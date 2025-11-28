import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/components/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                primary: '#F1F0E8', //based color
                secondary: '#ADC4CE', //second color (for the box)
                customButton: '#96B6C5', //for button
                customHover: '#96B6C5', //hover home button
                basetext: '#303030', //base text color
                blacktext: '#1E1E1E', //darker text
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                dmsans: ['DM Sans', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
