<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Dynamic Title & Meta -->
    <title>
        <?php if(is_home() && is_front_page()){ ?>
          <?php bloginfo('name');?>
          <?php } else{?>
          <?php  bloginfo('name');?> - <?php wp_title();?>
          <?php }?>
    </title>
    <!-- WordPress Head -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php get_template_part('template-parts/site', 'entrance'); ?>

<?php //echo ( !is_front_page() && !is_home() ) ? 'pages' : ''; ?>


    <!-- Start Form Search -->
    <div class="site-search">
        <div class="site-search-close"></div>
        <div class="close-side site-search-close"> <i class="fal fa-times"></i></div>
        <div class="site-search-inner">
            <div class="widget woocommerce widget_product_search">
                <!--<form role="search"
                    method="get"
                    class="woocommerce-product-search"
                    action="<?php echo esc_url( home_url( '/' ) ); ?>">

                    <label class="screen-reader-text" for="woocommerce-product-search-field-1">
                        <?php ml_text('[:en]Search[:ar]بحث'); ?>
                    </label>

                    <input type="search"
                        id="woocommerce-product-search-field-1"
                        class="search-field"
                        placeholder="<?php ml_text('[:en]Search...[:ar]بحث...'); ?>"
                        value="<?php echo get_search_query(); ?>"
                        name="s" required/>

                    <button type="submit" aria-label="<?php ml_text('[:en]View Details[:ar]عرض التفاصيل'); ?>">
                        <i class="fa fa-search"></i>
                    </button>
                </form>-->
                <?php echo get_theme_option('iframe_dynmaic_map'); ?>

            </div>
        </div>
        <div class="site-search-close"></div>
    </div>
    <!-- End Form Search -->
    <header>
        <!-- Start navbar -->
        <div class="mynav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="logo">
							<a href="<?php echo home_url('/'); ?>">
								<?php 
								if ( is_front_page() || is_singular('project')) {
									$header_logo = get_theme_option('logo'); // Logo for home
								} else {
									$header_logo = get_theme_option('logo_inner'); // Logo for other pages
								}

								if ($header_logo): 
								?>
									<img src="<?php echo esc_url($header_logo); ?>" alt="<?php bloginfo('name'); ?>">
								<?php endif; ?>
							</a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="left-menu">
                            <span class="navbar-toggler">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="6" width="25" height="3" fill="currentColor"></rect>
                                    <rect x="2" y="16" width="25" height="3" fill="currentColor"></rect>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <!--<div class="col-lg-7">
                        <div class="navbar">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'header-menu',
                                'container' => false,
                                'menu_class' => 'navbar-menu',
                            ));
                            ?>
                            <div class="project-type">
                                <ul class="tab-nav-list">
                                    <li class="tab-nav-item <?php echo is_tab_active('rent') ? 'active' : ''; ?>">
                                        <a href="<?php echo get_tab_url(119, 'rent'); ?>"><?php echo ml_get('[:en]Rent[:ar]إيجار[:]'); ?></a>
                                    </li>
                                    <li class="tab-nav-item <?php echo is_tab_active('buy') ? 'active' : ''; ?>">
                                        <a href="<?php echo get_tab_url(119, 'buy'); ?>"><?php echo ml_get('[:en]Buy[:ar]شراء[:]'); ?></a>
                                    </li>
                                    <li class="tab-nav-item <?php echo is_tab_active('investment') ? 'active' : ''; ?>">
                                        <a href="<?php echo get_tab_url(119, 'investment'); ?>"><?php echo ml_get('[:en]Investment[:ar]استثمار[:]'); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="left-header">
                            <div class="lang">
                            <?php if (function_exists('qtranxf_getSortedLanguages')): ?>
                                <?php
                                global $wp;
                                $current_lang = qtranxf_getLanguage();
                                $languages = qtranxf_getSortedLanguages();
                                
                                // Language display names
                                $lang_names = [
                                    'en' => 'En',
                                    'ar' => 'العربية',
                                ];
                                
                                foreach ($languages as $language):
                                    if ($language !== $current_lang): ?>                                 
                                    <a href="<?php echo esc_url(qtranxf_convertURL(home_url($wp->request), $language, false, true)); ?>">
                                        <span><?php echo esc_html($lang_names[$language] ?? strtoupper($language)); ?></span>
                                        <i class="fal fa-globe"></i>
                                    </a>
                                <?php endif; endforeach;  endif; ?>
                            </div>
                            <div class="search-menu">
                                <div class="searchForm">
                                    <span class="btnSearch">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.16699 0.833008C4.56462 0.833008 0.833008 4.56462 0.833008 9.16699C0.833183 13.7692 4.56473 17.5 9.16699 17.5C11.1681 17.5 13.0039 16.7938 14.4404 15.6182L17.7441 18.9229C18.0696 19.2482 18.5974 19.2482 18.9229 18.9229C19.2483 18.5974 19.2482 18.0696 18.9229 17.7441L15.6191 14.4395C16.7943 13.0031 17.4999 11.1676 17.5 9.16699C17.5 4.56468 13.7693 0.833105 9.16699 0.833008ZM9.16699 2.5C12.8488 2.5001 15.833 5.48515 15.833 9.16699C15.8328 12.8487 12.8487 15.8329 9.16699 15.833C5.4852 15.833 2.50018 12.8487 2.5 9.16699C2.5 5.48509 5.48509 2.5 9.16699 2.5Z"
                                                fill="#4C4C4C" />
                                        </svg>

                                    </span>
                                </div>
                            </div>

                            <div class="request"><a href="<?php echo get_permalink(117); ?>">
                                    <?php ml_text('[:en]Contact Us[:ar]تواصل معنا'); ?>
                                </a></div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
        <!-- End navbar -->
    </header>
    <!-- responsive menu -->
    <div class="responsive-menu">
		<div class="logo">
			<a href="<?php echo home_url('/'); ?>">
				<?php 
				$home_logo  = get_theme_option('logo');
				$inner_logo = get_theme_option('logo_inner');

				if ( is_front_page() ) {
					$logo = $home_logo ?: $inner_logo;
				} else {
					$logo = $inner_logo ?: $home_logo;
				}

				if ($logo):
				?>
					<img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>">
				<?php endif; ?>
			</a>
		</div>
        <div class="left-menu">
            <span class="navbar-toggler"><i class="fal fa-bars"></i></span>
        </div>

    </div>
    <!-- Sidebar -->
    <div class="close-overlay">
<!--         <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/menu.png" alt="#" /> -->
		<img src="<?php echo get_theme_option('menu_bg');?>" alt="#" />
    </div>
    <div class="sidebar">
        <div class="flex-h">
            <div class="logo">
				<a href="<?php echo home_url('/'); ?>">
					<?php 
					if ( is_front_page() ) {
						$header_logo = get_theme_option('logo'); // Logo for home
					} else {
						$header_logo = get_theme_option('logo_inner'); // Logo for other pages
					}

					if ($header_logo): 
					?>
						<img src="<?php echo esc_url($header_logo); ?>" alt="<?php bloginfo('name'); ?>">
					<?php endif; ?>
				</a>
            </div>
            <div class="close-side"><i class="fal fa-times"></i></div>
            <div class="search-menu">
                <div class="searchForm">
                    <span class="btnSearch">
                        <svg width="47" height="47" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_2037_3988)">
                            <path d="M31.7916 31.7426L27.514 27.465C28.6797 26.0393 29.2528 24.2201 29.1148 22.3837C28.9769 20.5473 28.1383 18.8342 26.7727 17.5987C25.407 16.3632 23.6188 15.6999 21.7777 15.7459C19.9367 15.7919 18.1838 16.5438 16.8816 17.846C15.5794 19.1482 14.8276 20.9011 14.7815 22.7421C14.7355 24.5831 15.3988 26.3714 16.6343 27.737C17.8698 29.1027 19.583 29.9412 21.4194 30.0792C23.2558 30.2172 25.075 29.644 26.5006 28.4783L30.7783 32.7559C30.9134 32.8865 31.0944 32.9587 31.2824 32.9571C31.4703 32.9555 31.65 32.8801 31.7829 32.7472C31.9157 32.6143 31.9911 32.4346 31.9927 32.2467C31.9944 32.0588 31.9221 31.8778 31.7916 31.7426ZM21.9686 28.6661C20.8347 28.6661 19.7263 28.3298 18.7835 27.6999C17.8407 27.0699 17.1058 26.1745 16.6719 25.1269C16.238 24.0794 16.1245 22.9266 16.3457 21.8145C16.5669 20.7024 17.1129 19.6808 17.9147 18.8791C18.7165 18.0773 19.738 17.5312 20.8501 17.31C21.9623 17.0888 23.115 17.2023 24.1626 17.6363C25.2102 18.0702 26.1056 18.805 26.7355 19.7478C27.3655 20.6906 27.7017 21.7991 27.7017 22.933C27.7 24.453 27.0955 25.9102 26.0207 26.985C24.9459 28.0598 23.4886 28.6644 21.9686 28.6661Z" fill="black"/>
                            </g>
                            <circle cx="23.4479" cy="23.4479" r="23.0896" stroke="#E2E2E2" stroke-width="0.716639"/>
                            <defs>
                            <clipPath id="clip0_2037_3988">
                            <rect width="17.1993" height="17.1993" fill="white" transform="translate(14.8027 15.7661)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
        <!--<div class="sidebar-logo"><img src="<?php echo get_theme_option('logo'); ?>" alt="<?php bloginfo('name'); ?>"></div>-->
        <div class="side-search">
            <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <label class="screen-reader-text" for="woocommerce-product-search-field-1"></label>
                <input type="search" class="search-field" placeholder="<?php ml_text('[:en]Search...[:ar]بحث...'); ?>" value="<?php echo get_search_query(); ?>" name="s" />                
                <button type="submit">
                    <span class="btnSearch">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.16699 0.833008C4.56462 0.833008 0.833008 4.56462 0.833008 9.16699C0.833183 13.7692 4.56473 17.5 9.16699 17.5C11.1681 17.5 13.0039 16.7938 14.4404 15.6182L17.7441 18.9229C18.0696 19.2482 18.5974 19.2482 18.9229 18.9229C19.2483 18.5974 19.2482 18.0696 18.9229 17.7441L15.6191 14.4395C16.7943 13.0031 17.4999 11.1676 17.5 9.16699C17.5 4.56468 13.7693 0.833105 9.16699 0.833008ZM9.16699 2.5C12.8488 2.5001 15.833 5.48515 15.833 9.16699C15.8328 12.8487 12.8487 15.8329 9.16699 15.833C5.4852 15.833 2.50018 12.8487 2.5 9.16699C2.5 5.48509 5.48509 2.5 9.16699 2.5Z"
                                fill="#4C4C4C"></path>
                        </svg>
                    </span>
                </button>
            </form>
        </div>
        <div class="side-content">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'mobile-menu',
                'container' => false,
                'menu_class' => 'mobile-menu',
            ));
            ?>   
            <div class="lang-flex">
                       <div class="request"><a href="<?php echo get_permalink(117); ?>">
                    <?php ml_text('[:en]Contact Us[:ar]تواصل معنا'); ?>
                </a></div>
                <div class="lang langedit">
                <?php if (function_exists('qtranxf_getSortedLanguages')): ?>
                    <?php
                    global $wp;
                    $current_lang = qtranxf_getLanguage();
                    $languages = qtranxf_getSortedLanguages();
                    
                    // Language display names
                    $lang_names = [
                        'en' => 'English',
                        'ar' => 'العربية',
                    ];
                    
                    foreach ($languages as $language):
                        if ($language !== $current_lang): ?>                                 
                        <a href="<?php echo esc_url(qtranxf_convertURL(home_url($wp->request), $language, false, true)); ?>">
                            <?php echo esc_html($lang_names[$language] ?? strtoupper($language)); ?>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12 22.75C17.928 22.75 22.75 17.928 22.75 12C22.75 6.072 17.928 1.25 12 1.25C6.072 1.25 1.25 6.072 1.25 12C1.25 17.928 6.072 22.75 12 22.75ZM3.54785 8.25C4.76542 5.51678 7.26863 3.48002 10.2861 2.91211C9.44562 4.08132 8.36184 5.91397 7.74316 8.25H3.54785ZM16.2578 8.25C15.639 5.91379 14.5544 4.08132 13.7139 2.91211C16.7314 3.48002 19.2346 5.51678 20.4521 8.25H16.2578ZM9.30957 8.25C10.0345 5.82772 11.2892 4.02745 12 3.14258C12.7107 4.02811 13.9655 5.82804 14.6904 8.25H9.30957ZM16.5752 14.25C16.6875 13.536 16.751 12.7847 16.751 12C16.751 11.2154 16.6875 10.4639 16.5752 9.75H20.9717C21.1525 10.4706 21.25 11.2241 21.25 12C21.25 12.7759 21.1525 13.5294 20.9717 14.25H16.5752ZM8.95215 14.25C8.825 13.5386 8.75002 12.7869 8.75 12C8.75 11.2133 8.82505 10.4613 8.95215 9.75H15.0479C15.175 10.4613 15.25 11.2132 15.25 12C15.25 12.7868 15.175 13.5386 15.0479 14.25H8.95215ZM3.02832 14.25C2.8475 13.5294 2.75 12.7759 2.75 12C2.75 11.2241 2.8475 10.4706 3.02832 9.75H7.42578C7.31352 10.4639 7.25 11.2154 7.25 12C7.25001 12.7847 7.31346 13.536 7.42578 14.25H3.02832ZM10.2871 21.0889C7.26911 20.5212 4.76557 18.4836 3.54785 15.75H7.74316C8.36221 18.0866 9.44652 19.9198 10.2871 21.0889ZM12 20.8564C11.2893 19.9709 10.0344 18.1715 9.30957 15.75H14.6904C13.9656 18.1719 12.7107 19.9716 12 20.8564ZM13.7139 21.0889C14.5545 19.9198 15.6389 18.0868 16.2578 15.75H20.4521C19.2346 18.4833 16.7314 20.521 13.7139 21.0889Z" fill="white"/>
</svg>
                        </a>
                    <?php endif; endforeach;  endif; ?>
                </div>
    
    
            </div>
        </div>
    </div>
    <!-- ----------------------------------- -->
    <div class="h-page-push-wrapper">
