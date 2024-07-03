import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': '#E9001A',
                'secondary': '#063EAB',
                'darkgrey': '#343334',
                'lightgrey': '#F4F4F4',
                'grey': '#698597',
                'army': '#779945',
                'yellow': '#FEFFB8',
                'tr': 'rgba(5, 57, 109, 0.2)'
            },
        },
    },

    plugins: [forms],
};
