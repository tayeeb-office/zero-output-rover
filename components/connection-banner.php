<?php
/**
 * ZERO OUTPUT — Rover Connection Banner
 * Reusable full-width status banner, per design-reference/mission-control
 * (disconnect banner) extended with a CONNECTING state.
 *
 * Pages may set $zoConnectionState to 'CONNECTED' | 'CONNECTING' | 'DISCONNECTED'
 * before including this file (defaults to 'CONNECTED'). Set
 * $zoConnectionDemoCycle = true to auto-cycle the banner through all three
 * states for visual preview — this is demo-only UI state, not a real link.
 */

$zoConnectionState = strtoupper((string) ($zoConnectionState ?? 'CONNECTED'));
$zoConnectionStates = ['CONNECTED', 'CONNECTING', 'DISCONNECTED'];
if (!in_array($zoConnectionState, $zoConnectionStates, true)) {
    $zoConnectionState = 'CONNECTED';
}
$zoConnectionDemoCycle = $zoConnectionDemoCycle ?? false;

$zoConnectionCopy = [
    'CONNECTED' => [
        'title' => 'ROVER CONNECTED',
        'lines' => ['Live telemetry and control link active'],
    ],
    'CONNECTING' => [
        'title' => 'CONNECTING TO ROVER',
        'lines' => ['Attempting to re-establish the link', 'Controls temporarily disabled'],
    ],
    'DISCONNECTED' => [
        'title' => 'ROVER DISCONNECTED',
        'lines' => ['Motors automatically stopped', 'Controls disabled'],
    ],
];

if (!function_exists('zo_connection_banner_icon')) {
    function zo_connection_banner_icon(string $state): string
    {
        $paths = [
            'CONNECTED'    => '<circle cx="12" cy="12" r="9"></circle><polyline points="8 12.5 11 15.5 16 9"></polyline>',
            'CONNECTING'   => '<path d="M21 12a9 9 0 1 1-9-9"></path>',
            'DISCONNECTED' => '<path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line>',
        ];

        $inner = $paths[$state] ?? $paths['CONNECTED'];

        return '<svg class="connection-banner__icon-svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
    }
}

$zoActiveCopy   = $zoConnectionCopy[$zoConnectionState];
$zoStateSlug    = strtolower($zoConnectionState);
$zoIsUrgent     = $zoConnectionState !== 'CONNECTED';
?>
<div class="connection-banner is-<?php echo $zoStateSlug; ?>"
     data-connection-banner
     data-connection-state="<?php echo $zoStateSlug; ?>"
     <?php echo $zoConnectionDemoCycle ? 'data-connection-banner-demo-cycle' : ''; ?>
     role="<?php echo $zoIsUrgent ? 'alert' : 'status'; ?>"
     aria-live="<?php echo $zoIsUrgent ? 'assertive' : 'polite'; ?>">
    <span class="connection-banner__icon" data-connection-banner-icon>
        <?php echo zo_connection_banner_icon($zoConnectionState); ?>
    </span>

    <div class="connection-banner__body">
        <div class="connection-banner__title" data-connection-banner-title><?php echo htmlspecialchars($zoActiveCopy['title']); ?></div>
        <ul class="connection-banner__lines" data-connection-banner-lines>
            <?php foreach ($zoActiveCopy['lines'] as $line): ?>
            <li class="connection-banner__line"><?php echo htmlspecialchars($line); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <button type="button"
            class="connection-banner__action"
            data-connection-banner-reconnect
            <?php echo $zoConnectionState === 'DISCONNECTED' ? '' : 'hidden'; ?>>
        Reconnect
    </button>
</div>

<script>
(function () {
    if (window.ZeroOutput && window.ZeroOutput.connectionBanner) {
        return;
    }

    var ICONS = {
        connected: '<circle cx="12" cy="12" r="9"></circle><polyline points="8 12.5 11 15.5 16 9"></polyline>',
        connecting: '<path d="M21 12a9 9 0 1 1-9-9"></path>',
        disconnected: '<path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line>'
    };

    var COPY = {
        connected: { title: 'ROVER CONNECTED', lines: ['Live telemetry and control link active'] },
        connecting: { title: 'CONNECTING TO ROVER', lines: ['Attempting to re-establish the link', 'Controls temporarily disabled'] },
        disconnected: { title: 'ROVER DISCONNECTED', lines: ['Motors automatically stopped', 'Controls disabled'] }
    };

    var CYCLE = ['connected', 'connecting', 'disconnected', 'connecting'];

    /**
     * Visual/demo state transition only — this never opens a socket or
     * polls a real link, it just re-renders the banner for a given state.
     */
    function setState(banner, state) {
        if (!COPY[state] || !banner) {
            return;
        }

        var isUrgent = state !== 'connected';

        banner.className = 'connection-banner is-' + state;
        banner.setAttribute('data-connection-state', state);
        banner.setAttribute('role', isUrgent ? 'alert' : 'status');
        banner.setAttribute('aria-live', isUrgent ? 'assertive' : 'polite');

        var iconWrap = banner.querySelector('[data-connection-banner-icon]');
        if (iconWrap) {
            iconWrap.innerHTML = '<svg class="connection-banner__icon-svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' + ICONS[state] + '</svg>';
        }

        var title = banner.querySelector('[data-connection-banner-title]');
        if (title) {
            title.textContent = COPY[state].title;
        }

        var linesWrap = banner.querySelector('[data-connection-banner-lines]');
        if (linesWrap) {
            linesWrap.innerHTML = '';
            COPY[state].lines.forEach(function (line) {
                var li = document.createElement('li');
                li.className = 'connection-banner__line';
                li.textContent = line;
                linesWrap.appendChild(li);
            });
        }

        var action = banner.querySelector('[data-connection-banner-reconnect]');
        if (action) {
            action.hidden = state !== 'disconnected';
        }
    }

    function initReconnectDemo(banner) {
        var action = banner.querySelector('[data-connection-banner-reconnect]');
        if (!action) {
            return;
        }

        action.addEventListener('click', function () {
            if (banner.getAttribute('data-connection-demo-busy') === '1') {
                return;
            }

            banner.setAttribute('data-connection-demo-busy', '1');
            setState(banner, 'connecting');

            window.setTimeout(function () {
                setState(banner, 'connected');
                banner.removeAttribute('data-connection-demo-busy');
            }, 1600);
        });
    }

    function initDemoCycle(banner) {
        if (!banner.hasAttribute('data-connection-banner-demo-cycle')) {
            return;
        }

        var index = 0;
        window.setInterval(function () {
            index = (index + 1) % CYCLE.length;
            setState(banner, CYCLE[index]);
        }, 3200);
    }

    function init() {
        document.querySelectorAll('[data-connection-banner]').forEach(function (banner) {
            initReconnectDemo(banner);
            initDemoCycle(banner);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    window.ZeroOutput = window.ZeroOutput || {};
    window.ZeroOutput.connectionBanner = { setState: setState };
})();
</script>
