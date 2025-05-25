/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./**/*.php", "./assets/js/**/*.js"],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Oswald", "Inter", "ui-sans-serif", "system-ui"],
      },
    },
  },
  plugins: [],
};
