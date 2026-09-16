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
 $no_fa = $_POST['no_fa'];
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
           <p class="style8">سوابق   مزارع تکثیر و پرورش ثبت شده برای این بهره </p><p class="style8"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <p>
        <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
<?php
include('../../login/config.php');
$query = "SELECT * from Aquatic where bah_cod_m = $bah_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
?>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr class="text1">
    <td width="7%" align="center" bgcolor="#999999">کارشناس مروج</td>
    <td width="9%" height="44" bgcolor="#999999">مساحت<br />
      <span class="style2">متر مربع</span></td>
    <td width="11%" bgcolor="#999999">منبع تامین آب</td>
    <td width="11%" bgcolor="#999999">قالب تولید</td>
    <td width="16%" bgcolor="#999999">نوع فعالیت</td>
    <td width="14%" bgcolor="#999999">سال</td>
    <td width="14%" bgcolor="#999999">آبادی / شهر</td>
    <td width="13%" bgcolor="#999999">شهرستان</td>
    <td width="13%" bgcolor="#999999">استان</td>
    <td width="6%" bgcolor="#999999">ردیف</td>
  </tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
	 $pic = user_pic($row['mor_cod_m']) ;

if ($row['no_fa']=='1') $v_no_fa='تکثیر' ;	 
if ($row['no_fa']=='2') $v_no_fa='پرورش' ;	 
if ($row['no_fa']=='3') $v_no_fa='تکثیر و پرورش' ;	 
	 
if ($row['g_tol']=='1') $v_g_tol='مجتمع' ;	 
if ($row['g_tol']=='2') $v_g_tol='منفرد' ;	
if ($row['g_tol']=='3') $v_g_tol='مدار بسته' ;	
if ($row['g_tol']=='4') $v_g_tol='دو منظوره' ;	 
if ($row['g_tol']=='5') $v_g_tol='شالیزار' ;	 
if ($row['g_tol']=='6') $v_g_tol='قفس' ;	
if ($row['g_tol']=='7') $v_g_tol='پن' ;	 
if ($row['g_tol']=='8') $v_g_tol='آب بندان' ;	 
if ($row['g_tol']=='9') $v_g_tol='منابع آبی' ;	
if ($row['g_tol']=='10') $v_g_tol='سایر موارد' ;	


if ($row['m_ab']=='1') $v_m_ab='رودخانه' ;	 
if ($row['m_ab']=='2') $v_m_ab='چاه' ;	
if ($row['m_ab']=='3') $v_m_ab='چشمه و قنات' ;	
if ($row['m_ab']=='4') $v_m_ab='آبن بندان' ;	 
if ($row['m_ab']=='5') $v_m_ab='خور و دریا' ;	 
if ($row['m_ab']=='6') $v_m_ab='دریاجه' ;	
if ($row['m_ab']=='7') $v_m_ab='سایر منابع' ;	 


?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><img id="img1" src="../../files/users/<?php echo $pic ?>" width="28" height="34"  alt=""/><br />
      <?php echo user_name($row['mor_cod_m'])?><br/>
      <?php echo $row['mor_cod_m']?><br /></td>
    <td height="40" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_ab ;?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_g_tol ;?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_fa?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal']?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_name($row['add_city'])?><?php echo abadi_name($row['add_abadi'])?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan'])?></td>
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
     <form name="myform1" class="myform" method="post" action="Aquatic_data.php">
     <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
     <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
     <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
     <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
     <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
     <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
     <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
    <input type="submit" name="action9" value="ثبت مزرعه جدید" style="width:150px ; height:45px" tabindex="22" />
    <a href="Aquatic.php"><input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="22" /></a>


     </form>
  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Aquatice.php">
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
