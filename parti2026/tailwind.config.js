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
                'ink-soft':  '#423525', // ponytail: darkened for better WCAG readability contrast
                ember:       '#E2650B',
                'ember-dark':'#A03F02', // ponytail: darkened for better contrast
                gold:        '#94660F', // ponytail: darkened for WCAG AA readability compliance
                'gold-soft': '#E9CE93',
                line:        '#E4D8C1', // ponytail: darkened for crisper borders
            },
        },
    },

    plugins: [forms],
};
