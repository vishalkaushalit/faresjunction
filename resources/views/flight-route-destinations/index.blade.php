<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary">{{ $addButtonLabel }}</a>
    </div>

    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $pluralTitle }}</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="sticky-top text-center bg-light">
                    <tr>
                        <th>Sr. No.</th>
                        <th>{{ $imageLabel }}</th>
                        <th>{{ $itemLabel }}</th>
                        <th>Category Name</th>
                        <th>Trip Type</th>
                        <th>Cabin Class</th>
                        <th>Pricing</th>
                        <th>Tag</th>
                        <th>Published</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $items->firstItem() + $loop->index }}</td>
                            <td>
                                @if ($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->route_text }}" width="70"
                                        height="50" class="rounded border object-fit-cover">
                                @else
                                    Not set
                                @endif
                            </td>
                            <td>{{ $item->route_text }}</td>
                            <td>{{ $item->category?->name ?? 'Not set' }}</td>
                            <td>{{ $item->trip_type_label }}</td>
                            <td>{{ $item->cabin_class }}</td>
                            <td>{{ $item->pricing ?: 'Not set' }}</td>
                            <td>{{ $item->tag ?: 'Not set' }}</td>
                            <td>
                                @if ($item->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at?->format('d M Y') ?? 'Not set' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route($routePrefix . '.show', $item) }}"
                                        class="btn btn-sm btn-secondary" title="View" aria-label="View {{ strtolower($singularTitle) }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route($routePrefix . '.edit', $item) }}"
                                        class="btn btn-sm btn-primary" title="Edit" aria-label="Edit {{ strtolower($singularTitle) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route($routePrefix . '.destroy', $item) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this {{ strtolower($singularTitle) }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                            aria-label="Delete {{ strtolower($singularTitle) }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11">No {{ strtolower($pluralTitle) }} available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($items->hasPages())
            <div class="d-flex justify-content-end m-2">
                {!! $items->links('pagination::simple-tailwind') !!}
            </div>
        @endif
    </section>
</x-app-layout>
