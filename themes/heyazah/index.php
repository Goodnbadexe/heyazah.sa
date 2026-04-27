<?php
/**
 * Index Template - Dynamic ELRYAD Homepage
 * Template Name: ELRYAD Homepage
 */

get_header(); ?>

   <!-- Start hero section -->
    <div class="hero-section">
        <div class="hero-video">
            <?php 
            $hero_video = get_theme_option('hom_vid');
            if ($hero_video):
            ?>
                <video src="<?php echo esc_url($hero_video); ?>" autoplay loop muted></video>
            <?php endif; ?>
        </div>
        <div class="banner-logo">
            <svg width="469" height="179" viewBox="0 0 469 179" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M218.76 67.1772C216.223 74.8982 214.328 80.1675 213.077 82.9851C212.673 83.8879 211.391 85.0744 209.23 86.5447C205.27 89.2324 201.458 91.4687 197.792 93.2536C182.2 100.811 166.063 105.772 149.383 108.138C141.505 109.246 127.872 109.964 121.943 103.779C121.704 103.534 121.501 103.257 121.337 102.958C119.559 99.8189 118.386 96.5329 117.819 93.0998C114.208 71.4856 117.829 48.7123 113.551 27.8573C112.779 24.0959 111.407 20.7449 109.438 17.8042C109.365 17.6928 109.318 17.5662 109.302 17.4345C109.286 17.3027 109.301 17.1694 109.346 17.0451L115.09 0.406223C115.126 0.297941 115.193 0.202369 115.282 0.130913C115.371 0.0594573 115.479 0.0151354 115.592 0.00323873C115.706 -0.00865793 115.821 0.0123719 115.922 0.0638192C116.024 0.115266 116.109 0.194958 116.167 0.293382C120.948 8.18198 121.584 18.2761 122.097 28.124C122.329 32.706 122.421 37.8864 122.374 43.6653C122.285 53.944 122.65 62.7148 123.471 69.9777C123.957 74.2998 124.794 78.1808 125.984 81.6208C127.923 87.2526 131.596 89.2734 137.545 90.33C143.099 91.308 149.356 91.3046 156.318 90.3198C170.693 88.2886 185.017 84.1272 199.29 77.8355C206.97 74.4434 213.299 70.7778 218.278 66.8386C218.33 66.7979 218.394 66.775 218.46 66.7732C218.526 66.7715 218.59 66.791 218.645 66.829C218.699 66.8669 218.739 66.9213 218.76 66.984C218.781 67.0467 218.781 67.1144 218.76 67.1772Z" fill="#D5CBBE"/>
                <path d="M467.376 81.4256L450.286 69.8235C450.182 69.7542 450.097 69.6599 450.038 69.5489C449.979 69.438 449.948 69.3138 449.948 69.1875C449.937 65.8946 450.307 59.1959 449.63 55.2363C448.241 47.1049 444.671 40.7174 438.92 36.0738C432.088 30.5481 424.63 28.1852 416.547 28.9854C403.96 30.2369 393.343 38.741 389.763 50.8765C388.826 54.0566 388.388 58.4573 388.449 64.0789C388.511 69.3448 388.525 78.4062 388.49 91.2632C388.488 91.4192 388.424 91.5679 388.313 91.6773C388.201 91.7867 388.052 91.848 387.896 91.8479H371.195C371.032 91.8479 370.875 91.7831 370.76 91.6677C370.644 91.5522 370.58 91.3957 370.58 91.2324C370.498 71.7281 370.532 60.3004 370.682 56.9494C371.421 40.5875 380.858 25.4463 394.984 17.3833C415.695 5.55555 441.177 10.2436 456.574 28.4007C464.22 37.4211 468.016 48.5444 467.961 61.7708C467.913 74.108 467.876 80.581 467.848 81.1896C467.844 81.2426 467.826 81.2936 467.797 81.3376C467.767 81.3817 467.727 81.4173 467.679 81.4411C467.632 81.4648 467.579 81.4759 467.526 81.4732C467.473 81.4704 467.421 81.454 467.376 81.4256Z" fill="#D5CBBE"/>
                <path d="M6.70182 11.434L20.8069 17.1171C20.9295 17.1646 21.0657 17.1622 21.1865 17.1104C21.3073 17.0586 21.4031 16.9616 21.4532 16.8401L23.5356 11.6699C23.5857 11.5484 23.6815 11.4514 23.8023 11.3997C23.9231 11.3479 24.0593 11.3455 24.1819 11.393L39.2512 17.4556C39.3727 17.5057 39.4698 17.6014 39.5215 17.7222C39.5733 17.843 39.5757 17.9793 39.5282 18.1019L33.5066 33.0584C33.4565 33.1799 33.3608 33.2769 33.24 33.3287C33.1192 33.3804 32.9829 33.3828 32.8604 33.3354L18.7553 27.6523C18.6327 27.6048 18.4964 27.6072 18.3756 27.659C18.2548 27.7107 18.1591 27.8078 18.109 27.9293L16.0266 33.0994C15.9764 33.2209 15.8807 33.3179 15.7599 33.3697C15.6391 33.4215 15.5028 33.4239 15.3803 33.3764L0.310931 27.3138C0.18944 27.2636 0.0924131 27.1679 0.0406415 27.0471C-0.0111301 26.9263 -0.0135286 26.79 0.0339578 26.6675L6.05555 11.711C6.10568 11.5895 6.2014 11.4925 6.3222 11.4407C6.443 11.3889 6.57927 11.3865 6.70182 11.434Z" fill="#D5CBBE"/>
                <path d="M98.2237 34.3477L83.188 28.576C82.9288 28.4765 82.6381 28.606 82.5386 28.8651L76.7669 43.9009C76.6675 44.16 76.7969 44.4508 77.0561 44.5503L92.0918 50.322C92.351 50.4214 92.6417 50.292 92.7412 50.0328L98.5129 34.9971C98.6124 34.7379 98.4829 34.4472 98.2237 34.3477Z" fill="#D5CBBE"/>
                <path d="M250.56 54.5798C250.521 54.6093 250.473 54.6254 250.425 54.6258C250.376 54.6262 250.328 54.6108 250.289 54.5819C250.25 54.5531 250.221 54.5123 250.207 54.4657C250.193 54.4191 250.194 54.3691 250.211 54.3233L254.817 41.0184C254.937 40.6764 255.15 40.3745 255.432 40.1464C266.921 30.9961 281.129 33.5196 293.747 38.977C308.078 45.1627 321.454 54.3644 333.703 64.3354C333.742 64.369 333.774 64.4114 333.794 64.459C333.815 64.5066 333.824 64.558 333.821 64.6091C333.818 64.6602 333.803 64.7094 333.777 64.7528C333.751 64.7962 333.715 64.8324 333.672 64.8586L321.126 72.8087C320.973 72.9076 320.792 72.9567 320.608 72.9494C320.425 72.9421 320.248 72.8786 320.1 72.7677C307.708 63.5352 294.352 54.9901 279.713 50.6817C269.394 47.6555 259.156 48.1684 250.56 54.5798Z" fill="#D5CBBE"/>
                <path d="M10.6818 56.8984L16.3957 40.3518C16.4519 40.1918 16.567 40.0592 16.7176 39.9811C16.8682 39.9029 17.0428 39.8851 17.2061 39.9313C29.834 43.4704 59.4598 55.0109 53.3459 73.4655C52.9629 74.6212 51.0309 79.9555 47.55 89.4683C46.2916 92.922 44.3768 95.6199 41.8054 97.5621C33.3662 103.936 24.5818 104.49 15.4519 99.2239C9.00289 95.5105 6.9615 89.6633 9.32774 81.6823C11.2084 75.3427 13.7559 68.2714 16.9701 60.4683C17.0062 60.381 17.0241 60.2872 17.0229 60.1927C17.0216 60.0983 17.0012 60.0051 16.9628 59.9187C16.9244 59.8324 16.8689 59.7547 16.7997 59.6905C16.7304 59.6263 16.6488 59.5768 16.5598 59.545L11.0409 57.637C10.9683 57.6128 10.9013 57.5743 10.8438 57.5239C10.7863 57.4734 10.7395 57.412 10.706 57.3432C10.6726 57.2744 10.6532 57.1996 10.649 57.1232C10.6449 57.0469 10.656 56.9704 10.6818 56.8984ZM17.7703 60.5914L15.0826 67.8234C14.9941 68.0684 14.9389 68.3272 14.9185 68.5928C14.5492 74.1938 16.7855 78.4305 21.6274 81.3028C29.9502 86.2267 38.1979 86.2404 46.3703 81.3438C46.4677 81.2849 46.5524 81.2073 46.6196 81.1154C46.6869 81.0236 46.7352 80.9193 46.7619 80.8087C46.7886 80.6981 46.7932 80.5832 46.7752 80.4708C46.7573 80.3584 46.7173 80.2507 46.6575 80.1539C43.71 75.312 39.8939 71.407 35.2093 68.4389C30.2375 65.2794 24.7083 62.537 18.6217 60.2118C18.5409 60.1805 18.4547 60.1654 18.3681 60.1676C18.2814 60.1697 18.1961 60.189 18.1169 60.2243C18.0378 60.2595 17.9664 60.3101 17.9069 60.3732C17.8474 60.4362 17.801 60.5103 17.7703 60.5914Z" fill="#D5CBBE"/>
                <path d="M8.08401 111.831C8.06482 111.805 8.05454 111.773 8.05469 111.74C8.05483 111.708 8.06539 111.676 8.08482 111.65C8.10425 111.623 8.13155 111.604 8.16276 111.594C8.19398 111.584 8.22748 111.585 8.25841 111.595C39.4127 124.275 71.798 111.021 93.7404 88.0527C93.9397 87.8469 94.0755 87.5877 94.1319 87.3059C94.1883 87.024 94.1628 86.7314 94.0584 86.4627L88.56 72.1832C88.4672 71.9454 88.4635 71.6862 88.5497 71.4549L94.2841 55.9444C94.3048 55.8932 94.3399 55.849 94.3851 55.8172C94.4304 55.7855 94.4838 55.7674 94.539 55.7652C94.5943 55.7631 94.6489 55.7769 94.6965 55.805C94.7441 55.8332 94.7825 55.8744 94.8072 55.9239C98.6746 63.8843 100.377 70.5419 100.675 79.1793C100.695 79.7485 100.605 80.3164 100.408 80.8514L95.2073 95.1412C94.9898 95.7323 94.6745 96.2868 94.2738 96.7825C79.5225 115.145 58.5546 129.137 34.7452 132.081C32.037 132.416 29.6605 131.91 27.6157 130.563C20.3118 125.742 13.8013 119.498 8.08401 111.831Z" fill="#D5CBBE"/>
                <path d="M468.558 118.817C468.556 118.885 468.534 118.951 468.495 119.006C468.456 119.062 468.401 119.105 468.338 119.13C468.275 119.155 468.206 119.161 468.139 119.147C468.072 119.134 468.011 119.101 467.963 119.053C451.051 101.415 431.112 88.5208 408.147 80.3689C408.03 80.3266 407.928 80.2497 407.857 80.1487C407.785 80.0477 407.747 79.9275 407.747 79.8047V61.8015C407.746 61.7478 407.758 61.6946 407.782 61.6464C407.806 61.5982 407.84 61.5563 407.883 61.5242C407.927 61.4922 407.977 61.4708 408.03 61.4619C408.083 61.4531 408.137 61.4569 408.188 61.4732C430.469 68.5172 450.456 79.538 468.148 94.5356C468.276 94.6452 468.38 94.7809 468.451 94.9332C468.522 95.0856 468.558 95.2509 468.558 95.4178V118.817Z" fill="#D5CBBE"/>
                <path d="M304.18 66.4795C304.216 66.4497 304.262 66.4321 304.31 66.4296C304.357 66.4271 304.404 66.4398 304.443 66.4656C304.482 66.4914 304.51 66.5289 304.524 66.5723C304.537 66.6156 304.535 66.6624 304.518 66.7051L299.051 82.5131C298.843 83.1364 298.462 83.6878 297.953 84.1031C294.52 86.9002 290.967 89.2699 287.295 91.2121C269.808 100.451 251.442 106.196 232.198 108.446C224.36 109.359 214.502 109.297 207.752 104.302C207.517 104.126 207.344 103.881 207.257 103.601C207.17 103.32 207.175 103.02 207.27 102.742L212.984 86.2266C213.008 86.1584 213.048 86.0972 213.101 86.0483C213.155 85.9994 213.219 85.9643 213.289 85.946C213.359 85.9278 213.432 85.927 213.502 85.9437C213.573 85.9604 213.638 85.9942 213.692 86.0419C216.68 88.668 220.199 90.1863 224.248 90.5966C233.945 91.5745 244.364 90.6581 255.504 87.8474C270.687 84.0176 283.848 78.9843 294.988 72.7472C298.763 70.634 301.827 68.5448 304.18 66.4795Z" fill="#D5CBBE"/>
                <path d="M370.511 118.93V101.737C370.511 101.687 370.521 101.638 370.54 101.592C370.559 101.546 370.587 101.504 370.622 101.469C370.657 101.434 370.699 101.406 370.745 101.387C370.791 101.367 370.84 101.358 370.89 101.358H435.774C435.839 101.357 435.903 101.374 435.96 101.406C436.017 101.438 436.065 101.484 436.099 101.539C436.133 101.595 436.152 101.659 436.154 101.724C436.157 101.789 436.142 101.854 436.112 101.912L427.516 119.104C427.484 119.166 427.435 119.218 427.375 119.255C427.316 119.291 427.247 119.31 427.177 119.31H370.89C370.79 119.31 370.693 119.27 370.622 119.198C370.551 119.127 370.511 119.031 370.511 118.93Z" fill="#D5CBBE"/>
                <path d="M178.147 126.449C177.958 126.375 177.806 126.23 177.723 126.048C177.64 125.865 177.634 125.659 177.706 125.475L183.338 110.559C183.379 110.454 183.46 110.368 183.564 110.322C183.668 110.276 183.785 110.273 183.892 110.313L198.397 115.955C198.452 115.978 198.511 115.99 198.571 115.989C198.63 115.989 198.689 115.976 198.744 115.952C198.799 115.928 198.848 115.893 198.889 115.85C198.929 115.806 198.961 115.755 198.981 115.699L200.9 110.58C200.943 110.466 201.03 110.373 201.142 110.323C201.254 110.273 201.38 110.27 201.495 110.313L216.513 116.171C216.644 116.224 216.75 116.326 216.808 116.454C216.865 116.583 216.87 116.728 216.82 116.858L211.178 131.835C211.152 131.906 211.112 131.97 211.061 132.025C211.009 132.08 210.947 132.124 210.878 132.155C210.81 132.185 210.735 132.202 210.66 132.203C210.585 132.205 210.51 132.191 210.44 132.163L196.191 126.613C196.041 126.557 195.875 126.562 195.729 126.627C195.583 126.692 195.469 126.813 195.412 126.962L193.637 131.794C193.608 131.872 193.565 131.943 193.508 132.004C193.452 132.065 193.384 132.114 193.309 132.148C193.233 132.182 193.152 132.201 193.069 132.204C192.986 132.207 192.904 132.193 192.826 132.163L178.147 126.449Z" fill="#D5CBBE"/>
            </svg>
        </div>
        <div class="carousel-info">
            <?php 
            $hero_title = get_theme_option('hero_tit');
            if ($hero_title): 
            ?>
                <h2><?php echo esc_html($hero_title); ?></h2>
            <?php endif; ?>
            
            <?php 
            $hero_desc = get_theme_option('hero_des');
            if ($hero_desc): 
            ?>
                <p><?php echo esc_html($hero_desc); ?></p>
            <?php endif; ?>
            <!--
                <div class="read-more">
                    <a href="<?php echo get_post_type_archive_link('project'); ?>">
                        <span><?php ml_text('[:en]Discover Projects[:ar]اكتشف المشاريع'); ?></span>
                        <i class="fal fa-long-arrow-left"></i>
                    </a>
                </div>-->
        </div>
    </div>
    <!-- end hero section -->
<?php
$projects = get_field('select_pro', 'option');

if ($projects) :
?>

<section class="projects-h">
    
    <div class="projects-home owl-carousel owl-theme">
        
          <?php foreach ($projects as $post) : setup_postdata($post); ?>

            <?php
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $permalink = get_permalink();
            ?>      
        
        <div class="item">
            <div class="project-block position-relative">
                    <?php if ($thumbnail) : ?>
                        <div class="overlay-img">
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>">
                        </div>
                    <?php endif; ?>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="project-info">
                                <span class="alert-h">
                                    
                                    <?php
                                    $terms = get_the_terms(get_the_ID(), 'project_category');
                                    
                                    if (!empty($terms) && !is_wp_error($terms)) :
                                        $term = $terms[0]; // first category
                                    ?>
                                    
                                           <?php echo esc_html($term->name); ?>
                                    
                                    <?php endif; ?>                                    
                                </span>
                                <h2>
                                    <h2><?php the_title(); ?></h2>
                                </h2>
                                <h4>
                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_2026_2008)">
                                        <path d="M12.0562 6.02808C12.0562 9.03793 8.71717 12.1726 7.59594 13.1407C7.49149 13.2192 7.36434 13.2617 7.23365 13.2617C7.10296 13.2617 6.97581 13.2192 6.87136 13.1407C5.75012 12.1726 2.41113 9.03793 2.41113 6.02808C2.41113 4.74907 2.91922 3.52245 3.82361 2.61805C4.72801 1.71365 5.95464 1.20557 7.23365 1.20557C8.51266 1.20557 9.73928 1.71365 10.6437 2.61805C11.5481 3.52245 12.0562 4.74907 12.0562 6.02808Z" stroke="#B5A491" stroke-width="1.20563" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.23325 7.83637C8.23202 7.83637 9.04169 7.0267 9.04169 6.02793C9.04169 5.02915 8.23202 4.21948 7.23325 4.21948C6.23447 4.21948 5.4248 5.02915 5.4248 6.02793C5.4248 7.0267 6.23447 7.83637 7.23325 7.83637Z" stroke="#B5A491" stroke-width="1.20563" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_2026_2008">
                                        <rect width="14.4675" height="14.4675" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                   <?php the_field('project_location'); ?>
                                </h4>
            
                                <div class="banar-btns">
                                    <div class="read-more">
                                        <a href="<?php echo esc_url($permalink); ?>">
                                            <span><?php ml_text('[:en]View Project[:ar]اكتشف المشروع'); ?></span>
                                            <div class="icon">
                                                <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.1201 1.36694C19.6111 1.367 24.873 6.62885 24.873 13.1199C24.873 19.6109 19.6111 24.8727 13.1201 24.8728C6.62909 24.8728 1.36725 19.6109 1.36719 13.1199C1.36719 6.62881 6.62905 1.36694 13.1201 1.36694ZM13.1201 3.00659C7.53478 3.00659 3.00684 7.53454 3.00684 13.1199C3.0069 18.7052 7.53482 23.2332 13.1201 23.2332C18.7054 23.2331 23.2333 18.7051 23.2334 13.1199C23.2334 7.53457 18.7054 3.00665 13.1201 3.00659ZM12.6064 10.4187L10.7266 12.2996H17.4932V13.9392H10.7266L12.6064 15.8191L11.4473 16.9783L7.58691 13.1189L11.4473 9.25854L12.6064 10.4187Z" fill="#005057"/>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <?php endforeach; ?>
    </div>
</section>

<?php
wp_reset_postdata();
endif;
?>



<!-- Start banar section 
<section class="banar-sec">
    <div class="banar-img">
        <?php if ($thumbnail) : ?>
            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title($project_id)); ?>">
        <?php endif; ?>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="banar-info wow animate__animated animate__fadeInUp">
                    
                    <h2><?php //echo esc_html(get_the_title($project_id)); ?></h2>

                    <p>
                        <?php
                        //echo get_field('business_destination_des', $project_id);
                        ?>
                    </p>

                    <div class="banar-btns">
                        <div class="read-more">
                            <a href="<?php echo esc_url($permalink); ?>">
                                <span><?php ml_text('[:en]View Project[:ar]عرض المشروع'); ?></span>
                                <i class="fal fa-long-arrow-left"></i>
                            </a>
                        </div>

                        <div class="read-more">
                            <a href="<?php echo esc_url($permalink); ?>#register-sec" class="register">
                                <?php ml_text('[:en]Register your interest[:ar] سجل إهتمامك'); ?>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
End banar section -->




    <!-- Start projects section -->
    <section class="project-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <!-- <h6>
                            <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                            <span><?php ml_text('[:en]Our work[:ar] اعمالنا'); ?> </span>
                        </h6> -->
                        <h4><?php echo esc_html(get_theme_option('works_tit')); ?></h4>
                        <p><?php echo esc_html(get_theme_option('works_des')); ?></p>
                    </div>
        <style>
.prj-status span.completed {
  background: #009491;
}
.prj-status span.under-implementation {
  background: #d5cbbe;
}
</style>
                    <div class="projects-slider2 owl-carousel owl-theme">
                        <?php
                        // Query to get 5 latest projects
                        $projects_args = array(
                            'post_type'      => 'project',
                            'posts_per_page' => 6,
                            'post_status'    => 'publish',
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        );
        
                        $projects_query = new WP_Query($projects_args);
        
                        if ($projects_query->have_posts()) :
                            while ($projects_query->have_posts()) : $projects_query->the_post();
                                // Args
                                set_query_var('card_col_class', 'item');
                                // Load project card template
                                get_template_part('template-parts/content', 'project-card');
                            endwhile;
                            wp_reset_postdata();
                        else:
                        ?>
                            <div class="col-12">
                                <p class="text-center"><?php ml_text('[:en]No projects available at the moment[:ar]لا توجد مشاريع حالياً'); ?></p>
                            </div>
                        <?php endif; ?>
        
                    </div>
        
                    <!-- View All Projects Button -->
                    <div class="read-more wow animate__animated animate__fadeInUp">
                        <a href="<?php echo get_post_type_archive_link('project'); ?>">
                            <span><?php ml_text('[:en]View All Projects[:ar]عرض جميع المشاريع'); ?></span>
                            <i class="fal fa-long-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        
    </section>
    <!-- End projects section -->
    
    
    <!-- Start Projects map section -->
    <section class="Projects-map">
        <div class="container-fliud">
            <div class="section-title">
                <h4> <?php ml_text('[:en]Discover freelance <br/> projects on the map[:ar]اكتشف مشاريع<br/> حيازة علي الخريطة'); ?> </h4>
                 <!-- <p>
                   <?php echo esc_html(get_theme_option('map_des')); ?>
                </p> -->
            </div>
            <div class="project-map-img">
                <!-- <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images//map-img.png" alt=""> -->
                <?php echo get_theme_option('iframe_dynmaic_map'); ?>
            </div>
        </div>
    </section>
    <!-- End Projects map section -->

    <!-- Start achevement section -->
    <section class="achevment">
        <div class="container">
            <div class="section-title">
                <h6>
                    <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                    <span><?php ml_text('[:en]Our achievements[:ar] إنجازاتنا'); ?> </span>
                </h6>
                <h4><?php echo esc_html(get_theme_option('achi_tit')); ?></h4>
                <p><?php echo esc_html(get_theme_option('achi_des')); ?></p>
            </div>
            <div class="about-counter">
                <div class="container">
                    <div class="row wow animate__animated animate__fadeInUp">
                        <?php 
                        $achievements = get_theme_option('achi_rep');
                        if ($achievements):
                            foreach ($achievements as $achievement):
                        ?>
                            <div class="col-md-3 col-6">
                                <div class="count-block">
                                    <div class="details">
                                        <div class="img"><img src="<?php echo esc_url($achievement['icon']); ?>" alt=""></div>
                                        <div class="counter-name">
                                            <h3 class="counter-item">
                                                <span class="plus">+</span>
                                                <span class="odometer" data-odometer-final="<?php echo esc_attr($achievement['num']); ?>"></span>
                                            </h3>
                                            <h6><?php echo esc_html($achievement['text_num1']); ?></h6>
                                            <p><?php echo esc_html($achievement['text_num2']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; endif;  ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end achevement section -->
    
    
    <!-- Start Discover opportunities section -->
    <section class="Discover-opportunities" id="reality_technology">
        <div class="container">
            <div class="section-title">
                <h6>
                <span> <?php ml_text('[:en]360° virtual tour[:ar]جولة افتراضية 360° '); ?> </span>
            </h6>
            <h4>
               <?php echo esc_html(get_theme_option('degree_tit')); ?>
            </h4>
                <p>
                   <?php echo esc_html(get_theme_option('degree_des')); ?>
                </p>
            </div>
                <?php
                $discover_items = get_theme_option('degree_rep');

                if ( $discover_items ) :
                ?>
                <div class="row">

                    <!-- LEFT COLUMN (FIRST ITEM ONLY) -->
                    <div class="col-lg-8">
                        <?php
                        if ( isset($discover_items[0]) ) :
                            $title = $discover_items[0]['txt'];
                            $image = $discover_items[0]['ima'];
                            $des   = $discover_items[0]['des'];                            
                        ?>
                            <div class="discoverItem discoverItem=big">
                                <a href="#" 
                       data-toggle="modal" 
                       data-target="#vr_modal" 
                       data-tour-id="1"> 
                                <div class="item-details">
                                   <!-- <div class="icone">
                                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/white-eye.svg" alt="">
                                    </div>-->
                                    <div class="item-name">
                                        <span class="alert-h">360°</span>
                                        <div class="text-inner">
                                            <h6><?php echo wp_kses_post($title); ?></h6>
                                            <p>
                                                <?php echo wp_kses_post($des); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="img">
                                    <img src="<?php echo esc_url($image); ?>" alt="">
                                </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
 
                    <!-- RIGHT COLUMN (NEXT TWO ITEMS) -->
                    <div class="col-lg-4">
                        <?php
                        for ( $i = 1; $i <= 2; $i++ ) :
                            if ( ! isset($discover_items[$i]) ) continue;

                            $title = $discover_items[$i]['txt'];
                            $image = $discover_items[$i]['ima'];
                            $des   = $discover_items[$i]['des'];
                        ?>
                            <div class="discoverItem discoverItem-small">
                    <a href="#" 
                       data-toggle="modal" 
                       data-target="#vr_modal" 
                       data-tour-id="<?php echo $i + 1 ; ?>"> 
                                <div class="item-details">
                                    <!-- <div class="icone">
                                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/white-eye.svg" alt="">
                                    </div>-->
                                    <div class="item-name">
                                        <span class="alert-h">360°</span>
                                        <div class="text-inner">
                                            <h6><?php echo wp_kses_post($title); ?></h6>
                                            <p>
                                                <?php echo wp_kses_post($des); ?>
                                            </p>                                            
                                        </div>
                                    </div>
                                </div> 
                                <div class="img">
                                    <img src="<?php echo esc_url($image); ?>" alt="">
                                </div>
                                </a>
                            </div>
                        <?php endfor; ?>
                    </div>

                </div>
                <?php endif; ?>


        </div>
    </section>
    <!-- End Discover opportunities section -->
    
    
    
    <!-- Start What distinguishes us section -->
    <section class="What-distinguishes-us ">
        <div class="container">
            <div class="section-title">
                <h6>
                    <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                    <span><?php ml_text('[:en]Our distinction[:ar] تميزنا'); ?> </span>
                </h6>
                <h4><?php echo esc_html(get_theme_option('des_tit')); ?></h4>
                <p><?php echo esc_html(get_theme_option('distin_des')); ?></p>
            </div>
            <div class="row">
                <?php 
                $distinguishes = get_theme_option('achi_rep_copy');
                if ($distinguishes):
                    foreach ($distinguishes as $item):
                ?>
                    <div class="col-lg-4">
                        <div class="dist-item wow">
                            <div class="img"><img src="<?php echo esc_url($item['icon']); ?>" alt=""></div>
                            <div class="dist-name">
                                <h5><?php echo esc_html($item['text']); ?></h5>
                                <p><?php echo esc_html($item['des']); ?></p>
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
    <!-- End What distinguishes us section -->

<!-- Start Virtual reality technology section 
<section class="reality-technology" id="reality_technology">
    <div class="container">
        <div class="section-title">
            <h6>
                <span> <?php ml_text('[:en]360° virtual tour[:ar]جولة افتراضية 360° '); ?> </span>
            </h6>
            <h4>
               <?php echo esc_html(get_theme_option('degree_tit')); ?>
            </h4>
            <p>
               <?php echo esc_html(get_theme_option('degree_des')); ?>
            </p>
        </div>
        <div class="card-slider owl-theme owl-carousel">
            <?php 
            $x = 0;
            if(have_rows('degree_rep', 'option')):
                while(have_rows('degree_rep', 'option')) : the_row();
                    $x++;
                    $title = get_sub_field('txt');
                    $image = get_sub_field('ima');
            ?>
            <div class="item">
                <div class="tech-item">
                    <a href="#" 
                       data-toggle="modal" 
                       data-target="#vr_modal" 
                       data-tour-id="<?php echo $x; ?>"> 
                        <div class="tech-num"><span>360&deg;</span></div>
                        <div class="eye-icon">
                            <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/eye.svg" alt="">
                        </div>
                        <div class="tech-img">
                            <img src="<?php echo esc_url($image); ?>" alt="">
                        </div>
                        <div class="name">
                            <h5><?php echo esc_html($title); ?></h5>
                        </div>
                    </a>
                </div>
            </div>
            <?php 
                endwhile;
            endif; 
            ?>
        </div>
    </div>
</section>
End Virtual reality technology section -->

<!-- Single reusable modal -->
<div class="modal fade" id="vr_modal" tabindex="-1" role="dialog" aria-labelledby="vrModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pop">
                <div class="popup-frame">
                    <div class="iframe-loader">
                        <div class="spinner"></div>
                        <p>Loading 360° Tour...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.popup-frame {
    position: relative;
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.iframe-loader {
    text-align: center;
}

.spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    margin: 0 auto 15px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.error-message {
    text-align: center;
    padding: 40px;
    color: #d9534f;
}
</style>



<section class="team-h">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h6>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_2029_3372)">
                            <path d="M6.61988 10.3268C6.5604 10.0963 6.44022 9.88585 6.27185 9.71748C6.10348 9.54911 5.89307 9.42893 5.6625 9.36945L1.57517 8.31547C1.50543 8.29568 1.44406 8.25368 1.40036 8.19584C1.35665 8.13801 1.33301 8.0675 1.33301 7.99501C1.33301 7.92252 1.35665 7.85201 1.40036 7.79418C1.44406 7.73635 1.50543 7.69435 1.57517 7.67455L5.6625 6.61991C5.89299 6.56048 6.10334 6.44041 6.27171 6.27216C6.44007 6.10391 6.5603 5.89364 6.61988 5.6632L7.67386 1.57586C7.69345 1.50585 7.73541 1.44417 7.79333 1.40024C7.85125 1.3563 7.92195 1.33252 7.99465 1.33252C8.06735 1.33252 8.13805 1.3563 8.19597 1.40024C8.25389 1.44417 8.29585 1.50585 8.31544 1.57586L9.36876 5.6632C9.42824 5.89376 9.54841 6.10417 9.71678 6.27255C9.88515 6.44092 10.0956 6.56109 10.3261 6.62057L14.4135 7.67389C14.4838 7.69327 14.5457 7.73519 14.5899 7.79319C14.6341 7.8512 14.658 7.9221 14.658 7.99501C14.658 8.06792 14.6341 8.13882 14.5899 8.19683C14.5457 8.25484 14.4838 8.29675 14.4135 8.31614L10.3261 9.36945C10.0956 9.42893 9.88515 9.54911 9.71678 9.71748C9.54841 9.88585 9.42824 10.0963 9.36876 10.3268L8.31478 14.4142C8.29518 14.4842 8.25323 14.5459 8.19531 14.5898C8.13739 14.6337 8.06668 14.6575 7.99398 14.6575C7.92129 14.6575 7.85058 14.6337 7.79266 14.5898C7.73474 14.5459 7.69279 14.4842 7.67319 14.4142L6.61988 10.3268Z" stroke="#B5A491" stroke-width="1.33247" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.3242 1.99854V4.66347" stroke="#B5A491" stroke-width="1.33247" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.6571 3.33105H11.9922" stroke="#B5A491" stroke-width="1.33247" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2.66504 11.3262V12.6586" stroke="#B5A491" stroke-width="1.33247" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.33149 11.9922H1.99902" stroke="#B5A491" stroke-width="1.33247" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_2029_3372">
                            <rect width="15.9896" height="15.9896" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                        <span><?php ml_text('[:en]Our designers[:ar] مصممينا'); ?> </span>
                    </h6>
                    <h4>
                       <?php echo esc_html(get_theme_option('heya_designers_tit')); ?>
                    </h4>
                    <p>
                       <?php echo esc_html(get_theme_option('heya_designers_des')); ?>
                    </p>
                </div>
                <div class="team-slider owl-carousel owl-theme">
                    
                    <?php 
                    $x = 0;
                    if(have_rows('heya_designers_rep', 'option')):
                        while(have_rows('heya_designers_rep', 'option')) : the_row();
                            $x++;
                            $name = get_sub_field('name');
                            $image = get_sub_field('ima');
                    ?>                    
                    
                    <div class="item">
                        <div class="team-block">
                            <div class="img">
                                <img src="<?php echo esc_url($image); ?>" class="only-des" alt="#" />
                                <img src="<?php echo esc_url($image); ?>" class="only-mob" alt="#" />
                            </div>
                            <div class="details">
                                <h3>
                                    <?php echo esc_html($name); ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    
                    <?php 
                        endwhile;
                    endif; 
                    ?>                    

                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Start partner section -->
    <section class="partner">
        <div class="container">
            <div class="section-title">
                <h6>
                    <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/star-icon.svg" alt="">
                    <span> <?php ml_text('[:en]Our partners[:ar]شركاؤنا'); ?> </span>
                </h6>
                <h4>
                   <?php echo esc_html(get_theme_option('part_tit')); ?>
                </h4>
                <p>
                   <?php echo esc_html(get_theme_option('part_des')); ?>
                </p>
            </div>
<div class="part-slider owl-carousel owl-theme wow animate__animated animate__fadeInUp">
<?php
$partners = get_theme_option('our_partners');

if ($partners) :
    foreach ($partners as $partner) :

        $logo = $partner['logo'] ?? '';
        $link = $partner['link'] ?? '';
?>
        <div class="item part-item">
            <div class="img">
                <a href="<?php echo esc_url($link ?: '#'); ?>" target="_blank">
                    <img src="<?php echo esc_url($logo); ?>" alt="">
                </a>
            </div>
        </div>
<?php
    endforeach;
endif;
?>
</div>
        </div>
    </section>
    <!-- End partner section -->



<?php get_footer(); ?>

