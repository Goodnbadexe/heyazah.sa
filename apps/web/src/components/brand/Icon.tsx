import { iconPath } from '@/lib/data/icons';
import { cn } from '@/lib/utils';

/** Resolves a semantic id ("amenity.bed") and renders an <img>. */
export function Icon({
  id,
  className,
  alt = '',
}: {
  id: string;
  className?: string;
  alt?: string;
}) {
  const src = iconPath(id);
  if (!src) return null;
  // eslint-disable-next-line @next/next/no-img-element
  return <img src={src} alt={alt} className={cn('inline-block', className)} />;
}
