import Link from 'next/link';
import { stats } from '@/lib/data/projects';
import { formatNumber } from '@/lib/utils';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

export default async function InvestorsPage({
  params,
}: {
  params: Promise<{ locale: Locale }>;
}) {
  const { locale } = await params;
  const s = stats();
  const lines: Array<{ label: string; value: number }> = [
    { label: locale === 'ar' ? 'إجمالي المشاريع'      : 'Total projects',      value: s.total },
    { label: locale === 'ar' ? 'مشاريع مكتملة'        : 'Delivered',           value: s.delivered },
    { label: locale === 'ar' ? 'قيد التطوير'          : 'Under development',   value: s.underDevelopment },
    { label: locale === 'ar' ? 'قادمة'                 : 'Pipeline',            value: s.pipeline },
    { label: locale === 'ar' ? 'تجارية'                : 'Commercial',          value: s.commercial },
    { label: locale === 'ar' ? 'سكنية'                 : 'Residential',         value: s.residential },
  ];
  return (
    <>
      <section className="bg-heyazah-primary py-24 text-heyazah-paper">
        <div className="container max-w-3xl">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-warm">{t(locale, 'nav.investors')}</p>
          <h1 className="mt-2 text-heyazah-paper text-5xl md:text-7xl">
            {locale === 'ar' ? 'للمستثمرين' : 'For investors'}
          </h1>
          <p className="mt-4 text-lg opacity-85">
            {locale === 'ar'
              ? 'فُرص استثمارية منسّقة عبر محفظة حيازة الممتدة من الأبراج التجارية في الملك فهد إلى المجمعات السكنية في شمال الرياض.'
              : 'Curated opportunities across the Heyazah portfolio — from commercial towers on King Fahd Road to residential compounds in north Riyadh.'}
          </p>
        </div>
      </section>
      <section className="container py-16">
        <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
          {lines.map((l) => (
            <div key={l.label} className="rounded-2xl border border-heyazah-fog bg-heyazah-paper p-6 shadow-card">
              <p className="font-ar-display text-5xl text-heyazah-primary">{formatNumber(l.value, locale)}</p>
              <p className="mt-2 text-sm uppercase tracking-widest text-heyazah-ink/60">{l.label}</p>
            </div>
          ))}
        </div>
        <div className="mt-10">
          <Link
            href={`/${locale}/contact?type=investor`}
            className="inline-flex items-center gap-2 rounded-full bg-heyazah-primary px-6 py-3 text-sm font-semibold text-heyazah-paper shadow-card hover:bg-heyazah-accent"
          >
            {locale === 'ar' ? 'طلب اجتماع' : 'Request a briefing'}
          </Link>
        </div>
      </section>
    </>
  );
}
