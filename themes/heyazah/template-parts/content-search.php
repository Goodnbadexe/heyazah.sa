<?php
/**
 * Template part for displaying search results in a news-item card style
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ELRYAD
 */

// Get the post type to determine layout
$post_type = get_post_type();

// Get column class - default to col-lg-4 for grid layout
$col_class = get_query_var('card_col_class', 'col-lg-4');

// Check if this is a media_center post type
$is_media_center = ($post_type === 'media_center');

// Get media center specific fields
if ($is_media_center) {
    $media_terms = get_the_terms(get_the_ID(), 'media_type');
    $is_video = false;
    
    if (!empty($media_terms) && !is_wp_error($media_terms)) {
        foreach ($media_terms as $term) {
            if ($term->slug === 'videos' || $term->slug === 'video') {
                $is_video = true;
                break;
            }
        }
    }
    
    $media_video_url = get_field('media_video');
    $media_link = $media_video_url ?: get_permalink();
    $view_count = get_post_meta(get_the_ID(), 'media_view_count', true);
    $view_count = $view_count ? $view_count : 0;
    
    // Format view count (e.g., 25300 -> 25.3K)
    $formatted_views = $view_count >= 1000 ? number_format($view_count / 1000, 1) . 'K' : $view_count;
    $media_category = get_field('media_category');
} else {
    $media_link = get_permalink();
    $is_video = false;
}
?>

<div class="<?php echo esc_attr($col_class); ?>">
    <div class="project-item search-result-item">
        <a href="<?php echo esc_url($media_link); ?>" <?php echo ($is_media_center && $is_video && $media_video_url) ? 'data-fancybox="gallery"' : ''; ?>>
            
            <?php if ($is_media_center && $is_video && $media_video_url): ?>
                <div class="video-icone"></div>
            <?php endif; ?>
            
            <div class="proj-img">
                <!-- Post Type / Category Badge -->
                <div class="prj-status">
                    <?php if ($is_media_center && !empty($media_category)): ?>
                        <span class="award"><?php echo esc_html($media_category); ?></span>
                    <?php elseif ($post_type === 'project'): ?>
                        <?php display_status_badge(); ?>
                    <?php else: ?>
                        <span class="post-type-badge"><?php echo esc_html(get_post_type_object($post_type)->labels->singular_name); ?></span>
                    <?php endif; ?>
                </div>
                
                <!-- Featured Image -->
                <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('medium'); ?>
                <?php else: ?>
                    <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/proj1.png" alt="<?php the_title_attribute(); ?>">
                <?php endif; ?>
            </div>
            
            <div class="proj-info">
                <?php if ($is_media_center && $is_video && $media_video_url): ?>
                    <!-- Video Layout -->
                    <div class="new-title">
                        <h5><?php the_title(); ?></h5>
                    </div>
                    <ul>
                        <li>
                            <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/calender-i.svg" alt="">
                            <span><?php echo get_localized_date(get_the_date('Y-m-d')); ?></span>
                        </li>
                        <li>
                            <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/eye-vid.svg" alt="">
                            <span><?php echo $formatted_views; ?></span>
                        </li>
                    </ul>
                <?php else: ?>
                    <!-- News/Default Layout -->
                    <ul>
                        <li>
                            <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/calender-i.svg" alt="">
                            <span><?php echo get_localized_date(get_the_date('Y-m-d')); ?></span>
                        </li>
                    </ul>
                    <div class="new-title">
                        <h5><?php the_title(); ?></h5>
                    </div>
                    
                    <?php if (has_excerpt()): ?>
                        <div class="search-excerpt">
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="read-more">
                        <span><?php echo ml_get('[:en]View Details[:ar]عرض التفاصيل[:]'); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </a>
    </div>
</div>
