<?php
/**
 * Register taxonomies for the Heyazah theme.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'init', function () {
    // Project Category
    register_taxonomy( 'project_category', array( 'project' ), array(
        'label'        => __( 'Project Categories', 'heyazah' ),
        'rewrite'      => array( 'slug' => 'project-category' ),
        'hierarchical' => true,
        'show_in_rest' => true,
    ) );

    // Project Status
    register_taxonomy( 'project_status', array( 'project' ), array(
        'label'        => __( 'Project Statuses', 'heyazah' ),
        'rewrite'      => array( 'slug' => 'project-status' ),
        'hierarchical' => true,
        'show_in_rest' => true,
    ) );

    // Sector
    register_taxonomy( 'sector', array( 'project' ), array(
        'label'        => __( 'Sectors', 'heyazah' ),
        'rewrite'      => array( 'slug' => 'sector' ),
        'hierarchical' => true,
        'show_in_rest' => true,
    ) );

    // Unit Status
    register_taxonomy( 'unit_status', array( 'unit' ), array(
        'label'        => __( 'Unit Statuses', 'heyazah' ),
        'rewrite'      => array( 'slug' => 'unit-status' ),
        'hierarchical' => true,
        'show_in_rest' => true,
    ) );

    // Media Type
    register_taxonomy( 'media_type', array( 'media_center' ), array(
        'label'        => __( 'Media Types', 'heyazah' ),
        'rewrite'      => array( 'slug' => 'media-type' ),
        'hierarchical' => true,
        'show_in_rest' => true,
    ) );
} );
