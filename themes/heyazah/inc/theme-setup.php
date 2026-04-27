<?php
/**
 * Theme Setup Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function ELRYAD_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    
    // Register navigation menus
    register_nav_menus(array(
        'header-menu' => __('header Menu', 'elryad'),
        'mobile-menu' => __('mobile Menu', 'elryad'),
    ));
    
    // Set content width
    $GLOBALS['content_width'] = 1200;
    
    // Add image sizes
    add_image_size('ELRYAD-hero', 800, 600, true);
    add_image_size('ELRYAD-project', 600, 400, true);
    add_image_size('ELRYAD-service-icon', 100, 100, true);
    add_image_size('ELRYAD-avatar', 150, 150, true);
}
add_action('after_setup_theme', 'ELRYAD_theme_setup');

// Custom excerpt length
function ELRYAD_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'ELRYAD_excerpt_length');

// Custom excerpt more
function ELRYAD_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ELRYAD_excerpt_more');

// Add Body Classes based on language
function ELRYAD_body_classes($classes) {
    if (function_exists('qtranxf_getLanguage')) {
        $lang = qtranxf_getLanguage();
        $classes[] = 'lang-' . $lang;
        
        if ($lang === 'ar') {
            $classes[] = 'rtl-language';
        }
    }
    return $classes;
}
add_filter('body_class', 'ELRYAD_body_classes');

// Disable WordPress admin bar for all users except administrators
function ELRYAD_disable_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'ELRYAD_disable_admin_bar');

// Custom Admin Styles
function ELRYAD_admin_styles() {
    echo '<style>
    
.multi-language-field .wp-switch-editor[data-language]{display: block !important}
.multi-language-field .wp-switch-editor {background: transparent;}
.multi-language-field .wp-switch-editor.current-language {
    background-color: #282424;
    border-bottom-color: #fff;
    color: #FFF;
}   

.language-tabs-wrapper {
    // margin: 30px 0px;
    display: flex;
    flex-direction: row-reverse;
    // justify-content: flex-end;
}    
    
        .acf-field-group h2 {
            background: #f0f0f1;
            padding: 10px 15px;
            margin: 0 -12px 15px;
            border-left: 3px solid #007cba;
        }
        .acf-options-page .wrap h1::before {
            content: "🏠 ";
            font-size: 24px;
        }
    </style>';
}
add_action('admin_head', 'ELRYAD_admin_styles');


function acf_qtranslate_wrap_tabs() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Wrap language switcher links in a container div
        $('.acf-field .multi-language-field').each(function() {
            var $field = $(this);
            var $langLinks = $field.find('> a.wp-switch-editor');
            
            if ($langLinks.length > 0 && !$langLinks.parent().hasClass('language-tabs-wrapper')) {
                $langLinks.wrapAll('<div class="language-tabs-wrapper"></div>');
            }
        });
        
        // Handle tab switching
        // $(document).on('click', '.acf-field .wp-switch-editor', function(e) {
        //     e.preventDefault();
        //     var $this = $(this);
        //     var language = $this.data('language');
        //     var $wrapper = $this.closest('.multi-language-field');
            
        //     // Update active tab
        //     $wrapper.find('.wp-switch-editor').removeClass('current-language');
        //     $this.addClass('current-language');
            
        //     // Update active input
        //     $wrapper.find('.qtranxs-translatable').removeClass('current-language');
        //     $wrapper.find('.qtranxs-translatable[data-language="' + language + '"]').addClass('current-language');
        // });
    });
    </script>
    <?php
}
add_action('admin_footer', 'acf_qtranslate_wrap_tabs');

