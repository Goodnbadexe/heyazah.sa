# @heyazah/web — Next.js 15 preview

Static preview of the new Heyazah site. Data is read directly from `../../migration/`.

## Quick start

```bash
pnpm install            # runs postinstall: sync-assets + gen-fonts
pnpm dev                # http://localhost:3000 -> redirects to /ar
pnpm build && pnpm start
```

If `pnpm` is unavailable, `npm install` works the same way.

## Data flow

- `../../migration/projects.json` — all 38 project records
- `../../migration/brand_tokens.json` + `.css` — colors, fonts, motion, shadows
- `../../migration/tailwind-tokens.js` — imported by `tailwind.config.ts`
- `../../migration/assets/manifest.json` — indexed icon/logo/font catalog

`scripts/sync-assets.mjs` hard-copies `migration/assets/` into `public/assets/`.
`scripts/gen-fonts-css.mjs` generates `src/styles/fonts.css` from the manifest.

## Routes

- `/ar` and `/en` (equal priority; middleware picks one based on Accept-Language)
- `/{locale}/portfolio` + `/{locale}/portfolio/[slug]`
- `/{locale}/pipeline` — appends `?admin=1` to reveal the fill-in checklist
- `/{locale}/about` · `/leadership` · `/investors` · `/contact` · `/media`

## Motion stack

- Framer Motion handles page/component reveals (`components/motion/RevealOnScroll`)
- GSAP + ScrollTrigger are loaded lazily (`components/motion/ParallaxLayer`)
- `prefers-reduced-motion` short-circuits both to static states

## Next step — export to WordPress

See `../../migration/BUILD_BLUEPRINT.md` §3. The wp-theme and importer plugin
live in `../wp-theme/`.
