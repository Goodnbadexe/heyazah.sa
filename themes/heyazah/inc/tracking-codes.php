<?php
/**
 * Tracking Codes and Analytics
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add tracking codes to head
function add_custom_tracking_codes() {
    $google_analytics = get_field('google_analytics', 'option');
    $google_tag_manager = get_field('google_tag_manager', 'option');
    $facebook_pixel = get_field('facebook_pixel', 'option');
    $custom_head_code = get_field('custom_head_code', 'option');
    
    // Google Analytics
    if ($google_analytics) {
        echo "<!-- Global site tag (gtag.js) - Google Analytics -->\n";
        echo "<script async src=\"https://www.googletagmanager.com/gtag/js?id={$google_analytics}\"></script>\n";
        echo "<script>\n";
        echo "  window.dataLayer = window.dataLayer || [];\n";
        echo "  function gtag(){dataLayer.push(arguments);}\n";
        echo "  gtag('js', new Date());\n";
        echo "  gtag('config', '{$google_analytics}');\n";
        echo "</script>\n";
    }
    
    // Google Tag Manager
    if ($google_tag_manager) {
        echo "<!-- Google Tag Manager -->\n";
        echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':\n";
        echo "new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],\n";
        echo "j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=\n";
        echo "'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);\n";
        echo "})(window,document,'script','dataLayer','{$google_tag_manager}');</script>\n";
        echo "<!-- End Google Tag Manager -->\n";
    }
    
    // Facebook Pixel
    if ($facebook_pixel) {
        echo "<!-- Facebook Pixel Code -->\n";
        echo "<script>\n";
        echo "!function(f,b,e,v,n,t,s)\n";
        echo "{if(f.fbq)return;n=f.fbq=function(){n.callMethod?\n";
        echo "n.callMethod.apply(n,arguments):n.queue.push(arguments)};\n";
        echo "if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';\n";
        echo "n.queue=[];t=b.createElement(e);t.async=!0;\n";
        echo "t.src=v;s=b.getElementsByTagName(e)[0];\n";
        echo "s.parentNode.insertBefore(t,s)}(window, document,'script',\n";
        echo "'https://connect.facebook.net/en_US/fbevents.js');\n";
        echo "fbq('init', '{$facebook_pixel}');\n";
        echo "fbq('track', 'PageView');\n";
        echo "</script>\n";
        echo "<noscript><img height=\"1\" width=\"1\" style=\"display:none\"\n";
        echo "src=\"https://www.facebook.com/tr?id={$facebook_pixel}&ev=PageView&noscript=1\"\n";
        echo "/></noscript>\n";
        echo "<!-- End Facebook Pixel Code -->\n";
    }
    
    // Custom head code
    if ($custom_head_code) {
        echo "<!-- Custom Head Code -->\n";
        echo $custom_head_code . "\n";
        echo "<!-- End Custom Head Code -->\n";
    }
}
add_action('wp_head', 'add_custom_tracking_codes');

// Add Google Tag Manager noscript to body
function add_google_tag_manager_noscript() {
    $google_tag_manager = get_field('google_tag_manager', 'option');
    
    if ($google_tag_manager) {
        echo "<!-- Google Tag Manager (noscript) -->\n";
        echo "<noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id={$google_tag_manager}\"\n";
        echo "height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>\n";
        echo "<!-- End Google Tag Manager (noscript) -->\n";
    }
}
add_action('wp_body_open', 'add_google_tag_manager_noscript');

// Add custom footer code
function add_custom_footer_code() {
    $custom_footer_code = get_field('custom_footer_code', 'option');
    
    if ($custom_footer_code) {
        echo "<!-- Custom Footer Code -->\n";
        echo $custom_footer_code . "\n";
        echo "<!-- End Custom Footer Code -->\n";
    }
}
add_action('wp_footer', 'add_custom_footer_code');