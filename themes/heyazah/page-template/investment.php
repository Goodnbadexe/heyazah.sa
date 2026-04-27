<?php /* Template Name:   ايجار - شراء - استثمار  */ ?>

<?php get_header(); ?>

    <!-- --------------  breadcrumb-section  --------------------- -->

    <div class="breadcrumb-section invest_Page">
        <div class="breadcrumb-info">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <h6>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                        <span><?php echo get_theme_option('investment_breadcrumb_title'); ?></span>
                    </h6>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><?php echo get_theme_option('investment_breadcrumb_subtitle'); ?></li>
                        <li class="breadcrumb-item"><?php echo get_theme_option('investment_breadcrumb_description'); ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- -----------------------  page content  ----------------------   -->
    <main class="pages-contant">
        <section class="media-center contact-page invest-page page-content">
            <div class="container">
                <div class="media-center-tabs">
                    <ul class="nav nav-pills nav-product" id="pills-tab" role="tablist">
                        <?php 
                        // Get active tab from URL parameter (rent, buy, investment)
                        $active_tab = get_active_tab('rent');
                        
                        $tabs = get_field('tabs_rep', 'option');
                        if ($tabs): 
                            foreach ($tabs as $index => $tab): 
                                $tab_id = !empty($tab['tab_slug']) ? sanitize_title($tab['tab_slug']) : 'tab-' . $index;
                                
                                // Check if this tab matches the URL parameter
                                $is_active = ($tab_id === $active_tab);
                                $active = $is_active ? 'active' : '';
                                $selected = $is_active ? 'true' : 'false';
                        ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $active; ?>" id="pills-<?php echo $tab_id; ?>-tab" data-toggle="pill" href="#pills-<?php echo $tab_id; ?>"
                                    role="tab" aria-controls="pills-<?php echo $tab_id; ?>" aria-selected="<?php echo $selected; ?>">
                                    <img src="<?php echo esc_url($tab['tab_icon']); ?>" alt="">
                                    <span><?php echo esc_html($tab['tab_name']); ?></span>
                                </a>
                            </li>
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <?php 
                        // Get active tab from URL parameter
                        $active_tab = get_active_tab('rent');
                        
                        $tabs = get_field('tabs_rep', 'option');
                        
                        if ($tabs): 
                            foreach ($tabs as $index => $tab): 
                                $tab_id = !empty($tab['tab_slug']) ? sanitize_title($tab['tab_slug']) : 'tab-' . $index;
                                $form_shortcode = $tab['investment_form_shortcode'];
                                
                                // Check if this tab matches the URL parameter
                                $is_active = ($tab_id === $active_tab);
                                $active = $is_active ? 'show active' : '';
                        ?>
                            <div class="tab-pane fade <?php echo $active; ?>" id="pills-<?php echo $tab_id; ?>" role="tabpanel"
                                aria-labelledby="pills-<?php echo $tab_id; ?>-tab">
                                <div class="tab-content">
                                    <div class="contact-form">
                                        <?php 
                                        if ($form_shortcode) {
                                            echo do_shortcode($form_shortcode);
                                        } else {
                                            echo '<p>'; ml_text('[:en]Please add Contact Form 7 shortcode in page settings[:ar]يرجى إضافة شورت كود Contact Form 7 في إعدادات الصفحة'); echo '</p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>


