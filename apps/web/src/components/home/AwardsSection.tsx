'use client';

import { useRef } from 'react';
import { motion, useInView, useReducedMotion } from 'framer-motion';
import type { Locale } from '@/lib/i18n/locales';

const AWARDS = [
  { src: '/assets/uploads/awards/cert.png',       labelAr: 'شهادة الاعتماد',  labelEn: 'Official Certification', size: 'h-28' },
  { src: '/assets/uploads/awards/arabian.png',     labelAr: 'جائزة العقارات العربية',  labelEn: 'Arabian Property Award', size: 'h-20' },
  { src: '/assets/uploads/awards/award-05-1.svg',  labelAr: 'جائزة التميز',    labelEn: 'Excellence Award',        size: 'h-20' },
  { src: '/assets/uploads/awards/ach1-1.svg',      labelAr: 'شهادة الإنجاز',   labelEn: 'Achievement Certificate', size: 'h-20' },
];

export function AwardsSection({ locale }: { locale: Locale }) {
  const sectionRef = useRef<HTMLElement>(null);
  const isInView = useInView(sectionRef, { once: true, margin: '-10%' });
  const prefersReduced = useReducedMotion();
  const ease = [0.16, 1, 0.3, 1] as const;

  return (
    <section ref={sectionRef} className="relative bg-heyazah-paper py-24 md:py-32 text-heyazah-primary overflow-hidden">
      {/* Subtle background pattern */}
      <div className="absolute inset-0 opacity-[0.02] pointer-events-none [background-image:radial-gradient(circle_at_25%_25%,#082b2a_1px,transparent_1px)] [background-size:24px_24px]" />

      <div className="container relative">
        {/* Header */}
        <motion.div
          className="text-center mb-16 md:mb-20"
          initial={prefersReduced ? {} : { opacity: 0, y: 25 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.9, ease }}
        >
          <p className="text-xs uppercase tracking-[0.35em] text-heyazah-accent mb-3">
            {locale === 'ar' ? 'الاعتمادات والجوائز' : 'Awards & Accreditations'}
          </p>
          <h2 className="text-3xl font-semibold md:text-4xl lg:text-5xl text-heyazah-primary max-w-2xl mx-auto">
            {locale === 'ar' ? 'التزامنا بالجودة والتميز' : 'Our commitment to quality & excellence'}
          </h2>
          <div className="mt-5 mx-auto h-[1px] w-12 bg-heyazah-accent/40" />
        </motion.div>

        {/* Awards grid */}
        <div className="flex flex-wrap items-center justify-center gap-8 md:gap-12 lg:gap-16">
          {AWARDS.map((award, i) => (
            <motion.div
              key={award.labelEn}
              className="group relative flex flex-col items-center gap-5"
              initial={prefersReduced ? {} : { opacity: 0, y: 30, scale: 0.9 }}
              animate={isInView ? { opacity: 1, y: 0, scale: 1 } : {}}
              transition={{ duration: 0.8, delay: i * 0.12, ease }}
            >
              <div className="relative flex h-44 w-44 md:h-52 md:w-52 items-center justify-center rounded-3xl bg-gradient-to-br from-heyazah-fog/60 to-heyazah-fog/30 shadow-sm ring-1 ring-heyazah-fog/50 transition-all duration-700 ease-[cubic-bezier(0.16,1,0.3,1)] hover:-translate-y-3 hover:shadow-hover hover:ring-heyazah-accent/20">
                {/* Glow on hover */}
                <div className="absolute inset-0 rounded-3xl bg-gradient-to-br from-heyazah-accent/0 to-heyazah-warm/0 transition-all duration-700 group-hover:from-heyazah-accent/5 group-hover:to-heyazah-warm/5" />
                {/* eslint-disable-next-line @next/next/no-img-element */}
                <img
                  src={award.src}
                  alt={locale === 'ar' ? award.labelAr : award.labelEn}
                  className={`${award.size} w-auto relative z-10 mix-blend-multiply transition-transform duration-700 ease-[cubic-bezier(0.16,1,0.3,1)] group-hover:scale-110`}
                />
              </div>
              <span className="text-sm font-medium tracking-wide text-heyazah-primary/70 transition-colors duration-500 group-hover:text-heyazah-primary">
                {locale === 'ar' ? award.labelAr : award.labelEn}
              </span>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
