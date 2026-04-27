<?php
/**
 * Template part for units filter sidebar with AJAX support
 * File location: template-parts/units-filter.php
 */

// Get project ID from query var
$project_id = get_query_var('filter_project_id', get_the_ID());

// Get filter options (bilingual: English/Arabic using ml_get helper)
$floor_options = array(
    'all' => ml_get('[:en]All[:ar]الكل[:]'),
    'ground' => ml_get('[:en]Ground Floor[:ar]الأرضي[:]'),
    'first' => ml_get('[:en]First Floor[:ar]الأول[:]'),
    'second' => ml_get('[:en]Second Floor[:ar]الثاني[:]'),
    'third' => ml_get('[:en]Third Floor[:ar]الثالث[:]'),
    'fourth' => ml_get('[:en]Fourth Floor[:ar]الرابع[:]'),
    'fifth' => ml_get('[:en]Fifth Floor[:ar]الخامس[:]'),
);

$room_options = array(
    'all' => ml_get('[:en]All[:ar]الكل[:]'),
    '1' => ml_get('[:en]1 Room[:ar]غرفة واحدة[:]'),
    '2' => ml_get('[:en]2 Rooms[:ar]غرفتين[:]'),
    '3' => ml_get('[:en]3 Rooms[:ar]ثلاث غرف[:]'),
    '4' => ml_get('[:en]4 Rooms[:ar]أربع غرف[:]'),
    '5' => ml_get('[:en]5 Rooms[:ar]خمس غرف[:]'),
);

$status_options = array(
    'all' => ml_get('[:en]All[:ar]الكل[:]'),
    'available' => ml_get('[:en]Available[:ar]متاح[:]'),
    'reserved' => ml_get('[:en]Reserved[:ar]محجوز[:]'),
    'sold' => ml_get('[:en]Sold[:ar]مباع[:]'),
);

// Get min and max prices for the slider
global $wpdb;
$price_range = $wpdb->get_row(
    $wpdb->prepare(
        "SELECT MIN(CAST(meta_value AS UNSIGNED)) as min_price, 
                MAX(CAST(meta_value AS UNSIGNED)) as max_price 
         FROM {$wpdb->postmeta} 
         WHERE meta_key = 'unit_price' 
         AND post_id IN (
             SELECT post_id 
             FROM {$wpdb->postmeta} 
             WHERE meta_key = 'unit_project' 
             AND meta_value = %d
         )",
        $project_id
    )
);

$min_price = $price_range->min_price ? $price_range->min_price : 100000;
$max_price = $price_range->max_price ? $price_range->max_price : 5000000;
?>

<div class="fillter-single">
    <div class="search-title">
        <h4><?php ml_text('[:en]Search Filter[:ar]فلترة البحث[:]'); ?></h4>
    </div>
    
    <form id="units-filter-form" data-project-id="<?php echo esc_attr($project_id); ?>">
        <div class="fillter-items">
            
            <!-- Price Range Filter -->
            <div class="item">
                <div class="item-inner">
                    <h3 class="title-item"><?php ml_text('[:en]Price[:ar]السعر[:]'); ?></h3>
                    <div class="range">
                        <div class="range-wrapper">
                            <input type="text" 
                                   class="js-range-slider" 
                                   name="price_range"
                                   data-type="double"
                                   data-min="<?php echo $min_price; ?>" 
                                   data-max="<?php echo $max_price; ?>" 
                                   data-from="<?php echo $min_price; ?>" 
                                   data-to="<?php echo $max_price; ?>"
                                   data-prefix="ر.س "
                                   data-grid="true"
                                   data-hide-min-max="true" />

                            <div class="range-label-wrapper">
                                <div class="range-label from">
                                    <span class="text"><?php ml_text('[:en]From[:ar]من[:]'); ?></span>
                                    <span class="value" id="price-from"><?php echo number_format($min_price); ?></span>
                                </div>
                                <div class="range-label to">
                                    <span class="text"><?php ml_text('[:en]To[:ar]إلى[:]'); ?></span>
                                    <span class="value" id="price-to"><?php echo number_format($max_price); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Filter -->
            <div class="item">
                <div class="status">
                    <h3 class="title-item"><?php ml_text('[:en]Status[:ar]الحالة[:]'); ?></h3>
                    <div class="checkRadio" id="status">
                        <?php foreach ($status_options as $value => $label): ?>
                        <div class="item-check">
                            <label>
                                <input type="radio" 
                                       name="status" 
                                       id="status-<?php echo $value; ?>" 
                                       value="<?php echo $value; ?>"
                                       <?php checked($value, 'all'); ?>>
                                <span><?php echo $label; ?></span>
                                <h6 class="status-numer" data-filter="status-<?php echo $value; ?>">(0)</h6>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Floor Filter -->
            <div class="item">
                <div class="floors">
                    <h3 class="title-item"><?php ml_text('[:en]Floor[:ar]الدور[:]'); ?></h3>
                    <div class="checkRadio" id="role_wrap">
                        <?php foreach ($floor_options as $value => $label): ?>
                        <div class="item-check">
                            <label>
                                <input type="radio" 
                                       name="floor" 
                                       id="floor-<?php echo $value; ?>" 
                                       value="<?php echo $value; ?>"
                                       <?php checked($value, 'all'); ?>>
                                <span><?php echo $label; ?></span>
                                <h6 class="status-numer" data-filter="floor-<?php echo $value; ?>">(0)</h6>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Rooms Filter -->
            <div class="item">
                <div class="rooms">
                    <h3 class="title-item"><?php ml_text('[:en]Number of Rooms[:ar]عدد الغرف[:]'); ?></h3>
                    <div class="checkRadio" id="room_wrap">
                        <?php foreach ($room_options as $value => $label): ?>
                        <div class="item-check">
                            <label>
                                <input type="radio" 
                                       name="rooms" 
                                       id="room-<?php echo $value; ?>" 
                                       value="<?php echo $value; ?>"
                                       <?php checked($value, 'all'); ?>>
                                <span><?php echo $label; ?></span>
                                <h6 class="status-numer" data-filter="room-<?php echo $value; ?>">(0)</h6>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Reset Button (Optional) -->
            <div class="item">
                <button type="button" class="btn btn-secondary btn-block reset-filters">
                    <?php ml_text('[:en]Reset Filters[:ar]إعادة تعيين الفلاتر[:]'); ?>
                </button>
            </div>

        </div>
    </form>
</div>

