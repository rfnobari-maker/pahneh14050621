<?php
include('../../lock_ce.php');
include('../../login/config.php');
include('../../event.php');
//include('../../login/config.php');
if  (isset($_POST['ShenaseKasboKar']))
{
$y_prod = $_POST['y_prod']  ;
$d_prod  = $_POST['d_prod']  ;
$ShenaseKasboKar = $_POST['ShenaseKasboKar'];
$query = "SELECT id_ostan,id_city,id_mar,unit_name,add_abadi,add_city,no_bah,v_gaz,v_bar,t_mah,NationalCode,id_mar  
from ind_unit where  ShenaseKasboKar = '$ShenaseKasboKar' "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$unit_id));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_bah = $row['no_bah'] ;
$NationalCode    = $row['NationalCode'];
$id_mar = $row['id_mar'] ;
$unit_name = $row['unit_name'] ;
$add_city = $row['add_city'] ;
$add_abadi = $row['add_abadi'] ;
$id_city = $row['id_city'] ;
$id_ostan = $row['id_ostan'] ;
$no_bah = $row['no_bah'] ;
$v_bar = $row['v_bar'] ;
$v_gaz = $row['v_gaz'] ;
$query = "SELECT * from ind_unit_info where y_prod = '$y_prod' and d_prod = '$d_prod' and  ShenaseKasboKar = '$ShenaseKasboKar' "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$unit_id));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$id_mar = $row['id_mar'] ;
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
function close_window() {
      close();
 }

    </script>
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>

           <p class="style8">نمایش عملکرد دوره <?php echo  $d_prod ?> ماهه سال <?php echo  $y_prod ?> واحد صنعتی 
             <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_ind_data($NationalCode,$no_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    
    <td width="840" >
      <table width="99%" height="648" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="25" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت واحد</strong></div></td>
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
          <td height="26" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>تعداد شاغلین</strong></div></td>
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
              <td height="29" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مصرف سوخت</strong></div></td>
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
                <td bgcolor="#FFFFFF"><div align="right"><span class="red1"> فاقد انشعاب گاز </span>
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
              <td height="32" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مصرف آب و برق </strong></div></td>
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
          <td height="27" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات محصول</strong></div></td>
        </tr>
        <tr>
          <td height="126" colspan="5"><table width="100%" height="107" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="11%" height="53" bgcolor="#FFFFCC">میزان تولید  <br />
                <span class="style8">تن</span></td>
              <td width="11%" bgcolor="#FFFFCC">ظرفیت جذب مواد<br />
                <span class="style8">تن</span></td>
              <td width="7%" bgcolor="#FFFFCC">ظرفیت سالن<br />
                <span class="style8">تن</span></td>
              <td width="58%" bgcolor="#FFFFCC">نام محصول</td>
              <td width="9%" bgcolor="#FFFFCC">کد آیسیک</td>
              <td width="4%" bgcolor="#FFFFCC">ردیف</td>
            </tr>
            <?php 
$n = 1 ;
$num2_t_mah = $t_mah ;

$query = "SELECT ind_list_product.m_jazb,ind_list_product.zarfiyat,
ind_list_product.product_name,ind_list_product.isic_code,ind_unit_prod.m_tol
From ind_list_product 
right join  ind_unit_prod ON 
ind_list_product.ShenaseKasboKar =ind_unit_prod.ShenaseKasboKar and 
ind_list_product.isic_code       =ind_unit_prod.isic_cod  
Where ind_list_product.ShenaseKasboKar = '$ShenaseKasboKar' and 
ind_unit_prod.y_prod = '$y_prod' and ind_unit_prod.d_prod = '$d_prod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <tr>
              <td height="36" bgcolor="#FFFFFF"><div align="center"><?php echo $row['m_tol']*1 ; ?></div></td>
              <td bgcolor="#FFFFFF"><div align="center"><?php echo $row['m_jazb']*1?></div></td>
              <td bgcolor="#FFFFFF"><div align="center"><?php echo $row['zarfiyat']*1?></div></td>
              <td bgcolor="#FFFFFF"><div align="right" style="margin-right:5px"><?php echo $row['product_name']?></div></td>
              <td bgcolor="#FFFFFF"><div align="right" style=" margin-right:5px; font-size:12px "><?php echo $row['isic_code']?></div></td>
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
       <input type="button" name="btn1" value="بستن"  onclick="close_window()" style="width:150px ; height:45px" tabindex="36" />
        </p>
      </div>
  </td>
  </tr>
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