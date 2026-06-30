@php
    $isPublished = (int) old('status', $post?->exists ? $post->status : 0) === 1;
    $tagsValue = old('tags', implode(', ', $post?->tags ?? []));
    $tocItems = old('table_of_contents', $post?->table_of_contents ?? []);
    $tocItems = count($tocItems) ? $tocItems : [['title' => '', 'link' => '']];
@endphp

<div class="row">
    @if (auth()->user()->isAdmin())
        <div class="col-md-6 mb-3">
            <label for="author_id" class="form-label">Author</label>
            <select id="author_id" name="author_id" class="form-select" required>
                <option value="">Select Author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" @selected((int) old('author_id', $post?->author_id) === $author->id)>
                        {{ $author->name }} ({{ $author->email }})
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="col-md-6 mb-3">
        <label for="blog_category_id" class="form-label">Category</label>
        <select id="blog_category_id" name="blog_category_id" class="form-select">
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('blog_category_id', $post?->blog_category_id) === $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post?->title) }}"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $post?->slug) }}"
            placeholder="best-travel-tips">
        <small class="text-muted">Leave blank to generate from the title.</small>
    </div>

    <div class="col-md-6 mb-3">
        <label for="featured_image" class="form-label">Featured Image</label>
        <input type="file" id="featured_image" name="featured_image" class="form-control" accept="image/*">
        @if ($post?->featured_image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" width="120"
                    class="rounded border">
            </div>
        @endif
    </div>

    <div class="col-md-12 mb-3">
        <label for="excerpt" class="form-label">Excerpt</label>
        <textarea id="excerpt" name="excerpt" rows="3" class="form-control">{{ old('excerpt', $post?->excerpt) }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label for="tags" class="form-label">Tags</label>
        <input type="text" id="tags" name="tags" class="form-control" value="{{ $tagsValue }}"
            placeholder="Europe, Flights, Budget Travel">
        <small class="text-muted">Separate tags with commas.</small>
    </div>

    <div class="col-md-12 mb-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label mb-0">Table of Contents</label>
            <button type="button" class="btn btn-sm btn-outline-primary" id="add-toc-item">Add Item</button>
        </div>
        <div class="border rounded p-3 bg-light" id="toc-items">
            @foreach ($tocItems as $index => $item)
                <div class="row g-2 align-items-end toc-item mb-2">
                    <div class="col-md-5">
                        <label class="form-label">Title</label>
                        <input type="text" name="table_of_contents[{{ $index }}][title]" class="form-control"
                            value="{{ $item['title'] ?? '' }}" placeholder="Spring (March to May) - Best for Sightseeing">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Link</label>
                        <input type="text" name="table_of_contents[{{ $index }}][link]" class="form-control"
                            value="{{ $item['link'] ?? '' }}" placeholder="#spring or https://example.com/page">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-danger w-100 remove-toc-item">Remove</button>
                    </div>
                </div>
            @endforeach
        </div>
        <small class="text-muted">Use links like #spring to jump to headings inside the post. Leave link blank to auto-create one from the title.</small>
    </div>

    <div class="col-md-12 mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea id="content" name="content" rows="8" class="form-control" required>{{ old('content', $post?->content) }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-check">
            <input type="hidden" name="status" value="0">
            <input type="checkbox" id="status" name="status" value="1" class="form-check-input"
                @checked($isPublished)>
            <label for="status" class="form-check-label">Published</label>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('toc-items');
        const addButton = document.getElementById('add-toc-item');

        if (!wrapper || !addButton) {
            return;
        }

        const refreshIndexes = () => {
            wrapper.querySelectorAll('.toc-item').forEach((row, index) => {
                row.querySelectorAll('input').forEach((input) => {
                    const field = input.name.endsWith('[link]') ? 'link' : 'title';
                    input.name = `table_of_contents[${index}][${field}]`;
                });
            });
        };

        addButton.addEventListener('click', () => {
            const index = wrapper.querySelectorAll('.toc-item').length;
            const row = document.createElement('div');
            row.className = 'row g-2 align-items-end toc-item mb-2';
            row.innerHTML = `
                <div class="col-md-5">
                    <label class="form-label">Title</label>
                    <input type="text" name="table_of_contents[${index}][title]" class="form-control" placeholder="Spring (March to May) - Best for Sightseeing">
                </div>
                <div class="col-md-5">
                    <label class="form-label">Link</label>
                    <input type="text" name="table_of_contents[${index}][link]" class="form-control" placeholder="#spring or https://example.com/page">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-danger w-100 remove-toc-item">Remove</button>
                </div>
            `;
            wrapper.appendChild(row);
        });

        wrapper.addEventListener('click', (event) => {
            if (!event.target.classList.contains('remove-toc-item')) {
                return;
            }

            const rows = wrapper.querySelectorAll('.toc-item');
            if (rows.length === 1) {
                rows[0].querySelectorAll('input').forEach((input) => input.value = '');
                return;
            }

            event.target.closest('.toc-item').remove();
            refreshIndexes();
        });
    });
</script>
