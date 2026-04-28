import { PlaceholderCard } from '@/components/project/PlaceholderCard';
import { FillInChecklist } from '@/components/pipeline/FillInChecklist';
import { RevealOnScroll } from '@/components/motion/RevealOnScroll';
import { pipeline } from '@/lib/data/projects';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

export default async function PipelinePage({
  params,
  searchParams,
}: {
  params: Promise<{ locale: Locale }>;
  searchParams: Promise<{ admin?: string }>;
}) {
  const { locale } = await params;
  const { admin } = await searchParams;
  const isAdmin = admin === '1';

  return (
    <>
      <section className="relative overflow-hidden bg-heyazah-warm/30 py-24">
        <div className="container relative z-10">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-accent">
            {locale === 'ar' ? 'طبقة الرؤية' : 'Vision layer'}
          </p>
          <h1 className="mt-2 text-5xl leading-tight text-heyazah-primary md:text-7xl">
            {locale === 'ar' ? 'مشاريع قابلة للنمو' : 'Projects ready to grow'}
          </h1>
          <p className="mt-4 max-w-2xl text-lg leading-8 text-heyazah-ink/72">
            {locale === 'ar'
              ? 'هذه ليست صفحة فارغة للمستقبل. إنها مساحة اهتمام مبكر للمشاريع التي ستكتمل بياناتها وصورها ومحتواها تدريجياً.'
              : 'This is not an empty future page. It is an early-interest layer for projects whose data, visuals, and content can mature over time.'}
          </p>
          {isAdmin && (
            <p className="mt-3 text-xs text-heyazah-primary">
              Admin mode — checklists visible. {pipeline.length} placeholders.
            </p>
          )}
        </div>
      </section>
      <section className="container py-16">
        <div className="mb-10 overflow-hidden rounded-2xl border border-heyazah-fog bg-heyazah-primary shadow-card">
          <video autoPlay muted loop playsInline className="aspect-[16/5] h-full w-full object-cover">
            <source src="/assets/videos/projects-reel.mp4" type="video/mp4" />
          </video>
        </div>
        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {pipeline.map((p, i) => (
            <RevealOnScroll key={p.id} delay={(i % 6) * 0.05}>
              <div className="space-y-3">
                <PlaceholderCard project={p} locale={locale} />
                {isAdmin && <FillInChecklist project={p} />}
              </div>
            </RevealOnScroll>
          ))}
        </div>
      </section>
    </>
  );
}
