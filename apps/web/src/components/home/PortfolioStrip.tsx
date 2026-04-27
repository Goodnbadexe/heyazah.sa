'use client';

import { useState, useRef } from 'react';
import Link from 'next/link';
import { motion, AnimatePresence, useInView, useReducedMotion } from 'framer-motion';
import { featured, displayName, displayLocation, projectHeroImage, type Project } from '@/lib/data/projects';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

/**
 * Immersive typographic portfolio list with projects-reel.mp4 ambient backdrop.
 * Bold editorial navigation — hovering a row highlights it while siblings dim.
 */
export function PortfolioStrip({ locale }: { locale: Locale }) {
  const [hoveredIndex, setHoveredIndex] = useState<number | null>(null);
  const sectionRef = useRef<HTMLElement>(null);
  const isInView = useInView(sectionRef, { once: true, margin: '-10%' });
  const prefersReduced = useReducedMotion();
  const isRtl = locale === 'ar';

  return (
    <section
      ref={sectionRef}
      id="portfolio-strip"
      className="relative overflow-hidden bg-heyazah-primary py-28 md:py-36 text-heyazah-paper"
    >
      {/* Video background — subtle ambient layer */}
      {!prefersReduced && (
        <div className="absolute inset-0 opacity-10 pointer-events-none">
          <video autoPlay muted loop playsInline className="h-full w-full object-cover">
            <source src="/assets/videos/projects-reel.mp4" type="video/mp4" />
          </video>
        </div>
      )}

      {/* Gradient overlays */}
      <div className="absolute inset-0 pointer-events-none bg-gradient-to-b from-heyazah-primary via-heyazah-primary/95 to-heyazah-primary" />
      <div className="absolute inset-0 pointer-events-none opacity-30 bg-gradient-to-br from-heyazah-accent/15 via-transparent to-heyazah-warm/10" />

      <div className="container relative z-10">
        {/* Section header */}
        <motion.div
          className="mb-16 md:mb-20"
          initial={prefersReduced ? {} : { opacity: 0, y: 30 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.9, ease: [0.16, 1, 0.3, 1] }}
        >
          <p className="text-xs uppercase tracking-[0.35em] text-heyazah-accent mb-4">
            {locale === 'ar' ? 'أبرز المشاريع' : 'Selected work'}
          </p>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-heyazah-paper">
            {t(locale, 'nav.portfolio')}
          </h2>
          <div className="mt-4 h-[1px] w-16 bg-heyazah-accent/50" />
        </motion.div>

        {/* Immersive list */}
        <ul
          className="flex flex-col w-full"
          onMouseLeave={() => setHoveredIndex(null)}
        >
          {featured.map((project, i) => (
            <ImmersiveRow
              key={project.id}
              project={project}
              index={i}
              locale={locale}
              isRtl={isRtl}
              isHovered={hoveredIndex === i}
              isOtherHovered={hoveredIndex !== null && hoveredIndex !== i}
              onHover={() => setHoveredIndex(i)}
              isInView={isInView}
              prefersReduced={!!prefersReduced}
            />
          ))}
        </ul>

        {/* CTA */}
        <motion.div
          className="mt-16 flex justify-center"
          initial={prefersReduced ? {} : { opacity: 0, y: 20 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.8, delay: 0.6, ease: [0.16, 1, 0.3, 1] }}
        >
          <Link
            href={`/${locale}/portfolio`}
            className="group inline-flex items-center gap-3 rounded-full border border-heyazah-paper/20 px-8 py-4 text-sm font-semibold text-heyazah-paper backdrop-blur-sm transition-all duration-500 hover:bg-heyazah-paper/10 hover:border-heyazah-accent/40 hover:shadow-[0_0_40px_rgba(2,81,87,0.15)]"
          >
            {locale === 'ar' ? 'عرض جميع المشاريع' : 'View all projects'}
            <motion.span
              className="inline-block"
              animate={{ x: [0, 4, 0] }}
              transition={{ repeat: Infinity, duration: 2, ease: 'easeInOut' }}
            >
              {isRtl ? '←' : '→'}
            </motion.span>
          </Link>
        </motion.div>
      </div>
    </section>
  );
}

/* ─── Individual Row ─────────────────────────────────────────────── */

function ImmersiveRow({
  project,
  index,
  locale,
  isRtl,
  isHovered,
  isOtherHovered,
  onHover,
  isInView,
  prefersReduced,
}: {
  project: Project;
  index: number;
  locale: Locale;
  isRtl: boolean;
  isHovered: boolean;
  isOtherHovered: boolean;
  onHover: () => void;
  isInView: boolean;
  prefersReduced: boolean;
}) {
  const name = displayName(project, locale);
  const location = displayLocation(project, locale);
  const hero = projectHeroImage(project, index);
  const ease = [0.16, 1, 0.3, 1] as const;

  return (
    <motion.li
      className="relative border-b border-heyazah-paper/8 first:border-t"
      initial={prefersReduced ? {} : { opacity: 0, y: 40 }}
      animate={isInView ? { opacity: 1, y: 0 } : {}}
      transition={{ duration: 0.8, delay: index * 0.08, ease }}
      onMouseEnter={onHover}
    >
      <Link
        href={`/${locale}/portfolio/${project.slug}`}
        className="group relative block w-full py-7 md:py-9"
      >
        <motion.div
          className="flex items-center gap-4 md:gap-8"
          initial={false}
          animate={{
            opacity: isOtherHovered ? 0.15 : 1,
            filter: isOtherHovered ? 'blur(3px)' : 'blur(0px)',
            x: isHovered ? (isRtl ? -20 : 20) : 0,
          }}
          transition={{ duration: 0.5, ease }}
        >
          {/* Arrow indicator */}
          <motion.span
            className="flex-shrink-0 text-heyazah-accent text-2xl md:text-4xl font-light"
            initial={false}
            animate={{
              opacity: isHovered ? 1 : 0,
              x: isHovered ? 0 : isRtl ? 20 : -20,
              scale: isHovered ? 1 : 0.5,
            }}
            transition={{ duration: 0.4, ease }}
          >
            {isRtl ? '←' : '→'}
          </motion.span>

          {/* Index number */}
          <span className="hidden md:block w-12 text-xs font-mono text-heyazah-paper/30 tabular-nums tracking-wider">
            {String(index + 1).padStart(2, '0')}
          </span>

          {/* Project name */}
          <h3 className="text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-bold tracking-tight leading-[1.05]">
            {name}
          </h3>

          {/* Status badge on hover */}
          <motion.span
            className="hidden md:flex items-center gap-1.5 text-[10px] uppercase tracking-widest text-heyazah-accent/70"
            initial={false}
            animate={{ opacity: isHovered ? 1 : 0, x: isHovered ? 0 : -10 }}
            transition={{ duration: 0.3, ease }}
          >
            <span className="w-1.5 h-1.5 rounded-full bg-heyazah-accent" />
            {project.status === 'old'
              ? locale === 'ar' ? 'مكتمل' : 'Delivered'
              : locale === 'ar' ? 'قيد التطوير' : 'In progress'}
          </motion.span>

          {/* Location tag */}
          {location && (
            <motion.span
              className="hidden lg:block text-sm text-heyazah-paper/40 uppercase tracking-widest ml-auto rtl:mr-auto rtl:ml-0"
              initial={false}
              animate={{ opacity: isHovered ? 1 : 0.3 }}
              transition={{ duration: 0.3 }}
            >
              {location}
            </motion.span>
          )}
        </motion.div>

        {/* Thumbnail preview on hover */}
        <AnimatePresence>
          {isHovered && (
            <motion.div
              className={`absolute top-1/2 -translate-y-1/2 w-36 h-24 md:w-52 md:h-32 rounded-xl overflow-hidden shadow-hero pointer-events-none z-20 ring-1 ring-heyazah-paper/10 ${
                isRtl ? 'left-4' : 'right-4'
              }`}
              initial={{ opacity: 0, scale: 0.8, y: '-50%' }}
              animate={{ opacity: 1, scale: 1, y: '-50%' }}
              exit={{ opacity: 0, scale: 0.9, y: '-50%' }}
              transition={{ duration: 0.4, ease }}
            >
              {/* eslint-disable-next-line @next/next/no-img-element */}
              <img src={hero} alt="" className="h-full w-full object-cover" />
              <div className="absolute inset-0 bg-gradient-to-t from-heyazah-primary/50 to-transparent" />
            </motion.div>
          )}
        </AnimatePresence>
      </Link>
    </motion.li>
  );
}
