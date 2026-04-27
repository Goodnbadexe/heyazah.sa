import type { Locale } from './locales';

/**
 * Dual-language dictionary. Every surface string that is NOT sourced from
 * projects.json lives here so AR and EN stay in lockstep.
 */
export const dict = {
  site: {
    name: { ar: 'حيازة', en: 'Heyazah' },
    parent: {
      ar: 'شركة أحمد السيف وأولاده القابضة',
      en: 'Ahmed Al-Saif & Sons Holding',
    },
    tagline: {
      ar: 'منذ 2005 — نطوّر وجهات حضرية وسكنية في الرياض',
      en: 'Since 2005 — developing landmark destinations across Riyadh',
    },
  },
  nav: {
    home:       { ar: 'الرئيسية',      en: 'Home' },
    portfolio:  { ar: 'المشاريع',      en: 'Portfolio' },
    pipeline:   { ar: 'مشاريع قادمة',  en: 'Pipeline' },
    about:      { ar: 'عن حيازة',      en: 'About' },
    leadership: { ar: 'القيادة',       en: 'Leadership' },
    investors:  { ar: 'للمستثمرين',    en: 'Investors' },
    contact:    { ar: 'تواصل معنا',    en: 'Contact' },
    media:      { ar: 'المركز الإعلامي', en: 'Media' },
  },
  status: {
    old:        { ar: 'مشروع مكتمل',     en: 'Delivered' },
    continuing: { ar: 'قيد التطوير',     en: 'Under development' },
    new:        { ar: 'جديد',            en: 'New' },
    pipeline:   { ar: 'قريباً',          en: 'Coming soon' },
    'sold-out': { ar: 'مكتمل البيع',     en: 'Sold out' },
  },
  type: {
    commercial:  { ar: 'تجاري',      en: 'Commercial' },
    residential: { ar: 'سكني',        en: 'Residential' },
    mixed:       { ar: 'مختلط',       en: 'Mixed-use' },
  },
  metrics: {
    units:     { ar: 'الوحدات',        en: 'Units' },
    parking:   { ar: 'مواقف السيارات', en: 'Parking' },
    office:    { ar: 'المساحات المكتبية', en: 'Office area' },
    retail:    { ar: 'المساحات التجارية', en: 'Retail' },
    delivery:  { ar: 'موعد التسليم',   en: 'Delivery' },
    starting:  { ar: 'السعر يبدأ من',  en: 'Starting from' },
  },
  cta: {
    explore:   { ar: 'اكتشف المشروع', en: 'Explore project' },
    contact:   { ar: 'تواصل معنا',    en: 'Get in touch' },
    register:  { ar: 'سجّل اهتمامك',  en: 'Register interest' },
    tour:      { ar: 'جولة افتراضية', en: 'Virtual tour' },
    brochure:  { ar: 'تحميل الكتيب',  en: 'Download brochure' },
  },
} as const;

export function t(locale: Locale, path: string): string {
  const parts = path.split('.');
  let cur: any = dict;
  for (const p of parts) cur = cur?.[p];
  if (!cur) return path;
  if (typeof cur === 'string') return cur;
  return cur[locale] ?? cur.en ?? path;
}
