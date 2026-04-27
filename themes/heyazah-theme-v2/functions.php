<?php
/**
 * Heyazah Pro Theme Functions
 *
 * Theme functions and definitions for Heyazah Real Estate Block Theme
 * شركة حيازة العقارية
 *
 * @package Heyazah_Pro
 * @version 2.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define theme constants
 */
define( 'HEYAZAH_PRO_VERSION', '2.0' );
define( 'HEYAZAH_PRO_DIR', get_template_directory() );
define( 'HEYAZAH_PRO_URI', get_template_directory_uri() );
define( 'HEYAZAH_PRO_ASSETS', HEYAZAH_PRO_URI . '/assets' );

/**
 * Enqueue Google Fonts
 */
function heyazah_pro_enqueue_fonts() {
	wp_enqueue_style(
		'heyazah-google-fonts',
		'https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200;300;400;500;600;700&display=swap',
		array(),
		null
	);
}
add_action( 'wp_enqueue_scripts', 'heyazah_pro_enqueue_fonts', 1 );

/**
 * Enqueue theme styles and scripts
 */
function heyazah_pro_enqueue_assets() {
	// Enqueue main stylesheet
	wp_enqueue_style(
		'heyazah-pro-style',
		get_stylesheet_uri(),
		array(),
		HEYAZAH_PRO_VERSION
	);

	// Enqueue custom CSS
	wp_enqueue_style(
		'heyazah-pro-custom',
		HEYAZAH_PRO_ASSETS . '/css/custom.css',
		array( 'heyazah-pro-style' ),
		HEYAZAH_PRO_VERSION
	);

	// Enqueue patterns CSS
	wp_enqueue_style(
		'heyazah-pro-patterns',
		HEYAZAH_PRO_ASSETS . '/css/patterns.css',
		array( 'heyazah-pro-style' ),
		HEYAZAH_PRO_VERSION
	);

	// Enqueue main script
	wp_enqueue_script(
		'heyazah-pro-main',
		HEYAZAH_PRO_ASSETS . '/js/main.js',
		array(),
		HEYAZAH_PRO_VERSION,
		true
	);

	// Localize script for RTL
	wp_localize_script( 'heyazah-pro-main', 'heyazahSettings', array(
		'isRTL' => is_rtl(),
		'themeURI' => HEYAZAH_PRO_URI,
		'ajaxURL' => admin_url( 'admin-ajax.php' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'heyazah_pro_enqueue_assets' );

/**
 * Register theme support
 */
function heyazah_pro_setup() {
	// Add support for post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 800, true );

	// Add support for custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Add support for title tag
	add_theme_support( 'title-tag' );

	// Add support for editor styles
	add_theme_support( 'editor-styles' );

	// Add support for wp-block-styles
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds
	add_theme_support( 'responsive-embeds' );

	// Add support for wide alignment
	add_theme_support( 'align-wide' );

	// Add support for custom line height
	add_theme_support( 'experimental-link-color' );

	// Load text domain
	load_theme_textdomain( 'heyazah-pro', HEYAZAH_PRO_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'heyazah_pro_setup' );

/**
 * Register navigation menus
 */
function heyazah_pro_register_menus() {
	register_nav_menus( array(
		'primary-menu'   => esc_html__( 'Primary Menu', 'heyazah-pro' ),
		'footer-menu'    => esc_html__( 'Footer Menu', 'heyazah-pro' ),
		'mobile-menu'    => esc_html__( 'Mobile Menu', 'heyazah-pro' ),
		'secondary-menu' => esc_html__( 'Secondary Menu', 'heyazah-pro' ),
	) );
}
add_action( 'init', 'heyazah_pro_register_menus' );

/**
 * Register custom post types
 */
function heyazah_pro_register_post_types() {
	// Register Project post type
	register_post_type( 'project', array(
		'labels' => array(
			'name'               => esc_html__( 'Projects', 'heyazah-pro' ),
			'singular_name'      => esc_html__( 'Project', 'heyazah-pro' ),
			'add_new'            => esc_html__( 'Add New Project', 'heyazah-pro' ),
			'add_new_item'       => esc_html__( 'Add New Project', 'heyazah-pro' ),
			'edit_item'          => esc_html__( 'Edit Project', 'heyazah-pro' ),
			'view_item'          => esc_html__( 'View Project', 'heyazah-pro' ),
		),
		'public'              => true,
		'has_archive'         => true,
		'show_in_rest'        => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'menu_icon'           => 'dashicons-building',
		'rewrite'             => array( 'slug' => 'projects' ),
		'capability_type'     => 'post',
	) );

	// Register Unit post type
	register_post_type( 'unit', array(
		'labels' => array(
			'name'               => esc_html__( 'Units', 'heyazah-pro' ),
			'singular_name'      => esc_html__( 'Unit', 'heyazah-pro' ),
			'add_new'            => esc_html__( 'Add New Unit', 'heyazah-pro' ),
			'add_new_item'       => esc_html__( 'Add New Unit', 'heyazah-pro' ),
			'edit_item'          => esc_html__( 'Edit Unit', 'heyazah-pro' ),
			'view_item'          => esc_html__( 'View Unit', 'heyazah-pro' ),
		),
		'public'              => true,
		'has_archive'         => true,
		'show_in_rest'        => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'menu_icon'           => 'dashicons-home',
		'rewrite'             => array( 'slug' => 'units' ),
		'capability_type'     => 'post',
	) );

	// Register Media Center post type
	register_post_type( 'media_center', array(
		'labels' => array(
			'name'               => esc_html__( 'Media Center', 'heyazah-pro' ),
			'singular_name'      => esc_html__( 'Media Item', 'heyazah-pro' ),
			'add_new'            => esc_html__( 'Add New Media Item', 'heyazah-pro' ),
			'add_new_item'       => esc_html__( 'Add New Media Item', 'heyazah-pro' ),
			'edit_item'          => esc_html__( 'Edit Media Item', 'heyazah-pro' ),
			'view_item'          => esc_html__( 'View Media Item', 'heyazah-pro' ),
		),
		'public'              => true,
		'has_archive'         => true,
		'show_in_rest'        => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'menu_icon'           => 'dashicons-media-document',
		'rewrite'             => array( 'slug' => 'media-center' ),
		'capability_type'     => 'post',
	) );
}
add_action( 'init', 'heyazah_pro_register_post_types' );

/**
 * Register custom taxonomies
 */
function heyazah_pro_register_taxonomies() {
	// Project Category taxonomy
	register_taxonomy( 'project_category', 'project', array(
		'label'             => esc_html__( 'Project Categories', 'heyazah-pro' ),
		'public'            => true,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'project-category' ),
	) );

	// Project Status taxonomy
	register_taxonomy( 'project_status', 'project', array(
		'label'             => esc_html__( 'Project Status', 'heyazah-pro' ),
		'public'            => true,
		'show_in_rest'      => true,
		'hierarchical'      => false,
		'rewrite'           => array( 'slug' => 'project-status' ),
	) );

	// Sector taxonomy
	register_taxonomy( 'sector', array( 'project', 'unit' ), array(
		'label'             => esc_html__( 'Sectors', 'heyazah-pro' ),
		'public'            => true,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'sector' ),
	) );

	// Unit Status taxonomy
	register_taxonomy( 'unit_status', 'unit', array(
		'label'             => esc_html__( 'Unit Status', 'heyazah-pro' ),
		'public'            => true,
		'show_in_rest'      => true,
		'hierarchical'      => false,
		'rewrite'           => array( 'slug' => 'unit-status' ),
	) );

	// Media Type taxonomy
	register_taxonomy( 'media_type', 'media_center', array(
		'label'             => esc_html__( 'Media Types', 'heyazah-pro' ),
		'public'            => true,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'media-type' ),
	) );
}
add_action( 'init', 'heyazah_pro_register_taxonomies' );

/**
 * Register block patterns
 */
function heyazah_pro_register_block_patterns() {
	$block_patterns = array(
		'hero-section',
		'project-card',
		'stats-counter',
		'features-grid',
		'contact-cta',
		'services-showcase',
	);

	foreach ( $block_patterns as $pattern ) {
		$pattern_path = HEYAZAH_PRO_DIR . '/patterns/' . $pattern . '.php';
		if ( file_exists( $pattern_path ) ) {
			register_block_pattern(
				'heyazah-pro/' . $pattern,
				require $pattern_path
			);
		}
	}
}
add_action( 'init', 'heyazah_pro_register_block_patterns' );

/**
 * Add editor styles
 */
function heyazah_pro_add_editor_styles() {
	add_editor_style( HEYAZAH_PRO_ASSETS . '/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'heyazah_pro_add_editor_styles' );

/**
 * Add custom image sizes
 */
function heyazah_pro_add_image_sizes() {
	add_image_size( 'heyazah-hero', 1600, 900, true );
	add_image_size( 'heyazah-card', 500, 400, true );
	add_image_size( 'heyazah-thumbnail', 300, 300, true );
	add_image_size( 'heyazah-featured', 1200, 800, true );
}
add_action( 'after_setup_theme', 'heyazah_pro_add_image_sizes' );

/**
 * Register sidebar
 */
function heyazah_pro_register_sidebar() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'heyazah-pro' ),
		'id'            => 'primary-sidebar',
		'description'   => esc_html__( 'Primary sidebar', 'heyazah-pro' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'heyazah_pro_register_sidebar' );

/**
 * Add theme support for ACF
 */
function heyazah_pro_acf_support() {
	// This enables compatibility with Advanced Custom Fields plugin
	add_filter( 'acf/settings/show_admin', '__return_true' );
}
add_action( 'after_setup_theme', 'heyazah_pro_acf_support' );

/**
 * Custom SVG Logo Support
 */
function heyazah_pro_svg_logo() {
	// Allow SVG in uploads
	add_filter( 'upload_mimes', function( $mimes ) {
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	});
}
add_action( 'init', 'heyazah_pro_svg_logo' );

/**
 * Custom logo sanitization
 */
function heyazah_pro_sanitize_svg( $file ) {
	return $file;
}
add_filter( 'wp_handle_upload_prefilter', function( $file ) {
	if ( $file['type'] === 'image/svg+xml' ) {
		add_filter( 'wp_check_filetype_and_ext', function( $data, $file ) {
			if ( strpos( $file, '.svg' ) !== false ) {
				$data['type'] = 'image/svg+xml';
				$data['ext']  = 'svg';
			}
			return $data;
		}, 10, 2 );
	}
	return $file;
});

/**
 * Register REST API endpoints for custom functionality
 */
function heyazah_pro_register_rest_endpoints() {
	register_rest_route( 'heyazah/v1', '/projects/featured', array(
		'methods'  => 'GET',
		'callback' => 'heyazah_pro_get_featured_projects',
		'permission_callback' => '__return_true',
	) );
}
add_action( 'rest_api_init', 'heyazah_pro_register_rest_endpoints' );

/**
 * Get featured projects for API
 */
function heyazah_pro_get_featured_projects() {
	$args = array(
		'post_type'  => 'project',
		'posts_per_page' => 6,
		'meta_key'   => '_featured',
		'meta_value' => 'yes',
	);

	$projects = get_posts( $args );

	if ( empty( $projects ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'No featured projects found',
		), 404 );
	}

	return new WP_REST_Response( array(
		'success' => true,
		'data' => $projects,
	), 200 );
}

/**
 * Theme compatibility filters
 */

// Rank Math SEO compatibility
add_filter( 'rank_math/gutenberg/can_use_snippet_editor', '__return_true' );

// Contact Form 7 compatibility
add_filter( 'wpcf7_load_js', '__return_true' );
add_filter( 'wpcf7_load_css', '__return_true' );

// qTranslate-XT compatibility
if ( defined( 'QTX_VERSION' ) ) {
	add_filter( 'qtranslate_get_language', function() {
		return get_bloginfo( 'language' );
	});
}

/**
 * Helper function to get theme color
 */
function heyazah_pro_get_color( $color_name ) {
	$colors = array(
		'primary-beige'     => '#d1ccbd',
		'primary-teal'      => '#025157',
		'gold'              => '#99856a',
		'dark-teal'         => '#082b2a',
		'light-accent-1'    => '#b0b5aa',
		'light-accent-2'    => '#cad1c7',
		'white'             => '#ffffff',
		'black'             => '#000000',
	);

	return isset( $colors[ $color_name ] ) ? $colors[ $color_name ] : '';
}

/**
 * Helper function to get theme setting
 */
function heyazah_pro_get_setting( $setting_key ) {
	$settings = get_option( 'heyazah_pro_settings', array() );
	return isset( $settings[ $setting_key ] ) ? $settings[ $setting_key ] : '';
}

/**
 * Gutenberg editor enhancements
 */
function heyazah_pro_gutenberg_enhancements( $args, $name ) {
	// Ensure core/button blocks render correctly in our theme
	if ( 'core/button' === $name && ! isset( $args['render_callback'] ) ) {
		$args['render_callback'] = function( $attributes, $content ) {
			return $content;
		};
	}
	return $args;
}
add_filter( 'register_block_type_args', 'heyazah_pro_gutenberg_enhancements', 10, 2 );

/**
 * Admin customizations
 */
if ( is_admin() ) {
	// Add theme admin page
	add_action( 'admin_menu', function() {
		add_theme_page(
			esc_html__( 'Heyazah Pro Settings', 'heyazah-pro' ),
			esc_html__( 'Heyazah Settings', 'heyazah-pro' ),
			'manage_options',
			'heyazah-pro-settings',
			'heyazah_pro_settings_page'
		);
	});
}

/**
 * Settings page callback
 */
function heyazah_pro_settings_page() {
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Heyazah Pro Theme Settings', 'heyazah-pro' ); ?></h1>
		<p><?php esc_html_e( 'Welcome to Heyazah Pro! Configure your theme settings below.', 'heyazah-pro' ); ?></p>

		<div style="background: #f5f5f5; padding: 20px; border-radius: 8px; margin-top: 20px;">
			<h2><?php esc_html_e( 'Quick Setup', 'heyazah-pro' ); ?></h2>
			<ul style="list-style: disc; margin-left: 20px;">
				<li><?php esc_html_e( 'Upload your company logo under Appearance > Site Identity', 'heyazah-pro' ); ?></li>
				<li><?php esc_html_e( 'Create navigation menus under Appearance > Menus', 'heyazah-pro' ); ?></li>
				<li><?php esc_html_e( 'Configure theme colors in the Site Editor', 'heyazah-pro' ); ?></li>
				<li><?php esc_html_e( 'Add content using the WordPress Block Editor', 'heyazah-pro' ); ?></li>
			</ul>
		</div>

		<div style="background: #e7f3ff; padding: 20px; border-radius: 8px; margin-top: 20px; border-left: 4px solid #0073aa;">
			<h3><?php esc_html_e( 'Resources', 'heyazah-pro' ); ?></h3>
			<ul>
				<li><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><?php esc_html_e( 'Customize Theme', 'heyazah-pro' ); ?></a></li>
				<li><a href="<?php echo esc_url( admin_url( 'site-editor.php' ) ); ?>"><?php esc_html_e( 'Site Editor', 'heyazah-pro' ); ?></a></li>
				<li><a href="<?php echo esc_url( admin_url( 'edit.php?post_type=project' ) ); ?>"><?php esc_html_e( 'Manage Projects', 'heyazah-pro' ); ?></a></li>
			</ul>
		</div>
	</div>
	<?php
}

/**
 * Load plugin textdomain for translations
 */
function heyazah_pro_load_textdomain() {
	load_theme_textdomain( 'heyazah-pro', HEYAZAH_PRO_DIR . '/languages' );
}
add_action( 'init', 'heyazah_pro_load_textdomain' );

// End of functions.php
