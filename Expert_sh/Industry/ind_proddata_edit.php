<?php
include('../../lock_expsh.php');
include('../../login/config.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
//include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
//////// 
if (isset($_POST['action'])) 
{  
$date_s  = $date_edit ;
$id  = $_POST['id']  ;
$y_prod  = $_POST['y_prod']  ;
$d_prod  = $_POST['d_prod']  ;
$NationalCode    = $_POST['NationalCode'];
$ShenaseKasboKar = $_POST['ShenaseKasboKar'];
$v_unit  = $_POST['v_unit'] ;
$t_mah   = $_POST['t_mah'] ;
$n_zd    = $_POST['n_zd'] ;
$n_d     = $_POST['n_d'] ;
$n_fd    = $_POST['n_fd'] ;
$n_l     = $_POST['n_l'] ;
$n_bl    = $_POST['n_bl'] ;
$gaz     = $_POST['gaz'] ;
$gaz_oil = $_POST['gaz_oil'] ;
$naft_w  = $_POST['naft_w'] ;
$naft_b  = $_POST['naft_b'] ;
$benz    = $_POST['benz'] ;
$barg    = $_POST['barg'] ;
$ab      = $_POST['ab'] ;
// بانک اطلاعات  
  $query= "UPDATE ind_unit_info SET date_s=?,v_unit=?,n_zd=?,n_d=?,n_fd=?,n_l=?,n_bl=?
	,gaz=?,gaz_oil=?,naft_w=?,naft_b=?,benz=?,barg=?,ab=? where id=? ";
  $q = $dbh->prepare($query);
  $q->execute(array($date_edit,$v_unit,$n_zd,$n_d,$n_fd,$n_l,$n_bl,$gaz,$gaz_oil,$naft_w,
  $naft_b,$benz,$barg,$ab,$id));
  $num3_t_mah = $t_mah ;
// شروع حلقه تنوع محصول 
$query = "DELETE FROM ind_unit_prod where ShenaseKasboKar=? and y_prod=? and d_prod=? ;";
$q = $dbh->prepare($query);
$q->execute(array($ShenaseKasboKar,$y_prod,$d_prod));

while ($num3_t_mah > 0 ){
 $isic_cod = $_POST['isic_cod'.$num3_t_mah] ;
 $m_tol = $_POST['m_tol'.$num3_t_mah] ;
$query = "INSERT INTO ind_unit_prod (id_ostan,id_city,NationalCode,ShenaseKasboKar,date_s,y_prod,d_prod,isic_cod,m_tol)
 VALUES ('$id_ostan','$id_city','$NationalCode','$ShenaseKasboKar','$date_s','$y_prod','$d_prod','$isic_cod','$m_tol');";
$q = $dbh->prepare($query);
$q->execute();
// پایان حلقه تنوع محصول 
$num3_t_mah--;
}
 // ثبت در بانک پیگیری
    sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ثبت عملکرد واحد صنعتی - '.$NationalCode,$id_ostan) ;
    alert ('عملکرد واحد صنعتی با موفقیت تصحیح شد ') ;
    // clos conntection 
$dbh = null;
?>
</script>
     <form name="myform" class="myform" action="ind_list_performance.php" method="post" onsubmit="winpap1(this)">
         <input type="hidden" name="ShenaseKasboKar" value="<?php echo $ShenaseKasboKar ;?>" />
         <button><img src="../../files/komo.png" title="نمایش عملکرد واحد صنعتی"  width="20" height="20"  alt=""/></button>
     </form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
//
if  (isset($_POST['NationalCode']))
{
$y_prod = $_POST['y_prod']  ;
$d_prod  = $_POST['d_prod']  ;
if(isset($_POST['y_prod_old'])) $y_prod_old = $_POST['y_prod_old'];
if(isset($_POST['d_prod_old'])) $d_prod_old = $_POST['d_prod_old'];
$id  = $_POST['id'];
$NationalCode    = $_POST['NationalCode'];
$ShenaseKasboKar = $_POST['ShenaseKasboKar'];
$v_unit = $_POST['v_unit']; 
$t_mah = $_POST['t_mah'];
$NationalCode = $_POST['NationalCode'];
 $query = "SELECT id_ostan,id_city,id_mar,unit_name,add_abadi,add_city,no_bah,v_gaz,v_bar,t_mah 
from ind_unit where NationalCode = '$NationalCode' and  ShenaseKasboKar = '$ShenaseKasboKar' "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$unit_id));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$id_mar = $row['id_mar'] ;
$unit_name = $row['unit_name'] ;
$add_city = $row['add_city'] ;
$add_abadi = $row['add_abadi'] ;
$id_city = $row['id_city'] ;
$id_ostan = $row['id_ostan'] ;
$no_bah = $row['no_bah'] ;
$v_bar = $row['v_bar'] ;
$v_gaz = $row['v_gaz'] ;
$num_t_mah = $t_mah ; 
$query = "SELECT * from ind_unit_info where NationalCode = '$NationalCode' and  ShenaseKasboKar = '$ShenaseKasboKar'
 and y_prod = '$y_prod' and d_prod = '$d_prod'  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$n_zd    = $row['n_zd'] ;
$n_d     = $row['n_d'] ;
$n_fd    = $row['n_fd'] ;
$n_l     = $row['n_l'] ;
$n_bl    = $row['n_bl'] ;
$gaz     = $row['gaz'] ;
$gaz_oil = $row['gaz_oil'] ;
$naft_w  = $row['naft_w'] ;
$naft_b  = $row['naft_b'] ;
$benz    =  $row['benz'] ;
$barg    = $row['barg'] ;
$ab      = $row['ab'] ;

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>
<?php
while ($num_t_mah > 0){
?>
<script type="text/javascript">
$(document).ready(function()
{
$(".country<?php echo $num_t_mah ;?>").change(function()
{
var id=$(this).val();
var dataString = 'isic_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_isic.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar<?php echo $num_t_mah ;?>").html(html);
} 
});
});
});
function close_window() {
      close();
 }
</script>
<?php
 $num_t_mah--;
}
?>
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
  <tr>
    <td>

           <p class="style8">ویرایش عملکرد دوره <?php echo  $d_prod ?> ماهه سال <?php echo  $y_prod ?> واحد صنعتی <br />
             <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_ind_data($NationalCode,$no_bah) ;?>
           </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1">
      <table width="99%" height="740" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت واحد</strong></div></td>
        </tr>
        <tr>
          <td width="33%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan)?></div></td>
          <td width="15%"><div align="right">:شهرستان</div></td>
          <td width="9%" rowspan="2">&nbsp;</td>
          <td width="27%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="16%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38" colspan="3">&nbsp;</td>
          <td height="38"><div align="right" class="yekan red" > <?php echo $unit_name; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نام واحد </div></td>
        </tr>
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>تعداد شاغلین</strong></div></td>
        </tr>
        <tr>
          <td height="5" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="18%" height="56"><div align="right"><span class="style2">نفر</span>
                <input name="n_fd" type="text" class="input_text  required  number" id="n_fd" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $n_fd ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
              <td width="15%"><div style="margin-right:30px" align="right">:فوق دیپلم</div></td>
              <td width="16%"><div align="right"><span class="style2">نفر</span>
                <input name="n_d" type="text" class="input_text  required  number" id="n_d" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $n_d ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
              <td width="18%"><div style="margin-right:30px" align="right">: دیپلم</div></td>
              <td width="17%" bgcolor="#FFFFFF"><div align="right"><span class="style2">نفر</span>
                <input name="n_zd" type="text" class="input_text  required  number" id="n_zd" style="width:50px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $n_zd ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
              <td width="16%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:زیر دیپلم</div></td>
              </tr>
            <tr>
              <td height="47" colspan="2">&nbsp;</td>
              <td><div align="right"><span class="style2">نفر</span>
                <input name="n_bl" type="text" class="input_text  required  number" id="n_bl" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $n_bl ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right">: بالاتر از لیسانس</div></td>
              <td><div align="right"><span class="style2">نفر</span>
                <input name="n_l" type="text" class="input_text  required  number" id="n_l" style="width:50px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $n_l ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
              <td><div style="margin-right:30px" align="right">:لیسانس</div></td>
              </tr>
            <tr>
              <td height="47" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مصرف سوخت</strong></div></td>
              </tr>
            <tr>
              <td height="56"><div align="right"><span class="style2">لیتر</span>
                  <input name="naft_w" type="text" class="input_text  required  number" id="naft_w" style="width:70px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $naft_w ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right">:نفت سفید</div></td>
              <td><div align="right"><span class="style2">لیتر</span>
                  <input name="gaz_oil" type="text" class="input_text  required  number" id="gaz_oil" style="width:70px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $gaz_oil ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right">: گازوئیل</div></td>
<?php if ($v_gaz == '1') {?>
              <td bgcolor="#FFFFFF"><div align="right"><span class="style2">مترمکعب</span>
                  <input name="gaz" type="text" class="input_text  required  number" id="gaz" style="width:70px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $gaz ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
<?php } else {?>
                <td bgcolor="#FFFFFF"><div align="right"><span class="red1"> فاقد انشعاب گاز </span>
                <input name="gaz" type="hidden"   value="0"  />
<?php }?>
              </div></td>
              <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:گاز</div></td>
            </tr>
            <tr>
              <td height="56" colspan="2">&nbsp;</td>
              <td><div align="right"><span class="style2">لیتر</span>
                <input name="benz" type="text" class="input_text  required  number" id="benz" style="width:70px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $benz ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right">: بنزین</div></td>
              <td bgcolor="#FFFFFF"><div align="right"><span class="style2">لیتر</span>
                <input name="naft_b" type="text" class="input_text  required  number" id="naft_b" style="width:70px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $naft_b ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:نفت سیاه</div></td>
            </tr>
            <tr>
              <td height="47" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مصرف آب و برق </strong></div></td>
              </tr>
            <tr>
              <td height="47" colspan="2">&nbsp;</td>
              <td><div align="right"><span class="style2">مترمکعب</span>
                <input name="ab" type="text" class="input_text  required  number" id="ab" style="width:70px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $ab ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right">: آب</div></td>
<?php if ($v_bar == '1') {?>
              <td bgcolor="#FFFFFF"><div align="right"><span class="style2">کیلووات/ساعت</span>
                  <input name="barg" type="text" class="input_text  required  number" id="barg" style="width:70px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $barg ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
<?php } else {?>
                <td bgcolor="#FFFFFF"><div align="right"><span class="red1"> فاقد انشعاب برق </span>
                <input name="barg" type="hidden"   value="0"  />
<?php }?>
               </div></td>
              <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:برق</div></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات محصول</strong></div></td>
        </tr>
        <tr>
          <td height="142" colspan="5"><table width="100%" height="107" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="11%" height="53" bgcolor="#FFFFCC">میزان تولید  <br />
                <span class="style8">تن</span></td>
              <td width="11%" bgcolor="#FFFFCC">ظرفیت جذب مواد<br />
                <span class="style8">تن</span></td>
              <td width="7%" bgcolor="#FFFFCC">ظرفیت سالن<br />
                <span class="style8">تن</span></td>
              <td width="61%" bgcolor="#FFFFCC">نام محصول</td>
              <td width="6%" bgcolor="#FFFFCC">کد آیسیک</td>
              <td width="4%" bgcolor="#FFFFCC">ردیف</td>
            </tr>
            <?php 
$n = 1 ;
$num2_t_mah = $t_mah ;
$query = "SELECT id from ind_unit_prod where ShenaseKasboKar='$ShenaseKasboKar' and ind_unit_prod.y_prod = '$y_prod' 
and ind_unit_prod.d_prod = '$d_prod'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_prod =$stmt -> rowCount();
if($count_prod > 0)
{
$query = "SELECT ind_list_product.m_jazb,ind_list_product.zarfiyat,ind_list_product.product_name,
ind_list_product.isic_code,ind_unit_prod.m_tol From ind_list_product
inner Join ind_unit_prod ON ind_unit_prod.shenaseKasboKar = ind_list_product.ShenaseKasboKar
And ind_unit_prod.isic_cod = ind_list_product.isic_code 
 Where ind_list_product.ShenaseKasboKar='$ShenaseKasboKar' and ind_unit_prod.y_prod = '$y_prod' 
and ind_unit_prod.d_prod = '$d_prod' ";
}
else 
{
$query = "SELECT ind_list_product.m_jazb,ind_list_product.zarfiyat,ind_list_product.product_name,
ind_list_product.isic_code From ind_list_product
 Where ind_list_product.ShenaseKasboKar='$ShenaseKasboKar' ";
}
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <tr>
              <td height="36" bgcolor="#FFFFFF"><div align="right" style="margin:10px">
                <input name="m_tol<?php echo $num2_t_mah ;?>" type="text" class="mashat required number input_text" id="m_tol<?php echo $num2_t_mah ;?>" style="width:75px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php  echo $row['m_tol'] ; ?>" maxlength="11"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center"><?php echo $row['m_jazb']?></div></td>
              <td bgcolor="#FFFFFF"><div align="right"><?php echo $row['zarfiyat']?></div></td>
              <td bgcolor="#FFFFFF"><div align="right"><?php echo $row['product_name']?></div></td>
              <td bgcolor="#FFFFFF"><div align="right" style="margin:10px">
                <input name="isic_cod<?php echo $num2_t_mah ;?>" type="text" class="mashat required number input_text" id="isic_cod<?php echo $num2_t_mah ;?>" style="width:75px; height:30px ; " tabindex="240" dir="rtl" lang="fa" value="<?php  echo $row['isic_code'] ; ?>" maxlength="11" readonly  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><?php echo $n ;?></td>
            </tr>
            <?php
 $num2_t_mah--;
 $n++ ;
}
?>
          </table></td>
        </tr>
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="y_prod" value=<?php echo $y_prod; ?> />
     <input type="hidden" name="d_prod" value=<?php echo $d_prod; ?> />
     <input type="hidden" name="y_prod_old" value="<?php echo $y_prod_old ;?>" />
     <input type="hidden" name="d_prod_old" value="<?php echo $d_prod_old ;?>" />
     <input type="hidden" name="NationalCode" value=<?php echo $NationalCode; ?> />
     <input type="hidden" name="ShenaseKasboKar" value=<?php echo $ShenaseKasboKar; ?> />
     <input type="hidden" name="v_unit" value=<?php echo $v_unit; ?> />
     <input type="hidden" name="t_mah" value=<?php echo $t_mah; ?> />
     <input type="hidden" name="id" value=<?php echo $id; ?> />
     <input type="submit" name="action" value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="33" id="submit" onClick="setTimeout(disableFunction, 1);"/>
     <button  id="send" class="style8" style="width:150px ; height:45px "  onclick="close_window()">انصراف</button>
      </div>
</form> 
        <p> </p>
<script>
function disableFunction() {
    document.getElementById("submit").disabled = 'true';
	$("#submit").attr("disabled","");
}
</script>  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Garden.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
   </tr>
</table>
</table>
</body>
</html>