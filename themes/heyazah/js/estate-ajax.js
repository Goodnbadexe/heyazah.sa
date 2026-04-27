/**
 * Estate AJAX Filtering
 * File location: /js/estate-ajax.js
 */

jQuery(document).ready(function($) {
    'use strict';

    console.log('=== ESTATE AJAX SCRIPT LOADED ===');

    // Configuration
    const config = {
        projectId: $('#units-filter-form').data('project-id') || 0,
        currentSector: '', // Will be set from active tab
        currentPage: 1,
        maxPages: 1,
        isLoading: false,
        filtersActive: false, // Track if any filters have been applied
    };
    
    console.log('Initial config:', config);

    /**
     * Initialize on page load
     */
    function init() {
        // Detect initial sector from active tab
        detectInitialSector();

        // Initialize price range slider
        initPriceSlider();

        // Bind events
        bindFilterEvents();
        bindTabEvents();
        bindLoadMoreEvent();

        // Update filter counts after everything is initialized
        updateFilterCounts();
        
        // DON'T filter on initial load - units are already rendered by PHP
        console.log('Init complete - NOT triggering initial filter (units already loaded)');
    }

    /**
     * Detect the initial active sector from tabs
     */
    function detectInitialSector() {
        console.log('Detecting initial sector...');
        console.log('Looking for active tab...');
        
        const $activeTab = $('.nav-pills a[data-toggle="pill"].active');
        console.log('Active tabs found:', $activeTab.length);
        
        if ($activeTab.length) {
            const tabId = $activeTab.attr('href');
            config.currentSector = tabId.replace('#pills-', '');
            console.log('Active tab href:', tabId);
        } else {
            // Fallback: get first tab
            console.log('No active tab found, using first tab');
            const $firstTab = $('.nav-pills a[data-toggle="pill"]').first();
            if ($firstTab.length) {
                const tabId = $firstTab.attr('href');
                config.currentSector = tabId.replace('#pills-', '');
                console.log('First tab href:', tabId);
            }
        }
        
        console.log('✅ Initial sector detected:', config.currentSector);
    }

    /**
     * Update range labels with formatted values
     */
    function updateValues(data) {
        $(".range-label.from .value").text(data.from_pretty + " RS");
        $(".range-label.to .value").text(data.to_pretty + " RS");
    }

    /**
     * Initialize price range slider
     */
    function initPriceSlider() {
        const $slider = $(".js-range-slider");

        if (!$slider.length) return;

        let isInitializing = true;

        $slider.ionRangeSlider({
            skin: "round",
            type: "double",
            prettify_enabled: true,
            prettify: function (num) {
                return num.toLocaleString();
            },
            onStart: updateValues,
            onChange: function (data) {
                updateValues(data);

                // Don't trigger filtering during initial setup
                if (isInitializing) {
                    console.log('Slider initialized - NOT triggering filter');
                    isInitializing = false;
                    return;
                }

                // Trigger filtering when user actually changes price
                console.log('User changed price slider - triggering filter');
                config.filtersActive = true; // Mark that filters are now active
                config.currentPage = 1;
                filterUnits();
            }
        });
    }


    /**
     * Bind filter form events
     */
    function bindFilterEvents() {
        // Radio button changes
        $('#units-filter-form input[type="radio"]').on('change', function() {
            console.log('Filter radio changed:', $(this).attr('name'), '=', $(this).val());
            config.filtersActive = true; // Mark that filters are now active
            config.currentPage = 1; // Reset to page 1 when filters change
            filterUnits();
        });

        // NOTE: Price slider filtering is handled in initPriceSlider() onChange
        // No need to bind additional change event here
    }

    /**
     * Bind sector tab events
     */
    function bindTabEvents() {
        const $tabs = $('.nav-pills a[data-toggle="pill"]');
        console.log('Binding tab events to:', $tabs.length, 'tabs');
        console.log('Tab elements:', $tabs.toArray().map(t => $(t).attr('href')));
        
        // Method 1: Bootstrap's shown.bs.tab event
        $tabs.on('shown.bs.tab', function(e) {
            // Get sector from tab
            const tabId = $(e.target).attr('href');
            const newSector = tabId.replace('#pills-', '');
            
            console.log('=== TAB SWITCH EVENT (shown.bs.tab) ===');
            console.log('Tab switched from:', config.currentSector, 'to:', newSector);
            console.log('Tab element:', e.target);
            console.log('Tab href:', tabId);
            
            config.currentSector = newSector;
            config.currentPage = 1;
            
            console.log('Updated config.currentSector to:', config.currentSector);
            
            // Small delay to ensure Bootstrap has fully shown the tab
            setTimeout(function() {
                // Update counts for this sector
                updateFilterCounts();
                
                // Only trigger filtering if user has applied filters
                if (config.filtersActive) {
                    console.log('Filters are active - applying to new sector');
                    filterUnits();
                } else {
                    console.log('No filters active - keeping PHP-rendered units');
                }
            }, 100);
        });
        
        // Method 2: Fallback - Click event (PRIMARY METHOD - Bootstrap event doesn't fire)
        $tabs.on('click', function(e) {
            const tabId = $(this).attr('href');
            const newSector = tabId.replace('#pills-', '');
            
            console.log('=== TAB CLICKED ===');
            console.log('Clicked tab href:', tabId);
            console.log('Current sector before click:', config.currentSector);
            console.log('New sector will be:', newSector);
            
            // Don't do anything if clicking the same tab
            if (newSector === config.currentSector) {
                console.log('Same tab clicked - no action needed');
                return;
            }
            
            // Update sector immediately
            config.currentSector = newSector;
            config.currentPage = 1;
            
            console.log('✅ Updated config.currentSector to:', config.currentSector);
            
            // Small delay to let Bootstrap show the tab content
            setTimeout(function() {
                // Update counts for this sector
                updateFilterCounts();
                
                // Only trigger filtering if user has applied filters
                if (config.filtersActive) {
                    console.log('Filters are active - applying to new sector');
                    filterUnits();
                } else {
                    console.log('No filters active - keeping PHP-rendered units');
                }
            }, 150);
        });
    }

    /**
     * Bind load more button event
     */
    function bindLoadMoreEvent() {
        $(document).on('click', '.load-more-units', function(e) {
            e.preventDefault();
            
            if (config.isLoading) return;
            
            config.currentPage++;
            filterUnits(true); // true = append results
        });
    }

    /**
     * Main filter function
     */
    function filterUnits(append = false) {
        console.log('=== FILTER UNITS CALLED ===');
        console.log('Current sector at start of filterUnits:', config.currentSector);
        console.log('Append mode:', append);
        
        if (config.isLoading) return;
        
        config.isLoading = true;

        // Get filter values
        const filters = getFilterValues();
        
        console.log('Sector after getFilterValues:', config.currentSector);

        // Get current tab content
        const $tabContent = $('#pills-' + config.currentSector);
        const $unitsContainer = $tabContent.find('.units-container');
        const $loadMoreBtn = $tabContent.find('.load-more-units');

        console.log('Filtering units for sector:', config.currentSector);
        console.log('Tab content found:', $tabContent.length);
        console.log('Units container found:', $unitsContainer.length);
        console.log('Filter values:', filters);

        // Validate we found the container
        if ($unitsContainer.length === 0) {
            console.error('Units container not found for sector:', config.currentSector);
            config.isLoading = false;
            return;
        }

        // Show loading state
        if (!append) {
            $unitsContainer.html('<div class="col-12 text-center py-5"><div class="spinner-border" role="status"><span class="sr-only">' + estateAjax.loading_text + '</span></div></div>');
            $loadMoreBtn.hide();
        } else {
            $loadMoreBtn.text(estateAjax.loading_text).prop('disabled', true);
        }

        // AJAX request
        $.ajax({
            url: estateAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_units',
                nonce: estateAjax.nonce,
                project_id: config.projectId,
                sector: config.currentSector,
                price_min: filters.price_min,
                price_max: filters.price_max,
                status: filters.status,
                floor: filters.floor,
                rooms: filters.rooms,
                paged: config.currentPage,
            },
            beforeSend: function() {
                console.log('=== AJAX REQUEST ===');
                console.log('Sector:', config.currentSector);
                console.log('Project ID:', config.projectId);
                console.log('Filters:', filters);
            },
            success: function(response) {
                if (response.success) {
                    if (append) {
                        // Append new units
                        $unitsContainer.append(response.html);
                    } else {
                        // Replace all units
                        $unitsContainer.html(response.html);
                    }

                    // Update config
                    config.maxPages = response.max_pages;

                    // Show/hide load more button
                    if (config.currentPage < config.maxPages) {
                        if ($loadMoreBtn.length === 0) {
                            $tabContent.find('.all-block').append(
                                '<div class="read-more text-center mt-4">' +
                                '<a href="#" class="load-more-units">' + estateAjax.load_more_text + '</a>' +
                                '</div>'
                            );
                        } else {
                            $loadMoreBtn.text(estateAjax.load_more_text).prop('disabled', false).show();
                        }
                    } else {
                        $loadMoreBtn.hide();
                    }

                    // Scroll to new content if appending
                    if (append && response.html) {
                        const $newItems = $unitsContainer.children().slice(-6); // Last 6 items
                        if ($newItems.length) {
                            $('html, body').animate({
                                scrollTop: $newItems.first().offset().top - 100
                            }, 500);
                        }
                    }
                } else {
                    // No units found
                    $unitsContainer.html(
                        '<div class="col-12 text-center py-5">' +
                        '<p>' + estateAjax.no_more_units + '</p>' +
                        '</div>'
                    );
                    $loadMoreBtn.hide();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $unitsContainer.html(
                    '<div class="col-12 text-center py-5">' +
                    '<p class="text-danger">حدث خطأ. الرجاء المحاولة مرة أخرى.</p>' +
                    '</div>'
                );
            },
            complete: function() {
                config.isLoading = false;
            }
        });
    }

    /**
     * Update filter counts
     */
    function updateFilterCounts() {
        // Don't proceed if sector is not set
        if (!config.currentSector) {
            console.warn('Cannot update counts: sector not set');
            return;
        }

        console.log('Updating filter counts for sector:', config.currentSector);

        $.ajax({
            url: estateAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'get_filter_counts',
                nonce: estateAjax.nonce,
                project_id: config.projectId,
                sector: config.currentSector,
            },
            success: function(response) {
                if (response.success) {
                    const counts = response.data;
                    console.log('Filter counts received:', counts);

                    // Update status counts
                    if (counts.status) {
                        // Update "all" option
                        $('[data-filter="status-all"]').text('(' + counts.total + ')');
                        
                        // Update individual status options
                        $.each(counts.status, function(key, value) {
                            $('[data-filter="status-' + key + '"]').text('(' + value + ')');
                        });
                    }

                    // Update floor counts
                    if (counts.floor) {
                        // Update "all" option
                        $('[data-filter="floor-all"]').text('(' + counts.total + ')');
                        
                        // Update individual floor options
                        $.each(counts.floor, function(key, value) {
                            $('[data-filter="floor-' + key + '"]').text('(' + value + ')');
                        });
                    }

                    // Update room counts
                    if (counts.rooms) {
                        // Update "all" option
                        $('[data-filter="room-all"]').text('(' + counts.total + ')');
                        
                        // Update individual room options
                        $.each(counts.rooms, function(key, value) {
                            $('[data-filter="room-' + key + '"]').text('(' + value + ')');
                        });
                    }
                } else {
                    console.error('Failed to get filter counts:', response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error updating counts:', error);
            }
        });
    }

    /**
     * Get current filter values
     */
    function getFilterValues() {
        console.log('Getting filter values - currentSector:', config.currentSector);
        
        const filters = {
            status: $('input[name="status"]:checked').val() || 'all',
            floor: $('input[name="floor"]:checked').val() || 'all',
            rooms: $('input[name="rooms"]:checked').val() || 'all',
            price_min: 0,
            price_max: 999999999,
        };

        // Get price range values (if using ion.rangeSlider)
        const $priceSlider = $('.js-range-slider');
        if ($priceSlider.length && $priceSlider.data('ionRangeSlider')) {
            const slider = $priceSlider.data('ionRangeSlider');
            filters.price_min = slider.result.from;
            filters.price_max = slider.result.to;
        }

        return filters;
    }

    /**
     * Reset filters
     */
    function resetFilters() {
        console.log('Resetting all filters');
        
        // Reset radio buttons to "all"
        $('input[name="status"][value="all"]').prop('checked', true);
        $('input[name="floor"][value="all"]').prop('checked', true);
        $('input[name="rooms"][value="all"]').prop('checked', true);

        // Reset price slider
        const $priceSlider = $('.js-range-slider');
        if ($priceSlider.length && $priceSlider.data('ionRangeSlider')) {
            const slider = $priceSlider.data('ionRangeSlider');
            slider.reset();
        }

        // Clear filters active flag and reset page
        config.filtersActive = false;
        config.currentPage = 1;
        
        // Reload the page to show original PHP-rendered units
        location.reload();
    }

    // Add reset button handler (if you add a reset button)
    $(document).on('click', '.reset-filters', function(e) {
        e.preventDefault();
        resetFilters();
    });

    // Initialize
    init();
});