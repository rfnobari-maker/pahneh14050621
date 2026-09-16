<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
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
           background: rgba(0, 0, 0, 0.6);
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
<?php 
include('../../event.php');
$id_ostan = $_GET['id_ostan'] ; 
$username =  $_GET['username'] ; 
$z_sal =  $_GET['z_sal'] ; 
?>
<div class="overlay" id="overlay">
    <div class="modal">
        <h2 style="color:#900">بررسی اطلاعات استان  : <?php echo ostan_name($id_ostan) ; ?></h2>
        <form id="usernameForm">
            <input style="text-align:center ; color:#333 ; font-size:18px" type="text" id="username" name="username" value="<?php echo $username ; ?>" readonly  />
            <button type="button" class="send-btn" onclick="sendUsername()">ارسال کد تایید</button>
        </form>
        <form id="codeForm" style="display:none;">
            <input style="text-align:center ; font-size:20px ; color:#096" type="text" id="verificationCode" name="verificationCode" required placeholder="کد تایید" />
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
            fetch('../../send_code.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ username: username })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showMessage(`${data.message} زمان اعتبار: <span id="timer">${data.expires_in || 120}</span> ثانیه`, false);
                    
                    document.getElementById('usernameForm').style.display = 'none';
                    document.getElementById('codeForm').style.display = 'block';
                    
                    // شروع شمارش معکوس
                    startCountdown(data.expires_in || 120);
                } else {
                    showMessage(data.message || 'خطا در ارسال کد تایید', true);
                }
            })
            .catch(error => {
                showMessage('خطا در ارتباط با سرور', true);
                console.error('Error:', error);
            });
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
                // اگر approvalSection نمایش داده شد، پیام را مخفی کن
                if (document.getElementById('approvalSection').style.display === 'block') {
                    document.getElementById('message').style.display = 'none';
                }
            }
        }, 1000);
    }

    function verifyCode() {
        const verificationCode = document.getElementById('verificationCode').value;
        if (verificationCode) {
            fetch('../../verify_code.php', {
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
                    document.getElementById('approvalSection').style.display = 'block'; 
                    // مخفی کردن پیام پس از نمایش دکمه‌های تایید و عدم تایید
                    document.getElementById('message').style.display = 'none';
                } else {
                    showMessage(data, true);
                }
            })
            .catch(error => showMessage('خطا در تأیید کد', true));
        } else {
            showMessage('لطفا کد تایید را وارد کنید', true);
        }
    }
    // جلوگیری از رفرش شدن فرم کد تایید هنگام زدن Enter
    document.getElementById('codeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        verifyCode();
    });

    function showReasonInput() {
        document.getElementById('rejectReason').style.display = 'block';
        document.getElementById('submitReject').style.display = 'block';
        document.querySelector('.button-container').style.display = 'none';
    }

    function approveRequest() {
        const username = document.getElementById('username').value;
        const id_ostan = '<?php echo $id_ostan; ?>';
        const z_sal = '<?php echo $z_sal; ?>';
        const reason = document.getElementById('reason')?.value || '';
        fetch('approve_request.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                username: username,
                id_ostan: id_ostan,
                z_sal: z_sal,
                action: 'approve',
                reason: reason
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showMessage(data.message, false);
                // مکث 2 ثانیه قبل از بستن modal والد و رفرش صفحه
                setTimeout(function() {
                    if (window.parent && typeof window.parent.closeModal === 'function') {
                        window.parent.closeModal();
                        // رفرش صفحه والد
                        window.parent.location.reload();
                    }
                }, 2000);
            } else {
                showMessage(data.message, true);
            }
        })
        .catch(error => showMessage('خطا در تایید درخواست', true));
    }

    function rejectRequest() {
        const username = document.getElementById('username').value;
        const reason = document.getElementById('rejectReason').value;
        const id_ostan = '<?php echo $id_ostan; ?>';
        const z_sal = '<?php echo $z_sal; ?>';
        if (!reason) {
            showMessage('لطفاً دلیل عدم تایید را وارد کنید', true);
            return;
        }
        fetch('approve_request.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                username: username,
                id_ostan: id_ostan,
                z_sal: z_sal,
                action: 'reject',
                reason: reason
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showMessage(data.message, false);
                // مکث 2 ثانیه قبل از بستن modal والد و رفرش صفحه
                setTimeout(function() {
                    if (window.parent && typeof window.parent.closeModal === 'function') {
                        window.parent.closeModal();
                        // رفرش صفحه والد
                        window.parent.location.reload();
                    }
                }, 2000);
            } else {
                showMessage(data.message, true);
            }
        })
        .catch(error => showMessage('خطا در عدم تایید درخواست', true));
    }
</script>
</body>
</html>