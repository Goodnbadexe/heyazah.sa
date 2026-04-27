import type { Config } from 'tailwindcss';
import tokens from '../../migration/tailwind-tokens.js';

const config: Config = {
  content: [
    './src/app/**/*.{ts,tsx,mdx}',
    './src/components/**/*.{ts,tsx,mdx}',
  ],
  theme: {
    extend: {
      ...tokens.theme.extend,
      container: {
        center: true,
        padding: {
          DEFAULT: '1rem',
          md: '2rem',
          lg: '3rem',
        },
        screens: {
          '2xl': '1440px',
        },
      },
    },
  },
  plugins: [],
};

export default config;
