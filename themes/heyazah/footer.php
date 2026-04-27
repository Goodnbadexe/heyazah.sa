    <!-- Start footer section -->
    <footer>
        <div id="circularMenu" class="circular-menu">
            <a class="floating-btn" onclick="document.getElementById('circularMenu').classList.toggle('active');">
                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/headset-.png" alt="headset" />
            </a>
            <menu class="items-wrapper">
                <?php
                $footer_email = get_theme_option('email_rep', '');
                $footer_phone = get_theme_option('phone_number', '');
                $footer_whatsapp = get_theme_option('whatsapp_number', '');
                
                if ($footer_email && !empty($footer_email[0]['email'])):
                ?>
                    <a rel="nofollow" href="mailto:<?php echo esc_attr($footer_email[0]['email']); ?>" class="menu-item">
                        <img width="23" src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/envelope.svg" alt="email" />
                    </a>
                <?php endif; ?>
                
                <?php if ($footer_phone && !empty($footer_phone[0]['phone'])): ?>
                    <a rel="nofollow" href="tel:<?php echo esc_attr($footer_phone[0]['phone']); ?>" class="menu-item">
                        <img width="23" src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/phone1.svg" alt="phone1" />
                    </a>
                <?php endif; ?>
                
                <a rel="nofollow" href="https://wa.me/<?php echo esc_attr($footer_whatsapp); ?>" class="menu-item">
                    <img width="23" src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/whats.svg" alt="whats">
                </a>
            </menu>
        </div>
         <button onclick="topFunction()" id="mybtn"><i class="fas fa-long-arrow-up"></i></button> 
        <div class="container">
            <div class="footer ">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="right-footer">
                            <div class="footer-logo">
                                <a href="<?php echo home_url('/'); ?>">
                                    <?php 
                                    $footer_logo = get_theme_option('logo_f');
                                    if ($footer_logo): 
                                    ?>
                                        <img src="<?php echo esc_url($footer_logo); ?>" alt="<?php bloginfo('name'); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/footer-logo.svg" alt="<?php bloginfo('name'); ?>">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="footer-badges">
                                <div class="cert-f">
                                    <img src="<?php echo get_theme_option('footer_certif_ima');?>" alt="#" />
                                </div>
                                <?php 
                                $footer_badge = get_theme_option('footer_badge_image');
                                if ($footer_badge): 
                                ?>
                                    <div class="arabian"><img src="<?php echo esc_url($footer_badge); ?>" alt=""></div>
                                <?php endif; ?>
                            </div>
                            <div class="other-logo">
                                <img src="<?php echo get_theme_option('footer_uniqe_ima');?>" alt="#" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="footer-contacts">
                            <div class="footer-form">
                                <h3><?php echo  ml_get('[:en]Subscribe to Newsletter[:ar]اشترك في النشرة البريدية'); ?></h3>
                                <?php echo do_shortcode('[contact-form-7 id="2c0ec6f" title="القائمة البريدية"]'); ?>
                            </div>
                            <div class="footer-info">
                                <div class="footer-contact">
                                    <h4><?php echo ml_get('[:en]Contact Us[:ar]تواصل معنا'); ?></h4>
                                    <ul class="contact-list">
                                        <?php 
                                        $phones = get_theme_option('phone_number');
                                        $whatsapp_no = get_theme_option('whatsapp_number');
                                        if ($phones && !empty($phones[0]['phone'])): 
                                        ?>
                                        <li>
                                            <a href="tel:<?php echo esc_attr($phones[0]['phone']); ?>">
                                                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/phone.svg" alt="">
                                                <span class="mob-num"><?php echo esc_html($phones[0]['phone']); ?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp_no; ?>" target="_blank">
                                                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/whatsapp.svg" alt="">
                                                <span class="mob-num"><?php echo $whatsapp_no; ?></span>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        
                                        <?php $emails = get_theme_option('email_rep'); ?>
                                        <li>
                                            <a href="mailto:<?php echo esc_attr($emails[0]['email']); ?>" target="_blank">
                                                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/mail-02.svg" alt="">
                                                <span><?php echo esc_html($emails[0]['email']); ?></span>
                                            </a>
                                        </li>
                                       
                                        <?php 
                                        $maps_link = get_theme_option('map_link');
                                        $address_short = get_theme_option('address');
                                        ?>
                                        <li>
                                            <a href="<?php echo esc_url($maps_link); ?>" target="_blank">
                                                <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/white-map.svg" alt="">
                                                <span>
                                                    <?php echo $address_short; ?>
                                                    <span class="data"><?php ml_text('[:en]Directions[:ar]الاتجاهات'); ?></span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="footer-soch">
                                    <span><?php echo ml_get('[:en]Follow Us[:ar]تابعنا على'); ?></span>
                                    <div class="footer-soch-icons">
                                        <?php 
                                        $social_links = get_field('social_media', 'option');
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
                                    <div class="work-time">
                                        <span>
                                            <?php echo ml_get('[:en]Working Hours:[:ar]اوقات العمل:');  echo get_theme_option('work_times'); ?>
                                        </span>
                                        <span class="time"><?php echo get_theme_option('work_time_txt'); ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="bootom-footer">
                <div class="copy-right text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 ">
                                <p>
                                   <?php echo get_theme_option('copy_rights'); ?>
                                </p>
                            </div>
                           <!-- <div class="col-sm-6">
                                <div class="comp-rights">
                                    <div class="ryad-logo" style="display: inline-block;">
                                        <a target="_balnk" href="https://elryad.com/ar/" title="Web Design"
                                            style="color:#000">
                                            <svg height="90" width="102"
                                                style=" transform: rotateY(180deg) scale(.35);float: left;width: 77px;">
                                                <line x1="0" y1="0" x2="90" y2="0" style="stroke:#f00;stroke-width:35">
                                                </line>
                                                <line x1="100" y1="0" x2="0" y2="10"
                                                    style="stroke:#f00;stroke-width:20; transform:rotate(40deg)"></line>
                                                <line x1="10" y1="95" x2="50" y2="45"
                                                    style="stroke:#f00;stroke-width:20;">
                                                </line>
                                            </svg>
                                        </a>
                                        <div class="lolo-co"
                                            style="float: right;text-align: left;padding-top: 30px;position: relative;left: -15px;">
                                            <a target="_balnk" href="https://elryad.com/ar/" title="Web Design"
                                                style="color:#fff;text-decoration: none;">
                                                <p
                                                    style="text-transform: uppercase;font-size: 20px;line-height: 0.7;margin: 0;font-weight: 700;">
                                                    elryad</p>
                                            </a>
                                            <span style="font-size: 12px; color:#fff;">
                                                <a target="_balnk" href="https://elryad.com/ar/" title="تصميم مواقع"
                                                    alt="تصميم مواقع"
                                                    style="font-size: 12px;  color:inherit;text-decoration: none;">تصميم
                                                    مواقع
                                                </a> /
                                                <a target="_balnk" href="https://elryad.com/ar/saudi-hosting/"
                                                    title="استضافة مواقع " alt="استضافة مواقع"
                                                    style="font-size: 12px; color:inherit;text-decoration: none;">استضافة
                                                    مواقع </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
    </footer>

    </div> <!-- /.h-page-push-wrapper -->
<!-- WordPress Footer -->
<?php wp_footer(); ?>


</body>

</html>
