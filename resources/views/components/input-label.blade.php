@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold  text-white tracking-wider']) }}>
    {{ $value ?? $slot }}
</label>
