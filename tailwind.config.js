module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
        fontFamily: { sans: ['Inter var'] },
    }
  },
  variants: {},
  plugins: [
      require('tailwindcss'),
      require('@tailwindcss/ui'),
      require('@tailwindcss/custom-forms')
  ]
}
