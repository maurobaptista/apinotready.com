const { fontFamily } = require('tailwindcss/defaultTheme');

module.exports = {
  purge: [
      './resources/**/*.blade.php',
  ],
  theme: {
      fontFamily: {
          'sans': fontFamily.sans,
          'title': ['Nunito'],
      }
  },
  variants: {},
  plugins: [],
}
