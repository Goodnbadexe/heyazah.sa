<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Heyazah
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_enqueue_scripts', function () {
    // Main theme style
    wp_enqueue_style(
        'heyazah-style',
        get_stylesheet_uri(),
        array(),
        HEYAZAH_THEME_VERSION
    );

    // If there is any extra assets/css or JS we load it here.
    if ( file_exists( get_template_directory() . '/assets/css/globals.css' ) ) {
        wp_enqueue_style( 'heyazah-globals', HEYAZAH_THEME_URL . 'assets/css/globals.css', array( 'heyazah-style' ), HEYAZAH_THEME_VERSION );
    }

    if ( file_exists( get_template_directory() . '/assets/js/main.js' ) ) {
        wp_enqueue_script( 'heyazah-main', HEYAZAH_THEME_URL . 'assets/js/main.js', array(), HEYAZAH_THEME_VERSION, true );
    }

    // GSAP and ScrollTrigger
    wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true );
    wp_enqueue_script( 'gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true );

    // Motion orchestrator
    if ( file_exists( get_template_directory() . '/assets/js/motion.js' ) ) {
        wp_enqueue_script( 'heyazah-motion', HEYAZAH_THEME_URL . 'assets/js/motion.js', array('gsap', 'gsap-scrolltrigger'), HEYAZAH_THEME_VERSION, true );
    }
} );
