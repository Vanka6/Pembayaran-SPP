@props([
    'id' => '',
    'name',
    'label' => '',
    'placeholder' => '',
    'required' => false,
    'value' => '',
])

@php
    $inputId = $id ?: $name;
    $isInvalid = $errors->has($name) ? 'is-invalid' : '';
@endphp

<div class="mb-3">
    @if ($label)
        <label for="{{ $inputId }}" class="form-label">{{ $label }}</label>
    @endif

    <textarea id="{{ $inputId }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => "form-control $isInvalid",
            'rows' => 4,
        ]) }}>{{ old($name, $value) }}</textarea>

    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
