<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event_new.php');
include('../cod_m.php');
include('../../date_con.php');
require_once('../../Jalali.php');

date_default_timezone_set('Asia/Tehran');

function agri_clean_code($v)
{
    if (!isset($v)) return '';
    $v = trim($v);
    if ($v == '/' || $v == '\\') return '';
    return $v;
}

function agri_h($v)
{
    return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
}

function agri_load_place($dbh, $m_poul, $add_abadi, $add_city)
{
    $out = array(
        'ok' => false,
        'add_abadi' => $add_abadi,
        'add_city' => $add_city,
        'id_ostan' => '',
        'id_city' => '',
        'id_mar' => ''
    );
    if ($m_poul == 'abadi' && $add_abadi != '' && $add_abadi != '-') {
        $query = "SELECT id_ostan,id_city,id_mar,add_abadi from list_abadi where add_abadi = :add_abadi";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_abadi' => $add_abadi));
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $out['ok'] = true;
            $out['add_abadi'] = $row['add_abadi'];
            $out['add_city'] = '-';
            $out['id_ostan'] = $row['id_ostan'];
            $out['id_city'] = $row['id_city'];
            $out['id_mar'] = $row['id_mar'];
        }
    } elseif ($m_poul == 'shahr' && $add_city != '' && $add_city != '-') {
        $query = "SELECT id_ostan,id_city,id_mar,add_city from list_city where add_city = :add_city";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_city' => $add_city));
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $out['ok'] = true;
            $out['add_city'] = $row['add_city'];
            $out['add_abadi'] = '-';
            $out['id_ostan'] = $row['id_ostan'];
            $out['id_city'] = $row['id_city'];
            $out['id_mar'] = $row['id_mar'];
        }
    }
    return $out;
}

function agri_fix_num_bah($dbh, $bah_cod_m, $num_bah)
{
    $num_bah = agri_clean_code($num_bah);
    if ($num_bah != '' && is_numeric($num_bah)) {
        return $num_bah;
    }
    $query = "SELECT num_bah from bah where bah_cod_m = :bah_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($row['num_bah']) && agri_clean_code($row['num_bah']) != '' && is_numeric($row['num_bah'])) {
            return $row['num_bah'];
        }
    }
    return '1';
}

function agri_form_css()
{
?>
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

        .agri1-steps {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-1);
            list-style: none;
            margin: 0 0 var(--space-3);
            padding: 0;
        }

        .agri1-steps li {
            display: flex;
            align-items: center;
            gap: 8px;
            min-height: var(--touch);
            padding: 0 14px;
            border-radius: 999px;
            background: var(--color-muted);
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }

        .agri1-steps li.is-current {
            background: var(--color-primary);
            color: var(--color-on-primary);
        }

        .agri1-steps li.is-link {
            padding: 0;
            background: transparent;
        }

        .agri1-step-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            min-height: var(--touch);
            padding: 0 14px;
            border: 0;
            border-radius: 999px;
            background: var(--color-muted);
            color: var(--color-foreground);
            cursor: pointer;
            font: inherit;
            font-size: 0.875rem;
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        .agri1-step-btn:hover { background: #DCFCE7; }
        .agri1-step-btn:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-step-btn .agri1-step-num {
            background: var(--color-primary);
            color: var(--color-on-primary);
        }

        .agri1-step-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            font-size: 0.75rem;
            font-weight: 700;
        }

        .agri1-card {
            background: var(--color-card);
            color: var(--color-card-foreground);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: var(--space-3);
        }

        .agri1-alert {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: var(--space-3);
            padding: var(--space-2);
            border-radius: var(--radius);
            border: 1px solid #FECACA;
            background: var(--color-warning-bg);
            color: #991B1B;
        }
        .agri1-alert:focus { outline: 3px solid var(--color-ring); outline-offset: 2px; }
        .agri1-alert h2 { margin: 0 0 8px; font-size: 1rem; }
        .agri1-alert ul { margin: 0; padding: 0 18px 0 0; }
        .agri1-alert a { color: #991B1B; text-decoration: underline; }
        .agri1-alert ul:empty { display: none; }

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

        .agri1-fieldset { margin: 0 0 var(--space-3); padding: 0; border: 0; }

        .agri1-legend {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            margin-bottom: 10px;
            color: var(--color-foreground);
            font-size: 1rem;
            font-weight: 700;
        }

        .agri1-hint {
            margin: 0 0 12px;
            color: var(--color-muted-foreground);
            font-size: 0.875rem;
        }

        .agri1-choices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .agri1-choice {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 52px;
            padding: 12px 14px;
            border: 2px solid var(--color-border);
            border-radius: var(--radius);
            background: var(--color-card);
            cursor: pointer;
            transition: border-color var(--duration) ease, background-color var(--duration) ease, box-shadow var(--duration) ease;
        }

        .agri1-choice:hover {
            border-color: var(--color-primary);
            background: #F7FEF9;
        }

        .agri1-choice:has(input:checked),
        .agri1-choice.is-selected {
            border-color: var(--color-primary);
            background: #ECFDF3;
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.16);
        }

        .agri1-choice:focus-within {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }

        .agri1-choice input {
            position: absolute;
            opacity: 0;
            width: 1px;
            height: 1px;
        }

        .agri1-choice-mark {
            width: 20px;
            height: 20px;
            border: 2px solid var(--color-primary);
            border-radius: 50%;
            flex-shrink: 0;
            position: relative;
        }

        .agri1-choice:has(input:checked) .agri1-choice-mark::after,
        .agri1-choice.is-selected .agri1-choice-mark::after {
            content: "";
            position: absolute;
            inset: 3px;
            border-radius: 50%;
            background: var(--color-primary);
        }

        .agri1-field { margin-top: 12px; }

        .agri1-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            color: var(--color-foreground);
        }

        .agri1-page .agri1-form input[type="text"],
        .agri1-page .agri1-form select {
            width: 100%;
            min-height: var(--touch);
            padding: 10px 12px;
            border: 1px solid #64748B;
            border-radius: 10px;
            background: var(--color-card);
            color: var(--color-foreground);
            font-size: 16px;
            box-shadow: none;
            transition: border-color var(--duration) ease, box-shadow var(--duration) ease;
        }

        .agri1-page .agri1-form #bah_cod_m,
        .agri1-page .agri1-form #m_cod_m {
            text-align: center;
            letter-spacing: 0.08em;
        }

        .agri1-page .agri1-form input[type="text"]:hover,
        .agri1-page .agri1-form select:hover {
            background: var(--color-card);
            color: var(--color-foreground);
        }

        .agri1-page .agri1-form input[type="text"]:focus,
        .agri1-page .agri1-form select:focus {
            border-color: var(--color-ring);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.25);
            outline: none;
        }

        .agri1-page .agri1-form input[aria-invalid="true"],
        .agri1-page .agri1-form select[aria-invalid="true"],
        .agri1-fieldset.is-invalid .agri1-choices {
            border-color: var(--color-destructive);
        }

        .agri1-combo { position: relative; }

        .agri1-page .agri1-form .agri1-combo input[type="text"] {
            padding-left: 44px;
        }

        .agri1-combo-toggle {
            position: absolute;
            left: 4px;
            top: 50%;
            transform: translateY(-50%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: var(--touch);
            height: var(--touch);
            border: 0;
            background: transparent;
            color: var(--color-foreground);
            cursor: pointer;
            border-radius: 8px;
        }
        .agri1-combo-toggle:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }

        .agri1-combo-list {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            right: 0;
            left: 0;
            z-index: 20;
            max-height: 240px;
            overflow-y: auto;
            margin: 0;
            padding: 6px 0;
            list-style: none;
            background: var(--color-card);
            border: 1px solid var(--color-border);
            border-radius: 10px;
            box-shadow: var(--shadow);
        }
        .agri1-combo-list.is-open { display: block; }

        .agri1-combo-option {
            min-height: var(--touch);
            padding: 10px 14px;
            cursor: pointer;
            color: var(--color-foreground);
        }
        .agri1-combo-option:hover,
        .agri1-combo-option.is-active {
            background: #ECFDF3;
        }
        .agri1-combo-empty {
            padding: 12px 14px;
            color: var(--color-muted-foreground);
        }

        .agri1-error {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 8px 0 0;
            color: var(--color-destructive);
            font-size: 0.875rem;
        }

        .is-hidden { display: none !important; }

        .agri1-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: var(--space-2);
        }

        .agri1-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: var(--touch);
            min-width: var(--touch);
            padding: 10px 20px;
            border: 0;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            touch-action: manipulation;
            transition: background-color var(--duration) ease, transform var(--duration) ease, box-shadow var(--duration) ease, opacity var(--duration) ease;
        }
        .agri1-btn:focus-visible {
            outline: 3px solid var(--color-ring);
            outline-offset: 2px;
        }
        .agri1-btn:active { transform: translateY(1px); }
        .agri1-btn[aria-busy="true"] { opacity: 0.85; }

        .agri1-btn-primary {
            background: var(--color-primary);
            color: var(--color-on-primary);
            box-shadow: 0 4px 12px rgba(21, 128, 61, 0.25);
        }
        .agri1-btn-primary:hover { background: var(--color-secondary); }

        .agri1-btn-accent {
            background: var(--color-accent);
            color: var(--color-on-accent);
        }
        .agri1-btn-accent:hover { background: #854D0E; }

        .agri1-btn-ghost {
            background: transparent;
            color: var(--color-foreground);
            border: 1px solid var(--color-border);
        }
        .agri1-btn-ghost:hover { background: var(--color-muted); }

        .agri1-back { margin-top: var(--space-3); }

        .agri1-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 80;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, 0.55);
        }
        .agri1-overlay.is-open { display: flex !important; }

        .agri1-overlay-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            min-width: 220px;
            padding: 24px;
            border-radius: 16px;
            background: var(--color-card);
            color: var(--color-foreground);
        }

        .agri1-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--color-border);
            border-top-color: var(--color-primary);
            border-radius: 50%;
            animation: agri1-spin 0.8s linear infinite;
        }

        @keyframes agri1-spin { to { transform: rotate(360deg); } }

        .agri1-info {
            min-height: var(--touch);
            padding: 10px 12px;
            border-radius: 10px;
            background: var(--color-muted);
            color: var(--color-foreground);
        }
        .agri1-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .agri1-note {
            margin-bottom: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1D4ED8;
        }
        .agri1-page .agri1-form input.agri-lock,
        .agri1-page .agri1-form input[readonly] {
            background: #FFFBEB;
        }
        .agri1-card-title {
            margin: 0 0 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--color-border);
            font-size: 1rem;
        }
        @media (max-width: 640px) {
            .agri1-grid { grid-template-columns: 1fr; }
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
<?php
}

function agri_goto_liste($id_page, $com_alert)
{
    ?>
    <form name="myform" class="myform" method="post" action="liste_Agri.php?id=<?php echo agri_h($id_page); ?>#1">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="action_lise" value="1" />
        <input type="hidden" name="back_p" value="1" />
        <?php if ($com_alert != '') { ?>
        <input type="hidden" name="com_alert" value="<?php echo agri_h($com_alert); ?>" />
        <?php } ?>
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
    exit;
}

$slash_keys = array('add_abadi', 'add_city', 'num_bah', 'id_city', 'id_mar', 'id_ostan', 'm_poul');
foreach ($slash_keys as $k) {
    if (isset($_POST[$k])) {
        $_POST[$k] = agri_clean_code($_POST[$k]);
    }
}

$mess = '';
$field_errors = array();
$place_err = '';
$show_step2 = false;
$place_ok = false;
$v_co_name = '';
$co_name = '';
$no_bah = '1';
$m_cod_m = $m_last_name = $m_name = $m_tel_m = $m_fname = $m_jens = '';
$id_ostan = $id_city = $id_mar = '';

$id = isset($_POST['id']) ? $_POST['id'] : '';
$id_page = (isset($_POST['id_page']) && $_POST['id_page'] > 1) ? (int)$_POST['id_page'] : 1;
$m_poul = isset($_POST['m_poul']) ? agri_clean_code($_POST['m_poul']) : '';
$no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$num_bah = isset($_POST['num_bah']) ? $_POST['num_bah'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$z_sal_old = isset($_POST['z_sal_old']) ? $_POST['z_sal_old'] : $z_sal;
$add_abadi = isset($_POST['add_abadi']) ? agri_clean_code($_POST['add_abadi']) : '';
$add_city = isset($_POST['add_city']) ? agri_clean_code($_POST['add_city']) : '';
$sh_gat = isset($_POST['sh_gat']) ? $_POST['sh_gat'] : '';
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$t_mah = isset($_POST['t_mah']) ? $_POST['t_mah'] : '';
$check_cod = isset($_POST['check_cod']) ? $_POST['check_cod'] : 0;

if ($m_poul == '') {
    if ($add_abadi != '' && $add_abadi != '-') $m_poul = 'abadi';
    elseif ($add_city != '' && $add_city != '-') $m_poul = 'shahr';
}

$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

if (isset($_POST['cancel'])) {
    agri_goto_liste($id_page, '');
}

$query = "SELECT ok from bah where bah_cod_m = :bah_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m' => $bah_cod_m));
$found = $stmt->rowCount();
$row_ok = $stmt->fetch(PDO::FETCH_ASSOC);
$ok = ($row_ok && isset($row_ok['ok'])) ? $row_ok['ok'] : '';

if ($bah_cod_m != '' && $ok == '2') {
    alert('بهره بردار در قید حیات نمیباشد !! امکان ویرایش اطلاعات مقدور نیست  ');
    ?>
    <form name="myform" class="myform" method="post" action="index.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
    exit;
}
if ($bah_cod_m != '' && $ok == '4') {
    alert('اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ویرایش اطلاعات مقدور نمیباشد  ');
    ?>
    <form name="myform" class="myform" method="post" action="index.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
    exit;
}

$force_step1 = (isset($_POST['agri_step']) && $_POST['agri_step'] == '1');
$is_save = (!$force_step1 && isset($_POST['action']) && isset($_POST['m_zamin']));
$is_continue = (!$force_step1 && isset($_POST['action']) && !isset($_POST['m_zamin']));
$from_step2_entry = (!$force_step1 && isset($_POST['agri_edit_step']) && $_POST['agri_edit_step'] == '2');

if ($is_save) {
    try {
        $dbh->beginTransaction();

        $date_s = $date_edit;
        $mor_cod_m = $login_session;
        $bah_cod_m = $_POST['bah_cod_m'];
        $num_bah = agri_fix_num_bah($dbh, $bah_cod_m, isset($_POST['num_bah']) ? $_POST['num_bah'] : '');
        $add_city = agri_clean_code($_POST['add_city']);
        $add_abadi = agri_clean_code($_POST['add_abadi']);
        $m_poul = isset($_POST['m_poul']) ? agri_clean_code($_POST['m_poul']) : $m_poul;
        if ($m_poul == '') {
            if ($add_abadi != '' && $add_abadi != '-') $m_poul = 'abadi';
            elseif ($add_city != '' && $add_city != '-') $m_poul = 'shahr';
        }

        $place = agri_load_place($dbh, $m_poul, $add_abadi, $add_city);
        if (!$place['ok']) {
            throw new Exception('موقعیت بهره برداری نامعتبر است. آبادی/شهر را دوباره انتخاب کنید.');
        }
        $add_abadi = $place['add_abadi'];
        $add_city = $place['add_city'];
        $id_ostan = $place['id_ostan'];
        $id_city = $place['id_city'];
        $id_mar = $place['id_mar'];

        $m_zamin = $_POST['m_zamin'];
        $no_mal = $_POST['no_mal'];
        $lng = $_POST['lng'];
        $lat = $_POST['lat'];
        if ($lng > 99) $lng = 0;
        if ($lat > 99) $lat = 0;
        $sh_gat = isset($_POST['sh_gat']) ? $_POST['sh_gat'] : '';
        $m_cod_m = $_POST['m_cod_m'];
        if ($no_mal !== '7') {
            $m_cod_m = $bah_cod_m;
        }
        $m_vaz_sok = $_POST['m_vaz_sok'];
        $no_kesh = $_POST['no_kesh'];
        $z_sal = $_POST['z_sal'];
        $s_ayesh = $_POST['s_ayesh'];
        $id = $_POST['id'];

        if (!preg_match('/^[a-zA-Z0-9\-_]+$/', $z_sal)) {
            throw new Exception('سال زراعی نامعتبر است.');
        }

        $Agri_table = 'Agri' . str_replace('-', '_', $z_sal);
        $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

        if ($no_kesh == '1') {
            $m_ab = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
            $md_ab = isset($_POST['md_ab']) ? $_POST['md_ab'] : '';
            $h_ab = isset($_POST['h_ab']) ? $_POST['h_ab'] : '';
            $no_sab = isset($_POST['no_sab']) ? $_POST['no_sab'] : '';
            $no_ab = isset($_POST['no_ab']) ? $_POST['no_ab'] : '';
            $es = isset($_POST['es']) ? $_POST['es'] : '';
        } else {
            $m_ab = '';
            $md_ab = 0;
            $h_ab = 0;
            $no_sab = '';
            $no_ab = '';
            $es = '';
        }

        $m_jens = isset($_POST['m_jens']) ? $_POST['m_jens'] : '';
        $m_name = isset($_POST['m_name']) ? $_POST['m_name'] : '';
        $m_last_name = isset($_POST['m_last_name']) ? $_POST['m_last_name'] : '';
        $m_fname = isset($_POST['m_fname']) ? $_POST['m_fname'] : '';
        $m_tel_m = isset($_POST['m_tel_m']) ? $_POST['m_tel_m'] : '';

        $query1 = "UPDATE `$Agri_prod_table` SET date_s=?, z_sal=?, num_bah=?, add_abadi=?, add_city=?, no_kesh=? WHERE bah_cod_m=? AND Agri_id=?";
        $q1 = $dbh->prepare($query1);
        $q1->execute(array($date_s, $z_sal, $num_bah, $add_abadi, $add_city, $no_kesh, $bah_cod_m, $id));

        $query2 = "UPDATE `$Agri_table` SET
                   date_s=?, num_bah=?, add_abadi=?, add_city=?, id_ostan=?, id_city=?, id_mar=?, m_zamin=?, no_mal=?, lng=?, lat=?, m_cod_m=?,
                   m_vaz_sok=?, no_kesh=?, m_ab=?, md_ab=?, h_ab=?, no_sab=?, no_ab=?, es=?, z_sal=?, s_ayesh=?
                   WHERE bah_cod_m=? AND id=?";
        $q2 = $dbh->prepare($query2);
        $q2->execute(array(
            $date_s, $num_bah, $add_abadi, $add_city, $id_ostan, $id_city, $id_mar, $m_zamin, $no_mal, $lng, $lat, $m_cod_m,
            $m_vaz_sok, $no_kesh, $m_ab, $md_ab, $h_ab, $no_sab, $no_ab, $es, $z_sal, $s_ayesh,
            $bah_cod_m, $id
        ));

        $query3 = "INSERT IGNORE INTO malek (date_s, mor_cod_m, m_cod_m, m_jens, m_name, m_last_name, m_fname, m_tel_m)
                   VALUES (:date_s, :mor_cod_m, :m_cod_m, :m_jens, :m_name, :m_last_name, :m_fname, :m_tel_m)";
        $q3 = $dbh->prepare($query3);
        $q3->execute(array(
            ':date_s' => $date_s,
            ':mor_cod_m' => $mor_cod_m,
            ':m_cod_m' => $m_cod_m,
            ':m_jens' => $m_jens,
            ':m_name' => $m_name,
            ':m_last_name' => $m_last_name,
            ':m_fname' => $m_fname,
            ':m_tel_m' => $m_tel_m
        ));

        sabt_event($login_session, getUserIP_1(), $date_edit, $time, $add_abadi, 'تصحیح زمین زراعی/' . $sh_gat . '/' . $bah_cod_m, $id_ostan);
        $dbh->commit();
        agri_goto_liste($id_page, 'اطلاعات زمین زراعی با موفقیت تصحیح شد');
    } catch (Exception $e) {
        $dbh->rollBack();
        $place_err = 'خطا در ثبت اطلاعات: ' . $e->getMessage();
        $show_step2 = true;
    }
}

if ($is_continue) {
    $m_poul = isset($_POST['m_poul']) ? agri_clean_code($_POST['m_poul']) : '';
    if ($m_poul == '') {
        $mess = 'موقعیت بهره برداری را تعیین کنید ';
        $field_errors['m_poul'] = 'موقعیت بهره برداری را تعیین کنید';
    }
    $add_city = isset($_POST['add_city']) ? agri_clean_code($_POST['add_city']) : '';
    if ($m_poul == 'shahr' && $add_city == '') {
        $mess .= 'نام شهر را انتخاب کنید';
        $field_errors['add_city'] = 'نام شهر را انتخاب کنید';
    }
    $add_abadi = isset($_POST['add_abadi']) ? agri_clean_code($_POST['add_abadi']) : '';
    if ($m_poul == 'abadi' && $add_abadi == '') {
        $mess .= 'نام آبادی را انتخاب کنید';
        $field_errors['add_abadi'] = 'نام آبادی را انتخاب کنید';
    }
    $bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
    if ($bah_cod_m == '') {
        $mess .= 'کد ملی را وارد کنید';
        $field_errors['bah_cod_m'] = 'کد ملی را وارد کنید';
    }
    $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
    if ($no_kesh == '') {
        $mess .= 'نوع کشت را انتخاب کنید';
        $field_errors['no_kesh'] = 'نوع کشت را انتخاب کنید';
    }
    $no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
    if ($no_mal == '') {
        $mess .= 'نوع مالکیت را انتخاب کنید';
        $field_errors['no_mal'] = 'نوع مالکیت را انتخاب کنید';
    }
    if ($bah_cod_m != '' && check_code_melli($bah_cod_m) != 1) {
        $mess .= 'کد ملی بهره بردار صحیح نیست';
        $field_errors['bah_cod_m'] = 'کد ملی بهره بردار صحیح نیست';
    }

    if ($mess == '') {
        if ($found > 1) {
            ?>
            <form name="myform1" class="myform" method="post" id="myCoolForm" action="bahEdit_history.php">
                <input type="hidden" name="bah_cod_m" value="<?php echo agri_h($bah_cod_m); ?>" />
                <input type="hidden" name="m_poul" value="<?php echo agri_h($m_poul); ?>" />
                <input type="hidden" name="add_city" value="<?php echo agri_h($add_city); ?>" />
                <input type="hidden" name="add_abadi" value="<?php echo agri_h($add_abadi); ?>" />
                <input type="hidden" name="no_kesh" value="<?php echo agri_h($no_kesh); ?>" />
                <input type="hidden" name="no_mal" value="<?php echo agri_h($no_mal); ?>" />
                <input type="hidden" name="sh_gat" value="<?php echo agri_h($sh_gat); ?>" />
                <input type="hidden" name="z_sal" value="<?php echo agri_h($z_sal); ?>" />
                <input type="hidden" name="id" value="<?php echo agri_h($id); ?>" />
                <input type="hidden" name="id_page" value="<?php echo agri_h($id_page); ?>" />
                <input type="hidden" name="t_mah" value="<?php echo agri_h($t_mah); ?>" />
            </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
            exit;
        }
        $show_step2 = true;
    }
}

if ($from_step2_entry && !$is_save && !$is_continue) {
    $show_step2 = true;
}

if ($show_step2) {
    if (!preg_match('/^[a-zA-Z0-9\-_]+$/', $z_sal)) {
        die('خطای امنیتی در سال زراعی');
    }
    $Agri_table = 'Agri' . str_replace('-', '_', $z_sal);
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

    $error = 0;
    $current_no_kesh_db = '';
    $query_check = "SELECT id, no_kesh FROM `$Agri_prod_table` WHERE Agri_id = :id";
    $stmt_check = $dbh->prepare($query_check);
    $stmt_check->execute(array(':id' => $id));
    $rows_prod = $stmt_check->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows_prod as $row_p) {
        $prod_id = $row_p['id'];
        $current_no_kesh_db = $row_p['no_kesh'];
        if (check_id($prod_id) == 2) {
            $error = 1;
        }
    }
    if ($error == 1 && $current_no_kesh_db != $no_kesh) {
        agri_goto_liste($id_page, 'حداقل یکی از محصولات این قطعه شامل کشت قراردادی میباشد، تغییر نوع کشت مقدور نیست');
    }

    $query = "SELECT * FROM `$Agri_table` WHERE id = :id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id' => $id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        die('اطلاعات زمین یافت نشد.');
    }

    $lng = isset($_POST['lng']) ? $_POST['lng'] : $row['lng'];
    $lat = isset($_POST['lat']) ? $_POST['lat'] : $row['lat'];
    $m_zamin = isset($_POST['m_zamin']) ? $_POST['m_zamin'] : $row['m_zamin'];
    $m_cod_m = $row['m_cod_m'];
    $m_ab = isset($_POST['m_ab']) ? $_POST['m_ab'] : $row['m_ab'];
    $md_ab = isset($_POST['md_ab']) ? $_POST['md_ab'] : $row['md_ab'];
    $h_ab = isset($_POST['h_ab']) ? $_POST['h_ab'] : $row['h_ab'];
    $no_sab = isset($_POST['no_sab']) ? $_POST['no_sab'] : $row['no_sab'];
    $no_ab = isset($_POST['no_ab']) ? $_POST['no_ab'] : $row['no_ab'];
    $es = isset($_POST['es']) ? $_POST['es'] : $row['es'];
    $s_ayesh = isset($_POST['s_ayesh']) ? $_POST['s_ayesh'] : $row['s_ayesh'];
    $m_vaz_sok = isset($_POST['m_vaz_sok']) ? $_POST['m_vaz_sok'] : $row['m_vaz_sok'];
    $check_cod = $row['check_cod'];
    $num_bah = agri_fix_num_bah($dbh, $bah_cod_m, $row['num_bah']);

    if ($no_mal != 7) {
        $query = "SELECT no_bah, co_name, name, jens, last_name, fname, tel_m FROM bah WHERE bah_cod_m = :bah_cod_m AND num_bah = :num_bah";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':num_bah' => $num_bah));
        $row_b = $stmt->fetch(PDO::FETCH_ASSOC);
        $no_bah = isset($row_b['no_bah']) ? $row_b['no_bah'] : '';
        $co_name = isset($row_b['co_name']) ? $row_b['co_name'] : '';
        $m_name = isset($row_b['name']) ? $row_b['name'] : '';
        $m_jens = isset($row_b['jens']) ? $row_b['jens'] : '';
        $m_last_name = isset($row_b['last_name']) ? $row_b['last_name'] : '';
        $m_fname = isset($row_b['fname']) ? $row_b['fname'] : '';
        $m_tel_m = isset($row_b['tel_m']) ? $row_b['tel_m'] : '';
        if ($no_bah == '2') {
            $v_co_name = '/ شرکت ' . $co_name . ' /';
        }
    } else {
        $query = "SELECT no_bah FROM bah WHERE bah_cod_m = :bah_cod_m AND num_bah = :num_bah";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':num_bah' => $num_bah));
        $row_b = $stmt->fetch(PDO::FETCH_ASSOC);
        $no_bah = isset($row_b['no_bah']) ? $row_b['no_bah'] : '';

        $query = "SELECT m_name, m_jens, m_last_name, m_fname, m_tel_m FROM malek WHERE m_cod_m = :m_cod_m";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':m_cod_m' => $m_cod_m));
        $row_m = $stmt->fetch(PDO::FETCH_ASSOC);
        $m_name = isset($row_m['m_name']) ? $row_m['m_name'] : '';
        $m_jens = isset($row_m['m_jens']) ? $row_m['m_jens'] : '';
        $m_last_name = isset($row_m['m_last_name']) ? $row_m['m_last_name'] : '';
        $m_fname = isset($row_m['m_fname']) ? $row_m['m_fname'] : '';
        $m_tel_m = isset($row_m['m_tel_m']) ? $row_m['m_tel_m'] : '';
        if (isset($_POST['m_cod_m'])) $m_cod_m = $_POST['m_cod_m'];
        if (isset($_POST['m_name'])) $m_name = $_POST['m_name'];
        if (isset($_POST['m_jens'])) $m_jens = $_POST['m_jens'];
        if (isset($_POST['m_last_name'])) $m_last_name = $_POST['m_last_name'];
        if (isset($_POST['m_fname'])) $m_fname = $_POST['m_fname'];
        if (isset($_POST['m_tel_m'])) $m_tel_m = $_POST['m_tel_m'];
    }

    $v_no_kesh = ($no_kesh == '1') ? 'آبی' : (($no_kesh == '2') ? 'دیم' : '');
    if ($no_mal != '7') $m_cod_m = $bah_cod_m;
    $malek_types = array(
        '1' => 'سند ششدانگ', '2' => 'سند مشاعی', '3' => 'اصلاحات اراضی',
        '4' => 'موقوفه', '5' => 'واگذاری', '6' => 'قولنامه', '7' => 'اجاره', '8' => 'سایر'
    );
    $v_no_mal = isset($malek_types[$no_mal]) ? $malek_types[$no_mal] : '';

    $query = "SELECT sum(zer_kesht_a) as z_kesht1, sum(zer_kesht_b) as z_kesht2 FROM `$Agri_prod_table` WHERE Agri_id = :Agri_id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':Agri_id' => $id));
    $row_sum = $stmt->fetch(PDO::FETCH_ASSOC);
    $z_kesht1 = isset($row_sum['z_kesht1']) ? $row_sum['z_kesht1'] : 0;
    $z_kesht2 = isset($row_sum['z_kesht2']) ? $row_sum['z_kesht2'] : 0;
    if ($z_kesht1 == '') $z_kesht1 = 0;
    if ($z_kesht2 == '') $z_kesht2 = 0;

    $place = agri_load_place($dbh, $m_poul, $add_abadi, $add_city);
    $place_ok = $place['ok'];
    if ($place_ok) {
        $add_abadi = $place['add_abadi'];
        $add_city = $place['add_city'];
        $id_ostan = $place['id_ostan'];
        $id_city = $place['id_city'];
        $id_mar = $place['id_mar'];
    } else {
        if ($place_err == '') $place_err = 'موقعیت بهره برداری یافت نشد. آبادی/شهر را از مرحله قبل دوباره انتخاب کنید.';
    }

    $agri_ro = ($no_mal <> 7) ? ' readonly="readonly"' : '';
    $agri_ro_class = ($no_mal <> 7) ? ' agri-lock' : '';
    $has_step2_errors = ($place_err != '');
    $back_city = ($add_city == '-') ? '' : $add_city;
    $back_abadi = ($add_abadi == '-') ? '' : $add_abadi;
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo isset($title) ? agri_h($title) : ''; ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <?php agri_form_css(); ?>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#form1">رفتن به فرم ویرایش</a>

    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>

    <?php include(__DIR__ . '/../../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri-edit-title">ویرایش اطلاعات زمین زراعی</h1>
            <ol class="agri1-steps" aria-label="مراحل ویرایش">
                <li class="is-link">
                    <button type="submit" class="agri1-step-btn" form="agri-edit-back">
                        <span class="agri1-step-num" aria-hidden="true">1</span> مشخصات اولیه
                    </button>
                </li>
                <li class="is-current" aria-current="step"><span class="agri1-step-num" aria-hidden="true">2</span> اطلاعات قطعه</li>
            </ol>
        </header>

        <section class="agri1-card" aria-labelledby="agri-edit-title">
            <form id="agri-edit-back" method="post" action="Agri_edit.php" class="is-hidden" aria-hidden="true">
                <input type="hidden" name="agri_step" value="1"/>
                <input type="hidden" name="m_poul" value="<?php echo agri_h($m_poul); ?>"/>
                <input type="hidden" name="add_city" value="<?php echo agri_h($back_city); ?>"/>
                <input type="hidden" name="add_abadi" value="<?php echo agri_h($back_abadi); ?>"/>
                <input type="hidden" name="bah_cod_m" value="<?php echo agri_h($bah_cod_m); ?>"/>
                <input type="hidden" name="no_kesh" value="<?php echo agri_h($no_kesh); ?>"/>
                <input type="hidden" name="no_mal" value="<?php echo agri_h($no_mal); ?>"/>
                <input type="hidden" name="num_bah" value="<?php echo agri_h($num_bah); ?>"/>
                <input type="hidden" name="id" value="<?php echo agri_h($id); ?>"/>
                <input type="hidden" name="z_sal" value="<?php echo agri_h($z_sal); ?>"/>
                <input type="hidden" name="z_sal_old" value="<?php echo agri_h($z_sal_old); ?>"/>
                <input type="hidden" name="sh_gat" value="<?php echo agri_h($sh_gat); ?>"/>
                <input type="hidden" name="id_page" value="<?php echo agri_h($id_page); ?>"/>
                <input type="hidden" name="t_mah" value="<?php echo agri_h($t_mah); ?>"/>
            </form>

            <div class="agri1-alert<?php echo $has_step2_errors ? '' : ' is-hidden'; ?>" id="agri2-error-summary" role="alert" tabindex="-1" aria-labelledby="agri2-error-title" <?php if (!$has_step2_errors) echo 'hidden'; ?>>
                <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 9v4"></path>
                    <path d="M12 17h.01"></path>
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                </svg>
                <div>
                    <h2 id="agri2-error-title"><?php echo ($place_err != '') ? 'موقعیت بهره‌برداری نیاز به اصلاح دارد' : 'لطفاً موارد زیر را تکمیل کنید'; ?></h2>
                    <?php if ($place_err != '') { ?>
                        <p><?php echo agri_h($place_err); ?></p>
                        <p><button type="submit" class="agri1-btn agri1-btn-ghost" form="agri-edit-back">اصلاح موقعیت در مشخصات اولیه</button></p>
                    <?php } ?>
                    <ul id="agri2-error-list"></ul>
                </div>
            </div>
            <div><?php sar_data2($bah_cod_m, $num_bah); ?></div>

            <form action="Agri_edit.php" method="post" id="form1" name="form1" class="agri1-form" novalidate>
                    <h2 class="agri1-card-title">موقعیت بهره‌برداری</h2>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">استان</span>
                            <div class="agri1-info"><?php echo ostan_name($id_ostan); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">شهرستان</span>
                            <div class="agri1-info"><?php echo city_name1($id_city, $id_ostan); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">مرکز جهاد کشاورزی</span>
                            <div class="agri1-info"><?php echo mar_name($id_mar); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">آبادی / شهر</span>
                            <div class="agri1-info"><?php echo abadi_name($add_abadi) . '' . shahr_name($add_city); ?></div>
                        </div>
                    </div>

                    <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات زمین</h2>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">نوع کشت</span>
                            <div class="agri1-info"><?php echo agri_h($v_no_kesh); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <span class="agri1-label">نوع مالکیت</span>
                            <div class="agri1-info"><?php echo agri_h($v_no_mal); ?></div>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-lng">
                            <label class="agri1-label" for="lng">طول جغرافیایی X</label>
                            <input name="lng" type="text" id="lng" dir="ltr" lang="fa" inputmode="decimal" value="<?php echo agri_h($lng); ?>" maxlength="11"
                                   aria-invalid="false" aria-describedby="hint-lng"/>
                            <p class="agri1-hint" id="hint-lng">درجه اعشار — مثال: 46.212486 — اگر مختصات ندارید صفر بزنید</p>
                            <p class="agri1-error is-hidden" id="error-lng"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-lat">
                            <label class="agri1-label" for="lat">عرض جغرافیایی Y</label>
                            <input name="lat" type="text" id="lat" dir="ltr" lang="fa" inputmode="decimal" value="<?php echo agri_h($lat); ?>" maxlength="11"
                                   aria-invalid="false" aria-describedby="hint-lat"/>
                            <p class="agri1-hint" id="hint-lat">درجه اعشار — مثال: 37.010521 — اگر مختصات ندارید صفر بزنید</p>
                            <p class="agri1-error is-hidden" id="error-lat"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <label class="agri1-label" for="m_zamin1">مجموع مساحت کشت اول (هکتار)</label>
                            <input name="m_zamin1" type="text" class="agri-lock" id="m_zamin1" dir="ltr" inputmode="decimal" value="<?php echo agri_h($z_kesht1 * 1); ?>" maxlength="15" readonly="readonly"/>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <label class="agri1-label" for="m_zamin2">مجموع مساحت کشت دوم (هکتار)</label>
                            <input name="m_zamin2" type="text" class="agri-lock" id="m_zamin2" dir="ltr" inputmode="decimal" value="<?php echo agri_h($z_kesht2 * 1); ?>" maxlength="15" readonly="readonly"/>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_zamin">
                            <label class="agri1-label" for="m_zamin">مساحت زمین (هکتار)</label>
                            <input name="m_zamin" type="text" id="m_zamin" dir="ltr" lang="fa" inputmode="decimal" value="<?php echo agri_h($m_zamin); ?>" maxlength="11"
                                   aria-invalid="false" aria-describedby="error-m_zamin"/>
                            <p class="agri1-error is-hidden" id="error-m_zamin"></p>
                        </div>
                    </div>

                    <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات مالک</h2>
                    <?php if ($no_mal <> 7) { ?>
                    <p class="agri1-note">اطلاعات بهره‌بردار <?php echo agri_h($v_co_name); ?> بعنوان مالک ثبت خواهد شد</p>
                    <?php } ?>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0" id="field-m_cod_m">
                            <label class="agri1-label" for="m_cod_m">کد ملی مالک</label>
                            <input name="m_cod_m" type="text" class="Mcod_m<?php echo $agri_ro_class; ?>" id="m_cod_m" dir="ltr" inputmode="numeric" value="<?php echo agri_h($m_cod_m); ?>" maxlength="12"<?php echo $agri_ro; ?>
                                   aria-invalid="false" aria-describedby="error-m_cod_m"/>
                            <p class="agri1-error is-hidden" id="error-m_cod_m"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0">
                            <label class="agri1-label" for="m_jens">جنسیت</label>
                            <select name="m_jens" class="mar" id="m_jens">
                                <option value="1" <?php if ($m_jens == '1') echo 'selected="selected"'; ?>>مرد</option>
                                <option value="2" <?php if ($m_jens == '2') echo 'selected="selected"'; ?>>زن</option>
                            </select>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_name">
                            <label class="agri1-label" for="m_name">نام</label>
                            <input name="m_name" type="text" class="<?php echo $agri_ro_class; ?>" id="m_name" value="<?php echo agri_h($m_name); ?>" maxlength="75"<?php echo $agri_ro; ?>
                                   aria-invalid="false" aria-describedby="error-m_name"/>
                            <p class="agri1-error is-hidden" id="error-m_name"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_last_name">
                            <label class="agri1-label" for="m_last_name">نام خانوادگی</label>
                            <input name="m_last_name" type="text" class="<?php echo $agri_ro_class; ?>" id="m_last_name" value="<?php echo agri_h($m_last_name); ?>" maxlength="70"<?php echo $agri_ro; ?>
                                   aria-invalid="false" aria-describedby="error-m_last_name"/>
                            <p class="agri1-error is-hidden" id="error-m_last_name"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_fname">
                            <label class="agri1-label" for="m_fname"><?php if ($no_bah == 2) echo 'نام شرکت'; else echo 'نام پدر'; ?></label>
                            <input name="m_fname" type="text" class="<?php echo $agri_ro_class; ?>" id="m_fname" value="<?php echo ($no_bah == 2) ? agri_h($co_name) : agri_h($m_fname); ?>" maxlength="75"<?php echo $agri_ro; ?>
                                   aria-invalid="false" aria-describedby="error-m_fname"/>
                            <p class="agri1-error is-hidden" id="error-m_fname"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_tel_m">
                            <label class="agri1-label" for="m_tel_m">تلفن همراه</label>
                            <input name="m_tel_m" type="text" class="<?php echo $agri_ro_class; ?>" id="m_tel_m" dir="ltr" inputmode="numeric" value="<?php echo agri_h($m_tel_m); ?>" maxlength="11"<?php echo $agri_ro; ?>
                                   aria-invalid="false" aria-describedby="error-m_tel_m"/>
                            <p class="agri1-error is-hidden" id="error-m_tel_m"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-m_vaz_sok">
                            <label class="agri1-label" for="m_vaz_sok">وضعیت سکونت مالک</label>
                            <select name="m_vaz_sok" id="m_vaz_sok" aria-invalid="false" aria-describedby="error-m_vaz_sok">
                                <option value="">انتخاب کنید</option>
                                <option value="1" <?php if ($m_vaz_sok == '1') echo 'selected="selected"'; ?>>ساکن</option>
                                <option value="2" <?php if ($m_vaz_sok == '2') echo 'selected="selected"'; ?>>غیرساکن</option>
                            </select>
                            <p class="agri1-error is-hidden" id="error-m_vaz_sok"></p>
                        </div>
                    </div>

                    <?php if ($no_kesh == '1') { ?>
                    <h2 class="agri1-card-title" style="margin-top:24px">اطلاعات آب</h2>
                    <div class="agri1-grid">
                        <div class="agri1-field" style="margin-top:0" id="field-m_ab">
                            <label class="agri1-label" for="m_ab">منبع آب</label>
                            <select name="m_ab" id="m_ab" aria-invalid="false" aria-describedby="error-m_ab">
                                <option value="">انتخاب کنید</option>
                                <option value="1" <?php if ($m_ab == '1') echo 'selected="selected"'; ?>>چشمه</option>
                                <option value="2" <?php if ($m_ab == '2') echo 'selected="selected"'; ?>>قنات</option>
                                <option value="3" <?php if ($m_ab == '3') echo 'selected="selected"'; ?>>رودخانه</option>
                                <option value="4" <?php if ($m_ab == '4') echo 'selected="selected"'; ?>>سد</option>
                                <option value="5" <?php if ($m_ab == '5') echo 'selected="selected"'; ?>>چاه سطحی</option>
                                <option value="6" <?php if ($m_ab == '6') echo 'selected="selected"'; ?>>چاه عمیق</option>
                                <option value="7" <?php if ($m_ab == '7') echo 'selected="selected"'; ?>>چاه نیمه عمیق</option>
                                <option value="8" <?php if ($m_ab == '8') echo 'selected="selected"'; ?>>زهکش</option>
                                <option value="9" <?php if ($m_ab == '9') echo 'selected="selected"'; ?>>پساب</option>
                                <option value="10" <?php if ($m_ab == '10') echo 'selected="selected"'; ?>>آب بندان</option>
                                <option value="11" <?php if ($m_ab == '11') echo 'selected="selected"'; ?>>سایر</option>
                            </select>
                            <p class="agri1-error is-hidden" id="error-m_ab"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-md_ab">
                            <label class="agri1-label" for="md_ab">مدار آبیاری (شبانه روز)</label>
                            <input name="md_ab" type="text" id="md_ab" dir="ltr" inputmode="decimal" value="<?php echo agri_h($md_ab); ?>" maxlength="2"
                                   aria-invalid="false" aria-describedby="error-md_ab"/>
                            <p class="agri1-error is-hidden" id="error-md_ab"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-h_ab">
                            <label class="agri1-label" for="h_ab">حقابه (ساعت)</label>
                            <input name="h_ab" type="text" id="h_ab" dir="ltr" inputmode="decimal" value="<?php echo agri_h($h_ab); ?>" maxlength="5"
                                   aria-invalid="false" aria-describedby="error-h_ab"/>
                            <p class="agri1-error is-hidden" id="error-h_ab"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-no_sab">
                            <label class="agri1-label" for="no_sab">نوع سند حقابه</label>
                            <select name="no_sab" id="no_sab" aria-invalid="false" aria-describedby="error-no_sab">
                                <option value="">انتخاب کنید</option>
                                <option value="1" <?php if ($no_sab == '1') echo 'selected="selected"'; ?>>پروانه بهره برداری</option>
                                <option value="2" <?php if ($no_sab == '2') echo 'selected="selected"'; ?>>مجوز آب</option>
                                <option value="3" <?php if ($no_sab == '3') echo 'selected="selected"'; ?>>عرفی</option>
                                <option value="4" <?php if ($no_sab == '4') echo 'selected="selected"'; ?>>سایر</option>
                            </select>
                            <p class="agri1-error is-hidden" id="error-no_sab"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-no_ab">
                            <label class="agri1-label" for="no_ab">نحوه آبیاری</label>
                            <select name="no_ab" id="no_ab" aria-invalid="false" aria-describedby="error-no_ab">
                                <option value="">انتخاب کنید</option>
                                <option value="1" <?php if ($no_ab == '1') echo 'selected="selected"'; ?>>جوی و پشته</option>
                                <option value="2" <?php if ($no_ab == '2') echo 'selected="selected"'; ?>>نواری</option>
                                <option value="3" <?php if ($no_ab == '3') echo 'selected="selected"'; ?>>غرقابی</option>
                                <option value="4" <?php if ($no_ab == '4') echo 'selected="selected"'; ?>>تشتکی</option>
                                <option value="5" <?php if ($no_ab == '5') echo 'selected="selected"'; ?>>تحت فشار قطره ای</option>
                                <option value="6" <?php if ($no_ab == '6') echo 'selected="selected"'; ?>>تحت فشار بارانی</option>
                                <option value="7" <?php if ($no_ab == '7') echo 'selected="selected"'; ?>>سایر</option>
                            </select>
                            <p class="agri1-error is-hidden" id="error-no_ab"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-es">
                            <label class="agri1-label" for="es">وضعیت استخر</label>
                            <select name="es" id="es" aria-invalid="false" aria-describedby="error-es">
                                <option value="">انتخاب کنید</option>
                                <option value="1" <?php if ($es == '1') echo 'selected="selected"'; ?>>ندارد</option>
                                <option value="2" <?php if ($es == '2') echo 'selected="selected"'; ?>>دارد / جهت ذخیره آب</option>
                                <option value="3" <?php if ($es == '3') echo 'selected="selected"'; ?>>دارد - دو منظوره</option>
                            </select>
                            <p class="agri1-error is-hidden" id="error-es"></p>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="agri1-grid" style="margin-top:24px">
                        <div class="agri1-field" style="margin-top:0" id="field-z_sal">
                            <label class="agri1-label" for="z_sal">سال زراعی</label>
                            <input name="z_sal" type="text" class="agri-lock" id="z_sal" dir="ltr" value="<?php echo agri_h($z_sal); ?>" maxlength="10" readonly="readonly"
                                   aria-invalid="false" aria-describedby="error-z_sal"/>
                            <p class="agri1-error is-hidden" id="error-z_sal"></p>
                        </div>
                        <div class="agri1-field" style="margin-top:0" id="field-s_ayesh">
                            <label class="agri1-label" for="s_ayesh">سطح آیش (هکتار)</label>
                            <input name="s_ayesh" type="text" id="s_ayesh" dir="ltr" inputmode="decimal" value="<?php echo agri_h($s_ayesh * 1); ?>" maxlength="10"
                                   aria-invalid="false" aria-describedby="hint-s_ayesh error-s_ayesh"/>
                            <p class="agri1-hint" id="hint-s_ayesh">اگر آیش ندارید صفر وارد کنید. نمی‌تواند از مساحت زمین بیشتر باشد.</p>
                            <p class="agri1-error is-hidden" id="error-s_ayesh"></p>
                        </div>
                    </div>

                    <div class="agri1-actions">
                        <input type="hidden" name="id" value="<?php echo agri_h($id); ?>"/>
                        <input type="hidden" name="z_sal_old" value="<?php echo agri_h($z_sal_old); ?>"/>
                        <input type="hidden" name="sh_gat" value="<?php echo agri_h($sh_gat); ?>"/>
                        <input type="hidden" name="bah_cod_m" value="<?php echo agri_h($bah_cod_m); ?>"/>
                        <input type="hidden" name="num_bah" value="<?php echo agri_h($num_bah); ?>"/>
                        <input type="hidden" name="m_poul" value="<?php echo agri_h($m_poul); ?>"/>
                        <input type="hidden" name="id_ostan" value="<?php echo agri_h($id_ostan); ?>"/>
                        <input type="hidden" name="id_city" value="<?php echo agri_h($id_city); ?>"/>
                        <input type="hidden" name="add_abadi" value="<?php echo agri_h($add_abadi); ?>"/>
                        <input type="hidden" name="add_city" value="<?php echo agri_h($add_city); ?>"/>
                        <input type="hidden" name="id_mar" value="<?php echo agri_h($id_mar); ?>"/>
                        <input type="hidden" name="t_mah" value="<?php echo agri_h($t_mah); ?>"/>
                        <input type="hidden" name="no_kesh" value="<?php echo agri_h($no_kesh); ?>"/>
                        <input type="hidden" name="no_mal" value="<?php echo agri_h($no_mal); ?>"/>
                        <input type="hidden" name="check_cod" value="<?php echo agri_h($check_cod); ?>"/>
                        <input type="hidden" name="id_page" value="<?php echo agri_h($id_page); ?>"/>
                        <input type="hidden" name="agri_edit_step" value="2"/>
                        <?php if ($place_ok) { ?>
                        <button type="submit" name="action" value="تصحیح اطلاعات" class="agri1-btn agri1-btn-primary" id="submit">تصحیح اطلاعات</button>
                        <?php } ?>
                        <button type="submit" class="agri1-btn agri1-btn-ghost" form="agri-edit-back" id="agri-edit-back-btn">بازگشت به مشخصات اولیه</button>
                    </div>
            </form>
        </section>

        <p class="agri1-back">
            <button type="submit" class="agri1-btn agri1-btn-ghost" form="agri-edit-cancel">
                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                </svg>
                بازگشت به صفحه قبل
            </button>
        </p>
        <form id="agri-edit-cancel" action="liste_Agri.php?id=<?php echo agri_h($id_page); ?>#1" method="post" class="is-hidden" aria-hidden="true">
            <input type="hidden" name="action_lise" value="1"/>
            <input type="hidden" name="back_p" value="1"/>
        </form>
    </main>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('../../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>
<script>
        (function () {
            var overlay = document.getElementById('agri1-overlay');
            var form = document.getElementById('form1');
            var submitBtn = document.getElementById('submit');
            var summary = document.getElementById('agri2-error-summary');
            var sending = false;

            function parseNum(v) {
                if (v == null) return null;
                v = String(v).replace(/[،,]/g, '.').replace(/^\s+|\s+$/g, '');
                if (v === '') return null;
                if (!/^-?\d+(\.\d+)?$/.test(v)) return false;
                return parseFloat(v);
            }

            function setFieldError(id, msg) {
                var el = document.getElementById(id);
                var err = document.getElementById('error-' + id);
                if (el) el.setAttribute('aria-invalid', msg ? 'true' : 'false');
                if (err) {
                    err.textContent = msg || '';
                    err.className = msg ? 'agri1-error' : 'agri1-error is-hidden';
                }
            }

            function val(id) {
                var el = document.getElementById(id);
                return el ? el.value : '';
            }

            function hasEl(id) {
                return !!document.getElementById(id);
            }

            function validateStep2() {
                var errors = {};
                var lng = parseNum(val('lng'));
                var lat = parseNum(val('lat'));
                var mZamin = parseNum(val('m_zamin'));
                var sAyesh = parseNum(val('s_ayesh'));
                var z1 = parseNum(val('m_zamin1'));
                var z2 = parseNum(val('m_zamin2'));
                if (z1 === null || z1 === false) z1 = 0;
                if (z2 === null || z2 === false) z2 = 0;

                if (lng === null) errors.lng = 'طول جغرافیایی را وارد کنید';
                else if (lng === false) errors.lng = 'طول جغرافیایی باید عدد باشد';
                else if (lng !== 0 && (lng < 40 || lng > 70)) errors.lng = 'طول جغرافیایی باید صفر یا بین ۴۰ تا ۷۰ باشد (مثال: ۴۶٫۲۱)';

                if (lat === null) errors.lat = 'عرض جغرافیایی را وارد کنید';
                else if (lat === false) errors.lat = 'عرض جغرافیایی باید عدد باشد';
                else if (lat !== 0 && (lat < 20 || lat > 45)) errors.lat = 'عرض جغرافیایی باید صفر یا بین ۲۰ تا ۴۵ باشد (مثال: ۳۷٫۰۱)';

                if (mZamin === null) errors.m_zamin = 'مساحت زمین را وارد کنید';
                else if (mZamin === false) errors.m_zamin = 'مساحت زمین باید عدد باشد';
                else if (mZamin <= 0) errors.m_zamin = 'مساحت زمین باید بزرگ‌تر از صفر باشد';

                if (sAyesh === null) errors.s_ayesh = 'سطح آیش را وارد کنید (اگر آیش ندارید صفر بزنید)';
                else if (sAyesh === false) errors.s_ayesh = 'سطح آیش باید عدد باشد';
                else if (sAyesh < 0) errors.s_ayesh = 'سطح آیش نمی‌تواند منفی باشد';
                else if (mZamin !== null && mZamin !== false && sAyesh > mZamin) {
                    errors.s_ayesh = 'سطح آیش نمی‌تواند از مساحت زمین بیشتر باشد';
                }

                if (mZamin !== null && mZamin !== false && sAyesh !== null && sAyesh !== false && sAyesh >= 0) {
                    var sumKeshtAyesh = Math.max(z1, z2) + sAyesh;
                    if (mZamin < sumKeshtAyesh) {
                        errors.m_zamin = 'مساحت کل زمین نمی‌تواند کوچک‌تر از مجموع مساحت کشت‌شده و آیش (' + sumKeshtAyesh + ') باشد';
                    }
                }

                if (!val('z_sal')) errors.z_sal = 'سال زراعی را انتخاب کنید';
                if (!val('m_vaz_sok')) errors.m_vaz_sok = 'وضعیت سکونت مالک را انتخاب کنید';
                if (!val('m_cod_m').replace(/^\s+|\s+$/g, '')) errors.m_cod_m = 'کد ملی مالک را وارد کنید';
                if (!val('m_name').replace(/^\s+|\s+$/g, '')) errors.m_name = 'نام مالک را وارد کنید';
                if (!val('m_last_name').replace(/^\s+|\s+$/g, '')) errors.m_last_name = 'نام خانوادگی مالک را وارد کنید';
                if (!val('m_tel_m').replace(/^\s+|\s+$/g, '')) errors.m_tel_m = 'تلفن همراه را وارد کنید';
                if (!val('m_fname').replace(/^\s+|\s+$/g, '')) errors.m_fname = 'این فیلد را تکمیل کنید';

                if (hasEl('m_ab')) {
                    if (!val('m_ab')) errors.m_ab = 'منبع آب را انتخاب کنید';
                    if (!val('md_ab').replace(/^\s+|\s+$/g, '')) errors.md_ab = 'مدار آبیاری را وارد کنید';
                    else if (parseNum(val('md_ab')) === false) errors.md_ab = 'مدار آبیاری باید عدد باشد';
                    if (!val('h_ab').replace(/^\s+|\s+$/g, '')) errors.h_ab = 'حقابه را وارد کنید';
                    else if (parseNum(val('h_ab')) === false) errors.h_ab = 'حقابه باید عدد باشد';
                    if (!val('no_sab')) errors.no_sab = 'نوع سند حقابه را انتخاب کنید';
                    if (!val('no_ab')) errors.no_ab = 'نحوه آبیاری را انتخاب کنید';
                    if (!val('es')) errors.es = 'وضعیت استخر را انتخاب کنید';
                }
                return errors;
            }

            function applyErrors(errors) {
                var ids = ['lng', 'lat', 'm_zamin', 's_ayesh', 'z_sal', 'm_vaz_sok', 'm_cod_m', 'm_name', 'm_last_name', 'm_fname', 'm_tel_m', 'm_ab', 'md_ab', 'h_ab', 'no_sab', 'no_ab', 'es'];
                for (var i = 0; i < ids.length; i++) {
                    setFieldError(ids[i], errors[ids[i]] || '');
                }
                if (summary) {
                    var title = document.getElementById('agri2-error-title');
                    var list = document.getElementById('agri2-error-list');
                    if (list) {
                        list.innerHTML = '';
                        for (var key in errors) {
                            if (!errors.hasOwnProperty(key)) continue;
                            var li = document.createElement('li');
                            var a = document.createElement('a');
                            a.href = '#field-' + key;
                            a.appendChild(document.createTextNode(errors[key]));
                            li.appendChild(a);
                            list.appendChild(li);
                        }
                    }
                    if (title) title.textContent = 'لطفاً موارد زیر را تکمیل کنید';
                    summary.className = 'agri1-alert';
                    summary.removeAttribute('hidden');
                    try { summary.focus(); } catch (e) {}
                }
            }

            function checkAyeshLive() {
                var mZamin = parseNum(val('m_zamin'));
                var sAyesh = parseNum(val('s_ayesh'));
                var msg = '';
                if (sAyesh === false) msg = 'سطح آیش باید عدد باشد';
                else if (sAyesh !== null && sAyesh < 0) msg = 'سطح آیش نمی‌تواند منفی باشد';
                else if (sAyesh !== null && mZamin !== null && mZamin !== false && sAyesh > mZamin) {
                    msg = 'سطح آیش نمی‌تواند از مساحت زمین بیشتر باشد';
                }
                setFieldError('s_ayesh', msg);
            }

            $(function () {
                if (summary && !summary.hasAttribute('hidden')) {
                    try { summary.focus(); } catch (e) {}
                }

                $('.Mcod_m').change(function () {
                    $.ajax({
                        type: 'POST',
                        url: 'select_mar.php',
                        data: 'cod_m=' + $(this).val(),
                        cache: false,
                        success: function (html) {
                            $('.mar').html(html);
                        }
                    });
                });

                $('#s_ayesh, #m_zamin').on('input', checkAyeshLive);

                if (form) {
                    form.addEventListener('submit', function (e) {
                        if (sending) {
                            e.preventDefault();
                            return;
                        }
                        var errors = validateStep2();
                        var hasErr = false;
                        for (var k in errors) {
                            if (errors.hasOwnProperty(k)) { hasErr = true; break; }
                        }
                        if (hasErr) {
                            e.preventDefault();
                            applyErrors(errors);
                            var firstId = null;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) { firstId = key; break; }
                            }
                            var first = firstId ? document.getElementById(firstId) : null;
                            if (first && first.focus) first.focus();
                            return;
                        }
                        sending = true;
                        if (overlay) overlay.className = 'agri1-overlay is-open';
                        if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
                    });
                }
            });
        })();
</script>
</body>
</html>
<?php
    exit;
}

if ($bah_cod_m == '') {
    ?>
    <form name="myform" class="myform" method="post" action="liste_Agri.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
    exit;
}

$city_data = array();
$abadi_data = array();
$query = "SELECT add_city, shahr FROM `list_city` WHERE mor_cod_m = :mor_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m' => $login_session));
foreach ($stmt as $row) {
    $city_data[] = array('code' => $row['add_city'], 'name' => $row['shahr']);
}

$query = "SELECT add_abadi, abadi FROM `list_abadi` WHERE mor_cod_m = :mor_cod_m ORDER BY BINARY abadi";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m' => $login_session));
foreach ($stmt as $row) {
    $abadi_data[] = array('code' => $row['add_abadi'], 'name' => $row['abadi']);
}

$city_code = ($add_city == '-') ? '' : $add_city;
$abadi_code = ($add_abadi == '-') ? '' : $add_abadi;
$city_label = '';
if ($city_code != '') {
    foreach ($city_data as $item) {
        if ($item['code'] == $city_code) {
            $city_label = $item['name'];
            break;
        }
    }
}
$abadi_label = '';
if ($abadi_code != '') {
    foreach ($abadi_data as $item) {
        if ($item['code'] == $abadi_code) {
            $abadi_label = $item['name'];
            break;
        }
    }
}

$show_city = ($m_poul == 'shahr' || ($city_code != ''));
$show_abadi = ($m_poul == 'abadi' || ($abadi_code != ''));
$has_errors = ($mess != '');
$err_m_poul = isset($field_errors['m_poul']);
$err_city = isset($field_errors['add_city']);
$err_abadi = isset($field_errors['add_abadi']);
$err_cod = isset($field_errors['bah_cod_m']);
$err_kesh = isset($field_errors['no_kesh']);
$err_mal = isset($field_errors['no_mal']);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo isset($title) ? agri_h($title) : ''; ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <?php agri_form_css(); ?>
</head>
<body class="agri1-body agri1-page">
    <a class="agri1-skip" href="#agri-edit-form">رفتن به فرم ویرایش</a>

    <div id="agri1-overlay" class="agri1-overlay">
        <div class="agri1-overlay-panel" role="status" aria-live="polite" aria-atomic="true">
            <div class="agri1-spinner" aria-hidden="true"></div>
            <p>در حال بررسی اطلاعات...</p>
        </div>
    </div>

    <?php include(__DIR__ . '/../../chrome.php'); ?>

    <main class="agri1-main">
        <header class="agri1-hero">
            <h1 class="agri1-title" id="agri-edit-title">ویرایش اطلاعات بهره‌برداری زراعی</h1>
            <ol class="agri1-steps" aria-label="مراحل ویرایش">
                <li class="is-current" aria-current="step"><span class="agri1-step-num" aria-hidden="true">1</span> مشخصات اولیه</li>
                <li><span class="agri1-step-num" aria-hidden="true">2</span> اطلاعات قطعه</li>
            </ol>
        </header>

        <section class="agri1-card" aria-labelledby="agri-edit-title">
            <?php if ($has_errors) { ?>
                <div class="agri1-alert" id="agri1-error-summary" role="alert" tabindex="-1" aria-labelledby="agri1-error-title">
                    <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 9v4"></path>
                        <path d="M12 17h.01"></path>
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    </svg>
                    <div>
                        <h2 id="agri1-error-title">لطفاً موارد زیر را تکمیل کنید</h2>
                        <?php if (!empty($field_errors)) { ?>
                            <ul>
                                <?php foreach ($field_errors as $fid => $ferr) { ?>
                                    <li><a href="#field-<?php echo agri_h($fid); ?>"><?php echo agri_h($ferr); ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <form id="agri-edit-form" class="agri1-form" method="post" action="Agri_edit.php" novalidate>
                <fieldset class="agri1-fieldset<?php echo $err_m_poul ? ' is-invalid' : ''; ?>" id="field-m_poul">
                    <legend class="agri1-legend">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        موقعیت بهره‌برداری
                    </legend>
                    <p class="agri1-hint" id="hint-m_poul">محل را انتخاب کنید؛ سپس نام شهر یا آبادی را جستجو و از فهرست برگزینید.</p>
                    <div class="agri1-choices" role="radiogroup" aria-labelledby="field-m_poul" aria-describedby="hint-m_poul<?php echo $err_m_poul ? ' error-m_poul' : ''; ?>">
                        <label class="agri1-choice<?php if ($m_poul == 'shahr') echo ' is-selected'; ?>">
                            <input type="radio" class="region" name="m_poul" value="shahr"
                                <?php if ($m_poul == 'shahr') echo 'checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>شهر</span>
                        </label>
                        <label class="agri1-choice<?php if ($m_poul == 'abadi') echo ' is-selected'; ?>">
                            <input type="radio" class="region" name="m_poul" value="abadi"
                                <?php if ($m_poul == 'abadi') echo 'checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>آبادی</span>
                        </label>
                    </div>
                    <?php if ($err_m_poul) { ?>
                        <p class="agri1-error" id="error-m_poul"><?php echo agri_h($field_errors['m_poul']); ?></p>
                    <?php } ?>

                    <div class="agri1-field shahr_wrap<?php echo $show_city ? '' : ' is-hidden'; ?>" id="field-add_city">
                        <label class="agri1-label" for="add_city_text">نام شهر</label>
                        <div class="agri1-combo">
                            <input type="text" id="add_city_text" dir="rtl" autocomplete="off"
                                   placeholder="جستجو یا انتخاب از فهرست"
                                   role="combobox" aria-expanded="false" aria-controls="city_dropdown"
                                   aria-autocomplete="list"
                                   aria-invalid="<?php echo $err_city ? 'true' : 'false'; ?>"
                                   value="<?php echo agri_h($city_label); ?>"/>
                            <button type="button" class="agri1-combo-toggle" id="city_arrow" aria-label="نمایش فهرست شهرها" aria-controls="city_dropdown">
                                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </button>
                            <ul id="city_dropdown" class="agri1-combo-list" role="listbox" hidden></ul>
                        </div>
                        <input type="hidden" name="add_city" id="add_city_hidden" value="<?php echo agri_h($city_code); ?>"/>
                        <p class="agri1-error<?php echo $err_city ? '' : ' is-hidden'; ?>" id="error-add_city"><?php echo $err_city ? agri_h($field_errors['add_city']) : 'لطفاً یک شهر را از فهرست انتخاب کنید'; ?></p>
                    </div>

                    <div class="agri1-field abadi_wrap<?php echo $show_abadi ? '' : ' is-hidden'; ?>" id="field-add_abadi">
                        <label class="agri1-label" for="add_abadi_text">نام آبادی</label>
                        <div class="agri1-combo">
                            <input type="text" id="add_abadi_text" dir="rtl" autocomplete="off"
                                   placeholder="جستجو یا انتخاب از فهرست"
                                   role="combobox" aria-expanded="false" aria-controls="abadi_dropdown"
                                   aria-autocomplete="list"
                                   aria-invalid="<?php echo $err_abadi ? 'true' : 'false'; ?>"
                                   value="<?php echo agri_h($abadi_label); ?>"/>
                            <button type="button" class="agri1-combo-toggle" id="abadi_arrow" aria-label="نمایش فهرست آبادی‌ها" aria-controls="abadi_dropdown">
                                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </button>
                            <ul id="abadi_dropdown" class="agri1-combo-list" role="listbox" hidden></ul>
                        </div>
                        <input type="hidden" name="add_abadi" id="add_abadi_hidden" value="<?php echo agri_h($abadi_code); ?>"/>
                        <p class="agri1-error<?php echo $err_abadi ? '' : ' is-hidden'; ?>" id="error-add_abadi"><?php echo $err_abadi ? agri_h($field_errors['add_abadi']) : 'لطفاً یک آبادی را از فهرست انتخاب کنید'; ?></p>
                    </div>
                </fieldset>

                <fieldset class="agri1-fieldset" id="field-bah_cod_m">
                    <legend class="agri1-legend">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        مشخصات بهره‌بردار
                    </legend>
                    <label class="agri1-label" for="bah_cod_m">کد ملی بهره‌بردار / مدیرعامل</label>
                    <input name="bah_cod_m" id="bah_cod_m" class="agri-lock" type="text" inputmode="numeric" maxlength="12" dir="ltr"
                           autocomplete="off" readonly="readonly"
                           value="<?php echo agri_h($bah_cod_m); ?>"
                           aria-invalid="<?php echo $err_cod ? 'true' : 'false'; ?>"
                           aria-describedby="<?php echo $err_cod ? 'error-bah_cod_m' : ''; ?>"/>
                    <?php if ($err_cod) { ?>
                        <p class="agri1-error" id="error-bah_cod_m"><?php echo agri_h($field_errors['bah_cod_m']); ?></p>
                    <?php } ?>
                </fieldset>

                <fieldset class="agri1-fieldset<?php echo $err_kesh ? ' is-invalid' : ''; ?>" id="field-no_kesh">
                    <legend class="agri1-legend">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 22V8"></path>
                            <path d="M5 12s2.5-7 7-7 7 7 7 7"></path>
                            <path d="M5 22h14"></path>
                        </svg>
                        نوع کشت
                    </legend>
                    <div class="agri1-choices" role="radiogroup" aria-labelledby="field-no_kesh"
                         aria-describedby="<?php echo $err_kesh ? 'error-no_kesh' : ''; ?>">
                        <label class="agri1-choice<?php if ($no_kesh == '1') echo ' is-selected'; ?>">
                            <input type="radio" name="no_kesh" value="1"
                                <?php if ($no_kesh == '1') echo 'checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>آبی</span>
                        </label>
                        <label class="agri1-choice<?php if ($no_kesh == '2') echo ' is-selected'; ?>">
                            <input type="radio" name="no_kesh" value="2"
                                <?php if ($no_kesh == '2') echo 'checked="checked"'; ?> />
                            <span class="agri1-choice-mark" aria-hidden="true"></span>
                            <span>دیم</span>
                        </label>
                    </div>
                    <?php if ($err_kesh) { ?>
                        <p class="agri1-error" id="error-no_kesh"><?php echo agri_h($field_errors['no_kesh']); ?></p>
                    <?php } ?>
                </fieldset>

                <fieldset class="agri1-fieldset" id="field-no_mal">
                    <legend class="agri1-legend">
                        <svg class="agri1-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <path d="M14 2v6h6"></path>
                            <path d="M16 13H8"></path>
                            <path d="M16 17H8"></path>
                            <path d="M10 9H8"></path>
                        </svg>
                        نوع مالکیت
                    </legend>
                    <label class="agri1-label" for="no_mal">سند یا مبنای مالکیت قطعه</label>
                    <select name="no_mal" id="no_mal" dir="rtl"
                            aria-invalid="<?php echo $err_mal ? 'true' : 'false'; ?>"
                            aria-describedby="<?php echo $err_mal ? 'error-no_mal' : ''; ?>">
                        <option value="">انتخاب کنید</option>
                        <option value="1" <?php if ($no_mal == '1') echo 'selected="selected"'; ?>>سند ششدانگ</option>
                        <option value="2" <?php if ($no_mal == '2') echo 'selected="selected"'; ?>>سند مشاعی</option>
                        <option value="3" <?php if ($no_mal == '3') echo 'selected="selected"'; ?>>اصلاحات اراضی</option>
                        <option value="4" <?php if ($no_mal == '4') echo 'selected="selected"'; ?>>موقوفه</option>
                        <option value="5" <?php if ($no_mal == '5') echo 'selected="selected"'; ?>>واگذاری</option>
                        <option value="6" <?php if ($no_mal == '6') echo 'selected="selected"'; ?>>قولنامه</option>
                        <option value="7" <?php if ($no_mal == '7') echo 'selected="selected"'; ?>>اجاره</option>
                        <option value="8" <?php if ($no_mal == '8') echo 'selected="selected"'; ?>>سایر</option>
                    </select>
                    <?php if ($err_mal) { ?>
                        <p class="agri1-error" id="error-no_mal"><?php echo agri_h($field_errors['no_mal']); ?></p>
                    <?php } ?>
                </fieldset>

                <div class="agri1-actions">
                    <input type="hidden" name="sh_gat" value="<?php echo agri_h($sh_gat); ?>"/>
                    <input type="hidden" name="id" value="<?php echo agri_h($id); ?>"/>
                    <input type="hidden" name="z_sal" value="<?php echo agri_h($z_sal); ?>"/>
                    <input type="hidden" name="id_page" value="<?php echo agri_h($id_page); ?>"/>
                    <input type="hidden" name="t_mah" value="<?php echo agri_h($t_mah); ?>"/>
                    <input type="hidden" name="m_poul" id="m_poul_hidden" value="<?php echo agri_h($m_poul); ?>"/>
                    <button id="sub" name="action" type="submit" class="agri1-btn agri1-btn-primary" value="ادامه">
                        ادامه
                        <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M19 12H5"></path>
                            <path d="M12 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </section>

        <p class="agri1-back">
            <button type="submit" class="agri1-btn agri1-btn-ghost" form="agri-edit-cancel">
                <svg class="agri1-icon" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                </svg>
                بازگشت به صفحه قبل
            </button>
        </p>
        <form id="agri-edit-cancel" action="liste_Agri.php?id=<?php echo agri_h($id_page); ?>#1" method="post" class="is-hidden" aria-hidden="true">
            <input type="hidden" name="action_lise" value="1"/>
            <input type="hidden" name="back_p" value="1"/>
        </form>
    </main>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td height="109" style="background: url('../../files/bottom.gif') repeat-x; vertical-align: middle;">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>
<script>
        (function () {
            var cityData = <?php echo json_encode($city_data); ?>;
            var abadiData = <?php echo json_encode($abadi_data); ?>;
            var overlay = document.getElementById('agri1-overlay');
            var form = document.getElementById('agri-edit-form');
            var submitBtn = document.getElementById('sub');
            var summary = document.getElementById('agri1-error-summary');
            var sending = false;

            function showOverlay() {
                if (!overlay) return;
                overlay.className = 'agri1-overlay is-open';
                if (submitBtn) submitBtn.setAttribute('aria-busy', 'true');
            }

            function syncChoiceState() {
                $('.agri1-choice').each(function () {
                    var input = $(this).find('input[type=radio]')[0];
                    if (input && input.checked) $(this).addClass('is-selected');
                    else $(this).removeClass('is-selected');
                });
            }

            function findExact(data, name) {
                var text = (name || '').replace(/^\s+|\s+$/g, '');
                for (var i = 0; i < data.length; i++) {
                    if (data[i].name === text) return data[i];
                }
                return null;
            }

            function closeList(list, input) {
                list.removeClass('is-open').attr('hidden', true);
                if (input) input.attr('aria-expanded', 'false');
            }

            function renderList(list, data, filterText, onPick) {
                list.empty();
                var filtered = data;
                if (filterText) {
                    filtered = [];
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].name.indexOf(filterText) !== -1) filtered.push(data[i]);
                    }
                }
                if (filtered.length === 0) {
                    list.append('<li class="agri1-combo-empty">موردی یافت نشد</li>');
                } else {
                    for (var j = 0; j < filtered.length; j++) {
                        var item = filtered[j];
                        var li = $('<li class="agri1-combo-option" role="option"></li>');
                        li.text(item.name);
                        li.attr('data-code', item.code);
                        li.attr('data-name', item.name);
                        list.append(li);
                    }
                    list.find('.agri1-combo-option').on('mousedown', function (e) {
                        e.preventDefault();
                        onPick($(this).attr('data-code'), $(this).attr('data-name'));
                    });
                }
                list.addClass('is-open').removeAttr('hidden');
            }

            function setupCombo(opts) {
                var input = $(opts.input);
                var hidden = $(opts.hidden);
                var list = $(opts.list);
                var arrow = $(opts.arrow);
                var data = opts.data;

                function openList() {
                    renderList(list, data, input.val(), function (code, name) {
                        input.val(name);
                        hidden.val(code);
                        input.attr('aria-invalid', 'false');
                        $(opts.error).addClass('is-hidden');
                        closeList(list, input);
                    });
                    input.attr('aria-expanded', 'true');
                }

                input.on('focus click', function () { openList(); });
                input.on('input', function () {
                    var match = findExact(data, input.val());
                    hidden.val(match ? match.code : '');
                    openList();
                });
                input.on('keydown', function (e) {
                    if (e.keyCode === 27) closeList(list, input);
                });
                arrow.on('click', function (e) {
                    e.preventDefault();
                    if (list.hasClass('is-open')) closeList(list, input);
                    else {
                        input.focus();
                        openList();
                    }
                });
            }

            function showFieldError(id, show) {
                var el = document.getElementById(id);
                if (!el) return;
                if (show) el.className = 'agri1-error';
                else el.className = 'agri1-error is-hidden';
            }

            if (summary) summary.focus();

            if (form) {
                form.addEventListener('submit', function (e) {
                    var region = form.querySelector('input.region:checked');
                    var hiddenRegion = document.getElementById('m_poul_hidden');
                    if (region && hiddenRegion) hiddenRegion.value = region.value;

                    var selectedType = region ? region.value : (hiddenRegion ? hiddenRegion.value : '');
                    var cityCode = document.getElementById('add_city_hidden').value;
                    var abadiCode = document.getElementById('add_abadi_hidden').value;
                    var ok = true;

                    if (selectedType === 'shahr' && (!cityCode || cityCode === '')) {
                        showFieldError('error-add_city', true);
                        document.getElementById('add_city_text').setAttribute('aria-invalid', 'true');
                        ok = false;
                    }
                    if (selectedType === 'abadi' && (!abadiCode || abadiCode === '')) {
                        showFieldError('error-add_abadi', true);
                        document.getElementById('add_abadi_text').setAttribute('aria-invalid', 'true');
                        ok = false;
                    }

                    if (!ok) {
                        e.preventDefault();
                        sending = false;
                        return;
                    }

                    if (sending) {
                        e.preventDefault();
                        return;
                    }
                    sending = true;
                    showOverlay();
                });
            }

            $(document).ready(function () {
                syncChoiceState();

                setupCombo({
                    input: '#add_city_text',
                    hidden: '#add_city_hidden',
                    list: '#city_dropdown',
                    arrow: '#city_arrow',
                    error: '#error-add_city',
                    data: cityData
                });
                setupCombo({
                    input: '#add_abadi_text',
                    hidden: '#add_abadi_hidden',
                    list: '#abadi_dropdown',
                    arrow: '#abadi_arrow',
                    error: '#error-add_abadi',
                    data: abadiData
                });

                $('.agri1-choice input[type=radio]').change(function () {
                    syncChoiceState();
                });

                $('input.region').change(function () {
                    $('#m_poul_hidden').val(this.value);
                    if (this.value == 'shahr') {
                        $('.shahr_wrap').removeClass('is-hidden');
                        $('.abadi_wrap').addClass('is-hidden');
                        $('#add_abadi_hidden').val('');
                        $('#add_abadi_text').val('').attr('aria-invalid', 'false');
                        $('#error-add_abadi').addClass('is-hidden');
                    } else if (this.value == 'abadi') {
                        $('.abadi_wrap').removeClass('is-hidden');
                        $('.shahr_wrap').addClass('is-hidden');
                        $('#add_city_hidden').val('');
                        $('#add_city_text').val('').attr('aria-invalid', 'false');
                        $('#error-add_city').addClass('is-hidden');
                    }
                });

                $(document).on('click', function (e) {
                    if (!$(e.target).closest('.agri1-combo').length) {
                        closeList($('#city_dropdown'), $('#add_city_text'));
                        closeList($('#abadi_dropdown'), $('#add_abadi_text'));
                    }
                });
            });
        })();
</script>
</body>
</html>
