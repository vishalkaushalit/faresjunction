<x-app-layout>
    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between"><h5 class="mb-0">Add Package</h5><a href="{{ route('admin-packages.index') }}" class="btn btn-sm btn-light">Back</a></div>
        <div class="card-body">
            @include('packages.partials.errors')
            <form method="POST" action="{{ route('admin-packages.store') }}" enctype="multipart/form-data">@csrf
                @include('packages.partials.form')
                <button class="btn btn-primary">Add Package</button>
            </form>
        </div>
    </section>
</x-app-layout>
