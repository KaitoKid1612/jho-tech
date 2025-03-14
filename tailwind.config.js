/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.vue",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    "50": "#eff6ff", "100": "#dbeafe", "200": "#bfdbfe", "300": "#93c5fd", "400": "#60a5fa", "500": "#3b82f6", "600": "#2563eb", "700": "#1d4ed8", "800": "#1e40af", "900": "#1e3a8a", "950": "#172554"
                }
            },
            spacing: {
                '4.5': '1.125rem',
            },
            fontFamily: {
                body: ["Noto Sans", "sans-serif"],
                sans: ["Noto Sans", "sans-serif"]
            },
        }
    },
    plugins: [],
};
