/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./assets/**/*.{js,css,php}",
    "./functions/**/*.{js,css,php}",
    "./page-templates/**/*.{js,css,php}",
    "./parts/**/*.{js,css,php}",
    "./*.{js,php}",
  ],
  theme: {
    container: { // Nastavení .containeru
      center: true,
      padding: { // padding containeru
        DEFAULT: '1.5rem',
        lg: '3rem',
      },
      screens: { // container se zastaví na 1280px (max-w-7xl z návrhu)
        sm: '640px',
        md: '768px',
        lg: '1024px',
        xl: '1280px',
        '2xl': '1280px',
      },
    },
    screens: { // Breakpointy
        'sm': '640px',
        'md': '768px',
        'lg': '1024px',
        'xl': '1280px',
        '2xl': '1536px',
    },
    colors: { // Design tokeny z Figma Make
      transparent: 'transparent',
      current: 'currentColor',
      background: '#ffffff',
      foreground: '#0a0a0a',
      primary: {
        DEFAULT: '#f16334',
        foreground: '#ffffff',
      },
      muted: {
        DEFAULT: '#f4f4f4',
        foreground: '#717182',
      },
      border: 'rgba(10, 10, 10, 0.08)',
      white: '#ffffff',
      black: '#0a0a0a',
    },
    borderRadius: { // Design nepoužívá zaoblení (--radius: 0px)
      none: '0px',
      DEFAULT: '0px',
      full: '9999px',
    },
    fontFamily: { // Fonty z Figma Make
      sans: ['DM Sans Variable', 'sans-serif'],
      display: ['Bricolage Grotesque Variable', 'sans-serif'],
      mono: ['JetBrains Mono Variable', 'monospace'],
    },
    fontSize: { // ['font-size','line-height']
      '2xs': ['10px', '1.4'],
      xs: ['11px', '1.4'],
      sm: ['14px', '1.6'],
      base: ['15px', '1.75'],
      md: ['16px', '1.7'],
      lg: ['18px', '1.6'],
      xl: ['20px', '1.5'],
      '2xl': ['24px', '1.3'],
      // Nadpisy — clamp odpovídá responzivní typografii z návrhu
      h1: {
        sm: ['clamp(64px, 13vw, 196px)', '0.88'],
        md: ['clamp(64px, 13vw, 196px)', '0.88'],
        lg: ['clamp(64px, 13vw, 196px)', '0.88'],
      },
      h2: {
        sm: ['36px', '1.05'],
        md: ['44px', '1.05'],
        lg: ['48px', '1.05'],
      },
      h3: {
        sm: ['22px', '1.25'],
        md: ['24px', '1.25'],
        lg: ['24px', '1.25'],
      },
      h4: {
        sm: ['18px', '1.35'],
        md: ['20px', '1.35'],
        lg: ['20px', '1.35'],
      },
      h5: {
        sm: ['16px', '1.4'],
        md: ['17px', '1.4'],
        lg: ['18px', '1.4'],
      },
      // Velký kontaktní nadpis
      contact: ['clamp(42px, 7vw, 110px)', '0.92'],
    },
    letterSpacing: {
      tighter: '-0.03em',
      tight: '-0.02em',
      normal: '0',
      wide: '0.05em',
      wider: '0.18em',
      widest: '0.22em',
    },
    extend: {
      maxWidth: {
        content: '640px',
      },
      gap: { // Defaultní mezera mezi řádky/sloupci v Gridu
        'sm': '10px',
        'md': '20px',
        'lg': '50px',
      },
    },
  },
  plugins: [
    require('tailwindcss-intersect'), // https://github.com/heidkaemper/tailwindcss-intersect
    require('tailwindcss-animated'), // https://github.com/new-data-services/tailwindcss-animated
  ],
}
