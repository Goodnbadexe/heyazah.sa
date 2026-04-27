import { t, dict } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

export default async function AboutPage({
  params,
}: {
  params: Promise<{ locale: Locale }>;
}) {
  const { locale } = await params;
  return (
    <>
      <section className="bg-heyazah-primary py-24 text-heyazah-paper">
        <div className="container max-w-3xl">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-warm">{t(locale, 'nav.about')}</p>
          <h1 className="mt-2 text-heyazah-paper text-5xl md:text-7xl">{t(locale, 'site.name')}</h1>
          <p className="mt-6 text-lg opacity-85">
            {locale === 'ar'
              ? 'حيازة شركة عقارية سعودية تأسست عام ٢٠٠٥، وهي الذراع العقارية لشركة أحمد السيف وأولاده القابضة. نطوّر ونستثمر ونُشغّل مشاريع سكنية وتجارية وفندقية في الرياض بمعايير جودة عالية ورؤية طويلة الأمد.'
              : 'Heyazah is a Saudi real estate company founded in 2005, the real estate arm of Ahmed Al-Saif & Sons Holding. We develop, invest in, and operate residential, commercial and hospitality projects across Riyadh — built to last and planned with the long view.'}
          </p>
          <p className="mt-4 text-sm opacity-70">{dict.site.parent[locale]}</p>
        </div>
      </section>
      <section className="container grid gap-10 py-16 md:grid-cols-2">
        <article className="rounded-2xl border border-heyazah-fog bg-heyazah-paper p-8 shadow-card">
          <h2 className="text-3xl">{locale === 'ar' ? 'رؤيتنا' : 'Vision'}</h2>
          <p className="mt-4 text-heyazah-ink/80">
            {locale === 'ar'
              ? 'أن نكون المطوّر العقاري المرجعي في المملكة — نُنشئ وجهات حضرية مستدامة تعكس هوية المكان وتحمل بصمة حيازة.'
              : 'To be the reference developer in the Kingdom — creating sustainable urban destinations that reflect place, signed in Heyazah’s craft.'}
          </p>
        </article>
        <article className="rounded-2xl border border-heyazah-fog bg-heyazah-paper p-8 shadow-card">
          <h2 className="text-3xl">{locale === 'ar' ? 'رسالتنا' : 'Mission'}</h2>
          <p className="mt-4 text-heyazah-ink/80">
            {locale === 'ar'
              ? 'نُصمّم، نُنشئ، ونُشغّل مجتمعات عمرانية مدروسة تُقدّم تجربة استثنائية للسكان والمستثمرين والضيوف.'
              : 'We design, build and operate considered communities that deliver an exceptional experience for residents, investors and guests.'}
          </p>
        </article>
      </section>
    </>
  );
}
