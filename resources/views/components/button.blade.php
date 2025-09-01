@props(['type' => 'submit', 'class' => 'btn btn-primary'])

<div class="d-grid mt-4">
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </button>
</div>
