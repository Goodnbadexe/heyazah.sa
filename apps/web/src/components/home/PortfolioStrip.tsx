'use client';

import { useRef } from 'react';
import Link from 'next/link';
import { motion, useInView, useReducedMotion } from 'framer-motion';
import {
  continuingProjects,
  deliveredProjects,
  displayLocation,
  displayName,
  projectHeroImage,
  visionProjects,
  type Project,
} from '@/lib/data/projects';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

const bucketCopy = {
  delivered: {
    eyebrow: { ar: 'طبقة الإنجاز', en: 'Proof of delivery' },
    title: { ar: 'مكتملة', en: 'Delivered' },
    body: {
      ar: 'مشاريع تثبت قدرة حيازة على التسليم وبناء القيمة.',
      en: 'Finished projects that prove Heyazah can deliver and compound value.',
    },
  },
  momentum: {
    eyebrow: { ar: 'طبقة الزخم', en: 'Momentum layer' },
    title: { ar: 'قيد التطوير', en: 'Under development' },
    body: {
      ar: 'مشاريع تتحرك الآن وتوضح حجم المحفظة القادم.',
      en: 'Active developments that show the portfolio moving into its next scale.',
    },
  },
  vision: {
    eyebrow: { ar: 'طبقة الرؤية', en: 'Vision layer' },
    title: { ar: 'قادمة', en: 'Pipeline' },
    body: {
      ar: 'فرص مبكرة قابلة للتوسيع قبل الإطلاق الرسمي.',
      en: 'Early-stage opportunities ready to mature into full launches.',
    },
  },
} as const;

export function PortfolioStrip({ locale }: { locale: Locale }) {
  const sectionRef = useRef<HTMLElement>(null);
  const isInView = useInView(sectionRef, { once: true, margin: '-10%' });
  const prefersReduced = useReducedMotion();
  const buckets = [
    { key: 'delivered', items: deliveredProjects.slice(0, 4), count: deliveredProjects.length },
    { key: 'momentum', items: continuingProjects.slice(0, 4), count: continuingProjects.length },
    { key: 'vision', items: visionProjects.slice(0, 4), count: visionProjects.length },
  ] as const;

  return (
    <section
      ref={sectionRef}
      id="portfolio-strip"
      className="relative overflow-hidden bg-heyazah-primary py-24 text-heyazah-paper md:py-32"
    >
      <div className="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-heyazah-primary to-transparent" />
      <div className="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-heyazah-primary to-transparent" />

      <div className="container relative z-10">
        <motion.div
          className="mb-12 max-w-4xl"
          initial={prefersReduced ? {} : { opacity: 0, y: 24 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.8, ease: [0.16, 1, 0.3, 1] }}
        >
          <p className="text-xs uppercase tracking-[0.35em] text-heyazah-warm">
            {locale === 'ar' ? 'هندسة المحفظة' : 'Portfolio architecture'}
          </p>
          <h2 className="mt-4 text-4xl font-bold leading-tight text-heyazah-paper md:text-6xl">
            {locale === 'ar' ? 'ثلاث طبقات. قصة واحدة.' : 'Three columns. One living portfolio.'}
          </h2>
          <p className="mt-5 max-w-2xl text-base leading-7 text-heyazah-paper/72 md:text-lg">
            {locale === 'ar'
              ? 'الموقع لا يعرض المشاريع كقائمة فقط؛ بل يوضح ما تم تسليمه، وما يتحرك الآن، وما يتم بناؤه كفرصة مستقبلية.'
              : 'The website should not read as a flat list. It separates what has been delivered, what is moving now, and what is being shaped next.'}
          </p>
        </motion.div>

        <div className="grid gap-5 lg:grid-cols-3">
          {buckets.map((bucket, bucketIndex) => (
            <PortfolioBucket
              key={bucket.key}
              bucketKey={bucket.key}
              count={bucket.count}
              items={bucket.items}
              index={bucketIndex}
              locale={locale}
              isInView={isInView}
              prefersReduced={!!prefersReduced}
            />
          ))}
        </div>

        {!prefersReduced && (
          <div className="mt-8 overflow-hidden rounded-2xl border border-heyazah-paper/10 bg-heyazah-paper/[0.06]">
            <video autoPlay muted loop playsInline className="aspect-[16/5] h-full w-full object-cover">
              <source src="/assets/videos/projects-reel.mp4" type="video/mp4" />
            </video>
          </div>
        )}

        <motion.div
          className="mt-12 flex justify-center"
          initial={prefersReduced ? {} : { opacity: 0, y: 18 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.75, delay: 0.35 }}
        >
          <Link
            href={`/${locale}/portfolio`}
            className="inline-flex items-center gap-3 rounded-full border border-heyazah-paper/20 bg-heyazah-paper/8 px-7 py-3 text-sm font-semibold text-heyazah-paper backdrop-blur-md transition hover:border-heyazah-warm/60 hover:bg-heyazah-paper/14"
          >
            {locale === 'ar' ? 'فتح المحفظة كاملة' : 'Open full portfolio'}
            <span>{locale === 'ar' ? '←' : '→'}</span>
          </Link>
        </motion.div>
      </div>
    </section>
  );
}

function PortfolioBucket({
  bucketKey,
  count,
  items,
  index,
  locale,
  isInView,
  prefersReduced,
}: {
  bucketKey: keyof typeof bucketCopy;
  count: number;
  items: readonly Project[];
  index: number;
  locale: Locale;
  isInView: boolean;
  prefersReduced: boolean;
}) {
  const copy = bucketCopy[bucketKey];

  return (
    <motion.article
      className="relative overflow-hidden rounded-2xl border border-heyazah-paper/10 bg-heyazah-paper/[0.06] p-5 backdrop-blur-md"
      initial={prefersReduced ? {} : { opacity: 0, y: 28 }}
      animate={isInView ? { opacity: 1, y: 0 } : {}}
      transition={{ duration: 0.8, delay: index * 0.08, ease: [0.16, 1, 0.3, 1] }}
    >
      <div className="flex items-start justify-between gap-5">
        <div>
          <p className="text-[10px] uppercase tracking-[0.28em] text-heyazah-warm/90">
            {copy.eyebrow[locale]}
          </p>
          <h3 className="mt-2 text-3xl text-heyazah-paper">{copy.title[locale]}</h3>
        </div>
        <span className="rounded-full border border-heyazah-paper/12 px-3 py-1 text-xs text-heyazah-paper/72">
          {count}
        </span>
      </div>
      <p className="mt-4 min-h-[56px] text-sm leading-7 text-heyazah-paper/66">{copy.body[locale]}</p>

      <div className="mt-6 space-y-3">
        {items.map((project, projectIndex) => (
          <Link
            key={project.slug}
            href={project.is_placeholder ? `/${locale}/pipeline` : `/${locale}/portfolio/${project.slug}`}
            className="group grid grid-cols-[72px_minmax(0,1fr)] items-center gap-4 rounded-xl border border-heyazah-paper/8 bg-heyazah-primary/35 p-2 transition hover:border-heyazah-warm/45 hover:bg-heyazah-primary/55"
          >
            <span className="block aspect-[4/3] overflow-hidden rounded-lg bg-heyazah-paper/8">
              {/* eslint-disable-next-line @next/next/no-img-element */}
              <img
                src={projectHeroImage(project, projectIndex + index)}
                alt=""
                loading="lazy"
                className="h-full w-full object-cover transition duration-700 group-hover:scale-105"
              />
            </span>
            <span className="min-w-0">
              <span className="block truncate text-sm font-semibold text-heyazah-paper">
                {displayName(project, locale)}
              </span>
              <span className="mt-1 block truncate text-xs text-heyazah-paper/48">
                {displayLocation(project, locale) || t(locale, `type.${project.type}`)}
              </span>
            </span>
          </Link>
        ))}
      </div>
    </motion.article>
  );
}
