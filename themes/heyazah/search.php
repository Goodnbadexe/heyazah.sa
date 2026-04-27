<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ELRYAD
 */

get_header();
?>

    <!-- Start braedcrumb -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-img">
            <img src="<?php if(get_field('breadcrumb_page')): the_field('breadcrumb_page'); else: the_field('g_breadcrumb', 'option'); endif;?>" alt="#" />            
        </div>
        <div class="breadcrumb-info">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <h6>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                        <span>  <?php ml_text('[:en]Search Results[:ar]نتائج البحث'); ?></span>
                    </h6>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"> 
                            <?php if(is_rtl()){
                            printf( esc_html__( 'نتائج البحث عن: %s', 'ELRYAD' ), '' . get_search_query() . '' );
                            }else{
                                printf( esc_html__( 'Search Results for: %s', 'ELRYAD' ), '' . get_search_query() . '' );
                            } ?>                            
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>    
    <!-- end braedcrumb -->




    <main class="pages-contant">
        <section class="media-center page-content">
            <div class="container">
            <!-- /* Start page Content */ -->
            <?php if ( have_posts() ) : 
                global $wp_query;
                $total_results = $wp_query->found_posts;
                $max_pages = $wp_query->max_num_pages;
            ?>
                <div class="search-results-info">
                    <p class="search-count">
                        <?php 
                        if (is_rtl()) {
                            printf(esc_html__('تم العثور على %s نتيجة', 'ELRYAD'), '<strong>' . $total_results . '</strong>');
                        } else {
                            printf(esc_html__('Found %s results', 'ELRYAD'), '<strong>' . $total_results . '</strong>');
                        }
                        ?>
                    </p>
                </div>
                
                <div class="row search-results-container">
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', 'search' );

                    endwhile;
                    ?>
                </div>
                
                <!-- Load More Button -->
                <?php if ($max_pages > 1): ?>
                    <div class="read-more load-more-wrapper text-center mt-4">
                        <a class="load-more-search" href="javascript:void(0)" 
                                data-search-query="<?php echo esc_attr(get_search_query()); ?>" 
                                data-page="1"
                                data-max-pages="<?php echo $max_pages; ?>">
                            <span> <?php ml_text('[:en]Load More[:ar]عرض المزيد[:]'); ?> </span>
                            <i class="fal fa-long-arrow-left"></i>
                        </a>
                    </div>
                <?php endif; ?>
           
            <?php else : ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php get_template_part( 'template-parts/content', 'none' ); ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- /* End page Content */ -->
           
        </div>
    </section>



<?php
get_footer();
