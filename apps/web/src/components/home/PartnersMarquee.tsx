'use client';

import { motion, useInView } from 'framer-motion';
import { useRef } from 'react';
import type { Locale } from '@/lib/i18n/locales';

const PARTNERS = [
  { name: 'Ministry of Justice', src: '/assets/uploads/partners/ministry_of_justice.png' },
  { name: 'Authority of Competition', src: '/assets/uploads/partners/authority_of_competition.png' },
  { name: 'SAFCSP', src: '/assets/uploads/partners/safcsp.png' },
  { name: 'Bank Aljazira', src: '/assets/uploads/partners/bankaljazira.webp' },
  { name: 'Seera Group', src: '/assets/uploads/partners/seera.jpg' },
  { name: 'Arabian Property', src: '/assets/uploads/partners/arabian.png' },
  { name: 'Tabby', src: '/assets/uploads/partners/tabby.png' },
  { name: 'Zain', src: '/assets/uploads/partners/zain.png' },
  { name: 'Layout', src: '/assets/uploads/partners/layout_set.png' },
  { name: 'Partner', src: '/assets/uploads/partners/ozdclpkk.png' },
  { name: 'Other', src: '/assets/uploads/partners/other-logo.png' },
];

export function PartnersMarquee({ locale }: { locale: Locale }) {
  const sectionRef = useRef<HTMLElement>(null);
  const isInView = useInView(sectionRef, { once: true, margin: '-5%' });
  const repeatedPartners = [...PARTNERS, ...PARTNERS, ...PARTNERS, ...PARTNERS];

  return (
    <section ref={sectionRef} className="relative overflow-hidden bg-heyazah-fog py-24 md:py-32">
      {/* Section header */}
      <div className="container relative z-10 mb-14 flex flex-col items-center">
        <motion.div
          className="text-center"
          initial={{ opacity: 0, y: 20 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.8, ease: [0.16, 1, 0.3, 1] }}
        >
          <p className="text-xs uppercase tracking-[0.35em] text-heyazah-accent mb-3">
            {locale === 'ar' ? 'شركاء النجاح' : 'Success Partners'}
          </p>
          <h2 className="text-3xl font-semibold md:text-4xl text-heyazah-primary max-w-xl">
            {locale === 'ar' ? 'نعتز بشراكاتنا الاستراتيجية' : 'We are proud of our strategic partnerships'}
          </h2>
          <div className="mt-4 mx-auto h-[1px] w-12 bg-heyazah-accent/40" />
        </motion.div>
      </div>

      {/* Marquee — row 1 */}
      <div className="relative mx-auto flex w-full overflow-hidden before:absolute before:left-0 before:top-0 before:z-10 before:h-full before:w-[80px] md:before:w-[200px] before:bg-gradient-to-r before:from-heyazah-fog before:to-transparent after:absolute after:right-0 after:top-0 after:z-10 after:h-full after:w-[80px] md:after:w-[200px] after:bg-gradient-to-l after:from-heyazah-fog after:to-transparent">
        <motion.div
          animate={{ x: locale === 'ar' ? ['0%', '50%'] : ['0%', '-50%'] }}
          transition={{ repeat: Infinity, ease: 'linear', duration: 60 }}
          className="flex w-max shrink-0 items-center justify-center gap-6 px-4 md:gap-12 md:px-8"
        >
          {repeatedPartners.map((partner, idx) => (
            <div
              key={idx}
              className="group relative flex h-20 w-36 shrink-0 items-center justify-center rounded-2xl bg-heyazah-paper/50 p-5 shadow-sm backdrop-blur-sm transition-all duration-700 ease-[cubic-bezier(0.16,1,0.3,1)] hover:-translate-y-2 hover:bg-heyazah-paper hover:shadow-hover md:h-28 md:w-48"
            >
              {/* eslint-disable-next-line @next/next/no-img-element */}
              <img
                src={partner.src}
                alt={partner.name}
                className="max-h-full max-w-full object-contain opacity-40 mix-blend-multiply grayscale transition-all duration-700 ease-[cubic-bezier(0.16,1,0.3,1)] group-hover:opacity-100 group-hover:grayscale-0"
              />
            </div>
          ))}
        </motion.div>
      </div>

      {/* Marquee — row 2 (reverse direction, slower) */}
      <div className="relative mx-auto mt-6 flex w-full overflow-hidden before:absolute before:left-0 before:top-0 before:z-10 before:h-full before:w-[80px] md:before:w-[200px] before:bg-gradient-to-r before:from-heyazah-fog before:to-transparent after:absolute after:right-0 after:top-0 after:z-10 after:h-full after:w-[80px] md:after:w-[200px] after:bg-gradient-to-l after:from-heyazah-fog after:to-transparent">
        <motion.div
          animate={{ x: locale === 'ar' ? ['0%', '-50%'] : ['0%', '50%'] }}
          transition={{ repeat: Infinity, ease: 'linear', duration: 75 }}
          className="flex w-max shrink-0 items-center justify-center gap-6 px-4 md:gap-12 md:px-8"
        >
          {[...repeatedPartners].reverse().map((partner, idx) => (
            <div
              key={idx}
              className="group relative flex h-20 w-36 shrink-0 items-center justify-center rounded-2xl bg-heyazah-paper/50 p-5 shadow-sm backdrop-blur-sm transition-all duration-700 ease-[cubic-bezier(0.16,1,0.3,1)] hover:-translate-y-2 hover:bg-heyazah-paper hover:shadow-hover md:h-28 md:w-48"
            >
              {/* eslint-disable-next-line @next/next/no-img-element */}
              <img
                src={partner.src}
                alt={partner.name}
                className="max-h-full max-w-full object-contain opacity-40 mix-blend-multiply grayscale transition-all duration-700 ease-[cubic-bezier(0.16,1,0.3,1)] group-hover:opacity-100 group-hover:grayscale-0"
              />
            </div>
          ))}
        </motion.div>
      </div>
    </section>
  );
}
