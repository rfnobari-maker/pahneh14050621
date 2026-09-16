<?php 
include("../../lock_oce.php");
include("../../Jalali.php");
include("../../event.php");
include('counter11.php');
if (isset($_POST['z_sal']))   $z_sal= $_POST['z_sal'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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
<?php include('../../login/config.php');
?>
<form  id="reg-form" method="post" action="#1">
  <p>&nbsp;</p>
  <div style="width: 450px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:15px" >
    <table width="100%" height="200" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style1">گزارش اطلاعات زراعی استان به تفکیک محصول</span><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
        <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl" >
         <?php $id_ostan1 = $id_ostan ; 
$query = "SELECT id_ostan,ostan FROM ostanname"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
          <?php 
		   }?>
        </select>
          <?php 
?></td>
        <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
            <option value="1394-1395" <?php if ($z_sal=='1394-1395') echo 'selected=selected'?>>1394-1395</option>
            <option value="1395-1396" <?php if ($z_sal=='1395-1396') echo 'selected=selected'?>>1395-1396</option>
            </select>
        </div></td>
        <td width="112"  align='center' bgcolor="#FFFFFF" class="style11"><span class="input_text"><font size="2" class="style8">: سال زراعی</font></span></td>
      </tr>
      <tr >
        <td align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
        <td height="60"  align='center' bgcolor="#FFFFFF" class="style11">&nbsp;</td>
      </tr>
    </table>
  </div>
</form>
<?php 
   if (isset($_POST['z_sal']))
   {
 $z_sal= $_POST['z_sal'] ; 
?>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <p>&nbsp;</p>
           <table width="98%" height="179" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="55" colspan="3" bgcolor="#999999">میزان تولید ، کل / بیمه شده<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح برداشت ،   اول / دوم<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت ،  اول / دوم<br />
                 <span class="style2">هکتار</span></td>
               <td width="11%" rowspan="2" bgcolor="#999999">نام محصول</td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="57" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="57" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="57" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td width="6%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
$query = "SELECT  DISTINCT cod_mah FROM Agri_prod where id_ostan='$id_ostan' and z_sal = '$z_sal' order by cod_qroup "  ;
$stmt = $dbh->prepare($query);
$stmt->execute(); 
$r = 1 ;
 foreach($stmt as $row){
 $cod_mah = $row['cod_mah'] ;
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="57" ><?php echo Num2Fa(round(sum_per_mah_tol($cod_mah,'1',$id_ostan,$z_sal) + sum_per_mah_tol($cod_mah,'2',$id_ostan,$z_sal)*1,1)) ?><br />
                 <?php echo Num2Fa(round(sum_per_mah_tol_bem($cod_mah,'1',$id_ostan,$z_sal) + sum_per_mah_tol_bem($cod_mah,'2',$id_ostan,$z_sal)*1,1)) ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo Num2Fa(round(sum_per_mah_tol($cod_mah,'2',$id_ostan,$z_sal)*1,1)) ?><br />
                <?php echo Num2Fa(round(sum_per_mah_tol_bem($cod_mah,'2',$id_ostan,$z_sal)*1,1)) ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo Num2Fa(round(sum_per_mah_tol($cod_mah,'1',$id_ostan,$z_sal)*1,1)) ?><br />
                 <?php echo Num2Fa(round(sum_per_mah_tol_bem($cod_mah,'1',$id_ostan,$z_sal)*1,1)) ?></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round((sum_mah_s_bar_a($cod_mah,'1',$id_ostan,$z_sal) + sum_mah_s_bar_a($cod_mah,'2',$id_ostan,$z_sal))/10000,1)) ?><br />
                 <?php echo Num2Fa(round((sum_mah_s_bar_b($cod_mah,'1',$id_ostan,$z_sal) + sum_mah_s_bar_b($cod_mah,'2',$id_ostan,$z_sal))/10000,1)) ?></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(sum_mah_s_bar_a($cod_mah,'2',$id_ostan,$z_sal)/10000,1)) ?><br />
                 <?php echo Num2Fa(round(sum_mah_s_bar_b($cod_mah,'2',$id_ostan,$z_sal)/10000,1)) ?></td>
               <td width="10%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(sum_mah_s_bar_a($cod_mah,'1',$id_ostan,$z_sal)/10000,1)) ?><br />
                 <?php echo Num2Fa(round(sum_mah_s_bar_b($cod_mah,'1',$id_ostan,$z_sal)/10000,1)) ?></td>
               <td width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round((sum_mah_zer_kesht_a($cod_mah,'1',$id_ostan,$z_sal) + sum_mah_zer_kesht_a($cod_mah,'2',$id_ostan,$z_sal))/10000,1)) ?><br />
                 <?php echo Num2Fa(round((sum_mah_zer_kesht_b($cod_mah,'1',$id_ostan,$z_sal) + sum_mah_zer_kesht_b($cod_mah,'2',$id_ostan,$z_sal))/10000,1)) ?></td>
               <td width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(sum_mah_zer_kesht_a($cod_mah,'2',$id_ostan,$z_sal)/10000,1)) ?><br />
                 <?php echo Num2Fa(round(sum_mah_zer_kesht_b($cod_mah,'2',$id_ostan,$z_sal)/10000,1)) ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(sum_mah_zer_kesht_a($cod_mah,'1',$id_ostan,$z_sal)/10000,1)) ?><br />
                 <?php echo Num2Fa(round(sum_mah_zer_kesht_b($cod_mah,'1',$id_ostan,$z_sal)/10000,1)) ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name($row['cod_mah']);?><br />
                 <?php echo $row['cod_mah'];?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
           </table>
           </div>
<?php }?>
           <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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



