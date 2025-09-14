document.addEventListener('DOMContentLoaded', function() {
    // Initialize Swiper for Blocks Section on mobile
    const sekcjaBlokiSwipers = document.querySelectorAll('.sekcja-bloki__swiper .swiper-container');
    
    sekcjaBlokiSwipers.forEach(function(swiperContainer) {
        new Swiper(swiperContainer, {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: swiperContainer.querySelector('.swiper-pagination'),
                clickable: true,
            },
            autoHeight: true,
        });
    });
});