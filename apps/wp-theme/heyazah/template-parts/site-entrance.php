<?php
/**
 * Site Entrance Template Part
 * 
 * This creates a full-viewport overlay for the first visit to the site.
 */

$site_entrance_enabled = get_field('site_entrance_enabled', 'option');
if (!$site_entrance_enabled) {
    return;
}

$site_entrance_url = get_field('site_entrance_url', 'option');
if (empty($site_entrance_url)) {
    return;
}
?>

<div id="heyazah-site-entrance" style="position:fixed; top:0; left:0; width:100vw; height:100vh; z-index:99999; background:#111; transition: opacity 0.8s ease-in-out;">
    <iframe
        src="<?php echo esc_url($site_entrance_url); ?>"
        title="<?php echo esc_attr__('Heyazah Immersive Entrance', 'heyazah'); ?>"
        style="width:100%; height:100%; border:none;"
        allow="fullscreen; xr-spatial-tracking; gyroscope; accelerometer"
        allowfullscreen>
    </iframe>
    
    <div style="position:absolute; bottom:40px; left:50%; transform:translateX(-50%); z-index:100000;">
        <button id="h-entrance-skip-btn" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); backdrop-filter:blur(10px); padding:12px 32px; border-radius:50px; color:#fff; font-size:14px; font-weight:600; cursor:pointer; transition:all 0.3s ease;">
            <?php echo esc_html__('Skip to website', 'heyazah'); ?>
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var entrance = document.getElementById('heyazah-site-entrance');
    var skipBtn = document.getElementById('h-entrance-skip-btn');
    
    if (!entrance) return;

    // Use JS to check sessionStorage so it works perfectly with page caching
    if (sessionStorage.getItem('heyazah_entrance_seen')) {
        entrance.style.display = 'none';
        return;
    }
    
    document.body.style.overflow = 'hidden';
    
    skipBtn.addEventListener('click', function() {
        sessionStorage.setItem('heyazah_entrance_seen', 'true');
        entrance.style.opacity = '0';
        entrance.style.pointerEvents = 'none';
        document.body.style.overflow = '';
        
        setTimeout(function() {
            entrance.remove();
        }, 800);
    });
});
</script>
