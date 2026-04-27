import Link from 'next/link';
import { all, projectHeroImage } from '@/lib/data/projects';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

const siteVideos = [
  {
    src: '/assets/videos/hero-loop.mp4',
    title: { ar: 'المشهد الرئيسي', en: 'Homepage cinematic' },
    body: { ar: 'فيديو يفتتح القصة الرئيسية للموقع.', en: 'The video layer that opens the main website story.' },
  },
  {
    src: '/assets/videos/orbit-showcase.mp4',
    title: { ar: 'عرض دائري', en: 'Orbit showcase' },
    body: { ar: 'لقطة للزخم والمشاريع بصيغة عرض مستمر.', en: 'A continuous showcase for project momentum and presence.' },
  },
  {
    src: '/assets/videos/projects-reel.mp4',
    title: { ar: 'شريط المشاريع', en: 'Portfolio ribbon' },
    body: { ar: 'طبقة فيديو خفيفة تربط أقسام المحفظة.', en: 'A lightweight video layer connecting portfolio sections.' },
  },
];

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
        <div className="container max-w-4xl">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-accent">{t(locale, 'nav.media')}</p>
          <h1 className="mt-3 text-5xl leading-tight text-heyazah-primary md:text-7xl">
            {locale === 'ar' ? 'مكتبة الفيديو والمواد' : 'Video and media library'}
          </h1>
          <p className="mt-5 max-w-2xl text-lg leading-8 text-heyazah-ink/75">
            {locale === 'ar'
              ? 'الفيديو في هذه النسخة ليس للزينة فقط. كل مادة يجب أن تكشف مشروعاً أو تجربة أو لحظة مهمة داخل الموقع.'
              : 'Video in this version is not decoration. Every asset should reveal a project, an experience, or a meaningful moment in the website.'}
          </p>
        </div>
      </section>

      <section className="container py-16">
        <div className="mb-8">
          <p className="text-xs uppercase tracking-[0.3em] text-heyazah-accent">
            {locale === 'ar' ? 'طبقات الموقع' : 'Website motion assets'}
          </p>
          <h2 className="mt-2 text-4xl text-heyazah-primary">
            {locale === 'ar' ? 'المواد التي تجعل الموقع حيّاً' : 'Assets making the site feel alive'}
          </h2>
        </div>
        <div className="grid gap-6 lg:grid-cols-3">
          {siteVideos.map((video) => (
            <article key={video.src} className="overflow-hidden rounded-2xl border border-heyazah-fog bg-heyazah-paper shadow-card">
              <div className="aspect-video bg-heyazah-primary">
                <video muted loop playsInline controls className="h-full w-full object-cover">
                  <source src={video.src} type="video/mp4" />
                </video>
              </div>
              <div className="p-5">
                <h3 className="text-xl text-heyazah-primary">{video.title[locale]}</h3>
                <p className="mt-2 text-sm leading-7 text-heyazah-ink/70">{video.body[locale]}</p>
              </div>
            </article>
          ))}
        </div>
      </section>

      <section className="container pb-20">
        <div className="mb-8 border-t border-heyazah-fog pt-10">
          <p className="text-xs uppercase tracking-[0.3em] text-heyazah-accent">
            {locale === 'ar' ? 'مواد المشاريع' : 'Project material'}
          </p>
          <h2 className="mt-2 text-4xl text-heyazah-primary">
            {locale === 'ar' ? 'جولات وكتيبات وروابط' : 'Tours, brochures, and links'}
          </h2>
        </div>
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
                <Link href={`/${locale}/portfolio/${i.slug}`} className="block aspect-video bg-heyazah-fog">
                  {/* eslint-disable-next-line @next/next/no-img-element */}
                  <img src={i.hero} alt="" className="h-full w-full object-cover" />
                </Link>
                <div className="space-y-3 p-5">
                  <h3 className="text-xl text-heyazah-primary">{i.name}</h3>
                  <div className="flex flex-wrap gap-2 text-xs font-semibold">
                    {i.tour && (
                      <a href={i.tour} target="_blank" rel="noopener noreferrer" className="rounded-full bg-heyazah-primary px-3 py-1 text-heyazah-paper">
                        {t(locale, 'cta.tour')}
                      </a>
                    )}
                    {i.video && (
                      <a href={i.video} target="_blank" rel="noopener noreferrer" className="rounded-full border border-heyazah-primary px-3 py-1 text-heyazah-primary">
                        {locale === 'ar' ? 'فيديو' : 'Video'}
                      </a>
                    )}
                    {i.brochure && (
                      <a href={i.brochure} target="_blank" rel="noopener noreferrer" className="rounded-full border border-heyazah-warm px-3 py-1 text-heyazah-primary">
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
