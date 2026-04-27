import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

const TEAM = [
  {
    slug: 'ceo',
    name: { ar: 'الرئيس التنفيذي', en: 'Chief Executive Officer' },
    role: { ar: 'القيادة التنفيذية',  en: 'Executive leadership' },
    bio: {
      ar: 'نبذة تُستكمل لاحقاً — راجع قائمة التعبئة في ملف fill_in_checklist.',
      en: 'Bio to be finalized — see fill-in checklist.',
    },
  },
];

export default async function LeadershipPage({
  params,
}: {
  params: Promise<{ locale: Locale }>;
}) {
  const { locale } = await params;
  return (
    <>
      <section className="bg-heyazah-fog py-24">
        <div className="container max-w-3xl">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-accent">{t(locale, 'nav.leadership')}</p>
          <h1 className="mt-2 text-5xl md:text-7xl">{t(locale, 'nav.leadership')}</h1>
          <p className="mt-4 text-lg text-heyazah-ink/75">
            {locale === 'ar'
              ? 'الفريق الذي يقود حيازة نحو الجيل القادم من المشاريع.'
              : 'The team leading Heyazah into its next generation of projects.'}
          </p>
        </div>
      </section>
      <section className="container grid gap-8 py-16 sm:grid-cols-2 lg:grid-cols-3">
        {TEAM.map((m) => (
          <article
            key={m.slug}
            className="rounded-2xl border border-heyazah-fog bg-heyazah-paper p-6 shadow-card"
          >
            <div className="aspect-[4/5] rounded-xl bg-heyazah-fog" />
            <h3 className="mt-5 text-2xl text-heyazah-primary">{m.name[locale]}</h3>
            <p className="text-sm uppercase tracking-widest text-heyazah-ink/60">{m.role[locale]}</p>
            <p className="mt-3 text-sm text-heyazah-ink/80">{m.bio[locale]}</p>
          </article>
        ))}
      </section>
    </>
  );
}
