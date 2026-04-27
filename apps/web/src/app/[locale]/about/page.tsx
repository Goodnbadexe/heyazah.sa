import Link from 'next/link';
import { t, dict } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

export default async function AboutPage({
  params,
}: {
  params: Promise<{ locale: Locale }>;
}) {
  const { locale } = await params;
  const principles = [
    {
      title: locale === 'ar' ? 'حركة دقيقة' : 'Precise motion',
      body: locale === 'ar'
        ? 'كل انتقال يخدم القراءة والثقة، وليس الاستعراض فقط.'
        : 'Every transition has to serve clarity and trust, not decoration.',
    },
    {
      title: locale === 'ar' ? 'فيديو صادق' : 'Honest video',
      body: locale === 'ar'
        ? 'الفيديو يوضح المشروع، الموقع، أو التجربة الحقيقية بدل الخلفيات العامة.'
        : 'Video should reveal the project, location, or real experience instead of acting as generic ambience.',
    },
    {
      title: locale === 'ar' ? 'محفظة مفهومة' : 'Readable portfolio',
      body: locale === 'ar'
        ? 'الإنجاز والزخم والرؤية تُعرض كطبقات واضحة داخل تجربة واحدة.'
        : 'Delivery, momentum, and vision are presented as clear layers inside one experience.',
    },
  ];

  return (
    <>
      <section className="relative overflow-hidden bg-heyazah-primary py-24 text-heyazah-paper">
        <div className="absolute inset-0 opacity-[0.16]">
          <video autoPlay muted loop playsInline className="h-full w-full object-cover">
            <source src="/assets/videos/hero-loop.mp4" type="video/mp4" />
          </video>
        </div>
        <div className="absolute inset-0 bg-gradient-to-b from-heyazah-primary/94 via-heyazah-primary/84 to-heyazah-primary" />
        <div className="container relative z-10 max-w-4xl">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-warm">{t(locale, 'nav.about')}</p>
          <h1 className="mt-3 text-5xl leading-tight text-heyazah-paper md:text-7xl">
            {locale === 'ar' ? 'من موقع جامد إلى منصة حيّة' : 'From static website to living platform'}
          </h1>
          <p className="mt-6 max-w-3xl text-lg leading-8 text-heyazah-paper/82">
            {locale === 'ar'
              ? 'حيازة شركة عقارية سعودية تأسست عام ٢٠٠٥، وهي الذراع العقارية لشركة أحمد السيف وأولاده القابضة. النسخة الجديدة من الموقع يجب أن تعرض التاريخ والمحفظة والطموح كمنصة حية وليست صفحات ثابتة.'
              : 'Heyazah is a Saudi real estate company founded in 2005, the real estate arm of Ahmed Al-Saif & Sons Holding. The new website should present the history, portfolio, and ambition as a living platform, not a static brochure.'}
          </p>
          <p className="mt-4 text-sm text-heyazah-paper/62">{dict.site.parent[locale]}</p>
        </div>
      </section>

      <section className="container grid gap-8 py-16 md:grid-cols-2">
        <article className="rounded-2xl border border-heyazah-fog bg-heyazah-paper p-8 shadow-card">
          <p className="text-xs uppercase tracking-[0.28em] text-heyazah-accent">
            {locale === 'ar' ? 'رؤيتنا' : 'Vision'}
          </p>
          <h2 className="mt-3 text-3xl text-heyazah-primary">
            {locale === 'ar' ? 'وجهات حضرية مستدامة تحمل بصمة حيازة' : 'Sustainable urban destinations with a Heyazah signature'}
          </h2>
          <p className="mt-4 leading-8 text-heyazah-ink/75">
            {locale === 'ar'
              ? 'أن نكون المطوّر العقاري المرجعي في المملكة عبر مشاريع تعكس هوية المكان وتُبنى بمنظور طويل الأمد.'
              : 'To be a reference developer in the Kingdom through places that reflect context and are built for long-term value.'}
          </p>
        </article>
        <article className="rounded-2xl border border-heyazah-fog bg-heyazah-paper p-8 shadow-card">
          <p className="text-xs uppercase tracking-[0.28em] text-heyazah-accent">
            {locale === 'ar' ? 'رسالتنا' : 'Mission'}
          </p>
          <h2 className="mt-3 text-3xl text-heyazah-primary">
            {locale === 'ar' ? 'تصميم وبناء وتشغيل مجتمعات مدروسة' : 'Design, build, and operate considered communities'}
          </h2>
          <p className="mt-4 leading-8 text-heyazah-ink/75">
            {locale === 'ar'
              ? 'نُحوّل المواقع إلى تجارب واضحة للسكان والمستثمرين والضيوف، من الفكرة إلى التشغيل.'
              : 'We turn sites into clear experiences for residents, investors, and guests, from concept to operation.'}
          </p>
        </article>
      </section>

      <section className="bg-heyazah-fog py-16">
        <div className="container">
          <div className="mb-8 max-w-3xl">
            <p className="text-xs uppercase tracking-[0.3em] text-heyazah-accent">
              {locale === 'ar' ? 'مبادئ النسخة الجديدة' : 'New platform principles'}
            </p>
            <h2 className="mt-3 text-4xl text-heyazah-primary">
              {locale === 'ar' ? 'حيّة، لكن مضبوطة' : 'Alive, but controlled'}
            </h2>
          </div>
          <div className="grid gap-5 md:grid-cols-3">
            {principles.map((item) => (
              <article key={item.title} className="rounded-2xl bg-heyazah-paper p-6 shadow-card">
                <h3 className="text-2xl text-heyazah-primary">{item.title}</h3>
                <p className="mt-3 text-sm leading-7 text-heyazah-ink/70">{item.body}</p>
              </article>
            ))}
          </div>
          <Link
            href={`/${locale}/portfolio`}
            className="mt-10 inline-flex rounded-full bg-heyazah-primary px-6 py-3 text-sm font-semibold text-heyazah-paper"
          >
            {locale === 'ar' ? 'استعراض المحفظة' : 'Explore the portfolio'}
          </Link>
        </div>
      </section>
    </>
  );
}
