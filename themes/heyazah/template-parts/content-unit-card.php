<?php
/**
 * Template part for displaying unit card
 * Used in: single-project.php, archive-unit.php, ...etc
 * File location: template-parts/content-unit-card.php
 * 
 * Usage Examples:
 * 
 * // Default (col-lg-6)
 * get_template_part('template-parts/content', 'unit-card');
 * 
 * // Custom column class
 * set_query_var('card_col_class', 'col-lg-4 col-md-6');
 * get_template_part('template-parts/content', 'unit-card');
 */

// Get column class from query var or use default (units usually 2 columns)
$col_class = get_query_var('card_col_class', 'col-lg-6');

// Get ACF fields
$floor_name = get_field('unit_floor_name');
$bedrooms = get_field('unit_bedrooms');
$bathrooms = get_field('unit_bathrooms');
$unit_price = get_field('unit_price');
$unit_desc = get_field('unit_desc');

// Get status and category using helper functions
// $status = get_post_status_data();
// $category = get_post_category_data();


// get_post_category_data();
// Count similar units (optional - can be calculated dynamically)
// $similar_units_count = get_query_var('similar_units_count', 0);
?>
<style>

    .proj-img span {
    background: #fff;
    color:#222222;
}
    span.available {
    background: var(--sec-color);
    color:#fff;
}
</style>
<div class="<?php echo esc_attr($col_class); ?>">
    <div class="project-item single-project-item">
        <a href="<?php the_permalink();?>">
            <div class="proj-img">
                <!-- Status Badge -->
                <?php  display_status_badge(); ?>

                <!-- Unit Type Badge -->
                <?php //display_category_badge(); ?>

                <!-- Unit Image -->
                <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('medium_large'); ?>
                <?php else: ?>
                    <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/singl-p.png" alt="<?php the_title(); ?>">
                <?php endif; ?>

                <!-- Number of Similar Units (optional) -->
                <?php //if ($similar_units_count > 0): ?>
                <!-- <div class="number-of-units">
                    <span><?php echo $similar_units_count; ?> <?php ml_text('[:en]Units[:ar]وحدات'); ?></span>
                </div> -->
                <?php //endif; ?>
                
                <!-- Price Badge (optional) -->
                <?php if ($unit_price): ?>
                <!-- <div class="unit-price-badge">
                    <span><?php echo number_format($unit_price); ?> <?php ml_text('[:en]SAR[:ar]ر.س'); ?></span>
                </div> -->
                <?php endif; ?>
                <div class="id-card">
                    <?php the_field('unit_id');?>
                </div>
            </div>
        </a>

            <div class="single-proj-info">
                <ul>
                    <?php if ($floor_name): ?>
                    <li>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/ico1.svg" alt="">
                        <span><?php echo ml_get($floor_name); ?></span>
                    </li>
                    <?php endif; ?>

                    <?php if ($bedrooms): ?>
                    <li>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/bed-double.svg" alt="">
                        <span><?php echo $bedrooms; ?> <?php ml_text('[:en]Rooms[:ar]غرف'); ?></span>
                    </li>
                    <?php endif; ?>

                    <?php if ($bathrooms): ?>
                    <li>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/pathroom.svg" alt="">
                        <span><?php echo $bathrooms; ?> <?php ml_text('[:en]Bathrooms[:ar]حمام'); ?></span>
                    </li>
                    <?php endif; ?>
                    
                    <?php //if ($unit_area): ?>
                    <!-- <li>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/area-icon.svg" alt="">
                        <span><?php echo number_format($unit_area); ?> <?php ml_text('[:en]sqm[:ar]م²'); ?></span>
                    </li> -->
                    <?php //endif; ?>
                </ul>

                <?php if ($unit_desc): ?>
                <h6><?php echo $unit_desc; ?></h6>
                <?php endif; ?>

                <div class="btns-flex">
                    <div class="read-more">
                        <a href="<?php the_permalink();?>">
                            <?php ml_text('[:en]View Details[:ar]عرض التفاصيل'); ?>
                        </a>
                    </div>
                    <div class="read-more btn-border">
                        <a href="<?php the_permalink();?>#form-booking" target="_blank">
                            <?php ml_text('[:en]reservation[:ar]حجز'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>


<?php
// DEBUG - Remove after testing
// $status = get_post_status_data();
// echo '<pre style="background: #f0f0f0; padding: 10px; margin: 10px;">';
// echo 'Post ID: ' . get_the_ID() . "\n";
// echo 'Post Type: ' . get_post_type() . "\n";
// echo 'Status Data: ';
// print_r($status);
// echo '</pre>';
?>