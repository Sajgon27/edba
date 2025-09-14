document.addEventListener('DOMContentLoaded', function() {
  // Initialize Swiper
  const miniGaleriaSwipers = document.querySelectorAll('.mini-galeria .swiper');
  
  if (miniGaleriaSwipers.length > 0) {
    miniGaleriaSwipers.forEach(function(swiperElement) {
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
