<?php /* Template Name: اتصل بنا */ ?>
<?php get_header(); ?>

<style>
    /*.wpcf7-form * {direction: ltr;}*/
</style>

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
                        <span><?php echo get_theme_option('contact_breadcrumb_title'); ?></span>
                    </h6>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><?php echo get_theme_option('contact_breadcrumb_subtitle'); ?></li>
                        <li class="breadcrumb-item"><?php echo get_theme_option('contact_breadcrumb_description'); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- -----------------------  page content  ----------------------   -->
    <main class="pages-contant">
        <section class="contact-page page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-form">
                            <h4><?php echo get_theme_option('contact_form_title'); ?></h4>
                            <h6><?php echo get_theme_option('contact_form_subtitle'); ?></h6>
                            <?php 
                            $form_shortcode = get_field('contact_form_shortcode', 'option');
                            if ($form_shortcode) {
                                echo do_shortcode($form_shortcode);
                            } else {
                                echo '<p>'; ml_text('[:en]Please add Contact Form 7 shortcode in page settings[:ar]يرجى إضافة شورت كود Contact Form 7 في إعدادات الصفحة'); echo '</p>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-img">
                            <img src="<?php echo get_theme_option('contact_image'); ?>" alt="">
                            <div class="con-info">
                                <h5><?php echo get_theme_option('contact_support_title'); ?></h5>
                                <h6><?php echo get_theme_option('contact_support_subtitle'); ?></h6>
                            </div>
                        </div>
                        <div class="department">
                            <h4><?php echo get_theme_option('contact_departments_title'); ?></h4>
                            <ul>
                                <?php 
                                $departments = get_field('contact_departments', 'option');
                                if ($departments): 
                                    foreach ($departments as $dept): 
                                ?>
                                    <li>
                                        <div class="img"><img src="<?php echo esc_url($dept['dept_icon']); ?>" alt=""></div>
                                        <div class="department-details">
                                            <h6><?php echo esc_html($dept['dept_name']); ?></h6>
                                            <?php if (!empty($dept['dept_phone'])): ?>
                                            <a href="tel:<?php echo esc_attr($dept['dept_phone']); ?>">
                                                <i class="fal fa-phone-alt"></i>
                                                <span class="mob-num"><?php echo esc_html($dept['dept_phone']); ?></span>
                                            </a>
                                            <?php endif; ?>
                                            <?php if (!empty($dept['dept_email'])): ?>
                                            <a href="mailto:<?php echo esc_attr($dept['dept_email']); ?>">
                                                <i class="fal fa-envelope"></i>
                                                <span><?php echo esc_html($dept['dept_email']); ?></span>
                                            </a>
                                            <?php endif; ?>
                                           
                                            
                                            <a href="https://wa.me/<?php echo esc_html($dept['dept_whatsapp']); ?>" target="_blank">
                                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.09961 16.1992C12.5729 16.1992 16.1992 12.5729 16.1992 8.09961C16.1992 3.62632 12.5729 0 8.09961 0C3.62632 7.62939e-06 0 3.62632 0 8.09961C2.1524e-07 9.21539 0.225608 10.2803 0.634766 11.249C0.74205 11.503 0.814965 11.6747 0.863281 11.8066C0.912034 11.9398 0.918944 11.9888 0.919922 12.002C0.924818 12.0727 0.90733 12.1694 0.785156 12.626L0.0195313 15.4883C-0.0325775 15.6832 0.0223685 15.8915 0.165039 16.0342C0.307712 16.1769 0.516018 16.2318 0.710938 16.1797L3.57324 15.4141C4.02986 15.2919 4.12651 15.2744 4.19727 15.2793C4.21037 15.2803 4.2594 15.2872 4.39258 15.3359C4.5245 15.3843 4.69618 15.4572 4.9502 15.5645C5.91896 15.9736 6.98383 16.1992 8.09961 16.1992ZM8.09961 15.0693C7.13774 15.0693 6.22264 14.8748 5.39062 14.5234L5.37695 14.5176C5.13939 14.4172 4.94213 14.3333 4.78125 14.2744C4.62023 14.2155 4.45063 14.1636 4.27539 14.1514C3.99042 14.1316 3.69412 14.2114 3.35449 14.3027C3.33032 14.3092 3.30588 14.3157 3.28125 14.3223L1.36328 14.8359L1.87695 12.918C1.88354 12.8933 1.88998 12.8689 1.89648 12.8447C1.98784 12.5051 2.06757 12.2088 2.04785 11.9238C2.03566 11.7486 1.98376 11.579 1.9248 11.418C1.86588 11.2571 1.78198 11.0598 1.68164 10.8223L1.67578 10.8086C1.32445 9.97658 1.12988 9.06148 1.12988 8.09961C1.12988 4.2505 4.2505 1.12989 8.09961 1.12988C11.9487 1.12988 15.0693 4.2505 15.0693 8.09961C15.0693 11.9487 11.9487 15.0693 8.09961 15.0693ZM10.2207 12.3457C10.5066 12.4106 10.7739 12.4719 11.125 12.3984C11.3812 12.3448 11.6201 12.209 11.8047 12.0615C11.9893 11.9139 12.1744 11.7109 12.2832 11.4727C12.4329 11.1448 12.4323 10.8115 12.4316 10.4502C12.4316 10.427 12.4316 10.4033 12.4316 10.3799C12.4316 10.2138 12.426 9.93405 12.3184 9.67578C12.1896 9.36728 11.925 9.11297 11.5098 9.04785L11.5049 9.04688C10.9903 8.96623 10.599 8.90547 10.3223 8.86523C10.1837 8.84509 10.0685 8.82858 9.97852 8.81836C9.9046 8.80996 9.80286 8.79973 9.71777 8.80469C9.34891 8.82627 9.05536 8.97612 8.82812 9.13184C8.68367 9.23083 8.52682 9.36347 8.40332 9.46777C8.35479 9.50876 8.31077 9.54573 8.27539 9.57422L7.76172 9.9873C7.47388 9.77199 7.19611 9.53204 6.93164 9.26758C6.66706 9.003 6.42632 8.72547 6.21094 8.4375L6.625 7.92383C6.65349 7.88844 6.69045 7.84443 6.73145 7.7959C6.83574 7.67241 6.96838 7.51554 7.06738 7.37109C7.2231 7.14387 7.37294 6.85029 7.39453 6.48145C7.39951 6.39636 7.38828 6.29465 7.37988 6.2207C7.36966 6.13073 7.35413 6.01552 7.33398 5.87695C7.29373 5.60008 7.23305 5.20831 7.15234 4.69336L7.15137 4.68945C7.08625 4.27397 6.8312 4.00854 6.52246 3.87988C6.26417 3.7724 5.98428 3.76758 5.81836 3.76758C5.79513 3.76758 5.77202 3.76762 5.74902 3.76758C5.38767 3.76697 5.0544 3.76632 4.72656 3.91602C4.48835 4.02482 4.28529 4.2099 4.1377 4.39453C3.99025 4.57905 3.85447 4.81716 3.80078 5.07324C3.72721 5.42461 3.78764 5.69252 3.85254 5.97852C3.8555 5.99156 3.85934 6.00445 3.8623 6.01758C4.18969 7.46744 4.95433 8.88988 6.13184 10.0674C7.30932 11.2448 8.73181 12.0095 10.1816 12.3369C10.1947 12.3399 10.2077 12.3428 10.2207 12.3457ZM5.5752 7.42578C5.29472 6.88675 5.09017 6.32792 4.96387 5.76855C4.88923 5.43799 4.88816 5.39689 4.90723 5.30566C4.9143 5.27189 4.94712 5.19141 5.02051 5.09961C5.09386 5.00788 5.16492 4.95866 5.19629 4.94434C5.27392 4.90891 5.34838 4.89747 5.81836 4.89746C5.89236 4.89746 5.95328 4.90026 6.00391 4.90625C6.01867 4.908 6.03136 4.9092 6.04199 4.91113C6.11978 5.40753 6.17778 5.77837 6.21582 6.04004C6.23539 6.1747 6.24864 6.27559 6.25684 6.34766C6.26242 6.39683 6.26408 6.42109 6.26465 6.42773C6.25698 6.5127 6.22149 6.60587 6.13477 6.73242C6.06734 6.83076 6.00054 6.9087 5.91797 7.00586C5.8675 7.06524 5.81161 7.13226 5.74512 7.21484L5.5752 7.42578ZM10.8936 11.292C10.8022 11.3111 10.7608 11.3091 10.4297 11.2344C9.87049 11.1081 9.31232 10.9044 8.77344 10.624L8.98438 10.4541C9.067 10.3876 9.13395 10.3308 9.19336 10.2803C9.29035 10.1978 9.36858 10.1318 9.4668 10.0645C9.59314 9.97787 9.68566 9.94134 9.77051 9.93359C9.77658 9.93413 9.80069 9.93574 9.85059 9.94141C9.92272 9.9496 10.0241 9.96376 10.1592 9.9834C10.4208 10.0214 10.7909 10.0795 11.2871 10.1572C11.2891 10.1679 11.2912 10.1805 11.293 10.1953C11.2989 10.2459 11.3018 10.306 11.3018 10.3799C11.3018 10.8504 11.2904 10.9252 11.2549 11.0029C11.2406 11.0343 11.1913 11.1054 11.0996 11.1787C11.0078 11.2521 10.9273 11.2849 10.8936 11.292Z" fill="#4C4C4C"/>
                                                </svg>
                                                <span>
                                                    <u>
                                                        <?php echo esc_html($dept['dept_whatsapp']); ?>
                                                    </u>
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                <?php 
                                    endforeach;
                                endif; 
                                ?>
                            </ul>
                        </div>
                        <div class="foolw-us-on-soch">
                            <h5><?php echo ml_get('[:en]Follow us on social media[:ar]تابعنا على السوشيال ميديا'); ?></h5>
                            <h6><?php echo ml_get('[:en]Stay updated with the latest news and offers[:ar]كن على اطلاع دائم بآخر الأخبار والعروض'); ?></h6>
                            <div class="soch">
                                        <?php 
                                        $social_links = get_field('social_media_2', 'option');
                                        if ($social_links):
                                            foreach ($social_links as $social):
                                        ?>
                                            <a href="<?php echo esc_url($social['link']); ?>" target="_blank">
                                                <?php if($social['icon_ima']): ?>
                                                 <img src="<?php echo esc_url($social['icon_ima']); ?>" alt="">
                                                 <?php else: ?>
                                                    <?php echo esc_url($social['icon']); ?>
                                                <?php endif;?>
                                            </a>
                                        <?php  endforeach;endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ------------------------------   -->
        <section class="our-location-on-map">
            <div class="container">
                <div class="section-title">
                    <h3>
                        <?php echo get_theme_option('contact_map_title'); ?> <span><?php echo get_theme_option('contact_map_title_highlight'); ?></span>
                    </h3>
                    <h5><?php echo get_theme_option('contact_map_subtitle'); ?></h5>
                </div>
                <div class="conatct-map-img">
                    <img src="<?php echo get_theme_option('contact_map_image'); ?>" alt="">
                    <div class="img-details">
                        <div class="icon"><i class="fal fa-map-marker-alt"></i></div>
                        <div class="info">
                            <h6><?php echo get_theme_option('name_headquarter'); ?></h6>
                            <p>
                                <?php echo get_theme_option('name_headquarter_address'); ?>
                            </p>
                            <a href="<?php echo esc_url(get_theme_option('contact_google_maps_link')); ?>" target="_blank">
                                <span><?php ml_text('[:en]Open in Google Maps[:ar]فتح في خرائط جوجل'); ?></span>
                                <i class="fal fa-map-marker-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="contact-items">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="contact-Item">
                                <a href="<?php echo get_theme_option('map_link'); ?>">
                                    <div class="icone"><i class="fal fa-map-marker-alt"></i></div>
                                    <h5><?php ml_text('[:en]Address[:ar]العنوان'); ?></h5>
                                    <h6><?php echo nl2br(get_theme_option('address', )); ?></h6>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="contact-Item">
                                <?php 
                                $phones = get_field('phone_number', 'option');
                                $first_phone = !empty($phones) ? $phones[0]['phone'] : '';
                                ?>
                                <a href="tel:<?php echo esc_attr($first_phone); ?>">
                                    <div class="icone"><i class="fal fa-phone-alt"></i></div>
                                    <h5><?php ml_text('[:en]Phone[:ar]الهاتف'); ?></h5>
                                    <?php 
                                    if ($phones): 
                                        foreach ($phones as $phone): 
                                    ?>
                                        <span class="mob-num"><?php echo esc_html($phone['phone']); ?></span>
                                    <?php 
                                        endforeach;
                                    endif; 
                                    ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="contact-Item">
                                <?php 
                                $emails = get_field('email_rep', 'option');
                                $first_email = !empty($emails) ? $emails[0]['email'] : '';
                                ?>
                                <a href="mailto:<?php echo esc_attr($first_email); ?>">
                                    <div class="icone"><i class="fal fa-envelope"></i></div>
                                    <h5><?php ml_text('[:en]Email[:ar]البريد الإلكتروني'); ?></h5>
                                    <?php 
                                    if ($emails): 
                                        foreach ($emails as $email): 
                                    ?>
                                        <span><?php echo esc_html($email['email']); ?></span>
                                    <?php 
                                        endforeach;
                                    endif; 
                                    ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ------------------------------   -->
    </main>
  
<?php get_footer(); ?>
