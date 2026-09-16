<?php 
include("../../lock_ce.php");
include_once("../../event.php");
if (isset($_POST['y_prod']))   $y_prod  = $_POST['y_prod'] ; 
if (isset($_POST['no_mush']))  $no_mush = $_POST['no_mush'] ; 
if (isset($_POST['no_moj']))   $no_moj = $_POST['no_moj'] ; 

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
    <table width="100%" height="246" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style1">گزارش  واحد های پرورش قارچ به تفکیک استان</span><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td width="302" height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="no_mush" class="input_text  required" id="no_mush"  style="height:40px ; width:200px ; direction:rtl" tabindex="9">
            <option value="">انتخاب کنید</option>
            <option value="1" <?php if ($no_mush=='1') { echo 'selected="selected"' ; } ?>>صدفی</option>
            <option value="2" <?php if ($no_mush=='2') { echo 'selected="selected"' ; } ?>>دکمه ای</option>
            <option value="3" <?php if ($no_mush=='3') { echo 'selected="selected"' ; } ?>>سایر قارچ های پرورشی خاص</option>
          </select>
        </div></td>
        <td  align='center' bgcolor="#FFFFFF" class="style11"><font size="2" class="style8"> : نوع قارچ پرورشی</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="no_moj" class="input_text required " id="seeAnotherField3"  style="height:40px ; width:200px ; direction:rtl" tabindex="22">
            <option value="">انتخاب کنید</option>
            <option value="1" <?php if ($no_moj=='1') { echo 'selected="selected"' ; } ?> >پروانه بهره برداری/نظام مهندسی</option>
            <option value="2" <?php if ($no_moj=='2') { echo 'selected="selected"' ; } ?>>مشاغل خانگی/وزارت جهاد</option>
            <option value="3" <?php if ($no_moj=='3') { echo 'selected="selected"' ; } ?>>تسهیلات/بسیج سازندگی</option>
            <option value="4" <?php if ($no_moj=='4') { echo 'selected="selected"' ; } ?>>فاقد مجوز</option>
          </select>
        </div></td>
        <td  align='center' bgcolor="#FFFFFF" class="style11"><font size="2" class="style8">: نوع مجوز</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="y_prod" class="input_text  required" id="y_prod" style="height:40px ; width:200px ; direction:rtl">
            <option value="1397" <?php if ($y_prod=='1397') echo 'selected=selected'?>>1397</option>
            </select>
          </div></td>
        <td width="148"  align='center' bgcolor="#FFFFFF" class="style11"><span class="input_text"><font size="2" class="style8">: عملکرد سال </font></span></td>
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
               <td width="56"><form  action="Mush_rep4_xls.php" method="post">
                 <input type="hidden" name="y_prod" value="<?php echo $y_prod ;?>" />
                 <input type="hidden" name="no_mush" value="<?php echo $no_mush ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
               <td width="56"><form  action="Mush_rep4_doc.php" method="post">
                 <input type="hidden" name="y_prod" value="<?php echo $y_prod ;?>" />
                 <input type="hidden" name="no_mush" value="<?php echo $no_mush ;?>" />
                 <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
               </form></td>
             </tr>
           </table>
           <br />
           <table width="99%" height="331" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td dir="rtl" rowspan="3" bgcolor="#999999"> كمپوست  مصرفي در سال<br /><span class="style2">(تن)</span></td>
               <td dir="rtl" rowspan="3" bgcolor="#999999">کل تولید سالانه<br />                 <span class="style2"> (تن)</span></td>
               <td dir="rtl" rowspan="3" bgcolor="#999999">عملكرد<br /><span class="style2">(کیلوگرم / مترمربع)</span></td>
               <td dir="rtl" rowspan="3" bgcolor="#999999">سطح زيركشت كل <span class="style2">(متر مربع)</span></td>
               <td height="38" colspan="3" bgcolor="#999999">تعداد افراد شاغل</td>
               <td colspan="4" bgcolor="#999999">وضعیت تولید </td>
               <td rowspan="3" bgcolor="#999999">تعداد واحد</td>
               <td width="11%" rowspan="3" bgcolor="#999999">استان </td>
               <td width="5%" rowspan="3" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="46" rowspan="2" bgcolor="#999999">لیسانس و بالاتر</td>
               <td rowspan="2" bgcolor="#999999">دیپلم و فوق دیپلم</td>
               <td rowspan="2" bgcolor="#999999">زیر دیپلم</td>
               <td height="46" colspan="3" bgcolor="#999999"><span class="style8">*</span> غیر فعال</td>
               <td width="6%" rowspan="2" bgcolor="#999999">فعال</td>
              </tr>
             <tr align="center" class="text1">
               <td width="7%" height="46" bgcolor="#999999">3</td>
               <td width="6%" bgcolor="#999999">2</td>
               <td width="5%" bgcolor="#999999">1</td>
              </tr>
             <tr>
               <?php
 if ($no_mush == '')  { $f_no_mush  = 1 ; }else{ $f_no_mush = "no_mush = '$no_mush'" ;}
 if ($no_moj == '')   { $f_no_moj  = 1  ; }else{ $f_no_moj = "no_moj = '$no_moj'" ;}

 $query = "select  Mushroom.id_ostan ,
count(Mushroom.id) as unit, 
sum(z_es)  as z_es ,
sum(z_vag) as z_vag ,
count(Mushroom_prod.id) as prod, 
sum(case when Mushroom_prod.v_unit = '1' then 1 else 0 end) as v_unit_1 ,
sum(case when Mushroom_prod.v_unit = '2' then 1 else 0 end) as v_unit_2 ,
sum(case when Mushroom_prod.v_unit = '3' then 1 else 0 end) as v_unit_3 ,
sum(case when Mushroom_prod.v_unit = '4' then 1 else 0 end) as v_unit_4 ,
sum(z_dep) as z_dep ,
sum(dep) as dep ,
sum(lisan) as lisan ,
sum(zer_kesh) as zer_kesh ,
sum(tol_avg) as tol_avg ,
sum(mah_tol) as mah_tol ,
sum(comp) as comp 
FROM (select * from Mushroom where $f_no_mush and $f_no_moj) Mushroom 
left join
(select * from Mushroom_prod where y_prod = '$y_prod') 
 Mushroom_prod ON Mushroom_prod.unit_id = Mushroom.id 
group by Mushroom.id_ostan
ORDER BY FIELD(Mushroom.id_ostan,'03','04','24','10','30','16','18','23','31','14','28','29','09','06','19','20'
,'11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="7%" height="45" ><?php echo $row['comp'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo $row['mah_tol'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="10%" ><?php echo  round((($row['mah_tol'] *1000 ) / $row['zer_kesh']),2) ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="10%" ><?php echo $row['zer_kesh'] ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['lisan'] ; ?></td>
               <td width="4%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['dep'] ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_dep'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_4'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_3'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_2'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_1'] ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['unit'] ; ?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo ostan_name($row['id_ostan']);?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
 $query = "select 
count(Mushroom.id) as unit, 
sum(z_es)  as z_es ,
sum(z_vag) as z_vag ,
count(Mushroom_prod.id) as prod, 
sum(case when Mushroom_prod.v_unit = '1' then 1 else 0 end) as v_unit_1 ,
sum(case when Mushroom_prod.v_unit = '2' then 1 else 0 end) as v_unit_2 ,
sum(case when Mushroom_prod.v_unit = '3' then 1 else 0 end) as v_unit_3 ,
sum(case when Mushroom_prod.v_unit = '4' then 1 else 0 end) as v_unit_4 ,
sum(z_dep) as z_dep ,
sum(dep) as dep ,
sum(lisan) as lisan ,
sum(zer_kesh) as zer_kesh ,
sum(mah_tol) as mah_tol ,
sum(comp) as comp 
FROM (select * from Mushroom where $f_no_mush and $f_no_moj) Mushroom 
left join
(select * from Mushroom_prod where y_prod = '$y_prod') 
 Mushroom_prod ON Mushroom_prod.unit_id = Mushroom.id "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr align="center" class="text1">
               <td rowspan="3" bgcolor="#999999" dir="rtl"> كمپوست  مصرفي در سال<br />
                 <span class="style2">(تن)</span></td>
               <td rowspan="3" bgcolor="#999999" dir="rtl">کل تولید سالانه<br />
                 <span class="style2"> (تن)</span></td>
               <td rowspan="3" bgcolor="#999999" dir="rtl">عملكرد<br />
                 <span class="style2">(کیلوگرم / مترمربع)</span></td>
               <td rowspan="3" bgcolor="#999999" dir="rtl">سطح زيركشت كل <span class="style2">(متر مربع)</span></td>
               <td height="38" colspan="3" rowspan="2" bgcolor="#999999">تعداد افراد شاغل</td>
               <td height="38" colspan="4" bgcolor="#999999">وضعیت تولید </td>
               <td rowspan="3" bgcolor="#999999">تعداد واحد</td>
               <td colspan="2" rowspan="3" bgcolor="#999999">&nbsp;</td>
              </tr>
             <tr align="center" class="text1">
               <td colspan="3" bgcolor="#999999"><span class="style8">*</span> غیر فعال</td>
               <td rowspan="2" bgcolor="#999999">فعال</td>
             </tr>
             <tr align="center" class="text1">
               <td height="36" bgcolor="#999999">لیسانس و بالاتر</td>
               <td height="36" bgcolor="#999999">دیپلم و فوق دیپلم</td>
               <td height="36" bgcolor="#999999">زیر دیپلم</td>
               <td bgcolor="#999999">3</td>
               <td bgcolor="#999999">2</td>
               <td bgcolor="#999999">1</td>
              </tr>
             <tr>
               <td height="45" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['comp'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['mah_tol'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo  round((($row['mah_tol'] *1000 ) / $row['zer_kesh']),2) ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['zer_kesh'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['lisan'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['dep'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_dep'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_4'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_3'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_2'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_1'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['unit'] ; ?><br /></td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
             </tr>
   </table>

<div align="right" dir="rtl" style="margin-right:25px" class="style8">
  <p>*<br />
    1- در حال اخذ پروانه تاسیس <br />
    2- دارای پیشرفت فیزیکی<br />
    3- غیرفعال</p>
</div>

           <p>
             <?php }?>
           </p>
           <p>
             <a href="Mushroom.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a>
            </p>    
             </p>
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