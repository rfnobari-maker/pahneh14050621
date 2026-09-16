<?php 
include('../../lock_ce.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if(isset($_POST['z_sal'])) $z_sal = $_POST['z_sal'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
   <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
<style type="text/css">
#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
.column {
  float: left;
  width:50%;
  padding: 0px;
}
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</head>
<body>
                    <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
<span class="style8">ثبت قیمت اقلام خوراکی شهرستان در تاریخ : <?php echo $date_edit?></span>
<p><span class="style1"><a name="1" id="1"></a></span>
               <?php
// include_once('../../login/config.php');
$query = "SELECT * from price_pro_list where 1 ORDER BY p_cod "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td width="8%" height="37" bgcolor="#006699">عملیات</td>
                <td width="7%" colspan="2" bgcolor="#006699">قیمت به ریال </td>
                <td width="13%" bgcolor="#006699">کد محصول</td>
                <td width="15%" bgcolor="#006699">نام محصول</td>
                <td width="5%" bgcolor="#006699">ردیف</td>
              </tr>
        <tr>
          <?php 
//$r = $start+1 ;
$r = 1 ;

foreach($stmt as $row){ 
$t_r = $r ;
$p_name = $row['p_name'] ; 
$p_unit = $row['p_unit'] ; 
$p_cod = $row['p_cod'] ; 

$query = "SELECT * from Vege_e_ostan where z_sal = '$z_sal' and id_ostan = '$id_ostan' and cod_mah = $cod_mah";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
  ?>
          <td height="57"  colspan="3" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form name="form<?php echo $r ?>">
              <input type="hidden" id="z_sal"     name="z_sal" value="<?php echo '01' ;?>" />
              <input type="hidden" id="p_cod"   name="p_cod" value="<?php echo $p_cod ;?>" />
              <input type="hidden" id="p_cod<?php echo $t_r?>"  name="p_cod" value="<?php echo $p_cod ;?>" />
              <div class="row">
                <div class="column" >
                  <input name="submit"  type="submit" class="submit<?php echo $r ?>" id="submit<?php echo $t_r ?>" style="width:45px ; height:35px ; font-size:14px ; color:#900 ; font-family:tahoma ; text-align:center" tabindex="<?php echo $r.'9'?>"  value="ثبت"  />
                  <span class="error<?php echo $t_r ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15"  alt=""/></span>
                  <span class="success<?php echo $t_r ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15"  alt=""/></span>
                  </div>
                <div class="column">
                  <input name="p_price"  type="text" class="p_price required digits input_text" id="p_price<?php echo $t_r?>" style="width:75px; height:30px ; " tabindex="<?php echo $r.'4'?>"  dir="rtl" lang="fa" value="<?php echo $row['p_price']*1 ; ?>" maxlength="10"  align="baseline" xml:lang="fa" /></div>
                </div>
              </form>
            </td>
          <td  class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><div align="right" dir="rtl"><?php echo $p_unit?></div></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $p_name?></div></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?><br /></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
  <p class="style2" align="center">
    <?php }  
  ?>
</p>
  <p><a href="Vege.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>

<?php
$no = 32 ; 
while ($no > 0){
?>
   <script type="text/javascript" >
$(function() {
$(".submit<?php echo $no ?>").click(function() {

var z_sal         = $("#z_sal").val();
var p_cod         = $("#p_cod<?php echo $no ?>").val()
var p_price       = $("#p_price<?php echo $no ?>").val();
alert(p_price); 
//alert(p_p_t); 

var dataString = 'z_sal='+ z_sal  +  '&p_cod=' + p_cod  +  '&p_price=' + p_price   ;
if(
( parseFloat(p_price) <= 0 ) 
 ){
$('.success<?php echo $no ?>').fadeOut(200).hide();
$('.error<?php echo $no ?>').fadeOut(200).show();
}
else
{
$.ajax({
type: "POST",
url: "post98.php",
data: dataString,
success: function(){
$('.success<?php echo $no ?>').fadeIn(200).show();
$('.error<?php echo $no ?>').fadeOut(200).hide();
}
});
}
return false;
});
});
</script>
<?php
 $no--;
}
?>