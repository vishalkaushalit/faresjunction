@props(['active'])

@php
$classes = ($active ?? false)
            ? 'd-block w-100 ps-3 pe-4 py-2 border-start border-4 border-primary text-start  fw-medium text-primary bg-light       '
            : 'd-block w-100 ps-3 pe-4 py-2 border-start border-4 border-0 text-start  fw-medium text-secondary          ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
