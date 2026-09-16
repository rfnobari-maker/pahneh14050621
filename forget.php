<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="FA.css" rel="stylesheet" type="text/css" />

    <script src="./assets/js/jquery-3.6.0.min.js"></script>

    <style>
        /*
         * استایل‌های جدید برای هماهنگی با صفحه لاگین
         * این استایل‌ها به جای استایل‌های قدیمی در فایل forget.php قرار گرفته‌اند
         */
        :root {
            --primary-color: #2980b9;
            --secondary-color: #2c3e50;
            --card-background: #ffffff;
            --error-color: #e74c3c;
            --input-border: #bdc3c7;
            --placeholder-color: #7f8c8d;
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background: var(--card-background); /* پس‌زمینه سفید برای هماهنگی با Modal والد */
            direction: rtl;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: var(--secondary-color);
            font-size: 20px;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            max-width: 300px;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid var(--input-border);
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #f7f9fb;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(41, 128, 185, 0.3);
        }

        button {
            width: 100%;
            max-width: 300px;
            padding: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-family: 'Vazirmatn', sans-serif;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #21618c;
            transform: translateY(-2px);
        }

        .message {
            margin-top: 20px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            display: none;
        }

        .error {
            color: var(--error-color);
            background-color: #fdeded;
            border: 1px solid var(--error-color);
        }

        .success {
            color: green;
            background-color: #e9f5e9;
            border: 1px solid green;
        }

        /* افکت انیمیشن برای نمایش فرم */
        .fade-in {
          animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
          from { opacity: 0; transform: translateY(10px); }
          to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <h2>بازیابی کلمه عبور</h2>
    <form id="usernameForm">
        <input type="text" id="username" name="username" required placeholder="نام کاربری"  />
        <button type="submit">ارسال کد تایید</button>
    </form>
    <form id="codeForm" style="display:none;">
        <input type="text" id="verificationCode" name="verificationCode" required placeholder="کد تایید" />
        <button type="submit">تأیید کد</button>
    </form>
    <form id="passwordForm" style="display:none;">
        <input type="password" id="newPassword" name="newPassword" required placeholder="کلمه عبور جدید" />
        <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="تکرار کلمه عبور جدید" />
        <button type="submit">تغییر کلمه عبور</button>
    </form>
    <div class="message" id="message"></div>

<script>
    // توابع JavaScript
    function showMessage(msg, isError = true) {
        const messageDiv = document.getElementById('message');
        messageDiv.innerHTML = msg;
        messageDiv.className = 'message ' + (isError ? 'error' : 'success');
        messageDiv.style.display = 'block';
    }

    function sendUsername() {
        const username = document.getElementById('username').value;
        if (username) {
            fetch('send_code.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ username })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showMessage(`${data.message} زمان اعتبار: <span id="timer">${data.expires_in}</span> ثانیه`, false);
                    document.getElementById('usernameForm').style.display = 'none';
                    document.getElementById('codeForm').style.display = 'block';
                    document.getElementById('codeForm').classList.add('fade-in');
                    startCountdown(data.expires_in);
                } else {
                    showMessage(data.message, true);
                }
            })
            .catch(error => showMessage('خطا در ارسال کد تایید', true));
        } else {
            showMessage('لطفا نام کاربری را وارد کنید', true);
        }
    }
    
    // کنترل فرم اول
    document.getElementById('usernameForm').addEventListener('submit', function(event) {
        event.preventDefault();
        sendUsername();
    });

    function startCountdown(duration) {
        let timerElement = document.getElementById('timer');
        let timeLeft = duration;

        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(countdown);
                showMessage("اعتبار کد ارسالی منقضی شد", true);
            }
        }, 1000);
    }

    function verifyCode() {
        const verificationCode = document.getElementById('verificationCode').value;

        if (verificationCode) {
            fetch('verify_code.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ verificationCode })
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "کد تأیید صحیح است.") {
                    showMessage(data, false);
                    document.getElementById('codeForm').style.display = 'none';
                    document.getElementById('passwordForm').style.display = 'block';
                    document.getElementById('passwordForm').classList.add('fade-in');
                } else {
                    showMessage(data, true);
                }
            })
            .catch(error => showMessage('خطا در تأیید کد', true));
        } else {
            showMessage('لطفا کد تایید را وارد کنید', true);
        }
    }
    
    // کنترل فرم دوم
    document.getElementById('codeForm').addEventListener('submit', function(event) {
        event.preventDefault();
        verifyCode();
    });

    function validatePassword(password) {
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumbers = /\d/.test(password);
        const isValidLength = password.length >= 8;

        return hasUpperCase && hasLowerCase && hasNumbers && isValidLength;
    }

    function resetPassword() {
        const newPassword = $('#newPassword').val();
        const confirmPassword = $('#confirmPassword').val();
        const username = $('#username').val();

        if (newPassword && confirmPassword) {
            if (!validatePassword(newPassword)) {
                showMessage('کلمه عبور جدید باید حداقل 8 کاراکتر، شامل حروف بزرگ، حروف کوچک و اعداد باشد.', true);
                return;
            }

            if (newPassword === confirmPassword) {
                fetch("reset_password.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ newPassword, username })
                })
                .then(response => response.text())
                .then(data => {
                    showMessage(data, false);
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Error: " + error);
                    showMessage('خطا در تغییر کلمه عبور: ' + error, true);
                });
            } else {
                showMessage('کلمه عبور جدید و تکرار آن مطابقت ندارد.', true);
            }
        } else {
            showMessage('لطفا کلمه عبور جدید و تکرار آن را وارد کنید', true);
        }
    }
    
    // کنترل فرم سوم
    document.getElementById('passwordForm').addEventListener('submit', function(event) {
        event.preventDefault();
        resetPassword();
    });
</script>
</body>
</html>