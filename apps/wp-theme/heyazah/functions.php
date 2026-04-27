<?php
/**
 * Heyazah theme bootstrap.
 *
 * @package Heyazah
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'HEYAZAH_THEME_VERSION', '1.0.0' );
define( 'HEYAZAH_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'HEYAZAH_THEME_URL', trailingslashit( get_template_directory_uri() ) );

require_once HEYAZAH_THEME_DIR . 'inc/cpt.php';
require_once HEYAZAH_THEME_DIR . 'inc/taxonomies.php';
require_once HEYAZAH_THEME_DIR . 'inc/acf-fields.php';
require_once HEYAZAH_THEME_DIR . 'inc/enqueue.php';
require_once HEYAZAH_THEME_DIR . 'inc/immersive.php';

add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
    load_theme_textdomain( 'heyazah', HEYAZAH_THEME_DIR . 'languages' );
} );

// RTL support. WP flips via text direction; we also add an inline class.
add_filter( 'body_class', function ( $classes ) {
    $classes[] = is_rtl() ? 'h-dir-rtl' : 'h-dir-ltr';
    $classes[] = 'h-theme';
    return $classes;
} );

// ACF local-json: load field groups from /acf-json/.
add_filter( 'acf/settings/load_json', function ( $paths ) {
    $paths[] = HEYAZAH_THEME_DIR . 'acf-json';
    return $paths;
} );

/**
 * Enable slug-based taxonomy queries in FSE via custom classes
 */
add_filter( 'query_loop_block_query_vars', function( $query, $block ) {
    $classes = $block->parsed_block['attrs']['className'] ?? '';
    if ( ! empty( $classes ) ) {
        $term = '';
        if ( strpos( $classes, 'h-query-status-completed' ) !== false ) {
            $term = 'completed';
        } elseif ( strpos( $classes, 'h-query-status-ongoing' ) !== false ) {
            $term = 'ongoing';
        } elseif ( strpos( $classes, 'h-query-status-pipeline' ) !== false ) {
            $term = 'pipeline';
        }

        if ( ! empty( $term ) ) {
            $query['tax_query'] = array(
                array(
                    'taxonomy' => 'project_status',
                    'field'    => 'slug',
                    'terms'    => $term,
                )
            );
        }
    }
    return $query;
}, 10, 2 );
