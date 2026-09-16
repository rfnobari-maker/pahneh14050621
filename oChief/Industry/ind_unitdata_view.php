<?php
include('../../lock_oce.php');
include('../../event.php');
include('../../login/config.php');
if  (isset($_POST['ShenaseKasboKar']))
{
   $ShenaseKasboKar = $_POST['ShenaseKasboKar'] ; 
$query = "SELECT * from ind_unit WHERE  ShenaseKasboKar = '$ShenaseKasboKar'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
   $id_ostan1 = $row['id_ostan'] ; 
   $id_city1 = $row['id_city'] ; 
   $id_mar = $row['id_mar'] ; 
   $add_abadi = $row['add_abadi'] ; 
   $add_city = $row['add_city'] ; 
   $NationalCode = $row['NationalCode'] ; 
   $no_bah = $row['no_bah'] ; 
   $add_abadi = $row["add_abadi"];
   $add_city = $row["add_city"];
   $no_mal = $row['no_mal'];
   $num_bah = $row['num_bah'];
   $id_mar = $row['id_mar'];
   $unit_name = $row['unit_name'] ;
   $m_zamin = $row['m_zamin'] ;
   $m_zmos = $row['m_zmos'] ;
   $X1      = $row['X1'] ;
   $Y1      = $row['Y1'] ;
   $Z1      = $row['Z1'] ;
   $Zone1   = $row['Zone1'] ;
   $X2      = $row['X2'] ;
   $Y2      = $row['Y2'] ;
   $Z2      = $row['Z2'] ;
   $Zone2   = $row['Zone2'] ;
   $X3      = $row['X3'] ;
   $Y3      = $row['Y3'] ;
   $Z3      = $row['Z3'] ;
   $Zone3   = $row['Zone3'] ;
   $X4      = $row['X4'] ;
   $Y4      = $row['Y4'] ;
   $Z4      = $row['Z4'] ;
   $Zone4   = $row['Zone4'] ;
   $start_date = $row['start_date'] ;
   $end_date   = $row['end_date'] ;
   $sarmayeh_s = $row['sarmayeh_s'] ;
   $sarmayeh_d = $row['sarmayeh_d'] ;
   $t_shagel   = $row['t_shagel'] ;
   $identCode   = $row['identCode'] ;
   $t_mah   = $row['t_mah'] ;
   $v_ab = $row['v_ab'] ;
   $g_en1 = $row['g_en'] ;
   $v_ch = $row['v_ch'] ;
   $no_mch1 = $row['no_mch'] ;
   $date_mch = $row['date_mch'] ;
   $y_mch1 = substr($date_mch,0,4);
   $m_mch1 = substr($date_mch,5,2) ;
   $d_mch1 = substr($date_mch,8,2) ;
   $v_bar = $row['v_bar'] ;
   $amp1 = $row['amp'] ;
   $t_faz1 = $row['t_faz'] ;
   $v_gaz = $row['v_gaz'] ;
   $v_tas = $row['v_tas'] ;
   $no_tas1 = $row['no_tas'] ;
   $v_tah = $row['v_tah'] ;
   $v_rd = $row['v_rd'] ;
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
$(document).ready(function() {
      $(".vtas_comment").hide();
      $(".vbar_comment").hide();
      $(".vch_comment").hide();
      $(".vab_comment").hide();
	  <?php if($v_ab == '1') {?>$(".vab_comment").show();<?php }?>
	  <?php if($v_ch == '1') {?>$(".vch_comment").show();<?php }?>
	  <?php if($v_bar == '1') {?>$(".vbar_comment").show();<?php }?>
	  <?php if($v_tas == '1') {?>$(".vtas_comment").show();<?php }?>

  $("#v_ab").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vab_comment").show();
    } else if (value == "2") {
      $(".vab_comment").hide();
	  <?php $g_en = '0'?>
    } 
  });

  $("#v_ch").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vch_comment").show();
    } else if (value == "2") {
      $(".vch_comment").hide();
	  <?php $y_mch = '0000' ; $m_mch = '00' ; $d_mch = '00' ; $no_mch = '0' ;?>
    } 
  });

  $("#v_bar").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vbar_comment").show();
    } else if (value == "2") {
      $(".vbar_comment").hide();
	  <?php $t_faz = 0 ; $amp = 0 ;?>

    } 
  });

  $("#v_tas").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vtas_comment").show();
    } else if (value == "2") {
      $(".vtas_comment").hide();
	  <?php $no_tas = '1' ; ?>
    } 
  });
});
function close_window() {
      close();
 }
    </script>
    <!-- پایان دریافت اطلاعات مالک -->
</head>
<body>
<div id="rasul" style="width: 100%; height: 100%; background: #726d6d; display: none;  opacity: 0.6; position: fixed; z-index: 4;">
   <img src="img/loading2.gif" style="margin: auto;float: right;z-index: 93;width: 90px;min-height: 50px;position: fixed;left: 0;right: 0;margin: 200px auto;">
</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td>

 <p class="style8">نمایش اطلاعات واحد صنعتی جدید<br />
   <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <p class="style8">
   <?php sar_ind_data($NationalCode,$no_bah) ;?>
 </p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
<td width="4"><p>&nbsp;</p>
                        <p>&nbsp;</p></td>
                    <td width="840" >
                        <form action="" method="post" id="form1" name="form1">
                          <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" id=" " style="border:3px solid #069;">
                                <tr>
                                    <td height="32" colspan="7" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
                                </tr>
                                <tr>
                                    <td width="30" height="31" colspan="2"><div align="right"> <?php echo city_name1($id_city1,$id_ostan1) ?></div></td>
                                    <td width="21%"><div align="right">:شهرستان</div></td>
                                    <td width="1%">&nbsp;</td>
                                    <td width="27" colspan="2"><div align="right"><?php echo ostan_name($id_ostan1) ; ?></div></td>
                                    <td width="21%"><div style="margin-right:30px" align="right">: استان</div></td>
                                </tr>
                                <tr>
                                    <td height="30" colspan="2"><div align="right"> <?php echo shahr_name($add_city); ?><?php echo abadi_name($add_abadi) ; ?></div></td>
                                    <td><div align="right">: آبادی/شهر</div></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
                                    <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
                                </tr>
                                <tr>
                                    <td height="23" colspan="2"><div align="right"> <?php echo $no_mal; ?></div></td>
                                    <td><div align="right">:نوع مالکیت</div></td>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><div align="right"><?php echo $unit_name ; ?></div></td>
                                    <td><div style="margin-right:30px" align="right" >:نام واحد</div></td>
                                </tr>
                                <tr>
                                  <td height="30"><div align="right" class="style2"> متر مربع </div></td>
                                  <td><div align="right"><?php echo $m_zmos ;  ?></div></td>
                                  <td height="30"><div align="right">:مساحت مسقف</div></td>
                                  <td height="30">&nbsp;</td>
                                  <td height="30"><div align="right" class="style2">  متر مربع </div></td>
                                  <td><div align="right"> <?php echo $m_zamin; ?></div></td>
                                  <td><div style="margin-right:30px" align="right">:مساحت  زمین</div></td>
                                </tr>
                                <tr>
                                  <td height="30" colspan="7" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مختصات جغرافیایی</strong></div></td>
                            </tr>
                                <tr>
                                  <td height="102" colspan="7"><table width="95%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr class="style8">
                                      <td width="28%">Zone</td>
                                      <td width="22%">Z</td>
                                      <td width="29%">Y</td>
                                      <td width="21%"> X</td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $Zone1; ?></td>
                                      <td><?php echo $Z1; ?></td>
                                      <td><?php echo $Y1; ?></td>
                                      <td><?php echo $X1; ?></td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $Zone2; ?></td>
                                      <td><?php echo $Z2; ?></td>
                                      <td><?php echo $Y2; ?></td>
                                      <td><?php echo $X2; ?></td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $Zone3; ?></td>
                                      <td><?php echo $Z3; ?></td>
                                      <td><?php echo $Y3; ?></td>
                                      <td><?php echo $X3; ?></td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $Zone2; ?></td>
                                      <td><?php echo $Z4; ?></td>
                                      <td><?php echo $Y4; ?></td>
                                      <td><?php echo $X4; ?></td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="30" colspan="7" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات تکمیلی </strong></div></td>
                                </tr>
                                <tr>
                                  <td height="46"><div align="right"><span class="style2"> میلیون ریال</span></div></td>
                                  <td height="46"><div align="right"><?php echo $sarmayeh_d; ?></div></td>
                                  <td height="46"><div align="right">:سرمایه در گردش</div></td>
                                  <td height="46">&nbsp;</td>
                                  <td height="46"><div align="right"><span class="style2"> میلیون ریال</span></div></td>
                                  <td height="46"><div align="right"><?php echo $sarmayeh_s; ?></div></td>
                                  <td><div style="margin-right:30px" align="right">:سرمایه ثابت</div></td>
                                </tr>
                                <tr>
                                  <td height="43" colspan="2"><div dir="rtl" align="right"> از <?php echo $start_date;  ?> لغایت <?php echo $end_date ;  ?></div></td>
                                  <td><div align="right">:تاریخ  اعتبار</div></td>
                                  <td>&nbsp;</td>
                                  <td colspan="2"><div align="right"><?php echo $identCode ; ?></div></td>
                                  <td><div style="margin-right:30px" align="right" >:شماره پروانه بهره برداری</div></td>
                                </tr>
                                <tr>
                                  <td height="43" colspan="2"><div dir="rtl" align="right"><?php echo $t_mah;  ?></div></td>
                                  <td><div align="right">:تنوع محصول تولیدی</div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="right" class="style2">نفر </div></td>
                                  <td><div align="right"><?php echo $t_shagel; ?></div></td>
                                  <td><div style="margin-right:30px" align="right" >:تعداد اشتغال</div></td>
                                </tr>
                                <tr>
                                  <td height="29" colspan="7" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>منابع و تجهیزات</strong></div></td>
                                </tr>
                                <tr>
                                  <td height="170" colspan="7">
                                    <table width="793" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td height="42" colspan="3">&nbsp;</td>
                                      <td width="14%" ><div align="center" class="vab_comment" >
                                        <input name="g_en" type="text" class="input_text number required" id="g_en" style="width:75px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $g_en1 ; ?>" maxlength="5" readonly="readonly"  align="baseline" xml:lang="fa" />
                                      </div></td>
                                      <td width="12%" ><div align="right" class="vab_comment"> :قطر انشعاب</div></td>
                                      <td width="21%"><div align="center">
                             <select name="v_ab" disabled="disabled" class="required input_text " id="v_ab" style="height:40px ; width:120px ; direction:rtl" tabindex="20">
                             <option value="">انتخاب کنید</option>
                             <option    value="1"<?php if ($v_ab == '1') echo "selected='selected'"?>>دارد</option>
                             <option    value="2"<?php if ($v_ab == '2') echo "selected='selected'"?>>ندارد</option>
                             </select>
                                      </div></td>
                                      <td width="16%"><div align="right" > :آب لوله کشی</div></td>
                                    </tr>
                                    <tr>
                                      <td width="25%" height="40"><div align="right" class="vch_comment">
 <input name="y_mch" type="text" class="input_text number required" id="y_mch" style="width:50px; height:30px ; " max="1400"min="0" tabindex="26" dir="rtl" lang="fa" value="<?php echo $y_mch1 ; ?>" maxlength="4" readonly="readonly" align="baseline" minlength="4" xml:lang="fa" />
                                        /
  <input name="m_mch" type="text" class="input_text number required" id="m_mch" style="width:30px; height:30px ; " max="12" min="0" tabindex="25" dir="rtl" lang="fa" value="<?php echo $m_mch1; ?>" maxlength="2" readonly="readonly"  align="baseline" minlength="2" xml:lang="fa" />
                                        /
  <input name="d_mch" type="text" class="input_text number required" id="d_mch" style="width:30px; height:30px ; " max="31" min="0" tabindex="24" dir="rtl" lang="fa" value="<?php echo $d_mch1 ; ?>" maxlength="2" readonly="readonly"  align="baseline" minlength="2" xml:lang="fa" />
                                      </div></td>
                                      <td colspan="2"> <div align="right" class="vch_comment"> :تاریخ مجوز</div></td>
                         <td><div align="center" class="vch_comment">
  <input name="no_mch" type="text" class="input_text number required" id="no_mch" style="width:75px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $no_mch1 ; ?>" maxlength="15" readonly="readonly"  align="baseline" xml:lang="fa" />
                                      </div></td>
                                      <td><div align="right" class="vch_comment"> :شماره مجوز </div></td>
                                      <td><div align="center">
                                        <select name="v_ch" disabled="disabled" class="required input_text  " id="v_ch"  style="height:40px ; width:120px ; direction:rtl" tabindex="22">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_ch == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_ch == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td><div align="right" > :آب چاه</div></td>
                                    </tr>
                                    <tr>
                                      <td height="44"><div align="right" class="vbar_comment">
                                        <input name="amp" type="text" class="input_text number required" id="amp" style="width:50px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $amp1 ; ?>" maxlength="3" readonly="readonly"  align="baseline" xml:lang="fa" />
                                      </div></td>
                                      <td colspan="2"><div align="right" class="vbar_comment"> :آمپر</div></td>
                                      <td><div align="center" class="vbar_comment">
                                        <input name="t_faz" type="text" class="input_text number required" id="t_faz" style="width:75px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $t_faz1 ; ?>" maxlength="3" readonly="readonly"  align="baseline" xml:lang="fa" />
                                      </div></td>
                                      <td> <div align="right" class="vbar_comment"> :تعداد فاز</div></td>
                                      <td><div align="center">
                                        <select name="v_bar" disabled="disabled" class="required input_text  " id="v_bar"  style="height:40px ; width:120px ; direction:rtl" tabindex="27">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_bar == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_bar == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td><div align="right" > :انشعاب برق</div></td>
                                    </tr>
                                    <tr>
                                      <td height="42" colspan="5">&nbsp;</td>
                                      <td><div align="center">
                                        <select name="v_gaz" disabled="disabled" class="required input_text  " id="v_gaz"  style="height:40px ; width:120px ; direction:rtl" tabindex="30">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_gaz == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_gaz == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td><div align="right" > :انشعاب گاز</div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="99" colspan="7"><table width="795" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td width="39%" height="42"><div align="right" class="vtas_comment">
                                        <select name="no_tas" disabled="disabled" class="required input_text  " id="no_tas"  style="height:40px ; width:120px ; direction:rtl" tabindex="32">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($no_tas == '1') echo "selected='selected'"?>>سپتیک</option>
                                          <option value="2"<?php if ($no_tas == '2') echo "selected='selected'"?>>صنعتی</option>
                                        </select>
                                      </div></td>
                                      <td width="24%"><div align="right" class="vtas_comment"> :نوع تصفیه</div></td>
                                      <td width="21%"><div align="center">
                                        <select name="v_tas" disabled="disabled" class="required input_text" id="v_tas"  style="height:40px ; width:120px ; direction:rtl" tabindex="31">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_tas == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_tas == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td width="16%"><div align="right" > :تصفیه خانه</div></td>
                                    </tr>
                                    <tr>
                                      <td><div align="right">
                                        <select name="v_rd" disabled="disabled" class="required input_text  " id="m_vaz_sok7"  style="height:40px ; width:120px ; direction:rtl" tabindex="34">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_rd == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_rd == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td><div align="right" > :R&amp;Dواحد تحقیق و توسعه <br />
                                      </div></td>
                                      <td height="57"><div align="center">
                                        <select name="v_tah" disabled="disabled" class="required input_text  " id="m_vaz_sok6"  style="height:40px ; width:120px ; direction:rtl" tabindex="33">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1"<?php if ($v_tah == '1') echo "selected='selected'"?>>دارد</option>
                                          <option value="2"<?php if ($v_tah == '2') echo "selected='selected'"?>>ندارد</option>
                                        </select>
                                      </div></td>
                                      <td><div align="right" > :تهویه هوا</div></td>
                                    </tr>
                                  </table></td>
                            </tr>
                          </table>
                            <div align="center">
                              <p><a href="index.php">
             <input type="button" name="btn1" value="بستن"  onclick="close_window()" style="width:150px ; height:45px" tabindex="36" /></a>
                              </p>
                          </div>
                      </form>
                      <script>

                            $('#submit').click(function () {

                                $('#rasul').css('display', 'block');
                                setTimeout(function () {
                                    $('#rasul').css('display', 'none');
                                },3000)

                              
                            },3000)


                            function disableFunction() {
                                document.getElementById("submit").disabled = 'true';
                                $("#submit").attr("disabled","");
                            }
                        </script>
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