import Link from 'next/link';
import { displayName, displayLocation, projectHeroImage, type Project } from '@/lib/data/projects';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';
import { cn } from '@/lib/utils';

export function ProjectCard({ project, locale }: { project: Project; locale: Locale }) {
  const name = displayName(project, locale);
  const loc = displayLocation(project, locale);
  const status = project.status as keyof typeof import('@/lib/i18n/dictionary').dict.status;
  const type = project.type as keyof typeof import('@/lib/i18n/dictionary').dict.type;
  const hero = projectHeroImage(project);

  return (
    <Link
      href={`/${locale}/portfolio/${project.slug}`}
      className="group relative block overflow-hidden rounded-2xl bg-heyazah-fog shadow-card transition-all duration-slow ease-dramatic hover:shadow-hover"
    >
      <div className="relative aspect-[4/5] w-full overflow-hidden bg-heyazah-fog">
        {/* eslint-disable-next-line @next/next/no-img-element */}
        <img
          src={hero}
          alt={name}
          loading="lazy"
          className="h-full w-full object-cover transition-transform duration-cinematic ease-dramatic group-hover:scale-105"
        />
        <div className="absolute inset-0 bg-gradient-to-t from-heyazah-primary/80 via-heyazah-primary/20 to-transparent" />
        <div className="absolute top-4 ltr:left-4 rtl:right-4 flex gap-2">
          <span
            className={cn(
              'rounded-full px-3 py-1 text-[11px] font-semibold uppercase tracking-wider',
              status === 'continuing' && 'bg-heyazah-accent text-heyazah-paper',
              status === 'old' && 'bg-heyazah-ink/70 text-heyazah-paper',
              status === 'new' && 'bg-heyazah-warm text-heyazah-primary',
            )}
          >
            {t(locale, `status.${status}`)}
          </span>
          <span className="rounded-full bg-heyazah-paper/90 px-3 py-1 text-[11px] font-semibold text-heyazah-primary">
            {t(locale, `type.${type}`)}
          </span>
        </div>
        <div className="absolute bottom-0 w-full p-5 text-heyazah-paper">
          <h3 className="text-xl leading-tight">{name}</h3>
          {loc && <p className="mt-1 text-sm opacity-85">{loc}</p>}
        </div>
      </div>
    </Link>
  );
}
