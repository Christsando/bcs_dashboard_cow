import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                softblue: '#F4F7FE',
                darkblue: '#2B3674',
                basicfont: '#707EAE',
                
                borderblue: '#707EAE',

                activeblue: '#4318FF',
                inactiveblue: '#707EAE',
            },
        },
    },

    plugins: [forms],
};
