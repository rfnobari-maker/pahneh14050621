<?php 
session_start();

// بررسی وجود کد ملی موقت در session
if (!isset($_SESSION['temp_bah_cod_m']) || !isset($_SESSION['temp_num_bah'])) {
    $_SESSION['login_error'] = "لطفاً ابتدا کد ملی خود را وارد کنید.";
    header("Location: login.php");
    exit;
}

$error = isset($_SESSION['otp_error']) ? $_SESSION['otp_error'] : null;
unset($_SESSION['otp_error']);

// شمارنده تلاش‌های مجدد
if (!isset($_SESSION['otp_attempts'])) {
    $_SESSION['otp_attempts'] = 0;
}
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>تأیید کد - سامانه بهره‌برداران</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, 'Tahoma', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .verify-container {
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .verify-header {
            background: linear-gradient(135deg, #1a472a 0%, #2d5a3c 100%);
            color: white;
            padding: 35px 20px;
            text-align: center;
            position: relative;
        }
        
        .verify-header::before {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 20px;
            background: white;
            border-radius: 20px 20px 0 0;
        }
        
        .verify-header i {
            font-size: 56px;
            margin-bottom: 15px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .verify-header h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .verify-header p {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .verify-body {
            padding: 40px 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
            text-align: center;
        }
        
        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            display: block;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .otp-input {
            text-align: center;
            font-size: 32px !important;
            font-weight: bold;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
            height: 70px !important;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            transition: all 0.3s ease;
            direction: ltr;
        }
        
        .otp-input:focus {
            border-color: #2d5a3c;
            box-shadow: 0 0 0 0.2rem rgba(45, 90, 60, 0.25);
            outline: none;
        }
        
        .btn-verify {
            height: 52px;
            font-size: 18px;
            font-weight: bold;
            background: linear-gradient(135deg, #2d5a3c, #1a472a);
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-verify:hover:not(:disabled) {
            background: linear-gradient(135deg, #1e4a2e, #0e331f);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-verify:active:not(:disabled) {
            transform: translateY(0);
        }
        
        .btn-verify:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .btn-resend {
            background: transparent;
            border: 2px solid #2d5a3c;
            color: #2d5a3c;
            height: 45px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .btn-resend:hover:not(:disabled) {
            background: #2d5a3c;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-resend:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .timer-text {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }
        
        .alert {
            border-radius: 12px;
            text-align: right;
        }
        
        .footer-text {
            font-size: 12px;
            color: #888;
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            line-height: 1.7;
        }
        
        @media (max-width: 576px) {
            .verify-body {
                padding: 30px 20px;
            }
            
            .otp-input {
                font-size: 24px !important;
                height: 60px !important;
                letter-spacing: 4px;
            }
        }
        
        input[type="text"]::-webkit-outer-spin-button,
        input[type="text"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        input[type="text"] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body>

<div class="verify-container">
    <div class="verify-header">
        <i class="fas fa-seedling"></i>
        <h2>تأیید هویت</h2>
        <p>کد ارسال شده به شماره همراه خود را وارد کنید</p>
    </div>

    <div class="verify-body">
        
        <!-- نمایش پیام خطا -->
        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle ml-2"></i>
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        
        <!-- نمایش پیام موفقیت برای ارسال مجدد -->
        <?php if (isset($_SESSION['resend_success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle ml-2"></i>
                <?php 
                echo htmlspecialchars($_SESSION['resend_success']); 
                unset($_SESSION['resend_success']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        
        <form action="dashboard.php" method="POST" id="verifyForm">
            <div class="form-group">
                <label>
                    <i class="fas fa-lock ml-2"></i>
                    کد تأیید ۶ رقمی
                </label>
                
                <input type="text" 
                       name="otp" 
                       id="otp" 
                       maxlength="6" 
                       class="form-control otp-input" 
                       placeholder="●●●●●●" 
                       required 
                       autofocus
                       inputmode="numeric"
                       pattern="\d{6}"
                       title="لطفاً کد 6 رقمی را وارد کنید">
            </div>
            
            <button type="submit" class="btn btn-primary btn-block btn-verify" id="submitBtn">
                <i class="fas fa-check-circle"></i> تأیید و ورود به داشبورد
            </button>
        </form>
        
        <div class="text-center mt-4">
            <button type="button" class="btn btn-resend" id="resendBtn" onclick="resendOTP()">
                <i class="fas fa-redo-alt"></i> ارسال مجدد کد
            </button>
            <div class="timer-text" id="timerText"></div>
        </div>
        
        <div class="text-center mt-3">
            <a href="login.php" class="text-muted">
                <i class="fas fa-arrow-right"></i> بازگشت به صفحه ورود
            </a>
        </div>

        <div class="footer-text">
            <i class="fas fa-shield-alt"></i> کد تأیید به مدت ۵ دقیقه معتبر می‌باشد
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// جلوگیری از ورود کاراکتر غیرعددی
const otpInput = document.getElementById('otp');
if (otpInput) {
    otpInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);
    });
}

// تایمر برای ارسال مجدد
let timerInterval;
let timeLeft = 90;

function startTimer() {
    const timerText = document.getElementById('timerText');
    const resendBtn = document.getElementById('resendBtn');
    
    if (!timerText || !resendBtn) return;
    
    const savedTime = localStorage.getItem('otp_timer');
    const savedTimestamp = localStorage.getItem('otp_timer_start');
    
    if (savedTime && savedTimestamp) {
        const elapsed = Math.floor((Date.now() - parseInt(savedTimestamp)) / 1000);
        timeLeft = Math.max(0, parseInt(savedTime) - elapsed);
    }
    
    if (timeLeft <= 0) {
        resendBtn.disabled = false;
        timerText.innerHTML = '✔️ می‌توانید کد جدید درخواست کنید';
        clearInterval(timerInterval);
        localStorage.removeItem('otp_timer');
        localStorage.removeItem('otp_timer_start');
        return;
    }
    
    resendBtn.disabled = true;
    updateTimerDisplay();
    
    timerInterval = setInterval(function() {
        timeLeft--;
        
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            resendBtn.disabled = false;
            timerText.innerHTML = '✔️ می‌توانید کد جدید درخواست کنید';
            localStorage.removeItem('otp_timer');
            localStorage.removeItem('otp_timer_start');
        } else {
            updateTimerDisplay();
            localStorage.setItem('otp_timer', timeLeft);
            localStorage.setItem('otp_timer_start', Date.now());
        }
    }, 1000);
}

function updateTimerDisplay() {
    const timerText = document.getElementById('timerText');
    if (timerText) {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerText.innerHTML = '<i class="fas fa-hourglass-half"></i> ارسال مجدد کد پس از ' + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    }
}

function resendOTP() {
    const resendBtn = document.getElementById('resendBtn');
    if (resendBtn.disabled) return;
    
    const originalText = resendBtn.innerHTML;
    resendBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> در حال ارسال...';
    resendBtn.disabled = true;
    
    fetch('resend-otp.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            timeLeft = 90;
            startTimer();
            
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success alert-dismissible fade show mt-3';
            alertDiv.innerHTML = '<i class="fas fa-check-circle ml-2"></i> کد جدید با موفقیت ارسال شد.<button type="button" class="close" data-dismiss="alert">×</button>';
            document.querySelector('.verify-body').insertBefore(alertDiv, document.querySelector('#verifyForm'));
            
            setTimeout(function() {
                $(alertDiv).alert('close');
            }, 5000);
            
            if (otpInput) {
                otpInput.value = '';
                otpInput.focus();
            }
        } else {
            throw new Error(data.message || 'خطا در ارسال مجدد کد');
        }
    })
    .catch(function(error) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger alert-dismissible fade show mt-3';
        alertDiv.innerHTML = '<i class="fas fa-exclamation-triangle ml-2"></i> ' + error.message + '<button type="button" class="close" data-dismiss="alert">×</button>';
        document.querySelector('.verify-body').insertBefore(alertDiv, document.querySelector('#verifyForm'));
        
        setTimeout(function() {
            $(alertDiv).alert('close');
        }, 5000);
        
        resendBtn.innerHTML = originalText;
        resendBtn.disabled = false;
    });
}

// جلوگیری از ارسال فرم خالی
document.getElementById('verifyForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    const otpValue = otpInput ? otpInput.value.trim() : '';
    
    if (otpValue.length !== 6 || !/^\d{6}$/.test(otpValue)) {
        e.preventDefault();
        
        let errorDiv = document.querySelector('.otp-error');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger mt-3 otp-error';
            errorDiv.style.fontSize = '14px';
            errorDiv.style.padding = '10px';
            document.getElementById('verifyForm').insertBefore(errorDiv, submitBtn);
        }
        errorDiv.innerHTML = '<i class="fas fa-exclamation-circle ml-2"></i> لطفاً کد 6 رقمی معتبر وارد کنید.';
        errorDiv.style.display = 'block';
        
        otpInput.focus();
        return false;
    }
    
    // غیرفعال کردن دکمه برای جلوگیری از ارسال چندباره
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> در حال بررسی...';
    
    return true;
});

// شروع تایمر هنگام لود صفحه
document.addEventListener('DOMContentLoaded', function() {
    startTimer();
    if (otpInput) otpInput.focus();
});
</script>
</body>
</html>