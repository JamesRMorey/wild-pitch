/** @type {import('tailwindcss').Config} */
module.exports = {
    purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                green: {
                  light: '#EDF1D6',
                  DEFAULT: '#9DC08B',
                  dark: '#609966',
                },
            }
        },
      },
    variants: {
      extend: {},
    },
    plugins: [],
  }
