/**
 * EDBA Blog AJAX Functionality with URL Parameters
 */
(function($) {
    'use strict';

    // Variables
    let activeCategory = 'all';
    let searchQuery = '';
    let currentPage = 1;
    let isLoading = false;
    
    // DOM Elements
    const $container = $('#blog-ajax-container');
    const $loadingIndicator = $('#blog-loading');
    const $categoryFilters = $('.blog-filter__category');
    const $searchForm = $('#blog-search-form');
    const $searchInput = $('#blog-search-input');
    
    /**
     * Initialize the blog functionality
     */
    function init() {
        // Set up event listeners
        $categoryFilters.on('click', handleCategoryClick);
        $searchForm.on('submit', handleSearchSubmit);
        
        // Get initial values from URL
        const urlParams = new URLSearchParams(window.location.search);
        activeCategory = urlParams.get('category') || 'all';
        searchQuery = urlParams.get('s') || '';
        currentPage = parseInt(urlParams.get('paged'), 10) || 1;
        
        // Focus the search input if there's a search query in the URL
        if (searchQuery) {
            $searchInput.val(searchQuery).focus();
        }
        
        // Initialize pagination click handlers
        $(document).on('click', '.blog-pagination a.page-numbers', handlePaginationClick);
    }
    
    /**
     * Handle category filter click
     */
    function handleCategoryClick(e) {
        e.preventDefault();
        
        const $this = $(this);
        const category = $this.data('category') || 'all';
        
        // Don't reload if already on this category
        if (activeCategory === category) return;
        
        // Update active state
        $categoryFilters.removeClass('active');
        $this.addClass('active');
        
        // Update active category and reset page
        activeCategory = category;
        currentPage = 1;
        
        // Update URL without refreshing
        updateUrl();
        
        // Load posts with new filter
        loadPosts();
    }
    
    /**
     * Handle search form submission
     */
    function handleSearchSubmit(e) {
        e.preventDefault();
        
        const newSearch = $searchInput.val().trim();
        
        // Don't reload if search is the same
        if (newSearch === searchQuery) return;
        
        // Update search query and reset page
        searchQuery = newSearch;
        currentPage = 1;
        
        // Update URL without refreshing
        updateUrl();
        
        // Load posts with search
        loadPosts();
    }
    
    /**
     * Handle pagination click
     */
    function handlePaginationClick(e) {
        e.preventDefault();
        
        // Don't proceed if the link is disabled
        if ($(this).hasClass('disabled')) {
            return;
        }
        
        const $this = $(this);
        
        // Get page number from data attribute or href
        let newPage;
        if ($this.data('page')) {
            newPage = parseInt($this.data('page'), 10);
        } else {
            const href = $this.attr('href');
            newPage = parseInt(href.replace(/.*page\/([0-9]+).*/, '$1'), 10) || 
                      parseInt(href.replace(/.*paged=([0-9]+).*/, '$1'), 10) || 
                      parseInt(href.replace(/.*page=([0-9]+).*/, '$1'), 10) || 1;
        }
        
        // Update current page
        currentPage = newPage;
        
        // Update URL without refreshing
        updateUrl();
        
        // Load posts
        loadPosts();
        
        // Scroll to top of grid
        $('html, body').animate({
            scrollTop: $container.offset().top - 100
        }, 500);
    }
    
    /**
     * Update URL with current parameters without page refresh
     */
    function updateUrl() {
        // Get blog page URL from hidden input field
        const baseUrl = $('#blog-page-url').val() || edbaAjax.baseUrl;
        let url = baseUrl;
        let params = [];
        
        // Add category parameter
        if (activeCategory && activeCategory !== 'all') {
            params.push(`category=${activeCategory}`);
        }
        
        // Add search parameter
        if (searchQuery) {
            params.push(`s=${encodeURIComponent(searchQuery)}`);
        }
        
        // Add page parameter
        if (currentPage > 1) {
            params.push(`paged=${currentPage}`);
        }
        
        // Build URL with parameters
        if (params.length > 0) {
            url += (url.includes('?') ? '&' : '?') + params.join('&');
        }
        
        // Update browser history without reload
        window.history.pushState({}, '', url);
    }
    
    /**
     * Load posts via AJAX
     */
    function loadPosts() {
        if (isLoading) return;
        
        // Show loading indicator
        isLoading = true;
        $loadingIndicator.addClass('active');
        
        // AJAX request
        $.ajax({
            url: edbaAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'edba_filter_posts',
                nonce: edbaAjax.nonce,
                category: activeCategory,
                search: searchQuery,
                page: currentPage
            },
            success: function(response) {
                // Update the container with new content
                $container.html(response);
                
                // Hide loading indicator
                $loadingIndicator.removeClass('active');
                isLoading = false;
            },
            error: function() {
                // Hide loading indicator and show error
                $loadingIndicator.removeClass('active');
                isLoading = false;
                $container.html('<div class="blog-grid__no-posts"><p>Wystąpił błąd. Proszę odświeżyć stronę.</p></div>');
            }
        });
    }
    
    // Initialize when document is ready
    $(document).ready(init);
    
})(jQuery);