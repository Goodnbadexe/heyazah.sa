<?php
/**
 * Elryad Support Dashboard Widget
 *
 * Adds a support widget to the WordPress admin dashboard for Elryad users.
 * customizes the admin footer text.
 * @package Elryad
 * @since 1.0.0
 * 
 */

// Add the dashboard widget
function elryad_support_dashboard_widget() {
    wp_add_dashboard_widget(
        'elryad_support_widget',           // Widget slug
        'الدعم الفني',                      // Title
        'elryad_support_widget_display'    // Display function
    );
}
add_action('wp_dashboard_setup', 'elryad_support_dashboard_widget');

// Display the widget content
function elryad_support_widget_display() {
    ?>
    <style>
        #elryad_support_widget .inside {
            margin: 0;
            padding: 0;
        }
        
        .elryad-support-section {
            background: #ffffff;
            padding: 20px;
            text-align: center;
            font-family: "IBM Plex Sans Arabic", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial;
            direction: rtl;
        }

        .elryad-support-section h3 {
            font-size: 18px !important;
            font-weight: 700 !important;
            margin: 0 0 10px 0 !important;
            color: #0f1724 !important;
        }

        .elryad-support-section p {
            font-size: 15px;
            color: #6b7280;
            margin: 0;
            line-height: 1.6;
        }

        .elryad-support-section a {
            color: #0b6df0;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .elryad-support-section a:hover {
            color: #084bb5;
            text-decoration: underline;
        }
    </style>

    <div class="elryad-support-section">
        <h3>لو عندك مشكلة أو استفسار</h3>
        <p>
            يمكنك <a href="https://elryad.net/submitticket.php" target="_blank" rel="noopener">الضغط هنا</a>
            لإنشاء تذكرة وسيتم الرد عليك من فريق الدعم في أسرع وقت.
        </p>
    </div>
    <?php
}

// Optional: Load IBM Plex Sans Arabic font
function elryad_support_widget_fonts() {
    $screen = get_current_screen();
    if ($screen->id === 'dashboard') {
        wp_enqueue_style(
            'ibm-plex-arabic',
            'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;600;700&display=swap',
            array(),
            null
        );
    }
}
add_action('admin_enqueue_scripts', 'elryad_support_widget_fonts');

// Customize the admin footer text
add_filter('admin_footer_text', 'remove_footer_admin');

 function remove_footer_admin () {
echo 'Designed by <a href="https://elryad.com" target="_blank">elryad.com</a></p>';
}