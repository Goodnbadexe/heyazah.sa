import { notFound } from 'next/navigation';
import { ProjectHero } from '@/components/project/ProjectHero';
import { MetricsRow } from '@/components/project/MetricsRow';
import { Gallery } from '@/components/project/Gallery';
import { MapEmbed } from '@/components/project/MapEmbed';
import { VirtualTour } from '@/components/project/VirtualTour';
import { ProjectCloudEmbed } from '@/components/project/ProjectCloudEmbed';
import { RevealOnScroll } from '@/components/motion/RevealOnScroll';
import { portfolio, bySlug, description, projectHasMetrics, statusNarrative, type Project } from '@/lib/data/projects';
import type { Locale } from '@/lib/i18n/locales';

export function generateStaticParams() {
  return portfolio.map((p) => ({ slug: p.slug }));
}

export default async function ProjectPage({
  params,
}: {
  params: Promise<{ locale: Locale; slug: string }>;
}) {
  const { locale, slug } = await params;
  const project: Project | undefined = bySlug(slug);
  if (!project) notFound();
  const hero = description(project, locale, 'hero');
  const bizDes = description(project, locale, 'business_destination_des');
  const hasMetrics = projectHasMetrics(project);

  return (
    <>
      <ProjectHero project={project} locale={locale} />
      {hasMetrics && (
        <section className="container -mt-16 pb-8">
          <div className="rounded-3xl bg-heyazah-paper p-6 shadow-hero md:p-10">
            <MetricsRow project={project} locale={locale} />
          </div>
        </section>
      )}
      <section className="container py-16">
        <RevealOnScroll>
          <div className="grid gap-10 lg:grid-cols-[minmax(0,1fr)_360px]">
            <div className="max-w-3xl space-y-6 text-lg leading-relaxed text-heyazah-ink/85">
              {hero && <p>{hero}</p>}
              {bizDes && <p>{bizDes}</p>}
              {!hero && !bizDes && (
                <p>
                  {locale === 'ar'
                    ? 'تُستكمل تفاصيل المشروع الرسمية في المرحلة التالية، ويُعرض هنا ضمن محفظة حيازة لإيضاح مكانه في القصة العامة للمشاريع.'
                    : 'Official project details will be completed in the next content pass; this alpha page places the project inside Heyazah’s wider portfolio story.'}
                </p>
              )}
            </div>
            <aside className="rounded-2xl border border-heyazah-fog bg-heyazah-paper p-6 shadow-card">
              <p className="text-xs uppercase tracking-[0.3em] text-heyazah-accent">
                {locale === 'ar' ? 'دور المشروع' : 'Portfolio role'}
              </p>
              <p className="mt-3 text-sm leading-7 text-heyazah-ink/75">
                {statusNarrative(project, locale)}
              </p>
            </aside>
          </div>
        </RevealOnScroll>
      </section>
      <VirtualTour project={project} locale={locale} />
      <ProjectCloudEmbed project={project} locale={locale} />
      <Gallery project={project} locale={locale} />
      <MapEmbed project={project} />
    </>
  );
}
