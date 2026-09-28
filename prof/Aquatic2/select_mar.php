<?php
include('../../login/config.php');

function aquatic_js_str($v)
{
    if (!isset($v) || $v === null) {
        $v = '';
    }
    return json_encode($v . '', JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}

function aquatic_gender_options($jens)
{
    $jens = isset($jens) ? (string) $jens : '';
    $out = '';
    $out .= '<option value="1"' . ($jens === '1' ? ' selected="selected"' : '') . '>مرد</option>';
    $out .= '<option value="2"' . ($jens === '2' ? ' selected="selected"' : '') . '>زن</option>';
    return $out;
}

$cod_m = isset($_POST['cod_m']) ? $_POST['cod_m'] : '';
if ($cod_m === '') {
    exit;
}

$query = "SELECT m_name, m_last_name, m_tel_m, m_fname, m_addres, m_jens FROM malek WHERE m_cod_m = :cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':cod_m' => $cod_m));
if ($stmt->rowCount() <> 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $jens = isset($row['m_jens']) ? $row['m_jens'] : '';
    ?>
<script>
(function () {
    var el;
    el = document.getElementById('m_name'); if (el) el.value = <?php echo aquatic_js_str($row['m_name']); ?>;
    el = document.getElementById('m_last_name'); if (el) el.value = <?php echo aquatic_js_str($row['m_last_name']); ?>;
    el = document.getElementById('m_fname'); if (el) el.value = <?php echo aquatic_js_str($row['m_fname']); ?>;
    el = document.getElementById('m_tel_m'); if (el) el.value = <?php echo aquatic_js_str($row['m_tel_m']); ?>;
    el = document.getElementById('m_addres'); if (el) el.value = <?php echo aquatic_js_str($row['m_addres']); ?>;
})();
</script>
<?php
    echo aquatic_gender_options($jens);
    exit;
}

$query = "SELECT name, last_name, tel_m, fname, jens FROM bah WHERE bah_cod_m = :cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':cod_m' => $cod_m));
if ($stmt->rowCount() == 0) {
    echo 'اطلاعات مالک یافت نشد ';
    echo '<option value="">انتخاب کنید</option>';
    echo '<option value="1">مرد</option>';
    echo '<option value="2">زن</option>';
    exit;
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);
$jens = isset($row['jens']) ? $row['jens'] : '';
?>
<script>
(function () {
    var el;
    el = document.getElementById('m_name'); if (el) el.value = <?php echo aquatic_js_str($row['name']); ?>;
    el = document.getElementById('m_last_name'); if (el) el.value = <?php echo aquatic_js_str($row['last_name']); ?>;
    el = document.getElementById('m_fname'); if (el) el.value = <?php echo aquatic_js_str($row['fname']); ?>;
    el = document.getElementById('m_tel_m'); if (el) el.value = <?php echo aquatic_js_str($row['tel_m']); ?>;
})();
</script>
<?php
echo aquatic_gender_options($jens);
