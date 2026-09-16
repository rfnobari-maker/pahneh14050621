<?php
include('../../lock_expsh.php');
include('../../login/config.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
if  (isset($_POST['unit_id']))
{
$unit_id = $_POST['unit_id']; 
$query = "SELECT ind_unit_info.*,ind_unit.id_ostan,ind_unit.id_city,ind_unit.id_mar,ind_unit.unit_name,ind_unit.add_abadi,ind_unit.add_city,ind_unit.num_bah,ind_unit.bah_cod_m
from ind_unit 
inner join ind_unit_info ON ind_unit.id = ind_unit_info.unit_id
where  ind_unit.id = :id"; 
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
$num_bah = $row['num_bah'] ;
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
$y_prod    = $row['y_prod']  ;
$v_unit    = $row['v_unit']; 
$bah_cod_m = $row['bah_cod_m'];
$t_mah = $row['t_mah'];
$num_t_mah = $t_mah ; 
 if($v_unit == '1') $v_v_unit = 'فعال'   ;
 if($v_unit == '2') $v_v_unit = 'نیمه فعال';
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
<script>
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
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td>
</td>
  </tr>
  <tr>
    <td>
           <p class="style8">ثبت عملکرد سالانه واحد صنعتی <br />
             <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_ind_data($bah_cod_m,$num_bah) ;?>
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
          <td height="38"><div align="right" class="yekan red" > <?php echo $v_v_unit; ; ?></div></td>
          <td height="38"><div align="right">: وضعیت</div></td>
          <td height="38">&nbsp;</td>
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
                <input name="n_fd" type="text" class="input_text  required  number" id="n_fd" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $n_fd ; ?>" maxlength="5" readonly="readonly"  align="baseline" xml:lang="fa" />
                </div></td>
              <td width="15%"><div style="margin-right:30px" align="right">:فوق دیپلم</div></td>
              <td width="16%"><div align="right"><span class="style2">نفر</span>
                <input name="n_d" type="text" class="input_text  required  number" id="n_d" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $n_d ; ?>" maxlength="5" readonly="readonly"  align="baseline" xml:lang="fa" />
                </div></td>
              <td width="18%"><div style="margin-right:30px" align="right">: دیپلم</div></td>
              <td width="17%" bgcolor="#FFFFFF"><div align="right"><span class="style2">نفر</span>
                <input name="n_zd" type="text" class="input_text  required  number" id="n_zd" style="width:50px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $n_zd ; ?>" maxlength="5" readonly="readonly"  align="baseline" xml:lang="fa" />
                </div></td>
              <td width="16%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:زیر دیپلم</div></td>
              </tr>
            <tr>
              <td height="47" colspan="2">&nbsp;</td>
              <td><div align="right"><span class="style2">نفر</span>
                <input name="n_bl" type="text" class="input_text  required  number" id="n_bl" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $n_bl ; ?>" maxlength="5" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right">: بالاتر از لیسانس</div></td>
              <td><div align="right"><span class="style2">نفر</span>
                <input name="n_l" type="text" class="input_text  required  number" id="n_l" style="width:50px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $n_l ; ?>" maxlength="5" readonly="readonly"  align="baseline" xml:lang="fa" />
                </div></td>
              <td><div style="margin-right:30px" align="right">:لیسانس</div></td>
              </tr>
            <tr>
              <td height="47" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مصرف سوخت</strong></div></td>
              </tr>
            <tr>
              <td height="56"><div align="right"><span class="style2">لیتر</span>
                  <input name="naft_w" type="text" class="input_text  required  number" id="naft_w" style="width:70px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $naft_w ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right">:نفت سفید</div></td>
              <td><div align="right"><span class="style2">لیتر</span>
                  <input name="gaz_oil" type="text" class="input_text  required  number" id="gaz_oil" style="width:70px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $gaz_oil ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right">: گازوئیل</div></td>
<?php if ($v_gaz == '1') {?>
              <td bgcolor="#FFFFFF"><div align="right"><span class="style2">مترمکعب</span>
                  <input name="gaz" type="text" class="input_text  required  number" id="gaz" style="width:70px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $gaz ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
<?php } else {?>
                <td bgcolor="#FFFFFF"><div align="right"><span class="red1"> فاقد گاز </span>
                <input name="gaz" type="hidden"   value="0"  />
<?php }?>
              </div></td>
              <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:گاز</div></td>
            </tr>
            <tr>
              <td height="56" colspan="2">&nbsp;</td>
              <td><div align="right"><span class="style2">لیتر</span>
                <input name="benz" type="text" class="input_text  required  number" id="benz" style="width:70px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $benz ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right">: بنزین</div></td>
              <td bgcolor="#FFFFFF"><div align="right"><span class="style2">لیتر</span>
                <input name="naft_b" type="text" class="input_text  required  number" id="naft_b" style="width:70px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $naft_b ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:نفت سیاه</div></td>
            </tr>
            <tr>
              <td height="47" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مصرف آب و برق </strong></div></td>
              </tr>
            <tr>
              <td height="47" colspan="2">&nbsp;</td>
              <td><div align="right"><span class="style2">مترمکعب</span>
                <input name="ab" type="text" class="input_text  required  number" id="ab" style="width:70px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $ab ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right">: آب</div></td>
<?php if ($v_bar == '1') {?>
              <td bgcolor="#FFFFFF"><div align="right"><span class="style2">کیلووات/ساعت</span>
                  <input name="barg" type="text" class="input_text  required  number" id="barg" style="width:70px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $barg ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
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
              <td width="12%" height="53" bgcolor="#FFFFCC">میزان تولید  سالیانه<br />
                <span class="style8">تن</span></td>
              <td width="71%" bgcolor="#FFFFCC">نام محصول</td>
              <td width="13%" bgcolor="#FFFFCC">کد آیسیک</td>
              <td width="4%" bgcolor="#FFFFCC">ردیف</td>
            </tr>
            <?php 
$n = 1 ;
$num2_t_mah = $t_mah ;
///
$query = "SELECT * from ind_unit_prod where unit_id = :unit_id "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':unit_id'=>$unit_id));
////

while ($num2_t_mah > 0){
foreach($stmt as $row)
{
 $isic_cod = $row['isic_cod'] ;
 $m_tol = $row['m_tol'] ; 
?>
            <tr>
              <td height="36" bgcolor="#FFFFFF"><div align="right" style="margin:10px">
          <input name="m_tol<?php echo $num2_t_mah ;?>" type="text" class="required number input_text" id="m_tol<?php echo $num2_t_mah ;?>" style="width:75px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $m_tol ; ?>" maxlength="11" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="right" style="margin-right:10px">
                <select  name="mah_name<?php echo $num2_t_mah ;?>" disabled="disabled" class="target input_text mar<?php echo $mah_name.$num2_t_mah ;?>" id="cod_mah<?php echo $num2_t_mah ;?>" style="width:550px ; height:40px" tabindex="23" dir="rtl" l>
                <?php
$query = "SELECT isic_cod,mah_name FROM isic WHERE  isic_cod = $isic_cod" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['product_cod'] ;?>"
   <?php if ($row['isic_cod']==$isic_cod) echo 'selected=selected'?>> <?php echo $row['mah_name'] ;?></option>
     <?php
}
?>
                </select>
              </div></td>
              <td bgcolor="#FFFFFF"><div align="right"><span style="margin:10px">
                <select  name="isic_cod<?php echo $num2_t_mah ;?>" disabled="disabled" class="required country<?php echo $num2_t_mah ;?>" id="mah_qroup<?php echo $num2_t_mah ;?>"
  style="width:100px ; height:40px" tabindex="22" dir="rtl"  >
                  <option value="" > انتخاب گروه</option>
                  <?php
$query = "SELECT  isic_cod,mah_name FROM isic "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                  <option value="<?php  echo $row['isic_cod'] ;?>"
   <?php if ($row['isic_cod']==$isic_cod) echo 'selected=selected'?>>
                    <?php  echo $row['isic_cod'] ;?>
                    </option>
                  <?php }?>
                </select>
              </span></div></td>
              <td bgcolor="#FFFFFF"><?php echo $n ;?></td>
            </tr>
            <?php
 $num2_t_mah--;
 $n++ ;
}
}
?>
          </table>
           </td>
        </tr>
        </table>
          <div align="center">
        <p>
     <button  id="send" class="style8" style="width:150px ; height:45px "  onclick="close_window()">بستن پنجره</button>
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
<form  name="myform" class="myform" method="post" action="list_ind_prod.php">
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