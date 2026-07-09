<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="card mb-3">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Add Blog Tag</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('blog-tags.store') }}" class="row g-3 align-items-end">
                @csrf

                <div class="col-md-5">
                    <label for="name" class="form-label">Tag Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-5">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                        class="form-control @error('slug') is-invalid @enderror"
                        placeholder="Auto generated if blank">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Add Tag</button>
                </div>
            </form>
        </div>
    </section>

    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Blog Tags</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="sticky-top text-center bg-light">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Posts</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($tags as $tag)
                        <tr>
                            <td>{{ $tags->firstItem() + $loop->index }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->slug }}</td>
                            <td>{{ $tag->posts_count }}</td>
                            <td>{{ $tag->created_at?->format('d M Y') ?? 'Not set' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('website.blog', ['tag' => $tag->slug]) }}"
                                        class="btn btn-sm btn-info text-white" target="_blank" rel="noopener"
                                        title="View Posts" aria-label="View posts using this tag">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form method="POST" action="{{ route('blog-tags.destroy', $tag) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this blog tag? It will be removed from every blog post using it.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                            aria-label="Delete blog tag">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No blog tags available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($tags->hasPages())
            <div class="d-flex justify-content-end m-2">
                {!! $tags->links('pagination::simple-tailwind') !!}
            </div>
        @endif
    </section>
</x-app-layout>
