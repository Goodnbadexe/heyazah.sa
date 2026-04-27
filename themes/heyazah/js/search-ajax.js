/**
 * Search AJAX - Load More Functionality
 * Handles loading more search results
 */

jQuery(document).ready(function($) {
    'use strict';

    /**
     * Update Results Counter
     * Updates the counter to show current number of visible results
     */
    function updateResultsCounter($container) {
        // Count visible items
        const visibleItems = $container.find('.search-result-item').length;
        
        // Find the counter element
        const $counter = $('.search-count strong');
        
        if ($counter.length) {
            // Update counter with current visible count
            $counter.text(visibleItems);
        }
    }

    // Load More Search Button Click Handler
    $(document).on('click', '.load-more-search', function(e) {
        e.preventDefault();
        
        const $button = $(this);
        const $container = $('.search-results-container');
        
        // Get data attributes
        const searchQuery = $button.data('search-query');
        let currentPage = parseInt($button.data('page'));
        const maxPages = parseInt($button.data('max-pages'));
        
        // Calculate next page
        const nextPage = currentPage + 1;
        
        // Disable button and show loading state
        const originalText = $button.find('span').text();
        $button.prop('disabled', true);
        $button.find('span').text(searchAjax.loading_text || 'Loading...');
        $button.find('i').addClass('fa-spin fa-spinner').removeClass('fa-long-arrow-left');
        
        // AJAX Request
        $.ajax({
            url: searchAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_more_search',
                nonce: searchAjax.nonce,
                search_query: searchQuery,
                paged: nextPage
            },
            success: function(response) {
                if (response.success && response.html) {
                    // Append new items to container
                    $container.append(response.html);
                    
                    // Update button page data
                    $button.data('page', nextPage);
                    
                    // Update results counter
                    updateResultsCounter($container);
                    
                    // Check if there are more pages
                    if (nextPage >= response.max_pages) {
                        // No more pages - hide button
                        $button.parent('.load-more-wrapper').fadeOut();
                    } else {
                        // Re-enable button
                        $button.prop('disabled', false);
                        $button.find('span').text(searchAjax.load_more_text || 'Load More');
                        $button.find('i').removeClass('fa-spin fa-spinner').addClass('fa-long-arrow-left');
                    }
                    
                    // Reinitialize fancybox if it exists for new video items
                    if (typeof $.fancybox !== 'undefined') {
                        $('[data-fancybox="gallery"]').fancybox({
                            youtube: {
                                controls: 1,
                                showinfo: 0
                            },
                            vimeo: {
                                color: 'f00'
                            }
                        });
                    }
                    
                    // Smooth scroll to first new item
                    if ($container.find('.search-result-item').length > 0) {
                        const firstNewItem = $container.find('.col-lg-4').eq(currentPage * 9);
                        if (firstNewItem.length) {
                            $('html, body').animate({
                                scrollTop: firstNewItem.offset().top - 100
                            }, 500);
                        }
                    }
                    
                } else {
                    // No more items or error
                    $button.parent('.load-more-wrapper').fadeOut();
                    console.log('No more search results to load');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $button.prop('disabled', false);
                $button.find('span').text(originalText);
                $button.find('i').removeClass('fa-spin fa-spinner').addClass('fa-long-arrow-left');
                alert('Error loading more results. Please try again.');
            }
        });
    });
    
});
