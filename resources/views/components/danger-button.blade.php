<button {{ $attributes->merge(['type' => 'submit', 'class' => 'fj-button fj-button-danger']) }}>
    {{ $slot }}
</button>
