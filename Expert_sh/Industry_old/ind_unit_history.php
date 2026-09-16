<?php
include('../../lock_expsh.php');
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
           <p class="style8">سوابق واحد های صنعتی این بهره بردار در سامانه 
      </p><p class="style8"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <p>
        <?php sar_ind_data($bah_cod_m,$num_bah) ;?>
      </p>
<?php
include('../../login/config.php');
$query = "SELECT mor_cod_m,unit_name,m_zamin,m_zmos,add_city,add_abadi,id_city,id_ostan from ind_unit where bah_cod_m = $bah_cod_m and num_bah = '$num_bah'  ORDER BY unit_name ASC ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
?>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr class="text1">
    <td width="7%" align="center" bgcolor="#999999">کارشناس مروج</td>
    <td width="10%" height="44" bgcolor="#999999">مساحت مسقف <br /><span class="style2">متر مربع</span></td>
    <td width="9%" bgcolor="#999999">مساحت کل<br />
      <span class="style2">مترمربع</span></td>
    <td width="16%" bgcolor="#999999">نام واحد</td>
    <td width="16%" bgcolor="#999999">آبادی / شهر</td>
    <td width="12%" bgcolor="#999999">شهرستان</td>
    <td width="16%" bgcolor="#999999">استان</td>
    <td width="5%" bgcolor="#999999">ردیف</td>
  </tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
	 $pic = user_pic($row['mor_cod_m']) ;
	 
if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 
?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><img id="img1" src="../../files/users/<?php echo $pic ?>" width="28" height="34"  alt=""/><br />
      <?php echo user_name($row['mor_cod_m'])?><br/>
      <?php echo $row['mor_cod_m']?><br /></td>
    <td height="40" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zmos']?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']?> </td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['unit_name']?></td>
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
     <form name="myform1" class="myform" method="post" action="ind_unit_data.php">
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
    <input type="submit" name="action9" value="ثبت واحد جدید" style="width:150px ; height:45px" tabindex="22" />
    <a href="index.php"><input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="22" /></a>


     </form>
  </td>
  </tr>
<?php }
else
{
?>
<form  name="myform" class="myform" method="post" action="Agri1.php">
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
