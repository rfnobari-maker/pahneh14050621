<?php 
session_start();

// نمایش پیام خطا اگر وجود داشته باشد
$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : null;
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ورود به سامانه بهره‌برداران</title>
    
    <link rel="stylesheet" href="assets/bootstrap/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    
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
        
        .login-container {
            max-width: 480px;
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
        
        .login-header {
            background: linear-gradient(135deg, #1a472a 0%, #2d5a3c 100%);
            color: white;
            padding: 35px 20px;
            text-align: center;
            position: relative;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 20px;
            background: white;
            border-radius: 20px 20px 0 0;
        }
        
        .login-header i {
            font-size: 56px;
            margin-bottom: 15px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .login-header h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .login-header p {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
            text-align: right;
        }
        
        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
            text-align: right;
        }
        
        .input-group {
            position: relative;
            direction: ltr;
        }
        
        .input-group-prepend .input-group-text,
        .input-group-append .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e0e0e0;
        }
        
        .input-group-prepend .input-group-text {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }
        
        .input-group-append .input-group-text {
            border-right: none;
            border-radius: 12px 0 0 12px;
        }
        
        .form-control {
            height: 52px;
            font-size: 16px;
            direction: ltr;
            text-align: center;
            letter-spacing: 2px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #2d5a3c;
            box-shadow: 0 0 0 0.2rem rgba(45, 90, 60, 0.25);
        }
        
        /* استایل برای اعداد */
        .form-control[dir="ltr"] {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            font-size: 18px;
        }
        
        .btn-login {
            height: 52px;
            font-size: 18px;
            font-weight: bold;
            background: linear-gradient(135deg, #2d5a3c, #1a472a);
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-login:hover:not(:disabled) {
            background: linear-gradient(135deg, #1e4a2e, #0e331f);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-login:active:not(:disabled) {
            transform: translateY(0);
        }
        
        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .alert-danger {
            border-radius: 12px;
            border-right: 4px solid #dc3545;
            background-color: #fff5f5;
            margin-bottom: 25px;
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
        
        .footer-text strong {
            color: #2d5a3c;
        }
        
        .spinner-border-sm {
            width: 1.2rem;
            height: 1.2rem;
            margin-left: 8px;
        }
        
        .form-text {
            text-align: right;
            margin-top: 5px;
        }
        
        @media (max-width: 576px) {
            .login-body {
                padding: 30px 20px;
            }
            
            .login-header h2 {
                font-size: 1.2rem;
            }
            
            .form-control {
                height: 48px;
                font-size: 14px;
            }
            
            .btn-login {
                height: 48px;
                font-size: 16px;
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
        
        .text-right {
            text-align: right;
        }
        
        /* نمایشگر نوع کد */
        .code-type-indicator {
            margin-top: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .code-type-indicator.personal {
            background: #e3f2fd;
            color: #1976d2;
        }
        
        .code-type-indicator.company {
            background: #fff3e0;
            color: #f57c00;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <i class="fas fa-seedling"></i>
        <h2>پورتال بهره‌برداران کشاورزی</h2>
        <p>سامانه پهنه‌بندی و مدیریت داده‌های کشاورزی</p>
    </div>

    <div class="login-body">
        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle ml-2"></i>
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        
        <form action="send-otp.php" method="POST" id="loginForm">
            <div class="form-group">
                <label>
                    <i class="fas fa-id-card ml-2"></i>
                    کد ملی / شناسه ملی
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-credit-card"></i>
                        </span>
                    </div>
                    <input type="text" 
                           name="bah_cod_m" 
                           id="bah_cod_m"
                           maxlength="11" 
                           class="form-control" 
                           placeholder="کد ملی یا شناسه ملی" 
                           required 
                           autofocus
                           inputmode="numeric"
                           dir="ltr">
                </div>
                <small class="form-text text-muted">
                    <i class="fas fa-info-circle"></i> 
                    کد ملی حقیقی (10 رقم) | شناسه ملی حقوقی (11 رقم)
                </small>
                
                <div id="codeTypeIndicator" class="code-type-indicator" style="display: none;">
                    <i class="fas fa-user"></i> 
                    <span id="codeTypeText"></span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-login mt-4" id="submitBtn">
                <i class="fas fa-paper-plane"></i> دریافت کد تأیید پیامکی
            </button>
        </form>

        <div class="footer-text">
            <i class="fas fa-headset"></i> <strong>پشتیبانی:</strong> ۰۲۱-۴۳۵۴۱۶۹۱<br>
            <i class="far fa-clock"></i> ساعات پاسخگویی: ۸ صبح تا ۱۶ عصر<br>
            کلیه حقوق مادی و معنوی این سامانه متعلق به <br>
            مرکز فناوری اطلاعات و ارتباطات وزارت جهاد کشاورزی می‌باشد.
        </div>
    </div>
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<script>
(function() {
    const form = document.getElementById('loginForm');
    const input = document.getElementById('bah_cod_m');
    const submitBtn = document.getElementById('submitBtn');
    const codeTypeIndicator = document.getElementById('codeTypeIndicator');
    const codeTypeText = document.getElementById('codeTypeText');
    
    // تشخیص نوع کد (10 یا 11 رقم)
    function detectCodeType(code) {
        code = code.trim();
        if (/^\d{10}$/.test(code)) {
            return { type: 'personal', text: 'کد ملی حقیقی (10 رقم)', icon: 'fa-user' };
        } else if (/^\d{11}$/.test(code)) {
            return { type: 'company', text: 'شناسه ملی حقوقی (11 رقم)', icon: 'fa-building' };
        }
        return null;
    }
    
    // به‌روزرسانی نمایشگر نوع کد
    function updateCodeTypeIndicator() {
        const code = input.value;
        if (code.length >= 8) {
            const detection = detectCodeType(code);
            if (detection) {
                codeTypeIndicator.style.display = 'block';
                codeTypeText.innerHTML = '<i class="fas ' + detection.icon + ' ml-1"></i> ' + detection.text;
                codeTypeIndicator.className = 'code-type-indicator ' + (detection.type === 'personal' ? 'personal' : 'company');
            } else {
                codeTypeIndicator.style.display = 'none';
            }
        } else {
            codeTypeIndicator.style.display = 'none';
        }
    }
    
    // اعتبارسنجی کد (10 یا 11 رقم)
    function validateCode(code) {
        code = code.trim();
        return /^\d{10}$/.test(code) || /^\d{11}$/.test(code);
    }
    
    // جلوگیری از ورود کاراکتر غیرعددی
    input.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 11) {
            this.value = this.value.slice(0, 11);
        }
        updateCodeTypeIndicator();
    });
    
    // اعتبارسنجی هنگام submit
    form.addEventListener('submit', function(e) {
        const code = input.value.trim();
        
        if (code.length === 0) {
            e.preventDefault();
            showError('لطفاً کد ملی / شناسه ملی خود را وارد کنید.');
            input.focus();
            return false;
        }
        
        if (!validateCode(code)) {
            e.preventDefault();
            showError('کد ملی باید 10 رقم یا شناسه ملی باید 11 رقم باشد.');
            input.focus();
            return false;
        }
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> در حال ارسال...';
        
        return true;
    });
    
    function showError(message) {
        let errorDiv = form.querySelector('.form-error');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger mt-3 form-error';
            errorDiv.style.fontSize = '14px';
            errorDiv.style.padding = '10px';
            form.insertBefore(errorDiv, submitBtn);
        }
        errorDiv.innerHTML = '<i class="fas fa-exclamation-circle ml-2"></i> ' + message;
        errorDiv.style.display = 'block';
        
        setTimeout(function() {
            if (errorDiv) errorDiv.style.display = 'none';
        }, 5000);
    }
    
    input.addEventListener('focus', function() {
        const errorDiv = form.querySelector('.form-error');
        if (errorDiv) {
            errorDiv.style.display = 'none';
        }
    });
    
    input.addEventListener('paste', function(e) {
        setTimeout(function() {
            const persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
            const englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            let value = input.value;
            for (var i = 0; i < 10; i++) {
                value = value.replace(persianNumbers[i], englishNumbers[i]);
            }
            input.value = value.replace(/[^0-9]/g, '').slice(0, 11);
            updateCodeTypeIndicator();
        }, 10);
    });
    
    input.addEventListener('blur', function() {
        input.value = input.value.trim();
    });
    
    updateCodeTypeIndicator();
})();
</script>
</body>
</html>