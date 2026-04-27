import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

const OPERATING_MODEL = [
  {
    title: { ar: 'القيادة التنفيذية', en: 'Executive leadership' },
    body: { ar: 'توجيه المحفظة، أولويات النمو، ومراحل الإطلاق.', en: 'Portfolio direction, growth priorities, and launch sequencing.' },
  },
  {
    title: { ar: 'التطوير والمشاريع', en: 'Development and projects' },
    body: { ar: 'تحويل الفرص إلى مشاريع قابلة للتنفيذ والقياس.', en: 'Turning opportunities into executable and measurable developments.' },
  },
  {
    title: { ar: 'التجربة والاستثمار', en: 'Experience and investment' },
    body: { ar: 'ربط المشروع بالمستثمر، الزائر، والعميل النهائي.', en: 'Connecting each project to investors, visitors, and end users.' },
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
        <div className="container max-w-4xl">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-accent">{t(locale, 'nav.leadership')}</p>
          <h1 className="mt-3 text-5xl leading-tight text-heyazah-primary md:text-7xl">
            {locale === 'ar' ? 'قيادة المحفظة، لا مجرد صفحة أسماء' : 'Portfolio leadership, not just a name page'}
          </h1>
          <p className="mt-5 max-w-2xl text-lg leading-8 text-heyazah-ink/75">
            {locale === 'ar'
              ? 'إلى حين اكتمال الصور والسير الرسمية، تعرض هذه الصفحة نموذج التشغيل الذي تحتاجه النسخة الجديدة: قرارات واضحة، تنفيذ، وتجربة استثمارية مفهومة.'
              : 'Until official portraits and bios are finalized, this page presents the operating model the new website needs: clear decisions, execution, and a readable investor experience.'}
          </p>
        </div>
      </section>
      <section className="container py-16">
        <div className="grid gap-6 lg:grid-cols-3">
          {OPERATING_MODEL.map((item, index) => (
            <article
              key={item.title.en}
              className="rounded-2xl border border-heyazah-fog bg-heyazah-paper p-6 shadow-card"
            >
              <div className="flex aspect-[4/3] items-end rounded-xl bg-heyazah-primary p-5 text-heyazah-paper">
                <span className="font-mono text-sm text-heyazah-warm">{String(index + 1).padStart(2, '0')}</span>
              </div>
              <h3 className="mt-5 text-2xl text-heyazah-primary">{item.title[locale]}</h3>
              <p className="mt-3 text-sm leading-7 text-heyazah-ink/72">{item.body[locale]}</p>
            </article>
          ))}
        </div>
      </section>
      <section className="bg-heyazah-primary py-16 text-heyazah-paper">
        <div className="container grid gap-8 lg:grid-cols-[1fr_420px]">
          <div>
            <p className="text-xs uppercase tracking-[0.3em] text-heyazah-warm">
              {locale === 'ar' ? 'ملاحظة ألفا' : 'Alpha note'}
            </p>
            <h2 className="mt-3 text-4xl text-heyazah-paper">
              {locale === 'ar' ? 'جاهزة للتعبئة الرسمية' : 'Ready for official content'}
            </h2>
          </div>
          <p className="leading-8 text-heyazah-paper/72">
            {locale === 'ar'
              ? 'عند توفر الصور والسير، يمكن استبدال هذه البطاقات مباشرة دون تغيير بنية الصفحة أو اتجاهها.'
              : 'When official portraits and bios are available, these cards can be replaced without changing the page structure or direction.'}
          </p>
        </div>
      </section>
    </>
  );
}
