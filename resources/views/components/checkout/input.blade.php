@props(['name', 'label', 'type' => 'text'])
@php
    $input_array_name = str_replace('[', '.', $name);
    $input_array_name = str_replace(']', '', $input_array_name);
    $parts = explode('.', $input_array_name);
    $input_error_name = $parts[count($parts) - 1];

    $hasError = $errors->has($input_array_name);
@endphp
<div class="{{ $attributes->get('class') }}">
    <div class="billing-info mb-4">
        <label for="{{ $name }}">{{ $label . ($attributes->get('required') ? ' *' : '') }}</label>
        <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}"
            class="{{ $hasError ? 'border border-danger' : '' }}" {{ $attributes->get('required') ? 'required' : '' }} />
        @if ($hasError)
            <i class="text-danger text-sm">
                {{ ucfirst($label) }} is required
            </i>
        @endif
    </div>
</div>
