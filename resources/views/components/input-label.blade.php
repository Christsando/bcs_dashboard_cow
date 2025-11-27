@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-darkblue dark:text-darkblue']) }}>
    {{ $value ?? $slot }}
</label>
