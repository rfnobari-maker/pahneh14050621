<?php 
include('../../lock_expar.php');
include('../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city5'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $z_sal = $_POST['z_sal'] ;
 $Agri_prod_table = 'Agriprod'.str_replace('-','_',$z_sal) ; 
// کد گروه و کد محصول

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
      <span class="style8">برآورد سطح، میزان تولید و عملکرد در هکتار محصولات زراعی </span>
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="264" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                     <option value="1402-1403" <?php if (isset($z_sal) && $z_sal=='1402-1403') echo 'selected=selected'?>>1402-1403</option>
                     <option value="1401-1402" <?php if (isset($z_sal) && $z_sal=='1401-1402') echo 'selected=selected'?>>1401-1402</option>
                     <option value="1400-1401" <?php if (isset($z_sal) && $z_sal=='1400-1401') echo 'selected=selected'?>>1400-1401</option>
                     <option value="1399-1400" <?php if (isset($z_sal) && $z_sal=='1399-1400') echo 'selected=selected'?>>1399-1400</option>
                     <option value="1398-1399" <?php if (isset($z_sal) && $z_sal=='1398-1399') echo 'selected=selected'?>>1398-1399</option>
                   </select>
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: سال زراعی</td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                  <select  name="id_ostan"  class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <option value="-1">انتخاب استان</option>
                  <?php
$query = "SELECT  id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC "  ;
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
				   if (isset($_POST['id_ostan']))
  $id_ostan1= $_POST['id_ostan'] ; 
?></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="47" align="right" bgcolor="#FFFFFF" class="style1" >&nbsp;</td>
                 <td width="214" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="0"> کل استان</option>
                     <?php
$query = "SELECT id_city,city FROM cityname WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
                     <?php }?>
                     </select>
                   <?php 
				   if (isset($_POST['id_city5']))
  $id_city = $_POST['id_city5'] ; 
?></td>
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="42" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >انتخاب نام آبادی</option>
                   <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE  id_mar = '$id_mar' ORDER BY BINARY abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                   <?php }?>
                   </select></td>
                 <td height="42"  align='center' bgcolor="#DDDDDD" class="style8">نام آبادی</td>
                 <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                     <option value="0"> نام مرکز</option>
                     <?php
$query = "SELECT  id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan1' and id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
                     <?php }?>
                     </select>
                   <?php
                 				   if (isset($_POST['id_mar']))
  $id_mar = $_POST['id_mar'] ; 

				 ?>
                   <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td width="146" rowspan="2"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
               </tr>
               <tr >
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >انتخاب نام شهر</option>
                   <?php
$query = "SELECT  add_city,shahr FROM list_city WHERE  id_mar = '$id_mar' ORDER BY BINARY shahr "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="47"  align='center' bgcolor="#DDDDDD" class="style8">:نام شهر</td>
                 </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' />
                   </td>
               </tr>
             </table> 
           </div>
 </form>
            <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1') {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city  =1;}else{ $f_add_city = "add_city = '$add_city'" ;}
$query = "SELECT cod_qroup_amar , cod_mah_amar , cod_mah, no_kesh ,
sum(case when no_kesh = 1  then (s_bar_a)+(s_bar_b)  else 0 end) as s_a , 
sum(case when no_kesh = 2  then (s_bar_a)+(s_bar_b)  else 0 end) as s_d, 
sum(case when no_kesh = 1  then mah_tol else 0 end) as mahtol_a , 
sum(case when no_kesh = 2  then mah_tol else 0 end) as mahtol_d , 


sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM $Agri_prod_table
where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and cod_qroup_amar !='' Group by cod_qroup_amar , cod_mah_amar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Agri_amar1_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
            </table>
            <table width="95%" height="125" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="38" colspan="2" bgcolor="#999999">عملکرد<br />
                 <span class="style2">کیلوگرم</span></td>
               <td colspan="3" bgcolor="#999999">میزان تولید<br />
                <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح <br />
                <span class="style2">هکتار</span></td>
               <td width="15%" rowspan="2" bgcolor="#999999">نام محصول</td>
               <td width="20%" rowspan="2" bgcolor="#999999">نام گروه محصول</td>
               <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="29" bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td width="8%" height="29" bgcolor="#999999">جمع</td>
               <td width="8%" bgcolor="#999999">دیم</td>
               <td width="7%" bgcolor="#999999">آبی</td>
               <td height="29" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td width="6%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
$r = 1 ; 
 foreach($stmt as $row){
 $cod_mah = $row['cod_mah'] ;
round($row['zer_keshta'],3) ;
 $s_a = round($row['s_a'],2) ;
 $s_d = round($row['s_d'],2) ;
 $mahtol_a = round($row['mahtol_a'],2) ;
 $mahtol_d = round($row['mahtol_d'],2) ;
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="40" ><?php echo round($mahtol_d/$s_d*1000) ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000) ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a+$mahtol_d ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_d ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a ;?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a+$s_d ;?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_d ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name_amar($row['cod_mah_amar']);?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php if($row['cod_qroup_amar'] == '4') echo group_name_amar($row['cod_qroup_amar']).'**'; else echo group_name_amar($row['cod_qroup_amar']);?>                 <br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
           </table>
               <?php
}
?>
<P></P>
           <table width="95%" height="108" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="38" colspan="2" bgcolor="#999999">عملکرد<br />
                 <span class="style2">کیلوگرم</span></td>
               <td colspan="3" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح <br />
                <span class="style2">هکتار</span></td>
               <td width="15%" rowspan="2" bgcolor="#999999">نام محصول</td>
               <td width="20%" rowspan="2" bgcolor="#999999">نام گروه محصول</td>
               <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="29" bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td width="8%" height="29" bgcolor="#999999">جمع</td>
               <td width="8%" bgcolor="#999999">دیم</td>
               <td width="7%" bgcolor="#999999">آبی</td>
               <td height="29" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td width="6%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
 $query = "SELECT 
cod_mah ,  
sum(zer_kesht) zer_k1, 
sum(mah_tolp) m_tolp, 
sum(s_bar) s_bar1, 
sum(mah_tol) m_tol 
FROM Vege_prod 
where  z_sal = '$z_sal' and $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city
GROUP BY cod_mah
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
        $s_a = round($row['s_bar1'],2)*1 ; 
	$mahtol_a = round($row['m_tol'],2)*1 ; 
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="37" ><?php echo 0 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000) ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="37" ><?php echo $mahtol_a ;  ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo 0 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo $mahtol_a ;  ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],2)*1 ; ?><br /></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo 0 ; ?><br /></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ; ?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name($row['cod_mah']);?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo group_name_amar('4');?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
}
?>
    </table>
           
          <p><a href="amar.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>