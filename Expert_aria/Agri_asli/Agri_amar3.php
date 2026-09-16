<?php 
include('../../lock_expar.php');
include('../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $z_sal = $_POST['z_sal'] ;
if (isset($_POST['mah_qroup'])) $mah_qroup = $_POST['mah_qroup'] ;
if (isset($_POST['mah_name'])) $mah_name = $_POST['mah_name'] ;
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
<form  id="reg-form" method="post" action="#1">
  <p>&nbsp;</p>
  <div style="width: 450px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:15px" >
    <table width="100%" height="342" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style1">برآورد سطح و میزان تولید هر محصول</span><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
            <option value="1402-1403" <?php if (isset($z_sal) && $z_sal=='1402-1403') echo 'selected=selected'?>>1402-1403</option>
            <option value="1401-1402" <?php if (isset($z_sal) && $z_sal=='1401-1402') echo 'selected=selected'?>>1401-1402</option>
            <option value="1400-1401" <?php if (isset($z_sal) && $z_sal=='1400-1401') echo 'selected=selected'?>>1400-1401</option>
            <option value="1399-1400" <?php if (isset($z_sal) && $z_sal=='1399-1400') echo 'selected=selected'?>>1399-1400</option>
            </select>
          </div></td>
        <td width="112"  align='center' bgcolor="#DDDDDD" class="style11"><span class="input_text"><font size="2" class="style8">: سال زراعی</font></span></td>
      </tr>
      <tr>
        <td height="68"><div align="right">
          <select  name="id_ostan" class="input_text" id="id_ostan2" style="width:170px ; height:40px" dir="rtl"  >
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
      <tr >
        <td align="left" bgcolor="#DDDDDD"><div align="right">
        <select  name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="22" dir="rtl" onchange="this.form.submit()">
          <option value="" > انتخاب گروه</option>
          <?php
$query = "SELECT DISTINCT group_cod,group_name FROM product_z_amar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
          <?php }?>
          </select></div></td>
        <td height="60"  align='center' bgcolor="#DDDDDD" class="style11"><font size="2" class="style8">: انتخاب گروه</font></td>
      </tr>
      <tr >
        <td align="left" bgcolor="#FFFFFF"><div align="right">
                   <select  name="mah_name" class="required input_text mar" style="width:170px ; height:40px" tabindex="23" dir="rtl">
                     <?php
 $query = "SELECT DISTINCT product_cod_amar,product_name FROM product_z_amar WHERE  group_cod = '$mah_qroup' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['product_cod_amar'] ;?>"
   <?php if ($row['product_cod_amar']==$mah_name) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
                     <?php
}
?>
                   </select>
                 </div></td>
        <td height="60"  align='center' bgcolor="#FFFFFF" class="style11"><font size="2" class="style8">: نام محصول</font></td>
      </tr>
      <tr >
        <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
        </tr>
    </table>
  </div>
</form>
            <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['action'])) 
 {  
?>
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <table width="86" height="56" border="0" align="center">
               <tr>
                 <td width="80">
                 <form  action="Agri_amar3_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="cod_qroup" value="<?php echo $cod_qroup ;?>" />
                   <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
            </table>
<?php
 if($mah_name!='156' and $mah_name !='158' and $mah_name !='160')
{

if ($id_ostan1 == '') 
{
 $query = "SELECT id_ostan, no_kesh ,
sum(case when no_kesh = 1  then (s_bar_a)+(s_bar_b)  else 0 end) as s_a , 
sum(case when no_kesh = 2  then (s_bar_a)+(s_bar_b)  else 0 end) as s_d, 
sum(case when no_kesh = 1  then mah_tol else 0 end) as mahtol_a , 
sum(case when no_kesh = 2  then mah_tol else 0 end) as mahtol_d , 
sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM $Agri_prod_table
where cod_mah_amar ='$mah_name' Group by id_ostan
ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21') "  ;
}
if ($id_ostan1 != '') 
{
$query = "SELECT id_ostan,id_city, no_kesh ,
sum(case when no_kesh = 1  then (s_bar_a)+(s_bar_b)  else 0 end) as s_a , 
sum(case when no_kesh = 2  then (s_bar_a)+(s_bar_b)  else 0 end) as s_d, 
sum(case when no_kesh = 1  then mah_tol else 0 end) as mahtol_a , 
sum(case when no_kesh = 2  then mah_tol else 0 end) as mahtol_d , 
sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM $Agri_prod_table
where id_ostan = '$id_ostan1'  and  cod_mah_amar ='$mah_name'
Group by id_city
 "  ;

 }
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
            <table width="95%" height="142" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
              <tr align="center" class="text1">
               <td height="46" colspan="2" bgcolor="#999999">عملکرد<br />
                 <span class="style2">کیلوگرم</span></td>
               <td colspan="3" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح <br />
                <span class="style2">هکتار</span></td>
               <td width="23%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?></td>
               <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="37" bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td width="10%" height="37" bgcolor="#999999">جمع</td>
               <td width="8%" bgcolor="#999999">دیم</td>
               <td width="9%" bgcolor="#999999">آبی</td>
               <td height="37" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td width="9%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
$r = 1 ; 
 foreach($stmt as $row){
 $s_a = round($row['s_a'],2) ;
 $s_d = round($row['s_d'],2) ;
 $mahtol_a = round($row['mahtol_a'],2) ;
 $mahtol_d = round($row['mahtol_d'],2) ;
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="40" ><?php echo round($mahtol_d/$s_d*1000,0) ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000,0) ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a+$mahtol_d ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_d ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a ;?></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a+$s_d ;?></td>
               <td width="10%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_d ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall">
                 <?php if($id_ostan1=='') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$id_ostan1)  ; ?>
               </span><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
if ($id_ostan1 == '') 
{
$query = "SELECT id_ostan, no_kesh ,
sum(case when no_kesh = 1  then (s_bar_a)+(s_bar_b)  else 0 end) as s_a , 
sum(case when no_kesh = 2  then (s_bar_a)+(s_bar_b)  else 0 end) as s_d, 
sum(case when no_kesh = 1  then mah_tol else 0 end) as mahtol_a , 
sum(case when no_kesh = 2  then mah_tol else 0 end) as mahtol_d , 
sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM $Agri_prod_table
where cod_mah_amar ='$mah_name' "  ;
}
if ($id_ostan1 != '') 
{
$query = "SELECT id_ostan,id_city, no_kesh ,
sum(case when no_kesh = 1  then (s_bar_a)+(s_bar_b)  else 0 end) as s_a , 
sum(case when no_kesh = 2  then (s_bar_a)+(s_bar_b)  else 0 end) as s_d, 
sum(case when no_kesh = 1  then mah_tol else 0 end) as mahtol_a , 
sum(case when no_kesh = 2  then mah_tol else 0 end) as mahtol_d , 
sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM $Agri_prod_table
where id_ostan = '$id_ostan1'  and cod_mah_amar ='$mah_name'
 "  ;
}
?>
<?php
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $s_a = round($row['s_a'],2) ;
 $s_d = round($row['s_d'],2) ;
 $mahtol_a = round($row['mahtol_a'],2) ;
 $mahtol_d = round($row['mahtol_d'],2) ;
?>

             <tr>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="40" ><?php echo round($mahtol_d/$s_d*1000,0) ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000,0) ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a+$mahtol_d ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_d ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a ;?></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a+$s_d ;?></td>
               <td width="10%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_d ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ;?></td>
               <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل <br /></td>
              </tr>
       </table>
             <?php
}
}
?>

<?php
 if($mah_name =='156' or $mah_name =='158' or $mah_name =='160')
{
	if($mah_name =='156') $cod_mah ='170' ; 
    if($mah_name =='158') $cod_mah ='172' ; 
	if($mah_name =='160') $cod_mah ='174' ; 	
?>
           <table width="95%" height="108" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="38" colspan="2" bgcolor="#999999">عملکرد<br />
                 <span class="style2">کیلوگرم</span></td>
               <td colspan="3" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح <br />
                <span class="style2">هکتار</span></td>
               <td width="23%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?></td>
               <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="29" bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td width="10%" height="29" bgcolor="#999999">جمع</td>
               <td width="8%" bgcolor="#999999">دیم</td>
               <td width="9%" bgcolor="#999999">آبی</td>
               <td height="29" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td width="9%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
if ($id_ostan1 == '') 
{
 $query = "SELECT 
id_ostan,id_city,  
sum(zer_kesht) zer_k1, 
sum(mah_tolp) m_tolp, 
sum(s_bar) s_bar1, 
sum(mah_tol) m_tol 
FROM Vege_prod 
where  z_sal = '$z_sal'  and cod_mah = '$cod_mah'
Group by id_ostan
ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21') "  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT 
id_ostan,id_city,  
sum(zer_kesht) zer_k1, 
sum(mah_tolp) m_tolp, 
sum(s_bar) s_bar1, 
sum(mah_tol) m_tol 
FROM Vege_prod 
where  z_sal = '$z_sal' and id_ostan = '$id_ostan1' and cod_mah = '$cod_mah'
Group by id_city
 "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
    $s_a = round($row['s_bar1'],2)*1 ; 
	$mahtol_a = round($row['m_tol'],2)*1 ; 
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="37" ><?php echo 0 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000,0) ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="10%" height="37" ><?php echo $mahtol_a ;  ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo 0 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="9%" ><?php echo $mahtol_a ;  ?></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],2)*1 ; ?><br /></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo 0 ; ?><br /></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ; ?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall">
                 <?php if($id_ostan1=='') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$id_ostan1)  ; ?>
               </span></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
if ($id_ostan1 == '') 
{
 $query = "SELECT 
id_ostan,id_city,  
sum(zer_kesht) zer_k1, 
sum(mah_tolp) m_tolp, 
sum(s_bar) s_bar1, 
sum(mah_tol) m_tol 
FROM Vege_prod 
where  z_sal = '$z_sal'  and cod_mah = '$cod_mah'
 "  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT 
id_ostan,id_city,  
sum(zer_kesht) zer_k1, 
sum(mah_tolp) m_tolp, 
sum(s_bar) s_bar1, 
sum(mah_tol) m_tol 
FROM Vege_prod 
where  z_sal = '$z_sal' and id_ostan = '$id_ostan1' and cod_mah = '$cod_mah' "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
    $s_a = round($row['s_bar1'],2)*1 ; 
	$mahtol_a = round($row['m_tol'],2)*1 ; 
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="37" ><?php echo 0 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000,0) ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="10%" height="37" ><?php echo $mahtol_a ;  ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo 0 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="9%" ><?php echo $mahtol_a ;  ?></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],2)*1 ; ?><br /></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo 0 ; ?><br /></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ; ?><br /></td>
               <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
               </tr>

<?php
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