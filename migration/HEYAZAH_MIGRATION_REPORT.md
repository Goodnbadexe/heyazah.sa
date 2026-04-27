# Heyazah — WordPress Extract & Migration Plan

**Source:** `heyazah.sa` WordPress UpdraftPlus backup (2026-04-18), WP 6.9.4
**Output folder:** `migration/`
**Purpose:** Turn a fragmented WP install into a clean, system-agnostic dataset ready to drop into a new stack.

---

## 1. What actually lives in the WordPress export

| Post type            | Published | Trashed | Role |
|----------------------|-----------|---------|------|
| `project`            | 18        | 0       | The real source of truth for projects |
| `unit`               | 4         | 14      | Unit inventory — effectively empty |
| `media_center`       | 8         | 0       | News + videos |
| `page`               | 5         | 1       | Home, About, Contact, etc. |
| `acf-field-group`    | 6         | 0       | Custom-field schema (ACF) |
| `acf-field`          | 296       | 0       | Individual custom field definitions |
| `attachment`         | 306       | 0       | Images / PDFs / one hero video |
| `nav_menu_item`      | 14        | 4       | Header / mobile menus |
| `wpcf7_contact_form` | 9         | 0       | Contact Form 7 forms |

Taxonomies in use:

- `project_category` — `commercial` (تجاري, 13 posts), `residential` (سكني, 5 posts)
- `project_status` — `completed` (مكتمل, 8 posts = OLD), `ongoing` (قيد التنفيذ, 10 posts = CONTINUING)
- `sector` — A / B / C / D (only A and B used, 4 relationships total)
- `unit_status` — `sold` / `reserved` / `available` (mostly unused — inventory is empty)
- `media_type` — `news` (الاخبار) / `videos` (الفيديوهات)

**Bottom line:** WordPress has no concept of a "new / pipeline" project — everything is either `completed` or `ongoing`. The pipeline names from the `heyazah.cloud` interactive map (Heyazah Tower, A/B series, Sumood, Resd 1–5, etc.) are **not in this database at all.** They will need to be added on the new platform.

---

## 2. The 18 projects, cleanly structured

Full records live in `projects.json`. Summary:

### OLD — Completed (8)

| Project        | Type        | Metrics filled | Gallery | Slug         | Notes |
|----------------|-------------|----------------|---------|--------------|-------|
| HEYAZAH GATE   | commercial  | 4/7            | 0       | `heyazah-gate` | |
| KAYNAT         | commercial  | 1/7            | 5       | encoded Arabic | Standardize spelling |
| LEX            | residential | 4/7            | 6       | `english-lex` | **Type conflict — should be commercial. Slug is wrong.** |
| Prime Square   | commercial  | 4/7            | 4       | encoded Arabic | |
| TAKAMUL        | commercial  | 4/7            | 0       | `takamul`   | |
| THE ROOFS      | commercial  | 4/7            | 0       | `the-roofs` | |
| WAHA GATE      | commercial  | 4/7            | 0       | `waha-gate` | **Public site calls this "Oasis Gate" — pick one.** |
| WAHA WAVES     | commercial  | 4/7            | 0       | `waha-waves` | |

### CONTINUING — Under construction (10)

| Project         | Type        | Metrics filled | Gallery | Slug              | Notes |
|-----------------|-------------|----------------|---------|-------------------|-------|
| AMD CENTER      | commercial  | 2/7            | 0       | `amd-center`      | Location missing |
| Business Yard   | commercial  | 4/7            | 4       | `business-yard`   | |
| LIVIN by Heyazah | commercial | 0/7            | 3       | `livin-by-heyazah` | All metrics empty |
| Masar Makkah    | residential | 0/7            | 4       | encoded Arabic    | All metrics empty |
| ParkSide        | residential | 1/7            | 5       | encoded Arabic    | |
| S Tower         | commercial  | 4/7            | 4       | `s-tower`         | |
| SIGMA           | commercial  | 3/7            | 0       | `sigma`           | Location missing |
| Skyline         | residential | 4/7            | 6       | encoded Arabic    | **Type conflict — public site calls it a commercial tower.** |
| The Hotel       | residential | 0/7            | 4       | `the-hotel`       | All metrics empty |
| VENTORA         | commercial  | 2/7            | 0       | `ventora`         | **Fully sold per public site, but marked `ongoing` in DB.** |

"Metrics filled" = out of 7 numeric fields: `office_area_m2`, `rental_area_m2`, `commercial_galleries_m2`, `parking_spaces`, `total_units`, `starting_price_sar`, `delivery_date`.

### NEW — Pipeline (0 in DB)

None. The 20 names below exist only on the public site or `heyazah.cloud` map. They need to be created fresh in the new system:

- From `heyazah.cloud`: Alsaif Center 1, Heyazah Tower, Heyazah A3/A7/A9, Heyazah B8/B19/B23/B52, Sumood, Heyazah Compound, Heyazah Resd 1–5, The Roofs Villa
- From `heyazah.com` residential portfolio (delivered, but not in `.sa` DB): Heyazah Haven, Narges Neighborhood villas, Al-Nafal Neighborhood villas, Villa Roves

---

## 3. Conflicts and data problems (the real action list)

Details in `flags.json`. Top items:

1. **Ventora status mismatch.** DB = `ongoing`, public site = "Fully Sold". In the new schema, construction status and inventory status should be **two different fields**, so Ventora can correctly be "Under construction" AND "Sold out".
2. **LEX type mismatch.** DB says residential, but LEX is a retail + office center. Reclassify.
3. **Skyline type mismatch.** DB says residential, public site shows it under "Projects Under Construction" as a commercial tower (78% progress). Either reclassify to commercial or introduce a `mixed-use` type.
4. **"Waha Gate" vs "Oasis Gate"** — same project, two English names between `.sa` DB and `.com` portfolio. Pick one canonical name and redirect the other.
5. **Three brands, one company** — `heyazah.com` + `heyazah.sa` + `heyazah.cloud` dilute SEO and confuse users. Consolidate to `heyazah.sa` as the canonical domain.
6. **Unit inventory is effectively empty** (4 published, 14 trashed). If you want a real unit-level inventory view on the new site, the data must come from the sales CRM, not this WP export.
7. **Metrics gaps on continuing projects** — LIVIN, Masar Makkah, The Hotel have zero numeric metrics filled. Need developer input before launch.
8. **Locations missing on 8 projects** (AMD, Sigma, Ventora, Heyazah Gate, Takamul, The Roofs, Waha Gate, Waha Waves). Many of these live as a Google Maps iframe in `map_image` but not as structured address strings.
9. **URL-encoded Arabic slugs** on ~7 projects. New system should use clean ASCII slugs (`parkside`, `masar-makkah`, `skyline`, `prime-square`, `kaynat`) and keep the Arabic name as a display field only.
10. **SEO scores are all 11** (Rank Math default/empty) — nothing to migrate from current SEO data.

---

## 4. Proposed schema for the new system

This matches the project-instructions schema and extends it to cover what the WP data actually contains.

```jsonc
{
  "id": "string | uuid",
  "slug": "string (ASCII, unique)",
  "name": { "ar": "...", "en": "..." },
  "type": "commercial | residential | mixed-use",
  "status": {
    "lifecycle": "old | continuing | new",  // delivery stage
    "construction_progress_pct": 0,         // 0..100, optional
    "inventory": "available | reserved | sold_out | not_for_sale"
  },
  "location": {
    "ar": "...", "en": "...",
    "city": "Riyadh | Makkah | ...",
    "district": "An Narjis | ...",
    "map_embed_iframe": "html | null",
    "lat_lng": { "lat": 0, "lng": 0 }       // optional, for a proper map UI
  },
  "metrics": {
    "office_area_m2": 0,
    "rental_area_m2": 0,
    "commercial_galleries_m2": 0,
    "parking_spaces": 0,
    "total_units": 0,
    "starting_price_sar": 0,
    "delivery_date": "YYYY-MM-DD"
  },
  "images": {
    "hero":    { "url": "...", "alt": { "ar": "", "en": "" } },
    "icon":    { "url": "...", "alt": ... },
    "gallery": [ { "url": "...", "alt": ... } ]
  },
  "media": {
    "virtual_tour_url": "https://heyazah.cloud/...",
    "video_url": "...",
    "brochure_url": "..."
  },
  "description": {
    "hero":       { "ar": "...", "en": "..." },
    "subtitle":   { "ar": "...", "en": "..." },
    "sections":   [ { "title": {ar,en}, "body": {ar,en}, "image": "..." } ],
    "featured_quote": { "ar": "...", "en": "..." }
  },
  "icon_metrics": [
    { "icon_url": "...", "label": {ar,en}, "value": {ar,en} }
  ],
  "units": [
    { "id": 0, "number": "", "floor": 0, "area_m2": 0, "price_sar": 0,
      "status": "available | reserved | sold" }
  ],
  "seo": { "title": {ar,en}, "description": {ar,en}, "og_image": "..." },
  "source": { "wp_id": 0, "wp_guid": "...", "created": "", "modified": "" }
}
```

Key schema decisions worth noting:

- **Lifecycle and inventory are separate.** Lets "under construction + sold out" (Ventora) render correctly.
- **Bilingual everywhere** (`{ar, en}` objects), so you can drop the qTranslate `[:ar]...[:en]...[:]` mess.
- **`type` gets a `mixed-use` option** for buildings like Skyline where "residential vs commercial" is not a clean binary.
- **`icon_metrics`** preserves the per-project spec bar (Location / Total Units / Parking Spaces) from the existing ACF repeater.
- **`source.wp_id`** keeps a trail back to the WordPress record, which is useful for image migration.

---

## 5. Asset migration

The uploads archive is ~395 MB with 2,054 files. After stripping WP's auto-generated resized thumbnails (`-300x188`, `-150x150`, etc.), there are **~511 distinct source files** to migrate — the rest is noise.

Hero files for the old portfolio are already consistently named: `heyazah-gate-hero.jpg`, `waha-waves-hero-unsmushed.jpg`, `takamul-hero-unsmushed.jpg`, etc. These can be mapped 1:1.

The full `projects.json` contains absolute `https://heyazah.sa/wp-content/uploads/...` URLs for every hero and gallery image — ready for a bulk download + re-upload script.

---

## 6. What to ignore from the WordPress export

Per the project instructions:

- **Themes** (`heyazah-theme-v2`): the PHP template files and any theme-level styling — not needed. We have the data. The theme tells you the *old UI structure*, which we're abandoning.
- **Page builder layouts**: There is no Elementor/WPBakery in this install (pages are native Gutenberg), so this is not a problem here — but the existing page content is thin and should be rebuilt, not migrated.
- **Plugins** (`updraftplus`, `advanced-custom-fields`, `contact-form-7`, `rank-math`, `qtranslate-xt`, `elementor`-is-not-installed, `easy-wp-smtp`, `yeemail`): Only ACF's *schema* mattered, and we've already extracted it into `acf_schema.json`. Everything else is WP plumbing.
- **`wp_options`** (1085 rows): WP config, widget state, cron jobs — irrelevant for migration.
- **`wp_actionscheduler_*`, `wp_cf7et_*`, `wp_easywpsmtp_*`, `wp_rank_math_*`, `wp_db7_forms`**: plugin working tables. Discard.

---

## 7. Migration plan, step by step

**Phase 1 — Freeze the truth (this doc + `projects.json`).** Done.

**Phase 2 — Fill the gaps.**
  1. Decide: Waha Gate or Oasis Gate? LEX commercial or residential? Skyline commercial or mixed-use? Ventora lifecycle label?
  2. Have the developer team fill metrics for LIVIN, Masar Makkah, The Hotel, AMD Center, Sigma, Ventora.
  3. Get structured addresses (city, district, lat/lng) for the 8 location-less projects.
  4. Decide canonical English names for projects with URL-encoded Arabic slugs.

**Phase 3 — Build the new CMS.**
  1. Stand up the new schema above on whatever backend you choose (Sanity, Strapi, Payload, Supabase + a thin admin UI — anything but another WordPress monolith).
  2. Import `projects.json` verbatim as the seed data.
  3. Add the 20 "missing / pipeline" names from heyazah.cloud + residential delivered as new records.

**Phase 4 — Asset migration.**
  1. Script a download of the ~511 source-quality images using the URLs in `projects.json`.
  2. Re-upload to a CDN (Cloudflare R2 / Bunny / S3).
  3. Update image URLs in the records.

**Phase 5 — Public site.**
  1. Build `heyazah.sa` as the single canonical domain with one project-page template applied to all records.
  2. 301-redirect `heyazah.com/*` to `heyazah.sa/*` using the slug mapping.
  3. Keep `heyazah.cloud` as a standalone interactive map (or embed it — don't autoload).

**Phase 6 — Decommission.**
  1. Archive the WP install read-only.
  2. Turn off the WP database once the new site is fully cut over.

---

## 8. Files in this folder

- `projects.json` — 18 projects, clean, bilingual, with images/media/units/metrics. This is the seed dataset for the new CMS.
- `flags.json` — conflicts, missing projects, data-quality issues per project. Work through this before launch.
- `acf_schema.json` — the ACF field catalog, for reference or if a plugin tool ever needs the original custom-field definitions.
- `HEYAZAH_MIGRATION_REPORT.md` — this document.
