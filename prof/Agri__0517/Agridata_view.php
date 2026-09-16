<?php
include("../../lock_p1.php"); 
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

if (isset($_POST['id'])) {
    $id = $_POST['id']; 
    $z_sal = $_POST['z_sal']; 
    $id_page = isset($_POST['id_page']) ? (int)$_POST['id_page'] : 1;
    if ($id_page < 1) { $id_page = 1; }
    
    $Agri_table = 'Agri' . str_replace('-', '_', $z_sal); 
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal); 
    
    date_default_timezone_set('Asia/Tehran');
    $date_s = date_con(jdate("Y/m/d"));
    include('../../login/config.php');
    
    // دریافت اطلاعات زراعی
    $query = "SELECT * FROM `$Agri_table` WHERE id = :id"; 
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id' => $id));
    
    if ($stmt->rowCount() == 0) {
        // ریدایرکت در صورت نبودن رکورد
        echo '<form name="myform" method="post" action="Agri1.php"></form>';
        echo '<script type="text/javascript">document.myform.submit();</script>';
        exit;
    }
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $bah_cod_m = $row['bah_cod_m'];
    $num_bah = $row['num_bah']; 
    $m_poul = isset($row['m_poul']) ? $row['m_poul'] : '';
    $sh_gat = $row['sh_gat'];
    $z_sal = $row['z_sal'];
    $t_mah = $row['t_mah'];
    $no_mal = $row['no_mal'];
    $no_kesh = $row['no_kesh'];
    $id_ostan1 = $row["id_ostan"];
    $id_city1 = $row["id_city"];
    $id_mar1 = $row["id_mar"];
    $add_abadi = $row["add_abadi"]; 
    $add_city = $row["add_city"]; 
    $lng = $row['lng'];
    $lat = $row['lat'];
    $m_zamin = $row['m_zamin'];
    $m_cod_m = $row['m_cod_m'];
    $m_ab = $row['m_ab'];
    $md_ab = $row['md_ab'];
    $h_ab = $row['h_ab'];
    $no_sab = $row['no_sab'];
    $no_ab = $row['no_ab'];
    $es = $row['es'];
    $s_ayesh = $row['s_ayesh'];
    $m_vaz_sok = $row['m_vaz_sok'];
    
    // ========== اصلاح متغیر v_no_kesh ==========
    $v_no_kesh = '';
    if ($no_kesh == '1') {
        $v_no_kesh = 'آبی';
    } elseif ($no_kesh == '2') {
        $v_no_kesh = 'دیم';
    } else {
        $v_no_kesh = 'نامشخص'; // مقدار پیش‌فرض برای جلوگیری از خطا
    }
    // ==========================================
    
    // دریافت اطلاعات مالک
    include('../../login/config.php');
    $query = "SELECT * FROM malek WHERE m_cod_m = :m_cod_m"; 
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':m_cod_m' => $m_cod_m));
    
    $m_name = '';
    $m_jens = '';
    $m_last_name = '';
    $m_fname = '';
    $m_tel_m = '';
    
    if ($stmt->rowCount() > 0) {
        $row_malek = $stmt->fetch(PDO::FETCH_ASSOC);
        $m_name = $row_malek['m_name'];
        $m_jens = $row_malek['m_jens'];
        $m_last_name = $row_malek['m_last_name'];
        $m_fname = $row_malek['m_fname'];
        $m_tel_m = $row_malek['m_tel_m'];
    }
    
    // نوع مالکیت
    $v_no_mal = '';
    switch ($no_mal) {
        case '1': $v_no_mal = 'سند ششدانگ'; break;
        case '2': $v_no_mal = 'سند مشاعی'; break;
        case '3': $v_no_mal = 'اصلاحات اراضی'; break;
        case '4': $v_no_mal = 'موقوفه'; break;
        case '5': $v_no_mal = 'واگذاری'; break;
        case '6': $v_no_mal = 'قولنامه'; break;
        case '7': $v_no_mal = 'اجاره'; break;
        case '8': $v_no_mal = 'سایر'; break;
        default: $v_no_mal = 'نامشخص';
    }
    
    if ($no_mal != '7') {
        $m_cod_m = $bah_cod_m;
    }
    
    $num_t_mah = $t_mah;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  lang="fa-IR" xml:lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title; ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .style10 {color: #FF0000}
        .style11 {font-size: 14px}
        .style8 {font-weight: bold;}
        .style2 {font-size: 11px; color: #666;}
    </style>
        <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script type="text/javascript">
    $(document).ready(function() {
        <?php
        $temp_mah = $t_mah;
        while ($temp_mah > 0) {
        ?>
        $(".country<?php echo $temp_mah; ?>").change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "ajax_city.php",
                data: 'group_cod=' + id,
                cache: false,
                success: function(html) {
                    $(".mar<?php echo $temp_mah; ?>").html(html);
                }
            });
        });
        <?php
            $temp_mah--;
        }
        ?>
        
        $(".Mcod_m").change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "select_mar.php",
                data: 'cod_m=' + id,
                cache: false,
                success: function(html) {
                    $(".mar").html(html);
                }
            });
        });
    });
    </script>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
        </tr>
        <tr>
            <td><?php include('menu.php'); ?></td>
        </tr>
        <tr>
            <td>
                <?php include('top.php'); ?>
                <p class="style8">نمایش اطلاعات زراعی</p>
                <p>
                    <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/><br />
                    <?php sar_data2($bah_cod_m, $num_bah); ?>
                </p>
                
                <form action="liste_Agri.php?id=<?php echo $id_page . '#1'; ?>" method="post" id="form1" name="form1">
                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" style="border:3px solid #069;">
                    <!-- موقعیت بهره برداری -->
                    <tr>
                        <td height="40" colspan="5" bgcolor="#CCCCCC" align="right">
                            <strong>موقعیت بهره برداری</strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="31%" height="40"><div align="right"><?php echo city_name1($id_city1, $id_ostan1); ?></div></td>
                        <td width="20%"><div align="right">:شهرستان</div></td>
                        <td width="1%">&nbsp;</td>
                        <td width="30%"><div align="right"><?php echo ostan_name($id_ostan1); ?></div></td>
                        <td width="18%"><div align="right">: استان</div></td>
                    </tr>
                    <tr>
                        <td height="38"><div align="right"><?php echo abadi_name($add_abadi); ?></div></td>
                        <td><div align="right">: آبادی / شهر</div></td>
                        <td>&nbsp;</td>
                        <td><div align="right"><?php echo mar_name($id_mar1); ?></div></td>
                        <td><div align="right">: مرکز جهاد کشاورزی</div></td>
                    </tr>
                    
                    <!-- اطلاعات زمین -->
                    <tr>
                        <td height="38" colspan="5" bgcolor="#CCCCCC"><div align="right"><strong>اطلاعات زمین</strong></div></td>
                    </tr>
                    <tr>
                        <td height="38"><div align="right"><?php echo $v_no_mal; ?></div></td>
                        <td><div align="right">:نوع مالکیت</div></td>
                        <td>&nbsp;</td>
                        <td><div align="right"><?php echo $v_no_kesh; ?></div></td>
                        <td><div align="right">:نوع کشت</div></td>
                    </tr>
                    <tr>
                        <td height="63">
                            <div align="right">
                                <input name="lat" type="text" class="input_text" id="lat" style="width:150px; height:30px;" dir="rtl" value="<?php echo $lat; ?>" maxlength="11" readonly="readonly" />
                                <br /><span class="style8">37.010521: مثال</span>
                            </div>
                        </td>
                        <td><div align="right">:Y عرض جغرافیایی</div></td>
                        <td>&nbsp;</td>
                        <td>
                            <div align="right">
                                <input name="lng" type="text" class="input_text" id="lng" style="width:150px; height:30px;" dir="rtl" value="<?php echo $lng; ?>" maxlength="11" readonly="readonly" />
                                <br /><span class="style8">46.212486: مثال</span>
                            </div>
                        </td>
                        <td><div align="right">:X طول جغرافیایی</div></td>
                    </tr>
                    <tr>
                        <td height="49" colspan="2">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <div align="right">
                                <span class="style2">هکتار</span>
                                <input name="m_zamin" type="text" class="input_text" id="m_zamin" style="width:100px; height:30px;" dir="rtl" value="<?php echo $m_zamin; ?>" maxlength="70" readonly="readonly" />
                            </div>
                        </td>
                        <td><div align="right">:مساحت زمین</div></td>
                    </tr>
                    
                    <!-- اطلاعات مالک -->
                    <tr>
                        <td height="42" colspan="5" bgcolor="#CCCCCC">
                            <?php if($no_mal != 7) echo '<div align="center" style="color:#0066CC">اطلاعات بهره بردار بعنوان مالک ثبت شده است</div>'; 
                                  else echo '<div align="right"><strong>اطلاعات مالک</strong></div>'; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="31%" height="58">
                            <div align="right">
                                <select name="m_jens" disabled="disabled" class="input_text" id="m_jens" style="height:40px; width:120px;">
                                    <option value="1" <?php if ($m_jens == '1') echo 'selected="selected"'; ?>>مرد</option>
                                    <option value="2" <?php if ($m_jens == '2') echo 'selected="selected"'; ?>>زن</option>
                                </select>
                            </div>
                        </td>
                        <td width="20%"><div align="right">جنسیت</div></td>
                        <td width="1%">&nbsp;</td>
                        <td width="30%">
                            <div align="right">
                                <input name="m_cod_m" type="text" class="input_text Mcod_m" id="m_cod_m" style="width:150px; height:30px; <?php if($no_mal != 7) echo 'background-color:#FFFFCC;'; ?>" dir="rtl" value="<?php echo $m_cod_m; ?>" maxlength="11" readonly="readonly" />
                            </div>
                        </td>
                        <td width="18%"><div align="right">: کد ملی مالک</div></td>
                    </tr>
                    <tr>
                        <td height="46">
                            <div align="right">
                                <input name="m_last_name" type="text" class="input_text" id="m_last_name" style="width:150px; height:30px; <?php if($no_mal != 7) echo 'background-color:#FFFFCC;'; ?>" dir="rtl" value="<?php echo $m_last_name; ?>" maxlength="70" readonly="readonly" />
                            </div>
                        </td>
                        <td><div align="right">:نام خانوادگی</div></td>
                        <td>&nbsp;</td>
                        <td>
                            <div align="right">
                                <input name="m_name" type="text" class="input_text" id="m_name" style="width:150px; height:30px; <?php if($no_mal != 7) echo 'background-color:#FFFFCC;'; ?>" dir="rtl" value="<?php echo $m_name; ?>" maxlength="11" readonly="readonly" />
                            </div>
                        </td>
                        <td><div align="right">: نام</div></td>
                    </tr>
                    <tr>
                        <td height="51">
                            <div align="right">
                                <input name="m_tel_m" type="text" class="digits input_text" id="m_tel_m" style="width:100px; height:30px; <?php if($no_mal != 7) echo 'background-color:#FFFFCC;'; ?>" dir="rtl" value="<?php echo $m_tel_m; ?>" maxlength="11" readonly="readonly" />
                            </div>
                        </td>
                        <td><div align="right">:تلفن همراه</div></td>
                        <td>&nbsp;</td>
                        <td>
                            <div align="right">
                                <input name="m_fname" type="text" class="input_text" id="m_fname" style="width:150px; height:30px; <?php if($no_mal != 7) echo 'background-color:#FFFFCC;'; ?>" dir="rtl" value="<?php echo $m_fname; ?>" maxlength="11" readonly="readonly" />
                            </div>
                        </td>
                        <td><div align="right">:نام پدر</div></td>
                    </tr>
                    <tr>
                        <td height="60" colspan="2">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <div align="right">
                                <select name="m_vaz_sok" disabled="disabled" class="input_text" id="m_vaz_sok" style="height:40px; width:120px;">
                                    <option value="">انتخاب کنید</option>
                                    <option value="1" <?php if ($m_vaz_sok == '1') echo 'selected="selected"'; ?>>ساکن</option>
                                    <option value="2" <?php if ($m_vaz_sok == '2') echo 'selected="selected"'; ?>>غیرساکن</option>
                                </select>
                            </div>
                        </td>
                        <td><div align="right">:وضعیت سکونت مالک</div></td>
                    </tr>
                    
                    <!-- اطلاعات آب (فقط در صورت آبی بودن) -->
                    <?php if ($no_kesh == '1') { ?>
                    <tr>
                        <td height="41" colspan="5" bgcolor="#CCCCCC"><div align="right"><strong>اطلاعات آب</strong></div></td>
                    </tr>
                    <tr>
                        <td width="31%" height="53">
                            <div align="right">
                                <span class="style2">شبانه روز</span>
                                <input name="md_ab" type="text" class="number input_text" id="md_ab" style="width:50px; height:30px;" dir="rtl" value="<?php echo $md_ab; ?>" maxlength="2" readonly="readonly" />
                            </div>
                        </td>
                        <td width="20%"><div align="right">:مدار آبیاری</div></td>
                        <td width="1%">&nbsp;</td>
                        <td width="30%">
                            <div align="right">
                                <select name="m_ab" disabled="disabled" class="input_text" id="m_ab" style="height:40px; width:120px;">
                                    <option value="">انتخاب کنید</option>
                                    <option value="1" <?php if ($m_ab == '1') echo 'selected="selected"'; ?>>چشمه</option>
                                    <option value="2" <?php if ($m_ab == '2') echo 'selected="selected"'; ?>>قنات</option>
                                    <option value="3" <?php if ($m_ab == '3') echo 'selected="selected"'; ?>>رودخانه</option>
                                    <option value="4" <?php if ($m_ab == '4') echo 'selected="selected"'; ?>>سد</option>
                                    <option value="5" <?php if ($m_ab == '5') echo 'selected="selected"'; ?>>چاه سطحی</option>
                                    <option value="6" <?php if ($m_ab == '6') echo 'selected="selected"'; ?>>چاه عمیق</option>
                                    <option value="7" <?php if ($m_ab == '7') echo 'selected="selected"'; ?>>چاه نیمه عمیق</option>
                                    <option value="8" <?php if ($m_ab == '8') echo 'selected="selected"'; ?>>زهکش</option>
                                    <option value="9" <?php if ($m_ab == '9') echo 'selected="selected"'; ?>>پساب</option>
                                    <option value="10" <?php if ($m_ab == '10') echo 'selected="selected"'; ?>>آب بندان</option>
                                    <option value="11" <?php if ($m_ab == '11') echo 'selected="selected"'; ?>>سایر</option>
                                </select>
                            </div>
                        </td>
                        <td width="18%"><div align="right">: منبع آب</div></td>
                    </tr>
                    <tr>
                        <td height="47">
                            <div align="right">
                                <select name="no_sab" disabled="disabled" class="input_text" id="no_sab" style="height:40px; width:170px;">
                                    <option value="">انتخاب کنید</option>
                                    <option value="1" <?php if ($no_sab == '1') echo 'selected="selected"'; ?>>پروانه بهره برداری</option>
                                    <option value="2" <?php if ($no_sab == '2') echo 'selected="selected"'; ?>>مجوز آب</option>
                                    <option value="3" <?php if ($no_sab == '3') echo 'selected="selected"'; ?>>عرفی</option>
                                    <option value="4" <?php if ($no_sab == '4') echo 'selected="selected"'; ?>>سایر</option>
                                </select>
                            </div>
                        </td>
                        <td><div align="right">:نوع سند حقابه</div></td>
                        <td>&nbsp;</td>
                        <td>
                            <div align="right">
                                <span class="style2">ساعت</span>
                                <input name="h_ab" type="text" class="input_text digits" id="h_ab" style="width:100px; height:30px;" dir="rtl" value="<?php echo $h_ab; ?>" maxlength="70" readonly="readonly" />
                            </div>
                        </td>
                        <td><div align="right">:حقابه</div></td>
                    </tr>
                    <tr>
                        <td height="52">
                            <div align="right">
                                <select name="es" disabled="disabled" class="input_text" id="es" style="height:40px; width:170px;">
                                    <option value="">انتخاب کنید</option>
                                    <option value="1" <?php if ($es == '1') echo 'selected="selected"'; ?>>ندارد</option>
                                    <option value="2" <?php if ($es == '2') echo 'selected="selected"'; ?>>دارد / جهت ذخیره آب</option>
                                    <option value="3" <?php if ($es == '3') echo 'selected="selected"'; ?>>دارد - دو منظوره</option>
                                </select>
                            </div>
                        </td>
                        <td><div align="right">:وضعیت استخر</div></td>
                        <td>&nbsp;</td>
                        <td>
                            <div align="right">
                                <select name="no_ab" disabled="disabled" class="input_text" id="no_ab" style="height:40px; width:120px;">
                                    <option value="">انتخاب کنید</option>
                                    <option value="1" <?php if ($no_ab == '1') echo 'selected="selected"'; ?>>جوی و پشته</option>
                                    <option value="2" <?php if ($no_ab == '2') echo 'selected="selected"'; ?>>نواری</option>
                                    <option value="3" <?php if ($no_ab == '3') echo 'selected="selected"'; ?>>غرقابی</option>
                                    <option value="4" <?php if ($no_ab == '4') echo 'selected="selected"'; ?>>تشتکی</option>
                                    <option value="5" <?php if ($no_ab == '5') echo 'selected="selected"'; ?>>تحت فشار قطره ای</option>
                                    <option value="6" <?php if ($no_ab == '6') echo 'selected="selected"'; ?>>تحت فشار بارانی</option>
                                    <option value="7" <?php if ($no_ab == '7') echo 'selected="selected"'; ?>>سایر</option>
                                </select>
                            </div>
                        </td>
                        <td><div align="right">: نحوه آبیاری</div></td>
                    </tr>
                    <?php } ?>
                    
                    <!-- اطلاعات کاشت -->
                    <tr>
                        <td height="42" colspan="5" bgcolor="#CCCCCC"><div align="right"><strong>اطلاعات کاشت</strong></div></td>
                    </tr>
                    <tr>
                        <td height="40" colspan="2">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><div class="style8" align="right"><?php echo $z_sal; ?></div></td>
                        <td><div align="right">: سال زراعی</div></td>
                    </tr>
                    <tr>
                        <td height="131" colspan="5">
                            <table width="100%" border="1" cellpadding="5" cellspacing="0">
                                <tr>
                                    <td width="4%" rowspan="2" bgcolor="#FFFFCC">محصول بیمه شده ؟</td>
                                    <td width="4%" rowspan="2" bgcolor="#FFFFCC">خسارت</td>
                                    <td colspan="2" bgcolor="#FFFFCC">میزان تولید<br /><span class="style2">تن</span></td>
                                    <td colspan="2" bgcolor="#FFFFCC">سطح برداشت<br /><span class="style2">هکتار</span></td>
                                    <td colspan="2" bgcolor="#FFFFCC">سطح زیر کشت<br /><span class="style2">هکتار</span></td>
                                    <td colspan="2" bgcolor="#FFFFCC">اطلاعات محصول</td>
                                    <td width="4%" rowspan="2" bgcolor="#FFFFCC">ردیف</td>
                                </tr>
                                <tr>
                                    <td width="10%" bgcolor="#FFFFCC">قطعی</td>
                                    <td width="10%" bgcolor="#FFFFCC">پیش بینی</td>
                                    <td width="8%" bgcolor="#FFFFCC">دوم</td>
                                    <td width="7%" bgcolor="#FFFFCC">اول</td>
                                    <td width="7%" bgcolor="#FFFFCC">دوم</td>
                                    <td width="7%" bgcolor="#FFFFCC">اول</td>
                                    <td width="17%" bgcolor="#FFFFCC">نام</td>
                                    <td width="14%" bgcolor="#FFFFCC">گروه</td>
                                </tr>
                                <?php 
                                $n = 1;
                                $num2_t_mah = $t_mah;
                                include('../../login/config.php');
                                $query = "SELECT * FROM `$Agri_prod_table` WHERE Agri_id = :Agri_id"; 
                                $stmt = $dbh->prepare($query);
                                $stmt->execute(array(':Agri_id' => $id));
                                $row_count = $stmt->rowCount();
                                
                                if ($row_count == $num2_t_mah && $num2_t_mah > 0) {
                                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($products as $row_prod) {
                                        $mah_mas = $row_prod['mah_mas'];
                                        $group_cod = $row_prod['cod_qroup'];
                                        $cod_mah = $row_prod['cod_mah']; 
                                        $zer_kesht_a = $row_prod['zer_kesht_a'];
                                        $zer_kesht_b = $row_prod['zer_kesht_b'];
                                        $s_bar_a = $row_prod['s_bar_a'];
                                        $s_bar_b = $row_prod['s_bar_b'];
                                        $mah_tol = $row_prod['mah_tol'];
                                        $mah_tolp = $row_prod['mah_tolp'];
                                        $mah_bem = $row_prod['mah_bem'];
                                        $mah_kh = $row_prod['mah_kh'];
                                ?>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <select name="mah_bem<?php echo $n; ?>" disabled="disabled" style="height:40px; width:70px;">
                                            <option value="">انتخاب</option>
                                            <option value="1" <?php if ($mah_bem == '1') echo 'selected="selected"'; ?>>بلی</option>
                                            <option value="2" <?php if ($mah_bem == '2') echo 'selected="selected"'; ?>>خیر</option>
                                        </select>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <select name="mah_kh<?php echo $n; ?>" disabled="disabled" style="height:40px; width:70px;">
                                            <option value="">انتخاب</option>
                                            <option value="1" <?php if ($mah_kh == '1') echo 'selected="selected"'; ?>>بلی</option>
                                            <option value="2" <?php if ($mah_kh == '2') echo 'selected="selected"'; ?>>خیر</option>
                                        </select>
                                    </td>
                                    <td bgcolor="#FFFFFF"><input name="mah_tol<?php echo $n; ?>" type="text" class="number input_text" style="width:75px;" value="<?php echo $mah_tol * 1; ?>" readonly="readonly" /></td>
                                    <td bgcolor="#FFFFFF"><input name="mah_tolp<?php echo $n; ?>" type="text" class="number input_text" style="width:75px;" value="<?php echo $mah_tolp * 1; ?>" readonly="readonly" /></td>
                                    <td bgcolor="#FFFFFF"><input name="s_bar_b<?php echo $n; ?>" type="text" class="digits input_text" style="width:50px;" value="<?php echo $s_bar_b * 1; ?>" readonly="readonly" /></td>
                                    <td bgcolor="#FFFFFF"><input name="s_bar_a<?php echo $n; ?>" type="text" class="digits input_text" style="width:50px;" value="<?php echo $s_bar_a * 1; ?>" readonly="readonly" /></td>
                                    <td bgcolor="#FFFFFF"><input name="zer_kesht_b<?php echo $n; ?>" type="text" class="digits input_text" style="width:50px;" value="<?php echo $zer_kesht_b * 1; ?>" readonly="readonly" /></td>
                                    <td bgcolor="#FFFFFF"><input name="zer_kesht_a<?php echo $n; ?>" type="text" class="digits input_text" style="width:50px;" value="<?php echo $zer_kesht_a * 1; ?>" readonly="readonly" /></td>
                                    <td bgcolor="#FFFFFF"><input name="cod_mah<?php echo $n; ?>" type="text" style="width:150px;" value="<?php echo mah_name($cod_mah); ?>" readonly="readonly" /></td>
                                    <td bgcolor="#FFFFFF">
                                        <select name="mah_qroup<?php echo $n; ?>" disabled="disabled" style="width:120px; height:40px;">
                                            <option value="">انتخاب گروه</option>
                                            <?php
                                            $qry = "SELECT DISTINCT group_cod, group_name FROM `product_z`";
                                            $stmt2 = $dbh->prepare($qry);
                                            $stmt2->execute();
                                            foreach ($stmt2 as $grp) {
                                            ?>
                                            <option value="<?php echo $grp['group_cod']; ?>" <?php if ($grp['group_cod'] == $group_cod) echo 'selected="selected"'; ?>>
                                                <?php echo $grp['group_name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td bgcolor="#FFFFFF"><?php echo $n; ?></td>
                                </tr>
                                <?php
                                        $n++;
                                    }
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="37" colspan="2">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <div align="right">
                                <span class="style2">هکتار</span>
                                <input name="s_ayesh" type="text" class="digits input_text" id="s_ayesh" style="width:100px; height:30px;" dir="rtl" value="<?php echo $s_ayesh * 1; ?>" maxlength="70" readonly="readonly" />
                            </div>
                        </td>
                        <td><div align="right">: سطح آیش</div></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="center">
                            <input type="hidden" name="action_lise" value="1" />
                            <input type="hidden" name="back_p" value="1" />
                            <input type="submit" name="action" value="بازگشت" style="width:150px; height:45px;" />
                        </td>
                    </tr>
                </table>
                </form>
            </td>
        </tr>
        <tr>
            <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>
</body>
</html>

<?php
} else {
?>
<form name="myform" class="myform" method="post" action="Agri1.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>