<?php 
include('../../lock_oce.php');
include('../../event.php');
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if(isset($_POST['sal'])) $sal = $_POST['sal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    </style>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

-->
</style>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="949" height="188" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      </p>
        <p class="style1">گزارش عملکرد تولید مزارع پرورش و تکثیر آبزیان</p>
        <div style=" width: 400px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1 ; border-radius:10px" >
          <form method="post" name="form1" id="form"  action="#1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="55%" height="68"><div align="right">
                  <select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
                    <?php
// استفاده از $dbh که از config.php می‌آید
$query_ostan = "SELECT id_ostan,ostan FROM ostanname where id_ostan = '$id_ostan' ORDER BY BINARY ostan";
$stmt_ostan = $dbh->prepare($query_ostan);
$stmt_ostan->execute();
foreach($stmt_ostan as $row_ostan){
?>
                    <option value="<?php echo $row_ostan['id_ostan'] ;?>"
                   <?php if ($row_ostan['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row_ostan['ostan'] ;?></option>
                    <?php
                       }?>
                  </select>
                </div></td>
                <td width="45%" class="style8">:  استان مورد نظر</td>
              </tr>
              <tr>
                <td height="68"><div align="right">
                  <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
                    <option value="1405"<?php if ($sal=='1405') echo 'selected=selected'?>>1405</option>
                    <option value="1404"<?php if ($sal=='1404') echo 'selected=selected'?>>1404</option>
                    <option value="1403"<?php if ($sal=='1403') echo 'selected=selected'?>>1403</option>
                    <option value="1402"<?php if ($sal=='1402') echo 'selected=selected'?>>1402</option>
                    <option value="1401"<?php if ($sal=='1401') echo 'selected=selected'?>>1401</option>
                    <option value="1400"<?php if ($sal=='1400') echo 'selected=selected'?>>1400</option>
                    <option value="1399"<?php if ($sal=='1399') echo 'selected=selected'?>>1399</option>
                    <option value="1398"<?php if ($sal=='1398') echo 'selected=selected'?>>1398</option>
                    <option value="1397"<?php if ($sal=='1397') echo 'selected=selected'?>>1397</option>
                  </select>
                </div></td>
                <td class="style8"> : سال </td>
              </tr>
            </table>
            <p>
              <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
            </p>
          </form>
      </div>
        <p>
  <?php if(isset($_POST['action']) && isset($_POST['sal']))
{
    $sal = $_POST['sal'];
    $id_ostan1 = $_POST['id_ostan'];

    // متغیر برای نگهداری نتایج اصلی جدول
    $results_for_table = array();
    // متغیر برای نگهداری جمع کل نهایی
    $grand_total_row = array();

    // تعیین فیلدهای tak و par بر اساس سال
    if ($sal > '1403') {
        for ($i = 1; $i <= 10; $i++) {
            $grand_total_row['tak' . $i] = 0;
        }
        for ($i = 1; $i <= 17; $i++) {
            $grand_total_row['par' . $i] = 0;
        }
    } else {
        $grand_total_row = array(
            'tak1' => 0, 'tak2' => 0, 'tak3' => 0, 'tak4' => 0, 'tak5' => 0,
            'par1' => 0, 'par2' => 0, 'par3' => 0, 'par4' => 0
        );
    }


    $select_cols = "O.ostan, A.id_ostan";
    $join_tables = "LEFT JOIN ostanname O ON A.id_ostan = O.id_ostan";
    $group_by_cols = "A.id_ostan, O.ostan";
    $order_by_cols = "O.ostan";
    $where_clause_ostan = "";
    $aquatic_table = "Aquatic"; // جدول پیش فرض

    if ($sal > '1403') {
        $aquatic_table = "Aquatic2";
        // توسعه فیلدهای SELECT برای Aquatic2
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
        $sum_cols_select = "
            SUM(tak1) as tak1, SUM(tak2) as tak2, SUM(tak3) as tak3, SUM(tak4) as tak4, SUM(tak5) as tak5,
            SUM(par1) as par1, SUM(par2) as par2, SUM(par3) as par3, SUM(par4) as par4
        ";
    }

    if ($id_ostan1 == '') { // حالت "کل کشور"
        $order_by_cols = "FIELD(A.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')";
    } else { // حالت "استان خاص" - نمایش شهرستان ها
        $select_cols .= ", C.city, A.id_city";
        $join_tables .= " LEFT JOIN cityname C ON A.id_city = C.id_city AND A.id_ostan = C.id_ostan";
        $group_by_cols .= ", A.id_city, C.city";
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

    // محاسبه جمع کل نهایی برای ردیف "جمع کل"
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
        <span class="style21"><a name="1" id="1"></a></span>
        <table width="69" height="56" border="0" align="center">
          <tr>
            <td width="63"><form  action="Aquatic_rep2_xls.php" method="post">
              <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
              <input type="hidden" name="sal" value="<?php echo  $sal ;?>" />
              <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
            </form></td>
          </tr>
        </table>
      <table width="90%" align="center" class="my-table"  >
             <?php if ($sal > '1403') { ?>
             <tr align="center" class="text1">
               <td height="25" colspan="17" bgcolor="#999999">پرورش<span class="style2"><br />
                تن</span><br /></td>
               <td colspan="10" bgcolor="#999999">تکثیر<span class="style2"> <br />
                هزار قطعه</span><br /></td>
               <td width="14%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?><br /></td>
                <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
            </tr>
             <tr align="center" class="text1">
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">پرورش ماهی تیلاپیا<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">پرورش ماهی در دریا (قفس)<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">پرورش ماهیان خاویاری<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">پرورش ماهیان دریایی در استخرهای خاکی<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">پرورش ماهیان سردآبی<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">پرورش ماهیان گرمابی<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">پرورش میگو آب شیرین<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">پرورش میگو آب شور<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">پرورش شاه میگو<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">پرورش در منابع آبی طبیعی و نیمه طبیعی<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">ماهیان زینتی<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">زالوی طبی<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">گیاهان آبزی<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">کروکودیل<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">صدف<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">جلبک (وزن تر)<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">سیست و بیومس آرتمیا<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">ماهیان گرمابی<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">ماهیان دریایی در استخرهای خاکی<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">ماهیان سردآبی (قزل آلا)<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">منابع آبی طبیعی و نیمه طبیعی<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">میگو آب شیرین<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">میگو آب شور<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">شاه میگو<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">ماهیان زینتی<br /></td>
               <td width="5%" bordercolor="#0099CC" bgcolor="#999999">صدف<br /></td>
              </tr>
             <?php
$r = 1 ;
  foreach($results_for_table as $row){
 ?>
             <tr>
               <?php for ($i = 1; $i <= 17; $i++) { ?>
               <td height="47" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par' . $i]?></td>
               <?php } ?>
               <?php for ($i = 1; $i <= 10; $i++) { ?>
               <td height="47" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak' . $i]?></td>
               <?php } ?>
               <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> >
                 <?php if($id_ostan1=='') echo $row['ostan'] ;  else echo $row['city']  ; ?>
               <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ;
}
?>
             <tr>
               <?php for ($i = 1; $i <= 17; $i++) { ?>
               <td height="47" class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['par' . $i]?></td>
               <?php } ?>
               <?php for ($i = 1; $i <= 10; $i++) { ?>
               <td height="47" class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak' . $i]?></td>
               <?php } ?>
               <td colspan="2" bgcolor="#ffcc99"><span class="style19">جمع کل</span></td>
             </tr>

             <?php } else { ?>
             <tr align="center" class="text1">
               <td height="25" colspan="4" bgcolor="#999999">پرورش<span class="style2"><br />
                تن</span><br /></td>
               <td colspan="5" bgcolor="#999999">تکثیر<span class="style2"> <br />
                هزار قطعه</span><br /></td>
               <td width="14%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?><br /></td>
                <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
            </tr>
             <tr align="center" class="text1">
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">میگو و<br />
                 شاه میگو<br /></td>
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
               <td width="11%" bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
               <td width="10%" height="43" bordercolor="#0099CC" bgcolor="#999999">ماهیان زینتی<br /></td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">میگو و<br />
                شاه میگو<br /></td>
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
               <td width="10%" bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
              </tr>
             <?php
$r = 1 ;
  foreach($results_for_table as $row){
 ?>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par4']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par3']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par2']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par1']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak5']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak4']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak3']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak2']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak1']?></td>
               <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >
                 <?php if($id_ostan1=='') echo $row['ostan'] ;  else echo $row['city']  ; ?>
               <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ;
}
?>
             <tr>
               <td height="47"  class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['par4']?></td>
               <td height="47"  class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['par3']?></td>
               <td height="47"  class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['par2']?></td>
               <td height="47"  class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['par1']?></td>
               <td height="47"  class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak5']?></td>
               <td height="47"  class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak4']?></td>
               <td height="47"  class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak3']?></td>
               <td height="47"  class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak2']?></td>
               <td height="47"  class="normalTextSmall" bgcolor="#ffcc99"><?php echo $grand_total_row['tak1']?></td>
               <td colspan="2"   bgcolor="#ffcc99"><span class="style19">جمع کل</span></td>
             </tr>
             <?php } ?>
         </table>
<?php }?>
       <p>&nbsp;</p>
       <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>