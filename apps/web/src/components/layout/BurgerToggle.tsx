'use client';

import { useNav } from '@/contexts/NavContext';
import type { Locale } from '@/lib/i18n/locales';

export function BurgerToggle({ locale }: { locale: Locale }) {
  const { isOpen, toggleNav } = useNav();

  return (
    <button
      onClick={toggleNav}
      className="relative z-50 flex h-10 w-10 items-center justify-center rounded-full hover:bg-heyazah-fog transition-colors focus:outline-none"
      aria-label="Toggle Navigation"
    >
      <div className="relative flex h-5 w-5 flex-col items-center justify-center gap-1.5 overflow-hidden">
        <span
          className={`h-0.5 w-full bg-heyazah-primary transition-all duration-300 ease-dramatic
            ${isOpen ? 'translate-y-2 rotate-45' : ''}
          `}
        />
        <span
          className={`h-0.5 w-full bg-heyazah-primary transition-all duration-300 ease-dramatic
            ${isOpen ? '-translate-x-full opacity-0' : ''}
          `}
        />
        <span
          className={`h-0.5 w-full bg-heyazah-primary transition-all duration-300 ease-dramatic
            ${isOpen ? '-translate-y-2 -rotate-45' : ''}
          `}
        />
      </div>
    </button>
  );
}
