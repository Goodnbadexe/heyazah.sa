# Action Required from Client: Missing Canonical Content

This data structure flags any and all missing properties from the core 2026-04 export that requires explicit mapping before final stage deployment. 

## 1. Metric Backfilling Required
These projects are currently tagged as under-development ("Continuing") but their explicit sizing scales are omitted causing visual voids in the single-project FSE templates:
*   **LIVIN by Heyazah**: Missing total unit layout, sales square meters, and timeline.
*   **Masar Makkah**: Missing metric rows (Office Area, Rental Area, Commercial Galleries).
*   **The Hotel**: Metrics entirely missing.
*   **AMD Center**: Metrics 2/7 filled; location data entirely missing.
*   **Sigma**: Metrics 3/7 filled; location data missing.
*   **Ventora**: Data shows ongoing, public shows Sold. Requires unit-inventory state clarity.

## 2. Location Tracking Missing
For `map_embed_iframe` and Google Map GSAP transitions inside `single-project.html`, we need specific GPS or Address strings explicitly verified:
*   AMD Center
*   Sigma
*   Ventora
*   Heyazah Gate
*   Takamul
*   The Roofs
*   Waha Gate
*   Waha Waves

## 3. High-Fidelity Asset Collection
*   **Pipeline Projects**: The 20 new pipeline assets are only flagged as Placeholders. Awaiting explicit High-res hero imagery, rather than using standard silhouetted deco set.
*   **3D Matterport Arrays**: Please provide explicit URL embeds for Matterport / 3D Vista.
*   **Sales Brochures**: We require validated dual-language PDF resources for the "Download Brochure" CTA buttons on the 18 active commercial/residential components.

## 4. Name Resolution
*   **Oasis Gate vs. Waha Gate**: Reconcile exact naming.
*   **URL Encoded Slugs**: Please verify mapped clean ASCII strings for `parkside`, `skyline`, `prime-square`, `kaynat`, and `masar-makkah` replacing existing Arabic URL-encoded strings logic.
