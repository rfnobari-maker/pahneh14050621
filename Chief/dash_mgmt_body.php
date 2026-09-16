<?php
if (!isset($dash_api)) {
    $dash_api = 'dash_mgmt_api.php';
}
if (!isset($dash_sms)) {
    $dash_sms = 'dash_mgmt_sms.php';
}
if (!isset($dash_root)) {
    $dash_root = '../';
}
if (!function_exists('dash_svg')) {
    function dash_svg($d)
    {
        return '<svg class="agri1-icon" viewBox="0 0 24 24" aria-hidden="true">' . $d . '</svg>';
    }
}
?>
<link rel="stylesheet" href="<?php echo dash_h($dash_root); ?>inc/leaflet.css">
<link rel="stylesheet" href="<?php echo dash_h($dash_root); ?>agri1-theme.css">
<style>
    html { scroll-padding-top: 8px; -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }
    body.agri1-body {
        margin: 0;
        background: var(--color-background, #F0FDF4);
        color: var(--color-foreground, #14532D);
        font-family: myfont, Tahoma, "Segoe UI", sans-serif;
        font-size: 16px;
        line-height: 1.6;
    }
    .agri1-icon { width: 22px; height: 22px; fill: none; stroke: currentColor; stroke-width: 1.75; stroke-linecap: round; stroke-linejoin: round; }
    .dash {
        direction: rtl;
        max-width: 1440px;
        margin: 0 auto;
        padding: 16px 12px 40px;
    }
    .dash-shell {
        position: relative;
        border-radius: 24px;
        padding: 18px 16px 8px;
        background:
            radial-gradient(90% 60% at 0% 0%, rgba(134,201,160,.28), transparent 55%),
            radial-gradient(70% 50% at 100% 0%, rgba(21,128,61,.10), transparent 50%),
            linear-gradient(180deg, rgba(255,255,255,.72), rgba(240,253,244,.35));
        border: 1px solid rgba(134,201,160,.55);
        box-shadow: 0 18px 40px rgba(20, 83, 45, 0.08);
    }
    .dash-top {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 14px;
    }
    .dash-brand {
        display: flex;
        flex-direction: column;
        gap: 4px;
        min-width: min(100%, 320px);
    }
    .dash-brand-kicker {
        margin: 0;
        font-size: 12px;
        color: #475569;
    }
    .dash-top h1 {
        margin: 0;
        font-size: clamp(1.25rem, 2.2vw, 1.85rem);
        line-height: 1.35;
        color: #14532D;
        font-weight: 700;
    }
    .dash-tools {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: end;
        background: rgba(255,255,255,.82);
        border: 1px solid #86C9A0;
        border-radius: 16px;
        padding: 10px;
    }
    .dash-tool {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .dash-tools label {
        font-size: 12px;
        color: #475569;
        padding-inline: 4px;
    }
    .dash-tools select, .dash-back {
        min-height: 44px;
        min-width: 44px;
        border: 1px solid #64748B;
        border-radius: 12px;
        background: #fff;
        color: #14532D;
        font-family: inherit;
        font-size: 16px;
        padding: 0 12px;
        cursor: pointer;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .dash-tools select:hover, .dash-back:hover {
        border-color: #15803D;
    }
    .dash-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #14532D;
        color: #fff;
        border-color: #14532D;
        text-decoration: none;
        align-self: end;
    }
    .dash-back:hover { background: #15803D; border-color: #15803D; }
    .dash-back:focus, .dash-tools select:focus {
        outline: 3px solid var(--color-ring, #15803D);
        outline-offset: 2px;
    }
    .dash-crumb {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        list-style: none;
        margin: 0 0 10px;
        padding: 0;
    }
    .dash-crumb button {
        min-height: 40px;
        border: 1px solid #86C9A0;
        background: #fff;
        border-radius: 999px;
        padding: 0 14px;
        font-family: inherit;
        font-size: 13px;
        color: #14532D;
        cursor: pointer;
        transition: background .15s ease, color .15s ease;
    }
    .dash-crumb button:hover { background: #ECFDF3; }
    .dash-crumb button[aria-current="page"] {
        background: #15803D;
        color: #fff;
        border-color: #14532D;
    }
    .dash-status {
        min-height: 20px;
        margin: 0 0 8px;
        font-size: 14px;
        color: #475569;
        background: rgba(255,255,255,.7);
        border-radius: 12px;
        padding: 8px 12px;
        border: 1px dashed rgba(134,201,160,.7);
    }
    .dash-source-bar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin: 0 0 14px;
        padding: 8px 12px;
        border-radius: 12px;
        background: #F7FEF9;
        border: 1px solid #E8F0F1;
        font-size: 13px;
        color: #14532D;
    }
    .dash-source-bar[hidden] { display: none !important; }
    .dash-source-bar .dash-source-tag {
        display: inline-flex;
        align-items: center;
        min-height: 28px;
        padding: 0 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        background: #ECFDF3;
        border: 1px solid #86C9A0;
        color: #166534;
    }
    .dash-source-bar .dash-source-tag.is-live {
        background: #FFFBEB;
        border-color: #F59E0B;
        color: #A16207;
    }
    .dash-source-bar .dash-source-meta { color: #475569; }
    .dash-live-btn {
        margin-right: auto;
        min-height: 36px;
        padding: 0 14px;
        border-radius: 10px;
        border: 1px solid #86C9A0;
        background: #fff;
        color: #14532D;
        font: inherit;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }
    .dash-live-btn:hover { background: #ECFDF3; }
    .dash-live-btn:disabled {
        opacity: .55;
        cursor: not-allowed;
    }
    .dash-grid {
        display: grid;
        grid-template-columns: minmax(240px, 280px) minmax(0, 1.6fr) minmax(240px, 300px);
        gap: 16px;
        align-items: start;
    }
    .dash-col {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .dash-card {
        background: #fff;
        border: 1px solid #86C9A0;
        border-radius: 18px;
        box-shadow: 0 10px 28px rgba(20, 83, 45, 0.07);
        padding: 16px;
        transition: box-shadow .18s ease, transform .18s ease;
    }
    .dash-card:hover {
        box-shadow: 0 14px 32px rgba(20, 83, 45, 0.11);
    }
    .dash-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin: 0 0 14px;
        padding-bottom: 10px;
        border-bottom: 1px solid #E8F0F1;
    }
    .dash-card h2,
    .dash-card-head h2 {
        margin: 0;
        font-size: 15px;
        color: #14532D;
        padding: 0;
        border: 0;
    }
    .dash-card-tag {
        font-size: 11px;
        color: #15803D;
        background: #ECFDF3;
        border: 1px solid #86C9A0;
        border-radius: 999px;
        padding: 2px 8px;
        white-space: nowrap;
    }
    .dash-map-wrap {
        position: relative;
        min-height: 680px;
        padding: 14px;
        background:
            radial-gradient(80% 60% at 50% 0%, rgba(236,253,243,.95), #fff 60%);
    }
    .dash-rank {
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px solid #E8F0F1;
    }
    .dash-rank[hidden] { display: none !important; }
    .dash-rank-head {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 8px;
    }
    .dash-rank-head h3 {
        margin: 0;
        font-size: 1rem;
        color: #14532D;
    }
    .dash-rank-tabs {
        display: inline-flex;
        gap: 4px;
        padding: 3px;
        border-radius: 12px;
        background: #F0FDF4;
        border: 1px solid #86C9A0;
    }
    .dash-rank-tab {
        min-height: 34px;
        padding: 0 14px;
        border: 0;
        border-radius: 9px;
        background: transparent;
        color: #14532D;
        font: inherit;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }
    .dash-rank-tab.is-on {
        background: #15803D;
        color: #fff;
    }
    .dash-rank-metrics {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin: 0 0 10px;
    }
    .dash-rank-axis {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
    }
    .dash-rank-axis-label {
        font-size: 12px;
        font-weight: 700;
        color: #475569;
        min-width: 52px;
    }
    .dash-rank-metric {
        min-height: 30px;
        padding: 0 10px;
        border-radius: 999px;
        border: 1px solid #86C9A0;
        background: #fff;
        color: #14532D;
        font: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }
    .dash-rank-metric.is-on {
        background: #ECFDF3;
        border-color: #15803D;
        color: #166534;
    }
    .dash-rank-hint {
        margin: 0 0 10px;
        font-size: 12px;
        color: #475569;
    }
    .dash-rank-list {
        margin: 0;
        padding: 0;
        list-style: none;
        display: grid;
        gap: 6px;
        max-height: 320px;
        overflow: auto;
    }
    .dash-rank-list li {
        display: grid;
        grid-template-columns: 36px minmax(0, 1fr) auto;
        grid-template-rows: auto 4px;
        column-gap: 10px;
        row-gap: 6px;
        align-items: center;
        margin: 0;
        padding: 8px 10px;
        border: 1px solid #E8F0F1;
        border-radius: 12px;
        background: #F7FEF9;
        cursor: pointer;
        font-size: 13px;
        color: #14532D;
    }
    .dash-rank-list li:hover {
        border-color: #86C9A0;
        background: #ECFDF3;
    }
    .dash-rank-list .dash-rank-n {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #15803D;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        direction: ltr;
    }
    .dash-rank-list li:nth-child(1) .dash-rank-n { background: #A16207; }
    .dash-rank-list li:nth-child(2) .dash-rank-n { background: #64748B; }
    .dash-rank-list li:nth-child(3) .dash-rank-n { background: #B45309; }
    .dash-rank-list .dash-rank-val {
        direction: ltr;
        font-weight: 700;
        color: #15803D;
        font-variant-numeric: tabular-nums;
        white-space: nowrap;
    }
    .dash-rank-list .dash-rank-bar {
        grid-column: 2 / -1;
        height: 4px;
        border-radius: 999px;
        background: #E8F0F1;
        overflow: hidden;
    }
    .dash-rank-list .dash-rank-bar > i {
        display: block;
        height: 100%;
        background: linear-gradient(90deg, #86C9A0, #15803D);
        border-radius: 999px;
    }
    #dash-map {
        height: 680px;
        width: 100%;
        border-radius: 16px;
        background: #ECFDF3;
        border: 1px solid #E8F0F1;
        overflow: hidden;
    }
    .dash-map-legend {
        margin: 0 0 10px;
        font-size: 13px;
        color: #475569;
    }
    .dash-map-icon { background: none !important; border: none !important; }
    .dash-map-label {
        transform: translate(-50%, -50%);
        background: transparent;
        border: none;
        border-radius: 0;
        padding: 0;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.15;
        color: #111827;
        white-space: nowrap;
        box-shadow: none;
        text-shadow:
            0 0 2px #fff,
            0 0 4px #fff,
            1px 0 0 #fff,
            -1px 0 0 #fff,
            0 1px 0 #fff,
            0 -1px 0 #fff;
        pointer-events: none;
        cursor: default;
        font-family: inherit;
    }
    .dash-map-label.is-chip {
        pointer-events: auto;
        cursor: pointer;
        background: rgba(255,255,255,.94);
        border: 1px solid #86C9A0;
        border-radius: 8px;
        padding: 3px 8px;
        font-weight: 600;
        color: #14532D;
        text-shadow: none;
        box-shadow: 0 1px 4px rgba(20,83,45,.18);
    }
    .dash-map-label.is-on {
        color: #14532D;
        font-size: 13px;
    }
    .dash-map-label.is-chip.is-on {
        background: #15803D;
        color: #fff;
        border-color: #14532D;
    }
    .dash-flag-icon { background: none !important; border: none !important; }
    .dash-flag {
        width: 32px;
        height: 40px;
        transform: translate(-50%, -100%);
        cursor: pointer;
        transition: transform .18s ease;
        filter: drop-shadow(0 2px 4px rgba(20,83,45,.28));
    }
    .dash-flag:hover { transform: translate(-50%, -100%) scale(1.08); }
    .dash-flag svg { display: block; width: 32px; height: 40px; }
    .dash-flag.is-on svg .flag-cloth { fill: #14532D; }
    .dash-flag-tip.leaflet-tooltip {
        background: #14532D;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 8px 12px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 8px 20px rgba(20,83,45,.28);
    }
    .dash-flag-tip.leaflet-tooltip::before { border-top-color: #14532D; }
    .dash-center-card {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .dash-center-hero {
        position: relative;
        overflow: hidden;
        border-radius: 14px;
        padding: 14px 14px 16px;
        background:
            radial-gradient(120% 80% at 100% 0%, rgba(134,201,160,.35), transparent 55%),
            linear-gradient(160deg, #ECFDF3 0%, #F7FEF9 48%, #fff 100%);
        border: 1px solid #86C9A0;
    }
    .dash-center-kicker {
        margin: 0 0 6px;
        font-size: 12px;
        color: #475569;
        letter-spacing: 0;
    }
    .dash-center-name {
        margin: 0;
        font-size: 1.15rem;
        line-height: 1.45;
        color: #14532D;
        font-weight: 700;
    }
    .dash-center-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
    }
    .dash-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 28px;
        padding: 0 10px;
        border-radius: 999px;
        font-size: 12px;
        background: #fff;
        border: 1px solid #86C9A0;
        color: #14532D;
    }
    .dash-badge.is-level {
        background: #15803D;
        border-color: #14532D;
        color: #fff;
    }
    .dash-center-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }
    .dash-center-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 44px;
        border-radius: 12px;
        border: 1px solid #86C9A0;
        background: #fff;
        color: #14532D;
        text-decoration: none;
        font-size: 14px;
        font-family: inherit;
        direction: ltr;
    }
    .dash-center-action:hover { background: #ECFDF3; }
    .dash-center-action.is-disabled {
        opacity: .45;
        pointer-events: none;
    }
    .dash-center-action svg {
        width: 18px; height: 18px; flex: 0 0 auto;
        stroke: currentColor; fill: none; stroke-width: 1.75;
        stroke-linecap: round; stroke-linejoin: round;
    }
    .dash-center-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin: 0;
        padding: 0;
    }
    .dash-center-meta li {
        list-style: none;
        background: #F7FEF9;
        border-radius: 12px;
        padding: 10px;
        min-height: 64px;
    }
    .dash-center-meta span {
        display: block;
        font-size: 11px;
        color: #475569;
        margin-bottom: 4px;
    }
    .dash-center-meta b {
        display: block;
        font-size: 14px;
        color: #14532D;
        line-height: 1.4;
        word-break: break-word;
    }
    .dash-center-block {
        background: #fff;
        border: 1px solid #E8F0F1;
        border-radius: 12px;
        padding: 12px;
    }
    .dash-center-block h3 {
        margin: 0 0 8px;
        font-size: 12px;
        font-weight: 700;
        color: #475569;
    }
    .dash-center-block p {
        margin: 0;
        font-size: 14px;
        line-height: 1.6;
        color: #14532D;
    }
    .dash-center-zone {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        border-radius: 14px;
        padding: 12px 14px;
        background: linear-gradient(120deg, #14532D, #15803D);
        color: #fff;
    }
    .dash-center-zone span { font-size: 13px; opacity: .92; }
    .dash-center-zone b {
        font-size: 1.5rem;
        line-height: 1;
        direction: ltr;
        font-variant-numeric: tabular-nums;
    }
    .dash-center-empty {
        text-align: center;
        padding: 18px 10px;
        color: #475569;
        font-size: 14px;
        background: #F7FEF9;
        border-radius: 12px;
    }
    @media (max-width: 1100px) {
        .dash-center-actions { grid-template-columns: 1fr; }
    }
    @media (prefers-reduced-motion: reduce) {
        .dash-flag { transition: none; }
    }
    .dash-side-list {
        max-height: 180px;
        overflow: auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-top: 12px;
    }
    .dash-chip {
        min-height: 44px;
        border: 1px solid #86C9A0;
        background: #F7FEF9;
        border-radius: 12px;
        padding: 6px 10px;
        font-family: inherit;
        font-size: 13px;
        color: #14532D;
        cursor: pointer;
        text-align: right;
        transition: background .15s ease, border-color .15s ease, transform .15s ease;
    }
    .dash-chip.is-on, .dash-chip:hover {
        background: #ECFDF3;
        border-color: #15803D;
        transform: translateY(-1px);
    }
    .official {
        text-align: center;
        overflow: hidden;
    }
    .official-hero {
        border-radius: 14px;
        padding: 14px 12px 16px;
        margin-bottom: 4px;
        background:
            radial-gradient(120% 80% at 100% 0%, rgba(134,201,160,.35), transparent 55%),
            linear-gradient(160deg, #ECFDF3 0%, #F7FEF9 48%, #fff 100%);
        border: 1px solid #86C9A0;
    }
    .official img {
        width: 112px;
        height: 140px;
        object-fit: cover;
        border-radius: 14px;
        border: 2px solid #fff;
        background: #ECFDF3;
        box-shadow: 0 8px 20px rgba(20,83,45,.18);
    }
    .official .role {
        color: #475569;
        font-size: 12px;
        margin: 10px 0 0;
    }
    .official .who {
        margin: 4px 0 0;
        font-weight: 700;
        color: #14532D;
        font-size: 1.05rem;
    }
    .dash-sms-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 14px;
        min-height: 44px;
        padding: 0 16px;
        border: 0;
        border-radius: 12px;
        background: linear-gradient(160deg, #15803D, #166534);
        color: #fff;
        font: inherit;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 8px 18px rgba(21, 128, 61, .28);
        transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
    }
    .dash-sms-btn svg {
        width: 18px;
        height: 18px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }
    .dash-sms-btn:hover {
        transform: translateY(-1px);
        filter: brightness(1.05);
        box-shadow: 0 10px 22px rgba(21, 128, 61, .34);
    }
    .dash-sms-btn:focus-visible {
        outline: 3px solid rgba(21, 128, 61, .35);
        outline-offset: 2px;
    }
    .dash-sms-hint {
        margin: 10px 0 0;
        font-size: 12px;
        color: #A16207;
        line-height: 1.5;
    }
    .dash-sms-modal[hidden] { display: none !important; }
    .dash-sms-modal {
        position: fixed;
        inset: 0;
        z-index: 12000;
        display: grid;
        place-items: center;
        padding: 20px 16px;
    }
    .dash-sms-backdrop {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(90% 70% at 50% 0%, rgba(21, 128, 61, .18), transparent 55%),
            rgba(15, 23, 42, .55);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        animation: dashSmsFade .22s ease;
    }
    .dash-sms-dialog {
        position: relative;
        z-index: 1;
        width: min(440px, 100%);
        outline: none;
        animation: dashSmsPop .28s cubic-bezier(.22, 1, .36, 1);
    }
    .dash-sms-panel {
        display: flex;
        flex-direction: column;
        gap: 0;
        max-height: min(640px, calc(100vh - 40px));
        overflow: hidden;
        border-radius: 22px;
        background:
            linear-gradient(165deg, #F7FEF9 0%, #fff 42%, #F0FDF4 100%);
        border: 1px solid rgba(134, 201, 160, .65);
        box-shadow:
            0 1px 0 rgba(255, 255, 255, .7) inset,
            0 28px 64px rgba(15, 23, 42, .28);
        font-family: myfont, Tahoma, sans-serif;
        color: #14532D;
        direction: rtl;
    }
    .dash-sms-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        padding: 18px 18px 14px;
        background:
            radial-gradient(120% 120% at 100% 0%, rgba(134, 201, 160, .35), transparent 55%),
            linear-gradient(180deg, #ECFDF3, transparent);
        border-bottom: 1px solid #E8F0F1;
    }
    .dash-sms-head-copy {
        display: grid;
        gap: 4px;
        min-width: 0;
    }
    .dash-sms-kicker {
        margin: 0;
        font-size: 11px;
        letter-spacing: .04em;
        color: #64748B;
    }
    .dash-sms-head h2 {
        margin: 0;
        font-size: 1.15rem;
        font-weight: 800;
        color: #14532D;
        line-height: 1.35;
    }
    .dash-sms-clock {
        margin: 0;
        font-size: 12px;
        color: #64748B;
        direction: ltr;
        font-variant-numeric: tabular-nums;
    }
    .dash-sms-x {
        flex: 0 0 auto;
        width: 40px;
        height: 40px;
        border: 1px solid #86C9A0;
        border-radius: 12px;
        background: rgba(255, 255, 255, .85);
        color: #14532D;
        font-size: 22px;
        line-height: 1;
        cursor: pointer;
        transition: background .15s ease, transform .15s ease;
    }
    .dash-sms-x:hover {
        background: #fff;
        transform: translateY(-1px);
    }
    .dash-sms-x:focus-visible {
        outline: 3px solid rgba(21, 128, 61, .35);
        outline-offset: 2px;
    }
    .dash-sms-body {
        display: flex;
        flex-direction: column;
        gap: 14px;
        padding: 16px 18px 18px;
        overflow: auto;
    }
    .dash-sms-to {
        display: grid;
        grid-template-columns: 48px 1fr;
        gap: 12px;
        align-items: center;
        padding: 12px 14px;
        border-radius: 16px;
        background: #fff;
        border: 1px solid #E8F0F1;
        box-shadow: 0 8px 20px rgba(20, 83, 45, .06);
    }
    .dash-sms-avatar {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        background: linear-gradient(160deg, #15803D, #166534);
        color: #fff;
        box-shadow: 0 8px 16px rgba(21, 128, 61, .25);
    }
    .dash-sms-avatar svg {
        width: 22px;
        height: 22px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }
    .dash-sms-to-meta {
        display: grid;
        gap: 2px;
        min-width: 0;
    }
    .dash-sms-to-meta span {
        color: #64748B;
        font-size: 11px;
    }
    .dash-sms-to-meta b {
        color: #14532D;
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .dash-sms-to-meta em {
        font-style: normal;
        color: #15803D;
        font-size: 13px;
        direction: ltr;
        font-variant-numeric: tabular-nums;
        letter-spacing: .03em;
    }
    .dash-sms-thread:empty { display: none; }
    .dash-sms-thread {
        display: flex;
        flex-direction: column;
        gap: 8px;
        max-height: 140px;
        overflow: auto;
        padding: 4px 2px;
    }
    .dash-sms-bubble {
        align-self: flex-start;
        max-width: 92%;
        padding: 10px 12px;
        border-radius: 16px 16px 4px 16px;
        background: linear-gradient(160deg, #15803D, #166534);
        color: #fff;
        font-size: 13px;
        line-height: 1.6;
        white-space: pre-wrap;
        word-break: break-word;
        box-shadow: 0 8px 18px rgba(21, 128, 61, .2);
        animation: dashSmsIn .28s ease;
    }
    .dash-sms-bubble.is-meta {
        align-self: center;
        background: #ECFDF3;
        color: #166534;
        border: 1px solid #86C9A0;
        box-shadow: none;
        border-radius: 999px;
        padding: 5px 12px;
        font-size: 12px;
    }
    @keyframes dashSmsIn {
        from { opacity: 0; transform: translateY(8px) scale(.98); }
        to { opacity: 1; transform: none; }
    }
    @keyframes dashSmsFade {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes dashSmsPop {
        from { opacity: 0; transform: translateY(14px) scale(.97); }
        to { opacity: 1; transform: none; }
    }
    .dash-sms-compose {
        display: grid;
        gap: 8px;
    }
    .dash-sms-label {
        font-size: 12px;
        font-weight: 700;
        color: #475569;
    }
    .dash-sms-compose textarea {
        width: 100%;
        box-sizing: border-box;
        resize: vertical;
        min-height: 120px;
        max-height: 220px;
        padding: 14px;
        border: 1px solid #64748B;
        border-radius: 14px;
        background: #fff;
        color: #14532D;
        font: inherit;
        font-size: 14px;
        line-height: 1.65;
        direction: rtl;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .dash-sms-compose textarea:focus {
        outline: 3px solid rgba(21, 128, 61, .28);
        outline-offset: 2px;
        border-color: #15803D;
        box-shadow: 0 0 0 1px rgba(21, 128, 61, .12);
    }
    .dash-sms-compose textarea[aria-invalid="true"] {
        border-color: #B91C1C;
    }
    .dash-sms-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        font-size: 12px;
        color: #64748B;
        min-height: 20px;
    }
    #dash-sms-feedback.is-ok { color: #15803D; font-weight: 700; }
    #dash-sms-feedback.is-err { color: #B91C1C; font-weight: 700; }
    .dash-sms-actions {
        display: grid;
        grid-template-columns: 1fr 1.4fr;
        gap: 10px;
        margin-top: 4px;
    }
    .dash-sms-cancel,
    .dash-sms-send {
        min-height: 46px;
        border-radius: 13px;
        font: inherit;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        border: 1px solid transparent;
        transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
    }
    .dash-sms-cancel {
        background: #fff;
        border-color: #86C9A0;
        color: #14532D;
    }
    .dash-sms-cancel:hover {
        background: #F7FEF9;
        transform: translateY(-1px);
    }
    .dash-sms-send {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: linear-gradient(160deg, #15803D, #166534);
        color: #fff;
        box-shadow: 0 10px 22px rgba(21, 128, 61, .28);
    }
    .dash-sms-send svg {
        width: 18px;
        height: 18px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }
    .dash-sms-send:hover {
        filter: brightness(1.05);
        transform: translateY(-1px);
    }
    .dash-sms-send:disabled,
    .dash-sms-cancel:disabled {
        opacity: .55;
        cursor: not-allowed;
        box-shadow: none;
        transform: none;
        filter: none;
    }
    @media (max-width: 480px) {
        .dash-sms-modal { padding: 12px; align-items: end; }
        .dash-sms-dialog { width: 100%; }
        .dash-sms-panel { border-radius: 20px 20px 14px 14px; max-height: calc(100vh - 24px); }
        .dash-sms-actions { grid-template-columns: 1fr; }
        .dash-sms-compose textarea { min-height: 110px; }
    }
    .kpi-row { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-top: 4px; }
    .kpi {
        background:
            linear-gradient(160deg, #ECFDF3, #F7FEF9);
        border: 1px solid #E8F0F1;
        border-radius: 14px;
        padding: 12px 10px;
        text-align: center;
    }
    .kpi b {
        display: block;
        font-size: 1.35rem;
        direction: ltr;
        color: #14532D;
        font-variant-numeric: tabular-nums;
    }
    .kpi span { font-size: 12px; color: #475569; }
    .dash-bah-gender .kpi {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
    }
    .dash-gender-ico {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    .dash-gender-ico svg { width: 18px; height: 18px; display: block; }
    .dash-gender-ico.is-male { background: #DBEAFE; color: #1D4ED8; }
    .dash-gender-ico.is-female { background: #FCE7F3; color: #BE185D; }
    .role-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin: 12px 0 0; padding: 0; }
    .role-grid li {
        list-style: none;
        background: #F7FEF9;
        border: 1px solid #E8F0F1;
        border-radius: 12px;
        padding: 10px;
        font-size: 13px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
        color: #14532D;
    }
    .role-grid b {
        direction: ltr;
        font-size: 1rem;
        color: #15803D;
    }
    .dash-section-label {
        margin: 14px 0 8px;
        font-size: 12px;
        font-weight: 700;
        color: #475569;
    }
    .dash-section-label:first-child { margin-top: 0; }
    .stat-list { margin: 0; padding: 0; display: grid; gap: 8px; }
    .stat-list li {
        list-style: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border: 1px solid #E8F0F1;
        border-radius: 12px;
        background: #F7FEF9;
        font-size: 13px;
        color: #14532D;
    }
    .stat-list b {
        direction: ltr;
        color: #15803D;
        font-variant-numeric: tabular-nums;
    }
    .dash-stat-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin: 0;
        padding: 0;
    }
    .dash-stat-grid li {
        list-style: none;
        background: #F7FEF9;
        border: 1px solid #E8F0F1;
        border-radius: 12px;
        padding: 10px;
        min-height: 68px;
    }
    .dash-stat-grid li.dash-plot-item {
        display: grid;
        grid-template-columns: 22px 1fr;
        grid-template-rows: auto auto;
        column-gap: 8px;
        align-items: center;
    }
    .dash-plot-ico {
        grid-row: 1 / span 2;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: visible;
        background: none;
        border: none;
        border-radius: 0;
        padding: 0;
    }
    .dash-plot-ico img {
        width: 22px;
        height: 22px;
        display: block;
    }
    .dash-stat-grid li.dash-plot-item span {
        margin: 0;
    }
    .dash-stat-grid li.dash-plot-item b {
        justify-self: start;
    }
    .dash-stat-grid span {
        display: block;
        font-size: 11px;
        color: #475569;
        margin-bottom: 4px;
    }
    .dash-stat-grid b {
        display: block;
        font-size: 1.05rem;
        color: #14532D;
        direction: ltr;
        font-variant-numeric: tabular-nums;
    }
    .chart-box {
        height: 210px;
        position: relative;
        border-radius: 14px;
        background: linear-gradient(180deg, #F7FEF9, #fff);
        border: 1px solid #E8F0F1;
        padding: 8px;
    }
    .dash-status-legacy { min-height: 20px; font-size: 14px; color: #475569; }
    .agri1-overlay {
        position: fixed; inset: 0; background: rgba(15, 23, 42, 0.55);
        display: none; align-items: center; justify-content: center; z-index: 200;
    }
    .agri1-overlay.is-open { display: flex; }
    .agri1-overlay-panel {
        background: #fff; border-radius: 16px; padding: 24px; text-align: center; min-width: 220px;
    }
    .agri1-spinner {
        width: 36px; height: 36px; margin: 0 auto 12px;
        border: 3px solid #E8F0F1; border-top-color: var(--color-primary, #15803D);
        border-radius: 50%; animation: dashspin 0.8s linear infinite;
    }
    @keyframes dashspin { to { transform: rotate(360deg); } }
    .leaflet-container { font-family: inherit; }
    .leaflet-default-icon-path { background-image: none !important; }
    .dash-pin { background: #15803D; color: #fff; border-radius: 50%; width: 28px; height: 28px; line-height: 28px; text-align: center; font-size: 12px; border: 2px solid #fff; box-shadow: 0 2px 8px rgba(20,83,45,.35); }
    @media (max-width: 1100px) {
        .dash-grid { grid-template-columns: 1fr; }
        .dash-map-wrap, #dash-map { min-height: 520px; height: 520px; }
        .dash-center-actions { grid-template-columns: 1fr; }
        .dash-shell { padding: 14px 10px 6px; border-radius: 18px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .agri1-spinner { animation: none; border-top-color: #15803D; }
        .dash-chip, .dash-back, .dash-crumb button, .dash-card, .dash-flag { transition: none; }
    }
</style>

<div id="agri1-overlay" class="agri1-overlay">
    <div class="agri1-overlay-panel" role="status" aria-live="polite">
        <div class="agri1-spinner" aria-hidden="true"></div>
        <p>در حال بررسی اطلاعات...</p>
    </div>
</div>

<div id="dash-sms-modal" class="dash-sms-modal" hidden aria-hidden="true">
    <div class="dash-sms-backdrop" data-sms-close="1"></div>
    <div class="dash-sms-dialog" role="dialog" aria-modal="true" aria-labelledby="dash-sms-title">
        <div class="dash-sms-panel">
            <header class="dash-sms-head">
                <div class="dash-sms-head-copy">
                    <p class="dash-sms-kicker">سامانه پهنه‌بندی</p>
                    <h2 id="dash-sms-title">ارسال پیامک</h2>
                    <p class="dash-sms-clock" id="dash-sms-clock">۱۲:۰۰</p>
                </div>
                <button type="button" class="dash-sms-x" data-sms-close="1" aria-label="بستن">×</button>
            </header>
            <div class="dash-sms-body">
                <div class="dash-sms-to">
                    <div class="dash-sms-avatar" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div class="dash-sms-to-meta">
                        <span>گیرنده</span>
                        <b id="dash-sms-who">—</b>
                        <em id="dash-sms-tel" dir="ltr">—</em>
                    </div>
                </div>
                <div class="dash-sms-thread" id="dash-sms-thread" aria-live="polite"></div>
                <form id="dash-sms-form" class="dash-sms-compose" novalidate>
                    <label class="dash-sms-label" for="dash-sms-message">متن پیام</label>
                    <textarea id="dash-sms-message" name="message" maxlength="150" rows="5" placeholder="پیام خود را بنویسید..." required></textarea>
                    <div class="dash-sms-meta">
                        <span id="dash-sms-count">۰ / ۱۵۰</span>
                        <span id="dash-sms-feedback" role="status"></span>
                    </div>
                    <div class="dash-sms-actions">
                        <button type="button" class="dash-sms-cancel" data-sms-close="1">انصراف</button>
                        <button type="submit" class="dash-sms-send" id="dash-sms-send">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                            ارسال پیامک
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="dash" data-dash-ui="20260905d">
    <!-- dash_mgmt_body v20260904h : full dashboard UI polish -->
    <div class="dash-shell">
    <div class="dash-top">
        <div class="dash-brand">
            <h1>داشبورد مدیریتی سامانه</h1>
        </div>
        <div class="dash-tools">
            <div class="dash-tool">
                <label for="dash-year">سال زراعی</label>
                <select id="dash-year" aria-label="سال زراعی">
<?php
$dash_years_html = array();
if (isset($dbh) && function_exists('dash_rows')) {
    $yrows = dash_rows($dbh, "SELECT sal FROM b_sal ORDER BY sal DESC", array());
    foreach ($yrows as $yr) {
        if (preg_match('/((?:13|14)\d{2})/', $yr['sal'], $m)) {
            $yi = (int) $m[1];
            if (!in_array($yi, $dash_years_html, true)) {
                $dash_years_html[] = $yi;
            }
        }
    }
}
if (!$dash_years_html) {
    $dash_years_html = array(1404);
}
foreach ($dash_years_html as $yi) {
    echo '<option value="' . (int) $yi . '">' . (int) $yi . '</option>';
}
?>
                </select>
            </div>
            <div class="dash-tool">
                <label for="dash-ostan">استان</label>
                <select id="dash-ostan" aria-label="استان">
                    <option value="">کل کشور</option>
                </select>
            </div>
            <button type="button" class="dash-back" id="dash-back" hidden>بازگشت</button>
        </div>
    </div>
    <ol class="dash-crumb" id="dash-crumb" aria-label="سطح جغرافیایی"></ol>
    <p class="dash-status" id="dash-status" role="status">برای دیدن جزئیات، روی نقشه استان کلیک کنید.</p>
    <div class="dash-source-bar" id="dash-source-bar" hidden>
        <span class="dash-source-tag" id="dash-source-tag">اسنپ‌شات</span>
        <span class="dash-source-meta" id="dash-source-meta"></span>
        <button type="button" class="dash-live-btn" id="dash-live-btn" hidden>بروزرسانی آنلاین</button>
    </div>

    <div class="dash-grid">
        <aside class="dash-col">
            <section class="dash-card official" id="dash-official" hidden>
                <div class="dash-card-head">
                    <h2 id="off-role">مسئول</h2>
                    <span class="dash-card-tag">پروفایل</span>
                </div>
                <div class="official-hero">
                    <img id="off-pic" alt="تصویر مسئول" width="112" height="140" src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 112 140'><rect fill='%23ECFDF3' width='112' height='140'/><circle cx='56' cy='48' r='22' fill='%2386C9A0'/><path d='M28 118c4-24 16-36 28-36s24 12 28 36' fill='%2386C9A0'/></svg>">
                    <p class="role" id="off-title"></p>
                    <p class="who" id="off-name"></p>
                    <button type="button" class="dash-sms-btn" id="dash-sms-open" hidden title="sms-ui-20260904k">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        ارسال پیامک
                    </button>
                    <p class="dash-sms-hint" id="dash-sms-hint" hidden>شماره همراه معتبر برای پیامک ثبت نشده است.</p>
                </div>
            </section>
            <section class="dash-card" id="dash-users-card">
                <div class="dash-card-head">
                    <h2 id="users-card-title">کاربران سامانه</h2>
                    <span class="dash-card-tag" id="users-card-tag">دسترسی‌ها</span>
                </div>
                <div id="users-stats-block">
                    <div class="kpi-row">
                        <div class="kpi"><b id="u-hq">۰</b><span>ستادی</span></div>
                        <div class="kpi"><b id="u-pr">۰</b><span>استانی</span></div>
                    </div>
                    <ul class="role-grid">
                        <li><span>مدیریت سامانه</span><b id="r-sys">۰</b></li>
                        <li><span>معین استان</span><b id="r-moin">۰</b></li>
                        <li><span>مدیر شهرستان</span><b id="r-city">۰</b></li>
                        <li><span>موضوعی شهرستان</span><b id="r-th">۰</b></li>
                        <li><span>رئیس مرکز</span><b id="r-cen">۰</b></li>
                        <li><span>کارشناس پهنه</span><b id="r-zone">۰</b></li>
                    </ul>
                </div>
                <div id="center-info-block" class="dash-center-card" hidden></div>
            </section>
            <section class="dash-card" id="dash-bah-card">
                <div class="dash-card-head">
                    <h2>بهره‌برداران ثبت‌شده</h2>
                    <span class="dash-card-tag">زنده</span>
                </div>
                <div class="kpi-row">
                    <div class="kpi"><b id="bah-total">۰</b><span>کل (تأییدشده)</span></div>
                    <div class="kpi"><b id="bah-legal">۰</b><span>حقوقی</span></div>
                </div>
                <p class="dash-section-label">حقیقی <span id="bah-natural-wrap">(<b id="bah-natural" style="font:inherit;color:#15803D">۰</b>)</span></p>
                <div class="kpi-row dash-bah-gender">
                    <div class="kpi">
                        <span class="dash-gender-ico is-male" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="10" cy="14" r="5"></circle>
                                <path d="M19 5l-5.5 5.5M15 5h4v4"></path>
                            </svg>
                        </span>
                        <b id="bah-male">۰</b>
                        <span>مرد</span>
                    </div>
                    <div class="kpi">
                        <span class="dash-gender-ico is-female" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="9" r="5"></circle>
                                <path d="M12 14v7M9 18h6"></path>
                            </svg>
                        </span>
                        <b id="bah-female">۰</b>
                        <span>زن</span>
                    </div>
                </div>
            </section>
            <section class="dash-card" id="dash-plots-card">
                <div class="dash-card-head">
                    <h2>قطعات و تولید</h2>
                    <span class="dash-card-tag">آمار</span>
                </div>
                <p class="dash-section-label">تعداد قطعات</p>
                <ul class="dash-stat-grid dash-plots-count">
                    <li class="dash-plot-item">
                        <span class="dash-plot-ico" aria-hidden="true"><img src="<?php echo dash_h($dash_root); ?>assets/icons/dash/plot-agri.svg" alt=""></span>
                        <span>زراعی</span><b id="p-agri">۰</b>
                    </li>
                    <li class="dash-plot-item">
                        <span class="dash-plot-ico" aria-hidden="true"><img src="<?php echo dash_h($dash_root); ?>assets/icons/dash/plot-garden.svg" alt=""></span>
                        <span>باغی</span><b id="p-garden">۰</b>
                    </li>
                    <li class="dash-plot-item">
                        <span class="dash-plot-ico" aria-hidden="true"><img src="<?php echo dash_h($dash_root); ?>assets/icons/dash/plot-greenhouse.svg" alt=""></span>
                        <span>گلخانه</span><b id="p-gh">۰</b>
                    </li>
                    <li class="dash-plot-item">
                        <span class="dash-plot-ico" aria-hidden="true"><img src="<?php echo dash_h($dash_root); ?>assets/icons/dash/plot-mushroom.svg" alt=""></span>
                        <span>قارچ</span><b id="p-mu">۰</b>
                    </li>
                    <li class="dash-plot-item">
                        <span class="dash-plot-ico" aria-hidden="true"><img src="<?php echo dash_h($dash_root); ?>assets/icons/dash/plot-bee.svg" alt=""></span>
                        <span>زنبور</span><b id="p-bee">۰</b>
                    </li>
                    <li class="dash-plot-item">
                        <span class="dash-plot-ico" aria-hidden="true"><img src="<?php echo dash_h($dash_root); ?>assets/icons/dash/plot-animal.svg" alt=""></span>
                        <span>دام</span><b id="p-an">۰</b>
                    </li>
                </ul>
                <p class="dash-section-label">تولید (تن)</p>
                <ul class="dash-stat-grid">
                    <li><span>زراعی</span><b id="t-agri">۰</b></li>
                    <li><span>باغی</span><b id="t-garden">۰</b></li>
                </ul>
            </section>
        </aside>

        <section class="dash-card dash-map-wrap">
            <div class="dash-card-head">
                <h2 id="map-title">نقشه کشور</h2>
                <span class="dash-card-tag">تعاملی</span>
            </div>
            <div id="dash-map" role="application" aria-label="نقشه تعاملی استان‌ها"></div>
            <div id="place-list" class="dash-side-list" hidden></div>
            <section class="dash-rank" id="dash-rank" hidden>
                <div class="dash-rank-head">
                    <h3 id="dash-rank-title">رتبه‌بندی سطح زیر کشت</h3>
                    <div class="dash-rank-tabs" role="tablist" aria-label="حوزه رتبه‌بندی">
                        <button type="button" class="dash-rank-tab is-on" role="tab" aria-selected="true" data-rank-domain="agri">زراعی</button>
                        <button type="button" class="dash-rank-tab" role="tab" aria-selected="false" data-rank-domain="garden">باغی</button>
                    </div>
                </div>
                <div class="dash-rank-metrics" id="dash-rank-metrics" role="tablist" aria-label="نوع سطح"></div>
                <p class="dash-rank-hint" id="dash-rank-hint">بر اساس سطح زیر کشت (هکتار) — برای رفتن به همان محدوده کلیک کنید.</p>
                <ol class="dash-rank-list" id="dash-rank-list"></ol>
            </section>
        </section>

        <aside class="dash-col">
            <section class="dash-card">
                <div class="dash-card-head">
                    <h2>وضعیت بازدید کاربران</h2>
                    <span class="dash-card-tag">۱۴ روز</span>
                </div>
                <div class="chart-box"><canvas id="chart-visits" aria-label="نمودار بازدید"></canvas></div>
            </section>
            <section class="dash-card">
                <div class="dash-card-head">
                    <h2>ترکیب بهره‌برداری</h2>
                    <span class="dash-card-tag">سهم</span>
                </div>
                <div class="chart-box"><canvas id="chart-plots" aria-label="نمودار ترکیب بهره‌برداری"></canvas></div>
            </section>
            <section class="dash-card">
                <div class="dash-card-head">
                    <h2>سطح زیر کشت زراعی (هکتار)</h2>
                    <span class="dash-card-tag">آبی / دیم</span>
                </div>
                <div class="chart-box"><canvas id="chart-area" aria-label="نمودار آبی و دیم زراعی"></canvas></div>
            </section>
            <section class="dash-card">
                <div class="dash-card-head">
                    <h2>سطح زیر کشت باغی (هکتار)</h2>
                    <span class="dash-card-tag">بارور غیر بارور / آبی دیم</span>
                </div>
                <ul class="dash-stat-grid" style="margin-bottom:10px">
                    <li><span>بارور آبی</span><b id="g-b-abi-r">۰</b></li>
                    <li><span>غیر بارور آبی</span><b id="g-gb-abi-r">۰</b></li>
                    <li><span>بارور دیم</span><b id="g-b-dim-r">۰</b></li>
                    <li><span>غیر بارور دیم</span><b id="g-gb-dim-r">۰</b></li>
                </ul>
                <div class="chart-box"><canvas id="chart-garden-area" aria-label="نمودار سطح باغی"></canvas></div>
            </section>
        </aside>
    </div>
    </div>
</div>

<script src="<?php echo dash_h($dash_root); ?>assets/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo dash_h($dash_root); ?>assets/js/Chart.min.js"></script>
<script src="<?php echo dash_h($dash_root); ?>inc/leaflet.js"></script>
<script>
(function () {
    var API = <?php echo json_encode($dash_api); ?>;
    var SMS_API = <?php echo json_encode($dash_sms); ?>;
    var ROOT = <?php echo json_encode($dash_root); ?>;
    var GEO = ROOT + 'inc/iran-provinces.json?v=20260904e';
    var GEO_COUNTY = ROOT + 'assets/geo/counties/';
    var GEO_ISO = ROOT + 'assets/geo/ostan-iso.json?v=20260904e';
    var state = {
        level: 'country', id_ostan: '', id_city: '', id_mar: '', year: 0, wantLive: false,
        rankDomain: 'agri', rankMetric: 'total', rankWater: 'total', rankFruit: 'total'
    };
    var lastRank = null;
    var map, geoLayer, countyLayer, tileLayer, markers, charts = {};
    var nameIndex = {};
    var ostanIso = {};
    var countyReq = 0;
    var countyCache = {};
    var overlay = document.getElementById('agri1-overlay');
    var COUNTY_COLORS = [
        '#F8BBD0', '#C8E6C9', '#FFF59D', '#BBDEFB', '#FFE0B2',
        '#E1BEE7', '#B2DFDB', '#FFCCBC', '#DCEDC8', '#D1C4E9',
        '#F0F4C3', '#B3E5FC', '#F8BBD9', '#D7CCC8', '#AED581'
    ];

    function ostanId(v) {
        v = String(v == null ? '' : v).trim();
        if (!v) return '';
        if (/^\d+$/.test(v)) {
            return ('0' + v).slice(-2);
        }
        return v;
    }

    function faNum(n) {
        n = Number(n) || 0;
        return n.toLocaleString('fa-IR');
    }
    function faNumInt(n) {
        return faNum(Math.round(Number(n) || 0));
    }
    function yearText(y) {
        return String(y).replace(/[^\d]/g, '');
    }
    function escHtml(s) {
        return String(s || '').replace(/[&<>"']/g, function (ch) {
            return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[ch];
        });
    }
    function normFa(s) {
        // نرمال‌سازی مشابه PHP (dash_norm_fa) تا کلیدها در نقشه/دیتا mismatch نشوند
        return String(s || '')
            .replace(/استان\s+/g, '')
            .replace(/ي/g, 'ی')
            .replace(/ك/g, 'ک')
            .replace(/ـ/g, '')      // tatweel
            .replace(/‌/g, '')      // ZWNJ
            .replace(/\s+/g, '');
    }
    function countyDisplayName(raw) {
        return String(raw || '')
            .replace(/^شهرستان\s*ویژه\s+/u, '')
            .replace(/^شهرستان\s+/u, '')
            .replace(/^شهرستان/u, '')
            .trim();
    }
    function featCountyName(feat) {
        var p = feat && feat.properties ? feat.properties : {};
        if (p.tags && p.tags.name) return p.tags.name;
        return p.name || '';
    }
    function layerCentroid(layer) {
        try {
            var latlngs = layer.getLatLngs();
            var flat = [];
            function walk(arr) {
                if (!arr || !arr.length) return;
                if (arr[0] && typeof arr[0].lat === 'number') {
                    for (var i = 0; i < arr.length; i++) flat.push(arr[i]);
                    return;
                }
                for (var j = 0; j < arr.length; j++) walk(arr[j]);
            }
            walk(latlngs);
            if (!flat.length) return layer.getBounds().getCenter();
            var lat = 0, lng = 0, n = flat.length;
            for (var k = 0; k < n; k++) {
                lat += flat[k].lat;
                lng += flat[k].lng;
            }
            return L.latLng(lat / n, lng / n);
        } catch (e) {
            try { return layer.getBounds().getCenter(); } catch (e2) { return null; }
        }
    }
    function clearCounties() {
        countyReq += 1;
        if (countyLayer && map) {
            try { map.removeLayer(countyLayer); } catch (e) {}
        }
        countyLayer = null;
    }
    function ostanLabel(d) {
        var name = '';
        var want = ostanId(d.id_ostan);
        (d.provinces || []).forEach(function (p) {
            if (ostanId(p.id_ostan) === want) name = p.ostan;
        });
        if (!name && d.crumb && d.crumb.length) {
            for (var i = 0; i < d.crumb.length; i++) {
                if (d.crumb[i].level === 'ostan') name = d.crumb[i].label;
            }
        }
        return name;
    }
    function isoForOstan(d) {
        // اولویت با کد استان تا اختلاف املای نام مانع بارگذاری مرز شهرستان نشود
        var id = ostanId(d.id_ostan);
        if (id) return 'IR-' + id;
        var key = normFa(ostanLabel(d));
        return ostanIso[key] || '';
    }
    function busy(on) {
        overlay.className = on ? 'agri1-overlay is-open' : 'agri1-overlay';
    }
    function colorFor(v, max) {
        if (!max || v <= 0) return '#E8F0F1';
        var t = v / max;
        if (t > 0.75) return '#14532D';
        if (t > 0.5) return '#166534';
        if (t > 0.25) return '#15803D';
        return '#86C9A0';
    }

    function hasLeaflet() {
        return typeof L !== 'undefined';
    }
    function setTiles(on) {
        if (!hasLeaflet() || !map) return;
        if (on && !tileLayer) {
            tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 18 }).addTo(map);
        } else if (!on && tileLayer) {
            map.removeLayer(tileLayer);
            tileLayer = null;
        }
    }

    function killChart(id) {
        if (charts[id]) { charts[id].destroy(); charts[id] = null; }
    }
    function drawLine(id, labels, data) {
        killChart(id);
        var ctx = document.getElementById(id).getContext('2d');
        charts[id] = new Chart(ctx, {
            type: 'line',
            data: { labels: labels, datasets: [{ data: data, borderColor: '#15803D', backgroundColor: 'rgba(21,128,61,.15)', fill: true, pointRadius: 3 }] },
            options: { legend: { display: false }, maintainAspectRatio: false, tooltips: { callbacks: { label: function (t) { return faNum(t.yLabel); } } }, scales: { yAxes: [{ ticks: { beginAtZero: true, callback: function (v) { return faNum(v); } } }] } }
        });
    }
    function drawDoughnut(id, labels, data, colors) {
        killChart(id);
        var el = document.getElementById(id);
        if (!el) return;
        var ctx = el.getContext('2d');
        var vals = (data || []).map(function (v) { return Number(v) || 0; });
        var total = 0;
        vals.forEach(function (v) { total += v; });
        function pctOf(v) {
            if (total <= 0) return 0;
            return Math.round((v * 1000) / total) / 10;
        }
        charts[id] = new Chart(ctx, {
            type: 'doughnut',
            data: { labels: labels, datasets: [{ data: vals, backgroundColor: colors }] },
            options: {
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        fontFamily: 'myfont, Tahoma',
                        boxWidth: 12,
                        generateLabels: function (chart) {
                            var ds = chart.data.datasets[0] || { data: [], backgroundColor: [] };
                            var meta = chart.getDatasetMeta(0);
                            return (chart.data.labels || []).map(function (label, i) {
                                var val = Number(ds.data[i]) || 0;
                                var hidden = meta && meta.data[i] ? meta.data[i].hidden : false;
                                return {
                                    text: label + ' — ' + faNum(pctOf(val)) + '٪',
                                    fillStyle: ds.backgroundColor[i],
                                    strokeStyle: ds.backgroundColor[i],
                                    lineWidth: 0,
                                    hidden: hidden,
                                    index: i
                                };
                            });
                        }
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, cdata) {
                            var val = Number(cdata.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]) || 0;
                            var name = cdata.labels[tooltipItem.index] || '';
                            return name + ': ' + faNum(val) + ' (' + faNum(pctOf(val)) + '٪)';
                        }
                    }
                }
            },
            plugins: [{
                afterDatasetsDraw: function (chart) {
                    if (total <= 0) return;
                    var c = chart.chart.ctx;
                    var meta = chart.getDatasetMeta(0);
                    if (!meta || !meta.data) return;
                    meta.data.forEach(function (arc, i) {
                        if (!arc || arc.hidden) return;
                        var val = vals[i];
                        if (val <= 0) return;
                        var pct = pctOf(val);
                        if (pct < 3) return;
                        var pos = arc.tooltipPosition();
                        c.save();
                        c.fillStyle = '#14532D';
                        c.font = 'bold 12px myfont, Tahoma, sans-serif';
                        c.textAlign = 'center';
                        c.textBaseline = 'middle';
                        c.fillText(faNum(pct) + '٪', pos.x, pos.y);
                        c.restore();
                    });
                }
            }]
        });
    }

    var PLACEHOLDER = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 112 140'><rect fill='%23ECFDF3' width='112' height='140'/><circle cx='56' cy='48' r='22' fill='%2386C9A0'/><path d='M28 118c4-24 16-36 28-36s24 12 28 36' fill='%2386C9A0'/></svg>";
    var smsState = { tel: '', who: '' };

    function toFaDigits(s) {
        return String(s).replace(/\d/g, function (d) {
            return '۰۱۲۳۴۵۶۷۸۹'[d];
        });
    }
    function normalizeMobile(tel) {
        var digits = String(tel || '').replace(/\D+/g, '');
        if (digits.length === 10 && digits.charAt(0) === '9') digits = '0' + digits;
        if (digits.length === 12 && digits.indexOf('98') === 0) digits = '0' + digits.slice(2);
        return digits;
    }
    function isValidMobile(tel) {
        var d = normalizeMobile(tel);
        return d.length === 11 && d.charAt(0) === '0' && d.charAt(1) === '9';
    }
    function fillOfficial(off) {
        var box = document.getElementById('dash-official');
        var smsBtn = document.getElementById('dash-sms-open');
        var smsHint = document.getElementById('dash-sms-hint');
        if (!off || !off.ok) {
            box.hidden = true;
            smsState = { tel: '', who: '' };
            if (smsBtn) smsBtn.hidden = true;
            if (smsHint) smsHint.hidden = true;
            return;
        }
        box.hidden = false;
        document.getElementById('off-role').textContent = off.role || 'مسئول';
        document.getElementById('off-title').textContent = off.role || '';
        var who = ((off.name || '') + ' ' + (off.last_name || '')).trim();
        document.getElementById('off-name').textContent = who;
        var img = document.getElementById('off-pic');
        img.onerror = function () { img.onerror = null; img.src = PLACEHOLDER; };
        img.src = off.pic || PLACEHOLDER;
        img.alt = who;
        smsState.who = who;
        smsState.tel = normalizeMobile(off.tel || '');
        var telOk = isValidMobile(smsState.tel);
        if (smsBtn) smsBtn.hidden = !telOk;
        if (smsHint) smsHint.hidden = telOk;
    }

    function smsLen(s) {
        return (typeof s === 'string') ? Array.from(s).length : 0;
    }
    function updateSmsCount() {
        var ta = document.getElementById('dash-sms-message');
        var n = smsLen(ta.value);
        document.getElementById('dash-sms-count').textContent = toFaDigits(n) + ' / ۱۵۰';
    }
    function setSmsFeedback(msg, ok) {
        var el = document.getElementById('dash-sms-feedback');
        el.textContent = msg || '';
        el.className = ok === true ? 'is-ok' : (ok === false ? 'is-err' : '');
    }
    function updateSmsClock() {
        var now = new Date();
        var h = ('0' + now.getHours()).slice(-2);
        var m = ('0' + now.getMinutes()).slice(-2);
        document.getElementById('dash-sms-clock').textContent = toFaDigits(h + ':' + m);
    }
    function openSmsModal() {
        if (!isValidMobile(smsState.tel)) return;
        var modal = document.getElementById('dash-sms-modal');
        document.getElementById('dash-sms-who').textContent = smsState.who || '—';
        document.getElementById('dash-sms-tel').textContent = toFaDigits(smsState.tel);
        document.getElementById('dash-sms-thread').innerHTML = '';
        document.getElementById('dash-sms-message').value = '';
        document.getElementById('dash-sms-message').removeAttribute('aria-invalid');
        setSmsFeedback('', null);
        updateSmsCount();
        updateSmsClock();
        modal.hidden = false;
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        setTimeout(function () {
            document.getElementById('dash-sms-message').focus();
        }, 40);
    }
    function closeSmsModal() {
        var modal = document.getElementById('dash-sms-modal');
        if (!modal || modal.hidden) return;
        modal.hidden = true;
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        document.getElementById('dash-sms-send').disabled = false;
        document.querySelectorAll('#dash-sms-form button').forEach(function (b) { b.disabled = false; });
    }
    function pushSmsBubble(text, meta) {
        var thread = document.getElementById('dash-sms-thread');
        var div = document.createElement('div');
        div.className = 'dash-sms-bubble' + (meta ? ' is-meta' : '');
        div.textContent = text;
        thread.appendChild(div);
        thread.scrollTop = thread.scrollHeight;
    }

    (function bindSmsUi() {
        var openBtn = document.getElementById('dash-sms-open');
        var modal = document.getElementById('dash-sms-modal');
        var form = document.getElementById('dash-sms-form');
        var ta = document.getElementById('dash-sms-message');
        if (!openBtn || !modal || !form || !ta) return;
        openBtn.addEventListener('click', openSmsModal);
        modal.addEventListener('click', function (e) {
            if (e.target && e.target.getAttribute('data-sms-close') === '1') closeSmsModal();
        });
        ta.addEventListener('input', function () {
            if (smsLen(ta.value) > 150) ta.value = Array.from(ta.value).slice(0, 150).join('');
            ta.removeAttribute('aria-invalid');
            updateSmsCount();
            setSmsFeedback('', null);
        });
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var msg = String(ta.value || '').trim();
            var len = smsLen(msg);
            if (!isValidMobile(smsState.tel)) {
                setSmsFeedback('شماره همراه معتبر نیست.', false);
                return;
            }
            if (len < 10) {
                ta.setAttribute('aria-invalid', 'true');
                setSmsFeedback('متن پیام حداقل باید ۱۰ کاراکتر باشد.', false);
                ta.focus();
                return;
            }
            if (len > 150) {
                ta.setAttribute('aria-invalid', 'true');
                setSmsFeedback('طول پیام حداکثر ۱۵۰ کاراکتر است.', false);
                return;
            }
            var sendBtn = document.getElementById('dash-sms-send');
            sendBtn.disabled = true;
            form.querySelectorAll('button').forEach(function (b) { b.disabled = true; });
            setSmsFeedback('در حال ارسال...', null);
            $.ajax({
                url: SMS_API,
                method: 'POST',
                dataType: 'json',
                data: {
                    tel_m: smsState.tel,
                    message: msg,
                    who: smsState.who
                }
            }).done(function (res) {
                if (res && res.ok) {
                    pushSmsBubble(msg, false);
                    pushSmsBubble(res.message || 'ارسال شد', true);
                    ta.value = '';
                    updateSmsCount();
                    setSmsFeedback(res.message || 'پیامک ارسال شد.', true);
                } else {
                    setSmsFeedback((res && res.error) || 'ارسال ناموفق بود.', false);
                }
            }).fail(function () {
                setSmsFeedback('ارتباط با سرویس پیامک برقرار نشد.', false);
            }).always(function () {
                form.querySelectorAll('button').forEach(function (b) { b.disabled = false; });
            });
        });
    })();

    function fillCenterInfo(d) {
        var usersBlock = document.getElementById('users-stats-block');
        var centerBlock = document.getElementById('center-info-block');
        var title = document.getElementById('users-card-title');
        var cp = d.center_public;
        var r = (d.users && d.users.roles) ? d.users.roles : {};
        if (d.level === 'mar') {
            usersBlock.hidden = true;
            centerBlock.hidden = false;
            title.textContent = 'شناسنامه مرکز';
            var tag = document.getElementById('users-card-tag');
            if (tag) tag.textContent = 'عمومی';
            var zone = faNum(r.zone);
            if (!(cp && cp.ok)) {
                centerBlock.innerHTML =
                    '<div class="dash-center-empty">اطلاعات عمومی این مرکز هنوز در سامانه ثبت نشده است.</div>'
                    + '<div class="dash-center-zone"><span>کارشناس پهنه</span><b>' + zone + '</b></div>';
                return;
            }
            var tel = String(cp.tel || '').trim();
            var fax = String(cp.fax || '').trim();
            var faxOk = fax && fax !== '0' && fax !== '2147483647';
            var telHref = tel ? ('tel:' + tel.replace(/[^\d+]/g, '')) : '';
            var level = cp.rating_label || cp.rating || '—';
            var meta = [];
            function pushMeta(label, val) {
                if (val === null || val === undefined) return;
                var s = String(val).trim();
                if (!s) return;
                meta.push('<li><span>' + escHtml(label) + '</span><b>' + escHtml(s) + '</b></li>');
            }
            pushMeta('کد مرکز', cp.id_mar);
            pushMeta('سال تأسیس', cp.y_tas);
            pushMeta('کد پستی', cp.cod_pos);
            pushMeta('نزدیک‌ترین آبادی', cp.f_naz_ab !== '' && cp.f_naz_ab != null ? (faNum(cp.f_naz_ab) + ' کیلومتر') : '');
            pushMeta('دورترین آبادی', cp.f_dor_ab !== '' && cp.f_dor_ab != null ? (faNum(cp.f_dor_ab) + ' کیلومتر') : '');
            var html = '';
            html += '<div class="dash-center-hero">';
            html += '<p class="dash-center-kicker">مرکز جهاد کشاورزی</p>';
            html += '<p class="dash-center-name">' + escHtml(cp.m_name || '—') + '</p>';
            html += '<div class="dash-center-badges">';
            html += '<span class="dash-badge is-level">سطح ' + escHtml(level) + '</span>';
            if (cp.id_mar) html += '<span class="dash-badge">کد ' + escHtml(cp.id_mar) + '</span>';
            html += '</div></div>';
            html += '<div class="dash-center-actions">';
            if (telHref) {
                html += '<a class="dash-center-action" href="' + escHtml(telHref) + '">'
                    + '<svg viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.6a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.5-1.1a2 2 0 0 1 2.1-.4c.8.3 1.7.5 2.6.6a2 2 0 0 1 1.7 2z"/></svg>'
                    + escHtml(tel) + '</a>';
            } else {
                html += '<span class="dash-center-action is-disabled">تلفن ثبت نشده</span>';
            }
            if (faxOk) {
                html += '<span class="dash-center-action" title="فکس">'
                    + '<svg viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 8h8M8 12h8M8 16h5"/></svg>'
                    + escHtml(fax) + '</span>';
            } else {
                html += '<span class="dash-center-action is-disabled">فکس ثبت نشده</span>';
            }
            html += '</div>';
            if (meta.length) {
                html += '<ul class="dash-center-meta">' + meta.join('') + '</ul>';
            }
            if (String(cp.address || '').trim()) {
                html += '<div class="dash-center-block"><h3>آدرس پستی</h3><p>' + escHtml(cp.address) + '</p></div>';
            }
            if (String(cp.zf_g || '').trim()) {
                html += '<div class="dash-center-block"><h3>زمینه فعالیت غالب</h3><p>' + escHtml(cp.zf_g) + '</p></div>';
            }
            html += '<div class="dash-center-zone"><span>کارشناس پهنه این مرکز</span><b>' + zone + '</b></div>';
            centerBlock.innerHTML = html;
            return;
        }
        usersBlock.hidden = false;
        centerBlock.hidden = true;
        centerBlock.innerHTML = '';
        title.textContent = 'کاربران سامانه';
        var tag2 = document.getElementById('users-card-tag');
        if (tag2) tag2.textContent = 'دسترسی‌ها';
    }

    function fillStats(d) {
        document.getElementById('u-hq').textContent = faNum(d.users.hq);
        document.getElementById('u-pr').textContent = faNum(d.users.provincial);
        var r = d.users.roles || {};
        document.getElementById('r-sys').textContent = faNum(r.sys);
        document.getElementById('r-moin').textContent = faNum(r.moin);
        document.getElementById('r-city').textContent = faNum(r.city_mgr);
        document.getElementById('r-th').textContent = faNum(r.thematic);
        document.getElementById('r-cen').textContent = faNum(r.center);
        document.getElementById('r-zone').textContent = faNum(r.zone);
        var p = d.plots || {};
        document.getElementById('p-agri').textContent = faNum(p.agri);
        document.getElementById('p-garden').textContent = faNum(p.garden);
        document.getElementById('p-gh').textContent = faNum(p.greenhouse);
        document.getElementById('p-mu').textContent = faNum(p.mushroom);
        document.getElementById('p-bee').textContent = faNum(p.bee);
        document.getElementById('p-an').textContent = faNum(p.animal);
        var ga = d.garden_area || {};
        var gMap = {
            'g-b-abi-r': ga.baror_abi,
            'g-gb-abi-r': ga.nonbaror_abi,
            'g-b-dim-r': ga.baror_dim,
            'g-gb-dim-r': ga.nonbaror_dim
        };
        Object.keys(gMap).forEach(function (id) {
            var el = document.getElementById(id);
            if (el) el.textContent = faNum(gMap[id]);
        });
        document.getElementById('t-agri').textContent = faNumInt(d.agri_prod);
        document.getElementById('t-garden').textContent = faNumInt(d.garden_prod);
        var bah = d.bah || {};
        var elBahTotal = document.getElementById('bah-total');
        if (elBahTotal) {
            elBahTotal.textContent = faNum(bah.total);
            document.getElementById('bah-natural').textContent = faNum(bah.natural);
            document.getElementById('bah-legal').textContent = faNum(bah.legal);
            document.getElementById('bah-male').textContent = faNum(bah.male);
            document.getElementById('bah-female').textContent = faNum(bah.female);
        }
        fillOfficial(d.official);
        fillCenterInfo(d);
        var vlab = [], vdat = [];
        (d.visits || []).forEach(function (x) { vlab.push(x.date); vdat.push(x.count); });
        drawLine('chart-visits', vlab, vdat);
        drawDoughnut('chart-plots',
            ['زراعی', 'باغی', 'گلخانه', 'قارچ', 'زنبور', 'دام'],
            [p.agri, p.garden, p.greenhouse, p.mushroom, p.bee, p.animal],
            ['#15803D', '#A16207', '#166534', '#86C9A0', '#14532D', '#475569']);
        drawDoughnut('chart-area', ['آبی', 'دیم'], [d.agri_area.abi, d.agri_area.dim], ['#15803D', '#A16207']);
        drawDoughnut(
            'chart-garden-area',
            ['بارور آبی', 'غیر بارور آبی', 'بارور دیم', 'غیر بارور دیم'],
            [ga.baror_abi || 0, ga.nonbaror_abi || 0, ga.baror_dim || 0, ga.nonbaror_dim || 0],
            ['#15803D', '#86C9A0', '#A16207', '#D97706']
        );
    }

    function renderCrumb(d) {
        var ol = document.getElementById('dash-crumb');
        ol.innerHTML = '';
        (d.crumb || []).forEach(function (c, i, arr) {
            var li = document.createElement('li');
            var b = document.createElement('button');
            b.type = 'button';
            b.textContent = c.label;
            if (i === arr.length - 1) b.setAttribute('aria-current', 'page');
            b.addEventListener('click', function () {
                load({ id_ostan: c.id_ostan, id_city: c.id_city, id_mar: c.id_mar });
            });
            li.appendChild(b);
            ol.appendChild(li);
        });
        document.getElementById('dash-back').hidden = (d.level === 'country');
        var titles = { country: 'نقشه کشور', ostan: 'شهرستان‌های استان', city: 'مراکز جهاد کشاورزی', mar: 'مرکز انتخاب‌شده' };
        document.getElementById('map-title').textContent = titles[d.level] || 'نقشه';
        var hints = {
            country: 'برای دیدن جزئیات، روی نقشه استان کلیک کنید.',
            ostan: 'شهرستان را از فهرست کنار نقشه یا از روی نقشه انتخاب کنید.',
            city: 'روی نشان مرکز جهاد کشاورزی کلیک کنید.',
            mar: 'آمار این مرکز در کارت‌ها به‌روز شد.'
        };
        document.getElementById('dash-status').textContent = hints[d.level] || '';
    }

    function renderPlaces(d) {
        var box = document.getElementById('place-list');
        box.innerHTML = '';
        var items = [];
        if (d.level === 'ostan') {
            (d.cities || []).forEach(function (c) {
                items.push({ label: c.city, go: function () { load({ id_ostan: d.id_ostan, id_city: c.id_city, id_mar: '' }); } });
            });
        } else if (d.level === 'city' || d.level === 'mar') {
            (d.centers || []).forEach(function (c) {
                items.push({ label: c.m_name || c.mar, on: c.id_mar === d.id_mar, go: function () { load({ id_ostan: d.id_ostan, id_city: d.id_city, id_mar: c.id_mar }); } });
            });
        }
        if (!items.length) { box.hidden = true; return; }
        box.hidden = false;
        items.forEach(function (it) {
            var b = document.createElement('button');
            b.type = 'button';
            b.className = 'dash-chip' + (it.on ? ' is-on' : '');
            b.textContent = it.label;
            b.addEventListener('click', it.go);
            box.appendChild(b);
        });
    }

    function gardenRankField(water, fruit) {
        water = water || 'total';
        fruit = fruit || 'total';
        if (water === 'total' && fruit === 'total') return 'garden_total';
        if (water === 'abi' && fruit === 'total') return 'garden_abi';
        if (water === 'dim' && fruit === 'total') return 'garden_dim';
        if (water === 'total' && fruit === 'baror') return 'garden_baror';
        if (water === 'total' && fruit === 'nonbaror') return 'garden_nonbaror';
        if (water === 'abi' && fruit === 'baror') return 'garden_baror_abi';
        if (water === 'abi' && fruit === 'nonbaror') return 'garden_nonbaror_abi';
        if (water === 'dim' && fruit === 'baror') return 'garden_baror_dim';
        if (water === 'dim' && fruit === 'nonbaror') return 'garden_nonbaror_dim';
        return 'garden_total';
    }
    function gardenRankLabel(axes, water, fruit) {
        var wMap = (axes && axes.water) ? axes.water : { total: 'کل', abi: 'آبی', dim: 'دیم' };
        var fMap = (axes && axes.fruit) ? axes.fruit : { total: 'کل', baror: 'بارور', nonbaror: 'غیر بارور' };
        var w = wMap[water] || water;
        var f = fMap[fruit] || fruit;
        if (water === 'total' && fruit === 'total') return 'کل';
        if (water === 'total') return f;
        if (fruit === 'total') return w;
        return w + ' ' + f;
    }
    function renderRankAxisRow(box, label, options, selected, onPick) {
        var row = document.createElement('div');
        row.className = 'dash-rank-axis';
        var lab = document.createElement('span');
        lab.className = 'dash-rank-axis-label';
        lab.textContent = label;
        row.appendChild(lab);
        Object.keys(options).forEach(function (key) {
            var b = document.createElement('button');
            b.type = 'button';
            b.className = 'dash-rank-metric' + (key === selected ? ' is-on' : '');
            b.textContent = options[key];
            b.addEventListener('click', function () { onPick(key); });
            row.appendChild(b);
        });
        box.appendChild(row);
    }
    function renderRank(d) {
        var box = document.getElementById('dash-rank');
        var list = document.getElementById('dash-rank-list');
        var title = document.getElementById('dash-rank-title');
        var hint = document.getElementById('dash-rank-hint');
        var metricsBox = document.getElementById('dash-rank-metrics');
        if (!box || !list || !metricsBox) return;
        lastRank = (d && d.rank) ? d.rank : null;
        if (!lastRank || !(lastRank.items && lastRank.items.length)) {
            box.hidden = true;
            list.innerHTML = '';
            metricsBox.innerHTML = '';
            return;
        }
        box.hidden = false;
        title.textContent = lastRank.title || 'رتبه‌بندی سطح زیر کشت';

        var domain = state.rankDomain === 'garden' ? 'garden' : 'agri';
        var domainCfg = (lastRank.domains && lastRank.domains[domain]) ? lastRank.domains[domain] : null;
        var domainFa = domainCfg && domainCfg.label ? domainCfg.label : (domain === 'garden' ? 'باغی' : 'زراعی');
        var unit = lastRank.unit || 'هکتار';
        var field = 'agri_total';
        var metricFa = 'کل';

        document.querySelectorAll('.dash-rank-tab').forEach(function (btn) {
            var on = btn.getAttribute('data-rank-domain') === domain;
            btn.className = 'dash-rank-tab' + (on ? ' is-on' : '');
            btn.setAttribute('aria-selected', on ? 'true' : 'false');
        });

        metricsBox.innerHTML = '';
        if (domain === 'garden') {
            var axes = domainCfg && domainCfg.axes ? domainCfg.axes : {
                water: { total: 'کل', abi: 'آبی', dim: 'دیم' },
                fruit: { total: 'کل', baror: 'بارور', nonbaror: 'غیر بارور' }
            };
            if (!axes.water[state.rankWater]) state.rankWater = 'total';
            if (!axes.fruit[state.rankFruit]) state.rankFruit = 'total';
            renderRankAxisRow(metricsBox, 'آبی/دیم', axes.water, state.rankWater, function (key) {
                if (state.rankWater === key) return;
                state.rankWater = key;
                renderRank({ rank: lastRank });
            });
            renderRankAxisRow(metricsBox, 'باروری', axes.fruit, state.rankFruit, function (key) {
                if (state.rankFruit === key) return;
                state.rankFruit = key;
                renderRank({ rank: lastRank });
            });
            field = gardenRankField(state.rankWater, state.rankFruit);
            metricFa = gardenRankLabel(axes, state.rankWater, state.rankFruit);
        } else {
            var metrics = domainCfg && domainCfg.metrics ? domainCfg.metrics : { total: 'کل', abi: 'آبی', dim: 'دیم' };
            if (!metrics[state.rankMetric]) state.rankMetric = 'total';
            var metric = state.rankMetric;
            field = 'agri_' + metric;
            metricFa = metrics[metric] || metric;
            var row = document.createElement('div');
            row.className = 'dash-rank-axis';
            Object.keys(metrics).forEach(function (key) {
                var b = document.createElement('button');
                b.type = 'button';
                b.className = 'dash-rank-metric' + (key === metric ? ' is-on' : '');
                b.textContent = metrics[key];
                b.addEventListener('click', function () {
                    if (state.rankMetric === key) return;
                    state.rankMetric = key;
                    renderRank({ rank: lastRank });
                });
                row.appendChild(b);
            });
            metricsBox.appendChild(row);
        }

        hint.textContent = 'سطح ' + domainFa + ' — ' + metricFa + ' (' + unit + ')'
            + (domain === 'agri' ? '؛ صیفی در کل و آبی لحاظ شده' : '')
            + ' — برای رفتن به همان محدوده کلیک کنید.';

        var items = lastRank.items.slice().sort(function (a, b) {
            return (Number(b[field]) || 0) - (Number(a[field]) || 0);
        });
        var top = items.slice(0, 12);
        var max = 0;
        top.forEach(function (it) {
            var v = Number(it[field]) || 0;
            if (v > max) max = v;
        });
        list.innerHTML = '';
        top.forEach(function (it, i) {
            var val = Number(it[field]) || 0;
            var li = document.createElement('li');
            li.setAttribute('role', 'button');
            li.tabIndex = 0;
            var pct = max > 0 ? Math.round((val * 100) / max) : 0;
            li.innerHTML =
                '<span class="dash-rank-n">' + faNum(i + 1) + '</span>' +
                '<span class="dash-rank-name">' + escHtml(it.label || '') + '</span>' +
                '<span class="dash-rank-val">' + faNum(val) + ' ' + unit + '</span>' +
                '<span class="dash-rank-bar" aria-hidden="true"><i style="width:' + pct + '%"></i></span>';
            function go() {
                load({
                    id_ostan: it.id_ostan || '',
                    id_city: it.id_city || '',
                    id_mar: it.id_mar || ''
                });
            }
            li.addEventListener('click', go);
            li.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    go();
                }
            });
            list.appendChild(li);
        });
    }

    function paintGeo(d) {
        if (!hasLeaflet() || !geoLayer) return;
        var max = 0;
        (d.provinces || []).forEach(function (p) { if (p.value > max) max = p.value; });
        var byId = {};
        (d.provinces || []).forEach(function (p) { byId[ostanId(p.id_ostan)] = p; });
        var showCounties = (d.level === 'ostan');
        geoLayer.eachLayer(function (layer) {
            var props = layer.feature && layer.feature.properties ? layer.feature.properties : {};
            var oid = ostanId(props.id_ostan);
            var rec = oid ? byId[oid] : null;
            if (!rec) {
                rec = nameIndex[normFa(props.name)] || null;
                if (rec) oid = ostanId(rec.id_ostan);
            }
            var val = rec ? rec.value : 0;
            var selected = oid !== '' && oid === ostanId(d.id_ostan);
            layer.setStyle({
                fillColor: selected ? '#1E3A5F' : colorFor(val, max),
                weight: selected ? 2.5 : 1,
                color: selected ? '#14532D' : '#166534',
                fillOpacity: selected && showCounties ? 0.05 : (selected ? 0.85 : 0.72)
            });
            if (oid) layer._dashId = oid;
        });
        if (d.level === 'ostan' || d.level === 'city' || d.level === 'mar') {
            geoLayer.eachLayer(function (layer) {
                if (String(layer._dashId) === ostanId(d.id_ostan)) {
                    try { map.fitBounds(layer.getBounds(), { padding: [20, 20], maxZoom: 8 }); } catch (e) {}
                }
            });
        } else {
            map.setView([32.4, 53.6], 5);
        }
    }

    function addMapLabel(lat, lng, name, on, go, asChip) {
        if (lat == null || lng == null) return null;
        var cls = 'dash-map-label' + (asChip ? ' is-chip' : '') + (on ? ' is-on' : '');
        var ic = L.divIcon({
            className: 'dash-map-icon',
            html: '<div class="' + cls + '">' + escHtml(name) + '</div>',
            iconSize: [0, 0],
            iconAnchor: [0, 0]
        });
        var m = L.marker([lat, lng], { icon: ic, title: name, riseOnHover: true, interactive: !!asChip });
        if (asChip && go) m.on('click', go);
        markers.addLayer(m);
        return m;
    }

    function renderCountyMap(d, gj) {
        if (!hasLeaflet() || !map) return;
        if (countyLayer) {
            try { map.removeLayer(countyLayer); } catch (e) {}
            countyLayer = null;
        }
        if (markers) markers.clearLayers();
        else markers = L.layerGroup().addTo(map);

        var cityByKey = {};
        (d.cities || []).forEach(function (c) {
            cityByKey[normFa(c.city)] = c;
        });
        var matched = {};
        var colorIdx = 0;

        countyLayer = L.geoJSON(gj, {
            filter: function (feat) {
                var t = feat && feat.geometry ? feat.geometry.type : '';
                return t === 'Polygon' || t === 'MultiPolygon';
            },
            style: {
                color: '#334155',
                weight: 1.2,
                fillColor: COUNTY_COLORS[0],
                fillOpacity: 0.72
            },
            onEachFeature: function (feat, layer) {
                var raw = featCountyName(feat);
                var label = countyDisplayName(raw);
                if (!label) return;
                var key = normFa(label);
                var city = cityByKey[key];
                var center = layerCentroid(layer);
                var fill = COUNTY_COLORS[colorIdx % COUNTY_COLORS.length];
                colorIdx += 1;
                layer.setStyle({
                    color: '#334155',
                    weight: 1.2,
                    fillColor: fill,
                    fillOpacity: 0.72
                });
                layer.bindTooltip(label, { sticky: true, direction: 'center', opacity: 0.9 });
                if (city) {
                    matched[key] = true;
                    layer.on('click', function () {
                        load({ id_ostan: d.id_ostan, id_city: city.id_city, id_mar: '' });
                    });
                    if (layer._path) layer._path.style.cursor = 'pointer';
                }
                if (center) {
                    addMapLabel(center.lat, center.lng, label, false, null, false);
                }
            }
        }).addTo(map);

        // شهرستان‌های دیتابیس بدون تطبیق مرز: با مختصات قبلی/شبکه
        var pending = [];
        (d.cities || []).forEach(function (c) {
            if (!matched[normFa(c.city)]) pending.push(c);
        });
        if (pending.length) {
            var pb = null;
            if (geoLayer) {
                geoLayer.eachLayer(function (layer) {
                    if (String(layer._dashId) === ostanId(d.id_ostan)) {
                        try { pb = layer.getBounds(); } catch (e) {}
                    }
                });
            }
            pending.forEach(function (c, i) {
                var lat = c.lat, lng = c.lng;
                if ((lat == null || lng == null) && pb) {
                    var sw = pb.getSouthWest();
                    var ne = pb.getNorthEast();
                    var cols = Math.ceil(Math.sqrt(pending.length));
                    var rows = Math.ceil(pending.length / cols);
                    var col = i % cols;
                    var row = Math.floor(i / cols);
                    lng = sw.lng + (ne.lng - sw.lng) * (col + 0.5) / cols;
                    lat = ne.lat - (ne.lat - sw.lat) * (row + 0.5) / rows;
                }
                addMapLabel(lat, lng, c.city, false, function () {
                    load({ id_ostan: d.id_ostan, id_city: c.id_city, id_mar: '' });
                }, true);
            });
        }

        try {
            if (countyLayer.getLayers().length) {
                map.fitBounds(countyLayer.getBounds(), { padding: [24, 24], maxZoom: 9 });
            }
        } catch (e) {}
    }

    function showCountyLayer(d) {
        clearCounties();
        if (markers) { markers.clearLayers(); }
        else if (hasLeaflet() && map) { markers = L.layerGroup().addTo(map); }
        if (!hasLeaflet() || !map || d.level !== 'ostan') return;
        var iso = isoForOstan(d);
        if (!iso) {
            drawMapNamesFallbackCities(d);
            return;
        }
        var req = countyReq;
        var url = GEO_COUNTY + iso + '_geo.json?v=20260904e';
        function applyGj(gj) {
            if (req !== countyReq) return;
            if (ostanId(state.id_ostan) !== ostanId(d.id_ostan) || state.level !== 'ostan') return;
            renderCountyMap(d, gj);
        }
        if (countyCache[iso]) {
            applyGj(countyCache[iso]);
            return;
        }
        $.getJSON(url).done(function (gj) {
            countyCache[iso] = gj;
            applyGj(gj);
        }).fail(function () {
            if (req !== countyReq) return;
            document.getElementById('dash-status').textContent =
                'مرز شهرستان‌ها برای این استان بارگذاری نشد (' + iso + '). فایل‌های assets/geo/counties را روی سرور بررسی کنید.';
            drawMapNamesFallbackCities(d);
        });
    }

    function drawMapNamesFallbackCities(d) {
        if (!hasLeaflet() || !map) return;
        if (markers) { markers.clearLayers(); }
        else { markers = L.layerGroup().addTo(map); }
        var cities = d.cities || [];
        var pb = null;
        if (geoLayer) {
            geoLayer.eachLayer(function (layer) {
                if (String(layer._dashId) === ostanId(d.id_ostan)) {
                    try { pb = layer.getBounds(); } catch (e) {}
                }
            });
        }
        var pending = 0;
        cities.forEach(function (c) {
            if (c.lat == null || c.lng == null) pending += 1;
        });
        var gi = 0;
        cities.forEach(function (c) {
            var lat = c.lat, lng = c.lng;
            if ((lat == null || lng == null) && pb) {
                var sw = pb.getSouthWest();
                var ne = pb.getNorthEast();
                var cols = Math.ceil(Math.sqrt(pending || cities.length));
                var rows = Math.ceil((pending || cities.length) / cols);
                var col = gi % cols;
                var row = Math.floor(gi / cols);
                gi += 1;
                lng = sw.lng + (ne.lng - sw.lng) * (col + 0.5) / cols;
                lat = ne.lat - (ne.lat - sw.lat) * (row + 0.5) / rows;
            }
            addMapLabel(lat, lng, c.city, false, function () {
                load({ id_ostan: d.id_ostan, id_city: c.id_city, id_mar: '' });
            }, true);
        });
    }

    function flagHtml(on) {
        return '<div class="dash-flag' + (on ? ' is-on' : '') + '">'
            + '<svg viewBox="0 0 32 40" aria-hidden="true">'
            + '<path d="M7 2 v36" stroke="#1E293B" stroke-width="2.2" fill="none"/>'
            + '<path class="flag-cloth" d="M9 3.5 h18 l-3.5 6.5 3.5 6.5 H9 z" fill="#DC2626"/>'
            + '<circle cx="7" cy="2.5" r="1.6" fill="#1E293B"/>'
            + '</svg></div>';
    }
    function addFlagMarker(lat, lng, name, on, go) {
        if (lat == null || lng == null) return null;
        var ic = L.divIcon({
            className: 'dash-flag-icon',
            html: flagHtml(on),
            iconSize: [32, 40],
            iconAnchor: [16, 40]
        });
        var m = L.marker([lat, lng], { icon: ic, title: name, riseOnHover: true });
        m.bindTooltip(escHtml(name), {
            className: 'dash-flag-tip',
            direction: 'top',
            offset: [0, -40],
            opacity: 1,
            sticky: false
        });
        if (go) m.on('click', go);
        markers.addLayer(m);
        return m;
    }

    function drawMapNames(d) {
        if (!hasLeaflet() || !map) return;
        if (d.level === 'ostan') {
            showCountyLayer(d);
            return;
        }
        clearCounties();
        if (markers) { markers.clearLayers(); }
        else { markers = L.layerGroup().addTo(map); }
        var pts = [];
        if (d.level === 'city' || d.level === 'mar') {
            var centers = d.centers || [];
            var cb = null;
            if (geoLayer) {
                geoLayer.eachLayer(function (layer) {
                    if (String(layer._dashId) === ostanId(d.id_ostan)) {
                        try { cb = layer.getBounds(); } catch (e) {}
                    }
                });
            }
            var cpend = 0;
            centers.forEach(function (c) {
                if (c.lat == null || c.lng == null) cpend += 1;
            });
            var cj = 0;
            centers.forEach(function (c) {
                var lat = c.lat, lng = c.lng;
                if ((lat == null || lng == null) && cb) {
                    var sw = cb.getSouthWest();
                    var ne = cb.getNorthEast();
                    var cols = Math.ceil(Math.sqrt(cpend || centers.length));
                    var rows = Math.ceil((cpend || centers.length) / cols);
                    var col = cj % cols;
                    var row = Math.floor(cj / cols);
                    cj += 1;
                    lng = sw.lng + (ne.lng - sw.lng) * (col + 0.5) / cols;
                    lat = ne.lat - (ne.lat - sw.lat) * (row + 0.5) / rows;
                }
                var label = c.m_name || c.mar;
                addFlagMarker(lat, lng, label, String(c.id_mar) === String(d.id_mar), function () {
                    load({ id_ostan: d.id_ostan, id_city: d.id_city, id_mar: c.id_mar });
                });
                if (lat != null && lng != null) pts.push([lat, lng]);
            });
        }
        if (pts.length && (d.level === 'city' || d.level === 'mar')) {
            map.fitBounds(pts, { padding: [48, 48], maxZoom: 12 });
        }
    }

    function toJalaliParts(gy, gm, gd) {
        var g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
        var gy2 = (gm > 2) ? (gy + 1) : gy;
        var days = 355666 + (365 * gy) + Math.floor((gy2 + 3) / 4)
            - Math.floor((gy2 + 99) / 100) + Math.floor((gy2 + 399) / 400)
            + gd + g_d_m[gm - 1];
        var jy = -1595 + (33 * Math.floor(days / 12053));
        days %= 12053;
        jy += 4 * Math.floor(days / 1461);
        days %= 1461;
        if (days > 365) {
            jy += Math.floor((days - 1) / 365);
            days = (days - 1) % 365;
        }
        var jm, jd;
        if (days < 186) {
            jm = 1 + Math.floor(days / 31);
            jd = 1 + (days % 31);
        } else {
            jm = 7 + Math.floor((days - 186) / 30);
            jd = 1 + ((days - 186) % 30);
        }
        return { y: jy, m: jm, d: jd };
    }
    function pad2(n) {
        n = String(n);
        return n.length < 2 ? ('0' + n) : n;
    }
    function formatBuiltAt(s) {
        if (!s) return '';
        var raw = String(s).replace('T', ' ').slice(0, 19);
        var m = raw.match(/^(\d{4})-(\d{2})-(\d{2})(?:[ ](\d{2}):(\d{2})(?::(\d{2}))?)?/);
        if (!m) return raw;
        var j = toJalaliParts(parseInt(m[1], 10), parseInt(m[2], 10), parseInt(m[3], 10));
        var datePart = j.y + '/' + pad2(j.m) + '/' + pad2(j.d);
        if (m[4] != null) {
            return datePart + ' ' + m[4] + ':' + m[5];
        }
        return datePart;
    }
    function renderSourceBar(d) {
        var bar = document.getElementById('dash-source-bar');
        var tag = document.getElementById('dash-source-tag');
        var meta = document.getElementById('dash-source-meta');
        var btn = document.getElementById('dash-live-btn');
        if (!bar || !tag || !meta || !btn) return;
        var src = d.data_source || 'live';
        var canSnapLevel = (d.level === 'country' || d.level === 'ostan' || d.level === 'city');
        if (!canSnapLevel) {
            bar.hidden = true;
            btn.hidden = true;
            return;
        }
        bar.hidden = false;
        if (src === 'snap') {
            tag.textContent = 'اسنپ‌شات';
            tag.className = 'dash-source-tag';
            meta.textContent = d.built_at
                ? ('تاریخ به‌روزرسانی: ' + formatBuiltAt(d.built_at))
                : 'آمار از جدول داشبورد';
        } else if (src === 'live') {
            tag.textContent = 'آنلاین';
            tag.className = 'dash-source-tag is-live';
            meta.textContent = 'واکشی زنده برای این مشاهده (اسنپ‌شات تغییر نکرد)';
        } else {
            tag.textContent = 'زنده';
            tag.className = 'dash-source-tag is-live';
            meta.textContent = 'اسنپ‌شات برای این سطح/سال یافت نشد';
        }
        var showLive = !!d.can_live && src !== 'live';
        btn.hidden = !showLive;
        btn.disabled = false;
    }

    function apply(d) {
        state.level = d.level;
        state.id_ostan = d.id_ostan || '';
        state.id_city = d.id_city || '';
        state.id_mar = d.id_mar || '';
        if (d.year) state.year = d.year;
        if (d.data_source === 'live') state.wantLive = false;
        (d.provinces || []).forEach(function (p) { nameIndex[p.name_key] = p; });
        var ysel = document.getElementById('dash-year');
        if (d.years && d.years.length && !ysel.options.length) {
            d.years.forEach(function (y) {
                var o = document.createElement('option');
                o.value = y;
                o.textContent = yearText(y);
                ysel.appendChild(o);
            });
        }
        if (d.year) ysel.value = String(d.year);
        var osel = document.getElementById('dash-ostan');
        if (d.provinces && d.provinces.length && osel.options.length < 2) {
            d.provinces.forEach(function (p) {
                var o = document.createElement('option');
                o.value = p.id_ostan;
                o.textContent = p.ostan;
                osel.appendChild(o);
            });
        }
        osel.value = d.id_ostan || '';
        fillStats(d);
        renderCrumb(d);
        renderPlaces(d);
        renderRank(d);
        renderSourceBar(d);
        setTiles(d.level === 'city' || d.level === 'mar');
        paintGeo(d);
        drawMapNames(d);
    }

    function load(q) {
        q = q || {};
        var year = document.getElementById('dash-year').value || state.year || '';
        var live = q.live ? '1' : '';
        if (q.live) state.wantLive = true;
        var url = API + '?action=stats&year=' + encodeURIComponent(year)
            + '&id_ostan=' + encodeURIComponent(q.id_ostan != null ? q.id_ostan : state.id_ostan || '')
            + '&id_city=' + encodeURIComponent(q.id_city != null ? q.id_city : '')
            + '&id_mar=' + encodeURIComponent(q.id_mar != null ? q.id_mar : '')
            + (live ? '&live=1' : '');
        busy(true);
        $.getJSON(url).done(function (d) {
            if (d && d.ok) apply(d);
            else document.getElementById('dash-status').textContent = 'بارگذاری آمار انجام نشد.';
        }).fail(function () {
            document.getElementById('dash-status').textContent = 'ارتباط با سرور برقرار نشد.';
        }).always(function () { busy(false); });
    }

    function initMap(first) {
        if (!hasLeaflet()) {
            try { apply(first); } catch (e) {}
            document.getElementById('dash-status').textContent = 'نقشه بارگذاری نشد. از فهرست استان‌ها استفاده کنید.';
            busy(false);
            return;
        }
        map = L.map('dash-map', { zoomControl: true, attributionControl: false }).setView([32.4, 53.6], 5);
        $.getJSON(GEO).done(function (gj) {
            geoLayer = L.geoJSON(gj, {
                style: { color: '#166534', weight: 1, fillColor: '#86C9A0', fillOpacity: 0.7 },
                onEachFeature: function (feat, layer) {
                    var props = feat.properties || {};
                    var n = props.name;
                    var oid = ostanId(props.id_ostan);
                    layer.bindTooltip(n, { sticky: true });
                    layer.on('click', function () {
                        var id = oid;
                        if (!id) {
                            var rec = nameIndex[normFa(n)];
                            if (rec) id = ostanId(rec.id_ostan);
                        }
                        if (id) load({ id_ostan: id, id_city: '', id_mar: '' });
                    });
                    layer.on('keydown', function (e) {
                        if (e.originalEvent && (e.originalEvent.key === 'Enter' || e.originalEvent.key === ' ')) {
                            layer.fire('click');
                        }
                    });
                }
            }).addTo(map);
            apply(first);
            setTimeout(function () { map.invalidateSize(); }, 250);
        }).fail(function () {
            apply(first);
            document.getElementById('dash-status').textContent = 'فایل نقشه استان‌ها بارگذاری نشد. از فهرست استان‌ها استفاده کنید.';
        }).always(function () { busy(false); });
    }

    document.getElementById('dash-back').addEventListener('click', function () {
        if (state.id_mar) load({ id_ostan: state.id_ostan, id_city: state.id_city, id_mar: '' });
        else if (state.id_city) load({ id_ostan: state.id_ostan, id_city: '', id_mar: '' });
        else load({ id_ostan: '', id_city: '', id_mar: '' });
    });
    document.getElementById('dash-year').addEventListener('change', function () {
        load({ id_ostan: state.id_ostan, id_city: state.id_city, id_mar: state.id_mar });
    });
    document.querySelectorAll('.dash-rank-tab').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var domain = btn.getAttribute('data-rank-domain') === 'garden' ? 'garden' : 'agri';
            if (state.rankDomain === domain) return;
            state.rankDomain = domain;
            state.rankMetric = 'total';
            state.rankWater = 'total';
            state.rankFruit = 'total';
            if (lastRank) {
                renderRank({ rank: lastRank });
            }
        });
    });
    document.getElementById('dash-ostan').addEventListener('change', function () {
        var v = this.value;
        load({ id_ostan: v, id_city: '', id_mar: '' });
    });
    var liveBtn = document.getElementById('dash-live-btn');
    if (liveBtn) {
        liveBtn.addEventListener('click', function () {
            liveBtn.disabled = true;
            load({
                id_ostan: state.id_ostan,
                id_city: state.id_city,
                id_mar: state.id_mar,
                live: true
            });
        });
    }
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;
        var smsModal = document.getElementById('dash-sms-modal');
        if (smsModal && !smsModal.hidden) {
            closeSmsModal();
            return;
        }
        if (state.level !== 'country') {
            document.getElementById('dash-back').click();
        }
    });

    busy(true);
    $.when(
        $.getJSON(GEO_ISO).then(function (m) {
            ostanIso = {};
            Object.keys(m || {}).forEach(function (k) {
                ostanIso[normFa(k)] = m[k];
            });
        }, function () { ostanIso = {}; }),
        $.getJSON(API + '?action=stats')
    ).done(function (_iso, statsArgs) {
        var d = statsArgs[0];
        if (!d || !d.ok) {
            busy(false);
            document.getElementById('dash-status').textContent = 'بارگذاری اولیه انجام نشد.';
            return;
        }
        (d.provinces || []).forEach(function (p) { nameIndex[p.name_key] = p; });
        initMap(d);
    }).fail(function () {
        busy(false);
        document.getElementById('dash-status').textContent = 'بارگذاری اولیه انجام نشد.';
    });
})();
</script>
