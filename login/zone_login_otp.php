<?php
/**
 * ورود دومرحله‌ای کارشناس پهنه.
 * این فایل از جدول و آدرس‌های بازیابی رمز استفاده نمی‌کند.
 */

define('ZONE_OTP_TTL', 120);
define('ZONE_OTP_RESEND_GAP', 60);
define('ZONE_OTP_MAX_ATTEMPTS', 5);
define('ZONE_OTP_MAX_SENDS', 5);
define('ZONE_OTP_SEND_WINDOW', 900);

function zone_otp_normalize_mobile($tel)
{
    $digits = preg_replace('/\D+/', '', (string) $tel);
    if (!is_string($digits)) {
        return '';
    }
    if (strpos($digits, '0098') === 0) {
        $digits = substr($digits, 4);
    }
    if (strpos($digits, '98') === 0 && strlen($digits) === 12) {
        $digits = '0' . substr($digits, 2);
    }
    if (strlen($digits) === 10 && isset($digits[0]) && $digits[0] === '9') {
        $digits = '0' . $digits;
    }
    if (!preg_match('/^09[0-9]{9}$/', $digits)) {
        return '';
    }
    return $digits;
}

function zone_otp_mask($phone)
{
    $phone = zone_otp_normalize_mobile($phone);

    if ($phone === '') {
        return '';
    }

    $head = substr($phone, 0, 4);
    $tail = substr($phone, -2);

    return $head . '***' . $tail;
}

function zone_otp_mask_text($phone)
{
    $mask = zone_otp_mask($phone);
    if ($mask === '') {
        return '';
    }
    return "\xE2\x81\xA6" . $mask . "\xE2\x81\xA9";
}

function zone_otp_mask_display($mask)
{
    return (string) $mask;
}

function zone_otp_mask_parts($mask)
{
    $clean = preg_replace('/[^\d*]/u', '', (string) $mask);
    if (!is_string($clean)) {
        $clean = '';
    }
    if (preg_match('/^(\d{2})\*+(\d{4})$/', $clean, $parts)) {
        return array($parts[1], $parts[2]);
    }
    if (preg_match('/^(\d{4})\*+(\d{2})$/', $clean, $parts)) {
        return array($parts[2], $parts[1]);
    }
    return array('', (string) $mask);
}

function zone_otp_mask_spans($mask)
{
    $display = htmlspecialchars((string) $mask, ENT_QUOTES, 'UTF-8');

    return '<span class="otp-mask" dir="ltr" style="display:inline-block; direction:ltr; unicode-bidi:isolate;">'
         . $display
         . '</span>';
}

function zone_otp_normalize_code($code)
{
    $code = str_replace(
        array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩', ' ', '-', '−'),
        array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '', '', ''),
        trim((string) $code)
    );
    if (!preg_match('/^[0-9]{6}$/', $code)) {
        return '';
    }
    return $code;
}

function zone_otp_random_code()
{
    if (function_exists('random_int')) {
        return (string) random_int(100000, 999999);
    }
    return (string) mt_rand(100000, 999999);
}

function zone_otp_random_id()
{
    if (function_exists('random_bytes')) {
        return bin2hex(random_bytes(16));
    }
    if (function_exists('openssl_random_pseudo_bytes')) {
        $bytes = openssl_random_pseudo_bytes(16);
        if ($bytes !== false) {
            return bin2hex($bytes);
        }
    }
    return hash('sha256', uniqid('otp', true) . mt_rand());
}

function zone_otp_hash_equals($known, $user)
{
    $known = (string) $known;
    $user = (string) $user;
    if (function_exists('hash_equals')) {
        return hash_equals($known, $user);
    }
    if (strlen($known) !== strlen($user)) {
        return false;
    }
    $res = 0;
    $len = strlen($known);
    for ($i = 0; $i < $len; $i++) {
        $res |= ord($known[$i]) ^ ord($user[$i]);
    }
    return $res === 0;
}

function zone_otp_code_hash($challengeId, $username, $code)
{
    return hash('sha256', $challengeId . '|' . $username . '|' . $code);
}

function zone_otp_regenerate_session()
{
    if (function_exists('session_status')) {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
        return;
    }
    if (session_id() !== '') {
        session_regenerate_id(true);
    }
}

function zone_otp_clear_auth_session()
{
    $keys = array(
        'login_user', 'karbar', 'title', 'username', 'cod_m', 'PersName',
        'ostan', 'city', 'id_ostan', 'id_city', 'markaz', 'id_mar', 'name',
        'jens', 'date_pas', 'v_jen', 'pic', 'no_karbar'
    );
    foreach ($keys as $key) {
        unset($_SESSION[$key]);
    }
}

function zone_otp_clear_challenge()
{
    unset($_SESSION['zone_login_otp']);
}

function zone_otp_rate_path($username)
{
    $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'pahneh_zone_otp';
    if (!is_dir($dir)) {
        @mkdir($dir, 0700, true);
    }
    return $dir . DIRECTORY_SEPARATOR . hash('sha256', 'zone-otp-send|' . $username) . '.json';
}

function zone_otp_rate_collect($username, $fileTimes)
{
    $now = time();
    $sessionTimes = array();
    if (isset($_SESSION['zone_otp_send_log'][$username]) && is_array($_SESSION['zone_otp_send_log'][$username])) {
        $sessionTimes = $_SESSION['zone_otp_send_log'][$username];
    }
    if (!is_array($fileTimes)) {
        $fileTimes = array();
    }
    $fresh = array();
    foreach (array_merge($sessionTimes, $fileTimes) as $stamp) {
        if (is_numeric($stamp) && ($now - (int) $stamp) < ZONE_OTP_SEND_WINDOW) {
            $fresh[(int) $stamp] = (int) $stamp;
        }
    }
    $fresh = array_values($fresh);
    sort($fresh);
    return $fresh;
}

function zone_otp_rate_decide($times)
{
    $now = time();
    $last = count($times) ? (int) max($times) : 0;
    if ($last && ($now - $last) < ZONE_OTP_RESEND_GAP) {
        $wait = ZONE_OTP_RESEND_GAP - ($now - $last);
        return array(
            'ok' => false,
            'message' => 'ارسال دوباره کد تا ' . $wait . ' ثانیه دیگر ممکن است.'
        );
    }
    if (count($times) >= ZONE_OTP_MAX_SENDS) {
        return array(
            'ok' => false,
            'message' => 'تعداد ارسال کد تأیید بیش از حد مجاز است. لطفاً دقایقی دیگر دوباره وارد شوید.'
        );
    }
    return array('ok' => true);
}

function zone_otp_rate_store_session($username, $times)
{
    if (!isset($_SESSION['zone_otp_send_log']) || !is_array($_SESSION['zone_otp_send_log'])) {
        $_SESSION['zone_otp_send_log'] = array();
    }
    $_SESSION['zone_otp_send_log'][$username] = $times;
}

function zone_otp_rate_reserve($username)
{
    $path = zone_otp_rate_path($username);
    $fh = @fopen($path, 'c+');
    if ($fh === false) {
        $times = zone_otp_rate_collect($username, array());
        $decision = zone_otp_rate_decide($times);
        if ($decision['ok']) {
            $times[] = time();
            zone_otp_rate_store_session($username, $times);
        }
        return $decision;
    }
    if (!flock($fh, LOCK_EX)) {
        fclose($fh);
        $times = zone_otp_rate_collect($username, array());
        $decision = zone_otp_rate_decide($times);
        if ($decision['ok']) {
            $times[] = time();
            zone_otp_rate_store_session($username, $times);
        }
        return $decision;
    }

    $decoded = json_decode((string) stream_get_contents($fh), true);
    $times = zone_otp_rate_collect($username, is_array($decoded) ? $decoded : array());
    $decision = zone_otp_rate_decide($times);
    if ($decision['ok']) {
        $times[] = time();
        zone_otp_rate_store_session($username, $times);
        rewind($fh);
        ftruncate($fh, 0);
        rewind($fh);
        fwrite($fh, json_encode(array_values($times)));
        fflush($fh);
    }
    flock($fh, LOCK_UN);
    fclose($fh);
    return $decision;
}

function zone_otp_save_challenge($username, $code, $mask, $attempts = 0)
{
    $challengeId = zone_otp_random_id();
    $_SESSION['zone_login_otp'] = array(
        'username' => $username,
        'challenge_id' => $challengeId,
        'code_hash' => zone_otp_code_hash($challengeId, $username, $code),
        'expires_at' => time() + ZONE_OTP_TTL,
        'attempts' => (int) $attempts,
        'mask' => $mask,
        'sent_at' => time(),
        'consumed' => 0
    );
}

function zone_otp_dispatch($phone, $code)
{
    $smsFile = dirname(__DIR__) . '/web/sms1.php';
    if (!is_file($smsFile)) {
        return array('ok' => false, 'message' => 'ارسال کد تأیید ممکن نیست. ورود انجام نشد.');
    }
    ob_start();
    include_once $smsFile;
    if (!function_exists('sendSMS')) {
        ob_end_clean();
        return array('ok' => false, 'message' => 'ارسال کد تأیید ممکن نیست. ورود انجام نشد.');
    }
    $uid = uniqid('', true);
    $sentOk = sendSMS($phone, 'کد ورود سامانه پهنه بندی: ' . $code, $uid);
    ob_end_clean();
    if ($sentOk !== true) {
        return array('ok' => false, 'message' => 'ارسال کد تأیید به شماره همراه انجام نشد. ورود انجام نشد.');
    }
    return array('ok' => true);
}

function zone_otp_start($username, $phone)
{
    zone_otp_clear_auth_session();
    $phone = zone_otp_normalize_mobile($phone);
    if ($phone === '' || $username === '') {
        return array('ok' => false, 'message' => 'شماره همراه معتبری در پرونده شما ثبت نشده است. ورود انجام نشد.');
    }
    $rate = zone_otp_rate_reserve($username);
    if (!$rate['ok']) {
        return $rate;
    }
    $code = zone_otp_random_code();
    $sent = zone_otp_dispatch($phone, $code);
    if (!$sent['ok']) {
        return $sent;
    }
    zone_otp_regenerate_session();
    zone_otp_save_challenge($username, $code, zone_otp_mask($phone));
    return array(
        'ok' => true,
        'message' => 'کد تأیید ارسال شد. اعتبار کد ۱۲۰ ثانیه است.'
    );
}

function zone_otp_require_challenge()
{
    if (empty($_SESSION['zone_login_otp']) || !is_array($_SESSION['zone_login_otp'])) {
        return array('ok' => false, 'message' => 'درخواست ورود پیدا نشد. دوباره نام کاربری و کلمه عبور را وارد کنید.');
    }
    $challenge = $_SESSION['zone_login_otp'];
    if (!empty($challenge['consumed'])) {
        zone_otp_clear_challenge();
        return array('ok' => false, 'message' => 'این کد تأیید دیگر قابل استفاده نیست. دوباره وارد شوید.');
    }
    if (empty($challenge['expires_at']) || time() >= (int) $challenge['expires_at']) {
        zone_otp_clear_challenge();
        return array('ok' => false, 'message' => 'مهلت کد تأیید تمام شده است. دوباره نام کاربری و کلمه عبور را وارد کنید.');
    }
    return array('ok' => true, 'challenge' => $challenge);
}

function zone_otp_fail_attempt($message)
{
    if (empty($_SESSION['zone_login_otp']) || !is_array($_SESSION['zone_login_otp'])) {
        return array('ok' => false, 'message' => $message);
    }
    $_SESSION['zone_login_otp']['attempts'] = (int) $_SESSION['zone_login_otp']['attempts'] + 1;
    if ((int) $_SESSION['zone_login_otp']['attempts'] >= ZONE_OTP_MAX_ATTEMPTS) {
        zone_otp_clear_challenge();
        return array(
            'ok' => false,
            'message' => 'کد تأیید چند بار اشتباه وارد شد. دوباره از مرحله نام کاربری و کلمه عبور وارد شوید.'
        );
    }
    $left = ZONE_OTP_MAX_ATTEMPTS - (int) $_SESSION['zone_login_otp']['attempts'];
    return array('ok' => false, 'message' => $message . ' تلاش باقی‌مانده: ' . $left . '.');
}

function zone_otp_posted_challenge_matches($challenge)
{
    $posted = isset($_POST['challenge_id']) ? (string) $_POST['challenge_id'] : '';
    $known = isset($challenge['challenge_id']) ? (string) $challenge['challenge_id'] : '';
    if ($posted === '' || $known === '') {
        return false;
    }
    return zone_otp_hash_equals($known, $posted);
}

function zone_otp_verify()
{
    $state = zone_otp_require_challenge();
    if (!$state['ok']) {
        return $state;
    }
    $challenge = $state['challenge'];
    if (!zone_otp_posted_challenge_matches($challenge)) {
        return array('ok' => false, 'message' => 'این صفحه با درخواست ورود فعلی هم‌خوان نیست. صفحه را یک‌بار تازه‌سازی کنید.');
    }
    $code = zone_otp_normalize_code(isset($_POST['otp_code']) ? $_POST['otp_code'] : '');
    if ($code === '') {
        return array('ok' => false, 'message' => 'کد تأیید را وارد کنید.');
    }
    $calc = zone_otp_code_hash($challenge['challenge_id'], $challenge['username'], $code);
    if (!zone_otp_hash_equals((string) $challenge['code_hash'], $calc)) {
        return zone_otp_fail_attempt('کد تأیید نادرست است.');
    }
    $_SESSION['zone_login_otp']['consumed'] = 1;
    $_SESSION['zone_login_otp']['code_hash'] = '';
    return array('ok' => true, 'username' => $challenge['username']);
}

function zone_otp_phone_for_user($dbh, $username)
{
    $stmt = $dbh->prepare('SELECT Access, S_access, tel_m FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        return array(
            'ok' => false,
            'clear' => true,
            'message' => 'درخواست ورود پیدا نشد. دوباره نام کاربری و کلمه عبور را وارد کنید.'
        );
    }
    if (!($row['Access'] == 1)) {
        return array(
            'ok' => false,
            'clear' => true,
            'message' => 'دسترسی شما به سامانه مسدود شده است'
        );
    }
    if (!($row['S_access'] == '1')) {
        return array(
            'ok' => false,
            'clear' => true,
            'message' => 'وضعیت دسترسی شما تغییر کرده است. دوباره نام کاربری و کلمه عبور را وارد کنید.'
        );
    }
    $phone = zone_otp_normalize_mobile($row['tel_m']);
    if ($phone === '') {
        return array(
            'ok' => false,
            'clear' => true,
            'message' => 'شماره همراه معتبری در پرونده شما ثبت نشده است. ورود انجام نشد.'
        );
    }
    return array('ok' => true, 'phone' => $phone);
}

function zone_otp_resend($dbh)
{
    $state = zone_otp_require_challenge();
    if (!$state['ok']) {
        return $state;
    }
    $challenge = $state['challenge'];
    if (!zone_otp_posted_challenge_matches($challenge)) {
        return array('ok' => false, 'message' => 'این صفحه با درخواست ورود فعلی هم‌خوان نیست. صفحه را یک‌بار تازه‌سازی کنید.');
    }
    $phoneRow = zone_otp_phone_for_user($dbh, $challenge['username']);
    if (!$phoneRow['ok']) {
        if (!empty($phoneRow['clear'])) {
            zone_otp_clear_challenge();
            zone_otp_clear_auth_session();
        }
        return $phoneRow;
    }
    $rate = zone_otp_rate_reserve($challenge['username']);
    if (!$rate['ok']) {
        return $rate;
    }
    $keptAttempts = isset($challenge['attempts']) ? (int) $challenge['attempts'] : 0;
    $code = zone_otp_random_code();
    $sent = zone_otp_dispatch($phoneRow['phone'], $code);
    if (!$sent['ok']) {
        return $sent;
    }
    zone_otp_regenerate_session();
    zone_otp_save_challenge($challenge['username'], $code, zone_otp_mask($phoneRow['phone']), $keptAttempts);
    return array(
        'ok' => true,
        'message' => 'کد تأیید جدید ارسال شد. اعتبار کد ۱۲۰ ثانیه است.'
    );
}

function zone_otp_panel()
{
    if (empty($_SESSION['zone_login_otp']) || !is_array($_SESSION['zone_login_otp'])) {
        return null;
    }
    $challenge = $_SESSION['zone_login_otp'];
    if (!empty($challenge['consumed']) || empty($challenge['expires_at']) || time() >= (int) $challenge['expires_at']) {
        zone_otp_clear_challenge();
        return array('expired' => true);
    }
    $sentAt = isset($challenge['sent_at']) ? (int) $challenge['sent_at'] : time();
    $wait = ZONE_OTP_RESEND_GAP - (time() - $sentAt);
    if ($wait < 0) {
        $wait = 0;
    }
    $attempts = isset($challenge['attempts']) ? (int) $challenge['attempts'] : 0;
    return array(
        'expired' => false,
        'mask' => zone_otp_mask_display(isset($challenge['mask']) ? $challenge['mask'] : ''),
        'challenge_id' => isset($challenge['challenge_id']) ? $challenge['challenge_id'] : '',
        'resend_wait' => $wait,
        'attempts_left' => ZONE_OTP_MAX_ATTEMPTS - $attempts,
        'expires_in' => (int) $challenge['expires_at'] - time()
    );
}
