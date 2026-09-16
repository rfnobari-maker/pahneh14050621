<?php
include('../lock_p1.php');
include('../web/ws_sabt1.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <link href="../FA.css" rel="stylesheet" type="text/css" />
<title><?php echo $title ;?></title>
<style type="text/css">
    /* Variable definitions for easy theming */
    :root {
        --primary-color: #006699; /* Dark Blue */
        --secondary-color: #f0f8ff; /* A soft blue/off-white */
        --accent-color: #0099cc; /* A brighter blue */
        --text-color: #333;

        --error-color: #dc3545; /* Red */
        --success-color: #28a745; /* Green */
        --border-color: #ccc;
        --shadow: 0 4px 8px rgba(0,0,0,0.1);
        --input-bg: #fff;
    }

    body {
        margin: 0; padding: 0; 
        color: var(--text-color);
        direction: rtl; /* Ensure RTL direction for the whole body */
        text-align: right; /* Default text alignment */
    }

    .search-form {
        background-color: #f9f9f9;
        padding: 25px;
        border-radius: 10px;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        max-width: 450px;
        margin: 30px auto;
        text-align: right; /* Align form elements to the right */
        border: 1px solid #eee;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 18px;
        color: var(--primary-color);
        font-weight: bold;
    }

    .form-input {
        width: calc(100% - 22px); /* Adjust for padding and border */
        padding: 10px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        font-size: 16px;
        color: var(--text-color);
        background-color: var(--input-bg);
        text-align: right; /* Ensure input text is RTL */
        box-sizing: border-box; /* Include padding and border in the element's total width and height */
    }

    .form-input:focus {
        border-color: var(--accent-color);
        outline: none;
        box-shadow: 0 0 5px rgba(0, 153, 204, 0.3);
    }

    .help-text {
        font-size: 13px;
        color: #666;
        display: block;
        margin-top: 5px;
        text-align: left; /* Align help text to left under RTL for better readability */
    }

    .submit-button {
        background-color: var(--primary-color);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        width: auto;
        min-width: 120px;
        display: block; /* Make button full width of its container or use flexbox for alignment */
        margin: 20px auto 0 auto; /* Center the button */
    }

    .submit-button:hover {
        background-color: var(--accent-color);
        transform: translateY(-2px);
    }

    /* Styles for the result box */
    .result-box {
        padding: 20px;
        margin: 20px auto;
        border-radius: 10px;
        max-width: 450px;
        font-size: 16px;
        line-height: 1.8;
        box-shadow: var(--shadow);
        text-align: right;
        border-left: 5px solid; /* A prominent left border for status */
    }

    .result-box p {
        margin: 5px 0;
        padding: 0;
    }
    
    .result-box strong {
        color: var(--primary-color); /* Highlight field names */
    }

    .result-box.success {
        background-color: #e6ffe6; /* Light green */
        border-color: var(--success-color);
        color: var(--success-color);
    }

    .result-box.error {
        background-color: #ffe6e6; /* Light red */
        border-color: var(--error-color);
        color: var(--error-color);
    }

    /* Responsive Adjustments */
    @media (max-width: 600px) {
        .search-form, .result-box {
            max-width: 90%;
            margin-left: 5%;
            margin-right: 5%;
        }
        .form-input, .submit-button {
            font-size: 15px;
        }
        .form-group label {
            font-size: 16px;
        }
        .result-box {
            font-size: 15px;
        }
    }

    @media (max-width: 400px) {
        .form-input {
            width: 100%;
        }
        .submit-button {
            width: 90%;
        }
    }
	
	
</style>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
        </tr>
        <tr>
            <td dir="ltr"><?php include('menu.php')?></td>
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
    // Basic validation for date format (YYYYMMDD)
    if (strlen($date) === 8 && is_numeric($date)) {
        $yy = substr($date, 0, 4);
        $mm = substr($date, 4, 2);
        $dd = substr($date, 6, 2);
        return $yy . '/' . $mm . '/' . $dd;
    }
    return ''; // Return empty string for invalid date
}

$birthdate = '';
$nationalid = '';

/**
 * Displays the search form.
 *
 * @param string $birthdate Pre-filled birthdate.
 * @param string $nationalid Pre-filled national ID.
 */
function displayForm($birthdate = '', $nationalid = '') {
    echo '<form action="" method="post" class="search-form">
            <div class="form-group">
                <label for="birthdate">تاریخ تولد:</label>
                <input type="text" name="birthdate" id="birthdate" value="'.htmlspecialchars($birthdate).'" placeholder="مثال: 13470522" class="form-input">
           </div>
            <div class="form-group">
                <label for="nationalid">کد ملی:</label>
                <input type="text" name="nationalid" id="nationalid" value="'.htmlspecialchars($nationalid).'" class="form-input">
            </div>
            <button type="submit" name="go" class="submit-button">جستجو</button>
          </form>';
}

/**
 * Displays the result of the web service call.
 *
 * @param array $result The result array from the web service.
 */
function displayResult($result) {
    if (isset($result['name']) && !empty($result['name'])) {
        echo '<div class="result-box success" dir="rtl">';
        echo '<p><strong>کد ملی:</strong> ' . htmlspecialchars($result['nin']) . '</p>';
        echo '<p><strong>نام:</strong> ' . htmlspecialchars($result['name']) . '</p>';
        echo '<p><strong>نام خانوادگی:</strong> ' . htmlspecialchars($result['family']) . '</p>';
        echo '<p><strong>نام پدر:</strong> ' . htmlspecialchars($result['fatherName']) . '</p>';
        echo '<p><strong>شماره شناسنامه:</strong> ' . htmlspecialchars($result['shenasnameNo']) . '</p>';

        // Determine gender
        $gender = (isset($result['gender']) && $result['gender'] == 1) ? 'مرد' : 'زن';
        echo '<p><strong>جنسیت:</strong> ' . htmlspecialchars($gender) . '</p>';

        // Convert birthdate
        $formattedBirthDate = isset($result['birthDate']) ? convertDate($result['birthDate']) : 'نامشخص';
        echo '<p><strong>تاریخ تولد:</strong> ' . htmlspecialchars($formattedBirthDate) . '</p>';

        // Determine life status
        $live = (isset($result['deathStatus']) && $result['deathStatus'] == 0) ? 'زنده' : 'فوت شده';
        echo '<p><strong>وضعیت حیات:</strong> ' . htmlspecialchars($live) . '</p>';
        echo '</div>';
    } else {
        echo '<div class="result-box error" dir="rtl">فردی با مشخصات فوق یافت نشد.</div>';
    }
}

// نمایش فرم جستجو با مقادیر وارد شده
displayForm($birthdate, $nationalid);

// بررسی ارسال فرم
if (isset($_POST['go'])) {
    $birthdate = trim($_POST['birthdate']);
    $nationalid = trim($_POST['nationalid']);

    // بررسی معتبر بودن ورودی‌ها
    if (empty($birthdate) || empty($nationalid)) {
        echo '<div dir="rtl" class="result-box error">لطفاً تمام فیلدها را پر کنید.</div>';
    } else {
        // درخواست به وب‌سرویس
        // Assuming webservice() function is available (e.g., from included files)
        if (function_exists('webservice')) {
            $result = webservice($birthdate, $nationalid);
            displayResult($result);
        } else {
            echo '<div dir="rtl" class="result-box error">خطا: تابع وب‌سرویس در دسترس نیست.</div>';
        }
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
