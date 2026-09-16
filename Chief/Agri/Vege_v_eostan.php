<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
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
<style>
button
{
	border-color:#FFF ;
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
      <span class="style8">مشاهده سطح  زیر کشت و پیش بینی تولید ابلاغی به تفکیک استان</span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 400px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="182" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan="2" align='center' bgcolor="#FFFFFF">&nbsp;</td>
                 </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                        <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl" tabindex="1">
                       <?php
                    $query = "SELECT z_sal FROM z_sal  ORDER BY z_sal DESC "  ;
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                   <option value="<?php echo $row['z_sal'] ;?>"
                   <?php if ($row['z_sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['z_sal'] ;?></option>
                   <?php }?>
                   </select>
                 </div></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style8">: سال زراعی</td>
                 </tr>
               <tr >
                 <td height="54" align="right" class="input_text" ><div align="right">
                   <select  name="cod_mah" class="required input_text mar" id="cod_mah" style="width:170px ; height:40px" tabindex="4" dir="rtl">
                     <option value="170" <?php if (isset($cod_mah) && $cod_mah=='170') echo 'selected=selected'?>>سیب زمینی</option>
                     <option value="172" <?php if (isset($cod_mah) && $cod_mah=='172') echo 'selected=selected'?>>پیاز</option>
                     <option value="174" <?php if (isset($cod_mah) && $cod_mah=='174') echo 'selected=selected'?>>گوجه فرنگی</option>
                     </select>
                   </div></td>
                 <td height="54"  align='center' class="style8">نام محصول</td>
               </tr>
               <tr >
                 <td height="60" colspan="2" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="10" value='جستجو' />
                 </td>
                 </tr>
             </table> 
           </div>
 </form>
      <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['action'])) 
 {  
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
 if ($cod_mah == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "cod_mah = '$cod_mah'" ;}
// include_once('../../login/config.php');
$query = "SELECT ostan,id_ostan from ostanname where 1 
ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21') "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             </p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td width="56"><form  action="Vege_veostan_xls.php" method="post">
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="cod_mah"   value="<?php echo $cod_mah ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                 <td width="56"><form  action="Vege_veostan_doc.php" method="post">
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="cod_mah"   value="<?php echo $cod_mah ;?>" />
                   <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
             <br />
            <table width="95%"  align="center" class="my-table" >
              <tr class="text1">
          <td colspan="3" bgcolor="#006699">جمع کل</td>
          <td height="36" colspan="3" bgcolor="#006699">پاییزه</td>
          <td colspan="3" bgcolor="#006699">تابستانه</td>
          <td colspan="3" bgcolor="#006699">بهاره</td>
          <td colspan="3" bgcolor="#006699">زمستانه/ استمرار</td>
          <td width="12%" rowspan="2" bgcolor="#006699">استان</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="4%" bgcolor="#006699" class="normalTextSmaller">میانگین عملکرد<br />
            <span class="style2">تن</span> <br /></td>
          <td width="5%" bgcolor="#006699"><p class="normalTextSmaller">پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="6%" bgcolor="#006699"><span class="normalTextSmaller">سطح زیر کشت</span><br />
            <span class="style2">هکتار</span></td>
          <td width="4%" bgcolor="#006699"><span class="normalTextSmaller">میانگین عملکرد<br />
              <span class="style2">تن</span> <br />
          </span></td>
          <td width="6%" bgcolor="#006699"><p class="normalTextSmaller">پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="6%" bgcolor="#006699"><span class="normalTextSmaller">سطح زیر کشت</span><br />
            <span class="style2">هکتار</span></td>
          <td width="4%" bgcolor="#006699"><span class="normalTextSmaller">میانگین عملکرد<br />
              <span class="style2">تن</span> <br />
          </span></td>
          <td width="6%" bgcolor="#006699"><p class="normalTextSmaller">پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="8%" bgcolor="#006699"><span class="normalTextSmaller">سطح زیر کشت</span><br />
            <span class="style2">هکتار</span></td>
          <td width="4%" bgcolor="#006699"><span class="normalTextSmaller">میانگین عملکرد<br />
              <span class="style2">تن</span> <br />
          </span></td>
          <td width="7%" bgcolor="#006699"><p class="normalTextSmaller">پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="6%" bgcolor="#006699"><span class="normalTextSmaller">سطح زیر کشت</span><br />
            <span class="style2">هکتار</span></td>
          <td width="4%" bgcolor="#006699"><span class="normalTextSmaller">میانگین عملکرد<br />
              <span class="style2">تن</span> <br />
          </span></td>
          <td width="7%" bgcolor="#006699"><p class="normalTextSmaller">پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="7%" bgcolor="#006699"><span class="normalTextSmaller">سطح زیر کشت</span><br />
            <span class="style2">هکتار</span></td>
        </tr>
          <?php 
//$r = $start+1 ;
$r = 1 ;

foreach($stmt as $row){ 
$t_r = $r ;
$ostan = $row['ostan'] ; 
$id_ostan = $row['id_ostan'] ; 

$query = "SELECT * from Vege_e_ostan where z_sal = '$z_sal' and id_ostan = '$id_ostan' and cod_mah = $cod_mah";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$z_avg_t = round(($row['z_p_t'] / $row['z_s_zk']),1) ; 
$p_avg_t = round(($row['p_p_t'] / $row['p_s_zk']),1) ; 
$b_avg_t = round(($row['b_p_t'] / $row['b_s_zk']),1) ; 
$t_avg_t = round(($row['t_p_t'] / $row['t_s_zk']),1) ; 
$avg_t   = round(($row['p_t'] / $row['s_zk']),1) ; 

  ?>
        <tr>
          <td height="47" class="style19" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center" class="style8"><?php if($avg_t > 0) echo $avg_t ?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['p_t']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['s_zk']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center" class="style8">
            <?php if($p_avg_t > 0) echo $p_avg_t ?>
          </div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['p_p_t']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['p_s_zk']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center" class="style8">
            <?php if($t_avg_t > 0) echo $t_avg_t ?>
          </div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['t_p_t']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['t_s_zk']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center" class="style8">
            <?php if($b_avg_t > 0) echo $b_avg_t ?>
          </div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['b_p_t']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['b_s_zk']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center" class="style8">
            <?php if($z_avg_t > 0) echo $z_avg_t ?>
          </div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['z_p_t']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['z_s_zk']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right" class="normalTextSmall"><?php echo $ostan?></div></td>
          <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
  
 $query = "SELECT sum(z_p_t) as z_p_t,sum(z_s_zk) as z_s_zk,sum(p_p_t) as p_p_t,sum(p_s_zk) as p_s_zk, 
  sum(b_p_t) as b_p_t,sum(b_s_zk) as b_s_zk,sum(t_p_t) as t_p_t,sum(t_s_zk) as t_s_zk,sum(p_t) as p_t , 
  sum(s_zk) as s_zk from Vege_e_ostan where z_sal = '$z_sal' and cod_mah = $cod_mah";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$z_avg_t = round(($row['z_p_t'] / $row['z_s_zk']),1) ; 
$p_avg_t = round(($row['p_p_t'] / $row['p_s_zk']),1) ; 
$b_avg_t = round(($row['b_p_t'] / $row['b_s_zk']),1) ; 
$t_avg_t = round(($row['t_p_t'] / $row['t_s_zk']),1) ; 
$avg_t   = round(($row['p_t']   / $row['s_zk']),1) ; 
	?>
        <tr>
          <td colspan="3" bgcolor="#006699" class="text1">جمع کل</td>
          <td height="36" colspan="3" bgcolor="#006699" class="text1">پاییزه</td>
          <td colspan="3" bgcolor="#006699" class="text1">تابستانه</td>
          <td colspan="3" bgcolor="#006699" class="text1">بهاره</td>
          <td colspan="3" bgcolor="#006699" class="text1">زمستانه/ استمرار</td>
          <td colspan="2" rowspan="2" bgcolor="#006699"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
        </tr>
        <tr>
          <td width="4%" bgcolor="#006699" class="text1"><span class="normalTextSmaller">میانگین عملکرد<br />
            <span class="style2">تن</span> <br />
          <td width="5%" bgcolor="#006699" class="text1"><p class="normalTextSmaller">پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="6%" bgcolor="#006699" class="text1"><span class="normalTextSmaller">سطح زیر کشت</span><br />
            <span class="style2">هکتار</span></td>
          <td width="4%" bgcolor="#006699" class="text1"><span class="normalTextSmaller">میانگین عملکرد<br />
            <span class="style2">تن</span> <br />
          </span></td>
          <td width="6%" bgcolor="#006699" class="text1"><p class="normalTextSmaller">پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="6%" bgcolor="#006699" class="text1"><span class="normalTextSmaller">سطح زیر کشت</span><br />
            <span class="style2">هکتار</span></td>
          <td width="4%" bgcolor="#006699" class="text1"><span class="normalTextSmaller">میانگین عملکرد<br />
            <span class="style2">تن</span> <br />
          </span></td>
          <td width="6%" bgcolor="#006699" class="text1"><p class="normalTextSmaller">پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="8%" bgcolor="#006699" class="text1"><span class="normalTextSmaller">سطح زیر کشت</span><br />
            <span class="style2">هکتار</span></td>
          <td width="4%" bgcolor="#006699" class="text1"><span class="normalTextSmaller">میانگین عملکرد<br />
            <span class="style2">تن</span> <br />
          </span></td>
          <td width="7%" bgcolor="#006699" class="text1"><p class="normalTextSmaller">پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="6%" bgcolor="#006699" class="text1"><span class="normalTextSmaller">سطح زیر کشت</span><br />
            <span class="style2">هکتار</span></td>
          <td width="4%" bgcolor="#006699" class="text1"><span class="normalTextSmaller">میانگین عملکرد<br />
            <span class="style2">تن</span> <br />
          </span></td>
          <td width="7%" bgcolor="#006699" class="text1"><p class="normalTextSmaller">پیش بینی تولید <br />
            <span class="style2">تن</span></p></td>
          <td width="7%" bgcolor="#006699" class="text1"><span class="normalTextSmaller">سطح زیر کشت</span><br />
            <span class="style2">هکتار</span></td>
          </tr>
        <tr>
          <td height="47" class="style19" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center" class="style8">
            <?php if($avg_t > 0) echo $avg_t ?>
          </div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['p_t']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['s_zk']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center" class="style8">
            <?php if($p_avg_t > 0) echo $p_avg_t ?>
          </div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['p_p_t']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['p_s_zk']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center" class="style8">
            <?php if($t_avg_t > 0) echo $t_avg_t ?>
          </div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['t_p_t']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['t_s_zk']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center" class="style8">
            <?php if($b_avg_t > 0) echo $b_avg_t ?>
          </div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['b_p_t']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['b_s_zk']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center" class="style8">
            <?php if($z_avg_t > 0) echo $z_avg_t ?>
          </div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['z_p_t']?></div></td>
          <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="center"><?php echo $row['z_s_zk']?></div></td>
          <td colspan="2" bgcolor="#006699"  class="text1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>جمع کل</td>
        </tr>
            </table>
  <p class="style2" align="center">
    <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>
</p>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>