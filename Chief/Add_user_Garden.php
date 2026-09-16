<?php
include("../lock_ce.php");
include("../event.php");
include('side_menu1.php');
include ('../login/config.php');

$message = '';
$message_type = '';

if (isset($_POST['action'])) {
    
    if (!$dbh) {
        die("❌ خطا: اتصال به دیتابیس برقرار نیست!");
    }
    
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $cod_m = $_POST['cod_m'];
    $tel_m = $_POST['tel_m'];
    $password = $_POST['pass'];
    
    $errors = array();
    
    if (empty($name)) $errors[] = "نام الزامی است";
    if (empty($last_name)) $errors[] = "نام خانوادگی الزامی است";
    if (empty($cod_m)) $errors[] = "کد ملی الزامی است";
    if (!preg_match('/^[0-9]{10}$/', $cod_m)) $errors[] = "کد ملی باید دقیقاً ۱۰ رقم باشد";
    if (empty($tel_m)) $errors[] = "شماره همراه الزامی است";
    if (!preg_match('/^[0-9]{11}$/', $tel_m)) $errors[] = "شماره همراه باید دقیقاً ۱۱ رقم باشد";
    if (empty($password)) $errors[] = "کلمه عبور الزامی است";
    if (strlen($password) < 6) $errors[] = "کلمه عبور باید حداقل ۶ کاراکتر باشد";
    if ($_POST['pass'] != $_POST['pass2']) $errors[] = "تکرار کلمه عبور مطابقت ندارد";
    
    if (empty($errors)) {
        try {
            $sql = $dbh->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
            $sql->execute(array($cod_m));
            $count = $sql->fetchColumn();
            if ($count > 0) {
                $errors[] = "❌ کد ملی قبلاً ثبت شده است و امکان ثبت دوباره وجود ندارد";
            }
        } catch (PDOException $e) {
            $errors[] = "خطا در بررسی کد ملی: " . $e->getMessage();
        }
    }
    
    if (empty($errors)) {
        try {
            function rand_string($length) {
                $str = "";
                $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $size = strlen($chars);
                for($i = 0; $i < $length; $i++) {
                    $str .= $chars[rand(0, $size-1)];
                }
                return $str;
            }
            
            $p_salt = rand_string(20);
            $site_salt = "subinsblogsalt";
            $salted_hash = hash('sha256', $password . $site_salt . $p_salt);
            
            $perm_value = 'p1p2p3p4d3d4d5d9';
            
            // ==============================================
            // همه فیلدهای عددی که NULL بودن رو به '' تبدیل کردم
            // ==============================================
            
            // ثبت رکورد اول - S_access = 20
            $sql1 = $dbh->prepare("INSERT INTO users (username, password, psalt, id_ostan, ostan, city, id_city, markaz, id_mar, name, Last_name, tel_m, Access, S_access, cod_m, perm, expert_unit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $result1 = $sql1->execute(array(
                $cod_m,
                $salted_hash,
                $p_salt,
                '',   // id_ostan = '' (نه NULL)
                '',   // ostan
                '',   // city
                '',   // id_city = '' (نه NULL)
                '',   // markaz
                '',   // id_mar = '' (نه NULL)
                $name,
                $last_name,
                $tel_m,
                1,
                20,
                $cod_m,
                $perm_value,
                2
            ));
            
            if (!$result1) {
                throw new Exception("خطا در ذخیره رکورد اول: " . print_r($sql1->errorInfo(), true));
            }
            
            // ثبت رکورد دوم - S_access = 23
            $sql2 = $dbh->prepare("INSERT INTO users (username, password, psalt, id_ostan, ostan, city, id_city, markaz, id_mar, name, Last_name, tel_m, Access, S_access, cod_m, perm, expert_unit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $result2 = $sql2->execute(array(
                $cod_m,
                $salted_hash,
                $p_salt,
                '',   // id_ostan = '' (نه NULL)
                '',   // ostan
                '',   // city
                '',   // id_city = '' (نه NULL)
                '',   // markaz
                '',   // id_mar = '' (نه NULL)
                $name,
                $last_name,
                $tel_m,
                1,
                23,
                $cod_m,
                $perm_value,
                2
            ));
            
            if (!$result2) {
                throw new Exception("خطا در ذخیره رکورد دوم: " . print_r($sql2->errorInfo(), true));
            }
            
            sabt_event($login_session, $_SERVER['REMOTE_ADDR'], $date_edit, $time, '', 'تعریف کاربر جدید با کد ملی : ' . $cod_m . ' (دو سطح دسترسی 20 و 23) - perm: ' . $perm_value, '');
            
            $message = "✅ کاربر جدید با کد ملی " . $cod_m . " با موفقیت در دو سطح دسترسی (مدیریت کشوری و الگوی کشت) ثبت شد";
            $message_type = "success";
            
            $_POST = array();
            
        } catch (PDOException $e) {
            $message = "❌ خطای دیتابیس: " . $e->getMessage();
            $message_type = "error";
            error_log("❌ PDOException: " . $e->getMessage());
        } catch (Exception $e) {
            $message = "❌ خطا: " . $e->getMessage();
            $message_type = "error";
            error_log("❌ Exception: " . $e->getMessage());
        }
    } else {
        $message = implode("<br>", $errors);
        $message_type = "error";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR" xml:lang="fa">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title; ?></title>
    <script src="../15_files/jquery.js" type="text/javascript"></script>
    <script src="../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../15_files/messages_fa.js" type="text/javascript"></script>
    
    <style type="text/css">
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Tahoma, Arial, sans-serif; background: #f0f4f8; direction: rtl; }
        .main-container { max-width: 1200px; margin: 0 auto; background: #ffffff; box-shadow: 0 0 20px rgba(0,0,0,0.1); border-radius: 10px; overflow: hidden; }
        .form-container { padding: 40px 50px; background: #ffffff; }
        .form-title { text-align: center; color: #003366; font-size: 24px; font-weight: bold; padding: 20px 0 10px 0; border-bottom: 3px solid #99CC00; margin-bottom: 30px; }
        .form-title span { background: #99CC00; color: #fff; padding: 5px 15px; border-radius: 5px; font-size: 14px; margin-right: 10px; }
        .form-card { background: #f9fbfd; border-radius: 12px; padding: 30px 35px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: 1px solid #e8edf3; }
        .form-row { display: flex; flex-wrap: wrap; margin-bottom: 20px; gap: 20px; }
        .form-group { flex: 1 1 calc(50% - 10px); min-width: 280px; }
        .form-group.full-width { flex: 1 1 100%; }
        .form-group label { display: block; font-size: 13px; font-weight: bold; color: #2c3e50; margin-bottom: 6px; padding-right: 5px; }
        .form-group label .required-star { color: #e74c3c; font-size: 16px; }
        .form-group input { width: 100%; padding: 12px 15px; border: 2px solid #dce4ec; border-radius: 8px; font-size: 14px; font-family: Tahoma, Arial, sans-serif; transition: all 0.3s ease; background: #ffffff; color: #2c3e50; height: 48px; }
        .form-group input:focus { border-color: #99CC00; outline: none; box-shadow: 0 0 0 3px rgba(153, 204, 0, 0.15); }
        .form-group input.error { border-color: #e74c3c; }
        .form-group .hint { font-size: 11px; color: #7f8c8d; margin-top: 4px; padding-right: 5px; }
        .btn-submit { background: linear-gradient(135deg, #99CC00 0%, #7cb300 100%); color: #ffffff; border: none; padding: 14px 50px; font-size: 18px; font-weight: bold; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; font-family: Tahoma, Arial, sans-serif; letter-spacing: 1px; min-width: 200px; }
        .btn-submit:hover { background: linear-gradient(135deg, #7cb300 0%, #669900 100%); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(153, 204, 0, 0.4); }
        .btn-wrapper { text-align: center; padding-top: 15px; border-top: 2px dashed #e8edf3; margin-top: 10px; }
        .message-box { padding: 15px 20px; border-radius: 8px; margin-bottom: 25px; font-size: 14px; font-weight: bold; display: flex; align-items: center; gap: 10px; }
        .message-box.success { background: #d4edda; border: 2px solid #28a745; color: #155724; }
        .message-box.error { background: #f8d7da; border: 2px solid #dc3545; color: #721c24; }
        .message-box .icon { font-size: 24px; }
        .label-icon { display: inline-block; width: 24px; text-align: center; margin-left: 5px; }
        label.error { color: #e74c3c; font-size: 12px; display: block; margin-top: 4px; padding-right: 5px; font-weight: normal; }
        .access-badge { display: inline-block; background: #e8f0fe; padding: 3px 12px; border-radius: 15px; font-size: 12px; color: #1a73e8; margin: 0 3px; border: 1px solid #d2e3fc; }
        .access-badge.level20 { background: #e6f7e6; color: #1e7e34; border-color: #b8e6b8; }
        .access-badge.level23 { background: #fff3cd; color: #856404; border-color: #ffc107; }
        .info-box { background: #e8f0fe; border-radius: 8px; padding: 12px 18px; border-right: 4px solid #1a73e8; margin-top: 5px; }
        .info-box .label { font-weight: bold; color: #1a73e8; }
        .info-box .value { color: #2c3e50; font-family: 'Courier New', monospace; background: #fff; padding: 2px 10px; border-radius: 4px; font-size: 13px; }
        @media (max-width: 768px) { .form-container { padding: 20px 15px; } .form-card { padding: 20px 15px; } .form-group { flex: 1 1 100%; min-width: unset; } .form-title { font-size: 18px; } .btn-submit { width: 100%; padding: 12px 20px; font-size: 16px; } }
    </style>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $("#form1").validate({
                rules: {
                    name: { required: true, minlength: 2 },
                    last_name: { required: true, minlength: 2 },
                    cod_m: { required: true, digits: true, minlength: 10, maxlength: 10 },
                    tel_m: { required: true, digits: true, minlength: 11, maxlength: 11 },
                    pass: { required: true, minlength: 6 },
                    pass2: { required: true, equalTo: "#password" }
                },
                messages: {
                    name: { required: "لطفاً نام خود را وارد کنید", minlength: "نام باید حداقل ۲ کاراکتر باشد" },
                    last_name: { required: "لطفاً نام خانوادگی خود را وارد کنید", minlength: "نام خانوادگی باید حداقل ۲ کاراکتر باشد" },
                    cod_m: { required: "لطفاً کد ملی خود را وارد کنید", digits: "کد ملی باید فقط شامل اعداد باشد", minlength: "کد ملی باید دقیقاً ۱۰ رقم باشد", maxlength: "کد ملی باید دقیقاً ۱۰ رقم باشد" },
                    tel_m: { required: "لطفاً شماره همراه خود را وارد کنید", digits: "شماره همراه باید فقط شامل اعداد باشد", minlength: "شماره همراه باید دقیقاً ۱۱ رقم باشد", maxlength: "شماره همراه باید دقیقاً ۱۱ رقم باشد" },
                    pass: { required: "لطفاً کلمه عبور را وارد کنید", minlength: "کلمه عبور باید حداقل ۶ کاراکتر باشد" },
                    pass2: { required: "لطفاً تکرار کلمه عبور را وارد کنید", equalTo: "تکرار کلمه عبور مطابقت ندارد" }
                },
                errorElement: "label",
                errorPlacement: function(error, element) { error.insertAfter(element); }
            });
        });
    </script>
</head>
<body>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr><td colspan="3"><?php include("header.php"); ?></td></tr>
    <tr>
        <td height="500" colspan="3" valign="top" bgcolor="#f0f4f8">
            
            <div class="main-container" style="margin: 30px auto; padding: 0 20px;">
                <div class="form-container">
                    
                    <div class="form-title">
                    📋 ثبت کاربر جدید معاونت باغبانی</div>
                    
                    <?php if (!empty($message)): ?>
                        <div class="message-box <?php echo $message_type; ?>">
                            <span class="icon"><?php echo ($message_type == 'success') ? '✅' : '❌'; ?></span>
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="form-card">
                        <form action="" method="post" id="form1" name="form1">
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label>👤 نام <span class="required-star">*</span></label>
                                    <input type="text" name="name" class="required" placeholder="نام خود را وارد کنید" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>👤 نام خانوادگی <span class="required-star">*</span></label>
                                    <input type="text" name="last_name" class="required" placeholder="نام خانوادگی خود را وارد کنید" value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>" />
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label>🆔 کد ملی (نام کاربری) <span class="required-star">*</span></label>
                                    <input type="text" name="cod_m" class="required digits" placeholder="مثال: ۱۲۳۴۵۶۷۸۹۰" maxlength="10" value="<?php echo isset($_POST['cod_m']) ? htmlspecialchars($_POST['cod_m']) : ''; ?>" />
                                    <div class="hint">🔑 این کد به عنوان نام کاربری در سیستم ثبت می‌شود</div>
                                </div>
                                <div class="form-group">
                                    <label>📱 شماره همراه <span class="required-star">*</span></label>
                                    <input type="text" name="tel_m" class="required digits" placeholder="مثال: ۰۹۱۲۳۴۵۶۷۸۹" maxlength="11" value="<?php echo isset($_POST['tel_m']) ? htmlspecialchars($_POST['tel_m']) : ''; ?>" />
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label>🔒 کلمه عبور <span class="required-star">*</span></label>
                                    <input type="password" name="pass" id="password" class="required" placeholder="حداقل ۶ کاراکتر" />
                                    <div class="hint">🔐 حداقل ۶ کاراکتر وارد کنید</div>
                                </div>
                                <div class="form-group">
                                    <label>🔁 تکرار کلمه عبور <span class="required-star">*</span></label>
                                    <input type="password" name="pass2" class="required" placeholder="کلمه عبور را دوباره وارد کنید" />
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group full-width" style="background: #f0f7e8; border-radius: 8px; padding: 15px 20px; border: 2px dashed #99CC00;">
                                    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                                        <span style="font-weight: bold; color: #2c3e50;">📌 سطح دسترسی‌های ثبت شده:</span>
                                        <span class="access-badge level20">مدیریت کشوری سامانه </span>
                                        <span class="access-badge level23">سامانه الگوی کشت </span>
                                        <span style="color: #7f8c8d; font-size: 12px;">🔹 هر دو با یک نام کاربری و رمز یکسان</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group full-width">
                                    <div class="info-box">
                                        <span class="label">📌 اطلاعات ثبت خودکار:</span><br>
                                        <span style="font-size:13px; color:#2c3e50;">
                                            🔹 <strong>دسترسی به سامانه (Access):</strong> <span class="value">1 (فعال)</span>
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                            🔹 <strong>perm:</strong> <span class="value">p1p2p3p4d3d4d5d9</span>
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                            🔹 <strong>expert_unit:</strong> <span class="value">2</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="btn-wrapper">
                                <button type="submit" name="action" class="btn-submit">✅ ثبت کاربر</button>
                            </div>
                            
                        </form>
                    </div>
                    
                </div>
            </div>
            
        </td>
    </tr>
    <tr>
        <td height="109" colspan="3" valign="middle" background="../files/bottom.gif">
            <?php include('../footer.php'); ?>
        </td>
    </tr>
</table>

</body>
</html>