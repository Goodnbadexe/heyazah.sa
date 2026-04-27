<?php
/**
 * Media Center AJAX Handlers
 * Handles all AJAX functionality for media center archive
 * 
 * @package ELRYAD
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue Media Center Scripts
 */
function enqueue_media_center_scripts() {
    // Only load on media center archive page
    if (is_post_type_archive('media_center')) {
        // Enqueue media center AJAX JavaScript
        wp_enqueue_script(
            'media-center-ajax', 
            ELRYAD_THEME_URL . '/js/media-center-ajax.js', 
            array('jquery'), 
            '1.0.0', 
            true
        );
        
        // Localize script with AJAX URL and nonce
        wp_localize_script('media-center-ajax', 'mediaCenterAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('media_center_ajax_nonce'),
            'loading_text' => ml_get('[:en]Loading...[:ar]جاري التحميل...[:]'),
            'load_more_text' => ml_get('[:en]Load More[:ar]عرض المزيد[:]'),
            'no_more_items' => ml_get('[:en]No more items[:ar]لا توجد المزيد من العناصر[:]'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_media_center_scripts');

/**
 * AJAX Handler: Load More Media Center Items
 * Handles loading more media center posts for specific tabs
 */
function ajax_load_more_media() {
    // Verify nonce
    check_ajax_referer('media_center_ajax_nonce', 'nonce');
    
    // Get parameters
    $term_id = isset($_POST['term_id']) ? intval($_POST['term_id']) : 0;
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $per_page = 3; // Posts per page (matching initial load)
    
    // Debug logging
    error_log('=== LOAD MORE MEDIA AJAX ===');
    error_log('Term ID: ' . $term_id);
    error_log('Page: ' . $paged);
    
    // Build query args
    $args = array(
        'post_type' => 'media_center',
        'posts_per_page' => $per_page,
        'paged' => $paged,
        'post_status' => 'publish',
    );
    
    // Add taxonomy query if term specified
    if ($term_id) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'media_type',
                'field'    => 'term_id',
                'terms'    => $term_id,
            ),
        );
    }
    
    // Execute query
    $media_query = new WP_Query($args);
    
    // Debug query
    error_log('Query args: ' . print_r($args, true));
    error_log('Found posts: ' . $media_query->found_posts);
    
    $response = array(
        'success' => false,
        'html' => '',
        'found_posts' => 0,
        'max_pages' => 0,
        'current_page' => $paged,
    );
    
    if ($media_query->have_posts()) {
        // Get term info for checking if it's video
        $term = get_term($term_id, 'media_type');
        $is_video = false;
        if ($term && !is_wp_error($term)) {
            $is_video = $term->slug === 'videos' || $term->slug === 'video';
        }
        
        ob_start();
        
        while ($media_query->have_posts()) {
            $media_query->the_post();
            $media_video_url = get_field('media_video') ? get_field('media_video') : get_field('video_url');
            $media_link = $media_video_url ?: get_permalink();
            $view_count = get_post_meta(get_the_ID(), 'media_view_count', true);
            $view_count = $view_count ? $view_count : 0;
            
            // Format view count (e.g., 25300 -> 25.3K)
            $formatted_views = $view_count >= 1000 ? number_format($view_count / 1000, 1) . 'K' : $view_count;
            ?>
            <div class="col-lg-4">
                <div class="project-item">
                    <a href="<?php echo esc_url($media_link); ?>" <?php echo $is_video && $media_video_url ? 'data-fancybox="gallery"' : ''; ?>>
                        <?php if ($is_video && $media_video_url): ?>
                            <div class="video-icone"></div>
                        <?php endif; ?>
                        <div class="proj-img">
                            <div class="prj-status"><span class="award"><?php echo get_field('media_category'); ?></span></div>
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else: ?>
                                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/proj1.png" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="proj-info">
                            <?php if ($is_video && $media_video_url): ?>
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
                                <!-- News Layout -->
                                <ul>
                                    <li>
                                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/calender-i.svg" alt="">
                                       <span><?php echo get_localized_date(get_the_date('Y-m-d')); ?></span>
                                    </li>
                                </ul>
                                <div class="new-title">
                                    <h5><?php the_title(); ?></h5>
                                </div>
                                <div class="read-more">
                                    <span><?php echo ml_get('[:en]View Details[:ar]عرض التفاصيل[:]'); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            </div>
            <?php
        }
        
        $response['html'] = ob_get_clean();
        $response['success'] = true;
        $response['found_posts'] = $media_query->found_posts;
        $response['max_pages'] = $media_query->max_num_pages;
    } else {
        // No media found
        $response['html'] = '';
        $response['success'] = true;
        $response['found_posts'] = 0;
        $response['max_pages'] = 0;
    }
    
    wp_reset_postdata();
    
    wp_send_json($response);
}
add_action('wp_ajax_load_more_media', 'ajax_load_more_media');
add_action('wp_ajax_nopriv_load_more_media', 'ajax_load_more_media');
