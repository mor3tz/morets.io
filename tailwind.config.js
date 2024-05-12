import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
        
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'custom-beige': '#F5F5F5', // Pastikan tidak mendefinisikan key warna yang sama lebih dari sekali. Ambil nilai yang Anda inginkan.
                'green': '#87A922', // Warna untuk tombol
                'orange': '#FC4100', // Warna hover untuk tombol
                'white-custom' :'#F5F7F8',
            },
        },
    },
    plugins: [
        // ...
        require('@tailwindcss/forms'),
        require('flowbite/plugin'),
      ],
};
