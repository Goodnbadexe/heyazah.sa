'use client';

import { useState, useRef, useEffect, useCallback } from 'react';
import { createPortal } from 'react-dom';
import Link from 'next/link';
import { motion, AnimatePresence, useReducedMotion } from 'framer-motion';
import { all, displayName, displayLocation, projectHeroImage, type Project } from '@/lib/data/projects';
import type { Locale } from '@/lib/i18n/locales';

/**
 * Expansive Search Modal — full-screen, immersive search experience.
 * Opens from compact pill, expands with smooth transition.
 */
export function SearchModal({ locale }: { locale: Locale }) {
  const [isOpen, setIsOpen] = useState(false);
  const [query, setQuery] = useState('');
  const [mounted, setMounted] = useState(false);
  const inputRef = useRef<HTMLInputElement>(null);
  const prefersReduced = useReducedMotion();
  const ease = [0.16, 1, 0.3, 1] as const;

  useEffect(() => {
    setMounted(true);
  }, []);

  const open = useCallback(() => {
    setIsOpen(true);
    setQuery('');
  }, []);

  const close = useCallback(() => {
    setIsOpen(false);
    setQuery('');
  }, []);

  useEffect(() => {
    if (isOpen) {
      document.body.style.overflow = 'hidden';
      const timer = setTimeout(() => inputRef.current?.focus(), 400);
      return () => clearTimeout(timer);
    } else {
      document.body.style.overflow = '';
    }
    return () => { document.body.style.overflow = ''; };
  }, [isOpen]);

  useEffect(() => {
    const handler = (e: KeyboardEvent) => {
      if (e.key === 'Escape' && isOpen) close();
      if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
        e.preventDefault();
        isOpen ? close() : open();
      }
    };
    window.addEventListener('keydown', handler);
    return () => window.removeEventListener('keydown', handler);
  }, [isOpen, open, close]);

  const filtered = query.trim()
    ? all.filter((p) => {
        const q = query.toLowerCase();
        const name = displayName(p, locale).toLowerCase();
        const loc = displayLocation(p, locale).toLowerCase();
        return name.includes(q) || loc.includes(q) || p.slug?.includes(q);
      }).slice(0, 10)
    : [];

  return (
    <>
      {/* Search trigger — compact pill */}
      <button
        onClick={open}
        id="search-trigger"
        className="group flex items-center gap-2 rounded-full border border-heyazah-fog bg-heyazah-fog/40 px-3.5 py-2 text-sm text-heyazah-ink/50 transition-all duration-400 hover:border-heyazah-accent/30 hover:bg-heyazah-accent/5 hover:text-heyazah-accent"
        aria-label={locale === 'ar' ? 'بحث' : 'Search'}
      >
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" className="transition-transform duration-300 group-hover:scale-110">
          <circle cx="11" cy="11" r="8" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
        <span className="hidden md:inline text-xs font-medium">
          {locale === 'ar' ? 'بحث' : 'Search'}
        </span>
        <kbd className="hidden lg:inline-flex items-center rounded bg-heyazah-fog/60 px-1.5 py-0.5 text-[10px] font-mono text-heyazah-ink/30">
          ⌘K
        </kbd>
      </button>

      {/* Full-screen overlay */}
      {mounted && createPortal(
      <AnimatePresence>
        {isOpen && (
          <motion.div
            className="fixed inset-0 z-[999] flex flex-col backdrop-blur-xl"
            style={{ backgroundColor: 'rgba(8, 43, 42, 0.98)' }}
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            transition={{ duration: 0.35, ease }}
          >
            <div className="pointer-events-none absolute inset-0 overflow-hidden">
              <div className="absolute inset-0 bg-heyazah-primary" />
              <div className="absolute -right-32 top-10 h-[420px] w-[420px] rounded-full bg-heyazah-accent/10 blur-[120px]" />
              <div className="absolute -left-24 bottom-0 h-[360px] w-[360px] rounded-full bg-heyazah-warm/10 blur-[120px]" />
            </div>

            {/* Top bar */}
            <div className="container relative z-10 flex justify-between items-center pt-6 pb-4 border-b border-heyazah-paper/10">
              <span className="text-xs uppercase tracking-[0.3em] text-heyazah-paper/30 font-medium">
                {locale === 'ar' ? 'بحث في المشاريع' : 'Search projects'}
              </span>
              <button
                onClick={close}
                className="flex items-center gap-2 rounded-full px-4 py-2 text-sm text-heyazah-paper/50 transition-colors hover:text-heyazah-paper hover:bg-heyazah-paper/10"
                aria-label="Close search"
              >
                <span className="text-xs hidden md:inline">ESC</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                  <line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" />
                </svg>
              </button>
            </div>

            {/* Search input */}
            <div className="container relative z-10 pt-8 md:pt-16">
              <motion.div
                className="relative"
                initial={prefersReduced ? {} : { opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.5, delay: 0.1, ease }}
              >
                <div className="flex items-center gap-4 border-b-2 border-heyazah-paper/15 pb-4 focus-within:border-heyazah-accent transition-colors duration-500">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="text-heyazah-paper/30 flex-shrink-0">
                    <circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
                  </svg>
                  <input
                    ref={inputRef}
                    type="text"
                    value={query}
                    onChange={(e) => setQuery(e.target.value)}
                    placeholder={locale === 'ar' ? 'ابحث عن مشروع...' : 'Search for a project...'}
                    className="w-full bg-transparent text-2xl md:text-4xl lg:text-5xl font-bold text-heyazah-paper placeholder:text-heyazah-paper/15 outline-none caret-heyazah-accent"
                  />
                  {query && (
                    <button
                      onClick={() => setQuery('')}
                      className="flex-shrink-0 rounded-full p-1.5 text-heyazah-paper/30 hover:text-heyazah-paper hover:bg-heyazah-paper/10 transition-colors"
                    >
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
                        <line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" />
                      </svg>
                    </button>
                  )}
                </div>
              </motion.div>
            </div>

            {/* Results */}
            <div className="container relative z-10 flex-1 overflow-y-auto mt-6 md:mt-10 pb-12">
              {query.trim() && (
                <motion.p
                  className="text-xs uppercase tracking-widest text-heyazah-paper/25 mb-6"
                  initial={{ opacity: 0 }}
                  animate={{ opacity: 1 }}
                >
                  {filtered.length > 0
                    ? locale === 'ar'
                      ? `${filtered.length} نتيجة`
                      : `${filtered.length} result${filtered.length !== 1 ? 's' : ''}`
                    : locale === 'ar'
                      ? 'لا توجد نتائج'
                      : 'No results found'}
                </motion.p>
              )}

              <AnimatePresence mode="popLayout">
                {filtered.map((project, i) => (
                  <SearchResultRow
                    key={project.slug}
                    project={project}
                    locale={locale}
                    index={i}
                    ease={ease}
                    prefersReduced={!!prefersReduced}
                    onSelect={close}
                  />
                ))}
              </AnimatePresence>

              {!query.trim() && (
                <motion.div
                  className="flex flex-col items-center justify-center h-40 text-center"
                  initial={{ opacity: 0 }}
                  animate={{ opacity: 1 }}
                  transition={{ delay: 0.3 }}
                >
                  <p className="text-heyazah-paper/20 text-base">
                    {locale === 'ar'
                      ? 'ابدأ بالكتابة لاستكشاف المشاريع'
                      : 'Start typing to explore projects'}
                  </p>
                </motion.div>
              )}
            </div>
          </motion.div>
        )}
      </AnimatePresence>,
      document.body,
      )}
    </>
  );
}

/* ─── Search Result Row ──────────────────────────────────────────── */

function SearchResultRow({
  project,
  locale,
  index,
  ease,
  prefersReduced,
  onSelect,
}: {
  project: Project;
  locale: Locale;
  index: number;
  ease: readonly [number, number, number, number];
  prefersReduced: boolean;
  onSelect: () => void;
}) {
  const name = displayName(project, locale);
  const location = displayLocation(project, locale);
  const hero = projectHeroImage(project, index);

  return (
    <motion.div
      initial={prefersReduced ? { opacity: 0 } : { opacity: 0, y: 15 }}
      animate={{ opacity: 1, y: 0 }}
      exit={{ opacity: 0 }}
      transition={{ duration: 0.35, delay: index * 0.04, ease }}
      layout
    >
      <Link
        href={`/${locale}/portfolio/${project.slug}`}
        onClick={onSelect}
        className="group flex items-center gap-5 py-4 border-b border-heyazah-paper/10 transition-all duration-400 hover:bg-heyazah-paper/5 rounded-lg px-3 -mx-3"
      >
        {/* Thumbnail */}
        <div className="w-16 h-12 md:w-20 md:h-14 rounded-lg overflow-hidden flex-shrink-0 ring-1 ring-heyazah-paper/10">
          {/* eslint-disable-next-line @next/next/no-img-element */}
          <img src={hero} alt="" className="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" />
        </div>

        {/* Info */}
        <div className="flex-1 min-w-0">
          <h4 className="text-lg md:text-xl font-semibold text-heyazah-paper truncate transition-colors duration-300 group-hover:text-heyazah-accent">
            {name}
          </h4>
          {location && (
            <p className="text-xs text-heyazah-paper/35 mt-0.5 truncate">{location}</p>
          )}
        </div>

        {/* Type badge */}
        <span className="hidden md:inline-block text-[10px] uppercase tracking-wider text-heyazah-paper/20 border border-heyazah-paper/10 rounded-full px-2.5 py-1">
          {project.type}
        </span>

        {/* Arrow */}
        <span className="text-heyazah-paper/15 text-lg transition-all duration-300 group-hover:text-heyazah-accent group-hover:translate-x-1 rtl:group-hover:-translate-x-1">
          {locale === 'ar' ? '←' : '→'}
        </span>
      </Link>
    </motion.div>
  );
}
