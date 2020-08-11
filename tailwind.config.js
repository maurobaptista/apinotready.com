
module.exports = {
  purge: [
      './resources/**/*.blade.php',
  ],
  theme: {
      extend: {
          fontFamily: {
              'title': ['Nunito', 'system-ui'],
              'mono': ['Fira Code', 'Menlo', 'monospace'],
          },
          height: {
              '96': '24rem',
          },
      },
  },
  variants: {},
  plugins: [],
}
