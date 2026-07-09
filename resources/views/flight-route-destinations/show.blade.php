<x-app-layout>
    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">View {{ $singularTitle }}</h5>
            <a href="{{ route($routePrefix . '.index') }}" class="btn btn-sm btn-light">Back</a>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    @if ($item->image_url)
                        <img src="{{ $item->image_url }}" alt="{{ $item->route_text }}"
                            class="img-fluid rounded border">
                    @else
                        <div class="border rounded p-4 text-center text-muted">No image uploaded.</div>
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered align-middle">
                        <tr>
                            <th width="220">{{ $itemLabel }}</th>
                            <td>{{ $item->route_text }}</td>
                        </tr>
                        <tr>
                            <th>Category Name</th>
                            <td>{{ $item->category?->name ?? 'Not set' }}</td>
                        </tr>
                        <tr>
                            <th>Trip Type</th>
                            <td>{{ $item->trip_type_label }}</td>
                        </tr>
                        <tr>
                            <th>Cabin Class</th>
                            <td>{{ $item->cabin_class }}</td>
                        </tr>
                        <tr>
                            <th>Pricing</th>
                            <td>{{ $item->pricing ?: 'Not set' }}</td>
                        </tr>
                        <tr>
                            <th>Tag</th>
                            <td>{{ $item->tag ?: 'Not set' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $item->is_published ? 'Published' : 'Draft' }}</td>
                        </tr>
                        <tr>
                            <th>Created Date</th>
                            <td>{{ $item->created_at?->format('d M Y h:i A') ?? 'Not set' }}</td>
                        </tr>
                    </table>

                    <div class="mb-3">
                        <h6>Description</h6>
                        <div class="border rounded p-3">
                            {!! $item->description ?: 'Not set' !!}
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route($routePrefix . '.edit', $item) }}" class="btn btn-primary">
                            Edit {{ $singularTitle }}
                        </a>
                        <form method="POST" action="{{ route($routePrefix . '.destroy', $item) }}"
                            onsubmit="return confirm('Are you sure you want to delete this {{ strtolower($singularTitle) }}?');">
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
