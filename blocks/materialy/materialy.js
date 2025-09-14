document.addEventListener('DOMContentLoaded', function() {
  // Initialize Swiper for materialy section
  const materialySwipers = document.querySelectorAll('.materialy .swiper');
  
  if (materialySwipers.length > 0) {
    materialySwipers.forEach(function(swiperElement) {
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
