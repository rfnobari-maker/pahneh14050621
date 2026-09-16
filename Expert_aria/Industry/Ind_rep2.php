<?php 
include("../../lock_expar.php");
include_once("../../event.php");
if (isset($_POST['y_prod']))   $y_prod= $_POST['y_prod'] ; 
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    	<script src="../../15_files/jquery.js" type="text/javascript"></script>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	text-align: center;
}
    </style>
</head>
<body>
  <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
      </p>
<form  id="reg-form" method="post" action="#1">
  <p>&nbsp;</p>
  <div style="width: 450px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:15px" >
    <table width="100%" height="268" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style1">گزارش  واحد های صنایع تبدیلی و غذایی به تفکیک استان</span><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr>
        <td height="68"><div align="right">
                   <?php $id_ostan1 = $id_ostan?>
          <select  name="id_ostan" disabled="disabled" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
            <option value="">کل کشور</option>
            <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php 
		   }?>
            </select>
          </div></td>
        <td class="style8">:  استان مورد نظر</td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="y_prod" class="input_text  required" id="y_prod" style="height:40px ; width:170px ; direction:rtl">
            <option value="1402" <?php if ($y_prod=='1402') echo 'selected=selected'?>>1402</option>
            <option value="1401" <?php if ($y_prod=='1401') echo 'selected=selected'?>>1401</option>
            <option value="1400" <?php if ($y_prod=='1400') echo 'selected=selected'?>>1400</option>
            <option value="1399" <?php if ($y_prod=='1399') echo 'selected=selected'?>>1399</option>
            </select>
          </div></td>
        <td width="112"  align='center' bgcolor="#FFFFFF" class="style11"><span class="input_text"><font size="2" class="style8">: عملکرد سال </font></span></td>
      </tr>
      <tr >
        <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
      </tr>
    </table>
  </div>
</form>
<?php 
   if (isset($_POST['y_prod']))
   {
?>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="122" height="56" border="0" align="center">
             <tr>
               <td width="56"><form  action="Ind_rep2_xls.php" method="post">
                 <input type="hidden" name="y_prod" value="<?php echo $y_prod ;?>" />
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
               <td width="56"><form  action="Ind_rep2_doc.php" method="post">
                 <input type="hidden" name="y_prod" value="<?php echo $y_prod ;?>" />
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                 <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
               </form></td>
             </tr>
           </table>
           <br />
           <table width="90%" height="242" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="41" colspan="4" bgcolor="#999999">دوازده ماهه</td>
               <td colspan="4" bgcolor="#999999">شش ماهه<br /></td>
               <td width="17%" rowspan="2" bgcolor="#999999">تعداد واحد ثبت شده </td>
               <td width="17%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?></td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="41" bgcolor="#999999">فاقد عملکرد</td>
               <td bgcolor="#999999">غیرفعال </td>
               <td bgcolor="#999999">نیمه فعال</td>
               <td bgcolor="#999999">فعال</td>
               <td height="41" bgcolor="#999999">فاقد عملکرد</td>
               <td bgcolor="#999999">غیرفعال </td>
               <td bgcolor="#999999">نیمه فعال</td>
               <td bgcolor="#999999">فعال</td>
              </tr>
             <tr>
               <?php
if ($id_ostan1 == '') 
{
 $query = "SELECT
ind_unit.id_ostan ,
count(ind_unit.id) as unit, 
count(ind_unit_info.id) as ind_p, 
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_3 ,
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_3 
FROM ind_unit 
left join
(select * from ind_unit_info where y_prod = $y_prod) 
 ind_unit_info ON ind_unit_info.ShenaseKasboKar = ind_unit.ShenaseKasboKar 
group by ind_unit.id_ostan
ORDER BY FIELD(ind_unit.id_ostan,'03','04','24','10','30','16','18','23','31','14','28','29','09','06','19','20'
,'11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')";
}
else
{
 $query = "SELECT
ind_unit.id_ostan ,ind_unit.id_city ,
count(ind_unit.id) as unit, 
count(ind_unit_info.id) as ind_p, 
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_3 ,
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_3 
FROM ind_unit 
left join
(select * from ind_unit_info where y_prod = $y_prod) 
 ind_unit_info ON ind_unit_info.ShenaseKasboKar = ind_unit.ShenaseKasboKar 
 where ind_unit.id_ostan=$id_ostan1
group by ind_unit.id_city
ORDER BY ind_unit.id_city";
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
 $v_unit_6_4  = $row['unit']-($row['v_unit_6_1']+$row['v_unit_6_2']+$row['v_unit_6_3']) ; 
 $v_unit_12_4 = $row['unit']-($row['v_unit_12_1']+$row['v_unit_12_2']+$row['v_unit_12_3']) ; 
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="38" ><?php echo $v_unit_12_4 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo $row['v_unit_12_3'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo $row['v_unit_12_2'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo $row['v_unit_12_1'] ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_unit_6_4 ; ?><br /></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_3'] ; ?><br /></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_2'] ; ?><br /></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_1'] ; ?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['unit'] ; ?></td>
               <td class="style8" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall">
                  <?php if($id_ostan1=='') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$id_ostan1)  ; ?>
               </span><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
if ($id_ostan1 == '') 
{
 $query = "SELECT
ind_unit.id_ostan ,
count(ind_unit.id) as unit, 
count(ind_unit_info.id) as ind_p, 
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_3 ,
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_3 
FROM ind_unit 
left join
(select * from ind_unit_info where y_prod = $y_prod) 
 ind_unit_info ON ind_unit_info.ShenaseKasboKar = ind_unit.ShenaseKasboKar  "  ;
}
else 
{
 $query = "SELECT
ind_unit.id_ostan ,
count(ind_unit.id) as unit, 
count(ind_unit_info.id) as ind_p, 
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '06'  then 1 else 0 end) as v_unit_6_3 ,
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_3 
FROM ind_unit 
left join
(select * from ind_unit_info where y_prod = $y_prod) 
 ind_unit_info ON ind_unit_info.ShenaseKasboKar = ind_unit.ShenaseKasboKar 
 where ind_unit.id_ostan = '$id_ostan1' " 
  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $v_unit_6_4  = $row['unit']-($row['v_unit_6_1']+$row['v_unit_6_2']+$row['v_unit_6_3']) ; 
 $v_unit_12_4 = $row['unit']-($row['v_unit_12_1']+$row['v_unit_12_2']+$row['v_unit_12_3']) ; 

?>
             <tr align="center" class="text1">
               <td height="34" colspan="4" bgcolor="#999999">دوازده ماهه</td>
               <td colspan="4" bgcolor="#999999">شش ماهه</td>
               <td rowspan="2" bgcolor="#999999">تعداد واحد ثبت شده </td>
               <td colspan="2" rowspan="2" bgcolor="#999999">&nbsp;</td>
              </tr>
             <tr align="center" class="text1">
               <td height="40" bgcolor="#999999">فاقد عملکرد</td>
               <td bgcolor="#999999">غیرفعال </td>
               <td bgcolor="#999999">نیمه فعال</td>
               <td bgcolor="#999999">فعال</td>
               <td height="40" bgcolor="#999999">فاقد عملکرد</td>
               <td bgcolor="#999999">غیرفعال </td>
               <td bgcolor="#999999">نیمه فعال</td>
               <td bgcolor="#999999">فعال</td>
              </tr>
             <tr>
               <td height="39" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $v_unit_12_4 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['v_unit_12_3'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['v_unit_12_2'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['v_unit_12_1'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_unit_6_4 ; ?><br /></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_3'] ; ?><br /></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_2'] ; ?><br /></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_1'] ; ?><br /></td>
               <td class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['unit'] ; ?></td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
              </tr>
   </table>
           <?php }?>
<p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
</p>
           <p>&nbsp;</p>
      </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>