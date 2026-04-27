<?php /* Template Name:   من نحن */ ?>

<?php get_header(); ?>

    <!-- --------------  breadcrumb-section  --------------------- -->

    <div class="breadcrumb-section about_Page">
        <div class="breadcrumb-img">
            <img src="<?php if(get_field('breadcrumb_page')): the_field('breadcrumb_page'); else: the_field('g_breadcrumb', 'option'); endif;?>" alt="#" />            
        </div>
        <div class="breadcrumb-info">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <h6>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                        <span><?php echo get_theme_option('about_breadcrumb_title'); ?></span>
                    </h6>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><?php echo get_theme_option('about_breadcrumb_subtitle'); ?></li>
                        <li class="breadcrumb-item"><?php echo get_theme_option('about_breadcrumb_description'); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- -----------------------  page content  ----------------------   -->
    <main class="pages-contant">
        <section class="about-page page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-page-info">
                            <h2><?php echo get_theme_option('about_main_heading'); ?>
                                <span><?php echo get_theme_option('about_main_heading_highlight'); ?></span>
                                <?php echo get_theme_option('about_main_heading_suffix'); ?>
                            </h2>
                            <?php echo wpautop(get_theme_option('about_main_description')); ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-page-img">
                            <img src="<?php echo get_theme_option('about_main_image'); ?>" alt="">
                            <div class="about-logo">
                                <img src="<?php echo get_theme_option('about_logo_image'); ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="manger-h">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="manger-img">
                            <img src="<?php echo get_theme_option('presdent_ima'); ?>" alt="#" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="manger-text about-page-info">
                            <h2>
                                <?php ml_text('[:en]president[:ar]رئيس');?>
                                <span>
                                    <?php ml_text('[:en]council[:ar]مجلس');?>
                                </span>
                                <?php ml_text('[:en]Administration[:ar]الادارة');?>
                            </h2>
                            <h4>
                                <?php echo get_theme_option('presdent_name'); ?>
                            </h4>
                            <p>
                                <?php echo get_theme_option('presdent_word'); ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="manger-img">
                            <img src="<?php echo get_theme_option('message_ima'); ?>" alt="#" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="manger-text about-page-info">
                            <h2>
                                <?php ml_text('[:en]Message[:ar]رسالة');?>
                                
                                <span>
                                    <?php ml_text('[:en]President[:ar]الرئيس');?>
                                </span>
								
                                <?php ml_text('[:en]Executive[:ar]التنفيذي');?>
                                
                            </h2>
                            <h4>
                                <!--يوضع هنا اسم الرئيس التنفيذي-هدير-->
                                <?php echo get_theme_option('message_tit'); ?>
                            </h4>
                            <p> <?php echo get_theme_option('message_des'); ?> </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        

        
        <section class="awards-h">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h4>
                                <?php ml_text('[:en]Awards[:ar]الجوائز');?>
                            </h4>
                        </div>
                        
                        <div class="all-awards">
                            <div class="awards-slider owl-carousel owl-theme">
                                <?php if( have_rows('rewards_rep', 'option') ): while( have_rows('rewards_rep', 'option') ) : the_row(); ?>
                                    <div class="item">
                                    <div class="awards-block position-relative">
                                        <a href="<?php the_sub_field('ima', 'option'); ?>" class="link-block" data-fancybox="gallary2"></a>
                                        <div class="img" data-fancybox="gallary2">
                                            <img src="<?php the_sub_field('ima', 'option'); ?>" alt="#" />
                                        </div>
                                        <div class="details">
                                            <h3>
                                                <?php the_sub_field('txt', 'option'); ?>  
                                            </h3>
                                            <div class="date-h">
                                                <div class="icon">
                                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_2031_2315)">
                                                            <path d="M11.6326 1.22449H11.0204V0.612244C11.0204 0.449867 10.9559 0.29414 10.8411 0.179322C10.7262 0.0645041 10.5705 0 10.4081 0C10.2458 0 10.09 0.0645041 9.97522 0.179322C9.8604 0.29414 9.7959 0.449867 9.7959 0.612244V1.22449H4.89795V0.612244C4.89795 0.449867 4.83345 0.29414 4.71863 0.179322C4.60381 0.0645041 4.44808 0 4.28571 0C4.12333 0 3.9676 0.0645041 3.85278 0.179322C3.73797 0.29414 3.67346 0.449867 3.67346 0.612244V1.22449H3.06122C2.24963 1.22546 1.47156 1.54829 0.897684 2.12217C0.323805 2.69605 0.000972156 3.47412 0 4.28571L0 11.6326C0.000972156 12.4442 0.323805 13.2223 0.897684 13.7962C1.47156 14.37 2.24963 14.6929 3.06122 14.6938H11.6326C12.4442 14.6929 13.2223 14.37 13.7962 13.7962C14.37 13.2223 14.6929 12.4442 14.6938 11.6326V4.28571C14.6929 3.47412 14.37 2.69605 13.7962 2.12217C13.2223 1.54829 12.4442 1.22546 11.6326 1.22449ZM1.22449 4.28571C1.22449 3.79857 1.418 3.33139 1.76245 2.98694C2.10691 2.64249 2.57409 2.44897 3.06122 2.44897H11.6326C12.1198 2.44897 12.5869 2.64249 12.9314 2.98694C13.2758 3.33139 13.4694 3.79857 13.4694 4.28571V4.89795H1.22449V4.28571ZM11.6326 13.4694H3.06122C2.57409 13.4694 2.10691 13.2758 1.76245 12.9314C1.418 12.5869 1.22449 12.1198 1.22449 11.6326V6.12244H13.4694V11.6326C13.4694 12.1198 13.2758 12.5869 12.9314 12.9314C12.5869 13.2758 12.1198 13.4694 11.6326 13.4694Z" fill="#B5A491"/>
                                                            <path d="M7.3461 10.1019C7.8533 10.1019 8.26447 9.6907 8.26447 9.1835C8.26447 8.6763 7.8533 8.26514 7.3461 8.26514C6.8389 8.26514 6.42773 8.6763 6.42773 9.1835C6.42773 9.6907 6.8389 10.1019 7.3461 10.1019Z" fill="#B5A491"/>
                                                            <path d="M4.28555 10.1019C4.79275 10.1019 5.20392 9.6907 5.20392 9.1835C5.20392 8.6763 4.79275 8.26514 4.28555 8.26514C3.77835 8.26514 3.36719 8.6763 3.36719 9.1835C3.36719 9.6907 3.77835 10.1019 4.28555 10.1019Z" fill="#B5A491"/>
                                                            <path d="M10.4086 10.1019C10.9158 10.1019 11.327 9.6907 11.327 9.1835C11.327 8.6763 10.9158 8.26514 10.4086 8.26514C9.9014 8.26514 9.49023 8.6763 9.49023 9.1835C9.49023 9.6907 9.9014 10.1019 10.4086 10.1019Z" fill="#B5A491"/>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_2031_2315">
                                                                <rect width="14.6938" height="14.6938" fill="white"/>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </div>
                                                <span>
                                                    <?php the_sub_field('year', 'option'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; endif;?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        <section class="members-h">
            <div class="container">
                <div class="col-md-12">
                    <div class="section-title text-start">
                        <h4>
                            <?php ml_text('[:en]Board members[:ar]اعضاء مجلس الادارة');?>
                        </h4>
                    </div>
                    
                    <div class="all-members row">
                        
                       <?php if( have_rows('member_rep', 'option') ): while( have_rows('member_rep', 'option') ) : the_row(); ?>
                        <div class="col-md-4">
                            <div class="member-block">
                                <div class="img">
                                    <img src="<?php the_sub_field('ima', 'option'); ?>" alt="#" />
                                </div>
                                <div class="details">
                                    <h3>
                                        <?php the_sub_field('name', 'option'); ?>
                                    </h3>
                                    <span>
                                        <i class="fal fa-angle-left"></i>
                                        <u>
                                            <?php the_sub_field('job_title', 'option'); ?>
                                        </u>
                                    </span>
                                </div>
                            </div>
                        </div>
                      <?php endwhile; endif;?> 

                    </div>
                </div>
            </div>
        </section>
        
        
        
        
        
        
        
        
        
        
        
        
        <!-- ------------------------------   
        <section class="vission">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="vission-item">
                            <div class="img"><img src="<?php echo get_theme_option('about_vision_icon'); ?>" alt=""></div>
                            <h3><?php echo get_theme_option('about_vision_title'); ?></h3>
                            <p>
                                <?php echo get_theme_option('about_vision_description'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="vission-item">
                            <div class="img"><img src="<?php echo get_theme_option('about_mission_icon'); ?>" alt=""></div>
                            <h3><?php echo get_theme_option('about_mission_title'); ?></h3>
                            <p>
                                <?php echo get_theme_option('about_mission_description'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="our-goals">
            <div class="container">
                <div class="section-title">
                    <h6>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                        <span><?php echo get_theme_option('about_goals_section_title'); ?></span>
                    </h6>
                    <h4>
                        <?php echo get_theme_option('about_goals_section_heading'); ?>
                    </h4>
                    <p>
                        <?php echo get_theme_option('about_goals_section_description'); ?>
                    </p>
                </div>
                <div class="row">
                    <?php 
                    $goals = get_field('about_goals', 'option');
                    if ($goals): 
                        foreach ($goals as $goal): 
                    ?>
                        <div class="col-lg-3">
                            <div class="goal-item">
                                <div class="g-icone">
                                    <img src="<?php echo esc_url($goal['goal_icon']); ?>" alt="">
                                </div>
                                <h6><?php echo esc_html($goal['goal_title']); ?></h6>
                                <p>
                                    <?php echo esc_html($goal['goal_description']); ?>
                                </p>
                            </div>
                        </div>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </div>
            </div>
        </section>
        <!-- ---------------- ما نقدمه لك-----------------------  
        <section class="What-we-offer-you">
            <div class="container">
                <div class="section-title">
                    <h6>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                        <span><?php echo get_theme_option('about_services_section_title'); ?></span>
                    </h6>
                    <h4>
                        <?php echo get_theme_option('about_services_section_heading'); ?>
                    </h4>
                    <p>
                        <?php echo get_theme_option('about_services_section_description'); ?>
                    </p>
                </div>
                <div class="row">
                    <?php 
                    $services = get_field('about_services', 'option');
                    if ($services): 
                        foreach ($services as $service): 
                    ?>
                        <div class="col-lg-3">
                            <div class="offer-you-item">
                                <div class="item-number"><span><?php echo esc_html($service['service_number']); ?></span></div>
                                <div class="item-img">
                                    <img src="<?php echo esc_url($service['service_image']); ?>" alt="">
                                    <div class="item-icone"><img src="<?php echo esc_url($service['service_icon']); ?>" alt=""></div>
                                </div>
                                <div class="item-details">
                                    <h4><?php echo esc_html($service['service_title']); ?></h4>
                                    <p>
                                        <?php echo esc_html($service['service_description']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </div>
            </div>
        </section>
        
        <section class="contact-us-now">
            <div class="container">
                <div class="contact-now">
                    <h4><?php echo get_theme_option('about_cta_heading'); ?></h4>
                    <p>
                        <?php echo get_theme_option('about_cta_description'); ?>
                    </p>
                    <div class="read-more"><a href="<?php echo esc_url(get_theme_option('about_cta_button_link')); ?>"><?php echo get_theme_option('about_cta_button_text'); ?></a></div>
                </div>
            </div>
        </section> -->
    </main>
    
<?php get_footer(); ?>