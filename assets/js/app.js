/**
 * ZERO OUTPUT — App
 * Mobile navigation drawer wiring (toggle button lives in header.php,
 * drawer/overlay markup lives in components/mobile-nav.php).
 */

(function () {
    function initMobileNav() {
        var toggle = document.getElementById('mobile-nav-toggle');
        var nav = document.querySelector('[data-mobile-nav]');

        if (!toggle || !nav) {
            return;
        }

        var overlay = nav.querySelector('[data-mobile-nav-overlay]');
        var closeBtn = nav.querySelector('[data-mobile-nav-close]');
        var links = nav.querySelectorAll('[data-mobile-nav-link]');

        function isOpen() {
            return nav.classList.contains('is-open');
        }

        function openNav() {
            nav.classList.add('is-open');
            toggle.setAttribute('aria-expanded', 'true');
            document.body.classList.add('mobile-nav-locked');
        }

        function closeNav() {
            nav.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('mobile-nav-locked');
        }

        toggle.setAttribute('aria-expanded', 'false');

        toggle.addEventListener('click', function () {
            if (isOpen()) {
                closeNav();
            } else {
                openNav();
            }
        });

        if (overlay) {
            overlay.addEventListener('click', closeNav);
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeNav);
        }

        links.forEach(function (link) {
            link.addEventListener('click', closeNav);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && isOpen()) {
                closeNav();
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 760 && isOpen()) {
                closeNav();
            }
        });
    }

    /**
     * Emergency Stop — confirm modal + engaged banner state machine.
     * Demo UI state only: no ESP32/hardware command is ever sent here.
     *
     * Trigger buttons can live anywhere on the page (e.g. the floating
     * global button and the one in the Rover Control panel both reuse this
     * same modal), so triggers are queried document-wide rather than
     * scoped to the [data-estop] root that holds the modal/banner markup.
     */
    function initEstopModal() {
        var root = document.querySelector('[data-estop]');

        if (!root) {
            return;
        }

        var triggers = document.querySelectorAll('[data-estop-trigger]');
        var overlay = root.querySelector('[data-estop-overlay]');
        var cancelBtn = root.querySelector('[data-estop-cancel]');
        var confirmBtn = root.querySelector('[data-estop-confirm]');
        var banner = root.querySelector('[data-estop-banner]');
        var resetBtn = root.querySelector('[data-estop-reset]');
        var lastTrigger = null;

        function setState(state) {
            root.setAttribute('data-estop-state', state);

            if (overlay) {
                overlay.hidden = state !== 'confirming';
            }

            if (banner) {
                banner.hidden = state !== 'active';
            }

            document.body.classList.toggle('estop-locked', state === 'confirming');
        }

        function openConfirm(event) {
            lastTrigger = (event && event.currentTarget) || lastTrigger;
            setState('confirming');

            if (cancelBtn) {
                cancelBtn.focus();
            }
        }

        function cancel() {
            setState('idle');

            if (lastTrigger) {
                lastTrigger.focus();
            }
        }

        function confirmStop() {
            setState('active');

            if (resetBtn) {
                resetBtn.focus();
            }
        }

        function reset() {
            setState('idle');

            if (lastTrigger) {
                lastTrigger.focus();
            }
        }

        triggers.forEach(function (trigger) {
            trigger.addEventListener('click', openConfirm);
        });

        if (cancelBtn) {
            cancelBtn.addEventListener('click', cancel);
        }

        if (confirmBtn) {
            confirmBtn.addEventListener('click', confirmStop);
        }

        if (resetBtn) {
            resetBtn.addEventListener('click', reset);
        }

        if (overlay) {
            overlay.addEventListener('click', function (event) {
                if (event.target === overlay) {
                    cancel();
                }
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && root.getAttribute('data-estop-state') === 'confirming') {
                cancel();
            }
        });

        setState('idle');
    }

    /**
     * Rover Control speed readout — keeps the "current speed" label in sync
     * with the slider. Visual/demo only: nothing here sends a speed command
     * anywhere, it just mirrors the input's own value back onto the page.
     */
    function initRoverControlSpeed() {
        var slider = document.getElementById('speed-slider');
        var value = document.getElementById('speed-value');

        if (!slider || !value) {
            return;
        }

        slider.addEventListener('input', function () {
            value.textContent = slider.value + '%';
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initMobileNav();
            initEstopModal();
            initRoverControlSpeed();
        });
    } else {
        initMobileNav();
        initEstopModal();
        initRoverControlSpeed();
    }
})();
