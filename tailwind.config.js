import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                card: {
                    DEFAULT: "#f6f8fe",
                },
                theme: {
                    secondary: "#ff4ad9",
                    red: {
                        DEFAULT: "#dc2626",
                    },
                    purple: {
                        DEFAULT: "#a48fe6",
                    },
                },
            },
        },
    },
    plugins: [],
};
