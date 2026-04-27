document.addEventListener('DOMContentLoaded', () => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const panel = document.querySelector('.h-concierge-panel');
    const trigger = document.querySelector('.h-concierge-trigger');

    // Vanilla Fallback Logic
    const useFallback = prefersReducedMotion || typeof gsap === 'undefined';
    let isOpen = false;

    function toggleMenuFallback() {
        if (!isOpen) {
            panel.classList.add('is-active-fallback');
            trigger.classList.add('is-open');
            trigger.querySelector('.h-menu-text').textContent = "Close";
            trigger.setAttribute('aria-expanded', 'true');
            // Focus trap basic
            const firstLink = panel.querySelector('a, button');
            if (firstLink) firstLink.focus();
        } else {
            panel.classList.remove('is-active-fallback');
            trigger.classList.remove('is-open');
            trigger.querySelector('.h-menu-text').textContent = "Menu";
            trigger.setAttribute('aria-expanded', 'false');
        }
        isOpen = !isOpen;
    }

    if (useFallback) {
        if (trigger && panel) {
            trigger.addEventListener('click', toggleMenuFallback);
        }
    } else {
        // Standard GSAP orchestration
        gsap.registerPlugin(ScrollTrigger);

        if (panel && trigger) {
            gsap.set(panel, { yPercent: -100, display: 'block' });
            
            const conciergeTl = gsap.timeline({ paused: true, defaults: { ease: "power4.inOut" } })
                .to(panel, { yPercent: 0, duration: 1.2 })
                .from('.h-premium-nav .wp-block-navigation-item', { 
                    y: 40, opacity: 0, stagger: 0.1, duration: 0.8, ease: "power3.out" 
                }, "-=0.6")
                .from('.h-concierge-image', { 
                    scale: 1.05, opacity: 0, duration: 1.2 
                }, "-=1.0")
                .from('.h-concierge-panel p, .h-concierge-panel .wp-block-button', {
                    y: 20, opacity: 0, stagger: 0.1, duration: 0.8
                }, "-=0.8");

            trigger.addEventListener('click', () => {
                if (!isOpen) {
                    conciergeTl.play();
                    trigger.classList.add('is-open');
                    trigger.querySelector('.h-menu-text').textContent = "Close";
                    trigger.setAttribute('aria-expanded', 'true');
                    const firstLink = panel.querySelector('a, button');
                    setTimeout(() => { if (firstLink) firstLink.focus(); }, 1200);
                } else {
                    conciergeTl.reverse();
                    trigger.classList.remove('is-open');
                    trigger.querySelector('.h-menu-text').textContent = "Menu";
                    trigger.setAttribute('aria-expanded', 'false');
                }
                isOpen = !isOpen;
            });
        }

        // 2. Cinematic Fade
        const cinematicFades = document.querySelectorAll('.gs-cinematic-fade');
        if (cinematicFades.length > 0) {
            gsap.from(cinematicFades, {
                y: 40, opacity: 0, duration: 1.5, stagger: 0.3, ease: "expo.out"
            });
        }

        // Hero parallax background
        const heroBg = document.querySelector('.gs-parallax-bg');
        if (heroBg) {
            gsap.to(heroBg, {
                yPercent: 15, ease: "none",
                scrollTrigger: {
                    trigger: heroBg.parentElement,
                    start: "top top", end: "bottom top", scrub: true
                }
            });
        }

        // 3. Architectural Mask
        const archMasks = document.querySelectorAll('.gs-arch-mask');
        archMasks.forEach(mask => {
            gsap.fromTo(mask, 
                { clipPath: "inset(100% 0 0 0)" }, 
                {
                    clipPath: "inset(0% 0 0 0)", duration: 1.2, ease: "power4.out",
                    scrollTrigger: { trigger: mask, start: "top 85%", toggleActions: "play none none reverse" }
                }
            );
        });

        // 4. Project Drift
        const projectDrifts = document.querySelectorAll('.gs-project-drift');
        projectDrifts.forEach((el) => {
            gsap.fromTo(el,
                { y: 60, autoAlpha: 0 },
                {
                    y: 0, autoAlpha: 1, duration: 1, stagger: 0.2, ease: "power3.out",
                    scrollTrigger: { trigger: el, start: "top 80%", toggleActions: "play none none reverse" }
                }
            );
        });

        // 5. Metric Rise
        const metricRises = document.querySelectorAll('.gs-metric-rise');
        metricRises.forEach(el => {
            const children = el.children;
            if(children.length === 0) return;
            gsap.fromTo(children, 
                { y: 50, autoAlpha: 0 },
                {
                    y: 0, autoAlpha: 1, duration: 1, stagger: 0.15, ease: "back.out(1.2)",
                    scrollTrigger: { trigger: el, start: "top 85%", toggleActions: "play none none reverse" }
                }
            );
        });

        // 6. Gallery Sweep
        const gallerySweeps = document.querySelectorAll('.gs-gallery-sweep');
        gallerySweeps.forEach(sweep => {
            const items = sweep.querySelectorAll('.gallery-item, figure');
            if(items.length === 0) return;
            gsap.fromTo(items,
                { x: 30, autoAlpha: 0 },
                {
                    x: 0, autoAlpha: 1, duration: 0.8, stagger: 0.1, ease: "power2.out",
                    scrollTrigger: { trigger: sweep, start: "top 75%", toggleActions: "play none none reverse" }
                }
            );
        });
        
        // 7. Map Expansion
        const mapExpand = document.querySelectorAll('.gs-map-expand');
        mapExpand.forEach(map => {
            gsap.fromTo(map,
                { scale: 0.95, autoAlpha: 0 },
                {
                    scale: 1, autoAlpha: 1, duration: 1, ease: "power3.out",
                    scrollTrigger: { trigger: map, start: "top 80%", toggleActions: "play none none reverse" }
                }
            );
        });
    }

    // Accessibility: ESC to close
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isOpen) {
            if (useFallback) {
                toggleMenuFallback();
            } else {
                trigger.click();
            }
            trigger.focus();
        }
    });

});
