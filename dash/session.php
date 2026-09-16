<?php
/**
 * Independent dash session. Valid until the end of the Tehran working day.
 * Cookie setup matches the working site login (no Secure/SameSite extras).
 */
if (!function_exists('dash_session_boot')) {
    function dash_session_boot()
    {
        date_default_timezone_set('Asia/Tehran');

        $already = false;
        if (function_exists('session_status')) {
            $already = (session_status() === PHP_SESSION_ACTIVE);
        } else {
            $already = (session_id() !== '');
        }
        if ($already) {
            return;
        }

        $life = 18 * 3600;
        if (function_exists('ini_set')) {
            ini_set('session.gc_maxlifetime', (string) $life);
            ini_set('session.cookie_lifetime', (string) $life);
        }
        session_name('PAHNEH_DASH');
        session_start();
    }
}

if (!function_exists('dash_today')) {
    function dash_today()
    {
        date_default_timezone_set('Asia/Tehran');
        return date('Y-m-d');
    }
}

if (!function_exists('dash_session_clear')) {
    function dash_session_clear()
    {
        dash_session_boot();
        $_SESSION = array();
        if (function_exists('session_destroy')) {
            session_destroy();
        }
    }
}
