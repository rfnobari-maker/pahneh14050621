<?php
include('../../../lock_expar.php');
include('../../../event.php');
  $id_ostan1 = $_POST['id_ostan'] ;
  $id_city1 = $_POST['id_city'] ;
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
  <p class="style1"> اطلاعات عمومی مراکز جهاد کشاورزی </p>
  <p><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
    <?php 
// $id_ostan = $_POST['id_ostan'] ; 
// $id_city = $_POST['id_city'] ; 
if ($id_ostan1 == -1) { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
if ($id_city1 == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city1'" ;}
 $query = "SELECT * FROM  promo_cent_public where  $v_id_ostan and  $v_id_city order by id_ostan,id_city "  ;
//echo  $query = "SELECT * FROM  public_abadi4 where  $v_id_ostan and  $v_id_city and $v_id_mar  and $v_add_deh  "  ;

$stmt = $dbh->prepare($query);
$stmt->execute();
?>
    <span class="style21"><a name="1" id="1"></a></span></p>
  <table width="200" height="56" border="0" align="center">
    <tr>
      <td><form  action="list_public_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
        <button><img src="../../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="58" height="59"  alt=""/></button>
      </form></td>
      <td><form  action="list_public_doc.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
        <button><img src="../../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="58" height="59"  alt=""/></button>
      </form></td>
    </tr>
  </table>
  <br />
  <table width="95%" height="149" border="0" align="center" cellpadding="0" cellspacing="2" >
    <tr align="center" class="text1">
               <td rowspan="2" bgcolor="#999999">عملیات </td>
               <td height="35" colspan="4" bgcolor="#999999">زمینه زراعی غالب </td>
               <td width="10%" rowspan="2" bordercolor="#FFFFFF" bgcolor="#999999">شماره تماس</td>
    <td width="7%" rowspan="2" bordercolor="#FFFFFF" bgcolor="#999999">سطح مرکز</td>
    <td width="6%" rowspan="2" bordercolor="#FFFFFF" bgcolor="#999999">کد مرکز</td>
    <td width="15%" rowspan="2" bgcolor="#999999">مرکز جهاد کشاورزی</td>
    <td width="11%" rowspan="2" bgcolor="#999999">شهرستان</td>
    <td width="12%" rowspan="2" bgcolor="#999999">استان</td>
    <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>

  </tr>
             <tr align="center" class="text1">
               <td bgcolor="#999999">دامی</td>
               <td height="44" bgcolor="#999999">باغی</td>
               <td height="44" bgcolor="#999999">زراعی</td>
               <td height="44" bgcolor="#999999">منطقه</td>
              </tr>
  <tr>
   
<?php
$r = 1 ;
 foreach($stmt as $row){
$id_city = $row['id_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_mar = $row['id_mar'] ;
?>
<td width="6%" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><form  action="public.php" method="post">
  <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan'] ;?>" />
  <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
  <input type="hidden" name="id_city" value="<?php echo $row['id_city'] ;?>" />
  <button class="tilt"><img src="../../../files/view.png" border="0"  title="مشاهده اطلاعات تشکل و شرکت های مرکز " width="40" height="41" /></button>
</form></td>
<td width="7%" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['to_d1'];?></span></td>
<td width="6%" height="62" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['to_b1'];?></span></td>
<td width="8%" height="62" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['to_z1'];?></span></td>
    <td width="7%"  class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['zf_g'];?></span></td>
    <td bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tel'];?></td>
    <td bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['rating'];?></td>
    <td bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><?php echo $row['id_mar'];?></span></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['m_name'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']);?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo ostan_name($row['id_ostan']);?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
 }
?>
</table>
           <p>&nbsp;</p>
 <form action="../../list_center.php#1" method="post" id="form1" name="form1">
   <input type="hidden" name="id_city"  value="<?php echo $id_city1 ?>">
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