'use client';

import Link from 'next/link';
import { useNav } from '@/contexts/NavContext';
import type { Locale } from '@/lib/i18n/locales';
import { t } from '@/lib/i18n/dictionary';

const NAV = [
  { key: 'home', href: '' },
  { key: 'portfolio', href: '/portfolio' },
  { key: 'pipeline', href: '/pipeline' },
  { key: 'about', href: '/about' },
  { key: 'leadership', href: '/leadership' },
  { key: 'investors', href: '/investors' },
  { key: 'media', href: '/media' },
  { key: 'contact', href: '/contact' },
];

export function NavigationSidebar({ locale }: { locale: Locale }) {
  const { isOpen, setIsOpen } = useNav();

  return (
    <div
      className={`fixed top-0 bottom-0 z-0 flex w-[360px] md:w-[400px] flex-col bg-heyazah-fog shadow-inner transition-transform duration-700 ease-dramatic
        ${locale === 'ar' ? 'right-0' : 'left-0'}
      `}
    >
      {/* We keep this static underneath. The AppShell will slide away to reveal it! */}
      <div className="flex h-full flex-col p-10 md:p-14">
        
        <div className="mt-8 mb-12">
           {/* Replace this with Logo component if needed, or textual ident */}
           {/* For now, just a premium label */}
           <span className="text-xs font-semibold tracking-[0.2em] uppercase text-heyazah-accent">
             {locale === 'ar' ? 'القائمة' : 'Navigation'}
           </span>
        </div>

        <div className="flex-1 overflow-y-auto">
          <nav className="flex flex-col gap-6">
            {NAV.map((item, idx) => (
              <Link
                key={item.key}
                href={`/${locale}${item.href}`}
                onClick={() => setIsOpen(false)}
                style={{ transitionDelay: `${isOpen ? idx * 50 : 0}ms` }}
                className={`text-2xl font-medium tracking-wide text-heyazah-primary transition-all duration-500 hover:text-heyazah-accent ${
                  locale === 'ar' ? 'hover:-translate-x-2' : 'hover:translate-x-2'
                } ${
                  isOpen ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'
                }`}
              >
                {t(locale, `nav.${item.key}`)}
              </Link>
            ))}
          </nav>
        </div>

        <div className="mt-8 flex flex-col gap-4 text-sm text-heyazah-ink/70">
          <p>© {new Date().getFullYear()} Heyazah.</p>
          <div className="flex gap-4">
            <a href="#" className="hover:text-heyazah-primary transition-colors">LinkedIn</a>
            <a href="#" className="hover:text-heyazah-primary transition-colors">X</a>
          </div>
        </div>
      </div>
    </div>
  );
}
