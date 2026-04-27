<?php /* Template Name:    شركاء النجاح  */ ?>

<?php get_header(); ?>

    <!-- -----------------------  page content  ----------------------   -->
    <main class="pages-contant">
        <section class="clients-page page-content">
            <div class="client-page-img"><img src="<?php echo get_theme_option('clients_hero_background'); ?>" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="client-page-hero">
                            <div class="title">
                                <h6>
                                    <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/client-i.svg" alt="">
                                    <span><?php echo get_theme_option('clients_hero_title'); ?></span>
                                </h6>
                            </div>
                            <h2>
                                <span><?php echo get_theme_option('clients_hero_withus'); ?></span>
                                <?php echo get_theme_option('clients_hero_heading'); ?>
                            </h2>
                            <p>
                                <?php echo get_theme_option('clients_hero_description'); ?>
                            </p>
                            <div class="row">
                                <?php 
                                $stats = get_field('clients_page_achive', 'option');
                                if ($stats): 
                                    foreach ($stats as $stat): 
                                ?>
                                    <div class="col-lg-4">
                                        <div class="cli-item-num">
                                            <h3 class="counter-item">
                                                <span class="plus"><?php echo esc_html($stat['prefix']); ?></span>
                                                <span class="odometer" data-odometer-final="<?php echo esc_attr($stat['num']); ?>"></span>
                                            </h3>
                                            <h6><?php echo esc_html($stat['txt']); ?></h6>
                                        </div>
                                    </div>
                                <?php 
                                    endforeach;
                                endif; 
                                ?>
                            </div>
                            <div class="read-more">
                                <a href="<?php echo esc_url(get_theme_option('clients_cta_link')); ?>">
                                    <span><?php echo get_theme_option('clients_cta_text'); ?></span>
                                    <i class="fal fa-long-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- -------------------------------------   -->
        <section class="Partners-of-excellence">
            <div class="container">
                <div class="section-title">
                    <h6>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                        <span><?php echo get_theme_option('clients_section_title'); ?></span>
                    </h6>
                    <h4>
                        <?php echo get_theme_option('clients_section_heading'); ?>
                    </h4>
                    <p>
                        <?php echo get_theme_option('clients_section_des'); ?>
                    </p>
                </div>
                <div class="row">
                    <?php 
                    $partners = get_field('clients_page_rep', 'option');
                    if ($partners): 
                        foreach ($partners as $partner): 
                    ?>
                        <div class="col-lg-4">
                            <div class="client-Item">
                                <div class="img"> 
                                    <img src="<?php echo esc_url($partner['ima']); ?>" alt="">
                                    <span class="name"><?php echo esc_html($partner['type']); ?></span>
                                </div>
                                <div class="client-item-details">
                                    <div class="c-logo"><img src="<?php echo esc_url($partner['part_logo']); ?>" alt=""></div>
                                    <div class="c-name">
                                        <h4><?php echo esc_html($partner['part_name']); ?></h4>
                                        <h6><?php echo esc_html($partner['part_des']); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </div>

                <!-- <div class="read-more">
                    <a href="#">
                        <span><?php echo  ml_get('[:en]View More[:ar]عرض المزيد'); ?></span>
                        <i class="fal fa-long-arrow-left"></i>
                    </a>
                </div> -->


            </div>
        </section>
    </main>

<?php get_footer(); ?>