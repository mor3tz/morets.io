import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'custom-beige': '#F5F5F5',
                'green': '#87A922',
                'orange': '#FC4100',
                'white-custom': '#F5F7F8',
                'table-color': '#EEEEEE',
                'btn': '#7E8EF1',
                'details': '#FFA62F',
                'btndetails': '#FFDA78',
                'dark': '#222831'
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin'),
    ],
};
