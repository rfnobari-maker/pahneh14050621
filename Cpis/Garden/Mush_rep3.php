<?php
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../side_menu1.php');
if (isset($_POST['y_prod']))     $y_prod   = $_POST['y_prod'] ; 
if (isset($_POST['id_ostan']))   $id_ostan = $_POST['id_ostan'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
 <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
	text-align: center;
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
<form  id="reg-form" method="post" action="#1">
      <span class="style19">گزارش  واحد های پرورش قارچ به تفکیک شهرستان</span><br />
   <div style="width: 450px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <table width="100%" height="174" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="22" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" >
        
        <select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl" >
          <?php
$query = "SELECT  id_ostan,ostan FROM ostanname ORDER BY BINARY ostan"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
          <?php 
		   }?>
        </select>
                  </td>
        <td  align='center' bgcolor="#FFFFFF" class="style11"><font size="2" class="style8">: استان </font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="y_prod" class="input_text  required" id="y_prod" style="height:40px ; width:170px ; direction:rtl">
            <option value="1404" <?php if ($y_prod=='1404') echo 'selected=selected'?>>1404</option>
            <option value="1403" <?php if ($y_prod=='1403') echo 'selected=selected'?>>1403</option>
            <option value="1402" <?php if ($y_prod=='1402') echo 'selected=selected'?>>1402</option>
            <option value="1401" <?php if ($y_prod=='1401') echo 'selected=selected'?>>1401</option>
            <option value="1400" <?php if ($y_prod=='1400') echo 'selected=selected'?>>1400</option>
            <option value="1399" <?php if ($y_prod=='1399') echo 'selected=selected'?>>1399</option>
            <option value="1398" <?php if ($y_prod=='1398') echo 'selected=selected'?>>1398</option>
            <option value="1397" <?php if ($y_prod=='1397') echo 'selected=selected'?>>1397</option>
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
<table width="122" height="56" border="0" align="center">
        <tr>
               <td width="56"><form  action="Mush_rep3_xls.php" method="post">
                 <input type="hidden" name="y_prod" value="<?php echo $y_prod ;?>" />
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
               <td width="56"><form  action="Mush_rep3_doc.php" method="post">
                 <input type="hidden" name="y_prod" value="<?php echo $y_prod ;?>" />
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />
                 <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
               </form></td>
             </tr>
           </table>
           <br />
           <table width="90%"  align="center" class="my-table" >
             <tr align="center" class="text1">
               <td height="55" colspan="4" bgcolor="#999999">تعداد واحد دارای عملکرد سالیانه</td>
               <td colspan="4" bgcolor="#999999">تعداد واحد پرورش قارچ<br /></td>
               <td width="17%" rowspan="2" bgcolor="#999999">شهرستان </td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="46" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">سایر </td>
               <td bgcolor="#999999">دکمه ای</td>
               <td bgcolor="#999999">صدفی</td>
               <td height="46" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">سایر </td>
               <td bgcolor="#999999">دکمه ای</td>
               <td bgcolor="#999999">صدفی</td>
              </tr>
             <tr>
               <?php
 $query = "SELECT
Mushroom.id_city ,
count(Mushroom.id) as mush, 
sum(case when Mushroom.no_mush = '1' then 1 else 0 end) as mush_1 ,
sum(case when Mushroom.no_mush = '2' then 1 else 0 end) as mush_2 ,
sum(case when Mushroom.no_mush = '3' then 1 else 0 end) as mush_3 ,
count(Mushroom_prod.id) as mush_p, 
sum(case when Mushroom_prod.no_mush = '1' then 1 else 0 end) as mush_p_1 ,
sum(case when Mushroom_prod.no_mush = '2' then 1 else 0 end) as mush_p_2 ,
sum(case when Mushroom_prod.no_mush = '3' then 1 else 0 end) as mush_p_3
FROM (select * from Mushroom where id_ostan = $id_ostan) Mushroom 
left join
(select * from Mushroom_prod where y_prod = $y_prod ) 
Mushroom_prod ON Mushroom_prod.unit_id = Mushroom.id 
group by Mushroom.id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="45" ><?php echo $row['mush_p'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo $row['mush_p_3'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo $row['mush_p_2'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo $row['mush_p_1'] ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mush'] ; ?><br /></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mush_3'] ; ?><br /></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mush_2'] ; ?><br /></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mush_1'] ; ?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo  city_name1($row['id_city'],$id_ostan) ; ?><br />                 <br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
 $query = "SELECT
count(Mushroom.id) as kol_mush, 
sum(case when Mushroom.no_mush = '1' then 1 else 0 end) as kol_mush_1 ,
sum(case when Mushroom.no_mush = '2' then 1 else 0 end) as kol_mush_2 ,
sum(case when Mushroom.no_mush = '3' then 1 else 0 end) as kol_mush_3 ,
count(Mushroom_prod.id) as kol_mush_p, 
sum(case when Mushroom_prod.no_mush = '1' then 1 else 0 end) as kol_mush_p_1 ,
sum(case when Mushroom_prod.no_mush = '2' then 1 else 0 end) as kol_mush_p_2 ,
sum(case when Mushroom_prod.no_mush = '3' then 1 else 0 end) as kol_mush_p_3
FROM (select * from Mushroom where id_ostan = $id_ostan) Mushroom 
left join
(select * from Mushroom_prod where y_prod = $y_prod) 
 Mushroom_prod ON Mushroom_prod.unit_id = Mushroom.id "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr align="center" class="text1">
               <td height="38" colspan="4" bgcolor="#999999">تعداد واحد دارای عملکرد سالیانه</td>
               <td colspan="4" bgcolor="#999999">تعداد واحد پرورش قارچ</td>
               <td colspan="2" rowspan="2" bgcolor="#999999">&nbsp;</td>
              </tr>
             <tr align="center" class="text1">
               <td height="46" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">سایر </td>
               <td bgcolor="#999999">دکمه ای</td>
               <td bgcolor="#999999">صدفی</td>
               <td height="46" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">سایر </td>
               <td bgcolor="#999999">دکمه ای</td>
               <td bgcolor="#999999">صدفی</td>
              </tr>
             <tr>
               <td height="45" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['kol_mush_p'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['kol_mush_p_3'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['kol_mush_p_2'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['kol_mush_p_1'] ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_mush'] ; ?><br /></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_mush_3'] ; ?><br /></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_mush_2'] ; ?><br /></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_mush_1'] ; ?><br /></td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
             </tr>
   </table>
           <?php }?>

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