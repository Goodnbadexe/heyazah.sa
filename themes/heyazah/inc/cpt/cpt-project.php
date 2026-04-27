<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Estate Custom Post Types and Taxonomies
 * Registers Projects and Units CPTs with their taxonomies
 */

add_action( 'init', 'register_estate_cpt_and_taxonomies' );

function register_estate_cpt_and_taxonomies() { 
    register_project_cpt();
    register_unit_cpt();
    register_project_taxonomies();
    register_unit_taxonomies();
}

/**
 * Register Project Custom Post Type
 */
function register_project_cpt() {
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
}

/**
 * Register Unit Custom Post Type
 */
function register_unit_cpt() {
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
}

/**
 * Register Project Taxonomies
 */
function register_project_taxonomies() {
    // Project Category (Residential / Commercial)
    register_taxonomy( 'project_category', 'project', array(
        'labels' => array(
            'name'          => qt_label('[:en]Project Categories[:ar]أنواع المشاريع'),
            'singular_name' => qt_label('[:en]Project Category[:ar]نوع المشروع'),
        ),
        'public'            => true,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,        
        'rewrite'           => array( 'slug' => 'project-category' ),
        'show_tagcloud'     => false,
    ) );

    // Project Status (Ongoing / Completed)
    register_taxonomy( 'project_status', 'project', array(
        'labels' => array(
            'name'          => qt_label('[:en]Project Status[:ar]حالة المشروع'),
            'singular_name' => qt_label('[:en]Status[:ar]الحالة'),
        ),
        'public'            => true,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'status' ),
        'meta_box_cb'       => 'project_status_radio_meta_box',
        'show_tagcloud'     => false,
    ) );
}

/**
 * Register Unit Taxonomies
 */
function register_unit_taxonomies() {
    // Sector (A / B / C / D)
    register_taxonomy( 'sector', 'unit', array(
        'labels' => array(
            'name'          => qt_label('[:en]Sectors[:ar]القطاعات'),
            'singular_name' => qt_label('[:en]Sector[:ar]القطاع'),
        ),
        'public'            => true,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,        
        'rewrite'           => array( 'slug' => 'sector' ),
        'meta_box_cb'       => 'sector_radio_meta_box',
        'show_tagcloud'     => false,
    ) );

    // Unit Status (Available / Reserved / Sold)
    register_taxonomy( 'unit_status', 'unit', array(
        'labels' => array(
            'name'          => qt_label('[:en]Unit Status[:ar]حالة الوحدة'),
            'singular_name' => qt_label('[:en]Status[:ar]الحالة'),
        ),
        'public'            => true,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'unit-status' ),
        'meta_box_cb'       => 'unit_status_radio_meta_box',
        'show_tagcloud'     => false,
    ) );
}

/**
 * Generic radio button meta box
 */
function render_radio_meta_box( $post, $box, $taxonomy ) {
    $terms = get_terms( array(
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
    ) );
    
    if ( empty( $terms ) || is_wp_error( $terms ) ) {
        echo '<p>' . __( 'No terms found.' ) . '</p>';
        return;
    }
    
    $current = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
    $current_id = ! empty( $current ) ? array_shift( $current ) : 0;
    
    echo '<div id="taxonomy-' . esc_attr( $taxonomy ) . '" class="categorydiv">';
    echo '<ul>';
    
    foreach ( $terms as $term ) {
        $checked = checked( $current_id, $term->term_id, false );
        printf(
            '<li><label><input type="radio" name="tax_input[%s][]" value="%d" %s> %s</label></li>',
            esc_attr( $taxonomy ),
            esc_attr( $term->term_id ),
            $checked,
            esc_html( $term->name )
        );
    }
    
    echo '</ul></div>';
}

// Specific meta box callbacks
function project_status_radio_meta_box( $post, $box ) {
    render_radio_meta_box( $post, $box, 'project_status' );
}

function unit_status_radio_meta_box( $post, $box ) {
    render_radio_meta_box( $post, $box, 'unit_status' );
}

function sector_radio_meta_box( $post, $box ) {
    render_radio_meta_box( $post, $box, 'sector' );
}

/**
 * Disable "Most Used" tab for taxonomies
 */
add_filter( 'wp_terms_checklist_args', 'disable_most_used_tab' );

function disable_most_used_tab( $args ) {
    $args['checked_ontop'] = false;
    return $args;
}

/**
 * Add Project column to Unit admin list
 */
add_filter('manage_unit_posts_columns', 'add_unit_project_column');
function add_unit_project_column($columns) {
    // Add project column after title
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['unit_project'] = qt_label('[:en]Project[:ar]المشروع[:]');
        }
    }
    return $new_columns;
}

/**
 * Display Project name in Unit admin column
 */
add_action('manage_unit_posts_custom_column', 'display_unit_project_column', 10, 2);
function display_unit_project_column($column, $post_id) {
    if ($column === 'unit_project') {
        $project_id = get_field('unit_project', $post_id);
        
        if ($project_id) {
            $project_title = get_the_title($project_id);
            $project_link = get_edit_post_link($project_id);
            
            if ($project_link) {
                echo '<a href="' . esc_url($project_link) . '">' . esc_html($project_title) . '</a>';
            } else {
                echo esc_html($project_title);
            }
        } else {
            echo '—';
        }
    }
}

/**
 * Make Project column sortable
 */
add_filter('manage_edit-unit_sortable_columns', 'make_unit_project_column_sortable');
function make_unit_project_column_sortable($columns) {
    $columns['unit_project'] = 'unit_project';
    return $columns;
}

/**
 * Handle sorting by Project
 */
add_action('pre_get_posts', 'unit_project_column_orderby');
function unit_project_column_orderby($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    
    if ($query->get('post_type') !== 'unit') {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    if ($orderby === 'unit_project') {
        $query->set('meta_key', 'unit_project');
        $query->set('orderby', 'meta_value_num');
    }
}

/**
 * Add Project filter dropdown to Unit admin
 */
add_action('restrict_manage_posts', 'add_unit_project_filter');
function add_unit_project_filter() {
    global $typenow;
    
    if ($typenow !== 'unit') {
        return;
    }
    
    // Get all projects
    $projects = get_posts(array(
        'post_type' => 'project',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'post_status' => 'publish'
    ));
    
    if (empty($projects)) {
        return;
    }
    
    $selected = isset($_GET['filter_unit_project']) ? $_GET['filter_unit_project'] : '';
    
    echo '<select name="filter_unit_project" id="filter_unit_project">';
    echo '<option value="">' . esc_html(ml_get('[:en]All Projects[:ar]جميع المشاريع[:]')) . '</option>';
    
    foreach ($projects as $project) {
        printf(
            '<option value="%s"%s>%s</option>',
            esc_attr($project->ID),
            selected($selected, $project->ID, false),
            esc_html($project->post_title)
        );
    }
    
    echo '</select>';
}

/**
 * Handle Project filter query
 */
add_filter('parse_query', 'filter_units_by_project');
function filter_units_by_project($query) {
    global $pagenow, $typenow;
    
    if ($pagenow !== 'edit.php' || $typenow !== 'unit' || !is_admin()) {
        return;
    }
    
    if (!isset($_GET['filter_unit_project']) || empty($_GET['filter_unit_project'])) {
        return;
    }
    
    $project_id = intval($_GET['filter_unit_project']);
    
    if ($project_id > 0) {
        $query->query_vars['meta_query'] = array(
            array(
                'key' => 'unit_project',
                'value' => $project_id,
                'compare' => '='
            )
        );
    }
}

/**
 * Add custom column data for quick edit
 */
add_action( 'manage_project_posts_custom_column', 'add_taxonomy_quick_edit_data', 10, 2 );
add_action( 'manage_unit_posts_custom_column', 'add_taxonomy_quick_edit_data', 10, 2 );

function add_taxonomy_quick_edit_data( $column, $post_id ) {
    $taxonomy_map = array(
        'taxonomy-project_status' => 'project_status',
        'taxonomy-unit_status'    => 'unit_status',
        'taxonomy-sector'         => 'sector',
    );
    
    if ( ! isset( $taxonomy_map[ $column ] ) ) {
        return;
    }
    
    $taxonomy = $taxonomy_map[ $column ];
    $terms = get_the_terms( $post_id, $taxonomy );
    
    if ( $terms && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            printf(
                '<div class="hidden %s_inline" data-term-id="%s">%s</div>',
                esc_attr( $taxonomy ),
                esc_attr( $term->term_id ),
                esc_html( $term->name )
            );
        }
    }
}

/**
 * Quick Edit JavaScript for radio buttons
 */
add_action( 'admin_footer-edit.php', 'taxonomy_quick_edit_script' );

function taxonomy_quick_edit_script() {
    global $current_screen;
    
    if ( ! $current_screen || ! in_array( $current_screen->post_type, array( 'project', 'unit' ) ) ) {
        return;
    }
    
    $taxonomies = array();
    
    if ( $current_screen->post_type === 'project' ) {
        $taxonomies[] = 'project_status';
    } elseif ( $current_screen->post_type === 'unit' ) {
        $taxonomies[] = 'unit_status';
        $taxonomies[] = 'sector';
    }
    
    if ( empty( $taxonomies ) ) {
        return;
    }
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        'use strict';
        
        var taxonomies = <?php echo json_encode( $taxonomies ); ?>;
        var termCache = {};
        var observers = {};
        
        // Override inline edit function
        if (typeof inlineEditPost !== 'undefined') {
            var wpInlineEdit = inlineEditPost.edit;
            
            inlineEditPost.edit = function(id) {
                // Call original function first
                wpInlineEdit.apply(this, arguments);
                
                var postId = 0;
                if (typeof id === 'object') {
                    postId = parseInt(this.getId(id));
                }
                
                if (postId > 0) {
                    var $row = $('#post-' + postId);
                    
                    // Cache current term IDs from the row
                    $.each(taxonomies, function(index, taxonomy) {
                        var $termData = $row.find('.' + taxonomy + '_inline');
                        if ($termData.length > 0) {
                            termCache[taxonomy] = $termData.attr('data-term-id');
                        } else {
                            termCache[taxonomy] = null;
                        }
                    });
                    
                    // Setup observers for each taxonomy
                    setupTaxonomyObservers();
                }
            };
        }
        
        /**
         * Setup MutationObserver for each taxonomy checklist
         * This watches for WordPress modifying the checkboxes and converts them after
         */
        function setupTaxonomyObservers() {
            $.each(taxonomies, function(index, taxonomy) {
                var $checklist = $('.' + taxonomy + '-checklist');
                
                if ($checklist.length === 0) {
                    return;
                }
                
                // Disconnect existing observer if any
                if (observers[taxonomy]) {
                    observers[taxonomy].disconnect();
                }
                
                // Create new observer
                observers[taxonomy] = new MutationObserver(function(mutations) {
                    // Check if there are checkboxes that need converting
                    var $checkboxes = $('.' + taxonomy + '-checklist input[type="checkbox"]');
                    
                    if ($checkboxes.length > 0) {
                        // Disconnect observer to prevent infinite loop
                        observers[taxonomy].disconnect();
                        
                        // Convert checkboxes to radios
                        convertTaxonomyToRadio(taxonomy);
                    }
                });
                
                // Start observing
                observers[taxonomy].observe($checklist[0], {
                    childList: true,
                    subtree: true,
                    attributes: true,
                    attributeFilter: ['checked']
                });
                
                // Also convert immediately if checkboxes already exist
                setTimeout(function() {
                    convertTaxonomyToRadio(taxonomy);
                }, 100);
            });
        }
        
        /**
         * Convert checkboxes to radio buttons for a specific taxonomy
         */
        function convertTaxonomyToRadio(taxonomy) {
            var selector = '.' + taxonomy + '-checklist input[type="checkbox"]';
            var converted = false;
            
            $(selector).each(function() {
                var $checkbox = $(this);
                var isChecked = $checkbox.is(':checked');
                var value = $checkbox.val();
                var id = $checkbox.attr('id');
                
                // Create radio button
                var $radio = $('<input type="radio">');
                $radio.attr({
                    'type': 'radio',
                    'name': 'tax_input[' + taxonomy + '][]',
                    'value': value,
                    'id': id
                });
                
                // Preserve checked state from WordPress OR use cached value
                if (isChecked || (termCache[taxonomy] && termCache[taxonomy] == value)) {
                    $radio.prop('checked', true);
                }
                
                // Replace checkbox with radio
                $checkbox.replaceWith($radio);
                converted = true;
            });
            
            return converted;
        }
        
        // Cleanup observers when quick edit is cancelled
        $(document).on('click', '.cancel', function() {
            $.each(observers, function(taxonomy, observer) {
                if (observer) {
                    observer.disconnect();
                }
            });
        });
    });
    </script>
    <?php
}