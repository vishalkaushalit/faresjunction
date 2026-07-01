<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('seo-meta.create') }}" class="btn btn-primary">Add SEO Meta</a>
    </div>

    <section class="card mb-4">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">SEO Meta Tags - Pages</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="sticky-top text-center bg-light">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Page</th>
                        <th>Key</th>
                        <th>Meta Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($pages as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['key'] }}</td>
                            <td>{{ $item['meta']->meta_title ?? 'Not set' }}</td>
                            <td>
                                @if (($item['meta']->status ?? false) === true)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive / Not Set</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('seo-meta.edit', ['type' => $item['type'], 'key' => $item['key']]) }}"
                                        class="btn btn-sm btn-primary" title="Edit" aria-label="Edit SEO meta">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    @if ($item['meta'])
                                        <form method="POST"
                                            action="{{ route('seo-meta.destroy', ['type' => $item['type'], 'key' => $item['key']]) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this SEO meta?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                aria-label="Delete SEO meta">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">SEO Meta Tags - Blogs</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="sticky-top text-center bg-light">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Blog</th>
                        <th>URL</th>
                        <th>Meta Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($blogs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>/blog/{{ $item['key'] }}</td>
                            <td>{{ $item['meta']->meta_title ?? 'Not set' }}</td>
                            <td>
                                @if (($item['meta']->status ?? false) === true)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive / Not Set</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('seo-meta.edit', ['type' => $item['type'], 'key' => $item['key']]) }}"
                                        class="btn btn-sm btn-primary" title="Edit" aria-label="Edit SEO meta">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    @if ($item['meta'])
                                        <form method="POST"
                                            action="{{ route('seo-meta.destroy', ['type' => $item['type'], 'key' => $item['key']]) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this SEO meta?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                aria-label="Delete SEO meta">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No blog data available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
