<?php
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=supplies_d_list.xls");
include('../../../lock_ce.php');
include('../../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city1 = $_POST['id_city'] ;
 $id_select_city  = $_POST['id_select_city'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
<?php
include ('../../../login/config.php');
?>
    <?php 
if ($id_ostan1 == '-1'){ $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
if ($id_city1 == 0){ $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city1'" ;}
$query = "SELECT * FROM  promo_cent_supplies where  $v_id_ostan and  $v_id_city order by id_ostan,id_city,id_mar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
    <span class="style21"><a name="1" id="1"></a></span></p>
  <br />
  <table width="95%" height="74" border="0" align="center" cellpadding="0" cellspacing="2" >
    <tr align="center" class="text1">
      <td height="45" bgcolor="#999999">تاریخ ثبت</td>
      <td width="6%" bordercolor="#FFFFFF" bgcolor="#999999">تعداد</td>
      <td width="10%" bordercolor="#FFFFFF" bgcolor="#999999">سال<br />
        ساخت / خرید</td>
      <td width="18%" bordercolor="#FFFFFF" bgcolor="#999999">مدل</td>
      <td width="18%" bordercolor="#FFFFFF" bgcolor="#999999">نوع تجهیزات</td>
      <td width="7%" bordercolor="#FFFFFF" bgcolor="#999999">کد مرکز</td>
      <td width="11%" bgcolor="#999999">مرکز جهاد کشاورزی</td>
      <td width="8%" bgcolor="#999999">شهرستان</td>
      <td width="10%" bgcolor="#999999">استان</td>
      <td width="4%" bgcolor="#999999">ردیف</td>
      
    </tr>
             <tr>
               
  <?php
$r = 1 ;
foreach($stmt as $row){
$id_city = $row['id_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_mar = $row['id_mar'] ;
if ($row['no_taj']=='18') $v_no_taj ='میز' ;
if ($row['no_taj']=='19') $v_no_taj ='صندلی';
if ($row['no_taj']=='1') $v_no_taj ='رایانه' ;
if ($row['no_taj']=='2') $v_no_taj ='لب تاپ';
if ($row['no_taj']=='3') $v_no_taj ='GPS';
if ($row['no_taj']=='4') $v_no_taj ='دوربین دیجیتالی';
if ($row['no_taj']=='5') $v_no_taj ='دستگاه فاکس';
if ($row['no_taj']=='6') $v_no_taj ='دستگاه کپی';
if ($row['no_taj']=='7') $v_no_taj ='ویدئو پروژکتور';
if ($row['no_taj']=='8') $v_no_taj ='اینترنت';
if ($row['no_taj']=='9') $v_no_taj ='اسکنر';
if ($row['no_taj']=='10') $v_no_taj ='چاپگر';
if ($row['no_taj']=='11') $v_no_taj ='پرده نمایش';
if ($row['no_taj']=='12') $v_no_taj ='تلویزیون';
if ($row['no_taj']=='13') $v_no_taj ='تابلو اعلانات ترویجی';
if ($row['no_taj']=='14') $v_no_taj ='آرشیو رسانه های ترویجی';
if ($row['no_taj']=='15') $v_no_taj ='خودرو';
if ($row['no_taj']=='16') $v_no_taj ='تراکتور';
if ($row['no_taj']=='17') $v_no_taj ='سمپاش';


?>
  <td align="center" width="8%" height="23"  class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['date_s'];?></span></td>
               <td align="center"bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['num'];?></td>
               <td align="center"bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['y_make'];?></td>
               <td align="center"bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['model'];?></td>
               <td align="center"bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $v_no_taj ;?></span></td>
               <td align="center"bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $row['id_mar'];?></span></td>
               <td align="center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo mar_name($row['id_mar']) ;?></td>
               <td align="center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']);?></td>
               <td align="center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo ostan_name($row['id_ostan']);?></td>
               <td align="center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
<?php
$r++ ; 
 }
?>
</table>
  <br />
  <p>&nbsp;</p>

</body>
</html>