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
$query = "SELECT * from bah where bah_cod_m = '$bah_cod_m'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
?>
</p>
     <form name="form3" id="form3" method="post" action="">
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

//echo $row['bah_cod_m'].'<p>' ;
//echo $row['num_bah'].'<p>' ;
	 
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
    <input name="num_bah" type="radio"   class="required green"   value="<?php echo $row['num_bah']?>" />
    </label>
      <br /></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>
     <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
     <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
     <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
     <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
     <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
     <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
             <input type="submit" name="action9" value="ادامه" style="width:150px ; height:45px" tabindex="22" />
             <a href="Aquatic.php">
             <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="22" />
             </a></p>
     </form>


      <p>
        <?php 
}
else
{
?>
</p>
      <form  name="myform"  method="post" action="Aquatic.php">
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
<?php
 if (isset($_POST['action9'])) 
 {  
include('../../login/config.php');
 $bah_cod_m =$_POST['bah_cod_m'] ; 
 $num_bah =$_POST['num_bah'] ; 
 $m_poul =$_POST['m_poul'] ; 
 $add_city =$_POST['add_city'] ; 
 $add_abadi =$_POST['add_abadi'] ; 
 include('../../login/config.php');
$query = "SELECT * from Aquatic where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
if ($count_codm>0) {   ; 
?>
	 <form name="myform1" class="myform" method="post" action="Aquatic_history.php">
     <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
     <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
     <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
     <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
     <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
     <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
     <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
else 
{
?>
	 <form name="myform2" class="myform" method="post" action="Aquatic_data.php">
     <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
     <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
     <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
     <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
     <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
     <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
     <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
     </form>
    <script type="text/javascript">document.myform2.submit();</script>
<?php
}
} 
?>

