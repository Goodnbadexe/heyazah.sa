import { logos } from '@/lib/data/icons';
import { cn } from '@/lib/utils';

type Variant = keyof typeof logos;

export function Logo({
  variant = 'primary_horizontal',
  className,
  alt = 'Heyazah',
}: {
  variant?: 'horizontal' | 'stacked' | 'mark' | 'mono' | 'icon' | 'footer' | 'primary_horizontal';
  className?: string;
  alt?: string;
}) {
  const map: Record<string, Variant> = {
    horizontal: 'primary_horizontal',
    stacked: 'primary_stacked',
    mark: 'mark',
    mono: 'mono',
    icon: 'icon',
    footer: 'footer_logo',
    primary_horizontal: 'primary_horizontal',
  };
  const key = map[variant] ?? 'primary_horizontal';
  const src = '/' + (logos as Record<string, string>)[key];
  // eslint-disable-next-line @next/next/no-img-element
  return <img src={src} alt={alt} className={cn('select-none', className)} />;
}
