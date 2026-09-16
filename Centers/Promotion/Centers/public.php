<?php
include("../../../lock_p2.php");
include("../../../event.php");
require_once('../../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
 include ('../../../login/config.php');
$query = "SELECT * from promo_cent_public where id_mar = '$id_mar' and id_ostan = $id_ostan";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$found_count = $stmt -> rowCount();
if ($found_count>0)
{
  $no_action  = '1' ; 
  $m_name = $row['m_name']; 
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
}
else 
{
$no_action = '2' ; 
}
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
 <script src="../../../15_files/jquery.js" type="text/javascript"></script>
<script src="../../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
            $.validator.addMethod("IsDate",
                  function (value, element) {
                      var result = /^(?:1[23]\d{2})\/(?:0?[1-9]|1[0-2])\/(?:0?[1-9]|[12][0-9]|3[01])$/.test(value);
                      if (value.length == 0)
                          return true;
                      else
                          return result;
                  },
                   "<br/><span style='color:#FF0066'>مثال<br/><span dir='ltr'>1390/08/14 </span></span>"
             );

            //$("#form1").validate();
        });
    </script>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 ?>
<p align="center" ><span class="style1">اطلاعات عمومی مرکز جهاد کشاورزی </span></p>
 <p align="center" ><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
   
 <form action="" method="post" id="form1" name="form1">
  <div  style=" border: 3px solid #930 ; width:90% ; margin:auto" >
 <table width="100%" border="0" align="center" bgcolor="#CCCCCC">
   <tr>
     <td width="263" height="38"><div align="right">
       <input name="id_mar" type="text" class="required digits input_text" id="id_mar" style="width:75px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $id_mar?>" maxlength="11" readonly="readonly" xml:lang="fa" />
       </div></td>
     <td width="147"><div align="right">:کد مرکز</div></td>
     <td width="17">&nbsp;</td>
     <td width="262" height="38"><div align="right">
       <input name="m_name" type="text" class="required input_text" id="m_name" style="width:200px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $m_name?>" maxlength="11" xml:lang="fa" />
       </div></td>
     <td width="139"><div align="right">:نام رسمی مرکز </div></td>
   </tr>
   <tr>
     <td height="38" class="input_text"><div align="right">
       <input name="y_tas" type="text" class="required input_text" id="y_tas" style="width:75px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $y_tas?>" maxlength="100" xml:lang="fa" />
       </div></td>
     <td><div align="right">:سال تاسیس</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><span class="input_text">
       <select name="rating" class="required input_text" id="rating" style="height:40px ; width:100px ; direction:rtl" tabindex="3">
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
       <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
       <span class="style8"><br />
       37.010521: مثال</span></div></td>
     <td><div align="right">:عرض جغرافیایی</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
       <p>
         <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
         <br />
         <span class="style8">46.212486: مثال</span></p>
     </div></td>
     <td><div align="right" >:طول جغرافیایی</div></td>
   </tr>
   <tr>
     <td height="99"><div align="right">
       <input name="cod_pos" type="text" class="required digits input_text" id="cod_pos" style="width:150px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $cod_pos ; ?>" maxlength="10" xml:lang="fa"/>
       </div></td>
     <td><div align="right">:کد پستی</div></td>
     <td colspan="2"><div align="right">
       <textarea name="address" cols="40" rows="6" class="required input_text" id="address" tabindex="7"><?php echo $address ;?></textarea>
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
       <input name="tel" type="text" class="required digits input_text" id="tel" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $tel ; ?>" maxlength="11" xml:lang="fa"/>
       </div></td>
     <td><div align="right">:شماره تلفن</div></td>
   </tr>
   <tr>
     <td height="47"><div align="right">
       <span class="style2">کیلومتر</span>
       <input name="f_dor_ab" type="text" class="required digits input_text" id="f_dor_ab" style="width:75px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $f_dor_ab?>" maxlength="11" xml:lang="fa" />
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
           <input name="zf_g" type="text" class="required input_text" id="zf_g" style="width:250px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $zf_g ; ?>" maxlength="250"  align="baseline" xml:lang="fa" />
         </div></td>
         <td colspan="2" bgcolor="#CCCCCC"> : زمینه <span class="style8">فعالیت</span>  غالب منطقه</td>
         </tr>
       <tr>
         <td width="25%" height="45" class="style2"><div align="right">
           <input name="to_z3" type="text" class="required input_text" id="to_z3" style="width:150px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $to_z3 ; ?>" maxlength="200"  align="baseline" xml:lang="fa" />
         </div></td>
         <td width="6%"> : سوم</td>
         <td width="19%"><div align="right">
           <input name="to_z2" type="text" class="required input_text" id="to_z2" style="width:150px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $to_z2 ; ?>" maxlength="200"  align="baseline" xml:lang="fa" />
         </div></td>
         <td width="5%"> :دوم</td>
         <td width="19%" class="style2"><div align="right">
           <input name="to_z1" type="text" class="required input_text" id="to_z1" style="width:150px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $to_z1 ; ?>" maxlength="200"  align="baseline" xml:lang="fa" />
         </div></td>
         <td width="5%"> : اول</td>
         <td width="21%"><p>تولید <span class="style8">زراعی</span> غالب منطقه</p></td>
         </tr>
       <tr>
         <td height="45" bgcolor="#CCCCCC" class="style2"><div align="right">
           <input name="to_b3" type="text" class="required input_text" id="to_b3" style="width:150px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $to_b3 ; ?>" maxlength="200"  align="baseline" xml:lang="fa" />
         </div></td>
         <td bgcolor="#CCCCCC">: سوم</td>
         <td bgcolor="#CCCCCC"><div align="right">
           <input name="to_b2" type="text" class="required input_text" id="to_b2" style="width:150px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $to_b2 ; ?>" maxlength="200"  align="baseline" xml:lang="fa" />
         </div></td>
         <td bgcolor="#CCCCCC">:دوم</td>
         <td bgcolor="#CCCCCC" class="style2"><div align="right">
           <input name="to_b1" type="text" class="required input_text" id="to_b1" style="width:150px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $to_b1 ; ?>" maxlength="200"  align="baseline" xml:lang="fa" />
         </div></td>
         <td bgcolor="#CCCCCC">: اول</td>
         <td bgcolor="#CCCCCC">تولید <span class="style8">باغی</span> غالب منطقه</td>
         </tr>
       <tr>
         <td class="style2"><div align="right">
           <input name="to_d3" type="text" class="required input_text" id="to_d3" style="width:150px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $to_d3 ; ?>" maxlength="200"  align="baseline" xml:lang="fa" />
         </div></td>
         <td>: سوم</td>
         <td><div align="right">
           <input name="to_d2" type="text" class="required input_text" id="to_d2" style="width:150px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $to_d2 ; ?>" maxlength="200"  align="baseline" xml:lang="fa" />
         </div></td>
         <td>:دوم</td>
         <td class="style2"><div align="right">
           <input name="to_d1" type="text" class="required input_text" id="to_d1" style="width:150px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $to_d1 ; ?>" maxlength="200"  align="baseline" xml:lang="fa" />
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
     <input type="hidden" name="id_city"  value="<?php echo $id_city ?>">
     <input type="hidden" name="no_action"  value="<?php echo $no_action ?>">
     <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan ?>">
     <a href="index.php"><input name="action2" type="button" style="width:150px ; height:45px" tabindex="24"  value="بازگشت" /></a>&nbsp;
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="23" value="ثبت اطلاعات" />
   </p>
 </div>
 <p align="center" >&nbsp;</p>
      </form>  </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
  <?PHP
 if (isset($_POST['action'])) 
 {  
  include('../../../login/config.php');
//echo $id_ostan = $_POST['id_ostan']; 
//echo $id_city = $_POST['id_city']; 
//$id_mar = $_POST['id_mar']; 
//  $ostan = ostan_name($id_ostan) ;
//  $city =city_name1($id_city,$id_ostan) ;
//  $mar = mar_name($id_mar) ;
// کاربر مروج و رئیس مرکز نباشد 
  $m_name = $_POST['m_name']; 
  $rating = $_POST['rating']; 
  $y_tas = $_POST['y_tas']; 
  $lat = $_POST['lat']; 
  $lng = $_POST['lng']; 
  $address= $_POST['address']; 
  $cod_pos= $_POST['cod_pos']; 
  $tel= $_POST['tel']; 
  $fax= $_POST['fax']; 
  $f_naz_ab= $_POST['f_naz_ab']; 
  $f_dor_ab= $_POST['f_dor_ab']; 
  $zf_g= $_POST['zf_g']; 
  $to_z1= $_POST['to_z1']; 
  $to_z2= $_POST['to_z2']; 
  $to_z3= $_POST['to_z3']; 
  $to_b1= $_POST['to_b1']; 
  $to_b2= $_POST['to_b2']; 
  $to_b3= $_POST['to_b3']; 
  $to_d1= $_POST['to_d1']; 
  $to_d2= $_POST['to_d2']; 
  $to_d3= $_POST['to_d3']; 
  $no_action= $_POST['no_action'];
  if ($no_action=='1')  
 {
 $query = "UPDATE promo_cent_public SET  date_s=? ,id_ostan=? ,id_city=? ,m_name=? ,rating=? ,y_tas=? ,lat=? ,lng=? 
 ,address=? ,cod_pos=? ,tel=? ,fax=? ,f_naz_ab=? ,f_dor_ab=? ,zf_g=? ,to_z1=? ,to_z2=? ,to_z3=? ,to_b1=? ,to_b2=? 
 ,to_b3=? ,to_d1=? ,to_d2=? ,to_d3=?  WHERE id_mar=?";
 $q = $dbh->prepare($query);
 $q->execute(array($date_edit,$id_ostan,$id_city,$m_name,$rating,$y_tas,$lat,$lng,$address,$cod_pos,$tel,$fax,
 $f_naz_ab,$f_dor_ab,$zf_g,$to_z1,$to_z2,$to_z3,$to_b1,$to_b2,$to_b3,$to_d1,$to_d2,$to_d3,$id_mar));
 sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','ویرایش اطلاعات عمومی مرکز ',$id_ostan) ; 
	 alert('اطلاعات عمومی مرکز با موفقیت ویرایش شد ');
}
if ($no_action=='2')  
{
$sql=$dbh->prepare("INSERT INTO promo_cent_public (date_s,id_ostan,id_city,id_mar,m_name,rating,y_tas,lat,lng,address,cod_pos,tel,fax,f_naz_ab,f_dor_ab,zf_g,to_z1,to_z2,to_z3,to_b1,to_b2,to_b3,to_d1,to_d2,to_d3) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
$sql->execute(array($date_edit,$id_ostan,$id_city,$id_mar,$m_name,$rating,$y_tas,$lat,$lng,$address,$cod_pos,$tel,$fax,$f_naz_ab,$f_dor_ab,$zf_g,$to_z1,$to_z2,$to_z3,$to_b1,$to_b2,$to_b3,$to_d1,$to_d2,$to_d3));
    // $mess = "کاربر جدید با موفقیت ثبت شد ";
	sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','ثبت اطلاعات عمومی مرکز ',$id_ostan) ; 
	 alert('اطلاعات عمومی مرکز با موفقیت ثبت شد ');
} 
?>
	 <form name="myform1" class="myform" method="post" action="index.php">
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php }?>