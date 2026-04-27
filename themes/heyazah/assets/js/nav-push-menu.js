document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const togglers = document.querySelectorAll('.navbar-toggler');
    const closeButtons = document.querySelectorAll('.close-side, .h-push-overlay');
    const pushWrapper = document.querySelector('.h-page-push-wrapper');

    // Create and inject the dimming overlay if it doesn't exist
    if (pushWrapper && !document.querySelector('.h-push-overlay')) {
        const overlay = document.createElement('div');
        overlay.className = 'h-push-overlay';
        pushWrapper.appendChild(overlay);
        
        // overlay click explicitly closes nav
        overlay.addEventListener('click', closeMenu);
    }

    function openMenu() {
        body.classList.add('h-push-menu-open');
    }

    function closeMenu() {
        body.classList.remove('h-push-menu-open');
    }

    // Bind toggler (hamburger)
    togglers.forEach(toggler => {
        // Remove existing theme clicks if any (by cloning and replacing, but let's just add event listener. 
        // If existing theme's logic interferes, we can manage it. But usually they just add a class.)
        toggler.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            if(body.classList.contains('h-push-menu-open')) {
                closeMenu();
            } else {
                openMenu();
            }
        });
    });

    // Bind close specific buttons inside sidebar X
    closeButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            closeMenu();
        });
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && body.classList.contains('h-push-menu-open')) {
            closeMenu();
        }
    });
});
