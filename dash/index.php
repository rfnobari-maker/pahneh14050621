<?php
require_once dirname(__FILE__) . '/auth.php';
require_once dirname(__FILE__) . '/lib.php';
dash_filter_prg(array('year', 'id_ostan', 'id_city', 'id_mar'));
$dash_boot = dash_filter_session_get();
$dash_api = 'api.php';
$dash_sms = 'sms.php';
$dash_root = '../';
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'داشبورد مدیریتی'; ?></title>
    <link rel="shortcut icon" href="<?php echo htmlspecialchars($dash_root, ENT_QUOTES, 'UTF-8'); ?>files/images/favicon.ico" type="image/x-icon">
    <style>
        @font-face { font-family: YekanBakh; src: url("<?php echo htmlspecialchars($dash_root, ENT_QUOTES, 'UTF-8'); ?>assets/fonts/Yekan-Bakh-Fa-En-04-Regular.woff") format("woff"); font-weight: 400; font-display: swap; }
        @font-face { font-family: YekanBakh; src: url("<?php echo htmlspecialchars($dash_root, ENT_QUOTES, 'UTF-8'); ?>assets/fonts/Yekan-Bakh-Fa-En-05-Medium.woff") format("woff"); font-weight: 500; font-display: swap; }
        @font-face { font-family: YekanBakh; src: url("<?php echo htmlspecialchars($dash_root, ENT_QUOTES, 'UTF-8'); ?>assets/fonts/Yekan-Bakh-Fa-En-06-Bold.woff") format("woff"); font-weight: 700; font-display: swap; }
        @font-face { font-family: YekanBakh; src: url("<?php echo htmlspecialchars($dash_root, ENT_QUOTES, 'UTF-8'); ?>assets/fonts/Yekan-Bakh-Fa-En-07-Heavy.woff") format("woff"); font-weight: 800; font-display: swap; }
        :root {
            --ink: #06140C;
            --forest: #0C2418;
            --canopy: #163524;
            --leaf: #1F6B45;
            --gold: #C9A227;
            --gold-soft: #E8D48B;
            --cream: #F6F1E7;
            --paper: #FFFCF6;
            --text: #14221A;
            --muted: #4A5A51;
            --line: #DDD3BE;
            --danger: #B42318;
            --danger-bg: #FDECEC;
            --ring: #C9A227;
            --touch: 48px;
            --radius: 28px;
            --ease: cubic-bezier(.22, 1, .36, 1);
        }
    </style>
</head>
<body class="dash-body">
<?php require dirname(__FILE__) . '/body.php'; ?>
</body>
</html>
