'use client';

import { motion, useReducedMotion, type Variants } from 'framer-motion';
import type { PropsWithChildren } from 'react';

const variants: Variants = {
  hidden: { opacity: 0, y: 24 },
  shown: { opacity: 1, y: 0, transition: { duration: 0.8, ease: [0.16, 1, 0.3, 1] } },
};

export function RevealOnScroll({
  children,
  className,
  delay = 0,
}: PropsWithChildren<{ className?: string; delay?: number }>) {
  const reduce = useReducedMotion();
  return (
    <motion.div
      initial={reduce ? 'shown' : 'hidden'}
      whileInView="shown"
      viewport={{ once: true, margin: '-15%' }}
      variants={variants}
      transition={{ delay }}
      className={className}
    >
      {children}
    </motion.div>
  );
}
