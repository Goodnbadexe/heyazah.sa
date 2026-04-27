<?php
/**
 * Template part for displaying project/unit card
 * Used in: archive-project.php, front-page.php, single-project.php, ...etc
 * File location: template-parts/content-project-card.php
 * 
 * Usage Examples:
 * 
 * // Default (col-lg-4)
 * get_template_part('template-parts/content', 'project-card');
 * 
 * // Custom column class
 * set_query_var('card_col_class', 'col-lg-3 col-md-6');
 * get_template_part('template-parts/content', 'project-card');
 * 
 * // Or use shorthand
 * set_query_var('card_col_class', 'col-lg-6');
 * get_template_part('template-parts/content', 'project-card');
 */

// Get column class from query var or use default
$col_class = get_query_var('card_col_class', 'col-lg-4');

// Get current post type
$post_type = get_post_type();

// Get ACF fields
$location = get_field('project_location_2');
$location_long = get_field('project_location');
$total_units = get_field('project_total_units');
$rental_area = get_field('project_rental_area');
$parking_spaces = get_field('project_parking_spaces');
$office_area = get_field('project_office_area');
$commercial_galleries = get_field('project_commercial_galleries');

// Get status and category using helper functions
// $status = get_post_status_data();
// $category = get_post_category_data();
?>

<div class="<?php echo esc_attr($col_class); ?>">
    <div class="project-item">
        <a href="<?php the_permalink(); ?>">
            <div class="proj-img">
                <!-- Status Badge -->
                <?php  display_status_badge(); ?>
                

                <!-- Category/Type Badge -->
                <?php display_category_badge(); ?>

                <!-- Image -->
                <?php if (has_post_thumbnail()): ?>
                    <img src="<?= get_the_post_thumbnail_url($post->ID, 'large'); ?>" alt="<?php the_title(); ?>">
                <?php endif; ?>

                <!-- Details Overlay (Show only for projects) -->
                <?php if ($post_type === 'project'): ?>
                <div class="project-details">
                    <ul>
                <?php if( have_rows('project_icon_rep') ): while( have_rows('project_icon_rep') ) : the_row(); ?>
                    <li>
                        <div class="icon"><img src="<?php the_sub_field('icon'); ?>" alt=""></div>
                        <span class="key"><?php the_sub_field('naming'); ?></span>
                        <span class="data"><?php the_sub_field('value'); ?></span>
                    </li>
                <?php endwhile; endif;?>
                        <?php if ($locationWEWE): ?>
                        <li>
                            <div class="icon">
                                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/proj-icon.svg" alt="">
                            </div>
                            <span class="key"><?php ml_text('[:en]Location[:ar]الموقع'); ?></span>
                            <span class="data"><?php echo esc_html($location); ?></span>
                        </li>
                        <?php endif; ?>

                        <?php if ($rental_area): ?>
                        <li>
                            <div class="icon">
                                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/proj-icon.svg" alt="">
                            </div>
                            <span class="key"><?php ml_text('[:en]Rental Area[:ar]المساحة التأجيرية'); ?></span>
                            <span class="data"><?php echo number_format($rental_area); ?></span>
                        </li>
                        <?php endif; ?>

                        <?php if ($parking_spaces): ?>
                        <li>
                            <div class="icon">
                                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/proj-icon.svg" alt="">
                            </div>
                            <span class="key"><?php ml_text('[:en]Parking Spaces[:ar]عدد المواقف'); ?></span>
                            <span class="data"><?php echo number_format($parking_spaces); ?></span>
                        </li>
                        <?php endif; ?>

                        <?php if ($office_area): ?>
                        <li>
                            <div class="icon">
                                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/proj-icon.svg" alt="">
                            </div>
                            <span class="key"><?php ml_text('[:en]Office Area[:ar]المساحة المكتبية'); ?></span>
                            <span class="data"><?php echo number_format($office_area, 2); ?></span>
                        </li>
                        <?php endif; ?>

                        <?php if ($commercial_galleries): ?>
                        <li>
                            <div class="icon">
                                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/proj-icon.svg" alt="">
                            </div>
                            <span class="key"><?php ml_text('[:en]Commercial Galleries[:ar]المعارض التجارية'); ?></span>
                            <span class="data"><?php echo number_format($commercial_galleries, 1); ?></span>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>

            <div class="proj-info">
                <h4><?php the_title(); ?></h4>
                <ul>
                    <?php if ($location_long): ?>
                    <li>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/map.svg" alt="">
                        <span><?php echo esc_html($location_long); ?></span>
                    </li>
                    <?php endif; ?>

                    <?php if ($total_units && $post_type === 'project'): ?>
                    <li>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/build.svg" alt="">
                        <span><?php echo number_format($total_units); ?> <?php ml_text('[:en]Unit[:ar]وحدة'); ?></span>
                    </li>
                    <?php endif; ?>
                </ul>
                <div class="read-more">
                    <span><?php ml_text('[:en]View Details[:ar]عرض التفاصيل'); ?></span>
                </div>
            </div>
        </a>
    </div>
</div>

