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
            colors: {
                primary: '#F1F0E8', //based color
                secondary: '#ADC4CE', //second color (for the box)
                customButton: '#96B6C5', //for button
                customHover: '#96B6C5', //hover home button
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                dmsans: ['DM Sans', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
