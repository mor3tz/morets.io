@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'bg-white-custom border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm mt-6',
    'style' => 'box-shadow: inset 0 2px 4px rgba(0,0,0,0.5);'  // Inner shadow style
]) !!}>
