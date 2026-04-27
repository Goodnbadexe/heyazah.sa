<?php
/**
 * Title: Portfolio Strip
 * Slug: heyazah/portfolio-strip
 * Categories: featured, portfolio
 * Description: A grid displaying featured projects with scroll animations, perfectly mirroring the Next.js luxury design.
 */
?>
<!-- wp:group {"layout":{"type":"constrained"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"className":"container py-20"} -->
<div class="wp-block-group container py-20" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","orientation":"horizontal"},"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"className":"mb-10 flex items-end justify-between"} -->
	<div class="wp-block-group mb-10 flex items-end justify-between" style="margin-bottom:var(--wp--preset--spacing--50)">
		<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.3em"},"elements":{"link":{"color":{"text":"var:preset|color|accent"}}}},"textColor":"accent","fontSize":"sm","className":"text-sm uppercase tracking-[0.3em] text-heyazah-accent"} -->
			<p class="has-accent-color has-text-color has-link-color has-sm-font-size text-sm uppercase tracking-[0.3em] text-heyazah-accent" style="letter-spacing:0.3em;text-transform:uppercase">Selected work</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"var:preset|font-size|2xl"},"spacing":{"margin":{"top":"var:preset|spacing|10"}}},"className":"mt-2 text-4xl md:text-5xl"} -->
			<h2 class="wp-block-heading mt-2 text-4xl md:text-5xl" style="margin-top:var(--wp--preset--spacing--10);font-size:var(--wp--preset--font-size--2xl)">Portfolio</h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":1,"query":{"perPage":3,"pages":0,"offset":0,"postType":"project","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"grid gap-6 sm:grid-cols-2 lg:grid-cols-3 h-query-status-ongoing"} -->
	<div class="wp-block-query grid gap-6 sm:grid-cols-2 lg:grid-cols-3 h-query-status-ongoing">
		<!-- wp:post-template {"className":"reveal-on-scroll"} -->
			<!-- wp:cover {"useFeaturedImage":true,"dimRatio":20,"overlayColor":"primary","isDark":false,"style":{"border":{"radius":"16px"}},"className":"group relative block overflow-hidden rounded-2xl bg-heyazah-fog shadow-card transition-all duration-slow ease-dramatic hover:shadow-hover aspect-[4/5] w-full"} -->
			<div class="wp-block-cover is-light group relative block overflow-hidden rounded-2xl bg-heyazah-fog shadow-card transition-all duration-slow ease-dramatic hover:shadow-hover aspect-[4/5] w-full" style="border-radius:16px"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-20 has-background-dim"></span><div class="wp-block-cover__inner-container">
				
				<!-- wp:group {"layout":{"type":"default"},"style":{"dimensions":{"minHeight":"100%"}},"className":"absolute inset-0 bg-gradient-to-t from-heyazah-primary/80 via-heyazah-primary/20 to-transparent"} -->
				<div class="wp-block-group absolute inset-0 bg-gradient-to-t from-heyazah-primary/80 via-heyazah-primary/20 to-transparent" style="min-height:100%">
					<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"},"className":"absolute top-4 left-4 flex gap-2"} -->
					<div class="wp-block-group absolute top-4 left-4 flex gap-2">
						<!-- wp:post-terms {"term":"status","style":{"typography":{"fontSize":"11px","textTransform":"uppercase","letterSpacing":"1px"}},"className":"rounded-full bg-heyazah-accent text-heyazah-paper px-3 py-1 font-semibold tracking-wider"} /-->
						<!-- wp:post-terms {"term":"project_category","style":{"typography":{"fontSize":"11px"}},"className":"rounded-full bg-heyazah-paper/90 text-heyazah-primary px-3 py-1 font-semibold"} /-->
					</div>
					<!-- /wp:group -->
					
					<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"},"style":{"spacing":{"blockGap":"0"}},"className":"absolute bottom-0 w-full p-5 text-heyazah-paper"} -->
					<div class="wp-block-group absolute bottom-0 w-full p-5 text-heyazah-paper">
						<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontSize":"var:preset|font-size|xl","lineHeight":"1.1"}},"textColor":"paper","className":"text-xl leading-tight"} /-->
						<!-- wp:post-excerpt {"moreText":"","excerptLength":10,"style":{"typography":{"fontSize":"var:preset|font-size|sm"},"spacing":{"margin":{"top":"var:preset|spacing|10"}}},"textColor":"paper","className":"opacity-85 mt-1 text-sm"} /-->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->

			</div></div>
			<!-- /wp:cover -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
