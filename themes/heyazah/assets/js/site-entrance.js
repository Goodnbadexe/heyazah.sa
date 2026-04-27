(function () {
    'use strict';

    var entrance = document.querySelector('[data-site-entrance]');

    if (!entrance) {
        return;
    }

    var storageKey = 'heyazahSiteEntranceSeen';
    var oncePerSession = entrance.getAttribute('data-once-per-session') !== 'false';
    var iframe = entrance.querySelector('.heyazah-site-entrance__frame');
    var enter = entrance.querySelector('[data-site-entrance-enter]');
    var closeButtons = entrance.querySelectorAll('[data-site-entrance-close]');
    var phase = entrance.querySelector('[data-site-entrance-phase]');
    var phaseLabel = entrance.querySelector('[data-site-entrance-phase-label]');
    var progress = entrance.querySelector('[data-site-entrance-progress]');
    var fallbackLink = entrance.querySelector('[data-site-entrance-fallback]');
    var scrollCue = entrance.querySelector('[data-site-entrance-scroll-cue]');
    var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var maxBeat = window.matchMedia && window.matchMedia('(max-width: 767px)').matches ? 2 : 3;
    var beat = 0;
    var state = 'gate';
    var lastAdvance = 0;
    var touchStartY = null;
    var frameLoaded = false;
    var fallbackTimer = null;
    var phaseLabels = {
        0: entrance.getAttribute('dir') === 'rtl' || document.documentElement.getAttribute('dir') === 'rtl' ? 'البداية' : 'Arrival',
        1: entrance.getAttribute('dir') === 'rtl' || document.documentElement.getAttribute('dir') === 'rtl' ? 'الحضور' : 'Presence',
        2: entrance.getAttribute('dir') === 'rtl' || document.documentElement.getAttribute('dir') === 'rtl' ? 'المشهد' : 'World',
        3: entrance.getAttribute('dir') === 'rtl' || document.documentElement.getAttribute('dir') === 'rtl' ? 'الانتقال' : 'Release'
    };

    function markSeen() {
        if (oncePerSession && window.sessionStorage) {
            window.sessionStorage.setItem(storageKey, '1');
        }
    }

    function setState(nextState) {
        state = nextState;
        entrance.setAttribute('data-state', state);
        entrance.classList.toggle('is-entered', state !== 'gate');
        entrance.classList.toggle('is-scroll-mode', state === 'scroll-mode');
        entrance.classList.toggle('is-exiting', state === 'exiting');
        entrance.classList.toggle('is-complete', state === 'complete');
    }

    function updateBeat(nextBeat) {
        beat = Math.max(0, Math.min(maxBeat, nextBeat));
        entrance.setAttribute('data-beat', String(beat));

        if (phase) {
            phase.textContent = '0' + Math.max(1, beat + 1);
        }

        if (phaseLabel) {
            phaseLabel.textContent = phaseLabels[Math.min(beat, maxBeat)] || phaseLabels[maxBeat];
        }

        if (progress) {
            progress.style.width = (((beat + 1) / (maxBeat + 1)) * 100) + '%';
        }
    }

    function removeEntrance() {
        entrance.classList.add('is-hidden');
        document.documentElement.classList.remove('has-heyazah-site-entrance');

        window.setTimeout(function () {
            if (entrance && entrance.parentNode) {
                entrance.parentNode.removeChild(entrance);
            }
        }, prefersReducedMotion ? 0 : 750);
    }

    function completeEntrance() {
        if (state !== 'exiting') {
            setState('exiting');
        }

        entrance.classList.add('is-complete');
        markSeen();
        removeEntrance();
    }

    function skipEntrance() {
        setState('exiting');
        completeEntrance();
    }

    function loadFrame() {
        if (!iframe || iframe.getAttribute('src')) {
            return;
        }

        var src = iframe.getAttribute('data-src');

        if (!src) {
            return;
        }

        iframe.setAttribute('src', src);
        iframe.addEventListener('load', function () {
            frameLoaded = true;
            entrance.classList.add('is-loaded');
            entrance.classList.add('is-ready');
            entrance.classList.remove('is-fallback');
        }, { once: true });

        iframe.addEventListener('error', function () {
            entrance.classList.add('is-fallback');
        }, { once: true });

        fallbackTimer = window.setTimeout(function () {
            if (!frameLoaded) {
                entrance.classList.add('is-fallback');
            }
        }, 5000);

        window.setTimeout(function () {
            entrance.classList.add('is-loaded');
            entrance.classList.add('is-ready');
        }, 5000);
    }

    if (oncePerSession && window.sessionStorage && window.sessionStorage.getItem(storageKey) === '1') {
        removeEntrance();
        return;
    }

    document.documentElement.classList.add('has-heyazah-site-entrance');
    updateBeat(0);

    if (!prefersReducedMotion) {
        loadFrame();
    }

    function enterScrollMode() {
        loadFrame();

        if (prefersReducedMotion) {
            completeEntrance();
            return;
        }

        setState('entered');
        setState('scroll-mode');
        updateBeat(1);
    }

    function advance(delta) {
        var now = Date.now();

        if (now - lastAdvance < 650) {
            return;
        }

        lastAdvance = now;

        if (state === 'gate') {
            enterScrollMode();
            return;
        }

        if (state !== 'scroll-mode') {
            return;
        }

        if (delta < 0 && beat > 1) {
            updateBeat(beat - 1);
            return;
        }

        if (beat >= maxBeat) {
            setState('exiting');
            completeEntrance();
            return;
        }

        updateBeat(beat + 1);
    }

    if (enter) {
        enter.addEventListener('click', enterScrollMode);
    }

    if (fallbackLink) {
        fallbackLink.addEventListener('click', function () {
            markSeen();
        });
    }

    closeButtons.forEach(function (button) {
        button.addEventListener('click', skipEntrance);
    });

    entrance.addEventListener('wheel', function (event) {
        if (state === 'complete' || state === 'exiting') {
            return;
        }

        event.preventDefault();
        advance(event.deltaY);
    }, { passive: false });

    entrance.addEventListener('touchstart', function (event) {
        touchStartY = event.touches && event.touches.length ? event.touches[0].clientY : null;
    }, { passive: true });

    entrance.addEventListener('touchmove', function (event) {
        if (touchStartY === null || state === 'complete' || state === 'exiting') {
            return;
        }

        event.preventDefault();
        var currentY = event.touches && event.touches.length ? event.touches[0].clientY : touchStartY;
        advance(touchStartY - currentY);
        touchStartY = currentY;
    }, { passive: false });

    entrance.addEventListener('click', function (event) {
        if (event.target.closest('button')) {
            return;
        }

        if (state === 'gate') {
            enterScrollMode();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            skipEntrance();
        }

        if (event.key === 'Enter' && state === 'gate') {
            enterScrollMode();
        }

        if (event.key === 'ArrowDown' || event.key === 'PageDown' || event.key === ' ') {
            advance(1);
        }
    });

    if (scrollCue) {
        scrollCue.hidden = false;
    }
}());
