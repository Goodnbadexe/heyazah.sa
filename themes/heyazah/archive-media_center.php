<?php
/**
 * Template Name: Media Center Archive
 * Archive template for displaying all Media Center
 *  
 * @package ELRYAD
 */

get_header();
?>

    <!-- --------------  breadcrumb-section  --------------------- -->

    <div class="breadcrumb-section">
        <div class="breadcrumb-img">
            <img src="<?php if(get_field('breadcrumb_page')): the_field('breadcrumb_page'); else: the_field('g_breadcrumb', 'option'); endif;?>" alt="#" />            
        </div>
        <div class="breadcrumb-info">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <h6>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                        <span>  <?php ml_text('[:en]Media Center[:ar]المركز الاعلامي '); ?></span>
                    </h6>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"> <?php echo esc_html(get_theme_option('media_center_tit')); ?> </li>
                        <li class="breadcrumb-item"> <?php echo esc_html(get_theme_option('media_center_des')); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- -----------------------  page content  ----------------------   -->
    <main class="pages-contant">
        <section class="media-center page-content">
            <div class="container">
                <?php
                $media_terms = get_terms(array(
                    'taxonomy' => 'media_type',
                    'hide_empty' => true,
                ));

                if (!empty($media_terms) && !is_wp_error($media_terms)):
                    $active_term = $media_terms[0];
                ?>
                    <div class="media-center-tabs">
                        <ul class="nav nav-pills nav-product" id="pills-tab" role="tablist">
                            <?php foreach ($media_terms as $index => $term): ?>
                                <?php
                                $is_active = $index === 0 ? 'active' : '';
                                $tab_id = 'media-' . esc_attr($term->slug);
                                
                                // Query to get the actual count of items that will be displayed initially
                                $initial_query = new WP_Query(array(
                                    'post_type' => 'media_center',
                                    'posts_per_page' => 9,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'media_type',
                                            'field'    => 'term_id',
                                            'terms'    => $term->term_id,
                                        ),
                                    ),
                                    'fields' => 'ids', // Only get IDs for performance
                                ));
                                
                                // Initial visible count (will be updated by JS as more items load)
                                $initial_count = $initial_query->post_count;
                                wp_reset_postdata();
                                
                                $icon = $term->slug === 'videos' || $term->slug === 'video' ? 'video-Icon.svg' : 'media-icon.svg';
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo $is_active; ?>" id="<?php echo $tab_id; ?>-tab" data-toggle="pill"
                                        href="#<?php echo $tab_id; ?>" role="tab" aria-controls="<?php echo $tab_id; ?>" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/<?php echo $icon; ?>" alt="">
                                        <span><?php echo esc_html($term->name); ?></span>
                                        <span class="p-num"><?php echo esc_html($initial_count); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <?php foreach ($media_terms as $index => $term): ?>
                                <?php
                                $is_active = $index === 0 ? 'show active' : '';
                                $tab_id = 'media-' . esc_attr($term->slug);
                                $is_video = $term->slug === 'videos' || $term->slug === 'video';
                                ?>
                                <div class="tab-pane fade <?php echo $is_active; ?>" id="<?php echo $tab_id; ?>" role="tabpanel" aria-labelledby="<?php echo $tab_id; ?>-tab">
                                    <div class="all-news">
                                        <div class="row media-items-container" data-term-id="<?php echo $term->term_id; ?>" data-page="1">
                                            <?php
                                            $media_query = new WP_Query(array(
                                                'post_type' => 'media_center',
                                                'posts_per_page' => 3,
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'media_type',
                                                        'field'    => 'term_id',
                                                        'terms'    => $term->term_id,
                                                    ),
                                                ),
                                            ));

                                            if ($media_query->have_posts()):
                                                while ($media_query->have_posts()): $media_query->the_post();
                                                    $media_video_url = get_field('media_video') ?: get_field('video_url');
                                                    $media_link = $media_video_url ?: get_permalink();
                                                    $view_count = get_post_meta(get_the_ID(), 'media_view_count', true);
                                                    $view_count = $view_count ? $view_count : 0;
                                                    
                                                    // Format view count (e.g., 25300 -> 25.3K)
                                                    $formatted_views = $view_count >= 1000 ? number_format($view_count / 1000, 1) . 'K' : $view_count;
                                            ?>
                                                <div class="col-lg-4">
                                                    <div class="project-item">
                                                        <a href="<?php echo esc_url($media_link); ?>" <?php echo $is_video && $media_video_url ? 'data-fancybox="gallery"' : ''; ?>>
                                                            <?php if ($is_video && $media_video_url): ?>
                                                                <div class="video-icone"></div>
                                                            <?php endif; ?>
                                                            <div class="proj-img">
                                                                <?php //if (!empty($term->name)): ?>
                                                                    <div class="prj-status"><span class="award"><?php echo get_field('media_category');//echo esc_html($term->name); ?></span></div>
                                                                <?php //endif; ?>
                                                                <?php if (has_post_thumbnail()): ?>
                                                                    <?php the_post_thumbnail('medium'); ?>
                                                                <?php else: ?>
                                                                    <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/proj1.png" alt="<?php the_title_attribute(); ?>">
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="proj-info">
                                                                <?php if ($is_video && $media_video_url): ?>
                                                                    <!-- Video Layout -->
                                                                    <div class="new-title">
                                                                        <h5><?php the_title(); ?></h5>
                                                                    </div>
                                                                    <ul>
                                                                        <li>
                                                                            <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/calender-i.svg" alt="">
                                                                            <span><?php echo get_localized_date(get_the_date('Y-m-d')); ?></span>
                                                                        </li>
                                                                        <li>
                                                                            <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/eye-vid.svg" alt="">
                                                                            <span><?php echo $formatted_views; ?></span>
                                                                        </li>
                                                                    </ul>
                                                                <?php else: ?>
                                                                    <!-- News Layout -->
                                                                    <ul>
                                                                        <li>
                                                                            <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/calender-i.svg" alt="">
                                                                            <span><?php echo get_localized_date(get_the_date('Y-m-d')); ?></span>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="new-title">
                                                                        <h5><?php the_title(); ?></h5>
                                                                    </div>
                                                                    <div class="read-more">
                                                                        <span><?php echo ml_get('[:en]View Details[:ar]عرض التفاصيل[:]'); ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php
                                                endwhile;
                                                $max_pages = $media_query->max_num_pages;
                                                wp_reset_postdata();
                                            else:
                                                $max_pages = 0;
                                            ?>
                                                <div class="col-12">
                                                    <p><?php ml_text('[:en]No media found in this section[:ar]لا توجد عناصر في هذا القسم'); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($max_pages > 1): ?>
										
										
<!-- 									<div class="read-more"><a href="#">
                                        <span>عرض المزيد</span>
                                        <i class="fal fa-long-arrow-left"></i>
                                    </a></div>				 -->
										
										
                                        <div class="read-more load-more-wrapper text-center mt-4">
                                            <a class="load-more-media" href="javascript:void(0)" 
                                                    data-term-id="<?php echo $term->term_id; ?>" 
                                                    data-page="1"
                                                    data-max-pages="<?php echo $max_pages; ?>">
                                                <span> <?php ml_text('[:en]Load More[:ar]عرض المزيد[:]'); ?> </span>
												<i class="fal fa-long-arrow-left"></i>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p><?php ml_text('[:en]No media categories found[:ar]لا توجد أقسام للمركز الإعلامي'); ?></p>
                <?php endif; ?>
            </div>
        </section>
    </main>


<?php get_footer(); ?>

  