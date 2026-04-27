<?php
/**
 * Usage Examples for WordPress Custom Pagination Functions
 * These examples show how to implement each pagination type
 */

// =============================================================================
// EXAMPLE 1: STANDARD ARCHIVE PAGINATION
// =============================================================================

// In your archive.php, category.php, tag.php, etc.
?>
<div class="blog-posts">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="post-item">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-excerpt"><?php the_excerpt(); ?></div>
            </article>
        <?php endwhile; ?>
        
        <?php 
        // Display pagination
        custom_archive_pagination(array(
            'mid_size' => 3,
            'end_size' => 1,
            'aria_label' => 'Blog posts pagination'
        )); 
        ?>
        
    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</div>

<?php
// =============================================================================
// EXAMPLE 2: CUSTOM POST TYPE PAGINATION
// =============================================================================

// Example: Portfolio archive with custom query
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$portfolio_query = new WP_Query(array(
    'post_type' => 'portfolio',
    'posts_per_page' => 6,
    'paged' => $paged,
    'meta_query' => array(
        array(
            'key' => 'featured',
            'value' => 'yes',
            'compare' => '='
        )
    )
));
?>

<div class="portfolio-grid">
    <?php if ($portfolio_query->have_posts()) : ?>
        <?php while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?>
            <div class="portfolio-item">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium'); ?>
                    <h3><?php the_title(); ?></h3>
                </a>
            </div>
        <?php endwhile; ?>
        
        <?php 
        // Display custom post type pagination
        custom_cpt_pagination($portfolio_query, array(
            'mid_size' => 2,
            'aria_label' => 'Portfolio pagination',
            'base_url' => get_post_type_archive_link('portfolio')
        )); 
        ?>
        
    <?php else : ?>
        <p>No portfolio items found.</p>
    <?php endif; ?>
    
    <?php wp_reset_postdata(); ?>
</div>


<?php
// =============================================================================
// EXAMPLE 3: ACF OPTIONS PAGE PAGINATION
// =============================================================================

// Example: Clients from ACF options page
$posts_per_page = 12;
$clients_data = get_acf_options_paginated('clients', $posts_per_page);
?>

<div class="clients-section">
    <h3>Our Clients</h3>
    
    <?php if (!empty($clients_data['items'])) : ?>
        <div class="clients-grid">
            <?php foreach ($clients_data['items'] as $client) : ?>
                <div class="client-item">
                    <?php if (!empty($client['logo'])) : ?>
                        <img src="<?php echo esc_url($client['logo']['url']); ?>" 
                             alt="<?php echo esc_attr($client['name']); ?>">
                    <?php endif; ?>
                    <h4><?php echo esc_html($client['name']); ?></h4>
                    <?php if (!empty($client['website'])) : ?>
                        <a href="<?php echo esc_url($client['website']); ?>" 
                           target="_blank" 
                           rel="noopener">Visit Website</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php 
        // Display options page pagination
        custom_acf_options_pagination(
            'clients', 
            $clients_data['total'], 
            $posts_per_page, 
            array(
                'aria_label' => 'Clients pagination',
                'mid_size' => 2
            )
        ); 
        ?>
        
    <?php else : ?>
        <p>No clients found.</p>
    <?php endif; ?>
</div>


<?php
// =============================================================================
// EXAMPLE 4: ACF PAGINATION
// =============================================================================

// Example: Related posts using ACF relationship field
$posts_per_page = 5;
$related_posts = get_acf_paginated_posts('related_posts', get_the_ID(), $posts_per_page);
?>

<div class="related-posts-section">
    <h3>Related Posts</h3>
    
    <?php if (!empty($related_posts['posts'])) : ?>
        <div class="related-posts-grid">
            <?php foreach ($related_posts['posts'] as $post) : setup_postdata($post); ?>
                <article class="related-post">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('thumbnail'); ?>
                        <h4><?php the_title(); ?></h4>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    </a>
                </article>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        
        <?php 
        // Display ACF pagination
        custom_acf_pagination(
            'related_posts', 
            $related_posts['total'], 
            $posts_per_page, 
            array(
                'aria_label' => 'Related posts pagination'
            )
        ); 
        ?>
        
    <?php else : ?>
        <p>No related posts found.</p>
    <?php endif; ?>
</div>

<?php
// =============================================================================
// EXAMPLE 5: ACF WITH AJAX (Advanced)
// =============================================================================
?>

<div id="ajax-posts-container">
    <?php
    $posts_per_page = 8;
    $team_members = get_acf_paginated_posts('team_members', get_the_ID(), $posts_per_page);
    ?>
    
    <div class="team-grid" id="team-members-grid">
        <?php if (!empty($team_members['posts'])) : ?>
            <?php foreach ($team_members['posts'] as $member) : setup_postdata($member); ?>
                <div class="team-member">
                    <?php the_post_thumbnail('medium'); ?>
                    <h4><?php the_title(); ?></h4>
                    <p><?php the_field('position'); ?></p>
                </div>
            <?php endforeach; wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
    
    <?php 
    custom_acf_pagination(
        'team_members', 
        $team_members['total'], 
        $posts_per_page, 
        array(
            'ajax' => true,
            'container_class' => 'team-pagination'
        )
    ); 
    ?>
</div>

<script>
jQuery(document).ready(function($) {
    // AJAX pagination for ACF fields
    $(document).on('click', '.team-pagination .page-link', function(e) {
        e.preventDefault();
        
        var page = $(this).data('page');
        if (!page) return;
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'load_acf_posts',
                page: page,
                field_name: 'team_members',
                post_id: <?php echo get_the_ID(); ?>,
                posts_per_page: <?php echo $posts_per_page; ?>
            },
            beforeSend: function() {
                $('#team-members-grid').addClass('loading');
            },
            success: function(response) {
                $('#team-members-grid').html(response.posts_html);
                $('.team-pagination').html(response.pagination_html);
                $('#team-members-grid').removeClass('loading');
            },
            error: function() {
                console.error('Failed to load posts');
                $('#team-members-grid').removeClass('loading');
            }
        });
    });
});
</script>

<?php
// =============================================================================
// AJAX HANDLER (Add to functions.php)
// =============================================================================

// AJAX handler for ACF pagination
add_action('wp_ajax_load_acf_posts', 'handle_acf_posts_ajax');
add_action('wp_ajax_nopriv_load_acf_posts', 'handle_acf_posts_ajax');

function handle_acf_posts_ajax() {
    $page = intval($_POST['page']);
    $field_name = sanitize_text_field($_POST['field_name']);
    $post_id = intval($_POST['post_id']);
    $posts_per_page = intval($_POST['posts_per_page']);
    
    // Temporarily set the page parameter
    $_GET['acf_page'] = $page;
    
    $paginated_posts = get_acf_paginated_posts($field_name, $post_id, $posts_per_page);
    
    ob_start();
    
    // Generate posts HTML
    if (!empty($paginated_posts['posts'])) {
        foreach ($paginated_posts['posts'] as $post) {
            setup_postdata($post);
            ?>
            <div class="team-member">
                <?php the_post_thumbnail('medium'); ?>
                <h4><?php the_title(); ?></h4>
                <p><?php the_field('position'); ?></p>
            </div>
            <?php
        }
        wp_reset_postdata();
    }
    
    $posts_html = ob_get_clean();
    
    // Generate pagination HTML
    ob_start();
    custom_acf_pagination(
        $field_name, 
        $paginated_posts['total'], 
        $posts_per_page, 
        array(
            'ajax' => true,
            'container_class' => 'team-pagination'
        )
    );
    $pagination_html = ob_get_clean();
    
    wp_send_json_success(array(
        'posts_html' => $posts_html,
        'pagination_html' => $pagination_html
    ));
}

// =============================================================================
// CUSTOMIZATION OPTIONS
// =============================================================================

// Example: Custom styling with additional classes
function custom_styled_pagination() {
    custom_archive_pagination(array(
        'mid_size' => 2,
        'end_size' => 1,
        'prev_text' => '<i class="fas fa-chevron-left"></i> Previous',
        'next_text' => 'Next <i class="fas fa-chevron-right"></i>',
        'aria_label' => 'Blog navigation'
    ));
}

// Example: Minimal pagination (only prev/next)
function minimal_pagination($query = null) {
    global $wp_query;
    $query = $query ? $query : $wp_query;
    
    $current_page = max(1, get_query_var('paged'));
    $total_pages = $query->max_num_pages;
    
    if ($total_pages <= 1) return;
    
    echo '<nav class="minimal-pagination">';
    echo '<ul class="pagination justify-content-between">';
    
    // Previous
    if ($current_page > 1) {
        $prev_link = get_pagenum_link($current_page - 1);
        echo '<li class="page-item">';
        echo '<a class="page-link" href="' . esc_url($prev_link) . '">← Previous</a>';
        echo '</li>';
    } else {
        echo '<li class="page-item invisible"><span class="page-link">← Previous</span></li>';
    }
    
    // Page info
    echo '<li class="page-item disabled">';
    echo '<span class="page-link">Page ' . $current_page . ' of ' . $total_pages . '</span>';
    echo '</li>';
    
    // Next
    if ($current_page < $total_pages) {
        $next_link = get_pagenum_link($current_page + 1);
        echo '<li class="page-item">';
        echo '<a class="page-link" href="' . esc_url($next_link) . '">Next →</a>';
        echo '</li>';
    } else {
        echo '<li class="page-item invisible"><span class="page-link">Next →</span></li>';
    }
    
    echo '</ul>';
    echo '</nav>';
}
?>