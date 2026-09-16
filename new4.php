<?php
// orchard_form.php — PHP 5.3.2 compatible
// Simple CRUD for: Land (زمین) + Orchard Products (محصولات باغی)
// --------------------------------------------------------------
// 1) Fill DB credentials below
// 2) Put this file on your server, visit it; it auto-creates tables if missing
// 3) Add a land and multiple products (client-side + button). Edit/Delete supported.
// --------------------------------------------------------------

// ====== CONFIG ======
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'orchard_db';

// ====== CONNECT ======
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS);
if ($mysqli->connect_errno) { die('DB connection failed: '.$mysqli->connect_error); }
$mysqli->query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
$mysqli->query("CREATE DATABASE IF NOT EXISTS `$DB_NAME` CHARACTER SET utf8 COLLATE utf8_general_ci");
$mysqli->select_db($DB_NAME);

// ====== CREATE TABLES IF NOT EXISTS ======
$mysqli->query("CREATE TABLE IF NOT EXISTS lands (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  land_name VARCHAR(190) NOT NULL,
  province VARCHAR(120) DEFAULT NULL,
  city VARCHAR(120) DEFAULT NULL,
  village VARCHAR(120) DEFAULT NULL,
  area_ha DECIMAL(10,2) DEFAULT NULL,
  irrigation_type VARCHAR(60) DEFAULT NULL,
  notes TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

$mysqli->query("CREATE TABLE IF NOT EXISTS products (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  land_id INT UNSIGNED NOT NULL,
  product_group VARCHAR(120) NOT NULL,
  product_name VARCHAR(160) NOT NULL,
  area_bearing DECIMAL(10,2) DEFAULT 0,
  area_non_bearing DECIMAL(10,2) DEFAULT 0,
  trees_bearing INT DEFAULT 0,
  trees_non_bearing INT DEFAULT 0,
  prod_predicted DECIMAL(12,2) DEFAULT 0,
  prod_actual DECIMAL(12,2) DEFAULT 0,
  FOREIGN KEY (land_id) REFERENCES lands(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

function h($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

// ====== SIMPLE ROUTER ======
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// ====== CREATE/UPDATE HANDLER ======
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_land'])) {
        $land_id = isset($_POST['land_id']) ? intval($_POST['land_id']) : 0;
        $land_name = $mysqli->real_escape_string(trim($_POST['land_name']));
        $province  = $mysqli->real_escape_string(trim($_POST['province']));
        $city      = $mysqli->real_escape_string(trim($_POST['city']));
        $village   = $mysqli->real_escape_string(trim($_POST['village']));
        $area_ha   = isset($_POST['area_ha']) ? floatval(str_replace(',', '', $_POST['area_ha'])) : 0;
        $irrig     = $mysqli->real_escape_string(trim($_POST['irrigation_type']));
        $notes     = $mysqli->real_escape_string(trim($_POST['notes']));

        if ($land_id > 0) {
            $mysqli->query("UPDATE lands SET land_name='$land_name', province='$province', city='$city', village='$village', area_ha=$area_ha, irrigation_type='$irrig', notes='$notes' WHERE id=$land_id");
        } else {
            $mysqli->query("INSERT INTO lands (land_name, province, city, village, area_ha, irrigation_type, notes) VALUES
                ('$land_name', '$province', '$city', '$village', $area_ha, '$irrig', '$notes')");
            $land_id = $mysqli->insert_id;
        }

        // Handle Products arrays
        $p_ids   = isset($_POST['p_id']) ? $_POST['p_id'] : array();
        $pgs     = isset($_POST['product_group']) ? $_POST['product_group'] : array();
        $pnames  = isset($_POST['product_name']) ? $_POST['product_name'] : array();
        $ab      = isset($_POST['area_bearing']) ? $_POST['area_bearing'] : array();
        $anb     = isset($_POST['area_non_bearing']) ? $_POST['area_non_bearing'] : array();
        $tb      = isset($_POST['trees_bearing']) ? $_POST['trees_bearing'] : array();
        $tnb     = isset($_POST['trees_non_bearing']) ? $_POST['trees_non_bearing'] : array();
        $pp      = isset($_POST['prod_predicted']) ? $_POST['prod_predicted'] : array();
        $pa      = isset($_POST['prod_actual']) ? $_POST['prod_actual'] : array();
        $del     = isset($_POST['p_delete']) ? $_POST['p_delete'] : array();

        for ($i = 0; $i < count($pnames); $i++) {
            $pid  = isset($p_ids[$i]) ? intval($p_ids[$i]) : 0;
            $delf = isset($del[$i]) && $del[$i] === '1';
            $pg   = $mysqli->real_escape_string(trim($pgs[$i]));
            $pn   = $mysqli->real_escape_string(trim($pnames[$i]));
            $v_ab = floatval(str_replace(',', '', $ab[$i]));
            $v_an = floatval(str_replace(',', '', $anb[$i]));
            $v_tb = intval($tb[$i]);
            $v_tn = intval($tnb[$i]);
            $v_pp = floatval(str_replace(',', '', $pp[$i]));
            $v_pa = floatval(str_replace(',', '', $pa[$i]));

            if ($pid > 0) {
                if ($delf) {
                    $mysqli->query("DELETE FROM products WHERE id=$pid AND land_id=$land_id");
                } else {
                    // Update
                    $mysqli->query("UPDATE products SET product_group='$pg', product_name='$pn', area_bearing=$v_ab, area_non_bearing=$v_an, trees_bearing=$v_tb, trees_non_bearing=$v_tn, prod_predicted=$v_pp, prod_actual=$v_pa WHERE id=$pid AND land_id=$land_id");
                }
            } else {
                // New row (skip if empty name)
                if ($pn !== '') {
                    $mysqli->query("INSERT INTO products (land_id, product_group, product_name, area_bearing, area_non_bearing, trees_bearing, trees_non_bearing, prod_predicted, prod_actual)
                        VALUES ($land_id, '$pg', '$pn', $v_ab, $v_an, $v_tb, $v_tn, $v_pp, $v_pa)");
                }
            }
        }

        header('Location: ?action=edit&id='.$land_id.'&saved=1');
        exit;
    }
}

// ====== DELETE LAND ======
if ($action === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $mysqli->query("DELETE FROM lands WHERE id=$id");
    header('Location: ?deleted=1');
    exit;
}

// Fetch helpers
function get_land($mysqli, $id){
    $id = intval($id);
    $res = $mysqli->query("SELECT * FROM lands WHERE id=$id");
    return $res ? $res->fetch_assoc() : null;
}
function get_products($mysqli, $land_id){
    $land_id = intval($land_id);
    $rows = array();
    $res = $mysqli->query("SELECT * FROM products WHERE land_id=$land_id ORDER BY id ASC");
    if ($res) { while($r=$res->fetch_assoc()){ $rows[]=$r; } }
    return $rows;
}

// ====== VIEW TEMPLATES ======
function header_html($title){
    echo '<!DOCTYPE html><html lang="fa" dir="rtl"><head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>'.h($title).'</title>';
    echo '<style>
    body{font-family:tahoma,Arial,Helvetica,sans-serif;background:#f7fafc;color:#111;margin:0;padding:20px}
    h1,h2{margin:8px 0}
    .container{max-width:1100px;margin:0 auto}
    .card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;margin:12px 0;box-shadow:0 1px 2px rgba(0,0,0,.03)}
    label{display:block;font-size:14px;margin:8px 0 4px}
    input[type=text], input[type=number], textarea, select{width:100%;padding:8px;border:1px solid #d1d5db;border-radius:8px}
    table{width:100%;border-collapse:collapse;margin-top:8px}
    th,td{border-bottom:1px solid #e5e7eb;padding:8px;text-align:center}
    th{background:#f3f4f6}
    .row-actions button, .btn{padding:8px 12px;border:0;border-radius:8px;cursor:pointer}
    .btn{background:#111;color:#fff}
    .btn.secondary{background:#6b7280}
    .btn.danger{background:#b91c1c}
    .btn.link{background:transparent;color:#2563eb}
    .flex{display:flex;gap:8px;align-items:center}
    .grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
    .grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:10px}
    .tag{display:inline-block;background:#eef2ff;color:#3730a3;border-radius:999px;padding:2px 8px;font-size:12px}
    .muted{color:#6b7280;font-size:12px}
    .success{color:#065f46}
    .danger-t{color:#991b1b}
    </style>';
    echo '</head><body><div class="container">';
}
function footer_html(){
    echo '</div></body></html>';
}

// ====== LIST ======
if ($action === 'list') {
    header_html('مدیریت باغات و محصولات');
    echo '<div class="card"><div class="flex" style="justify-content:space-between">';
    echo '<h1>فهرست زمین‌ها</h1>'; 
    echo '<a class="btn" href="?action=edit">+ زمین جدید</a>';
    echo '</div>';

    if (isset($_GET['deleted'])) echo '<p class="success">زمین حذف شد.</p>';

    $res = $mysqli->query("SELECT l.*, (SELECT COUNT(*) FROM products p WHERE p.land_id=l.id) AS pc FROM lands l ORDER BY id DESC");
    echo '<table><thead><tr><th>#</th><th>نام زمین</th><th>استان/شهر/روستا</th><th>مساحت (هکتار)</th><th>محصولات</th><th>اقدامات</th></tr></thead><tbody>';
    $i=1;
    while($row=$res->fetch_assoc()){
        echo '<tr>';
        echo '<td>'.($i++).'</td>';
        echo '<td>'.h($row['land_name']).'</td>';
        echo '<td>'.h($row['province']).' / '.h($row['city']).' / '.h($row['village']).'</td>';
        echo '<td>'.h($row['area_ha']).'</td>';
        echo '<td><span class="tag">'.intval($row['pc']).'</span></td>';
        echo '<td class="row-actions">'
            .'<a class="btn link" href="?action=edit&id='.intval($row['id']).'">ویرایش</a> '
            .'<a class="btn danger" onclick="return confirm(\'حذف شود؟\')" href="?action=delete&id='.intval($row['id']).'">حذف</a>'
            .'</td>';
        echo '</tr>';
    }
    echo '</tbody></table></div>';
    footer_html();
    exit;
}

// ====== EDIT/CREATE FORM ======
if ($action === 'edit') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $land = $id ? get_land($mysqli, $id) : array('id'=>0,'land_name'=>'','province'=>'','city'=>'','village'=>'','area_ha'=>'','irrigation_type'=>'','notes'=>'');
    $products = $id ? get_products($mysqli, $id) : array();

    header_html($id ? 'ویرایش زمین' : 'زمین جدید');
    if (isset($_GET['saved'])) echo '<p class="success">ذخیره شد.</p>';
    echo '<form method="post" action="">';
    echo '<input type="hidden" name="land_id" value="'.intval($land['id']).'">';

    echo '<div class="card">';
    echo '<h2>مشخصات زمین</h2>';
    echo '<div class="grid">';
    echo '<div><label>نام زمین</label><input type="text" name="land_name" required value="'.h($land['land_name']).'"></div>';
    echo '<div><label>استان</label><input type="text" name="province" value="'.h($land['province']).'"></div>';
    echo '<div><label>شهر</label><input type="text" name="city" value="'.h($land['city']).'"></div>';
    echo '<div><label>روستا</label><input type="text" name="village" value="'.h($land['village']).'"></div>';
    echo '<div><label>مساحت (هکتار)</label><input type="text" name="area_ha" value="'.h($land['area_ha']).'" onkeypress="return filterNumber(event)"></div>';
    echo '<div><label>نوع آبیاری</label><select name="irrigation_type"><option value="">-</option>';
    $opts = array('غرقابی','قطره‌ای','بارانی','باغ باران','سایر');
    foreach($opts as $o){ $sel = ($land['irrigation_type']===$o)?' selected':''; echo '<option'.$sel.'>'.h($o).'</option>'; }
    echo '</select></div>';
    echo '</div>';
    echo '<label>توضیحات</label><textarea name="notes" rows="3">'.h($land['notes']).'</textarea>';
    echo '</div>';

    echo '<div class="card">';
    echo '<div class="flex" style="justify-content:space-between"><h2>محصولات باغی</h2><button type="button" class="btn" onclick="addRow()">+ افزودن محصول</button></div>';

    echo '<table id="productsTbl"><thead><tr>'
        .'<th>گروه</th>'
        .'<th>نام محصول</th>'
        .'<th>سطح زیر کشت بارور (هکتار)</th>'
        .'<th>سطح زیر کشت غیر بارور (هکتار)</th>'
        .'<th>تعداد درخت بارور</th>'
        .'<th>تعداد درخت غیر بارور</th>'
        .'<th>پیش‌بینی تولید (تن)</th>'
        .'<th>تولید قطعی (تن)</th>'
        .'<th>حذف</th>'
        .'</tr></thead><tbody>';

    if (count($products)){
        foreach($products as $p){
            echo product_row_html($p);
        }
    } else {
        echo product_row_html(null); // one empty row
    }

    echo '</tbody></table>';
    echo '</div>';

    echo '<div class="flex" style="justify-content:flex-end;gap:8px">';
    echo '<a class="btn secondary" href="?">بازگشت</a>';
    echo '<button class="btn" name="save_land" value="1" type="submit">ذخیره</button>';
    echo '</div>';

    echo '</form>';

    // JS
    echo '<script>
    function filterNumber(e){ var k=e.which||e.keyCode; if(k===46||k===44) return true; if(k>31&&(k<48||k>57)) return false; return true; }
    function addRow(){
        var tbody = document.querySelector("#productsTbl tbody");
        var temp = document.createElement("tbody");
        temp.innerHTML = '.json_encode(str_replace(array("\n","\r"), '', product_row_html(null))).';
        tbody.appendChild(temp.firstChild.firstChild);
    }
    function markDelete(btn){
        var row = btn.parentNode.parentNode;
        var delInput = row.querySelector("input[name='p_delete[]']");
        if (delInput){
            if (delInput.value==='1'){
                delInput.value='0';
                row.style.opacity='1';
                btn.textContent='حذف';
                btn.className='btn danger';
            } else {
                delInput.value='1';
                row.style.opacity='0.5';
                btn.textContent='لغو حذف';
                btn.className='btn secondary';
            }
        } else {
            // brand-new row: just remove from DOM
            row.parentNode.removeChild(row);
        }
    }
    </script>';

    footer_html();
    exit;
}

// ====== ROW RENDERER ======
function product_row_html($p){
    $isExisting = is_array($p);
    $pid = $isExisting ? intval($p['id']) : 0;
    $group = $isExisting ? $p['product_group'] : '';
    $name = $isExisting ? $p['product_name'] : '';
    $ab = $isExisting ? $p['area_bearing'] : '';
    $an = $isExisting ? $p['area_non_bearing'] : '';
    $tb = $isExisting ? $p['trees_bearing'] : '';
    $tn = $isExisting ? $p['trees_non_bearing'] : '';
    $pp = $isExisting ? $p['prod_predicted'] : '';
    $pa = $isExisting ? $p['prod_actual'] : '';

    $html = '\n<tr>\n'
    .'<td><input type="hidden" name="p_id[]" value="'.($pid).'">'
    .'<input type="text" name="product_group[]" value="'.h($group).'"></td>'
    .'<td><input type="text" name="product_name[]" value="'.h($name).'"></td>'
    .'<td><input type="text" name="area_bearing[]" value="'.h($ab).'" onkeypress="return filterNumber(event)"></td>'
    .'<td><input type="text" name="area_non_bearing[]" value="'.h($an).'" onkeypress="return filterNumber(event)"></td>'
    .'<td><input type="number" name="trees_bearing[]" value="'.h($tb).'" ></td>'
    .'<td><input type="number" name="trees_non_bearing[]" value="'.h($tn).'" ></td>'
    .'<td><input type="text" name="prod_predicted[]" value="'.h($pp).'" onkeypress="return filterNumber(event)"></td>'
    .'<td><input type="text" name="prod_actual[]" value="'.h($pa).'" onkeypress="return filterNumber(event)"></td>'
    .'<td>';

    if ($isExisting) {
        $html .= '<input type="hidden" name="p_delete[]" value="0">'
              .  '<button type="button" class="btn danger" onclick="markDelete(this)">حذف</button>';
    } else {
        $html .= '<button type="button" class="btn danger" onclick="markDelete(this)">حذف</button>';
        $html .= '<input type="hidden" name="p_delete[]" value="0">';
    }

    $html .= '</td></tr>';
    return $html;
}

?>
