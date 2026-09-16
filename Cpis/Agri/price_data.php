<?php 
include('../../lock_cp.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if(isset($_POST['z_sal'])) $z_sal = $_POST['z_sal'] ;
if(isset($_POST['cod_mah']))  $cod_mah = $_POST['cod_mah'] ;
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
  width:11.11%;
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
      <span class="style8">ثبت قیمت اقلام خوراکی شهرستان در تاریخ : <?php echo $date_edit?></span><br />
      </p>
            <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 
$query = "SELECT * from price_pro_list where 1 
ORDER BY p_cod "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <br />
            <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
          <td width="8%" rowspan="2" bgcolor="#006699">عملیات</td>
          <td height="36" colspan="2" bgcolor="#006699">پاییزه</td>
          <td colspan="2" bgcolor="#006699">تابستانه</td>
          <td colspan="2" bgcolor="#006699">بهاره</td>
          <td colspan="2" bgcolor="#006699">زمستانه/ استمرار</td>
          <td width="9%" rowspan="2" bgcolor="#006699">واحد</td>
          <td width="20%" rowspan="2" bgcolor="#006699">نام محصول</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="7%" bgcolor="#006699"><p>پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="7%" bgcolor="#006699">سطح زیر کشت<br />
            <span class="style2">هکتار</span></td>
          <td width="8%" bgcolor="#006699"><p>پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="7%" bgcolor="#006699">سطح زیر کشت<br />
            <span class="style2">هکتار</span></td>
          <td width="8%" bgcolor="#006699"><p>پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="7%" bgcolor="#006699">سطح زیر کشت<br />
            <span class="style2">هکتار</span></td>
          <td width="7%" bgcolor="#006699"><p>پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="8%" bgcolor="#006699">سطح زیر کشت<br />
            <span class="style2">هکتار</span></td>
        </tr>
        <tr>
          <?php 
//$r = $start+1 ;
$r = 1 ;

foreach($stmt as $row){ 
$t_r = $r ;
$p_name = $row['p_name'] ; 
$p_unit = $row['p_unit'] ; 

$query = "SELECT * from Vege_e_ostan where z_sal = '$z_sal' and id_ostan = '$id_ostan' and cod_mah = $cod_mah";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
  ?>
          <td height="57"  colspan="9" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form name="form<?php echo $r ?>">
              <input type="hidden" id="z_sal"     name="z_sal" value="<?php echo $z_sal ;?>" />
              <input type="hidden" id="cod_mah"   name="cod_mah" value="<?php echo $cod_mah ;?>" />
              <input type="hidden" id="id_ostan<?php echo $t_r?>"  name="id_ostan" value="<?php echo $id_ostan ;?>" />
              <div class="row">
                <div class="column" >
                  <input name="submit"  type="submit" class="submit<?php echo $r ?>" id="submit<?php echo $t_r ?>" style="width:45px ; height:35px ; font-size:14px ; color:#900 ; font-family:tahoma ; text-align:center" tabindex="<?php echo $r.'9'?>"  value="ثبت"  />
                  <span class="error<?php echo $t_r ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15"  alt=""/></span>
                  <span class="success<?php echo $t_r ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15"  alt=""/></span>
                  </div>
          <div class="column">
            <input name="p_p_t"  type="text" class="p_p_t required number input_text" id="p_p_t<?php echo $t_r?>" style="width:50px; height:30px ; " tabindex="<?php echo $r.'8'?>"  dir="rtl" lang="fa" value="<?php  echo $row['p_p_t']*1 ; ?>" maxlength="10"  align="baseline" xml:lang="fa" /> 
          </div>
          <div class="column">
            <input name="p_s_zk" type="text" class="p_s_zk required number input_text" id="p_s_zk<?php echo $t_r?>" style="width:50px; height:30px ; " tabindex="<?php echo $r.'7'?>"  dir="rtl" lang="fa" value="<?php  echo $row['p_s_zk']*1 ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
          </div>
          <div class="column">
            <input name="t_p_t"  type="text" class="t_p_t required number input_text" id="t_p_t<?php echo $t_r?>" style="width:50px; height:30px ; " tabindex="<?php echo $r.'6'?>"  dir="rtl" lang="fa" value="<?php  echo $row['t_p_t']*1 ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
          </div>
          <div class="column">
            <input name="t_s_zk" type="text" class="t_s_zk required number input_text" id="t_s_zk<?php echo $t_r?>" style="width:50px; height:30px ; " tabindex="<?php echo $r.'5'?>"  dir="rtl" lang="fa" value="<?php  echo $row['t_s_zk']*1 ; ?>" maxlength="10"  align="baseline" xml:lang="fa" /> </div>
          <div class="column">
            <input name="b_p_t"  type="text" class="b_p_t required digits input_text" id="b_p_t<?php echo $t_r?>" style="width:50px; height:30px ; " tabindex="<?php echo $r.'4'?>"  dir="rtl" lang="fa" value="<?php echo $row['b_p_t']*1 ; ?>" maxlength="10"  align="baseline" xml:lang="fa" /></div>
          <div class="column">
            <input name="b_s_zk" type="text" class="b_s_zk required number input_text" id="b_s_zk<?php echo $t_r?>" style="width:50px; height:30px ; " tabindex="<?php echo $r.'3'?>"  dir="rtl" lang="fa" value="<?php  echo $row['b_s_zk']*1 ; ?>" maxlength="10"  align="baseline" xml:lang="fa" /> </div>
          <div class="column" >
            <input name="z_p_t"  type="text" class="z_p_t required digits input_text" id="z_p_t<?php echo $t_r?>" style="width:50px; height:30px ; " tabindex="<?php echo $r.'2'?>"  dir="rtl" lang="fa" value="<?php echo $row['z_p_t']*1 ; ?>" maxlength="10"  align="baseline" xml:lang="fa" /></div>
          <div class="column" >
            <input name="z_s_zk" type="text" class="z_s_zk required digits input_text" id="z_s_zk<?php echo $t_r?>" style="width:50px; height:30px ; " tabindex="<?php echo $r.'1'?>"  dir="rtl" lang="fa" value="<?php echo $row['z_s_zk']*1 ; ?>" maxlength="10"  align="baseline" xml:lang="fa" /></div>
          </div>
              </form>
            </td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right" dir="rtl"><?php echo $p_unit?></div></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $p_name?></div></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?><br /></td>
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

var z_sal       = $("#z_sal").val();
var cod_mah     = $("#cod_mah").val();
var id_ostan    = $("#id_ostan<?php echo $no ?>").val()
var z_s_zk      = $("#z_s_zk<?php echo $no ?>").val();
var z_p_t       = $("#z_p_t<?php echo $no ?>").val();
var b_s_zk      = $("#b_s_zk<?php echo $no ?>").val();
var b_p_t       = $("#b_p_t<?php echo $no ?>").val();
var t_s_zk      = $("#t_s_zk<?php echo $no ?>").val();
var t_p_t       = $("#t_p_t<?php echo $no ?>").val();
var p_s_zk      = $("#p_s_zk<?php echo $no ?>").val();
var p_p_t       = $("#p_p_t<?php echo $no ?>").val();
//alert(p_s_zk); 
//alert(p_p_t); 

var s_zk        = parseFloat(z_s_zk) + parseFloat(b_s_zk) + parseFloat(t_s_zk) + parseFloat(p_s_zk)  ; 
var p_t         = parseFloat(z_p_t) +  parseFloat(b_p_t) + parseFloat(t_p_t) + parseFloat(p_p_t) ; 
var dataString = 'z_sal='+ z_sal  +  '&id_ostan=' + id_ostan +  '&cod_mah=' + cod_mah +  '&z_s_zk=' + z_s_zk 
+  '&z_p_t=' + z_p_t  +  '&b_s_zk=' + b_s_zk +  '&b_p_t=' + b_p_t  +  '&t_s_zk=' + t_s_zk +  '&t_p_t=' + t_p_t  + 
    '&p_s_zk=' + p_s_zk +  '&p_p_t=' + p_p_t  +  '&s_zk=' + s_zk +  '&p_t=' + p_t     ;
if(
(parseFloat(b_s_zk) > 0  &&  parseFloat(b_p_t) <= 0 ) ||
(parseFloat(t_s_zk) > 0  &&  parseFloat(t_p_t) <= 0 ) ||
(parseFloat(p_s_zk) > 0  &&  parseFloat(p_p_t) <= 0 ) ||
(parseFloat(z_s_zk) > 0  &&  parseFloat(z_p_t) <= 0 ) ||
(parseFloat(b_s_zk) <= 0  &&  parseFloat(b_p_t) > 0 ) ||
(parseFloat(t_s_zk) <= 0  &&  parseFloat(t_p_t) > 0 ) ||
(parseFloat(p_s_zk) <= 0  &&  parseFloat(p_p_t) > 0 ) ||
(parseFloat(z_s_zk) <= 0  &&  parseFloat(z_p_t) > 0 ) 
 ){
$('.success<?php echo $no ?>').fadeOut(200).hide();
$('.error<?php echo $no ?>').fadeOut(200).show();
}
else
{
$.ajax({
type: "POST",
url: "price_post.php",
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