<?php
/**
 * The template for displaying taxonomay 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ELRYAD
 */

get_header();
?>

   <!-- Start Breadcrumb -->
   <section class="breadcrumb" style="background-image: url(<?php the_field('g_breadcrumb', 'option');?>)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-bread">
                        <h1> <?php single_cat_title(); ?> </h1>
                        <ul>
                            <li>
                                <a href="<?= home_url();?>"> <?php _e('[:en]Home[:ar]الرئيسية');?></a>
                            </li>
                            <li>
                                <span> <?php single_cat_title(); ?> </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Breadcrumb -->

    <!-- Start Team-page -->
    <section class="team-page body-inner">
        <div class="container">
            <div class="row">
                <!-- Col -->
                <div class="col-md-12 col-sm-12 wow animate__animated animate__zoomInDown">
                    <div class="title title-page">
                        <h3> <?php single_cat_title(); ?> </h3>
                    </div>
                </div>
                <!-- /Col -->

                <?php if ( have_posts() ) :
                            /* Start the Loop */
                            while ( have_posts() ) : the_post(); ?>
                    <!-- Col -->
                    <div class="col-md-3 col-sm-12">
                        <div class="team-block">
                            <div class="img">
                            <a href="<?php the_permalink();?>" style="display:block">
                                <img src="<?= get_the_post_thumbnail_url($post->ID, 'full'); ?>" />
                                </a>
                            </div>
                            <div class="details">
                                <a href="<?php the_permalink();?>"><h3 class="name"> <?php the_title(); ?> </h3></a>
                            </div>
                        </div>
                    </div>
                    <!-- /Col -->
                <?php endwhile; endif;?>

                <div class="col-md-12">
        <?php echo sa_get_bootstrap_paginate_links(); ?>
        </div>

            </div>
        </div>
    </section>
    <!-- End Team-page -->

    <?php get_footer();