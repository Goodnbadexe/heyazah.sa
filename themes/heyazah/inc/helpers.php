<?php
/**
 * Helper Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Date Helper Functions
 */

/**
 * Get Arabic Hijri date format
 * Converts Gregorian date to Hijri (Arabic/Islamic calendar)
 * 
 * @param string $date Date in Y-m-d format
 * @return string Formatted Arabic date
 */
if (!function_exists('get_arabic_date')) {
    function get_arabic_date($date = null) {
        if (!$date) {
            $date = date('Y-m-d');
        }
        
        // If IntlDateFormatter is available (better for Hijri dates)
        if (class_exists('IntlDateFormatter')) {
            $formatter = new IntlDateFormatter(
                'ar_SA@calendar=islamic-umalqura',
                IntlDateFormatter::LONG,
                IntlDateFormatter::NONE,
                'Asia/Riyadh',
                IntlDateFormatter::TRADITIONAL
            );
            
            $timestamp = strtotime($date);
            $hijri_date = $formatter->format($timestamp);
            
            return $hijri_date;
        }
        
        // Fallback: Use Arabic month names with Gregorian date
        $arabic_months = array(
            1 => 'يناير',
            2 => 'فبراير',
            3 => 'مارس',
            4 => 'أبريل',
            5 => 'مايو',
            6 => 'يونيو',
            7 => 'يوليو',
            8 => 'أغسطس',
            9 => 'سبتمبر',
            10 => 'أكتوبر',
            11 => 'نوفمبر',
            12 => 'ديسمبر'
        );
        
        $timestamp = strtotime($date);
        $day = date('j', $timestamp);
        $month = date('n', $timestamp);
        $year = date('Y', $timestamp);
        
        return $day . ' ' . $arabic_months[$month] . ' ' . $year;
    }
}

/**
 * Get English Hijri date format
 * Converts Gregorian date to Hijri with English month names
 * 
 * @param string $date Date in Y-m-d format
 * @return string Formatted English Hijri date
 */
if (!function_exists('get_english_hijri_date')) {
    function get_english_hijri_date($date = null) {
        if (!$date) {
            $date = date('Y-m-d');
        }
        
        // If IntlDateFormatter is available (better for Hijri dates)
        if (class_exists('IntlDateFormatter')) {
            $formatter = new IntlDateFormatter(
                'en_SA@calendar=islamic-umalqura',
                IntlDateFormatter::LONG,
                IntlDateFormatter::NONE,
                'Asia/Riyadh',
                IntlDateFormatter::TRADITIONAL
            );
            
            $timestamp = strtotime($date);
            $hijri_date = $formatter->format($timestamp);
            
            return $hijri_date;
        }
        
        // Fallback: Use English month names with Gregorian date
        $english_months = array(
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        );
        
        $timestamp = strtotime($date);
        $day = date('j', $timestamp);
        $month = date('n', $timestamp);
        $year = date('Y', $timestamp);
        
        return $day . ' ' . $english_months[$month] . ' ' . $year;
    }
}

/**
 * Get localized date based on current language
 * Returns English Hijri for English, Arabic Hijri for Arabic
 * 
 * @param string $date Date in Y-m-d format
 * @return string Formatted date based on current language
 */
if (!function_exists('get_localized_date')) {
    function get_localized_date($date = null) {
        if (!$date) {
            $date = date('Y-m-d');
        }
        
        $timestamp = strtotime($date);
        
        // Detect current language (qtranslate-xt or other multilingual plugins)
        $current_lang = 'ar'; // Default to Arabic
        
        if (function_exists('qtranxf_getLanguage')) {
            $current_lang = qtranxf_getLanguage();
        } elseif (function_exists('qtrans_getLanguage')) {
            $current_lang = qtrans_getLanguage();
        } elseif (defined('ICL_LANGUAGE_CODE')) {
            $current_lang = ICL_LANGUAGE_CODE;
        }
        
        // Return English Hijri format for English language
        if ($current_lang === 'en') {
            return get_english_hijri_date($date); // e.g., "15 Muharram 1448"
        }
        
        // Return Arabic/Hijri format for Arabic language
        return get_arabic_date($date);
    }
}

/**
 * Tab System Helper Functions
 */

/**
 * Get current active tab from URL parameter
 * 
 * @param string $default Default tab if none specified
 * @return string Current tab slug
 */
if (!function_exists('get_active_tab')) {
    function get_active_tab($default = 'rent') {
        return isset($_GET['tab']) ? sanitize_key($_GET['tab']) : $default;
    }
}

/**
 * Check if a specific tab is active
 * 
 * @param string $tab_slug Tab slug to check
 * @return bool True if tab is active
 */
if (!function_exists('is_tab_active')) {
    function is_tab_active($tab_slug) {
        return get_active_tab() === $tab_slug;
    }
}

/**
 * Get tab URL for a page
 * 
 * @param int $page_id Page ID
 * @param string $tab_slug Tab slug
 * @return string Full URL with tab parameter
 */
if (!function_exists('get_tab_url')) {
    function get_tab_url($page_id, $tab_slug) {
        return add_query_arg('tab', $tab_slug, get_permalink($page_id));
    }
}

// Helper function to get option with fallback
if (!function_exists('get_theme_option')) {
    function get_theme_option($field_name, $default = '') {
        $value = get_field($field_name, 'option');
        return !empty($value) ? $value : '';
    }
}

// Get theme option only if exists (no default/fallback)
if (!function_exists('get_theme_option_if_exists')) {
    function get_theme_option_if_exists($field_name) {
        $value = get_field($field_name, 'option');
        return !empty($value) ? $value : false;
    }
}

// Display theme option only if exists
if (!function_exists('show_if_exists')) {
    function show_if_exists($field_name, $tag = '', $class = '') {
        $value = get_field($field_name, 'option');
        if (!empty($value)) {
            if ($tag) {
                $class_attr = $class ? ' class="' . esc_attr($class) . '"' : '';
                echo '<' . $tag . $class_attr . '>' . wp_kses_post($value) . '</' . $tag . '>';
            } else {
                echo wp_kses_post($value);
            }
        }
    }
}

/**
 * Translate text using multilingual format
 * Usage: ml_text('[:en]English[:ar]عربى')
 * This function echoes the output
 */
if (!function_exists('ml_text')) {
    function ml_text($text) {
        echo ml_get($text);
    }
}

/**
 * Get translated text (return instead of echo)
 * Usage: $text = ml_get('[:en]English[:ar]عربى')
 */
if (!function_exists('ml_get')) {
    function ml_get($text) {
        // Use qTranslate-XT if available
        if (function_exists('qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage')) {
            return qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage($text);
        }

        // Use Polylang if available
        if (function_exists('pll_current_language')) {
            return $text;
        }

        // Fallback: return raw text
        return $text;
    }
}

// Helper function to get translated option (you'll need to implement based on your translation setup)
if (!function_exists('get_translated_option')) {
    function get_translated_option($field_name, $default = '') {
        // Add your translation logic here
        // This is a placeholder - adapt based on your translation plugin
        $value = get_field($field_name, 'option');
        return $value ? $value : $default;
    }
}

// Helper function to check if ACF is active
if (!function_exists('is_acf_active')) {
    function is_acf_active() {
        return class_exists('ACF');
    }
}

// Helper function to get post meta with fallback
if (!function_exists('get_post_meta_with_fallback')) {
    function get_post_meta_with_fallback($post_id, $key, $default = '') {
        $value = get_post_meta($post_id, $key, true);
        return !empty($value) ? $value : $default;
    }
}



// Add custom body class if not front page
function add_custom_body_class( $classes ) {
    if ( ! is_front_page() ) {
        $classes[] = 'pages';
    }
    return $classes;
}
add_filter( 'body_class', 'add_custom_body_class' );

// escape html from fields acf
// Allow unsafe HTML for specific ACF fields
add_filter( 'acf/the_field/allow_unsafe_html', function( $allowed, $selector ) {
    $allowed_fields = [ 'iframe_map', 'ab_home_des' ]; // Add all allowed fields here

    if ( in_array( $selector, $allowed_fields, true ) ) {
        return true;
    }

    return $allowed;
}, 10, 2 );



// for repeater

// add_filter( 'acf/the_field/allow_unsafe_html', function( $allowed, $selector ) {
//     // Check for the specific repeater subfield 'sico' inside 'non_rep'
//     if ( strpos( $selector, 'non_rep' ) !== false && strpos( $selector, 'sico' ) !== false ) {
//         return true;
//     }

//     return $allowed;
// }, 10, 2 );




/*
	  =========================
	   Pagination bootstrap
	  =========================
*/

function sa_get_bootstrap_paginate_links($custom_query = null) {
    ob_start();

    // Use global $wp_query if no custom query is provided
    $query = $custom_query ? $custom_query : $GLOBALS['wp_query'];


    $current = max(1, absint(get_query_var('paged')));

    // Preserve custom query variables in pagination URLs
    $args = array(
        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
	 // 'base' => str_replace(PHP_INT_MAX, '%#%', esc_url(get_pagenum_link(PHP_INT_MAX))),
        'format' => '?paged=%#%',
        'current' => $current,
        'total' => $query->max_num_pages,
        'type' => 'array',
        'prev_text' => '<i class="fas fa-chevron-right"></i>',
        'next_text' => '<i class="fas fa-chevron-left"></i>',
        // 'add_args' => array(), // Add custom query parameters if needed
    );

    // Add any custom query variables
    // if (!empty($_GET)) {
    //     foreach ($_GET as $key => $value) {
    //         if ($key != 'paged') {
    //             $args['add_args'][$key] = $value;
    //         }
    //     }
    // }

    $pagination = paginate_links($args);

    if (!empty($pagination)) : ?>
        <ul class="pagination">
            <?php foreach ($pagination as $key => $page_link) :
                // Remove 'prev' class and add aria-labels to the links
                if (strpos($page_link, 'prev') !== false) {
                    $page_link = str_replace('prev ', '', $page_link);
                    $page_link = str_replace('<a ', '<a aria-label="Previous" ', $page_link);
                }
                if (strpos($page_link, 'next') !== false) {
                    $page_link = str_replace('<a ', '<a aria-label="Next" ', $page_link);
                }
                // Convert current page span to an anchor tag with 'active' class
                if (strpos($page_link, 'current') !== false) {
                    $page_link = str_replace('<span aria-current="page" class="page-link current">', '<a class="page-link active">', $page_link);
                    $page_link = str_replace('</span>', '</a>', $page_link);
                }
                $page_link_b = str_replace('page-numbers', 'page-link', $page_link);
                ?>
                <li class="page-item <?php if (strpos($page_link, 'active') !== false) echo ' active'; ?>"><?php echo $page_link_b ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif;

    $links = ob_get_clean();
    return apply_filters('sa_bootstrap_paginate_links', $links);
}

function sa_bootstrap_paginate_links($custom_query = null) {
    echo sa_get_bootstrap_paginate_links($custom_query);
}


/*
 	==========================================
 	 Advanced custom post theme options
 	==========================================
 */

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'theme Settings',
		'menu_title'	=> 'اعدادات القالب',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		// 'redirect'		=> false,
		'position' 		=> false,
		'icon_url' 		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'theme General Settings',
		'menu_title'	=> 'الاعدادات العامة',
		'menu_slug' 	=> 'general-setting',
        'capability' 	=> 'edit_posts',
		'parent_slug'	=> 'theme-general-settings',
		'position' 		=> false,
	));

}


function get_youtube_id($url) {
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
    return $matches[1] ?? '';
}



add_action('template_redirect', function() {
    // Get option fields
    $active   = get_field('active', 'option');
    $act_date = get_field('act_date', 'option');
    $today    = date('Y-m-d');

    // Check if the condition is met
    if ( $active && $act_date < $today ) {

        // Avoid redirect loop if soon.php is already being shown
        $soon_path = get_template_directory() . '/soon.php';
        $current_template = basename( get_page_template() );

        // Optional: prevent loading soon.php in admin or AJAX calls
        if ( is_admin() || wp_doing_ajax() ) {
            return;
        }

        // Include the soon page for all front-end requests
        include $soon_path;
        exit; // stop further page rendering
    }
});


// if ( $active && $act_date < $today ) {
//     if ( !is_page('coming-soon') ) {
//         wp_redirect( home_url('/coming-soon/') );
//         exit;
//     }
// }



function dynamic_acf_repeater_select( $tag, $unused ) {
    if ( $tag['name'] != 'your-major' ) {
        return $tag;
    }

    // Get repeater field values from ACF
    $majors = get_field('major_rep', 'option'); 

    if ( !$majors ) {
        return $tag;
    }

    // First option
    $tag['raw_values'][] = "";
    $tag['values'][] = "";
    $tag['labels'][] = __("[:en]Choose Major[:ar]اختر التخصص");

    // Loop through each repeater row
    foreach ( $majors as $major ) {
        $tag['raw_values'][] = sanitize_text_field( $major['major_title'] );
        $tag['values'][] = sanitize_text_field( $major['major_title'] );
        $tag['labels'][] = esc_html( $major['major_title'] );
    }

    return $tag;
}

add_filter( 'wpcf7_form_tag', 'dynamic_acf_repeater_select', 10, 2 );

function dynamic_cpt_select( $tag, $unused ) {
  if ( $tag['name'] != 'your-solution' ) {
    return $tag;
  }

  $args = array(
    'post_type' => 'services', 
    'order' => 'ASC',
  );

  $posts = get_posts( $args );

  if ( ! $posts ) {
    return $tag;
  }
	
	// First option
	$tag['raw_values'][] = "";
	$tag['values'][] = "";
        $tag['labels'][] = __("[:en]Choose Service[:ar]اختر الخدمة");
	// Dynamic options
	foreach ( $posts as $post ) {
		$tag['raw_values'][] = $post->ID; // value
		$tag['values'][] = $post->ID;
		$tag['labels'][] = $post->post_title; // label
	}

  return $tag;
}

add_filter( 'wpcf7_form_tag', 'dynamic_cpt_select', 10, 2 );

/**
 * Disable qTranslate-XT for "sector" taxonomy screens
 */
// add_action( 'current_screen', function ( $screen ) {

//     if (
//         isset( $screen->taxonomy ) &&
//         $screen->taxonomy === 'sector'
//     ) {

//         // Remove qTranslate filters for titles & terms
//         remove_filter( 'gettext', 'qtranxf_gettext', 0 );
//         remove_filter( 'gettext_with_context', 'qtranxf_gettext_with_context', 0 );
//         remove_filter( 'ngettext', 'qtranxf_ngettext', 0 );

//         // Remove content & title filters
//         remove_filter( 'the_title', 'qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage', 0 );
//         remove_filter( 'post_title', 'qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage', 0 );
//     }
// });

/**
 * Hide qTranslate-XT language UI on Sector taxonomy
 */
add_action( 'admin_enqueue_scripts', function () {

    if (
        (isset($_GET['taxonomy']) && $_GET['taxonomy'] === 'sector') 
        // || (isset($_GET['taxonomy']) && $_GET['taxonomy'] === 'project_status')
    ) {
        wp_add_inline_style(
            'wp-admin',
            '.qtranxs-lang-switch-wrap,
             .qtranxs-lang-switch,
             .qtranxs-lang-switch-wrap-term {
                display: none !important;
             }'
        );
    }
});


    // Helper function to parse qTranslate-XT labels
    function qt_label($text) {
        if ( function_exists('qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage') ) {
            return qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage($text);
        }
        return $text;
    }


 /**
 * Get category/type data for a post
 * 
 * @param int|null $post_id Post ID
 * @return array Category data
 */
function get_post_category_data($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $post_type = get_post_type($post_id);
    $category_data = array(
        'name' => '',
        'slug' => '',
    );
    
    if ($post_type === 'project') {
        $categories = get_the_terms($post_id, 'project_category');
        if ($categories && !is_wp_error($categories)) {
            $category_data['name'] = $categories[0]->name;
            $category_data['slug'] = $categories[0]->slug;
        }
    } elseif ($post_type === 'unit') {
        // Units use 'sector' taxonomy (A, B, C, D sectors)
        $sectors = get_the_terms($post_id, 'sector');
        if ($sectors && !is_wp_error($sectors)) {
            $category_data['name'] = $sectors[0]->name;
            $category_data['slug'] = $sectors[0]->slug;
        }
    }
    
    return $category_data;
}

/**
 * Display category badge
 * 
 * @param int|null $post_id Post ID
 * @param bool $echo Echo or return
 * @return string|void HTML output
 */
function display_category_badge($post_id = null, $echo = true) {
    $category = get_post_category_data($post_id);
    
    if (empty($category['name'])) {
        return '';
    }
    
    $output = sprintf(
        '<div class="proj-type"><span>%s</span></div>',
        esc_html($category['name'])
    );
    
    if ($echo) {
        echo $output;
    } else {
        return $output;
    }
}

/**
 * Get all statuses for a specific post type
 * Useful for filters and admin
 * 
 * @param string $post_type Post type
 * @return array|false Array of statuses or false
 */
function get_post_type_statuses($post_type) {
    $config = get_status_config();
    
    if (!isset($config[$post_type])) {
        return false;
    }
    
    return $config[$post_type]['statuses'];
}

/**
 * Get status class by slug
 * 
 * @param string $post_type Post type
 * @param string $status_slug Status slug
 * @return string CSS class
 */
function get_status_class($post_type, $status_slug) {
    $config = get_status_config();
    
    if (isset($config[$post_type]['statuses'][$status_slug]['class'])) {
        return $config[$post_type]['statuses'][$status_slug]['class'];
    }
    
    return sanitize_html_class($status_slug);
}   


function estimate_reading_time($text) {
    if (empty($text)) {
        return '';
    }

    $word_count = str_word_count(
        wp_strip_all_tags($text),
        0,
        'اأإآبتثجحخدذرزسشصضطظعغفقكلمنهوي'
    );

    $minutes = max(1, ceil($word_count / 200));
    // Return translated reading time using ml_get()
    if ($minutes == 1) {
        return $minutes . ' ' . ml_get('[:en]minute read[:ar]دقيقة قراءة[:]');
    } else {
        return $minutes . ' ' . ml_get('[:en]minutes read[:ar]دقائق قراءة[:]');
    }
}
