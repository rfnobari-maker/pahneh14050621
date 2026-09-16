<?php
/**
 * User account dropdown for dash chrome (forest-gold).
 * Same items as pahneh/chrome minus profile, password change, and page theme.
 */
if (!function_exists('dash_account_icon')) {
    function dash_account_icon($name)
    {
        $paths = array(
            'home' => '<path d="M3 11L12 3l9 8"/><path d="M5 10v10h14V10"/>',
            'logout' => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/>',
            'user' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
            'chevron' => '<path d="M6 9l6 6 6-6"/>',
            'ip' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3a14 14 0 0 1 0 18"/><path d="M12 3a14 14 0 0 0 0 18"/>',
        );
        $d = isset($paths[$name]) ? $paths[$name] : '';
        return '<svg class="dash-icon" viewBox="0 0 24 24" aria-hidden="true">' . $d . '</svg>';
    }
}

if (!function_exists('dash_account_ip')) {
    function dash_account_ip()
    {
        $ip = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        }
        $parts = explode(',', $ip);
        $ip = trim($parts[0]);
        if (strpos($ip, '.') !== false && substr_count($ip, ':') === 1) {
            $ipParts = explode(':', $ip);
            return $ipParts[0];
        }
        return $ip;
    }
}

if (!function_exists('dash_account_css')) {
    function dash_account_css()
    {
        echo <<<'CSS'
    .dash-top { position: relative; z-index: 30; }
    .dash-head-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        justify-content: flex-end;
        gap: 14px;
        min-width: 0;
    }
    .dash-tools {
        overflow: visible;
        align-items: center;
        min-height: calc(var(--touch, 48px) + 20px);
        box-sizing: border-box;
    }
    .dash-tools > .dash-tool > label { display: none; }
    .dash-account-box {
        display: flex;
        align-items: center;
        background: #fff;
        border: 1px solid var(--line, #DDD3BE);
        border-radius: 16px;
        padding: 10px;
        flex: 0 0 auto;
        position: relative;
        overflow: visible;
        min-height: calc(var(--touch, 48px) + 20px);
        box-sizing: border-box;
    }
    .dash-back.dash-home {
        width: var(--touch, 48px);
        min-width: var(--touch, 48px);
        height: var(--touch, 48px);
        padding: 0;
        justify-content: center;
        gap: 0;
        flex-shrink: 0;
        align-self: center;
    }
    .dash-back.dash-home svg,
    .dash-account svg {
        width: 22px;
        height: 22px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.75;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex: 0 0 auto;
    }
    .dash-account {
        position: relative;
        flex: 0 0 auto;
        align-self: center;
        flex-shrink: 0;
    }
    .dash-account-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: var(--touch, 48px);
        height: var(--touch, 48px);
        min-width: 44px;
        padding: 0 10px 0 4px;
        border: 1px solid var(--line, #DDD3BE);
        border-radius: 14px;
        background: #fff;
        color: var(--text, #14221A);
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        box-sizing: border-box;
    }
    .dash-account-btn:hover,
    .dash-account.is-open > .dash-account-btn {
        border-color: #C9A227;
        background: #FFF8EA;
    }
    .dash-account-btn .dash-icon {
        width: 18px;
        height: 18px;
        transition: transform .15s ease;
    }
    .dash-account.is-open .dash-account-btn .dash-icon {
        transform: rotate(180deg);
    }
    .dash-account-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        width: 36px;
        height: 36px;
        overflow: hidden;
        border-radius: 50%;
        border: 1px solid rgba(201, 162, 39, 0.45);
        background: #0C2418;
        color: #E8D48B;
    }
    .dash-account-avatar img {
        display: block;
        width: 36px;
        height: 36px;
        object-fit: cover;
        object-position: center;
    }
    .dash-account-avatar .dash-icon { width: 18px; height: 18px; }
    .dash-account-name {
        max-width: 180px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        line-height: 1.3;
    }
    .dash-account-menu {
        display: none;
        position: absolute;
        top: calc(100% + 6px);
        inset-inline-end: 0;
        min-width: 260px;
        max-width: min(320px, calc(100vw - 24px));
        padding: 8px 0;
        background: #FFFCF6;
        color: #14221A;
        border: 1px solid #DDD3BE;
        border-radius: 14px;
        box-shadow: 0 16px 36px rgba(6, 20, 12, 0.18);
        z-index: 40;
    }
    .dash-account.is-open > .dash-account-menu { display: block; }
    .dash-account-meta {
        display: flex;
        flex-direction: column;
        gap: 2px;
        padding: 8px 14px 10px;
        border-bottom: 1px solid #DDD3BE;
    }
    .dash-account-meta strong {
        font-size: 0.9375rem;
        line-height: 1.4;
        font-weight: 800;
    }
    .dash-account-meta span {
        color: #4A5A51;
        font-size: 0.8125rem;
        font-weight: 600;
    }
    .dash-account-menu a,
    .dash-account-ip {
        display: flex;
        align-items: center;
        gap: 8px;
        min-height: var(--touch, 48px);
        padding: 0 14px;
        color: #14221A;
        text-decoration: none;
        font-size: 0.9375rem;
        font-weight: 700;
    }
    .dash-account-menu a:hover { background: #FFF8EA; }
    .dash-account-ip {
        color: #4A5A51;
        font-size: 0.875rem;
        font-weight: 600;
    }
    .dash-account-sep {
        height: 1px;
        margin: 6px 0;
        background: #DDD3BE;
        border: 0;
    }
    .dash-account-menu a.is-danger { color: #B42318; }
    .dash-account-menu a.is-danger:hover { background: #FDECEC; }
    .dash-account-ip-val { direction: ltr; unicode-bidi: isolate; }
    .dash-account-btn:focus-visible,
    .dash-account-menu a:focus-visible {
        outline: 3px solid rgba(201, 162, 39, 0.55);
        outline-offset: 2px;
    }
    @media (max-width: 480px) {
        .dash-account-name { display: none; }
        .dash-account-btn { padding-inline-end: 6px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .dash-account-btn .dash-icon { transition: none; }
        .dash-account.is-open .dash-account-btn .dash-icon { transform: none; }
    }
CSS;
    }
}

if (!function_exists('dash_account_honorific')) {
    function dash_account_honorific($jens, $v_jen)
    {
        $j = trim(str_replace(array('ي', 'ك', '‌'), array('ی', 'ک', ''), $jens . ''));
        if ($j === 'زن' || $j === 'خانم' || $j === '2') {
            return 'خانم';
        }
        if ($j === 'مرد' || $j === 'آقا' || $j === 'آقای' || $j === '1') {
            return 'آقا';
        }
        $v = trim($v_jen . '');
        if ($v === 'خانم') {
            return 'خانم';
        }
        if ($v === 'آقا' || $v === 'آقای') {
            return 'آقا';
        }
        return '';
    }
}

if (!function_exists('dash_account_html')) {
    function dash_account_html()
    {
        global $dash_root, $dash_user_pic, $dash_user_vjen, $dash_user_last, $dash_user_first, $dash_user_jens, $pic, $v_jen, $jens;
        $h = function ($v) {
            if (function_exists('dash_h')) {
                return dash_h($v);
            }
            return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
        };
        $root = isset($dash_root) ? $dash_root : '../';
        $picFile = isset($dash_user_pic) ? trim($dash_user_pic . '') : (isset($pic) ? trim($pic . '') : '');
        $picSrc = '';
        if (function_exists('dash_pic_url')) {
            $picSrc = dash_pic_url($picFile, $root);
        } elseif ($picFile !== '' && $picFile !== 'no_pic.png') {
            $picSrc = $root . 'files/users/' . rawurlencode($picFile);
        }
        $last = isset($dash_user_last) ? trim($dash_user_last . '') : '';
        $first = isset($dash_user_first) ? trim($dash_user_first . '') : '';
        $honor = dash_account_honorific(
            isset($dash_user_jens) ? $dash_user_jens : (isset($jens) ? $jens : ''),
            isset($dash_user_vjen) ? $dash_user_vjen : (isset($v_jen) ? $v_jen : '')
        );
        $user_display = trim($honor . ' ' . $last);
        $button_name = ($user_display !== '') ? $user_display : $first;
        $meta_strong = ($user_display !== '') ? $user_display : 'کارشناس';
        $userIp = dash_account_ip();
        ?>
            <div class="dash-account-box">
            <div class="dash-account" id="dash-account">
                <button type="button" class="dash-account-btn" id="dash-account-btn" aria-expanded="false" aria-haspopup="true" aria-controls="dash-account-menu" aria-label="منوی حساب کاربری">
                    <span class="dash-account-avatar">
                        <?php if ($picSrc !== '') { ?>
                            <img src="<?php echo $h($picSrc); ?>" width="36" height="36" alt="">
                        <?php } else { ?>
                            <?php echo dash_account_icon('user'); ?>
                        <?php } ?>
                    </span>
                    <span class="dash-account-name"><?php echo $h($button_name !== '' ? $button_name : 'کارشناس'); ?></span>
                    <?php echo dash_account_icon('chevron'); ?>
                </button>
                <div class="dash-account-menu" id="dash-account-menu">
                    <div class="dash-account-meta">
                        <strong><?php echo $h($meta_strong); ?></strong>
                        <?php if ($first !== '') { ?>
                            <span><?php echo $h($first); ?></span>
                        <?php } ?>
                    </div>
                    <div class="dash-account-ip" title="نشانی اینترنتی">
                        <?php echo dash_account_icon('ip'); ?>
                        <span class="dash-account-ip-val"><?php echo $h($userIp); ?></span>
                    </div>
                    <hr class="dash-account-sep"/>
                    <a class="is-danger" href="logout.php">
                        <?php echo dash_account_icon('logout'); ?>
                        <span>خروج از سیستم</span>
                    </a>
                </div>
            </div>
            </div>
            <script>
            (function () {
                var account = document.getElementById('dash-account');
                var btn = document.getElementById('dash-account-btn');
                if (!account || !btn || account.getAttribute('data-ready') === '1') return;
                account.setAttribute('data-ready', '1');
                function closeAccount() {
                    account.classList.remove('is-open');
                    btn.setAttribute('aria-expanded', 'false');
                }
                function openAccount() {
                    account.classList.add('is-open');
                    btn.setAttribute('aria-expanded', 'true');
                }
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (account.classList.contains('is-open')) closeAccount();
                    else openAccount();
                });
                document.addEventListener('click', function (e) {
                    if (!account.contains(e.target)) closeAccount();
                });
                document.addEventListener('keydown', function (e) {
                    if (e.key !== 'Escape' || !account.classList.contains('is-open')) return;
                    e.stopImmediatePropagation();
                    closeAccount();
                    btn.focus();
                });
            })();
            </script>
        <?php
    }
}
