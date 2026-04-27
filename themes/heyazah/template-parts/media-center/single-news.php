<?php



// ACF Fields
$meta           = get_field('news_meta');
$main_image     = get_field('main_image');
$intro_title    = get_field('intro_title');
$news_content   = get_field('news_content');
$quote          = get_field('highlighted_quote');
$facilities     = get_field('facilities');
$facility_imgs  = get_field('facility_images');
$payment_plan   = get_field('payment_plan');
$delivery_date  = get_field('delivery_date');
$sales_content  = get_field('sales_content');
$cta            = get_field('cta');

// Build reading source ONLY from ACF
$reading_source = '';

// Intro
if (!empty($intro_title)) {
    $reading_source .= ' ' . $intro_title;
}

// Main content
if (!empty($news_content)) {
    $reading_source .= ' ' . wp_strip_all_tags($news_content);
}

// Quote
if (!empty($quote['quote_text'])) {
    $reading_source .= ' ' . $quote['quote_text'];
}

// Facilities
if (!empty($facilities)) {
    foreach ($facilities as $item) {
        if (!empty($item['facility'])) {
            $reading_source .= ' ' . $item['facility'];
        }
    }
}

// Sales content
if (!empty($sales_content)) {
    $reading_source .= ' ' . wp_strip_all_tags($sales_content);
}

// Final reading time
$reading_time = !empty(trim($reading_source))
    ? estimate_reading_time($reading_source)
    : '';

?>




<main class="pages-contant">
<section class="single-new-page page-content">
<div class="container">
<div class="row">
<div class="col-lg-10">
<div class="singlenewcontent">

<!-- ===== TITLE ===== -->
<div class="single-new-title">
    <h6>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/single-new-i.svg" alt="">
        <span><?php echo esc_html($meta['news_label']); ?></span>
    </h6>

    <h2><?php the_title(); ?></h2>

    <div class="title-details">
        <ul>
            <li>
                <div class="img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/user.svg">
                </div>
                <div class="detail">
                    <span class="key"><?php ml_text('[:en]By[:ar]بقلم'); ?></span>
                    <span class="data"><?php echo esc_html($meta['author_name']); ?></span>
                </div>
            </li>
            <li>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cal-s-new.svg">
                <span class="data"><?php echo get_the_date('F j, Y'); ?></span>
            </li>
            <?php if (!empty($reading_time)): ?>
            <li>
                <i class="fal fa-clock"></i>
                <span class="data"><?php echo esc_html($reading_time); ?></span>
            </li>
            <?php endif; ?>

        </ul>
    </div>
<?php
$url   = urlencode(get_permalink());
$title = urlencode(get_the_title());
?>

    <div class="title-soch-icones">
        <span> <?php ml_text('[:en]Share[:ar]شارك'); ?>:</span>

        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/face-i.svg">
        </a>

        <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>" target="_blank">
          <svg xmlns="http://www.w3.org/2000/svg" fill="#7C7C7C" class="bi bi-twitter-x" viewBox="0 0 16 16" id="Twitter-X--Streamline-Bootstrap" height="16" width="16" style="fill: #7C7C7C;">
<desc>
Twitter X Streamline Icon: https://streamlinehq.com
</desc>
<path d="M12.6 0.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867 -5.07 -4.425 5.07H0.316l5.733 -6.57L0 0.75h5.063l3.495 4.633L12.601 0.75Zm-0.86 13.028h1.36L4.323 2.145H2.865z" stroke-width="1"></path>
</svg>
        </a>

        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $url; ?>" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/li-i.svg">
        </a>

        <a href="#" class="copy-link" data-link="<?php the_permalink(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/link.svg">
        </a>
    </div>
</div>

<!-- ===== IMAGE ===== -->
<?php if ($main_image): ?>
<div class="single-new-img">
    <img src="<?php echo esc_url($main_image['url']); ?>" alt="">
</div>
<?php endif; ?>

<div class="project-s-details">

<?php if ($intro_title): ?>
<div class="new-title">
    <h5><?php echo esc_html($intro_title); ?></h5>
</div>
<?php endif; ?>

<?php echo apply_filters('the_content', $news_content); ?>

<?php if ($quote): ?>
<div class="project-m-word">
    <p><?php echo esc_html($quote['quote_text']); ?></p>
    <h6><?php echo esc_html($quote['quote_author']); ?></h6>
</div>
<?php endif; ?>

<!-- ================= FACILITIES ================= -->
<?php if ($facilities): ?>
<div class="fac-and-serv">
    <h6> <?php ml_text('[:en]Facilities and services[:ar]المرافق والخدمات'); ?> </h6>
    <span><?php the_field('facilities_services_des');?></span>
    <ul>
        <?php foreach ($facilities as $item): ?>
            <li><?php echo esc_html($item['facility']); ?></li>
        <?php endforeach; ?>
    </ul>

    <?php if ($facility_imgs): ?>
    <div class="serandfac-imgs">
        <div class="row">
            <?php foreach ($facility_imgs as $img): ?>
            <div class="col-lg-6">
                <div class="fac-img">
                    <img src="<?php echo esc_url($img['image']['url']); ?>">
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ================= PAYMENT ================= -->
<?php if ($payment_plan): ?>
<div class="payment-plans">
    <h6> <?php ml_text('[:en]Flexible payment plans[:ar]خطط السداد المرنة '); ?></h6>
    <p><?php the_field('payment_plan_counters_des');?></p>
    <div class="row">
        <?php foreach ($payment_plan as $plan): ?>
        <div class="col-lg-4">
            <div class="pay-pane-item">
                <div class="count-block">
                    <div class="details">
                        <div class="counter-name">
                            <h3 class="counter-item">
                                <span class="plus">+</span>
                                <span class="odometer" data-odometer-final="<?php echo esc_html($plan['value']); ?>"></span>
                            </h3>
                            <h6> <?php echo esc_html($plan['label']); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
        <?php endforeach; ?>
        <!-- Delivery date -->
        <div class="col-lg-4">
            <div class="pay-pane-item">
                <div class="count-block">
                    <div class="details">
                        <div class="counter-name">
                            <h3 class="counter-item">
                                <?php echo esc_html($delivery_date); ?>
                            </h3>
                            <h6> <?php ml_text('[:en]Delivery date[:ar]موعد التسليم'); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</div>
<?php endif; ?>

<!-- ================= SALES ================= -->
<?php if ($sales_content): ?>
<div class="start-of-sale">
    <?php echo apply_filters('the_content', $sales_content); ?>
</div>
<?php endif; ?>

<!-- ================= CTA ================= -->
<?php if ($cta): ?>
<div class="are-ypu-inters">
    <h4><?php echo esc_html($cta['title']); ?></h4>
    <p><?php echo esc_html($cta['text']); ?></p>
    <div class="inters-btns">
        <a href="<?php echo esc_url($cta['register_link']); ?>" class="reg-now"> <?php ml_text('[:en]Register your interest[:ar]سجل اهتمامك'); ?></a>
        <a href="<?php echo esc_url($cta['book_link']); ?>" class="book-now"><?php ml_text('[:en]Book an appointment[:ar]احجز موعد'); ?></a>
    </div>
</div>
<?php endif; ?>

</div>
</div>
</div>
</div>
</section>
</main>
