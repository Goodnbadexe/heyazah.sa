import { Icon } from '@/components/brand/Icon';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';

export default async function ContactPage({
  params,
  searchParams,
}: {
  params: Promise<{ locale: Locale }>;
  searchParams: Promise<{ project?: string; type?: string }>;
}) {
  const { locale } = await params;
  const { project, type } = await searchParams;
  return (
    <>
      <section className="bg-heyazah-primary py-24 text-heyazah-paper">
        <div className="container max-w-3xl">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-warm">{t(locale, 'nav.contact')}</p>
          <h1 className="mt-2 text-heyazah-paper text-5xl md:text-7xl">{t(locale, 'cta.contact')}</h1>
          {(project || type) && (
            <p className="mt-3 text-sm opacity-80">
              {project
                ? (locale === 'ar' ? `بخصوص مشروع: ${project}` : `Regarding project: ${project}`)
                : (locale === 'ar' ? 'استفسار استثماري' : 'Investor enquiry')}
            </p>
          )}
        </div>
      </section>
      <section className="container grid gap-10 py-16 md:grid-cols-2">
        <form className="space-y-4 rounded-2xl bg-heyazah-paper p-6 shadow-card" action="#" method="post">
          <label className="block">
            <span className="text-sm font-medium text-heyazah-ink/80">
              {locale === 'ar' ? 'الاسم' : 'Name'}
            </span>
            <input
              name="name"
              required
              className="mt-1 w-full rounded-lg border border-heyazah-fog bg-heyazah-paper px-3 py-2"
            />
          </label>
          <label className="block">
            <span className="text-sm font-medium text-heyazah-ink/80">
              {locale === 'ar' ? 'البريد الإلكتروني' : 'Email'}
            </span>
            <input
              type="email"
              name="email"
              required
              className="mt-1 w-full rounded-lg border border-heyazah-fog bg-heyazah-paper px-3 py-2"
            />
          </label>
          <label className="block">
            <span className="text-sm font-medium text-heyazah-ink/80">
              {locale === 'ar' ? 'الرسالة' : 'Message'}
            </span>
            <textarea
              name="message"
              rows={5}
              className="mt-1 w-full rounded-lg border border-heyazah-fog bg-heyazah-paper px-3 py-2"
            />
          </label>
          <input type="hidden" name="project" defaultValue={project ?? ''} />
          <input type="hidden" name="type" defaultValue={type ?? ''} />
          <button
            type="submit"
            className="inline-flex items-center gap-2 rounded-full bg-heyazah-primary px-6 py-3 text-sm font-semibold text-heyazah-paper shadow-card hover:bg-heyazah-accent"
          >
            {locale === 'ar' ? 'إرسال' : 'Send'}
          </button>
        </form>
        <aside className="space-y-4 text-sm text-heyazah-ink/80">
          <div className="flex items-start gap-3">
            <Icon id="ui.mail" className="mt-1 h-5 w-5" />
            <div>
              <p className="font-semibold text-heyazah-primary">
                {locale === 'ar' ? 'البريد' : 'Email'}
              </p>
              <p>info@heyazah.sa</p>
            </div>
          </div>
          <div className="flex items-start gap-3">
            <Icon id="ui.phone" className="mt-1 h-5 w-5" />
            <div>
              <p className="font-semibold text-heyazah-primary">
                {locale === 'ar' ? 'الهاتف' : 'Phone'}
              </p>
              <p>+966 · TBA</p>
            </div>
          </div>
          <div className="flex items-start gap-3">
            <Icon id="ui.map" className="mt-1 h-5 w-5" />
            <div>
              <p className="font-semibold text-heyazah-primary">
                {locale === 'ar' ? 'العنوان' : 'Address'}
              </p>
              <p>{locale === 'ar' ? 'الرياض، المملكة العربية السعودية' : 'Riyadh, Saudi Arabia'}</p>
            </div>
          </div>
        </aside>
      </section>
    </>
  );
}
