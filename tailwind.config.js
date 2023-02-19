const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './node_modules/@protonemedia/inertiajs-tables-laravel-query-builder/**/*.{js,vue}',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['arial', 'sans-serif'],
                heading: ['philosopher', 'arial', 'sans-serif'],
            },
            colors: {
                mydark: "#0a0a0a",
                primary: "#6050dc",
                primaryd: "#3a28c8",
                primaryl: "#998fe9",
                accent: "#9faf23",
                secondary: "#969696",
                darklight: "#9ca3af"
            },
            dropShadow: {
                'lg-white': [
                    '0 10px 8px rgb(255 255 255 / 0.1)',
                    '0 4px 3px rgb(255 255 255 / 0.05)'
                ],
                'xl-white': [
                    '0 20px 13px rgb(255 255 255 / 0.12)',
                    '0 8px 5px rgb(255 255 255 / 0.08)'
                ],
                '2xl-white': [
                    '0 25px 25px rgb(255 255 255 / 0.20)',
                ]
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
