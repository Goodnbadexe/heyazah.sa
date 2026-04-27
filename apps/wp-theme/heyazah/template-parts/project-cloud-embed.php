<?php
/**
 * Project Cloud Embed Template Part
 */

$cloud_embed_enabled = apply_filters('acf/load_value', get_field('cloud_embed_enabled'));
if ($cloud_embed_enabled === false || $cloud_embed_enabled === '0') {
    // If specifically disabled or not set
    // But we might still want to check fallback models or tours if the logic allows
}

$cloud_embed_url = get_field('cloud_embed_url');
$project_model_url = get_field('project_model_url');
$virtual_reality_iframe = get_field('virtual_reality_iframe');

// If nothing at all is available, bail
if (empty($cloud_embed_url) && empty($project_model_url) && empty($virtual_reality_iframe)) {
    return;
}

$poster = get_field('cloud_embed_poster');
$poster_url = $poster ? $poster['url'] : '';

?>
<div class="wp-block-group p-virtual-tour gs-cinematic-fade" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
    <h2 class="wp-block-heading has-text-align-center"><?php echo esc_html__('Explore the Space', 'heyazah'); ?></h2>
    
    <div class="h-3d-embed-container" style="width:100%; height:600px; background:#111; border-radius:12px; overflow:hidden; position: relative;">
        
        <!-- Priority 1: Cloud Embed URL -->
        <?php if (!empty($cloud_embed_url)) : ?>
            <iframe
                src="<?php echo esc_url($cloud_embed_url); ?>"
                loading="lazy"
                title="<?php echo esc_attr__('Project Cloud Embed', 'heyazah'); ?>"
                style="width: 100%; height: 100%; border: none;"
                allow="fullscreen; xr-spatial-tracking; gyroscope; accelerometer"
                allowfullscreen>
            </iframe>
            
        <!-- Priority 2: Direct 3D Model -->
        <?php elseif (!empty($project_model_url)) : ?>
            <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.3.0/model-viewer.min.js"></script>
            <model-viewer
                src="<?php echo esc_url($project_model_url); ?>"
                poster="<?php echo esc_url($poster_url); ?>"
                camera-controls auto-rotate ar shadow-intensity="0.8" loading="lazy" reveal="interaction"
                style="width:100%; height:100%;">
            </model-viewer>
            
        <!-- Priority 3: Fallback Virtual Reality Iframe -->
        <?php elseif (!empty($virtual_reality_iframe)) : ?>
            <div style="width:100%; height:100%;">
                <?php echo wp_kses_post($virtual_reality_iframe); ?>
            </div>
        <?php endif; ?>
        
    </div>
</div>
