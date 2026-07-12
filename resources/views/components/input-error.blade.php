@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'fj-validation-errors']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
