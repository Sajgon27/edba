document.addEventListener('DOMContentLoaded', function() {
  const swiper = new Swiper('.branze-boxy .swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    pagination: {
      el: '.branze-boxy .swiper-pagination',
      clickable: true,
    }
  });
});