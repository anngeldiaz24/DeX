/** @type {import('tailwindcss').Config} */
export default {
  content: [
    /* Con esto agregamos tailwind css a todas nuestras vistas */
    "./resources/**/*.blade.php",
    "./resources/**/*.blade.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

