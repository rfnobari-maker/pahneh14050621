<?php
include('../lock_ce.php');
include('../web/ws_sabt1.php');
include("side_menu1.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <link href="../FA.css" rel="stylesheet" type="text/css" />
    <title><?php echo $title ;?></title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background: #f0f2f5;
            font-family: 'Tahoma', 'IranSans', sans-serif;
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
            color: #dc3545;
            font-style: italic;
            background: #f8d7da;
            padding: 12px;
            border-radius: 8px;
            margin: 10px 0;
            font-weight: bold;
        }
        .info-box {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            padding: 25px;
            margin: 20px auto;
            max-width: 550px;
            text-align: right;
            font-family: Tahoma, sans-serif;
            border-right: 6px solid #28a745;
        }
        .info-row {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            flex-wrap: wrap;
        }
        .info-label {
            font-weight: bold;
            width: 110px;
            color: #555;
        }
        .info-value {
            flex: 1;
            color: #333;
        }
        .status-alive {
            color: #28a745;
            font-weight: bold;
            background: #d4edda;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-block;
        }
        .status-dead {
            color: #dc3545;
            font-weight: bold;
            background: #f8d7da;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-block;
        }
        .status-martyr {
            color: #fd7e14;
            font-weight: bold;
            background: #fff3cd;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-block;
        }
        .status-unknown {
            color: #6c757d;
            font-weight: bold;
            background: #e9ecef;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-block;
        }
        .exception-box {
            background: #fff3cd;
            border-right: 5px solid #ffc107;
            padding: 12px;
            border-radius: 8px;
            margin-top: 15px;
            font-size: 13px;
        }
        .search-form {
            background: white;
            padding: 25px 35px;
            border-radius: 20px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            display: inline-block;
            text-align: center;
            margin-bottom: 20px;
        }
        .search-form input[type="text"] {
            font-size: 16px;
            color: #0066CC;
            font-family: Tahoma;
            width: 180px;
            height: 40px;
            padding: 5px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin: 5px;
        }
        .search-form input[type="submit"] {
            font-size: 16px;
            color: white;
            background: #0066CC;
            font-family: Tahoma;
            width: 100px;
            height: 45px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            margin-right: 10px;
        }
        .search-form input[type="submit"]:hover {
            background: #004999;
        }
        .style8 {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
        }
        .style2 {
            font-size: 11px;
            color: #888;
        }
        h3 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
            color: #2c3e50;
        }
    </style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
    </tr>
    <tr>
        <td><?php include('menu.php')?></td>
    </tr>
    <tr>
        <td height="500px">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" dir="rtl">
                <tr>
                    <td width="4">&nbsp;</td>
                    <td width="840">
                        <p class="style8">&nbsp;</p>
                        <p class="style8" align="center">استعلام مشخصات بهره بردار</p>
                        <p align="center"><img src="../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                        <div align="center" style="margin-top: 10px; font-family: tahoma; font-size: 16px">

                            <?php
                            // تابع تبدیل تاریخ
                            function convertDate($date) {
                                if (!$date || strlen($date) != 8) return 'نامشخص';
                                return substr($date, 0, 4) . '/' . substr($date, 4, 2) . '/' . substr($date, 6, 2);
                            }

                            // تابع نمایش جنسیت
                            function getGender($genderCode) {
                                if ($genderCode == 1) return 'مرد';
                                if ($genderCode == 2) return 'زن';
                                return 'نامشخص';
                            }

                            // تابع نمایش وضعیت حیات (اصلاح شده کامل)
                            function getLifeStatus($deathStatus, $message, $exceptionMessage) {
                                // بررسی شهادت
                                if (strpos($message, 'Martyr') !== false || strpos($exceptionMessage, 'martyr') !== false) {
                                    return '<span class="status-martyr">★ شهید</span>';
                                }
                                
                                // بررسی deathStatus
                                if ($deathStatus === 0 || $deathStatus === '0') {
                                    return '<span class="status-alive">✓ زنده</span>';
                                }
                                if ($deathStatus === 1 || $deathStatus === '1') {
                                    return '<span class="status-dead">✗ فوت شده</span>';
                                }
                                
                                // بررسی از روی پیام
                                if (!empty($message)) {
                                    if (strpos($message, 'فوت') !== false || strpos($message, 'death') !== false) {
                                        return '<span class="status-dead">✗ فوت شده</span>';
                                    }
                                }
                                
                                return '<span class="status-unknown">? نامشخص</span>';
                            }

                            // نمایش فرم جستجو
                            function displayForm($birthdate = '', $nationalid = '') {
                                echo '<div class="search-form">
                                    <form action="" method="post">
                                        <input type="text" name="birthdate" value="'.htmlspecialchars($birthdate).'" placeholder="مثال: 13470522">
                                        <span>: تاریخ تولد</span><br>
                                        <span class="style2">فرمت: 13470522</span><br><br>
                                        
                                        <input type="text" name="nationalid" value="'.htmlspecialchars($nationalid).'" placeholder="کد ملی 10 رقمی">
                                        <span>: کد ملی</span><br><br>
                                        
                                        <input type="submit" name="go" value="جستجو">
                                    </form>
                                </div>';
                            }

                            // نمایش اطلاعات
                            function displayResult($result) {
                                if (isset($result['error'])) {
                                    echo '<div class="error">❌ ' . htmlspecialchars($result['error']) . '</div>';
                                    return;
                                }
                                
                                if (!empty($result['name']) || !empty($result['nin'])) {
                                    echo '<div class="info-box">';
                                    echo '<h3>📋 اطلاعات هویتی</h3>';
                                    
                                    echo '<div class="info-row"><div class="info-label">کد ملی:</div><div class="info-value">' . htmlspecialchars($result['nin']) . '</div></div>';
                                    echo '<div class="info-row"><div class="info-label">نام:</div><div class="info-value">' . htmlspecialchars($result['name']) . '</div></div>';
                                    echo '<div class="info-row"><div class="info-label">نام خانوادگی:</div><div class="info-value">' . htmlspecialchars($result['family']) . '</div></div>';
                                    echo '<div class="info-row"><div class="info-label">نام پدر:</div><div class="info-value">' . htmlspecialchars($result['fatherName']) . '</div></div>';
                                    echo '<div class="info-row"><div class="info-label">شماره شناسنامه:</div><div class="info-value">' . htmlspecialchars($result['shenasnameNo']) . '</div></div>';
                                    echo '<div class="info-row"><div class="info-label">جنسیت:</div><div class="info-value">' . getGender($result['gender']) . '</div></div>';
                                    echo '<div class="info-row"><div class="info-label">تاریخ تولد:</div><div class="info-value">' . convertDate($result['birthDate']) . '</div></div>';
                                    echo '<div class="info-row"><div class="info-label">وضعیت حیات:</div><div class="info-value">' . getLifeStatus($result['deathStatus'], $result['message'], $result['exceptionMessage']) . '</div></div>';
                                    
                                    if (!empty($result['officeCode'])) {
                                        echo '<div class="info-row"><div class="info-label">کد اداره:</div><div class="info-value">' . htmlspecialchars($result['officeCode']) . '</div></div>';
                                    }
                                    if (!empty($result['bookNo'])) {
                                        echo '<div class="info-row"><div class="info-label">شماره مجلد:</div><div class="info-value">' . htmlspecialchars($result['bookNo']) . '</div></div>';
                                    }
                                    
                                    // نمایش پیام‌های استثنا
                                    if (!empty($result['exceptionMessage'])) {
                                        echo '<div class="exception-box"><strong>⚠️ نکته:</strong><br>' . htmlspecialchars($result['exceptionMessage']) . '</div>';
                                    }
                                    if (!empty($result['message']) && $result['message'] != 'OK' && empty($result['exceptionMessage'])) {
                                        echo '<div class="exception-box"><strong>📢 پیام:</strong><br>' . htmlspecialchars($result['message']) . '</div>';
                                    }
                                    
                                    echo '</div>';
                                } else {
                                    echo '<div class="error">⚠️ فردی با مشخصات فوق یافت نشد</div>';
                                }
                            }

                            // پردازش فرم
                            $birthdate = '';
                            $nationalid = '';
                            if (isset($_POST['go'])) {
                                $birthdate = trim($_POST['birthdate']);
                                $nationalid = trim($_POST['nationalid']);

                                if (empty($birthdate) || empty($nationalid)) {
                                    echo '<div class="error">لطفاً تمام فیلدها را پر کنید</div>';
                                    displayForm($birthdate, $nationalid);
                                } elseif (!preg_match('/^\d{8}$/', $birthdate)) {
                                    echo '<div class="error">فرمت تاریخ تولد صحیح نیست (باید 8 رقم باشد)</div>';
                                    displayForm($birthdate, $nationalid);
                                } elseif (!preg_match('/^\d{10}$/', $nationalid)) {
                                    echo '<div class="error">کد ملی باید 10 رقم باشد</div>';
                                    displayForm($birthdate, $nationalid);
                                } else {
                                    $result = webservice($birthdate, $nationalid);
                                    displayResult($result);
                                    displayForm($birthdate, $nationalid);
                                }
                            } else {
                                displayForm();
                            }
                            ?>

                        </div>
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
