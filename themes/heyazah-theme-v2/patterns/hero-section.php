<?php
/**
 * Hero Section Pattern
 * Heyazah Pro Theme
 */

return array(
	'title'      => esc_html__( 'Hero Section', 'heyazah-pro' ),
	'categories' => array( 'heyazah', 'hero' ),
	'content'    => '<!-- wp:cover {"dimRatio":60,"overlayColor":"dark-teal","minHeight":500,"align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:500px">
	<span aria-hidden="true" class="wp-block-cover__background has-dark-teal-background-color has-background-dim-60 has-background-dim"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:heading {"level":1,"align":"center","textColor":"white","fontSize":"4xl"} -->
		<h1 class="has-text-align-center has-white-color has-text-color has-4xl-font-size">عنوان البطل</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","textColor":"primary-beige","fontSize":"large"} -->
		<p class="has-text-align-center has-primary-beige-color has-text-color has-large-font-size">نص وصفي قصير يشرح الرؤية</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
		<div class="wp-block-buttons" style="margin-top:2rem">
			<!-- wp:button {"backgroundColor":"gold","textColor":"black"} -->
			<div class="wp-block-button">
				<a class="wp-block-button__link has-gold-background-color has-black-color has-text-color has-background">دعوة للإجراء</a>
			</div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
</div>
<!-- /wp:cover -->',
	'description' => esc_html__( 'A full-width hero section with heading, description, and call-to-action button', 'heyazah-pro' ),
);
