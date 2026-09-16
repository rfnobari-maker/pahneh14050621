<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
//include('sar_data.php');
//require_once('../../ersal_p.php');
if  (isset($_POST['bah_cod_m']))
{
 $add_abadi = $_POST["add_abadi"]; 
 $add_city = $_POST["add_city"]; 
 $bah_cod_m = $_POST['bah_cod_m'];
if(isset($_POST['num_bah'])) $num_bah = $_POST['num_bah']; else  $num_bah = '1' ;
 $m_poul = $_POST['m_poul'];
 $no_mush = $_POST['no_mush'];
$no_moj = $_POST['no_moj'];
 $no_mal = $_POST['no_mal'];
 ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<link href="../radio.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
  <script>
function target_po3(form) {
    window.open('null', 'formpopup', 'width=950,height=1400,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
     <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>

  </tr>
  <tr>
    <td>
      <?php include('top.php'); ?>
           <p class="style8">سوابق   واحد های پرورش قارچ ثبت شده برای این بهره بردار</p><p class="style8"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <p>
        <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
<?php
include_once('../../login/config.php');
$query = "SELECT no_mush,mor_cod_m,m_zamin,unit_name,add_city,add_abadi,id_city,id_ostan from Mushroom where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
?>
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr class="text1">
    <td width="10%" align="center" bgcolor="#999999">عملیات</td>
    <td width="10%" align="center" bgcolor="#999999">کارشناس مروج</td>
    <td width="10%" height="44" bgcolor="#999999">مساحت<br />
      <span class="style2">متر مربع</span></td>
    <td width="28%" bgcolor="#999999">نام واحد </td>
    <td width="9%" bgcolor="#999999">نوع قارج پرورشی</td>
    <td width="14%" bgcolor="#999999">آبادی / شهر</td>
    <td width="13%" bgcolor="#999999">شهرستان</td>
    <td width="11%" bgcolor="#999999">استان</td>
    <td width="5%" bgcolor="#999999">ردیف</td>
  </tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
	 $pic = user_pic($row['mor_cod_m']) ;
if ($row['no_mush']=='1')  $v_no_mush='صدفی';
if ($row['no_mush']=='2')  $v_no_mush='دکمه ای';
?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller">
    <form  action="Mushroom_view.php" method="post"  onsubmit="target_po3(this)">
      <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
      <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
      <button><img src="../../files/view.png" title="نمایش اطلاعات واحد"  width="20" height="20"  alt=""/></button>
    </form></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><img id="img1" src="../../files/users/<?php echo $pic ?>" width="28" height="34"  alt=""/><br />
      <?php echo user_name($row['mor_cod_m'])?><br/>
      <?php echo $row['mor_cod_m']?><br /></td>
    <td height="40" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['unit_name'] ;?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mush?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_name($row['add_city'])?><?php echo abadi_name($row['add_abadi'])?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$id_ostan) ; ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan'])?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>

      <p>&nbsp;</p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
	         
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
     <form name="myform1" class="myform" method="post" action="Mushroom_data.php">
     <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
     <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
     <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
     <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
     <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
     <input type="hidden" name="no_mush" value="<?php echo $no_mush ;?>" />
     <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
     <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
    <input type="submit" name="action9" value="ثبت بهره برداری جدید" style="width:150px ; height:45px" tabindex="22" />
    <a href="Mushroom.php"><input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="22" /></a>


     </form>
  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Mushroom.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
   </tr>
</table>
</table>
</td>
</tr>
</td>
</table></body>
</body>
</html>
