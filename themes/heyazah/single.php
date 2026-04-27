<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ELRYAD
 */

get_header();
?>
    <!-- --------------       breadcrumb section --------------------- -->
    <div class="breadcrumb-section" style="background-image: url('../assets/images/slider-1.jpg');">
        <div class="breadcrumb-info">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo home_url();?>"> الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> <?php the_title();?> </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- -------------------------------  page content ------------------------   -->
    <!-- Start service single -->
    <section class="single_blog_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single_blog_img"><img src="<?= get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="">
                        <div class="blog_date">
                            <img src="../assets/images/Calendar.svg" alt="">
                            <span><?php echo get_the_date( 'd/m/Y' ); ?> </span>
                        </div>
                    </div>
                    <div class="single_blog_details">
                        <h3> <?php the_title();?></h3>
                        <?php the_content();?>
                    </div>

                </div>
            </div>
        </div>
    </section>






<?php get_footer();