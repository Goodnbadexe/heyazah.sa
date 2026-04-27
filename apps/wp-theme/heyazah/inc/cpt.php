<?php
/**
 * Custom post types — project, unit, media_center.
 * Slugs intentionally match the legacy Heyazah theme so URLs stay compatible.
 *
 * @package Heyazah
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'init', function () {

    register_post_type( 'project', array(
        'label'        => __( 'Projects', 'heyazah' ),
        'labels'       => array(
            'name'          => __( 'Projects', 'heyazah' ),
            'singular_name' => __( 'Project', 'heyazah' ),
            'add_new_item'  => __( 'Add new project', 'heyazah' ),
            'edit_item'     => __( 'Edit project', 'heyazah' ),
        ),
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-building',
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes' ),
        'rewrite'      => array( 'slug' => 'portfolio' ),
        'has_archive'  => 'portfolio',
    ) );

    register_post_type( 'unit', array(
        'label'        => __( 'Units', 'heyazah' ),
        'labels'       => array(
            'name'          => __( 'Units', 'heyazah' ),
            'singular_name' => __( 'Unit', 'heyazah' ),
        ),
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-admin-home',
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'rewrite'      => array( 'slug' => 'units' ),
        'has_archive'  => 'units',
    ) );

    register_post_type( 'media_center', array(
        'label'        => __( 'Media Center', 'heyazah' ),
        'labels'       => array(
            'name'          => __( 'Media Center', 'heyazah' ),
            'singular_name' => __( 'Media Item', 'heyazah' ),
        ),
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-format-video',
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'rewrite'      => array( 'slug' => 'media' ),
        'has_archive'  => 'media',
    ) );
} );
