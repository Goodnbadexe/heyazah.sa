<?php
/**
 * Helper Functions for Status Management
 */

/**
 * Get status configuration for all post types
 * Centralized status management
 * 
 * @return array Status configuration
 */
function get_status_config() {
    return array(
        'project' => array(
            'type' => 'taxonomy',
            'taxonomy' => 'project_status',
            'statuses' => array(
                'completed' => array(
                    'class' => 'complete',
                    'label_en' => 'Completed',
                    'label_ar' => 'مكتمل',
                    'icon' => 'check-circle', // Optional: for icons
                ),
                'ongoing' => array(
                    'class' => 'Under-implementation',
                    'label_en' => 'progress',
                    'label_ar' => 'قيد التنفيذ',
                    'icon' => 'clock',
                ),
            ),
        ),
        'unit' => array(
            'type' => 'taxonomy',
            'taxonomy' => 'unit_status',
            'statuses' => array(
                'available' => array(
                    'class' => 'available',
                    'label_en' => 'Available',
                    'label_ar' => 'متاح',
                    'icon' => 'check',
                ),
                'reserved' => array(
                    'class' => 'reserved',
                    'label_en' => 'Reserved',
                    'label_ar' => 'محجوز',
                    'icon' => 'clock',
                ),
                'sold' => array(
                    'class' => 'sold',
                    'label_en' => 'Sold',
                    'label_ar' => 'مباع',
                    'icon' => 'times-circle',
                ),
            ),
        ),
    );
}

/**
 * Get status data for a specific post
 * 
 * @param int|null $post_id Post ID (defaults to current post)
 * @return array|false Status data or false if not found
 */
function get_post_status_data($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $post_type = get_post_type($post_id);
    $config = get_status_config();
    
    if (!isset($config[$post_type])) {
        return false;
    }
    
    $type_config = $config[$post_type];
    $status_data = array(
        'name' => '',
        'class' => '',
        'icon' => '',
        'slug' => '',
    );
    
    if ($type_config['type'] === 'taxonomy') {
        // Get from taxonomy
        $terms = get_the_terms($post_id, $type_config['taxonomy']);
        
        if ($terms && !is_wp_error($terms)) {
            $status_slug = $terms[0]->slug;
            $status_data['slug'] = $status_slug;
            
            if (isset($type_config['statuses'][$status_slug])) {
                $status_info = $type_config['statuses'][$status_slug];
                $status_data['name'] = ml_get('[:en]' . $status_info['label_en'] . '[:ar]' . $status_info['label_ar']);
                $status_data['class'] = $status_info['class'];
                $status_data['icon'] = isset($status_info['icon']) ? $status_info['icon'] : '';
            } else {
                // Use term name if not in config
                $status_data['name'] = $terms[0]->name;
                $status_data['class'] = sanitize_html_class($status_slug);
            }
        }
        
    } elseif ($type_config['type'] === 'acf') {
        // Get from ACF field
        $status_value = get_field($type_config['field_name'], $post_id);
        
        if ($status_value && isset($type_config['statuses'][$status_value])) {
            $status_info = $type_config['statuses'][$status_value];
            $status_data['slug'] = $status_value;
            $status_data['name'] = ml_get('[:en]' . $status_info['label_en'] . '[:ar]' . $status_info['label_ar']);
            $status_data['class'] = $status_info['class'];
            $status_data['icon'] = isset($status_info['icon']) ? $status_info['icon'] : '';
        }
    }
    
    return $status_data;
}

/**
 * Check if post has a specific status (by slug)
 * This is the RECOMMENDED approach - use slug comparison
 * 
 * @param string $status_slug Status slug to check (e.g., 'sold', 'available', 'completed')
 * @param int|null $post_id Post ID (defaults to current post)
 * @return bool True if post has the specified status
 */
function has_post_status($status_slug, $post_id = null) {
    $status = get_post_status_data($post_id);
    return ($status && $status['slug'] === $status_slug);
}

/**
 * Check if unit is sold
 * 
 * @param int|null $post_id Post ID (defaults to current post)
 * @return bool True if unit is sold
 */
function is_unit_sold($post_id = null) {
    return has_post_status('sold', $post_id);
}

/**
 * Check if unit is available
 * 
 * @param int|null $post_id Post ID (defaults to current post)
 * @return bool True if unit is available
 */
function is_unit_available($post_id = null) {
    return has_post_status('available', $post_id);
}

/**
 * Check if unit is reserved
 * 
 * @param int|null $post_id Post ID (defaults to current post)
 * @return bool True if unit is reserved
 */
function is_unit_reserved($post_id = null) {
    return has_post_status('reserved', $post_id);
}

/**
 * Check if project is completed
 * 
 * @param int|null $post_id Post ID (defaults to current post)
 * @return bool True if project is completed
 */
function is_project_completed($post_id = null) {
    return has_post_status('completed', $post_id);
}

/**
 * Check if project is ongoing
 * 
 * @param int|null $post_id Post ID (defaults to current post)
 * @return bool True if project is ongoing
 */
function is_project_ongoing($post_id = null) {
    return has_post_status('ongoing', $post_id);
}

/**
 * Get defined status slugs for a post type
 * Useful for validating if a status is "official" vs custom
 * 
 * @param string $post_type Post type (e.g., 'unit', 'project')
 * @return array Array of status slugs
 */
function get_defined_status_slugs($post_type) {
    $config = get_status_config();
    
    if (!isset($config[$post_type])) {
        return array();
    }
    
    return array_keys($config[$post_type]['statuses']);
}

/**
 * Check if status is a defined/official status
 * 
 * @param string $status_slug Status slug to check
 * @param string $post_type Post type
 * @return bool True if status is defined in config
 */
function is_defined_status($status_slug, $post_type) {
    $defined_slugs = get_defined_status_slugs($post_type);
    return in_array($status_slug, $defined_slugs);
}

/**
 * Display status badge
 * 
 * @param int|null $post_id Post ID (defaults to current post)
 * @param bool $echo Echo or return
 * @return string|void HTML output
 */
function display_status_badge($post_id = null, $echo = true) {
    $status = get_post_status_data($post_id);
    
    if (!$status || empty($status['name'])) {
        return '';
    }
    
    $output = sprintf(
        '<div class="prj-status"><span class="%s">%s</span></div>',
        esc_attr($status['class']),
        esc_html($status['name'])
    );
    
    if ($echo) {
        echo $output;
    } else {
        return $output;
    }
}

