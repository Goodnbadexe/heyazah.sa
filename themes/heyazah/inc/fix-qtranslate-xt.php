<?php
/**
 * Fix qTranslate-XT Admin Display Issues
 * 
 * This file fixes the display of multilingual text in WordPress admin areas
 * where qTranslate-XT shows raw tags like [:en]Text[:ar]نص[:]
 * 
 * Common problem areas:
 * - Site title in admin bar
 * - Post titles in admin list
 * - Taxonomy terms in quick edit
 * - Meta box titles
 * - Column headers
 * 
 * @package ElRiyadTheme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Parse qTranslate-XT multilingual text in admin
 * Ensures text is properly translated even in admin areas
 */
function elryad_parse_qtranslate_admin($text) {
    if (empty($text)) {
        return $text;
    }
    
    // Use qTranslate-XT function if available
    if (function_exists('qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage')) {
        return qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage($text);
    }
    
    return $text;
}

/**
 * Fix Site Title in Admin Bar and Admin Pages
 */
add_filter('bloginfo', 'elryad_fix_site_title_admin', 10, 2);
add_filter('bloginfo_url', 'elryad_fix_site_title_admin', 10, 2);
function elryad_fix_site_title_admin($output, $show) {
    if (is_admin() && in_array($show, array('name', 'title', 'description'))) {
        return elryad_parse_qtranslate_admin($output);
    }
    return $output;
}

/**
 * Fix Admin Bar Site Name
 */
add_filter('admin_bar_menu', 'elryad_fix_admin_bar_site_name', 999);
function elryad_fix_admin_bar_site_name($wp_admin_bar) {
    if (!is_admin()) {
        return;
    }
    
    $site_name_node = $wp_admin_bar->get_node('site-name');
    if ($site_name_node) {
        $site_name_node->title = elryad_parse_qtranslate_admin(get_bloginfo('name'));
        $wp_admin_bar->add_node($site_name_node);
    }
}

/**
 * Fix Post Titles in Admin List Tables
 */
add_filter('the_title', 'elryad_fix_admin_post_titles', 10, 2);
function elryad_fix_admin_post_titles($title, $post_id) {
    if (is_admin()) {
        return elryad_parse_qtranslate_admin($title);
    }
    return $title;
}

/**
 * Fix Taxonomy Terms in Admin
 * Fixes term names in admin lists, quick edit, and meta boxes
 */
add_filter('term_name', 'elryad_fix_term_names_admin', 10, 1);
add_filter('single_term_title', 'elryad_fix_term_names_admin', 10, 1);
function elryad_fix_term_names_admin($term_name) {
    if (is_admin()) {
        return elryad_parse_qtranslate_admin($term_name);
    }
    return $term_name;
}

/**
 * Fix Quick Edit Term Display
 * Ensures terms show translated in quick edit boxes
 */
add_filter('get_terms', 'elryad_fix_terms_quick_edit', 10, 3);
function elryad_fix_terms_quick_edit($terms, $taxonomies, $args) {
    if (!is_admin()) {
        return $terms;
    }
    
    // Only process if terms exist
    if (empty($terms) || is_wp_error($terms)) {
        return $terms;
    }
    
    // Process each term
    foreach ($terms as $term) {
        if (isset($term->name)) {
            $term->name = elryad_parse_qtranslate_admin($term->name);
        }
    }
    
    return $terms;
}

/**
 * Fix Taxonomy Labels in Admin
 * Fixes labels for custom taxonomies
 */
add_filter('taxonomy_labels_project_status', 'elryad_fix_taxonomy_labels');
add_filter('taxonomy_labels_unit_status', 'elryad_fix_taxonomy_labels');
add_filter('taxonomy_labels_project_category', 'elryad_fix_taxonomy_labels');
add_filter('taxonomy_labels_sector', 'elryad_fix_taxonomy_labels');
add_filter('taxonomy_labels_media_type', 'elryad_fix_taxonomy_labels');
function elryad_fix_taxonomy_labels($labels) {
    if (is_admin()) {
        foreach ($labels as $key => $label) {
            $labels->$key = elryad_parse_qtranslate_admin($label);
        }
    }
    return $labels;
}

/**
 * Fix Post Type Labels in Admin
 */
add_filter('post_type_labels_project', 'elryad_fix_post_type_labels');
add_filter('post_type_labels_unit', 'elryad_fix_post_type_labels');
add_filter('post_type_labels_media_center', 'elryad_fix_post_type_labels');
function elryad_fix_post_type_labels($labels) {
    if (is_admin()) {
        foreach ($labels as $key => $label) {
            $labels->$key = elryad_parse_qtranslate_admin($label);
        }
    }
    return $labels;
}

/**
 * Fix Column Headers in Admin
 */
add_filter('manage_posts_columns', 'elryad_fix_column_headers', 999);
add_filter('manage_pages_columns', 'elryad_fix_column_headers', 999);
add_filter('manage_project_posts_columns', 'elryad_fix_column_headers', 999);
add_filter('manage_unit_posts_columns', 'elryad_fix_column_headers', 999);
add_filter('manage_media_center_posts_columns', 'elryad_fix_column_headers', 999);
function elryad_fix_column_headers($columns) {
    if (is_admin() && !empty($columns)) {
        foreach ($columns as $key => $title) {
            $columns[$key] = elryad_parse_qtranslate_admin($title);
        }
    }
    return $columns;
}

/**
 * Fix Meta Box Titles
 */
add_filter('add_meta_boxes', 'elryad_fix_metabox_titles', 999);
function elryad_fix_metabox_titles() {
    global $wp_meta_boxes;
    
    if (!is_admin() || empty($wp_meta_boxes)) {
        return;
    }
    
    foreach ($wp_meta_boxes as $post_type => $contexts) {
        foreach ($contexts as $context => $priorities) {
            foreach ($priorities as $priority => $boxes) {
                foreach ($boxes as $box_id => $box) {
                    if (isset($box['title'])) {
                        $wp_meta_boxes[$post_type][$context][$priority][$box_id]['title'] = 
                            elryad_parse_qtranslate_admin($box['title']);
                    }
                }
            }
        }
    }
}

/**
 * Fix ACF Field Labels and Instructions
 */
add_filter('acf/prepare_field', 'elryad_fix_acf_field_labels');
function elryad_fix_acf_field_labels($field) {
    if (!is_admin()) {
        return $field;
    }
    
    if (isset($field['label'])) {
        $field['label'] = elryad_parse_qtranslate_admin($field['label']);
    }
    
    if (isset($field['instructions'])) {
        $field['instructions'] = elryad_parse_qtranslate_admin($field['instructions']);
    }
    
    if (isset($field['placeholder'])) {
        $field['placeholder'] = elryad_parse_qtranslate_admin($field['placeholder']);
    }
    
    // Fix choices for select/radio/checkbox fields
    if (isset($field['choices']) && is_array($field['choices'])) {
        foreach ($field['choices'] as $key => $choice) {
            $field['choices'][$key] = elryad_parse_qtranslate_admin($choice);
        }
    }
    
    return $field;
}

/**
 * Fix Admin Menu Items
 */
add_filter('admin_menu', 'elryad_fix_admin_menu_items', 999);
function elryad_fix_admin_menu_items() {
    global $menu, $submenu;
    
    if (!empty($menu)) {
        foreach ($menu as $key => $item) {
            if (isset($item[0])) {
                $menu[$key][0] = elryad_parse_qtranslate_admin($item[0]);
            }
        }
    }
    
    if (!empty($submenu)) {
        foreach ($submenu as $parent => $items) {
            foreach ($items as $key => $item) {
                if (isset($item[0])) {
                    $submenu[$parent][$key][0] = elryad_parse_qtranslate_admin($item[0]);
                }
            }
        }
    }
}

/**
 * Fix Widget Titles in Admin
 */
add_filter('widget_title', 'elryad_fix_widget_titles_admin');
function elryad_fix_widget_titles_admin($title) {
    if (is_admin()) {
        return elryad_parse_qtranslate_admin($title);
    }
    return $title;
}

/**
 * Fix Settings Page Titles and Labels
 */
add_filter('pre_option_blogname', 'elryad_fix_option_blogname');
function elryad_fix_option_blogname($value) {
    if (is_admin() && $value) {
        return elryad_parse_qtranslate_admin($value);
    }
    return $value;
}

add_filter('pre_option_blogdescription', 'elryad_fix_option_blogdescription');
function elryad_fix_option_blogdescription($value) {
    if (is_admin() && $value) {
        return elryad_parse_qtranslate_admin($value);
    }
    return $value;
}

/**
 * Fix Taxonomy Term Names in Edit Forms
 */
add_action('edit_term', 'elryad_fix_term_edit_form', 10, 3);
function elryad_fix_term_edit_form($term_id, $tt_id, $taxonomy) {
    // This ensures terms display correctly when editing
    $term = get_term($term_id, $taxonomy);
    if (!is_wp_error($term) && isset($term->name)) {
        // The term name will be parsed by the filters above
        return;
    }
}

/**
 * Fix Dashboard Widget Titles
 */
add_action('wp_dashboard_setup', 'elryad_fix_dashboard_widgets', 999);
function elryad_fix_dashboard_widgets() {
    global $wp_meta_boxes;
    
    if (isset($wp_meta_boxes['dashboard'])) {
        foreach ($wp_meta_boxes['dashboard'] as $context => $priorities) {
            foreach ($priorities as $priority => $widgets) {
                foreach ($widgets as $widget_id => $widget) {
                    if (isset($widget['title'])) {
                        $wp_meta_boxes['dashboard'][$context][$priority][$widget_id]['title'] = 
                            elryad_parse_qtranslate_admin($widget['title']);
                    }
                }
            }
        }
    }
}

/**
 * Fix User Profile Fields
 */
add_filter('user_profile_fields', 'elryad_fix_user_profile_fields');
function elryad_fix_user_profile_fields($fields) {
    if (is_admin() && !empty($fields)) {
        foreach ($fields as $key => $field) {
            if (isset($field['label'])) {
                $fields[$key]['label'] = elryad_parse_qtranslate_admin($field['label']);
            }
            if (isset($field['description'])) {
                $fields[$key]['description'] = elryad_parse_qtranslate_admin($field['description']);
            }
        }
    }
    return $fields;
}

/**
 * Add inline script to fix dynamically loaded admin content
 * This handles AJAX-loaded content and dynamic updates
 * Integrates with qTranslate-XT's own language switching system
 */
add_action('admin_footer', 'elryad_qtranslate_admin_inline_js');
function elryad_qtranslate_admin_inline_js() {
    if (!function_exists('qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage')) {
        return;
    }
    
    $current_lang = function_exists('qtranxf_getLanguage') ? qtranxf_getLanguage() : 'en';
    $current_screen = get_current_screen();
    $is_taxonomy_page = isset($current_screen->taxonomy);
    ?>
    <script type="text/javascript">
    (function($) {
        // Function to parse qTranslate tags
        function parseQTranslate(text) {
            if (!text || typeof text !== 'string') return text;
            
            var currentLang = '<?php echo esc_js($current_lang); ?>';
            var pattern = new RegExp('\\[:'+ currentLang +'\\]([^\\[]*)\\[:');
            var match = text.match(pattern);
            
            if (match && match[1]) {
                return match[1];
            }
            
            // Fallback: try to get any language
            var fallbackPattern = /\[:([a-z]{2})\]([^\[]*)\[:/;
            var fallbackMatch = text.match(fallbackPattern);
            if (fallbackMatch && fallbackMatch[2]) {
                return fallbackMatch[2];
            }
            
            return text;
        }
        
        // Fix elements on page load
        $(document).ready(function() {
            // Fix site name in admin bar
            $('#wp-admin-bar-site-name .ab-item').each(function() {
                $(this).html(parseQTranslate($(this).html()));
            });
            
            // Fix page title
            $('h1, h2.nav-tab-wrapper').each(function() {
                $(this).html(parseQTranslate($(this).html()));
            });
            
            <?php if ($is_taxonomy_page): ?>
            /**
             * Hook into qTranslate-XT's language switching system for taxonomy pages
             * Enables instant language switching without page reload
             * 
             * How it works:
             * 1. Checks if qTranslateConfig exists (loaded by qTranslate-XT)
             * 2. Registers callback in onTabSwitchFunctions array
             * 3. When user clicks language tab, callback fires automatically
             * 4. Updates term names in table to selected language instantly
             * 
             * Debug: Uncomment console.log lines below to troubleshoot
             */
            
            // console.log('=== TAXONOMY PAGE DEBUG ===');
            // console.log('qTranslateConfig exists?', typeof qTranslateConfig !== 'undefined');
            
            if (typeof qTranslateConfig !== 'undefined') {
                // console.log('qTranslateConfig.qtx:', qTranslateConfig.qtx);
                // console.log('qTranslateConfig.onTabSwitchFunctions:', qTranslateConfig.onTabSwitchFunctions);
                
                // Initialize onTabSwitchFunctions array if it doesn't exist
                if (!qTranslateConfig.onTabSwitchFunctions) {
                    qTranslateConfig.onTabSwitchFunctions = [];
                    // console.log('Created onTabSwitchFunctions array');
                }
                
                /**
                 * Helper function to parse qTranslate tags for a specific language
                 * Extracts text from multilingual format: [:en]English[:ar]العربية[:]
                 * 
                 * @param {string} text - Text containing qTranslate tags
                 * @param {string} lang - Target language code (e.g., 'en', 'ar')
                 * @return {string} Translated text for the specified language
                 */
                function parseQTranslateForLang(text, lang) {
                    if (!text || typeof text !== 'string') return text;
                    
                    // Match pattern: [:lang]content[:
                    var pattern = new RegExp('\\[:'+ lang +'\\]([^\\[]*)\\[:');
                    var match = text.match(pattern);
                    
                    if (match && match[1]) {
                        return match[1];
                    }
                    
                    // Fallback: return any available language if target not found
                    var fallbackPattern = /\[:([a-z]{2})\]([^\[]*)\[:/;
                    var fallbackMatch = text.match(fallbackPattern);
                    if (fallbackMatch && fallbackMatch[2]) {
                        return fallbackMatch[2];
                    }
                    
                    return text;
                }
                
                /**
                 * Language switch callback
                 * Automatically called by qTranslate-XT when user clicks language tab
                 * Updates all taxonomy term names to the selected language
                 * 
                 * @param {string} lang - Target language code
                 * @param {string} langFrom - Previous language code
                 */
                qTranslateConfig.onTabSwitchFunctions.push(function(lang, langFrom) {
                    // console.log('=== LANGUAGE SWITCH CALLBACK FIRED ===');
                    // console.log('Language switched from', langFrom, 'to', lang);
                    
                    // Iterate through all rows in the taxonomy table
                    $('#the-list tr').each(function() {
                        var $row = $(this);
                        
                        // console.log('Processing row');
                        
                        // Find hidden inline data containing multilingual content
                        // WordPress stores quick-edit data in hidden divs with class 'hidden'
                        var $inline = $row.find('.hidden');
                        // console.log('  Found .hidden elements:', $inline.length);
                        
                        if ($inline.length > 0) {
                            // Find the .name div which contains multilingual term name
                            var $nameDiv = $inline.find('.name');
                            // console.log('  Found .name div:', $nameDiv.length);
                            
                            if ($nameDiv.length > 0) {
                                // Get full multilingual text: [:en]English[:ar]العربية[:]
                                var fullName = $nameDiv.text();
                                // console.log('  Full name:', fullName);
                                
                                // Parse to get text for selected language
                                var translatedName = parseQTranslateForLang(fullName, lang);
                                // console.log('  Translated name:', translatedName);
                                
                                // Update the visible term name in the table
                                var $rowTitle = $row.find('.row-title');
                                // console.log('  Found .row-title:', $rowTitle.length);
                                
                                if ($rowTitle.length > 0) {
                                    $rowTitle.text(translatedName);
                                    // console.log('  ✓ Updated row title to:', translatedName);
                                }
                            }
                        }
                    });
                });
                
                // console.log('✓ qTranslate-XT integration active for taxonomy pages');
                // console.log('✓ Callback registered, total callbacks:', qTranslateConfig.onTabSwitchFunctions.length);
            } else {
                // console.error('✗ qTranslateConfig not found! qTranslate-XT may not be loaded properly');
            }
            <?php endif; ?>
        });
        
        // Fix dynamically loaded content (AJAX)
        $(document).ajaxComplete(function() {
            setTimeout(function() {
                $('.row-title, .column-name, .term-name').each(function() {
                    $(this).html(parseQTranslate($(this).html()));
                });
            }, 100);
        });
    })(jQuery);
    </script>
    <?php
}

/**
 * Debug function to check if qTranslate is working
 * Uncomment to use
 */
// add_action('admin_notices', 'elryad_qtranslate_debug');
// function elryad_qtranslate_debug() {
//     if (!current_user_can('manage_options')) return;
//     
//     $test_text = '[:en]English Text[:ar]نص عربي[:]';
//     $parsed = elryad_parse_qtranslate_admin($test_text);
//     
//     echo '<div class="notice notice-info">';
//     echo '<p><strong>qTranslate Debug:</strong></p>';
//     echo '<p>Original: ' . esc_html($test_text) . '</p>';
//     echo '<p>Parsed: ' . esc_html($parsed) . '</p>';
//     echo '<p>Current Language: ' . (function_exists('qtranxf_getLanguage') ? qtranxf_getLanguage() : 'N/A') . '</p>';
//     echo '</div>';
// }
