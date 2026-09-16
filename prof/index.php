<?php include("../lock_p1.php"); ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
    <link href="../FA.css" rel="stylesheet">
    <style>
        :root {
            --color-primary: #15803D;
            --color-on-primary: #FFFFFF;
            --color-secondary: #166534;
            --color-accent: #A16207;
            --color-on-accent: #FFFFFF;
            --color-background: #F0FDF4;
            --color-foreground: #14532D;
            --color-card: #FFFFFF;
            --color-card-foreground: #14532D;
            --color-muted: #E8F0F1;
            --color-muted-foreground: #475569;
            --color-border: #86C9A0;
            --color-destructive: #DC2626;
            --color-on-destructive: #FFFFFF;
            --color-ring: #15803D;
            --color-warning-bg: #FEF2F2;
            --space-1: 8px;
            --space-2: 16px;
            --space-3: 24px;
            --space-4: 32px;
            --radius: 12px;
            --duration: 200ms;
            --shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
            --touch: 44px;
            --font: myfont, Tahoma, "Segoe UI", sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-padding-top: 96px; }

        body.agri1-body {
            margin: 0;
            background: var(--color-background);
            color: var(--color-foreground);
            font-family: var(--font);
            font-size: 16px;
            line-height: 1.6;
        }

        .agri1-skip {
            position: absolute;
            right: -999px;
            top: 8px;
            z-index: 50;
            background: var(--color-primary);
            color: var(--color-on-primary);
            padding: 8px 16px;
            border-radius: 8px;
        }
        .agri1-skip:focus { right: 8px; }

        .agri1-main {
            width: min(920px, 100%);
            margin: 0 auto;
            padding: var(--space-3) var(--space-2) var(--space-4);
        }

        .agri1-title {
            margin: 0 0 var(--space-2);
            color: var(--color-foreground);
            font-size: clamp(1.35rem, 2.4vw, 1.85rem);
            line-height: 1.4;
            text-wrap: balance;
        }

        .agri1-hero { margin-bottom: var(--space-3); }

        .agri1-card {
            background: var(--color-card);
            color: var(--color-card-foreground);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: var(--space-3);
        }

        .agri1-choices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        a.agri1-choice {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 52px;
            padding: 12px 14px;
            border: 2px solid var(--color-border);
            border-radius: var(--radius);
            background: var(--color-card);
            color: var(--color-foreground);
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            touch-action: manipulation;
            transition: border-color var(--duration) ease, background-color var(--duration) ease, box-shadow var(--duration) ease;
        }
        a.agri1-choice:hover {
            border-color: var(--color-primary);
            background: #F7FEF9;
        }
        a.agri1-choice:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }

        .agri1-sticker {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: var(--radius);
            background: #ECFDF3;
            border: 1px solid var(--color-border);
            color: var(--color-primary);
        }

        .agri1-icon {
            flex: 0 0 auto;
            width: 24px;
            height: 24px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .agri1-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            min-height: var(--touch);
            min-width: var(--touch);
            padding: 10px 20px;
            border: 0;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            touch-action: manipulation;
            transition: background-color var(--duration) ease, transform var(--duration) ease, box-shadow var(--duration) ease, opacity var(--duration) ease;
        }
        .agri1-btn:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-btn:active { transform: translateY(1px); }

        .agri1-btn-primary {
            background: var(--color-primary);
            color: var(--color-on-primary);
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25);
        }
        .agri1-btn-primary:hover { background: var(--color-secondary); }

        .agri1-btn-ghost {
            background: transparent;
            color: var(--color-foreground);
            border: 1px solid var(--color-border);
        }
        .agri1-btn-ghost:hover { background: var(--color-muted); }

        .agri1-back { margin-top: var(--space-3); }
        .agri1-back .agri1-btn { width: auto; }

        @media (max-width: 640px) {
            .agri1-choices { grid-template-columns: 1fr; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            .agri1-btn:active { transform: none; }
        }
    </style>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#agri1-content">رفتن به محتوا</a>

    <?php include(__DIR__ . '/../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri1-content">اطلاعات اختصاصی</h1>
        </header>

        <section class="agri1-card" aria-labelledby="agri1-content">
            <nav class="agri1-choices" aria-label="بخش‌های اطلاعات اختصاصی">
                <a href="benefic.php" class="agri1-choice">
                    <span class="agri1-sticker" aria-hidden="true">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </span>
                    بهره برداران کشاورزی
                </a>
                <a href="Agri/" class="agri1-choice">
                    <span class="agri1-sticker" aria-hidden="true">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12 22V10"></path>
                            <path d="M12 10c2-4 6-6 8-6-1 5-5 8-8 8z"></path>
                            <path d="M12 10c-2-4-6-6-8-6 1 5 5 8 8 8z"></path>
                        </svg>
                    </span>
                    زراعت
                </a>
                <a href="./Garden/" class="agri1-choice">
                    <span class="agri1-sticker" aria-hidden="true">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12 3v18"></path>
                            <path d="M5 10c3 0 5-3 7-7 2 4 4 7 7 7"></path>
                            <path d="M5 16c3 0 5-3 7-7 2 4 4 7 7 7"></path>
                        </svg>
                    </span>
                    باغبانی
                </a>
                <a href="Poultry/" class="agri1-choice">
                    <span class="agri1-sticker" aria-hidden="true">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12 8c3 0 6 2 6 5s-3 5-6 5-6-2-6-5 3-5 6-5z"></path>
                            <path d="M8 8c0-3 2-5 4-5 1 2 1 4 0 6"></path>
                            <path d="M16 8c0-3-2-5-4-5"></path>
                        </svg>
                    </span>
                    زنبور عسل
                </a>
                <a href="Aquatic/" class="agri1-choice">
                    <span class="agri1-sticker" aria-hidden="true">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M3 12s4-6 9-6 9 6 9 6-4 6-9 6-9-6-9-6z"></path>
                            <path d="M16 12h5"></path>
                            <circle cx="9" cy="12" r="1"></circle>
                        </svg>
                    </span>
                    آبزی پروری
                </a>
                <a href="Animal/" class="agri1-choice">
                    <span class="agri1-sticker" aria-hidden="true">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M6 8c2-3 10-3 12 0"></path>
                            <path d="M5 12h14"></path>
                            <path d="M7 12v7"></path>
                            <path d="M17 12v7"></path>
                            <path d="M5 19h14"></path>
                            <path d="M9 8V5"></path>
                            <path d="M15 8V5"></path>
                        </svg>
                    </span>
                    دام
                </a>
            </nav>
        </section>

        <p class="agri1-back">
            <a class="agri1-btn agri1-btn-ghost" href="../indexbenef.php">
                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                </svg>
                بازگشت به صفحه قبل
            </a>
        </p>
    </main>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../footer.php'); ?>
            </td>
        </tr>
    </table>
</body>
</html>
