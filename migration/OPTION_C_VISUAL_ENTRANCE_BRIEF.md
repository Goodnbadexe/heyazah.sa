# Option C - Visual-First Immersive Entrance

## Decision

Use **Option C for now**:

- Keep the experience inside WordPress.
- Use `heyazah.cloud` as the embedded immersive source.
- Prioritize the entrance look, rhythm, and premium feeling before building complex custom 3D controls.
- Treat the immersive entrance as a site-level moment, separate from project-level 3D/360 embeds.

This is the right path for the current phase because the brand needs visual confidence first. The technical system should support the look without forcing the whole site into a custom app.

## Reference Site Takeaways

### Immersive Garden

Reference: `https://immersive-g.com`

Key pattern:

- Very quiet first viewport.
- Sparse navigation.
- Large negative space.
- Small “Scroll down” cue.
- Premium editorial composition.
- The experience feels controlled, not loud.

Use for Heyazah:

- A calm cinematic opening, not a busy dashboard.
- Minimal copy: logo, one positioning line, one action.
- No visible technical controls on the first frame.

### Robin Payot

Reference: `https://robinpayot.com`

Key pattern:

- Clear “Enter” threshold.
- The user chooses to enter the experience.
- Desktop-first immersive warning/handling.
- Simple typographic center stage.

Use for Heyazah:

- Add an explicit `Enter` / `ادخل التجربة` gate.
- Do not auto-force the heavy scene.
- Mobile can show a poster/fallback with a lighter entrance.

### Panasonic Entrance

Reference: `https://www2.panasonic.biz/jp/dsr/index/entrance/`

Key pattern:

- Brand logo first.
- Big centered product/world title.
- Entrance behaves like a themed portal.
- Cookie/UI overlays can destroy the illusion if not controlled.

Use for Heyazah:

- Show Heyazah identity first, then reveal the world.
- Keep cookie notices and floating widgets out of the entrance viewport where possible.
- Use the entrance as a “world door,” not as a normal homepage hero.

### Marseille La Phase 5

Reference: `https://marseille.laphase5.com/en`

Key pattern:

- Numeric/loading state before scene.
- Dark atmospheric palette.
- Suspense before content.

Use for Heyazah:

- Use a refined loader if `heyazah.cloud` needs time.
- Keep loader typography small and elegant.
- Cap the loading moment with a timeout and fallback.

### Musee de la Plaisance Timeline

Reference: `https://timeline.museedelaplaisance.com/en`

Key pattern:

- Big visual world.
- Clear `Enter` button.
- The experience begins with depth and atmosphere.
- Supporting navigation is present but visually secondary.

Use for Heyazah:

- Use an atmospheric Heyazah city/building world as the first impression.
- Put the entrance CTA in the lower-left or lower-center, with restrained button styling.
- Preserve language switch and accessibility, but keep them small.

## Elementor / WordPress Fit

Elementor Pro Motion Effects are acceptable for supporting motion: entrance animation, parallax, mouse tracking, 3D tilt, transparency, blur, rotate, and scale. Elementor also documents that motion effects respect reduced-motion preferences, which matters for accessibility.

Motion.page is the stronger match if the desired result is closer to the reference sites:

- Page load animation.
- Page exit/transition animation.
- ScrollTrigger style motion.
- Mouse movement.
- Image sequences.
- Works with Elementor and other page builders.

Scrollsequence is useful only if the entrance becomes a scroll-controlled cinematic sequence. For Option C, do not start there unless we have exported frames or a rendered sequence.

## Recommended Build Shape

### Layer 1 - Site Entrance

Template:

- `themes/heyazah/template-parts/site-entrance.php`

Purpose:

- Full viewport opening scene.
- Embeds `https://heyazah.cloud/entrance` or another configured entrance URL.
- Shows once per session.
- Has a skip/continue button.
- Uses a poster image before loading the iframe.

Visual:

- Full-screen dark or warm-neutral stage.
- Heyazah logo small at top.
- One line of brand copy.
- One `Enter` button.
- Background comes from `heyazah.cloud` iframe or poster.

Copy:

- English: `Enter Heyazah`
- Arabic: `ادخل عالم حيازة`

### Layer 2 - Project Cloud Embed

Template:

- `themes/heyazah/template-parts/project-cloud-embed.php`

Purpose:

- Embedded `heyazah.cloud` project experience inside each project page.
- This is not the site entrance.
- Loaded after interaction to protect performance.

Visual:

- Poster first.
- Button: `Explore project` / `استكشف المشروع`.
- On click, iframe loads in the same section.
- Fallback link opens `heyazah.cloud` in a new tab if iframe is blocked.

### Layer 3 - Elementor Control

Elementor can manage the page layout around the entrance:

- Home sections after the entrance.
- Typography and spacing.
- Scroll reveal for standard content.
- CTA sections.

The entrance iframe and project embed should remain theme/template controlled, not manually pasted into random Elementor widgets for every page.

## Scroll-Mode Follow-Up

The reference sites are not only using a static entrance. They use a **guided scroll mode** where each scroll step reveals another phase of the world. This should be the next phase after the current entrance scaffold is enabled.

### What Scroll Mode Means

The entrance should become a short cinematic sequence:

1. **Gate** - logo, poster/iframe, and `Enter Heyazah`.
2. **Reveal** - the iframe/scene becomes visible and the title recedes.
3. **Move** - first scroll moves the visitor through the scene.
4. **Anchor** - the next website section appears cleanly, without feeling like a hard page jump.

The scroll motion should feel like a camera path, not normal webpage scrolling.

### WordPress-Native Path

Keep the core in the theme:

- `site-entrance.php` owns the entrance markup.
- `site-entrance.js` owns the state: gate, entered, scrolling, exited.
- `site-entrance.css` owns the full-screen visual layer.
- Elementor controls the normal homepage sections after the entrance.

Use GSAP/ScrollTrigger where possible because the theme already includes GSAP vendor assets. Motion.page can be used later if the team wants a no-code interface for fine-tuning scroll timing.

### Scroll States

Add these states in the next implementation pass:

- `is-ready` - poster loaded and iframe can be started.
- `is-entered` - user clicked Enter.
- `is-scroll-mode` - entrance captures/pins scroll.
- `is-exiting` - final scroll step releases the page.
- `is-complete` - homepage scroll behaves normally.

### Visual Direction

Use a restrained cinematic structure:

- 3 to 5 scroll beats only.
- Small progress indicator or phase number, not a heavy timeline.
- Smooth title fade and scale.
- Subtle camera-feel movement using iframe/poster container transforms.
- No floating cards over the scene.
- No repeated buttons after the user enters.

### Scroll Beats For Heyazah

Recommended first version:

1. **Presence** - Heyazah logo and entrance line.
2. **City / Portfolio World** - `heyazah.cloud` visual opens.
3. **Scale** - show a short metric layer, such as delivered/under construction/pipeline.
4. **Projects** - release into the portfolio/homepage section.

### Acceptance Criteria For Scroll Mode

- The entrance can be completed by click, scroll, Escape, or Skip.
- The user never gets trapped.
- Reduced-motion users skip the pinned scroll and go directly to the poster + Enter flow.
- Mobile gets a shorter version: gate, reveal, release.
- The main homepage content is not hidden from search engines.
- The scroll experience does not load project-level embeds up front.

### Claude / Opus Handoff For Scroll Mode

Use this when handing the detailed motion pass to Claude/Opus:

```text
Extend the Heyazah Option C entrance into a guided scroll-mode sequence.

Work in the existing WordPress theme files:
- themes/heyazah/template-parts/site-entrance.php
- themes/heyazah/assets/css/site-entrance.css
- themes/heyazah/assets/js/site-entrance.js

Keep the site-level entrance separate from project-level 3D/360 embeds. Build a state machine for gate -> entered -> scroll-mode -> exiting -> complete. Use GSAP/ScrollTrigger if available from the theme vendor assets; otherwise fall back to CSS transforms and wheel/touch handling. Do not trap the user. Respect reduced-motion. Keep the design close to the reference pattern: minimal copy, premium full-screen scene, 3-5 scroll beats, restrained progress, then release into the normal WordPress/Elementor homepage.
```

## First Implementation Spec

### Theme Options

Add global options:

- `site_entrance_enabled`
- `site_entrance_url`
- `site_entrance_poster`
- `site_entrance_once_per_session`
- `site_entrance_button_en`
- `site_entrance_button_ar`

### Project Fields

Add project ACF fields:

- `cloud_embed_enabled`
- `cloud_embed_url`
- `cloud_embed_poster`
- `cloud_fallback_url`
- `project_experience_default`

Keep:

- `virtual_reality_iframe`

Map existing `virtual_reality_iframe` as the fallback project tour.

## Interaction Rules

- Entrance appears on the first site visit only.
- Visitor can skip.
- `Esc` should close entrance.
- Reduced motion users see poster + button, no forced animation.
- Mobile loads poster first.
- Iframe loads after `Enter`, not before, unless explicitly enabled.
- Do not show WhatsApp, cookie, chat, or floating sales widgets over the entrance.

## Visual Rules

- Use restrained typography and high contrast.
- No busy hero copy.
- No card around the entrance.
- No decorative blobs/orbs.
- Keep the first view full-bleed.
- Use one strong project/building/city visual from `heyazah.cloud`.
- Controls should be minimal: language, skip, enter.

## Performance Rules

- Poster must load before iframe.
- Iframe must lazy-load.
- Heavy project embeds must not load on the initial homepage paint.
- The entrance must have a 5-8 second fallback timeout.
- Use CSS transforms and opacity for motion.
- Avoid layout-shifting animations.

## Handoff Prompt

```text
Implement Option C from migration/OPTION_C_VISUAL_ENTRANCE_BRIEF.md.

Keep everything WordPress-native. Build a site-level immersive entrance that embeds heyazah.cloud as the visual source, but keep it separate from project-level 3D/360 embeds. Use a full-viewport entrance with poster-first loading, Enter/Skip behavior, sessionStorage show-once logic, reduced-motion handling, and a graceful fallback if the iframe fails.

Use Elementor only for surrounding page layout and supporting motion. Do not depend on Elementor widgets for the core entrance embed. Add theme template parts for site-entrance.php and project-cloud-embed.php, and keep project embeds lazy-loaded from ACF fields.
```
