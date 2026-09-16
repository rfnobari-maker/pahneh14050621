<?php
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=آمار_مزارع.xls");
include('../../lock_oce.php');
include('../../event.php');
include_once('../../login/config.php'); // اطمینان حاصل کنید که فایل config.php برای اتصال به پایگاه داده موجود است.

if(isset($_POST['sal'])) {
    $sal = $_POST['sal'];
    if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
    else $id_ostan1 = ''; // مقدار پیش فرض
} else {
    // اگر سال یا استان تنظیم نشده باشد، داده‌ای برای نمایش نیست.
    // در محیط واقعی، اینجا می‌توانید یک پیام خطا نمایش دهید یا به صفحه قبلی هدایت کنید.
    exit("No data to generate Excel file. Please select Year and Province/Country.");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <style type="text/css">
        /* این استایل ها مستقیماً بر خروجی اکسل تأثیر نمی‌گذارند اما برای حفظ ساختار اضافه شده‌اند */
        button { border-color:#FFF; }
        .tabel { margin-right:45px; }
        .text_r { margin-right:0px; }
        .style1 { color: #003366; font-family: Tahoma; font-size: 18px; }
        .normalTextSmall { font-size: 12px; font-family: Tahoma; text-align: center; }
        .style8 { font-size: 14px; font-family: Tahoma; }
        .style19 { font-size: 16px; font-family: Tahoma; font-weight: bold; color: white; }
    </style>
</head>
<body>
<?php
// متغیر برای نگهداری نتایج اصلی جدول
$results_for_table = array();
// متغیر برای نگهداری جمع کل نهایی
$grand_total_row = array(
    'unit_count_type1' => 0, 'sum_zamin_type1' => 0,
    'unit_count_type2' => 0, 'sum_zamin_type2' => 0,
    'unit_count_type3' => 0, 'sum_zamin_type3' => 0,
    'total_unit_count' => 0, 'total_sum_zamin' => 0
);

$select_cols = "A.id_ostan, O.ostan";
$join_tables = "LEFT JOIN ostanname O ON A.id_ostan = O.id_ostan";
$group_by_cols = "A.id_ostan, O.ostan";
$order_by_cols = "O.ostan";
$where_clause_ostan = "";
$aquatic_table = "Aquatic"; // جدول پیش فرض

if ($sal > '1403') {
    $aquatic_table = "Aquatic2";
}

if ($id_ostan1 == '') { // حالت "کل کشور"
    $order_by_cols = "FIELD(A.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')";
} else { // حالت "استان خاص" - نمایش شهرستان ها
    $select_cols .= ", A.id_city, C.city";
    $join_tables .= " LEFT JOIN cityname C ON A.id_city = C.id_city AND A.id_ostan = C.id_ostan";
    $group_by_cols .= ", A.id_city, C.city";
    $order_by_cols = "C.city"; // مرتب سازی بر اساس نام شهر
    $where_clause_ostan = " AND A.id_ostan = :id_ostan1_param";
}

$main_query = "
    SELECT
        $select_cols,
        SUM(CASE WHEN A.no_fa = '1' THEN 1 ELSE 0 END) AS unit_count_type1,
        SUM(CASE WHEN A.no_fa = '1' THEN A.m_zamin ELSE 0 END) AS sum_zamin_type1,
        SUM(CASE WHEN A.no_fa = '2' THEN 1 ELSE 0 END) AS unit_count_type2,
        SUM(CASE WHEN A.no_fa = '2' THEN A.m_zamin ELSE 0 END) AS sum_zamin_type2,
        SUM(CASE WHEN A.no_fa = '3' THEN 1 ELSE 0 END) AS unit_count_type3,
        SUM(CASE WHEN A.no_fa = '3' THEN A.m_zamin ELSE 0 END) AS sum_zamin_type3,
        COUNT(A.id) AS total_unit_count,
        SUM(A.m_zamin) AS total_sum_zamin
    FROM
        $aquatic_table A
    $join_tables
    WHERE
        A.sal = :sal
        $where_clause_ostan
    GROUP BY
        $group_by_cols
    ORDER BY
        $order_by_cols;
";

$stmt_main = $dbh->prepare($main_query);
$stmt_main->bindParam(':sal', $sal);
if ($id_ostan1 != '') {
    $stmt_main->bindParam(':id_ostan1_param', $id_ostan1);
}
$stmt_main->execute();
$results_for_table = $stmt_main->fetchAll(PDO::FETCH_ASSOC);

// محاسبه جمع کل نهایی برای ردیف "جمع کل"
foreach ($results_for_table as $row) {
    $grand_total_row['unit_count_type1'] += $row['unit_count_type1'];
    $grand_total_row['sum_zamin_type1'] += $row['sum_zamin_type1'];
    $grand_total_row['unit_count_type2'] += $row['unit_count_type2'];
    $grand_total_row['sum_zamin_type2'] += $row['sum_zamin_type2'];
    $grand_total_row['unit_count_type3'] += $row['unit_count_type3'];
    $grand_total_row['sum_zamin_type3'] += $row['sum_zamin_type3'];
    $grand_total_row['total_unit_count'] += $row['total_unit_count'];
    $grand_total_row['total_sum_zamin'] += $row['total_sum_zamin'];
}

?>
<p align="center">آمار مزارع تکثیر و پرورش آبزیان در سال <?php echo $sal; ?></p>
<table width="85%" height="119" border="1" bordercolor="#00CCFF" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="text1">
        <td height="29" colspan="2" bgcolor="#999999" class="style19">جمع</td>
        <td height="29" colspan="2" bgcolor="#999999" class="style19">تکثیر و پرورش</td>
        <td colspan="2" bgcolor="#999999" class="style19">پرورش</td>
        <td colspan="2" bgcolor="#999999" class="style19">تکثیر</td>
        <td width="13%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ; else echo 'شهرستان' ; ?><br /></td>
        <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
  </tr>
    <tr align="center" class="text1">
        <td width="16%" height="28" bgcolor="#999999">مساحت زمین/<span class="style8">مترمربع</span></td>
        <td width="6%" bgcolor="#999999">تعداد واحد</td>
        <td width="17%" height="28" bgcolor="#999999">مساحت زمین/<span class="style8">مترمربع</span></td>
        <td width="6%" bgcolor="#999999">تعداد واحد</td>
        <td width="14%" bgcolor="#999999">مساحت زمین/<span class="style8">مترمربع</span></td>
        <td width="6%" bgcolor="#999999">تعداد واحد</td>
        <td width="13%" bgcolor="#999999">مساحت زمین/<span class="style8">مترمربع</span></td>
        <td width="5%" bgcolor="#999999">تعداد واحد</td>
    </tr>
    <?php
    $r = 1 ;
    foreach($results_for_table as $row){
    ?>
    <tr>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor="#FFFFCC"' ?>><?php echo $row['total_sum_zamin']; ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor="#FFFFCC"' ?>><?php echo $row['total_unit_count']; ?></td>
        <td align="center" height="31" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor="#FFFFCC"' ?>><?php echo $row['sum_zamin_type3']; ?></td>
        <td align="center" height="31" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor="#FFFFCC"' ?>><?php echo $row['unit_count_type3']; ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor="#FFFFCC"' ?>><?php echo $row['sum_zamin_type2']; ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor="#FFFFCC"' ?>><?php echo $row['unit_count_type2']; ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor="#FFFFCC"' ?>><?php echo $row['sum_zamin_type1']; ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor="#FFFFCC"' ?>><?php echo $row['unit_count_type1']; ?></td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor="#FFFFCC"' ?> >
            <?php if($id_ostan1=='') echo $row['ostan'] ; else echo $row['city'] ; ?>
        </td>
        <td align="center" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor="#FFFFCC"' ?> ><?php echo $r;?></td>
    </tr>
    <?php
    $r++ ;
    }
    ?>
    <tr>
        <td align="center" class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['total_sum_zamin']; ?></td>
        <td align="center" class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['total_unit_count']; ?></td>
        <td align="center" height="29" class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['sum_zamin_type3']; ?></td>
        <td align="center" height="29" class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['unit_count_type3']; ?></td>
        <td align="center" class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['sum_zamin_type2']; ?></td>
        <td align="center" class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['unit_count_type2']; ?></td>
        <td align="center" class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['sum_zamin_type1']; ?></td>
        <td align="center" class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['unit_count_type1']; ?></td>
        <td align="center" colspan="2" bgcolor="#ffcc99"><span class="style19">جمع کل</span></td>
    </tr>
</table>
</body>
</html>