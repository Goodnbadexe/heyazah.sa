'use client';

import { useRef, useEffect } from 'react';
import { motion, useInView, useReducedMotion } from 'framer-motion';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';
import { displayName, displayLocation, description, projectHeroImage, type Project } from '@/lib/data/projects';
import { cn } from '@/lib/utils';

/**
 * Cinematic project hero — restrained motion + staggered typography reveal.
 *
 * The background image uses a very small transform-only drift so the image
 * stays legible and does not feel over-cropped on project pages.
 */
export function ProjectHero({ project, locale }: { project: Project; locale: Locale }) {
  const hero = projectHeroImage(project);
  const name = displayName(project, locale);
  const loc = displayLocation(project, locale);
  const sub = description(project, locale, 'subtitle');
  const status = project.status as keyof typeof import('@/lib/i18n/dictionary').dict.status;
  const imgRef = useRef<HTMLImageElement>(null);
  const sectionRef = useRef<HTMLElement>(null);
  const isInView = useInView(sectionRef, { once: true });
  const prefersReduced = useReducedMotion();

  /* Ken Burns zoom via GSAP (lazy-loaded, SSR-safe) */
  useEffect(() => {
    if (prefersReduced || !imgRef.current) return;
    let cleanup: (() => void) | undefined;
    (async () => {
      const { default: gsap } = await import('gsap');
      if (!imgRef.current) return;
      const tl = gsap.timeline({ repeat: -1, yoyo: true });
      tl.fromTo(
        imgRef.current,
        { scale: 1, x: '0%', y: '0%' },
        { scale: 1.045, x: '-0.75%', y: '-0.5%', duration: 22, ease: 'none' },
      );
      cleanup = () => tl.kill();
    })();
    return () => cleanup?.();
  }, [prefersReduced]);

  /* Staggered text animations */
  const ease = [0.16, 1, 0.3, 1] as const;
  const textBase = prefersReduced ? {} : { opacity: 0, y: 30 };
  const textVisible = { opacity: 1, y: 0 };

  return (
    <section
      ref={sectionRef}
      className="relative isolate overflow-hidden bg-heyazah-primary text-heyazah-paper"
    >
      {/* Background image with Ken Burns */}
      {hero && (
        <div className="absolute inset-0 -z-10 overflow-hidden">
          {/* eslint-disable-next-line @next/next/no-img-element */}
          <img
            ref={imgRef}
            src={hero}
            alt=""
            aria-hidden="true"
            className="h-full w-full object-cover opacity-62 will-change-transform"
          />
        </div>
      )}

      {/* Gradient overlays */}
      <div className="absolute inset-0 -z-10 bg-gradient-to-t from-heyazah-primary via-heyazah-primary/70 to-heyazah-primary/20" />
      <div className="absolute inset-0 -z-10 bg-gradient-to-r from-heyazah-primary/35 to-transparent" />

      {/* Content */}
      <div className="container flex min-h-[65vh] flex-col justify-end gap-5 pb-16 pt-32 md:min-h-[80vh] md:pb-24">
        {/* Status badges — first to appear */}
        <motion.div
          className="flex gap-2"
          initial={textBase}
          animate={isInView ? textVisible : {}}
          transition={{ duration: 0.8, delay: 0.3, ease }}
        >
          <span
            className={cn(
              'rounded-full px-3 py-1 text-[11px] font-semibold uppercase tracking-wider backdrop-blur-sm',
              status === 'continuing' && 'bg-heyazah-accent/90',
              status === 'old' && 'bg-heyazah-ink/60',
              status === 'new' && 'bg-heyazah-warm text-heyazah-primary',
            )}
          >
            {t(locale, `status.${status}`)}
          </span>
          <span className="rounded-full bg-heyazah-paper/90 px-3 py-1 text-[11px] font-semibold text-heyazah-primary backdrop-blur-sm">
            {t(locale, `type.${project.type}`)}
          </span>
        </motion.div>

        {/* Project name — large, cinematic reveal */}
        <motion.h1
          className="text-heyazah-paper text-5xl leading-[1.05] md:text-7xl lg:text-8xl font-bold"
          initial={prefersReduced ? {} : { opacity: 0, y: 50, clipPath: 'inset(100% 0 0 0)' }}
          animate={isInView ? { opacity: 1, y: 0, clipPath: 'inset(0% 0 0 0)' } : {}}
          transition={{ duration: 1.1, delay: 0.5, ease }}
        >
          {name}
        </motion.h1>

        {/* Location */}
        {loc && (
          <motion.p
            className="text-lg opacity-90 flex items-center gap-2"
            initial={textBase}
            animate={isInView ? textVisible : {}}
            transition={{ duration: 0.8, delay: 0.8, ease }}
          >
            <span className="inline-block h-[1px] w-6 bg-heyazah-accent" />
            {loc}
          </motion.p>
        )}

        {/* Subtitle */}
        {sub && (
          <motion.p
            className="max-w-2xl text-base opacity-80 leading-relaxed"
            initial={textBase}
            animate={isInView ? textVisible : {}}
            transition={{ duration: 0.8, delay: 1.0, ease }}
          >
            {sub}
          </motion.p>
        )}
      </div>

      {/* Bottom edge gradient for smooth transition */}
      <div className="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-heyazah-paper to-transparent" />
    </section>
  );
}
