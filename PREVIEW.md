# See Heyazah in action — 3 ways

Three preview paths, ranked by how fast you can see something clickable.

---

## Option 1 — Next.js preview (fastest, already built)

**Use this to see the design right now. ~60 seconds.**

### Prerequisites
- Node.js 20+ ([download](https://nodejs.org))
- pnpm (recommended) or npm

```bash
# From the repo root
cd apps/web
pnpm install         # also runs sync-assets + gen-fonts automatically
pnpm dev             # starts the dev server
```

Open **http://localhost:3000** — it redirects to `/ar` or `/en` based on your browser language.

### What you'll see
- Home (`/ar` or `/en`) — hero + stats band + featured portfolio
- Portfolio index (`/ar/portfolio`) — grid of 18 real projects + 20 pipeline teasers
- Single project (`/ar/portfolio/boulevard-residences` etc.) — hero + metrics + virtual tour + gallery + map
- Pipeline (`/ar/pipeline`) — the 20 "Coming Soon" projects; add `?admin=1` to see fill-in checklists
- About, Leadership, Investors, Contact, Media — all bilingual

### Language + direction toggle
Click the **EN / ع** switch in the header. The whole layout mirrors (RTL ↔ LTR) and fonts change.

### Troubleshooting
- **"Cannot find module '@migration/projects.json'":** make sure you're inside `apps/web/` not the repo root, and that `pnpm install` completed.
- **Fonts don't load:** `pnpm run gen-fonts` to regenerate `src/styles/fonts.css` from the manifest.
- **Images missing:** `pnpm run sync-assets` to re-copy `migration/assets/` into `public/assets/`.
- **Port in use:** `pnpm dev -- -p 3001`

> ⚠️ This is the **design preview**, not the WordPress theme itself. Use it to approve look-and-feel, content, and responsive behavior before we commit the same design to the WP theme.

---

## Option 2 — WordPress Playground (in-browser real WP, no install)

**Use this to see the actual WordPress theme running in a real WP admin — with no software to install.**

WordPress Playground runs a full WordPress install inside your browser using WebAssembly. The theme, plugins, and content are loaded from a blueprint.

### Quick link (when the zip is ready)

We'll host the bundle on GitHub and publish a one-click URL like:

```
https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/<org>/heyazah.sa/main/playground/blueprint.json
```

Click the link. Wait ~30 seconds. You're in WP admin with the Heyazah theme active, content seeded, 38 projects imported.

### What the blueprint does (auto)
1. Installs WordPress (latest), PHP 8.1, empty database
2. Switches language to Arabic (`ar`) with English as secondary
3. Uploads `heyazah-theme.zip` and activates it
4. Uploads and activates: Polylang, ACF, Rank Math, CF7, Flamingo, Smush, Complianz, W3TC
5. Uploads and activates `heyazah-importer.zip`
6. Runs the importer (creates 38 projects + 8 pages + navigation)
7. Logs you in as admin at `/wp-admin`

### Local Playground (offline)

If you prefer to run it on your own machine without GitHub hosting:

```bash
# Requires Node 20+
npx @wp-playground/cli start --blueprint=./playground/blueprint.json
```

Opens at http://localhost:9400.

---

## Option 3 — LocalWP desktop app (proper local WP environment)

**Use this if you want to keep iterating locally, test plugin updates, or mimic production.**

### Install LocalWP

1. Download from **https://localwp.com** (free, macOS/Windows/Linux)
2. Open it → **Create a new site**
3. Name: `Heyazah` · Environment: **Preferred** (PHP 8.1+, Nginx, MariaDB)
4. Username/password: your choice (remember them)

### Load the Heyazah release into it

1. Open the site in LocalWP → click **Go to admin** (opens `/wp-admin`)
2. **Plugins → Add new → Upload**
   - Upload licensed `advanced-custom-fields-pro.zip` (from advancedcustomfields.com)
   - Upload licensed `polylang-pro.zip` (from polylang.pro)
   - Or, use free alternatives: ACF free + Polylang free (limited features)
3. **Plugins → Add new → Upload** each plugin from `heyazah-release-v1/plugins-bundle/free/`
4. **Appearance → Themes → Add new → Upload Theme** → `heyazah-theme.zip` → Activate
5. **Plugins → Add new → Upload** → `heyazah-importer.zip` → Activate
6. **Heyazah → Import** (new admin menu item) → click **Run import**
7. **Settings → Permalinks** → click **Save Changes** (flushes rewrite rules)

Done. Visit `http://heyazah.local/ar` and `http://heyazah.local/en`.

### What production-like behavior you get
- Real MySQL queries, real file uploads, real cache behavior
- Full Polylang URL structure (`/ar/portfolio/...`)
- Rank Math SEO checks on actual pages
- Site Kit can connect to a test GA4 property
- Plugin update workflows exactly as on production

---

## Which should I pick?

| Goal | Best path |
|---|---|
| See the design NOW, approve direction | **Option 1** (Next.js) |
| Sign off the WP theme before shipping | **Option 2** (Playground) |
| Iterate, test, train content editors | **Option 3** (LocalWP) |
| All of the above, at different stages | **Use all three** (which is the plan) |

---

## Status

| Path | Status | Blocker |
|---|---|---|
| Option 1 Next.js | ✅ Ready to run right now | None |
| Option 2 Playground | 🔶 Needs theme + importer zips | Building now |
| Option 3 LocalWP | 🔶 Needs theme + importer zips | Building now |

When Options 2 and 3 are ready, the blueprint URL + the release zip will be linked here.
