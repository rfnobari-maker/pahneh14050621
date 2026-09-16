<?php
session_start(); // اطمینان از شروع سشن

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // دریافت داده‌ها
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $captcha = isset($_POST['captcha']) ? trim($_POST['captcha']) : '';

    // بررسی اینکه نام کاربری و کپچا وارد شده‌اند
    if (empty($username) || empty($captcha)) {
        echo "لطفاً نام کاربری و کد کپچا را وارد کنید.";
        exit();
    }

    // بررسی کد کپچا
  if (isset($_SESSION['captcha_text']) && strtoupper($captcha) == strtoupper($_SESSION['captcha_text'])) {
        // کد کپچا صحیح است
        echo "کپچا به درستی وارد شد.";
        
        // می‌توانید کدهای مربوط به تایید کد یا تغییر رمز عبور را اینجا اضافه کنید
    } else {
        // کد کپچا اشتباه است
        echo "کد کپچا اشتباه است.";
    }

    exit();
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="FA.css" rel="stylesheet" type="text/css" />
    <script src="./assets/js/jquery-3.6.0.min.js"></script>

    <style>
        /* استایل‌های فرم */
        body { background: white; margin: 0; padding: 0; }
        .overlay { position: fixed; display: flex; justify-content: center; align-items: center; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); z-index: 1000; }
        .modal { background: white; padding: 30px; width: 400px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); text-align: center; }
        input[type="text"], input[type="password"] { width: 85%; padding: 12px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; font-size: 16px; }
        button { background-color: #007bff; color: white; border: none; padding: 12px; border-radius: 4px; font-size: 16px; cursor: pointer; width: 85%; margin-top: 10px; font-family:myfont2; }
        button:hover { background-color: #0056b3; }
        .message { margin-top: 20px; font-size: 16px; display: none; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

<div class="overlay" id="overlay">
    <div class="modal">
        <h2>بازیابی کلمه عبور</h2>
        <form id="usernameForm">
            <input type="text" id="username" name="username" required placeholder="نام کاربری" />
            <label for="captcha">کد امنیتی را وارد کنید:</label>
       <img src="captcha.php" alt="Captcha Image" onclick="this.src='captcha.php?'+Math.random();" title="برای بارگذاری مجدد کلیک کنید"><br>
            <input type="text" id="captcha" name="captcha" required placeholder="کد کپچا" />
            <button type="button" onclick="sendUsername()">ارسال کد تایید</button>
        </form>

        <form id="codeForm" style="display:none;">
            <input type="text" id="verificationCode" name="verificationCode" required placeholder="کد تایید" />
            <button type="button" onclick="verifyCode()">تأیید کد</button>
        </form>

        <form id="passwordForm" style="display:none;">
            <input type="password" id="newPassword" name="newPassword" required placeholder="کلمه عبور جدید" />
            <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="تکرار کلمه عبور جدید" />
            <button type="button" onclick="resetPassword()">تغییر کلمه عبور</button>
        </form>

        <div class="message" id="message"></div>
    </div>
</div>

<script>
    function showMessage(msg, isError = true) {
        const messageDiv = document.getElementById('message');
        messageDiv.textContent = msg;
        messageDiv.className = 'message ' + (isError ? 'error' : 'success');
        messageDiv.style.display = 'block';
    }

    function sendUsername() {
        const username = document.getElementById('username').value;
        const captcha = document.getElementById('captcha').value;

        if (username && captcha) {
fetch('forget.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `username=${encodeURIComponent(username)}&captcha=${encodeURIComponent(captcha)}`
})
.then(response => response.text())
.then(data => {
    if (data.includes("کپچا به درستی وارد شد")) {
        showMessage("کپچا صحیح است. لطفاً کد تایید را وارد کنید.", false);
        document.getElementById('usernameForm').style.display = 'none';
        document.getElementById('codeForm').style.display = 'block';
    } else {
        showMessage("کد کپچا اشتباه است.", true);
    }
})
.catch(error => {
    console.error('خطا در ارسال اطلاعات:', error);
    showMessage('خطا در ارسال اطلاعات', true);
});
        } else {
            alert("لطفاً نام کاربری و کد کپچا را وارد کنید.");
        }
    }

    function verifyCode() {
        const verificationCode = document.getElementById('verificationCode').value;
        if (verificationCode) {
            fetch('verify_code.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ verificationCode })
            })
            .then(response => response.text())
            .then(data => {
                if (data === "کد تأیید صحیح است.") {
                    showMessage(data, false);
                    document.getElementById('codeForm').style.display = 'none';
                    document.getElementById('passwordForm').style.display = 'block';
                } else {
                    showMessage(data, true);
                }
            })
            .catch(error => showMessage('خطا در تأیید کد', true));
        } else {
            showMessage('لطفا کد تایید را وارد کنید', true);
        }
    }

    function resetPassword() {
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const username = document.getElementById('username').value;

        if (newPassword && confirmPassword) {
            if (newPassword === confirmPassword) {
                fetch("reset_password.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ newPassword, username })
                })
                .then(response => response.text())
                .then(data => showMessage(data, false))
                .catch(error => showMessage('خطا در تغییر کلمه عبور: ' + error, true));
            } else {
                showMessage('کلمه عبور جدید و تکرار آن مطابقت ندارد.', true);
            }
        } else {
            showMessage('لطفا کلمه عبور جدید و تکرار آن را وارد کنید', true);
        }
    }
</script>
</body>
</html>
