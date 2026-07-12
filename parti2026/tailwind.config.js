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
                display: ['Cinzel', 'serif'],
                'display-decorative': ['"Cinzel Decorative"', 'serif'],
                body: ['"Work Sans"', 'sans-serif'],
                mono: ['"Space Mono"', 'monospace'],
            },
            colors: {
                paper:       '#FFFFFF',
                'paper-warm':'#FDF9F1',
                ink:         '#1C140B',
                'ink-soft':  '#5E4F3E',
                ember:       '#E2650B',
                'ember-dark':'#B84D06',
                gold:        '#B0801E',
                'gold-soft': '#E9CE93',
                line:        '#EDE3D0',
            },
        },
    },

    plugins: [forms],
};
