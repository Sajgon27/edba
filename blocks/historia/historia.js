document.addEventListener('DOMContentLoaded', () => {
    initHistoriaSlideshow();
    initHistoriaSwipers();
});

/**
 * Initialize the slideshow for the Historia block
 */
function initHistoriaSlideshow() {
    const slideshows = document.querySelectorAll('.historia__slideshow');
    
    slideshows.forEach(slideshow => {
        const slides = slideshow.querySelectorAll('.historia__slide');
        if (slides.length <= 1) return;
        
        let currentSlide = 0;
        let slideshowInterval;
        
        // Function to show a specific slide
        const showSlide = (index) => {
            // Remove active class from all slides
            slides.forEach(slide => slide.classList.remove('active'));
            
            // Add active class to current slide
            slides[index].classList.add('active');
            
            // Update current slide index
            currentSlide = index;
        };
        
        // Function to show the next slide
        const nextSlide = () => {
            const nextIndex = (currentSlide + 1) % slides.length;
            showSlide(nextIndex);
        };
        
        // Start the slideshow interval
        const startSlideshow = () => {
            slideshowInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
        };
        
        // Start the slideshow
        startSlideshow();
    });
}

/**
 * Initialize Swiper for the Historia timeline
 */
function initHistoriaSwipers() {
    const timelineContainers = document.querySelectorAll('.historia__timeline');
    
    timelineContainers.forEach(container => {
        // Get navigation elements
        const prevBtn = container.querySelector('.historia__nav--prev');
        const nextBtn = container.querySelector('.historia__nav--next');
        
        // Ensure proper styling of the active elements
        const updateActiveStyles = () => {
            const slides = container.querySelectorAll('.historia-timeline-swiper .swiper-slide');
            
            slides.forEach((slide, index) => {
                const isActive = slide.classList.contains('swiper-slide-active');
                const event = slide.querySelector('.historia__event');
                const dot = slide.querySelector('.historia__dot');
                
                // Add null checks to prevent errors
                if (isActive) {
                    if (event) event.classList.add('active');
                    if (dot) dot.classList.add('active');
                } else {
                    if (event) event.classList.remove('active');
                    if (dot) dot.classList.remove('active');
                }
            });
        };
        
        // Initialize the main timeline swiper (now combined with dots)
        const timelineSwiper = new Swiper(container.querySelector('.historia-timeline-swiper'), {
            slidesPerView: getSlidesPerView(),
            spaceBetween: 0, // No spacing between slides for continuous line
            initialSlide: 0,
            grabCursor: true,
            watchSlidesProgress: true,
            slideToClickedSlide: true, // Allow clicking slides to navigate
            speed: 500, // Smooth transition speed
            snapOnRelease: true, // Snap to slides when user stops dragging
            freeMode: false, // Disable free mode for better snapping
            navigation: {
                prevEl: prevBtn,
                nextEl: nextBtn,
            },
            on: {
                init: function() {
                    updateNavigationState(this);
                    
                    // Apply custom widths to slides
                    const slides = container.querySelectorAll('.historia-timeline-swiper .swiper-slide');
                    const slidesPerView = getSlidesPerView();
                    
                    slides.forEach(slide => {
                        slide.style.width = `${100 / slidesPerView}%`;
                    });
                    
                    // Set initial active styles
                    updateActiveStyles();
                    
                    // Ensure first slide is active
                    if (slides.length > 0) {
                        const firstEvent = slides[0].querySelector('.historia__event');
                        const firstDot = slides[0].querySelector('.historia__dot');
                        
                        if (firstEvent) firstEvent.classList.add('active');
                        if (firstDot) firstDot.classList.add('active');
                    }
                },
                slideChange: function() {
                    updateNavigationState(this);
                    updateActiveStyles();
                },
                resize: function() {
                    // Update slidesPerView on window resize
                    const newSlidesPerView = getSlidesPerView();
                    this.params.slidesPerView = newSlidesPerView;
                    
                    // Apply custom widths to slides
                    const slides = container.querySelectorAll('.historia-timeline-swiper .swiper-slide');
                    slides.forEach(slide => {
                        slide.style.width = `${100 / newSlidesPerView}%`;
                    });
                    
                    this.update();
                    updateActiveStyles();
                },
            }
        });
        
        /**
         * Update the state of navigation buttons
         */
        function updateNavigationState(swiper) {
            if (swiper.isBeginning) {
                prevBtn.disabled = true;
            } else {
                prevBtn.disabled = false;
            }
            
            if (swiper.isEnd) {
                nextBtn.disabled = true;
                
                // Make the last slide active when we reach the end
                const slides = container.querySelectorAll('.historia-timeline-swiper .swiper-slide');
                if (slides.length > 0) {
                    const lastIndex = slides.length - 1;
                    const lastSlide = slides[lastIndex];
                    const lastEvent = lastSlide.querySelector('.historia__event');
                    const lastDot = lastSlide.querySelector('.historia__dot');
                    
                    // Clear all active classes first
                    slides.forEach(slide => {
                        const event = slide.querySelector('.historia__event');
                        const dot = slide.querySelector('.historia__dot');
                        
                        if (event) event.classList.remove('active');
                        if (dot) dot.classList.remove('active');
                    });
                    
                    // Set active class on the last slide
                    if (lastEvent) lastEvent.classList.add('active');
                    if (lastDot) lastDot.classList.add('active');
                }
            } else {
                nextBtn.disabled = false;
            }
        }
        
        /**
         * Get the appropriate number of slides to show based on screen width
         */
        function getSlidesPerView() {
            const windowWidth = window.innerWidth;
            
            if (windowWidth >= 992) {
                return 2.3; // Desktop - show 2.5 items
            } else if (windowWidth >= 768) {
                return 2; // Tablet - show 2 items
            } else {
                return 1.1; // Mobile - show 1.5 items
            }
        }
        
        // In the combined design, we don't need a separate getDotsToShow function
        // as dots are part of each slide
        
        // Add click event listeners to navigation buttons
        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                // Check if we're at the last slide after clicking next
                setTimeout(() => {
                    if (timelineSwiper.isEnd) {
                        const slides = container.querySelectorAll('.historia-timeline-swiper .swiper-slide');
                        if (slides.length > 0) {
                            const lastSlide = slides[slides.length - 1];
                            const event = lastSlide.querySelector('.historia__event');
                            const dot = lastSlide.querySelector('.historia__dot');
                            
                            // Ensure the last slide gets the active class
                            if (event) event.classList.add('active');
                            if (dot) dot.classList.add('active');
                        }
                    }
                    
                    updateActiveStyles();
                }, 50);
            });
        }
    });
}