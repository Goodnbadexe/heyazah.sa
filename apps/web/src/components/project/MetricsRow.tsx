import { Icon } from '@/components/brand/Icon';
import { t } from '@/lib/i18n/dictionary';
import type { Locale } from '@/lib/i18n/locales';
import { formatNumber, formatDate } from '@/lib/utils';
import type { Project } from '@/lib/data/projects';

type Row = { icon: string; label: string; value: string };

function rows(project: Project, locale: Locale): Row[] {
  const m = project.metrics ?? {};
  const out: Row[] = [];
  if (m.total_units) out.push({ icon: 'amenity.key', label: t(locale, 'metrics.units'), value: formatNumber(m.total_units, locale) });
  if (m.parking_spaces) out.push({ icon: 'amenity.parking', label: t(locale, 'metrics.parking'), value: formatNumber(m.parking_spaces, locale) });
  if (m.office_area_m2) out.push({ icon: 'amenity.desk', label: t(locale, 'metrics.office'), value: `${formatNumber(m.office_area_m2, locale)} m²` });
  if (m.rental_area_m2) out.push({ icon: 'amenity.building', label: t(locale, 'metrics.retail'), value: `${formatNumber(m.rental_area_m2, locale)} m²` });
  if (m.commercial_galleries_m2) out.push({ icon: 'amenity.store', label: locale === 'ar' ? 'صالات تجارية' : 'Galleries', value: `${formatNumber(m.commercial_galleries_m2, locale)} m²` });
  if (m.starting_price_sar) out.push({ icon: 'ui.star', label: t(locale, 'metrics.starting'), value: `${formatNumber(m.starting_price_sar, locale)} SAR` });
  if (m.delivery_date_yyyymmdd) out.push({ icon: 'ui.calendar', label: t(locale, 'metrics.delivery'), value: formatDate(m.delivery_date_yyyymmdd, locale) });
  return out;
}

export function MetricsRow({ project, locale }: { project: Project; locale: Locale }) {
  const r = rows(project, locale);
  if (!r.length) return null;
  return (
    <ul className="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
      {r.map((row) => (
        <li
          key={row.label}
          className="flex items-center gap-3 rounded-xl border border-heyazah-fog bg-heyazah-paper p-4 shadow-card"
        >
          <Icon id={row.icon} className="h-7 w-7" />
          <div className="min-w-0">
            <p className="text-xs uppercase tracking-wider text-heyazah-ink/60">{row.label}</p>
            <p className="truncate text-lg font-semibold text-heyazah-primary">{row.value}</p>
          </div>
        </li>
      ))}
    </ul>
  );
}
