<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('flight-categories.create') }}" class="btn btn-primary">Add Flight Category</a>
    </div>

    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Flight Categories</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="sticky-top text-center bg-light">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Category Image</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Parent Category</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Posts Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($flightCategories as $category)
                        <tr>
                            <td>{{ $flightCategories->firstItem() + $loop->index }}</td>
                            <td>
                                @if ($category->image_url)
                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" width="70"
                                        height="50" class="rounded border object-fit-cover">
                                @else
                                    Not set
                                @endif
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->parent?->name ?? 'Main category' }}</td>
                            <td>{{ $category->created_at?->format('d M Y h:i A') ?? 'Not set' }}</td>
                            <td>{{ $category->updated_at?->format('d M Y h:i A') ?? 'Not set' }}</td>
                            <td>{{ $category->posts_count }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('flight-categories.show', $category) }}"
                                        class="btn btn-sm btn-secondary" title="View" aria-label="View flight category">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('flight-categories.edit', $category) }}"
                                        class="btn btn-sm btn-primary" title="Edit" aria-label="Edit flight category">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('flight-categories.destroy', $category) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this flight category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                            aria-label="Delete flight category">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">No flight categories available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($flightCategories->hasPages())
            <div class="d-flex justify-content-end m-2">
                {!! $flightCategories->links('pagination::simple-bootstrap-5') !!}
            </div>
        @endif
    </section>
</x-app-layout>
