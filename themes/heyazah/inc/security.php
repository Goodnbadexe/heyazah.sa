<?php
/**
 * Security Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Remove version strings from scripts and styles
function ELRYAD_remove_version_strings($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'ELRYAD_remove_version_strings', 9999);
add_filter('script_loader_src', 'ELRYAD_remove_version_strings', 9999);

// Hide WordPress version
function ELRYAD_remove_wp_version() {
    return '';
}
add_filter('the_generator', 'ELRYAD_remove_wp_version');

// Optimize WordPress - remove unnecessary features
function ELRYAD_optimize_wordpress() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}
add_action('init', 'ELRYAD_optimize_wordpress');