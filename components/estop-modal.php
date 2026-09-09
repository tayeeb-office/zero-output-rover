<?php
/**
 * ZERO OUTPUT — Emergency Stop
 * Trigger + confirmation modal + engaged banner, per design-reference/mission-control
 * (E-STOP CONFIRM / estopped states). Frontend demo only — no ESP32/hardware link.
 *
 * Kept visually distinct from a normal STOP command on purpose: this control is a
 * solid #EF4444 fill with an octagon glyph, while a normal STOP button elsewhere in
 * the UI uses a dark, muted style. Never reuse .estop__trigger for a non-emergency action.
 */
?>
<div class="estop" data-estop data-estop-state="idle">
    <button type="button" class="estop__trigger" data-estop-trigger aria-haspopup="dialog" aria-controls="estop-confirm-dialog">
        <svg class="estop__trigger-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
            <line x1="12" y1="8" x2="12" y2="13"></line>
            <line x1="12" y1="16.5" x2="12.01" y2="16.5"></line>
        </svg>
        <span>EMERGENCY STOP</span>
    </button>

    <div class="estop-modal" data-estop-overlay hidden>
        <div class="estop-modal__dialog" data-estop-dialog role="dialog" aria-modal="true" aria-labelledby="estop-confirm-title" aria-describedby="estop-confirm-desc" id="estop-confirm-dialog">
            <div class="estop-modal__header">
                <div class="estop-modal__icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                        <line x1="12" y1="8" x2="12" y2="13"></line>
                        <line x1="12" y1="16.5" x2="12.01" y2="16.5"></line>
                    </svg>
                </div>
                <div>
                    <div class="estop-modal__title" id="estop-confirm-title">Confirm emergency stop</div>
                    <p class="estop-modal__desc" id="estop-confirm-desc">All motors cut immediately and the mission is flagged. Sensor logging and camera continue. Confirm to send the halt command.</p>
                </div>
            </div>
            <div class="estop-modal__actions">
                <button type="button" class="estop-modal__button estop-modal__button--cancel" data-estop-cancel>Cancel</button>
                <button type="button" class="estop-modal__button estop-modal__button--confirm" data-estop-confirm>EMERGENCY STOP</button>
            </div>
        </div>
    </div>

    <div class="estop-banner" data-estop-banner role="alert" aria-live="assertive" hidden>
        <span class="estop-banner__dot"></span>
        <span class="estop-banner__label">E-STOP ACTIVE &mdash; MOTORS HALTED</span>
        <button type="button" class="estop-banner__reset" data-estop-reset>RESET / RE-ARM</button>
    </div>
</div>
