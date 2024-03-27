/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    theme: {
        extend: {
            // Additional colors
            colors: {
                "brand-color": "#3F51B5",
                "dark-gray": "#222222",
                "light-gray": "#717171",
                "pastel-gray": "#F0EFE9",
                "hover-light": "#0000000a",
            },

            backgroundImage: {
                "auth-background": "url('/resources/images/auth-bg.png')",
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
