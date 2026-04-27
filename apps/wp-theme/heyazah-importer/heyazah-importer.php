<?php
/**
 * Plugin Name: Heyazah Data Importer
 * Description: Imports project JSON data and ACF schema for the new Heyazah website.
 * Version: 1.0.0
 * Author: Heyazah + Goodnbad
 * Text Domain: heyazah-importer
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'HEYAZAH_IMPORTER_DIR', plugin_dir_path( __FILE__ ) );

// Load classes
require_once HEYAZAH_IMPORTER_DIR . 'includes/class-importer.php';

// Register WP-Admin Menu
add_action( 'admin_menu', function() {
    add_management_page(
        'Heyazah Import',
        'Heyazah Import',
        'manage_options',
        'heyazah-importer',
        'heyazah_importer_page_render'
    );
} );

function heyazah_importer_page_render() {
    echo '<div class="wrap">';
    echo '<h1>Heyazah JSON Importer</h1>';
    echo '<p>Click below to import <code>data/projects.json</code> into WordPress Custom Post Types, Taxonomies, and ACF metadata.</p>';
    if (isset($_GET['status']) && $_GET['status'] == 'success') {
        echo '<div class="notice notice-success is-dismissible"><p>Import completed successfully!</p></div>';
    }
    echo '<form method="post" action="' . esc_url(admin_url('admin-post.php')) . '">';
    echo '<input type="hidden" name="action" value="heyazah_import_run">';
    submit_button( 'Run Import' );
    echo '</form>';
    echo '</div>';
}

// Handle Form Submission
add_action( 'admin_post_heyazah_import_run', function() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorized user' );
    }

    $importer = new Heyazah_Importer();
    $importer->run();

    wp_redirect( admin_url( 'tools.php?page=heyazah-importer&status=success' ) );
    exit;
} );
