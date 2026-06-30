@php
    $isActive = (int) old('status', $category?->exists ? $category->status : 1) === 1;
@endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category?->name) }}"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $category?->slug) }}"
            placeholder="travel-tips">
        <small class="text-muted">Leave blank to generate from the category name.</small>
    </div>

    <div class="col-md-12 mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" rows="3" class="form-control">{{ old('description', $category?->description) }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-check">
            <input type="hidden" name="status" value="0">
            <input type="checkbox" id="status" name="status" value="1" class="form-check-input"
                @checked($isActive)>
            <label for="status" class="form-check-label">Active</label>
        </div>
    </div>
</div>
