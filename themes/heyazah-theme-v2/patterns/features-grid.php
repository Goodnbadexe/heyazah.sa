<?php
/**
 * Features Grid Pattern
 * Heyazah Pro Theme
 */

return array(
	'title'      => esc_html__( 'Features Grid', 'heyazah-pro' ),
	'categories' => array( 'heyazah', 'sections' ),
	'content'    => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"4rem","right":"2rem","bottom":"4rem","left":"2rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:4rem;padding-right:2rem;padding-bottom:4rem;padding-left:2rem">
	<!-- wp:heading {"level":2,"align":"center","textColor":"dark-teal"} -->
	<h2 class="has-text-align-center has-dark-teal-color has-text-color">ميزاتنا الرئيسية</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","textColor":"dark-teal","style":{"spacing":{"margin":{"bottom":"2rem"}}}} -->
	<p class="has-text-align-center has-dark-teal-color has-text-color" style="margin-bottom:2rem">اكتشف ما يميزنا عن منافسينا</p>
	<!-- /wp:paragraph -->

	<!-- wp:columns -->
	<div class="wp-block-columns">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"feature-card","style":{"spacing":{"padding":{"top":"2rem","right":"1.5rem","bottom":"2rem","left":"1.5rem"}},"border":{"radius":"8px"}}} -->
			<div class="wp-block-group feature-card" style="border-radius:8px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
				<!-- wp:heading {"level":3,"textColor":"dark-teal","align":"center"} -->
				<h3 class="has-text-align-center has-dark-teal-color has-text-color">الميزة الأولى</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center">وصف الميزة الأولى بشكل موجز</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"feature-card","style":{"spacing":{"padding":{"top":"2rem","right":"1.5rem","bottom":"2rem","left":"1.5rem"}},"border":{"radius":"8px"}}} -->
			<div class="wp-block-group feature-card" style="border-radius:8px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
				<!-- wp:heading {"level":3,"textColor":"dark-teal","align":"center"} -->
				<h3 class="has-text-align-center has-dark-teal-color has-text-color">الميزة الثانية</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center">وصف الميزة الثانية بشكل موجز</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"feature-card","style":{"spacing":{"padding":{"top":"2rem","right":"1.5rem","bottom":"2rem","left":"1.5rem"}},"border":{"radius":"8px"}}} -->
			<div class="wp-block-group feature-card" style="border-radius:8px;padding-top:2rem;padding-right:1.5rem;padding-bottom:2rem;padding-left:1.5rem">
				<!-- wp:heading {"level":3,"textColor":"dark-teal","align":"center"} -->
				<h3 class="has-text-align-center has-dark-teal-color has-text-color">الميزة الثالثة</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center">وصف الميزة الثالثة بشكل موجز</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->',
	'description' => esc_html__( 'A three-column grid showing key features with cards', 'heyazah-pro' ),
);
