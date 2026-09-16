<?php 
include('../../lock_p1.php');
include('../../event.php');
$bah_cod_m = $_POST['bah_cod_m'] ;
$num_bah   = $_POST['num_bah'] ; 
$y_prod = $_POST['y_prod'] ; 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script>
function close_window() {
      close();
 }
</script>

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
</style>

  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_po3(form) {
    window.open('null', 'formpopup', 'width=950,height=1400,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><span class="style8">سوابق گلخانه بهره بردار در سال <?php echo $y_prod ;?></span><br />
      <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/> <br />
      </p>
      <?php
 if (isset($_POST['action'])) 
 {  

 include_once('../../login/config.php');
 $query = " SELECT id,num_bah,bah_cod_m,mor_cod_m,unit_id,t_zan,t_mar,m_fani,no_mtol,v_unit,id_ostan,id_city
,add_abadi,add_city,y_prod from Greenhous_prod 
where  y_prod = '$y_prod' and bah_cod_m = '$bah_cod_m' and num_bah = $num_bah "; 

$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
      <br />
            <table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td colspan="2" rowspan="2" bgcolor="#006699">عملیات</td>
                <td width="5%" rowspan="2" bgcolor="#006699">تعداد شاغل<br />
                <span class="style2">نفر</span></td>
          <td width="12%" rowspan="2" bgcolor="#006699">مسئول فنی</td>
          <td width="23%" rowspan="2" bgcolor="#006699">نوع محصول تولیدی</td>
          <td width="5%" rowspan="2" bgcolor="#006699">وضعیت واحد</td>
          <td width="5%" rowspan="2" bgcolor="#006699"><p>عملکرد سال </p></td>
          <td height="36" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="3" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="6%" bgcolor="#006699" class="style8"><span class="text1"> کد ملی</span></td>
          <td width="8%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="8%" bgcolor="#006699">شهر/آبادی</td>
          <td width="9%" bgcolor="#006699">شهرستان</td>
          <td width="10%" bgcolor="#006699">استان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 


if ($row['v_unit']=='1') $v_v_unit = 'فعال' ;
if ($row['v_unit']=='2') $v_v_unit = 'در حال اخذ پروانه تاسیس';
if ($row['v_unit']=='3') $v_v_unit = 'دارای پیشرفت فیزیکی';
if ($row['v_unit']=='4') $v_v_unit = 'غیرفعال';

if ($row['m_fani']=='1')  $v_m_fani='دارد';
if ($row['m_fani']=='2')  $v_m_fani='ندارد';


if ($row['no_mtol']=='1')  $v_no_mtol='سبزی و صیفی';
if ($row['no_mtol']=='2')  $v_no_mtol='گل و گیاه زینتی در فضای گلخانه';
if ($row['no_mtol']=='4')  $v_no_mtol='گل و گیاه زینتی در فضای باز ';
if ($row['no_mtol']=='5')  $v_no_mtol='گل و گیاه زینتی در فضای توام';
if ($row['no_mtol']=='3')  $v_no_mtol='سایر' ;	 



  ?>
          <td width="5%" height="53" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="../send_pm1.php#1" method="post" onsubmit="target_po3(this)">
            <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
            <button><img src="../../files/receive_mail.png" width="23" height="25" title="ارسال پیام " /></button>
            </form></td>
       
          <td width="5%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
       <?php if ($v_v_unit == 'فعال') {?>
            <form  action="Greenh_prod_view.php" method="post"  onsubmit="target_po3(this)">
                  <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
                  <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
                  <input type="hidden" name="unit_id" value="<?php echo $row['unit_id']  ;?>" />
                  <input type="hidden" name="y_prod" value="<?php echo $row['y_prod']  ;?>" />
                  <input type="hidden" name="v_unit" value="<?php echo $row['v_unit']  ;?>" />
                  <input type="hidden" name="num_bah" value="<?php echo $row['num_bah']  ;?>" />
                  <input type="hidden" name="no_moj" value="<?php echo $no_moj  ;?>" />
                  <button><img src="../../files/view.png" title="نمایش اطلاعات عملکرد واحد"  width="20" height="20"  alt=""/></button>
                </form><?php }?></td> 
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_mar'] + $row['t_zan'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_fani ; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mtol?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_v_unit?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['y_prod'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
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
   <p> <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بازگشت</button></p></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</body>
</html>