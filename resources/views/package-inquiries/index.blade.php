<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <section class="card">
        <div class="card-header bg-danger text-white"><h5 class="mb-0">Package Enquiries</h5></div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="text-center bg-light"><tr><th>#</th><th>Customer</th><th>Contact</th><th>Interest</th><th>Travel</th><th>Message</th><th>Email status</th><th>Received</th><th>Action</th></tr></thead>
                <tbody>
                    @forelse ($inquiries as $inquiry)
                        <tr>
                            <td class="text-center">{{ $inquiries->firstItem() + $loop->index }}</td>
                            <td>{{ $inquiry->name }}<small class="d-block text-muted">Source: {{ ucfirst($inquiry->source) }}</small></td>
                            <td><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a><small class="d-block"><a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a></small></td>
                            <td>{{ $inquiry->package?->title ?? $inquiry->interest }}</td>
                            <td>{{ $inquiry->travel_date->format('d M Y') }}<small class="d-block text-muted">{{ $inquiry->traveler_count }} traveler(s)</small></td>
                            <td style="min-width: 180px;">{{ $inquiry->message ?: 'Not provided' }}</td>
                            <td>
                                <span class="badge {{ $inquiry->admin_notified_at ? 'bg-success' : 'bg-danger' }}">Admin</span>
                                <span class="badge {{ $inquiry->user_notified_at ? 'bg-success' : 'bg-danger' }}">User</span>
                                @if ($inquiry->notification_error)<small class="d-block text-danger mt-1" title="{{ $inquiry->notification_error }}">Delivery failed</small>@endif
                            </td>
                            <td>{{ $inquiry->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center"><form method="POST" action="{{ route('package-inquiries.destroy', $inquiry) }}" onsubmit="return confirm('Delete this inquiry?');">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" title="Delete"><i class="bi bi-trash"></i></button></form></td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center">No package enquiries available.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($inquiries->hasPages())<div class="d-flex justify-content-end m-2">{{ $inquiries->links('pagination::simple-bootstrap-5') }}</div>@endif
    </section>
</x-app-layout>
