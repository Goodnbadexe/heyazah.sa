<?php
/**
 * Immersive 3D/360 embeds for Heyazah Project Pages
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode('heyazah_project_embed', function($atts) {
    ob_start();
    get_template_part('template-parts/project-cloud-embed');
    return ob_get_clean();
});

add_shortcode('heyazah_site_entrance', function($atts) {
    ob_start();
    get_template_part('template-parts/site-entrance');
    return ob_get_clean();
});

function heyazah_json_meta( $post_id, $key, $default = array() ) {
    $raw = get_post_meta( $post_id, $key, true );
    if ( empty( $raw ) ) {
        return $default;
    }
    $decoded = json_decode( $raw, true );
    return is_array( $decoded ) ? $decoded : $default;
}

function heyazah_locale() {
    return is_rtl() ? 'ar' : 'en';
}

function heyazah_localized_value( $value ) {
    if ( is_array( $value ) ) {
        $locale = heyazah_locale();
        return $value[ $locale ] ?? $value['en'] ?? $value['ar'] ?? '';
    }
    return is_scalar( $value ) ? (string) $value : '';
}

add_shortcode( 'heyazah_project_metrics', function() {
    $post_id = get_the_ID();
    $metrics = heyazah_json_meta( $post_id, '_heyazah_metrics' );
    $rows = array(
        array( 'key' => 'total_units', 'icon' => 'amenity-key.svg', 'label_en' => 'Total Units', 'label_ar' => 'عدد الوحدات', 'suffix' => '' ),
        array( 'key' => 'parking_spaces', 'icon' => 'amenity-parking.svg', 'label_en' => 'Parking Spaces', 'label_ar' => 'عدد المواقف', 'suffix' => '' ),
        array( 'key' => 'office_area_m2', 'icon' => 'amenity-desk.svg', 'label_en' => 'Office Area', 'label_ar' => 'المساحة المكتبية', 'suffix' => ' m²' ),
        array( 'key' => 'rental_area_m2', 'icon' => 'amenity-building.svg', 'label_en' => 'Rental Area', 'label_ar' => 'المساحة التأجيرية', 'suffix' => ' m²' ),
        array( 'key' => 'commercial_galleries_m2', 'icon' => 'amenity-store.svg', 'label_en' => 'Galleries', 'label_ar' => 'صالات تجارية', 'suffix' => ' m²' ),
        array( 'key' => 'starting_price_sar', 'icon' => 'ui-star.svg', 'label_en' => 'Starting Price', 'label_ar' => 'السعر يبدأ من', 'suffix' => ' SAR' ),
        array( 'key' => 'delivery_date_yyyymmdd', 'icon' => 'ui-calendar.svg', 'label_en' => 'Delivery', 'label_ar' => 'التسليم', 'suffix' => '' ),
    );

    $items = array();
    foreach ( $rows as $row ) {
        if ( empty( $metrics[ $row['key'] ] ) ) {
            continue;
        }
        $items[] = array(
            'icon'  => $row['icon'],
            'label' => is_rtl() ? $row['label_ar'] : $row['label_en'],
            'value' => $metrics[ $row['key'] ] . $row['suffix'],
        );
    }

    if ( empty( $items ) ) {
        return '';
    }

    ob_start();
    ?>
    <ul class="h-project-metrics gs-metric-rise">
        <?php foreach ( $items as $item ) : ?>
            <li class="h-project-metric">
                <img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/' . $item['icon'] ) ); ?>" alt="" loading="lazy" />
                <span>
                    <small><?php echo esc_html( $item['label'] ); ?></small>
                    <strong><?php echo esc_html( $item['value'] ); ?></strong>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
    return ob_get_clean();
} );

add_shortcode( 'heyazah_project_gallery', function() {
    $gallery = heyazah_json_meta( get_the_ID(), '_heyazah_gallery' );
    $gallery = array_values( array_filter( array_map( function( $item ) {
        if ( is_string( $item ) ) {
            return $item;
        }
        return is_array( $item ) ? ( $item['url'] ?? $item['path'] ?? '' ) : '';
    }, $gallery ) ) );

    if ( empty( $gallery ) ) {
        return '';
    }

    ob_start();
    ?>
    <section class="h-project-gallery gs-gallery-sweep">
        <?php foreach ( $gallery as $index => $src ) : ?>
            <figure class="<?php echo 0 === $index % 5 ? 'is-large' : ''; ?>">
                <img src="<?php echo esc_url( $src ); ?>" alt="" loading="lazy" />
            </figure>
        <?php endforeach; ?>
    </section>
    <?php
    return ob_get_clean();
} );

add_shortcode( 'heyazah_project_media_actions', function() {
    $media = heyazah_json_meta( get_the_ID(), '_heyazah_media' );
    $actions = array(
        array( 'key' => 'virtual_tour_url', 'icon' => 'ui-eye-white.svg', 'label_en' => 'Virtual Tour', 'label_ar' => 'جولة افتراضية', 'class' => 'is-primary' ),
        array( 'key' => 'video_url', 'icon' => 'ui-video.svg', 'label_en' => 'Video', 'label_ar' => 'فيديو', 'class' => 'is-outline' ),
        array( 'key' => 'brochure_url', 'icon' => 'ui-envelope.svg', 'label_en' => 'Brochure', 'label_ar' => 'الكتيب', 'class' => 'is-warm' ),
    );

    ob_start();
    ?>
    <div class="h-media-actions">
        <?php foreach ( $actions as $action ) : ?>
            <?php if ( ! empty( $media[ $action['key'] ] ) ) : ?>
                <a class="h-media-action <?php echo esc_attr( $action['class'] ); ?>" href="<?php echo esc_url( $media[ $action['key'] ] ); ?>" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/' . $action['icon'] ) ); ?>" alt="" loading="lazy" />
                    <?php echo esc_html( is_rtl() ? $action['label_ar'] : $action['label_en'] ); ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php
    $html = trim( ob_get_clean() );
    return false === strpos( $html, '<a ' ) ? '' : $html;
} );

add_shortcode( 'heyazah_project_map', function() {
    $map = get_post_meta( get_the_ID(), '_heyazah_map_embed', true );
    if ( empty( $map ) ) {
        return '';
    }
    return '<div class="h-map-embed gs-map-expand">' . wp_kses( $map, array(
        'iframe' => array(
            'src' => true,
            'width' => true,
            'height' => true,
            'style' => true,
            'allowfullscreen' => true,
            'loading' => true,
            'referrerpolicy' => true,
        ),
    ) ) . '</div>';
} );
