export const locales = ['ar', 'en'] as const;
export type Locale = (typeof locales)[number];
export const defaultLocale: Locale = 'ar';

export function isLocale(x: string): x is Locale {
  return (locales as readonly string[]).includes(x);
}

export function direction(locale: Locale): 'rtl' | 'ltr' {
  return locale === 'ar' ? 'rtl' : 'ltr';
}

export function altLocale(locale: Locale): Locale {
  return locale === 'ar' ? 'en' : 'ar';
}
