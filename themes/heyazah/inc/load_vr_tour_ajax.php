<?php
// Add AJAX handler for loading VR tour iframes
add_action('wp_ajax_load_vr_tour', 'load_vr_tour_ajax');
add_action('wp_ajax_nopriv_load_vr_tour', 'load_vr_tour_ajax');

function load_vr_tour_ajax() {
    // Verify nonce for security
    check_ajax_referer('vr_tour_nonce', 'nonce');
    
    $tour_id = isset($_POST['tour_id']) ? intval($_POST['tour_id']) : 0;
    
    if ($tour_id <= 0) {
        wp_send_json_error('Invalid tour ID');
        return;
    }
    
    // Get the ACF repeater data
    if(have_rows('degree_rep', 'option')) {
        $count = 0;
        while(have_rows('degree_rep', 'option')) {
            the_row();
            $count++;
            
            if($count == $tour_id) {
                $iframe_url = get_sub_field('code_iframe');
                $title = get_sub_field('txt');
                
                if (!empty($iframe_url)) {
                    wp_send_json_success(array(
                        'iframe_url' => $iframe_url, // Don't use esc_url here, send raw
                        'title' => esc_html($title)
                    ));
                    return;
                } else {
                    wp_send_json_error('Empty iframe URL for tour #' . $tour_id);
                    return;
                }
            }
        }
    }
    
    wp_send_json_error('Tour #' . $tour_id . ' not found');
}

// Enqueue and localize script
function enqueue_vr_tour_scripts() {
    wp_enqueue_script(
        'load-vr-tour-ajax', 
        get_template_directory_uri() . '/js/load_vr_tour_ajax.js', 
        array('jquery'), 
        time(), // Change to '1.0' after testing
        true
    );
    
    // Localize script with AJAX URL and nonce
    wp_localize_script('load-vr-tour-ajax', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('vr_tour_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_vr_tour_scripts');