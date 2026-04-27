<?php
/**
 * Template Name: Projects Archive
 * Archive template for displaying all projects with category filtering + AJAX
 *
 * @package ELRYAD
 */

get_header();

// Get all categories with project counts
$categories = get_terms(array(
    'taxonomy'   => 'project_category',
    'hide_empty' => true,
));

// Get all statuses for the dropdown
$statuses = get_terms(array(
    'taxonomy'   => 'project_status',
    'hide_empty' => true,
));

// Get total projects count
$all_projects_count = wp_count_posts('project')->publish;
?>

<!-- --------------  breadcrumb-section  --------------------- -->
<div class="breadcrumb-section project_Page">
    <div class="breadcrumb-img">
        <img src="<?php if ( get_field('breadcrumb_page') ) : the_field('breadcrumb_page'); else : the_field('g_breadcrumb', 'option'); endif; ?>" alt="#" />
    </div>
    <div class="breadcrumb-info">
        <div class="container">
            <nav aria-label="breadcrumb">
                <h6>
                    <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                    <span><?php ml_text('[:en]Discover our projects[:ar]اكتشف مشاريعنا'); ?></span>
                </h6>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><?php echo get_theme_option('projects_bread_tit'); ?></li>
                    <li class="breadcrumb-item"><?php echo get_theme_option('projects_bread_des'); ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- -----------------------  page content  ---------------------- -->
<main class="pages-contant">
    <section class="project-page page-content">
        <div class="container">
            <div class="project-tabs">

                <!-- ================================================
                     TABS NAVIGATION
                     data-category drives the AJAX state.category
                ================================================ -->
                <ul class="nav nav-pills nav-product" id="pills-tab" role="tablist">

                    <!-- All Projects Tab -->
                    <li class="nav-item">
                        <a class="nav-link active"
                           id="pills-all-tab"
                           data-toggle="pill"
                           href="#pills-all"
                           role="tab"
                           aria-controls="pills-all"
                           aria-selected="true">
                            <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/pr-icone.svg" alt="">
                            <span><?php ml_text('[:en]All projects[:ar]جميع المشاريع'); ?></span>
                            <span class="p-num"><?php echo $all_projects_count; ?></span>
                        </a>
                    </li>

                    <?php foreach ( $categories as $category ) : ?>
                    <li class="nav-item">
                        <a class="nav-link"
                           id="pills-<?php echo esc_attr($category->slug); ?>-tab"
                           data-toggle="pill"
                           href="#pills-<?php echo esc_attr($category->slug); ?>"
                           role="tab"
                           aria-controls="pills-<?php echo esc_attr($category->slug); ?>"
                           aria-selected="false">
                            <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/pr-icone.svg" alt="">
                            <span><?php echo esc_html($category->name); ?></span>
                            <span class="p-num"><?php echo $category->count; ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>

                </ul><!-- /nav-pills -->

                <!-- ================================================
                     FILTER BAR
                     IDs must match project-filter.js selectors:
                       #filter-type, #filter-location, #filter-status
                ================================================ -->
                <div class="projects-search">
                    <div class="form-inner">
                        <form action="#" onsubmit="return false;">

                            <!-- Property type (project_category re-filter – optional) -->
                            <div class="form-group">
                                <select class="form-control" id="filter-type">
                                    <option value=""><?php ml_text('[:en]Property Type[:ar]نوع العقار'); ?></option>
                                    <?php foreach ( $categories as $cat ) : ?>
                                    <option value="<?php echo esc_attr($cat->slug); ?>">
                                        <?php echo esc_html($cat->name); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Location (ACF field – populated via AJAX) -->
                            <div class="form-group">
                                <select class="form-control" id="filter-location">
                                    <option value=""><?php ml_text('[:en]Area[:ar]المنطقة'); ?></option>
                                    <!-- Options injected by JS after page load -->
                                </select>
                            </div>

                            <!-- Status (project_status taxonomy) -->
                            <div class="form-group sort-select">
                                <select class="form-control" id="filter-status">
                                    <option value=""><?php ml_text('[:en]Search by Status[:ar]البحث حسب الحالة'); ?></option>
                                    <?php foreach ( $statuses as $status ) : ?>
                                    <option value="<?php echo esc_attr($status->slug); ?>">
                                        <?php echo esc_html($status->name); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </form>
                    </div>

                    <!-- Map button (unchanged) -->
                    <div class="lookMap">
                        <a data-toggle="modal" data-target="#mapModal">
                            <span><?php ml_text('[:en]View Map[:ar]انظر الخريطة'); ?></span>
                            <div class="icon">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.23111 7.15088L9.25102 3.27749C9.25141 3.18455 9.23338 3.09244 9.19799 3.0065C9.16259 2.92055 9.11053 2.84247 9.04481 2.77674C8.97908 2.71102 8.901 2.65896 8.81505 2.62356C8.72911 2.58817 8.637 2.57014 8.54406 2.57053C8.35805 2.57108 8.17982 2.64522 8.04829 2.77674C7.91676 2.90827 7.84262 3.08651 7.84207 3.27251L7.82713 6.83225L1.20112 0.206232C1.06908 0.0741902 0.889989 9.98904e-06 0.703254 9.85207e-06C0.516518 1.00523e-05 0.337431 0.0741903 0.205389 0.206232C0.0733471 0.338274 -0.000832869 0.517361 -0.000832901 0.704096C-0.000832932 0.890832 0.0733473 1.06992 0.205389 1.20196L6.86127 7.85785L3.26171 7.85287C3.16877 7.85249 3.07667 7.87051 2.99072 7.90591C2.90477 7.9413 2.82669 7.99336 2.76096 8.05908C2.69524 8.12481 2.64318 8.2029 2.60779 8.28884C2.57239 8.37479 2.55437 8.46689 2.55475 8.55984C2.55437 8.65278 2.57239 8.74489 2.60779 8.83083C2.64318 8.91678 2.69524 8.99486 2.76096 9.06059C2.82669 9.12631 2.90477 9.17837 2.99072 9.21377C3.07666 9.24916 3.16877 9.26718 3.26171 9.2668L7.12016 9.26182C7.67992 9.26148 8.21664 9.03896 8.61244 8.64316C9.00825 8.24735 9.23076 7.71063 9.23111 7.15088Z" fill="#374957"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div><!-- /projects-search -->

                <!-- ================================================
                     TAB CONTENT PANES
                     Each pane holds ONE .row – AJAX replaces its innerHTML.
                     Initial server-side render for "All" pane only;
                     category panes start empty and are filled on first click.
                ================================================ -->
                <div class="tab-content" id="pills-tabContent">

                    <!-- All Projects (initial SSR) -->
                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                        <div class="row">
                            <?php
                            $all_projects = new WP_Query(array(
                                'post_type'      => 'project',
                                'posts_per_page' => (int) ( get_theme_option('projects_per_page') ?: 9 ),
                                'paged'          => 1,
                            ));
                            if ( $all_projects->have_posts() ) :
                                while ( $all_projects->have_posts() ) : $all_projects->the_post();
                                    set_query_var('card_col_class', 'col-lg-4 col-md-6');
                                    get_template_part('template-parts/content', 'project-card');
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>

                    <!-- Category panes – empty shells, filled by AJAX on tab click -->
                    <?php foreach ( $categories as $category ) : ?>
                    <div class="tab-pane fade"
                         id="pills-<?php echo esc_attr($category->slug); ?>"
                         role="tabpanel"
                         aria-labelledby="pills-<?php echo esc_attr($category->slug); ?>-tab">
                        <div class="row">
                            <!-- loaded via AJAX -->
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div><!-- /tab-content -->

                <!-- ================================================
                     PAGINATION WRAPPER
                     Rebuilt by JS after every AJAX response
                ================================================ -->
                <div id="projects-pagination" class="projects-pagination" style="display:none;"></div>

            </div><!-- /project-tabs -->
        </div><!-- /container -->
    </section>


    <!-- Register Interest Section (unchanged) -->
    <section class="register-sec">
        <div class="container">
            <div class="s-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="single-p-info">
                            <h3><?php echo ml_get('[:en]Register your interest in residential projects[:ar]سجل اهتمامك مشاريع سكنية'); ?></h3>
                        </div>
                        <?php echo do_shortcode('[contact-form-7 id="ad66b02" title="نموذج سجل اهتمامك"]'); ?>
                    </div>
                    <div class="col-lg-6">
                        <div class="register-img">
                            <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/singl-p.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- Map Modal (unchanged) -->
<div class="modal fade mapModal" id="mapModal"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
                <div class="modal-map-inner">
                    <?php echo get_theme_option('iframe_dynmaic_map'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>