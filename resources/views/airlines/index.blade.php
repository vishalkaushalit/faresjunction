<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('airline-pages.create') }}" class="btn btn-primary">Add Airline Page</a>
    </div>

    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Airline Pages</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="sticky-top text-center bg-light">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Slug</th>
                        <th>Routes</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($airlinePages as $airlinePage)
                        <tr>
                            <td>{{ $airlinePages->firstItem() + $loop->index }}</td>
                            <td>{{ $airlinePage->name }}</td>
                            <td>{{ $airlinePage->code ?: 'Not set' }}</td>
                            <td>{{ $airlinePage->slug }}</td>
                            <td>{{ count($airlinePage->routes ?? []) }}</td>
                            <td>
                                @if ($airlinePage->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('website.airline.slug', $airlinePage->slug) }}"
                                        class="btn btn-sm btn-secondary" title="View" aria-label="View airline page"
                                        target="_blank">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('airline-pages.edit', $airlinePage) }}"
                                        class="btn btn-sm btn-primary" title="Edit" aria-label="Edit airline page">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('airline-pages.destroy', $airlinePage) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this airline page?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                            aria-label="Delete airline page">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No airline pages available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($airlinePages->hasPages())
            <div class="d-flex justify-content-end m-2">
                {!! $airlinePages->links('pagination::simple-tailwind') !!}
            </div>
        @endif
    </section>
</x-app-layout>
