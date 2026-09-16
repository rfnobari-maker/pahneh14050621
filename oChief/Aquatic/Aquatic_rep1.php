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
        <p class="style1">آمار مزارع پرورش و تکثیر آبزیان</p>
        <div style=" width: 400px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1 ; border-radius:10px" >
          <form method="post" name="form1" id="form"  action="#1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="55%" height="68"><div align="right">
                  <select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
                    <?php
                    // کوئری برای لیست استان ها
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

    if ($id_ostan1 == '') { // حالت "کل کشور"
        $order_by_cols = "FIELD(A.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')";
    } else { // حالت "استان خاص" - نمایش شهرستان ها
        $select_cols .= ", A.id_city, C.city";
        $join_tables .= " LEFT JOIN cityname C ON A.id_city = C.id_city AND A.id_ostan = C.id_ostan";
        $group_by_cols .= ", A.id_city, C.city";
        $order_by_cols = "C.city"; // مرتب سازی بر اساس نام شهر
        $where_clause_ostan = " AND A.id_ostan = :id_ostan1_param";
    }

    if($sal > '1403')
	{
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
            Aquatic2 A
        $join_tables
        WHERE
            A.sal = :sal
            $where_clause_ostan
        GROUP BY
            $group_by_cols
        ORDER BY
            $order_by_cols;
    ";
	}
	else
	{
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
            Aquatic A
        $join_tables
        WHERE
            A.sal = :sal
            $where_clause_ostan
        GROUP BY
            $group_by_cols
        ORDER BY
            $order_by_cols;
    ";
		}
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
        <span class="style21"><a name="1" id="1"></a></span>
        <table width="69" height="56" border="0" align="center">
          <tr>
            <td width="63"><form  action="Aquatic_rep1_xls.php" method="post">
              <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
              <input type="hidden" name="sal" value="<?php echo  $sal ;?>" />
              <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
            </form></td>
            </tr>
        </table>
        <table  bordercolor="#00CCFF" align="center" class="my-table" >
             <tr align="center" class="text1">
               <td height="45" colspan="2" bgcolor="#999999" class="style19">جمع</td>
               <td height="45" colspan="2" bgcolor="#999999" class="style19">تکثیر و پرورش</td>
               <td colspan="2" bgcolor="#999999" class="style19">پرورش</td>
               <td colspan="2" bgcolor="#999999" class="style19">تکثیر</td>
               <td width="13%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?><br /></td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td width="16%" height="67" bgcolor="#999999">مساحت زمین<br />
                 <span class="style8">مترمربع</span></td>
               <td width="6%" bgcolor="#999999">تعداد واحد</td>
               <td width="17%" height="67" bgcolor="#999999">مساحت زمین<br />
                 <span class="style8">مترمربع</span></td>
               <td width="6%" bgcolor="#999999">تعداد واحد</td>
               <td width="14%" bgcolor="#999999">مساحت زمین<br />
                 <span class="style8">مترمربع</span></td>
               <td width="6%" bgcolor="#999999">تعداد واحد</td>
               <td width="13%" bgcolor="#999999">مساحت زمین<br />
                <span class="style8">مترمربع</span></td>
               <td width="5%" bgcolor="#999999">تعداد واحد</td>
             </tr>
             <?php
$r = 1 ;
  foreach($results_for_table as $row){
 ?>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo $row['total_sum_zamin'] ; ?></td>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo $row['total_unit_count'] ; ?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo $row['sum_zamin_type3'] ; ?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo $row['unit_count_type3'] ; ?></td>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo $row['sum_zamin_type2'] ; ?></td>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo $row['unit_count_type2'] ; ?></td>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall">
                 <?php  echo $row['sum_zamin_type1'] ; ?>
               </span></td>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall">
                <?php  echo $row['unit_count_type1'] ; ?>
               </span></td>
               <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >
                 <?php if($id_ostan1=='') echo $row['ostan'] ;  else echo $row['city']  ; ?>
               <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ;
}

?>
  <tr>
    <td  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo $grand_total_row['total_sum_zamin'] ; ?></td>
    <td  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo $grand_total_row['total_unit_count'] ; ?></td>
    <td height="46"  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo $grand_total_row['sum_zamin_type3'] ; ?></td>
    <td height="46"  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo $grand_total_row['unit_count_type3'] ; ?></td>
    <td  class="normalTextSmall" <?php  echo 'bgcolor=#ffcc99' ?>><?php  echo $grand_total_row['sum_zamin_type2'] ; ?></td>
    <td  class="normalTextSmall" <?php  echo 'bgcolor=#ffcc99' ?>><?php  echo $grand_total_row['unit_count_type2'] ; ?></td>
    <td  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><span class="normalTextSmall">
      <?php  echo $grand_total_row['sum_zamin_type1'] ; ?>
    </span></td>
    <td  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><span class="normalTextSmall">
      <?php  echo $grand_total_row['unit_count_type1'] ; ?>
    </span></td>
    <td colspan="2"   <?php  echo 'bgcolor=#ffcc99' ?>><span class="style19">جمع کل</span></td>
  </tr>
        </table>
  <?php }?>
        </table>
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
