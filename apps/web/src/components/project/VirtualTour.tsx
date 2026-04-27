import { Icon } from '@/components/brand/Icon';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';
import type { Project } from '@/lib/data/projects';

export function VirtualTour({ project, locale }: { project: Project; locale: Locale }) {
  const tour = project.media?.virtual_tour_url;
  const video = project.media?.video_url;
  const brochure = project.media?.brochure_url;
  if (!tour && !video && !brochure) return null;

  return (
    <section className="container py-12">
      <div className="flex flex-wrap gap-3">
        {tour && (
          <a
            href={tour}
            target="_blank"
            rel="noopener noreferrer"
            className="inline-flex items-center gap-2 rounded-full bg-heyazah-primary px-5 py-3 text-sm font-semibold text-heyazah-paper shadow-card transition-colors hover:bg-heyazah-accent"
          >
            <Icon id="ui.eye-white" className="h-4 w-4" />
            {t(locale, 'cta.tour')}
          </a>
        )}
        {video && (
          <a
            href={video}
            target="_blank"
            rel="noopener noreferrer"
            className="inline-flex items-center gap-2 rounded-full border border-heyazah-primary bg-heyazah-paper px-5 py-3 text-sm font-semibold text-heyazah-primary transition-colors hover:bg-heyazah-fog"
          >
            <Icon id="ui.video" className="h-4 w-4" />
            {locale === 'ar' ? 'فيديو' : 'Video'}
          </a>
        )}
        {brochure && (
          <a
            href={brochure}
            target="_blank"
            rel="noopener noreferrer"
            className="inline-flex items-center gap-2 rounded-full border border-heyazah-warm bg-heyazah-paper px-5 py-3 text-sm font-semibold text-heyazah-primary transition-colors hover:bg-heyazah-warm"
          >
            <Icon id="ui.envelope" className="h-4 w-4" />
            {t(locale, 'cta.brochure')}
          </a>
        )}
      </div>
    </section>
  );
}
