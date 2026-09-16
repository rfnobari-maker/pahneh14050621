<?php
// تعیین پروتکل به روش بهینه‌تر
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$actual_link = $protocol . $_SERVER['HTTP_HOST'];
define("BASE_URL", "/var/www/html/");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>صفحه مورد نظر یافت نشد</title>
    <link href="<?php echo $actual_link?>/FA.css" rel="stylesheet">
    <style>
        .style3 { color: #FFFFFF }
        .style4 { font-size: 10px; color: #FFFFFF }
        
        .box {
            width: 275px;
            float: right;
            line-height: 150%;
            margin: 10px 20px 30px 10px;
            font-family: Tahoma;
        }
        
        .tricky_image {
            margin-bottom: 10px;
            max-width: 86px;
            max-height: 86px;
            transition: all 1s;
            opacity: 1;
        }
        
        .tricky_image:hover {
            opacity: 0.2;
        }
        
        /* اضافه کردن استایل‌های جدید */
        body {
            margin: 0;
            font-family: Tahoma, Arial, sans-serif;
        }
        
        .error-container {
            text-align: center;
            padding: 20px;
        }
        
        .error-message {
            margin: 20px 0;
            line-height: 1.6;
        }
        
        #back-button {
            height: 40px;
            font-family: Tahoma;
            padding: 0 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="<?php echo $actual_link?>/files/images/header.jpg" width="100%" height="123" alt="header"></td>
        </tr>
        <tr>
            <td class="error-container">
              <p><img src="<?php echo $actual_link?>/files/attention.gif" width="87" height="88" alt="attention"></p>
                <h1>صفحه مورد نظر شما یافت نشد</h1>
                <p>&nbsp;</p>
                <p class="error-message">
                    در صورتیکه از صحت آدرس وارد شده مطمئن هستید؟! احتمالاً به منظور اعمال تغییرات موقتاً از دسترس خارج شده است.<br>
                    لطفاً بعداً بررسی فرمایید.
              </p>
                <button id="back-button" onclick="goBack()">بازگشت</button>
            </td>
        </tr>
        <tr>
            <td height="109" colspan="3" valign="middle" background="<?php echo $actual_link ?>/files/bottom.gif">
                <?php include(BASE_URL . 'footer.php')?>
            </td>
        </tr>
    </table>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>