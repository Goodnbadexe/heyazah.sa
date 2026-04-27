<?php get_header(); ?>

    <!-- --------------  breadcrumb-section  --------------------- -->

    <div class="breadcrumb-section project_Page">
        <div class="breadcrumb-img">
            <img src="<?php if(get_field('breadcrumb_page')): the_field('breadcrumb_page'); else: the_field('g_breadcrumb', 'option'); endif;?>" alt="#" />            
        </div>
        <div class="breadcrumb-info">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <h6>
                        <img src="<?php echo ELRYAD_THEME_URL; ?>/assets/images/title-icon.svg" alt="">
                        <span><?php echo get_field('unit_page_breadcrumb_title'); ?></span>
                    </h6>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><?php echo get_field('unit_page_breadcrumb_subtitle'); ?></li>
                        <li class="breadcrumb-item"><?php echo get_field('unit_page_breadcrumb_description'); ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- -----------------------  page content  ----------------------   -->
    <main class="pages-contant">
        
        
        
        <section class="page-content body-inner single-unite">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="single-unite-inner">
                            <div class="all-imgs-single row">
                                <div class="col-md-9">
                                    <div class="video-single">
                                        <div class="img">
                                            <img src="<?php the_field('video_image_thumbnail'); ?>" alt="#" />
                                        </div>
                                        <a href="<?php the_field('youtube_url'); ?>" data-fancybox>
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.24998 13.5384L13.5384 9.49996L7.24998 5.46154V13.5384ZM9.50164 18.9999C8.18771 18.9999 6.95267 18.7506 5.79653 18.2519C4.64039 17.7533 3.63471 17.0765 2.77948 16.2217C1.92426 15.3668 1.2472 14.3616 0.748323 13.206C0.249441 12.0503 0 10.8156 0 9.50164C0 8.18771 0.24933 6.95267 0.74799 5.79653C1.24665 4.64039 1.9234 3.63471 2.77825 2.77948C3.6331 1.92426 4.63833 1.24721 5.79396 0.748323C6.94958 0.249441 8.18436 0 9.49829 0C10.8122 0 12.0473 0.24933 13.2034 0.74799C14.3595 1.24665 15.3652 1.9234 16.2204 2.77825C17.0757 3.6331 17.7527 4.63833 18.2516 5.79396C18.7505 6.94958 18.9999 8.18436 18.9999 9.49829C18.9999 10.8122 18.7506 12.0473 18.2519 13.2034C17.7533 14.3595 17.0765 15.3652 16.2217 16.2204C15.3668 17.0757 14.3616 17.7527 13.206 18.2516C12.0503 18.7505 10.8156 18.9999 9.50164 18.9999ZM9.49996 17.5C11.7333 17.5 13.625 16.725 15.175 15.175C16.725 13.625 17.5 11.7333 17.5 9.49996C17.5 7.26663 16.725 5.37496 15.175 3.82496C13.625 2.27496 11.7333 1.49996 9.49996 1.49996C7.26663 1.49996 5.37496 2.27496 3.82496 3.82496C2.27496 5.37496 1.49996 7.26663 1.49996 9.49996C1.49996 11.7333 2.27496 13.625 3.82496 15.175C5.37496 16.725 7.26663 17.5 9.49996 17.5Z" fill="#1F2937"/>
                                            </svg>
                                            <span>
                                                <?php ml_text('[:en]Play video[:ar]تشغيل الفيديو'); ?>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="imgs-single">
										
									<?php $gallery = get_field('side_images'); ?>
									<?php if($gallery): ?>
									<?php foreach($gallery as $image): ?>
										<div class="img">
											<a href="<?php echo esc_url($image); ?>" data-fancybox>
												<img src="<?php echo esc_url($image); ?>" alt="..." />
											</a>
										</div>
									<?php endforeach; ?>
									<?php endif; ?>
										
                                    </div>
                                </div>
                            </div>
                            
                            <div class="single-unite-content row">
                                <div class="col-md-8">
                                    <div class="single-content-inner">
                                        <div class="single-alert">
										<span>
										<?php
										$project_id = get_field('unit_project');

										if($project_id){

											$terms = get_the_terms($project_id, 'project_category');

											if(!empty($terms) && !is_wp_error($terms)){
												echo esc_html($terms[0]->name);
											}

										}
										?>
										</span>
                                            <span class="avriable">
                                    <?php
                                    $terms = get_the_terms(get_the_ID(), 'unit_status');
                                    
                                    if (!empty($terms) && !is_wp_error($terms)) :
                                        $term = $terms[0]; // first category
                                    ?>
                                    
                                           <?php echo esc_html($term->name); ?>
                                    
                                    <?php endif; ?>                                                 
                                            </span>
                                        </div>
                                        <div class="single-title">
                                            <h3>
                                                <?php // the_field('unit_code'); 
                                                the_field('unit_id');
                                                ?>
                                            </h3>
                                            <p>
												<?php the_field('unit_description'); ?>
                                            </p>
                                        </div>
                                        
                                        <div class="single-options">
                                            <div class="item">
                                                <span>
                                                    <?php ml_text('[:en]Total area[:ar]المساحة الإجمالية'); ?> 
                                                </span>
                                                <h4>
                                                    <div class="icon">
                                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M2.04614 14.8975C1.47435 14.8975 0.990379 14.6995 0.594228 14.3033C0.198076 13.9072 0 13.4232 0 12.8514V0.978464C0 0.552828 0.191344 0.256997 0.574031 0.0909735C0.956718 -0.0750502 1.29229 -0.013833 1.58075 0.274625L3.44611 2.13998L2.38459 3.2015L2.9692 3.78611L4.03071 2.72459L6.39993 5.0938L5.33841 6.15532L5.92302 6.73993L6.98453 5.67841L9.39221 8.08609L8.33069 9.1476L8.9153 9.73221L9.97682 8.67069L12.346 11.0399L11.2845 12.1014L11.8691 12.686L12.9306 11.6245L14.6422 13.336C14.9242 13.6181 14.9822 13.9488 14.8162 14.3283C14.6502 14.7078 14.3575 14.8975 13.9383 14.8975H2.04614ZM2.53843 12.6668H10.5307L2.23071 4.36684V12.3591C2.23071 12.4489 2.25956 12.5226 2.31726 12.5803C2.37495 12.638 2.44868 12.6668 2.53843 12.6668Z" fill="#9CA3AF"/>
                                                        </svg>
                                                    </div>
                                                    <?php the_field('unit_area'); ?> <?php ml_text('[:en]m²[:ar]م²'); ?>
                                                </h4>
                                            </div>
                                            
                                            <div class="item">
                                                <span>
                                                   <?php ml_text('[:en]Number of rooms[:ar]عدد الغرف'); ?> 
                                                </span>
                                                <h4>
                                                    <div class="icon">
                                                        <svg width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M0 12.4999V6.99993C0 6.62686 0.0884613 6.265 0.265384 5.91436C0.442307 5.56372 0.687179 5.27558 1 5.04994V2.49996C1 1.80126 1.24198 1.20992 1.72595 0.725951C2.20992 0.241984 2.80126 0 3.49996 0H7.74998C8.11408 0 8.44036 0.0708333 8.72882 0.2125C9.01728 0.354167 9.27433 0.55 9.49996 0.8C9.7256 0.55 9.98265 0.354167 10.2711 0.2125C10.5596 0.0708333 10.8858 0 11.2499 0H15.5C16.1987 0 16.79 0.241984 17.274 0.725951C17.7579 1.20992 17.9999 1.80126 17.9999 2.49996V5.04994C18.3127 5.27558 18.5576 5.56372 18.7345 5.91436C18.9115 6.265 18.9999 6.62686 18.9999 6.99993V12.4999H17.5V10.4999H1.49996V12.4999H0ZM10.2499 4.49996H16.5V2.49996C16.5 2.21663 16.4041 1.97913 16.2125 1.78746C16.0208 1.5958 15.7833 1.49996 15.5 1.49996H11.2499C10.9666 1.49996 10.7291 1.5958 10.5374 1.78746C10.3458 1.97913 10.2499 2.21663 10.2499 2.49996V4.49996ZM2.49996 4.49996H8.74998V2.49996C8.74998 2.21663 8.65415 1.97913 8.46248 1.78746C8.27081 1.5958 8.03332 1.49996 7.74998 1.49996H3.49996C3.21663 1.49996 2.97913 1.5958 2.78746 1.78746C2.5958 1.97913 2.49996 2.21663 2.49996 2.49996V4.49996ZM1.49996 8.99993H17.5V6.99993C17.5 6.71659 17.4041 6.47909 17.2125 6.28743C17.0208 6.09576 16.7833 5.99993 16.5 5.99993H2.49996C2.21663 5.99993 1.97913 6.09576 1.78746 6.28743C1.5958 6.47909 1.49996 6.71659 1.49996 6.99993V8.99993ZM17.5 8.99993H1.49996C1.49996 8.99993 1.5958 8.99993 1.78746 8.99993C1.97913 8.99993 2.21663 8.99993 2.49996 8.99993H16.5C16.7833 8.99993 17.0208 8.99993 17.2125 8.99993C17.4041 8.99993 17.5 8.99993 17.5 8.99993Z" fill="#9CA3AF"/>
                                                        </svg>
                                                    </div>
                                                    <?php the_field('unit_bedrooms'); ?> <?php ml_text('[:en]rooms[:ar]غرف'); ?>
                                                </h4>
                                            </div>
                                            
                                            <div class="item">
                                                <span>
                                                    <?php ml_text('[:en]Restrooms[:ar]دورات المياه'); ?>
                                                </span>
                                                <h4>
                                                    <div class="icon">
                                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4.55766 7.02885C4.07177 7.02885 3.65863 6.85844 3.31825 6.51761C2.97787 6.17679 2.80768 5.76708 2.80768 5.28848C2.80768 4.80459 2.97787 4.39035 3.31825 4.04577C3.65863 3.70118 4.07177 3.52888 4.55766 3.52888C5.04355 3.52888 5.45669 3.70072 5.79707 4.04439C6.13745 4.38806 6.30764 4.8012 6.30764 5.2838C6.30764 5.76641 6.13745 6.1779 5.79707 6.51828C5.45669 6.85866 5.04355 7.02885 4.55766 7.02885ZM2.80768 18.9999C2.52434 18.9999 2.28684 18.9009 2.09518 18.7028C1.90351 18.5047 1.80768 18.264 1.80768 17.9807C1.30255 17.9807 0.874992 17.8018 0.524995 17.444C0.174998 17.0863 0 16.6562 0 16.1538V10.9231H2.80768V10.1635C2.80768 9.58782 3.00672 9.09776 3.40479 8.69327C3.80286 8.28879 4.28972 8.08654 4.86536 8.08654C5.18587 8.08654 5.48459 8.15481 5.76151 8.29135C6.03843 8.42789 6.28715 8.61283 6.50766 8.84616L7.71534 10.2135C7.84867 10.3486 7.97784 10.4753 8.10284 10.5936C8.22784 10.7119 8.36534 10.8217 8.51534 10.9231H15.5V2.61921C15.5 2.31536 15.3958 2.05286 15.1875 1.8317C14.9791 1.61054 14.7262 1.49996 14.4288 1.49996C14.2926 1.49996 14.1621 1.52881 14.0372 1.5865C13.9124 1.6442 13.7987 1.72433 13.6961 1.82689L12.4461 3.09132C12.5294 3.37792 12.5461 3.66031 12.4961 3.93848C12.4461 4.21665 12.3461 4.47561 12.1961 4.71536L9.79227 2.26154C10.0256 2.10955 10.2756 2.01244 10.5423 1.97022C10.8089 1.928 11.0756 1.95756 11.3423 2.05888L12.5923 0.792303C12.8371 0.543738 13.1164 0.349546 13.4302 0.209727C13.7439 0.0699092 14.0768 0 14.4288 0C15.1505 0 15.7595 0.254165 16.2557 0.762495C16.7518 1.27083 16.9999 1.88973 16.9999 2.61921V10.9231H18.9999V16.1538C18.9999 16.6562 18.8249 17.0863 18.4749 17.444C18.1249 17.8018 17.6974 17.9807 17.1922 17.9807C17.1922 18.264 17.0964 18.5047 16.9047 18.7028C16.7131 18.9009 16.4756 18.9999 16.1922 18.9999H2.80768ZM1.80768 16.4807H17.1922C17.282 16.4807 17.3557 16.4487 17.4134 16.3846C17.4711 16.3205 17.5 16.2435 17.5 16.1538V12.423H1.49996V16.1538C1.49996 16.2435 1.52881 16.3205 1.58651 16.3846C1.6442 16.4487 1.71793 16.4807 1.80768 16.4807ZM1.80768 16.4807C1.71793 16.4807 1.6442 16.4807 1.58651 16.4807C1.52881 16.4807 1.49996 16.4807 1.49996 16.4807H17.5C17.5 16.4807 17.4711 16.4807 17.4134 16.4807C17.3557 16.4807 17.282 16.4807 17.1922 16.4807H1.80768Z" fill="#9CA3AF"/>
                                                        </svg>
                                                    </div>
                                                    <?php the_field('unit_bathrooms'); ?> <?php ml_text('[:en]Bathrooms[:ar]حمامات'); ?>
                                                </h4>
                                            </div>
                                            
                                            <div class="item">
                                                <span>
                                                    <?php ml_text('[:en]floor[:ar]الطابق'); ?>
                                                </span>
                                                <h4>
                                                    <div class="icon">
                                                        <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8.19225 17.1652L0 10.7999L1.22689 9.85762L8.19225 15.2499L15.1576 9.85762L16.3845 10.7999L8.19225 17.1652ZM8.19225 12.7307L0 6.36534L8.19225 0L16.3845 6.36534L8.19225 12.7307ZM8.19225 10.8153L13.9422 6.36534L8.19225 1.91534L2.44225 6.36534L8.19225 10.8153Z" fill="#9CA3AF"/>
                                                        </svg>
                                                    </div>
													<?php 
													$value = get_field('unit_floor_name');
													      $label = function_exists('qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage')
            ? qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage($value)
            : $value;
													?>
                                                    <?php echo $label; ?>
                                                </h4>
                                            </div>
                                        </div>
                                        
                                        <div class="single-more-details">
                                            <h3>
                                                <?php ml_text('[:en]Unit details[:ar]تفاصيل الوحدة'); ?>
                                            </h3>
										<?php if( have_rows('unit_details') ):
											while( have_rows('unit_details') ) : the_row(); ?>								
                                            <div class="item active">
                                                <h4>
                                                    <div class="icon">
                                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M2.04614 14.8975C1.47435 14.8975 0.990379 14.6995 0.594228 14.3033C0.198076 13.9072 0 13.4232 0 12.8514V0.978464C0 0.552828 0.191344 0.256997 0.574031 0.0909735C0.956718 -0.0750502 1.29229 -0.013833 1.58075 0.274625L3.44611 2.13998L2.38459 3.2015L2.9692 3.78611L4.03071 2.72459L6.39993 5.0938L5.33841 6.15532L5.92302 6.73993L6.98453 5.67841L9.39221 8.08609L8.33069 9.1476L8.9153 9.73221L9.97682 8.67069L12.346 11.0399L11.2845 12.1014L11.8691 12.686L12.9306 11.6245L14.6422 13.336C14.9242 13.6181 14.9822 13.9488 14.8162 14.3283C14.6502 14.7078 14.3575 14.8975 13.9383 14.8975H2.04614ZM2.53843 12.6668H10.5307L2.23071 4.36684V12.3591C2.23071 12.4489 2.25956 12.5226 2.31726 12.5803C2.37495 12.638 2.44868 12.6668 2.53843 12.6668Z" fill="#9CA3AF"/>
                                                        </svg>
                                                    </div>
                                                    <span>
                                                        <?php the_sub_field('num'); ?> <?php the_sub_field('txt'); ?>
                                                    </span>
                                                </h4>
                                            </div>
                                           <?php endwhile; endif;?>	
											
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="single-unit-sidebar">
                                        <div class="single-price">
                                            <h4>
                                               <?php ml_text('[:en]Unit price[:ar]سعر الوحدة'); ?>
											</h4>
                                            <h2>
												<span><?php echo number_format( get_field('unit_price') ); ?></span>
												<!--<span>1,803,820</span> -->
                                                <svg width="30" height="34" viewBox="0 0 30 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M18.4065 29.4445C17.8789 30.621 17.5302 31.898 17.3965 33.2369L28.5632 30.8499C29.0909 29.6737 29.4395 28.3966 29.5733 27.0576L18.4065 29.4445Z" fill="#009491"/>
                                                    <path d="M28.5603 23.6953C29.088 22.5191 29.4369 21.242 29.5704 19.9031L20.872 21.7633V18.1871L28.56 16.5441C29.0877 15.3679 29.4365 14.0908 29.5702 12.7518L20.8717 14.6106V1.74925C19.5388 2.50179 18.3551 3.50352 17.3928 4.68512V15.3544L13.914 16.098V0C12.5811 0.75228 11.3974 1.75427 10.4352 2.93587V16.8412L2.65127 18.5045C2.1236 19.6808 1.77453 20.9579 1.64063 22.2969L10.4352 20.4176V24.9211L1.01011 26.9352C0.482433 28.1116 0.133629 29.3886 0 30.7276L9.8654 28.6194C10.6685 28.4514 11.3587 27.9739 11.8075 27.317L13.6168 24.6196C13.8046 24.3406 13.914 24.0036 13.914 23.6411V19.6739L17.3928 18.9304V26.0828L28.5603 23.6953Z" fill="#009491"/>
                                                </svg>
                                            </h2>
                                        </div>
                                        
                                        <div class="single-unit-form" id="form-booking">
                                            <div class="sidebar-title">
                                                <h3>
                                                    <?php ml_text('[:en]Register your interest[:ar]سجل اهتمامك'); ?> 
                                                </h3>
                                                <p>
													<?php ml_text('[:en]One of our consultants will contact you as soon as possible.[:ar]سيقوم أحد مستشارينا بالتواصل معك في أقرب وقت.'); ?>
                                                </p>
                                            </div>
<?= do_shortcode( '[contact-form-7 id="77cb895" title="نموذج حجز الوحدة"]' );?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        

    </main>

<?php get_footer(); ?>
<?php
$unit_name = get_the_title();

$project_name = '';
$project_id = get_field('unit_project');
$project_name = get_the_title($project_id);?>


<script>
jQuery(document).ready(function($){

    var projectName = "<?php echo esc_js($project_name); ?>";
    var unitName = "<?php echo esc_js($unit_name); ?>";

    $('#project_name').val(projectName);
    $('#unit_name').val(unitName);

});
</script>

