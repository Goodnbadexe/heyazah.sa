/**
 * Media Center AJAX - Load More Functionality
 * Handles loading more media items for each tab separately
 */

jQuery(document).ready(function($) {
    'use strict';

    /**
     * Update Tab Counter
     * Updates the counter badge in the tab to show current number of visible items
     */
    function updateTabCounter($tabPane, termId) {
        // Count visible items in this tab
        const visibleItems = $tabPane.find('.project-item').length;
        
        // Find the corresponding tab link by term ID
        const tabId = $tabPane.attr('id');
        const $tabLink = $('[href="#' + tabId + '"]');
        const $counter = $tabLink.find('.p-num');
        
        if ($counter.length) {
            // Update counter with current visible count
            $counter.text(visibleItems);
        }
    }

    // Load More Media Button Click Handler
    $(document).on('click', '.load-more-media', function(e) {
        e.preventDefault();
        
        const $button = $(this);
        const $tabPane = $button.closest('.tab-pane');
        const $container = $tabPane.find('.media-items-container');
        
        // Get data attributes
        const termId = $button.data('term-id');
        let currentPage = parseInt($button.data('page'));
        const maxPages = parseInt($button.data('max-pages'));
        
        // Calculate next page
        const nextPage = currentPage + 1;
        
        // Disable button and show loading state
        $button.prop('disabled', true).text(mediaCenterAjax.loading_text || 'Loading...');
        
        // AJAX Request
        $.ajax({
            url: mediaCenterAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_more_media',
                nonce: mediaCenterAjax.nonce,
                term_id: termId,
                paged: nextPage
            },
            success: function(response) {
                if (response.success && response.html) {
                    // Append new items to container
                    $container.append(response.html);
                    
                    // Update button page data
                    $button.data('page', nextPage);
                    
                    // Update tab counter to show current number of items displayed
                    updateTabCounter($tabPane, termId);
                    
                    // Check if there are more pages
                    if (nextPage >= response.max_pages) {
                        // No more pages - hide button
                        $button.parent('.load-more-wrapper').fadeOut();
                    } else {
                        // Re-enable button
                        $button.prop('disabled', false).text(mediaCenterAjax.load_more_text || 'Load More');
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
                    
                } else {
                    // No more items or error
                    $button.parent('.load-more-wrapper').fadeOut();
                    console.log('No more media items to load');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $button.prop('disabled', false).text(mediaCenterAjax.load_more_text || 'Load More');
                alert('Error loading more items. Please try again.');
            }
        });
    });
    
    // Reset pagination when switching tabs
    $('.media-center-tabs .nav-link').on('shown.bs.tab', function(e) {
        const $tab = $(e.target);
        const targetPane = $($tab.attr('href'));
        const $button = targetPane.find('.load-more-media');
        
        // Reset button state if it exists
        if ($button.length) {
            const maxPages = parseInt($button.data('max-pages'));
            if (maxPages > 1) {
                $button.parent('.load-more-wrapper').show();
                $button.prop('disabled', false).text(mediaCenterAjax.load_more_text || 'Load More');
            }
        }
    });
    
});
