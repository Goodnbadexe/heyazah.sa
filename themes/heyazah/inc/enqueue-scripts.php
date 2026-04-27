<?php
/**
 * Enqueue Scripts and Styles
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue styles and scripts
function ELRYAD_enqueue_scripts() {

    /* =========================
     * STYLES (LOW → HIGH PRIORITY)
     * ========================= */

    // Vendor / base styles
    wp_enqueue_style(
        'elryad-bootstrap',
        ELRYAD_THEME_URL . '/assets/css/bootstrap.min.css',
        array(),
        ELRYAD_THEME_VERSION
    );

    wp_enqueue_style(
        'elryad-owl',
        ELRYAD_THEME_URL . '/assets/css/owl.carousel.css',
        array('elryad-bootstrap'),
        ELRYAD_THEME_VERSION
    );

    wp_enqueue_style(
        'elryad-owl-theme',
        ELRYAD_THEME_URL . '/assets/css/owl.theme.default.min.css',
        array('elryad-owl'),
        ELRYAD_THEME_VERSION
    );

    wp_enqueue_style(
        'elryad-animate',
        ELRYAD_THEME_URL . '/assets/css/animate.css',
        array(),
        ELRYAD_THEME_VERSION
    );

    wp_enqueue_style(
        'elryad-lineawesome',
        ELRYAD_THEME_URL . '/assets/css/line-awesome.min.css',
        array(),
        ELRYAD_THEME_VERSION
    );

    wp_enqueue_style(
        'elryad-fontawesome',
        ELRYAD_THEME_URL . '/assets/css/all.css',
        array(),
        ELRYAD_THEME_VERSION
    );

    wp_enqueue_style(
        'elryad-nice-select',
        ELRYAD_THEME_URL . '/assets/css/nice-select.css',
        array(),
        ELRYAD_THEME_VERSION
    );

    wp_enqueue_style(
        'elryad-fancybox',
        ELRYAD_THEME_URL . '/assets/css/jquery.fancybox.css',
        array(),
        ELRYAD_THEME_VERSION
    );

    wp_enqueue_style(
        'elryad-odometer',
        ELRYAD_THEME_URL . '/assets/css/edomiter.css',
        array(),
        ELRYAD_THEME_VERSION
    );

    if ( is_singular( 'project' ) ) {
        wp_enqueue_style(
            'elryad-rangeSlider',
            ELRYAD_THEME_URL . '/assets/css/ion.rangeSlider.min.css',
            array(),
            ELRYAD_THEME_VERSION
        ); 
    }
    /* =========================
     * OVERRIDE STYLES (LAST)
     * ========================= */
// style.css (MAIN OVERRIDE - FIRST)
wp_enqueue_style(
    'elryad-style',
    ELRYAD_THEME_URL . '/assets/css/style.css',
    array(),
    file_exists( ELRYAD_THEME_DIR . '/assets/css/style.css' )
        ? filemtime( ELRYAD_THEME_DIR . '/assets/css/style.css' )
        : ELRYAD_THEME_VERSION
);

// LTR (AFTER style.css)
if ( ! is_rtl() ) {
    wp_enqueue_style(
        'elryad-en',
        ELRYAD_THEME_URL . '/assets/css/style-en.css',
        array('elryad-style'), // 👈 depends on main style
        file_exists( ELRYAD_THEME_DIR . '/assets/css/style-en.css' )
            ? filemtime( ELRYAD_THEME_DIR . '/assets/css/style-en.css' )
            : ELRYAD_THEME_VERSION
    );
}

// Mobile (ALWAYS LAST)
wp_enqueue_style(
    'elryad-style-mobile',
    ELRYAD_THEME_URL . '/assets/css/style-mobile.css',
    is_rtl()
        ? array('elryad-style')                 // RTL → no EN dependency
        : array('elryad-style', 'elryad-en'),   // LTR → after EN
    file_exists( ELRYAD_THEME_DIR . '/assets/css/style-mobile.css' )
        ? filemtime( ELRYAD_THEME_DIR . '/assets/css/style-mobile.css' )
        : ELRYAD_THEME_VERSION
);

if ( is_front_page() || is_home() ) {
    wp_enqueue_style(
        'elryad-site-entrance',
        ELRYAD_THEME_URL . '/assets/css/site-entrance.css',
        array('elryad-style-mobile'),
        file_exists( ELRYAD_THEME_DIR . '/assets/css/site-entrance.css' )
            ? filemtime( ELRYAD_THEME_DIR . '/assets/css/site-entrance.css' )
            : ELRYAD_THEME_VERSION
    );
}

	
    /* =========================
     * SCRIPTS
     * ========================= */

    // wp_enqueue_script('jquery');

    // Enqueue custom jQuery first
    wp_enqueue_script(
        'elryad-jquery',
        ELRYAD_THEME_URL . '/assets/js/jquery-1.11.0.min.js',
        array(), // no dependency
        filemtime( ELRYAD_THEME_DIR . '/assets/js/jquery-1.11.0.min.js' ),
        true
    );

    wp_enqueue_script(
        'elryad-popper',
        ELRYAD_THEME_URL . '/assets/js/popper.js',
        array('elryad-jquery'),
        ELRYAD_THEME_VERSION,
        true
    );

    wp_enqueue_script(
        'elryad-bootstrap',
        ELRYAD_THEME_URL . '/assets/js/bootstrap.min.js',
        array('elryad-jquery', 'elryad-popper'),
        ELRYAD_THEME_VERSION,
        true
    );

    wp_enqueue_script(
        'elryad-owl',
        ELRYAD_THEME_URL . '/assets/js/owl.carousel.min.js',
        array('elryad-jquery'),
        ELRYAD_THEME_VERSION,
        true
    );

    wp_enqueue_script(
        'elryad-responsive-carousel',
        ELRYAD_THEME_URL . '/assets/js/responsiveCarousel.min.js',
        array('elryad-jquery'),
        ELRYAD_THEME_VERSION,
        true
    );

    wp_enqueue_script(
        'elryad-nice-select',
        ELRYAD_THEME_URL . '/assets/js/jquery.nice-select.min.js',
        array('elryad-jquery'),
        ELRYAD_THEME_VERSION,
        true
    );

    wp_enqueue_script(
        'elryad-wow',
        ELRYAD_THEME_URL . '/assets/js/wow.min.js',
        array('elryad-jquery'),
        ELRYAD_THEME_VERSION,
        true
    );

    wp_enqueue_script(
        'elryad-fancybox',
        ELRYAD_THEME_URL . '/assets/js/jquery.fancybox.js',
        array('elryad-jquery'),
        ELRYAD_THEME_VERSION,
        true
    );

    wp_enqueue_script(
        'elryad-odometer',
        ELRYAD_THEME_URL . '/assets/js/odometer.min.js',
        array('elryad-jquery'),
        ELRYAD_THEME_VERSION,
        true
    );

    wp_enqueue_script(
        'elryad-viewport',
        ELRYAD_THEME_URL . '/assets/js/viewport.jquery.js',
        array('elryad-jquery'),
        ELRYAD_THEME_VERSION,
        true
    );

    if ( is_singular( 'project' ) ) {
    //     wp_enqueue_script(
    //         'elryad-rangeSlider',
    //         ELRYAD_THEME_URL . '/assets/js/ion.rangeSlider.min.js',
    //         array('elryad-jquery'),
    //         ELRYAD_THEME_VERSION,
    //         true
    //     );       
        
    // // Enqueue your custom JS file
    // wp_enqueue_script('estate-ajax', ELRYAD_THEME_URL . '/js/estate-ajax.js', array('jquery'), '1.0', true);
    
    // // Localize script with AJAX URL and nonce
    // wp_localize_script('estate-ajax', 'estateAjax', array(
    //     'ajaxurl' => admin_url('admin-ajax.php'),
    //     'nonce' => wp_create_nonce('estate_ajax_nonce'),
    //     'loading_text' => __('جاري التحميل...', 'textdomain'),
    //     'load_more_text' => __('عرض المزيد', 'textdomain'),
    //     'no_more_units' => __('لا توجد المزيد من الوحدات', 'textdomain'),
    // ));        


    }

    // MAIN JS (LAST — OVERRIDES ALL)
    wp_enqueue_script(
        'elryad-main',
        ELRYAD_THEME_URL . '/assets/js/main.js',
        array('elryad-jquery'),
        file_exists( ELRYAD_THEME_DIR . '/assets/js/main.js' )
            ? filemtime( ELRYAD_THEME_DIR . '/assets/js/main.js' )
            : ELRYAD_THEME_VERSION,
        true
    );

    if ( is_front_page() || is_home() ) {
        wp_enqueue_script(
            'elryad-site-entrance',
            ELRYAD_THEME_URL . '/assets/js/site-entrance.js',
            array(),
            file_exists( ELRYAD_THEME_DIR . '/assets/js/site-entrance.js' )
                ? filemtime( ELRYAD_THEME_DIR . '/assets/js/site-entrance.js' )
                : ELRYAD_THEME_VERSION,
            true
        );
    }
    
    
    if(is_home()):
    
    wp_enqueue_script(
        'elryad-gsap',
        ELRYAD_THEME_URL . '/assets/vendor/gsap/gsap-latest-beta.min.js',
        array('elryad-jquery'),
        file_exists( ELRYAD_THEME_DIR . '/assets/vendor/gsap/gsap-latest-beta.min.js' )
            ? filemtime( ELRYAD_THEME_DIR . '/assets/vendor/gsap/gsap-latest-beta.min.js' )
            : ELRYAD_THEME_VERSION,
        true
    );
    
    
    wp_enqueue_script(
        'elryad-scrollTrigger',
        ELRYAD_THEME_URL . '/assets/vendor/gsap/ScrollTrigger.min.js',
        array('elryad-jquery'),
        file_exists( ELRYAD_THEME_DIR . '/assets/vendor/gsap/ScrollTrigger.min.js' )
            ? filemtime( ELRYAD_THEME_DIR . '/assets/vendor/gsap/ScrollTrigger.min.js' )
            : ELRYAD_THEME_VERSION,
        true
    );
    
    
    wp_enqueue_script(
        'elryad-scrollToPlugin',
        ELRYAD_THEME_URL . '/assets/vendor/gsap/ScrollToPlugin.min.js',
        array('elryad-jquery'),
        file_exists( ELRYAD_THEME_DIR . '/assets/vendor/gsap/ScrollToPlugin.min.js' )
            ? filemtime( ELRYAD_THEME_DIR . '/assets/vendor/gsap/ScrollToPlugin.min.js' )
            : ELRYAD_THEME_VERSION,
        true
    );
    
    
    wp_enqueue_script(
        'elryad-animation',
        ELRYAD_THEME_URL . '/assets/vendor/gsap/animation-h.js',
        array('elryad-jquery'),
        file_exists( ELRYAD_THEME_DIR . '/assets/vendor/gsap/animation-h.js' )
            ? filemtime( ELRYAD_THEME_DIR . '/assets/vendor/gsap/animation-h.js' )
            : ELRYAD_THEME_VERSION,
        true
    );
    
    endif;
    // Nav Push Menu
    wp_enqueue_style(
        'nav-push-menu-css',
        ELRYAD_THEME_URL . '/assets/css/nav-push-menu.css',
        array(),
        '1.0.0',
        'all'
    );
    wp_enqueue_script(
        'nav-push-menu-js',
        ELRYAD_THEME_URL . '/assets/js/nav-push-menu.js',
        array(),
        '1.0.0',
        true
    );
}

add_action( 'wp_enqueue_scripts', 'ELRYAD_enqueue_scripts', 100 );


function ELRYAD_remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];

        if ( $script->deps ) {
            // Remove 'jquery-migrate' from dependencies
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'ELRYAD_remove_jquery_migrate' );
