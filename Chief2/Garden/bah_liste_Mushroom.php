<?php 
include('../../lock_ce.php');
include('../../event.php');
$bah_cod_m = $_POST['bah_cod_m'] ;
$num_bah   = $_POST['num_bah'] ; 
$y_prod    = $_POST['z_sal'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script>
function close_window() {
      close();
 }
</script>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td>&nbsp;</td>
          </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    
      </p>
             <?php
 if (isset($_POST['action'])) 
 {  
  $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;
 include('../../login/config.php');
$start=0;
$limit=100;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
$query = " SELECT id,num_bah,bah_cod_m,mor_cod_m,unit_id,t_zan,t_mar,m_fani,no_mush,comp,nt_comp
 ,t_dpar,zer_kesh,mah_tol,tol_avg,v_unit from Mushroom_prod
where  $v_bah_cod_m  and num_bah = '$num_bah' and y_prod = '$y_prod' ORDER BY bah_cod_m ASC  "; 
$query1 = "SELECT id from Mushroom_prod
 where  $v_bah_cod_m  and num_bah = '$num_bah' and y_prod = '$y_prod'  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <span class="style8">سوابق پرورش قارچ بهره بردار در سال <?php echo $y_prod ;?></span><br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
            <table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td colspan="2" rowspan="2" bgcolor="#006699">عملیات</td>
                <td width="7%" rowspan="2" bgcolor="#006699">عملکرد تولید<span class="style2"><br />
                  کیلوگرم / مترمربع</span></td>
          <td width="5%" rowspan="2" bgcolor="#006699"><p>کل تولید <span class="style2">تن</span></p></td>
          <td width="6%" rowspan="2" bgcolor="#006699">سطح زیر کشت<br />
            <span class="style2">مترمربع</span></td>
          <td width="6%" rowspan="2" bgcolor="#006699"><p>تعداد دوره پرورشی</p></td>
          <td width="8%" rowspan="2" bgcolor="#006699">نحوه تامین کمپوست</td>
          <td width="7%" rowspan="2" bgcolor="#006699"><p>کمپوست مصرفی<br />
              <span class="style2">تن / سال</span> </p></td>
          <td width="6%" rowspan="2" bgcolor="#006699">نوع قارچ</td>
          <td width="7%" rowspan="2" bgcolor="#006699">مسئول فنی</td>
          <td width="8%" rowspan="2" bgcolor="#006699"><p>تعداد شاغل<br />
              <span class="style2">نفر</span> </p></td>
          <td colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="10%" bgcolor="#006699" class="style8"><img src="../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="14%" bgcolor="#006699">نام و نام خانوادگی</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 

if ($row['no_mush']=='1')  $v_no_mush='صدفی';
if ($row['no_mush']=='2')  $v_no_mush='دکمه ای';
if ($row['no_mush']=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';

if ($row['m_fani']=='1')  $v_m_fani='دارد';
if ($row['m_fani']=='2')  $v_m_fani='ندارد';

if ($row['nt_comp']=='1')  $v_nt_comp='خود مصرفی';
if ($row['nt_comp']=='2')  $v_nt_comp='خریداری شده';
if ($row['nt_comp']=='3')  $v_nt_comp='ترکیبی';



  ?>
          <td width="6%" height="53" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>  <form  action="../send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
            <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
            <button><img src="../../files/receive_mail.png" width="23" height="25" title="ارسال پیام " /></button>
            </form></td>
          <td width="6%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
           <form  action="Mushdata_prod_view.php" method="post"  onsubmit="target_po3(this)">
                  <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
                  <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
                  <input type="hidden" name="unit_id" value="<?php echo $row['unit_id']  ;?>" />
                  <input type="hidden" name="y_prod" value="<?php echo $y_prod  ;?>" />
                  <input type="hidden" name="v_unit" value="<?php echo $row['v_unit']  ;?>" />
                  <input type="hidden" name="num_bah" value="<?php echo $row['num_bah']  ;?>" />
                  <button><img src="../../files/view.png" title="نمایش اطلاعات عملکرد واحد"  width="20" height="20"  alt=""/></button>
                </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tol_avg'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tol']*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesh']*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dpar'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_nt_comp ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['comp']*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mush;  ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_fani ; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_mar'] + $row['t_zan'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>
<p> <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بازگشت</button></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>