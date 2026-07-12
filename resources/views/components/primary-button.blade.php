<button {{ $attributes->merge(['type' => 'submit', 'class' => 'fj-button fj-button-primary']) }}>
    {{ $slot }}
</button>
