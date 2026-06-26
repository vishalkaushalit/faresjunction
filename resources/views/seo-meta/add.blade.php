<x-app-layout>
    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add SEO Meta Tags</h5>
            <a href="{{ route('seo-meta.index') }}" class="btn btn-sm btn-light">Back</a>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="alert alert-info">
                Add a page/blog key from admin. This manages SEO only; the actual website page or blog must already exist.
            </div>

            <form method="POST" action="{{ route('seo-meta.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="page_type" class="form-label">Page Type</label>
                        <select id="page_type" name="page_type" class="form-control" required>
                            <option value="page" @selected(old('page_type') === 'page')>Page</option>
                            <option value="blog" @selected(old('page_type') === 'blog')>Blog</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="page_name" class="form-label">Page / Blog Name</label>
                        <input type="text" id="page_name" name="page_name" class="form-control"
                            value="{{ old('page_name') }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="page_key" class="form-label">Page Key / Blog Slug</label>
                        <input type="text" id="page_key" name="page_key" class="form-control"
                            value="{{ old('page_key') }}" placeholder="example-page" required>
                        <small class="text-muted">Use lowercase letters, numbers, and hyphens only.</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title" class="form-control"
                            value="{{ old('meta_title') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="canonical_url" class="form-label">Canonical URL</label>
                        <input type="url" id="canonical_url" name="canonical_url" class="form-control"
                            value="{{ old('canonical_url') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" rows="3" class="form-control">{{ old('meta_description') }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <textarea id="meta_keywords" name="meta_keywords" rows="2" class="form-control">{{ old('meta_keywords') }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="og_title" class="form-label">OG Title</label>
                        <input type="text" id="og_title" name="og_title" class="form-control"
                            value="{{ old('og_title') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="og_image" class="form-label">OG Image URL</label>
                        <input type="text" id="og_image" name="og_image" class="form-control"
                            value="{{ old('og_image') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="og_description" class="form-label">OG Description</label>
                        <textarea id="og_description" name="og_description" rows="3" class="form-control">{{ old('og_description') }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" id="status" name="status" value="1" class="form-check-input"
                                @checked((int) old('status', 1) === 1)>
                            <label for="status" class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Add Meta Tags</button>
            </form>
        </div>
    </section>
</x-app-layout>
