<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
if  (isset($_POST['bah_cod_m']))
{
$sh_gat = $_POST["sh_gat"]; 
$id = $_POST["id"]; 
$add_abadi = $_POST["add_abadi"]; 
$add_city = $_POST["add_city"]; 
$bah_cod_m = $_POST['bah_cod_m'];
$m_poul = $_POST['m_poul'];
$b_time = $_POST['b_time'];
if ($b_time=='1')  $v_b_time='استمرار ، زمستانه';
if ($b_time=='2')  $v_b_time='بهاره';
if ($b_time=='3')  $v_b_time='تابستانه';
if ($b_time=='4')  $v_b_time='پاییزه';
$z_sal = $_POST['z_sal'];
$mah1 = $_POST['mah1'];
$mah2 = $_POST['mah2'];
$mah3 = $_POST['mah3'];
$t_kind = $_POST['t_kind'];
$m_ab = $_POST['m_ab'] ;
$no_bah = $_POST['no_bah'] ;
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
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form3").validate();
           });
    </script>
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
           <p class="style8">انتخاب بهره بردار </p><p class="style8"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <p>
        <?php
include('../../login/config.php');
$query = "SELECT mor_cod_m,no_bah,last_name,name,add_abadi,add_city,id_city,id_ostan from bah where bah_cod_m = '$bah_cod_m'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
?>
</p>
	 <form name="myform2" class="myform" method="post" action="Vegedata_edit.php">
      <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr class="text1">
    <td width="13%" align="center" bgcolor="#999999">کارشناس مروج</td>
    <td width="14%" height="44" bgcolor="#999999">نام خانوادگی</td>
    <td width="12%" bgcolor="#999999">نام</td>
    <td width="17%" bgcolor="#999999">نوع بهره بردار</td>
    <td width="10%" bgcolor="#999999">آبادی / شهر</td>
    <td width="13%" bgcolor="#999999">شهرستان</td>
    <td width="9%" bgcolor="#999999">استان</td>
    <td width="7%" bgcolor="#999999">انتخاب</td>
    <td width="5%" bgcolor="#999999">ردیف</td>
  </tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
	 $pic = user_pic($row['mor_cod_m']) ;
if ($row['no_bah']=='1') $v_no_bah='حقیقی' ;	 
if ($row['no_bah']=='2') $v_no_bah='حقوقی' ;	 
?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><img id="img1" src="../../files/users/<?php echo $pic ?>" width="28" height="34"  alt=""/><br />
      <?php echo user_name($row['mor_cod_m'])?><br/>
      <?php echo $row['mor_cod_m']?><br /></td>
    <td height="40" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name']?></td>
    <td height="40" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name']?></td>
    <td class="style8" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah?><br /> <?php echo $row['co_name']?><br /></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_name($row['add_city'])?><?php echo abadi_name($row['add_abadi'])?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan'])?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan'])?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <label >
    <input name="no_bah" type="radio"   class="required green"  <?php if($row['no_bah'] == $no_bah) { ?> checked='checked' <?php } ?>  value="<?php echo $row['no_bah']?>"  />
    </label>
      <br /></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="b_time" value="<?php echo $b_time ;?>" />
           <input type="hidden" name="mah1" value="<?php echo $mah1 ;?>" />
           <input type="hidden" name="mah2" value="<?php echo $mah2 ;?>" />
           <input type="hidden" name="mah3" value="<?php echo $mah3 ;?>" />
           <input type="hidden" name="t_kind" value="<?php echo $t_kind ;?>" />
           <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
           <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
           <input type="hidden" name="sh_gat" value="<?php echo $sh_gat ;?>" />
           <input type="hidden" name="id" value="<?php echo $id ;?>" />
           <input type="submit" name="action9" value="ادامه" style="width:150px ; height:45px" tabindex="22" />
           <input type="button" name="cancel" value="انصراف" style="width:150px ; height:45px" tabindex="30" id="btn1" onClick="window.location='index.php';"/>
          </form>
      <p>
        <?php 
}
else
{
?>
</p>
      <form  name="myform"  method="post" action="Vege.php">
      </form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
   </tr>
</table>
</td>
</tr>
</td>
</table></body>
</body>
</html>
