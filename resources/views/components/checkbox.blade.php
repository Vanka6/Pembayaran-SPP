@props(['id', 'name', 'value' => '', 'checked' => false, 'label' => ''])

@php
    $inputId = $id ?? $name . '-' . $value;
@endphp

<div class="form-check">
    <input type="checkbox" id="{{ $inputId }}" name="{{ $name }}[]" value="{{ $value }}"
        class="form-check-input" {{ $checked ? 'checked' : '' }} {{ $attributes }}>
    <label class="form-check-label" for="{{ $inputId }}">
        {{ $label }}
    </label>
    @error($name)
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>
