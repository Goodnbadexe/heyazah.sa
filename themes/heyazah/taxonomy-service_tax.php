<?php get_header();?>
<?php
$current_term = get_queried_object();
?>

    <main class="main-content">
        <!-- Start Breadcrumb -->
        <section class="breadcrumb-h">
            <div class="overlay-img">
                <?php 
                $breadcrumb_img = get_field('breadcrumb_page') ?: get_field('g_breadcrumb', 'option');
                if ($breadcrumb_img): 
                ?>
                    <img src="<?php echo esc_url($breadcrumb_img); ?>" alt="<?php single_cat_title(); ?>" />
                <?php endif; ?>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-bread">
                            <h1> <?php single_cat_title(); ?> </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb -->
        
    <!-- الوعى الشخصى-->
    <?php if ( $current_term && $current_term->term_id == 21 ) : ?>
    
        <!-- Start Single-scales-page -->
        <section class="single-scales-page body-inner">
            <div class="container">
                <div class="row">
                    <!-- Col -->
                    <div class="col-md-12">
                        <div class="p-pages">
                            <p>
                                <?php echo $current_term->description;?>
                            </p>
                        </div>
                    </div>
                    <!-- /Col -->

                    <!-- Col -->
                    <div class="col-md-12">
                        <div class="single-scales-inner">
                            <div class="single-scales-title">
                                <h3>
                                    <?php single_cat_title(); ?>
                                </h3>
                            </div>
                            <div class="single-scales-lists">
                                
                                


                            <?php    if (have_posts()) :
                            while (have_posts()) : the_post(); ?>                       
                                
                                <!-- Item -->
                                <div class="item">
                                    <h3>
                                        <?php the_title();?> 
                                    </h3>
                                    <div class="item-btn">
                                        <a href="<?php the_permalink(); ?>" class="btn">
                                            <span>
                                                <?php _e('[:en]Start Now[:ar]ابدأ الان'); ?>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <!-- /Item -->
                                         <?php endwhile; ?>

                                <?php endif;?> 

                            </div>
                        </div>
                    </div>
                    <!-- /Col -->
                </div>
            </div>
        </section>
        <!-- End Single-scales-page -->    
    
    
        <?php else: ?>   
          <!-- Start Scales-page -->
        <section class="scales-page body-inner">
            <div class="container">
                <div class="row">

<?php
$children = get_terms([
    'taxonomy'   => 'service_tax',
    'parent'     => $current_term->term_id,
    'hide_empty' => false,
]);

// If children exist: Show child terms
if (!empty($children)) : ?>

    <?php foreach ($children as $child) : 
        $term_link = get_term_link($child);
        $image = get_field('term_img', 'service_tax_' . $child->term_id); // ACF term image
    ?>
        <div class="col-md-6">
            <div class="consul-block scale-block position-relative">
                <a href="<?= esc_url($term_link); ?>" class="link-block"></a>
                <?php if ($image): ?>
                <div class="img">
                    <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($child->name); ?>" />
                </div>
                <?php endif; ?>
                <div class="details">
                    <h3><?= esc_html($child->name); ?></h3>
                    <p><?= strip_tags(term_description($child->term_id)); ?></p>
                    <a href="<?= esc_url($term_link); ?>" class="readMore">
                        <?php _e('[:en]Go to the group[:ar]الإنتقال الى المجموعة'); ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

<?php 
// Else show posts if no children
else : ?>
    
                     <!-- Col -->
                    <div class="col-md-12">
                        <div class="p-pages">
                            <p>
                                <?php echo $current_term->description;?>
                            </p>
                        </div>
                    </div>
                    <!-- /Col -->   
    
<?php    if (have_posts()) :
        while (have_posts()) : the_post(); ?>




            <div class="col-md-4">
                <div class="consul-block scale-block position-relative">
                    <a href="<?php the_permalink(); ?>" class="link-block"></a>
                    <div class="img">
                        <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="#" />
                    </div>
                    <div class="details">
                                <span class="sub-title">
                                     <?php echo $current_term->name;?>
                                </span>                        
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo strip_tags(get_the_excerpt()); ?></p>
                        
                        <a href="<?php the_permalink(); ?>" class="readMore">
                            <?php _e('[:en]More[:ar]المزيد'); ?>
                        </a>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

        <div class="col-md-12">
            <div class="mypagination">
                <?php custom_archive_pagination([
                    'mid_size' => 3,
                    'end_size' => 1,
                    'aria_label' => 'services pagination'
                ]); ?>
            </div>
        </div>

    <?php endif;
endif;
?>




                </div>
            </div>
        </section>
        <!-- End Scales-page -->
        <?php endif;?>
    </main>
        
        
        
    <?php get_footer();?>