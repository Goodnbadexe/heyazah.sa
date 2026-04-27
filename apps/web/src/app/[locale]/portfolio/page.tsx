import Link from 'next/link';
import { ProjectCard } from '@/components/project/ProjectCard';
import { PlaceholderCard } from '@/components/project/PlaceholderCard';
import { RevealOnScroll } from '@/components/motion/RevealOnScroll';
import { continuingProjects, deliveredProjects, visionProjects } from '@/lib/data/projects';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

export default async function PortfolioPage({
  params,
}: {
  params: Promise<{ locale: Locale }>;
}) {
  const { locale } = await params;
  const buckets = [
    {
      key: 'delivered',
      label: locale === 'ar' ? 'طبقة الإنجاز' : 'Proof of delivery',
      title: locale === 'ar' ? 'مشاريع مكتملة' : 'Delivered projects',
      body: locale === 'ar'
        ? 'المشاريع التي تبني الثقة وتثبت قدرة حيازة على تنفيذ الوجهات وتسليمها.'
        : 'Projects that build trust and prove Heyazah can execute, operate and deliver.',
      projects: deliveredProjects,
    },
    {
      key: 'momentum',
      label: locale === 'ar' ? 'طبقة الزخم' : 'Momentum layer',
      title: locale === 'ar' ? 'قيد التطوير' : 'Under development',
      body: locale === 'ar'
        ? 'المشاريع النشطة التي توضح أين تتحرك المحفظة الآن.'
        : 'Active developments showing where the portfolio is moving now.',
      projects: continuingProjects,
    },
    {
      key: 'vision',
      label: locale === 'ar' ? 'طبقة الرؤية' : 'Vision layer',
      title: locale === 'ar' ? 'الفرص القادمة' : 'Future pipeline',
      body: locale === 'ar'
        ? 'مشاريع مبكرة تُعرض كمسار اهتمام إلى حين اكتمال البيانات الرسمية.'
        : 'Early-stage concepts presented as interest paths until the official data matures.',
      projects: visionProjects,
    },
  ];

  return (
    <>
      <section className="relative overflow-hidden bg-heyazah-primary py-24 text-heyazah-paper">
        <div className="absolute inset-0 opacity-[0.13]">
          <video autoPlay muted loop playsInline className="h-full w-full object-cover">
            <source src="/assets/videos/projects-reel.mp4" type="video/mp4" />
          </video>
        </div>
        <div className="absolute inset-0 bg-gradient-to-b from-heyazah-primary/92 via-heyazah-primary/86 to-heyazah-primary" />
        <div className="container relative z-10 max-w-4xl">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-warm">
            {locale === 'ar' ? 'المحفظة' : 'Portfolio'}
          </p>
          <h1 className="mt-3 text-5xl leading-tight text-heyazah-paper md:text-7xl">
            {locale === 'ar' ? 'محفظة تتحرك بثلاث طبقات' : 'A portfolio in three moving layers'}
          </h1>
          <p className="mt-5 max-w-2xl text-lg leading-8 text-heyazah-paper/80">
            {locale === 'ar'
              ? 'حيازة لا تعرض المشاريع كصور منفصلة فقط. كل مشروع له دور: إنجاز يثبت، زخم يتحرك، أو رؤية تستعد للإطلاق.'
              : 'Heyazah should not present projects as disconnected cards. Each project has a role: proof delivered, momentum in motion, or vision preparing for launch.'}
          </p>
        </div>
      </section>

      <section className="container py-16 md:py-24">
        <div className="grid gap-4 lg:grid-cols-3">
          {buckets.map((bucket) => (
            <a
              key={bucket.key}
              href={`#${bucket.key}`}
              className="rounded-2xl border border-heyazah-fog bg-heyazah-paper p-6 shadow-card transition hover:-translate-y-1 hover:shadow-hover"
            >
              <p className="text-xs uppercase tracking-[0.28em] text-heyazah-accent">{bucket.label}</p>
              <h2 className="mt-2 text-2xl text-heyazah-primary">{bucket.title}</h2>
              <p className="mt-3 text-sm leading-7 text-heyazah-ink/70">{bucket.body}</p>
              <p className="mt-5 text-sm font-semibold text-heyazah-primary">
                {bucket.projects.length} {locale === 'ar' ? 'مشروع' : 'projects'}
              </p>
            </a>
          ))}
        </div>
      </section>

      {buckets.map((bucket, bucketIndex) => (
        <section key={bucket.key} id={bucket.key} className="container pb-20">
          <div className="mb-8 flex flex-col justify-between gap-4 border-t border-heyazah-fog pt-10 md:flex-row md:items-end">
            <div className="max-w-2xl">
              <p className="text-xs uppercase tracking-[0.28em] text-heyazah-accent">{bucket.label}</p>
              <h2 className="mt-2 text-4xl text-heyazah-primary">{bucket.title}</h2>
              <p className="mt-3 text-heyazah-ink/70">{bucket.body}</p>
            </div>
            {bucket.key === 'vision' && (
              <Link
                href={`/${locale}/pipeline`}
                className="inline-flex w-fit items-center rounded-full bg-heyazah-primary px-5 py-2 text-sm font-semibold text-heyazah-paper"
              >
                {t(locale, 'nav.pipeline')}
              </Link>
            )}
          </div>

          <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {bucket.projects.map((project, i) => (
              <RevealOnScroll key={project.id ?? project.slug} delay={(i % 6) * 0.04}>
                {project.is_placeholder ? (
                  <PlaceholderCard project={project} locale={locale} />
                ) : (
                  <ProjectCard project={project} locale={locale} />
                )}
              </RevealOnScroll>
            ))}
          </div>
          {bucketIndex < buckets.length - 1 && <div className="mt-20 h-px bg-heyazah-fog" />}
        </section>
      ))}
    </>
  );
}
