<?php /* Template Name:    Facilities Management  */ ?>

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
                        <li class="breadcrumb-item"><?php echo strip_tags(get_the_content()); ?> </li>
                    </ol>
                </nav>
            </div> 
        </div>
    </div>
    <!-- -----------------------  page content  ----------------------   -->
    <main class="pages-contant">


        <section class="contact-page invest-page facil-page body-inner page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-form">
                            <?= do_shortcode( '[contact-form-7 id="f8fda2f" title="نموذج ادارة المرافق"]' );?>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>

<?php get_footer(); ?>


