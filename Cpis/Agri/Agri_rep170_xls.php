<?php

// Require the necessary classes from the 'src' folder.
// This is the manual way of including the files.
// Please make sure the paths are correct based on where you placed the 'src' folder.
require '../../src/PhpSpreadsheet/Spreadsheet.php';
require '../../src/PhpSpreadsheet/Writer/Xlsx.php';
require '../../src/PhpSpreadsheet/Writer/Xls.php';
require '../../src/PhpSpreadsheet/IOFactory.php'; // Required for loading old format files if needed

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

// --- 1. Process user inputs ---
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
// ... (Your remaining input variables, no changes needed here)
$id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$m_ab = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
$no_ab = isset($_POST['no_ab']) ? $_POST['no_ab'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$zka1 = isset($_POST['zka1']) ? $_POST['zka1'] : '';
$zka2 = isset($_POST['zka2']) ? $_POST['zka2'] : '';
$zkb1 = isset($_POST['zkb1']) ? $_POST['zkb1'] : '';
$zkb2 = isset($_POST['zkb2']) ? $_POST['zkb2'] : '';
$mtol1 = isset($_POST['mtol1']) ? $_POST['mtol1'] : '';
$mtol2 = isset($_POST['mtol2']) ? $_POST['mtol2'] : '';
$sba1 = isset($_POST['sba1']) ? $_POST['sba1'] : '';
$sba2 = isset($_POST['sba2']) ? $_POST['sba2'] : '';
$sbb1 = isset($_POST['sbb1']) ? $_POST['sbb1'] : '';
$sbb2 = isset($_POST['sbb2']) ? $_POST['sbb2'] : '';
$mtolp1 = isset($_POST['mtolp1']) ? $_POST['mtolp1'] : '';
$mtolp2 = isset($_POST['mtolp2']) ? $_POST['mtolp2'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
$mah_kh = isset($_POST['mah_kh']) ? $_POST['mah_kh'] : '';
$mah_bem = isset($_POST['mah_bem']) ? $_POST['mah_bem'] : '';
$date_s1 = isset($_POST['date_s1']) ? $_POST['date_s1'] : '';
$date_s2 = isset($_POST['date_s2']) ? $_POST['date_s2'] : '';

$Agri_table = 'Agri' . str_replace('-', '_', $z_sal);
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

// --- 2. Build the WHERE clause for the SQL query ---
$conditions = array();
if ($id_ostan1 != '-1') {
    $conditions[] = "$Agri_prod_table.id_ostan='$id_ostan1'";
}
if (!empty($id_city)) {
    $conditions[] = "$Agri_prod_table.id_city='$id_city'";
}
if (!empty($id_mar)) {
    $conditions[] = "$Agri_prod_table.id_mar='$id_mar'";
}
if (!empty($add_abadi)) {
    $conditions[] = "$Agri_prod_table.add_abadi = '$add_abadi'";
}
if (!empty($add_city)) {
    $conditions[] = "$Agri_prod_table.add_city = '$add_city'";
}
if (!empty($no_kesh)) {
    $conditions[] = "$Agri_prod_table.no_kesh = '$no_kesh'";
}
if (!empty($m_ab)) {
    $conditions[] = "$Agri_table.m_ab = '$m_ab'";
}
if (!empty($no_ab)) {
    $conditions[] = "$Agri_table.no_ab = '$no_ab'";
}
if (!empty($mor_cod_m)) {
    $conditions[] = "$Agri_prod_table.mor_cod_m = '$mor_cod_m'";
}
if (!empty($bah_cod_m)) {
    $conditions[] = "$Agri_prod_table.bah_cod_m = '$bah_cod_m'";
}
if (!empty($mah_name)) {
    $conditions[] = "$Agri_prod_table.cod_mah = '$mah_name'";
}
if (!empty($zka1)) {
    $conditions[] = "$Agri_prod_table.zer_kesht_a >= $zka1";
}
if (!empty($zka2)) {
    $conditions[] = "$Agri_prod_table.zer_kesht_a <= $zka2";
}
if (!empty($zkb1)) {
    $conditions[] = "$Agri_prod_table.zer_kesht_b >= $zkb1";
}
if (!empty($zkb2)) {
    $conditions[] = "$Agri_prod_table.zer_kesht_b <= $zkb2";
}
if (!empty($sba1)) {
    $conditions[] = "$Agri_prod_table.s_bar_a >= $sba1";
}
if (!empty($sba2)) {
    $conditions[] = "$Agri_prod_table.s_bar_a <= $sba2";
}
if (!empty($sbb1)) {
    $conditions[] = "$Agri_prod_table.s_bar_b >= $sbb1";
}
if (!empty($sbb2)) {
    $conditions[] = "$Agri_prod_table.s_bar_b <= $sbb2";
}
if (!empty($mtol1)) {
    $conditions[] = "$Agri_prod_table.mah_tol >= $mtol1";
}
if (!empty($mtol2)) {
    $conditions[] = "$Agri_prod_table.mah_tol <= $mtol2";
}
if (!empty($mtolp1)) {
    $conditions[] = "$Agri_prod_table.mah_tolp >= $mtolp1";
}
if (!empty($mtolp2)) {
    $conditions[] = "$Agri_prod_table.mah_tolp <= $mtolp2";
}
if (!empty($mah_kh)) {
    $conditions[] = "$Agri_prod_table.mah_kh = '$mah_kh'";
}
if (!empty($mah_bem)) {
    $conditions[] = "$Agri_prod_table.mah_bem = '$mah_bem'";
}
if (!empty($date_s1)) {
    $conditions[] = "$Agri_prod_table.date_s >= '$date_s1'";
}
if (!empty($date_s2)) {
    $conditions[] = "$Agri_prod_table.date_s <= '$date_s2'";
}

$where_clause = implode(' AND ', $conditions);
if (!empty($where_clause)) {
    $where_clause = "WHERE " . $where_clause;
}

// --- 3. Database connection and query ---
include_once('../../login/config.php');
include_once('../../event.php'); // Your helper functions

$query = "SELECT $Agri_prod_table.*, $Agri_table.m_ab, $Agri_table.no_ab, $Agri_table.no_mal, $Agri_table.m_cod_m 
          FROM $Agri_prod_table
          INNER JOIN $Agri_table ON $Agri_table.id = $Agri_prod_table.Agri_id
          $where_clause
          ORDER BY bah_cod_m ASC";

$stmt = $dbh->prepare($query);
$stmt->execute();
$rowCount = $stmt->rowCount();

if ($rowCount == 0) {
    exit('<p style="text-align: center; font-family: Tahoma;">اطلاعاتی یافت نشد</p>');
}

// --- 4. Create a new Spreadsheet and set headers ---
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('گزارش اطلاعات زراعی');
$sheet->setRightToLeft(true); // Enable Right-to-Left for Persian text

// --- 5. Define and write the header row ---
$header = array(
    'ردیف', 'استان', 'شهرستان', 'مرکز', 'تاریخ ثبت / ویرایش', 'آدرس آماری شهر', 'نام شهر',
    'آدرس آماری آبادی', 'نام آبادی', 'نام و نام خانوادگی بهره بردار', 'کد ملی بهره بردار', 'همراه بهره بردار',
    'نوع کشت', 'سطح زیر کشت اول / هکتار', 'سطح زیر کشت مجدد / هکتار', 'کل سطح زیر کشت /هکتار',
    'سطح برداشت کشت اول/ هکتار', 'سطح برداشت کشت مجدد / هکتار', 'کل سطح برداشت هکتار',
    'نام محصول', 'پیش بینی تولید /تن', 'میزان تولید / تن', 'بیمه', 'خسارت', 'نوع مالکیت',
    'کد ملی مالک', 'نام و نام خانوادگی مالک', 'نام مروج', 'کد ملی مروج', 'همراه مروج'
);
$sheet->fromArray($header, NULL, 'A1');

// --- 6. Write data rows from the database query ---
$rowCounter = 2;
$recordNumber = 1;

foreach ($stmt as $rowData) {
    $v_no_kesh = ($rowData['no_kesh'] == '1') ? 'آبی' : 'دیم';
    $v_mah_bem = ($rowData['mah_bem'] == '1') ? 'هست' : 'نیست';
    $v_mah_kh = ($rowData['mah_kh'] == '1') ? 'دیده' : 'ندیده';
    $v_no_mal = '';
    switch ($rowData['no_mal']) {
        case '1': $v_no_mal = 'سند ششدانگ'; break;
        case '2': $v_no_mal = 'سند مشاعی'; break;
        case '3': $v_no_mal = 'اصلاحات اراضی'; break;
        case '4': $v_no_mal = 'موقوفه'; break;
        case '5': $v_no_mal = 'واگذاری'; break;
        case '6': $v_no_mal = 'قولنامه'; break;
        case '7': $v_no_mal = 'اجاره'; break;
    }
    $m_name = ($rowData['bah_cod_m'] == $rowData['m_cod_m']) ? bah_name($rowData['bah_cod_m']) : m_name($rowData['m_cod_m']);
    
    $excelRow = array(
        $recordNumber,
        ostan_name($rowData['id_ostan']),
        city_name1($rowData['id_city'], $rowData['id_ostan']),
        mar_name($rowData['id_mar']),
        $rowData['date_s'],
        $rowData['add_city'],
        shahr_name($rowData['add_city']),
        $rowData['add_abadi'],
        abadi_name($rowData['add_abadi']),
        bah_name($rowData['bah_cod_m']),
        $rowData['bah_cod_m'],
        bah_tel_m($rowData['bah_cod_m']),
        $v_no_kesh,
        (float)$rowData['zer_kesht_a'],
        (float)$rowData['zer_kesht_b'],
        (float)$rowData['zer_kesht_a'] + (float)$rowData['zer_kesht_b'],
        (float)$rowData['s_bar_a'],
        (float)$rowData['s_bar_b'],
        (float)$rowData['s_bar_a'] + (float)$rowData['s_bar_b'],
        mah_name($rowData['cod_mah']),
        round((float)$rowData['mah_tolp'], 3),
        round((float)$rowData['mah_tol'], 3),
        $v_mah_bem,
        $v_mah_kh,
        $v_no_mal,
        $rowData['m_cod_m'],
        $m_name,
        user_name1($rowData['mor_cod_m']),
        $rowData['mor_cod_m'],
        user_tel($rowData['mor_cod_m'])
    );

    $sheet->fromArray($excelRow, NULL, 'A' . $rowCounter);

    $rowCounter++;
    $recordNumber++;
}

// --- 7. Set the file format and save the file ---
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="گزارش_ویژه_زراعی.xlsx"');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;