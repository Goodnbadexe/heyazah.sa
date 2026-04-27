import { notFound } from 'next/navigation';
import { ProjectHero } from '@/components/project/ProjectHero';
import { MetricsRow } from '@/components/project/MetricsRow';
import { Gallery } from '@/components/project/Gallery';
import { MapEmbed } from '@/components/project/MapEmbed';
import { VirtualTour } from '@/components/project/VirtualTour';
import { RevealOnScroll } from '@/components/motion/RevealOnScroll';
import { portfolio, bySlug, description, type Project } from '@/lib/data/projects';
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

  return (
    <>
      <ProjectHero project={project} locale={locale} />
      <section className="container -mt-16 pb-8">
        <div className="rounded-3xl bg-heyazah-paper p-6 shadow-hero md:p-10">
          <MetricsRow project={project} locale={locale} />
        </div>
      </section>
      {(hero || bizDes) && (
        <section className="container py-16">
          <RevealOnScroll>
            <div className="max-w-3xl space-y-6 text-lg leading-relaxed text-heyazah-ink/85">
              {hero && <p>{hero}</p>}
              {bizDes && <p>{bizDes}</p>}
            </div>
          </RevealOnScroll>
        </section>
      )}
      <VirtualTour project={project} locale={locale} />
      <Gallery project={project} />
      <MapEmbed project={project} />
    </>
  );
}
