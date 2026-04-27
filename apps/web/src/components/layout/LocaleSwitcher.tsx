'use client';

import Link from 'next/link';
import { usePathname } from 'next/navigation';
import { altLocale, type Locale } from '@/lib/i18n/locales';

export function LocaleSwitcher({ locale }: { locale: Locale }) {
  const pathname = usePathname();
  const alt = altLocale(locale);
  // Replace the first segment of the path with the alternate locale.
  const target = pathname.replace(/^\/(ar|en)(?=\/|$)/, `/${alt}`);

  return (
    <Link
      href={target || `/${alt}`}
      className="rounded-full border border-heyazah-fog px-3 py-1 text-xs font-medium uppercase text-heyazah-primary transition-colors duration-fast hover:bg-heyazah-primary hover:text-heyazah-paper"
      aria-label={`Switch to ${alt === 'ar' ? 'Arabic' : 'English'}`}
    >
      {alt === 'ar' ? 'العربية' : 'EN'}
    </Link>
  );
}
