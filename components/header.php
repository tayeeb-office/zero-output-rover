<?php
/**
 * ZERO OUTPUT — Top Header
 * Mission Control header bar, per design-reference/mission-control.
 *
 * Pages may set $zoPageTitle and $zoPageSubtitle before including this
 * file to override the defaults below.
 */

$zoPageTitle    = $zoPageTitle ?? 'Command Center';
$zoPageSubtitle = $zoPageSubtitle ?? 'Disaster Mapping Rover';
?>
<header class="header">
    <div class="header__left">
        <button type="button" class="header__nav-toggle" id="mobile-nav-toggle" aria-label="Toggle navigation">
            <svg class="header__nav-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
        <img src="assets/images/zero-output-logo.png" alt="ZERO OUTPUT" class="header__logo">
        <div class="header__titles">
            <h1 class="header__page-title" id="page-title"><?php echo htmlspecialchars($zoPageTitle); ?></h1>
            <p class="header__page-subtitle" id="page-subtitle"><?php echo htmlspecialchars($zoPageSubtitle); ?></p>
        </div>
    </div>

    <div class="header__right">
        <div class="header__status-pill" id="rover-connection-status" data-rover-connection>
            <span class="header__status-dot"></span>
            <span class="header__status-label" id="rover-connection-label">ONLINE</span>
        </div>

        <div class="header__meta-item" id="battery-status">
            <svg class="header__meta-icon header__meta-icon--battery" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="2" y="7" width="17" height="10" rx="2"></rect>
                <line x1="22" y1="10.5" x2="22" y2="13.5"></line>
            </svg>
            <span class="header__meta-value" id="battery-value">--%</span>
        </div>

        <div class="header__meta-item" id="mission-timer-wrap">
            <svg class="header__meta-icon header__meta-icon--timer" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="13" r="8"></circle>
                <polyline points="12 9 12 13 15 15"></polyline>
                <line x1="9" y1="1.5" x2="15" y2="1.5"></line>
            </svg>
            <span class="header__meta-value" id="mission-timer">00:00:00</span>
        </div>

        <button type="button" class="header__alert-button" id="header-alert-button" aria-label="Alerts">
            <svg class="header__alert-icon" viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"></path>
                <path d="M10.5 18.5a1.8 1.8 0 0 0 3 0"></path>
            </svg>
            <span class="header__alert-badge" id="alert-badge"></span>
        </button>
    </div>
</header>
