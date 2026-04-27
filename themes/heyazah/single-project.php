<?php
/**
 * Single Project Template
 * Displays project details and related units filtered by sectors
 * @package ELRYAD
 */

get_header();

while (have_posts()) : the_post();

// Get ACF fields

// Project hero
$hero_image = get_field('hero_image');
$hero_icon = get_field('hero_icon');
$hero_des = get_field('hero_des');
$hero_profile_pdf = get_field('profile_pdf') ?: get_field('profile_pdf_url');
$hero_360_virtual_tourf = get_field('360_virtual_tour');

// Project Basic Information
$location = get_field('project_location_2');
$rental_area = get_field('project_rental_area');
$parking_spaces = get_field('project_parking_spaces');
$office_area = get_field('project_office_area');
$total_units = get_field('project_total_units');
$commercial_galleries = get_field('project_commercial_galleries');

// Project content sections
$content_sections_rep = get_field('content_rep');

// business destination
$business_destin_title = get_field('business_destination_title');
$business_destin_des = get_field('business_destination_des');

// Gallery
$gallery = get_field('project_gallery');
// Debug: Check gallery format
if ($gallery) {
    error_log('Gallery type: ' . gettype($gallery));
    error_log('Gallery content: ' . print_r($gallery, true));
}

// Virtual Reality
// $virtual_reality_txt = get_field('virtual_reality_txt');
// $virtual_reality_ima = get_field('virtual_reality_ima');
$virtual_reality_iframe = get_field('virtual_reality_iframe');
// Project Map location

$map_image = get_field('map_image');
// Get all sectors that have units in this project
$project_id = get_the_ID();
$sectors = get_terms(array(
    'taxonomy' => 'sector',
    'hide_empty' => true,
));

// Filter sectors to only show those with units in this project
$project_sectors = array();
foreach ($sectors as $sector) {
    $sector_units = new WP_Query(array(
        'post_type' => 'unit',
        'posts_per_page' => 1,
        'meta_query' => array(
            array(
                'key' => 'unit_project',
                'value' => $project_id,
                'compare' => '='
            )
        ),
        'tax_query' => array(
            array(
                'taxonomy' => 'sector',
                'field' => 'slug',
                'terms' => $sector->slug,
            )
        )
    ));
    
    if ($sector_units->have_posts()) {
        $project_sectors[] = $sector;
    }
    wp_reset_postdata();
}
?>
<style>
    .irs--round .irs-from, .irs--round .irs-to, .irs--round .irs-single{display:none}
</style>

    <!-- -----------------------  page content  ----------------------   -->
    <section class="single-p-hero">
        <div class="single-project-hero">
            <img src="<?php echo $hero_image;?>" alt="">
        </div>
        <div class="single-p-hero-details">
            <div class="s-img"><img src="<?php echo $hero_icon;?>" alt=""></div>
            <h6><?php echo $hero_des;?></h6>
            <div class="singl-btns">
                <div class="read-more"><a href="<?php echo $hero_profile_pdf;?>" download="" target="_blank">
                       <?php ml_text('[:en]Profile[:ar]الملف التعريفي'); ?> 
                    </a></div>
				<?php if ($virtual_reality_iframe): ?>
                <div class="read-more virtual-tour">
                    <a href="#virtual_reality">
                       <?php ml_text('[:en]360° virtual tour[:ar]جولة افتراضية 360°'); ?> 
                    </a>
                </div>
				<?php endif; ?>
            </div>
            
            <div class="achiev-rate">
            
            <?php if( have_rows('achiev_steps') ): ?>
                
                <?php while( have_rows('achiev_steps') ): the_row(); 
                    
                    $title  = get_sub_field('title');
                    $status = get_sub_field('status');
            
                ?>
            
                    <div class="item <?php echo esc_attr($status); ?>">
            
                        <div class="icon">
            
                            <?php if($status == 'doneH'): ?>
            
                                <!-- Done Icon -->
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2029_4815)">
                                    <path d="M7.92855 1.32135C8.80498 1.32422 9.67214 1.50089 10.4798 1.84112C11.2875 2.18135 12.0198 2.67838 12.6341 3.30347H10.5714C10.3961 3.30347 10.2281 3.37308 10.1042 3.49698C9.98028 3.62089 9.91067 3.78894 9.91067 3.96417C9.91067 4.1394 9.98028 4.30746 10.1042 4.43136C10.2281 4.55527 10.3961 4.62488 10.5714 4.62488H13.3087C13.634 4.6247 13.946 4.49538 14.1761 4.26533C14.4061 4.03527 14.5354 3.7233 14.5356 3.39795V0.660644C14.5356 0.485414 14.466 0.317361 14.3421 0.193454C14.2182 0.0695481 14.0501 -6.18095e-05 13.8749 -6.18095e-05C13.6997 -6.18095e-05 13.5316 0.0695481 13.4077 0.193454C13.2838 0.317361 13.2142 0.485414 13.2142 0.660644V2.03359C12.1222 1.0501 10.7779 0.390025 9.33195 0.127289C7.88601 -0.135448 6.39546 0.00952632 5.02725 0.545977C3.65903 1.08243 2.46717 1.98917 1.58512 3.16467C0.703077 4.34016 0.165682 5.738 0.0331172 7.20163C0.0245831 7.29364 0.0353079 7.38642 0.0646083 7.47405C0.0939087 7.56168 0.141142 7.64225 0.203299 7.71063C0.265456 7.779 0.341174 7.83368 0.425628 7.87117C0.510082 7.90867 0.60142 7.92816 0.693823 7.92841C0.855423 7.93047 1.01198 7.87214 1.13283 7.76484C1.25369 7.65755 1.33016 7.50901 1.34726 7.34831C1.49434 5.70364 2.25109 4.17342 3.46884 3.05824C4.68659 1.94306 6.27732 1.32352 7.92855 1.32135Z" fill="white"/>
                                    <path d="M15.1637 7.92864C15.0021 7.92658 14.8456 7.98491 14.7247 8.0922C14.6039 8.1995 14.5274 8.34804 14.5103 8.50874C14.4011 9.76622 13.9334 10.966 13.1629 11.9657C12.3923 12.9654 11.3512 13.7231 10.1629 14.1489C8.97472 14.5747 7.6893 14.6507 6.45917 14.368C5.22904 14.0852 4.10583 13.4555 3.2228 12.5536H5.28552C5.46075 12.5536 5.62881 12.484 5.75271 12.3601C5.87662 12.2362 5.94623 12.0681 5.94623 11.8929C5.94623 11.7177 5.87662 11.5496 5.75271 11.4257C5.62881 11.3018 5.46075 11.2322 5.28552 11.2322H2.54822C2.38707 11.2321 2.22749 11.2638 2.07859 11.3254C1.92969 11.387 1.7944 11.4774 1.68046 11.5913C1.56651 11.7053 1.47614 11.8406 1.41451 11.9895C1.35288 12.1384 1.3212 12.298 1.32129 12.4591V15.1964C1.32129 15.3717 1.3909 15.5397 1.51481 15.6636C1.63871 15.7875 1.80676 15.8571 1.98199 15.8571C2.15722 15.8571 2.32528 15.7875 2.44918 15.6636C2.57309 15.5397 2.6427 15.3717 2.6427 15.1964V13.8235C3.73473 14.807 5.07899 15.467 6.52494 15.7298C7.97089 15.9925 9.46143 15.8475 10.8296 15.3111C12.1979 14.7746 13.3897 13.8679 14.2718 12.6924C15.1538 11.5169 15.6912 10.1191 15.8238 8.65542C15.8323 8.56341 15.8216 8.47063 15.7923 8.383C15.763 8.29536 15.7158 8.21479 15.6536 8.14642C15.5914 8.07805 15.5157 8.02337 15.4313 7.98588C15.3468 7.94838 15.2555 7.92889 15.1631 7.92864H15.1637Z" fill="white"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_2029_4815">
                                    <rect width="15.8569" height="15.8569" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
            
                            <?php elseif($status == 'active'): ?>
            
                                <!-- Active Icon -->
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2029_4815)">
                                    <path d="M7.92855 1.32135C8.80498 1.32422 9.67214 1.50089 10.4798 1.84112C11.2875 2.18135 12.0198 2.67838 12.6341 3.30347H10.5714C10.3961 3.30347 10.2281 3.37308 10.1042 3.49698C9.98028 3.62089 9.91067 3.78894 9.91067 3.96417C9.91067 4.1394 9.98028 4.30746 10.1042 4.43136C10.2281 4.55527 10.3961 4.62488 10.5714 4.62488H13.3087C13.634 4.6247 13.946 4.49538 14.1761 4.26533C14.4061 4.03527 14.5354 3.7233 14.5356 3.39795V0.660644C14.5356 0.485414 14.466 0.317361 14.3421 0.193454C14.2182 0.0695481 14.0501 -6.18095e-05 13.8749 -6.18095e-05C13.6997 -6.18095e-05 13.5316 0.0695481 13.4077 0.193454C13.2838 0.317361 13.2142 0.485414 13.2142 0.660644V2.03359C12.1222 1.0501 10.7779 0.390025 9.33195 0.127289C7.88601 -0.135448 6.39546 0.00952632 5.02725 0.545977C3.65903 1.08243 2.46717 1.98917 1.58512 3.16467C0.703077 4.34016 0.165682 5.738 0.0331172 7.20163C0.0245831 7.29364 0.0353079 7.38642 0.0646083 7.47405C0.0939087 7.56168 0.141142 7.64225 0.203299 7.71063C0.265456 7.779 0.341174 7.83368 0.425628 7.87117C0.510082 7.90867 0.60142 7.92816 0.693823 7.92841C0.855423 7.93047 1.01198 7.87214 1.13283 7.76484C1.25369 7.65755 1.33016 7.50901 1.34726 7.34831C1.49434 5.70364 2.25109 4.17342 3.46884 3.05824C4.68659 1.94306 6.27732 1.32352 7.92855 1.32135Z" fill="white"/>
                                    <path d="M15.1637 7.92864C15.0021 7.92658 14.8456 7.98491 14.7247 8.0922C14.6039 8.1995 14.5274 8.34804 14.5103 8.50874C14.4011 9.76622 13.9334 10.966 13.1629 11.9657C12.3923 12.9654 11.3512 13.7231 10.1629 14.1489C8.97472 14.5747 7.6893 14.6507 6.45917 14.368C5.22904 14.0852 4.10583 13.4555 3.2228 12.5536H5.28552C5.46075 12.5536 5.62881 12.484 5.75271 12.3601C5.87662 12.2362 5.94623 12.0681 5.94623 11.8929C5.94623 11.7177 5.87662 11.5496 5.75271 11.4257C5.62881 11.3018 5.46075 11.2322 5.28552 11.2322H2.54822C2.38707 11.2321 2.22749 11.2638 2.07859 11.3254C1.92969 11.387 1.7944 11.4774 1.68046 11.5913C1.56651 11.7053 1.47614 11.8406 1.41451 11.9895C1.35288 12.1384 1.3212 12.298 1.32129 12.4591V15.1964C1.32129 15.3717 1.3909 15.5397 1.51481 15.6636C1.63871 15.7875 1.80676 15.8571 1.98199 15.8571C2.15722 15.8571 2.32528 15.7875 2.44918 15.6636C2.57309 15.5397 2.6427 15.3717 2.6427 15.1964V13.8235C3.73473 14.807 5.07899 15.467 6.52494 15.7298C7.97089 15.9925 9.46143 15.8475 10.8296 15.3111C12.1979 14.7746 13.3897 13.8679 14.2718 12.6924C15.1538 11.5169 15.6912 10.1191 15.8238 8.65542C15.8323 8.56341 15.8216 8.47063 15.7923 8.383C15.763 8.29536 15.7158 8.21479 15.6536 8.14642C15.5914 8.07805 15.5157 8.02337 15.4313 7.98588C15.3468 7.94838 15.2555 7.92889 15.1631 7.92864H15.1637Z" fill="white"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_2029_4815">
                                    <rect width="15.8569" height="15.8569" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
            
                            <?php else: ?>
            
                                <!-- Inactive Icon -->
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2029_4814)">
                                    <path d="M14.2881 5.60435L9.6008 0.916426C9.02068 0.337998 8.23488 0.0131836 7.41566 0.0131836C6.59644 0.0131836 5.81064 0.337998 5.23051 0.916426L0.543204 5.60435C0.370435 5.77601 0.233458 5.98026 0.140214 6.20526C0.0469703 6.43025 -0.000686195 6.67152 7.46477e-06 6.91507V12.9817C7.46477e-06 13.4734 0.19533 13.9449 0.543006 14.2926C0.890682 14.6403 1.36223 14.8356 1.85392 14.8356H12.9774C13.4691 14.8356 13.9406 14.6403 14.2883 14.2926C14.636 13.9449 14.8313 13.4734 14.8313 12.9817V6.91507C14.832 6.67152 14.7843 6.43025 14.6911 6.20526C14.5979 5.98026 14.4609 5.77601 14.2881 5.60435ZM9.26957 13.5997H5.56175V11.1686C5.56175 10.6769 5.75707 10.2053 6.10474 9.85765C6.45242 9.50997 6.92397 9.31465 7.41566 9.31465C7.90735 9.31465 8.3789 9.50997 8.72657 9.85765C9.07425 10.2053 9.26957 10.6769 9.26957 11.1686V13.5997ZM13.5954 12.9817C13.5954 13.1456 13.5303 13.3028 13.4144 13.4187C13.2985 13.5346 13.1413 13.5997 12.9774 13.5997H10.5055V11.1686C10.5055 10.3491 10.18 9.56316 9.60051 8.9837C9.02105 8.40424 8.23514 8.07871 7.41566 8.07871C6.59618 8.07871 5.81026 8.40424 5.2308 8.9837C4.65134 9.56316 4.3258 10.3491 4.3258 11.1686V13.5997H1.85392C1.69002 13.5997 1.53284 13.5346 1.41695 13.4187C1.30106 13.3028 1.23595 13.1456 1.23595 12.9817V6.91507C1.23652 6.75129 1.30157 6.59433 1.41701 6.47816L6.10432 1.79209C6.45267 1.44536 6.92416 1.25071 7.41566 1.25071C7.90715 1.25071 8.37864 1.44536 8.72699 1.79209L13.4143 6.48002C13.5293 6.59573 13.5943 6.75194 13.5954 6.91507V12.9817Z" fill="white"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_2029_4814">
                                    <rect width="14.8313" height="14.8313" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
            
                            <?php endif; ?>
            
                        </div>
            
                        <h4><?php echo esc_html($title); ?></h4>
            
                    </div>
            
                <?php endwhile; ?>
            
            <?php endif; ?>
            
            </div>
            
            <div class="hero-project-details">
               <ul>
                <?php if( have_rows('project_icon_rep') ): while( have_rows('project_icon_rep') ) : the_row(); ?>
                    <li>
                        <div class="img"><img src="<?php the_sub_field('icon'); ?>" alt=""></div>
                        <span class="key"><?php the_sub_field('naming'); ?></span>
                        <span><?php the_sub_field('value'); ?></span>
                    </li>
                <?php endwhile; endif;?>
                </ul>
               
               
               
                
                <!--old code-->
            <!--<ul>-->
            <!--    <?php if ($location): ?>-->
            <!--    <li>-->
            <!--        <div class="img"><img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/s-map.svg" alt=""></div>-->
            <!--        <span class="key"><?php ml_text('[:en]Location[:ar]الموقع'); ?></span>-->
            <!--        <span><?php echo esc_html($location); ?></span>-->
            <!--    </li>-->
            <!--    <?php endif; ?>-->

            <!--    <?php if ($rental_area): ?>-->
            <!--    <li>-->
            <!--        <div class="img"><img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/store-04.svg" alt=""></div>-->
            <!--        <span class="key"><?php ml_text('[:en]Rental Area[:ar]المساحة التأجيرية'); ?></span>-->
            <!--        <span><?php echo number_format($rental_area); ?></span>-->
            <!--    </li>-->
            <!--    <?php endif; ?>-->

            <!--    <?php if ($parking_spaces): ?>-->
            <!--    <li>-->
            <!--        <div class="img"><img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/car-parking-02.svg" alt=""></div>-->
            <!--        <span class="key"><?php ml_text('[:en]Parking Spaces[:ar]عدد المواقف'); ?></span>-->
            <!--        <span><?php echo number_format($parking_spaces); ?></span>-->
            <!--    </li>-->
            <!--    <?php endif; ?>-->

            <!--    <?php if ($office_area): ?>-->
            <!--    <li>-->
            <!--        <div class="img"><img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/desk.svg" alt=""></div>-->
            <!--        <span class="key"><?php ml_text('[:en]Office Area[:ar]المساحة المكتبية'); ?></span>-->
            <!--        <span><?php echo number_format($office_area, 2); ?></span>-->
            <!--    </li>-->
            <!--    <?php endif; ?>-->

            <!--    <?php if ($commercial_galleries): ?>-->
            <!--    <li>-->
            <!--        <div class="img"><img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/store-location-02.svg" alt=""></div>-->
            <!--        <span class="key"><?php ml_text('[:en]Commercial Galleries[:ar]المعارض التجارية'); ?></span>-->
            <!--        <span><?php echo number_format($commercial_galleries, 1); ?></span>-->
            <!--    </li>-->
            <!--    <?php endif; ?>-->
            <!--</ul>-->
            </div>
        </div>
    </section>

    <?php if ($content_sections_rep): ?>    
    <!-- --------------------  about single project ----------------   -->
    <section class="about-single-project">
        <div class="container-fliud">
          <?php foreach ($content_sections_rep as $section): ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="s-about-info">
                        <h5><?php echo esc_html($section['title']); ?></h5>
                        <p>
                            <?php echo esc_html($section['description']); ?>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="s-about-project-img"><img src="<?php echo esc_url($section['image']); ?>" alt=""></div>
                </div>
            </div>
          <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

	<?php if ($gallery): ?>
    <!-- ------------------  Central Business Destination  ------------------  -->
    <section class="central-business">
        <div class="container-fliud">
            <div class="central-business-disc">
                <h4><?php echo $business_destin_title;?></h4>
                <p>
                    <?php echo $business_destin_des;?>
                </p>
            </div>

            <?php if ($gallery && is_array($gallery) && !empty($gallery)): ?>            
                <div class="silge-project-slider owl-carousel owl-theme">
                <?php foreach ($gallery as $image): ?>
                    <?php 
                    // Debug each image
                    error_log('Image type: ' . gettype($image));
                    error_log('Image data: ' . print_r($image, true));
                    
                    // Handle different ACF gallery return formats
                    $image_url = '';
                    $image_alt = '';
                    
                    if (is_array($image)) {
                        $image_url = $image['url'] ?? '';
                        $image_alt = $image['alt'] ?? '';
                    } elseif (is_numeric($image)) {
                        // Image ID format
                        $image_url = wp_get_attachment_image_url($image, 'full');
                        $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                    }
                    
                    if ($image_url): ?>
                    <div class="item">
                        <div class="single-p-img">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
   <?php endif; ?>

<?php if (!empty($project_sectors)): ?>
<!-- Units and Prices Section -->
<section class="units-and-price">
    <div class="container">
        <div class="section-title">   
            <h4><?php ml_text('[:en]Units and Prices[:ar]الوحدات والاسعار'); ?> </h4>
        </div>
        
        <?php if (empty($project_sectors)): ?>
            <!-- No Units Message -->
            <div class="row">
                <div class="col-12 text-center py-5">
                    <p><?php ml_text('[:en]No units available for this project yet.[:ar]لا توجد وحدات متاحة لهذا المشروع حتى الآن.'); ?></p>
                </div>
            </div>
        <?php else: ?>
        
        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-lg-3">
                <?php 
                // Pass project ID to filter
                set_query_var('filter_project_id', $project_id);
                get_template_part('template-parts/units', 'filter'); 
                ?>
            </div>

            <!-- Units Tabs by Sector -->
            <div class="col-lg-9">
                <div class="unites-tab">
                    <!-- Sector Tabs Navigation -->
                    <ul class="nav nav-pills nav-product" id="pills-tab" role="tablist">
                        <?php 
                        $first_sector = true;
                        foreach ($project_sectors as $sector): 
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $first_sector ? 'active' : ''; ?>" 
                               id="pills-<?php echo $sector->slug; ?>-tab" 
                               data-toggle="pill" 
                               href="#pills-<?php echo $sector->slug; ?>"
                               role="tab" 
                               aria-controls="pills-<?php echo $sector->slug; ?>" 
                               aria-selected="<?php echo $first_sector ? 'true' : 'false'; ?>">
                                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/tab-icon.svg" alt="">
                                <span><?php echo $sector->name; ?></span>
                            </a>
                        </li>
                        <?php 
                        $first_sector = false;
                        endforeach; 
                        ?>
                    </ul>

                    <!-- Sector Tabs Content -->
                    <div class="tab-content" id="pills-tabContent">
                        <?php 
                        $first_sector = true;
                        foreach ($project_sectors as $sector): 
                            
                            // Query units for this sector
                            $sector_units = new WP_Query(array(
                                'post_type' => 'unit',
                                'posts_per_page' => -1,
                                'meta_query' => array(
                                    array(
                                        'key' => 'unit_project',
                                        'value' => $project_id,
                                        'compare' => '='
                                    )
                                ),
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'sector',
                                        'field' => 'slug',
                                        'terms' => $sector->slug,
                                    )
                                )
                            ));
                        ?>
                        
                        <div class="tab-pane fade <?php echo $first_sector ? 'show active' : ''; ?>" 
                             id="pills-<?php echo $sector->slug; ?>" 
                             role="tabpanel" 
                             aria-labelledby="pills-<?php echo $sector->slug; ?>-tab"
                             data-sector="<?php echo $sector->slug; ?>">
                            <div class="all-block">
                                <div class="row units-container">
                                    <?php
                                    if ($sector_units->have_posts()) :
                                        while ($sector_units->have_posts()) : $sector_units->the_post();
                                            get_template_part('template-parts/content', 'unit-card');
                                        endwhile;
                                        wp_reset_postdata();
                                    else:
                                        echo '<div class="col-12 text-center py-5"><p>' . __('لا توجد وحدات في هذا القطاع', 'textdomain') . '</p></div>';
                                    endif;
                                    ?>
                                </div>
                                <?php if ($sector_units->max_num_pages > 1): ?>
                                <div class="read-more text-center mt-4">
                                    <a href="#" class="load-more-units" data-page="1" data-max="<?php echo $sector_units->max_num_pages; ?>">
                                        <?php _e('عرض المزيد', 'textdomain'); ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <?php 
                        $first_sector = false;
                        endforeach; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php endif; // End if project_sectors check ?>
    </div>
</section>
<?php endif;?>

<!-- Virtual Reality Section -->
<?php if ($virtual_reality_iframe): ?>
<section class="virtual-reality" id="virtual_reality">
    <div class="container">
        <div class="s-content">
            <div class="singl-p-title"> 
                <h4><?php ml_text('[:en]360 virtual reality technology[:ar]تقنية الواقع الافتراضي 360'); ?></h4>
            </div>
            <div class="discoverItem">
                <div class="item-details">
                    <div class="icone"><img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/white-eye.svg" alt=""></div>
                    <div class="item-name">
                        <h6><?php echo $virtual_reality_txt;?></h6>
                    </div>
                </div>
                <div class="img">
                    
                    <?php echo $virtual_reality_iframe;?>

                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Project Location Map -->
<?php if ($map_image): ?>
<section class="project-website">
    <div class="container">
        <div class="s-content">  
            <div class="singl-p-title">
                <h4>  <?php ml_text('[:en]Project location[:ar]موقع المشروع'); ?>  </h4>
            </div>
            <div class="project-website-img">
                <div class="map">
                <?php echo $map_image; ?>
            </div>
                <!--<img src="<?php echo esc_url($map_image); ?>" alt="<?php ml_text('[:en]Project location[:ar]موقع المشروع'); ?>">-->
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Register Interest Section -->
<section class="register-sec" id="register-sec">
    <div class="container">
        <div class="s-content">
            <div class="row">
                <div class="col-lg-6">  
                    <div class="single-p-info"> 
                        <h3><?php ml_text('[:en]Register your interest in residential projects[:ar]سجل اهتمامك مشاريع سكنية'); ?></h3>
                    </div>
                    <?php echo do_shortcode('[contact-form-7 id="a5ba456" title="نموذج سجل اهتمامك (سنجل المشروع)"]');  ?>
                </div>
                <div class="col-lg-6">
                    <div class="register-img">
                        <img src="<?php echo get_theme_option('interest_ima');?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
<script>
jQuery(function ($) {
    $('input[name="your-project-name"]').val('<?php the_title();?>');
});
</script>
