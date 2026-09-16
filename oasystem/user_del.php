<?php 
if (isset($_POST['username'])) 
{ 
    include('../login/config.php');
    
    // دریافت username از POST
    $username = $_POST['username'];
    
    // دریافت اطلاعات کاربر و بررسی همزمان وجود در جداول دیگر
    $check_sql = "SELECT 
                    u.username,
                    u.cod_m,
                    u.name,
                    u.Last_name,
                    (SELECT COUNT(*) FROM list_abadi WHERE mor_cod_m = u.username) as count_abadi,
                    (SELECT COUNT(*) FROM list_city WHERE mor_cod_m = u.username) as count_city
                  FROM users u
                  WHERE u.username = :username";
    
    $check_stmt = $dbh->prepare($check_sql);
    $check_stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $check_stmt->execute();
    $result = $check_stmt->fetch(PDO::FETCH_ASSOC);
    
    // اگر کاربر وجود نداشت
    if (!$result) {
        header("Location: search_user.php");
        exit();
    }
    
    $total_count = intval($result['count_abadi']) + intval($result['count_city']);
    
    // اگر تعداد رکوردها بیشتر از 0 بود، پیام خطا نمایش داده شود
    if ($total_count > 0) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>خطا در حذف</title>
            <link href="../FA.css" rel="stylesheet" type="text/css" />
            <style>
                body {
                    font-family: Tahoma, Arial, sans-serif;
                    direction: rtl;
                    text-align: center;
                    padding: 50px;
                    background: #f8f9fa;
                }
                .error-box {
                    background: #f8d7da;
                    color: #721c24;
                    border: 1px solid #f5c6cb;
                    padding: 20px;
                    border-radius: 5px;
                    max-width: 600px;
                    margin: 0 auto;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                }
                .error-box h3 {
                    margin-top: 0;
                    color: #721c24;
                }
                .error-box .icon {
                    font-size: 48px;
                    margin-bottom: 10px;
                }
                .error-box .details {
                    background: white;
                    padding: 10px;
                    border-radius: 3px;
                    margin: 15px 0;
                    text-align: right;
                }
                .btn-back {
                    display: inline-block;
                    padding: 10px 20px;
                    background: #007bff;
                    color: white;
                    text-decoration: none;
                    border-radius: 3px;
                    margin-top: 10px;
                }
                .btn-back:hover {
                    background: #0056b3;
                }
                .user-name {
                    font-weight: bold;
                    color: #721c24;
                }
                .detail-item {
                    padding: 5px 0;
                    border-bottom: 1px solid #eee;
                }
                .detail-item:last-child {
                    border-bottom: none;
                }
            </style>
        </head>
        <body>
            <div class="error-box">
                <div class="icon">⚠️</div>
                <h3>خطا در حذف کاربر</h3>
                <p>کارشناس <span class="user-name"><?php echo $result['name'] . ' ' . $result['Last_name']; ?></span> دارای شهر و یا آبادی تحت پوشش هست و حذف مقدور نیست</p>
                <div class="details">
                    <div class="detail-item"><strong>کد ملی:</strong> <?php echo $result['cod_m']; ?></div>
                    <div class="detail-item"><strong>تعداد آبادی‌های تحت پوشش:</strong> <?php echo $result['count_abadi']; ?></div>
                    <div class="detail-item"><strong>تعداد شهرهای تحت پوشش:</strong> <?php echo $result['count_city']; ?></div>
                </div>
                <a href="search_user.php" class="btn-back">بازگشت به صفحه جستجو</a>
            </div>
        </body>
        </html>
        <?php
        exit();
    }
    
    // اگر تعداد رکوردها 0 بود، عملیات حذف انجام شود
    $sql = "DELETE FROM users WHERE username = :username";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    
    // هدایت به صفحه جستجو با پیام موفقیت
    header("Location: search_user.php?msg=success"); 
    exit();
} 
else 
{ 
    header("Location: search_user.php"); 
    exit();
} 
?>