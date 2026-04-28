'use client';

import Link from 'next/link';
import { motion, useInView, useReducedMotion } from 'framer-motion';
import { useRef } from 'react';
import { featured, displayName, projectHeroImage, stats as getStats } from '@/lib/data/projects';
import { formatNumber } from '@/lib/utils';
import type { Locale } from '@/lib/i18n/locales';

export function OrbitCarousel({ locale }: { locale: Locale }) {
  const sectionRef = useRef<HTMLElement>(null);
  const isInView = useInView(sectionRef, { once: true, margin: '-10%' });
  const prefersReduced = useReducedMotion();
  const stats = getStats();
  const projects = featured.slice(0, 5);
  const ease = [0.16, 1, 0.3, 1] as const;

  return (
    <section
      ref={sectionRef}
      id="orbit-carousel"
      className="relative isolate overflow-hidden bg-heyazah-primary py-24 text-heyazah-paper md:py-32"
    >
      <div className="absolute inset-x-0 bottom-0 -z-10 h-48 bg-gradient-to-t from-heyazah-primary to-transparent" />

      <div className="container grid items-center gap-12 lg:grid-cols-[0.88fr_1.12fr]">
        <motion.div
          initial={prefersReduced ? {} : { opacity: 0, y: 30 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.9, ease }}
        >
          <p className="text-xs uppercase tracking-[0.32em] text-heyazah-accent">
            {locale === 'ar' ? 'رحلة حيازة' : 'The Heyazah Journey'}
          </p>
          <h2 className="mt-5 max-w-2xl text-4xl font-bold leading-[1.05] text-heyazah-paper md:text-6xl">
            {locale === 'ar' ? 'محفظة تتحرك بثقة نحو رؤية 2030.' : 'A portfolio moving with confidence toward Vision 2030.'}
          </h2>
          <p className="mt-5 max-w-xl text-base leading-8 text-heyazah-paper/75">
            {locale === 'ar'
              ? 'نستخدم العرض المرئي كطبقة رئيسية، ثم نضيف أرقام المشاريع وروابط سريعة بدون ازدحام بصري.'
              : 'The video becomes the main showcase layer, supported by clear portfolio signals and quick project entry points.'}
          </p>

          <div className="mt-10 grid max-w-xl grid-cols-3 gap-3">
            {[
              { value: '2005', label: locale === 'ar' ? 'تأسست' : 'Founded' },
              { value: formatNumber(stats.total, locale), label: locale === 'ar' ? 'مشروع' : 'Projects' },
              { value: '2030', label: locale === 'ar' ? 'الرؤية' : 'Vision' },
            ].map((item) => (
              <div key={item.label} className="rounded-2xl border border-heyazah-paper/10 bg-heyazah-paper/8 p-4 backdrop-blur-md">
                <strong className="block text-3xl font-bold text-heyazah-paper md:text-4xl">{item.value}</strong>
                <span className="mt-2 block text-[10px] uppercase tracking-[0.22em] text-heyazah-paper/45">{item.label}</span>
              </div>
            ))}
          </div>
        </motion.div>

        <motion.div
          className="grid gap-4 sm:grid-cols-2"
          initial={prefersReduced ? {} : { opacity: 0, y: 30 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.9, delay: 0.15, ease }}
        >
          {!prefersReduced && (
            <div className="overflow-hidden rounded-2xl border border-heyazah-paper/10 bg-heyazah-paper/8 shadow-hero sm:col-span-2">
              <video autoPlay muted loop playsInline className="aspect-video h-full w-full object-cover">
                <source src="/assets/videos/orbit-showcase.mp4" type="video/mp4" />
              </video>
            </div>
          )}
          {projects.map((project, index) => (
            <Link
              key={project.slug}
              href={`/${locale}/portfolio/${project.slug}`}
              className={index === 0 ? 'group relative overflow-hidden rounded-2xl border border-heyazah-paper/10 bg-heyazah-paper/10 shadow-hero sm:col-span-2' : 'group relative overflow-hidden rounded-2xl border border-heyazah-paper/10 bg-heyazah-paper/10 shadow-card'}
            >
              <div className={index === 0 ? 'aspect-[16/7]' : 'aspect-[16/10]'}>
                {/* eslint-disable-next-line @next/next/no-img-element */}
                <img
                  src={projectHeroImage(project, index)}
                  alt={displayName(project, locale)}
                  className="h-full w-full object-cover opacity-85 transition-transform duration-700 group-hover:scale-105"
                />
              </div>
              <div className="absolute inset-0 bg-gradient-to-t from-heyazah-primary/82 via-heyazah-primary/18 to-transparent" />
              <div className="absolute inset-x-0 bottom-0 p-4">
                <p className="text-sm font-semibold text-heyazah-paper">{displayName(project, locale)}</p>
              </div>
            </Link>
          ))}
        </motion.div>
      </div>
    </section>
  );
}
