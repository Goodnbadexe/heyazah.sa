# Heyazah Release Bundle — v1 Spec

> Locked 2026-04-19. This document defines the contents, install order, and
> plugin policy for `heyazah-release-v1.zip`. Any deviation requires an
> explicit decision from the project owner.

---

## 1. Release bundle shape

```
heyazah-release-v1.zip
├── INSTALL.md                          # 1-2-3 install walkthrough, bilingual
├── heyazah-theme.zip                   # FSE theme
├── heyazah-importer.zip                # Companion plugin (reads projects.json)
├── plugins-bundle/
│   ├── premium/
│   │   ├── advanced-custom-fields-pro.zip.placeholder
│   │   └── polylang-pro.zip.placeholder
│   └── free/
│       ├── seo-by-rank-math.zip
│       ├── google-site-kit.zip
│       ├── contact-form-7.zip
│       ├── flamingo.zip
│       ├── wp-smushit.zip
│       ├── complianz-gdpr.zip
│       └── w3-total-cache.zip
├── data/
│   ├── projects.json                   # 38 projects (18 real + 20 placeholders)
│   ├── brand_tokens.json
│   └── assets/                         # logos, icons, fonts
└── docs/
    ├── ACF_FIELD_REFERENCE.md
    ├── BLOCK_PATTERN_REFERENCE.md
    └── ODOO_INTEGRATION_GUIDE.md       # for the future Odoo wiring
```

### Install order (from INSTALL.md)

1. Install premium plugins first (ACF Pro, Polylang Pro) — admin supplies their license zips to replace `.placeholder` files.
2. Bulk-install free plugins from `plugins-bundle/free/`.
3. Install + activate `heyazah-theme.zip`.
4. Install + activate `heyazah-importer.zip`.
5. Go to **Heyazah → Import** → click **Run import** → content is seeded.
6. Visit `/wp-admin/options-permalink.php` and save (flushes rewrite rules).

---

## 2. Theme (`heyazah-theme.zip`)

**Slug:** `heyazah` · **Version:** 1.0.0 · **PHP required:** 8.1+

### File tree
```
heyazah/
├── style.css                 # Theme header metadata
├── theme.json                # FSE v3 — palette, fonts, spacing
├── functions.php             # Bootstrap + ACF local-json filter
├── inc/
│   ├── cpt.php               # project, unit, media_center
│   ├── taxonomies.php        # project_category, project_status, sector, unit_status, media_type
│   ├── acf-fields.php        # Defensive fallback; primary source = acf-json/
│   ├── enqueue.php           # Brand stylesheet + fonts
│   ├── polylang-config.php   # Register strings, CPT translations
│   └── block-patterns.php    # Register 12 patterns
├── acf-json/                 # Field groups, auto-loaded
├── assets/
│   ├── fonts/                # 13 font files
│   ├── logos/                # 7 SVGs
│   ├── icons/                # 70 SVGs
│   └── css/
│       └── brand.css
├── templates/                # FSE templates
│   ├── index.html
│   ├── front-page.html
│   ├── archive-project.html
│   ├── single-project.html
│   ├── page-pipeline.html
│   ├── page-about.html
│   ├── page-leadership.html
│   ├── page-investors.html
│   ├── page-contact.html
│   └── page-media.html
├── parts/
│   ├── header.html
│   ├── footer.html
│   └── locale-switcher.html
└── patterns/
    ├── hero-home.php
    ├── portfolio-strip.php
    ├── stats-band.php
    ├── pipeline-teaser.php
    ├── project-hero.php
    ├── project-metrics.php
    ├── project-gallery.php
    ├── virtual-tour-cta.php
    ├── map-embed.php
    ├── leadership-grid.php
    ├── investor-cta.php
    └── contact-form-block.php
```

### Custom post types
| CPT | Slug | Archive | Purpose |
|---|---|---|---|
| `project` | `portfolio` | `/portfolio` | Real + pipeline projects |
| `unit` | `units` | `/units` | Optional: individual units for sale/rent |
| `media_center` | `media` | `/media` | Press, videos, announcements |

### Taxonomies
- `project_category` — commercial, residential, mixed_use, hospitality
- `project_status` — completed, under_construction, upcoming, coming_soon
- `sector` — retail, office, residential, F&B, wellness
- `unit_status` — available, reserved, sold, leased
- `media_type` — press, video, announcement, interview

### ACF field groups (from `migration/acf_schema.json`)
- **Project core:** project_code, display_name_ar/en, status_badge, location (lat/lng/address_ar/en), launch_year, delivery_date_yyyymmdd, is_pipeline_placeholder
- **Project metrics:** total_units, parking_spaces, office_area_m2, rental_area_m2, commercial_galleries_m2, starting_price_sar
- **Project media:** hero_image, gallery (repeater), virtual_tour_url, brochure_pdf, video_embed_url
- **Project relationships:** sector (taxonomy), category (taxonomy), related_projects (post relationship)
- **Placeholder-only:** fill_in_checklist (repeater of missing_items, editor-only visible)
- **Contact submission:** name, phone, email, project_slug, interest_type, budget_range, preferred_contact_time (Odoo-aligned)

---

## 3. Importer plugin (`heyazah-importer.zip`)

**Slug:** `heyazah-importer` · **Version:** 1.0.0 · **Requires:** ACF Pro, Polylang Pro

### Responsibilities
1. Read bundled `data/projects.json` (38 records).
2. Register admin page **Heyazah → Import** (shows preview + run button).
3. On run: for each project, `wp_insert_post` twice (AR + EN), link via Polylang, `update_field` for ACF, sideload hero + gallery images, register in taxonomies.
4. Seed 8 static pages with block patterns (home, portfolio, pipeline, about, leadership, investors, contact, media).
5. Create navigation menu structure.
6. Record run state in `wp_options` (`heyazah_import_log`) so it's idempotent.
7. Flush rewrite rules after run.

### Admin UX
- **Before run:** shows a diff — "38 projects will be created, 0 will be updated, 0 will be skipped (already imported)."
- **During run:** progress bar, per-record log.
- **After run:** summary + link to Portfolio archive + re-run button.

### Hooks exposed
- `heyazah_import_before_project($data)` — filter project data before insert
- `heyazah_import_after_project($post_id, $data)` — action after insert (e.g., to post to Odoo)
- `heyazah_ai_seo_suggestions($meta, $post)` — filter for future AI-generated meta/alt

---

## 4. Plugins bundle

### Premium (license placeholders)
| Plugin | Why | License source |
|---|---|---|
| Advanced Custom Fields Pro | Custom field engine, repeater + flexible content | advancedcustomfields.com |
| Polylang Pro | Bilingual data model, CPT translations | polylang.pro |

### Free (bundled actual zips)
| Plugin | Version | Purpose |
|---|---|---|
| Rank Math | latest | SEO (lighter + better AR than Yoast) |
| Google Site Kit | latest | GA4 + Search Console + PageSpeed in one dashboard |
| Contact Form 7 | latest | Forms engine |
| Flamingo | latest | CF7 submission DB + CSV export |
| Smush | latest | Image compression |
| Complianz | latest | PDPL + GDPR cookie banner (AR + EN) |
| W3 Total Cache | latest | Portable caching |

---

## 5. Data flow (single source of truth)

```
migration/projects.json ──┐
                          ├──► apps/web/ (Next.js preview, via @migration/*)
migration/brand_tokens.* ─┤
migration/assets/ ────────┤
                          └──► heyazah-importer/data/projects.json (bundled copy)
                                    │
                                    └──► WP DB on "Run import"
```

A script (`scripts/sync-importer-data.mjs`) will copy the canonical `migration/projects.json` into the importer plugin's `data/` folder at build time.

---

## 6. Forms + Odoo integration

- Forms are CF7 + Flamingo — submissions stored in WP DB with CSV export.
- Every submission is mapped to an ACF field group matching the future Odoo lead schema.
- `heyazah_cf7_submission` action fires on every submit; an Odoo webhook can hook here with zero form reconfig.
- `docs/ODOO_INTEGRATION_GUIDE.md` documents the endpoint contract, auth, and field mapping.

---

## 7. SEO + AI hook

- Rank Math free handles title/meta/sitemap/schema.
- `heyazah_ai_seo_suggestions` filter runs on project save — can later be wired to call Claude/OpenAI for auto meta descriptions and alt text on gallery images.
- Site Kit provides the GA4 snippet loaded only after Complianz consent.

---

## 8. Out of scope for v1

- Membership / investor login portal (MemberPress or similar)
- Unit inventory management (`unit` CPT is registered but not populated — hooks into the future CRM)
- Matterport-specific integration (generic iframe handles it)
- Multisite setup
- Elementor / WPBakery templates
- AR numeral conversion in frontend (JS helper will arrive in v1.1)

---

## 9. Open items from earlier phases — **still flagged**

From `migration/BUILD_BLUEPRINT.md` §5:
- [ ] AR display names for the 20 placeholder projects (only EN in legacy data)
- [ ] Confirm virtual tour host preference (generic iframe works; Matterport is the likely partner)
- [ ] Odoo endpoint URL + auth (not blocking v1, but needed before soft launch)
- [ ] Media Center seeding — do we import 12 legacy press items, or start fresh?
- [ ] Final domain hookup (heyazah.sa vs .com vs .cloud — legacy had all three)
