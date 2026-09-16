<?php include('../lock_admin.php');
require_once dirname(__FILE__) . '/../login/sys_access.php';
if (isset($dbh) && $dbh) {
    pahneh_sys_ensure($dbh);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR" xml:lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <link href="../FA.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../jspc-gray.css">
    <script type="text/javascript" src="../js-persian-cal.min.js"></script>
    <script type="text/javascript" src="../script.js"></script>
    <script src="../15_files/jquery.js" type="text/javascript"></script>
    <script src="../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../15_files/messages_fa.js" type="text/javascript"></script>
    
    <style type="text/css">
        .style1 {
            color: #003366;
            font-family: Tahoma;
            font-size: 18px;
        }
        
        /* استایل‌های جدید برای فرم راست‌چین */
        .form-container {
            max-width: 950px;
            margin: 0 auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            direction: rtl;
        }
        
        .form-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 5px rgba(0,0,0,0.05);
            direction: rtl;
        }
        
        .form-table td {
            padding: 10px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #eee;
            text-align: right;
        }
        
        .form-table tr:last-child td {
            border-bottom: none;
        }
        
        .form-table tr:hover {
            background: #fafafa;
        }
        
        .label-text {
            font-family: Tahoma;
            font-size: 13px;
            color: #333;
            font-weight: bold;
            white-space: nowrap;
            text-align: right;
            padding-left: 10px;
        }
        
        .input-field {
            width: 100%;
            max-width: 200px;
            height: 35px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: Tahoma;
            font-size: 13px;
            transition: border-color 0.3s;
            background: #fff;
            direction: rtl;
            text-align: right;
        }
        
        .input-field:focus {
            border-color: #006699;
            outline: none;
            box-shadow: 0 0 5px rgba(0,102,153,0.3);
        }
        
        .input-field.wide {
            max-width: 300px;
        }
        
        .input-field.full {
            max-width: 100%;
        }
        
        .select-field {
            width: 100%;
            max-width: 200px;
            height: 40px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: Tahoma;
            font-size: 13px;
            background: #fff;
            cursor: pointer;
            transition: border-color 0.3s;
            direction: rtl;
        }
        
        .select-field:focus {
            border-color: #006699;
            outline: none;
            box-shadow: 0 0 5px rgba(0,102,153,0.3);
        }
        
        .select-field.wide {
            max-width: 250px;
        }
        
        .btn {
            padding: 10px 25px;
            border: none;
            border-radius: 4px;
            font-family: Tahoma;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            margin: 0 5px;
        }
        
        .btn-primary {
            background: #006699;
            color: #fff;
        }
        
        .btn-primary:hover {
            background: #004466;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: #fff;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .btn-danger {
            background: #dc3545;
            color: #fff;
        }
        
        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .btn-success {
            background: #28a745;
            color: #fff;
        }
        
        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }
        
        .profile-image-container {
            text-align: center;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 8px;
            border: 2px dashed #ddd;
            direction: rtl;
        }
        
        .profile-image-container img {
            border: 3px solid #006699;
            border-radius: 4px;
        }
        
        .profile-image-container .no-image {
            border: 3px solid #ccc;
            border-radius: 4px;
            opacity: 0.7;
        }
        
        .upload-section {
            margin-top: 15px;
            padding: 15px;
            background: #fff;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
            direction: rtl;
        }
        
        .upload-section .info-text {
            font-size: 12px;
            color: #900;
            text-align: justify;
            padding: 5px 10px;
            line-height: 1.8;
        }
        
        .header-section {
            background: linear-gradient(to right, #f0f7ff, #e6f0fa);
            padding: 15px 20px;
            border-radius: 8px 8px 0 0;
            border-bottom: 3px solid #006699;
            direction: rtl;
        }
        
        .title-divider {
            text-align: center;
            margin: 20px 0;
        }
        
        .title-divider img {
            max-width: 100%;
            height: auto;
        }
        
        .btn-group {
            text-align: center;
            padding: 20px 0;
            direction: rtl;
        }
        
        .field-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            direction: rtl;
        }
        
        .field-wrapper .label-text {
            white-space: nowrap;
        }
        
        .field-wrapper .input-field {
            flex: 1;
        }
        
        @media (max-width: 768px) {
            .form-table td {
                display: block;
                padding: 8px 12px;
                text-align: right !important;
            }
            .input-field, .select-field {
                max-width: 100% !important;
            }
            .label-text {
                white-space: normal;
            }
            .field-wrapper {
                flex-direction: column;
                align-items: stretch;
            }
            .field-wrapper .label-text {
                margin-bottom: 5px;
            }
        }
    </style>
    
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
        });
    </script>
</head>
<body>
    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
        </tr>
        <tr>
            <td><?php include('menu.php'); ?></td>
        </tr>
        <tr>
            <td>
                <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                        <td width="840">
                            <?php
                            if (isset($_POST['username'])) {
                                $username = $_POST['username'];
                                
                                include('../date_con.php');
                                include('../event.php');
                                require_once('../Jalali.php');
                                date_default_timezone_set('Asia/Tehran');
                                $date_edit = jdate("Y/m/d");
                                $time = date('H:i:s');
                                include('../login/config.php');
                                
                                // دریافت اطلاعات کاربر
                                $query = "SELECT * FROM users WHERE username = ?";
                                $stmt = $dbh->prepare($query);
                                $stmt->execute(array($username));
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                
                                // مقداردهی اولیه متغیرها از دیتابیس
                                $username = $row['username'];
                                $ostan = $row['ostan'];
                                $city = $row['city'];
                                $markaz = $row['markaz'];
                                $cod_m = $row['cod_m'];
                                $name_m = $row['name'];
                                $last_name = $row['Last_name'];
                                $jens = $row['jens'];
                                $sh_sh = $row['sh_sh'];
                                $date_t = $row['date_t'];
                                $m_sodor = $row['m_sodor'];
                                $fname = $row['fname'];
                                $m_tah = $row['m_tah'];
                                $r_tah = $row['r_tah'];
                                $univer = $row['univer'];
                                $m_date = $row['m_date'];
                                $avre = $row['avre'];
                                $v_tahol = $row['v_tahol'];
                                $cod_p = $row['cod_p'];
                                $tel_s = $row['tel_s'];
                                $tel_m = $row['tel_m'];
                                $addres = $row['addres'];
                                $id_ostan = $row['id_ostan'];
                                $id_city = $row['id_city'];
                                $id_mar = $row['id_mar'];
                                $s_access = $row['S_access'];
                                $acc_chief = pahneh_sys_can($row, 'chief') ? 1 : 0;
                                $acc_cpis = pahneh_sys_can($row, 'cpis') ? 1 : 0;
                                $acc_dash = pahneh_sys_can($row, 'dash') ? 1 : 0;
                                $access = $row['Access'];
                                $id_aria = $row['id_aria'];
                                $expert_unit = $row['expert_unit'];
                                
                                // به‌روزرسانی متغیرها از POST در صورت وجود (برای تغییر استان و شهرستان)
                                if (isset($_POST['id_ostan1']) && $_POST['id_ostan1'] != -1) {
                                    $id_ostan = $_POST['id_ostan1'];
                                }
                                if (isset($_POST['id_city']) && $_POST['id_city'] != 0) {
                                    $id_city = $_POST['id_city'];
                                }
                                if (isset($_POST['id_mar']) && $_POST['id_mar'] != 0) {
                                    $id_mar = $_POST['id_mar'];
                                }
                                
                                // حذف تصویر
                                if (isset($_POST['del_pic'])) {
                                    $query = "UPDATE users SET pic=? WHERE username=?";
                                    $q = $dbh->prepare($query);
                                    $q->execute(array('', $username));
                                    sabt_event($login_session, $_SERVER['REMOTE_ADDR'], $date_edit, $time, '', 'حذف تصویر کاربر', $id_ostan);
                                }
                                
                                // آپلود تصویر
                                $pic = '';
                                if ($_FILES['pic']['name']) {
                                    list($name, $result) = upload('pic', '../files/users', 'jpg,jpeg,gif,png,JPG,JPEG,PNG');
                                    if ($result == 1) {
                                        $pic = $name;
                                        echo "<br align='center'><font size=3 color='#060'>تصویر شما با موفقیت ارسال شد</font></br>";
                                    } else {
                                        echo "<br align='center' style='text-decoration:rtl'><font size=3 color='#900'>خطا در بارگذاري فايل: " . $result . "</font></br>";
                                    }
                                }
                                
                                if (isset($_POST['action4'])) {
                                    $query = "UPDATE users SET pic=? WHERE username=?";
                                    $q = $dbh->prepare($query);
                                    $q->execute(array($pic, $username));
                                    sabt_event($login_session, $_SERVER['REMOTE_ADDR'], $date_edit, $time, '', 'آپلود تصویر کاربر', $id_ostan);
                                }
                                
                                // دریافت مجدد اطلاعات برای نمایش
                                $query = "SELECT * FROM users WHERE username = ?";
                                $stmt = $dbh->prepare($query);
                                $stmt->execute(array($username));
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            ?>
                            
                            <div class="header-section">
                                <p align="center"><span class="style1">ویرایش اطلاعات کاربر</span></p>
                            </div>
                            
                            <div class="title-divider">
                                <img src="../files/horizontal-line-700x223.png" width="700" height="19" alt=""/>
                            </div>
                            
                            <!-- بخش آپلود تصویر -->
                            <div class="profile-image-container">
                                <p style="font-family:Tahoma; font-size:14px; color:#006699; font-weight:bold;">تصویر کاربر</p>
                                <div style="margin: 10px 0;">
                                    <?php if($row['pic'] <> "") { ?>
                                        <img style="border:3px solid #006699; border-radius:4px;" src="<?php echo '../files/users/'.$row['pic']; ?>?m=<?php echo filemtime('../files/users/'.user_pic($row['s_user'])); ?>" width="87" height="107"/>
                                        <div style="margin-top: 10px;">
                                            <form action="" method="post" style="display:inline;">
                                                <input type="hidden" name="username" value="<?php echo $username; ?>" />
                                                <input type="submit" name="del_pic" value="حذف تصویر" class="btn btn-danger" />
                                            </form>
                                        </div>
                                    <?php } else { ?>
                                        <img class="no-image" src="../files/users/no_pic.png" width="87" height="107"/>
                                    <?php } ?>
                                </div>
                                
                                <div class="upload-section">
                                    <div class="info-text">
                                        - حجم فایل ارسالی نباید از 2 کیلوبایت کمتر و از 30 کیلوبایت بیشتر باشد<br/>
                                        - برای تغییر تصویر موجود، ابتدا تصویر قبلی را حذف نمایید.<br/>
                                        - پس از ارسال تصویر جدید، برای مشاهده تغییرات، کلید F5 را فشار دهید.
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data" style="margin-top: 10px;">
                                        <input type="hidden" name="no_file" value="<?php echo $username; ?>" />
                                        <input type="hidden" name="username" value="<?php echo $username; ?>" />
                                        <input type="file" name="pic" id="pic" accept=".jpg,.jpeg,.gif,.png,.JPG,.JPEG,.GIF,.PNG" style="margin: 5px 0;" />
                                        <br/>
                                        <input type="submit" value="ارسال فایل" name="action4" class="btn btn-success" <?php if($row['pic'] <> "") { echo 'disabled="disabled"'; } ?> />
                                    </form>
                                </div>
                            </div>
                            
                            <!-- فرم اصلی -->
                            <div class="form-container">
                                <form action="" method="post" id="form1" name="form1">
                                    <input type="hidden" name="cod_p" value="<?php echo $cod_p; ?>" />
                                    <input type="hidden" name="username" value="<?php echo $username; ?>" />
                                    
                                    <table class="form-table">
                                        <!-- ردیف اول: شماره ملی و دسترسی به سامانه -->
                                        <tr>
                                            <td style="width:15%;">
                                                <div class="label-text">شماره ملی :</div>
                                            </td>
                                            <td style="width:35%;">
                                                <input name="cod_m" type="text" class="input-field" dir="rtl" value="<?php echo $cod_m; ?>" />
                                            </td>
                                            <td style="width:15%;">
                                                <div class="label-text">دسترسی به سامانه :</div>
                                            </td>
                                            <td style="width:35%;">
                                                <select name="access" class="select-field" dir="rtl" tabindex="10">
                                                    <option value="1" <?php if ($access == '1') echo 'selected="selected"'; ?>>بلی</option>
                                                    <option value="0" <?php if ($access == '0') echo 'selected="selected"'; ?>>خیر</option>
                                                </select>
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف دوم: استان و سطح دسترسی -->
                                        <tr>
                                            <td>
                                                <div class="label-text">استان :</div>
                                            </td>
                                            <td>
                                                <select name="id_ostan1" class="select-field" dir="rtl" onchange="this.form.submit()">
                                                    <option value="-1">انتخاب استان</option>
                                                    <?php
                                                    $query = "SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach($stmt as $row_ostan) {
                                                    ?>
                                                        <option value="<?php echo $row_ostan['id_ostan']; ?>" <?php if ($row_ostan['id_ostan'] == $id_ostan) echo 'selected="selected"'; ?>>
                                                            <?php echo $row_ostan['ostan']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="label-text">سطح دسترسی :</div>
                                            </td>
                                            <td>
                                                <select name="s_access" class="select-field wide" dir="rtl" tabindex="11">
                                                    <option value="1" <?php if ($s_access == '1') echo 'selected="selected"'; ?>>مروج کشاورزی</option>
                                                    <option value="2" <?php if ($s_access == '2') echo 'selected="selected"'; ?>>رئیس مرکز</option>
                                                    <option value="3" <?php if ($s_access == '3') echo 'selected="selected"'; ?>>مدیریت شهرستان</option>
                                                    <option value="4" <?php if ($s_access == '4') echo 'selected="selected"'; ?>>مدیریت سامانه</option>
                                                    <option value="5" <?php if ($s_access == '5') echo 'selected="selected"'; ?>>کارشناس معین استان</option>
                                                    <option value="6" <?php if ($s_access == '6') echo 'selected="selected"'; ?>>کارشناس موضوعی شهرستان</option>
                                                    <option value="7" <?php if ($s_access == '7') echo 'selected="selected"'; ?>>محقق معین شهرستان</option>
                                                    <option value="98" <?php if ($s_access == '98') echo 'selected="selected"'; ?>>مدیر استانی سامانه</option>
                                                    <option value="99" <?php if ($s_access == '99') echo 'selected="selected"'; ?>>ادمین سامانه</option>
                                                    <option value="23" <?php if ($s_access == '23') echo 'selected="selected"'; ?>>الگوی کشت</option>
                                                    <option value="20" <?php if ($s_access == '20') echo 'selected="selected"'; ?>>مدیریت کشوری سامانه</option>
                                                    <option value="50" <?php if ($s_access == '50') echo 'selected="selected"'; ?>>نیروی پشتیبانی</option>
                                                    <option value="51" <?php if ($s_access == '51') echo 'selected="selected"'; ?>>سرباز سازندگی</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="label-text">ورود به سامانه‌ها :</div>
                                            </td>
                                            <td colspan="5">
                                                <style type="text/css">
                                                    .pahneh-sys-access { display:flex; flex-wrap:wrap; gap:10px 18px; }
                                                    .pahneh-sys-access label { font-family:Tahoma; font-size:13px; cursor:pointer; }
                                                    .pahneh-sys-access input { width:18px; height:18px; vertical-align:middle; }
                                                </style>
                                                <?php echo pahneh_sys_checkboxes_html($acc_chief, $acc_cpis, $acc_dash); ?>
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف سوم: شهرستان و واحد تخصصی -->
                                        <tr>
                                            <td>
                                                <div class="label-text">شهرستان :</div>
                                            </td>
                                            <td>
                                                <select name="id_city" class="select-field" dir="rtl" onchange="this.form.submit()">
                                                    <option value="0">--</option>
                                                    <?php
                                                    $query = "SELECT id_city, city FROM cityname WHERE id_ostan = ?";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute(array($id_ostan));
                                                    foreach($stmt as $row_city) {
                                                    ?>
                                                        <option value="<?php echo $row_city['id_city']; ?>" <?php if ($row_city['id_city'] == $id_city) echo 'selected="selected"'; ?>>
                                                            <?php echo $row_city['city']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <input type="hidden" name="id_ostan" value="<?php echo $id_ostan; ?>" />
                                            </td>
                                            <td>
                                                <div class="label-text">واحد تخصصی :</div>
                                            </td>
                                            <td>
                                                <select name="expert_unit" class="select-field wide" dir="rtl" tabindex="13">
                                                    <option value="0">---</option>
                                                    <option value="1" <?php if ($expert_unit == '1') echo 'selected="selected"'; ?>>هماهنگی ترویج</option>
                                                    <option value="2" <?php if ($expert_unit == '2') echo 'selected="selected"'; ?>>باغبانی</option>
                                                    <option value="3" <?php if ($expert_unit == '3') echo 'selected="selected"'; ?>>حفظ نباتات</option>
                                                    <option value="4" <?php if ($expert_unit == '4') echo 'selected="selected"'; ?>>زراعت</option>
                                                    <option value="5" <?php if ($expert_unit == '5') echo 'selected="selected"'; ?>>امور شیلات و آبزیان</option>
                                                    <option value="6" <?php if ($expert_unit == '6') echo 'selected="selected"'; ?>>امور دام</option>
                                                    <option value="7" <?php if ($expert_unit == '7') echo 'selected="selected"'; ?>>امور طیور</option>
                                                    <option value="8" <?php if ($expert_unit == '8') echo 'selected="selected"'; ?>>امور اراضی</option>
                                                    <option value="9" <?php if ($expert_unit == '9') echo 'selected="selected"'; ?>>صنایع کشاورزی</option>
                                                    <option value="10" <?php if ($expert_unit == '10') echo 'selected="selected"'; ?>>آب و خاک</option>
                                                </select>
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف چهارم: منطقه تحت پوشش و مرکز خدمات -->
                                        <tr>
                                            <td>
                                                <div class="label-text">منطقه تحت پوشش :</div>
                                            </td>
                                            <td>
                                                <select name="id_aria" class="select-field" dir="rtl" tabindex="12">
                                                    <option value="0">---</option>
                                                    <?php
                                                    $query = "SELECT DISTINCT id_aria FROM aria WHERE id_ostan = ?";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute(array($id_ostan));
                                                    foreach($stmt as $row_aria) {
                                                    ?>
                                                        <option value="<?php echo $row_aria['id_aria']; ?>" <?php if ($row_aria['id_aria'] == $id_aria) echo 'selected="selected"'; ?>>
                                                            <?php echo $row_aria['id_aria']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="label-text">مرکز خدمات :</div>
                                            </td>
                                            <td>
                                                <select name="id_mar" class="select-field" dir="rtl" onchange="this.form.submit()">
                                                    <option value="0">--</option>
                                                    <?php
                                                    $query = "SELECT DISTINCT id_mar, mar FROM mar WHERE id_ostan = ? AND id_city = ?";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute(array($id_ostan, $id_city));
                                                    foreach($stmt as $row_mar) {
                                                    ?>
                                                        <option value="<?php echo $row_mar['id_mar']; ?>" <?php if ($row_mar['id_mar'] == $id_mar) echo 'selected="selected"'; ?>>
                                                            <?php echo $row_mar['mar']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <input type="hidden" name="id_ostan2" value="<?php echo $id_ostan; ?>" />
                                                <input type="hidden" name="id_city2" value="<?php echo $id_city; ?>" />
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف پنجم: نام و نام خانوادگی -->
                                        <tr>
                                            <td>
                                                <div class="label-text">نام :</div>
                                            </td>
                                            <td>
                                                <input name="name" type="text" class="input-field" dir="rtl" value="<?php echo $name_m; ?>" maxlength="50" tabindex="1" />
                                            </td>
                                            <td>
                                                <div class="label-text">نام خانوادگی :</div>
                                            </td>
                                            <td>
                                                <input name="last_name" type="text" class="input-field" dir="rtl" value="<?php echo $last_name; ?>" maxlength="50" tabindex="2" />
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف ششم: جنسیت و شماره شناسنامه -->
                                        <tr>
                                            <td>
                                                <div class="label-text">جنسیت :</div>
                                            </td>
                                            <td>
                                                <select name="jens" class="select-field" dir="rtl" tabindex="3">
                                                    <option value="">انتخاب کنید</option>
                                                    <option value="مرد" <?php if ($jens == 'مرد') echo 'selected="selected"'; ?>>آقا</option>
                                                    <option value="زن" <?php if ($jens == 'زن') echo 'selected="selected"'; ?>>خانم</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="label-text">شماره شناسنامه :</div>
                                            </td>
                                            <td>
                                                <input name="sh_sh" type="text" class="input-field digits" dir="rtl" value="<?php echo $sh_sh; ?>" maxlength="20" tabindex="4" />
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف هفتم: تاریخ تولد و محل صدور -->
                                        <tr>
                                            <td>
                                                <div class="label-text">تاریخ تولد :</div>
                                            </td>
                                            <td>
                                                <input name="date_t" type="text" class="input-field pdate" id="pcal1" dir="rtl" value="<?php echo $date_t; ?>" maxlength="10" tabindex="5" />
                                            </td>
                                            <td>
                                                <div class="label-text">محل صدور :</div>
                                            </td>
                                            <td>
                                                <input name="m_sodor" type="text" class="input-field" dir="rtl" value="<?php echo $m_sodor; ?>" maxlength="35" tabindex="6" />
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف هشتم: نام پدر و مدرک تحصیلی -->
                                        <tr>
                                            <td>
                                                <div class="label-text">نام پدر :</div>
                                            </td>
                                            <td>
                                                <input name="fname" type="text" class="input-field" dir="rtl" value="<?php echo $fname; ?>" maxlength="35" tabindex="7" />
                                            </td>
                                            <td>
                                                <div class="label-text">مدرک تحصیلی :</div>
                                            </td>
                                            <td>
                                                <select name="m_tah" class="select-field" dir="rtl" tabindex="8">
                                                    <option value="">انتخاب کنید</option>
                                                    <option value="1" <?php if ($m_tah == '1') echo 'selected="selected"'; ?>>لیسانس</option>
                                                    <option value="2" <?php if ($m_tah == '2') echo 'selected="selected"'; ?>>فوق لیسانس</option>
                                                    <option value="3" <?php if ($m_tah == '3') echo 'selected="selected"'; ?>>دکتری</option>
                                                </select>
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف نهم: رشته تحصیلی و نام دانشگاه -->
                                        <tr>
                                            <td>
                                                <div class="label-text">رشته تحصیلی :</div>
                                            </td>
                                            <td>
                                                <input name="r_tah" type="text" class="input-field" dir="rtl" value="<?php echo $r_tah; ?>" maxlength="35" tabindex="9" />
                                            </td>
                                            <td>
                                                <div class="label-text">نام دانشگاه :</div>
                                            </td>
                                            <td>
                                                <input name="univer" type="text" class="input-field" dir="rtl" value="<?php echo $univer; ?>" maxlength="35" tabindex="10" />
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف دهم: تاریخ اخذ مدرک و معدل -->
                                        <tr>
                                            <td>
                                                <div class="label-text">تاریخ اخذ مدرک :</div>
                                            </td>
                                            <td>
                                                <input name="m_date" type="text" class="input-field pdate" id="pcal2" dir="rtl" value="<?php echo $m_date; ?>" maxlength="10" tabindex="11" />
                                            </td>
                                            <td>
                                                <div class="label-text">معدل :</div>
                                            </td>
                                            <td>
                                                <input name="avre" type="text" class="input-field" dir="rtl" value="<?php echo $avre; ?>" maxlength="5" tabindex="12" />
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف یازدهم: وضعیت تاهل و کد پرسنلی -->
                                        <tr>
                                            <td>
                                                <div class="label-text">وضعیت تاهل :</div>
                                            </td>
                                            <td>
                                                <select name="v_tahol" class="select-field" dir="rtl" tabindex="13">
                                                    <option value="">انتخاب کنید</option>
                                                    <option value="1" <?php if ($v_tahol == '1') echo 'selected="selected"'; ?>>متاهل</option>
                                                    <option value="2" <?php if ($v_tahol == '2') echo 'selected="selected"'; ?>>مجرد</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="label-text">کد پرسنلی :</div>
                                            </td>
                                            <td>
                                                <input name="cod_p" type="text" class="input-field" dir="rtl" value="<?php echo $cod_p; ?>" maxlength="35" tabindex="14" />
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف دوازدهم: تلفن ثابت و همراه -->
                                        <tr>
                                            <td>
                                                <div class="label-text">شماره تلفن ثابت :</div>
                                            </td>
                                            <td>
                                                <input name="tel_s" type="text" class="input-field digits" dir="rtl" value="<?php echo $tel_s; ?>" maxlength="11" tabindex="15" />
                                            </td>
                                            <td>
                                                <div class="label-text">شماره همراه :</div>
                                            </td>
                                            <td>
                                                <input name="tel_m" type="text" class="input-field digits" dir="rtl" value="<?php echo $tel_m; ?>" maxlength="11" tabindex="16" />
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف سیزدهم: آدرس -->
                                        <tr>
                                            <td colspan="4">
                                                <div class="field-wrapper">
                                                    <div class="label-text">آدرس محل سکونت :</div>
                                                    <input name="addres" type="text" class="input-field full" dir="rtl" value="<?php echo $addres; ?>" maxlength="300" tabindex="17" />
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- ردیف دکمه‌ها -->
                                        <tr>
                                            <td colspan="4" class="btn-group">
                                                <input type="submit" name="action2" value="بازگشت" class="btn btn-secondary" />
                                                <input type="submit" name="action" value="تصحیح اطلاعات" class="btn btn-primary" tabindex="18" />
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            
                            <?php
                            } else {
                                echo '<br/><p align="center" style="color:red; font-family:Tahoma; font-size:16px;">مجوز دسترسی به این صفحه را ندارید</p>';
                            }
                            ?>
                            
                            <!-- تاریخ فارسی -->
                            <script type="text/javascript">
                                var objCal1 = new AMIB.persianCalendar('pcal1');
                                var objCal2 = new AMIB.persianCalendar('pcal2');
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../files/bottom.gif">
                            <?php include('../footer.php'); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<?php
// پردازش ذخیره اطلاعات
if (isset($_POST['action'])) {
    $id_ostan = $_POST['id_ostan'];
    $id_city = $_POST['id_city'];
    $id_mar = $_POST['id_mar'];
    $id_aria = $_POST['id_aria'];
    $ostan = ostan_name($id_ostan);
    $city = city_name1($id_city, $id_ostan);
    $markaz = mar_name($id_mar);
    $cod_m = $_POST['cod_m'];
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $jens = $_POST['jens'];
    $sh_sh = $_POST['sh_sh'];
    $date_t = date_con($_POST['date_t']);
    $m_sodor = $_POST['m_sodor'];
    $fname = $_POST['fname'];
    $m_tah = $_POST['m_tah'];
    $r_tah = $_POST['r_tah'];
    $univer = $_POST['univer'];
    $m_date = date_con($_POST['m_date']);
    $avre = $_POST['avre'];
    $v_tahol = $_POST['v_tahol'];
    $cod_p = $_POST['cod_p'];
    $tel_s = $_POST['tel_s'];
    $tel_m = $_POST['tel_m'];
    $addres = $_POST['addres'];
    $s_access = $_POST['s_access'];
    $access = $_POST['access'];
    $expert_unit = $_POST['expert_unit'];
    $username = $_POST['username'];
    pahneh_sys_ensure($dbh);
    $acc = pahneh_sys_from_post();
    
    $query = "UPDATE users SET cod_m=?, id_ostan=?, id_city=?, id_mar=?, ostan=?, city=?, markaz=?, name=?, Last_name=?, jens=?, sh_sh=?, date_t=?, m_sodor=?, fname=?, m_tah=?, r_tah=?, univer=?, m_date=?, avre=?, v_tahol=?, cod_p=?, tel_s=?, tel_m=?, addres=?, S_access=?, Access=?, id_aria=?, expert_unit=?, acc_chief=?, acc_cpis=?, acc_dash=? WHERE username=?";
    $q = $dbh->prepare($query);
    $q->execute(array($cod_m, $id_ostan, $id_city, $id_mar, $ostan, $city, $markaz, $name, $last_name, $jens, $sh_sh, $date_t, $m_sodor, $fname, $m_tah, $r_tah, $univer, $m_date, $avre, $v_tahol, $cod_p, $tel_s, $tel_m, $addres, $s_access, $access, $id_aria, $expert_unit, $acc['acc_chief'], $acc['acc_cpis'], $acc['acc_dash'], $username));
    
    sabt_event($login_session, $_SERVER['REMOTE_ADDR'], $date_edit, $time, '', 'ویرایش اطلاعات کاربر با نام کاربری: ' . $username, $id_ostan);
    alert('اطلاعات کاربری شما با موفقیت تصحیح شد');
    ?>
    <form name="myform" class="myform" method="post" action="user_view.php">
        <input type="hidden" name="previous" value="<?php echo $previous; ?>" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan; ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city; ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar; ?>" />
        <input type="hidden" name="s_access" value="<?php echo $s_access; ?>" />
        <input type="hidden" name="action" value="1" />
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
}

// بازگشت
if (isset($_POST['action2'])) {
    ?>
    <form name="myform" class="myform" method="post" action="user_view.php">
        <input type="hidden" name="previous" value="<?php echo $previous; ?>" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan; ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city; ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar; ?>" />
        <input type="hidden" name="s_access" value="<?php echo $s_access; ?>" />
        <input type="hidden" name="action" value="1" />
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
}

// تابع آپلود فایل
function upload($file_id, $folder="", $types="") {
    if(!$_FILES[$file_id]['name']) return array('', 'No file specified');
    $file_title = $_FILES[$file_id]['name'];
    $ext = substr(strrchr(basename($file_title), '.'), 1);
    $no_file = $_POST['no_file'];
    $file_name = strrev($no_file) . '.' . $ext;
    $all_types = explode(",", strtolower($types));
    if($types) {
        if(!in_array($ext, $all_types)) {
            $result = 'فایل غیر مجاز';
            return array($file_name, $result);
        }
    }
    if($folder) $folder .= '/';
    $uploadfile = $folder . $file_name;
    $result = 1;
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "امکان آپلود فایل وجود ندارد";
        if(!file_exists($folder)) {
            $result .= " : مقصد یافت نشد";
        } elseif(!is_writable($folder)) {
            $result .= " : امکان نوشتن در مقصد وجود ندارد";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : فایل قابل نوشتن نیست";
        }
        $file_name = '';
    } else {
        if(!$_FILES[$file_id]['size']) {
            @unlink($uploadfile);
            $file_name = '';
            $result = "فایل خالی است لطفاً یک فایل معتبر انتخاب کنید";
        } else {
            if(($_FILES[$file_id]['size'] < 2000) || ($_FILES[$file_id]['size'] > 30000)) {
                $file_name = '';
                $result = "حجم فایل ارسالی نباید از 2 کیلوبایت کمتر و از 30 کیلوبایت بیشتر باشد";
            } else {
                chmod($uploadfile, 0777);
            }
        }
    }
    return array($file_name, $result);
}
?>