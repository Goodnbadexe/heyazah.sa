<?php
/**
 * Title: Admin Quality Gap
 * Slug: heyazah/admin-quality-gap
 * Categories: heyazah
 * Block Types: core/group
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// We only output this when the user is logged in
if ( is_user_logged_in() ) : 
    $post_id = get_the_ID();
    $missing_items_json = get_post_meta( $post_id, '_heyazah_missing_items', true );
    if ( ! empty( $missing_items_json ) ) {
        $missing_items = json_decode( $missing_items_json, true );
        if ( is_array( $missing_items ) && ! empty( $missing_items ) ) :
?>
<!-- wp:group {"className":"h-admin-quality-gap"} -->
<div class="wp-block-group h-admin-quality-gap" style="background-color: #ffe6e6; border-left: 4px solid #ff4d4d; padding: 1rem; margin: 2rem 0; color: #cc0000; font-family: monospace;">
    <!-- wp:heading {"level":4} -->
    <h4 class="wp-block-heading" style="margin-top: 0;">Admin Note: Missing Data</h4>
    <!-- /wp:heading -->
    <!-- wp:list -->
    <ul class="wp-block-list">
        <?php foreach ( $missing_items as $item ) : ?>
            <li><?php echo esc_html( $item ); ?></li>
        <?php endforeach; ?>
    </ul>
    <!-- /wp:list -->
</div>
<!-- /wp:group -->
<?php 
        endif;
    }
endif;
?>
