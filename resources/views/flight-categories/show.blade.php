<x-app-layout>
    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">View Flight Category</h5>
            <a href="{{ route('flight-categories.index') }}" class="btn btn-sm btn-light">Back</a>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    @if ($flightCategory->image_url)
                        <img src="{{ $flightCategory->image_url }}" alt="{{ $flightCategory->name }}"
                            class="img-fluid rounded border">
                    @else
                        <div class="border rounded p-4 text-center text-muted">No image uploaded.</div>
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered align-middle">
                        <tr>
                            <th width="220">Category Name</th>
                            <td>{{ $flightCategory->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $flightCategory->slug }}</td>
                        </tr>
                        <tr>
                            <th>Parent Category</th>
                            <td>{{ $flightCategory->parent?->name ?? 'Main category' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $flightCategory->created_at?->format('d M Y h:i A') ?? 'Not set' }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $flightCategory->updated_at?->format('d M Y h:i A') ?? 'Not set' }}</td>
                        </tr>
                        <tr>
                            <th>Posts Count</th>
                            <td>{{ $flightCategory->posts_count }}</td>
                        </tr>
                    </table>

                    <div class="d-flex gap-2">
                        <a href="{{ route('flight-categories.edit', $flightCategory) }}" class="btn btn-primary">
                            Edit Flight Category
                        </a>
                        <form method="POST" action="{{ route('flight-categories.destroy', $flightCategory) }}"
                            onsubmit="return confirm('Are you sure you want to delete this flight category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
