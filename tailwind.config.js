const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    //purge: [
    //    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    //    './storage/framework/views/*.php',
    //    './resources/views/**/*.blade.php',
    //    './resources/js/**/*.vue', // Purge VueJS
    //    './resources/js/**/*.js', // Better safe then sorry
    //],

    // Object form so we can include a "safe list (tailwind v2 only)"
    // https://tailwindcss.com/docs/detecting-classes-in-source-files#dynamic-class-names
    purge: {
        content: [
            './resources/views/**/*.blade.php',
            './resources/js/**/*.vue',
            './resources/js/**/*.js',
        ],
        options: {
            safelist: [
                { pattern: /justify-(start|center|end|between|around|evenly)/ },
            ],
        },
    },
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms')
    ],
};
