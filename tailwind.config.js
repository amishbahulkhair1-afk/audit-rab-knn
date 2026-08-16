import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import flowbite from "flowbite/plugin";

/** @type {import('tailwindcss').Config} */
export default {
    // ========================================
    // DARK MODE
    // ========================================
    darkMode: "class",

    // ========================================
    // FILES YANG DI-SCAN
    // ========================================
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    // ========================================
    // THEME
    // ========================================
    theme: {
        extend: {
            fontFamily: {
                // Ganti Figtree → Inter agar sama dengan layout WorkInfra
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },

            colors: {
                primary: {
                    50: "#eef2ff",
                    100: "#e0e7ff",
                    500: "#6366f1",
                    600: "#4f46e5",
                    700: "#4338ca",
                },
            },

            boxShadow: {
                card: "0 1px 3px 0 rgb(0 0 0 / 0.08)",
                glass: "0 20px 40px rgba(15, 23, 42, 0.12)",
            },

            borderRadius: {
                "3xl": "1.5rem",
                "4xl": "2rem",
            },
        },
    },

    // ========================================
    // PLUGINS
    // ========================================
    plugins: [forms, flowbite],
};
