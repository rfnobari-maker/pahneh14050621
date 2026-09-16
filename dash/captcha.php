<?php
require_once dirname(__FILE__) . '/session.php';
dash_session_boot();

$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
$code = '';
for ($i = 0; $i < 5; $i++) {
    $code .= $chars[mt_rand(0, strlen($chars) - 1)];
}
$_SESSION['dash_captcha'] = md5($code);

$w = 152;
$h = 52;
$safe = htmlspecialchars($code, ENT_QUOTES, 'UTF-8');
$lines = '';
for ($i = 0; $i < 6; $i++) {
    $x1 = mt_rand(4, $w - 4);
    $y1 = mt_rand(4, $h - 4);
    $x2 = mt_rand(4, $w - 4);
    $y2 = mt_rand(4, $h - 4);
    $op = mt_rand(18, 38) / 100;
    $lines .= '<line x1="' . $x1 . '" y1="' . $y1 . '" x2="' . $x2 . '" y2="' . $y2 . '" stroke="#8A6A1F" stroke-width="1" stroke-opacity="' . $op . '"/>';
}

header('Content-Type: image/svg+xml; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<svg xmlns="http://www.w3.org/2000/svg" width="' . $w . '" height="' . $h . '" viewBox="0 0 ' . $w . ' ' . $h . '" role="img" aria-hidden="true">';
echo '<defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#F4EDE0"/><stop offset="1" stop-color="#E7DCC4"/></linearGradient></defs>';
echo '<rect width="' . $w . '" height="' . $h . '" rx="12" fill="url(#g)" stroke="#C9A227"/>';
echo $lines;
echo '<text x="76" y="34" text-anchor="middle" font-size="20" font-family="Georgia, Times New Roman, serif" letter-spacing="6" fill="#1A2E22">' . $safe . '</text>';
echo '</svg>';
exit;
