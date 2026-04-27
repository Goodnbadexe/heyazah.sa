<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('init', 'register_media_center_cpt');
function register_media_center_cpt() {

    /* =========================
     * MEDIA CENTER CPT
     * ========================= */
    register_post_type('media_center', array(
        'labels' => array(
            'name'               => qt_label('[:en]Media Center[:ar]المركز الاعلامى'),
            'singular_name'      => qt_label('[:en]Media Item[:ar]عنصر وسائط'),
            'add_new'            => qt_label('[:en]Add New Media[:ar]اضافة وسائط'),
            'add_new_item'       => qt_label('[:en]Add New Item[:ar]اضافة عنصر جديد'),
            'edit_item'          => qt_label('[:en]Edit Media Item[:ar]تعديل عنصر الاعلامى'),
            'new_item'           => qt_label('[:en]New Media Item[:ar]عنصر وسائط جديد'),
            'view_item'          => qt_label('[:en]View Media Item[:ar]عرض عنصر الاعلامى'),
            'search_items'       => qt_label('[:en]Search Media[:ar]بحث في الاعلامى'),
            'not_found'          => qt_label('[:en]No media found[:ar]لا توجد وسائط'),
            'menu_name'          => qt_label('[:en]Media Center[:ar]المركز الاعلامى'),
        ),
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'media-center'),
        'menu_icon'     => 'dashicons-format-video',
        'supports'      => array('title','editor','thumbnail','excerpt'),
        'show_in_rest'  => true,
    ));

    /* =========================
     * MEDIA TYPE TAXONOMY (News / Videos)
     * ========================= */
    register_taxonomy('media_type', 'media_center', array(
        'labels' => array(
            'name'          => qt_label('[:en]Media Type[:ar]نوع الاعلامى'),
            'singular_name' => qt_label('[:en]Media Type[:ar]نوع الاعلامى'),
            'all_items'     => qt_label('[:en]All Media Types[:ar]جميع أنواع الاعلامى'),
            'edit_item'     => qt_label('[:en]Edit Media Type[:ar]تعديل نوع الاعلامى'),
            'add_new_item'  => qt_label('[:en]Add New Media Type[:ar]اضافة نوع وسائط جديد'),
            'new_item_name' => qt_label('[:en]New Media Type Name[:ar]اسم نوع وسائط جديد'),
            'menu_name'     => qt_label('[:en]Media Type[:ar] الاقسام'),
        ),
        'hierarchical' => true,
        'show_ui'           => true,
        'show_admin_column' => true,      
        'show_in_rest' => true,
        'rewrite'      => array('slug' => 'media-type'),
    ));
}
