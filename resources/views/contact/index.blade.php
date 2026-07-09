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

    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Contact Form</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="sticky-top text-center bg-light">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Lead Date</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($contactdata as $key => $data)
                        <tr>
                            <td style="min-width: 80px;text-align:center;">{{ $key + 1 }}</td>
                            <td style="min-width: 100px;">{{ $data->name }}</td>
                            <td style="min-width: 100px;">{{ $data->email }}</td>
                            <td style="min-width: 100px;">{{ $data->phone }}</td>
                            <td style="min-width: 100px;">{{ $data->message }}</td>
                            <td style="min-width: 100px;">
                                <?php echo date('d/m/Y', strtotime($data->created_at)); ?>
                            </td>
                        </tr>
                    @endforeach
                    @if ($contactdata->isEmpty())
                        <tr>
                            <td colspan="7">No Data available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-end m-2">
                {!! $contactdata->links('pagination::simple-tailwind') !!}
            </div>
        </div>
    </section>
</x-app-layout>
