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
                // Primary Colors
                'primary': '#00B4D8',
                'primary-light': '#90E0EF',
                'primary-dark': '#0077B6',

                // Secondary Colors
                'secondary': '#48CAE4',
                'secondary-light': '#ADE8F4',
                'secondary-dark': '#0096C7',

                // Text Colors (you can also use Tailwind's default gray shades for these,
                // or define your own custom grays if needed)
                'text-primary': '#212529', // Dark gray for main text
                'text-secondary': '#495057', // Slightly lighter gray for secondary text
                'text-light': '#F8F9FA',    // White/light gray for text on dark backgrounds
                'text-link': '#00B4D8',     // Links use primary color
                'text-error': '#DC3545',    // Red for error messages
                'text-success': '#28A745',  // Green for success messages

                // If you want to use your custom gray scale, you can define them here
                // 'gray-100': '#F8F9FA',
                // 'gray-200': '#E9ECEF',
                // 'gray-300': '#DEE2E6',
                // 'gray-400': '#CED4DA',
                // 'gray-500': '#ADB5BD',
                // 'gray-600': '#6C757D',
                // 'gray-700': '#495057',
                // 'gray-800': '#343A40',
                // 'gray-900': '#212529',
            },
        },
    },

    plugins: [forms],
};