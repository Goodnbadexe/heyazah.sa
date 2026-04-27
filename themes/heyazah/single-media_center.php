<?php
get_header();

while (have_posts()) : the_post();

    /**
     * Get media_center taxonomy terms
     */
    $terms = get_the_terms(get_the_ID(), 'media_type');

    $is_news = false;

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            if ($term->slug === 'news' || (int) $term->term_id === 10) {
                $is_news = true;
                break;
            }
        }
    }

    /**
     * Load template based on term
     */
    if ($is_news) {
        get_template_part('template-parts/media-center/single', 'news');
    } else {
        // Fallback for other media center types
        get_template_part('template-parts/media-center/single', 'default');
    }

endwhile;

get_footer();?>

<script>
jQuery(document).on('click', '.copy-link', function (e) {
    e.preventDefault();

    var link = jQuery(this).data('link');

    // Create temp input
    var tempInput = jQuery('<input>');
    jQuery('body').append(tempInput);
    tempInput.val(link).select();

    try {
        document.execCommand('copy');
        alert('تم نسخ الرابط');
    } catch (err) {
        alert('لم يتم نسخ الرابط');
    }

    tempInput.remove();
});


</script>

