<?php
include('../../lock_Sc.php');
include('../../login/config.php');
include('../../event.php');

if  (isset($_POST['unit_id']))
{
$unit_id = $_POST['unit_id'] ; 
$y_prod = $_POST['y_prod'];
$num_bah = $_POST['num_bah'];
$query = "SELECT bah_cod_m,add_abadi,add_city,id_ostan,id_city,id_mar,unit_name,no_kesht,gaz,barg from Greenhous where id = :id"; 
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
$gaz = $row['gaz'];
$barg = $row['barg'] ; 
$no_kesht = $row['no_kesht'];
 if ($no_kesht =='2') {$v_no_kesht ='در فضای باز' ; }
$query = "SELECT * from Greenhous_prod where unit_id = :unit_id and y_prod = :y_prod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':unit_id'=>$unit_id,':y_prod'=>$y_prod));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_mtol = $row['no_mtol'];
 $t_mah = $row['t_mah'] ; 
 $v_unit   = '1' ;
 $z_dep = $row['z_dep'] ;
 $dep = $row['dep'] ;
 $lisan = $row['lisan'] ;
 $t_mar = $row['t_mar'] ;
 $t_zan  = $row['t_zan'] ;
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
 $ab_m = $row['ab_m'] ;
 $ab_a = $row['ab_a'] ;
 $benz_m = $row['benz_m'] ;
 $benz_a = $row['benz_a'] ;
 $barg_m = $row['barg_m'] ;
 $barg_a = $row['barg_a'] ;
 $gaz_m = $row['gaz_m'] ;
 $gaz_a = $row['gaz_a'] ;
 $kod_h1_m = $row['kod_h1_m'] ;
 $kod_h1_a = $row['kod_h1_a'] ;
 $kod_h2_m = $row['kod_h2_m'] ;
 $kod_h2_a = $row['kod_h2_a'] ;
 $kod_h3_m = $row['kod_h3_m'] ;
 $kod_h3_a = $row['kod_h3_a'] ;
 $kod_sh1_m = $row['kod_sh1_m'] ;
 $kod_sh1_a = $row['kod_sh1_a'] ;
 $kod_sh2_m = $row['kod_sh2_m'] ;
 $kod_sh2_a = $row['kod_sh2_a'] ;
 $kod_sh3_m = $row['kod_sh3_m'] ;
 $kod_sh3_a = $row['kod_sh3_a'] ;
 $kod_bio1_m = $row['kod_bio1_m'] ;
 $kod_bio1_a = $row['kod_bio1_a'] ;
 $kod_bio2_m = $row['kod_bio2_m'] ;
 $kod_bio2_a = $row['kod_bio2_a'] ;
 $kod_bio3_m = $row['kod_bio3_m'] ;
 $kod_bio3_a = $row['kod_bio3_a'] ;
 $bazr_m = $row['bazr_m'] ;
 $bazr_a = $row['bazr_a'] ;
 $nesha_m = $row['nesha_m'] ;
 $nesha_a = $row['nesha_a'] ;
 $t_hshekar = $row['t_hshekar'] ;
 $t_zgard = $row['t_zgard'] ;
 $b_coco = $row['b_coco'] ;
 $b_mas = $row['b_mas'] ;
 $b_per = $row['b_per'] ;
 $b_pet = $row['b_pet'] ;
 $b_say = $row['b_say'] ;


if ($no_mtol=='211100') { $v_no_mtol='سبزی و صیفی'; $unit = 'تن'  ; }
if ($no_mtol=='211300')   {$v_no_mtol='گل و گیاه زینتی '; $unit = 'شاخه/گلدان/بونه/اصله' ; }
if ($no_mtol=='211200')  {$v_no_mtol='سایر' ;	$unit = 'تن/عدد' ; }

$num_t_mah = $t_mah ; 

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
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>

      <p class="style8"> عملکرد سال <?php echo $y_prod?> گلخانه </p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1"  onSubmit="return checkform()">
      <table width="90%" height="642" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
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
          <td height="38"><div align="right"><?php echo $v_no_mtol ; if(isset($v_no_kesht)) echo $v_no_kesht ; ?></div></td>
          <td height="38"><div align="right">: نوع محصول تولیدی</div></td>
          <td height="38"><div align="right"> <?php echo $unit_name; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نام واحد</div></td>
        </tr>
        <tr>
          <td height="30" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>تعداد افراد شاغل</strong></div></td>
        </tr>
        <tr>
          <td height="40"><div align="right"><span class="style2">نفر</span>
            <input name="t_mar" type="text" class="t_mar input_text  required  digits" id="t_mar" style="width:50px; height:30px ; " readonly="readonly" tabindex="4" dir="rtl" lang="fa" value="<?php echo $t_mar ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div align="right">:تعداد شاغل مرد</div></td>
          <td rowspan="3">&nbsp;</td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="z_dep" type="text" class="z_dep input_text  required  digits" id="z_dep" style="width:50px; height:30px ; " readonly="readonly" tabindex="1" dir="rtl" lang="fa" value="<?php echo $z_dep ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:زیر دیپلم</div></td>
        </tr>
        <tr>
          <td height="43"><div align="right"><span class="style2">نفر</span>
            <input name="t_zan" type="text" class="t_zan input_text  required  digits" id="t_zan" style="width:50px; height:30px ; " readonly="readonly" tabindex="5" dir="rtl" lang="fa" value="<?php echo $t_zan ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div align="right">:تعداد شاغل زن </div></td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="dep" type="text" class="dep input_text  required  digits" id="dep" style="width:50px; height:30px ; " readonly="readonly" tabindex="2" dir="rtl" lang="fa" value="<?php echo $dep ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:دیپلم یا بالاتر</div></td>
        </tr>
        <tr>
          <td height="42"><div align="right">
            <select name="m_fani" disabled="disabled" class="input_text required " id="seeAnotherField"  style="height:40px ; width:100px ; direction:rtl" tabindex="6">
              <option value="">انتخاب کنید</option>
              <option value="1" <?php if ($m_fani=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
              <option value="2" <?php if ($m_fani=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
            </select>
          </div></td>
          <td><div align="right">:مسئول فنی </div></td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="lisan" type="text" class="lisan input_text  required  digits" id="lisan" style="width:50px; height:30px ; " readonly="readonly" tabindex="3" dir="rtl" lang="fa" value="<?php echo $lisan ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:لیسانس یا بالاتر </div></td>
        </tr>
        <tr>
          <td height="215" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td  height="29" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>وضعیت سموم و مواد ضد عفونی کننده مورد استفاده در سال </strong></div></td>
            </tr>
            <tr>
              <td width="26%" height="36" bgcolor="#FFFFCC" ><div style="margin-right:30px" align="right" >ارزش /<span class="style2"> ریال</span></div></td>
              <td width="18%" bgcolor="#FFFFCC" ><div style="margin-right:30px" align="right" >مایع / <span class="style2">لیتر</span></div></td>
              <td width="19%"  bgcolor="#FFFFCC" ><div style="margin-right:30px" align="right" > ارزش / <span class="style2"> ریال</span></div></td>
              <td width="19%"  bgcolor="#FFFFCC" ><div style="margin-right:30px" align="right" >جامد / <span class="style2">کیلوگرم</span></div></td>
              <td width="18%" bgcolor="#FFFFCC">&nbsp;</td>
            </tr>
            <tr>
              <td height="46" bgcolor="#FFFFFF"><div align="right">
                <input name="gar_ma" type="text" class="input_text  required  digits" id="gar_ma" style="width:100px;height:30px" readonly="readonly" tabindex="10" dir="rtl" lang="fa" value="<?php echo $gar_ma ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="right">
                <input name="gar_m" type="text" class="input_text  required  number" id="gar_m" style="width:100px;height:30px" readonly="readonly" tabindex="9" dir="rtl" lang="fa" value="<?php echo $gar_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="right">
                <input name="gar_ja" type="text" class="input_text  required  digits" id="gar_ja" style="width:100px;height:30px" readonly="readonly" tabindex="8" dir="rtl" lang="fa" value="<?php echo $gar_ja ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="right">
                <input name="gar_j" type="text" class="input_text  required  number" id="gar_j" style="width:100px;height:30px" readonly="readonly" tabindex="7" dir="rtl" lang="fa" value="<?php echo $gar_j ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td width="18%" bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >قارچ کش</div></td>
            </tr>
            <tr>
              <td height="44"><div align="right">
                <input name="hash_ma" type="text" class="input_text  required  digits" id="hash_ma" style="width:100px; height:30px" readonly="readonly" tabindex="14" dir="rtl" lang="fa" value="<?php echo $hash_ma ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right">
                <input name="hash_m" type="text" class="input_text  required  number" id="hash_m" style="width:100px; height:30px ; " readonly="readonly" tabindex="13" dir="rtl" lang="fa" value="<?php echo $hash_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right">
                <input name="hash_ja" type="text" class="input_text  required  digits" id="hash_ja" style="width:100px; height:30px ; " readonly="readonly" tabindex="12" dir="rtl" lang="fa" value="<?php echo $hash_ja ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right">
                <input name="hash_j" type="text" class="input_text  required  number" id="hash_j" style="width:100px; height:30px ; " readonly="readonly" tabindex="11" dir="rtl" lang="fa" value="<?php echo $hash_j ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td ><div style="margin-right:30px" align="right" >حشره کش</div></td>
            </tr>
            <tr>
              <td height="47"><div align="right">
                <input name="zof_ma" type="text" class="input_text  required  digits" id="zof_ma" style="width:100px; height:30px ; " readonly="readonly" tabindex="18" dir="rtl" lang="fa" value="<?php echo $zof_ma ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td height="47"><div align="right">
                <input name="zof_m" type="text" class="input_text  required  number" id="zof_m" style="width:100px; height:30px ; " readonly="readonly" tabindex="17" dir="rtl" lang="fa" value="<?php echo $zof_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td height="47"><div align="right">
                <input name="zof_ja" type="text" class="input_text  required  digits" id="zof_ja" style="width:100px; height:30px ; " readonly="readonly" tabindex="16" dir="rtl" lang="fa" value="<?php echo $zof_ja ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td height="47"><div align="right">
                <input name="zof_j" type="text" class="input_text  required  number" id="zof_j" style="width:100px; height:30px ; " readonly="readonly" tabindex="15" dir="rtl" lang="fa" value="<?php echo $zof_j ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td ><div style="margin-right:30px" align="right" >ضد عفونی کننده</div></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="29" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong><span dir="rtl">میزان  و ارزش کودهای مصرفی مورد استفاده در سال</span></strong></div></td>
            </tr>
            <tr>
              <td height="29" colspan="6"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="13%" height="35" bgcolor="#FFFFCC">ارزش <span class="style2">ریال</span></td>
                  <td width="7%" bgcolor="#FFFFCC">مقدار</td>
                  <td width="7%" bgcolor="#FFFFCC">نوع</td>
                  <td width="12%" bgcolor="#FFFFCC">ارزش <span class="style2">ریال</span></td>
                  <td width="7%" bgcolor="#FFFFCC">مقدار</td>
                  <td width="8%" bgcolor="#FFFFCC">نوع</td>
                  <td width="13%" bgcolor="#FFFFCC">ارزش <span class="style2">ریال</span></td>
                  <td width="7%" bgcolor="#FFFFCC">مقدار</td>
                  <td width="11%" bgcolor="#FFFFCC">نوع</td>
                  <td width="15%" bgcolor="#FFFFCC">گروه</td>
                </tr>
                <tr>
                  <td height="49"><div align="right">
                    <input name="kod_h3_a" type="text" class="input_text  required  digits" id="kod_h3_a" style="width:100px;height:30px" readonly="readonly" tabindex="24" dir="rtl" lang="fa" value="<?php echo $kod_h3_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td><div align="right">
                    <input name="kod_h3_m" type="text" class="input_text  required  number" id="kod_h3_m" style="width:50px;height:30px" readonly="readonly" tabindex="23" dir="rtl" lang="fa" value="<?php echo $kod_h3_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td>سایر</td>
                  <td><div align="right">
                    <input name="kod_h2_a" type="text" class="input_text  required  digits" id="kod_h2_a" style="width:100px;height:30px" readonly="readonly" tabindex="22" dir="rtl" lang="fa" value="<?php echo $kod_h2_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td><div align="right">
                    <input name="kod_h2_m" type="text" class="input_text  required  number" id="kod_h2_m" style="width:50px;height:30px" readonly="readonly" tabindex="21" dir="rtl" lang="fa" value="<?php echo $kod_h2_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td>مرغی</td>
                  <td><div align="right">
                    <input name="kod_h1_a" type="text" class="input_text  required  digits" id="kod_h1_a" style="width:100px;height:30px" readonly="readonly" tabindex="20" dir="rtl" lang="fa" value="<?php echo $kod_h1_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td><div align="right">
                    <input name="kod_h1_m" type="text" class="input_text  required  number" id="kod_h1_m" style="width:50px;height:30px" readonly="readonly" tabindex="19" dir="rtl" lang="fa" value="<?php echo $kod_h1_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td>گاوی / گوسفندی</td>
                  <td>کود حیوانی <span class="style2">تن</span></td>
                </tr>
                <tr>
                  <td height="52"><div align="right">
                    <input name="kod_sh3_a" type="text" class="input_text  required  digits" id="kod_sh3_a" style="width:100px;height:30px" readonly="readonly" tabindex="30" dir="rtl" lang="fa" value="<?php echo $kod_sh3_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td><div align="right">
                    <input name="kod_sh3_m" type="text" class="input_text  required  number" id="kod_sh3_m" style="width:50px;height:30px" readonly="readonly" tabindex="29" dir="rtl" lang="fa" value="<?php echo $kod_sh3_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td>سایر</td>
                  <td><div align="right">
                    <input name="kod_sh2_a" type="text" class="input_text  required  digits" id="kod_sh2_a" style="width:100px;height:30px" readonly="readonly" tabindex="28" dir="rtl" lang="fa" value="<?php echo $kod_sh2_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td><div align="right">
                    <input name="kod_sh2_m" type="text" class="input_text  required  number" id="kod_sh2_m" style="width:50px;height:30px" readonly="readonly" tabindex="27" dir="rtl" lang="fa" value="<?php echo $kod_sh2_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td>پتاس</td>
                  <td><div align="right">
                    <input name="kod_sh1_a" type="text" class="input_text  required  digits" id="kod_sh1_a" style="width:100px;height:30px" readonly="readonly" tabindex="26" dir="rtl" lang="fa" value="<?php echo $kod_sh1_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td><div align="right">
                    <input name="kod_sh1_m" type="text" class="input_text  required  number" id="kod_sh1_m" style="width:50px;height:30px" readonly="readonly" tabindex="25" dir="rtl" lang="fa" value="<?php echo $kod_sh1_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td>فسفات</td>
                  <td>کود شیمیایی <span class="style2">کیلوگرم</span></td>
                </tr>
                <tr>
                  <td height="54"><div align="right">
                    <input name="kod_bio3_a" type="text" class="input_text  required  digits" id="kod_bio3_a" style="width:100px;height:30px"readonly="readonly" tabindex="36" dir="rtl" lang="fa" value="<?php echo $kod_bio3_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td><div align="right">
                    <input name="kod_bio3_m" type="text" class="input_text  required  number" id="kod_bio3_m" style="width:50px;height:30px" readonly="readonly" tabindex="35" dir="rtl" lang="fa" value="<?php echo $kod_bio3_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td>سایر</td>
                  <td><div align="right">
                    <input name="kod_bio2_a" type="text" class="input_text  required  digits" id="kod_bio2_a" style="width:100px;height:30px" readonly="readonly" tabindex="34" dir="rtl" lang="fa" value="<?php echo $kod_bio2_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td><div align="right">
                    <input name="kod_bio2_m" type="text" class="input_text  required  number" id="kod_bio2_m" style="width:50px;height:30px" readonly="readonly" tabindex="33" dir="rtl" lang="fa" value="<?php echo $kod_bio2_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td>مایکوروت</td>
                  <td><div align="right">
                    <input name="kod_bio1_a" type="text" class="input_text  required  digits" id="kod_bio1_a" style="width:100px;height:30px" readonly="readonly" tabindex="32" dir="rtl" lang="fa" value="<?php echo $kod_bio1_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td><div align="right">
                    <input name="kod_bio1_m" type="text" class="input_text  required  number" id="kod_bio1_m" style="width:50px;height:30px" readonly="readonly" tabindex="31" dir="rtl" lang="fa" value="<?php echo $kod_bio1_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                  </div></td>
                  <td>فسفات بارو</td>
                  <td>کود بیولوژیک <span class="style2"> کیلوگرم</span></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="29" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>وضعیت مصرف حامل های انرژی در سال </strong></div></td>
            </tr>
            <tr>
              <td width="19%" height="35" bgcolor="#FFFFCC" ><?php if($gaz=='1') {?>
                <div style="margin-right:30px" align="right" >گاز</div>
                <?php }?></td>
              <td width="17%" bgcolor="#FFFFCC" ><?php if($barg=='1') {?>
                <div style="margin-right:30px" align="right" >برق</div>
                <?php }?></td>
              <td width="15%" bgcolor="#FFFFCC" ><div style="margin-right:30px" align="right" >گازوئیل</div></td>
              <td width="17%" bgcolor="#FFFFCC" ><div style="margin-right:30px" align="right" >بنزین</div></td>
              <td width="20%" bgcolor="#FFFFCC" ><div style="margin-right:30px" align="right" >آب</div></td>
              <td width="12%" bgcolor="#FFFFCC">&nbsp;</td>
            </tr>
            <tr>
              <td height="47"><?php if($gaz=='1') {?>
                <div align="right"> <span class="style2">مترمکعب</span>
                  <input name="gaz_m" type="text" class="input_text  required  number" id="gaz_m" style="width:100px; height:30px ; " readonly="readonly" tabindex="45" dir="rtl" lang="fa" value="<?php echo $gaz_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div>
                <?php }?></td>
              <td><?php if($barg=='1') {?>
                <div align="right"> <span class="style2">کیلووات</span>
                  <input name="barg_m" type="text" class="input_text  required  number" id="barg_m" style="width:100px; height:30px ; " readonly="readonly" tabindex="43" dir="rtl" lang="fa" value="<?php echo $barg_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div>
                <?php } ?></td>
              <td><div align="right"><span class="style2">لیتر</span>
                <input name="gazoil_m" type="text" class="input_text  required  number" id="gazoil_m" style="width:100px; height:30px ; " readonly="readonly" tabindex="41" dir="rtl" lang="fa" value="<?php echo $gazoil_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right"> <span class="style2">لیتر</span>
                <input name="benz_m" type="text" class="input_text  required  number" id="benz_m" style="width:100px; height:30px ; " readonly="readonly" tabindex="39" dir="rtl" lang="fa" value="<?php echo $benz_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right"> <span class="style2">مترمکعب</span>
                <input name="ab_m" type="text" class="input_text  required  number" id="ab_m" style="width:100px; height:30px ; " readonly="readonly" tabindex="37" dir="rtl" lang="fa" value="<?php echo $ab_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
              </div></td>
              <td ><div style="margin-right:30px" align="right" >مقدار</div></td>
            </tr>
            <tr>
              <td height="52"><?php if($gaz=='1') {?>
                <div align="right">
                  <input name="gaz_a" type="text" class="input_text  required  number" id="gaz_a" style="width:100px; height:30px ; " readonly="readonly" tabindex="46" dir="rtl" lang="fa" value="<?php echo $gaz_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                </div>
                <?php }?></td>
              <td><?php if($barg=='1') {?>
                <div align="right">
                  <input name="barg_a" type="text" class="input_text  required  number" id="barg_a" style="width:100px; height:30px ; " readonly="readonly" tabindex="44" dir="rtl" lang="fa" value="<?php echo $barg_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                </div>
                <?php } ?></td>
              <td><div align="right">
                <input name="gazoil_a" type="text" class="input_text  required  number" id="gazoil_a" style="width:100px; height:30px ; " readonly="readonly" tabindex="42" dir="rtl" lang="fa" value="<?php echo $gazoil_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right">
                <input name="benz_a" type="text" class="input_text  required  number" id="benz_a" style="width:100px; height:30px ; " readonly="readonly" tabindex="40" dir="rtl" lang="fa" value="<?php echo $benz_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="right">
                <input name="ab_a" type="text" class="input_text  required  number" id="ab_a" style="width:100px; height:30px ; " readonly="readonly" tabindex="38" dir="rtl" lang="fa" value="<?php echo $ab_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >ارزش / <span class="style2"> ریال</span></div></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="29" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong><span dir="rtl">وضعیت  تامین نهاده تکثیری در سال</span></strong></div></td>
            </tr>
            <tr>
              <td height="26" bgcolor="#FFFFCC" >&nbsp;</td>
              <td height="26" bgcolor="#FFFFCC" >ارزش <span class="style2">ریال</span></td>
              <td height="26" bgcolor="#FFFFCC" >&nbsp;</td>
              <td bgcolor="#FFFFCC" >مقدار</td>
              <td bgcolor="#FFFFCC">&nbsp;</td>
            </tr>
            <tr>
              <td height="36" >&nbsp;</td>
              <td height="36" ><div align="right">
                <input name="bazr_a" type="text" class="input_text  required  digits" id="bazr_a" style="width:100px;height:30px" readonly="readonly" tabindex="48" dir="rtl" lang="fa" value="<?php echo $bazr_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td height="36" >&nbsp;</td>
              <td bgcolor="#FFFFFF" ><div align="right"> <span class="style2">عدد/کیلوگرم</span>
                <input name="bazr_m" type="text" class="input_text  required  number" id="bazr_m" style="width:100px; height:30px ; " readonly="readonly" tabindex="47" dir="rtl" lang="fa" value="<?php echo $bazr_m ; ?>" maxlength="7"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right" >:بذر مصرفی </div></td>
            </tr>
            <tr>
              <td height="47" >&nbsp;</td>
              <td height="47" ><div align="right">
                <div align="right">
                  <input name="nesha_a" type="text" class="input_text  required  number" id="nesha_a" style="width:100px;height:30px" readonly="readonly" tabindex="50" dir="rtl" lang="fa" value="<?php echo $nesha_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                </div>
              </div></td>
              <td height="47" >&nbsp;</td>
              <td bgcolor="#FFFFFF" ><div align="right"> <span class="style2">عدد</span>
                <input name="nesha_m" type="text" class="input_text  required  digits" id="nesha_m" style="width:100px; height:30px  " readonly="readonly" tabindex="49" dir="rtl" lang="fa" value="<?php echo $nesha_m ; ?>" maxlength="7"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:30px" align="right" >:نشاء مصرفی </div></td>
            </tr>
            <tr>
              <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>شکارگرها و گرده افشان ها </strong></div></td>
            </tr>
            <tr>
              <td width="33%" height="59" ><div align="right"><span class="style2">عدد</span>
                <input name="t_zgard" type="text" class="input_text  required  digits" id="t_zgard" style="width:100px; height:30px ; " readonly="readonly" tabindex="52" dir="rtl" lang="fa" value="<?php echo $t_zgard ; ?>" maxlength="7"  align="baseline" xml:lang="fa" />
              </div></td>
              <td width="22%" ><div align="right">: میزان استفاده از زنبورهای گرده افشان<span dir="rtl"></span></div></td>
              <td width="2%" >&nbsp;</td>
              <td width="21%" bgcolor="#FFFFFF" ><div align="right"><span class="style2">عدد</span>
                <input name="t_hshekar" type="text" class="input_text  required  digits" id="t_hshekar" style="width:100px; height:30px ; " readonly="readonly" tabindex="51" dir="rtl" lang="fa" value="<?php echo $t_hshekar ; ?>"  maxlength="7"  align="baseline" xml:lang="fa" />
              </div></td>
              <td width="22%"><div style="margin-right:30px" align="right" >:<span dir="rtl"> میزان استفاده  از حشرات شکارگر</span></div></td>
            </tr>
          </table></td>
        </tr>
          <?php if($no_kesht != '2') {?>
        <tr>
          <td height="29" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong><span dir="rtl">سیستم  کشت هیدروپونیک </span></strong></div></td>
        </tr>
        <tr>
          <td height="29" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%" height="28" bgcolor="#FFFFCC">سایر</td>
              <td width="14%" bgcolor="#FFFFCC"><span dir="rtl">پالم  پیت</span></td>
              <td width="14%" bgcolor="#FFFFCC"><span dir="rtl">پرلیت</span></td>
              <td width="14%" bgcolor="#FFFFCC"><span dir="rtl">پیت  ماس</span></td>
              <td width="15%" bgcolor="#FFFFCC"><span dir="rtl">کوکوپیت</span></td>
              <td width="30%" bgcolor="#FFFFCC">نوع بستر </td>
            </tr>
            <tr>
              <td height="50"><div align="center">
                <input name="b_say" type="text" class="input_text  number" id="b_say" style="width:75px; height:30px ; " tabindex="57" dir="rtl" lang="fa" value="<?php echo $b_say ; ?>"  readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="center">
                <input name="b_pet" type="text" class="input_text  number" id="b_pet" style="width:75px; height:30px ; " tabindex="56" dir="rtl" lang="fa" value="<?php echo $b_pet ; ?>"  readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="center">
                <input name="b_per" type="text" class="input_text  number" id="b_per" style="width:75px; height:30px ; " tabindex="55" dir="rtl" lang="fa" value="<?php echo $b_per ; ?>"  readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="center">
                <input name="b_mas" type="text" class="input_text  number" id="b_mas" style="width:75px; height:30px ; " tabindex="54" dir="rtl" lang="fa" value="<?php echo $b_mas ; ?>"  readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="center">
                <input name="b_coco" type="text" class="input_text  number" id="b_coco" style="width:75px; height:30px ; " tabindex="53" dir="rtl" lang="fa" value="<?php echo $b_coco ; ?>"   readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td>میزان بستر کشت مصرفی <br />
                <span class="style2" dir="rtl">تن  یا مترمکعب</span></td>
            </tr>
                 <?php }?>
            <tr>
              <td height="35" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>اطلاعات تولید محصول</strong></div></td>
            </tr>
            <tr>
              <td height="16" colspan="6"><table width="100%"  border="1" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="9%" rowspan="2" bgcolor="#FFFFCC">میزان تولید<span class="style2"></span><br />
                    <span class="style2"><?php echo $unit ;?></span></td>
                  <?php if($no_mtol == '211100') {?>
                  <td colspan="2" bgcolor="#FFFFCC">تاریخ برداشت</td>
                  <?php }?>
                  <td width="9%" rowspan="2" bgcolor="#FFFFCC">سطح زیر کشت<br />
                    <span class="style2">مترمربع</span></td>
                  <?php if($no_mtol == '211100') {?>
                  <td colspan="2" bgcolor="#FFFFCC">تاریخ کشت</td>
                  <?php }?>
                  <td height="29" colspan="2" bgcolor="#FFFFCC">اطلاعات محصول</td>
                  <td width="4%" rowspan="2" bgcolor="#FFFFCC">ردیف</td>
                </tr>
                <tr>
                  <?php if($no_mtol == '211100') {?>
                  <td width="9%" bgcolor="#FFFFCC">پایان</td>
                  <td width="9%" bgcolor="#FFFFCC"> شروع</td>
                  <td width="9%" bgcolor="#FFFFCC"> پایان</td>
                  <td width="9%" bgcolor="#FFFFCC"> شروع</td>
                  <?php }?>
                  <td width="23%" height="29" bgcolor="#FFFFCC">نام محصول</td>
                  <td width="19%" bgcolor="#FFFFCC"> نام گروه</td>
                </tr>
                <?php 
$n = 1;
$num2_t_mah = $t_mah ;
$query = "SELECT id,group_cod,mah_cod,date_1_kesh,date_2_kesh,s_kesh,date_1_bar,date_2_bar,m_tol from Greenprod_annual where unit_id = :unit_id and y_prod = :y_prod "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':unit_id'=>$unit_id,':y_prod'=>$y_prod));
$row_count = $stmt -> rowCount();
while ($num2_t_mah > 0){
foreach($stmt as $row)
{
$Greenprod_id  = $row['id'] ; 
$group_cod     = $row['group_cod'] ;
$mah_cod       = $row['mah_cod'] ;
$date_1_kesh   = $row['date_1_kesh'] ; 
$date_2_kesh   = $row['date_2_kesh'] ; 
$s_kesh        = $row['s_kesh'] ;
$date_1_bar    = $row['date_1_bar'] ;
$date_2_bar    = $row['date_2_bar'] ;
$m_tol         = $row['m_tol'] ;
?>
                <tr>
                  <td height="62" bgcolor="#FFFFFF"><div align="center">
                    <input name="m_tol<?php echo $num2_t_mah ;?>" type="text" class="m_tol<?php echo $num2_t_mah ;?> required number input_text" id="m_tol<?php echo $num2_t_mah ;?>" style="width:70px; height:30px ; " tabindex="65" dir="rtl" lang="fa" value="<?php echo $m_tol * 1 ;?>" maxlength="10" readonly="readonly"  align="baseline" onpaste="return false" xml:lang="fa" />
                  </div></td>
                  <?php if($no_mtol == '211100') {?>
                  <td bgcolor="#FFFFFF"><div align="center">
                    <select name="date_2_bar<?php echo $num2_t_mah ;?>" disabled="disabled" class="date date_2_bar<?php echo $num2_t_mah ;?> input_text  " id="date_2_bar<?php echo $num2_t_mah ;?>"  style="height:40px ; width:70px ; direction:rtl" tabindex="64">
                      <option value="">انتخاب</option>
                      <option value="01"<?php if($date_2_bar == '01') echo 'selected=selected'?>>فروردین</option>
                      <option value="02"<?php if($date_2_bar == '02') echo 'selected=selected'?>>اردیبهشت</option>
                      <option value="03"<?php if($date_2_bar == '03') echo 'selected=selected'?>>خرداد</option>
                      <option value="04"<?php if($date_2_bar == '04') echo 'selected=selected'?>>تیر</option>
                      <option value="05"<?php if($date_2_bar == '05') echo 'selected=selected'?>>مرداد</option>
                      <option value="06"<?php if($date_2_bar == '06') echo 'selected=selected'?>>شهریور</option>
                      <option value="07"<?php if($date_2_bar == '07') echo 'selected=selected'?>>مهر</option>
                      <option value="08"<?php if($date_2_bar == '08') echo 'selected=selected'?>>آبان</option>
                      <option value="09"<?php if($date_2_bar == '09') echo 'selected=selected'?>>آذر</option>
                      <option value="10"<?php if($date_2_bar == '10') echo 'selected=selected'?>>دی</option>
                      <option value="11"<?php if($date_2_bar == '11') echo 'selected=selected'?>>بهمن</option>
                      <option value="12"<?php if($date_2_bar == '12') echo 'selected=selected'?>>اسفند</option>
                    </select>
                  </div></td>
                  <td bgcolor="#FFFFFF"><div align="center">
                    <select name="date_1_bar<?php echo $num2_t_mah ;?>" disabled="disabled" class="date date_1_bar<?php echo $num2_t_mah ;?> input_text  " id="date_1_bar<?php echo $num2_t_mah ;?>"  style="height:40px ; width:70px ; direction:rtl" tabindex="63">
                      <option value="">انتخاب</option>
                      <option value="01"<?php if($date_1_bar == '01') echo 'selected=selected'?>>فروردین</option>
                      <option value="02"<?php if($date_1_bar == '02') echo 'selected=selected'?>>اردیبهشت</option>
                      <option value="03"<?php if($date_1_bar == '03') echo 'selected=selected'?>>خرداد</option>
                      <option value="04"<?php if($date_1_bar == '04') echo 'selected=selected'?>>تیر</option>
                      <option value="05"<?php if($date_1_bar == '05') echo 'selected=selected'?>>مرداد</option>
                      <option value="06"<?php if($date_1_bar == '06') echo 'selected=selected'?>>شهریور</option>
                      <option value="07"<?php if($date_1_bar == '07') echo 'selected=selected'?>>مهر</option>
                      <option value="08"<?php if($date_1_bar == '08') echo 'selected=selected'?>>آبان</option>
                      <option value="09"<?php if($date_1_bar == '09') echo 'selected=selected'?>>آذر</option>
                      <option value="10"<?php if($date_1_bar == '10') echo 'selected=selected'?>>دی</option>
                      <option value="11"<?php if($date_1_bar == '11') echo 'selected=selected'?>>بهمن</option>
                      <option value="12"<?php if($date_1_bar == '12') echo 'selected=selected'?>>اسفند</option>
                    </select>
                  </div></td>
                  <?php }?>
                  <td bgcolor="#FFFFFF"><div align="center">
                    <input name="s_kesh<?php echo $num2_t_mah ;?>" type="text" class="mah_tolp required number input_text" id="s_kesh<?php echo $num2_t_mah ;?>" style="width:70px; height:30px ; " tabindex="62" dir="rtl" lang="fa" value="<?php echo $s_kesh * 1?>" maxlength="10" readonly="readonly"  align="baseline" onpaste="return false" xml:lang="fa" />
                  </div></td>
                  <?php if($no_mtol == '211100') {?>
                  <td bgcolor="#FFFFFF"><div align="center">
                    <select name="date_2_kesh<?php echo $num2_t_mah ;?>" disabled="disabled" class="date date_2_kesh<?php echo $num2_t_mah ;?> input_text  " id="date_2_kesh<?php echo $num2_t_mah ;?>"  style="height:40px ; width:70px ; direction:rtl" tabindex="61">
                      <option value="">انتخاب</option>
                      <option value="01"<?php if($date_2_kesh == '01') echo 'selected=selected'?>>فروردین</option>
                      <option value="02"<?php if($date_2_kesh == '02') echo 'selected=selected'?>>اردیبهشت</option>
                      <option value="03"<?php if($date_2_kesh == '03') echo 'selected=selected'?>>خرداد</option>
                      <option value="04"<?php if($date_2_kesh == '04') echo 'selected=selected'?>>تیر</option>
                      <option value="05"<?php if($date_2_kesh == '05') echo 'selected=selected'?>>مرداد</option>
                      <option value="06"<?php if($date_2_kesh == '06') echo 'selected=selected'?>>شهریور</option>
                      <option value="07"<?php if($date_2_kesh == '07') echo 'selected=selected'?>>مهر</option>
                      <option value="08"<?php if($date_2_kesh == '08') echo 'selected=selected'?>>آبان</option>
                      <option value="09"<?php if($date_2_kesh == '09') echo 'selected=selected'?>>آذر</option>
                      <option value="10"<?php if($date_2_kesh == '10') echo 'selected=selected'?>>دی</option>
                      <option value="11"<?php if($date_2_kesh == '11') echo 'selected=selected'?>>بهمن</option>
                      <option value="12"<?php if($date_2_kesh == '12') echo 'selected=selected'?>>اسفند</option>
                    </select>
                  </div></td>
                  <td bgcolor="#FFFFFF"><div align="center">
                    <select name="date_1_kesh<?php echo $num2_t_mah ;?>" disabled="disabled" class="date date_1_kesh<?php echo $num2_t_mah ;?> input_text  " id="date_1_kesh<?php echo $num2_t_mah ;?>"  style="height:40px ; width:70px ; direction:rtl" tabindex="60">
                      <option value="">انتخاب</option>
                      <option value="01"<?php if($date_1_kesh == '01') echo 'selected=selected'?>>فروردین</option>
                      <option value="02"<?php if($date_1_kesh == '02') echo 'selected=selected'?>>اردیبهشت</option>
                      <option value="03"<?php if($date_1_kesh == '03') echo 'selected=selected'?>>خرداد</option>
                      <option value="04"<?php if($date_1_kesh == '04') echo 'selected=selected'?>>تیر</option>
                      <option value="05"<?php if($date_1_kesh == '05') echo 'selected=selected'?>>مرداد</option>
                      <option value="06"<?php if($date_1_kesh == '06') echo 'selected=selected'?>>شهریور</option>
                      <option value="07"<?php if($date_1_kesh == '07') echo 'selected=selected'?>>مهر</option>
                      <option value="08"<?php if($date_1_kesh == '08') echo 'selected=selected'?>>آبان</option>
                      <option value="09"<?php if($date_1_kesh == '09') echo 'selected=selected'?>>آذر</option>
                      <option value="10"<?php if($date_1_kesh == '10') echo 'selected=selected'?>>دی</option>
                      <option value="11"<?php if($date_1_kesh == '11') echo 'selected=selected'?>>بهمن</option>
                      <option value="12"<?php if($date_1_kesh == '12') echo 'selected=selected'?>>اسفند</option>
                    </select>
                  </div></td>
                  <?php }?>
                  <td bgcolor="#FFFFFF"><div style="margin:10px" align="right">
                    <select  name="mah_cod<?php echo $num2_t_mah ;?>" disabled="disabled" class="target<?php echo $mah_name.$num2_t_mah ;?> required input_text mar<?php echo $mah_name.$num2_t_mah ;?>" id="cod_mah<?php echo $num2_t_mah ;?>" style="width:200px ; height:40px" tabindex="59" dir="rtl">
                      <option value="" selected="selected">انتخاب نام محصول</option>
                      <?php
$query = "SELECT DISTINCT mah_cod,mah_name FROM product_G WHERE  group_cod = $group_cod" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                      <option value="<?php echo $row['mah_cod'] ;?>"
   <?php if ($row['mah_cod']==$mah_cod) echo 'selected=selected'?>> <?php echo $row['mah_name'] ;?></option>
                      <?php
}
?>
                    </select>
                  </div></td>
                  <td bgcolor="#FFFFFF"><div style="margin:10px" align="right">
                    <select  name="group_cod<?php echo $num2_t_mah ;?>" disabled="disabled" class="mah_qroup<?php echo $num2_t_mah ;?> required input_text country<?php echo $num2_t_mah ;?>" id="mah_qroup<?php echo $num2_t_mah ;?>" style="width:160px ; height:40px" tabindex="58" dir="rtl"  >
                      <option value="" > انتخاب گروه</option>
                      <?php
$query = "SELECT DISTINCT group_cod,group_name FROM product_G where catagory_cod = $no_mtol  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                      <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']== $group_cod) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                      <?php }?>
                    </select>
                  </div></td>
                  <input type="hidden" name="Greenprod_id<?php echo $num2_t_mah ;?>" value="<?php echo $Greenprod_id; ?>" />
                  <td bgcolor="#FFFFFF"><?php echo $n ;?></td>
                </tr>
                <?php
 $num2_t_mah--;
 $n++ ;
 if ($num2_t_mah == 0 )
{
break ; 
}
}
}

?>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <div align="center">
        <p>
     <input type="hidden" name="p_number" value=<?php echo $number; ?> />
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
     <input type="hidden" name="no_mtol" value=<?php echo $no_mtol; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="hidden" name="y_prod" value=<?php echo $y_prod; ?> />
     <input type="hidden" name="unit_id" value=<?php echo $unit_id; ?> />
     <input type="hidden" name="no_kesht" value=<?php echo $no_kesht; ?> />     
     <input type="hidden" name="t_mah" value=<?php echo $t_mah; ?> />          
         <a href="#" onClick="document.form_name.submit(); return false;">
         <input type="button" name="btn1" value="بازگشت" style="width:150px ; height:45px" tabindex="77" />
         </a>
</form> 
           <form  name="form_name" class="form_name" method="post" action="liste_Greenhous_prod.php">
            <input type="hidden" name="id"  value="<?php echo $unit_id ;?>" />
            <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m  ;?>" />
            </form>

  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Greenhous_prod.php">
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
