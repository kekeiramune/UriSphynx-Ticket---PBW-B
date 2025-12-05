@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium font-dmsans text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
