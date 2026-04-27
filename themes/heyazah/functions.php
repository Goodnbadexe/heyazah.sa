<?php
/**
 * ELRYAD Theme Functions
 * WordPress theme setup and functionality
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit();
}

// Define theme constants
define('ELRYAD_THEME_VERSION', '1.0.0');
define('ELRYAD_THEME_DIR', get_template_directory());
define('ELRYAD_THEME_URL', get_template_directory_uri());

// Load theme components
require_once ELRYAD_THEME_DIR . '/inc/theme-setup.php';
// get_template_part('inc/theme-setup');
require_once ELRYAD_THEME_DIR . '/inc/wp-customizations.php';
require_once ELRYAD_THEME_DIR . '/inc/enqueue-scripts.php';
// CPTS
require_once ELRYAD_THEME_DIR . '/inc/cpt/cpt-project.php';
require_once ELRYAD_THEME_DIR . '/inc/cpt/cpt-media_center.php';

require_once ELRYAD_THEME_DIR . '/inc/navigation.php';
require_once ELRYAD_THEME_DIR . '/inc/pagination.php';
require_once ELRYAD_THEME_DIR . '/inc/security.php';
require_once ELRYAD_THEME_DIR . '/inc/helpers.php';
require_once ELRYAD_THEME_DIR . '/inc/admin-elryad.php';
// Ajax
require_once ELRYAD_THEME_DIR . '/inc/filter-ajax.php';
require_once ELRYAD_THEME_DIR . '/inc/media-center-ajax.php';
require_once ELRYAD_THEME_DIR . '/inc/search-ajax.php';
require_once ELRYAD_THEME_DIR . '/inc/load_vr_tour_ajax.php';
require_once ELRYAD_THEME_DIR . '/inc/archive-project-filter.php';


require_once ELRYAD_THEME_DIR . '/inc/handle-status.php';
require_once ELRYAD_THEME_DIR . '/inc/fix-qtranslate-xt.php';

