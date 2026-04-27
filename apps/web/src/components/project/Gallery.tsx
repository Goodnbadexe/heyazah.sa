'use client';

import { useRef } from 'react';
import { motion, useInView, useReducedMotion } from 'framer-motion';
import { cn } from '@/lib/utils';
import type { Project } from '@/lib/data/projects';

/**
 * Cinematic collage gallery — images stagger into view with varied
 * entry directions and durations, creating the architectural montage
 * effect from the suggestion videos (Scene.mp4 / 16-9.mp4).
 *
 * Every 5th image spans 2 columns + 2 rows to create visual hierarchy.
 * On scroll, items fade in with slight translation from alternating
 * directions.
 */
export function Gallery({ project }: { project: Project }) {
  const gallery: string[] = (project.images?.gallery ?? [])
    .map((g: any) => (typeof g === 'string' ? g : g?.url ?? g?.path ?? ''))
    .filter(Boolean);
  if (!gallery.length) return null;

  const sectionRef = useRef<HTMLElement>(null);
  const isInView = useInView(sectionRef, { once: true, margin: '-5%' });
  const prefersReduced = useReducedMotion();

  const ease = [0.16, 1, 0.3, 1] as const;

  return (
    <section ref={sectionRef} className="container py-16 md:py-24">
      <div className="grid grid-cols-2 gap-3 md:grid-cols-3 md:gap-4">
        {gallery.map((src, i) => {
          const isFeature = i % 5 === 0;
          // Alternate entry directions for cinematic feel
          const xOffset = i % 3 === 0 ? -40 : i % 3 === 1 ? 40 : 0;
          const yOffset = i % 2 === 0 ? 30 : 50;

          return (
            <motion.figure
              key={src + i}
              className={cn(
                'group relative overflow-hidden rounded-xl bg-heyazah-fog shadow-card cursor-pointer',
                isFeature
                  ? 'col-span-2 row-span-2 aspect-[16/10]'
                  : 'aspect-square',
              )}
              initial={
                prefersReduced
                  ? {}
                  : { opacity: 0, x: xOffset, y: yOffset, scale: 0.92 }
              }
              animate={
                isInView
                  ? { opacity: 1, x: 0, y: 0, scale: 1 }
                  : {}
              }
              transition={{
                duration: 0.9 + (i % 3) * 0.1,
                delay: i * 0.07,
                ease,
              }}
            >
              {/* eslint-disable-next-line @next/next/no-img-element */}
              <img
                src={src}
                alt=""
                loading="lazy"
                className="h-full w-full object-cover transition-all duration-[1400ms] ease-[cubic-bezier(0.16,1,0.3,1)] group-hover:scale-110"
              />
              {/* Hover overlay with subtle gradient */}
              <div className="absolute inset-0 bg-gradient-to-t from-heyazah-primary/30 via-transparent to-transparent opacity-0 transition-opacity duration-700 group-hover:opacity-100" />
              {/* Lightbox index indicator */}
              <div className="absolute bottom-3 right-3 rtl:right-auto rtl:left-3 rounded-full bg-heyazah-paper/10 backdrop-blur-md px-3 py-1 text-xs text-heyazah-paper opacity-0 transition-all duration-500 group-hover:opacity-100 group-hover:translate-y-0 translate-y-2">
                {String(i + 1).padStart(2, '0')}
              </div>
            </motion.figure>
          );
        })}
      </div>
    </section>
  );
}
