<?php
/**
 * Maintenance Mode Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Maintenance mode functionality
function check_maintenance_mode() {
    $maintenance_mode = get_field('maintenance_mode', 'option');
    
    if ($maintenance_mode && !current_user_can('manage_options')) {
        $maintenance_title = get_translated_option('maintenance_title', 'We\'ll be back soon!');
        $maintenance_message = get_translated_option('maintenance_message', 'We are currently performing scheduled maintenance.');
        $maintenance_background = get_field('maintenance_background', 'option');
        
        status_header(503);
        nocache_headers();
        
        include(get_template_directory() . '/maintenance.php');
        exit();
    }
}
add_action('template_redirect', 'check_maintenance_mode');