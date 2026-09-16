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
 $no_moj = $_POST['no_moj'];
 $no_fa = $_POST['no_fa'];
 $vaz_s = $_POST['vaz_s']; 

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
     <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
           <p class="style8">سوابق   بهره برداری های دامی بهره بردار در سامانه 
           </p><p class="style8"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <p>
        <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
<?php
include('../../login/config.php');
$query = "SELECT id,sh_yek,num_bah,mor_cod_m,no_fa,bah_cod_m,add_abadi,add_city,sal,no_moj,id_ostan,id_city from Animal
 where bah_cod_m = '$bah_cod_m' ORDER BY `sal` ASC ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
?>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr class="text1">
    <td width="10%" height="44" align="center" bgcolor="#999999">کارشناس مروج</td>
    <td width="9%" bgcolor="#999999">شناسه یکتا</td>
    <td width="10%" bgcolor="#999999">نوع فعالیت</td>
    <td width="14%" bgcolor="#999999">نوع مجوز</td>
    <td width="7%" bgcolor="#999999">سال </td>
    <td width="16%" bgcolor="#999999">آبادی / شهر</td>
    <td width="15%" bgcolor="#999999">شهرستان</td>
    <td width="12%" bgcolor="#999999">استان</td>
    <td width="7%" bgcolor="#999999">ردیف</td>
  </tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
	 $pic = user_pic($row['mor_cod_m']) ;
if ($row['no_fa']=='1') $v_no_fa='گاوشیری' ;	 
if ($row['no_fa']=='2') $v_no_fa='گوساله پرواری' ;	 
if ($row['no_fa']=='3') $v_no_fa='گاومیش شیری' ;	 
if ($row['no_fa']=='4') $v_no_fa='گاومیش پرواری' ;	 
if ($row['no_fa']=='5') $v_no_fa='گوسفند داشتی' ;	 
if ($row['no_fa']=='6') $v_no_fa='بره پرواری' ;	 
if ($row['no_fa']=='7') $v_no_fa='بز و بزغاله داشتی' ;	 
if ($row['no_fa']=='8') $v_no_fa='بز داشتی' ;	 
if ($row['no_fa']=='9') $v_no_fa='بز پرواری' ;	 
if ($row['no_fa']=='10') $v_no_fa='شتر پرواری' ;	 
if ($row['no_fa']=='11') $v_no_fa='پرورش اسب' ;	 


if ($row['no_moj']=='1') $v_no_moj='صنعتی' ;	 
if ($row['no_moj']=='2') $v_no_moj='نیمه صنعتی' ;	 
if ($row['no_moj']=='3') $v_no_moj='کارت شناسائی' ;	 
if ($row['no_moj']=='4') $v_no_moj='کوچک روستایی' ;	 
if ($row['no_moj']=='5') $v_no_moj='فاقد مجوز' ;	 
?>
  <tr>
    <td height="40" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img id="img1" src="../../files/users/<?php echo $pic ?>" width="28" height="34"  alt=""/><br />
      <?php echo user_name($row['mor_cod_m'])?><br/>
      <?php echo $row['mor_cod_m']?><br /></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_yek'] ;?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_fa ;?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_moj?></td>
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
     <form name="myform1" class="myform" method="post" action="Animal_data.php">
     <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
     <input type="hidden" name="no_bah" value="<?php echo $num_bah ;?>" />
     <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
     <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
     <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
     <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
     <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
     <input type="hidden" name="vaz_s" value="<?php echo $vaz_s ;?>" />
     <input type="submit" name="action9" value="ثبت بهره برداری جدید" style="width:150px ; height:45px" tabindex="22" />
    <a href="Animal.php"><input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="22" /></a>
     </form>
  </td>
  </tr>
<?php }
else
{
?>
<form  name="myform" class="myform" method="post" action="Animal.php">
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
