<?php
/**
 * The template for displaying archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ELRYAD
 */

get_header();
?>

    <!-- Start Breadcrumb -->
    <section class="breadcrumb" style="background-image: url(<?php if(get_field('breadcrumb_page')): the_field('breadcrumb_page'); else: the_field('g_breadcrumb', 'option'); endif;?>);">
        <div class="container">
            <div class="row">
                <!-- Col -->
                <div class="col-12">
                    <div class="text-bread">
                        <h1> <?php the_archive_title(); ?>  </h1>
                    </div>
                </div>
                <!-- /Col -->
            </div>
        </div>
    </section>
    <!-- End Breadcrumb -->


        <!-- Start Doctors-page  -->
        <section class="doctors-page  body-inner">
        <div class="container">
            <div class="row">
                <!-- Col -->
                <div class="col-md-12 wow animate__animated animate__swing">
                    <div class="title-sec title-center">
                        <h3><?php the_archive_title(); ?> </h3>
                    </div>
                </div>
                <!-- /Col -->

                <?php if ( have_posts() ) : 
                    /* Start the Loop */
                    while ( have_posts() ) : the_post(); ?>  

                <!-- Col -->
                <div class="col-md-4 col-sm-12 wow animate__animated animate__zoomInDown">
                    <div class="dr-block">
                        <div class="img-block">
                            <a href="<?php the_permalink();?>" class="img">
                                <img src="<?= get_the_post_thumbnail_url($post->ID, 'full'); ?>" />
                            </a>
                        </div>
                        <div class="details">
                            <div class="name">
                                <h3> <?php the_title(); ?> </h3>
                            </div>
                            <p>
                            <?php echo wp_trim_words( get_the_content(), $num_words = 10, $more = '' ); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /Col -->

                <?php endwhile; endif; ?>

                <!-- pagination -->
                <div class="col-md-12 col-sm-12 wow animate__animated animate__zoomInDown">
                   <?php echo sa_get_bootstrap_paginate_links(); ?>
                </div>
                <!-- /pagination -->

            </div>
        </div>
    </section>
    <!-- End Doctors-page -->

    <!-- Start Partners-h -->
    <section class="partners-h ">
        <div class="container ">
            <div class="row ">
                <!-- Col -->
                <div class="col-md-12 ">
                    <div class="title-sec wow animate__animated animate__zoomInDown ">
                        <h3> <?php _e('[:en]Success Partners[:ar]شركاء النجاح');?> </h3>
                        <span>  <?php _e('[:en]Success Partners[:ar]شركاء النجاح');?>  </span>
                    </div>
                </div>
                <!-- /Col -->
                <!-- Col -->
                <div class="col-md-12 ">
                    <div class="partners-slider owl-carousel owl-theme ">


                    <?php if( have_rows('success_partners', 'option') ): while( have_rows('success_partners', 'option') ) : the_row(); ?>
                        <!-- Item -->
                        <div class="item ">
                            <div class="team-block ">
                                <div class="img ">
                                    <img src="<?php the_sub_field('صورة', 'option'); ?>" />
                                </div>
                            </div>
                        </div>
                        <!-- /Item -->
                    <?php endwhile; endif;?>

                    </div>
                </div>
                <!-- /Col -->

                <!-- Col -->
                <div class="col-md-12">
                    <a href="<?php the_permalink(284);?>" class="btn wow animate__animated animate__zoomInUp">
                        <span>
                        <?php _e('[:en]Read more [:ar] إقرء المزيد');?>
                        </span>
                    </a>
                </div>
                <!-- /Col -->
            </div>
        </div>
    </section>
    <!-- End Partners-h -->


    <?php get_footer();