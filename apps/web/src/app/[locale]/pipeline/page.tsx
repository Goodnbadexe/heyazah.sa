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
      <section className="bg-heyazah-warm/30 py-24">
        <div className="container">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-accent">
            {t(locale, 'status.pipeline')}
          </p>
          <h1 className="mt-2 text-5xl md:text-7xl">{t(locale, 'nav.pipeline')}</h1>
          <p className="mt-4 max-w-2xl text-lg text-heyazah-ink/70">
            {locale === 'ar'
              ? 'نظرة مبكرة على المشاريع القادمة قبل الإطلاق الرسمي. سجّل اهتمامك لتكون أول من يعرف.'
              : 'An early look at projects ahead of their public launch. Register to be first to know.'}
          </p>
          {isAdmin && (
            <p className="mt-3 text-xs text-heyazah-primary">
              Admin mode — checklists visible. {pipeline.length} placeholders.
            </p>
          )}
        </div>
      </section>
      <section className="container py-16">
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
