@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
$alignmentClasses = match ($align) {
    'left' => 'start-0',
    'top' => 'start-50 translate-middle-x',
    default => 'end-0',
};

$width = match ($width) {
    '48' => 'dropdown-panel-width',
    default => $width,
};
@endphp

<div class="position-relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            class="position-absolute z-3 mt-2 {{ $width }} rounded shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="rounded {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
