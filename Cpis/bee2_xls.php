<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=زنبورستانهای_استان.xls");
include('../lock_cp.php');
include('bee_counter.php');
$sal = '1396' ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
</head>
<body>
        <?php if(isset($_POST['id_ostan']))
{
	include_once('../login/config.php');
$id_ostan = $_POST['id_ostan'];
$query = "SELECT  DISTINCT id_ostan,id_city,city FROM list_abadi WHERE  id_ostan = '$id_ostan' order by binary city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
        <br />  
<P align="center"> اطلاعات زنبورستان های استان در سال 1396 به تفکیک شهرستان </P>
<table width="98%" height="169" border="1" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0" >
          <tr align="center" class="text1">
               <td height="40" colspan="6" bgcolor="#999999">  میزان تولیدات /<span class="style8"> کیلوگرم</span></td>
               <td width="6%" rowspan="3" bgcolor="#999999">تعداد کلنی تحت پوشش بیمه</td>
               <td colspan="2" bgcolor="#999999">تعداد کندو</td>
               <td colspan="2" bgcolor="#999999">محل تامین ملکه </td>
               <td width="7%" rowspan="3" bgcolor="#999999">تعداد زنبوردار تحت پوشش بیمه</td>
               <td width="6%" rowspan="3" bgcolor="#999999">تعداد افراد شاغل</td>
               <td width="8%" rowspan="3" bgcolor="#999999">زنبوردار</td>
    <td width="9%" rowspan="3" bgcolor="#999999">شهرستان </td>
    <td width="5%" rowspan="3" bgcolor="#999999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td height="27" colspan="4" bgcolor="#999999">سایر فرآورده ها</td>
               <td colspan="2" bgcolor="#999999">عسل</td>
               <td width="6%" rowspan="2" bgcolor="#999999">مدرن</td>
               <td width="6%" rowspan="2" bgcolor="#999999">بومی</td>
               <td width="5%" rowspan="2" bgcolor="#999999">سایر</td>
               <td width="7%" rowspan="2" bgcolor="#999999">خود مصرفی</td>
              </tr>
             <tr align="center" class="text1">
               <td height="34" bgcolor="#999999">برموم</td>
               <td bgcolor="#999999">موم</td>
               <td bgcolor="#999999">گرده گل </td>
               <td bgcolor="#999999">ژل رویال</td>
               <td bgcolor="#999999">مدرن</td>
               <td bgcolor="#999999">بومی</td>
             </tr>
  <tr>
    <?php
$r = 1 ;
 foreach($stmt as $row){
 $id_city = $row['id_city'] ;
?>
    <?php if(city_status($id_ostan,$row['id_city'])=='1') $conf_status='../files/ok.png'; ?>
    <?php if(city_status($id_ostan,$row['id_city'])=='2') $conf_status='../files/notok.png'; ?>
   <td align="center" width="6%" height="35"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_t_bar($id_ostan,$id_city,$sal)?></td>
   <td align="center"width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_t_mom($id_ostan,$id_city,$sal)?></td>
   <td align="center"width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_t_gar($id_ostan,$id_city,$sal)?></td>
   <td align="center"width="7%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_t_jel($id_ostan,$id_city,$sal)?></td>
   <td align="center"width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_to_mo($id_ostan,$id_city,$sal)?></td>
   <td align="center"width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_to_bo($id_ostan,$id_city,$sal)?></td>
 <td align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bem_kand_count($id_ostan,$row['id_city'],$sal) ?></td>
 <td align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_tk_mo($id_ostan,$id_city,$sal)?></td>
 <td align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_tk_bo($id_ostan,$id_city,$sal)?></td>
 <td align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mt_mom_count($id_ostan,$row['id_city'],$sal,'2')?></td>
 <td align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mt_mom_count($id_ostan,$row['id_city'],$sal,'1')?></td>
 <td align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bem_zan_count($id_ostan,$row['id_city'],$sal)?></td>
 <td align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_city_t_sha($id_ostan,$row['id_city'],$sal) ;?></td>
 <td align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bee_count($row['id_city'],$id_ostan)?></td>
    <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?><br /></td>
    <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
  <tr>
    <td align="center"height="23" bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_t_bar($id_ostan,$sal)?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_t_mom($id_ostan,$sal)?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_t_gar($id_ostan,$sal)?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_t_jel($id_ostan,$sal)?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_to_mo($id_ostan,$sal)?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_to_bo($id_ostan,$sal)?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bem_kand($id_ostan,$sal) ?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_tk_mo($id_ostan,$sal)?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_tk_bo($id_ostan,$sal)?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_mt_mom($id_ostan,$sal,'2')?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_mt_mom($id_ostan,$sal,'1') ;?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bemzan($id_ostan,$sal) ;?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_ostan_t_sha($id_ostan,$sal) ;?></td>
   <td align="center"bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bee_count($id_ostan,$sal) ;?></td>
   <td align="center"colspan="2" bgcolor="#FFFFCC" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >کل استان</td>
   </tr>
</table>
<?php }?>
<p align="center">----------- پایان گزارش ---------------</p>
</body>
</html>



