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
$y_prod  = $_POST['y_prod']  ;
$d_prod  = $_POST['d_prod']  ;
$unit_id = $_POST['unit_id']; 
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
$benz    =  $_POST['benz'] ;
$barg    = $_POST['barg'] ;
$ab      = $_POST['ab'] ;
// بانک اطلاعات  
    $query = "INSERT INTO ind_unit_info (date_s,unit_id,y_prod,v_unit,t_mah,n_zd,n_d,n_fd,n_l,n_bl,gaz,gaz_oil,naft_w,naft_b,benz,barg,ab)
	  VALUES(:date_s,:unit_id,:y_prod,:v_unit,:t_mah,:n_zd,:n_d,:n_fd,:n_l,:n_bl,:gaz,:gaz_oil,:naft_w,:naft_b,:benz,:barg,:ab)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_s'=>$date_edit,':unit_id'=>$unit_id,':y_prod'=>$y_prod,':v_unit'=>$v_unit,':t_mah'=>$t_mah,':n_zd'=>$n_zd,':n_d'=>$n_d
	,':n_fd'=>$n_fd,':n_l'=>$n_l,':n_bl'=>$n_bl,':gaz'=>$gaz,':gaz_oil'=>$gaz_oil,':naft_w'=>$naft_w,':naft_b'=>$naft_b,':benz'=>$benz,':barg'=>$barg
	,':ab'=>$ab	));
$num3_t_mah = $t_mah ;
// شروع حلقه تنوع محصول 
while ($num3_t_mah > 0 ){
 $isic_cod = $_POST['isic_cod'.$num3_t_mah] ;
 $m_tol = $_POST['m_tol'.$num3_t_mah] ;
$query = "INSERT INTO ind_unit_prod (unit_id,date_s,y_prod,isic_cod,m_tol) VALUES ('$unit_id','$date_s','$y_prod','$isic_cod','$m_tol');";
$q = $dbh->prepare($query);
$q->execute();
// پایان حلقه تنوع محصول 
$num3_t_mah--;
}
 // ثبت در بانک پیگیری
    sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ثبت عملکرد واحد صنعتی - '.$NationalCode,$id_ostan) ;
    alert ('عملکرد واحد صنعتی با موفقیت ثبت شد ') ;
    unset($NationalCode,$unit_id,$y_prod,$v_unit,$t_mah);
// clos conntection 
$dbh = null;
?>
<form  name="myform" class="myform" method="post" action="ind_prod.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
//
if  (isset($_POST['NationalCode']))
{
$y_prod = $_POST['y_prod']  ;
$d_prod  = $_POST['d_prod']  ;
$unit_id = $_POST['unit_id']; 
$v_unit = $_POST['v_unit']; 
$t_mah = $_POST['t_mah'];
$NationalCode = $_POST['NationalCode'];
$query = "SELECT id_ostan,id_city,id_mar,unit_name,add_abadi,add_city,no_bah,v_gaz,v_bar,t_mah from ind_unit where  id = :id"; 
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
</script>
<?php
 $num_t_mah--;
}
?>
</head>
<body>
     <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td>
      <?php include('top.php'); ?>
           <p class="style8">ثبت عملکرد دوره <?php echo  $d_prod ?> ماهه سال <?php echo  $y_prod ?> واحد صنعتی <br />
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
          <td height="142" colspan="5">
          <table width="100%" height="107" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="12%" height="53" bgcolor="#FFFFCC">میزان تولید  سالیانه<br />
                <span class="style8">تن</span></td>
              <td width="71%" bgcolor="#FFFFCC">نام محصول</td>
              <td width="13%" bgcolor="#FFFFCC">کد آیسیک</td>
              <td width="4%" bgcolor="#FFFFCC">ردیف</td>
            </tr>
            <?php 
$n = 1 ;
$num2_t_mah = $t_mah ;
while ($num2_t_mah > 0){
?>
            <tr>
              <td height="36" bgcolor="#FFFFFF"><div align="right" style="margin:10px">
                <input name="m_tol<?php echo $num2_t_mah ;?>" type="text" class="mashat required number input_text" id="m_tol<?php echo $num2_t_mah ;?>" style="width:75px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php  $m_tol.$num2_t_mah ; ?>" maxlength="11"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="right" style="margin-right:10px"></div></td>
              <td bgcolor="#FFFFFF"><div align="right"></div></td>
              <td bgcolor="#FFFFFF"><?php echo $n ;?></td>
            </tr>
            <?php
 $num2_t_mah--;
 $n++ ;
}
?>
          </table>
           </td>
        </tr>
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="y_prod" value=<?php echo $y_prod; ?> />
     <input type="hidden" name="unit_id" value=<?php echo $unit_id; ?> />
     <input type="hidden" name="v_unit" value=<?php echo $v_unit; ?> />
     <input type="hidden" name="t_mah" value=<?php echo $t_mah; ?> />
  <input type="submit" name="action" value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="33" id="submit" onClick="setTimeout(disableFunction, 1);"/>
                 <a href="ind_prod.php">
             <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="36" /></a>
        </p>
      </div>
</form> 
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