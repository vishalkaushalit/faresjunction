<x-app-layout>
    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add {{ $singularTitle }}</h5>
            <a href="{{ route($routePrefix . '.index') }}" class="btn btn-sm btn-light">Back</a>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route($routePrefix . '.store') }}" enctype="multipart/form-data">
                @csrf

                @include('flight-route-destinations.partials.form')

                <button type="submit" class="btn btn-primary">Add {{ $singularTitle }}</button>
            </form>
        </div>
    </section>
</x-app-layout>
