import type { Project } from '@/lib/data/projects';

// projects.json stores `map_embed` as a raw Google Maps <iframe ...> HTML blob.
// We render it as HTML so the embed URL + allowfullscreen/referrer attrs
// survive unchanged. Sanitized via a narrow allowlist to keep the surface small.
function sanitizeIframe(html: string): string {
  // Only allow a single <iframe ...></iframe> element; reject anything else.
  const match = html.match(/<iframe\b[^>]*>\s*<\/iframe>/i);
  if (!match) return '';
  // Strip any inline event handlers (onload=, onerror=, ...) defensively.
  return match[0].replace(/\son[a-z]+\s*=\s*("[^"]*"|'[^']*'|[^\s>]+)/gi, '');
}

export function MapEmbed({ project }: { project: Project }) {
  const embed = project.map_embed;
  if (!embed || typeof embed !== 'string') return null;
  const safe = sanitizeIframe(embed);
  if (!safe) return null;
  return (
    <section className="container py-12">
      <div
        className="overflow-hidden rounded-2xl border border-heyazah-fog shadow-card [&>iframe]:h-[420px] [&>iframe]:w-full [&>iframe]:border-0"
        dangerouslySetInnerHTML={{ __html: safe }}
      />
    </section>
  );
}
