# Heyazah Canonical Development Changelog

## 1.0.0

### Added
- **Premium GSAP Motion System**: Added customized architectural transition engine using scroll reveals and staggered fade-ups (`assets/js/motion.js`), respecting `prefers-reduced-motion`.
- **Cinematic Front Page**: Replaced the default blog grid with a structured, component-driven canonical home layout splitting properties into Completed Legacy, Under Construction, and Future Pipeline.
- **Luxury Single Project Layout**: Established a brochure-style template structure supporting full-bleed parallax hero blocks, segmented grid layouts, and embedded 3D tours (`templates/single-project.html`).
- **Data Gap Pattern**: Backoffice FSE pattern added for alerting administrators of missing property details during the pipeline draft phase (`patterns/admin-quality-gap.php`).

### Fixed
- **Plugin JSON Parser**: Corrected the importer root lookup error when accessing `projects.json` structure (`$parsed['projects']`).
- **Bilingual Title Handling**: Set project display titles using qTranslate-XT style `[:ar]...[:en]...[:]` formats matching the native schema format.
- **Pipeline Draft Status**: Fixed importer logic to accurately target `status.lifecycle == "new"` or `is_placeholder == true` forcing them into Draft mode safely.
- **Hero Image Sideloading**: Added `media_sideload_image` automated execution downloading missing external hero assets and properly assigning them to `_thumbnail_id` on first ingestion.

### Recommendations
- Standardized on **Custom GSAP + ScrollTrigger**, dropping GreenShift and Motion.page, explicitly for block-editor resilience and reduced database overhead fitting a luxury corporate profile.
