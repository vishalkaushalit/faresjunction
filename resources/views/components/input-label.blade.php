@props(['value'])

<label {{ $attributes->merge(['class' => 'fj-label']) }}>
    {{ $value ?? $slot }}
</label>
