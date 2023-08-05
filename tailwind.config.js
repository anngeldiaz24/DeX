/** @type {import('tailwindcss').Config} */
export default {
  content: [
    /* Con esto agregamos tailwind css a todas nuestras vistas */
    "./resources/**/*.blade.php",
    "./resources/**/*.blade.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

