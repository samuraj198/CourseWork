/** @type {import('tailwindcss').Config} */
export default {
  content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
    darkMode: 'class',
  theme: {
      screens: {
        'laptopL': '1441px',
        'tablet': '769px',
        'mobileL': '426px',
        'mobileM': '376px',
        'mobileS': '321px',
      },
    extend: {},
  },
  plugins: [],
}
