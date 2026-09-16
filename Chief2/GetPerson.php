<?php
include('../lock_ce.php');
include('../web/ws_sabt.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <style type="text/css"> 
	body {
    margin: 0;
    padding: 0;
}

img {
    display: block;
    margin: 0;
    padding: 0;
    line-height: 0;
}

table {
    border-spacing: 0;
    border-collapse: collapse;
}


    .error { 
        display: block; 
        color: red; 
        font-style: italic; 
    } 
    #message { 
        display: none; 
        font-size: 15px; 
        font-weight: bold; 
        color: #333333; 
    } 
    </style>
</head>
<body>
    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
        </tr>
        <tr>
            <td><?php include('menu.php')?></td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td width="4">&nbsp;</td>
                        <td width="840">
                            <p class="style8">استعلام مشخصات بهره بردار</p>
                            <p align="center"><img src="../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                            <div align="center" style="margin-top: 10px; font-family: tahoma; font-size: 16px">

                                <?php
                                // تابع برای تبدیل تاریخ به فرمت مطلوب
                                function convertDate($date) {
                                    $yy = substr($date, 0, 4);
                                    $mm = substr($date, 4, 2);
                                    $dd = substr($date, 6, 2);
                                    return $yy . '/' . $mm . '/' . $dd;
                                }

                                // نمایش فرم جستجو
                                function displayForm($birthdate = '', $nationalid = '') {
                                    echo '<form action="" method="post">
                                        <p>
                                            <input type="text" name="birthdate" value="'.htmlspecialchars($birthdate).'" style="font-size:16px; color:#06C; font-family:tahoma; width:120px; height:35px">
                                            : تاریخ تولد <br /><span class="style2">13470522</span><br /><br />
                                            <input type="text" name="nationalid" value="'.htmlspecialchars($nationalid).'" style="font-size:16px; color:#06C; font-family:tahoma; width:120px; height:35px">
                                            : کد ملی <br /><br />
                                            <input type="submit" name="go" style="font-size:16px; color:#06C; font-family:tahoma; width:100px; height:40px" value="جستجو">
                                        </p>
                                    </form>';
                                }

                                                              // نمایش فرم جستجو با مقادیر وارد شده
                                displayForm($birthdate, $nationalid);

							    // نمایش اطلاعات کاربر بر اساس نتیجه وب‌سرویس
                                function displayResult($result) {
                                    if ($result['name'] != '') {
                                        echo '<div dir="rtl">';
                                        echo 'کد ملی: ' . htmlspecialchars($result['nin']) . '<br>';
                                        echo 'نام: ' . htmlspecialchars($result['name']) . '<br>';
                                        echo 'نام خانوادگی: ' . htmlspecialchars($result['family']) . '<br>';
                                        echo 'نام پدر: ' . htmlspecialchars($result['fatherName']) . '<br>';
                                        echo 'شماره شناسنامه: ' . htmlspecialchars($result['shenasnameNo']) . '<br>';

                                        // تعیین جنسیت
                                        $gender = ($result['gender'] == 1) ? 'مرد' : 'زن';
                                        echo 'جنسیت: ' . $gender . '<br>';

                                        // تبدیل تاریخ تولد
                                        echo 'تاریخ تولد: ' . convertDate($result['birthDate']) . '<br>';

                                        // وضعیت حیات
                                        $live = ($result['deathStatus'] == 0) ? 'زنده' : 'فوت شده';
                                        echo 'وضعیت حیات: ' . $live . '<br>';
                                        echo '</div>';
                                    } else {
                                        echo '<div dir="rtl">فردی با مشخصات فوق یافت نشد</div>';
                                    }
                                }

                                // بررسی ارسال فرم
                                $birthdate = '';
                                $nationalid = '';
                                if (isset($_POST['go'])) {
                                    $birthdate = $_POST['birthdate'];
                                    $nationalid = $_POST['nationalid'];

                                    // بررسی معتبر بودن ورودی‌ها
                                    if (empty($birthdate) || empty($nationalid)) {
                                        echo '<div dir="rtl" class="error">لطفاً تمام فیلدها را پر کنید.</div>';
                                    } else {
                                        // درخواست به وب‌سرویس
                                        $result = webservice($birthdate, $nationalid);
                                        displayResult($result);
                                    }
                                }

                                ?>
                                
                            </div>
                            <p>&nbsp;</p>
                            <p align="center"><a href="benef.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47" alt=""/> </a></p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
