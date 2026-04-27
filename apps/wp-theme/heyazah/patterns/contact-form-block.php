<?php
/**
 * Title: Contact Form Block
 * Slug: heyazah/contact-form-block
 * Categories: featured
 */
?>
<!-- wp:group {"layout":{"type":"constrained"},"className":"container grid gap-10 py-16 md:grid-cols-2 reveal-on-scroll"} -->
<div class="wp-block-group container grid gap-10 py-16 md:grid-cols-2 reveal-on-scroll">
	<!-- wp:group {"className":"space-y-4 rounded-2xl bg-heyazah-paper p-6 shadow-card"} -->
	<form class="wp-block-group space-y-4 rounded-2xl bg-heyazah-paper p-6 shadow-card" action="#" method="post">
		<!-- wp:html -->
		<label class="block">
			<span class="text-sm font-medium text-heyazah-ink/80">Name</span>
			<input name="name" required class="mt-1 w-full rounded-lg border border-heyazah-fog bg-heyazah-paper px-3 py-2" />
		</label>
		<label class="block mt-4">
			<span class="text-sm font-medium text-heyazah-ink/80">Email</span>
			<input type="email" name="email" required class="mt-1 w-full rounded-lg border border-heyazah-fog bg-heyazah-paper px-3 py-2" />
		</label>
		<label class="block mt-4">
			<span class="text-sm font-medium text-heyazah-ink/80">Message</span>
			<textarea name="message" rows="5" class="mt-1 w-full rounded-lg border border-heyazah-fog bg-heyazah-paper px-3 py-2"></textarea>
		</label>
		<button type="submit" class="mt-4 inline-flex items-center gap-2 rounded-full bg-heyazah-primary px-6 py-3 text-sm font-semibold text-heyazah-paper shadow-card hover:bg-heyazah-accent">Send</button>
		<!-- /wp:html -->
	</form>
	<!-- /wp:group -->

	<!-- wp:group {"tagName":"aside","className":"space-y-4 text-sm text-heyazah-ink/80"} -->
	<aside class="wp-block-group space-y-4 text-sm text-heyazah-ink/80">
		<!-- wp:group {"className":"flex items-start gap-3"} -->
		<div class="wp-block-group flex items-start gap-3">
			<!-- wp:image {"sizeSlug":"thumbnail","className":"mt-1 h-5 w-5"} -->
			<figure class="wp-block-image size-thumbnail mt-1 h-5 w-5"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/ui.mail.svg' ) ); ?>" alt=""/></figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":""} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"className":"font-semibold text-heyazah-primary"} -->
				<p class="font-semibold text-heyazah-primary">Email</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph -->
				<p>info@heyazah.sa</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"flex items-start gap-3 mt-4"} -->
		<div class="wp-block-group flex items-start gap-3 mt-4">
			<!-- wp:image {"sizeSlug":"thumbnail","className":"mt-1 h-5 w-5"} -->
			<figure class="wp-block-image size-thumbnail mt-1 h-5 w-5"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/ui.phone.svg' ) ); ?>" alt=""/></figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":""} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"className":"font-semibold text-heyazah-primary"} -->
				<p class="font-semibold text-heyazah-primary">Phone</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph -->
				<p>+966 · TBA</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"flex items-start gap-3 mt-4"} -->
		<div class="wp-block-group flex items-start gap-3 mt-4">
			<!-- wp:image {"sizeSlug":"thumbnail","className":"mt-1 h-5 w-5"} -->
			<figure class="wp-block-image size-thumbnail mt-1 h-5 w-5"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/ui.map.svg' ) ); ?>" alt=""/></figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":""} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"className":"font-semibold text-heyazah-primary"} -->
				<p class="font-semibold text-heyazah-primary">Address</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph -->
				<p>Riyadh, Saudi Arabia</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</aside>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
