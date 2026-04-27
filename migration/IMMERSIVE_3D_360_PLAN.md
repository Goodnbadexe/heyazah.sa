# Heyazah Immersive Entrance + Project 3D/360 Embeds

## Purpose

Current selected direction: **Option C - visual-first WordPress entrance**. See `migration/OPTION_C_VISUAL_ENTRANCE_BRIEF.md`.

There are two separate experiences and they should not be mixed:

1. **Immersive entrance** - the website opening scene. This is the branded first impression for Heyazah as a company.
2. **Project 3D/360 embeds** - each project page can embed the relevant `heyazah.cloud` experience for that specific project.

Each project page should support project-level media:

- A 3D building/model viewer for the project.
- A 360 tour/camera experience for real site or interior capture.
- A direct `heyazah.cloud` embed when the cloud experience already exists.
- A regular image/video/gallery fallback when project immersive assets are missing.
- WordPress-managed fields so the same project template can power every project.

The immersive entrance should not be treated as a video hero, and it is not the same thing as the 3D/360 viewer. The entrance is a site-level scene. The 3D/360 embeds are project-level experiences.

## Current Codebase Reality

The WordPress theme already has a project template at:

- `themes/heyazah/single-project.php`

That template already reads:

- `hero_image`
- `profile_pdf`
- `360_virtual_tour`
- `virtual_reality_iframe`
- `project_gallery`
- `map_image`

The current 360 section renders `virtual_reality_iframe` inside the project page. This means the clean path is to use `heyazah.cloud` as an embeddable source inside WordPress, while preserving the current project page structure.

The canonical migration data already has project media fields in:

- `migration/projects.json`

Current media shape:

```json
"media": {
  "virtual_tour_url": "https://heyazah.cloud/lex",
  "video_url": null,
  "brochure_url": "..."
}
```

## Recommended Data Model

Add two separate data concepts:

- `site_entrance` for the website opening scene.
- `cloud_embed` / `project_experience` for each project page.

Keep `media.virtual_tour_url` for backward compatibility, but make `cloud_embed` the future source for `heyazah.cloud` embeds.

### Site Entrance

This belongs to theme/global settings, not to each project.

```json
"site_entrance": {
  "enabled": true,
  "source_type": "iframe",
  "embed_url": "https://heyazah.cloud/entrance",
  "poster_url": "https://heyazah.cloud/assets/entrance/poster.webp",
  "show_once_per_session": true,
  "skip_enabled": true
}
```

### Project Experience

```json
"cloud_embed": {
  "enabled": true,
  "source_type": "iframe",
  "embed_url": "https://heyazah.cloud/prime-square",
  "poster_url": "https://heyazah.cloud/assets/projects/prime-square/poster.webp",
  "fallback_url": "https://heyazah.cloud/prime-square",
  "label_en": "Explore project",
  "label_ar": "استكشف المشروع",
  "load_mode": "on_interaction"
},
"project_experience": {
  "enabled": true,
  "default_tab": "cloud_embed",
  "model": {
    "glb_url": "https://heyazah.cloud/assets/projects/prime-square/model.glb",
    "poster_url": "https://heyazah.cloud/assets/projects/prime-square/poster.webp",
    "environment_url": null,
    "camera": {
      "orbit": "35deg 70deg 180m",
      "target": "0m 25m 0m",
      "field_of_view": "35deg"
    },
    "hotspots": [
      {
        "id": "main-entrance",
        "label_en": "Main entrance",
        "label_ar": "المدخل الرئيسي",
        "position": "4m 2m 8m",
        "target": "tour-lobby"
      }
    ]
  },
  "tours": [
    {
      "id": "tour-lobby",
      "type": "iframe",
      "title_en": "Lobby 360 Tour",
      "title_ar": "جولة 360 للردهة",
      "url": "https://heyazah.cloud/prime-square/lobby"
    }
  ]
}
```

## WordPress ACF Fields

Add project-level fields to the Project Settings group:

| Field | Type | Name | Notes |
| --- | --- | --- | --- |
| Enable Cloud Embed | True/False | `cloud_embed_enabled` | Controls whether the embedded `heyazah.cloud` project appears. |
| Cloud Embed URL | URL | `cloud_embed_url` | Primary `heyazah.cloud` iframe/source URL. |
| Cloud Fallback URL | URL | `cloud_fallback_url` | Opens in a new tab if iframe is blocked. |
| Cloud Poster | Image | `cloud_embed_poster` | Shown before the embed loads. |
| Project Experience Default | Select | `project_experience_default` | `cloud_embed`, `model`, `tour`, `gallery`. |
| 3D Model File/URL | URL or File | `project_model_url` | Optional direct `.glb/.gltf` model. |
| Model Poster | Image | `project_model_poster` | Shown before model loads and on low bandwidth. |
| 360 Tours | Repeater | `project_360_tours` | Fields: title AR/EN, type, URL/embed. |
| Hotspots | Repeater | `project_hotspots` | Label AR/EN, position, target tour/page. |
| Fallback Image | Image | `project_experience_fallback_image` | Required if no embed/model is ready. |

Add site-level fields to theme options:

| Field | Type | Name | Notes |
| --- | --- | --- | --- |
| Enable Site Entrance | True/False | `site_entrance_enabled` | Controls the opening scene. |
| Site Entrance URL | URL | `site_entrance_url` | Usually a `heyazah.cloud` embed. |
| Site Entrance Poster | Image | `site_entrance_poster` | Lightweight initial visual. |
| Show Once Per Session | True/False | `site_entrance_once_per_session` | Prevents annoying repeat entrance loads. |

Keep existing `virtual_reality_iframe`, but map it into `project_360_tours[0]` during migration.

## Frontend Implementation

### WordPress Theme

Add a reusable template part:

- `themes/heyazah/template-parts/project-cloud-embed.php`

Render it inside `single-project.php` after the hero and before the gallery/about sections.

Behavior:

1. If `cloud_embed_url` exists, render the `heyazah.cloud` project embed inside the page.
2. If the cloud embed is missing but `project_model_url` exists, render a direct 3D model viewer.
3. If only `virtual_reality_iframe` or a 360 tour URL exists, render the 360 tour panel.
4. If none exists, hide the project experience section and keep the normal gallery.

Add a second reusable template part for the site-level entrance:

- `themes/heyazah/template-parts/site-entrance.php`

Render this on the home page only, or globally only when the user first lands on the website. It should not be repeated inside every project page.

### Embed Rules

For `heyazah.cloud`, prefer an iframe-based embed:

```html
<iframe
  src="https://heyazah.cloud/prime-square"
  title="Prime Square"
  loading="lazy"
  allow="fullscreen; xr-spatial-tracking; gyroscope; accelerometer"
  allowfullscreen>
</iframe>
```

Use a poster and a button first. Load the iframe only after click/interaction, unless the page is explicitly the site entrance.

Recommended viewer:

- Use the `heyazah.cloud` iframe embed first when a complete cloud experience exists.
- Use Google `<model-viewer>` only when a direct `.glb/.gltf` file exists and there is no better cloud embed.
- Use Three.js only when custom city-scale interaction, animated paths, or advanced hotspots become necessary.

Example viewer markup:

```html
<model-viewer
  src="PROJECT_MODEL.glb"
  poster="PROJECT_POSTER.webp"
  camera-controls
  auto-rotate
  ar
  shadow-intensity="0.8"
  loading="lazy"
  reveal="interaction">
</model-viewer>
```

### Next.js Preview App

The Next.js project already has:

- `apps/web/src/components/project/VirtualTour.tsx`
- `apps/web/src/components/project/ProjectHero.tsx`

Upgrade `VirtualTour.tsx` into a project cloud embed section later, or add:

- `apps/web/src/components/project/ProjectCloudEmbed.tsx`
- `apps/web/src/components/SiteEntrance.tsx`

This keeps parity between the migration preview and WordPress theme.

## Asset Rules

Preferred embed/source paths on `heyazah.cloud`:

```text
https://heyazah.cloud/entrance
https://heyazah.cloud/{project-slug}
https://heyazah.cloud/assets/projects/{project-slug}/model.glb
https://heyazah.cloud/assets/projects/{project-slug}/poster.webp
https://heyazah.cloud/assets/projects/{project-slug}/tour/index.html
```

WordPress should store only URLs/references, not huge raw model files, unless the model is small.

Targets:

- `.glb` model: ideally under 15 MB, hard limit around 30 MB.
- Poster: `.webp`, 1600px wide.
- Project cloud embeds and 360 tours: lazy-loaded only after click/scroll.
- Site entrance: can load immediately on the first session visit, but must have skip and poster fallback.
- Mobile: poster first, model loads on interaction.

## Project Page Flow

1. Hero with project name, status, location, profile CTA, project experience CTA.
2. Project experience section:
   - `heyazah.cloud` embed if available.
   - Direct 3D model if cloud embed is missing.
   - 360 tour if model is missing.
   - Gallery fallback if no project experience asset exists.
3. Hotspot/tour controls:
   - Exterior
   - Lobby
   - Typical floor
   - Roof/facilities
   - Location/map
4. Project facts and metrics.
5. Gallery, units/prices, map, register interest.

## Site Entrance Flow

1. User opens the website.
2. If `site_entrance_enabled` is true and the session has not seen it yet, show a full-viewport entrance.
3. Entrance loads from `heyazah.cloud` or a lightweight poster first.
4. User can skip/continue into the regular home page.
5. Store a session flag so the entrance does not block every page navigation.

## Migration Steps

1. Audit `heyazah.cloud` and list each embed:
   - site entrance URL
   - project slug
   - project cloud embed URL
   - optional model URL
   - poster URL
   - 360 tour URL
   - missing/needs export
2. Add `cloud_embed` and optional `project_experience` objects to `migration/projects.json`.
3. Add ACF fields to the WordPress Project Settings field group.
4. Add site entrance fields to theme options.
5. Update importer to map cloud/project experience data into ACF.
6. Add `project-cloud-embed.php` and `site-entrance.php` to the theme.
7. Replace direct raw iframe output with sanitized iframe rendering and optional model-viewer rendering.
8. Test every project page with:
   - cloud embed available
   - direct model available
   - only 360 available
   - no immersive assets
   - mobile low bandwidth

## Acceptance Criteria

- The site entrance is separate from the project 3D/360 experience.
- Every project can define its own `heyazah.cloud` embed from WordPress.
- Every project can optionally define direct 3D and 360 assets from WordPress.
- Opening entrance is interactive, not a video.
- Missing assets do not break the page.
- Project cloud/360 embeds are lazy-loaded and do not slow down the first paint.
- Large 3D files are hosted on `heyazah.cloud` or CDN-like storage, not bundled into the theme.
- The same project slug connects WordPress, `projects.json`, and `heyazah.cloud` assets.
- Arabic and English labels are supported for hotspots and tour titles.

## Claude / Antigravity Handoff Prompt

Use this prompt when handing the task to another coding agent:

```text
You are working in the Heyazah WordPress/Next.js migration repo. Implement the immersive entrance and project cloud embeds described in migration/IMMERSIVE_3D_360_PLAN.md.

Start with the WordPress theme. Treat the site-level immersive entrance and the project-level 3D/360 experience as separate features. Add project ACF fields for a heyazah.cloud embed URL, optional direct 3D model, optional 360 tour, poster, and fallback. Create themes/heyazah/template-parts/project-cloud-embed.php and include it from themes/heyazah/single-project.php after the hero section. Use the heyazah.cloud iframe embed first. Use <model-viewer> only as a fallback when a direct .glb/.gltf model exists. Preserve the existing virtual_reality_iframe behavior as the 360 fallback. Make the project embed lazy-loaded, responsive, bilingual, and safe when fields are empty.

Separately add a site entrance template part, themes/heyazah/template-parts/site-entrance.php, controlled by theme options. It may embed heyazah.cloud/entrance, should show only once per session, and must include skip/continue behavior.

Do not replace the whole single-project template. Keep the current project page structure, gallery, units, map, and contact form intact. Add only the project cloud embed section, the site entrance, and supporting CSS/JS enqueue logic.
```
