import { ProjectCard } from '@/components/project/ProjectCard';
import { RevealOnScroll } from '@/components/motion/RevealOnScroll';
import { portfolio } from '@/lib/data/projects';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

export default async function PortfolioPage({
  params,
}: {
  params: Promise<{ locale: Locale }>;
}) {
  const { locale } = await params;
  return (
    <>
      <section className="bg-heyazah-primary py-24 text-heyazah-paper">
        <div className="container">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-warm">
            {locale === 'ar' ? 'المحفظة' : 'Portfolio'}
          </p>
          <h1 className="mt-2 text-heyazah-paper text-5xl md:text-7xl">{t(locale, 'nav.portfolio')}</h1>
          <p className="mt-4 max-w-2xl text-lg opacity-85">
            {locale === 'ar'
              ? 'مشاريعنا المكتملة وقيد التطوير في مختلف أحياء الرياض — سكنية وتجارية وفندقية.'
              : 'Delivered and under-development projects across Riyadh — residential, commercial and hospitality.'}
          </p>
        </div>
      </section>
      <section className="container py-16">
        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
          {portfolio.map((p, i) => (
            <RevealOnScroll key={p.id} delay={(i % 8) * 0.04}>
              <ProjectCard project={p} locale={locale} />
            </RevealOnScroll>
          ))}
        </div>
      </section>
    </>
  );
}
