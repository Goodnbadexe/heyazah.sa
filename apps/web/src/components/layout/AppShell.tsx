'use client';

import { ReactNode, useEffect } from 'react';
import type { Locale } from '@/lib/i18n/locales';
import { useNav } from '@/contexts/NavContext';

export function AppShell({ children, locale }: { children: ReactNode; locale: Locale }) {
  const { isOpen, setIsOpen } = useNav();

  // Prevent background scroll when sidebar is open
  useEffect(() => {
    if (isOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
    return () => {
      document.body.style.overflow = '';
    };
  }, [isOpen]);

  return (
    <div
      className={`relative min-h-screen transition-transform duration-700 ease-dramatic bg-heyazah-paper ${
        isOpen
          ? locale === 'ar'
            ? '-translate-x-[360px] md:-translate-x-[400px]'
            : 'translate-x-[360px] md:translate-x-[400px]'
          : 'translate-x-0'
      }`}
    >
      {/* Overlay: clickable to close */}
      <div 
        className={`absolute inset-0 z-50 bg-heyazah-primary/20 backdrop-blur-sm transition-opacity duration-700 ${
          isOpen ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'
        }`}
        onClick={() => setIsOpen(false)}
      />
      
      {children}
    </div>
  );
}
