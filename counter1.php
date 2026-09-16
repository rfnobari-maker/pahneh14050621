<?php
include ('lock_p1.php') ;
include('login/config.php');


$query = "SELECT pic,fname,tel_m,valid FROM users WHERE username='".$_SESSION['login_user']."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$tel_m = $row['tel_m'] ; 
$valid = $row['valid'] ; 
if ($row['pic']=='' or $row['fname']=='')
{
 header("Location: profile.php?a");
}

// پیام جدید 
 $query = "SELECT count(*) FROM  pm WHERE r_user = '$login_session' and  ru_read = '1'" ;
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count_pm = $stmt->fetchColumn();
if ($count_pm > 0) {
header("Location:rec_msg_notseen.php?unread");
}
//
$query = "SELECT count(*) FROM  list_abadi WHERE  mor_cod_m = '$user_check' " ;
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count = $stmt->fetchColumn();

$query = "SELECT count(*) FROM  list_city WHERE  mor_cod_m = '$user_check' " ;
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count_city = $stmt->fetchColumn();

// =============== نظرسنجی ===============

// پردازش ثبت نظرسنجی
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_survey'])) {
    $speed = intval($_POST['speed']);
    $behavior = intval($_POST['behavior']);
    $quality = intval($_POST['quality']);
    $suggestion = trim($_POST['suggestion']);
    
    $check = $dbh->prepare("SELECT COUNT(*) FROM survey_responses WHERE username = :username");
    $check->execute(array(':username' => $login_session));
    $exists = $check->fetchColumn();
    
    if ($exists == 0) {
        $insert_survey = "INSERT INTO survey_responses (username, speed_rating, behavior_rating, quality_rating, suggestion) 
                          VALUES (:username, :speed, :behavior, :quality, :suggestion)";
        $stmt_insert = $dbh->prepare($insert_survey);
        $stmt_insert->execute(array(
            ':username' => $login_session,
            ':speed' => $speed,
            ':behavior' => $behavior,
            ':quality' => $quality,
            ':suggestion' => $suggestion
        ));
        $show_success_message = true;
    }
}

// بررسی آیا کاربر قبلاً نظرسنجی پر کرده است
$check_survey = "SELECT COUNT(*) FROM survey_responses WHERE username = :username";
$stmt_survey = $dbh->prepare($check_survey);
$stmt_survey->execute(array(':username' => $login_session));
$has_survey = $stmt_survey->fetchColumn();

// اگر ثبت با موفقیت انجام شده و قبلاً ثبت نداشته، دیگر فرم را نشان نده
if ($show_success_message) {
    $has_survey = 1;
}

// فقط اگر کاربر قبلاً نظرسنجی ثبت نکرده باشد، نمایش بده
if ($has_survey == 0) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css2?family=Vazir&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    .survey-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.6) 100%);
        backdrop-filter: blur(5px);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Vazir', 'Tahoma', 'Arial', sans-serif;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    .survey-box {
        background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        width: 520px;
        max-width: 90%;
        padding: 0;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.35);
        direction: rtl;
        text-align: right;
        animation: slideUp 0.4s ease;
        overflow: hidden;
    }
    
    .survey-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 18px 25px;
        color: white;
        position: relative;
    }
    
    .survey-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }
    
    .survey-header p {
        margin: 5px 0 0 0;
        font-size: 11px;
        opacity: 0.85;
    }
    
    .close-icon {
        position: absolute;
        left: 20px;
        top: 15px;
        font-size: 24px;
        cursor: pointer;
        color: rgba(255,255,255,0.8);
        transition: all 0.2s ease;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    .close-icon:hover {
        color: white;
        background: rgba(255,255,255,0.2);
        transform: rotate(90deg);
    }
    
    .survey-body {
        padding: 20px 25px;
        max-height: none;
        overflow-y: visible;
    }
    
    .survey-question {
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .survey-question:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .question-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }
    
    .question-number {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 11px;
        font-weight: bold;
    }
    
    .survey-question label.question {
        font-weight: 600;
        color: #2d3748;
        font-size: 13px;
        flex: 1;
    }
    
    .stars {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 6px;
        margin-top: 8px;
        padding-right: 34px;
    }
    
    .stars input {
        display: none;
    }
    
    .stars label {
        font-size: 24px;
        color: #e2e8f0;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .stars label:hover,
    .stars label:hover ~ label,
    .stars input:checked ~ label {
        color: #fbbf24;
        transform: scale(1.05);
    }
    
    .survey-box textarea {
        width: 100%;
        padding: 8px 12px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        resize: vertical;
        font-family: 'Vazir', 'Tahoma', 'Arial', sans-serif;
        font-size: 12px;
        box-sizing: border-box;
        margin-top: 8px;
        transition: all 0.2s ease;
        background: #fafbfc;
    }
    
    .survey-box textarea:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
    }
    
    .survey-buttons {
        margin-top: 18px;
        display: flex;
        gap: 10px;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
        font-family: 'Vazir', 'Tahoma', 'Arial', sans-serif;
        flex: 2;
        transition: all 0.2s ease;
    }
    
    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px -5px rgba(102,126,234,0.4);
    }
    
    .btn-later {
        background: #f1f3f5;
        color: #495057;
        border: none;
        padding: 10px 15px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 500;
        font-family: 'Vazir', 'Tahoma', 'Arial', sans-serif;
        flex: 1;
        transition: all 0.2s ease;
    }
    
    .btn-later:hover {
        background: #e9ecef;
        transform: translateY(-1px);
    }
    
    @media (max-width: 600px) {
        .survey-body {
            padding: 15px 20px;
        }
        .stars label {
            font-size: 20px;
        }
        .btn-submit, .btn-later {
            padding: 8px 12px;
        }
        .survey-question {
            margin-bottom: 14px;
            padding-bottom: 10px;
        }
    }
</style>
</head>
<body>
<div class="survey-overlay" id="surveyModal">
    <div class="survey-box">
        <div class="survey-header">
            <span class="close-icon" onclick="document.getElementById('surveyModal').style.display='none';">&times;</span>
            <h3>📊 نظرسنجی در خصوص پشتیبانی سامانه</h3>
            <p>نظر شما باعث بهبود کیفیت خدمات ما می‌شود</p>
            <div style="background: #e8f0fe; padding: 8px 12px; border-radius: 8px; font-size: 12px; color: #4a5568;
             text-align: center; margin-bottom: 15px;
              border-right: 3px solid #667eea;">🔒 هویت شما در این نظرسنجی ثبت نمی‌شود و پاسخ‌ها کاملاً ناشناس خواهد بود.</div>
        </div>
        
        <div class="survey-body">
            <form method="post" action="">
                <!-- سوال 1: سرعت پاسخگویی -->
                <div class="survey-question">
                    <div class="question-title">
                        <div class="question-number">۱</div>
                        <label class="question">سرعت پاسخگویی تیم پشتیبانی</label>
                    </div>
                    <div class="stars">
                        <input type="radio" name="speed" value="5" id="speed5" required><label for="speed5">★</label>
                        <input type="radio" name="speed" value="4" id="speed4"><label for="speed4">★</label>
                        <input type="radio" name="speed" value="3" id="speed3"><label for="speed3">★</label>
                        <input type="radio" name="speed" value="2" id="speed2"><label for="speed2">★</label>
                        <input type="radio" name="speed" value="1" id="speed1"><label for="speed1">★</label>
                    </div>
                </div>
                
                <!-- سوال 2: رفتار و برخورد -->
                <div class="survey-question">
                    <div class="question-title">
                        <div class="question-number">۲</div>
                        <label class="question">رفتار و برخورد پشتیبانی</label>
                    </div>
                    <div class="stars">
                        <input type="radio" name="behavior" value="5" id="behavior5" required><label for="behavior5">★</label>
                        <input type="radio" name="behavior" value="4" id="behavior4"><label for="behavior4">★</label>
                        <input type="radio" name="behavior" value="3" id="behavior3"><label for="behavior3">★</label>
                        <input type="radio" name="behavior" value="2" id="behavior2"><label for="behavior2">★</label>
                        <input type="radio" name="behavior" value="1" id="behavior1"><label for="behavior1">★</label>
                    </div>
                </div>
                
                <!-- سوال 3: کیفیت راهنمایی -->
                <div class="survey-question">
                    <div class="question-title">
                        <div class="question-number">۳</div>
                        <label class="question">کیفیت راهنمایی‌های ارائه شده</label>
                    </div>
                    <div class="stars">
                        <input type="radio" name="quality" value="5" id="quality5" required><label for="quality5">★</label>
                        <input type="radio" name="quality" value="4" id="quality4"><label for="quality4">★</label>
                        <input type="radio" name="quality" value="3" id="quality3"><label for="quality3">★</label>
                        <input type="radio" name="quality" value="2" id="quality2"><label for="quality2">★</label>
                        <input type="radio" name="quality" value="1" id="quality1"><label for="quality1">★</label>
                    </div>
                </div>
                
                <!-- سوال 4: پیشنهادات (اختیاری) -->
                <div class="survey-question">
                    <div class="question-title">
                        <div class="question-number">💬</div>
                        <label class="question">پیشنهاد شما برای بهبود پشتیبانی</label>
                    </div>
                    <textarea name="suggestion" rows="2" placeholder="نظر یا پیشنهاد خود را بنویسید..."></textarea>
                </div>
                
                <div class="survey-buttons">
                    <button type="submit" name="save_survey" class="btn-submit">✓ ثبت نظرسنجی</button>
                    <button type="button" class="btn-later" onclick="document.getElementById('surveyModal').style.display='none';">بعداً</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
} else if ($show_success_message) {
    // اگر ثبت انجام شده، فقط پیام موفقیت نمایش بده
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8">
    <style>
        .success-toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            font-family: 'Vazir', 'Tahoma', sans-serif;
            font-size: 14px;
            z-index: 10000;
            animation: slideInRight 0.3s ease;
            direction: rtl;
        }
        
        @keyframes slideInRight {
            from { transform: translateX(100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
    </head>
    <body>
    <div class="success-toast" id="successMsg">
        ✓ نظرسنجی با موفقیت ثبت شد. متشکریم!
    </div>
    <script>
        setTimeout(function() {
            var msg = document.getElementById('successMsg');
            if (msg) {
                msg.style.opacity = '0';
                msg.style.transition = '0.3s';
                setTimeout(function() {
                    msg.remove();
                }, 500);
            }
        }, 3000);
    </script>
    </body>
    </html>
    <?php
}
?>