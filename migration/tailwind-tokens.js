// Heyazah brand tokens for Tailwind
// Source of truth: migration/brand_tokens.json (PDF Brand Guidelines 2026 p.16 palette, p.22–23 typography)
// Consumed by apps/web/tailwind.config.ts -> theme.extend
module.exports = {
  theme: {
    extend: {
      colors: {
        heyazah: {
          // Core palette
          primary: '#082b2a',  // Heyazah Deep
          accent:  '#025157',  // Heyazah Teal
          warm:    '#99856a',  // Heyazah Gold
          cream:   '#d1ccbd',  // Heyazah Cream
          silver:  '#b0b5aa',  // Heyazah Silver
          mist:    '#cad1c7',  // Heyazah Mist
          ink:     '#000000',
          paper:   '#ffffff',
          // Legacy aliases kept so existing bg-heyazah-fog / bg-heyazah-warm refs don't break
          fog:     '#d1ccbd',  // → cream
        },
        status: {
          old:        '#082b2a',
          continuing: '#025157',
          new:        '#99856a',
          'sold-out': '#b0b5aa',
        }
      },
      fontFamily: {
        primary:      ['var(--h-font-primary)'],
        'ar-display': ['var(--h-font-ar-display)'],
        'ar-body':    ['var(--h-font-ar-body)'],
        'ar-bold':    ['var(--h-font-ar-bold)'],
        latin:        ['var(--h-font-latin)'],
      },
      boxShadow: {
        card:  '0 1px 2px rgba(8,43,42,0.06), 0 8px 24px rgba(8,43,42,0.06)',
        hover: '0 2px 4px rgba(8,43,42,0.08), 0 16px 40px rgba(8,43,42,0.14)',
        hero:  '0 40px 120px rgba(8,43,42,0.32)',
        gold:  '0 1px 2px rgba(153,133,106,0.18), 0 8px 24px rgba(153,133,106,0.18)',
      },
      transitionTimingFunction: {
        smooth:    'cubic-bezier(0.25, 0.1, 0.25, 1)',
        precision: 'cubic-bezier(0.4, 0, 0.2, 1)',
        dramatic:  'cubic-bezier(0.16, 1, 0.3, 1)',
      },
      transitionDuration: {
        fast:      '200ms',
        DEFAULT:   '400ms',
        slow:      '800ms',
        cinematic: '1400ms',
      },
    },
  },
};
