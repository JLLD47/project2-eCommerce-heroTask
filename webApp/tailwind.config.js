/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["*/assets/**/*.js",
    "./templates/**/*.html.twig",],
  theme: {
    extend: {
      colors: {
        orangePeel: '#FFA630',
        teaGreen:  '#86522D',
        moonstone: '#4DA1A9',
        yInMnBlue: '#2E5077',
        tyrianPurple: '#611C35',
      },
    },
  },
  plugins: [],
}

