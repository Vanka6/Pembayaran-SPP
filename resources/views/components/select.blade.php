@props(['id', 'name', 'label' => null, 'options' => [], 'selected' => null])

<div class="mb-3">
    @if ($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif
    <select id="{{ $id }}" name="{{ $name }}" required
        {{ $attributes->merge(['class' => 'form-control']) }}>
        <option value="" disabled {{ old($name, $selected) ? '' : 'selected' }}>~~ Pilih
            {{ ucwords(str_replace('_', ' ', $name)) }} ~~
        </option>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
