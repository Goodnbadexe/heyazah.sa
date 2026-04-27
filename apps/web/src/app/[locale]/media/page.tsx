import { all, projectHeroImage } from '@/lib/data/projects';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

export default async function MediaPage({
  params,
}: {
  params: Promise<{ locale: Locale }>;
}) {
  const { locale } = await params;
  const items = all
    .filter((p) => p.media?.video_url || p.media?.virtual_tour_url || p.media?.brochure_url)
    .map((p, index) => ({
      slug: p.slug,
      name: p.name?.[locale] ?? p.display_name ?? p.slug,
      video: p.media?.video_url,
      tour: p.media?.virtual_tour_url,
      brochure: p.media?.brochure_url,
      hero: projectHeroImage(p, index),
    }));
  return (
    <>
      <section className="bg-heyazah-fog py-24">
        <div className="container max-w-3xl">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-accent">{t(locale, 'nav.media')}</p>
          <h1 className="mt-2 text-5xl md:text-7xl">{t(locale, 'nav.media')}</h1>
          <p className="mt-4 text-lg text-heyazah-ink/75">
            {locale === 'ar'
              ? 'فيديوهات وجولات افتراضية وكتيبات رسمية لمشاريع حيازة.'
              : 'Videos, virtual tours and official brochures across Heyazah projects.'}
          </p>
        </div>
      </section>
      <section className="container py-16">
        {items.length === 0 ? (
          <p className="text-sm text-heyazah-ink/60">
            {locale === 'ar' ? 'لا توجد مواد إعلامية مرتبطة بعد.' : 'No media is attached yet.'}
          </p>
        ) : (
          <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {items.map((i) => (
              <article
                key={i.slug}
                className="overflow-hidden rounded-2xl border border-heyazah-fog bg-heyazah-paper shadow-card"
              >
                <div className="aspect-video bg-heyazah-fog">
                  {i.hero && (
                    // eslint-disable-next-line @next/next/no-img-element
                    <img src={i.hero} alt="" className="h-full w-full object-cover" />
                  )}
                </div>
                <div className="space-y-2 p-5">
                  <h3 className="text-xl text-heyazah-primary">{i.name}</h3>
                  <div className="flex flex-wrap gap-2 text-xs font-semibold">
                    {i.tour && (
                      <a
                        href={i.tour}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="rounded-full bg-heyazah-primary px-3 py-1 text-heyazah-paper"
                      >
                        {t(locale, 'cta.tour')}
                      </a>
                    )}
                    {i.video && (
                      <a
                        href={i.video}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="rounded-full border border-heyazah-primary px-3 py-1 text-heyazah-primary"
                      >
                        {locale === 'ar' ? 'فيديو' : 'Video'}
                      </a>
                    )}
                    {i.brochure && (
                      <a
                        href={i.brochure}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="rounded-full border border-heyazah-warm px-3 py-1 text-heyazah-primary"
                      >
                        {t(locale, 'cta.brochure')}
                      </a>
                    )}
                  </div>
                </div>
              </article>
            ))}
          </div>
        )}
      </section>
    </>
  );
}
