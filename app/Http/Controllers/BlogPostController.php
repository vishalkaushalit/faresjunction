<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Tag;
use App\Models\User;
use DOMDocument;
use DOMElement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(Request $request): View
    {
        $posts = BlogPost::query()
            ->with(['author', 'category', 'tags'])
            ->when(! $request->user()->isAdmin(), fn ($query) => $query->where('author_id', $request->user()->id))
            ->latest()
            ->paginate(10);

        return view('blog-posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('blog-posts.create', [
            'post' => null,
            'categories' => BlogCategory::query()->where('status', true)->orderBy('name')->get(),
            'authors' => $this->authorsForSelect(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedPostData($request);
        $tags = $this->normalizeTags($validated['tags'] ?? '');
        unset($validated['tags']);

        if (! $request->user()->isAdmin()) {
            $validated['author_id'] = $request->user()->id;
        }

        $validated['featured_image'] = $this->storeFeaturedImage($request);
        $validated['content'] = $this->prepareContentImages(
            $validated['content'],
            $validated['content_image_alts'] ?? []
        );
        unset($validated['content_image_alts']);

        $validated['table_of_contents'] = $this->normalizeTableOfContents($validated['table_of_contents'] ?? []);
        $validated['published_at'] = $validated['status'] ? now() : null;

        $post = BlogPost::create($validated);
        $this->syncTags($post, $tags);

        return redirect()->route('blog-posts.index')->with('success', 'Blog post added successfully.');
    }

    public function edit(Request $request, BlogPost $blogPost): View
    {
        $this->authorizePostAccess($request, $blogPost);

        return view('blog-posts.edit', [
            'post' => $blogPost,
            'categories' => BlogCategory::query()->where('status', true)->orderBy('name')->get(),
            'authors' => $this->authorsForSelect(),
        ]);
    }

    public function update(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $this->authorizePostAccess($request, $blogPost);

        $validated = $this->validatedPostData($request, $blogPost);
        $tags = $this->normalizeTags($validated['tags'] ?? '');
        unset($validated['tags']);

        if (! $request->user()->isAdmin()) {
            $validated['author_id'] = $request->user()->id;
        }

        if ($request->hasFile('featured_image')) {
            $this->deleteFile($blogPost->featured_image);
            $validated['featured_image'] = $this->storeFeaturedImage($request);
        }

        $validated['content'] = $this->prepareContentImages(
            $validated['content'],
            $validated['content_image_alts'] ?? []
        );
        unset($validated['content_image_alts']);

        $validated['table_of_contents'] = $this->normalizeTableOfContents($validated['table_of_contents'] ?? []);
        $validated['published_at'] = $validated['status']
            ? ($blogPost->published_at ?? now())
            : null;

        $blogPost->update($validated);
        $this->syncTags($blogPost, $tags);

        return redirect()->route('blog-posts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $this->authorizePostAccess($request, $blogPost);

        $this->deleteFile($blogPost->featured_image);
        $blogPost->delete();

        return redirect()->route('blog-posts.index')->with('success', 'Blog post deleted successfully.');
    }

    public function duplicate(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $this->authorizePostAccess($request, $blogPost);

        $blogPost->loadMissing('tags');

        $duplicate = BlogPost::create([
            'author_id' => $blogPost->author_id,
            'blog_category_id' => $blogPost->blog_category_id,
            'title' => $this->duplicateTitle($blogPost->title),
            'slug' => $this->uniqueDuplicateSlug($blogPost->slug),
            'featured_image' => $this->copyFeaturedImage($blogPost->featured_image),
            'featured_image_alt' => $blogPost->featured_image_alt,
            'excerpt' => $blogPost->excerpt,
            'table_of_contents' => $blogPost->table_of_contents,
            'content' => $blogPost->content,
            'status' => false,
            'published_at' => null,
        ]);

        $duplicate->tags()->sync($blogPost->tags->pluck('id')->all());

        return redirect()
            ->route('blog-posts.edit', $duplicate)
            ->with('success', 'Blog post duplicated successfully. Review and publish it when ready.');
    }

    public function uploadContentImage(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => ['required', 'image', 'max:5120'],
        ]);

        $path = $request->file('upload')->store('blog-posts/content', 'public');

        return response()->json([
            'uploaded' => 1,
            'fileName' => basename($path),
            'url' => Storage::url($path),
        ]);
    }

    public function uploadContentFile(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => ['required', 'file', 'max:10240'],
        ]);

        $file = $request->file('upload');
        $extension = $file->getClientOriginalExtension();
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $filename = ($filename ?: 'file') . '-' . Str::uuid() . ($extension ? '.' . $extension : '');
        $path = $file->storeAs('blog-posts/files', $filename, 'public');

        return response()->json([
            'uploaded' => 1,
            'fileName' => basename($path),
            'url' => Storage::url($path),
        ]);
    }

    private function validatedPostData(Request $request, ?BlogPost $blogPost = null): array
    {
        $slug = $request->filled('slug')
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('title'));

        $request->merge(['slug' => $slug]);

        return $request->validate([
            'author_id' => [
                $request->user()->isAdmin() ? 'required' : 'nullable',
                'integer',
                Rule::exists('users', 'id')->whereIn('role', [User::ROLE_ADMIN, User::ROLE_AUTHOR]),
            ],
            'blog_category_id' => ['nullable', 'integer', Rule::exists('blog_categories', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('blog_posts', 'slug')->ignore($blogPost),
            ],
            'featured_image' => ['nullable', 'image', 'max:2048'],
            'featured_image_alt' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'tags' => ['nullable', 'string', 'max:1000'],
            'table_of_contents' => ['nullable', 'array'],
            'table_of_contents.*.title' => ['nullable', 'string', 'max:255'],
            'table_of_contents.*.link' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'content_image_alts' => ['nullable', 'array'],
            'content_image_alts.*' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'boolean'],
        ]) + [
            'status' => $request->boolean('status'),
        ];
    }

    private function authorizePostAccess(Request $request, BlogPost $blogPost): void
    {
        abort_unless($request->user()->isAdmin() || $blogPost->author_id === $request->user()->id, 403);
    }

    private function authorsForSelect()
    {
        return User::query()
            ->whereIn('role', [User::ROLE_ADMIN, User::ROLE_AUTHOR])
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'role']);
    }

    private function storeFeaturedImage(Request $request): ?string
    {
        return $request->file('featured_image')?->store('blog-posts', 'public');
    }

    private function duplicateTitle(string $title): string
    {
        return Str::limit($title . ' Copy', 255, '');
    }

    private function uniqueDuplicateSlug(string $slug): string
    {
        $base = Str::limit(Str::slug($slug) ?: 'blog-post', 240, '');
        $candidate = $base . '-copy';
        $counter = 2;

        while (BlogPost::query()->where('slug', $candidate)->exists()) {
            $suffix = '-copy-' . $counter;
            $candidate = Str::limit($base, 255 - strlen($suffix), '') . $suffix;
            $counter++;
        }

        return $candidate;
    }

    private function copyFeaturedImage(?string $path): ?string
    {
        if (! $path || ! Storage::disk('public')->exists($path)) {
            return $path;
        }

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $directory = pathinfo($path, PATHINFO_DIRNAME);
        $copyPath = trim($directory === '.' ? '' : $directory, '/');
        $copyPath .= ($copyPath ? '/' : '') . Str::uuid() . ($extension ? '.' . $extension : '');

        Storage::disk('public')->copy($path, $copyPath);

        return $copyPath;
    }

    private function normalizeTags(?string $tags): array
    {
        return collect(explode(',', (string) $tags))
            ->map(fn (string $tag): string => trim($tag))
            ->filter()
            ->unique(fn (string $tag): string => Str::lower($tag))
            ->values()
            ->all();
    }

    private function syncTags(BlogPost $post, array $tagNames): void
    {
        $tagIds = collect($tagNames)
            ->map(function (string $name): ?int {
                $slug = Str::slug($name);

                if ($slug === '') {
                    return null;
                }

                return Tag::query()->firstOrCreate(
                    ['slug' => $slug],
                    ['name' => $name]
                )->id;
            })
            ->filter()
            ->values()
            ->all();

        $post->tags()->sync($tagIds);
    }

    private function prepareContentImages(string $content, array $alts): string
    {
        if ($content === '' || ! str_contains(Str::lower($content), '<img')) {
            return $content;
        }

        $document = new DOMDocument();
        $previous = libxml_use_internal_errors(true);

        $document->loadHTML(
            '<?xml encoding="utf-8" ?><div id="blog-content-wrapper">' . $content . '</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );

        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $images = $document->getElementsByTagName('img');

        foreach ($images as $index => $image) {
            if (! $image instanceof DOMElement) {
                continue;
            }

            if (array_key_exists($index, $alts)) {
                $image->setAttribute('alt', trim((string) $alts[$index]));
            }

            $storedUrl = $this->storeEmbeddedContentImage($image->getAttribute('src'));

            if ($storedUrl) {
                $image->setAttribute('src', $storedUrl);
            }
        }

        $wrapper = $document->getElementById('blog-content-wrapper');

        if (! $wrapper instanceof DOMElement) {
            return $content;
        }

        $html = '';
        foreach ($wrapper->childNodes as $child) {
            $html .= $document->saveHTML($child);
        }

        return $html;
    }

    private function storeEmbeddedContentImage(string $src): ?string
    {
        if (! preg_match('/^data:image\/(png|jpe?g|gif|webp);base64,(.+)$/i', $src, $matches)) {
            return null;
        }

        $extension = strtolower($matches[1]) === 'jpeg' ? 'jpg' : strtolower($matches[1]);
        $contents = base64_decode(preg_replace('/\s+/', '', $matches[2]), true);

        if ($contents === false || strlen($contents) > 5 * 1024 * 1024) {
            return null;
        }

        $path = 'blog-posts/content/' . Str::uuid() . '.' . $extension;

        Storage::disk('public')->put($path, $contents);

        return Storage::url($path);
    }

    private function normalizeTableOfContents(array $items): array
    {
        return collect($items)
            ->map(function (array $item): ?array {
                $title = trim((string) ($item['title'] ?? ''));
                $link = trim((string) ($item['link'] ?? ''));

                if ($title === '' && $link === '') {
                    return null;
                }

                if ($title === '') {
                    return null;
                }

                return [
                    'title' => $title,
                    'link' => $link !== '' ? $link : '#' . Str::slug($title),
                ];
            })
            ->filter()
            ->values()
            ->all();
    }

    private function deleteFile(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
