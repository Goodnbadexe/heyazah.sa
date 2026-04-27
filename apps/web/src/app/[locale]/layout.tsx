import { notFound } from 'next/navigation';
import { Header } from '@/components/layout/Header';
import { Footer } from '@/components/layout/Footer';
import { direction, isLocale, locales, type Locale } from '@/lib/i18n/locales';

export function generateStaticParams() {
  return locales.map((locale) => ({ locale }));
}

import { NavProvider } from '@/contexts/NavContext';
import { AppShell } from '@/components/layout/AppShell';
import { NavigationSidebar } from '@/components/layout/NavigationSidebar';

export default async function LocaleLayout({
  children,
  params,
}: {
  children: React.ReactNode;
  params: Promise<{ locale: string }>;
}) {
  const { locale } = await params;
  if (!isLocale(locale)) notFound();
  const dir = direction(locale as Locale);

  return (
    <html lang={locale} dir={dir}>
      <body className="min-h-screen bg-heyazah-paper text-heyazah-ink antialiased overflow-x-hidden">
        <NavProvider>
          <NavigationSidebar locale={locale as Locale} />
          <AppShell locale={locale as Locale}>
            <Header locale={locale as Locale} />
            <main id="main">{children}</main>
            <Footer locale={locale as Locale} />
          </AppShell>
        </NavProvider>
      </body>
    </html>
  );
}
