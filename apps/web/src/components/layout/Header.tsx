import Link from 'next/link';
import { Logo } from '@/components/brand/Logo';
import { LocaleSwitcher } from './LocaleSwitcher';
import { BurgerToggle } from './BurgerToggle';
import { SearchModal } from './SearchModal';
import type { Locale } from '@/lib/i18n/locales';

export function Header({ locale }: { locale: Locale }) {
  return (
    <header className="sticky top-0 z-40 w-full border-b border-heyazah-fog bg-heyazah-paper/90 backdrop-blur">
      <div className="container flex h-16 items-center justify-between gap-6">
        <Link href={`/${locale}`} className="flex items-center gap-3" aria-label="Heyazah home">
          <Logo variant="horizontal" className="h-8 w-auto" />
        </Link>
        <div className="flex items-center gap-4">
          <SearchModal locale={locale} />
          <LocaleSwitcher locale={locale} />
          <BurgerToggle locale={locale} />
        </div>
      </div>
    </header>
  );
}
