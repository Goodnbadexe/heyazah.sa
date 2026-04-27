'use client';

import { useState, useEffect, useRef } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import type { Locale } from '@/lib/i18n/locales';

/**
 * Cinematic video entrance / preloader — Apple-keynote-style reveal.
 *
 * Plays the 16-9.mp4 montage video full-screen, then splits open like an
 * unboxing experience to reveal the site underneath. Uses the local video
 * file instead of a broken external iframe.
 */
export function SiteEntrance({ locale }: { locale: Locale }) {
  const [show, setShow] = useState(false);
  const [phase, setPhase] = useState<'loading' | 'playing' | 'exiting'>('loading');
  const videoRef = useRef<HTMLVideoElement>(null);
  const progressRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (!window.location.search.includes('intro=1')) return;
    const hasSeen = sessionStorage.getItem('heyazah_entrance_seen');
    if (!hasSeen) {
      setShow(true);
      document.body.style.overflow = 'hidden';
    }
  }, []);

  useEffect(() => {
    if (!show) return;
    // Start playing once video can play
    const vid = videoRef.current;
    if (!vid) return;

    const onCanPlay = () => setPhase('playing');
    const onTimeUpdate = () => {
      if (!vid || !progressRef.current) return;
      const pct = (vid.currentTime / vid.duration) * 100;
      progressRef.current.style.width = `${pct}%`;
    };
    const onEnded = () => dismiss();

    vid.addEventListener('canplaythrough', onCanPlay);
    vid.addEventListener('timeupdate', onTimeUpdate);
    vid.addEventListener('ended', onEnded);
    const fallbackTimer = window.setTimeout(() => setPhase('playing'), 900);
    return () => {
      window.clearTimeout(fallbackTimer);
      vid.removeEventListener('canplaythrough', onCanPlay);
      vid.removeEventListener('timeupdate', onTimeUpdate);
      vid.removeEventListener('ended', onEnded);
    };
  // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [show]);

  const dismiss = () => {
    setPhase('exiting');
    sessionStorage.setItem('heyazah_entrance_seen', 'true');
    document.body.style.overflow = '';
    setTimeout(() => setShow(false), 1200);
  };

  if (!show) return null;

  const ease = [0.16, 1, 0.3, 1] as const;

  return (
    <AnimatePresence>
      {show && (
        <motion.div
          className="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-heyazah-primary"
          initial={{ opacity: 1 }}
          exit={{ opacity: 0 }}
          transition={{ duration: 0.6 }}
        >
          {/* Top half curtain */}
          <motion.div
            className="absolute top-0 left-0 right-0 z-20 bg-heyazah-primary"
            initial={{ height: '0%' }}
            animate={phase === 'exiting' ? { height: '50%', y: '-100%' } : { height: '0%' }}
            transition={{ duration: 1.0, ease }}
          />
          {/* Bottom half curtain */}
          <motion.div
            className="absolute bottom-0 left-0 right-0 z-20 bg-heyazah-primary"
            initial={{ height: '0%' }}
            animate={phase === 'exiting' ? { height: '50%', y: '100%' } : { height: '0%' }}
            transition={{ duration: 1.0, ease }}
          />

          {/* Video */}
          <motion.div
            className="absolute inset-0 z-10 flex items-center justify-center bg-heyazah-primary"
            animate={phase === 'exiting' ? { scale: 1.03, opacity: 0 } : { scale: 1, opacity: 1 }}
            transition={{ duration: 1.0, ease }}
          >
            <video
              ref={videoRef}
              src="/assets/videos/entrance.mp4"
              autoPlay
              muted
              playsInline
              preload="auto"
              className="h-full w-full object-contain"
            />
            {/* Gradient overlay for text legibility */}
            <div className="absolute inset-0 bg-gradient-to-t from-heyazah-primary/70 via-heyazah-primary/5 to-heyazah-primary/25" />
          </motion.div>

          {/* Central branding */}
          <motion.div
            className="relative z-30 flex flex-col items-center text-center pointer-events-none"
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 1.0, delay: 0.3, ease }}
          >
            <p className="px-6 text-xs md:text-sm uppercase tracking-[0.28em] md:tracking-[0.4em] text-heyazah-accent mb-4">
              {locale === 'ar' ? 'حيازة للتطوير العقاري' : 'Heyazah Real Estate Development'}
            </p>
            <h2 className="px-6 text-3xl md:text-5xl lg:text-6xl font-bold text-heyazah-paper leading-tight max-w-3xl">
              {locale === 'ar'
                ? 'نبني وجهات المستقبل'
                : 'Building the destinations of tomorrow'}
            </h2>
          </motion.div>

          {/* Bottom controls */}
          <div className="absolute bottom-0 left-0 right-0 z-30 p-5 md:p-8">
            {/* Progress bar */}
            <div className="mx-auto max-w-md mb-6">
              <div className="h-[2px] w-full bg-heyazah-paper/10 rounded-full overflow-hidden">
                <div
                  ref={progressRef}
                  className="h-full bg-heyazah-accent transition-[width] duration-100 ease-linear"
                  style={{ width: '0%' }}
                />
              </div>
            </div>

            {/* Skip button */}
            <div className="flex justify-center">
              <button
                onClick={dismiss}
                className="group relative rounded-full bg-heyazah-paper/10 border border-heyazah-paper/20 px-8 py-3 text-sm font-semibold tracking-wider text-heyazah-paper backdrop-blur-md transition-all duration-500 hover:bg-heyazah-paper/25 hover:scale-105 hover:border-heyazah-accent/40"
              >
                <span className="flex items-center gap-2">
                  {locale === 'ar' ? 'تخطي واكتشف' : 'Skip & Explore'}
                  <motion.span
                    className="inline-block"
                    animate={{ x: [0, 4, 0] }}
                    transition={{ repeat: Infinity, duration: 1.5, ease: 'easeInOut' }}
                  >
                    {locale === 'ar' ? '←' : '→'}
                  </motion.span>
                </span>
              </button>
            </div>
          </div>
        </motion.div>
      )}
    </AnimatePresence>
  );
}
