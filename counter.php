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

// فقط اگر کاربر قبلاً نظرسنجی ثبت نکرده باشد، نمایش بده
if ($has_survey == 0 && !$show_success_message) {
?>
<style>
/* استایل‌های نظرسنجی */
.survey-overlay-custom {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    z-index: 10001;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Vazir', 'Tahoma', 'Arial', sans-serif;
}

.survey-box-custom {
    background: #ffffff;
    width: 550px;
    max-width: 90%;
    border-radius: 20px;
    direction: rtl;
    text-align: right;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    overflow: hidden;
}

.survey-header-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 15px 20px;
    color: white;
    position: relative;
}

.survey-header-custom h3 {
    margin: 0;
    font-size: 18px;
}

.survey-header-custom p {
    margin: 5px 0 0;
    font-size: 11px;
    opacity: 0.85;
}

.close-survey {
    position: absolute;
    left: 15px;
    top: 12px;
    font-size: 24px;
    cursor: pointer;
    color: rgba(255,255,255,0.8);
}

.close-survey:hover {
    color: white;
}

.survey-body-custom {
    padding: 20px;
}

.privacy-note {
    background: #e8f0fe;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 12px;
    color: #4a5568;
    text-align: center;
    margin-bottom: 20px;
    border-right: 3px solid #667eea;
}

.survey-question-custom {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e9ecef;
}

.question-title-custom {
    font-weight: 600;
    color: #2d3748;
    font-size: 14px;
    margin-bottom: 10px;
}

/* ستاره‌ها - در ردیف جداگانه، سمت چپ و با فاصله از لبه چپ */
.stars-custom {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    gap: 8px;
    margin-right: 20px;  /* فاصله از سمت راست = حرکت به راست */
}

.stars-custom input {
    display: none;
}

.stars-custom label {
    font-size: 26px;
    color: #e2e8f0;
    cursor: pointer;
    transition: all 0.2s ease;
}

.stars-custom label:hover,
.stars-custom label:hover ~ label {
    color: #fbbf24;
}

.stars-custom input:checked ~ label {
    color: #fbbf24;
}

.survey-body-custom textarea {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    resize: vertical;
    font-family: inherit;
    font-size: 12px;
    box-sizing: border-box;
    margin-top: 8px;
}

.survey-body-custom textarea:focus {
    outline: none;
    border-color: #667eea;
}

.survey-buttons-custom {
    margin-top: 20px;
    display: flex;
    gap: 10px;
}

.btn-submit-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    flex: 2;
}

.btn-later-custom {
    background: #f1f3f5;
    color: #495057;
    border: none;
    padding: 10px 15px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 12px;
    flex: 1;
}

.btn-submit-custom:hover, .btn-later-custom:hover {
    transform: translateY(-1px);
}
</style>
<div class="survey-overlay-custom" id="surveyModalCustom">
    <div class="survey-box-custom">
        <div class="survey-header-custom">
            <span class="close-survey" onclick="document.getElementById('surveyModalCustom').style.display='none';">&times;</span>
            <h3>📊 نظرسنجی در خصوص پشتیبانی سامانه</h3>
            <p>نظر شما باعث بهبود کیفیت خدمات ما می‌شود</p>
        </div>
        
        <div class="survey-body-custom">
            <!-- پیام محرمانگی -->
            <div class="privacy-note">
                🔒 هویت شما در این نظرسنجی ثبت نمی‌شود و پاسخ‌ها کاملاً ناشناس خواهد بود.
            </div>
            
            <form method="post" action="" id="surveyFormCustom">
                <!-- سوال 1 -->
                <div class="survey-question-custom">
                    <div class="question-title-custom">۱. سرعت پاسخگویی تیم پشتیبانی</div>
                    <div class="stars-custom">
                        <input type="radio" name="speed" value="1" id="speed1c" required><label for="speed1c">★</label>
                        <input type="radio" name="speed" value="2" id="speed2c"><label for="speed2c">★</label>
                        <input type="radio" name="speed" value="3" id="speed3c"><label for="speed3c">★</label>
                        <input type="radio" name="speed" value="4" id="speed4c"><label for="speed4c">★</label>
                        <input type="radio" name="speed" value="5" id="speed5c"><label for="speed5c">★</label>
                    </div>
                </div>
                
                <!-- سوال 2 -->
                <div class="survey-question-custom">
                    <div class="question-title-custom">۲. رفتار و برخورد پشتیبانی</div>
                    <div class="stars-custom">
                        <input type="radio" name="behavior" value="1" id="behavior1c" required><label for="behavior1c">★</label>
                        <input type="radio" name="behavior" value="2" id="behavior2c"><label for="behavior2c">★</label>
                        <input type="radio" name="behavior" value="3" id="behavior3c"><label for="behavior3c">★</label>
                        <input type="radio" name="behavior" value="4" id="behavior4c"><label for="behavior4c">★</label>
                        <input type="radio" name="behavior" value="5" id="behavior5c"><label for="behavior5c">★</label>
                    </div>
                </div>
                
                <!-- سوال 3 -->
                <div class="survey-question-custom">
                    <div class="question-title-custom">۳. کیفیت راهنمایی‌های ارائه شده</div>
                    <div class="stars-custom">
                        <input type="radio" name="quality" value="1" id="quality1c" required><label for="quality1c">★</label>
                        <input type="radio" name="quality" value="2" id="quality2c"><label for="quality2c">★</label>
                        <input type="radio" name="quality" value="3" id="quality3c"><label for="quality3c">★</label>
                        <input type="radio" name="quality" value="4" id="quality4c"><label for="quality4c">★</label>
                        <input type="radio" name="quality" value="5" id="quality5c"><label for="quality5c">★</label>
                    </div>
                </div>
                
                <!-- سوال 4: پیشنهادات -->
                <div class="survey-question-custom">
                    <div class="question-title-custom">💬 پیشنهاد شما برای بهبود پشتیبانی</div>
                    <textarea name="suggestion" rows="2" placeholder="نظر یا پیشنهاد خود را بنویسید..."></textarea>
                </div>
                
                <div class="survey-buttons-custom">
                    <button type="submit" name="save_survey" class="btn-submit-custom">✓ ثبت نظرسنجی</button>
                    <button type="button" class="btn-later-custom" onclick="document.getElementById('surveyModalCustom').style.display='none';">بعداً</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // جلوگیری از اسکرول پشت پاپ‌آپ
    document.getElementById('surveyModalCustom').addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });
</script>
<?php
} else if ($show_success_message) {
    // فقط نمایش پیام موفقیت
    ?>
    <div style="position: fixed; bottom: 30px; right: 30px; background: #27ae60; color: white; padding: 12px 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); font-family: 'Vazir', 'Tahoma', sans-serif; font-size: 13px; z-index: 10002; direction: rtl;">
        ✓ نظرسنجی با موفقیت ثبت شد. متشکریم!
    </div>
    <script>
        setTimeout(function() {
            var msg = document.querySelector('div[style*="position: fixed; bottom: 30px"]');
            if (msg) msg.remove();
        }, 3000);
    </script>
    <?php
}
?>