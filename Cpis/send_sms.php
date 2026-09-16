<?php
include '../lock_cp.php';
include ('../web/sms1.php');
$username = $_POST['username'] ;
$tel_m = $_POST['tel_m'] ;
$message_display = ""; // تعریف متغیر برای نمایش پیام

// بررسی و تغییر شماره تلفن به فرمت صحیح
if (strlen($tel_m) == 10) {
    $tel_m = '0' . $tel_m;
}

if (isset($_POST['action'])) {  
    $message = $_POST['message'];
    $tel_m = $_POST['tel_m'];

    if (strlen($message) >= 10) {
        $uid = uniqid();
        sendSMS($tel_m, $message . '(سامانه پهنه بندی/فرستنده پیام : ' . $PersName . ')', $uid);
        $message_display = 'پیام شما با موفقیت ارسال شد.';
    } else {
        $message_display = 'پیام ارسالی حداقل باید 10 کارکتر باشد.';
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <style>
        #send {
            font-family: Tahoma;
            color: #039;
            border-radius: 10px;
        }
        #send:hover {
            background-color: #FF6;
        }
        #notok {
            padding-top: 100px;
            color: #FFF;
            line-height: 200%;
            font-family: Tahoma;
            font-size: 16px;
            width: 200px;
        }
        #message-box {
            font-family: Tahoma;
            color: #900;
            font-size: 14px;
            padding: 10px;
            margin-top: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            text-align: center;
        }
        body {
            background-image: url(../files/mobile.png);
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
<div align="center">
<?php if (strlen($tel_m) == 11): ?>
    <form action="" method="post">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p><br />
            <input name="tel_m" type="text" style="width:90px" disabled="disabled" id="textfield" value="<?php echo $tel_m ?>" />
            : شماره <br /><br />
            <textarea name="message" style="direction:rtl; width:180px; height:125px; font-family:Tahoma; font-size:14px; color:#069" maxlength="150" placeholder="متن پیام شما"></textarea>
            <input type="hidden" name="tel_m" value="<?php echo $tel_m; ?>">
        </p>
        <p style="font-family: Tahoma; font-size: 10px; color: #900;">طول پیام حداکثر 150 کارکتر</p>
        <p>
            <input type="submit" id="send" name="action" value="ارسال" style="width:100px; height:30px" tabindex="39" />
        </p>
    </form>
<?php else: ?>
    <div id="notok">
        امکان ارسال پیامک مقدور نیست
        <p>شماره تلفن همراه، کاربر مورد نظر معتبر نمی باشد.</p>
    </div>
<?php endif; ?>
<button id="send" onclick="window.close()">انصراف</button>

<?php if (!empty($message_display)): ?>
    <div id="message-box"><?php echo $message_display; ?></div>
<?php endif; ?>
</div>
</body>
</html>
