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
                'euro-lightest': '#f0f4f8',
                'euro-light': '#bcccdc',
                'euro': '#829ab1',
                'euro-dark': '#486581',
                'euro-darkest': '#102a43',
            },
        },
    },

    plugins: [forms],
};
