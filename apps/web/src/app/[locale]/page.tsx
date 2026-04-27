import { Hero } from '@/components/home/Hero';
import { PartnersMarquee } from '@/components/home/PartnersMarquee';
import { StatsBand } from '@/components/home/StatsBand';
import { OrbitCarousel } from '@/components/home/OrbitCarousel';
import { AwardsSection } from '@/components/home/AwardsSection';
import { PortfolioStrip } from '@/components/home/PortfolioStrip';
import { SiteEntrance } from '@/components/SiteEntrance';
import type { Locale } from '@/lib/i18n/locales';

export default async function HomePage({
  params,
}: {
  params: Promise<{ locale: Locale }>;
}) {
  const { locale } = await params;
  return (
    <>
      <SiteEntrance locale={locale} />
      <Hero locale={locale} />
      <PartnersMarquee locale={locale} />
      <StatsBand locale={locale} />
      <OrbitCarousel locale={locale} />
      <AwardsSection locale={locale} />
      <PortfolioStrip locale={locale} />
    </>
  );
}
