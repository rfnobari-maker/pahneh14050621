<?php
// PHP 5.3.2 سازگار - طراحی شده برای include شدن
// بهینه شده برای سرعت لود بالا

if (!function_exists('agri1_footer_h')) {
    function agri1_footer_h($v)
    {
        if (!isset($v)) {
            return '';
        }
        return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
    }
}

$base_dir = dirname(__FILE__);

require_once $base_dir . '/login/config.php';

$messages = array();

if (isset($dbh) && ($dbh instanceof PDO)) {
    try {
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

        $sql = "SELECT * FROM system_messages ORDER BY order_num ASC, id ASC";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $messages = array();
    }
}

$js_messages_data = array();
if (!empty($messages)) {
    foreach ($messages as $msg) {
        $storageKey = !empty($msg['message_key']) ? $msg['message_key'] : 'msg_' . $msg['id'];
        $storageKey = $storageKey . '_' . $msg['id'];
        $js_messages_data[] = array(
            'id' => 'msg_' . $msg['id'],
            'key' => $storageKey
        );
    }
}
?>
<style>
    .agri1-footer-copy,
    .agri1-sysmsg {
        --color-primary: #15803D;
        --color-foreground: #14532D;
        --color-card: #FFFFFF;
        --color-border: #86C9A0;
        --color-ring: #15803D;
        --color-warning-bg: #FEF2F2;
        --space-1: 8px;
        --space-2: 16px;
        --radius: 12px;
        --shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
        --touch: 44px;
        --font: myfont, Tahoma, "Segoe UI", sans-serif;
    }

    .agri1-footer-copy,
    .agri1-sysmsg,
    .agri1-sysmsg * {
        box-sizing: border-box;
    }

    p.agri1-footer-copy.MenuItemRight {
        margin: 0;
        padding: 0 16px;
        background: none;
        border: 0;
        box-shadow: none;
        color: #FFFFFF;
        font-family: var(--font);
        font-size: 0.875rem;
        font-weight: 600;
        line-height: 1.6;
        text-align: center;
        text-decoration: none;
        text-shadow: 0 1px 1px rgba(15, 23, 42, 0.35);
    }

    .agri1-sysmsg {
        position: fixed;
        top: var(--space-2);
        right: var(--space-2);
        z-index: 999999;
        display: flex;
        flex-direction: column;
        gap: var(--space-1);
        width: min(520px, calc(100% - 32px));
        font-family: var(--font);
        font-size: 16px;
        line-height: 1.6;
    }

    .agri1-sysmsg-item {
        display: none;
        align-items: flex-start;
        gap: 12px;
        padding: var(--space-2);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        background: var(--color-card);
    }

    .agri1-sysmsg-item.is-visible {
        display: flex;
    }

    .agri1-sysmsg-item.is-emergency {
        background: var(--color-warning-bg);
        border: 1px solid #FECACA;
        color: #991B1B;
    }

    .agri1-sysmsg-item.is-info {
        background: #EFF6FF;
        border: 1px solid #BFDBFE;
        color: #1D4ED8;
    }

    .agri1-sysmsg .agri1-icon {
        flex: 0 0 auto;
        width: 24px;
        height: 24px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .agri1-sysmsg-body {
        flex: 1;
        min-width: 0;
    }

    .agri1-sysmsg-title {
        margin: 0 0 4px;
        font-size: 1rem;
        font-weight: 700;
    }

    .agri1-sysmsg-text {
        margin: 0;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .agri1-sysmsg-text p {
        margin: 0 0 4px;
    }

    .agri1-sysmsg-item.is-emergency a {
        color: #991B1B;
        font-weight: 700;
        text-decoration: underline;
    }

    .agri1-sysmsg-item.is-info a {
        color: #1D4ED8;
        font-weight: 700;
        text-decoration: underline;
    }

    .agri1-sysmsg-dismiss {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: var(--touch);
        height: var(--touch);
        margin: -8px 0 -8px -8px;
        padding: 0;
        border: 1px solid transparent;
        border-radius: 12px;
        background: transparent;
        color: inherit;
        cursor: pointer;
        touch-action: manipulation;
    }

    .agri1-sysmsg-item.is-emergency .agri1-sysmsg-dismiss:hover {
        background: #FEE2E2;
        border-color: #FECACA;
    }

    .agri1-sysmsg-item.is-info .agri1-sysmsg-dismiss:hover {
        background: #DBEAFE;
        border-color: #BFDBFE;
    }

    .agri1-sysmsg-dismiss:focus-visible {
        outline: 3px solid var(--color-ring);
        outline-offset: 2px;
    }

    @media (max-width: 640px) {
        .agri1-sysmsg {
            right: var(--space-2);
            left: var(--space-2);
            width: auto;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .agri1-sysmsg-dismiss {
            transition: none;
        }
    }
</style>

<p class="agri1-footer-copy MenuItemRight">کلیه حقوق مادی و معنوی این سامانه متعلق به مرکز فناوری اطلاعات و ارتباطات وزارت جهاد کشاورزی می باشد</p>
<?php if (!empty($messages)) { ?>
<div class="agri1-sysmsg" dir="rtl" lang="fa" role="region" aria-label="پیام‌های سامانه">
    <?php
    $message_index = 0;
    foreach ($messages as $msg) {
        $storageKey = !empty($msg['message_key']) ? $msg['message_key'] : 'msg_' . $msg['id'];
        $storageKey = $storageKey . '_' . $msg['id'];
        $elementId = 'msg_' . $msg['id'];
        $is_emergency = (isset($msg['message_type']) && strtolower($msg['message_type']) === 'emergency');
        $kind_class = $is_emergency ? 'is-emergency' : 'is-info';
        $label = $is_emergency ? 'پیام اضطراری' : 'اطلاعیه';
        $message_text_html = nl2br(agri1_footer_h($msg['message_text']));
        ?>
    <div id="<?php echo agri1_footer_h($elementId); ?>"
         class="agri1-sysmsg-item <?php echo $kind_class; ?>"
         data-msg-index="<?php echo (int) $message_index; ?>"
         role="status">
        <?php if ($is_emergency) { ?>
        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 9v4"></path>
            <path d="M12 17h.01"></path>
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
        </svg>
        <?php } else { ?>
        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M12 16v-4"></path>
            <path d="M12 8h.01"></path>
        </svg>
        <?php } ?>
        <div class="agri1-sysmsg-body">
            <p class="agri1-sysmsg-title"><?php echo agri1_footer_h($label); ?></p>
            <div class="agri1-sysmsg-text"><?php echo $message_text_html; ?></div>
        </div>
        <button type="button"
                class="agri1-sysmsg-dismiss delete-btn"
                title="حذف دائمی پیام (دیگر نمایش داده نخواهد شد)"
                aria-label="حذف دائمی پیام (دیگر نمایش داده نخواهد شد)"
                data-msg-id="<?php echo agri1_footer_h($elementId); ?>"
                data-storage-key="<?php echo agri1_footer_h($storageKey); ?>">
            <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M18 6L6 18"></path>
                <path d="M6 6l12 12"></path>
            </svg>
        </button>
    </div>
        <?php
        $message_index++;
    }
    ?>
</div>
<?php } ?>

<script>
    function initMessages() {
        function checkMessageStatus(elementId, storageKey) {
            var messageBox = document.getElementById(elementId);
            if (messageBox && localStorage.getItem(storageKey) !== 'true') {
                if ((' ' + messageBox.className + ' ').indexOf(' is-visible ') === -1) {
                    messageBox.className += ' is-visible';
                }
            }
        }

        function permanentlyHide(elementId, storageKey) {
            var messageBox = document.getElementById(elementId);
            if (messageBox) {
                messageBox.className = messageBox.className.replace(/\bis-visible\b/g, '').replace(/\s+/g, ' ');
            }
            try {
                localStorage.setItem(storageKey, 'true');
            } catch (e) {}
        }

        var messagesData = <?php echo json_encode($js_messages_data); ?>;
        var i;

        for (i = 0; i < messagesData.length; i++) {
            checkMessageStatus(messagesData[i].id, messagesData[i].key);
        }

        var container = document.querySelector('.agri1-sysmsg');
        if (container && container.getAttribute('data-agri1-bound') !== '1') {
            container.setAttribute('data-agri1-bound', '1');
            container.addEventListener('click', function (e) {
                var btn = e.target.closest ? e.target.closest('.delete-btn') : null;
                if (btn) {
                    var msgId = btn.getAttribute('data-msg-id');
                    var storageKey = btn.getAttribute('data-storage-key');
                    if (msgId && storageKey) {
                        permanentlyHide(msgId, storageKey);
                    }
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMessages);
    } else {
        initMessages();
    }
</script>
