import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#2EDA88',
                primarylight: '#C9FDE4',
                secondary: '#373737',
                secondarylight: '#474747',
                gray1: '#666666',
                gray2: '#97989A',
                gray3: '#BEBFC1',
                gray4: '#D9D9D9',
                gray5: '#F2F2F2',
            }
        },
    },

    plugins: [forms, typography],
};
