<?php
include("../../../lock_expsh.php");
include("../../../event.php");
include ('../../../login/config.php');
$id_mar1   = $_POST['id_mar'];
$id_ostan1 = $_POST['id_ostan'];
$id_city1  = $_POST['id_city'];
$id_select_city  = $_POST['id_select_city'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../../../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 ?>
<p align="center" ><span class="style1">اطلاعات عمومی مرکز جهاد کشاورزی </span></p>
 <p align="center" ><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<?php
$query = "SELECT * from promo_cent_public where id_mar = $id_mar1 and id_ostan = $id_ostan1";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$found_count = $stmt -> rowCount();
if ($found_count>0)
{
  $no_action  = '1' ; 
  $m_name = $row['m_name']; 
  $id_mar = $row['id_mar']; 
  $rating = $row['rating']; 
  $y_tas = $row['y_tas']; 
  $lat = $row['lat']; 
  $lng = $row['lng']; 
  $address= $row['address']; 
  $cod_pos= $row['cod_pos']; 
  $tel= $row['tel']; 
  $fax= $row['fax']; 
  $f_naz_ab= $row['f_naz_ab']; 
  $f_dor_ab= $row['f_dor_ab']; 
  $zf_g= $row['zf_g']; 
  $to_z1= $row['to_z1']; 
  $to_z2= $row['to_z2']; 
  $to_z3= $row['to_z3']; 
  $to_b1= $row['to_b1']; 
  $to_b2= $row['to_b2']; 
  $to_b3= $row['to_b3']; 
  $to_d1= $row['to_d1']; 
  $to_d2= $row['to_d2']; 
  $to_d3= $row['to_d3']; 
?>
 <form action="../../list_center.php#1" method="post" id="form1" name="form1">
  <div  style=" border: 3px solid #930 ; width:90% ; margin:auto" >
 <table width="100%" border="0" align="center" bgcolor="#CCCCCC">
   <tr>
     <td width="263" height="38"><div align="right">
       <input name="id_mar" type="text" class="required digits input_text" id="id_mar" style="width:75px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $id_mar?>" maxlength="11" readonly="readonly" xml:lang="fa" />
       </div></td>
     <td width="147"><div align="right">:کد مرکز</div></td>
     <td width="17">&nbsp;</td>
     <td width="262" height="38"><div align="right">
       <input name="m_name" type="text" class="required input_text" id="m_name" style="width:200px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $m_name?>" maxlength="11" readonly="readonly" xml:lang="fa" />
       </div></td>
     <td width="139"><div align="right">:نام رسمی مرکز </div></td>
   </tr>
   <tr>
     <td height="38" class="input_text"><div align="right">
       <input name="y_tas" type="text" class="required input_text" id="y_tas" style="width:75px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $y_tas?>" maxlength="100" readonly="readonly" xml:lang="fa" />
       </div></td>
     <td><div align="right">:سال تاسیس</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><span class="input_text">
       <select name="rating" disabled="disabled" class="required input_text" id="rating" style="height:40px ; width:100px ; direction:rtl" tabindex="3">
         <option value="" >انتخاب کنید</option>
         <option value="1"<?php if($rating=='1') echo "selected='selected'"?>>یک</option>
         <option value="2"<?php if($rating=='2') echo "selected='selected'"?>>دو</option>
         <option value="3"<?php if($rating=='3') echo "selected='selected'"?>>سه</option>
       </select>
       </span></div></td>
     <td><div align="right">:سطح مرکز</div></td>
   </tr>
   <tr>
     <td height="46"><div align="right">
       <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
       <span class="style8"><br />
       </span></div></td>
     <td><div align="right">:عرض جغرافیایی</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
       <p>
         <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
         <br />
       </p>
     </div></td>
     <td><div align="right" >:طول جغرافیایی</div></td>
   </tr>
   <tr>
     <td height="99"><div align="right">
       <input name="cod_pos" type="text" class="required digits input_text" id="cod_pos" style="width:150px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $cod_pos ; ?>" maxlength="10" readonly="readonly" xml:lang="fa"/>
       </div></td>
     <td><div align="right">:کد پستی</div></td>
     <td colspan="2"><div align="right">
       <textarea name="address" cols="40" rows="6" readonly="readonly" class="required input_text" id="address" tabindex="7"><?php echo $address ;?></textarea>
       </div></td>
     <td><div  align="right" >: آدرس پستی مرکز</div></td>
   </tr>
   <tr>
     <td height="41"><div align="right" >
       <input name="fax" type="text" class="required digits input_text" id="fax" style="width:150px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $fax ; ?>" maxlength="11" xml:lang="fa"/>
       </div></td>
     <td><div align="right">:شماره فاکس</div></td>
     <td>&nbsp;</td>
     <td><div align="right" class="input_text" >
       <input name="tel" type="text" class="required digits input_text" id="tel" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $tel ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
       </div></td>
     <td><div align="right">:شماره تلفن</div></td>
   </tr>
   <tr>
     <td height="47"><div align="right">
       <span class="style2">کیلومتر</span>
       <input name="f_dor_ab" type="text" class="required digits input_text" id="f_dor_ab" style="width:75px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $f_dor_ab?>" maxlength="11" readonly="readonly" xml:lang="fa" />
       </div></td>
     <td><div align="right" class="normalTextSmall">: فاصله تا دورترین آبادی</div></td>
     <td>&nbsp;</td>
     <td height="47"><div align="right">
       <span class="style2">کیلومتر</span>
       <input name="f_naz_ab" type="text" class="required digits input_text" id="f_naz_ab" style="width:75px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $f_naz_ab ?>" maxlength="11" xml:lang="fa" />
       </div></td>
     <td><div align="right" class="normalTextSmall">: فاصله تا نزدیک ترین آبادی</div></td>
   </tr>
   <tr>
     <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0">
       <tr>
         <td height="45" bgcolor="#CCCCCC" class="style2">&nbsp;</td>
         <td bgcolor="#CCCCCC">&nbsp;</td>
         <td colspan="3" bgcolor="#CCCCCC"><div align="right">
           <input name="zf_g" type="text" class="required input_text" id="zf_g" style="width:250px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $to_z1 ; ?>" maxlength="250" readonly="readonly"  align="baseline" xml:lang="fa" />
         </div></td>
         <td colspan="2" bgcolor="#CCCCCC"> : زمینه <span class="style8">فعالیت</span>  غالب منطقه</td>
         </tr>
       <tr>
         <td width="25%" height="45" class="style2"><div align="right">
           <input name="to_z3" type="text" class="required input_text" id="to_z3" style="width:150px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $to_z3 ; ?>" maxlength="200" readonly="readonly"  align="baseline" xml:lang="fa" />
         </div></td>
         <td width="6%"> : سوم</td>
         <td width="19%"><div align="right">
           <input name="to_z2" type="text" class="required input_text" id="to_z2" style="width:150px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $to_z2 ; ?>" maxlength="200" readonly="readonly"  align="baseline" xml:lang="fa" />
         </div></td>
         <td width="5%"> :دوم</td>
         <td width="19%" class="style2"><div align="right">
           <input name="to_z1" type="text" class="required input_text" id="to_z1" style="width:150px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $to_z1 ; ?>" maxlength="200" readonly="readonly"  align="baseline" xml:lang="fa" />
         </div></td>
         <td width="5%"> : اول</td>
         <td width="21%"><p>تولید <span class="style8">زراعی</span> غالب منطقه</p></td>
         </tr>
       <tr>
         <td height="45" bgcolor="#CCCCCC" class="style2"><div align="right">
           <input name="to_b3" type="text" class="required input_text" id="to_b3" style="width:150px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $to_b3 ; ?>" maxlength="200" readonly="readonly"  align="baseline" xml:lang="fa" />
         </div></td>
         <td bgcolor="#CCCCCC">: سوم</td>
         <td bgcolor="#CCCCCC"><div align="right">
           <input name="to_b2" type="text" class="required input_text" id="to_b2" style="width:150px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $to_b2 ; ?>" maxlength="200" readonly="readonly"  align="baseline" xml:lang="fa" />
         </div></td>
         <td bgcolor="#CCCCCC">:دوم</td>
         <td bgcolor="#CCCCCC" class="style2"><div align="right">
           <input name="to_b1" type="text" class="required input_text" id="to_b1" style="width:150px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $to_b1 ; ?>" maxlength="200" readonly="readonly"  align="baseline" xml:lang="fa" />
         </div></td>
         <td bgcolor="#CCCCCC">: اول</td>
         <td bgcolor="#CCCCCC">تولید <span class="style8">باغی</span> غالب منطقه</td>
         </tr>
       <tr>
         <td class="style2"><div align="right">
           <input name="to_d3" type="text" class="required input_text" id="to_d3" style="width:150px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $to_d3 ; ?>" maxlength="200" readonly="readonly"  align="baseline" xml:lang="fa" />
         </div></td>
         <td>: سوم</td>
         <td><div align="right">
           <input name="to_d2" type="text" class="required input_text" id="to_d2" style="width:150px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $to_d2 ; ?>" maxlength="200" readonly="readonly"  align="baseline" xml:lang="fa" />
         </div></td>
         <td>:دوم</td>
         <td class="style2"><div align="right">
           <input name="to_d1" type="text" class="required input_text" id="to_d1" style="width:150px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $to_d1 ; ?>" maxlength="200" readonly="readonly"  align="baseline" xml:lang="fa" />
         </div></td>
         <td>: اول</td>
         <td>تولید <span class="style8">دامی</span> غالب منطقه</td>
         </tr>
     </table></td>
     </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
 </table>
 </div>
 <div align="center">
   <p>
     <input type="hidden" name="id_city"  value='<?php echo $id_select_city ?>'>
     <input type="hidden" name="action"  value="1">
     <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan1 ?>">
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="23" value="بازگشت" />
   </p>
 </div>
 <p align="center" >&nbsp;</p>
      </form>  </td>
  </tr>
<?php
}
else 
{
echo '<p>&nbsp;</p>' ;
echo  "<p dir='rtl' class='style8'> متاسفانه اطلاعات عمومی مرکز ثبت نشده است. </p> " ; 
echo '<p>&nbsp;</p>' ;
?>
 <form action="../../list_center.php#1" method="post" id="form1" name="form1">
   <input type="hidden" name="id_city"  value='<?php echo $id_select_city ?>'>
     <input type="hidden" name="action"  value='1'>
     <input type="hidden" name="id_ostan"  value='<?php echo $id_ostan1 ?>'>
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="23" value="بازگشت" />
    </form>
    <?php
echo '<p>&nbsp;</p>' ;
}
?>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
