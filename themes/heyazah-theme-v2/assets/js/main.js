/**
 * Heyazah Pro Theme - Main JavaScript
 * World-class animations and interactions
 */
document.addEventListener("DOMContentLoaded", function () {
    initScrollReveal();
    initCounterAnimation();
    initVideoHero();
});

/* ── Scroll Reveal (single system using .hz-reveal / .is-visible) ── */
function initScrollReveal() {
    var els = document.querySelectorAll(".hz-reveal");
    if (!els.length) return;
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08, rootMargin: "0px 0px -30px 0px" });
    els.forEach(function (el) { observer.observe(el); });
}

/* ── Counter Animation ── */
function initCounterAnimation() {
    var counters = document.querySelectorAll(".hz-stat-number");
    if (!counters.length) return;
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });
    counters.forEach(function (counter) { observer.observe(counter); });
}

function animateCounter(el) {
    var text = el.textContent.trim();
    var suffix = text.replace(/[0-9]/g, "");
    var target = parseInt(text);
    if (isNaN(target)) return;
    var duration = 2000;
    var startTime = null;
    function step(timestamp) {
        if (!startTime) startTime = timestamp;
        var progress = Math.min((timestamp - startTime) / duration, 1);
        var ease = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(ease * target) + suffix;
        if (progress < 1) requestAnimationFrame(step);
        else el.textContent = target + suffix;
    }
    requestAnimationFrame(step);
}

/* ── Video Hero ── */
function initVideoHero() {
    var video = document.querySelector(".hz-hero-video");
    if (!video) return;
    video.playbackRate = 0.8;
    video.addEventListener("canplay", function () { video.style.opacity = "1"; });
    var hero = document.querySelector(".hz-hero, .heyazah-video-hero");
    if (hero) {
        var ticking = false;
        window.addEventListener("scroll", function () {
            if (!ticking) {
                requestAnimationFrame(function () {
                    var scrolled = window.pageYOffset;
                    var heroH = hero.offsetHeight;
                    if (scrolled < heroH) {
                        if (video) video.style.transform = "translate(-50%,-50%) scale(" + (1 + scrolled * 0.0003) + ")";
                        var overlay = hero.querySelector(".hz-hero-overlay, .hero-overlay");
                        if (overlay) overlay.style.opacity = 0.6 + (scrolled / heroH) * 0.3;
                    }
                    ticking = false;
                });
                ticking = true;
            }
        });
    }
}
