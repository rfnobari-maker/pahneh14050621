<?php
// فایل‌های مورد نیاز را وارد کنید
include("../lock_cp.php");
include("../event.php");
include("side_menu1.php");

// تابع تبدیل تاریخ به فرمت مطلوب
function convertDate($date)
{
    return substr($date, 0, 4) . '/' . substr($date, 4, 2) . '/' . substr($date, 6, 2);
}

// نمایش فرم جستجو
function displayForm($birthdate = '', $nationalid = '')
{
    echo '<form action="" method="post">
        <p>
            <label for="birthdate">تاریخ تولد:</label>
            <input type="text" id="birthdate" name="birthdate" value="' . htmlspecialchars($birthdate) . '" placeholder="13470522" style="font-size:16px; color:#06C; font-family:tahoma; width:120px; height:35px"><br><br>
            <label for="nationalid">کد ملی:</label>
            <input type="text" id="nationalid" name="nationalid" value="' . htmlspecialchars($nationalid) . '" style="font-size:16px; color:#06C; font-family:tahoma; width:120px; height:35px"><br><br>
            <input type="submit" name="go" value="جستجو" style="font-size:16px; color:#06C; font-family:tahoma; width:100px; height:40px">
        </p>
    </form>';
}

// نمایش نتایج جستجو
function displayResult($result)
{
    if (!empty($result['name'])) {
        echo '<div dir="rtl">';
        echo 'کد ملی: ' . htmlspecialchars($result['nin']) . '<br>';
        echo 'نام: ' . htmlspecialchars($result['name']) . '<br>';
        echo 'نام خانوادگی: ' . htmlspecialchars($result['family']) . '<br>';
        echo 'نام پدر: ' . htmlspecialchars($result['fatherName']) . '<br>';
        echo 'شماره شناسنامه: ' . htmlspecialchars($result['shenasnameNo']) . '<br>';
        echo 'جنسیت: ' . (($result['gender'] == 1) ? 'مرد' : 'زن') . '<br>';
        echo 'تاریخ تولد: ' . convertDate($result['birthDate']) . '<br>';
        echo 'وضعیت حیات: ' . (($result['deathStatus'] == 0) ? 'زنده' : 'فوت شده') . '<br>';
        echo '</div>';
    } else {
        echo '<div dir="rtl">فردی با مشخصات فوق یافت نشد</div>';
    }
}

// بررسی ارسال فرم
$birthdate = $_POST['birthdate'] ;
$nationalid = $_POST['nationalid'] ;
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['go'])) {
    if (empty($birthdate) || empty($nationalid)) {
        echo '<div dir="rtl" class="error">لطفاً تمام فیلدها را پر کنید.</div>';
    } else {
        // درخواست به وب‌سرویس (فرض کنید تابع webservice وجود دارد)
        $result = webservice($birthdate, $nationalid);
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../FA.css" rel="stylesheet" type="text/css">
    <title><?php echo $title  ?></title>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td colspan="3">
            <?php include("header.php"); ?>
        </td>
    </tr>
    <tr>
        <td height="500" colspan="3" valign="middle">
            <p class="style8">استعلام مشخصات بهره‌بردار</p>
            <p align="center">
                <img src="../files/horizontal-line-700x223.png" width="700" height="19" alt="">
            </p>
            <div align="center" style="margin-top: 10px; font-family: tahoma; font-size: 16px">
                <?php
                // نمایش فرم جستجو و نتایج (در صورت وجود)
                displayForm($birthdate, $nationalid);
                if ($result) {
                    displayResult($result);
                }
                ?>
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
