# Heyazah Release QA Checklist

Use this list when testing the delivered `heyazah.zip` and `heyazah-importer.zip` on a fresh WordPress install.

## Stage 1: Plugin Validation

- [ ] Install `heyazah-importer.zip` and activate.
- [ ] Verify the "Heyazah Import" screen is present in `Tools > Heyazah Import`.
- [ ] Initial trigger execution returns a success status with no JSON parse faults.
- [ ] 18 base projects have successfully loaded into `wp_posts`.
- [ ] Pipeline drafts (like *Sumood*, *Resd 1–5*) accurately show as "Draft" under the Projects listing, validating `.is_placeholder` interception.
- [ ] Verify qTranslate-XT style fields mapping to default post loop correctly `[:ar]arabic[:en]english[:]`.
- [ ] Check media gallery logs for newly sideloaded default hero attachments.

## Stage 2: Theme Layout & Data Presentation

- [ ] Install `heyazah.zip` block theme.
- [ ] Validate Site Editor applies Global variables defined locally.
- [ ] Visit the front page.
   - [ ] GSAP initial Parallax operates smoothly across desktop and mobile without jank.
   - [ ] Three core taxonomy segments execute accurately ("Completed Legacy", "Under Construction", and "Future Pipeline").
   - [ ] Verified that metric components exist, displaying: 2005 / 30,000+ / ~1M m².
- [ ] View an administrative draft pipeline project natively.
   - [ ] Verify the Admin Quality Gap pattern visually flashes red warning with missing schema blocks dynamically generated.
- [ ] Reconfigure user device to "prefers-reduced-motion".
   - [ ] Ensure `motion.js` gracefully intercepts GSAP rendering and reverts to an immediate visual load.
