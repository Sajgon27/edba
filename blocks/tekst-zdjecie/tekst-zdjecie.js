document.addEventListener('DOMContentLoaded', function () {
	const wrapper = document.querySelector('.tekst-zdjecie__wrapper');
	if (!wrapper) return;
	
	// Check if hover functionality is enabled
	const isHoverEnabled = wrapper.dataset.hoverEnabled === 'true';
	
	// If hover is not enabled, don't initialize the image switching
	if (!isHoverEnabled) return;

	const imageWrapper = wrapper.querySelector('.tekst-zdjecie__image-wrapper');
	const images = imageWrapper.querySelectorAll('.tekst-zdjecie__image');
	const sections = wrapper.querySelectorAll('.tekst-zdjecie__section');

	// If no images found, exit
	if (!images.length || images.length <= 1) {
		console.warn('No images or only one image found in tekst-zdjecie block');
		return;
	}

	// Helper to show image by index
	function showImage(index) {
		images.forEach((img, i) => {
			if (i === index) {
				img.classList.add('active');
				img.style.opacity = 1;
				img.style.zIndex = 2;
			} else {
				img.classList.remove('active');
				img.style.opacity = 0;
				img.style.zIndex = 1;
			}
		});
	}

	// Set initial state for all images
	images.forEach((img, i) => {
		img.style.position = 'absolute';
		img.style.top = 0;
		img.style.left = 0;
		img.style.width = '100%';
		img.style.height = '100%';
		img.style.objectFit = 'cover';
		img.style.opacity = i === 0 ? 1 : 0;
		img.style.zIndex = i === 0 ? 2 : 1;
		img.style.transition = 'opacity 0.5s ease';
	});
	
	// Ensure image wrapper is positioned for absolute positioning of images
	imageWrapper.style.position = 'relative';

	// Add hover listeners to sections
	sections.forEach((section, i) => {
		// Only add listeners for sections that have corresponding images
		if (i < images.length) {
			section.addEventListener('mouseenter', () => {
				showImage(i);
			});
			
			section.addEventListener('focus', () => {
				showImage(i);
			});
			
			section.addEventListener('touchstart', () => {
				showImage(i);
			});
		}
	});

	// On mouseleave, revert to first image
	wrapper.addEventListener('mouseleave', () => {
		showImage(0);
	});
});
