<?php
/**
 * Custom WordPress Pagination Functions
 * Add these functions to your theme's functions.php file
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}


// =============================================================================
// 1. STANDARD ARCHIVE PAGINATION (for default WordPress queries)
// =============================================================================

function custom_archive_pagination($args = array()) {
    global $wp_query;
    
    $defaults = array(
        'mid_size' => 2,
        'end_size' => 1,
        'prev_text' => '<i class="fas fa-arrow-right"></i><span class="sr-only">Previous</span>',
        'next_text' => '<i class="fas fa-arrow-left"></i><span class="sr-only">Next</span>',
        'screen_reader_text' => 'Posts navigation',
        'aria_label' => 'Page navigation'
    );
    
    $args = wp_parse_args($args, $defaults);
    
    $total_pages = $wp_query->max_num_pages;
    $current_page = max(1, get_query_var('paged'));
    
    if ($total_pages <= 1) {
        return;
    }
    
    echo '<nav class="Page navigation example" aria-label="' . esc_attr($args['aria_label']) . '">';
    echo '<div class="pagination-list">';
    echo '<ul class="pagination">';
    
    // Previous button
    if ($current_page > 1) {
        $prev_link = get_pagenum_link($current_page - 1);
        echo '<li class="page-item">';
        echo '<a class="page-link" href="' . esc_url($prev_link) . '" aria-label="Previous">';
        echo '<span aria-hidden="true">' . $args['prev_text'] . '</span>';
        echo '</a>';
        echo '</li>';
    }
    
    // First page and dots
    if ($current_page > ($args['end_size'] + $args['mid_size'] + 1)) {
        for ($i = 1; $i <= $args['end_size']; $i++) {
            $link = get_pagenum_link($i);
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . esc_url($link) . '">' . $i . '</a>';
            echo '</li>';
        }
        if ($current_page > ($args['end_size'] + $args['mid_size'] + 2)) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }
    
    // Pages around current page
    $start = max(1, $current_page - $args['mid_size']);
    $end = min($total_pages, $current_page + $args['mid_size']);
    
    // Adjust start and end to show more pages when near beginning or end
    if ($current_page <= ($args['end_size'] + $args['mid_size'] + 1)) {
        $end = min($total_pages, $args['end_size'] + $args['mid_size'] * 2 + 2);
    }
    if ($current_page >= ($total_pages - $args['end_size'] - $args['mid_size'])) {
        $start = max(1, $total_pages - $args['end_size'] - $args['mid_size'] * 2 - 1);
    }
    
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $current_page) {
            echo '<li class="page-item active">';
            echo '<span class="page-link" aria-current="page">' . $i . '</span>';
            echo '</li>';
        } else {
            $link = get_pagenum_link($i);
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . esc_url($link) . '">' . $i . '</a>';
            echo '</li>';
        }
    }
    
    // Last page and dots
    if ($current_page < ($total_pages - $args['end_size'] - $args['mid_size'])) {
        if ($current_page < ($total_pages - $args['end_size'] - $args['mid_size'] - 1)) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        for ($i = $total_pages - $args['end_size'] + 1; $i <= $total_pages; $i++) {
            $link = get_pagenum_link($i);
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . esc_url($link) . '">' . $i . '</a>';
            echo '</li>';
        }
    }
    
    // Next button
    if ($current_page < $total_pages) {
        $next_link = get_pagenum_link($current_page + 1);
        echo '<li class="page-item">';
        echo '<a class="page-link" href="' . esc_url($next_link) . '" aria-label="Next">';
        echo '<span aria-hidden="true">' . $args['next_text'] . '</span>';
        echo '</a>';
        echo '</li>';
    }
    
    echo '</ul>';
    echo '</div>';
    echo '</nav>';
}

// =============================================================================
// 2. CUSTOM POST TYPE PAGINATION (for custom WP_Query)
// =============================================================================

function custom_cpt_pagination($query, $args = array()) {
    if (!$query instanceof WP_Query) {
        return;
    }
    
    $defaults = array(
        'mid_size' => 2,
        'end_size' => 1,
        'prev_text' => '<i class="fal fa-angle-double-left"></i><span class="sr-only">Previous</span>',
        'next_text' => '<i class="fal fa-angle-double-right"></i><span class="sr-only">Next</span>',
        'screen_reader_text' => 'Posts navigation',
        'aria_label' => 'Page navigation',
        'base_url' => null
    );
    
    $args = wp_parse_args($args, $defaults);
    
    $total_pages = $query->max_num_pages;
    $current_page = max(1, get_query_var('paged'));
    
    if ($total_pages <= 1) {
        return;
    }
    
    // Base URL for pagination links
    $base_url = $args['base_url'] ? $args['base_url'] : get_pagenum_link(1);
    $base_url = trailingslashit($base_url);
    
    echo '<nav aria-label="' . esc_attr($args['aria_label']) . '">';
    echo '<ul class="pagination">';
    
    // Previous button
    if ($current_page > 1) {
        $prev_page = $current_page - 1;
        $prev_link = $prev_page == 1 ? $base_url : $base_url . 'page/' . $prev_page . '/';
        echo '<li class="page-item">';
        echo '<a class="page-link" href="' . esc_url($prev_link) . '" aria-label="Previous">';
        echo '<span aria-hidden="true">' . $args['prev_text'] . '</span>';
        echo '</a>';
        echo '</li>';
    }
    
    // First page and dots
    if ($current_page > ($args['end_size'] + $args['mid_size'] + 1)) {
        for ($i = 1; $i <= $args['end_size']; $i++) {
            $link = $i == 1 ? $base_url : $base_url . 'page/' . $i . '/';
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . esc_url($link) . '">' . $i . '</a>';
            echo '</li>';
        }
        if ($current_page > ($args['end_size'] + $args['mid_size'] + 2)) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }
    
    // Pages around current page
    $start = max(1, $current_page - $args['mid_size']);
    $end = min($total_pages, $current_page + $args['mid_size']);
    
    // Adjust start and end to show more pages when near beginning or end
    if ($current_page <= ($args['end_size'] + $args['mid_size'] + 1)) {
        $end = min($total_pages, $args['end_size'] + $args['mid_size'] * 2 + 2);
    }
    if ($current_page >= ($total_pages - $args['end_size'] - $args['mid_size'])) {
        $start = max(1, $total_pages - $args['end_size'] - $args['mid_size'] * 2 - 1);
    }
    
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $current_page) {
            echo '<li class="page-item active">';
            echo '<span class="page-link" aria-current="page">' . $i . '</span>';
            echo '</li>';
        } else {
            $link = $i == 1 ? $base_url : $base_url . 'page/' . $i . '/';
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . esc_url($link) . '">' . $i . '</a>';
            echo '</li>';
        }
    }
    
    // Last page and dots
    if ($current_page < ($total_pages - $args['end_size'] - $args['mid_size'])) {
        if ($current_page < ($total_pages - $args['end_size'] - $args['mid_size'] - 1)) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        for ($i = $total_pages - $args['end_size'] + 1; $i <= $total_pages; $i++) {
            $link = $base_url . 'page/' . $i . '/';
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . esc_url($link) . '">' . $i . '</a>';
            echo '</li>';
        }
    }
    
    // Next button
    if ($current_page < $total_pages) {
        $next_page = $current_page + 1;
        $next_link = $base_url . 'page/' . $next_page . '/';
        echo '<li class="page-item">';
        echo '<a class="page-link" href="' . esc_url($next_link) . '" aria-label="Next">';
        echo '<span aria-hidden="true">' . $args['next_text'] . '</span>';
        echo '</a>';
        echo '</li>';
    }
    
    echo '</ul>';
    echo '</nav>';
}

// =============================================================================
// 3. ACF PAGINATION (for ACF Relationship/Post Object fields with pagination)
// =============================================================================

function custom_acf_pagination($field_name, $total_posts, $posts_per_page = 10, $args = array()) {
    $defaults = array(
        'mid_size' => 2,
        'end_size' => 1,
        'prev_text' => '<i class="fal fa-angle-double-left"></i><span class="sr-only">Previous</span>',
        'next_text' => '<i class="fal fa-angle-double-right"></i><span class="sr-only">Next</span>',
        'screen_reader_text' => 'Posts navigation',
        'aria_label' => 'Page navigation',
        'ajax' => false,
        'container_class' => 'acf-pagination'
    );
    
    $args = wp_parse_args($args, $defaults);
    
    $total_pages = ceil($total_posts / $posts_per_page);
    $current_page = isset($_GET['acf_page']) ? max(1, intval($_GET['acf_page'])) : 1;
    
    if ($total_pages <= 1) {
        return;
    }
    
    $base_url = remove_query_arg('acf_page');
    
    echo '<div class="' . esc_attr($args['container_class']) . '" data-field="' . esc_attr($field_name) . '">';
    echo '<nav aria-label="' . esc_attr($args['aria_label']) . '">';
    echo '<ul class="pagination">';
    
    // Previous button
    if ($current_page > 1) {
        $prev_page = $current_page - 1;
        $prev_link = add_query_arg('acf_page', $prev_page, $base_url);
        $data_attr = $args['ajax'] ? 'data-page="' . $prev_page . '"' : '';
        echo '<li class="page-item">';
        echo '<a class="page-link" href="' . esc_url($prev_link) . '" aria-label="Previous" ' . $data_attr . '>';
        echo '<span aria-hidden="true">' . $args['prev_text'] . '</span>';
        echo '</a>';
        echo '</li>';
    }
    
    // First page and dots
    if ($current_page > ($args['end_size'] + $args['mid_size'] + 1)) {
        for ($i = 1; $i <= $args['end_size']; $i++) {
            $link = $i == 1 ? $base_url : add_query_arg('acf_page', $i, $base_url);
            $data_attr = $args['ajax'] ? 'data-page="' . $i . '"' : '';
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . esc_url($link) . '" ' . $data_attr . '>' . $i . '</a>';
            echo '</li>';
        }
        if ($current_page > ($args['end_size'] + $args['mid_size'] + 2)) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }
    
    // Pages around current page
    $start = max(1, $current_page - $args['mid_size']);
    $end = min($total_pages, $current_page + $args['mid_size']);
    
    // Adjust start and end to show more pages when near beginning or end
    if ($current_page <= ($args['end_size'] + $args['mid_size'] + 1)) {
        $end = min($total_pages, $args['end_size'] + $args['mid_size'] * 2 + 2);
    }
    if ($current_page >= ($total_pages - $args['end_size'] - $args['mid_size'])) {
        $start = max(1, $total_pages - $args['end_size'] - $args['mid_size'] * 2 - 1);
    }
    
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $current_page) {
            echo '<li class="page-item active">';
            echo '<span class="page-link" aria-current="page">' . $i . '</span>';
            echo '</li>';
        } else {
            $link = $i == 1 ? $base_url : add_query_arg('acf_page', $i, $base_url);
            $data_attr = $args['ajax'] ? 'data-page="' . $i . '"' : '';
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . esc_url($link) . '" ' . $data_attr . '>' . $i . '</a>';
            echo '</li>';
        }
    }
    
    // Last page and dots
    if ($current_page < ($total_pages - $args['end_size'] - $args['mid_size'])) {
        if ($current_page < ($total_pages - $args['end_size'] - $args['mid_size'] - 1)) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        for ($i = $total_pages - $args['end_size'] + 1; $i <= $total_pages; $i++) {
            $link = add_query_arg('acf_page', $i, $base_url);
            $data_attr = $args['ajax'] ? 'data-page="' . $i . '"' : '';
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . esc_url($link) . '" ' . $data_attr . '>' . $i . '</a>';
            echo '</li>';
        }
    }
    
    // Next button
    if ($current_page < $total_pages) {
        $next_page = $current_page + 1;
        $next_link = add_query_arg('acf_page', $next_page, $base_url);
        $data_attr = $args['ajax'] ? 'data-page="' . $next_page . '"' : '';
        echo '<li class="page-item">';
        echo '<a class="page-link" href="' . esc_url($next_link) . '" aria-label="Next" ' . $data_attr . '>';
        echo '<span aria-hidden="true">' . $args['next_text'] . '</span>';
        echo '</a>';
        echo '</li>';
    }
    
    echo '</ul>';
    echo '</nav>';
    echo '</div>';
}

// =============================================================================
// 4. ACF OPTIONS PAGE PAGINATION
// =============================================================================

function custom_acf_options_pagination($field_name, $total_items, $posts_per_page = 10, $args = array()) {
    $defaults = array(
        'mid_size' => 2,
        'end_size' => 1,
        'prev_text' => '<i class="fas fa-arrow-right"></i><span class="sr-only">Previous</span>',
        'next_text' => '<i class="fas fa-arrow-left"></i><span class="sr-only">Next</span>',
        'aria_label' => 'ACF Options Page Pagination',
        'ajax' => false,
        'container_class' => 'acf-options-pagination'
    );
    
    $args = wp_parse_args($args, $defaults);
    $current_page = isset($_GET['acf_page']) ? max(1, intval($_GET['acf_page'])) : 1;
    $total_pages = ceil($total_items / $posts_per_page);
    
    if ($total_pages <= 1) {
        return;
    }
    
    $current_url = add_query_arg(array());
    $current_url = remove_query_arg('acf_page', $current_url);
    
    echo '<div class="' . esc_attr($args['container_class']) . '">';
    echo '<nav class="Page navigation example" aria-label="' . esc_attr($args['aria_label']) . '">';
    echo '<div class="pagination-list">';
    echo '<ul class="pagination">';
    
    // Previous button
    if ($current_page > 1) {
        $prev_page = $current_page - 1;
        $prev_link = add_query_arg('acf_page', $prev_page, $current_url);
        
        if ($args['ajax']) {
            echo '<li class="page-item">';
            echo '<a class="page-link" href="#" data-page="' . $prev_page . '" aria-label="Previous">';
            echo '<span aria-hidden="true">' . $args['prev_text'] . '</span>';
            echo '</a>';
            echo '</li>';
        } else {
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . esc_url($prev_link) . '" aria-label="Previous">';
            echo '<span aria-hidden="true">' . $args['prev_text'] . '</span>';
            echo '</a>';
            echo '</li>';
        }
    }
    
    // First page and dots
    if ($current_page > ($args['end_size'] + $args['mid_size'] + 1)) {
        for ($i = 1; $i <= $args['end_size']; $i++) {
            $page_link = add_query_arg('acf_page', $i, $current_url);
            
            if ($args['ajax']) {
                echo '<li class="page-item">';
                echo '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
                echo '</li>';
            } else {
                echo '<li class="page-item">';
                echo '<a class="page-link" href="' . esc_url($page_link) . '">' . $i . '</a>';
                echo '</li>';
            }
        }
        if ($current_page > ($args['end_size'] + $args['mid_size'] + 2)) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }
    
    // Pages around current page
    $start = max(1, $current_page - $args['mid_size']);
    $end = min($total_pages, $current_page + $args['mid_size']);
    
    // Adjust start and end to show more pages when near beginning or end
    if ($current_page <= ($args['end_size'] + $args['mid_size'] + 1)) {
        $end = min($total_pages, $args['end_size'] + $args['mid_size'] * 2 + 2);
    }
    if ($current_page >= ($total_pages - $args['end_size'] - $args['mid_size'])) {
        $start = max(1, $total_pages - $args['end_size'] - $args['mid_size'] * 2 - 1);
    }
    
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $current_page) {
            echo '<li class="page-item active">';
            echo '<span class="page-link" aria-current="page">' . $i . '</span>';
            echo '</li>';
        } else {
            $page_link = add_query_arg('acf_page', $i, $current_url);
            
            if ($args['ajax']) {
                echo '<li class="page-item">';
                echo '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
                echo '</li>';
            } else {
                echo '<li class="page-item">';
                echo '<a class="page-link" href="' . esc_url($page_link) . '">' . $i . '</a>';
                echo '</li>';
            }
        }
    }
    
    // Last page and dots
    if ($current_page < ($total_pages - $args['end_size'] - $args['mid_size'])) {
        if ($current_page < ($total_pages - $args['end_size'] - $args['mid_size'] - 1)) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        for ($i = $total_pages - $args['end_size'] + 1; $i <= $total_pages; $i++) {
            $page_link = add_query_arg('acf_page', $i, $current_url);
            
            if ($args['ajax']) {
                echo '<li class="page-item">';
                echo '<a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>';
                echo '</li>';
            } else {
                echo '<li class="page-item">';
                echo '<a class="page-link" href="' . esc_url($page_link) . '">' . $i . '</a>';
                echo '</li>';
            }
        }
    }
    
    // Next button
    if ($current_page < $total_pages) {
        $next_page = $current_page + 1;
        $next_link = add_query_arg('acf_page', $next_page, $current_url);
        
        if ($args['ajax']) {
            echo '<li class="page-item">';
            echo '<a class="page-link" href="#" data-page="' . $next_page . '" aria-label="Next">';
            echo '<span aria-hidden="true">' . $args['next_text'] . '</span>';
            echo '</a>';
            echo '</li>';
        } else {
            echo '<li class="page-item">';
            echo '<a class="page-link" href="' . esc_url($next_link) . '" aria-label="Next">';
            echo '<span aria-hidden="true">' . $args['next_text'] . '</span>';
            echo '</a>';
            echo '</li>';
        }
    }
    
    echo '</ul>';
    echo '</div>';
    echo '</nav>';
    echo '</div>';
}

// =============================================================================
// HELPER FUNCTION: Get ACF paginated posts
// =============================================================================

function get_acf_paginated_posts($field_name, $post_id = null, $posts_per_page = 10) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $current_page = isset($_GET['acf_page']) ? max(1, intval($_GET['acf_page'])) : 1;
    $offset = ($current_page - 1) * $posts_per_page;
    
    $all_posts = get_field($field_name, $post_id);
    
    if (!$all_posts || !is_array($all_posts)) {
        return array(
            'posts' => array(),
            'total' => 0,
            'current_page' => $current_page,
            'total_pages' => 0
        );
    }
    
    $total_posts = count($all_posts);
    $paginated_posts = array_slice($all_posts, $offset, $posts_per_page);
    
    return array(
        'posts' => $paginated_posts,
        'total' => $total_posts,
        'current_page' => $current_page,
        'total_pages' => ceil($total_posts / $posts_per_page)
    );
}


// =============================================================================
// HELPER FUNCTION: Get ACF options page paginated data
// =============================================================================
function get_acf_options_paginated($field_name, $posts_per_page = 10) {
    $current_page = isset($_GET['acf_page']) ? max(1, intval($_GET['acf_page'])) : 1;
    $offset = ($current_page - 1) * $posts_per_page;
    
    // Get data from options page
    $all_items = get_field($field_name, 'option');
    
    if (!$all_items || !is_array($all_items)) {
        return array(
            'items' => array(),
            'total' => 0,
            'current_page' => $current_page,
            'total_pages' => 0
        );
    }
    
    $total_items = count($all_items);
    $paginated_items = array_slice($all_items, $offset, $posts_per_page);
    
    return array(
        'items' => $paginated_items,
        'total' => $total_items,
        'current_page' => $current_page,
        'total_pages' => ceil($total_items / $posts_per_page)
    );
}
?>