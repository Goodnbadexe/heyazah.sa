<?php
/**
 * WordPress Core Customizations
 */

defined('ABSPATH') || exit;

/**
 * Remove prefixes from archive titles
 */
add_filter('get_the_archive_title', function($title) {    
    if (is_category()) {    
        return single_cat_title('', false);    
    } elseif (is_tag()) {    
        return single_tag_title('', false);    
    } elseif (is_author()) {    
        return get_the_author();    
    } elseif (is_tax()) {
        return single_term_title('', false);
    } elseif (is_post_type_archive()) {
        return post_type_archive_title('', false);
    }
    return $title;    
});



/**
 * Remove auto-paragraph from Contact Form 7
 */
add_filter('wpcf7_autop_or_not', '__return_false');


/**
 * Clean up admin menu
 */
add_action('admin_menu', function() {
    $pages_to_remove = [
        'tools.php',
        'edit-comments.php', 
        'edit.php',
        'loginpress-settings',
        // 'edit.php?post_type=acf-field-group'
    ];
    
    foreach ($pages_to_remove as $page) {
        remove_menu_page($page);
    }
});

/**
 * Custom login page styling
 */
add_action('login_enqueue_scripts', function() {
    $logo_url = get_field('logo', 'option');
    ?>
    <style>
        body.login {
            background-color: #fdfdfdff;
        }
        
        .login form {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        <?php if ($logo_url) : ?>
        #login h1 a, .login h1 a {
            background-image: url(<?php echo esc_url($logo_url); ?>);
            width: auto;
              height: auto;
              max-width: 322px;
              min-height: 96px;
              background-color: transparent;
              padding: 15px;
              background-size: auto;
              background-position: center;
              border-radius: 10px;
        }
        <?php endif; ?>
        
        .wp-core-ui .button-primary {
            background: #0073aa;
            border-color: #0073aa;
            border-radius: 4px;
        }
        
        .wp-core-ui .button-primary:hover {
            background: #005a87;
            border-color: #005a87;
        }
    </style>
    <?php
});

/**
 * Customize login URL (if logo is set)
 */
add_filter('login_headerurl', function() {
    return home_url();
});

/**
 * Customize login title
 */
add_filter('login_headertext', function() {
    return get_bloginfo('name');
});

/**
 * Remove unnecessary dashboard widgets
 */
add_action('wp_dashboard_setup', function() {
    global $wp_meta_boxes;
    
    $widgets_to_remove = [
        'dashboard_incoming_links',
        'dashboard_plugins',
        'dashboard_primary',
        'dashboard_secondary',
        'dashboard_quick_press',
        'dashboard_recent_drafts',
        'dashboard_recent_comments',
        'dashboard_right_now',
        'dashboard_activity'
    ];
    
    foreach ($widgets_to_remove as $widget) {
        unset($wp_meta_boxes['dashboard']['normal']['core'][$widget]);
        unset($wp_meta_boxes['dashboard']['side']['core'][$widget]);
    }
});

/**
 * Disable file editing in admin
 */
// if (!defined('DISALLOW_FILE_EDIT')) {
//     define('DISALLOW_FILE_EDIT', true);
// }


/**
 * Security: Hide login errors
 */
// add_filter('login_errors', function() {
//     return 'Invalid login credentials.';
// });

/**
 * Remove admin bar for non-admins
 */
add_action('after_setup_theme', function() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
});


// add_action('admin_enqueue_scripts', function () {

//     // Only run if ACF is active
//     if ( ! wp_style_is('acf-input', 'registered') ) {
//         return;
//     }

//     // Make sure ACF admin styles are loaded first
//     wp_enqueue_style('acf-input');

//     // Add inline CSS for qTranslate-XT language tabs inside ACF fields
//     wp_add_inline_style('acf-input', '
//         /* Container for the multi-language switcher */
//         .multi-language-field {
//             display: flex !important;
//             align-items: center !important;
//             gap: 8px !important;
//             margin-bottom: 10px !important;
//             flex-wrap: wrap !important;
//         }

//         /* Language tabs */
//         .multi-language-field .wp-switch-editor {
//             padding: 6px 14px !important;
//             border: 1px solid #d0d7de !important;
//             border-radius: 6px !important;
//             background: #f6f8fa !important;
//             font-size: 13px !important;
//             font-weight: 500 !important;
//             color: #24292f !important;
//             cursor: pointer !important;
//             transition: all 0.2s ease-in-out !important;
//             text-transform: capitalize !important;
//             margin-bottom: 10px !important;
//             margin-inline-start: 10px !important;
//         }

//         /* Hover effect */
//         .multi-language-field .wp-switch-editor:hover {
//             background: #e9ecef !important;
//             border-color: #c4c9ce !important;
//         }

//         /* Active tab */
//         .multi-language-field .wp-switch-editor.current-language {
//             background: #2271b1 !important;
//             color: #fff !important;
//             border-color: #2271b1 !important;
//             box-shadow: 0 2px 6px rgba(44, 123, 229, 0.3) !important;
//         }

//         /* Inputs for translations */
//         .multi-language-field .qtranxs-translatable {
//             flex: 1 1 100% !important;
//             padding: 8px 10px !important;
//             border: 1px solid #d0d7de !important;
//             border-radius: 6px !important;
//             font-size: 14px !important;
//             background: #fff !important;
//             transition: border-color 0.2s !important;
//         }

//         /* Input focus state */
//         .multi-language-field .qtranxs-translatable:focus {
//             border-color: #2271b1 !important;
//             box-shadow: 0 0 0 2px rgba(44, 123, 229, 0.2) !important;
//             outline: none !important;
//         }

//         /* Hide inactive language input */
//         .multi-language-field .qtranxs-translatable:not(.current-language) {
//             display: none !important;
//         }
//     ');
// });



// add_action('admin_enqueue_scripts', function () {
//     wp_add_inline_style('acf-input', '
//         /* Hide qTranslate-XT language tabs */
//         .multi-language-field .wp-switch-editor,
//         .qtranxs-lang-switch-wrap,
//         .qtranxs-lang-switch { 
//             display: none !important; 
//         }

//         /* Always show all textareas/inputs */
//         .multi-language-field .qtranxs-translatable {
//             display: block !important;
//         }
//     ');
// });
