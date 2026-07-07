<x-app-layout>
    @php
        $authenticatedUser = auth()->user();
    @endphp

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
            <h5 class="mb-0">Dashboard</h5>
        </div>
        <div class="row m-3 dashboard">
            <div class="col-md-6 col-xl-6 ">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Enquiries</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $contactCount }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End  Card -->

            <div class="col-md-6 col-xl-6">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Account Status</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <div class="ps-3">
                                @if ($authenticatedUser->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Card -->

            <div class="col-md-6 col-xl-6">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Created On</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-calendar-plus"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ \App\Models\User::formatLocalDateTime($authenticatedUser->created_at) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Card -->

            <div class="col-md-6 col-xl-6">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Last Login</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-box-arrow-in-right"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ \App\Models\User::formatLocalDateTime($authenticatedUser->last_login_at, 'Never') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Card -->
        </div>
    </section>
</x-app-layout>
