import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class', // Enable class-based dark mode

    theme: {
        extend: {
            colors: {
                current: 'currentColor',
                transparent: 'transparent',
                white: '#ffffff',
                black: '#101828',
                primary: '#465fff',
                secondary: '#101828',
                stroke: '#E2E8F0',
                gray: {
                    DEFAULT: '#EFF4FB',
                    2: '#F7F9FC',
                    3: '#FAFAFA',
                    dark: '#1a2231',
                },
                boxdark: '#24303F',
                'boxdark-2': '#1A222C',
                strokedark: '#2E3A47',
                'form-strokedark': '#3d4d60',
                'form-input': '#1d2a39',
                'meta-4': '#313D4A',
            },
        },
    },

    plugins: [forms],
};
