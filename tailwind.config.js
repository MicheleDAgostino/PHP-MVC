/** @type {import('tailwindcss').Config} */
module.exports = {
  daisyui: {
    themes: ["cupcake", "dark", "cmyk"],
  },
  content: ["./views/**/*.html"],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
}

