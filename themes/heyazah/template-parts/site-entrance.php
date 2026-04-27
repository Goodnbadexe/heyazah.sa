<?php
/**
 * Site-level immersive entrance.
 *
 * This is intentionally separate from project 3D/360 embeds.
 *
 * @package ELRYAD
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!is_front_page() && !is_home()) {
    return;
}

$enabled = function_exists('get_field') ? (bool) get_field('site_entrance_enabled', 'option') : false;
$entrance_url = function_exists('get_field') ? get_field('site_entrance_url', 'option') : '';
$poster = function_exists('get_field') ? get_field('site_entrance_poster', 'option') : '';
$button_en = function_exists('get_field') ? get_field('site_entrance_button_en', 'option') : '';
$button_ar = function_exists('get_field') ? get_field('site_entrance_button_ar', 'option') : '';
$once_per_session_raw = function_exists('get_field') ? get_field('site_entrance_once_per_session', 'option') : true;
$once_per_session = ($once_per_session_raw === null || $once_per_session_raw === '') ? true : (bool) $once_per_session_raw;

if (!$enabled || empty($entrance_url)) {
    return;
}

if (is_array($poster)) {
    $poster = $poster['url'] ?? '';
}

$logo = function_exists('get_theme_option') ? get_theme_option('logo') : '';
$button_label = is_rtl()
    ? ($button_ar ?: 'ادخل عالم حيازة')
    : ($button_en ?: 'Enter Heyazah');
$skip_label = is_rtl() ? 'تخطي' : 'Skip';
$eyebrow = is_rtl() ? 'تجربة حيازة التفاعلية' : 'Heyazah immersive experience';
?>

<section
    class="heyazah-site-entrance"
    data-site-entrance
    data-state="gate"
    data-beat="0"
    data-once-per-session="<?php echo $once_per_session ? 'true' : 'false'; ?>"
    aria-label="<?php echo esc_attr($eyebrow); ?>"
>
    <div class="heyazah-site-entrance__media" aria-hidden="true">
        <?php if ($poster): ?>
            <img class="heyazah-site-entrance__poster" src="<?php echo esc_url($poster); ?>" alt="" loading="eager">
        <?php endif; ?>
        <iframe
            class="heyazah-site-entrance__frame"
            data-src="<?php echo esc_url($entrance_url); ?>"
            title="<?php echo esc_attr($eyebrow); ?>"
            allow="fullscreen; xr-spatial-tracking; gyroscope; accelerometer"
            allowfullscreen
        ></iframe>
    </div>

    <div class="heyazah-site-entrance__shade" aria-hidden="true"></div>

    <div class="heyazah-site-entrance__chrome">
        <?php if ($logo): ?>
            <img class="heyazah-site-entrance__logo" src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>">
        <?php else: ?>
            <span class="heyazah-site-entrance__wordmark"><?php bloginfo('name'); ?></span>
        <?php endif; ?>

        <button class="heyazah-site-entrance__skip" type="button" data-site-entrance-close>
            <?php echo esc_html($skip_label); ?>
        </button>
    </div>

    <div class="heyazah-site-entrance__content">
        <p class="heyazah-site-entrance__eyebrow"><?php echo esc_html($eyebrow); ?></p>
        <h1 class="heyazah-site-entrance__title">
            <?php
            if (function_exists('ml_text')) {
                ml_text('[:en]A real estate world shaped by presence, precision, and place.[:ar]عالم عقاري تصنعه الحضور والدقة والمكان.');
            } else {
                echo esc_html(is_rtl() ? 'عالم عقاري تصنعه الحضور والدقة والمكان.' : 'A real estate world shaped by presence, precision, and place.');
            }
            ?>
        </h1>
        <button class="heyazah-site-entrance__enter" type="button" data-site-entrance-enter>
            <span><?php echo esc_html($button_label); ?></span>
        </button>
        <a
            class="heyazah-site-entrance__fallback-link"
            href="<?php echo esc_url($entrance_url); ?>"
            target="_blank"
            rel="noopener noreferrer"
            data-site-entrance-fallback
        >
            <?php echo esc_html(is_rtl() ? 'فتح التجربة مباشرة' : 'Open experience directly'); ?>
        </a>
    </div>

    <div class="heyazah-site-entrance__progress" aria-hidden="true">
        <span class="heyazah-site-entrance__phase" data-site-entrance-phase>01</span>
        <span class="heyazah-site-entrance__phase-label" data-site-entrance-phase-label>
            <?php echo esc_html(is_rtl() ? 'البداية' : 'Arrival'); ?>
        </span>
        <span class="heyazah-site-entrance__rail">
            <span class="heyazah-site-entrance__rail-fill" data-site-entrance-progress></span>
        </span>
    </div>

    <div class="heyazah-site-entrance__scroll-cue" data-site-entrance-scroll-cue aria-hidden="true">
        <?php echo esc_html(is_rtl() ? 'مرر للمتابعة' : 'Scroll to continue'); ?>
    </div>

    <div class="heyazah-site-entrance__beats" aria-hidden="true">
        <div class="heyazah-site-entrance__beat" data-beat-card="1">
            <span class="heyazah-site-entrance__beat-value"><?php echo esc_html(is_rtl() ? '٢٠٠٥' : '2005'); ?></span>
            <span class="heyazah-site-entrance__beat-label"><?php echo esc_html(is_rtl() ? 'بداية الحكاية' : 'Foundation'); ?></span>
        </div>
        <div class="heyazah-site-entrance__beat" data-beat-card="2">
            <span class="heyazah-site-entrance__beat-value"><?php echo esc_html(is_rtl() ? 'الرياض' : 'Riyadh'); ?></span>
            <span class="heyazah-site-entrance__beat-label"><?php echo esc_html(is_rtl() ? 'وجهات عمرانية وسكنية' : 'Urban and residential destinations'); ?></span>
        </div>
        <div class="heyazah-site-entrance__beat" data-beat-card="3">
            <span class="heyazah-site-entrance__beat-value"><?php echo esc_html(is_rtl() ? 'محفظة' : 'Portfolio'); ?></span>
            <span class="heyazah-site-entrance__beat-label"><?php echo esc_html(is_rtl() ? 'اكمل إلى المشاريع' : 'Continue into projects'); ?></span>
        </div>
    </div>

    <noscript>
        <style>.heyazah-site-entrance{display:none!important}</style>
    </noscript>
</section>
