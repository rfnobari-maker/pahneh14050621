<?php
include('../../login/config.php') ;
function getAgriStatus($z_sal, $agri_id) {
  $z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
  $table_Agri_note = 'Agri_note'.str_replace('-','_',$z_sal) ; 
    global $dbh ; // استفاده از اتصال پایگاه داده از config.php
    try {
        // کوئری برای بررسی مقدار Agri_id
        $stmt = $dbh->prepare("SELECT COUNT(*) FROM $table_Agri_note WHERE Agri_id = :agri_id");
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

// استفاده از تابع
//$agri_id = 8958260; // مقدار مورد نظر
//echo getAgriStatus($agri_id);
?>
