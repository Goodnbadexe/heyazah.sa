/**
 * Project Filter – AJAX + Nice Select + Tabs + Pagination
 * File location: assets/js/archive-project-filter.js
 *
 * Dependencies: jQuery, nice-select (already initialised globally by theme)
 */

(function ($) {
    'use strict';

    /* ================================================================
       CONFIG
    ================================================================ */
    const CONFIG = {
        ajaxUrl  : elryadAjax.ajax_url,
        nonce    : elryadAjax.nonce,
        perPage  : elryadAjax.per_page  || 9,
        noResults: elryadAjax.no_results || 'لا توجد مشاريع مطابقة للبحث',
        loading  : elryadAjax.loading_text || 'جاري التحميل...',
    };

    /* ================================================================
       STATE  – single source of truth
    ================================================================ */
    const state = {
        category : 'all',   // active tab slug
        status   : '',
        location : '',
        paged    : 1,
    };

    /* ================================================================
       SELECTORS
    ================================================================ */
    const $tabLinks      = $('#pills-tab .nav-link');
    const $tabContent    = $('#pills-tabContent');
    const $selectStatus  = $('#filter-status');           // <select id="filter-status">
    const $selectType    = $('#filter-type');             // <select id="filter-type">  (project_category re-filter, optional)
    const $selectLocation= $('#filter-location');         // <select id="filter-location">
    const $paginationWrap= $('#projects-pagination');

    /* ================================================================
       INIT
    ================================================================ */
    function init() {
        bindTabEvents();
        bindFilterEvents();
        bindPaginationEvents();
        populateLocationDropdown();   // fill location <select> via AJAX
        $('#filter-type').next('.nice-select').show(); // visible by default on 'all' tab
    }

    /* ================================================================
       TAB EVENTS
       Bootstrap pill tabs – intercept click, update state, fetch
    ================================================================ */
    function bindTabEvents() {
        $tabLinks.on('click', function (e) {
            e.preventDefault();

            const $this = $(this);
            if ($this.hasClass('active')) return;

            // Update Bootstrap active classes
            $tabLinks.removeClass('active').attr('aria-selected', 'false');
            $this.addClass('active').attr('aria-selected', 'true');

            // Update state
            const href = $this.attr('href'); // e.g. "#pills-residential"
            state.category = href === '#pills-all' ? 'all' : href.replace('#pills-', '');
            state.paged    = 1;

            // Show/hide filter-type (nice-select div) based on active tab
            if (state.category === 'all') {
                $('#filter-type').next('.nice-select').show();
            } else {
                $('#filter-type').next('.nice-select').hide();
            }

            fetchProjects();
        });
    }

    /* ================================================================
       FILTER SELECT EVENTS
       Works with native <select> AND with nice-select (which fires
       'change' on the original <select> after the user picks an item).
    ================================================================ */
function bindFilterEvents() {
    // Nice-select doesn't fire native 'change' — listen to clicks on its list items
    $(document).on('click', '.nice-select .option', function () {
        const $niceSelect = $(this).closest('.nice-select');
        // Find the preceding hidden <select> sibling
        const $select = $niceSelect.prev('select.form-control');
        if (!$select.length) return;

        const id  = $select.attr('id');
        const val = $(this).data('value');

        if (id === 'filter-status')   state.status   = val;
        if (id === 'filter-location') state.location = val;
        if (id === 'filter-type') {
            state.category = val || 'all';
            // Sync tabs UI if needed
            $tabLinks.removeClass('active').attr('aria-selected', 'false');
            $tabLinks.filter('[href="#pills-' + state.category + '"], [href="#pills-all"]')
                     .first()
                     .addClass('active')
                     .attr('aria-selected', 'true');
        }

        state.paged = 1;
        fetchProjects();
    });
}

    /* ================================================================
       PAGINATION EVENTS  (event delegation – pagination rebuilt on each fetch)
    ================================================================ */
    function bindPaginationEvents() {
        $(document).on('click', '#projects-pagination .page-item:not(.disabled) .page-link', function (e) {
            e.preventDefault();
            const page = parseInt($(this).data('page'), 10);
            if (!page || page === state.paged) return;
            state.paged = page;
            fetchProjects();
        });
    }

    /* ================================================================
       MAIN FETCH FUNCTION
    ================================================================ */
    function fetchProjects() {
        const $activePane = getActivePane();

        // Show loader
        $activePane.find('.row').html(
            '<div class="col-12 text-center projects-loader">' +
            '<div class="spinner-border" role="status"><span class="sr-only">' + CONFIG.loading + '</span></div>' +
            '</div>'
        );
        $paginationWrap.hide();

        $.ajax({
            url    : CONFIG.ajaxUrl,
            type   : 'POST',
            data   : {
                action  : 'elryad_filter_projects',
                nonce   : CONFIG.nonce,
                category: state.category,
                status  : state.status,
                location: state.location,
                paged   : state.paged,
                per_page: CONFIG.perPage,
            },
            success: function (response) {
                if (!response.success) {
                    showError($activePane);
                    return;
                }

                const data = response.data;

                if (!data.html || data.found_posts === 0) {
                    $activePane.find('.row').html(
                        '<div class="col-12"><div class="no-results-msg">' + CONFIG.noResults + '</div></div>'
                    );
                    $paginationWrap.hide();
                    return;
                }

                // Inject cards
                $activePane.find('.row').html(data.html);

                // Re-init any card animations / lazy images if needed
                triggerCardAnimations($activePane);

                // Build pagination
                if (data.total_pages > 1) {
                    buildPagination(data.total_pages, data.current_page);
                    $paginationWrap.show();
                } else {
                    $paginationWrap.hide();
                }

                // Smooth scroll to top of grid
                $('html, body').animate({
                    scrollTop: $('.project-tabs').offset().top - 100
                }, 400);
            },
            error: function () {
                showError($activePane);
            },
        });
    }

    /* ================================================================
       PAGINATION BUILDER
    ================================================================ */
    function buildPagination(totalPages, currentPage) {
        let html = '<nav><ul class="pagination justify-content-center">';

        // Prev
        html += pageLi(currentPage - 1, '&laquo;', currentPage === 1);

        // Page numbers (show max 5 around current)
        const range = getPageRange(currentPage, totalPages, 5);
        range.forEach(function (p) {
            if (p === '...') {
                html += '<li class="page-item disabled"><span class="page-link">...</span></li>';
            } else {
                html += '<li class="page-item' + (p === currentPage ? ' active' : '') + '">' +
                        '<a class="page-link" data-page="' + p + '" href="#">' + p + '</a></li>';
            }
        });

        // Next
        html += pageLi(currentPage + 1, '&raquo;', currentPage === totalPages);

        html += '</ul></nav>';
        $paginationWrap.html(html);
    }

    function pageLi(page, label, disabled) {
        return '<li class="page-item' + (disabled ? ' disabled' : '') + '">' +
               '<a class="page-link" data-page="' + page + '" href="#">' + label + '</a></li>';
    }

    function getPageRange(current, total, delta) {
        const range  = [];
        const left   = Math.max(2, current - delta);
        const right  = Math.min(total - 1, current + delta);

        range.push(1);
        if (left > 2) range.push('...');
        for (let i = left; i <= right; i++) range.push(i);
        if (right < total - 1) range.push('...');
        if (total > 1) range.push(total);

        return range;
    }

    /* ================================================================
       LOCATION DROPDOWN – populate via AJAX on page load
    ================================================================ */
function populateLocationDropdown() {
    if (!$selectLocation.length) return;

    $.ajax({
        url : CONFIG.ajaxUrl,
        type: 'POST',
        data: {
            action: 'elryad_get_locations',
            nonce : CONFIG.nonce,
        },
        success: function (response) {
            if (!response.success) return;
        
            const locations = response.data;
        
            let options = '<option value="">' + (elryadAjax.location_placeholder || 'المنطقة') + '</option>';
            locations.forEach(function (loc) {
                options += '<option value="' + escapeHtml(loc.value) + '">' + escapeHtml(loc.label) + '</option>';
            });
            $selectLocation.html(options);
        
            // Manually rebuild nice-select <ul>
            const $niceSelect = $selectLocation.next('.nice-select');
            let liHTML = '';
            $selectLocation.find('option').each(function () {
                const val      = $(this).val();
                const label    = $(this).text().trim();
                const isSelected = val === '' ? ' selected focus' : '';
                liHTML += '<li data-value="' + escapeHtml(val) + '" class="option' + isSelected + '">' + label + '</li>';
            });
            $niceSelect.find('.list').html(liHTML);
        },
        error: function (xhr, status, error) {
            console.log('location ajax error:', error);
        }
    });
}

    /* ================================================================
       HELPERS
    ================================================================ */
    function getActivePane() {
        // Return the currently visible tab-pane .row wrapper
        return $tabContent.find('.tab-pane.active');
    }

    function showError($pane) {
        $pane.find('.row').html(
            '<div class="col-12"><div class="no-results-msg alert alert-danger">حدث خطأ، يرجى المحاولة مرة أخرى.</div></div>'
        );
    }

    function triggerCardAnimations($pane) {
        // Hook into theme animation library if exists (e.g. AOS, WOW)
        if (typeof AOS !== 'undefined') AOS.refresh();
        if (typeof WOW  !== 'undefined') new WOW().sync();
    }

    function escapeHtml(str) {
        return String(str)
            .replace(/&/g,  '&amp;')
            .replace(/</g,  '&lt;')
            .replace(/>/g,  '&gt;')
            .replace(/"/g,  '&quot;');
    }

    /* ================================================================
       KICK OFF
    ================================================================ */
    $(document).ready(init);


}(jQuery));