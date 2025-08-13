/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js,php}",
    "./public/**/*.{html,js,php}",
    "./components/**/*.{html,js,php}",
    "./pages/**/*.{html,js,php}",
    "./config/**/*.{html,js,php}",
    "./*.php",
    "./*.html"
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#fdf2f8',   // Rosa muy claro
          100: '#fce7f3',  // Rosa claro
          200: '#fbcfe8',  // Rosa medio claro
          300: '#f9a8d4',  // Rosa medio
          400: '#f472b6',  // Rosa
          500: '#EF89AE',  // Color principal del logo
          600: '#e91e63',  // Rosa más intenso
          700: '#be185d',  // Rosa oscuro
          800: '#9d174d',  // Rosa muy oscuro
          900: '#831843',  // Rosa casi negro
        },
        accent: {
          50: '#f0f9ff',   // Azul muy claro
          100: '#e0f2fe',  // Azul claro
          200: '#bae6fd',  // Azul medio claro
          300: '#7dd3fc',  // Azul medio
          400: '#38bdf8',  // Azul
          500: '#0ea5e9',  // Azul principal
          600: '#0284c7',  // Azul oscuro
          700: '#0369a1',  // Azul muy oscuro
        },
        neutral: {
          50: '#fafafa',   // Gris muy claro
          100: '#f5f5f5',  // Gris claro
          200: '#e5e5e5',  // Gris medio claro
          300: '#d4d4d4',  // Gris medio
          400: '#a3a3a3',  // Gris
          500: '#737373',  // Gris medio oscuro
          600: '#525252',  // Gris oscuro
          700: '#404040',  // Gris muy oscuro
          800: '#262626',  // Casi negro
          900: '#171717',  // Negro
        }
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
      }
    },
  },
  plugins: [],
  // Asegurar que todas las clases se incluyan
  safelist: [
    'underline',
    'no-underline',
    'line-through',
    'text-decoration-line',
    'text-decoration-style',
    'text-decoration-color',
    'text-decoration-thickness',
    'decoration-auto',
    'decoration-from-font',
    'decoration-0',
    'decoration-1',
    'decoration-2',
    'decoration-4',
    'decoration-8',
    'underline-offset-auto',
    'underline-offset-0',
    'underline-offset-1',
    'underline-offset-2',
    'underline-offset-4',
    'underline-offset-8'
  ]
}
