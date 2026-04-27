import Link from 'next/link';
import { continuingProjects, deliveredProjects, stats, visionProjects } from '@/lib/data/projects';
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
  const lines: Array<{ label: string; value: number; note: string }> = [
    {
      label: locale === 'ar' ? 'إجمالي المشاريع' : 'Total projects',
      value: s.total,
      note: locale === 'ar' ? 'محفظة ممتدة عبر السكني والتجاري والفندقي.' : 'A mixed residential, commercial, and hospitality portfolio.',
    },
    {
      label: locale === 'ar' ? 'مكتملة' : 'Delivered',
      value: deliveredProjects.length,
      note: locale === 'ar' ? 'طبقة تثبت التنفيذ والتسليم.' : 'The layer that proves execution and delivery.',
    },
    {
      label: locale === 'ar' ? 'قيد التطوير' : 'Under development',
      value: continuingProjects.length,
      note: locale === 'ar' ? 'طبقة الزخم وحجم النمو القادم.' : 'The momentum layer and next scale of growth.',
    },
    {
      label: locale === 'ar' ? 'قادمة' : 'Pipeline',
      value: visionProjects.length,
      note: locale === 'ar' ? 'طبقة الرؤية وفرص الاهتمام المبكر.' : 'The vision layer and early interest opportunities.',
    },
  ];
  const thesis = [
    locale === 'ar' ? 'محفظة مفهومة وليست قائمة طويلة.' : 'A legible portfolio, not a long flat list.',
    locale === 'ar' ? 'كل مشروع يوضح حالة، نوع، ومكان القيمة.' : 'Every project clarifies status, type, and value role.',
    locale === 'ar' ? 'الطلبات الاستثمارية تقود إلى اجتماع واضح.' : 'Investor interest routes into a clear briefing path.',
  ];

  return (
    <>
      <section className="bg-heyazah-primary py-24 text-heyazah-paper">
        <div className="container max-w-4xl">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-warm">{t(locale, 'nav.investors')}</p>
          <h1 className="mt-3 text-5xl leading-tight text-heyazah-paper md:text-7xl">
            {locale === 'ar' ? 'محفظة قابلة للقراءة والاستثمار' : 'A portfolio built to be read and evaluated'}
          </h1>
          <p className="mt-5 max-w-2xl text-lg leading-8 text-heyazah-paper/82">
            {locale === 'ar'
              ? 'هذه الصفحة تُحوّل المشاريع إلى قصة استثمارية واضحة: ما تم تسليمه، ما يتحرك الآن، وما يمكن أن ينمو لاحقاً.'
              : 'This page turns the project base into a clear investor story: what has been delivered, what is moving now, and what can grow next.'}
          </p>
        </div>
      </section>

      <section className="container py-16">
        <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          {lines.map((l) => (
            <div key={l.label} className="rounded-2xl border border-heyazah-fog bg-heyazah-paper p-6 shadow-card">
              <p className="font-ar-display text-5xl text-heyazah-primary">{formatNumber(l.value, locale)}</p>
              <p className="mt-2 text-sm uppercase tracking-widest text-heyazah-ink/60">{l.label}</p>
              <p className="mt-4 text-sm leading-7 text-heyazah-ink/70">{l.note}</p>
            </div>
          ))}
        </div>
      </section>

      <section className="bg-heyazah-fog py-16">
        <div className="container grid gap-10 lg:grid-cols-[1fr_420px]">
          <div>
            <p className="text-xs uppercase tracking-[0.3em] text-heyazah-accent">
              {locale === 'ar' ? 'ماذا يرى المستثمر؟' : 'Investor lens'}
            </p>
            <h2 className="mt-3 text-4xl text-heyazah-primary">
              {locale === 'ar' ? 'من الدليل إلى الزخم إلى الرؤية' : 'From proof, to momentum, to vision'}
            </h2>
            <p className="mt-4 max-w-2xl leading-8 text-heyazah-ink/75">
              {locale === 'ar'
                ? 'النسخة الحالية تجعل حيازة قابلة للفهم بسرعة: المشاريع المكتملة تبني الثقة، المشاريع النشطة تثبت الحركة، والمشاريع القادمة تفتح باب الحوار.'
                : 'The current alpha makes Heyazah easier to understand quickly: delivered work builds trust, active work proves motion, and upcoming work opens the conversation.'}
            </p>
            <Link
              href={`/${locale}/contact?type=investor`}
              className="mt-8 inline-flex rounded-full bg-heyazah-primary px-6 py-3 text-sm font-semibold text-heyazah-paper shadow-card hover:bg-heyazah-accent"
            >
              {locale === 'ar' ? 'طلب اجتماع استثماري' : 'Request an investor briefing'}
            </Link>
          </div>
          <div className="space-y-3">
            {thesis.map((line, index) => (
              <div key={line} className="flex gap-4 rounded-2xl bg-heyazah-paper p-5 shadow-card">
                <span className="font-mono text-sm text-heyazah-accent">{String(index + 1).padStart(2, '0')}</span>
                <p className="font-semibold text-heyazah-primary">{line}</p>
              </div>
            ))}
          </div>
        </div>
      </section>
    </>
  );
}
