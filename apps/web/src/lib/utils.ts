import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs));
}

export function formatNumber(n: number | string | null | undefined, locale: 'ar' | 'en'): string {
  if (n === null || n === undefined || n === '') return '';
  const num = typeof n === 'string' ? Number(n) : n;
  if (!Number.isFinite(num)) return String(n);
  return num.toLocaleString(locale === 'ar' ? 'ar-SA' : 'en-US');
}

export function formatDate(yyyymmdd: number | string | null | undefined, locale: 'ar' | 'en'): string {
  if (!yyyymmdd) return '';
  const s = String(yyyymmdd);
  if (s.length !== 8) return s;
  const d = new Date(`${s.slice(0, 4)}-${s.slice(4, 6)}-${s.slice(6, 8)}`);
  return d.toLocaleDateString(locale === 'ar' ? 'ar-SA-u-ca-gregory' : 'en-US', {
    year: 'numeric',
    month: 'short',
  });
}
