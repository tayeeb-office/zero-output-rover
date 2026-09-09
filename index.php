<?php
$zoPageTitle    = 'Command Center';
$zoPageSubtitle = 'Disaster Mapping Rover';
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
                Command Center Content
            </main>
        </div>
    </div>

    <?php include __DIR__ . '/components/mobile-nav.php'; ?>
    <?php include __DIR__ . '/components/estop-modal.php'; ?>

    <script src="assets/js/app.js"></script>
</body>
</html>
