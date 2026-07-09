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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RuntimeException;

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

    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'csv_file' => ['required', 'file', 'mimes:csv,txt', 'max:5120'],
        ]);

        $handle = fopen($request->file('csv_file')->getRealPath(), 'r');

        if ($handle === false) {
            return back()->with('error', 'Unable to read the uploaded CSV file.');
        }

        try {
            $imported = DB::transaction(fn (): int => $this->importCsvPosts($request, $handle));
        } catch (RuntimeException $exception) {
            return back()->with('error', $exception->getMessage());
        } finally {
            fclose($handle);
        }

        return redirect()
            ->route('blog-posts.index')
            ->with('success', $imported . ' blog ' . Str::plural('post', $imported) . ' imported successfully.');
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

    private function importCsvPosts(Request $request, mixed $handle): int
    {
        $headerRow = fgetcsv($handle);

        if ($headerRow === false) {
            throw new RuntimeException('The uploaded CSV file is empty.');
        }

        $headers = $this->normalizeCsvHeaders($headerRow);
        $created = 0;
        $rowNumber = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;

            if ($this->isEmptyCsvRow($row)) {
                continue;
            }

            $csvRow = $this->combineCsvRow($headers, $row);
            $data = $this->csvPostData($request, $csvRow, $rowNumber);
            $tags = $this->normalizeTags($this->csvValue($csvRow, 'tags', ''));

            $post = BlogPost::create($data);
            $this->syncTags($post, $tags);
            $created++;
        }

        if ($created === 0) {
            throw new RuntimeException('No blog posts found in the CSV file.');
        }

        return $created;
    }

    private function csvPostData(Request $request, array $row, int $rowNumber): array
    {
        $title = $this->csvValue($row, 'title', '');
        $content = $this->csvValue($row, ['content', 'body'], '');
        $slug = $this->csvValue($row, 'slug') ?: Str::slug($title);
        $status = $this->parseCsvBoolean($this->csvValue($row, ['status', 'published']), false, $rowNumber, 'status');
        $contentImageAlts = $this->parseCsvPipeList($this->csvValue($row, ['content_image_alts', 'image_alts']));

        $data = [
            'author_id' => $this->resolveCsvAuthorId($request, $row, $rowNumber),
            'blog_category_id' => $this->resolveCsvCategoryId($row, $rowNumber),
            'title' => $title,
            'slug' => $slug,
            'featured_image' => $this->csvValue($row, 'featured_image'),
            'featured_image_alt' => $this->csvValue($row, 'featured_image_alt'),
            'excerpt' => $this->csvValue($row, 'excerpt'),
            'table_of_contents' => $this->parseCsvTableOfContents($this->csvValue($row, ['table_of_contents', 'toc']), $rowNumber),
            'content' => $this->prepareContentImages($content, $contentImageAlts),
            'status' => $status,
            'published_at' => $this->csvPublishedAt($row, $status, $rowNumber),
        ];

        $validator = Validator::make($data, [
            'author_id' => [
                'required',
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
                Rule::unique('blog_posts', 'slug'),
            ],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'featured_image_alt' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'table_of_contents' => ['nullable', 'array'],
            'content' => ['required', 'string'],
            'status' => ['boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        if ($validator->fails()) {
            throw new RuntimeException('Row ' . $rowNumber . ': ' . $validator->errors()->first());
        }

        return $data;
    }

    private function normalizeCsvHeaders(array $headerRow): array
    {
        return collect($headerRow)
            ->map(function (?string $header, int $index): string {
                $header = preg_replace('/^\xEF\xBB\xBF/', '', (string) $header);
                $header = Str::lower(trim($header));
                $header = preg_replace('/[^a-z0-9]+/', '_', $header) ?: '';
                $header = trim($header, '_');

                return $header !== '' ? $header : 'column_' . ($index + 1);
            })
            ->all();
    }

    private function combineCsvRow(array $headers, array $row): array
    {
        $row = array_slice(array_pad($row, count($headers), ''), 0, count($headers));

        return array_combine($headers, $row) ?: [];
    }

    private function isEmptyCsvRow(array $row): bool
    {
        return collect($row)->every(fn (mixed $value): bool => trim((string) $value) === '');
    }

    private function csvValue(array $row, string|array $keys, ?string $default = null): ?string
    {
        foreach ((array) $keys as $key) {
            if (array_key_exists($key, $row) && trim((string) $row[$key]) !== '') {
                return trim((string) $row[$key]);
            }
        }

        return $default;
    }

    private function resolveCsvAuthorId(Request $request, array $row, int $rowNumber): int|string|null
    {
        if (! $request->user()->isAdmin()) {
            return $request->user()->id;
        }

        $authorId = $this->csvValue($row, 'author_id');

        if ($authorId !== null) {
            return $authorId;
        }

        $authorEmail = $this->csvValue($row, 'author_email');

        if ($authorEmail === null) {
            return $request->user()->id;
        }

        $author = User::query()
            ->where('email', $authorEmail)
            ->whereIn('role', [User::ROLE_ADMIN, User::ROLE_AUTHOR])
            ->first();

        if (! $author) {
            throw new RuntimeException('Row ' . $rowNumber . ': Author "' . $authorEmail . '" was not found.');
        }

        return $author->id;
    }

    private function resolveCsvCategoryId(array $row, int $rowNumber): int|string|null
    {
        $categoryId = $this->csvValue($row, ['blog_category_id', 'category_id']);

        if ($categoryId !== null) {
            return $categoryId;
        }

        $categorySlug = $this->csvValue($row, ['blog_category_slug', 'category_slug']);
        $categoryName = $this->csvValue($row, ['blog_category', 'category', 'category_name']);

        if ($categorySlug === null && $categoryName === null) {
            return null;
        }

        $categorySlug = $categorySlug ? Str::slug($categorySlug) : null;
        $categoryName = $categoryName ?: Str::headline(str_replace('-', ' ', (string) $categorySlug));

        $category = BlogCategory::query()
            ->where('status', true)
            ->when($categorySlug, fn ($query) => $query->where('slug', $categorySlug))
            ->when(! $categorySlug && $categoryName, fn ($query) => $query->where('name', $categoryName))
            ->first();

        return ($category ?? BlogCategory::create([
            'name' => $categoryName,
            'slug' => $this->uniqueCategorySlug($categorySlug ?: Str::slug($categoryName)),
            'status' => true,
        ]))->id;
    }

    private function uniqueCategorySlug(string $slug): string
    {
        $base = Str::limit($slug ?: 'blog-category', 240, '');
        $candidate = $base;
        $counter = 2;

        while (BlogCategory::query()->where('slug', $candidate)->exists()) {
            $suffix = '-' . $counter;
            $candidate = Str::limit($base, 255 - strlen($suffix), '') . $suffix;
            $counter++;
        }

        return $candidate;
    }

    private function parseCsvBoolean(?string $value, bool $default, int $rowNumber, string $field): bool
    {
        if ($value === null || $value === '') {
            return $default;
        }

        $normalized = Str::lower($value);

        if (in_array($normalized, ['1', 'true', 'yes', 'y', 'published', 'publish', 'active'], true)) {
            return true;
        }

        if (in_array($normalized, ['0', 'false', 'no', 'n', 'draft', 'unpublished', 'inactive'], true)) {
            return false;
        }

        throw new RuntimeException('Row ' . $rowNumber . ': ' . $field . ' must be true/false, yes/no, published, or draft.');
    }

    private function csvPublishedAt(array $row, bool $status, int $rowNumber): ?Carbon
    {
        if (! $status) {
            return null;
        }

        $publishedAt = $this->csvValue($row, 'published_at');

        if ($publishedAt === null) {
            return now();
        }

        try {
            return Carbon::parse($publishedAt);
        } catch (\Throwable) {
            throw new RuntimeException('Row ' . $rowNumber . ': published_at must be a valid date.');
        }
    }

    private function parseCsvTableOfContents(?string $value, int $rowNumber): array
    {
        if ($value === null || $value === '') {
            return [];
        }

        if (str_starts_with($value, '[') || str_starts_with($value, '{')) {
            $decoded = json_decode($value, true);

            if (! is_array($decoded)) {
                throw new RuntimeException('Row ' . $rowNumber . ': table_of_contents must be valid JSON or title|link pairs.');
            }

            $items = collect($decoded)
                ->map(fn (mixed $item): array => is_array($item)
                    ? [
                        'title' => $item['title'] ?? '',
                        'link' => $item['link'] ?? '',
                    ]
                    : ['title' => (string) $item, 'link' => ''])
                ->all();

            return $this->normalizeTableOfContents($items);
        }

        $items = collect(explode(';', $value))
            ->map(function (string $item): array {
                [$title, $link] = array_pad(explode('|', $item, 2), 2, '');

                return [
                    'title' => trim($title),
                    'link' => trim($link),
                ];
            })
            ->all();

        return $this->normalizeTableOfContents($items);
    }

    private function parseCsvPipeList(?string $value): array
    {
        if ($value === null || $value === '') {
            return [];
        }

        return collect(explode('|', $value))
            ->map(fn (string $item): string => trim($item))
            ->all();
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
