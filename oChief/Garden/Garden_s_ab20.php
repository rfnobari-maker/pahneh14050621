<?php 
// تضمین سازگاری با PHP 5.3.3
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;

// متغیرهای ورودی جدید
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
$id_ostan = $_SESSION['id_ostan']; // از Session خوانده می‌شود

// اتصال به دیتابیس باید در فایل lock_oce.php یا در کدهای اولیه تعریف شده باشد.
// فرض بر این است که متغیر $dbh (شیء PDO یا مشابه آن) در دسترس است.

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
        <select name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="1" dir="rtl"  >
                                                        <option value="" > انتخاب گروه</option>
                                                        <?php
                                                        $query = "SELECT DISTINCT group_cod,group_name FROM `product_b` ORDER BY group_cod ASC" ;
                                                        $stmt = $dbh->prepare($query);
                                                        $stmt->execute();
                                                        foreach($stmt as $row){
                                                            ?>
                                                            <option value="<?php echo $row['group_cod'] ;?>"
                                                                <?php if (isset($_POST['mah_qroup']) && $row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                                                            <?php }?>
                                                    </select>
                                              </div>
                                            </td>
                                            <td align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8">:گروه محصولات</font></td>
                                        </tr>
                                        <tr bgcolor='#f1f1f1' >
                                            <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" >
                                                <div align="right">
                                                    <select name="mah_name" class="required input_text mar" style="width:170px ; height:40px" tabindex="2" dir="rtl">
                                                        <?php
                                                        if (!empty($mah_qroup)) {
                                                            $query = "SELECT DISTINCT product_cod,product_name FROM `product_b` WHERE `group_cod` = :mah_qroup ORDER BY product_name ASC" ;
                                                            $stmt = $dbh->prepare($query);
                                                            $stmt->bindParam(':mah_qroup', $mah_qroup);
                                                            $stmt->execute();
                                                            foreach($stmt as $row){
                                                                ?>
                                                                <option value="<?php echo $row['product_cod'] ;?>"
                                                                    <?php if ($row['product_cod']==$mah_name) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo '<option value="">ابتدا گروه را انتخاب کنید</option>';
                                                        }
                                                        ?>
                                                    </select>
                                              </div>
                                            </td>
                                            <td align='center' bgcolor="#FFFFFF" class="style8">: نام محصول</td>
                                        </tr>
                                        <tr bgcolor='#f1f1f1' >
                                            <td height="71" align="right" bgcolor="#FFFFFF" class="input_text" >
                                                <div align="right">
                                                    <select name="z_sal" class="input_text required" id="z_sal" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                                                        <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                                                    </select>
                                              </div>
                                            </td>
                                            <td width="146" align='center' bgcolor="#FFFFFF" class="style1"><span class="style8">: سال زراعی</span></td>
                                        </tr>
                                        <tr >
                                            <td height="60" colspan="2" align="left">
                                                <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="5" value='جستجو' />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                            <p>
                                <?php
                                if (isset($_POST['action']) && !empty($mah_qroup) && !empty($mah_name) && !empty($z_sal)) {
                                    // 1. کوئری بررسی وجود الگو در سطح استان
                                    // استفاده از Garden_ab_ostan و فیلدهای باغی
                                    $query_check_ostan = "
                                        SELECT COUNT(*) 
                                        FROM Garden_ab_ostan 
                                        WHERE z_sal = :z_sal 
                                          AND product_cod = :mah_name 
                                          AND (s_bar_abi > 0 OR s_bar_dem > 0 OR s_nobar_abi > 0 OR s_nobar_dem > 0)
                                          AND id_ostan = :id_ostan
                                    ";
                                    $stmt_check_ostan = $dbh->prepare($query_check_ostan);
                                    // برای سازگاری با PHP 5.3.3 از آرایه در execute استفاده می‌شود
                                    $stmt_check_ostan->execute(array(
                                        ':z_sal'    => $z_sal,
                                        ':mah_name' => $mah_name,
                                        ':id_ostan'  => $id_ostan
                                    ));
                                    $count_ostan = $stmt_check_ostan->fetchColumn();

                                    // 2. بررسی نتیجه کوئری
                                    if ($count_ostan > 0) {
                                        // اگر رکوردی یافت شد، ادامه فرآیند را اجرا کن
                                        $query_city_list = "SELECT id_city FROM cityname WHERE id_ostan = :id_ostan";
                                        $stmt_city_list = $dbh->prepare($query_city_list);
                                        $stmt_city_list->bindParam(':id_ostan', $id_ostan);
                                        $stmt_city_list->execute();
                                        $city_ids = $stmt_city_list->fetchAll(PDO::FETCH_COLUMN);

                                        foreach ($city_ids as $city_id) {
                                            // استفاده از Garden_ab_city
                                            $query_insert = "
                                            INSERT INTO Garden_ab_city (group_cod, group_name, product_cod, product_name, id_ostan, id_city, z_sal)
                                            SELECT p.group_cod, p.group_name, p.product_cod, p.product_name, :id_ostan, :id_city, :z_sal
                                            FROM product_b p
                                            LEFT JOIN Garden_ab_city a
                                              ON p.product_cod = a.product_cod
                                                 AND p.group_cod = a.group_cod
                                                 AND a.id_ostan = :id_ostan
                                                 AND a.id_city = :id_city
                                                 AND a.z_sal = :z_sal
                                            WHERE a.product_cod IS NULL
                                              AND p.product_cod = :mah_name
                                              AND p.group_cod = :mah_qroup";

                                            $q_insert = $dbh->prepare($query_insert);
                                            // برای سازگاری با PHP 5.3.3 از آرایه در execute استفاده می‌شود
                                            $q_insert->execute(array(
                                                ':id_ostan'  => $id_ostan,
                                                ':id_city'   => $city_id,
                                                ':z_sal'     => $z_sal,
                                                ':mah_name'  => $mah_name,
                                                ':mah_qroup' => $mah_qroup
                                            ));
                                        }

                                        // استفاده از Garden_ab_city
                                        $query = "
                                            SELECT a.*, c.city
                                            FROM Garden_ab_city a
                                            JOIN cityname c ON a.id_city = c.id_city AND a.id_ostan = c.id_ostan
                                            WHERE a.z_sal = :z_sal
                                              AND a.group_cod = :mah_qroup
                                              AND a.product_cod = :mah_name
                                              AND a.id_ostan = :id_ostan
                                            ORDER BY BINARY c.city ASC
                                        ";
                                        $stmt = $dbh->prepare($query);
                                        // برای سازگاری با PHP 5.3.3 از آرایه در execute استفاده می‌شود
                                        $stmt->execute(array(
                                            ':z_sal'     => $z_sal,
                                            ':mah_qroup' => $mah_qroup,
                                            ':mah_name'  => $mah_name,
                                            ':id_ostan'  => $id_ostan
                                        ));
                                        $t_row = $stmt->rowCount();

                                        if ($t_row > 0) {
                                            ?>
                                            <table width="122" height="56" border="0" align="center">
                                                <tr>
                                                    <td>
                                                        <form action="Sab_L2p_xls.php" method="post">
                                                            <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                                                            <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                                                            <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                                                            <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="agri-table">
                                                <tr class="text1">
                                                    <td width="7%" rowspan="2" bgcolor="#006699">عملیات</td>
                                                    <td colspan="2" bgcolor="#006699">عملکرد / کیلوگرم در هکتار<br /></td>
                                                    <td colspan="2" bgcolor="#006699">تولید / تن <br /></td>
                                                    <td colspan="2" bgcolor="#006699"><p>سطح کل  بارور / هکتار<br /></p></td>
                                                    <td colspan="2" bgcolor="#006699">سطح کل غیر بارور / هکتار</td>
                                                    <td width="17%" height="35" rowspan="2" bgcolor="#006699">شهرستان </td>
                                                    <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
                                                </tr>
                                                <tr class="text1">
                                                    <td width="15%" bgcolor="#006699">دیم</td>
                                                    <td width="12%" bgcolor="#006699">آبی</td>
                                                    <td width="11%" bgcolor="#006699">دیم</td>
                                                    <td width="9%" bgcolor="#006699">آبی</td>
                                                    <td width="3%" bgcolor="#006699">دیم</td>
                                                    <td width="4%" bgcolor="#006699">آبی</td>
                                                    <td width="9%" bgcolor="#006699">دیم</td>
                                                    <td width="10%" bgcolor="#006699">آبی</td>
                                                </tr>
                                                <tr>
                                                <?php  
                                                $r = 1 ;
                                                foreach($stmt as $row){  
                                                 $t_r = $r ;  
                                                 $id_city = $row['id_city'] ;
                                                  ?>
                                                  <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>>
                                                    <form name="form<?php echo $t_r ?>">
                                                      <input type="hidden" id="id<?php echo $t_r ?>" name="id" value="<?php echo $row['id'] ;?>" />
                                                      <input type="hidden" id="id_city<?php echo $t_r ?>" name="id_city" value="<?php echo $id_city ;?>" />
                                                      <input type="hidden" id="z_sal" name="z_sal" value="<?php echo $z_sal ;?>" />
                                                      <input type="hidden" id="product_cod<?php echo $t_r ?>" name="product_cod" value="<?php echo $mah_name ;?>" />
                                                      <input type="hidden" id="group_cod<?php echo $t_r ?>" name="group_cod" value="<?php echo $mah_qroup ;?>" />
                                                      <input name="submit" type="submit" class="submit<?php echo $t_r ?>" id="submit<?php echo $t_r ?>" style="width:40px ; height:35px ; font-size:14px ; color:#900 ; font-family:tahoma ; text-align:center" tabindex="<?php echo ($r*10+7); ?>" value="ثبت" />
                                                      <span class="error<?php echo $t_r ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15" alt=""/></span>
                                                      <span class="success<?php echo $t_r ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15" alt=""/></span>
                                                    </form>
                                                  </td>
                                                  <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="a_dem" type="text" class="style8" id="a_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+6); ?>" dir="rtl" lang="fa" value="" maxlength="8" align="baseline" xml:lang="fa" readonly /></td>
                                                  <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="a_abi" type="text" class="style8" id="a_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+5); ?>" dir="rtl" lang="fa" value="" maxlength="8" align="baseline" xml:lang="fa" readonly /></td>
                                                  <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="t_dem" type="text" class="t_dem<?php echo $t_r ?> required number input_text" id="t_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+4); ?>" dir="rtl" lang="fa" value="<?php echo $row['t_dem']*1 ; ?>" maxlength="8" align="baseline" xml:lang="fa" /></td>
                                                  <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="t_abi" type="text" class="t_abi<?php echo $t_r ?> required number input_text" id="t_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+3); ?>" dir="rtl" lang="fa" value="<?php echo $row['t_abi']*1 ; ?>" maxlength="8" align="baseline" xml:lang="fa" /></td>
                                                  <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="s_bar_dem" type="text" class="s_bar_dem<?php echo $t_r ?> required digits input_text" id="s_bar_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+2); ?>" dir="rtl" lang="fa" value="<?php echo $row['s_bar_dem']*1 ; ?>" maxlength="8" align="baseline" xml:lang="fa" /></td>
                                                  <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="s_bar_abi" type="text" class="s_bar_abi<?php echo $t_r ?> required digits input_text" id="s_bar_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+1); ?>" dir="rtl" lang="fa" value="<?php echo $row['s_bar_abi']*1 ; ?>" maxlength="8" align="baseline" xml:lang="fa" /></td>
                                                  <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="s_nobar_dem" type="text" class="s_nobar_dem<?php echo $t_r ?> required digits input_text" id="s_nobar_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+0); ?>" dir="rtl" lang="fa" value="<?php echo $row['s_nobar_dem']*1 ; ?>" maxlength="8" align="baseline" xml:lang="fa" /></td>
                                                  <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><input name="s_nobar_abi" type="text" class="s_nobar_abi<?php echo $t_r ?> required digits input_text" id="s_nobar_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10-1); ?>" dir="rtl" lang="fa" value="<?php echo $row['s_nobar_abi']*1 ; ?>" maxlength="8" align="baseline" xml:lang="fa" /></td>

                                                  <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><div align="right"><?php echo $row['city'] ;?></div></td>
                                                  <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo $r;?></td>
                                                </tr>
                                                <?php $r++; } ?>
                                            </table>
                                            <p class="style2" align="center">
                                                <?php } else { echo '<p class="style8">اطلاعاتی یافت نشد. لطفاً گروه محصولات، نام محصول و سال زراعی را انتخاب و جستجو کنید.</p>'; } 
                                        } else {
                                            // 3. اگر رکوردی یافت نشد، پیام خطا را نمایش بده
                                            echo '<p class="style8">برنامه الگوی کشت برای این محصول در سطح استان تعریف نشده است</p>';
                                        }
                                    } else { echo '<p class="style8"></p>'; } ?>
                                <p><a href="Pattern.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt=""/> </a></p>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <script type="text/javascript">
        // jQuery برای بارگذاری پویای محصولات بر اساس گروه
        $(document).ready(function() {
            $(".country").change(function() {
                var id = $(this).val();
                var dataString = 'group_cod=' + id;
                $.ajax({
                    type: "POST",
                    // فرض بر این است که فایل ajax_city.php برای محصول باغی (product_b) هم کار می‌کند
                    url: "ajax_city.php", 
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $(".mar").html(html);
                    }
                });
            });
        });
    </script>
    
    <script>
        function formatNumberWithSeparator(num) {
            if (!num) return "";
            const parts = num.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "٬");
            return parts.join(".");
        }
        function unformatNumber(str) {
            return str ? str.replace(/٬/g, "") : "0";
        }
        // اجبار به ورودی عددی با فرمت
        function enforceNumericInput(el) {
            el.addEventListener('input', function() {
                // استفاده از var به جای let برای سازگاری بهتر با ES5 در PHP 5.3.3
                var value = el.value.replace(/[^\d.]/g, '');
                var parts = value.split('.');
                if (parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');
                el.value = value ? formatNumberWithSeparator(value) : "";
            });
            el.addEventListener('paste', function() {
                setTimeout(function() {
                    var value = el.value.replace(/[^\d.]/g, '');
                    var parts = value.split('.');
                    if (parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');
                    el.value = value ? formatNumberWithSeparator(value) : "";
                }, 0);
            });
        }
    </script>
    
    <?php $no = isset($t_row) ? $t_row : 0; while ($no > 0){ ?>
    <script>
        // تعریف متغیر وضعیت اعتبار برای هر ردیف
        var isValidRow<?php echo $no ?> = { 
            s_bar_abi: true, 
            s_bar_dem: true, 
            s_nobar_abi: true, 
            s_nobar_dem: true, 
            t_abi: true, 
            t_dem: true 
        };

        // تابع محاسبه عملکرد
        function calcRow(row) {
            var un = unformatNumber;
            var t_abi = parseFloat(un(document.getElementById('t_abi'+row).value)) || 0;
            var s_bar_abi = parseFloat(un(document.getElementById('s_bar_abi'+row).value)) || 0; // استفاده از سطح بارور
            var t_dem = parseFloat(un(document.getElementById('t_dem'+row).value)) || 0;
            var s_bar_dem = parseFloat(un(document.getElementById('s_bar_dem'+row).value)) || 0; // استفاده از سطح بارور

            // محاسبه عملکرد (کیلوگرم بر هکتار) بر اساس سطح بارور
            var a_abi = s_bar_abi > 0 ? (t_abi / s_bar_abi * 1000).toFixed(2) : '';
            var a_dem = s_bar_dem > 0 ? (t_dem / s_bar_dem * 1000).toFixed(2) : '';

            document.getElementById('a_abi'+row).value = formatNumberWithSeparator(a_abi);
            document.getElementById('a_dem'+row).value = formatNumberWithSeparator(a_dem);
        }

        // تابع بررسی و اعتبارسنجی ورودی‌ها
        function handleBoxChange(boxClass, valueName) {
            $('.' + boxClass + '<?php echo $no ?>').on('change', function () {
                var value = parseFloat(unformatNumber($(this).val())) || 0;
                
                // تغییر فیلدهای مورد استفاده در اعتبارسنجی سمت کاربر به سطح بارور
                var s_bar_abi = parseFloat(unformatNumber($('#s_bar_abi<?php echo $no ?>').val())) || 0;
                var s_bar_dem = parseFloat(unformatNumber($('#s_bar_dem<?php echo $no ?>').val())) || 0;
                var $input = $(this);
                var clientSideValid = true;

                // اعتبارسنجی سمت کاربر برای تولید آبی و دیم (بر اساس سطح بارور)
                if ((valueName === 't_abi' && s_bar_abi > 0) || (valueName === 't_dem' && s_bar_dem > 0)) {
                    if (value <= 0) {
                        alert("در صورت وجود سطح بارور، مقدار تولید نمی‌تواند مساوی یا کوچکتر از ۰ باشد.");
                        $input.val(''); // پاک کردن مقدار
                        $input.focus();
                        clientSideValid = false;
                    }
                }
                
                if (clientSideValid) {
                    // محاسبه مجدد در صورت تغییر معتبر
                    calcRow(<?php echo $no ?>);
                    
                    var z_sal = $('#z_sal').val();
                    var id_ostan = '<?php echo $id_ostan ?>';
                    var id_city = $('#id_city<?php echo $no ?>').val();
                    var product_cod = $('#product_cod<?php echo $no ?>').val();
                    
                    // ساخت آبجکت داده‌ها به صورت پویا (سازگار با ES5)
                    var postData = {
                        z_sal: z_sal, 
                        id_ostan: id_ostan, 
                        id_city: id_city, 
                        product_cod: product_cod 
                    };
                    postData[valueName] = $(this).val();

                    // فراخوانی AJAX برای بررسی سرور ساید
                    $.post('check_s_abi.php', postData, function(response) {
                        // افزودن لاگ‌ها برای اشکال زدایی سمت سرور
                        console.log('برنامه ابلاغی استان:', response.stage1_value);
                        console.log('مجموع فعلی شهرستان ها:', response.stage2_value);
                        console.log('مجموع نهایی شهرستان ها:', response.final_value);
                        console.log('کوئری مرحله اول:', response.stage1_query); 
                        
                        if (response && !response.valid) {
                            alert(response.message);
                            $input.val(0); // این بخش برای پاسخ سرور است
                            
                            // در صورت خطای سرور، فیلدهای مرتبط را صفر کن
                            if (boxClass.indexOf('abi') !== -1) {
                                $('.t_abi<?php echo $no ?>').val(0);
                                $('.a_abi<?php echo $no ?>').val(0);
                            }
                            if (boxClass.indexOf('dem') !== -1) {
                                $('.t_dem<?php echo $no ?>').val(0);
                                $('.a_dem<?php echo $no ?>').val(0);
                            }
                            // محاسبه مجدد برای اعمال صفر شدن مقادیر
                            calcRow(<?php echo $no ?>);

                            isValidRow<?php echo $no ?>[valueName] = false;
                        } else {
                            isValidRow<?php echo $no ?>[valueName] = true;
                        }
                    }, 'json').fail(function(jqXHR, textStatus, errorThrown) {
                        console.error("Error in check.php AJAX call:", textStatus, errorThrown);
                    });
                } else {
                    isValidRow<?php echo $no ?>[valueName] = false;
                }
            });
        }
        
        // راه‌اندازی بررسی مقادیر (با فیلدهای جدید باغی)
        handleBoxChange('s_nobar_abi', 's_nobar_abi');
        handleBoxChange('s_nobar_dem', 's_nobar_dem');
        handleBoxChange('s_bar_abi', 's_bar_abi');
        handleBoxChange('s_bar_dem', 's_bar_dem');
        handleBoxChange('t_abi', 't_abi');
        handleBoxChange('t_dem', 't_dem');

    </script>
    <script>
        $(function() {
            $(".submit<?php echo $no ?>").click(function() {
                var un = unformatNumber;
                
                // جمع‌آوری اطلاعات فیلدهای باغی جدید
                var s_bar_abi = un($("#s_bar_abi<?php echo $no ?>").val());
                var s_bar_dem = un($("#s_bar_dem<?php echo $no ?>").val());
                var s_nobar_abi = un($("#s_nobar_abi<?php echo $no ?>").val());
                var s_nobar_dem = un($("#s_nobar_dem<?php echo $no ?>").val());

                var t_abi = un($("#t_abi<?php echo $no ?>").val());
                var t_dem = un($("#t_dem<?php echo $no ?>").val());
                var a_abi = un($("#a_abi<?php echo $no ?>").val());
                var a_dem = un($("#a_dem<?php echo $no ?>").val());
                
                var id = $("#id<?php echo $no ?>").val();
                var id_city = $("#id_city<?php echo $no ?>").val();
                var z_sal = $("#z_sal").val();
                var group_cod = $("#group_cod<?php echo $no ?>").val();
                var product_cod = $("#product_cod<?php echo $no ?>").val();

                // بررسی اعتبارسنجی‌ها قبل از ارسال
                if (!isValidRow<?php echo $no ?>.s_bar_abi || !isValidRow<?php echo $no ?>.s_bar_dem || !isValidRow<?php echo $no ?>.s_nobar_abi || !isValidRow<?php echo $no ?>.s_nobar_dem || !isValidRow<?php echo $no ?>.t_abi || !isValidRow<?php echo $no ?>.t_dem) {
                    alert("لطفاً مقادیر وارد شده را مجدداً بررسی کنید. برخی از مقادیر از سقف ابلاغی بیشتر است یا شرایط اعتبارسنجی را نقض کرده است.");
                    return false;
                }

                // ارسال با فیلدهای باغی جدید
                var dataString = 'id=' + id + '&id_city=' + id_city + '&z_sal=' + z_sal + '&group_cod=' + group_cod + '&product_cod=' + product_cod + 
                                 '&s_bar_abi=' + s_bar_abi + '&s_bar_dem=' + s_bar_dem + 
                                 '&s_nobar_abi=' + s_nobar_abi + '&s_nobar_dem=' + s_nobar_dem + 
                                 '&t_abi=' + t_abi + '&t_dem=' + t_dem + 
                                 '&a_abi=' + a_abi + '&a_dem=' + a_dem;
                
                // در صورت خالی بودن مقادیر، ثبت انجام نشود
                // بررسی می کند که حداقل یکی از فیلدهای سطح (بارور یا غیر بارور) مقدار داشته باشد.
                if (parseFloat(s_bar_abi) == 0 && parseFloat(s_bar_dem) == 0 && parseFloat(s_nobar_abi) == 0 && parseFloat(s_nobar_dem) == 0) {
                     alert("حداقل یک فیلد سطح (بارور یا غیر بارور) باید دارای مقدار باشد.");
                     return false;
                }
                
                // ارسال به فایل ثبت اطلاعات
                $.post("sabt_ab.php", dataString, function(response) {
                    if (response.valid) {
                        $('.success<?php echo $no ?>').fadeIn(200).show();
                        $('.error<?php echo $no ?>').fadeOut(200).hide();
                        console.log("ذخیره سازی با موفقیت انجام شد.");
                    } else {
                        alert(response.message);
                        $('.success<?php echo $no ?>').fadeOut(200).hide();
                        $('.error<?php echo $no ?>').fadeIn(200).show();
                        console.log("خطا در ذخیره سازی:", response.message);
                    }
                }, 'json');

                return false;
            });
        });

        // راه‌اندازی هنگام بارگذاری صفحه
        window.addEventListener('DOMContentLoaded', function() {
            var i = 1; // استفاده از var برای سازگاری با ES5
            while(document.getElementById('t_abi'+i)) {
                (function(row) { // استفاده از IIFE برای ایجاد اسکوپ
                    // اضافه کردن event listener برای تمام فیلدها جهت محاسبه ردیف و اعتبارسنجی ورودی عددی
                    ['t_abi', 's_bar_abi', 't_dem', 's_bar_dem', 's_nobar_abi', 's_nobar_dem'].forEach(function(field) {
                        var el = document.getElementById(field+row); // استفاده از var
                        if (el) {
                            enforceNumericInput(el);
                            el.addEventListener('input', function() { calcRow(row); });
                            calcRow(row);
                        }
                    });

                    // اضافه کردن event listener برای پاک کردن t_abi هنگام تغییر s_bar_abi (سطح بارور آبی)
                    document.getElementById('s_bar_abi' + row).addEventListener('input', function() {
                      document.getElementById('t_abi' + row).value = '';
                      calcRow(row); // Recalculate the row
                    });

                    // اضافه کردن event listener برای پاک کردن t_dem هنگام تغییر s_bar_dem (سطح بارور دیم)
                    document.getElementById('s_bar_dem' + row).addEventListener('input', function() {
                      document.getElementById('t_dem' + row).value = '';
                      calcRow(row); // Recalculate the row
                    });

                })(i);
                i++;
            }
        });
    </script>
    <?php
        $no--;
    }
    ?>
</body>
</html>