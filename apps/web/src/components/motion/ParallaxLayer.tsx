'use client';

import { useEffect, useRef, type PropsWithChildren } from 'react';

/**
 * Thin wrapper around GSAP ScrollTrigger. Lazy-loads gsap so SSR stays clean.
 */
export function ParallaxLayer({
  children,
  className,
  speed = 0.4,
}: PropsWithChildren<{ className?: string; speed?: number }>) {
  const ref = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (typeof window === 'undefined') return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    let cleanup: (() => void) | undefined;
    (async () => {
      const { default: gsap } = await import('gsap');
      const { ScrollTrigger } = await import('gsap/ScrollTrigger');
      gsap.registerPlugin(ScrollTrigger);
      if (!ref.current) return;
      const tween = gsap.to(ref.current, {
        yPercent: -speed * 60,
        ease: 'none',
        scrollTrigger: {
          trigger: ref.current,
          start: 'top bottom',
          end: 'bottom top',
          scrub: true,
        },
      });
      cleanup = () => {
        tween.scrollTrigger?.kill();
        tween.kill();
      };
    })();
    return () => cleanup?.();
  }, [speed]);

  return (
    <div ref={ref} className={className}>
      {children}
    </div>
  );
}
