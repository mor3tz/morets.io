<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'mt-5 w-2/5 inline-flex items-center justify-center px-4 py-2 bg-orange border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
    'style' => 'box-shadow: 0 4px 6px rgba(0, 0, 0, 1);'  // Adding shadow effect
    ]) }}>
    {{ $slot }}
</button>
