<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
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
            ->with(['author', 'category'])
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

        if (! $request->user()->isAdmin()) {
            $validated['author_id'] = $request->user()->id;
        }

        $validated['featured_image'] = $this->storeFeaturedImage($request);
        $validated['tags'] = $this->normalizeTags($validated['tags'] ?? '');
        $validated['table_of_contents'] = $this->normalizeTableOfContents($validated['table_of_contents'] ?? []);
        $validated['published_at'] = $validated['status'] ? now() : null;

        BlogPost::create($validated);

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

        if (! $request->user()->isAdmin()) {
            $validated['author_id'] = $request->user()->id;
        }

        if ($request->hasFile('featured_image')) {
            $this->deleteFile($blogPost->featured_image);
            $validated['featured_image'] = $this->storeFeaturedImage($request);
        }

        $validated['tags'] = $this->normalizeTags($validated['tags'] ?? '');
        $validated['table_of_contents'] = $this->normalizeTableOfContents($validated['table_of_contents'] ?? []);
        $validated['published_at'] = $validated['status']
            ? ($blogPost->published_at ?? now())
            : null;

        $blogPost->update($validated);

        return redirect()->route('blog-posts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $this->authorizePostAccess($request, $blogPost);

        $this->deleteFile($blogPost->featured_image);
        $blogPost->delete();

        return redirect()->route('blog-posts.index')->with('success', 'Blog post deleted successfully.');
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
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'tags' => ['nullable', 'string', 'max:1000'],
            'table_of_contents' => ['nullable', 'array'],
            'table_of_contents.*.title' => ['nullable', 'string', 'max:255'],
            'table_of_contents.*.link' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
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

    private function normalizeTags(?string $tags): array
    {
        return collect(explode(',', (string) $tags))
            ->map(fn (string $tag): string => trim($tag))
            ->filter()
            ->unique(fn (string $tag): string => Str::lower($tag))
            ->values()
            ->all();
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
