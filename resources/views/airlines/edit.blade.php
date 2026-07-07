<x-app-layout>
    <section class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Airline Page</h5>
            <a href="{{ route('airline-pages.index') }}" class="btn btn-sm btn-light">Back</a>
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

            <form method="POST" action="{{ route('airline-pages.update', $airlinePage) }}">
                @csrf
                @method('PUT')

                @include('airlines.partials.form', [
                    'airlinePage' => $airlinePage,
                    'sectionLabels' => $sectionLabels,
                ])

                <button type="submit" class="btn btn-primary">Save Airline Page</button>
            </form>
        </div>
    </section>
</x-app-layout>
