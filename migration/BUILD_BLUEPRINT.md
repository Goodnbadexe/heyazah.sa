# Heyazah Build Blueprint

**Version:** 1.0 · 2026-04-18  
**Owners:** Goodnbad + engineering  
**Purpose:** Single source of truth for building the new Heyazah presence. It walks from the migration JSON we already produced all the way to a Next.js 15 preview **and** a WordPress theme `.zip` that ships the same data and visual language.

---

## 0. Guiding principles

1. **One data model, two runtimes.** `projects.json`, `brand_tokens.json`, and `assets/manifest.json` feed both the Next.js app and the WordPress theme. No copy/paste content.
2. **Preview first, WP second.** Ship the Next.js site for review; generate the WordPress theme from the same source once the preview is approved.
3. **No legacy theme reuse.** We read the old theme for *data and assets*, we do not run its PHP, its page builders, or its layouts. See `HEYAZAH_MIGRATION_REPORT.md` §6.
4. **Dual language is a first-class citizen.** Arabic and English share equal priority. URLs split at the root (`/ar/…` and `/en/…`). Every piece of copy has both keys.
5. **Placeholders are visible.** Pipeline projects render as "coming soon" cards and show a checklist to the admin, never silently break.

---

## 1. Repository layout

```
heyazah/
├── migration/                       # (already delivered)
│   ├── projects.json                # 38 records (18 real + 20 placeholder)
│   ├── acf_schema.json
│   ├── brand_tokens.json
│   ├── brand_tokens.css
│   ├── tailwind-tokens.js
│   ├── flags.json
│   ├── assets/
│   │   ├── logos/                   # 7 SVG logo variants
│   │   ├── icons/                   # 70 semantic SVGs (amenity/ui/social/...)
│   │   ├── fonts/                   # 13 font files (Arabic + Latin)
│   │   ├── brand-guidelines/        # PDF + report.txt
│   │   └── manifest.json            # indexed catalog
│   └── HEYAZAH_MIGRATION_REPORT.md
│
├── apps/
│   └── web/                         # Next.js 15 preview (this blueprint)
│       ├── src/
│       │   ├── app/
│       │   │   ├── layout.tsx                 # <html dir> + font loading
│       │   │   ├── [locale]/                  # ar | en
│       │   │   │   ├── layout.tsx
│       │   │   │   ├── page.tsx               # Home
│       │   │   │   ├── portfolio/
│       │   │   │   │   ├── page.tsx           # Portfolio index + filters
│       │   │   │   │   └── [slug]/page.tsx    # Single project template
│       │   │   │   ├── pipeline/page.tsx      # Pipeline showcase
│       │   │   │   ├── about/page.tsx
│       │   │   │   ├── leadership/page.tsx
│       │   │   │   ├── investors/page.tsx
│       │   │   │   ├── contact/page.tsx
│       │   │   │   └── media/page.tsx
│       │   │   └── api/
│       │   │       └── revalidate/route.ts    # ISR hook for WP sync
│       │   ├── components/
│       │   │   ├── primitives/                # shadcn/ui re-exports (button, card, tabs, ...)
│       │   │   ├── brand/
│       │   │   │   ├── Logo.tsx               # switches variant by context
│       │   │   │   ├── Icon.tsx               # resolves from manifest.json
│       │   │   │   └── TokensProvider.tsx     # injects CSS vars per theme
│       │   │   ├── layout/
│       │   │   │   ├── Header.tsx
│       │   │   │   ├── Footer.tsx
│       │   │   │   └── LocaleSwitcher.tsx
│       │   │   ├── project/
│       │   │   │   ├── ProjectCard.tsx
│       │   │   │   ├── ProjectHero.tsx
│       │   │   │   ├── MetricsRow.tsx
│       │   │   │   ├── Gallery.tsx
│       │   │   │   ├── MapEmbed.tsx
│       │   │   │   ├── VirtualTour.tsx
│       │   │   │   └── PlaceholderCard.tsx    # pipeline/coming soon variant
│       │   │   ├── pipeline/
│       │   │   │   ├── PipelineTicker.tsx
│       │   │   │   └── FillInChecklist.tsx    # admin-only; surfaces missing_items
│       │   │   ├── home/
│       │   │   │   ├── Hero.tsx
│       │   │   │   ├── PortfolioStrip.tsx
│       │   │   │   ├── StatsBand.tsx
│       │   │   │   └── LatestMedia.tsx
│       │   │   └── motion/
│       │   │       ├── RevealOnScroll.tsx     # Framer Motion
│       │   │       ├── ParallaxLayer.tsx      # GSAP ScrollTrigger
│       │   │       └── LottieIcon.tsx
│       │   ├── lib/
│       │   │   ├── data/
│       │   │   │   ├── projects.ts            # loads /migration/projects.json at build
│       │   │   │   ├── brand.ts               # loads brand_tokens.json
│       │   │   │   └── icons.ts               # loads assets/manifest.json
│       │   │   ├── i18n/
│       │   │   │   ├── dictionary.ts
│       │   │   │   ├── locales.ts             # ['ar','en']
│       │   │   │   └── direction.ts           # 'rtl' | 'ltr'
│       │   │   └── utils.ts
│       │   └── styles/
│       │       ├── globals.css                # imports brand_tokens.css
│       │       └── fonts.css                  # @font-face generated from manifest
│       ├── public/
│       │   └── (symlinked or copied) assets/  # logos, icons, fonts
│       ├── next.config.mjs
│       ├── tailwind.config.ts                 # imports migration/tailwind-tokens.js
│       ├── postcss.config.mjs
│       ├── tsconfig.json
│       └── package.json
│
└── apps/
    └── wp-theme/                    # WordPress theme export (stage 2)
        ├── heyazah/                 # our new theme — NOT the old one
        │   ├── style.css            # theme header + brand_tokens.css
        │   ├── functions.php
        │   ├── theme.json           # FSE tokens mirrored from brand_tokens.json
        │   ├── inc/
        │   │   ├── cpt.php          # registers project, unit, media_center
        │   │   ├── taxonomies.php   # project_category, project_status, sector, ...
        │   │   ├── acf-fields.php   # ACF JSON import path
        │   │   └── enqueue.php
        │   ├── acf-json/            # ACF local-json — exported from migration/acf_schema.json
        │   ├── parts/
        │   ├── patterns/            # FSE block patterns matching Next components
        │   ├── templates/
        │   │   ├── single-project.html
        │   │   ├── archive-project.html
        │   │   └── page-pipeline.html
        │   └── assets/              # copy from migration/assets
        │
        ├── heyazah-importer/        # companion plugin
        │   ├── heyazah-importer.php # adds "Heyazah → Import" admin screen
        │   ├── includes/
        │   │   ├── class-importer.php      # reads projects.json → wp_insert_post
        │   │   ├── class-media-sideloader.php
        │   │   └── class-placeholder-seed.php
        │   └── data/
        │       └── projects.json    # bundled copy of migration/projects.json
        │
        └── README.md                # install order: plugin, theme, run importer
```

---

## 2. Stage 1 — Next.js 15 preview

### 2.1 Stack

| Layer | Choice | Why |
|---|---|---|
| Framework | Next.js 15 (App Router, RSC) | Static-first, SEO, trivial to publish |
| Styling | Tailwind + shadcn/ui | Mapped onto our tokens |
| State | React Server Components + `use()` | No client state store needed |
| i18n | `next-intl` | Dual routing + RTL helper |
| Motion (scroll/content) | GSAP + ScrollTrigger | Cinematic hero, portfolio reveals |
| Motion (UI) | Framer Motion | Page transitions, hover, stagger |
| Motion (micro) | Lottie | Loader, status indicators |
| Forms | React Hook Form + Zod | Contact, investor enquiry |
| Analytics | GA4 + Plausible (optional) | Both supported, configurable |

### 2.2 Bootstrapping order

1. `pnpm create next-app@15 apps/web --ts --tailwind --app --eslint --src-dir --import-alias "@/*"`
2. `pnpm add next-intl class-variance-authority clsx tailwind-merge lucide-react gsap framer-motion lottie-react zod react-hook-form`
3. `pnpm dlx shadcn@latest init` (select *Default*, dark-mode disabled — we control palette)
4. Copy `migration/assets/*` into `apps/web/public/assets/`.
5. Merge `migration/brand_tokens.css` into `src/styles/globals.css` via `@import`.
6. Replace `tailwind.config.ts` `theme.extend` with `require('../../migration/tailwind-tokens.js').theme`.
7. Generate `src/styles/fonts.css` from `manifest.json` (script in §2.6).
8. Add a data loader that imports `migration/projects.json` at build time and provides typed accessors.

### 2.3 Routing & i18n

- Root redirect (`/`) → locale auto-detect → `/ar` by default, fallback `/en`.
- Every page lives under `src/app/[locale]/...`. `middleware.ts` rewrites `/` to `/{defaultLocale}`.
- `layout.tsx` at `[locale]` sets `<html lang={locale} dir={direction(locale)}>`.
- A `LocaleSwitcher` component writes the counterpart path so `/ar/portfolio/ventora` ↔ `/en/portfolio/ventora` preserves slug.
- Slugs come from `projects.json:slug`; we do **not** rewrite per-locale slugs — brand names stay identical across languages.

### 2.4 Page-by-page build order

| # | Route | Source data | Notes |
|---|---|---|---|
| 1 | `/[locale]` (Home) | `projects.json` (featured subset) + hero media | Landing cinematic, portfolio strip, stats band, latest media, investor CTA |
| 2 | `/[locale]/portfolio` | `projects.json` where `is_placeholder=false` | Filter by type/status/location; grid of `ProjectCard` |
| 3 | `/[locale]/portfolio/[slug]` | `projects.json` single record | Hero, metrics row, description, gallery, map, virtual tour, brochure CTA |
| 4 | `/[locale]/pipeline` | `projects.json` where `is_placeholder=true` | Ticker + `PlaceholderCard`s + `FillInChecklist` (admin-only) |
| 5 | `/[locale]/about` | static JSON dictionary | Company snapshot, vision, mission |
| 6 | `/[locale]/leadership` | static JSON | Team bios + headshots |
| 7 | `/[locale]/investors` | static JSON + `projects.json` metrics | Delivered/under-construction/pipeline totals, CTA to enquiry form |
| 8 | `/[locale]/contact` | static JSON | Form, map, socials |
| 9 | `/[locale]/media` | `projects.json.media` aggregated + static | Video + press |

### 2.5 Component contract

```ts
// lib/data/projects.ts
import raw from '@/../../migration/projects.json';
export type Project = (typeof raw)[number];
export const all: Project[] = raw;
export const portfolio = raw.filter((p) => !p.is_placeholder);
export const pipeline = raw.filter((p) => p.is_placeholder);
export const bySlug = (slug: string) => raw.find((p) => p.slug === slug);
```

Every content component takes a `Project` and a `locale` and renders the correct language branch. No component owns copy directly — everything reads from the JSON.

### 2.6 Fonts

Run once during scaffolding:

```bash
node scripts/gen-fonts-css.mjs > apps/web/src/styles/fonts.css
```

The script reads `migration/assets/manifest.json`, emits `@font-face` blocks for every font file, and exposes CSS variables `--font-arabic-display`, `--font-arabic-body`, `--font-latin`. `tailwind.config.ts` maps these to `fontFamily.brand`.

### 2.7 Motion system

Three layers, one orchestrator:

- `RevealOnScroll` (Framer Motion) — default reveal for card grids, headlines; uses `--h-motion-duration` from CSS vars.
- `ParallaxLayer` (GSAP ScrollTrigger) — hero, portfolio mosaic, metric counters. Initialised inside a `"use client"` wrapper.
- `LottieIcon` — micro-animations on stat cards, pipeline badges. Lottie JSON lives under `public/assets/lottie/` (to be supplied).

Accessibility: respect `prefers-reduced-motion`. The motion orchestrator reads the media query and drops to static states.

### 2.8 Placeholder UX

`PlaceholderCard` shows:

- Project name + location
- "Pipeline" badge in accent
- Rotating silhouette image from the deco icon set
- CTA "Register interest" → contact form with project slug pre-filled
- When `?admin=1` is present, a `FillInChecklist` drawer opens listing every unresolved item in `fill_in_checklist.missing_items`.

---

## 3. Stage 2 — WordPress theme + importer

The preview becomes the design spec. We do **not** port the Next.js React components back to PHP; we ship the theme as a classic/FSE hybrid whose HTML patterns match the Next.js output one-to-one.

### 3.1 Theme shell

- `style.css` header declares `Theme Name: Heyazah`, version, text domain `heyazah`.
- `theme.json` is generated from `brand_tokens.json` (a build script maps palette/typography/spacing into the FSE settings schema).
- `functions.php` enqueues the same fonts and icon set under the same paths as the Next.js app.
- FSE templates mirror the Next.js page list above. Where Next uses React components, theme.json uses block patterns.

### 3.2 Custom post types / taxonomies / ACF

- `inc/cpt.php` re-declares the three CPTs we actually want (`project`, `unit`, `media_center`) using the old theme's slug scheme so imports line up.
- `inc/taxonomies.php` registers `project_category`, `project_status`, `sector`, `unit_status`, `media_type`.
- `acf-json/` is populated from `migration/acf_schema.json` via a one-time converter (`scripts/acf-schema-to-json.mjs`). ACF's native local-json loader picks them up on theme activation.
- The old ACF field group `group_66014ba2974b7` (template settings) is *not* imported — its fields relate to legacy page builder layouts.

### 3.3 Companion plugin: `heyazah-importer`

Separate plugin so re-imports don't depend on theme state. Screens:

1. **Import projects** — reads `data/projects.json`, for each record:
   - `wp_insert_post` with `post_type=project`, status from `wp_post_status`.
   - Maps `type`, `status`, `sector`, `location_short` → taxonomy terms.
   - Writes ACF fields via `update_field` (bilingual payload goes into qTranslate-XT markers `[:ar]…[:en]…[:]`).
   - Sideloads images via `media_sideload_image` when `images.hero_path` is present locally; otherwise enqueues a "needs upload" task.
   - For placeholders, creates the post as draft and writes `fill_in_checklist` into a private meta key + surfaces it in the admin screen.
2. **Import taxonomies** — seeds the fixed term lists so slugs match existing URLs.
3. **Import ACF schema** — optional; activates if ACF local-json hasn't loaded.
4. **Re-run** — idempotent, keyed by `project.id`.

### 3.4 Plugin bundle

Bundle these inside the zip-of-zips we ship to the client:

| Plugin | Why | Licensing note |
|---|---|---|
| ACF Pro | Structured fields the importer writes to | Requires their license key |
| Rank Math | SEO titles/descriptions pulled from project data | Free tier is enough |
| WP Rocket | Cache (works with FSE) | Paid; client supplies |
| Smush | Image optimisation for sideloaded media | Free tier OK |
| Polylang **or** WPML | Frontend language switcher | Pick one; importer writes in both formats so either works |

If any paid plugin isn't licensed yet, we include a note + download placeholder in the zip.

### 3.5 Final shippable zip

```
heyazah-release-v1.zip
 ├─ heyazah-theme.zip           (apps/wp-theme/heyazah)
 ├─ heyazah-importer.zip        (apps/wp-theme/heyazah-importer)
 ├─ data/projects.json
 ├─ data/acf_schema.json
 ├─ assets/                     (logos, icons, fonts — mirrored from migration)
 ├─ docs/INSTALL.md
 └─ docs/BUILD_BLUEPRINT.md     (this file)
```

`INSTALL.md` sequence: install plugins → activate theme → run importer → flip default language to AR.

---

## 4. What we are NOT doing

- Not re-running the legacy `heyazah` or `heyazah-theme-v2` themes.
- Not porting Elementor, WPBakery, or any page builder layouts.
- Not reusing any CSS from the old theme (tokens only).
- Not importing `heyazah.cloud` or `heyazah.com` as-is — those are references, not sources of truth.
- Not promising units are orderable from the website until the CRM integration is defined (see `flags.json` unit inventory note).

---

## 5. Open questions to close before Stage 2

1. **Translation gap:** 20 placeholders only have EN names. Do we want rough AR names now, or block Stage 2 until marketing signs off?
2. **Virtual tour URLs:** do we host Matterport/3D Vista, or embed a third party?
3. **CRM:** which system is authoritative for unit inventory? (Salesforce? Zoho CRM MCP is connected in this session.)
4. **Media center seeding:** do we carry the existing media_center posts over, or start clean?
5. **Which i18n plugin will run in production — Polylang or WPML?** The importer writes both dialects; the theme ships with hooks for both.

These go into `flags.json.open_questions` for tracking.

---

## 6. Milestones & ownership

| Milestone | Output | Gate |
|---|---|---|
| M1 · Data locked | `projects.json`, `acf_schema.json`, `flags.json`, `brand_tokens.*`, asset pack | ✅ DONE |
| M2 · Preview live | Next.js 15 on Vercel staging | Visual QA + language QA |
| M3 · WP theme buildable | `heyazah-theme.zip` + importer in a local WP | Importer round-trips against `projects.json` |
| M4 · Release zip | `heyazah-release-v1.zip` | Client installs into a staging WP |
| M5 · Go-live | DNS flip + ISR/webhook from WP → Vercel preview | Handover to marketing |
