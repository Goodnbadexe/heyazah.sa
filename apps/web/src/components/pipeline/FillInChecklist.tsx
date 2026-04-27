import type { Project } from '@/lib/data/projects';

/**
 * Admin-only drawer that lists unresolved fields on a placeholder project.
 * Query param ?admin=1 toggles visibility; drop in on the pipeline page.
 */
export function FillInChecklist({ project }: { project: Project }) {
  const checklist = project.fill_in_checklist;
  // The migration pipeline emits an array of { field, label, done }. Older
  // schemas used { missing_items: string[] } — support both defensively.
  const list: string[] = Array.isArray(checklist)
    ? checklist
        .filter((item) => !item?.done)
        .map((item) => item?.label ?? item?.field ?? '')
        .filter(Boolean)
    : checklist?.missing_items ?? [];
  if (!list.length) return null;

  return (
    <details className="group rounded-xl border border-heyazah-warm bg-heyazah-warm/10 p-3 text-xs">
      <summary className="cursor-pointer font-semibold text-heyazah-primary">
        Fill-in checklist ({list.length})
      </summary>
      <ul className="mt-2 list-disc space-y-1 ltr:pl-5 rtl:pr-5 text-heyazah-ink/80">
        {list.map((item) => (
          <li key={item}>{item}</li>
        ))}
      </ul>
    </details>
  );
}
