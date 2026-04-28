import { projectProgress, type Project } from '@/lib/data/projects';
import type { Locale } from '@/lib/i18n/locales';

export function ProjectProgress({ project, locale }: { project: Project; locale: Locale }) {
  const progress = projectProgress(project);
  const isContinuing = project.status === 'continuing';

  if (!isContinuing && progress.overall === null) return null;

  const overall = progress.overall;

  return (
    <section className="bg-heyazah-fog py-16">
      <div className="container grid gap-8 lg:grid-cols-[360px_minmax(0,1fr)]">
        <div>
          <p className="text-xs uppercase tracking-[0.3em] text-heyazah-accent">
            {locale === 'ar' ? 'حالة المشروع' : 'Project status'}
          </p>
          <h2 className="mt-3 text-4xl text-heyazah-primary">
            {locale === 'ar' ? 'تحديث التنفيذ' : 'Execution update'}
          </h2>
          <p className="mt-4 text-sm leading-7 text-heyazah-ink/70">
            {locale === 'ar'
              ? 'تُعرض نسب التقدم عندما تكون منشورة، وتبقى المشاريع الأخرى ضمن حالة تنفيذ واضحة إلى حين اكتمال التحديثات التفصيلية.'
              : 'Published progress percentages are shown where available; other active projects keep a clear execution state until detailed updates are complete.'}
          </p>
        </div>

        <div className="rounded-2xl border border-heyazah-fog bg-heyazah-paper p-6 shadow-card">
          <div className="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
            <div>
              <p className="text-sm font-semibold text-heyazah-primary">
                {locale === 'ar' ? 'التقدم العام' : 'Overall progress'}
              </p>
              <p className="mt-1 text-sm text-heyazah-ink/60">
                {overall === null
                  ? locale === 'ar' ? 'قيد التحديث' : 'Update pending'
                  : locale === 'ar' ? 'منشور ضمن تحديثات المشروع' : 'Published project update'}
              </p>
            </div>
            <strong className="font-ar-display text-5xl text-heyazah-primary">
              {overall === null ? 'TBA' : `${overall}%`}
            </strong>
          </div>

          <div className="mt-6 h-3 overflow-hidden rounded-full bg-heyazah-fog">
            <div
              className="h-full rounded-full bg-heyazah-accent"
              style={{ width: `${overall ?? 18}%` }}
            />
          </div>

          {progress.items.length > 0 && (
            <div className="mt-6 grid gap-3 md:grid-cols-3">
              {progress.items.map((item) => (
                <div key={item.label.en} className="rounded-xl bg-heyazah-fog p-4">
                  <p className="text-xs uppercase tracking-[0.2em] text-heyazah-ink/50">
                    {item.label[locale]}
                  </p>
                  <p className="mt-2 text-2xl font-semibold text-heyazah-primary">
                    {item.value === null ? 'TBA' : `${item.value}%`}
                  </p>
                </div>
              ))}
            </div>
          )}
        </div>
      </div>
    </section>
  );
}
