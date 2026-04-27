<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', 'register_estate_cpt_and_taxonomies' );

function register_estate_cpt_and_taxonomies() { 

    /* =========================
     * PROJECT CPT
     * ========================= */
    register_post_type( 'project', array(
        'labels' => array(
            'name'               => qt_label('[:en]Projects[:ar]المشاريع'),
            'singular_name'      => qt_label('[:en]Project[:ar]المشروع'),
            'add_new'            => qt_label('[:en]Add New Project[:ar]اضافة مشروع'),
            'add_new_item'       => qt_label('[:en]Add New Project[:ar]اضافة مشروع جديد'),
            'edit_item'          => qt_label('[:en]Edit Project[:ar]تعديل المشروع'),
            'new_item'           => qt_label('[:en]New Project[:ar]مشروع جديد'),
            'view_item'          => qt_label('[:en]View Project[:ar]عرض المشروع'),
            'search_items'       => qt_label('[:en]Search Projects[:ar]بحث في المشاريع'),
            'not_found'          => qt_label('[:en]No projects found[:ar]لا توجد مشاريع'),
            'menu_name'          => qt_label('[:en]Projects[:ar]المشاريع'),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-building',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true,
    ) );

    /* =========================
     * UNIT CPT (Flats/Apartments)
     * ========================= */
    register_post_type( 'unit', array(
        'labels' => array(
            'name'               => qt_label('[:en]Units[:ar]الوحدات'),
            'singular_name'      => qt_label('[:en]Unit[:ar]الوحدة'),
            'add_new'            => qt_label('[:en]Add New Unit[:ar]اضافة وحدة'),
            'add_new_item'       => qt_label('[:en]Add New Unit[:ar]اضافة وحدة جديدة'),
            'edit_item'          => qt_label('[:en]Edit Unit[:ar]تعديل الوحدة'),
            'new_item'           => qt_label('[:en]New Unit[:ar]وحدة جديدة'),
            'view_item'          => qt_label('[:en]View Unit[:ar]عرض الوحدة'),
            'search_items'       => qt_label('[:en]Search Units[:ar]بحث في الوحدات'),
            'not_found'          => qt_label('[:en]No units found[:ar]لا توجد وحدات'),
            'menu_name'          => qt_label('[:en]Units[:ar]الوحدات'),
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'units' ),
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-admin-multisite',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest'       => true,
    ) );

    /* =========================
     * TAXONOMIES
     * ========================= */

    // Project Category (Residential / Commercial)
    register_taxonomy( 'project_category', 'project', array(
        'labels' => array(
            'name'          => qt_label('[:en]Project Categories[:ar]أنواع المشاريع'),
            'singular_name' => qt_label('[:en]Project Category[:ar]نوع المشروع'),
        ),
        'public'        => true,
        'hierarchical'  => true,
        'show_in_rest'  => true,
        'show_ui' => true,
        'show_admin_column' => true,        
        'rewrite'       => array( 'slug' => 'project-category' ),
    ) );

    // Project Status (Ongoing / Completed)
    register_taxonomy( 'project_status', 'project', array(
        'labels' => array(
            'name'          => qt_label('[:en]Project Status[:ar]حالة المشروع'),
            'singular_name' => qt_label('[:en]Status[:ar]الحالة'),
        ),
        'public'        => true,
        'hierarchical'  => true,
        'show_in_rest'  => true,
        'rewrite'       => array( 'slug' => 'status' ),
        'show_ui' => true,
        'show_admin_column' => true,
        'meta_box_cb' => 'project_status_radio_meta_box', // callback        
    ) );

    // Sector (A / B / C / D) - for Units
    register_taxonomy( 'sector', 'unit', array(
        'labels' => array(
            'name'          => qt_label('[:en]Sectors[:ar]القطاعات'),
            'singular_name' => qt_label('[:en]Sector[:ar]القطاع'),
        ),
        'public'        => true,
        'show_ui'       => true,
        'hierarchical'  => true,
        'show_in_rest'  => true,
        'show_ui' => true,
        'show_admin_column' => true,        
        'rewrite'       => array( 'slug' => 'sector' ),
        'meta_box_cb' => 'sector_radio_meta_box', // callback for single-select
    ) );

    // Unit Status (Available / Reserved / Sold) - for Units
    register_taxonomy( 'unit_status', 'unit', array(
        'labels' => array(
            'name'          => qt_label('[:en]Unit Status[:ar]حالة الوحدة'),
            'singular_name' => qt_label('[:en]Status[:ar]الحالة'),
        ),
        'public'        => true,
        'hierarchical'  => true,
        'show_in_rest'  => true,
        'rewrite'       => array( 'slug' => 'unit-status' ),
        'show_ui' => true,
        'show_admin_column' => true,
        'meta_box_cb' => 'unit_status_radio_meta_box', // callback
    ) );

    // Unit Type (Studio / 1BR / 2BR / 3BR / Villa / Duplex)
    // register_taxonomy( 'unit_type', 'unit', array(
    //     'labels' => array(
    //         'name'          => qt_label('[:en]Unit Types[:ar]أنواع الوحدات'),
    //         'singular_name' => qt_label('[:en]Unit Type[:ar]نوع الوحدة'),
    //     ),
    //     'public'        => true,
    //     'hierarchical'  => true,
    //     'show_in_rest'  => true,
    //     'show_ui' => true,
    //     'show_admin_column' => true,        
    //     'rewrite'       => array( 'slug' => 'unit-type' ),
    // ) );
}


// Custom metabox to display radio buttons instead of checkboxes
function project_status_radio_meta_box($post, $box) {
    $taxonomy = $box['args']['taxonomy'];
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
    ));
    
    $current = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
    $current_id = !empty($current) ? array_shift($current) : 0;
    
    echo '<div id="taxonomy-' . $taxonomy . '" class="categorydiv">';
    echo '<ul>';
    
    foreach ($terms as $term) {
        $checked = ($current_id == $term->term_id) ? 'checked="checked"' : '';
        echo '<li><label>';
        echo '<input type="radio" name="tax_input[' . $taxonomy . '][]" value="' . $term->term_id . '" ' . $checked . '> ';
        echo $term->name;
        echo '</label></li>';
    }
    
    echo '</ul></div>';
}
// Add JavaScript to convert checkboxes to radio buttons in quick edit
function project_status_quick_edit_script() {
    global $current_screen;
    
    if ($current_screen->post_type !== 'project') {
        return;
    }
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        var inlineEditPost_original = inlineEditPost.edit;
        
        // Override the inline edit function
        inlineEditPost.edit = function(id) {
            // Call the original function
            inlineEditPost_original.apply(this, arguments);
            
            var postId = 0;
            if (typeof(id) == 'object') {
                postId = parseInt(this.getId(id));
            }
            
            if (postId > 0) {
                // Get the current taxonomy term ID from the row
                var $row = $('#post-' + postId);
                var currentTermId = null;
                
                // Look for hidden taxonomy data
                var $termData = $row.find('.project_status_inline');
                if ($termData.length > 0) {
                    currentTermId = $termData.attr('data-term-id');
                }
                
                // Wait longer for WordPress to finish its own checkbox manipulation
                setTimeout(function() {
                    // Convert checkboxes to radio buttons first
                    convertToRadio();
                    
                    // Then check the correct radio button
                    if (currentTermId) {
                        $('.project_status-checklist input[type="radio"][value="' + currentTermId + '"]').prop('checked', true);
                    }
                }, 200);
            }
        };
        
        // Convert checkboxes to radio buttons
        function convertToRadio() {
            $('.project_status-checklist input[type="checkbox"]').each(function() {
                // Only convert if not already a radio button
                var $checkbox = $(this);
                var isChecked = $checkbox.is(':checked');
                var value = $checkbox.val();
                var id = $checkbox.attr('id');
                
                // Create radio button
                var $radio = $('<input type="radio" name="tax_input[project_status][]">');
                $radio.val(value);
                $radio.attr('id', id);
                
                if (isChecked) {
                    $radio.prop('checked', true);
                }
                
                // Replace checkbox with radio
                $checkbox.replaceWith($radio);
            });
        }
    });
    </script>
    <?php
}
add_action('admin_footer-edit.php', 'project_status_quick_edit_script');

// Add hidden data for quick edit to read current terms
function project_status_custom_column_data($column, $post_id) {
    if ($column === 'taxonomy-project_status') {
        $terms = get_the_terms($post_id, 'project_status');
        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                echo '<div class="hidden project_status_inline" data-term-id="' . esc_attr($term->term_id) . '">' . esc_html($term->name) . '</div>';
            }
        }
    }
}
add_action('manage_project_posts_custom_column', 'project_status_custom_column_data', 10, 2);

// Custom metabox to display radio buttons for unit status
function unit_status_radio_meta_box($post, $box) {
    $taxonomy = $box['args']['taxonomy'];
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
    ));
    
    $current = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
    $current_id = !empty($current) ? array_shift($current) : 0;
    
    echo '<div id="taxonomy-' . $taxonomy . '" class="categorydiv">';
    echo '<ul>';
    
    foreach ($terms as $term) {
        $checked = ($current_id == $term->term_id) ? 'checked="checked"' : '';
        echo '<li><label>';
        echo '<input type="radio" name="tax_input[' . $taxonomy . '][]" value="' . $term->term_id . '" ' . $checked . '> ';
        echo $term->name;
        echo '</label></li>';
    }
    
    echo '</ul></div>';
}

// Add JavaScript to convert checkboxes to radio buttons in quick edit for unit_status
function unit_status_quick_edit_script() {
    global $current_screen;
    
    if ($current_screen->post_type !== 'unit') {
        return;
    }
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        var currentTermId = null;
        
        // Handle Quick Edit click
        $('.editinline').on('click', function() {
            var postId = $(this).closest('tr').attr('id').replace('post-', '');
            
            inlineEditPost.revert();
            
            setTimeout(function() {
                var $row = $('#post-' + postId);
                var $termData = $row.find('.unit_status_inline');
                if ($termData.length > 0) {
                    currentTermId = $termData.attr('data-term-id');
                }
                
                // Wait longer for WordPress to finish its own checkbox manipulation
                setTimeout(function() {
                    // Convert checkboxes to radio buttons first
                    convertToRadio();
                    
                    // Then check the correct radio button
                    if (currentTermId) {
                        $('.unit_status-checklist input[type="radio"][value="' + currentTermId + '"]').prop('checked', true);
                    }
                }, 200);
                
            });
        };
        
        // Convert checkboxes to radio buttons
        function convertToRadio() {
            $('.unit_status-checklist input[type="checkbox"]').each(function() {
                // Only convert if not already a radio button
                var $checkbox = $(this);
                var isChecked = $checkbox.is(':checked');
                var value = $checkbox.val();
                var id = $checkbox.attr('id');
                
                // Create radio button
                var $radio = $('<input type="radio" name="tax_input[unit_status][]">');
                $radio.val(value);
                $radio.attr('id', id);
                
                if (isChecked) {
                    $radio.prop('checked', true);
                }
                
                // Replace checkbox with radio
                $checkbox.replaceWith($radio);
            });
        }
    });
    </script>
    <?php
}
add_action('admin_footer-edit.php', 'unit_status_quick_edit_script');

// Add hidden data for quick edit to read current terms for unit_status
function unit_status_custom_column_data($column, $post_id) {
    if ($column === 'taxonomy-unit_status') {
        $terms = get_the_terms($post_id, 'unit_status');
        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                echo '<div class="hidden unit_status_inline" data-term-id="' . esc_attr($term->term_id) . '">' . esc_html($term->name) . '</div>';
            }
        }
    }
}
add_action('manage_unit_posts_custom_column', 'unit_status_custom_column_data', 10, 2);

// Custom metabox to display radio buttons for sector
function sector_radio_meta_box($post, $box) {
    $taxonomy = $box['args']['taxonomy'];
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
    ));
    
    $current = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
    $current_id = !empty($current) ? array_shift($current) : 0;
    
    echo '<div id="taxonomy-' . $taxonomy . '" class="categorydiv">';
    echo '<ul>';
    
    foreach ($terms as $term) {
        $checked = ($current_id == $term->term_id) ? 'checked="checked"' : '';
        echo '<li><label>';
        echo '<input type="radio" name="tax_input[' . $taxonomy . '][]" value="' . $term->term_id . '" ' . $checked . '> ';
        echo $term->name;
        echo '</label></li>';
    }
    
    echo '</ul></div>';
}

// Add JavaScript to convert checkboxes to radio buttons in quick edit for sector
function sector_quick_edit_script() {
    global $current_screen;
    
    if ($current_screen->post_type !== 'unit') {
        return;
    }
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        var currentSectorId = null;
        
        // Store the original click handler
        var originalHandler = $('.editinline').attr('onclick');
        
        // Handle Quick Edit click for sector
        $(document).on('click', '.editinline', function() {
            var postId = $(this).closest('tr').attr('id').replace('post-', '');
            
            inlineEditPost.revert();
            
            setTimeout(function() {
                var $row = $('#post-' + postId);
                var $termData = $row.find('.sector_inline');
                if ($termData.length > 0) {
                    currentSectorId = $termData.attr('data-term-id');
                }
                
                // Wait longer for WordPress to finish its own checkbox manipulation
                setTimeout(function() {
                    // Convert sector checkboxes to radio buttons first
                    convertSectorToRadio();
                    
                    // Then check the correct radio button
                    if (currentSectorId) {
                        $('.sector-checklist input[type="radio"][value="' + currentSectorId + '"]').prop('checked', true);
                    }
                }, 200);
            });
        });
        
        // Convert checkboxes to radio buttons for sector
        function convertSectorToRadio() {
            $('.sector-checklist input[type="checkbox"]').each(function() {
                // Only convert if not already a radio button
                var $checkbox = $(this);
                var isChecked = $checkbox.is(':checked');
                var value = $checkbox.val();
                var id = $checkbox.attr('id');
                
                // Create radio button
                var $radio = $('<input type="radio" name="tax_input[sector][]">');
                $radio.val(value);
                $radio.attr('id', id);
                
                if (isChecked) {
                    $radio.prop('checked', true);
                }
                
                // Replace checkbox with radio
                $checkbox.replaceWith($radio);
            });
        }
    });
    </script>
    <?php
}
add_action('admin_footer-edit.php', 'sector_quick_edit_script');

// Add hidden data for quick edit to read current terms for sector
function sector_custom_column_data($column, $post_id) {
    if ($column === 'taxonomy-sector') {
        $terms = get_the_terms($post_id, 'sector');
        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                echo '<div class="hidden sector_inline" data-term-id="' . esc_attr($term->term_id) . '">' . esc_html($term->name) . '</div>';
            }
        }
    }
}
add_action('manage_unit_posts_custom_column', 'sector_custom_column_data', 10, 2);
