
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../FA.css" rel="stylesheet" type="text/css" />
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
            display: none;
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
         <input type="text" id="username" name="username" required placeholder="نام کاربری" />
        <!-- بخش کپچا -->
        <div style="margin: 10px 0;">
            <img border="0" id="captcha" src="image.php" alt="کپچا">
            <a href="JavaScript: new_captcha();">
                <img border="0" alt="تازه‌سازی" src="refresh.png" align="bottom" style="cursor: pointer;">
            </a>
        </div>
          <input type="text" id="security_code" name="security_code" required placeholder="کد امنیتی" />
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
        const security_code = document.getElementById('security_code').value;

        if (username && security_code) {
            fetch('send_code.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ username, security_code })
            })
            .then(response => response.text())
            .then(data => {
                if (data === "کد امنیتی صحیح است.") {
                    showMessage("کد تایید ارسال شد.", false);
                    document.getElementById('usernameForm').style.display = 'none'; 
                    document.getElementById('codeForm').style.display = 'block'; 
                } else {
                    showMessage(data, true);
                }
            })
            .catch(error => {
                showMessage('خطا در ارسال کد تایید', true);
            });
        } else {
            showMessage('لطفا نام کاربری و کد امنیتی را وارد کنید', true);
        }
    }

    function new_captcha() {
        const c_currentTime = new Date();
        const c_milliseconds = c_currentTime.getTime();
        document.getElementById('captcha').src = 'image.php?x=' + c_milliseconds;
    }
</script>
</body>
</html>
