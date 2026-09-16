<?php
include('../../login/config.php') ;

function getGardenStatus($z_sal, $agri_id) {
    // استفاده از پارامتر دریافتی به جای $_POST
    $table_Garden_note = 'Garden_note' . $z_sal; 
    
    global $dbh;
    try {
        // کوئری برای بررسی مقدار Garden_id
        $stmt = $dbh->prepare("SELECT COUNT(*) FROM $table_Garden_note WHERE Garden_id = :agri_id");
        $stmt->bindParam(':agri_id', $agri_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $count = $stmt->fetchColumn();

        // تعریف CSS و HTML برای نقطه چشمک‌زن
        $css = '<style>
            .blink {
                color: green;
                font-weight: bold;
                animation: blink 1s infinite;
            }
            @keyframes blink {
                0%, 100% { opacity: 1; }
                50% { opacity: 0; }
            }
        </style>';

        // بازگرداندن نقطه چشمک‌زن یا وضعیت پیش‌فرض
        if ($count > 0) {
            return $css . '<span class="blink">●</span>';
        } else {
            return '<span style="color: red; font-weight: bold;">●</span>'; // نقطه قرمز
        }
    } catch (PDOException $e) {
        return 'خطا در پایگاه داده: ' . $e->getMessage();
    }
}
?>