<?php
/**
 * AJAX Handler: Filter Units
 * Handles filtering units by price, status, floor, and rooms
 */


// Enqueue scripts and localize AJAX
add_action('wp_enqueue_scripts', 'estate_enqueue_ajax_scripts');
function estate_enqueue_ajax_scripts() {

    if ( is_singular( 'project' ) ) {
        // CSS
        wp_enqueue_style(
            'ion-rangeslider-css',
            'https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css',
            array(),
            '2.3.1'
        );

        // JS
        wp_enqueue_script(
            'ion-rangeslider-js',
            'https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js',
            array( 'jquery' ),
            '2.3.1',
            true
        );
        
        // Enqueue your custom JS file
        wp_enqueue_script('estate-ajax', ELRYAD_THEME_URL . '/js/estate-ajax.js', array('jquery'), '1.0', true);
    
    
    }

    
    // Localize script with AJAX URL and nonce
    wp_localize_script('estate-ajax', 'estateAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('estate_ajax_nonce'),
        'loading_text' => __('جاري التحميل...', 'textdomain'),
        'load_more_text' => __('عرض المزيد', 'textdomain'),
        'no_more_units' => __('لا توجد المزيد من الوحدات', 'textdomain'),
    ));
}


// Handles filtering units by price, status, floor, and rooms

add_action('wp_ajax_filter_units', 'ajax_filter_units');
add_action('wp_ajax_nopriv_filter_units', 'ajax_filter_units');

function ajax_filter_units() {
    // Verify nonce
    check_ajax_referer('estate_ajax_nonce', 'nonce');
    
    // Get filter parameters
    $project_id = isset($_POST['project_id']) ? intval($_POST['project_id']) : 0;
    $sector = isset($_POST['sector']) ? sanitize_text_field($_POST['sector']) : '';
    $price_min = isset($_POST['price_min']) ? intval($_POST['price_min']) : 0;
    $price_max = isset($_POST['price_max']) ? intval($_POST['price_max']) : 999999999;
    $status = isset($_POST['status']) ? sanitize_text_field($_POST['status']) : 'all';
    $floor = isset($_POST['floor']) ? sanitize_text_field($_POST['floor']) : 'all';
    $rooms = isset($_POST['rooms']) ? sanitize_text_field($_POST['rooms']) : 'all';
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $per_page = 6; // Units per page
    
    // Debug logging
    error_log('=== FILTER UNITS AJAX ===');
    error_log('Project ID: ' . $project_id);
    error_log('Sector: ' . $sector);
    error_log('Price: ' . $price_min . ' - ' . $price_max);
    error_log('Status: ' . $status);
    error_log('Floor: ' . $floor);
    error_log('Rooms: ' . $rooms);
    error_log('Page: ' . $paged);
    
    // Build query args
    $args = array(
        'post_type' => 'unit',
        'posts_per_page' => $per_page,
        'paged' => $paged,
        'post_status' => 'publish',
    );
    
    // Meta query for project relationship and price
    $meta_query = array('relation' => 'AND');
    
    if ($project_id) {
        $meta_query[] = array(
            'key' => 'unit_project',
            'value' => $project_id,
            'compare' => '='
        );
    }
    
    // Price filter
    if ($price_min > 0 || $price_max < 999999999) {
        $meta_query[] = array(
            'key' => 'unit_price',
            'value' => array($price_min, $price_max),
            'type' => 'NUMERIC',
            'compare' => 'BETWEEN'
        );
    }
    
    // Status filter - REMOVED (handled in tax_query below)
    // Status is stored in taxonomy 'unit_status', not in meta field
    
    // Floor filter
    if ($floor !== 'all') {
        $meta_query[] = array(
            'key' => 'unit_floor_name',
            'value' => $floor,
            'compare' => '='
        );
    }
    
    // Rooms filter
    if ($rooms !== 'all') {
        $meta_query[] = array(
            'key' => 'unit_bedrooms',
            'value' => intval($rooms),
            'type' => 'NUMERIC',
            'compare' => '='
        );
    }
    
    if (count($meta_query) > 1) {
        $args['meta_query'] = $meta_query;
    }
    
    // Tax query for sector and status
    $tax_query = array('relation' => 'AND');
    
    if (!empty($sector)) {
        $tax_query[] = array(
            'taxonomy' => 'sector',
            'field' => 'slug',
            'terms' => $sector,
        );
    }
    
    // Status filter (taxonomy)
    if ($status !== 'all') {
        $tax_query[] = array(
            'taxonomy' => 'unit_status',
            'field' => 'slug',
            'terms' => $status,
        );
    }
    
    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    }
    
    // Execute query
    $units_query = new WP_Query($args);
    
    // Debug query
    error_log('Query args: ' . print_r($args, true));
    error_log('Found posts: ' . $units_query->found_posts);
    error_log('SQL: ' . $units_query->request);
    
    $response = array(
        'success' => false,
        'html' => '',
        'found_posts' => 0,
        'max_pages' => 0,
        'current_page' => $paged,
    );
    
    if ($units_query->have_posts()) {
        ob_start();
        
        while ($units_query->have_posts()) {
            $units_query->the_post();
            get_template_part('template-parts/content', 'unit-card');
        }
        
        $response['html'] = ob_get_clean();
        $response['success'] = true;
        $response['found_posts'] = $units_query->found_posts;
        $response['max_pages'] = $units_query->max_num_pages;
    } else {
        // No units found matching filters
        $response['html'] = '<div class="col-12 text-center py-5"><p>' . ml_get('[:en]No units match the selected filters[:ar]لا توجد وحدات متطابقة مع الفلاتر المحددة[:]') . '</p></div>';
        $response['success'] = true;
        $response['found_posts'] = 0;
        $response['max_pages'] = 0;
    }
    
    wp_reset_postdata();
    
    wp_send_json($response);
}

/**
 * AJAX Handler: Get Filter Counts
 * Returns counts for each filter option
 */
add_action('wp_ajax_get_filter_counts', 'ajax_get_filter_counts');
add_action('wp_ajax_nopriv_get_filter_counts', 'ajax_get_filter_counts');

function ajax_get_filter_counts() {
    check_ajax_referer('estate_ajax_nonce', 'nonce');
    
    $project_id = isset($_POST['project_id']) ? intval($_POST['project_id']) : 0;
    $sector = isset($_POST['sector']) ? sanitize_text_field($_POST['sector']) : '';
    
    $counts = array(
        'status' => array(),
        'floor' => array(),
        'rooms' => array(),
    );
    
    // Base args
    $base_args = array(
        'post_type' => 'unit',
        'posts_per_page' => -1,
        'fields' => 'ids',
        'meta_query' => array(
            array(
                'key' => 'unit_project',
                'value' => $project_id,
                'compare' => '='
            )
        ),
    );
    
    if (!empty($sector)) {
        $base_args['tax_query'] = array(
            array(
                'taxonomy' => 'sector',
                'field' => 'slug',
                'terms' => $sector,
            )
        );
    }
    
    // Get all units for this project/sector
    $all_units = new WP_Query($base_args);
    $counts['total'] = $all_units->found_posts;
    
    // Count by status (taxonomy)
    $status_options = array('available', 'reserved', 'sold');
    foreach ($status_options as $status_value) {
        $args = $base_args;
        
        // Add status taxonomy to existing tax_query
        if (isset($args['tax_query'])) {
            $args['tax_query']['relation'] = 'AND';
            $args['tax_query'][] = array(
                'taxonomy' => 'unit_status',
                'field' => 'slug',
                'terms' => $status_value,
            );
        } else {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'unit_status',
                    'field' => 'slug',
                    'terms' => $status_value,
                )
            );
        }
        
        $query = new WP_Query($args);
        $counts['status'][$status_value] = $query->found_posts;
    }
    
    // Count by floor
    $floor_options = array('ground', 'first', 'second', 'third', 'fourth', 'fifth');
    foreach ($floor_options as $floor_value) {
        $args = $base_args;
        $args['meta_query'][] = array(
            'key' => 'unit_floor_name',
            'value' => $floor_value,
            'compare' => '='
        );
        $query = new WP_Query($args);
        $counts['floor'][$floor_value] = $query->found_posts;
    }
    
    // Count by rooms
    for ($i = 1; $i <= 5; $i++) {
        $args = $base_args;
        $args['meta_query'][] = array(
            'key' => 'unit_bedrooms',
            'value' => $i,
            'type' => 'NUMERIC',
            'compare' => '='
        );
        $query = new WP_Query($args);
        $counts['rooms'][$i] = $query->found_posts;
    }
    
    wp_reset_postdata();
    
    wp_send_json_success($counts);
}