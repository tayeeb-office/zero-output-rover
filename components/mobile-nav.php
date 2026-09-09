<?php
/**
 * ZERO OUTPUT — Mobile Navigation
 * Off-canvas drawer (all operational pages) + bottom tab bar (quick access),
 * shown below the 760px breakpoint. Opened via #mobile-nav-toggle in header.php.
 * Per design-reference/mission-control (Mobile Drawer + Mobile Bottom Nav).
 */

$zoCurrentPage = $zoCurrentPage ?? basename(parse_url($_SERVER['SCRIPT_NAME'] ?? '', PHP_URL_PATH));

$zoMobileNavGroups = [
    [
        'label' => 'Command Center',
        'items' => [
            ['label' => 'Command Center', 'href' => 'index.php', 'icon' => 'dashboard'],
        ],
    ],
    [
        'label' => 'Live Operations',
        'items' => [
            ['label' => 'Live Monitoring', 'href' => 'monitoring.php', 'icon' => 'activity'],
            ['label' => 'Rover Control', 'href' => 'rover-control.php', 'icon' => 'gamepad'],
            ['label' => 'Live Camera', 'href' => 'camera.php', 'icon' => 'camera'],
        ],
    ],
    [
        'label' => 'Mapping',
        'items' => [
            ['label' => 'Hazard Map', 'href' => 'hazard-map.php', 'icon' => 'map'],
            ['label' => 'Mission Path', 'href' => 'mission-path.php', 'icon' => 'route'],
        ],
    ],
    [
        'label' => 'Analytics',
        'items' => [
            ['label' => 'Mission History', 'href' => 'mission-history.php', 'icon' => 'history'],
            ['label' => 'Sensor Analytics', 'href' => 'sensor-analytics.php', 'icon' => 'chart'],
            ['label' => 'Time-Series Comparison', 'href' => 'time-series.php', 'icon' => 'compare'],
        ],
    ],
    [
        'label' => 'System',
        'items' => [
            ['label' => 'Rover Status', 'href' => 'rover-status.php', 'icon' => 'cpu'],
            ['label' => 'Settings', 'href' => 'settings.php', 'icon' => 'settings'],
        ],
    ],
];

$zoMobileTabs = [
    ['label' => 'Home', 'href' => 'index.php', 'icon' => 'dashboard'],
    ['label' => 'Camera', 'href' => 'camera.php', 'icon' => 'camera'],
    ['label' => 'Control', 'href' => 'rover-control.php', 'icon' => 'gamepad'],
    ['label' => 'Map', 'href' => 'hazard-map.php', 'icon' => 'map'],
    ['label' => 'System', 'href' => 'rover-status.php', 'icon' => 'cpu'],
];

if (!function_exists('zo_mobile_nav_icon')) {
    function zo_mobile_nav_icon(string $name, string $class = 'mobile-nav__link-icon'): string
    {
        $paths = [
            'dashboard' => '<rect x="3" y="3" width="7" height="9" rx="1.5"></rect><rect x="14" y="3" width="7" height="5" rx="1.5"></rect><rect x="14" y="12" width="7" height="9" rx="1.5"></rect><rect x="3" y="16" width="7" height="5" rx="1.5"></rect>',
            'activity'  => '<polyline points="3 12 8 12 10 6 14 18 16 12 21 12"></polyline>',
            'gamepad'   => '<rect x="2" y="7" width="20" height="11" rx="5.5"></rect><line x1="7" y1="10.5" x2="7" y2="14.5"></line><line x1="5" y1="12.5" x2="9" y2="12.5"></line><circle cx="15" cy="10.5" r="1"></circle><circle cx="18" cy="13.5" r="1"></circle>',
            'camera'    => '<path d="M4 8h3l1.5-2h7L17 8h3a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"></path><circle cx="12" cy="13" r="3.5"></circle>',
            'map'       => '<polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"></polygon><line x1="9" y1="3" x2="9" y2="18"></line><line x1="15" y1="6" x2="15" y2="21"></line>',
            'route'     => '<circle cx="6" cy="18" r="2.5"></circle><circle cx="18" cy="6" r="2.5"></circle><path d="M8.2 16.8 15.8 7.2"></path>',
            'history'   => '<path d="M3 12a9 9 0 1 0 3-6.7"></path><polyline points="3 3 3 8 8 8"></polyline><polyline points="12 7 12 12 16 14"></polyline>',
            'chart'     => '<polyline points="3 17 9 10 13 14 21 5"></polyline><polyline points="15 5 21 5 21 11"></polyline>',
            'compare'   => '<path d="M7 3v14"></path><path d="M17 21V7"></path><polyline points="3 7 7 3 11 7"></polyline><polyline points="21 17 17 21 13 17"></polyline>',
            'cpu'       => '<rect x="7" y="7" width="10" height="10" rx="1.5"></rect><rect x="10" y="10" width="4" height="4"></rect><line x1="12" y1="2" x2="12" y2="5"></line><line x1="12" y1="19" x2="12" y2="22"></line><line x1="2" y1="12" x2="5" y2="12"></line><line x1="19" y1="12" x2="22" y2="12"></line>',
            'settings'  => '<line x1="4" y1="6" x2="20" y2="6"></line><circle cx="9" cy="6" r="2"></circle><line x1="4" y1="12" x2="20" y2="12"></line><circle cx="15" cy="12" r="2"></circle><line x1="4" y1="18" x2="20" y2="18"></line><circle cx="9" cy="18" r="2"></circle>',
            'close'     => '<line x1="6" y1="6" x2="18" y2="18"></line><line x1="18" y1="6" x2="6" y2="18"></line>',
        ];

        $inner = $paths[$name] ?? '<circle cx="12" cy="12" r="8"></circle>';

        return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
    }
}
?>
<div class="mobile-nav" data-mobile-nav>
    <div class="mobile-nav__overlay" data-mobile-nav-overlay></div>

    <aside class="mobile-nav__drawer" data-mobile-nav-drawer role="dialog" aria-modal="true" aria-label="Navigation">
        <div class="mobile-nav__header">
            <img src="assets/images/zero-output-logo.png" alt="ZERO OUTPUT" class="mobile-nav__logo">
            <div class="mobile-nav__brand">
                <span class="mobile-nav__title">ZERO OUTPUT</span>
                <span class="mobile-nav__subtitle">Disaster Rover Control</span>
            </div>
            <button type="button" class="mobile-nav__close" data-mobile-nav-close aria-label="Close navigation">
                <?php echo zo_mobile_nav_icon('close', 'mobile-nav__close-icon'); ?>
            </button>
        </div>

        <nav class="mobile-nav__body">
            <?php foreach ($zoMobileNavGroups as $group): ?>
            <div class="mobile-nav__group">
                <div class="mobile-nav__group-label"><?php echo htmlspecialchars($group['label']); ?></div>
                <?php foreach ($group['items'] as $item):
                    $isActive = $zoCurrentPage === $item['href'];
                ?>
                <a href="<?php echo htmlspecialchars($item['href']); ?>" class="mobile-nav__link<?php echo $isActive ? ' is-active' : ''; ?>"<?php echo $isActive ? ' aria-current="page"' : ''; ?> data-mobile-nav-link>
                    <?php echo zo_mobile_nav_icon($item['icon']); ?>
                    <span class="mobile-nav__link-label"><?php echo htmlspecialchars($item['label']); ?></span>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </nav>
    </aside>
</div>

<nav class="mobile-tabbar" data-mobile-tabbar aria-label="Primary">
    <?php foreach ($zoMobileTabs as $tab):
        $isActive = $zoCurrentPage === $tab['href'];
    ?>
    <a href="<?php echo htmlspecialchars($tab['href']); ?>" class="mobile-tabbar__item<?php echo $isActive ? ' is-active' : ''; ?>"<?php echo $isActive ? ' aria-current="page"' : ''; ?>>
        <?php echo zo_mobile_nav_icon($tab['icon'], 'mobile-tabbar__icon'); ?>
        <span class="mobile-tabbar__label"><?php echo htmlspecialchars($tab['label']); ?></span>
    </a>
    <?php endforeach; ?>
</nav>
