<?php
include('../../lock_p2.php');
include('../../login/config.php');
include('../../event.php');
if  (isset($_POST['unit_id']))
{
$unit_id = $_POST['unit_id'] ; 
$y_prod = $_POST['y_prod'];
$num_bah = $_POST['num_bah'];
$query = "SELECT bah_cod_m,add_abadi,add_city,id_ostan,id_city,id_mar,unit_name,no_mush,gaz,barg from Mushroom where id = :id"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$unit_id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$add_abadi = $row["add_abadi"]; 
$add_abadi = $row["add_abadi"]; 
$add_city = $row["add_city"];
$id_ostan = $row["id_ostan"]; 
$id_city = $row["id_city"]; 
$id_mar = $row["id_mar"]; 
$bah_cod_m = $row['bah_cod_m'];
$unit_name = $row['unit_name'];
$no_mush = $row['no_mush'];
$gaz = $row['gaz'];
$barg = $row['barg'];
if ($no_mush=='1')  $v_no_mush='صدفی';
if ($no_mush=='2')  $v_no_mush='دکمه ای';
if ($no_mush=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';
$query = "SELECT * from Mushroom_prod where unit_id = :unit_id and y_prod = :y_prod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':unit_id'=>$unit_id,':y_prod'=>$y_prod));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $v_unit = $row["v_unit"]; 
if ($v_unit=='2')  $v_v_unit='در حال اخذ پروانه تاسیس';
if ($v_unit=='3')  $v_v_unit='دارای پیشرفت فیزیکی';
if ($v_unit=='4')  $v_v_unit='غیرفعال';
 $z_dep = $row['z_dep'] ;
 $dep = $row['dep'] ;
 $lisan = $row['lisan'] ;
 $t_mar = $row['t_mar'] ;
 $t_zan = $row['t_zan'] ;
 $m_fani = $row['m_fani'] ;
 $gar_j = $row['gar_j'] ;
 $gar_ja = $row['gar_ja'] ;
 $gar_m = $row['gar_m'] ;
 $gar_ma = $row['gar_ma'] ;
 $hash_j = $row['hash_j'] ;
 $hash_ja = $row['hash_ja'] ;
 $hash_m = $row['hash_m'] ;
 $hash_ma = $row['hash_ma'] ;
 $zof_j = $row['zof_j'] ;
 $zof_ja = $row['zof_ja'] ;
 $zof_m = $row['zof_m'] ;
 $zof_ma = $row['zof_ma'] ;
 $gazoil_m = $row['gazoil_m'] ;
 $gazoil_a = $row['gazoil_a'] ;
 $benz_m = $row['benz_m'] ;
 $benz_a = $row['benz_a'] ;
 $barg_m = $row['barg_m'] ;
 $barg_a = $row['barg_a'] ;
 $ab_m = $row['ab_m'] ;
 $ab_a = $row['ab_a'] ;
 if(isset($row['gaz_m'])){$gaz_m = $row['gaz_m'];$gaz_a=$row['gaz_a'];}else{$gaz_m=0;$gaz_a=0;}
 $comp   = $row['comp'] ;
 $nt_comp   = $row['nt_comp'] ;
 $t_dpar = $row['t_dpar'] ;
 $mah_tol = $row['mah_tol'] ;
 $zer_kesh = $row['zer_kesh'] ;
 $tol_avg  = $row['tol_avg'] ;
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <script type="text/javascript">
function close_window() {
      close();
 }
</script>
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
</td>
  </tr>
  <tr>
    <td>
           <p class="style8">مشاهده عملکرد سال <?php echo $y_prod?> واحد پرورش قارچ </p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1"  onSubmit="return checkform()">
      <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="31" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:20px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="33%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan)?></div></td>
          <td width="15%"><div align="right">:شهرستان</div></td>
          <td width="9%" rowspan="3">&nbsp;</td>
          <td width="25%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo $v_no_mush ?></div></td>
          <td height="38"><div align="right">: نوع قارچ پرورشی</div></td>
          <td height="38"><div align="right"> <?php echo $unit_name; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نام واحد</div></td>
        </tr>
<?php if($v_unit =='1') { ?>
        <tr>
          <td height="30" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>تعداد افراد شاغل</strong></div></td>
        </tr>
        <tr>
          <td height="40"><div align="right"><span class="style2">نفر</span>
            <input name="t_mar" type="text" class="t_mar input_text  required  digits" id="t_mar" style="width:50px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $t_mar ; ?>" maxlength="3" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div align="right">:تعداد شاغل مرد</div></td>
          <td rowspan="3">&nbsp;</td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="z_dep" type="text" class="z_dep input_text  required  digits" id="z_dep" style="width:50px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $z_dep ; ?>" maxlength="3" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:زیر دیپلم</div></td>
        </tr>
        <tr>
          <td height="43"><div align="right"><span class="style2">نفر</span>
            <input name="t_zan" type="text" class="t_zan input_text  required  digits" id="t_zan" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $t_zan ; ?>" maxlength="3" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div align="right">:تعداد شاغل زن </div></td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="dep" type="text" class="dep input_text  required  digits" id="dep" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $dep ; ?>" maxlength="3" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:دیپلم یا بالاتر</div></td>
        </tr>
        <tr>
          <td height="42"><div align="right">
            <select name="m_fani" disabled="disabled" class="input_text required " id="seeAnotherField"  style="height:40px ; width:100px ; direction:rtl" tabindex="37">
              <option value="">انتخاب کنید</option>
              <option value="1" <?php if ($m_fani=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
              <option value="2" <?php if ($m_fani=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
            </select>
          </div></td>
          <td><div align="right">:مسئول فنی </div></td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="lisan" type="text" class="lisan input_text  required  digits" id="lisan" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lisan ; ?>" maxlength="3" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:لیسانس یا بالاتر </div></td>
        </tr>
        <tr>
          <td height="215" colspan="5">  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="29" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>وضعیت سموم و مواد ضد عفونی کننده مورد استفاده در سال </strong></div></td>
                </tr>
              <tr>
                <td width="26%" height="36" ><div style="margin-right:30px" align="right" >ارزش /<span class="style2"> ریال</span></div> </td>
                <td width="18%" ><div style="margin-right:30px" align="right" >مایع / <span class="style2">لیتر</span></div></td>
                <td width="19%"  bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" > ارزش / <span class="style2"> ریال</span>  </div></td>
                <td width="19%"  bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >جامد / <span class="style2">کیلوگرم</span></div></td>
                <td width="18%">&nbsp;</td>
                </tr>
              <tr>
                <td height="46" bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_ma" type="text" class="input_text  required  number" id="gar_ma" style="width:100px;height:30px" tabindex="9" dir="rtl" lang="fa" value="<?php echo $gar_ma ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_m" type="text" class="input_text  required  number" id="gar_m" style="width:100px;height:30px" tabindex="8" dir="rtl" lang="fa" value="<?php echo $gar_m ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_ja" type="text" class="input_text  required  number" id="gar_ja" style="width:100px;height:30px" tabindex="7" dir="rtl" lang="fa" value="<?php echo $gar_ja ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_j" type="text" class="input_text  required  number" id="gar_j" style="width:100px;height:30px" tabindex="6" dir="rtl" lang="fa" value="<?php echo $gar_j ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >قارچ کش</div></td>
                </tr>
              <tr>
                <td height="44"><div align="right">
                  <input name="hash_ma" type="text" class="input_text  required  number" id="hash_ma" style="width:100px; height:30px" tabindex="13" dir="rtl" lang="fa" value="<?php echo $hash_ma ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div align="right">
                  <input name="hash_m" type="text" class="input_text  required  number" id="hash_m" style="width:100px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $hash_m ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div align="right">
                  <input name="hash_ja" type="text" class="input_text  required  number" id="hash_ja" style="width:100px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $hash_ja ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div align="right">
                  <input name="hash_j" type="text" class="input_text  required  number" id="hash_j" style="width:100px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $hash_j ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td ><div style="margin-right:30px" align="right" >حشره کش</div></td>
                </tr>
              <tr>
                <td height="47"><div align="right">
                  <input name="zof_ma" type="text" class="input_text  required  number" id="zof_ma" style="width:100px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $zof_ma ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td height="47"><div align="right">
                  <input name="zof_m" type="text" class="input_text  required  number" id="zof_m" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $zof_m ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td height="47"><div align="right">
                  <input name="zof_ja" type="text" class="input_text  required  number" id="zof_ja" style="width:100px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $zof_ja ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td height="47"><div align="right">
                  <input name="zof_j" type="text" class="input_text  required  number" id="zof_j" style="width:100px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $zof_j ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td ><div style="margin-right:30px" align="right" >ضد عفونی کننده</div></td>
                </tr>
              </table></td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="29" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>وضعیت مصرف حامل های انرژی در سال </strong></div></td>
              </tr>
            <tr>
              <td width="20%" height="35" ><?php if($gaz=='1') {?><div style="margin-right:30px" align="right" >گاز</div><?php }?></td>
              <td width="16%" ><?php if($barg=='1') {?><div style="margin-right:30px" align="right" >برق</div><?php }?></td>
              <td width="19%" ><div style="margin-right:30px" align="right" >گازوئیل</div></td>
              <td width="17%" ><div style="margin-right:30px" align="right" >بنزین</div></td>
              <td width="16%" bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >آب</div></td>
              <td width="12%">&nbsp;</td>
              </tr>
            <tr>
              <td height="47"><?php if($gaz=='1') {?><div align="right">
                <span class="style2">مترمکعب</span>
                <input name="gaz_m" type="text" class="input_text  required  number" id="gaz_m" style="width:100px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $gaz_m ; ?>" maxlength="6" readonly="readonly"  align="baseline" xml:lang="fa" />
                </div><?php }?></td>
              <td><?php if($barg=='1') {?><div align="right"> <span class="style2">کیلووات</span>
                <input name="barg_m" type="text" class="input_text  required  number" id="barg_m" style="width:100px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $barg_m ; ?>" maxlength="6" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div><?php } ?></td>
              <td><div align="right"><span class="style2">لیتر</span>
                <input name="gazoil_m" type="text" class="input_text  required  number" id="gazoil_m" style="width:100px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $gazoil_m ; ?>" maxlength="6" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right">
                <span class="style2">لیتر</span>
                <input name="benz_m" type="text" class="input_text  required  number" id="benz_m" style="width:100px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $benz_m ; ?>" maxlength="6" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right">
                <span class="style2">مترمکعب</span>
                <input name="ab_m" type="text" class="input_text  required  number" id="ab_m" style="width:100px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $ab_m ; ?>" maxlength="6" readonly="readonly"  align="baseline" xml:lang="fa" />
                </div></td>
              <td ><div style="margin-right:30px" align="right" >مقدار</div></td>
              </tr>
            <tr>
              <td height="52"><?php if($gaz=='1') {?><div align="right">
                <input name="gaz_a" type="text" class="input_text  required  number" id="gaz_a" style="width:100px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $gaz_a ; ?>" maxlength="12" readonly="readonly"  align="baseline" xml:lang="fa" />
                </div><?php }?></td>
              <td><?php if($barg=='1') {?><div align="right">
                <input name="barg_a" type="text" class="input_text  required  number" id="barg_a" style="width:100px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $barg_a ; ?>" maxlength="12" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div><?php } ?></td>
              <td><div align="right">
                <input name="gazoil_a" type="text" class="input_text  required  number" id="gazoil_a" style="width:100px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $gazoil_a ; ?>" maxlength="12" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right">
                <input name="benz_a" type="text" class="input_text  required  number" id="benz_a" style="width:100px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $benz_a ; ?>" maxlength="12" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="right">
                <input name="ab_a" type="text" class="input_text  required  number" id="ab_a" style="width:100px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $ab_a ; ?>" maxlength="12" readonly="readonly"  align="baseline" xml:lang="fa" />
                </div></td>
              <td bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >ارزش / <span class="style2"> ریال</span></div></td>
              </tr>
            </table></td>
        </tr>
          <tr>
            <td height="29" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>میزان کمپوست مصرفی در سال </strong></div></td>
              </tr>
              <tr>
                <td height="47" ><div align="right">
                  <select name="nt_comp" disabled="disabled" class="input_text required " id="m_fani"  style="height:40px ; width:100px ; direction:rtl" tabindex="28">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($nt_comp=='1') { echo 'selected="selected"' ; } ?>>خود مصرفی</option>
                    <option value="2" <?php if ($nt_comp=='2') { echo 'selected="selected"' ; } ?>>خریداری شده</option>
                    <option value="3" <?php if ($nt_comp=='3') { echo 'selected="selected"' ; } ?>>ترکیبی</option>
                  </select>
                </div></td>
                <td height="47" ><div align="right">:نحوه تامین کمپوست</div></td>
                <td height="47" >&nbsp;</td>
                <td bgcolor="#FFFFFF" ><div align="right"><span class="style2">تن /سال</span>
                  <input name="comp" type="text" class="input_text  required  number" id="comp" style="width:100px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $comp ; ?>"  maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div style="margin-right:30px" align="right" >:کمپوست مصرفی</div></td>
              </tr>
              <tr>
                <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>اطلاعات تولید  </strong></div></td>
                </tr>
              <tr>
                <td width="33%" height="47" ><div align="right"><span class="style2">تن</span>
                    <input name="mah_tol" type="text" class="input_text  required  number" id="mah_tol" style="width:100px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $mah_tol ; ?>" maxlength="9"  align="baseline" xml:lang="fa" />
                </div></td>
                <td width="15%" ><div align="right">:میزان کل تولید </div></td>
                <td width="9%" >&nbsp;</td>
                <td width="22%" bgcolor="#FFFFFF" ><div align="right"><span class="style2">دوره / سال</span>
                    <input name="t_dpar" type="text" class="input_text  required  number" id="t_dpar" style="width:100px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $t_dpar ; ?>" min="1" max="8" maxlength="1"  align="baseline" xml:lang="fa" />
                </div></td>
                <td width="21%"><div style="margin-right:30px" align="right" >:تعداد دوره های پرورش  </div></td>
                </tr>
              </table></td>
          </tr>
          <tr>
          <td height="29" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>مشخصات سالن/ سالن ها  </strong></div></td>
          </tr>
        <tr>
          <td height="142" colspan="5"><br /><?php include('../../oChief/Garden/Mushroom_spwan_view98.php')?></td>
        </tr>
        <tr>
          <td height="54"><div align="right"><span class="style2">کیلوگرم / مترمربع</span>
            <input name="tol_avg" type="text" class="input_text  required  number" id="tol_avg" style="width:100px; height:30px ; " tabindex="30" dir="rtl" lang="fa" value="<?php echo $tol_avg ; ?>" maxlength="9" readonly  align="baseline" xml:lang="fa" />
            </div></td>
          <td height="54"><div align="right">:عملکرد تولید  </div></td>
          <td height="54">&nbsp;</td>
          <td height="54"><div align="right"><span class="style2">مترمربع</span>
            <input name="zer_kesh" type="text" class="input_text  required  number" id="zer_kesh9" style="width:100px; height:30px ; " min="1"  tabindex="29" dir="rtl" lang="fa" value="<?php echo $zer_kesh ; ?>" maxlength="9" readonly  align="baseline" xml:lang="fa" />
            </div></td>
          <td height="54"><div style="margin-right:30px" align="right" >:سطح زیر کشت سالانه</div></td>
        </tr>
<?php } else { ?>
<tr>
 <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>  وضعیت واحد  </strong></div></td>
              </tr>
              <tr>
                <td height="47" colspan="5" align="center" class="style19"><?php echo $v_v_unit ?></td>
</tr>
<?php }?>
        </table>
          <div align="center">
        <p>
         <a href="../../oChief/Garden/index.php">
          <input type="button" name="btn1" value="بستن پنجره" onclick="close_window()" style="width:150px ; height:45px" tabindex="28" /></a>
    </p>
      </div>
</form> 
  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="../../oChief/Garden/Mushroom_prod.php">
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