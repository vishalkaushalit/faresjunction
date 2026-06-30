<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('blog-posts.create') }}" class="btn btn-primary">Add Blog Post</a>
    </div>

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
                                @if (!empty($post->tags))
                                    <div class="mt-1">
                                        @foreach ($post->tags as $tag)
                                            <span class="badge bg-info text-dark">{{ $tag }}</span>
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
                                    <a href="{{ route('blog-posts.edit', $post) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form method="POST" action="{{ route('blog-posts.destroy', $post) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
