@props(['id', 'type' => 'text', 'name', 'label' => null, 'placeholder' => '', 'value' => ''])

<div class="mb-3 position-relative">
    @if ($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif

    <div class="input-group">
        <input id="{{ $id }}" type="{{ $type }}" name="{{ $name }}"
            value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'form-control']) }}>
        @if ($type === 'password')
            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="{{ $id }}">
                <i class="fas fa-eye"></i>
            </button>
        @endif
    </div>

    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
