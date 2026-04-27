<?php
/**
 * Advanced Custom Fields configuration.
 *
 * Registers the immersive project experience field group on the `project`
 * post type, plus a theme options page holding the site entrance fields.
 *
 * These registrations intentionally live in PHP (not acf-json) so the theme
 * can ship the fields without the author needing to import JSON, and so the
 * field keys remain stable across environments.
 *
 * @package Heyazah
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Surface a visible admin notice if ACF PRO isn't active.
 * The repeater/options-page fields require ACF PRO.
 */
add_action( 'admin_notices', function () {
	if ( ! class_exists( 'ACF' ) ) {
		echo '<div class="notice notice-error"><p>' . esc_html__(
			'Heyazah Theme requires Advanced Custom Fields PRO to be installed and active. The project immersive embeds and site entrance depend on ACF PRO.',
			'heyazah'
		) . '</p></div>';
	}
} );

/**
 * Register the theme options page for site-level immersive settings.
 * Lives under Appearance so content editors don't need extra capabilities.
 */
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page( array(
		'page_title'  => __( 'Heyazah Settings', 'heyazah' ),
		'menu_title'  => __( 'Heyazah Settings', 'heyazah' ),
		'menu_slug'   => 'heyazah-settings',
		'parent_slug' => 'themes.php', // Appearance > Heyazah Settings
		'capability'  => 'edit_theme_options',
		'redirect'    => false,
		'icon_url'    => 'dashicons-admin-customizer',
	) );
} );

/**
 * Register the project immersive field group.
 *
 * Field names are chosen to match the expectations of the template parts:
 * - template-parts/project-cloud-embed.php
 * - template-parts/site-entrance.php
 * and the schema documented in migration/IMMERSIVE_3D_360_PLAN.md.
 */
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	/* ------------------------------------------------------------------
	 * Project: Immersive Experience
	 * Attached to the `project` CPT.
	 * ----------------------------------------------------------------*/
	acf_add_local_field_group( array(
		'key'      => 'group_heyazah_project_immersive',
		'title'    => __( 'Project Immersive Experience', 'heyazah' ),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'project',
				),
			),
		),
		'menu_order'      => 5,
		'position'        => 'normal',
		'style'           => 'default',
		'label_placement' => 'top',
		'active'          => true,
		'description'     => __( 'Controls the heyazah.cloud embed, optional 3D model, 360 tours and hotspots rendered inside the project page.', 'heyazah' ),
		'fields'          => array(

			// --- Cloud embed (Priority 1) ----------------------------
			array(
				'key'       => 'field_heyazah_cloud_embed_tab',
				'label'     => __( 'Cloud Embed', 'heyazah' ),
				'type'      => 'tab',
				'placement' => 'top',
			),
			array(
				'key'           => 'field_heyazah_cloud_embed_enabled',
				'label'         => __( 'Enable Cloud Embed', 'heyazah' ),
				'name'          => 'cloud_embed_enabled',
				'type'          => 'true_false',
				'instructions'  => __( 'When enabled and a Cloud Embed URL is set, the heyazah.cloud iframe renders on the project page.', 'heyazah' ),
				'ui'            => 1,
				'default_value' => 0,
			),
			array(
				'key'          => 'field_heyazah_cloud_embed_url',
				'label'        => __( 'Cloud Embed URL', 'heyazah' ),
				'name'         => 'cloud_embed_url',
				'type'         => 'url',
				'instructions' => __( 'Primary heyazah.cloud iframe source, e.g. https://heyazah.cloud/prime-square', 'heyazah' ),
				'placeholder'  => 'https://heyazah.cloud/{project-slug}',
			),
			array(
				'key'          => 'field_heyazah_cloud_fallback_url',
				'label'        => __( 'Cloud Fallback URL', 'heyazah' ),
				'name'         => 'cloud_fallback_url',
				'type'         => 'url',
				'instructions' => __( 'Opens in a new tab if the iframe is blocked. Usually the same as the embed URL.', 'heyazah' ),
			),
			array(
				'key'           => 'field_heyazah_cloud_embed_poster',
				'label'         => __( 'Cloud Embed Poster', 'heyazah' ),
				'name'          => 'cloud_embed_poster',
				'type'          => 'image',
				'instructions'  => __( 'Shown before the embed loads on click. Recommended 1600px WebP.', 'heyazah' ),
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'library'       => 'all',
			),
			array(
				'key'           => 'field_heyazah_project_experience_default',
				'label'         => __( 'Default Experience', 'heyazah' ),
				'name'          => 'project_experience_default',
				'type'          => 'select',
				'instructions'  => __( 'Which immersive source the project page should prefer when more than one is set.', 'heyazah' ),
				'choices'       => array(
					'cloud_embed' => __( 'Cloud Embed', 'heyazah' ),
					'model'       => __( '3D Model', 'heyazah' ),
					'tour'        => __( '360 Tour', 'heyazah' ),
					'gallery'     => __( 'Gallery Only', 'heyazah' ),
				),
				'default_value' => 'cloud_embed',
				'return_format' => 'value',
				'allow_null'    => 0,
				'ui'            => 1,
			),

			// --- Direct 3D model (Priority 2) ------------------------
			array(
				'key'       => 'field_heyazah_model_tab',
				'label'     => __( '3D Model', 'heyazah' ),
				'type'      => 'tab',
				'placement' => 'top',
			),
			array(
				'key'          => 'field_heyazah_project_model_url',
				'label'        => __( '3D Model URL', 'heyazah' ),
				'name'         => 'project_model_url',
				'type'         => 'url',
				'instructions' => __( 'Direct .glb / .gltf URL. Prefer hosting on heyazah.cloud or CDN. Ideally under 15MB.', 'heyazah' ),
				'placeholder'  => 'https://heyazah.cloud/assets/projects/{slug}/model.glb',
			),
			array(
				'key'           => 'field_heyazah_project_model_poster',
				'label'         => __( 'Model Poster', 'heyazah' ),
				'name'          => 'project_model_poster',
				'type'          => 'image',
				'instructions'  => __( 'Shown before the 3D model loads and on low-bandwidth mobile.', 'heyazah' ),
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'library'       => 'all',
			),

			// --- 360 Tours (Priority 3) ------------------------------
			array(
				'key'       => 'field_heyazah_360_tours_tab',
				'label'     => __( '360 Tours', 'heyazah' ),
				'type'      => 'tab',
				'placement' => 'top',
			),
			array(
				'key'          => 'field_heyazah_project_360_tours',
				'label'        => __( '360 Tours', 'heyazah' ),
				'name'         => 'project_360_tours',
				'type'         => 'repeater',
				'instructions' => __( 'Optional per-scene 360 tours. First tour is used as the default 360 panel.', 'heyazah' ),
				'button_label' => __( 'Add Tour', 'heyazah' ),
				'layout'       => 'block',
				'collapsed'    => 'field_heyazah_tour_title_en',
				'sub_fields'   => array(
					array(
						'key'   => 'field_heyazah_tour_title_en',
						'label' => __( 'Title (EN)', 'heyazah' ),
						'name'  => 'title_en',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_heyazah_tour_title_ar',
						'label' => __( 'Title (AR)', 'heyazah' ),
						'name'  => 'title_ar',
						'type'  => 'text',
					),
					array(
						'key'           => 'field_heyazah_tour_type',
						'label'         => __( 'Tour Type', 'heyazah' ),
						'name'          => 'type',
						'type'          => 'select',
						'choices'       => array(
							'iframe' => __( 'Iframe URL', 'heyazah' ),
							'embed'  => __( 'Raw embed HTML', 'heyazah' ),
						),
						'default_value' => 'iframe',
						'ui'            => 1,
					),
					array(
						'key'   => 'field_heyazah_tour_url',
						'label' => __( 'Tour URL', 'heyazah' ),
						'name'  => 'url',
						'type'  => 'url',
					),
				),
			),
			array(
				'key'          => 'field_heyazah_virtual_reality_iframe',
				'label'        => __( 'Legacy VR Iframe', 'heyazah' ),
				'name'         => 'virtual_reality_iframe',
				'type'         => 'textarea',
				'instructions' => __( 'Legacy field preserved for backward compatibility. If filled, it is used as the last-resort 360 fallback. Prefer the 360 Tours repeater for new content.', 'heyazah' ),
				'rows'         => 3,
			),

			// --- Hotspots --------------------------------------------
			array(
				'key'       => 'field_heyazah_hotspots_tab',
				'label'     => __( 'Hotspots', 'heyazah' ),
				'type'      => 'tab',
				'placement' => 'top',
			),
			array(
				'key'          => 'field_heyazah_project_hotspots',
				'label'        => __( 'Hotspots', 'heyazah' ),
				'name'         => 'project_hotspots',
				'type'         => 'repeater',
				'instructions' => __( 'Optional hotspots rendered on top of the 3D model. Link each to a tour id to open that tour.', 'heyazah' ),
				'button_label' => __( 'Add Hotspot', 'heyazah' ),
				'layout'       => 'block',
				'collapsed'    => 'field_heyazah_hotspot_label_en',
				'sub_fields'   => array(
					array(
						'key'   => 'field_heyazah_hotspot_id',
						'label' => __( 'Hotspot ID', 'heyazah' ),
						'name'  => 'id',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_heyazah_hotspot_label_en',
						'label' => __( 'Label (EN)', 'heyazah' ),
						'name'  => 'label_en',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_heyazah_hotspot_label_ar',
						'label' => __( 'Label (AR)', 'heyazah' ),
						'name'  => 'label_ar',
						'type'  => 'text',
					),
					array(
						'key'          => 'field_heyazah_hotspot_position',
						'label'        => __( 'Position', 'heyazah' ),
						'name'         => 'position',
						'type'         => 'text',
						'instructions' => __( 'model-viewer coordinate string, e.g. "4m 2m 8m".', 'heyazah' ),
					),
					array(
						'key'          => 'field_heyazah_hotspot_target',
						'label'        => __( 'Target Tour ID', 'heyazah' ),
						'name'         => 'target',
						'type'         => 'text',
						'instructions' => __( 'Optional id of a tour (in the 360 Tours repeater) to open when this hotspot is clicked.', 'heyazah' ),
					),
				),
			),

			// --- Fallback --------------------------------------------
			array(
				'key'       => 'field_heyazah_fallback_tab',
				'label'     => __( 'Fallback', 'heyazah' ),
				'type'      => 'tab',
				'placement' => 'top',
			),
			array(
				'key'           => 'field_heyazah_project_experience_fallback_image',
				'label'         => __( 'Fallback Image', 'heyazah' ),
				'name'          => 'project_experience_fallback_image',
				'type'          => 'image',
				'instructions'  => __( 'Static image used when no cloud embed, 3D model, or 360 tour is available.', 'heyazah' ),
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'library'       => 'all',
			),
		),
	) );

	/* ------------------------------------------------------------------
	 * Site Entrance (theme options).
	 * Attached to the Heyazah Settings options page.
	 * ----------------------------------------------------------------*/
	acf_add_local_field_group( array(
		'key'      => 'group_heyazah_site_entrance',
		'title'    => __( 'Site Entrance', 'heyazah' ),
		'location' => array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'heyazah-settings',
				),
			),
		),
		'menu_order'      => 0,
		'position'        => 'normal',
		'style'           => 'default',
		'label_placement' => 'top',
		'active'          => true,
		'description'     => __( 'Controls the full-viewport heyazah.cloud entrance shown once per session when a visitor first lands on the site.', 'heyazah' ),
		'fields'          => array(
			array(
				'key'           => 'field_heyazah_site_entrance_enabled',
				'label'         => __( 'Enable Site Entrance', 'heyazah' ),
				'name'          => 'site_entrance_enabled',
				'type'          => 'true_false',
				'instructions'  => __( 'Turns the entrance overlay on. Requires Site Entrance URL to be set.', 'heyazah' ),
				'ui'            => 1,
				'default_value' => 0,
			),
			array(
				'key'          => 'field_heyazah_site_entrance_url',
				'label'        => __( 'Site Entrance URL', 'heyazah' ),
				'name'         => 'site_entrance_url',
				'type'         => 'url',
				'instructions' => __( 'heyazah.cloud entrance URL. Usually https://heyazah.cloud/entrance.', 'heyazah' ),
				'placeholder'  => 'https://heyazah.cloud/entrance',
			),
			array(
				'key'           => 'field_heyazah_site_entrance_poster',
				'label'         => __( 'Site Entrance Poster', 'heyazah' ),
				'name'          => 'site_entrance_poster',
				'type'          => 'image',
				'instructions'  => __( 'Lightweight poster shown before the entrance iframe finishes loading.', 'heyazah' ),
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'library'       => 'all',
			),
			array(
				'key'           => 'field_heyazah_site_entrance_once_per_session',
				'label'         => __( 'Show Once Per Session', 'heyazah' ),
				'name'          => 'site_entrance_once_per_session',
				'type'          => 'true_false',
				'instructions'  => __( 'When enabled, the entrance only appears on the first visit of a session. Disable only for testing.', 'heyazah' ),
				'ui'            => 1,
				'default_value' => 1,
			),
		),
	) );
} );
