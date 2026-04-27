<?php
/**
 * AJAX Handler for Project Filtering
 * File location: inc/ajax-project-filter.php
 * 
 * Register AJAX actions in functions.php:
 * require_once get_template_directory() . '/inc/ajax-project-filter.php';
 */

// -----------------------------------------------------------------------
// 1. Enqueue scripts & localize
// -----------------------------------------------------------------------
add_action('wp_enqueue_scripts', 'elryad_enqueue_project_filter_assets');
function elryad_enqueue_project_filter_assets() {
if ( ! is_post_type_archive('project') ) return;

    wp_enqueue_script(
        'elryad-project-filter',
        get_template_directory_uri() . '/js/archive-project-filter.js',
        array('jquery'),
        '1.0.0', 
        true
    );

wp_localize_script('elryad-project-filter', 'elryadAjax', array(
    'ajax_url'            => admin_url('admin-ajax.php'),
    'nonce'               => wp_create_nonce('elryad_project_filter_nonce'),
    'per_page'            => 9,
    'loading_text'        => ml_get('[:en]Loading...[:ar]جاري التحميل...[:]'),
    'no_results'          => ml_get('[:en]No projects found[:ar]لا توجد مشاريع مطابقة للبحث[:]'),
    'location_placeholder'=> ml_get('[:en]Area[:ar]المنطقة[:]'),
    'error_text'          => ml_get('[:en]An error occurred, please try again[:ar]حدث خطأ، يرجى المحاولة مرة أخرى[:]'),
));
}


// -----------------------------------------------------------------------
// 2. AJAX callback (logged-in + non-logged-in users)
// -----------------------------------------------------------------------
add_action('wp_ajax_elryad_filter_projects',        'elryad_filter_projects_callback');
add_action('wp_ajax_nopriv_elryad_filter_projects', 'elryad_filter_projects_callback');

function elryad_filter_projects_callback() {

    // --- Security ---
    check_ajax_referer('elryad_project_filter_nonce', 'nonce');

    // --- Sanitize inputs ---
    $category   = sanitize_text_field( $_POST['category']   ?? 'all' );   // taxonomy slug or 'all'
    $status     = sanitize_text_field( $_POST['status']     ?? ''    );   // project_status slug
    $location   = sanitize_text_field( $_POST['location']   ?? ''    );   // ACF text field value
    $paged      = absint(              $_POST['paged']       ?? 1     );
    $per_page   = absint(              $_POST['per_page']    ?? 9     );

    // --- Build WP_Query args ---
    $args = array(
        'post_type'      => 'project',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    // Tax query collector
    $tax_query = array( 'relation' => 'AND' );

    // --- Category tab filter ---
    if ( $category && $category !== 'all' ) {
        $tax_query[] = array(
            'taxonomy' => 'project_category',
            'field'    => 'slug',
            'terms'    => $category,
        );
    }

    // --- Status filter ---
    if ( $status ) {
        $tax_query[] = array(
            'taxonomy' => 'project_status',
            'field'    => 'slug',
            'terms'    => $status,
        );
    }

    if ( count($tax_query) > 1 ) {
        $args['tax_query'] = $tax_query;
    }

    // --- Location filter (ACF field – meta_query) ---
    if ( $location ) {
        $args['meta_query'] = array(
            array(
                'key'     => 'project_location',   // ACF field name
                'value'   => $location,
                'compare' => 'LIKE',
            ),
        );
    }

    $query = new WP_Query($args);

    // --- Build response ---
    $html        = '';
    $total_pages = $query->max_num_pages;
    $found_posts = $query->found_posts;

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            ob_start();
            set_query_var('card_col_class', 'col-lg-4 col-md-6');
            get_template_part('template-parts/content', 'project-card');
            $html .= ob_get_clean();
        }
        wp_reset_postdata();
    }

    wp_send_json_success(array(
        'html'        => $html,
        'total_pages' => $total_pages,
        'found_posts' => $found_posts,
        'current_page'=> $paged,
    ));
}


// -----------------------------------------------------------------------
// 3. Helper: get distinct ACF location values for the dropdown
// -----------------------------------------------------------------------
add_action('wp_ajax_elryad_get_locations',        'elryad_get_locations_callback');
add_action('wp_ajax_nopriv_elryad_get_locations', 'elryad_get_locations_callback');

function elryad_get_locations_callback() {
    check_ajax_referer('elryad_project_filter_nonce', 'nonce');

    global $wpdb;

    $results = $wpdb->get_col(
        "SELECT DISTINCT pm.meta_value
         FROM {$wpdb->postmeta} pm
         INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
         WHERE pm.meta_key = 'project_location'
           AND p.post_type = 'project'
           AND p.post_status = 'publish'
           AND pm.meta_value != ''
         ORDER BY pm.meta_value ASC"
    );

    // Process qtranslate tags – translate each value to current language
    $translated = array();
    foreach ( array_values( array_filter($results) ) as $value ) {
        $label = function_exists('qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage')
            ? qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage($value)
            : $value;

        $translated[] = array(
            'value' => $value,   // keep raw value for meta_query matching
            'label' => $label,   // translated label for display
        );
    }

    wp_send_json_success( $translated );
}