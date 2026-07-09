<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('blog-posts.create') }}" class="btn btn-primary">Add Blog Post</a>
    </div>

    <section class="card mb-3">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Import Blog Posts</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('blog-posts.import') }}" enctype="multipart/form-data"
                class="row g-3 align-items-end">
                @csrf
                <div class="col-md-8">
                    <label for="csv_file" class="form-label">CSV File</label>
                    <input type="file" id="csv_file" name="csv_file" class="form-control" accept=".csv,text/csv"
                        required>
                    <small class="text-muted">
                        Required columns: title, content. Optional columns: slug, author_email, category_slug,
                        category, excerpt, tags, status, featured_image_alt, table_of_contents. Missing categories
                        are created automatically.
                    </small>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-upload"></i> Upload CSV
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Blog Posts</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="sticky-top text-center bg-light">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($posts as $post)
                        <tr>
                            <td>{{ $posts->firstItem() + $loop->index }}</td>
                            <td class="text-start">
                                <strong>{{ $post->title }}</strong>
                                <div class="small text-muted">{{ $post->slug }}</div>
                                @if ($post->tags->isNotEmpty())
                                    <div class="mt-1">
                                        @foreach ($post->tags as $tag)
                                            <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td>{{ $post->author?->name ?? 'Not set' }}</td>
                            <td>{{ $post->category?->name ?? 'Not set' }}</td>
                            <td>
                                @if ($post->status)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>{{ $post->published_at?->format('d M Y') ?? 'Not published' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('website.blog-details', $post->slug) }}"
                                        class="btn btn-sm btn-info text-white" target="_blank" rel="noopener"
                                        title="View" aria-label="View blog post">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('blog-posts.edit', $post) }}" class="btn btn-sm btn-primary"
                                        title="Edit" aria-label="Edit blog post">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('blog-posts.duplicate', $post) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary" title="Duplicate"
                                            aria-label="Duplicate blog post">
                                            <i class="bi bi-copy"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('blog-posts.destroy', $post) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                            aria-label="Delete blog post">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No blog posts available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($posts->hasPages())
            <div class="d-flex justify-content-end m-2">
                {!! $posts->links() !!}
            </div>
        @endif
    </section>
</x-app-layout>
