document.addEventListener('DOMContentLoaded', function() {
    // Menu toggle functionality
    const menuToggle = document.querySelector('.header__toggle');
    const closeButton = document.querySelector('.fullscreen-menu__close');
    const fullscreenMenu = document.querySelector('.fullscreen-menu');
    const body = document.body;
    const header = document.querySelector('.header');
    
    // Toggle menu on click
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            fullscreenMenu.classList.add('active');
            body.classList.add('menu-open');
            header.classList.add('menu-open');
        });
    }
    
    // Close menu on click
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            closeMenu();
        });
    }
    
    function closeMenu() {
        fullscreenMenu.classList.remove('active');
        body.classList.remove('menu-open');
        header.classList.remove('menu-open');
        
        // Reset any active states
        const activeItems = document.querySelectorAll('.menu-item-has-children.active');
        activeItems.forEach(item => {
            if (!isDesktop()) {
                item.classList.remove('active');
                const toggle = item.querySelector('.submenu-toggle');
                if (toggle) toggle.classList.remove('active');
            }
        });
    }
    
    // Submenu toggle functionality for mobile
    const submenuToggles = document.querySelectorAll('.submenu-toggle');
    
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const parentLi = this.parentNode;
            
            // Close other open submenus
            const activeItems = document.querySelectorAll('.menu-item-has-children.active');
            activeItems.forEach(item => {
                if (item !== parentLi) {
                    item.classList.remove('active');
                    const toggle = item.querySelector('.submenu-toggle');
                    if (toggle) toggle.classList.remove('active');
                }
            });
            
            parentLi.classList.toggle('active');
            this.classList.toggle('active');
        });
    });
    
    // Add hover functionality for desktop
    const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');
    
    function isDesktop() {
        return window.innerWidth >= 1024; // Using tablet breakpoint
    }
    
    // Initial setup
    if (isDesktop()) {
        setupDesktopBehavior();
    } else {
        setupMobileBehavior();
    }
    
    // Reset on resize
    window.addEventListener('resize', function() {
        if (isDesktop()) {
            setupDesktopBehavior();
        } else {
            resetDesktopBehavior();
            setupMobileBehavior();
        }
    });
    
    function setupDesktopBehavior() {
        menuItemsWithChildren.forEach(item => {
            // Use mouseenter instead of hover for better control
            item.addEventListener('mouseenter', function() {
                this.classList.add('active');
            });
            
            // Remove active class on mouseleave
            item.addEventListener('mouseleave', function() {
                this.classList.remove('active');
            });
        });
    }
    
    function setupMobileBehavior() {
        menuItemsWithChildren.forEach(item => {
            item.querySelector('a').addEventListener('click', function(e) {
                if (!isDesktop() && item.classList.contains('menu-item-has-children')) {
                    e.preventDefault();
                    
                    // Close other open submenus
                    const activeItems = document.querySelectorAll('.menu-item-has-children.active');
                    activeItems.forEach(activeItem => {
                        if (activeItem !== item) {
                            activeItem.classList.remove('active');
                            const toggle = activeItem.querySelector('.submenu-toggle');
                            if (toggle) toggle.classList.remove('active');
                        }
                    });
                    
                    // Toggle active class
                    item.classList.toggle('active');
                    const toggle = item.querySelector('.submenu-toggle');
                    if (toggle) toggle.classList.toggle('active');
                }
            });
        });
    }
    
    function resetDesktopBehavior() {
        menuItemsWithChildren.forEach(item => {
            item.classList.remove('active');
        });
    }
    
    // Close menu on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && fullscreenMenu.classList.contains('active')) {
            closeMenu();
        }
    });
    
    // Add animation for menu items
    const menuItems = document.querySelectorAll('.fullscreen-menu__primary > li');
    menuItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = `opacity 0.5s ease ${0.1 + index * 0.1}s, transform 0.5s ease ${0.1 + index * 0.1}s`;
    });
    
    // Animate menu items when menu opens
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            setTimeout(() => {
                menuItems.forEach(item => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                });
            }, 300);
        });
    }
    
    // Reset animation when menu closes
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            menuItems.forEach(item => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
            });
        });
    }
});
