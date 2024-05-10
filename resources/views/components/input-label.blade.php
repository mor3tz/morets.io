@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold  text-2xl text-white']) }}>
    {{ $value ?? $slot }}
</label>
