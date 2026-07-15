<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin-packages.create') }}" class="btn btn-primary">Add Package</a>
    </div>

    <section class="card">
        <div class="card-header bg-danger text-white"><h5 class="mb-0">Packages</h5></div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="text-center bg-light"><tr><th>#</th><th>Title</th><th>Duration</th><th>Price</th><th>Status</th><th>Action</th></tr></thead>
                <tbody class="text-center">
                    @forelse ($packages as $package)
                        <tr>
                            <td>{{ $packages->firstItem() + $loop->index }}</td>
                            <td class="text-start">{{ $package->title }}<small class="d-block text-muted">{{ $package->slug }}</small></td>
                            <td>{{ $package->duration }}</td>
                            <td>{{ $package->price }}</td>
                            <td><span class="badge {{ $package->status ? 'bg-success' : 'bg-secondary' }}">{{ $package->status ? 'Active' : 'Inactive' }}</span></td>
                            <td><div class="d-flex justify-content-center gap-2">
                                @if ($package->status)<a href="{{ route('website.package-details', $package) }}" target="_blank" class="btn btn-sm btn-secondary" title="View"><i class="bi bi-eye"></i></a>@endif
                                <a href="{{ route('admin-packages.edit', $package) }}" class="btn btn-sm btn-primary" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <form method="POST" action="{{ route('admin-packages.destroy', $package) }}" onsubmit="return confirm('Delete this package?');">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" title="Delete"><i class="bi bi-trash"></i></button></form>
                            </div></td>
                        </tr>
                    @empty
                        <tr><td colspan="6">No packages available.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($packages->hasPages())<div class="d-flex justify-content-end m-2">{!! $packages->links('pagination::simple-bootstrap-5') !!}</div>@endif
    </section>
</x-app-layout>
