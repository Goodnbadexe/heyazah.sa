<?php
/**
 * Project Card Pattern
 * Heyazah Pro Theme
 */

return array(
	'title'      => esc_html__( 'Project Card', 'heyazah-pro' ),
	'categories' => array( 'heyazah', 'cards' ),
	'content'    => '<!-- wp:group {"className":"project-card","style":{"spacing":{"padding":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}},"border":{"radius":"8px"}}} -->
<div class="wp-block-group project-card" style="border-radius:8px;padding-top:1rem;padding-right:1rem;padding-bottom:1rem;padding-left:1rem">
	<!-- wp:image {"sizeSlug":"heyazah-card","linkDestination":"none"} -->
	<figure class="wp-block-image size-heyazah-card"><img alt="صورة المشروع"/></figure>
	<!-- /wp:image -->

	<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.5rem","right":"1rem","bottom":"1rem","left":"1rem"}}}} -->
	<div class="wp-block-group" style="padding-top:1.5rem;padding-right:1rem;padding-bottom:1rem;padding-left:1rem">
		<!-- wp:heading {"level":3,"textColor":"dark-teal"} -->
		<h3 class="has-dark-teal-color has-text-color">اسم المشروع</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"textColor":"dark-teal"} -->
		<p class="has-dark-teal-color has-text-color">وصف قصير عن المشروع والميزات الرئيسية.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"backgroundColor":"primary-teal","textColor":"white","className":"is-small"} -->
			<div class="wp-block-button is-small">
				<a class="wp-block-button__link has-primary-teal-background-color has-white-color has-text-color has-background" href="#">عرض المشروع</a>
			</div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->',
	'description' => esc_html__( 'A project card with image, title, description, and view button', 'heyazah-pro' ),
);
