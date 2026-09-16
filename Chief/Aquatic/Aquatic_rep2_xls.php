<?php
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=تولید_مزارع.xls");
include('../../lock_ce.php');
include('../../event.php');
// Assuming ostan_name and city_name1 functions are defined in required files or globally available
// If not, you might need to include or define them.
// Example placeholder functions if they are not external:
/*
function ostan_name($id) {
    // Implement logic to get ostan name by id
    global $dbh;
    $stmt = $dbh->prepare("SELECT ostan FROM ostanname WHERE id_ostan = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['ostan'] : '';
}

function city_name1($city_id, $ostan_id) {
    // Implement logic to get city name by city_id and ostan_id
    global $dbh;
    $stmt = $dbh->prepare("SELECT city FROM cityname WHERE id_city = :city_id AND id_ostan = :ostan_id");
    $stmt->bindParam(':city_id', $city_id);
    $stmt->bindParam(':ostan_id', $ostan_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['city'] : '';
}
*/


if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
else $id_ostan1 = ''; // Default value
if(isset($_POST['sal'])) $sal = $_POST['sal'];
else $sal = date("Y"); // Default current year

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <style type="text/css">
        .tabel { margin-right:45px }
        .text_r { margin-right:0px }
        .style1 {
            color: #003366;
            font-family: Tahoma;
            font-size: 18px;
        }
        .style2 { /* added - based on guess for smaller font */
            font-size: 10px;
        }
        .style8 { /* added - from Aquatic_rep1.php */
            font-size: 14px;
            font-family: Tahoma;
        }
        .style19 { /* added - from Aquatic_rep1.php */
            font-size: 16px;
            font-family: Tahoma;
            font-weight: bold;
            color: white;
        }
        .normalTextSmall { /* added - from Aquatic_rep1.php */
            font-size: 12px;
            font-family: Tahoma;
            text-align: center;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
<?php
if(isset($_POST['action']) || isset($_POST['sal'])) // Check for action or sal to display report
{
    include_once('../../login/config.php');

    $sal = $_POST['sal'];
    $id_ostan1 = $_POST['id_ostan'];

    $results_for_table = array();
    $grand_total_row = array();

    $aquatic_table = "Aquatic"; // Default table

    if ($sal > '1403') {
        $aquatic_table = "Aquatic2";
        // Initialize grand_total_row for Aquatic2 fields
        for ($i = 1; $i <= 10; $i++) {
            $grand_total_row['tak' . $i] = 0;
        }
        for ($i = 1; $i <= 17; $i++) {
            $grand_total_row['par' . $i] = 0;
        }
        $tak_selects = array();
        for ($i = 1; $i <= 10; $i++) {
            $tak_selects[] = "SUM(tak" . $i . ") as tak" . $i;
        }
        $par_selects = array();
        for ($i = 1; $i <= 17; $i++) {
            $par_selects[] = "SUM(par" . $i . ") as par" . $i;
        }
        $sum_cols_select = implode(', ', array_merge($tak_selects, $par_selects));

    } else {
        // Initialize grand_total_row for Aquatic fields
        $grand_total_row = array(
            'tak1' => 0, 'tak2' => 0, 'tak3' => 0, 'tak4' => 0, 'tak5' => 0,
            'par1' => 0, 'par2' => 0, 'par3' => 0, 'par4' => 0
        );
        $sum_cols_select = "
            SUM(tak1) as tak1, SUM(tak2) as tak2, SUM(tak3) as tak3, SUM(tak4) as tak4, SUM(tak5) as tak5,
            SUM(par1) as par1, SUM(par2) as par2, SUM(par3) as par3, SUM(par4) as par4
        ";
    }

    $select_cols = "";
    $join_tables = "";
    $group_by_cols = "";
    $order_by_cols = "";
    $where_clause_ostan = "";

    if ($id_ostan1 == '') { // کل کشور
        $select_cols = "O.ostan, A.id_ostan";
        $join_tables = "LEFT JOIN ostanname O ON A.id_ostan = O.id_ostan";
        $group_by_cols = "A.id_ostan, O.ostan";
        $order_by_cols = "FIELD(A.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')";
    } else { // استان خاص - نمایش شهرستان ها
        $select_cols = "C.city, A.id_city, O.ostan, A.id_ostan";
        $join_tables = "LEFT JOIN ostanname O ON A.id_ostan = O.id_ostan LEFT JOIN cityname C ON A.id_city = C.id_city AND A.id_ostan = C.id_ostan";
        $group_by_cols = "A.id_city, C.city";
        $order_by_cols = "C.city"; // مرتب سازی بر اساس نام شهر
        $where_clause_ostan = " AND A.id_ostan = :id_ostan1_param";
    }

    $main_query = "
        SELECT
            $select_cols,
            $sum_cols_select
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

    // Calculate grand total row
    foreach ($results_for_table as $row) {
        if ($sal > '1403') {
            for ($i = 1; $i <= 10; $i++) {
                $grand_total_row['tak' . $i] += $row['tak' . $i];
            }
            for ($i = 1; $i <= 17; $i++) {
                $grand_total_row['par' . $i] += $row['par' . $i];
            }
        } else {
            $grand_total_row['tak1'] += $row['tak1'];
            $grand_total_row['tak2'] += $row['tak2'];
            $grand_total_row['tak3'] += $row['tak3'];
            $grand_total_row['tak4'] += $row['tak4'];
            $grand_total_row['tak5'] += $row['tak5'];
            $grand_total_row['par1'] += $row['par1'];
            $grand_total_row['par2'] += $row['par2'];
            $grand_total_row['par3'] += $row['par3'];
            $grand_total_row['par4'] += $row['par4'];
        }
    }
?>
<p align="center">گزارش عملکرد تولید مزارع پرورش و تکثیر آبزیان در سال <?php echo $sal?></p>
<table width="99%" height="279" border="1" bordercolor="#00CCFF" align="center" cellpadding="0" cellspacing="0" >
    <?php if ($sal > '1403') { ?>
    <tr align="center" class="text1">
        <td height="25" colspan="17" bgcolor="#999999">پرورش<span class="style2"><br />تن</span><br /></td>
        <td colspan="10" bgcolor="#999999">تکثیر<span class="style2"> <br />هزار قطعه</span><br /></td>
        <td width="14%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?><br /></td>
        <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
    <tr align="center" class="text1">
        <td bgcolor="#999999">پرورش ماهی تیلاپیا<br /></td>
        <td bgcolor="#999999">پرورش ماهی در دریا (قفس)<br /></td>
        <td bgcolor="#999999">پرورش ماهیان خاویاری<br /></td>
        <td bgcolor="#999999">پرورش ماهیان دریایی در استخرهای خاکی<br /></td>
        <td bgcolor="#999999">پرورش ماهیان سردآبی<br /></td>
        <td bgcolor="#999999">پرورش ماهیان گرمابی<br /></td>
        <td bgcolor="#999999">پرورش میگو آب شیرین<br /></td>
        <td bgcolor="#999999">پرورش میگو آب شور<br /></td>
        <td bgcolor="#999999">پرورش شاه میگو<br /></td>
        <td bgcolor="#999999">پرورش در منابع آبی طبیعی و نیمه طبیعی<br /></td>
        <td bgcolor="#999999">ماهیان زینتی<br /></td>
        <td bgcolor="#999999">زالوی طبی<br /></td>
        <td bgcolor="#999999">گیاهان آبزی<br /></td>
        <td bgcolor="#999999">کروکودیل<br /></td>
        <td bgcolor="#999999">صدف<br /></td>
        <td bgcolor="#999999">جلبک (وزن تر)<br /></td>
        <td bgcolor="#999999">سیست و بیومس آرتمیا<br /></td>
        <td bgcolor="#999999">ماهیان گرمابی<br /></td>
        <td bgcolor="#999999">ماهیان دریایی در استخرهای خاکی<br /></td>
        <td bgcolor="#999999">ماهیان خاویاری<br /></td>
        <td bgcolor="#999999">ماهیان سردآبی (قزل آلا)<br /></td>
        <td bgcolor="#999999">منابع آبی طبیعی و نیمه طبیعی<br /></td>
        <td bgcolor="#999999">میگو آب شیرین<br /></td>
        <td bgcolor="#999999">میگو آب شور<br /></td>
        <td bgcolor="#999999">شاه میگو<br /></td>
        <td bgcolor="#999999">ماهیان زینتی<br /></td>
        <td bgcolor="#999999">صدف<br /></td>
    </tr>
    <?php
    $r = 1 ;
    foreach($results_for_table as $row){
    ?>
    <tr>
        <?php for ($i = 1; $i <= 17; $i++) { ?>        
        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par' . $i]?></td>
        <?php } ?>
         <?php for ($i = 1; $i <= 10; $i++) { ?>
        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak' . $i]?></td>
        <?php } ?>
        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> >
            <?php if($id_ostan1=='') echo (isset($row['ostan']) ? $row['ostan'] : '') ;  else echo (isset($row['city']) ? $row['city'] : '')  ; ?>
        </td>
        <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
    <?php
    $r++ ;
    }
    ?>
    <tr>
        <?php for ($i = 1; $i <= 17; $i++) { ?>        
        <td class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['par' . $i]?></td>
        <?php } ?>
         <?php for ($i = 1; $i <= 10; $i++) { ?>
        <td class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak' . $i]?></td>
        <?php } ?>
        <td colspan="2" bgcolor="#ffcc99"><span class="style19">جمع کل</span></td>
    </tr>

    <?php } else { // For سال <= 1403 ?>
    <tr align="center" class="text1">
        <td height="25" colspan="4" bgcolor="#999999">پرورش<span class="style2"><br />تن</span><br /></td>
        <td colspan="5" bgcolor="#999999">تکثیر<span class="style2"> <br />هزار قطعه</span><br /></td>
        <td width="14%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?><br /></td>
        <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
    <tr align="center" class="text1">
        <td bordercolor="#0099CC" bgcolor="#999999">میگو و<br />شاه میگو<br /></td>
        <td bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
        <td bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
        <td bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
        <td height="43" bordercolor="#0099CC" bgcolor="#999999">ماهیان زینتی<br /></td>
        <td bordercolor="#0099CC" bgcolor="#999999">میگو و<br />شاه میگو<br /></td>
        <td bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
        <td bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
        <td bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
    </tr>
    <?php
    $r = 1 ;
    foreach($results_for_table as $row){
    ?>
    <tr>
        <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par4']?></td>
        <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par3']?></td>
        <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par2']?></td>
        <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par1']?></td>
        <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak5']?></td>
        <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak4']?></td>
        <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak3']?></td>
        <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak2']?></td>
        <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak1']?></td>
        <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >
            <?php if($id_ostan1=='') echo (isset($row['ostan']) ? $row['ostan'] : '') ;  else echo (isset($row['city']) ? $row['city'] : '')  ; ?>
        </td>
        <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
    <?php
    $r++ ;
    }
    ?>
    <tr>
        <td class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['par4']?></td>
        <td class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['par3']?></td>
        <td class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['par2']?></td>
        <td class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['par1']?></td>
        <td class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak5']?></td>
        <td class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak4']?></td>
        <td class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak3']?></td>
        <td class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak2']?></td>
        <td class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak1']?></td>
        <td colspan="2" bgcolor="#ffcc99"><span class="style19">جمع کل</span></td>
    </tr>
    <?php } ?>
</table>
<?php }?>
</body>
</html>