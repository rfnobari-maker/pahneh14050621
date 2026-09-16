<?php
include '../lock_ce.php';
include '../web/sms1.php';

$tel_m = isset($_POST['tel_m']) ? preg_replace('/\D+/', '', $_POST['tel_m'] . '') : '';
if (strlen($tel_m) === 10 && isset($tel_m[0]) && $tel_m[0] === '9') {
    $tel_m = '0' . $tel_m;
}
if (strlen($tel_m) === 12 && strpos($tel_m, '98') === 0) {
    $tel_m = '0' . substr($tel_m, 2);
}

$message_display = '';
$message_ok = null;
$posted_message = '';

function send_sms_len($s)
{
    return function_exists('mb_strlen') ? mb_strlen($s, 'UTF-8') : strlen($s);
}

if (isset($_POST['action'])) {
    $message = isset($_POST['message']) ? trim($_POST['message'] . '') : '';
    $posted_message = $message;
    $tel_post = isset($_POST['tel_m']) ? preg_replace('/\D+/', '', $_POST['tel_m'] . '') : $tel_m;
    if (strlen($tel_post) === 10 && isset($tel_post[0]) && $tel_post[0] === '9') {
        $tel_post = '0' . $tel_post;
    }
    $tel_m = $tel_post;
    $len = send_sms_len($message);

    if (strlen($tel_m) !== 11 || $tel_m[0] !== '0') {
        $message_display = 'شماره تلفن همراه معتبر نیست.';
        $message_ok = false;
    } elseif ($len < 10) {
        $message_display = 'پیام ارسالی حداقل باید ۱۰ کاراکتر باشد.';
        $message_ok = false;
    } elseif ($len > 150) {
        $message_display = 'طول پیام حداکثر ۱۵۰ کاراکتر است.';
        $message_ok = false;
    } else {
        $uid = uniqid('sms_', true);
        $sender = isset($PersName) ? $PersName : '';
        sendSMS($tel_m, $message . '(سامانه پهنه بندی/فرستنده پیام : ' . $sender . ')', $uid);
        $message_display = 'پیام شما با موفقیت ارسال شد.';
        $message_ok = true;
        $posted_message = '';
    }
}

$tel_ok = (strlen($tel_m) === 11 && isset($tel_m[0]) && $tel_m[0] === '0');
function h($s)
{
    return htmlspecialchars($s . '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ارسال پیامک</title>
    <link rel="stylesheet" href="../FA.css">
    <style>
        :root {
            --green: #15803D;
            --ink: #14532D;
            --muted: #64748B;
            --mint: #ECFDF3;
            --line: #86C9A0;
            --danger: #B91C1C;
            --font: myfont, Tahoma, sans-serif;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px 16px;
            font-family: var(--font);
            color: var(--ink);
            background:
                radial-gradient(80% 60% at 50% 0%, rgba(21,128,61,.2), transparent 55%),
                linear-gradient(180deg, #0f172a 0%, #14532d 100%);
        }
        .card {
            width: min(420px, 100%);
            border-radius: 22px;
            overflow: hidden;
            background: linear-gradient(165deg, #F7FEF9 0%, #fff 45%, #F0FDF4 100%);
            border: 1px solid rgba(134,201,160,.65);
            box-shadow: 0 28px 64px rgba(0,0,0,.35);
        }
        .head {
            padding: 18px 18px 14px;
            background:
                radial-gradient(120% 120% at 100% 0%, rgba(134,201,160,.35), transparent 55%),
                linear-gradient(180deg, #ECFDF3, transparent);
            border-bottom: 1px solid #E8F0F1;
        }
        .head p { margin: 0 0 4px; font-size: 11px; color: var(--muted); }
        .head h1 { margin: 0; font-size: 1.15rem; color: var(--ink); }
        .body { padding: 16px 18px 18px; display: grid; gap: 12px; }
        .to {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 14px;
            background: #fff;
            border: 1px solid #E8F0F1;
            font-size: 13px;
        }
        .to b {
            direction: ltr;
            color: var(--green);
            font-variant-numeric: tabular-nums;
        }
        label { font-size: 12px; font-weight: 700; color: #475569; }
        textarea {
            width: 100%;
            min-height: 140px;
            resize: vertical;
            border: 1px solid #64748B;
            border-radius: 14px;
            padding: 12px 14px;
            font: inherit;
            font-size: 14px;
            color: var(--ink);
            direction: rtl;
        }
        textarea:focus {
            outline: 3px solid rgba(21,128,61,.28);
            outline-offset: 2px;
            border-color: var(--green);
        }
        .meta {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--muted);
        }
        .actions {
            display: grid;
            grid-template-columns: 1fr 1.35fr;
            gap: 10px;
        }
        button {
            min-height: 44px;
            border-radius: 13px;
            font: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid transparent;
        }
        .btn-send {
            background: linear-gradient(160deg, #15803D, #166534);
            color: #fff;
            box-shadow: 0 10px 22px rgba(21,128,61,.28);
        }
        .btn-ghost {
            background: #fff;
            border-color: var(--line);
            color: var(--ink);
        }
        .msg {
            padding: 10px 12px;
            border-radius: 12px;
            font-size: 13px;
            text-align: center;
            line-height: 1.5;
        }
        .msg.ok { background: var(--mint); color: var(--green); border: 1px solid var(--line); }
        .msg.err { background: #FEF2F2; color: var(--danger); border: 1px solid #FECACA; }
        .blocked {
            text-align: center;
            padding: 28px 12px;
            line-height: 1.7;
        }
        .blocked p { margin: 8px 0 18px; color: var(--muted); font-size: 13px; }
        @media (max-width: 420px) {
            .actions { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="card">
    <div class="head">
        <p>سامانه پهنه‌بندی</p>
        <h1>ارسال پیامک</h1>
    </div>
    <div class="body">
        <?php if ($tel_ok): ?>
            <div class="to">
                <span>گیرنده</span>
                <b><?php echo h($tel_m); ?></b>
            </div>
            <form method="post" action="" id="sms-form" novalidate>
                <input type="hidden" name="tel_m" value="<?php echo h($tel_m); ?>">
                <label for="message">متن پیام</label>
                <textarea id="message" name="message" maxlength="150" placeholder="متن پیام شما" required><?php echo h($posted_message); ?></textarea>
                <div class="meta">
                    <span id="count">۰ / ۱۵۰</span>
                    <span>حداقل ۱۰ کاراکتر</span>
                </div>
                <?php if ($message_display !== ''): ?>
                    <div class="msg <?php echo $message_ok ? 'ok' : 'err'; ?>" role="status"><?php echo h($message_display); ?></div>
                <?php endif; ?>
                <div class="actions">
                    <button type="button" class="btn-ghost" onclick="window.close()">انصراف</button>
                    <button type="submit" class="btn-send" name="action" value="1">ارسال</button>
                </div>
            </form>
        <?php else: ?>
            <div class="blocked">
                امکان ارسال پیامک مقدور نیست
                <p>شماره تلفن همراه کاربر معتبر نیست.</p>
                <button type="button" class="btn-ghost" onclick="window.close()">بستن</button>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
(function () {
    var ta = document.getElementById('message');
    var count = document.getElementById('count');
    if (!ta || !count) return;
    function fa(n) {
        return String(n).replace(/\d/g, function (d) { return '۰۱۲۳۴۵۶۷۸۹'[d]; });
    }
    function len(s) { return Array.from(String(s || '')).length; }
    function sync() {
        var n = len(ta.value);
        if (n > 150) {
            ta.value = Array.from(ta.value).slice(0, 150).join('');
            n = 150;
        }
        count.textContent = fa(n) + ' / ۱۵۰';
    }
    ta.addEventListener('input', sync);
    sync();
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') window.close();
    });
})();
</script>
</body>
</html>
