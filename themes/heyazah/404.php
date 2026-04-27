<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ELRYAD
 */

get_header();
?>


    <!-- Start braedcrumb -->
    <div class="breadcrumb-section" style="background-image: url(<?php if(get_field('breadcrumb_page')): the_field('breadcrumb_page'); else: the_field('g_breadcrumb', 'option'); endif;?>);">
        <div class="breadcrumb-info">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= home_url();?>"> <?php _e('[:en]Home[:ar]الرئيسية');?> </a></li>
                        <li class="breadcrumb-item active" aria-current="page"> 
						404
						</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end braedcrumb -->

  <!-- Start Page-Content -->

  <div class="error-page page-content body-inner">
    <div class="error-layout col-xs-12">
      <div class="container">
        <div class="inner_ro">
          <span>404</span>

          <div class="outer">
            <h4> <?php _e("<!--:en--> Page not found! <!--:--><!--:ar--> الصفحة غير موجودة!  <!--:-->"); ?></h4>
            <p>
              <?php _e("<!--:en--> Unfortunately the search result is not found, you can return to the home page <!--:--><!--:ar--> للأسف نتيجة البحث غير موجودة , يمكنك الرجوع للصفحة الرئيسية <!--:-->"); ?>
              <a class="" href="<?php echo get_home_url()?>">
                 <?php _e("<!--:en--> Press here <!--:--><!--:ar--> اضغط هنا  <!--:-->"); ?></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Start Page-Content -->


<?php
get_footer();
