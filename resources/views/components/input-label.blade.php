@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-gray-700 tracking-widest sm:tracking-wide md:tracking-normal lg:tracking-widest text-base sm:text-sm md:text-base lg:text-lg']) }}>
    {{ $value ?? $slot }}
</label>
