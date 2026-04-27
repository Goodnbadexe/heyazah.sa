import Link from 'next/link';
import { Logo } from '@/components/brand/Logo';
import { t, dict } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

const SOCIAL = [
  { name: 'LinkedIn', icon: '/assets/uploads/social/linkedin.svg', href: '#' },
  { name: 'X', icon: '/assets/uploads/social/x.svg', href: '#' },
  { name: 'Instagram', icon: '/assets/uploads/social/instagram.svg', href: '#' },
  { name: 'YouTube', icon: '/assets/uploads/social/youtube.svg', href: '#' },
  { name: 'Facebook', icon: '/assets/uploads/social/facebook.svg', href: '#' },
];

export function Footer({ locale }: { locale: Locale }) {
  return (
    <footer className="mt-0 border-t border-heyazah-fog bg-heyazah-primary text-heyazah-paper">
      <div className="container grid gap-10 py-16 md:py-20 md:grid-cols-4">
        {/* Brand column */}
        <div className="space-y-5">
          <Logo variant="footer" className="h-10 w-auto text-heyazah-paper" />
          <p className="text-sm opacity-70 leading-relaxed">{t(locale, 'site.tagline')}</p>
          <p className="text-xs opacity-40">{t(locale, 'site.parent')}</p>
          {/* Social icons */}
          <div className="flex items-center gap-3 pt-2">
            {SOCIAL.map((s) => (
              <a
                key={s.name}
                href={s.href}
                aria-label={s.name}
                className="flex h-9 w-9 items-center justify-center rounded-full bg-heyazah-paper/5 border border-heyazah-paper/10 transition-all duration-500 hover:bg-heyazah-accent/20 hover:border-heyazah-accent/30 hover:scale-110"
              >
                {/* eslint-disable-next-line @next/next/no-img-element */}
                <img src={s.icon} alt={s.name} className="h-4 w-4 opacity-60 invert transition-opacity hover:opacity-100" />
              </a>
            ))}
          </div>
        </div>

        {/* Projects nav */}
        <nav className="space-y-3 text-sm">
          <h4 className="text-heyazah-warm text-xs uppercase tracking-[0.2em] font-semibold">{locale === 'ar' ? 'المشاريع' : 'Projects'}</h4>
          <Link href={`/${locale}/portfolio`} className="block opacity-60 hover:opacity-100 transition-opacity duration-300">
            {t(locale, 'nav.portfolio')}
          </Link>
          <Link href={`/${locale}/pipeline`} className="block opacity-60 hover:opacity-100 transition-opacity duration-300">
            {t(locale, 'nav.pipeline')}
          </Link>
          <Link href={`/${locale}/media`} className="block opacity-60 hover:opacity-100 transition-opacity duration-300">
            {t(locale, 'nav.media')}
          </Link>
        </nav>

        {/* Company nav */}
        <nav className="space-y-3 text-sm">
          <h4 className="text-heyazah-warm text-xs uppercase tracking-[0.2em] font-semibold">{locale === 'ar' ? 'الشركة' : 'Company'}</h4>
          <Link href={`/${locale}/about`} className="block opacity-60 hover:opacity-100 transition-opacity duration-300">
            {t(locale, 'nav.about')}
          </Link>
          <Link href={`/${locale}/leadership`} className="block opacity-60 hover:opacity-100 transition-opacity duration-300">
            {t(locale, 'nav.leadership')}
          </Link>
          <Link href={`/${locale}/investors`} className="block opacity-60 hover:opacity-100 transition-opacity duration-300">
            {t(locale, 'nav.investors')}
          </Link>
        </nav>

        {/* Contact column */}
        <div className="space-y-3 text-sm">
          <h4 className="text-heyazah-warm text-xs uppercase tracking-[0.2em] font-semibold">{locale === 'ar' ? 'تواصل' : 'Contact'}</h4>
          <p className="opacity-60">{locale === 'ar' ? 'الرياض، المملكة العربية السعودية' : 'Riyadh, Saudi Arabia'}</p>
          <p className="opacity-60">www.heyazah.sa</p>
          <Link
            href={`/${locale}/contact`}
            className="inline-flex items-center gap-2 mt-2 text-heyazah-accent text-xs uppercase tracking-wider hover:text-heyazah-warm transition-colors duration-300"
          >
            {locale === 'ar' ? 'تواصل معنا' : 'Get in touch'}
            <span>{locale === 'ar' ? '←' : '→'}</span>
          </Link>
        </div>
      </div>

      {/* Bottom bar */}
      <div className="border-t border-heyazah-paper/8">
        <div className="container flex flex-col items-start justify-between gap-2 py-5 text-xs opacity-40 md:flex-row">
          <span>© {new Date().getFullYear()} {t(locale, 'site.name')}. {locale === 'ar' ? 'جميع الحقوق محفوظة' : 'All rights reserved'}.</span>
          <span>{dict.site.parent[locale]}</span>
        </div>
      </div>
    </footer>
  );
}
