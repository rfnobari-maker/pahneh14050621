<?php 
include('../../lock_ce.php');
include('../../event.php');
include('Greenh_DR_counter.php');
$Base = $_POST['Base'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    </style>

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
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      </p>
<p class="style8"><span class="style19">گزارش خلاصه روزانه واحدهای گلخانه </span><br />
  </p>
  این گزارش شامل نوع کشت فضای باز نمیباشد<br />
  <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <form  id="reg-form" method="post" action="#1">
             <div style="width: 300px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="128" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="189" height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <select  name="Base" class="style8" id="Base" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <option value="-1" <?php if ($Base=='-1') echo 'selected=selected' ;?>>کلیه استان ها </option>
                  <option value="-2" <?php if ($Base=='-2') echo 'selected=selected' ;?>>کلیه شهرستان ها</option>

                   <?php
$query = "SELECT  id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$Base) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                   <?php 
		   }?>
                 </select>
                   <?php 
				   if (isset($_POST['id_ostan']))
  $id_ostan1= $_POST['id_ostan'] ; 
?></td>
                 <td width="111"  align='center' bgcolor="#DDDDDD" class="style8">: نوع گزارش </td>
               </tr>
               <tr >
                 <td height="60" colspan="2" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' />
                   </td>
               </tr>
             </table> 
           </div>
<?php 
              if(isset($_POST['action']))
{
include('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_today = jdate("Y/m/d");

     if ($Base == '-1')   { $v_id_ostan = 1 ; $v_Group = id_ostan ;} 
else if ($Base == '-2')   { $v_id_ostan = 1 ; $v_Group = "id_ostan,id_city ";}
else if ($Base  > '-1')   { $v_id_ostan = "id_ostan='$Base'" ; $v_Group = id_city ;}

 $query = "SELECT id_ostan,id_city,city FROM cityname where $v_id_ostan group by $v_Group ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21'),id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
 </form>
           <table width="122" height="56" border="0" align="center">
             <tr>
     <td width="56"><form  action="Greenh_daily_report_xls.php" method="post">
       <input type="hidden" name="Base"  value="<?php echo  $Base ;?>" />
       <input type="hidden" name="date_today"  value="<?php echo  $date_today ;?>" />
       <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
     </form></td>
     <td width="56"><form  action="Greenh_daily_report_doc.php" method="post">
       <input type="hidden" name="Base"  value="<?php echo  $Base ;?>" />
       <input type="hidden" name="date_today"  value="<?php echo  $date_today ;?>" />
       <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
     </form></td>
   </tr>
 </table>
 <span class="style1"><a name="1" id="1"></a></span>
 <table width="85%" height="248" border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0" >
   <tr align="center" class="text1">
               <td bgcolor="#999999"> افزایش یا کاهش مساحت گلخانه نسبت به روز قبل</td>
               <td bgcolor="#999999"> افزایش یا کاهش تعداد واحد نسبت به روز قبل</td>
               <td bgcolor="#999999">مساحت گلخانه در روز قبل/ مترمربع</td>
               <td bgcolor="#999999">تعداد واحد در روز قبل </td>
               <td width="12%" bgcolor="#999999">مساحت گلخانه در روز جاری/ مترمربع</td>
               <td width="11%" bgcolor="#999999">تعداد واحد در روز جاری <br />
                <?php echo $date_today ?></td>
<?PHP if($Base != '-1') {?> 
               <td width="15%" bgcolor="#999999" >شهرستان</td>
<?php }?>
               <td width="16%" bgcolor="#999999">استان </td>
               <td width="6%" bgcolor="#999999">ردیف</td>
             </tr>
  <tr>
    <?php
$r = 1 ;
 foreach($stmt as $row){
?>
    <td width="10%" height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1') 
	{ 	echo round(ostan_mz($row['id_ostan'])  - ostan_mz_noToday($row['id_ostan'],$date_today),1) ;}
	else { 	echo round(city_mz($row['id_ostan'],$row['id_city']) - city_mz_noToday($row['id_ostan'],$row['id_city'],$date_today),1) ;	}?></td>
    <td width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
	<?php if($Base == '-1') 
	{ 	echo ostan_counter($row['id_ostan']) - ostan_counter_noToday($row['id_ostan'],$date_today) ;}
	else { 	echo city_counter($row['id_ostan'],$row['id_city']) - city_counter_noToday($row['id_ostan'],$row['id_city'],$date_today) ;	}?></td>
    <td width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1') 
	{ 	echo ostan_mz_noToday($row['id_ostan'],$date_today) ;}
	else { 	echo city_mz_noToday($row['id_ostan'],$row['id_city'],$date_today) ;	}?></td>
    <td width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1') 
	{ 	echo ostan_counter_noToday($row['id_ostan'],$date_today) ;}
	else { 	echo city_counter_noToday($row['id_ostan'],$row['id_city'],$date_today) ;	}?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
		<?php if($Base == '-1') { 	echo ostan_mz($row['id_ostan']) ;}
	else { 	echo city_mz($row['id_ostan'],$row['id_city']) ;	}?> </td>

    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
		<?php if($Base == '-1') { 	echo ostan_counter($row['id_ostan']) ;}
	else { 	echo city_counter($row['id_ostan'],$row['id_city']) ;	}?> </td>
<?PHP if($Base != '-1') {?> 
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'];?></td>
<?php }?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo ostan_name($row['id_ostan']);?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
   <tr align="center" class="text1">
               <td bgcolor="#999999"> افزایش یا کاهش مساحت گلخانه نسبت به روز قبل</td>
               <td bgcolor="#999999"> افزایش یا کاهش تعداد واحد نسبت به روز قبل</td>
               <td bgcolor="#999999">مساحت گلخانه در روز قبل/ مترمربع</td>
               <td bgcolor="#999999">تعداد واحد در روز قبل </td>
               <td width="12%" bgcolor="#999999">مساحت گلخانه در روز جاری/ مترمربع</td>
               <td width="11%" bgcolor="#999999">تعداد واحد در روز جاری </td>
               <td colspan="3" bgcolor="#999999" >&nbsp;</td>
              </tr>
  <tr>
    <td width="10%" height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1' or $Base=='-2')
	{ 	echo round(kol_mz()  - kol_mz_noToday($date_today),1) ;}
	else { 	echo round(ostan_mz($row['id_ostan'])  - ostan_mz_noToday($row['id_ostan'],$date_today),1) ;}?></td>
    <td width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
	<?php if($Base == '-1' or $Base=='-2')
	{ 	echo kol_counter() -  kol_counter_noToday($date_today) ;}
	else { 	echo ostan_counter($row['id_ostan']) - ostan_counter_noToday($row['id_ostan'],$date_today) ;}?></td>
    <td width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1' or $Base=='-2')
	{ 	echo kol_mz_noToday($date_today) ;}
	else { echo ostan_mz_noToday($row['id_ostan'],$date_today) ;}?></td>
    <td width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if($Base == '-1' or $Base=='-2')
	{ 	echo kol_counter_noToday($date_today) ;}
	else { echo ostan_counter_noToday($row['id_ostan'],$date_today) ;}?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
		<?php if($Base == '-1' or $Base=='-2') { 	echo kol_mz() ;}
	else { echo ostan_mz($row['id_ostan']) ; 	}?> </td>

    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
		<?php if($Base == '-1' or $Base=='-2') { echo kol_counter() ;}
	else { 	echo ostan_counter($row['id_ostan']) ;	}?> </td>
    <td colspan="3"  class="style19" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>جمع کل </td>
    </tr>
       </table>
<?php }?>
          <p><a href="Greenhous.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg"  alt="" width="118" height="47" border="0"/> </a></p>           </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>