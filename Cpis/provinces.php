<?php
include('../lock_cp.php');
include('../login/config.php');
require_once('side_menu1.php');
include('counter_a.php');
header('Content-Type: text/html; charset=utf-8');

$province_counts = get_province_counts();
$province_totals = get_province_totals();
$update_percents = get_all_ostan_abadi_update_per();

$query = "SELECT t1.id_ostan, t1.ostan, t2.id, t2.username, t2.tel_m, t2.cod_m, t2.Last_name, t2.name, t2.pic
          FROM ostanname t1
          LEFT JOIN users t2 ON t1.id_ostan = t2.id_ostan AND t2.chief = '1'
          ORDER BY BINARY t1.ostan";
$stmt = $dbh->prepare($query);
$stmt->execute();
$provinces = $stmt->fetchAll(PDO::FETCH_ASSOC);

function fmt_count($n) {
    return number_format((int) $n);
}

function count_button($action, $id_ostan, $ostan, $value) {
    $action = htmlspecialchars($action, ENT_QUOTES, 'UTF-8');
    $id_ostan = htmlspecialchars($id_ostan, ENT_QUOTES, 'UTF-8');
    $ostan_esc = htmlspecialchars($ostan, ENT_QUOTES, 'UTF-8');
    $label = fmt_count($value);
    echo '<form action="'.$action.'" method="post" class="num-form" onsubmit="return showLoader()">';
    echo '<input type="hidden" name="id_ostan" value="'.$id_ostan.'" />';
    echo '<input type="hidden" name="ostan" value="'.$ostan_esc.'" />';
    echo '<button type="submit" class="num-btn" title="مشاهده جزئیات">'.$label.'</button>';
    echo '</form>';
}

function pct_color($pct) {
    if ($pct >= 80) return '#27ae60';
    if ($pct >= 50) return '#f39c12';
    return '#e74c3c';
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($title); ?></title>
    <link href="../FA.css" rel="stylesheet" type="text/css" />
    <style>
        /* ── CSS Variables ── */
        :root {
            --primary: #1a5276;
            --primary-light: #2980b9;
            --primary-dark: #0e2f44;
            --accent: #27ae60;
            --bg: #f0f4f8;
            --card-bg: #fff;
            --border: #dce4ec;
            --text: #2c3e50;
            --text-light: #7f8c8d;
            --shadow-sm: 0 1px 3px rgba(0,0,0,.08);
            --shadow-md: 0 4px 12px rgba(0,0,0,.1);
            --shadow-lg: 0 8px 24px rgba(0,0,0,.12);
            --radius: 10px;
            --radius-sm: 6px;
            --transition: .2s ease;
        }

        /* ── Reset & Base ── */
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Tahoma, 'Segoe UI', Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        /* ── Page Layout ── */
        .page-wrap { width: 100%; background: #fff; }
        .page-main { padding: 12px 20px 30px; max-width: 1400px; margin: 0 auto; }

        /* ── Title ── */
        .dash-title {
            color: var(--primary-dark);
            font-size: 20px;
            font-weight: 700;
            margin: 10px 0 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .dash-title::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 24px;
            background: var(--primary-light);
            border-radius: 2px;
        }
        .dash-divider {
            height: 1px;
            background: linear-gradient(to left, transparent, var(--border), transparent);
            margin: 10px 0 18px;
            border: none;
        }

        /* ── KPI Cards ── */
        .kpi-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }
        .kpi {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 14px 12px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: transform var(--transition), box-shadow var(--transition);
            position: relative;
            overflow: hidden;
        }
        .kpi:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        .kpi::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 3px;
            background: var(--primary-light);
            border-radius: var(--radius) var(--radius) 0 0;
        }
        .kpi .kpi-icon {
            font-size: 22px;
            margin-bottom: 4px;
        }
        .kpi b {
            display: block;
            color: var(--primary);
            font-size: 20px;
            margin-top: 4px;
        }
        .kpi span {
            color: var(--text-light);
            font-size: 12px;
            font-weight: 500;
        }

        /* ── Toolbar ── */
        .dash-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 14px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 10px 14px;
            box-shadow: var(--shadow-sm);
        }
        .dash-search-wrap {
            position: relative;
            flex: 1;
            min-width: 220px;
            max-width: 360px;
        }
        .dash-search-wrap::before {
            content: '🔍';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            pointer-events: none;
        }
        .dash-search {
            font-family: Tahoma, sans-serif;
            font-size: 13px;
            padding: 8px 12px 8px 34px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            width: 100%;
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
            background: #fafbfc;
        }
        .dash-search:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(41,128,185,.12);
            background: #fff;
        }
        .dash-search::placeholder { color: #aab; }
        .filter-info {
            display: inline-block;
            margin-right: 8px;
            font-size: 12px;
            color: var(--text-light);
            background: #eef3f8;
            padding: 2px 8px;
            border-radius: 10px;
        }
        .export-btns { display: flex; gap: 8px; align-items: center; }
        .export-btns form { margin: 0; }
        .export-btns button {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 5px 8px;
            cursor: pointer;
            transition: all var(--transition);
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: var(--text);
        }
        .export-btns button:hover {
            background: var(--primary-light);
            color: #fff;
            border-color: var(--primary-light);
            box-shadow: var(--shadow-sm);
        }
        .export-btns button img { width: 28px; height: 30px; }

        /* ── Table ── */
        .table-scroll { width: 100%; overflow-x: auto; border-radius: var(--radius); box-shadow: var(--shadow-sm); }
        table.ostan-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            background: var(--card-bg);
        }
        table.ostan-table thead th {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            padding: 10px 8px;
            position: sticky;
            top: 0;
            z-index: 2;
            white-space: nowrap;
            font-weight: 600;
            font-size: 11px;
            letter-spacing: .3px;
            border-bottom: 2px solid rgba(255,255,255,.15);
            user-select: none;
        }
        table.ostan-table thead th.sortable {
            cursor: pointer;
            position: relative;
        }
        table.ostan-table thead th.sortable:hover {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        }
        table.ostan-table thead th.sortable::after {
            content: ' ⇅';
            font-size: 10px;
            opacity: .6;
        }
        table.ostan-table thead th.sort-asc::after { content: ' ▲'; opacity: 1; }
        table.ostan-table thead th.sort-desc::after { content: ' ▼'; opacity: 1; }
        table.ostan-table thead tr:last-child th {
            background: var(--primary);
            font-weight: 500;
            font-size: 10.5px;
            padding: 7px 6px;
        }
        table.ostan-table td {
            padding: 7px 6px;
            border-bottom: 1px solid #eef1f5;
            text-align: center;
            vertical-align: middle;
            transition: background var(--transition);
        }
        table.ostan-table tbody tr { transition: background var(--transition); }
        table.ostan-table tbody tr:nth-child(even) { background: #f8fafc; }
        table.ostan-table tbody tr:hover { background: #edf5ff; }
        table.ostan-table .ostan-name {
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 12.5px;
        }
        .row-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: #eef3f8;
            border-radius: 50%;
            font-size: 11px;
            color: var(--text-light);
            font-weight: 600;
        }

        /* ── Chief Photo ── */
        .chief-photo {
            width: 38px;
            height: 44px;
            object-fit: cover;
            border-radius: 6px;
            border: 2px solid var(--border);
            transition: border-color var(--transition), transform var(--transition);
        }
        .chief-photo:hover {
            border-color: var(--primary-light);
            transform: scale(1.1);
        }

        /* ── Progress Bar ── */
        .pct-wrap { white-space: nowrap; font-size: 11px; color: var(--text-light); }
        .pct {
            display: inline-block;
            width: 60px;
            height: 6px;
            background: #e8ecf0;
            border-radius: 6px;
            overflow: hidden;
            vertical-align: middle;
            margin-left: 6px;
        }
        .pct > i {
            display: block;
            height: 100%;
            border-radius: 6px;
            transition: width .5s ease;
        }

        /* ── Buttons ── */
        .act-cell form, .num-form { margin: 0; display: inline; }
        .icon-btn, .num-btn {
            background: transparent;
            border: 0;
            cursor: pointer;
            padding: 2px;
        }
        .num-btn {
            min-width: 48px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 4px 10px;
            color: var(--primary);
            font-family: Tahoma, sans-serif;
            font-size: 12px;
            font-weight: 600;
            transition: all var(--transition);
        }
        .num-btn:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            box-shadow: var(--shadow-sm);
            transform: translateY(-1px);
        }
        .num-btn:active { transform: translateY(0); }
        .icon-btn img, .icon-btn {
            transition: all var(--transition);
        }
        .icon-btn:hover img {
            transform: scale(1.15);
            filter: brightness(1.1);
        }
        .icon-btn[disabled], .num-btn[disabled] {
            opacity: .3;
            cursor: default;
        }
        .icon-btn[disabled]:hover img { transform: none; filter: none; }

        /* ── Table Footer ── */
        .total-row td { background: #f0f4f8; font-weight: 700; color: var(--primary-dark); }
        .total-head td {
            background: linear-gradient(135deg, #34495e, #2c3e50);
            color: #fff;
            font-weight: 600;
            font-size: 11px;
        }
        .total-head a { color: #f1c40f; text-decoration: none; }
        .total-head a:hover { text-decoration: underline; }

        /* ── Loading Overlay ── */
        #load {
            display: none;
            position: fixed;
            z-index: 999;
            inset: 0;
            background: rgba(255,255,255,.7);
            backdrop-filter: blur(3px);
            align-items: center;
            justify-content: center;
        }
        #load.show { display: flex; }
        .loader-spinner {
            width: 48px;
            height: 48px;
            border: 4px solid var(--border);
            border-top-color: var(--primary-light);
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Go Back Button ── */
        .go-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 16px;
            padding: 8px 18px;
            background: var(--primary);
            color: #fff;
            text-decoration: none;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 600;
            transition: all var(--transition);
            box-shadow: var(--shadow-sm);
        }
        .go-back:hover {
            background: var(--primary-dark);
            box-shadow: var(--shadow-md);
            transform: translateY(-1px);
        }

        /* ── Empty State ── */
        .no-results {
            text-align: center;
            padding: 30px;
            color: var(--text-light);
            font-size: 14px;
            display: none;
        }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .page-main { padding: 10px 12px 20px; }
            .dash-toolbar { flex-direction: column; align-items: stretch; }
            .dash-search-wrap { max-width: 100%; }
            .export-btns { justify-content: center; }
            .kpi-row { grid-template-columns: repeat(3, 1fr); gap: 8px; }
            .kpi { padding: 10px 8px; }
            .kpi b { font-size: 16px; }
        }
        @media (max-width: 600px) {
            .kpi-row { grid-template-columns: repeat(2, 1fr); }
            .dash-title { font-size: 16px; }
            table.ostan-table { font-size: 11px; }
        }

        /* ── Print ── */
        @media print {
            .dash-toolbar, .go-back, .icon-btn, #load { display: none !important; }
            .kpi-row { break-inside: avoid; }
            table.ostan-table { font-size: 10px; }
        }
    </style>
    <script>
        /* ── Loading Overlay ── */
        function showLoader() {
            var el = document.getElementById('load');
            if (el) el.className = 'show';
            return true;
        }

        /* ── Popup Windows ── */
        function target_popup(form) {
            window.open('', 'formpopup', 'width=250,height=479,resizable,scrollbars');
            form.target = 'formpopup';
        }
        function target_popup2(form) {
            window.open('', 'formpopup', 'width=950,height=700,resizable,scrollbars');
            form.target = 'formpopup';
        }

        /* ── Search (multi-column, case-insensitive) ── */
        function filterOstan(q) {
            q = (q || '').replace(/^\s+|\s+$/g, '').toLowerCase();
            var rows = document.querySelectorAll('#ostan-table tbody tr[data-ostan]');
            var n = 0;
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].querySelectorAll('td');
                var text = '';
                for (var j = 0; j < cells.length; j++) {
                    text += ' ' + (cells[j].textContent || '');
                }
                var show = !q || text.toLowerCase().indexOf(q) !== -1;
                rows[i].style.display = show ? '' : 'none';
                if (show) n++;
            }
            var info = document.getElementById('ostan-filter-info');
            if (info) info.textContent = q ? (n + ' استان از ' + rows.length) : '';
            // Show/hide no-results message
            var nr = document.getElementById('no-results');
            if (nr) nr.style.display = (q && n === 0) ? 'block' : 'none';
        }

        /* ── Keyboard Shortcut: / to focus search ── */
        document.addEventListener('keydown', function(e) {
            if (e.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
                e.preventDefault();
                var s = document.querySelector('.dash-search');
                if (s) s.focus();
            }
            if (e.key === 'Escape') {
                var s = document.querySelector('.dash-search');
                if (s && s === document.activeElement) { s.value = ''; filterOstan(''); s.blur(); }
            }
        });

        /* ── Column Sorting ── */
        (function() {
            var table = document.getElementById('ostan-table');
            if (!table) return;
            var thead = table.querySelector('thead');
            var tbody = table.querySelector('tbody');
            if (!thead || !tbody) return;

            var headers = thead.querySelectorAll('tr:last-child th');
            var sortCol = -1, sortAsc = true;

            // Map header index to data extraction function
            function getCellText(row, idx) {
                var cells = row.querySelectorAll('td');
                if (idx >= cells.length) return '';
                return (cells[idx].textContent || '').trim();
            }

            function getCellNum(row, idx) {
                var txt = getCellText(row, idx).replace(/[^\d.\-]/g, '');
                var n = parseFloat(txt);
                return isNaN(n) ? -1 : n;
            }

            for (var i = 0; i < headers.length; i++) {
                (function(idx) {
                    headers[idx].addEventListener('click', function() {
                        var rows = Array.prototype.slice.call(tbody.querySelectorAll('tr[data-ostan]'));
                        if (rows.length === 0) return;

                        if (sortCol === idx) { sortAsc = !sortAsc; }
                        else { sortCol = idx; sortAsc = true; }

                        // Determine if column is numeric
                        var isNum = !isNaN(getCellNum(rows[0], idx));

                        rows.sort(function(a, b) {
                            var va, vb;
                            if (isNum) {
                                va = getCellNum(a, idx);
                                vb = getCellNum(b, idx);
                            } else {
                                va = getCellText(a, idx);
                                vb = getCellText(b, idx);
                            }
                            if (va === vb) return 0;
                            if (isNum) return sortAsc ? va - vb : vb - va;
                            return sortAsc ? va.localeCompare(vb, 'fa') : vb.localeCompare(va, 'fa');
                        });

                        // Update header classes
                        for (var h = 0; h < headers.length; h++) {
                            headers[h].classList.remove('sort-asc', 'sort-desc');
                        }
                        headers[idx].classList.add(sortAsc ? 'sort-asc' : 'sort-desc');

                        // Re-insert rows
                        var frag = document.createDocumentFragment();
                        for (var r = 0; r < rows.length; r++) frag.appendChild(rows[r]);
                        tbody.appendChild(frag);

                        // Re-number
                        renumber();
                    });
                })(i);
            }

            function renumber() {
                var rows = tbody.querySelectorAll('tr[data-ostan]');
                for (var i = 0; i < rows.length; i++) {
                    var numCell = rows[i].querySelector('td .row-num');
                    if (numCell) numCell.textContent = i + 1;
                }
            }
        })();
    </script>
</head>
<body>
<div id="load"><div class="loader-spinner"></div></div>

<table class="page-wrap" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td><img src="../files/images/header.jpg" width="100%" height="149" alt=""/></td>
    </tr>
    <tr>
        <td dir="ltr"><?php include('menu.php'); ?></td>
    </tr>
    <tr>
        <td class="page-main">
            <?php include('top.php'); ?>
            <p class="dash-title">داشبورد مدیریتی استان‌های تحت پوشش</p>
            <hr class="dash-divider" />

            <!-- KPI Summary Cards -->
            <div class="kpi-row">
                <div class="kpi">
                    <div class="kpi-icon">🏙️</div>
                    <span>شهرستان</span>
                    <b><?php echo fmt_count($province_totals['city_count']); ?></b>
                </div>
                <div class="kpi">
                    <div class="kpi-icon">📍</div>
                    <span>مرکز</span>
                    <b><?php echo fmt_count($province_totals['mar_count']); ?></b>
                </div>
                <div class="kpi">
                    <div class="kpi-icon">👤</div>
                    <span>کارشناس پهنه</span>
                    <b><?php echo fmt_count($province_totals['mor_count']); ?></b>
                </div>
                <div class="kpi">
                    <div class="kpi-icon">🏢</div>
                    <span>شهر</span>
                    <b><?php echo fmt_count($province_totals['shahr_count']); ?></b>
                </div>
                <div class="kpi">
                    <div class="kpi-icon">🏘️</div>
                    <span>آبادی</span>
                    <b><?php echo fmt_count($province_totals['abadi_count']); ?></b>
                </div>
                <div class="kpi">
                    <div class="kpi-icon">👨‍🌾</div>
                    <span>بهره‌بردار</span>
                    <b><?php echo fmt_count($province_totals['benef_count']); ?></b>
                </div>
            </div>

            <!-- Toolbar -->
            <div class="dash-toolbar">
                <div style="display:flex;align-items:center;gap:8px;flex:1;">
                    <div class="dash-search-wrap">
                        <input type="text" class="dash-search" placeholder="جستجوی استان، نام، شهرستان... (با /)" onkeyup="filterOstan(this.value)" />
                    </div>
                    <span id="ostan-filter-info" class="filter-info"></span>
                </div>
                <div class="export-btns">
                    <form action="provinces_xls.php" method="post">
                        <button type="submit" title="دانلود اکسل">📊 اکسل</button>
                    </form>
                    <form action="provinces_doc.php" method="post">
                        <button type="submit" title="دانلود ورد">📄 ورد</button>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="table-scroll">
            <table id="ostan-table" class="ostan-table">
                <thead>
                    <tr>
                        <th rowspan="2">ردیف</th>
                        <th rowspan="2" class="sortable">استان</th>
                        <th colspan="3">مشخصات رئیس سازمان</th>
                        <th colspan="6">تعداد</th>
                        <th colspan="4">عملیات</th>
                    </tr>
                    <tr>
                        <th>تصویر</th>
                        <th class="sortable">نام</th>
                        <th class="sortable">نام خانوادگی</th>
                        <th class="sortable">شهرستان</th>
                        <th class="sortable">مرکز</th>
                        <th class="sortable">کارشناس پهنه</th>
                        <th class="sortable">شهر</th>
                        <th class="sortable">آبادی</th>
                        <th class="sortable">بهره‌بردار</th>
                        <th>پروفایل</th>
                        <th>عملکرد</th>
                        <th>پیام</th>
                        <th>پیامک</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $r = 1;
                foreach ($provinces as $row) {
                    $id_ostan = $row['id_ostan'];
                    $counts = province_count_row($id_ostan);
                    $pic = $row['pic'] ? $row['pic'] : 'no_pic.png';
                    $pct = isset($update_percents[$id_ostan]) ? $update_percents[$id_ostan] : 0;
                    $has_user = !empty($row['username']);
                    $dis = $has_user ? '' : ' disabled="disabled"';
                    $barColor = pct_color($pct);
                ?>
                    <tr data-ostan="<?php echo htmlspecialchars($row['ostan']); ?>">
                        <td><span class="row-num"><?php echo $r; ?></span></td>
                        <td>
                            <div class="ostan-name"><?php echo htmlspecialchars($row['ostan']); ?></div>
                            <div class="pct-wrap" title="درصد به‌روزرسانی اطلاعات عمومی آبادی‌ها">
                                <span class="pct"><i style="width:<?php echo min(100, max(0, $pct)); ?>%;background:<?php echo $barColor; ?>"></i></span>
                                <?php echo $pct; ?>٪
                            </div>
                        </td>
                        <td>
                            <img class="chief-photo" src="../files/users/<?php echo htmlspecialchars($pic); ?>" width="38" height="44" alt="" loading="lazy" onerror="this.src='../files/users/no_pic.png'" />
                        </td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['Last_name']); ?></td>
                        <td><?php count_button('centers.php', $id_ostan, $row['ostan'], $counts['city_count']); ?></td>
                        <td><?php count_button('ocenters_list.php', $id_ostan, $row['ostan'], $counts['mar_count']); ?></td>
                        <td><?php count_button('ostan_promotes.php', $id_ostan, $row['ostan'], $counts['mor_count']); ?></td>
                        <td><?php count_button('ostan_listscity.php', $id_ostan, $row['ostan'], $counts['shahr_count']); ?></td>
                        <td><?php count_button('ostan_act_abadi.php', $id_ostan, $row['ostan'], $counts['abadi_count']); ?></td>
                        <td><?php count_button('ostan_benef.php', $id_ostan, $row['ostan'], $counts['benef_count']); ?></td>
                        <td class="act-cell">
                            <form action="center_profile1.php#1" method="post" onsubmit="target_popup2(this)">
                                <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                <input type="hidden" name="cod_m" value="<?php echo htmlspecialchars($row['cod_m']); ?>" />
                                <button type="submit" class="icon-btn"<?php echo $dis; ?>><img src="../files/adduser1.jpg" title="مشاهده اطلاعات تکمیلی مروج" width="31" height="30" alt="" /></button>
                            </form>
                        </td>
                        <td class="act-cell">
                            <form action="center_operation1.php#1" method="post" onsubmit="target_popup2(this)">
                                <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                <button type="submit" class="icon-btn"<?php echo $dis; ?>><img src="../files/History.png" title="مشاهده عملکرد مروج در سامانه" width="31" height="30" alt="" /></button>
                            </form>
                        </td>
                        <td class="act-cell">
                            <form action="send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
                                <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                <button type="submit" class="icon-btn"<?php echo $dis; ?>><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" alt="" /></button>
                            </form>
                        </td>
                        <td class="act-cell">
                            <form action="send_sms.php" method="post" onsubmit="target_popup(this)">
                                <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                <input type="hidden" name="tel_m" value="<?php echo htmlspecialchars($row['tel_m']); ?>" />
                                <button type="submit" class="icon-btn"<?php echo $dis; ?>><img src="../files/sms_icon.png" title="ارسال پیامک" width="31" height="31" alt="" /></button>
                            </form>
                        </td>
                    </tr>
                <?php
                    $r++;
                }
                ?>
                </tbody>
                <tfoot>
                    <tr class="total-head">
                        <td colspan="5">جمع کل</td>
                        <td>شهرستان</td>
                        <td>مرکز</td>
                        <td>کارشناس پهنه</td>
                        <td>شهر</td>
                        <td>آبادی</td>
                        <td><a href="bah_rep1.php" style="color:#f1c40f;text-decoration:none;">بهره‌بردار</a></td>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="5">&nbsp;</td>
                        <td><?php echo fmt_count($province_totals['city_count']); ?></td>
                        <td><?php echo fmt_count($province_totals['mar_count']); ?></td>
                        <td><?php echo fmt_count($province_totals['mor_count']); ?></td>
                        <td><?php echo fmt_count($province_totals['shahr_count']); ?></td>
                        <td><?php echo fmt_count($province_totals['abadi_count']); ?></td>
                        <td><?php echo fmt_count($province_totals['benef_count']); ?></td>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                </tfoot>
            </table>
            </div>

            <div id="no-results" class="no-results">نتیجه‌ای یافت نشد</div>

            <a href="index.php" class="go-back" title="برگشت به صفحه قبل">← بازگشت</a>
        </td>
    </tr>
    <tr>
        <td height="109" valign="middle" background="../files/bottom.gif"><?php include('../footer.php'); ?></td>
    </tr>
</table>
</body>
</html>
