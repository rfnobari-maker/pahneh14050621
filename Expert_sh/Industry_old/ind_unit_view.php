<?php
include('../../lock_expsh.php');
include('../../event.php');
require_once('../../Jalali.php');
include('../../login/config.php');
if  (isset($_POST['id']))
{
    $id = $_POST['id'] ; 
    $query = "SELECT * from ind_unit where  id = :id ";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id'=>$id));
    $found = $stmt -> rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $add_abadi = $row["add_abadi"];
    $add_city = $row["add_city"];
    $bah_cod_m = $row['bah_cod_m'];
    $no_mal = $ow['no_mal'];
    $num_bah = $row['num_bah'];
    $id_mar = $row['id_mar'];
    $unit_name = $row['unit_name'] ;
    $m_zamin = $row['m_zamin'] ;
    $m_zmos = $row['m_zmos'] ;
    $no_mal = $row['no_mal'] ;
    $lng = $row['lng'] ;
    $lat = $row['lat'] ;
    $m_cod_m = $row['m_cod_m'] ;
   $no_pta = $row['no_pta'] ;
   $date_pta = $row['date_pta'] ;
   $no_pb = $row['no_pb'] ;
   $date_pb = $row['date_pb'] ;
   $v_ab = $row['v_ab'] ;
   $g_en = $row['g_en'] ;
   $v_ch = $row['v_ch'] ;
   $no_mch = $row['no_mch'] ;
   $date_mch = $row['date_mch'] ;
   $v_bar = $row['v_bar'] ;
   $amp = $row['amp'] ;
   $t_faz = $row['t_faz'] ;
   $v_gaz = $row['v_gaz'] ;
   $v_tas = $row['v_tas'] ;
   $no_tas = $row['no_tas'] ;
   $v_tah = $row['v_tah'] ;
   $v_rd = $row['v_rd'] ;

if ($no_mal<>'5')
{
    $query = "SELECT no_bah,co_name,fname,name,jens,last_name,tel_m from ind_bah where  bah_cod_m = :bah_cod_m and num_bah = :num_bah";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
    $found = $stmt -> rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $no_bah = $row['no_bah'] ;
    $co_name = $row['co_name'] ;
    if ($no_bah=='2')
    {
        $m_fname = '-' ;
        $v_co_name= '/ شرکت '.$row['co_name'].' /';
    }
    else
    {
        $m_fname = $row['fname'] ;
    }
    $m_name = $row['name'] ;
    $m_jens = $row['jens'] ;
    $m_last_name = $row['last_name'] ;
    $m_tel_m = $row['tel_m'] ;
}
if ($no_mal<>'5') $m_cod_m = $bah_cod_m ;
if ($no_mal=='1')  $v_no_mal='امور اراضی';
if ($no_mal=='2')  $v_no_mal='منابع طبیعی';
if ($no_mal=='3')  $v_no_mal='شهرک صنعتی';
if ($no_mal=='4')  $v_no_mal='مالکیت شخصی';
if ($no_mal=='5')  $v_no_mal='اجاره ای';
if ($no_mal=='6')  $v_no_mal='سایر' ;
if ($m_poul=='abadi') {
    $query = "SELECT id_ostan,id_city,id_mar,add_abadi from list_abadi where add_abadi = :add_abadi";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':add_abadi'=>$add_abadi));
    $found = $stmt -> rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $add_abadi = $row["add_abadi"];
    $add_city = '-';
    $id_ostan = $row["id_ostan"];
    $id_city = $row["id_city"];
    $id_mar = $row["id_mar"];
}
if  ($m_poul=='shahr') {
    $query = "SELECT id_ostan,id_city,id_mar,add_city from list_city where add_city = :add_city";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':add_city'=>$add_city));
    $found = $stmt -> rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $add_city = $row["add_city"];
    $add_abadi = '-';
    $id_ostan = $row["id_ostan"];
    $id_city = $row["id_city"];
    $id_mar = $row["id_mar"];
}
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .style10 {color: #FF0000}
    .style11 {font-size: 14px}
    .size:hover
    {
        width: 20px;
        height:19px ;
    }
</style>
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
    <!--دریافت اطلاعات مالک -->
    <script type="text/javascript">
        $(document).ready(function()
        {
            $(".Mcod_m").change(function()
            {
                var id=$(this).val();
                var dataString = 'cod_m='+ id;
                $.ajax
                ({
                    type: "POST",
                    url: "select_mar.php",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        $(".mar").html(html);
                    }
                });

            });
        });
    </script>
    <!-- پایان دریافت اطلاعات مالک -->
<script>
function close_window() {
      close();
 }
</script>
</head>
<body>
<div id="rasul" style="width: 100%; height: 100%; background: #726d6d; display: none;  opacity: 0.6; position: fixed; z-index: 4;">
   <img src="img/loading2.gif" style="margin: auto;float: right;z-index: 93;width: 90px;min-height: 50px;position: fixed;left: 0;right: 0;margin: 200px auto;">
</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td>&nbsp;</td>
    </tr>
    </tr>
    <tr>
        <td>
 <p class="style8">مشاهده  اطلاعات واحد صنعتی </p>
 <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
 <?php sar_ind_data($bah_cod_m,$num_bah) ;?>
 </p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
<tr>
<td width="4"><p>&nbsp;</p>
                        <p>&nbsp;</p></td>
                    <td width="840" >
                        <form action="" method="post" id="form1" name="form1">
                          <table width="100%" height="1231" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
                                <tr>
                                    <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت واحد</strong></div></td>
                                </tr>
                                <tr>
                                    <td width="31%" height="22"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?></div></td>
                                    <td width="20%"><div align="right">:شهرستان</div></td>
                                    <td width="1%">&nbsp;</td>
                                    <td width="30%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
                                    <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
                                </tr>
                                <tr>
                                    <td height="63"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
                                    <td><div align="right">: آبادی / شهر</div></td>
                                    <td>&nbsp;</td>
                                    <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
                                    <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
                                </tr>
                                <tr>
                                    <td height="40" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
                                </tr>
                                <tr>
                                    <td height="43"><div align="right"> <?php echo $v_no_mal; ?></div></td>
                                    <td><div align="right">:نوع مالکیت</div></td>
                                    <td>&nbsp;</td>
                                    <td><div align="right">
                                      <input name="unit_name" type="text" class="input_text required" id="unit_name" style="width:250px; height:30px;  " tabindex="1" dir="rtl" lang="fa" value="<?php echo $unit_name ; ?>" maxlength="100" readonly="readonly" xml:lang="fa"/>
                                  </div></td>
                                    <td><div style="margin-right:30px" align="right" >:نام واحد</div></td>
                                </tr>
                                <tr>
                                    <td height="47"><div align="right">
                                            <span class="style2">درجه اعشار</span>
                                            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
                                            <br />
                                    </div></td>
                                    <td><div align="right">:Y عرض جغرافیایی</div></td>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><span class="style2">درجه اعشار</span>
                                            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
                                            <br />
                                    </div></td>
                                    <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
                                </tr>
                                <tr>
                                    <td height="46"><div align="right"><span class="style2">مترمربع </span>
                                            <input name="m_zmos" type="text" class="input_text number required" id="m_zmos" style="width:100px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $m_zmos ; ?>" maxlength="11" readonly="readonly"  align="baseline" xml:lang="fa" />
                                  </div></td>
                                    <td height="46"><div align="right">:مساحت مسقف</div></td>
                                    <td height="46">&nbsp;</td>
                                    <td height="46"><div align="right"><span class="style2">مترمربع </span>
                                        <input name="m_zamin" type="text" class="m_zamin input_text number required" id="m_zamin" style="width:100px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="11" readonly="readonly"  align="baseline" xml:lang="fa" />
                                  </div></td>
                                    <td><div style="margin-right:30px" align="right">:مساحت کل زمین</div></td>
                                </tr>
                                <tr>
                                    <td height="5" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td  height="42" colspan="5" bgcolor="#CCCCCC"><?php if($no_mal<>'5') echo '<p align="center" style="color:#0066CC" > اطلاعات  مالک - بهره بردار '.$v_co_name.' بعنوان مالک ثبت خواهد شد </p>' ;  else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>' ?></td>
                                      </tr>
                                      <tr>
                                        <td width="31%" height="58"><div align="right">
                           <select name="m_jens" disabled="disabled"  class="input_text mar required" id="m_jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="7">
                                            <option value="1" <?php if (isset($jens) && $row['jens']=='1') echo 'selected=selected'?>>مرد</option>
                                            <option value="2" <?php if (isset($jens) && $row['jens']=='2') echo 'selected=selected'?>>زن</option>
                                          </select>
                                        </div></td>
                                        <td width="20%"><div align="right">:جنسیت</div></td>
                                        <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
                                        <td width="30%"  bgcolor="#FFFFFF"><div align="right"  >
                                          <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>'5') echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="6"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
                                        </div></td>
                                        <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد ملی مالک </div></td>
                                      </tr>
                                      <tr>
                                        <td height="46" bgcolor="#FFFFFF"><div align="right"  >
                                          <input name="m_last_name" type="text"  class="input_text required" id="m_last_name" style="width:150px; height:30px;  <?php if($no_mal<>'5') echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="9" dir="rtl" lang="fa" value="<?php echo $m_last_name ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
                                        </div></td>
                                        <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی<br />
                                        </div></td>
                                        <td bgcolor="#FFFFFF">&nbsp;</td>
                                        <td bgcolor="#FFFFFF"><div align="right">
                                          <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>'5') echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="8" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="75" readonly="readonly" xml:lang="fa"/>
                                        </div></td>
                                        <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
                                      </tr>
                                      <tr>
                                        <td height="51"><div align="right">
                                          <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px;  <?php if($no_mal<>'5') echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="11" dir="rtl" lang="fa" value="<?php echo $m_tel_m ; ?>"  maxlength="11" readonly="readonly"  align="baseline" xml:lang="fa" />
                                        </div></td>
                                        <td><div align="right">:تلفن همراه</div></td>
                                        <td>&nbsp;</td>
                                        <td><div align="right">
                                          <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px;  <?php if($no_mal<>'5') echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="10" dir="rtl" lang="fa" value="<?php if ($no_bah==2) echo $co_name; else echo $m_fname ; ?>" maxlength="75" readonly="readonly" xml:lang="fa"/>
                                        </div></td>
                                        <td><div style="margin-right:30px" align="right">
                                          <?php if ($no_bah==2) echo ':نام شرکت'; else echo ':نام پدر' ; ?>
                                        </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات مجوز</strong></div></td>
                                </tr>
                                <tr>
                                  <td height="150" colspan="5" bgcolor="#FFFFFF"><table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td height="40" bgcolor="#FFFFCC">تاریخ مجوز</td>
                                      <td height="40" bgcolor="#FFFFCC">شماره مجوز</td>
                                      <td height="40" bgcolor="#FFFFCC">نوع مجوز</td>
                                    </tr>
                                    <tr>
                                      <td width="44%" height="47" bgcolor="#FFFFFF"><div align="center">
                                        <input name="date_pta" type="text" class="input_text number required" id="m_zamin15" style="width:100px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $date_pta ; ?>" maxlength="10" readonly="readonly" align="baseline" minlength="4" xml:lang="fa" />
                                      </div></td>
                                      <td width="31%"><div align="center">
                                        <input name="no_pta" type="text" class="input_text number required" id="no_pta" style="width:100px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $no_pta ; ?>" maxlength="15" readonly="readonly"  align="baseline" xml:lang="fa" />
                                      </div></td>
                                      <td width="25%">مجوز تاسیس </td>
                                    </tr>
                                    <tr>
                                      <td height="47"><div align="center">
  <input name="date_pb" type="text" class="input_text number required" id="y_pb" style="width:100px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $date_pb ; ?>" maxlength="10" readonly="readonly" align="baseline" minlength="4" xml:lang="fa" />
                                      </div></td>
                                      <td><div align="center">
 <input name="no_pb" type="text" class="input_text number required" id="no_pb" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $no_pb ; ?>" maxlength="15" readonly="readonly"  align="baseline" xml:lang="fa" />
                                      </div></td>
                                      <td>پروانه بهره برداری</td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="39" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>منابع پایه</strong></div></td>
                                </tr>
                                <tr>
                                  <td height="256" colspan="5"><table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td height="40" colspan="5" bgcolor="#FFFFCC">توضیحات</td>
                                      <td width="19%" bgcolor="#FFFFCC">آخرین وضعیت</td>
                                      <td width="16%" bgcolor="#FFFFCC">نوع منبع</td>
                                    </tr>
                                    <tr>
                                      <td height="47" colspan="3" bgcolor="#CCCCCC">&nbsp;</td>
                                      <td width="14%"><?php if($v_ab=='1') { ?> <div align="center">
   <input name="g_en" type="text" class="input_text number required" id="g_en" style="width:50px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $g_en ; ?>" maxlength="2" readonly="readonly"  align="baseline" xml:lang="fa" />
                                      </div><?php }?></td>
                                 <td width="14%" ><?php if($v_ab=='1') echo 'قطر انشعاب' ?></td>
                                 <td><div align="center">
                             <select name="v_ab" disabled="disabled" class="required input_text  " id="v_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="20">
                             <option value="">انتخاب کنید</option>
                             <option value="1"<?php if ($v_ab == '1') echo "selected='selected'"?>>دارد</option>
                             <option value="2"<?php if ($v_ab == '2') echo "selected='selected'"?>>ندارد</option>
                             </select>
                                      </div></td>
                                      <td> آب لوله کشی</td>
                                    </tr>
                                    <tr>
                                      <td width="25%" height="47"><?php if ($v_ch == '1') { ?> <div align="center">
 <input name="date_mch" type="text" class="input_text number required" id="y_mch" style="width:100px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $date_mch ; ?>" maxlength="10" readonly="readonly" align="baseline" minlength="4" xml:lang="fa" />
                                      </div><?php }?></td>
                                      <td colspan="2"> <?php if ($v_ch == '1') echo 'تاریخ مجوز' ?></td>
                         <td><?php if ($v_ch == '1') { ?> <div align="center">
  <input name="no_mch" type="text" class="input_text number required" id="no_mch" style="width:75px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $no_mch ; ?>" maxlength="15" readonly="readonly"  align="baseline" xml:lang="fa" />
                                      </div><?php }?></td>
                                      <td><?php if ($v_ch == '1') echo 'شماره مجوز' ?></td>
                                      <td><div align="center">
                                        <select name="v_ch" disabled="disabled" class="required input_text  " id="v_ch"  style="height:40px ; width:120px ; direction:rtl" tabindex="22">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_ch == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_ch == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td>چاه آب</td>
                                    </tr>
                                    <tr>
                                      <td height="50"><?php if ($v_bar == '1') { ?><div align="center">
                                        <input name="amp" type="text" class="input_text number required" id="amp" style="width:50px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $amp ; ?>" maxlength="3" readonly="readonly"  align="baseline" xml:lang="fa" />
                                      </div><?php }?></td>
                                      <td colspan="2"><?php if ($v_bar == '1') echo 'آمپر' ?></td>
                                      <td><?php if ($v_bar == '1') { ?> <div align="center">
                                        <input name="t_faz" type="text" class="input_text number required" id="t_faz" style="width:50px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $t_faz ; ?>" maxlength="3" readonly="readonly"  align="baseline" xml:lang="fa" />
                                      </div><?php }?></td>
                                      <td><?php if ($v_bar == '1') echo 'تعداد فاز' ?></td>
                                      <td><div align="center">
                                        <select name="v_bar" disabled="disabled" class="required input_text  " id="v_bar"  style="height:40px ; width:120px ; direction:rtl" tabindex="27">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_bar == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_bar == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td>برق</td>
                                    </tr>
                                    <tr>
                                      <td height="50" colspan="5" bgcolor="#CCCCCC">&nbsp;</td>
                                      <td><div align="center">
                                        <select name="v_gaz" disabled="disabled" class="required input_text  " id="v_gaz"  style="height:40px ; width:120px ; direction:rtl" tabindex="30">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_gaz == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_gaz == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td>گاز</td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="39" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>سایر</strong></div></td>
                                </tr>
                                <tr>
                                  <td height="200" colspan="5"><table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td height="40" colspan="2" bgcolor="#FFFFCC">توضیحات</td>
                                      <td width="21%" bgcolor="#FFFFCC">آخرین وضعیت</td>
                                      <td width="29%" bgcolor="#FFFFCC">شرح</td>
                                    </tr>
                                    <tr>
                                      <td width="26%" height="50"><?php if ($v_tas == '1') { ?> <div align="center" >
                                        <select name="no_tas" disabled="disabled" class="required input_text  " id="m_vaz_sok9"  style="height:40px ; width:120px ; direction:rtl" tabindex="32">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($no_tas == '1') echo "selected='selected'"?>>سپتیک</option>
                                          <option value="2"<?php if ($no_tas == '2') echo "selected='selected'"?>>صنعتی</option>
                                        </select>
                                      </div><?PHP }?></td>
                                      <td width="24%"><?php if ($v_tas == '1') echo 'نوع تصفیه' ?></div></td>
                                      <td><div align="center">
                                        <select name="v_tas" disabled="disabled" class="required input_text  " id="v_tas"  style="height:40px ; width:120px ; direction:rtl" tabindex="31">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_tas == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_tas == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td> تصفیه خانه</td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" rowspan="2" bgcolor="#CCCCCC">&nbsp;</td>
                                      <td height="50"><div align="center">
                                        <select name="v_tah" disabled="disabled" class="required input_text  " id="m_vaz_sok6"  style="height:40px ; width:120px ; direction:rtl" tabindex="33">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_tah == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_tah == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td>تهویه هوا</td>
                                    </tr>
                                    <tr>
                                      <td><div align="center">
                                        <select name="v_rd" disabled="disabled" class="required input_text  " id="m_vaz_sok7"  style="height:40px ; width:120px ; direction:rtl" tabindex="34">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_rd == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_rd == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td>واحد تحقیق و توسعه<br />
                                        R&amp;D</td>
                                    </tr>
                                  </table></td>
                                </tr>
                            </table>
                            <div align="center">
                              <p>
       <button  id="send" class="style8" style="width:150px ; height:45px "  onclick="close_window()">بستن پنجره</button>
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
                    <form  name="myform" class="myform" method="post" action="index.php">
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