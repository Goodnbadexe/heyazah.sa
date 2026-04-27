<?php
/**
 * Contact CTA Pattern
 * Heyazah Pro Theme
 */

return array(
	'title'      => esc_html__( 'Contact CTA Section', 'heyazah-pro' ),
	'categories' => array( 'heyazah', 'sections' ),
	'content'    => '<!-- wp:group {"backgroundColor":"primary-teal","textColor":"white","style":{"spacing":{"padding":{"top":"4rem","right":"2rem","bottom":"4rem","left":"2rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-primary-teal-background-color has-white-color has-text-color has-background" style="padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">
	<!-- wp:heading {"level":2,"align":"center","fontSize":"3xl"} -->
	<h2 class="has-text-align-center has-3xl-font-size">هل أنت مهتم بمشاريعنا؟</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","fontSize":"large","style":{"spacing":{"margin":{"top":"1rem","bottom":"2rem"}}}} -->
	<p class="has-text-align-center has-large-font-size" style="margin-top:1rem;margin-bottom:2rem">تواصل معنا اليوم للحصول على مزيد من المعلومات</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"backgroundColor":"gold","textColor":"black"} -->
		<div class="wp-block-button">
			<a class="wp-block-button__link has-gold-background-color has-black-color has-text-color has-background" href="/contact">تواصل معنا الآن</a>
		</div>
		<!-- /wp:button -->

		<!-- wp:button {"textColor":"white","style":{"border":{"width":"2px"}},"borderColor":"white"} -->
		<div class="wp-block-button">
			<a class="wp-block-button__link has-white-color has-text-color" style="border-width:2px" href="/projects">استكشف المشاريع</a>
		</div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->',
	'description' => esc_html__( 'A call-to-action section with heading, description, and action buttons', 'heyazah-pro' ),
);
