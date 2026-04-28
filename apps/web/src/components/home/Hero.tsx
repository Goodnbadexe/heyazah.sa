'use client';

import { useRef } from 'react';
import Link from 'next/link';
import { motion, useInView, useReducedMotion } from 'framer-motion';
import { Icon } from '@/components/brand/Icon';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

/**
 * Cinematic Hero — Scene.mp4 sits in a dedicated media zone.
 * Text elements reveal with staggered timing like an Apple keynote.
 * The source video contains baked-in logo/text moments, so live copy is kept
 * on a solid text-safe panel instead of overlaying the video.
 */
export function Hero({ locale }: { locale: Locale }) {
  const sectionRef = useRef<HTMLElement>(null);
  const isInView = useInView(sectionRef, { once: true });
  const prefersReduced = useReducedMotion();

  const ease = [0.16, 1, 0.3, 1] as const;
  const base = prefersReduced ? {} : { opacity: 0, y: 40 };
  const show = { opacity: 1, y: 0 };

  return (
    <section
      ref={sectionRef}
      className="relative isolate min-h-[100vh] overflow-hidden bg-heyazah-primary text-heyazah-paper"
    >
      <div className="container relative z-10 grid min-h-[100vh] items-center gap-10 pb-24 pt-28 lg:grid-cols-[0.88fr_1.12fr]">
      {/* Content */}
      <div className="flex max-w-2xl flex-col gap-8">
        {/* Tagline */}
        <motion.p
          className="max-w-xl text-sm font-medium uppercase tracking-[0.35em] text-heyazah-warm"
          initial={base}
          animate={isInView ? show : {}}
          transition={{ duration: 0.9, delay: 0.2, ease }}
        >
          {t(locale, 'site.tagline')}
        </motion.p>

        {/* Main headline — reveal with clip path */}
        <motion.h1
          className="max-w-2xl text-heyazah-paper text-5xl leading-[1.05] md:text-6xl lg:text-7xl font-bold"
          initial={prefersReduced ? {} : { opacity: 0, y: 60, clipPath: 'inset(100% 0 0 0)' }}
          animate={isInView ? { opacity: 1, y: 0, clipPath: 'inset(0% 0 0 0)' } : {}}
          transition={{ duration: 1.2, delay: 0.5, ease }}
        >
          {locale === 'ar'
            ? 'نبني وجهات الرياض منذ ٢٠٠٥.'
            : 'Building destinations in Riyadh since 2005.'}
        </motion.h1>

        {/* Subtitle */}
        <motion.p
          className="max-w-2xl text-lg leading-relaxed opacity-85"
          initial={base}
          animate={isInView ? show : {}}
          transition={{ duration: 0.9, delay: 0.9, ease }}
        >
          {locale === 'ar'
            ? 'محفظة من المشاريع السكنية والتجارية والفندقية التي يوقّعها فريق حيازة، بإرث يمتد من شركة أحمد السيف وأولاده القابضة.'
            : 'A portfolio of residential, commercial and hospitality landmarks signed by Heyazah, backed by the legacy of Ahmed Al-Saif & Sons Holding.'}
        </motion.p>

        {/* CTAs */}
        <motion.div
          className="flex flex-wrap gap-3"
          initial={base}
          animate={isInView ? show : {}}
          transition={{ duration: 0.9, delay: 1.2, ease }}
        >
          <Link
            href={`/${locale}/portfolio`}
            className="group inline-flex items-center gap-2 rounded-full bg-heyazah-paper px-7 py-3.5 text-sm font-semibold text-heyazah-primary shadow-card transition-all duration-500 hover:translate-y-[-2px] hover:shadow-hover"
          >
            {t(locale, 'nav.portfolio')}
            <Icon id="ui.button-arrow" className="h-3 w-3 ltr:rotate-0 rtl:rotate-180 transition-transform duration-300 group-hover:translate-x-1 rtl:group-hover:-translate-x-1" />
          </Link>
          <Link
            href={`/${locale}/pipeline`}
            className="inline-flex items-center gap-2 rounded-full border border-heyazah-paper/30 px-7 py-3.5 text-sm font-semibold text-heyazah-paper backdrop-blur-sm transition-all duration-500 hover:bg-heyazah-paper/10 hover:border-heyazah-paper/50"
          >
            {t(locale, 'nav.pipeline')}
          </Link>
        </motion.div>
      </div>

      {/* Dedicated video zone: no live text is placed over this media. */}
      {!prefersReduced && (
        <motion.div
          className="pointer-events-none hidden overflow-hidden rounded-2xl border border-heyazah-paper/10 bg-heyazah-paper/5 shadow-hero md:block"
          initial={{ opacity: 0, y: 28 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 1.0, delay: 0.7, ease }}
        >
          <video
            autoPlay
            muted
            loop
            playsInline
            preload="auto"
            className="aspect-[4/3] h-full w-full object-cover lg:aspect-[5/4]"
          >
            <source src="/assets/videos/hero-loop.mp4" type="video/mp4" />
          </video>
        </motion.div>
      )}
      </div>

      {/* Scroll indicator */}
      <motion.div
        className="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-heyazah-paper/40"
        initial={{ opacity: 0 }}
        animate={isInView ? { opacity: 1 } : {}}
        transition={{ delay: 2.0, duration: 1.0 }}
      >
        <span className="text-[10px] uppercase tracking-[0.3em]">
          {locale === 'ar' ? 'اكتشف' : 'Scroll'}
        </span>
        <motion.div
          className="w-[1px] h-8 bg-heyazah-paper/30"
          animate={{ scaleY: [0, 1, 0] }}
          transition={{ repeat: Infinity, duration: 2, ease: 'easeInOut' }}
          style={{ transformOrigin: 'top' }}
        />
      </motion.div>

      {/* Bottom transition gradient */}
      <div className="absolute bottom-0 left-0 right-0 h-40 bg-gradient-to-t from-heyazah-fog to-transparent pointer-events-none" />
    </section>
  );
}
