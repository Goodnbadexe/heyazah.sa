<?php
/**
 * Search AJAX Handlers
 * Handles AJAX load more functionality for search results
 * 
 * @package ELRYAD
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue Search Scripts
 */
function enqueue_search_scripts() {
    // Only load on search results page
    if (is_search()) {
        // Enqueue search AJAX JavaScript
        wp_enqueue_script(
            'search-ajax', 
            ELRYAD_THEME_URL . '/js/search-ajax.js', 
            array('jquery'), 
            '1.0.0', 
            true
        );
        
        // Localize script with AJAX URL and nonce
        wp_localize_script('search-ajax', 'searchAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('search_ajax_nonce'),
            'loading_text' => ml_get('[:en]Loading...[:ar]جاري التحميل...[:]'),
            'load_more_text' => ml_get('[:en]Load More[:ar]عرض المزيد[:]'),
            'no_more_items' => ml_get('[:en]No more results[:ar]لا توجد المزيد من النتائج[:]'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_search_scripts');

/**
 * AJAX Handler: Load More Search Results
 * Handles loading more search results via AJAX
 */
function ajax_load_more_search() {
    // Verify nonce
    check_ajax_referer('search_ajax_nonce', 'nonce');
    
    // Get parameters
    $search_query = isset($_POST['search_query']) ? sanitize_text_field($_POST['search_query']) : '';
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $per_page = 9; // Posts per page (matching initial load)
    
    // Debug logging
    error_log('=== LOAD MORE SEARCH AJAX ===');
    error_log('Search Query: ' . $search_query);
    error_log('Page: ' . $paged);
    
    // Build query args
    $args = array(
        's' => $search_query,
        'posts_per_page' => $per_page,
        'paged' => $paged,
        'post_status' => 'publish',
    );
    
    // Execute query
    $search_query_obj = new WP_Query($args);
    
    // Debug query
    error_log('Query args: ' . print_r($args, true));
    error_log('Found posts: ' . $search_query_obj->found_posts);
    
    $response = array(
        'success' => false,
        'html' => '',
        'found_posts' => 0,
        'max_pages' => 0,
        'current_page' => $paged,
    );
    
    if ($search_query_obj->have_posts()) {
        ob_start();
        
        while ($search_query_obj->have_posts()) {
            $search_query_obj->the_post();
            
            // Get the post type to determine layout
            $post_type = get_post_type();
            
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
            
            <div class="col-lg-4">
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
            <?php
        }
        
        $response['html'] = ob_get_clean();
        $response['success'] = true;
        $response['found_posts'] = $search_query_obj->found_posts;
        $response['max_pages'] = $search_query_obj->max_num_pages;
    } else {
        // No results found
        $response['html'] = '';
        $response['success'] = true;
        $response['found_posts'] = 0;
        $response['max_pages'] = 0;
    }
    
    wp_reset_postdata();
    
    wp_send_json($response);
}
add_action('wp_ajax_load_more_search', 'ajax_load_more_search');
add_action('wp_ajax_nopriv_load_more_search', 'ajax_load_more_search');
