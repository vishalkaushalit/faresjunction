@props(['active'])

@php
$classes = ($active ?? false)
            ? 'd-inline-flex align-items-center px-1 pt-1 border-bottom border-2 border-primary small fw-medium  text-dark     '
            : 'd-inline-flex align-items-center px-1 pt-1 border-bottom border-2 border-0 small fw-medium  text-muted        ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
