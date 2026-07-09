<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category?->name) }}"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $category?->slug) }}"
            placeholder="domestic-flights">
        <small class="text-muted">Leave blank to generate from the category name.</small>
    </div>

    <div class="col-md-6 mb-3">
        <label for="parent_id" class="form-label">Parent Category</label>
        <select id="parent_id" name="parent_id" class="form-select">
            <option value="">Main category</option>
            @foreach ($parentCategories as $parentCategory)
                <option value="{{ $parentCategory->id }}" @selected((int) old('parent_id', $category?->parent_id) === $parentCategory->id)>
                    {{ $parentCategory->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label for="category_image" class="form-label">Category Image</label>
        <input type="file" id="category_image" name="category_image" class="form-control" accept="image/*"
            @required(! $category?->exists)>
        @if ($category?->image_url)
            <div class="mt-2">
                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" width="120"
                    class="rounded border">
            </div>
        @endif
    </div>
</div>
