<?php
$zoPageTitle    = 'Command Center';
$zoPageSubtitle = 'Disaster Mapping Rover';

/**
 * Icons used only by the Command Center panel headers on this page.
 */
if (!function_exists('zo_cc_icon')) {
    function zo_cc_icon(string $name): string
    {
        $paths = [
            'camera'   => '<path d="M4 8h3l1.5-2h7L17 8h3a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"></path><circle cx="12" cy="13" r="3.5"></circle>',
            'activity' => '<polyline points="3 12 8 12 10 6 14 18 16 12 21 12"></polyline>',
            'gauge'    => '<path d="M4.5 19a8.5 8.5 0 1 1 15 0"></path><line x1="12" y1="13" x2="15.5" y2="9"></line><circle cx="12" cy="13" r="1"></circle>',
            'alert'    => '<path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"></path><path d="M10.5 18.5a1.8 1.8 0 0 0 3 0"></path>',
            'gamepad'  => '<rect x="2" y="7" width="20" height="11" rx="5.5"></rect><line x1="7" y1="10.5" x2="7" y2="14.5"></line><line x1="5" y1="12.5" x2="9" y2="12.5"></line><circle cx="15" cy="10.5" r="1"></circle><circle cx="18" cy="13.5" r="1"></circle>',
            'radar'    => '<circle cx="12" cy="12" r="9"></circle><circle cx="12" cy="12" r="5"></circle><circle cx="12" cy="12" r="1"></circle><line x1="12" y1="3" x2="12" y2="12"></line>',
            'octagon'  => '<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="13"></line><line x1="12" y1="16.5" x2="12.01" y2="16.5"></line>',
            'thermometer' => '<rect x="10" y="3" width="4" height="11.5" rx="2"></rect><circle cx="12" cy="18" r="3"></circle>',
            'droplet'  => '<path d="M12 3c4 5 6 8.5 6 11.5A6 6 0 0 1 6 14.5C6 11.5 8 8 12 3Z"></path>',
            'wind'     => '<path d="M3 8h11.5a2.5 2.5 0 1 0-2.3-3.4"></path><path d="M2.5 13h14a2.5 2.5 0 1 1-2.3 3.4"></path><path d="M4 18h9.5"></path>',
            'cloud'    => '<path d="M6.5 18a4 4 0 0 1 .4-8 5.2 5.2 0 0 1 10 1.4A3.4 3.4 0 0 1 16.3 18Z"></path>',
            'person'   => '<circle cx="12" cy="7.2" r="3.3"></circle><path d="M5 20c0-3.9 3.1-7 7-7s7 3.1 7 7"></path>',
            'ruler'    => '<path d="M3 12h18"></path><path d="M7 8.2 3 12l4 3.8"></path><path d="M17 8.2 21 12l-4 3.8"></path>',
            'compass'  => '<circle cx="12" cy="12" r="9"></circle><path d="M14.8 9.2 13 13l-3.8 1.8L11 11l3.8-1.8Z"></path>',
            'battery'  => '<rect x="2" y="7" width="17" height="10" rx="2"></rect><line x1="22" y1="10.5" x2="22" y2="13.5"></line>',
        ];

        $inner = $paths[$name] ?? '<circle cx="12" cy="12" r="8"></circle>';

        return '<svg class="panel__icon-svg" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
    }
}

/**
 * Overall Risk Assessment — static placeholder data only.
 * No risk score is computed here; these are fixed demo values matching the
 * "MEDIUM RISK · 58/100" placeholder requested for this presentation-only
 * section. A future data layer will replace this array, not add logic to it.
 */
$zoRiskGaugeSegments = [
    ['zone' => 'low', 'filled' => true],  ['zone' => 'low', 'filled' => true],
    ['zone' => 'low', 'filled' => true],  ['zone' => 'low', 'filled' => true],
    ['zone' => 'low', 'filled' => true],  ['zone' => 'low', 'filled' => true],
    ['zone' => 'low', 'filled' => true],
    ['zone' => 'medium', 'filled' => true],  ['zone' => 'medium', 'filled' => true],
    ['zone' => 'medium', 'filled' => true],  ['zone' => 'medium', 'filled' => true],
    ['zone' => 'medium', 'filled' => true],  ['zone' => 'medium', 'filled' => false],
    ['zone' => 'medium', 'filled' => false],
    ['zone' => 'high', 'filled' => false],  ['zone' => 'high', 'filled' => false],
    ['zone' => 'high', 'filled' => false],  ['zone' => 'high', 'filled' => false],
    ['zone' => 'high', 'filled' => false],  ['zone' => 'high', 'filled' => false],
];

$zoRiskFactors = [
    ['label' => 'Temperature',     'value' => '24.6°C',  'percent' => 22, 'tier' => 'low'],
    ['label' => 'Gas',             'value' => 'SAFE',     'percent' => 18, 'tier' => 'low'],
    ['label' => 'Human Presence',  'value' => 'DETECTED', 'percent' => 72, 'tier' => 'medium'],
    ['label' => 'Rover Stability', 'value' => 'STABLE',   'percent' => 15, 'tier' => 'low'],
    ['label' => 'Path Clearance',  'value' => '182 cm',   'percent' => 30, 'tier' => 'low'],
];

/**
 * Live Alerts — static demo entries only. No alert generation logic and no
 * database/API calls; this is a fixed list for presentation purposes.
 */
$zoLiveAlerts = [
    ['severity' => 'warning', 'message' => 'Elevated CO reading detected', 'time' => '2 min ago'],
    ['severity' => 'warning', 'message' => 'Human presence detected',      'time' => '4 min ago'],
    ['severity' => 'normal',  'message' => 'Rover stability normal',       'time' => '5 min ago'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZERO OUTPUT — Command Center</title>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
    <div class="app-shell">
        <?php include __DIR__ . '/components/sidebar.php'; ?>

        <div class="app-shell__body">
            <?php include __DIR__ . '/components/header.php'; ?>
            <?php include __DIR__ . '/components/connection-banner.php'; ?>

            <main class="main-content">
                <div class="command-center">

                    <!-- Mission Status -->
                    <section class="mission-status" aria-label="Mission Status">
                        <div class="mission-status__badge">
                            <span class="mission-status__badge-dot"></span>
                            <span class="mission-status__badge-label" id="mission-status">MISSION ACTIVE</span>
                        </div>
                        <div class="mission-status__divider"></div>
                        <div class="mission-status__stats">
                            <div class="mission-status__stat">
                                <span class="mission-status__stat-label">MISSION</span>
                                <span class="mission-status__stat-value" id="mission-name">Building Collapse — Sector A</span>
                            </div>
                            <div class="mission-status__stat">
                                <span class="mission-status__stat-label">MISSION ID</span>
                                <span class="mission-status__stat-value" id="mission-id">#024</span>
                            </div>
                            <div class="mission-status__stat">
                                <span class="mission-status__stat-label">ELAPSED TIME</span>
                                <span class="mission-status__stat-value mission-status__stat-value--mono" id="mission-status-timer">00:24:18</span>
                            </div>
                            <div class="mission-status__stat">
                                <span class="mission-status__stat-label">ROVER</span>
                                <span class="mission-status__stat-value mission-status__stat-value--safe" id="mission-status-rover">ONLINE</span>
                            </div>
                        </div>
                        <div class="mission-status__stat mission-status__stat--risk">
                            <span class="mission-status__stat-label">OVERALL RISK</span>
                            <span class="mission-status__stat-value mission-status__stat-value--warning" id="mission-risk-level">MEDIUM</span>
                        </div>
                    </section>

                    <div class="command-center__grid">

                        <!-- Main column -->
                        <div class="command-center__main">

                            <!-- Live Camera -->
                            <section class="panel camera-panel" aria-labelledby="live-camera-title" id="live-camera">
                                <header class="panel__header">
                                    <div class="panel__heading">
                                        <span class="panel__icon"><?php echo zo_cc_icon('camera'); ?></span>
                                        <h2 class="panel__title" id="live-camera-title">Live Camera</h2>
                                        <span class="camera-panel__source" id="camera-source">ESP32-CAM · FRONT</span>
                                    </div>
                                    <span class="camera-panel__status" id="camera-connection-status" data-camera-connection="offline">
                                        <span class="camera-panel__status-dot"></span>
                                        <span class="camera-panel__status-label" id="camera-connection-label">NOT CONNECTED</span>
                                    </span>
                                </header>

                                <div class="camera-feed" id="camera-feed" data-camera-state="offline">
                                    <div class="camera-feed__placeholder">
                                        <span class="camera-feed__placeholder-icon"><?php echo zo_cc_icon('camera'); ?></span>
                                        <div class="camera-feed__placeholder-title">CAMERA FEED</div>
                                        <div class="camera-feed__placeholder-subtitle" id="camera-feed-message">Waiting for ESP32-CAM</div>
                                    </div>

                                    <div class="camera-feed__overlay camera-feed__overlay--top-left">
                                        <span class="camera-feed__live" id="camera-live-indicator" data-camera-live="false">
                                            <span class="camera-feed__live-dot"></span>
                                            <span class="camera-feed__live-label">LIVE</span>
                                        </span>
                                    </div>

                                    <div class="camera-feed__overlay camera-feed__overlay--top-right">
                                        <span class="camera-feed__signal" id="camera-signal-status">SIGNAL — NO DATA</span>
                                    </div>

                                    <div class="camera-feed__overlay camera-feed__overlay--bottom-left">
                                        <span class="camera-feed__timestamp" id="camera-timestamp">--:--:--</span>
                                    </div>

                                    <div class="camera-feed__overlay camera-feed__overlay--bottom-right">
                                        <span class="camera-feed__pan-tilt" id="camera-pan-tilt-readout">PAN 0° · TILT 0°</span>
                                    </div>
                                </div>

                                <div class="camera-controls">
                                    <div class="camera-controls__group">
                                        <span class="camera-controls__label">PAN</span>
                                        <div class="camera-controls__buttons" role="group" aria-label="Camera pan controls">
                                            <button type="button" class="camera-controls__btn" id="camera-pan-left" disabled>◀</button>
                                            <button type="button" class="camera-controls__btn camera-controls__btn--center" id="camera-pan-center" disabled>●</button>
                                            <button type="button" class="camera-controls__btn" id="camera-pan-right" disabled>▶</button>
                                        </div>
                                    </div>
                                    <div class="camera-controls__group">
                                        <span class="camera-controls__label">TILT</span>
                                        <div class="camera-controls__buttons" role="group" aria-label="Camera tilt controls">
                                            <button type="button" class="camera-controls__btn" id="camera-tilt-up" disabled>▲</button>
                                            <button type="button" class="camera-controls__btn camera-controls__btn--center" id="camera-tilt-center" disabled>●</button>
                                            <button type="button" class="camera-controls__btn" id="camera-tilt-down" disabled>▼</button>
                                        </div>
                                    </div>
                                    <div class="camera-controls__latency" id="camera-latency">latency -- ms</div>
                                </div>
                            </section>

                            <!-- Sensor Overview -->
                            <section class="panel" aria-labelledby="sensor-overview-title" id="sensor-overview">
                                <header class="panel__header">
                                    <div class="panel__heading">
                                        <span class="panel__icon"><?php echo zo_cc_icon('activity'); ?></span>
                                        <h2 class="panel__title" id="sensor-overview-title">Sensor Overview</h2>
                                    </div>
                                </header>

                                <div class="sensor-grid">

                                    <!-- Temperature -->
                                    <div class="sensor-card">
                                        <div class="sensor-card__header">
                                            <span class="sensor-card__label-group">
                                                <span class="sensor-card__icon"><?php echo zo_cc_icon('thermometer'); ?></span>
                                                <span class="sensor-card__label">Temperature</span>
                                            </span>
                                            <span class="sensor-card__status" data-status="normal">NORMAL</span>
                                        </div>
                                        <div class="sensor-card__value-row">
                                            <span class="sensor-card__value" id="temperature-value">24.6</span>
                                            <span class="sensor-card__unit">°C</span>
                                        </div>
                                        <div class="sensor-card__source">DHT22</div>
                                    </div>

                                    <!-- Humidity -->
                                    <div class="sensor-card">
                                        <div class="sensor-card__header">
                                            <span class="sensor-card__label-group">
                                                <span class="sensor-card__icon"><?php echo zo_cc_icon('droplet'); ?></span>
                                                <span class="sensor-card__label">Humidity</span>
                                            </span>
                                            <span class="sensor-card__status" data-status="normal">NORMAL</span>
                                        </div>
                                        <div class="sensor-card__value-row">
                                            <span class="sensor-card__value" id="humidity-value">58</span>
                                            <span class="sensor-card__unit">%</span>
                                        </div>
                                        <div class="sensor-card__source">DHT22</div>
                                    </div>

                                    <!-- MQ-4 Reading (Methane) -->
                                    <div class="sensor-card">
                                        <div class="sensor-card__header">
                                            <span class="sensor-card__label-group">
                                                <span class="sensor-card__icon"><?php echo zo_cc_icon('wind'); ?></span>
                                                <span class="sensor-card__label">MQ-4 Reading</span>
                                            </span>
                                            <span class="sensor-card__status" data-status="safe">SAFE</span>
                                        </div>
                                        <div class="sensor-card__value-row">
                                            <span class="sensor-card__value" id="mq4-value">182</span>
                                            <span class="sensor-card__unit">raw</span>
                                        </div>
                                        <div class="sensor-card__source">Methane · uncalibrated</div>
                                    </div>

                                    <!-- MQ-7 Reading (CO) -->
                                    <div class="sensor-card">
                                        <div class="sensor-card__header">
                                            <span class="sensor-card__label-group">
                                                <span class="sensor-card__icon"><?php echo zo_cc_icon('cloud'); ?></span>
                                                <span class="sensor-card__label">MQ-7 Reading</span>
                                            </span>
                                            <span class="sensor-card__status" data-status="safe">SAFE</span>
                                        </div>
                                        <div class="sensor-card__value-row">
                                            <span class="sensor-card__value" id="mq7-value">146</span>
                                            <span class="sensor-card__unit">raw</span>
                                        </div>
                                        <div class="sensor-card__source">CO · uncalibrated</div>
                                    </div>

                                    <!-- Human Presence -->
                                    <div class="sensor-card">
                                        <div class="sensor-card__header">
                                            <span class="sensor-card__label-group">
                                                <span class="sensor-card__icon"><?php echo zo_cc_icon('person'); ?></span>
                                                <span class="sensor-card__label">Human Presence</span>
                                            </span>
                                            <span class="sensor-card__status" data-status="detected">DETECTED</span>
                                        </div>
                                        <div class="sensor-card__value-row">
                                            <span class="sensor-card__value" id="human-value">1</span>
                                            <span class="sensor-card__unit">target</span>
                                        </div>
                                        <div class="sensor-card__source">LD2410B</div>
                                    </div>

                                    <!-- Front Distance -->
                                    <div class="sensor-card">
                                        <div class="sensor-card__header">
                                            <span class="sensor-card__label-group">
                                                <span class="sensor-card__icon"><?php echo zo_cc_icon('ruler'); ?></span>
                                                <span class="sensor-card__label">Front Distance</span>
                                            </span>
                                            <span class="sensor-card__status" data-status="safe">SAFE</span>
                                        </div>
                                        <div class="sensor-card__value-row">
                                            <span class="sensor-card__value" id="distance-value">182</span>
                                            <span class="sensor-card__unit">cm</span>
                                        </div>
                                        <div class="sensor-card__source">Ultrasonic</div>
                                    </div>

                                    <!-- Rover Tilt -->
                                    <div class="sensor-card">
                                        <div class="sensor-card__header">
                                            <span class="sensor-card__label-group">
                                                <span class="sensor-card__icon"><?php echo zo_cc_icon('compass'); ?></span>
                                                <span class="sensor-card__label">Rover Tilt</span>
                                            </span>
                                            <span class="sensor-card__status" data-status="stable">STABLE</span>
                                        </div>
                                        <div class="sensor-card__value-row">
                                            <span class="sensor-card__value" id="tilt-value">2.4</span>
                                            <span class="sensor-card__unit">°</span>
                                        </div>
                                        <div class="sensor-card__source">IMU</div>
                                    </div>

                                    <!-- Battery -->
                                    <div class="sensor-card">
                                        <div class="sensor-card__header">
                                            <span class="sensor-card__label-group">
                                                <span class="sensor-card__icon"><?php echo zo_cc_icon('battery'); ?></span>
                                                <span class="sensor-card__label">Battery</span>
                                            </span>
                                            <span class="sensor-card__status" data-status="good">GOOD</span>
                                        </div>
                                        <div class="sensor-card__value-row">
                                            <span class="sensor-card__value" id="sensor-battery-value">78</span>
                                            <span class="sensor-card__unit">%</span>
                                        </div>
                                        <div class="sensor-card__source">Li-ion 2S</div>
                                    </div>

                                </div>

                                <div class="sensor-overview__note">MQ-4 and MQ-7 values are uncalibrated relative sensor readings, not certified ppm.</div>
                            </section>

                        </div>

                        <!-- Right rail -->
                        <div class="command-center__rail">

                            <!-- Overall Risk Assessment -->
                            <section class="panel" aria-labelledby="risk-assessment-title" id="risk-assessment">
                                <header class="panel__header">
                                    <div class="panel__heading">
                                        <span class="panel__icon"><?php echo zo_cc_icon('gauge'); ?></span>
                                        <h2 class="panel__title" id="risk-assessment-title">Overall Risk Assessment</h2>
                                    </div>
                                </header>
                                <div class="panel__body risk-assessment">

                                    <div class="risk-assessment__summary">
                                        <div>
                                            <div class="risk-assessment__level" id="risk-level" data-risk-level="medium">MEDIUM RISK</div>
                                            <div class="risk-assessment__subtitle">Composite of 5 weighted signals</div>
                                        </div>
                                        <div class="risk-assessment__score">
                                            <span class="risk-assessment__score-value" id="risk-score">58</span><span class="risk-assessment__score-max">/100</span>
                                        </div>
                                    </div>

                                    <div class="risk-gauge" role="img" aria-label="Risk gauge — medium risk, 58 out of 100">
                                        <?php foreach ($zoRiskGaugeSegments as $seg): ?>
                                        <span class="risk-gauge__segment risk-gauge__segment--<?php echo $seg['zone']; ?><?php echo $seg['filled'] ? ' is-filled' : ''; ?>"></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="risk-gauge__scale">
                                        <span>LOW</span><span>MEDIUM</span><span>HIGH</span>
                                    </div>

                                    <div class="risk-factors">
                                        <?php foreach ($zoRiskFactors as $factor): ?>
                                        <div class="risk-factor">
                                            <div class="risk-factor__row">
                                                <span class="risk-factor__label"><?php echo htmlspecialchars($factor['label']); ?></span>
                                                <span class="risk-factor__value risk-factor__value--<?php echo $factor['tier']; ?>"><?php echo htmlspecialchars($factor['value']); ?></span>
                                            </div>
                                            <div class="risk-factor__track">
                                                <div class="risk-factor__bar risk-factor__bar--<?php echo $factor['tier']; ?>" style="width: <?php echo (int) $factor['percent']; ?>%;"></div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                            </section>

                            <!-- Live Alerts -->
                            <section class="panel" aria-labelledby="live-alerts-title" id="live-alerts">
                                <header class="panel__header">
                                    <div class="panel__heading">
                                        <span class="panel__icon"><?php echo zo_cc_icon('alert'); ?></span>
                                        <h2 class="panel__title" id="live-alerts-title">Live Alerts</h2>
                                    </div>
                                    <span class="live-alerts__count" id="live-alerts-count">2 ACTIVE</span>
                                </header>

                                <div class="live-alerts__list" id="live-alerts-list">
                                    <?php foreach ($zoLiveAlerts as $alert): ?>
                                    <div class="live-alert" data-severity="<?php echo htmlspecialchars($alert['severity']); ?>">
                                        <span class="live-alert__dot"></span>
                                        <div class="live-alert__body">
                                            <div class="live-alert__message"><?php echo htmlspecialchars($alert['message']); ?></div>
                                            <div class="live-alert__time"><?php echo htmlspecialchars($alert['time']); ?></div>
                                        </div>
                                        <span class="live-alert__severity"><?php echo htmlspecialchars(strtoupper($alert['severity'])); ?></span>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </section>

                            <!-- Rover Control -->
                            <section class="panel panel--dark" aria-labelledby="rover-control-title" id="rover-control">
                                <header class="panel__header">
                                    <div class="panel__heading">
                                        <span class="panel__icon"><?php echo zo_cc_icon('gamepad'); ?></span>
                                        <h2 class="panel__title" id="rover-control-title">Rover Control</h2>
                                    </div>
                                </header>
                                <div class="panel__body rover-control">

                                    <div class="rover-control__dpad" role="group" aria-label="Drive controls">
                                        <button type="button" class="dpad-btn dpad-btn--forward" id="control-forward" aria-label="Forward">
                                            <span class="dpad-btn__label">Forward</span>
                                            <span class="dpad-btn__arrow" aria-hidden="true">▲</span>
                                        </button>

                                        <button type="button" class="dpad-btn dpad-btn--left" id="control-left" aria-label="Left">
                                            <span class="dpad-btn__label">Left</span>
                                            <span class="dpad-btn__arrow" aria-hidden="true">◀</span>
                                        </button>

                                        <button type="button" class="dpad-btn dpad-btn--stop" id="control-stop" aria-label="Stop">
                                            STOP
                                        </button>

                                        <button type="button" class="dpad-btn dpad-btn--right" id="control-right" aria-label="Right">
                                            <span class="dpad-btn__arrow" aria-hidden="true">▶</span>
                                            <span class="dpad-btn__label">Right</span>
                                        </button>

                                        <button type="button" class="dpad-btn dpad-btn--backward" id="control-backward" aria-label="Backward">
                                            <span class="dpad-btn__arrow" aria-hidden="true">▼</span>
                                            <span class="dpad-btn__label">Backward</span>
                                        </button>
                                    </div>

                                    <div class="rover-control__speed">
                                        <div class="rover-control__speed-header">
                                            <label class="rover-control__speed-label" for="speed-slider">SPEED</label>
                                            <span class="rover-control__speed-value" id="speed-value">50%</span>
                                        </div>
                                        <input type="range" class="rover-control__speed-slider" id="speed-slider" min="0" max="100" value="50" step="1" aria-describedby="speed-value">
                                    </div>

                                    <div class="rover-control__estop">
                                        <button type="button" class="rover-control__estop-button" id="emergency-stop-button" data-estop-trigger aria-haspopup="dialog" aria-controls="estop-confirm-dialog">
                                            <span class="rover-control__estop-icon"><?php echo zo_cc_icon('octagon'); ?></span>
                                            <span>EMERGENCY STOP</span>
                                        </button>
                                    </div>

                                </div>
                            </section>

                            <!-- Relative Position -->
                            <section class="panel" aria-labelledby="relative-position-title" id="relative-position">
                                <header class="panel__header">
                                    <div class="panel__heading">
                                        <span class="panel__icon"><?php echo zo_cc_icon('radar'); ?></span>
                                        <h2 class="panel__title" id="relative-position-title">Relative Position</h2>
                                    </div>
                                </header>
                                <div class="panel__body relative-position">

                                    <p class="relative-position__note">No GPS on board — odometry + IMU dead reckoning from the mission start point.</p>

                                    <div class="relative-position__viz" aria-hidden="true">
                                        <svg viewBox="0 0 120 120" class="relative-position__viz-svg" preserveAspectRatio="xMidYMid meet">
                                            <line x1="8" y1="96" x2="112" y2="96" stroke="#E5E9F0" stroke-width="1" stroke-dasharray="3 3"></line>
                                            <line x1="24" y1="8" x2="24" y2="112" stroke="#E5E9F0" stroke-width="1" stroke-dasharray="3 3"></line>
                                            <line x1="24" y1="96" x2="86" y2="38" stroke="#CBD5E1" stroke-width="1.5" stroke-dasharray="4 3"></line>
                                            <circle cx="24" cy="96" r="5" fill="#FFFFFF" stroke="#94A3B8" stroke-width="2"></circle>
                                            <text x="24" y="111" text-anchor="middle" font-size="8" font-family="'IBM Plex Mono', monospace" fill="#94A3B8">START</text>
                                            <circle cx="86" cy="38" r="7" fill="rgba(255,107,44,.18)"></circle>
                                            <circle cx="86" cy="38" r="4" fill="#FF6B2C" stroke="#FFFFFF" stroke-width="1.5" class="relative-position__viz-dot"></circle>
                                            <text x="86" y="25" text-anchor="middle" font-size="8" font-weight="600" font-family="'IBM Plex Mono', monospace" fill="#FF6B2C">ROVER</text>
                                        </svg>
                                    </div>

                                    <div class="relative-position__stats">
                                        <div class="relative-position__stat">
                                            <span class="relative-position__label">X</span>
                                            <span class="relative-position__value" id="x-position">+12.4 m</span>
                                        </div>
                                        <div class="relative-position__stat">
                                            <span class="relative-position__label">Y</span>
                                            <span class="relative-position__value" id="y-position">+7.8 m</span>
                                        </div>
                                        <div class="relative-position__stat">
                                            <span class="relative-position__label">HEADING</span>
                                            <span class="relative-position__value" id="heading-value">124°</span>
                                        </div>
                                        <div class="relative-position__stat">
                                            <span class="relative-position__label">DISTANCE FROM START</span>
                                            <span class="relative-position__value" id="distance-from-start">19.2 m</span>
                                        </div>
                                    </div>

                                </div>
                            </section>

                        </div>

                    </div>

                </div>
            </main>
        </div>
    </div>

    <?php include __DIR__ . '/components/mobile-nav.php'; ?>
    <?php include __DIR__ . '/components/estop-modal.php'; ?>

    <script src="assets/js/app.js"></script>
</body>
</html>
