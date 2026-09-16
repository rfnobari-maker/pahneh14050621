<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="FA.css" rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background: white;
            margin: 0;
            padding: 0;
        }

        .overlay {
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
        }

        .modal {
            background: white;
            padding: 30px;
            width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 85%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 85%;
            margin-top: 10px;
			font-family:myfont2
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 20px;
            font-size: 16px; 
            display: none; /* پنهان کردن پیام به‌طور پیش‌فرض */
        }

        .error {
            color: red; 
        }

        .success {
            color: green; 
        }
    </style>
</head>
<body>

<div class="overlay" id="overlay">
    <div class="modal">
        <h2>بازیابی کلمه عبور</h2>
        <form id="usernameForm">
            <input type="text" id="username" name="username" required placeholder="نام کاربری"  />
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
        messageDiv.style.display = 'block'; // نمایش پیام
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
            .then(response => response.text())
            .then(data => {
                showMessage(data, true);
                document.getElementById('usernameForm').style.display = 'none'; 
                document.getElementById('codeForm').style.display = 'block'; 
            })
            .catch(error => showMessage('خطا در ارسال کد تایید', true));
        } else {
            showMessage('لطفا نام کاربری را وارد کنید', true);
        }
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
            // ارسال درخواست AJAX برای تغییر کلمه عبور
            fetch("reset_password.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ newPassword, username })
            })
            .then(response => response.text()) // پاسخ را به فرمت متن دریافت کنید
            .then(data => {
                showMessage(data, false); // نمایش پیام موفقیت
              //  setTimeout(() => {
              //  $('#overlay').hide(); // بستن پنجره بعد از 2 ثانیه
              //   }, 3000);
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error: " + error); // نمایش خطای احتمالی در `alert`
                showMessage('خطا در تغییر کلمه عبور: ' + error, true);
            });
        } else {
            showMessage('کلمه عبور جدید و تکرار آن مطابقت ندارد.', true);
        }
    } else {
        showMessage('لطفا کلمه عبور جدید و تکرار آن را وارد کنید', true);
    }
}

function showMessage(msg, isError = true) {
    const messageDiv = document.getElementById('message');
    messageDiv.textContent = msg;
    messageDiv.className = 'message ' + (isError ? 'error' : 'success');
    messageDiv.style.display = 'block'; // نمایش پیام
}

function validatePassword(password) {
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);
    const hasNumbers = /\d/.test(password);
    const isValidLength = password.length >= 8;

    return hasUpperCase && hasLowerCase && hasNumbers && isValidLength;
}
</script>
</body>
</html>
