<?php
/**
 * Services Showcase Pattern
 * Heyazah Pro Theme
 */

return array(
	'title'      => esc_html__( 'Services Showcase', 'heyazah-pro' ),
	'categories' => array( 'heyazah', 'sections' ),
	'content'    => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"4rem","right":"2rem","bottom":"4rem","left":"2rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">
	<!-- wp:heading {"level":2,"align":"center","textColor":"dark-teal"} -->
	<h2 class="has-text-align-center has-dark-teal-color has-text-color">خدماتنا</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","textColor":"dark-teal","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
	<p class="has-text-align-center has-dark-teal-color has-text-color" style="margin-bottom:2rem">مجموعة شاملة من الخدمات العقارية</p>
	<!-- /wp:paragraph -->

	<!-- wp:columns -->
	<div class="wp-block-columns">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:image {"sizeSlug":"heyazah-card","linkDestination":"none"} -->
			<figure class="wp-block-image size-heyazah-card"><img alt="صورة الخدمة"/></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"level":3,"textColor":"dark-teal","align":"center"} -->
			<h3 class="has-text-align-center has-dark-teal-color has-text-color">الخدمة الأولى</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">وصف الخدمة الأولى</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:image {"sizeSlug":"heyazah-card","linkDestination":"none"} -->
			<figure class="wp-block-image size-heyazah-card"><img alt="صورة الخدمة"/></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"level":3,"textColor":"dark-teal","align":"center"} -->
			<h3 class="has-text-align-center has-dark-teal-color has-text-color">الخدمة الثانية</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">وصف الخدمة الثانية</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:image {"sizeSlug":"heyazah-card","linkDestination":"none"} -->
			<figure class="wp-block-image size-heyazah-card"><img alt="صورة الخدمة"/></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"level":3,"textColor":"dark-teal","align":"center"} -->
			<h3 class="has-text-align-center has-dark-teal-color has-text-color">الخدمة الثالثة</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">وصف الخدمة الثالثة</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->',
	'description' => esc_html__( 'A showcase of services with images and descriptions', 'heyazah-pro' ),
);
