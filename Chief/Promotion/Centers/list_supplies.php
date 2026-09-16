<?php
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
            <td><img src="../../../files/images/header.jpg" width="949" height="149" /></td>
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
  <p>
    <?php 
include('top.php'); 
include ('../../../login/config.php');
?>
  </p>
  <p class="style1"> اطلاعات ملزومات مراکز جهاد کشاورزی </p>
  <p><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
    <?php 
// $id_ostan = $_POST['id_ostan'] ; 
// $id_city = $_POST['id_city'] ; 
if ($id_ostan1 == '-1'){ $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
if ($id_city1 == 0){ $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city1'" ;}
$query = "SELECT * FROM  promo_cent_supplies where  $v_id_ostan and  $v_id_city order by id_ostan,id_city,id_mar "  ;
//echo  $query = "SELECT * FROM  public_abadi4 where  $v_id_ostan and  $v_id_city and $v_id_mar  and $v_add_deh  "  ;

$stmt = $dbh->prepare($query);
$stmt->execute();
?>
    <span class="style21"><a name="1" id="1"></a></span></p>
  <table width="200" height="56" border="0" align="center">
    <tr>
      <td bgcolor="#FFFFCC"><form  action="list_supplies_d_xls.php" method="post">
        جزئیات
            <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
        <button><img src="../../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="41" height="42"  alt=""/></button>
      </form></td>
      <td><form  action="list_supplies_xls.php" method="post">
        جمعبندی
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
        <button><img src="../../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="41" height="42"  alt=""/></button>
      </form></td>
      <td><form  action="list_supplies_doc.php" method="post">
        جمعبندی
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
        <button><img src="../../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="41" height="42"  alt=""/></button>
      </form></td>
    </tr>
  </table>
  <br />
  <table width="95%" align="center" class="my-table"  >
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
if ($row['no_taj']=='20') $v_no_taj ='تبلت';
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
  <td width="8%" height="35"  class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['date_s'];?></span></td>
               <td bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['num'];?></td>
               <td bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['y_make'];?></td>
               <td bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['model'];?></td>
               <td bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $v_no_taj ;?></span></td>
               <td bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $row['id_mar'];?></span></td>
               <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo mar_name($row['id_mar']) ;?></td>
               <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']);?></td>
               <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo ostan_name($row['id_ostan']);?></td>
               <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
             </tr>
<?php
$r++ ; 
 }
?>
</table>
  <br />
  <form action="../../list_center.php#1" method="post" id="form1" name="form1">
     <input type="hidden" name="id_city"  value='<?php echo $id_select_city ?>'>
     <input type="hidden" name="action"  value="1">
     <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan1 ?>">
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="23" value="بازگشت" />
</form>           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



