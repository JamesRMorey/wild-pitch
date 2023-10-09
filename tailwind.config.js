/** @type {import('tailwindcss').Config} */
module.exports = {
    purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
          colors: {
            'light-green': '#EDF1D6',
            'mid-green': '#9DC08B',
            'dark-green': '#609966',
            'dark-grey': '#40513B',
            'black': '#212121',
            'white': '#ffffff',
            'grey': '#808080e2',
          }
        },
      },
    variants: {
      extend: {},
    },
    plugins: [],
  }

