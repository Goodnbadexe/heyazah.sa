'use client';

import { useRef, useEffect, useState } from 'react';
import { motion, useInView, useReducedMotion } from 'framer-motion';
import { stats } from '@/lib/data/projects';
import { formatNumber } from '@/lib/utils';
import type { Locale } from '@/lib/i18n/locales';

/**
 * Animated stats band — numbers count up on scroll with staggered reveals.
 * Each card has a glassmorphic design with subtle accent gradients.
 */
export function StatsBand({ locale }: { locale: Locale }) {
  const s = stats();
  const sectionRef = useRef<HTMLElement>(null);
  const isInView = useInView(sectionRef, { once: true, margin: '-10%' });
  const prefersReduced = useReducedMotion();
  const ease = [0.16, 1, 0.3, 1] as const;

  const items = [
    { key: 'total',     value: s.total,            label: locale === 'ar' ? 'إجمالي المشاريع'    : 'Total projects',     icon: '◆' },
    { key: 'delivered', value: s.delivered,         label: locale === 'ar' ? 'مشاريع مكتملة'      : 'Delivered',           icon: '✓' },
    { key: 'underDev',  value: s.underDevelopment,  label: locale === 'ar' ? 'قيد التطوير'        : 'Under development',   icon: '▲' },
    { key: 'pipeline',  value: s.pipeline,          label: locale === 'ar' ? 'قادمة'              : 'Pipeline',            icon: '→' },
  ];

  return (
    <section ref={sectionRef} className="relative bg-heyazah-warm/20 py-20 md:py-28 overflow-hidden">
      <div className="container relative z-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        {items.map((item, i) => (
          <motion.div
            key={item.key}
            className="group relative rounded-3xl bg-heyazah-paper/80 backdrop-blur-sm p-7 md:p-8 shadow-card ring-1 ring-heyazah-fog/50 transition-all duration-700 hover:-translate-y-2 hover:shadow-hover hover:ring-heyazah-accent/20"
            initial={prefersReduced ? {} : { opacity: 0, y: 30, scale: 0.95 }}
            animate={isInView ? { opacity: 1, y: 0, scale: 1 } : {}}
            transition={{ duration: 0.8, delay: i * 0.1, ease }}
          >
            {/* Corner accent */}
            <div className="absolute top-0 right-0 rtl:right-auto rtl:left-0 w-20 h-20 rounded-bl-3xl rtl:rounded-bl-none rtl:rounded-br-3xl rounded-tr-3xl rtl:rounded-tr-none rtl:rounded-tl-3xl bg-gradient-to-br from-heyazah-accent/5 to-transparent pointer-events-none" />

            {/* Icon */}
            <span className="inline-block text-heyazah-accent/60 text-sm mb-3 transition-colors duration-500 group-hover:text-heyazah-accent">
              {item.icon}
            </span>

            {/* Animated number */}
            <AnimatedNumber
              value={item.value}
              locale={locale}
              isInView={isInView}
              prefersReduced={!!prefersReduced}
            />

            <p className="mt-3 text-xs uppercase tracking-[0.2em] text-heyazah-ink/50 font-medium">
              {item.label}
            </p>
          </motion.div>
        ))}
      </div>
    </section>
  );
}

/* ─── Animated Counter ─────────────────────────────────────────── */

function AnimatedNumber({
  value,
  locale,
  isInView,
  prefersReduced,
}: {
  value: number;
  locale: 'ar' | 'en';
  isInView: boolean;
  prefersReduced: boolean;
}) {
  const [displayValue, setDisplayValue] = useState(0);

  useEffect(() => {
    if (!isInView || prefersReduced) {
      setDisplayValue(value);
      return;
    }

    let start = 0;
    const duration = 2000;
    const startTime = Date.now();

    const step = () => {
      const elapsed = Date.now() - startTime;
      const progress = Math.min(elapsed / duration, 1);
      // Ease out cubic
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = Math.round(eased * value);
      setDisplayValue(current);
      if (progress < 1) requestAnimationFrame(step);
    };

    requestAnimationFrame(step);
  }, [isInView, value, prefersReduced]);

  return (
    <p className="text-5xl md:text-6xl font-bold text-heyazah-primary tracking-tight tabular-nums">
      {formatNumber(displayValue, locale)}
    </p>
  );
}
