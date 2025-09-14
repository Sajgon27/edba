document.addEventListener('DOMContentLoaded', function() {
  // Initialize Swiper
  const blokZdjecieSwipers = document.querySelectorAll('.blok-zdjecie .swiper');
  
  if (blokZdjecieSwipers.length > 0) {
    blokZdjecieSwipers.forEach(function(swiperElement) {
      const swiper = new Swiper(swiperElement, {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
          el: swiperElement.querySelector('.swiper-pagination'),
          clickable: true,
        },
      });
    });
  }
});
