import manifest from '@migration/assets/manifest.json';

type IconEntry = { id: string; file: string; label_en?: string; label_ar?: string };

function flatten(): Record<string, IconEntry> {
  const out: Record<string, IconEntry> = {};
  const addGroup = (items: IconEntry[], prefix: string) => {
    for (const it of items) out[`${prefix}.${it.id}`] = it;
  };
  addGroup(manifest.icons.amenity.items as IconEntry[], 'amenity');
  addGroup(manifest.icons.ui.items as IconEntry[], 'ui');
  addGroup(manifest.icons.social as IconEntry[], 'social');
  addGroup(manifest.icons.stats_and_features as IconEntry[], 'stat');
  addGroup(manifest.icons.decorative as IconEntry[], 'deco');
  return out;
}

const INDEX = flatten();

/**
 * Resolves "amenity.bed" → "/assets/icons/amenity-bed.svg".
 * Returns null if id not found.
 */
export function iconPath(id: string): string | null {
  const entry = INDEX[id];
  if (!entry) return null;
  return '/' + entry.file; // served from /public/assets/...
}

export function iconLabel(id: string, locale: 'ar' | 'en' = 'en'): string {
  const entry = INDEX[id];
  if (!entry) return '';
  return locale === 'ar' ? entry.label_ar ?? '' : entry.label_en ?? '';
}

export const logos = manifest.logos;
export const allIcons = INDEX;
