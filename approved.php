<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="FA.css" rel="stylesheet" type="text/css" />
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: white;
            margin: 0;
            padding: 0;
            font-family: Tahoma, Arial, sans-serif;
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
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        textarea {
            width: 85%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            font-family: Tahoma, Arial, sans-serif;
        }

        button {
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 85%;
            margin-top: 10px;
            font-family: Tahoma, Arial, sans-serif;
            transition: background-color 0.3s;
        }

        .approve-btn {
            background-color: #28a745; /* سبز */
        }

        .approve-btn:hover {
            background-color: #218838;
        }

        .reject-btn {
            background-color: #dc3545; /* قرمز */
        }

        .reject-btn:hover {
            background-color: #c82333;
        }

        .send-btn {
            background-color: #007bff; /* آبی */
        }

        .send-btn:hover {
            background-color: #0069d9;
        }

        .verify-btn {
            background-color: #17a2b8; /* فیروزه‌ای */
        }

        .verify-btn:hover {
            background-color: #138496;
        }

        .message {
            margin-top: 20px;
            font-size: 16px;
            padding: 10px;
            border-radius: 4px;
            display: none;
        }

        .error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        .success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .reason-input {
            display: none;
            margin-top: 15px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            width: 85%;
            margin: 15px auto 0;
        }

        .button-container button {
            width: 48%;
            margin-top: 0;
        }

        #timer {
            font-weight: bold;
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="overlay" id="overlay">
    <div class="modal">
        <h2>تایید یا عدم تایید درخواست</h2>
        <form id="usernameForm">
            <input type="text" id="username" name="username" required placeholder="نام کاربری" />
            <button type="button" class="send-btn" onclick="sendUsername()">ارسال کد تایید</button>
        </form>
        <form id="codeForm" style="display:none;">
            <input type="text" id="verificationCode" name="verificationCode" required placeholder="کد تایید" />
            <button type="button" class="verify-btn" onclick="verifyCode()">تأیید کد</button>
        </form>
        <div id="approvalSection" style="display:none;">
            <div class="button-container">
                <button class="approve-btn" onclick="approveRequest()">تایید</button>
                <button class="reject-btn" onclick="showReasonInput()">عدم تایید</button>
            </div>
            <textarea id="rejectReason" class="reason-input" placeholder="لطفاً دلیل عدم تایید را وارد کنید"></textarea>
            <button id="submitReject" class="reject-btn" style="display:none; width:85%;" onclick="rejectRequest()">ثبت عدم تایید</button>
        </div>
        <div class="message" id="message"></div>
    </div>
</div>

<script>
    function showMessage(msg, isError = true) {
        const messageDiv = document.getElementById('message');
        messageDiv.innerHTML = msg;
        messageDiv.className = 'message ' + (isError ? 'error' : 'success');
        messageDiv.style.display = 'block';
    }

    function sendUsername() {
        const username = document.getElementById('username').value.trim();

        if (username) {
            // شبیه‌سازی ارسال به سرور - در عمل باید به جای این از fetch استفاده کنید
            showMessage('کد تایید ارسال شد. زمان اعتبار: <span id="timer">120</span> ثانیه', false);
            
            document.getElementById('usernameForm').style.display = 'none';
            document.getElementById('codeForm').style.display = 'block';
            
            // شروع شمارش معکوس
            startCountdown(120);
        } else {
            showMessage('لطفا نام کاربری را وارد کنید', true);
        }
    }

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
        const verificationCode = document.getElementById('verificationCode').value.trim();

        if (verificationCode) {
            // شبیه‌سازی تأیید کد - در عمل باید به جای این از fetch استفاده کنید
            showMessage('کد تأیید صحیح است.', false);
            document.getElementById('codeForm').style.display = 'none';
            document.getElementById('approvalSection').style.display = 'block';
        } else {
            showMessage('لطفا کد تایید را وارد کنید', true);
        }
    }

    function showReasonInput() {
        document.getElementById('rejectReason').style.display = 'block';
        document.getElementById('submitReject').style.display = 'block';
        document.querySelector('.button-container').style.display = 'none';
    }

    function approveRequest() {
        // شبیه‌سازی تایید درخواست - در عمل باید به جای این از fetch استفاده کنید
        showMessage('درخواست با موفقیت تایید شد.', false);
        setTimeout(() => {
            $('#overlay').hide();
        }, 2000);
    }

    function rejectRequest() {
        const reason = document.getElementById('rejectReason').value.trim();
        
        if (!reason) {
            showMessage('لطفاً دلیل عدم تایید را وارد کنید', true);
            return;
        }

        // شبیه‌سازی عدم تایید درخواست - در عمل باید به جای این از fetch استفاده کنید
        showMessage('درخواست با موفقیت رد شد. دلیل: ' + reason, false);
        setTimeout(() => {
            $('#overlay').hide();
        }, 2000);
    }
</script>
</body>
</html>