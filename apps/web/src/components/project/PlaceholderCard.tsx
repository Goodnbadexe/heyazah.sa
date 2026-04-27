import Link from 'next/link';
import { Icon } from '@/components/brand/Icon';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';
import { displayName, displayLocation, type Project } from '@/lib/data/projects';

export function PlaceholderCard({ project, locale }: { project: Project; locale: Locale }) {
  const name = displayName(project, locale);
  const loc = displayLocation(project, locale);
  const checklist = project.fill_in_checklist;
  const missingCount = Array.isArray(checklist)
    ? checklist.filter((item) => !item?.done).length
    : checklist?.missing_items?.length ?? 0;

  return (
    <div className="group relative min-h-[260px] overflow-hidden rounded-2xl border border-dashed border-heyazah-warm bg-heyazah-paper p-6 shadow-card">
      <div className="relative z-10 flex h-full flex-col gap-4">
        <div className="flex items-center justify-between">
          <span className="inline-flex items-center gap-1 rounded-full bg-heyazah-warm px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-heyazah-primary">
            <Icon id="ui.star" className="h-3 w-3" />
            {t(locale, 'status.pipeline')}
          </span>
          {missingCount > 0 && (
            <span
              className="rounded-full bg-heyazah-fog px-2 py-0.5 text-[10px] text-heyazah-ink/60"
              title={locale === 'ar' ? 'عناصر بحاجة إلى تعبئة' : 'Items needing fill-in'}
            >
              {missingCount}
            </span>
          )}
        </div>
        <h3 className="text-2xl leading-tight text-heyazah-primary">{name}</h3>
        <p className="text-sm text-heyazah-ink/70">
          {loc || (locale === 'ar' ? 'موقع سيُعلن لاحقاً' : 'Location TBA')}
        </p>
        <p className="text-xs leading-6 text-heyazah-ink/58">
          {locale === 'ar'
            ? 'بطاقة ألفا قابلة للتعبئة لاحقاً بالصور، المساحات، وروابط الاهتمام الرسمية.'
            : 'Alpha-ready card to be completed later with visuals, metrics, and official interest links.'}
        </p>
        <Link
          href={`/${locale}/contact?project=${project.slug}`}
          className="mt-auto inline-flex w-fit items-center gap-2 rounded-full bg-heyazah-primary px-4 py-2 text-sm font-semibold text-heyazah-paper transition-colors group-hover:bg-heyazah-accent"
        >
          {t(locale, 'cta.register')}
          <Icon id="ui.button-arrow" className="h-3 w-3 ltr:rotate-0 rtl:rotate-180" />
        </Link>
      </div>
    </div>
  );
}
