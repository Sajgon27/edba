// Home Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Swiper for News Section on Mobile
    const aktualnosciSwiper = new Swiper('.aktualnosci__swiper .swiper-container', {
        slidesPerView: 1,
        spaceBetween: 20,
        pagination: {
            el: '.aktualnosci__swiper .swiper-pagination',
            clickable: true,
        },
        autoHeight: true,
    });
    
    // GSAP Animations or other JS functionality can be added here
});
