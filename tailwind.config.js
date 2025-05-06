/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        colors: {
          primary: '#8A4FFF',
          secondary: '#6930c3',
          light: '#e2d9f3',
          dark: '#2c2a4a',
          accent: '#FFD166',
        },
      },
    },
    plugins: [],
  }
