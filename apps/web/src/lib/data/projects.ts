import raw from '@migration/projects.json';
import type { Locale } from '@/lib/i18n/locales';

// projects.json is { meta, taxonomies, counts, projects: [...] }
// We only export the array + a couple helpers off the taxonomy index.

// Relaxed type — projects.json grows over time
export type Project = {
  id?: number | string;
  slug: string;
  name?: { ar?: string | null; en?: string | null };
  display_name?: string;
  type?: string;
  status?: string;
  sector?: string;
  location?: { ar?: string | null; en?: string | null };
  location_short?: string;
  metrics?: Record<string, number | string | null>;
  icon_metrics?: Array<{ icon: string; label_ar?: string; label_en?: string; value?: string | number | null }>;
  description?: Record<string, any>;
  images?: { hero?: string | null; hero_path?: string | null; icon?: string | null; gallery_count?: number; gallery?: string[] };
  media?: Record<string, any>;
  // Raw Google Maps iframe HTML blob as it appears in projects.json, or null.
  // Renderers must use dangerouslySetInnerHTML — this is not a plain URL.
  map_embed?: string | null;
  developer?: string | null;
  units?: any[];
  source?: string;
  is_placeholder?: boolean;
  // Array of fill-in items emitted by the migration pipeline. Older schemas
  // also used { missing_items: string[] }; both shapes accepted for safety.
  fill_in_checklist?:
    | Array<{ field?: string; label?: string; done?: boolean }>
    | { missing_items?: string[] }
    | null;
  cta_for_visitor?: Record<string, any>;
  [k: string]: any;
};

// eslint-disable-next-line @typescript-eslint/no-explicit-any
const doc = raw as any;
const list: Project[] = Array.isArray(doc) ? doc : Array.isArray(doc?.projects) ? doc.projects : [];

export const meta = (doc && doc.meta) || {};
export const taxonomies = (doc && doc.taxonomies) || {};

export const all: Project[] = list;
export const portfolio: Project[] = all.filter((p) => !p.is_placeholder);
export const pipeline: Project[] = all.filter((p) => p.is_placeholder);
export const featured: Project[] = portfolio.slice(0, 6);
export const deliveredProjects: Project[] = all.filter((p) => p.status === 'old');
export const continuingProjects: Project[] = all.filter((p) => p.status === 'continuing');
export const visionProjects: Project[] = all.filter((p) => p.status === 'new');

const localProjectImagesBySlug: Record<string, string> = {
  'كايـنات': '/assets/uploads/projects/img580.jpg',
  'english-lex': '/assets/uploads/projects/85b939_a90f844079f14ea791df33c33d93bbe5~mv2.avif',
  'برايم-سكوير': '/assets/uploads/projects/59c26c_8be9c247fe5a4ec785cae554ed3e8d3a~mv2.avif',
  'business-yard': '/assets/uploads/projects/59c26c_0609c0877ccf4e5f85ed0db7d128bd80~mv2.avif',
  'livin-by-heyazah': '/assets/uploads/projects/img1181.jpg',
  'مسار-مكة': '/assets/uploads/projects/img1237.jpg',
  'بارك-سايد': '/assets/uploads/projects/img598.jpg',
  'سكاي-لاين': '/assets/uploads/projects/screenshot_816.png',
};

const localProjectImages = [
  '/assets/uploads/projects/project-aerial.png',
  '/assets/uploads/projects/1000050045-min_edited.avif',
  '/assets/uploads/projects/1000050045-min_edited (1).avif',
  '/assets/uploads/projects/1000050045-min_edited (2).avif',
  '/assets/uploads/projects/1000050045-min_edited (3).avif',
  '/assets/uploads/projects/1000050045-min_edited (4).avif',
  '/assets/uploads/projects/1000050045-min_edited (5).avif',
];

export function bySlug(slug: string): Project | undefined {
  return all.find((p) => p.slug === slug);
}

export function byStatus(status: string): Project[] {
  return all.filter((p) => p.status === status);
}

export function byType(type: string): Project[] {
  return all.filter((p) => p.type === type);
}

export function displayName(project: Project, locale: Locale): string {
  return project?.name?.[locale] ?? project?.display_name ?? project?.slug ?? '—';
}

export function displayLocation(project: Project, locale: Locale): string {
  const loc = project?.location?.[locale];
  if (loc) return loc;
  const short = project?.location_short;
  if (typeof short === 'string') return short;
  if (short && typeof short === 'object') return short[locale] ?? '';
  return '';
}

export function projectHeroImage(project: Project, fallbackIndex = 0): string {
  const direct = project.images?.hero_path || project.images?.hero;
  if (direct && !direct.includes('/wp-content/uploads/') && !direct.startsWith('2026/')) {
    return direct;
  }
  return localProjectImagesBySlug[project.slug] || localProjectImages[fallbackIndex % localProjectImages.length];
}

export function projectGalleryImages(project: Project, fallbackIndex = 0): string[] {
  const gallery = (project.images?.gallery ?? [])
    .map((item: any) => (typeof item === 'string' ? item : item?.url ?? item?.path ?? ''))
    .filter((src: string) => src && !src.includes('/wp-content/uploads/') && !src.startsWith('2026/'));

  if (gallery.length) return gallery;

  const hero = projectHeroImage(project, fallbackIndex);
  return [hero, ...localProjectImages]
    .filter((src, index, arr) => src && arr.indexOf(src) === index)
    .slice(0, 6);
}

export function projectHasMetrics(project: Project): boolean {
  const metrics = project.metrics ?? {};
  return Object.values(metrics).some((value) => value !== null && value !== undefined && value !== '');
}

export function statusNarrative(project: Project, locale: Locale): string {
  if (project.status === 'old') {
    return locale === 'ar'
      ? 'جزء من طبقة الإنجاز: مشروع يثبت قدرة حيازة على التسليم وبناء القيمة طويلة الأمد.'
      : 'Part of the proof-of-delivery layer: a project that demonstrates Heyazah execution and long-term value creation.';
  }
  if (project.status === 'continuing') {
    return locale === 'ar'
      ? 'جزء من طبقة الزخم: مشروع قيد التطوير يوضح اتجاه المحفظة وحجمها القادم.'
      : 'Part of the momentum layer: an active development that shows the portfolio moving into its next scale.';
  }
  return locale === 'ar'
    ? 'جزء من طبقة الرؤية: فرصة قادمة تُعرض مبكراً قبل اكتمال التفاصيل الرسمية.'
    : 'Part of the vision layer: an upcoming opportunity presented early while the official details mature.';
}

export function description(project: Project, locale: Locale, key: 'hero' | 'subtitle' | 'business_destination_des' = 'hero'): string {
  const d = project?.description?.[key];
  if (!d) return '';
  if (typeof d === 'string') return d;
  return d[locale] ?? d.en ?? '';
}

export function stats() {
  return {
    total: all.length,
    delivered: byStatus('old').length,
    underDevelopment: byStatus('continuing').length,
    pipeline: pipeline.length,
    commercial: byType('commercial').length,
    residential: byType('residential').length,
  };
}
