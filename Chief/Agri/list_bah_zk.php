<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once("../../login/config.php");
require_once("./Vege_status.php");

if ($cod_mah == 170 || $cod_mah == 172 || $cod_mah == 174) {
    $id_ostan1   = isset($_POST['id_ostan'])   ? $_POST['id_ostan']   : '';
    $id_city     = isset($_POST['id_city5'])   ? $_POST['id_city5']   : '';
    $id_mar      = isset($_POST['id_mar'])     ? $_POST['id_mar']     : '';
    $add_abadi   = isset($_POST['add_abadi'])  ? $_POST['add_abadi']  : '';
    $add_city    = isset($_POST['add_city'])   ? $_POST['add_city']   : '';
    $ra_kesh     = isset($_POST['ra_kesh'])    ? $_POST['ra_kesh']    : '';
    $mor_cod_m   = isset($_POST['mor_cod_m'])  ? $_POST['mor_cod_m']  : '';
    $bah_cod_m   = isset($_POST['bah_cod_m'])  ? $_POST['bah_cod_m']  : '';
    $z_sal       = isset($_POST['z_sal'])      ? $_POST['z_sal']      : '';
    $b_time      = isset($_POST['b_time'])     ? $_POST['b_time']     : '';
    $mah_name    = isset($_POST['mah_name'])   ? $_POST['mah_name']   : '';
    $zka1        = isset($_POST['zka1'])       ? $_POST['zka1']       : '';
    $zka2        = isset($_POST['zka2'])       ? $_POST['zka2']       : '';
    $ragham      = isset($_POST['ragham'])     ? $_POST['ragham']     : '';
    $no_ab       = isset($_POST['no_ab'])      ? $_POST['no_ab']      : '';
    $sba1        = isset($_POST['sba1'])       ? $_POST['sba1']       : '';
    $sba2        = isset($_POST['sba2'])       ? $_POST['sba2']       : '';
    $mtolp1      = isset($_POST['mtolp1'])     ? $_POST['mtolp1']     : '';
    $mtolp2      = isset($_POST['mtolp2'])     ? $_POST['mtolp2']     : '';
    $mtol1       = isset($_POST['mtol1'])      ? $_POST['mtol1']      : '';
    $mtol2       = isset($_POST['mtol2'])      ? $_POST['mtol2']      : '';
    $mah_bazar   = isset($_POST['mah_bazar'])  ? $_POST['mah_bazar']  : '';
    $dah_bazar   = isset($_POST['dah_bazar'])  ? $_POST['dah_bazar']  : '';
    $history_filter = isset($_POST['history_filter']) ? $_POST['history_filter'] : 'all';
} else {
    $id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
    $id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
    $id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
    $add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
    $add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
    $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
    $m_ab = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
    $no_ab = isset($_POST['no_ab']) ? $_POST['no_ab'] : '';
    $mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
    $bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
    $z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
    $zka1 = isset($_POST['zka1']) ? $_POST['zka1'] : '';
    $zka2 = isset($_POST['zka2']) ? $_POST['zka2'] : '';
    $zkb1 = isset($_POST['zkb1']) ? $_POST['zkb1'] : '';
    $zkb2 = isset($_POST['zkb2']) ? $_POST['zkb2'] : '';
    $sba1 = isset($_POST['sba1']) ? $_POST['sba1'] : '';
    $sba2 = isset($_POST['sba2']) ? $_POST['sba2'] : '';
    $sbb1 = isset($_POST['sbb1']) ? $_POST['sbb1'] : '';
    $sbb2 = isset($_POST['sbb2']) ? $_POST['sbb2'] : '';
    $mtol1 = isset($_POST['mtol1']) ? $_POST['mtol1'] : '';
    $mtol2 = isset($_POST['mtol2']) ? $_POST['mtol2'] : '';
    $mtolp1 = isset($_POST['mtolp1']) ? $_POST['mtolp1'] : '';
    $mtolp2 = isset($_POST['mtolp2']) ? $_POST['mtolp2'] : '';
    $mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
    $cod_mah = isset($_POST['cod_mah']) ? $_POST['cod_mah'] : '';
    $mah_kh = isset($_POST['mah_kh']) ? $_POST['mah_kh'] : '';
    $mah_bem = isset($_POST['mah_bem']) ? $_POST['mah_bem'] : '';
    $date_s1 = isset($_POST['date_s1']) ? $_POST['date_s1'] : '';
    $date_s2 = isset($_POST['date_s2']) ? $_POST['date_s2'] : '';
    $history_filter = isset($_POST['history_filter']) ? $_POST['history_filter'] : 'all';
    
    $Agri_table = 'Agri' . str_replace('-', '_', $z_sal);
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
}

// بررسی درخواست Ajax
$is_ajax = isset($_POST['ajax']) && $_POST['ajax'] == '1';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --primary-light: #d1fae5;
            --secondary: #3b82f6;
            --secondary-dark: #2563eb;
            --warning: #f59e0b;
            --danger: #ef4444;
            --danger-dark: #dc2626;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --border-radius: 16px;
            --border-radius-sm: 10px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --box-shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
            color: var(--gray-800);
            min-height: 100vh;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-200);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gray-400);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gray-500);
        }

        .close-btn-container {
            position: fixed;
            top: 24px;
            left: 24px;
            z-index: 1000;
        }

        .close-btn {
            background: linear-gradient(135deg, var(--danger) 0%, var(--danger-dark) 100%);
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 40px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .close-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--box-shadow-lg);
        }

        .close-btn:active {
            transform: translateY(0);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 80px 24px 40px 24px;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            background: white;
            padding: 20px 28px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            direction: rtl;
        }

        .header-content:hover {
            box-shadow: var(--box-shadow-lg);
        }

        .header-title-section {
            flex: 1;
            text-align: right;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--gray-500);
            font-size: 0.9rem;
        }

        .expert-info-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
            padding: 8px 20px 8px 24px;
            border-radius: 60px;
            border: 1px solid var(--gray-200);
            transition: var(--transition);
        }

        .expert-info-card:hover {
            border-color: var(--primary-light);
            background: white;
            transform: translateY(-2px);
        }

        .expert-avatar {
            width: 56px;
            height: 56px;
            min-width: 56px;
            border-radius: 50%;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .expert-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .expert-avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
        }

        .expert-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .expert-label {
            font-size: 0.7rem;
            font-weight: 500;
            color: var(--gray-500);
            letter-spacing: 0.5px;
        }

        .expert-name {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-800);
            white-space: nowrap;
        }

        .card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-bottom: 24px;
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: var(--box-shadow-lg);
        }

        .card-header {
            padding: 20px 24px;
            background: white;
            border-bottom: 2px solid var(--primary-light);
        }

        .card-header h3 {
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--gray-700);
        }

        .card-body {
            padding: 0;
            overflow-x: auto;
        }

        .filter-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 24px;
            box-shadow: var(--box-shadow);
        }

        .filter-title {
            font-weight: 600;
            margin-bottom: 16px;
            color: var(--gray-700);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 28px;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .filter-btn-all {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .filter-btn-with {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .filter-btn-without {
            background: linear-gradient(135deg, var(--danger) 0%, var(--danger-dark) 100%);
            color: white;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
        }

        .filter-btn-active {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
        }

        .filter-btn-inactive {
            opacity: 0.7;
        }

        .download-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .download-btn {
            background: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            font-weight: 500;
            color: var(--gray-700);
            box-shadow: var(--box-shadow);
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--box-shadow-lg);
        }

        .download-btn img {
            width: 28px;
            height: 28px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            direction: ltr;
            font-size: 0.85rem;
        }

        .data-table th {
            padding: 14px 12px;
            background: var(--gray-100);
            color: var(--gray-700);
            font-weight: 600;
            font-size: 0.8rem;
            text-align: center;
            border-bottom: 2px solid var(--gray-200);
        }

        .data-table td {
            padding: 12px;
            text-align: center;
            font-size: 0.8rem;
            border-bottom: 1px solid var(--gray-200);
            background: white;
        }

        .data-table tr:hover td {
            background: var(--primary-light);
        }

        .pagination-container {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            margin-top: 24px;
            box-shadow: var(--box-shadow);
        }

        .pagination {
            list-style: none;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .page-btn {
            background: var(--gray-100);
            color: var(--gray-700);
            border: none;
            padding: 8px 14px;
            border-radius: var(--border-radius-sm);
            cursor: pointer;
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            font-weight: 500;
            transition: var(--transition);
        }

        .page-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .page-btn-active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 8px 14px;
            border-radius: var(--border-radius-sm);
        }

        .nav-btn {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: var(--border-radius-sm);
            cursor: pointer;
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            font-weight: 500;
            transition: var(--transition);
        }

        .nav-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
        }

        .page-jump {
            margin-top: 20px;
            text-align: center;
        }

        .page-jump input {
            padding: 8px 12px;
            border: 2px solid var(--gray-200);
            border-radius: var(--border-radius-sm);
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            text-align: center;
            width: 70px;
            transition: var(--transition);
        }

        .page-jump input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .empty-message {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .empty-message h3 {
            color: var(--gray-500);
            font-size: 1.3rem;
            margin-bottom: 12px;
        }

        .empty-message p {
            color: var(--gray-400);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            padding: 4px;
            border-radius: 8px;
        }

        .action-btn:hover {
            transform: scale(1.1);
            background: var(--gray-100);
        }

        .action-btn img {
            width: 24px;
            height: 24px;
            vertical-align: middle;
        }

        /* لودینگ */
        .ajax-loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ajax-loading .loading-content {
            background: white;
            padding: 25px 40px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .ajax-loading .spinner {
            width: 45px;
            height: 45px;
            border: 4px solid var(--gray-200);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .container {
                padding: 70px 16px 20px 16px;
            }
            
            .page-title {
                font-size: 1.4rem;
            }
            
            .data-table th,
            .data-table td {
                padding: 8px;
                font-size: 0.7rem;
            }
            
            .filter-btn {
                padding: 6px 16px;
                font-size: 0.75rem;
            }
            
            .action-btn img {
                width: 20px;
                height: 20px;
            }

            .expert-name {
                font-size: 0.9rem;
                white-space: normal;
            }

            .expert-avatar {
                width: 48px;
                height: 48px;
                min-width: 48px;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .header-title-section {
                text-align: center;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card, .filter-section, .pagination-container {
            animation: fadeIn 0.4s ease-out;
        }
    </style>
    <script type="text/javascript">
    function target_popup(form) {
        window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=950,height=700"); 
        form.target = 'formpopup';
    }
    function target_popup1(form) {
        window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=950,height=700,top=50,left=50"); 
        form.target = 'formpopup';
    }
    function target_popup2(form) {
        window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=950,height=700"); 
        form.target = 'formpopup';
    }
    function target_Agri17(form) {
        window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600"); 
        form.target = 'formpopup'; 
    }

    // ============== کدهای Ajax برای تغییر فیلتر بدون رفرش ==============
    $(document).ready(function() {
        // دکمه‌های فیلتر
        $('.filter-btn').click(function(e) {
            e.preventDefault();
            
            var filterValue = $(this).data('filter');
            var currentFilter = $('#current-history-filter').val();
            
            if (filterValue === currentFilter) return;
            
            // جمع‌آوری داده‌های فرم
            var formData = new FormData();
            
            <?php
            foreach ($_POST as $key => $value) {
                if ($key != 'history_filter' && !is_array($value)) {
                    echo "formData.append('" . addslashes($key) . "', '" . addslashes($value) . "');\n";
                }
            }
            ?>
            formData.append('history_filter', filterValue);
            formData.append('ajax', '1');
            
            // نمایش لودینگ
            $('body').append(`
                <div class="ajax-loading">
                    <div class="loading-content">
                        <div class="spinner"></div>
                        <span style="color: #374151;">در حال بارگذاری...</span>
                    </div>
                </div>
            `);
            
            $.ajax({
                url: window.location.pathname,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.ajax-loading').remove();
                    
                    // استخراج بخش‌های مورد نیاز از پاسخ
                    var $response = $(response);
                    
                    // به‌روزرسانی جداول
                    $('.card').each(function(index) {
                        var $newCard = $response.find('.card').eq(index);
                        if ($newCard.length) {
                            $(this).replaceWith($newCard);
                        }
                    });
                    
                    // به‌روزرسانی pagination
                    $('.pagination-container').replaceWith($response.find('.pagination-container'));
                    
                    // به‌روزرسانی دکمه‌های دانلود (اگر وجود داشته باشند)
                    if ($response.find('.download-buttons').length) {
                        $('.download-buttons').replaceWith($response.find('.download-buttons'));
                    }
                    
                    // به‌روزرسانی کلاس active دکمه‌های فیلتر
                    $('.filter-btn').removeClass('filter-btn-active').addClass('filter-btn-inactive');
                    $('.filter-btn[data-filter="' + filterValue + '"]').removeClass('filter-btn-inactive').addClass('filter-btn-active');
                    $('#current-history-filter').val(filterValue);
                    
                    // به‌روزرسانی تابع‌های popup (برای دکمه‌های جدید)
                    attachPopupEvents();
                },
                error: function() {
                    $('.ajax-loading').remove();
                    alert('خطا در بارگذاری اطلاعات. لطفاً دوباره تلاش کنید.');
                }
            });
        });
        
        // اتصال مجدد رویدادهای popup به دکمه‌های جدید
        function attachPopupEvents() {
            $('form[action="../send_pm1.php"]').each(function() {
                $(this).off('submit').on('submit', function(e) {
                    target_popup2(this);
                });
            });
            $('form[action="history_bah_zk.php"]').each(function() {
                $(this).off('submit').on('submit', function(e) {
                    target_popup1(this);
                });
            });
            $('form[action="Vegedata_T_view.php"]').each(function() {
                $(this).off('submit').on('submit', function(e) {
                    target_popup2(this);
                });
            });
            $('form[action="Agridata_view1.php"]').each(function() {
                $(this).off('submit').on('submit', function(e) {
                    target_popup1(this);
                });
            });
            $('form[action="../send_pm1.php"]').each(function() {
                $(this).off('submit').on('submit', function(e) {
                    target_Agri17(this);
                });
            });
        }
    });
    </script>
</head>
<body>

<div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">
        <span>✕</span> بستن پنجره
    </button>
</div>

<div class="container">
    <div class="page-header">
        <div class="header-content">
            <div class="header-title-section">
                <h1 class="page-title">📊 لیست قطعات ثبت شده</h1>
                <p class="page-subtitle">مشاهده و مدیریت اطلاعات</p>
            </div>
            
            <?php 
            $pic = user_pic($mor_cod_m);
            $user_name = user_name($mor_cod_m);
            if($user_name != '' || $pic != '') { 
            ?>
            <div class="expert-info-card">
                <div class="expert-avatar">
                    <?php if($pic != '' && file_exists("../../files/users/".$pic)) { ?>
                        <img src="../../files/users/<?php echo $pic; ?>" alt="تصویر کارشناس" />
                    <?php } else { ?>
                        <div class="expert-avatar-placeholder">
                            <span>👤</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="expert-details">
                    <span class="expert-label">کارشناس مسئول</span>
                    <span class="expert-name"><?php echo $user_name; ?></span>
                </div>
             <td>
                                    <form action="../send_pm1.php#1" method="post" onsubmit="target_popup2(this)" style="display: inline;">
                                        <input type="hidden" name="username" value="<?php echo $mor_cod_m; ?>" />
                                        <button class="action-btn" title="ارسال پیام به کارشناس"><img src="../../files/receive_mail.png" alt=""/></button>
                                    </form>
                                </td>

            </div>
            <?php } ?>

        </div>
    </div>
                               
<?php
// ==================== توابع کمکی ====================

function generate_hidden_inputs_vege() {
    global $id_ostan1, $id_city, $id_mar, $add_abadi, $add_city,
           $ra_kesh, $mor_cod_m, $bah_cod_m, $z_sal, $b_time, $cod_mah,
           $zka1, $zka2, $ragham, $no_ab, $sba1, $sba2, $mtolp1, $mtolp2,
           $mtol1, $mtol2, $mah_bazar, $dah_bazar, $history_filter;
    ?>
    <input type="hidden" name="action" value="1" />
    <input type="hidden" name="history_filter" value="<?php echo htmlspecialchars($history_filter); ?>" />
    <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
    <input type="hidden" name="id_city5" value="<?php echo htmlspecialchars($id_city); ?>" />
    <input type="hidden" name="id_mar" value="<?php echo htmlspecialchars($id_mar); ?>" />
    <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($add_abadi); ?>" />
    <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($add_city); ?>" />
    <input type="hidden" name="ra_kesh" value="<?php echo htmlspecialchars($ra_kesh); ?>" />
    <input type="hidden" name="mor_cod_m" value="<?php echo htmlspecialchars($mor_cod_m); ?>" />
    <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m); ?>" />
    <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
    <input type="hidden" name="b_time" value="<?php echo htmlspecialchars($b_time); ?>" />
    <input type="hidden" name="cod_mah" value="<?php echo htmlspecialchars($cod_mah); ?>" />
    <input type="hidden" name="zka1" value="<?php echo htmlspecialchars($zka1); ?>" />
    <input type="hidden" name="zka2" value="<?php echo htmlspecialchars($zka2); ?>" />
    <input type="hidden" name="ragham" value="<?php echo htmlspecialchars($ragham); ?>" />
    <input type="hidden" name="no_ab" value="<?php echo htmlspecialchars($no_ab); ?>" />
    <input type="hidden" name="sba1" value="<?php echo htmlspecialchars($sba1); ?>" />
    <input type="hidden" name="sba2" value="<?php echo htmlspecialchars($sba2); ?>" />
    <input type="hidden" name="mtolp1" value="<?php echo htmlspecialchars($mtolp1); ?>" />
    <input type="hidden" name="mtolp2" value="<?php echo htmlspecialchars($mtolp2); ?>" />
    <input type="hidden" name="mtol1" value="<?php echo htmlspecialchars($mtol1); ?>" />
    <input type="hidden" name="mtol2" value="<?php echo htmlspecialchars($mtol2); ?>" />
    <input type="hidden" name="mah_bazar" value="<?php echo htmlspecialchars($mah_bazar); ?>" />
    <input type="hidden" name="dah_bazar" value="<?php echo htmlspecialchars($dah_bazar); ?>" />
    <?php
}

function generate_hidden_inputs_agri() {
    global $id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, 
           $no_kesh, $m_ab, $no_ab, $z_sal, $mah_qroup, $cod_mah, $zka1, $zka2, $zkb1, $zkb2, 
           $sba1, $sba2, $sbb1, $sbb2, $mtolp1, $mtolp2, $mtol1, $mtol2, $mah_bem, $mah_kh,
           $date_s1, $date_s2, $history_filter;
    ?>
    <input type="hidden" name="action" value="1" />
    <input type="hidden" name="history_filter" value="<?php echo htmlspecialchars($history_filter); ?>" />
    <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
    <input type="hidden" name="id_city" value="<?php echo htmlspecialchars($id_city); ?>" />
    <input type="hidden" name="id_mar" value="<?php echo htmlspecialchars($id_mar); ?>" />
    <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($add_abadi); ?>" />
    <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($add_city); ?>" />
    <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m); ?>" />
    <input type="hidden" name="mor_cod_m" value="<?php echo htmlspecialchars($mor_cod_m); ?>" />
    <input type="hidden" name="no_kesh" value="<?php echo htmlspecialchars($no_kesh); ?>" />
    <input type="hidden" name="m_ab" value="<?php echo htmlspecialchars($m_ab); ?>" />
    <input type="hidden" name="no_ab" value="<?php echo htmlspecialchars($no_ab); ?>" />
    <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
    <input type="hidden" name="mah_qroup" value="<?php echo htmlspecialchars($mah_qroup); ?>" />
    <input type="hidden" name="cod_mah" value="<?php echo htmlspecialchars($cod_mah); ?>" />
    <input type="hidden" name="zka1" value="<?php echo htmlspecialchars($zka1); ?>" />
    <input type="hidden" name="zka2" value="<?php echo htmlspecialchars($zka2); ?>" />
    <input type="hidden" name="zkb1" value="<?php echo htmlspecialchars($zkb1); ?>" />
    <input type="hidden" name="zkb2" value="<?php echo htmlspecialchars($zkb2); ?>" />
    <input type="hidden" name="sba1" value="<?php echo htmlspecialchars($sba1); ?>" />
    <input type="hidden" name="sba2" value="<?php echo htmlspecialchars($sba2); ?>" />
    <input type="hidden" name="sbb1" value="<?php echo htmlspecialchars($sbb1); ?>" />
    <input type="hidden" name="sbb2" value="<?php echo htmlspecialchars($sbb2); ?>" />
    <input type="hidden" name="mtolp1" value="<?php echo htmlspecialchars($mtolp1); ?>" />
    <input type="hidden" name="mtolp2" value="<?php echo htmlspecialchars($mtolp2); ?>" />
    <input type="hidden" name="mtol1" value="<?php echo htmlspecialchars($mtol1); ?>" />
    <input type="hidden" name="mtol2" value="<?php echo htmlspecialchars($mtol2); ?>" />
    <input type="hidden" name="mah_bem" value="<?php echo htmlspecialchars($mah_bem); ?>" />
    <input type="hidden" name="mah_kh" value="<?php echo htmlspecialchars($mah_kh); ?>" />
    <input type="hidden" name="date_s1" value="<?php echo htmlspecialchars($date_s1); ?>" />
    <input type="hidden" name="date_s2" value="<?php echo htmlspecialchars($date_s2); ?>" />
    <?php
}

function show_filter_buttons($current_filter) {
    ?>
    <div class="filter-section">
        <div class="filter-title">
            <span>🔍</span> فیلتر سابقه کشت
        </div>
        <div class="filter-buttons">
            <button type="button" class="filter-btn filter-btn-all <?php echo ($current_filter == 'all') ? 'filter-btn-active' : 'filter-btn-inactive'; ?>" data-filter="all">
                📋 همه رکوردها
            </button>
            <button type="button" class="filter-btn filter-btn-with <?php echo ($current_filter == 'with_history') ? 'filter-btn-active' : 'filter-btn-inactive'; ?>" data-filter="with_history">
                🟢 دارای سابقه (۵ سال اخیر)
            </button>
            <button type="button" class="filter-btn filter-btn-without <?php echo ($current_filter == 'without_history') ? 'filter-btn-active' : 'filter-btn-inactive'; ?>" data-filter="without_history">
                🔴 فاقد سابقه (۵ سال اخیر)
            </button>
        </div>
    </div>
    <input type="hidden" id="current-history-filter" value="<?php echo $current_filter; ?>" />
    <?php
}

// اگر درخواست Ajax باشد، فقط محتوای مورد نیاز را خروجی می‌دهیم
if ($is_ajax) {
    ob_start();
}

if (isset($_POST['z_sal'])) {
    // ==================== بخش محصول صیفی ====================
    if ($cod_mah == 170 || $cod_mah == 172 || $cod_mah == 174) {
        if ($id_ostan1 == '-1') { $v_id_ostan = 1; } else { $v_id_ostan = "id_ostan='$id_ostan1'"; }
        if ($id_city == 0) { $v_id_city = 1; } else { $v_id_city = "id_city='$id_city'"; }
        if ($id_mar == 0) { $v_id_mar = 1; } else { $v_id_mar = "id_mar='$id_mar'"; }
        if ($mor_cod_m == '') { $v_mor_cod_m = 1; } else { $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'"; }
        if ($z_sal == '') { $v_z_sal = 1; } else { $v_z_sal = "z_sal = '$z_sal'"; }
        $v_cod_mah = "cod_mah = '$cod_mah'";
        
        include_once('../../login/config.php');
        
        $history_condition = "";
        
        if ($history_filter == 'with_history') {
            $parts_year = explode('-', $z_sal);
            $current_start = (int)$parts_year[0];
            $five_years_ago = $current_start - 5;
            
            $sub_query = "SELECT DISTINCT bah_cod_m FROM Vege_prod WHERE cod_mah = '$cod_mah' AND SUBSTRING_INDEX(z_sal, '-', 1) >= '$five_years_ago' AND SUBSTRING_INDEX(z_sal, '-', 1) < '$current_start'";
            $history_condition = " AND bah_cod_m IN ($sub_query) ";
            
        } elseif ($history_filter == 'without_history') {
            $parts_year = explode('-', $z_sal);
            $current_start = (int)$parts_year[0];
            $five_years_ago = $current_start - 5;
            
            $sub_query = "SELECT DISTINCT bah_cod_m FROM Vege_prod WHERE cod_mah = '$cod_mah' AND SUBSTRING_INDEX(z_sal, '-', 1) >= '$five_years_ago' AND SUBSTRING_INDEX(z_sal, '-', 1) < '$current_start'";
            $history_condition = " AND bah_cod_m NOT IN ($sub_query) ";
        }
        
        $start = 0;
        $limit = 10;
        $id_page = isset($_GET['id']) ? intval($_GET['id']) : 1;
        $start = ($id_page - 1) * $limit;
        
        $query = "SELECT * FROM Vege_prod WHERE $v_id_ostan AND $v_id_city AND $v_id_mar AND $v_mor_cod_m AND $v_z_sal AND $v_cod_mah $history_condition ORDER BY bah_cod_m ASC LIMIT $start, $limit";
        $query1 = "SELECT COUNT(*) FROM Vege_prod WHERE $v_id_ostan AND $v_id_city AND $v_id_mar AND $v_mor_cod_m AND $v_z_sal AND $v_cod_mah $history_condition";
        
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $t_row = $stmt->rowCount();
        
        if (!$is_ajax) {
            show_filter_buttons($history_filter);
        }
        
        if ($t_row > 0) {
            ?>
            <div class="download-buttons">
                <form action="Vege_rep2_xls.php" method="post">
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1; ?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city; ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar; ?>" />
                    <input type="hidden" name="add_abadi" value="0" />
                    <input type="hidden" name="add_city" value="0" />
                    <input type="hidden" name="ra_kesh" value="<?php echo $ra_kesh; ?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m; ?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
                    <input type="hidden" name="b_time" value="<?php echo $b_time; ?>" />
                    <input type="hidden" name="mah_name" value="<?php echo $cod_mah; ?>" />
                    <input type="hidden" name="zka1" value="<?php echo $zka1; ?>" />
                    <input type="hidden" name="zka2" value="<?php echo $zka2; ?>" />
                    <input type="hidden" name="ragham" value="<?php echo $ragham; ?>" />
                    <input type="hidden" name="no_ab" value="<?php echo $no_ab; ?>" />
                    <input type="hidden" name="sba1" value="<?php echo $sba1; ?>" />
                    <input type="hidden" name="sba2" value="<?php echo $sba2; ?>" />
                    <input type="hidden" name="mtolp1" value="<?php echo $mtolp1; ?>" />
                    <input type="hidden" name="mtolp2" value="<?php echo $mtolp2; ?>" />
                    <input type="hidden" name="mtol1" value="<?php echo $mtol1; ?>" />
                    <input type="hidden" name="mtol2" value="<?php echo $mtol2; ?>" />
                    <input type="hidden" name="mah_bazar" value="<?php echo $mah_bazar; ?>" />
                    <input type="hidden" name="dah_bazar" value="<?php echo $dah_bazar; ?>" />
                    <input type="hidden" name="history_filter" value="<?php echo $history_filter; ?>" />
                    <button class="download-btn"><img src="../../files/xls.png" alt=""/> دانلود اکسل</button>
                </form>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>🌱 نام محصول : <?php echo mah_name($cod_mah) ?></h3>
                </div>
                <div class="card-body">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>سابقه</th>
                                <th>جزئیات</th>
                                <th>فصل تولید</th>
                                <th>میزان قطعی</th>
                                <th>میزان پیش‌بینی</th>
                                <th>سطح برداشت</th>
                                <th>سطح زیر کشت</th>
                                <th>کد ملی</th>
                                <th>نام بهره‌بردار</th>
                                <th>ردیف</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                $r = $start + 1;
                foreach ($stmt as $row) {
                    if ($row['b_time'] == '1') $v_b_time = 'زمستانه';
                    if ($row['b_time'] == '2') $v_b_time = 'بهاره';
                    if ($row['b_time'] == '3') $v_b_time = 'تابستانه';
                    if ($row['b_time'] == '4') $v_b_time = 'پاییزه';
                    ?>
                            <tr>
                                <td>
                                    <form action="history_bah_zk.php" method="post" onsubmit="target_popup1(this)" style="display: inline;">
                                        <input type="hidden" name="z_sal" value="<?php echo $row['z_sal']; ?>" />
                                        <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan']; ?>" />
                                        <input type="hidden" name="id_mar" value="<?php echo $row['id_mar']; ?>" />
                                        <input type="hidden" name="cod_mah" value="<?php echo $row['cod_mah']; ?>" />
                                        <input type="hidden" name="id_city" value="<?php echo $row['id_city']; ?>" />
                                        <input type="hidden" name="mor_cod_m" value="<?php echo $row['mor_cod_m']; ?>" />
                                        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']; ?>" />
                                        <button class="action-btn" title="بررسی سوابق"><img src="../../files/komo2.png" alt=""/></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="Vegedata_T_view.php" method="post" onsubmit="target_popup2(this)" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['Vege_id']; ?>" />
                                        <button class="action-btn" title="نمایش"><img src="../../files/view.png" alt=""/></button>
                                    </form>
                                    <?php echo check_production_status_pdo($dbh, $row['bah_cod_m'], $row['z_sal'], $row['cod_mah']); ?>
                                </td>
                                <td><?php echo $v_b_time; ?></td>
                                <td><?php echo round($row['mah_tol'], 3) * 1; ?></td>
                                <td><?php echo round($row['mah_tolp'], 3) * 1; ?></td>
                                <td><?php echo $row['s_bar'] + 0; ?></td>
                                <td><?php echo $row['zer_kesht'] + 0; ?></td>
                                <td><?php echo $row['bah_cod_m']; ?></td>
                                <td style="text-align: right;"><?php echo bah_name($row['bah_cod_m']); ?></td>
                                <td><?php echo $r; ?></td>
                            </tr>
                    <?php
                    $r++;
                }
                ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        } else {
            echo '<div class="empty-message"><h3>📭 اطلاعاتی یافت نشد</h3><p>لطفاً معیارهای جستجوی خود را تغییر دهید.</p></div>';
        }
        
        $stmt1 = $dbh->prepare($query1);
        $stmt1->execute();
        $rows = $stmt1->fetchColumn();
        $total = ceil($rows / $limit);
        $visible_pages = 5;
        $start_page = max(1, $id_page - $visible_pages);
        $end_page = min($total, $id_page + $visible_pages);
        
        if ($total > 0) {
        ?>
        <div class="pagination-container">
            <ul class="pagination">
                <?php if ($id_page > 1) { ?>
                    <li>
                        <form action="list_bah_zk.php?id=<?php echo $id_page - 1; ?>#1" method="post" style="display: inline;">
                            <?php generate_hidden_inputs_vege(); ?>
                            <button type="submit" class="nav-btn">« قبلی</button>
                        </form>
                    </li>
                <?php } ?>
                <?php if ($start_page > 1) { ?>
                    <li>
                        <form action="list_bah_zk.php?id=1#1" method="post" style="display: inline;">
                            <?php generate_hidden_inputs_vege(); ?>
                            <button type="submit" class="page-btn">1</button>
                        </form>
                    </li>
                    <?php if ($start_page > 2) { echo '<li style="color:#999; padding:5px 10px;">...</li>'; } ?>
                <?php } ?>
                <?php for ($i = $start_page; $i <= $end_page; $i++) { ?>
                    <li>
                        <?php if ($i == $id_page) { ?>
                            <span class="page-btn-active"><?php echo $i; ?></span>
                        <?php } else { ?>
                            <form action="list_bah_zk.php?id=<?php echo $i; ?>#1" method="post" style="display: inline;">
                                <?php generate_hidden_inputs_vege(); ?>
                                <button type="submit" class="page-btn"><?php echo $i; ?></button>
                            </form>
                        <?php } ?>
                    </li>
                <?php } ?>
                <?php if ($end_page < $total) { ?>
                    <?php if ($end_page < $total - 1) { echo '<li style="color:#999; padding:5px 10px;">...</li>'; } ?>
                    <li>
                        <form action="list_bah_zk.php?id=<?php echo $total; ?>#1" method="post" style="display: inline;">
                            <?php generate_hidden_inputs_vege(); ?>
                            <button type="submit" class="page-btn"><?php echo $total; ?></button>
                        </form>
                    </li>
                <?php } ?>
                <?php if ($id_page < $total) { ?>
                    <li>
                        <form action="list_bah_zk.php?id=<?php echo $id_page + 1; ?>#1" method="post" style="display: inline;">
                            <?php generate_hidden_inputs_vege(); ?>
                            <button type="submit" class="nav-btn">بعدی »</button>
                        </form>
                    </li>
                <?php } ?>
            </ul>
            <?php if ($id_page < $total || $id_page > 1) { ?>
            <div class="page-jump">
                <form id="pageJumpFormVege" action="list_bah_zk.php" method="post">
                    <span>📄 رفتن به صفحه:</span>
                    <input type="number" name="page_input" min="1" max="<?php echo $total; ?>" value="<?php echo $id_page; ?>" />
                    <button type="submit" class="nav-btn">برو</button>
                    <?php generate_hidden_inputs_vege(); ?>
                </form>
            </div>
            <?php } ?>
        </div>
        <?php
        }
    }
    // ==================== بخش محصولات غیر صیفی ====================
    else {
        $filters = array();
        
        if ($date_s1 != '') { $filters[] = "$Agri_prod_table.date_s >= '$date_s1'"; }
        if ($date_s2 != '') { $filters[] = "$Agri_prod_table.date_s <= '$date_s2'"; }
        if ($id_ostan1 != '' && $id_ostan1 != '-1') { $filters[] = "$Agri_prod_table.id_ostan = '$id_ostan1'"; }
        if ($id_city != '') { $filters[] = "$Agri_prod_table.id_city = '$id_city'"; }
        if ($id_mar != '') { $filters[] = "$Agri_prod_table.id_mar = '$id_mar'"; }
        if ($add_abadi != '') { $filters[] = "$Agri_prod_table.add_abadi = '$add_abadi'"; }
        if ($add_city != '') { $filters[] = "$Agri_prod_table.add_city = '$add_city'"; }
        if ($no_kesh != '') { $filters[] = "$Agri_prod_table.no_kesh = '$no_kesh'"; }
        if ($m_ab != '') { $filters[] = "$Agri_table.m_ab = '$m_ab'"; }
        if ($no_ab != '') { $filters[] = "$Agri_table.no_ab = '$no_ab'"; }
        if ($mor_cod_m != '') { $filters[] = "$Agri_prod_table.mor_cod_m = '$mor_cod_m'"; }
        if ($bah_cod_m != '') { $filters[] = "$Agri_prod_table.bah_cod_m = '$bah_cod_m'"; }
        if ($cod_mah != '') { $filters[] = "$Agri_prod_table.cod_mah = '$cod_mah'"; }
        if ($zka1 != '') { $filters[] = "$Agri_prod_table.zer_kesht_a >= '$zka1'"; }
        if ($zka2 != '') { $filters[] = "$Agri_prod_table.zer_kesht_a <= '$zka2'"; }
        if ($zkb1 != '') { $filters[] = "$Agri_prod_table.zer_kesht_b >= '$zkb1'"; }
        if ($zkb2 != '') { $filters[] = "$Agri_prod_table.zer_kesht_b <= '$zkb2'"; }
        if ($sba1 != '') { $filters[] = "$Agri_prod_table.s_bar_a >= '$sba1'"; }
        if ($sba2 != '') { $filters[] = "$Agri_prod_table.s_bar_a <= '$sba2'"; }
        if ($sbb1 != '') { $filters[] = "$Agri_prod_table.s_bar_b >= '$sbb1'"; }
        if ($sbb2 != '') { $filters[] = "$Agri_prod_table.s_bar_b <= '$sbb2'"; }
        if ($mtol1 != '') { $filters[] = "$Agri_prod_table.mah_tol >= '$mtol1'"; }
        if ($mtol2 != '') { $filters[] = "$Agri_prod_table.mah_tol <= '$mtol2'"; }
        if ($mtolp1 != '') { $filters[] = "$Agri_prod_table.mah_tolp >= '$mtolp1'"; }
        if ($mtolp2 != '') { $filters[] = "$Agri_prod_table.mah_tolp <= '$mtolp2'"; }
        if ($mah_kh != '') { $filters[] = "$Agri_prod_table.mah_kh = '$mah_kh'"; }
        if ($mah_bem != '') { $filters[] = "$Agri_prod_table.mah_bem = '$mah_bem'"; }
        
        if ($history_filter == 'with_history') {
            $parts_year = explode('-', $z_sal);
            $current_start = (int)$parts_year[0];
            
            $history_conditions = array();
            for ($i = 1; $i <= 5; $i++) {
                $prev_start = $current_start - $i;
                $prev_end = $prev_start + 1;
                $table_name = "Agri_prod" . $prev_start . "_" . $prev_end;
                $history_conditions[] = "EXISTS (SELECT 1 FROM $table_name WHERE $table_name.bah_cod_m = $Agri_prod_table.bah_cod_m AND $table_name.cod_mah = '$cod_mah')";
            }
            if (count($history_conditions) > 0) {
                $filters[] = "(" . implode(" OR ", $history_conditions) . ")";
            } else {
                $filters[] = "1=0";
            }
            
        } elseif ($history_filter == 'without_history') {
            $parts_year = explode('-', $z_sal);
            $current_start = (int)$parts_year[0];
            
            $history_conditions = array();
            for ($i = 1; $i <= 5; $i++) {
                $prev_start = $current_start - $i;
                $prev_end = $prev_start + 1;
                $table_name = "Agri_prod" . $prev_start . "_" . $prev_end;
                $history_conditions[] = "NOT EXISTS (SELECT 1 FROM $table_name WHERE $table_name.bah_cod_m = $Agri_prod_table.bah_cod_m AND $table_name.cod_mah = '$cod_mah')";
            }
            if (count($history_conditions) > 0) {
                $filters[] = "(" . implode(" AND ", $history_conditions) . ")";
            }
        }
        
        $query_conditions = implode(' AND ', $filters);
        if ($query_conditions == '') {
            $query_conditions = '1=1';
        }
        
        $start = 0;
        $limit = 10;
        $id_page = isset($_GET['id']) ? intval($_GET['id']) : 1;
        $start = ($id_page - 1) * $limit;
        
        $query = "SELECT $Agri_prod_table.*, $Agri_table.m_ab, $Agri_table.no_ab
                  FROM $Agri_prod_table
                  INNER JOIN $Agri_table ON $Agri_table.id = $Agri_prod_table.Agri_id
                  WHERE $query_conditions
                  ORDER BY bah_cod_m ASC
                  LIMIT $start, $limit";
        $query1 = "SELECT COUNT(*) FROM $Agri_prod_table
                   INNER JOIN $Agri_table ON $Agri_table.id = $Agri_prod_table.Agri_id
                   WHERE $query_conditions";
        
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $t_row = $stmt->rowCount();
        
        if (!$is_ajax) {
            show_filter_buttons($history_filter);
        }
        
        if ($t_row > 0) {
            ?>
            <div class="download-buttons">
                <form action="Agri_rep172_xls.php" method="post">
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1; ?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city; ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar; ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city; ?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh; ?>" />
                    <input type="hidden" name="m_ab" value="<?php echo $m_ab; ?>" />
                    <input type="hidden" name="no_ab" value="<?php echo $no_ab; ?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m; ?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
                    <input type="hidden" name="cod_mah" value="<?php echo $cod_mah; ?>" />
                    <input type="hidden" name="zka1" value="<?php echo $zka1; ?>" />
                    <input type="hidden" name="zka2" value="<?php echo $zka2; ?>" />
                    <input type="hidden" name="zkb1" value="<?php echo $zkb1; ?>" />
                    <input type="hidden" name="zkb2" value="<?php echo $zkb2; ?>" />
                    <input type="hidden" name="sba1" value="<?php echo $sba1; ?>" />
                    <input type="hidden" name="sba2" value="<?php echo $sba2; ?>" />
                    <input type="hidden" name="sbb1" value="<?php echo $sbb1; ?>" />
                    <input type="hidden" name="sbb2" value="<?php echo $sbb2; ?>" />
                    <input type="hidden" name="mtolp1" value="<?php echo $mtolp1; ?>" />
                    <input type="hidden" name="mtolp2" value="<?php echo $mtolp2; ?>" />
                    <input type="hidden" name="mtol1" value="<?php echo $mtol1; ?>" />
                    <input type="hidden" name="mtol2" value="<?php echo $mtol2; ?>" />
                    <input type="hidden" name="mah_bem" value="<?php echo $mah_bem; ?>" />
                    <input type="hidden" name="mah_kh" value="<?php echo $mah_kh; ?>" />
                    <input type="hidden" name="date_s1" value="<?php echo $date_s1; ?>" />
                    <input type="hidden" name="date_s2" value="<?php echo $date_s2; ?>" />
                    <input type="hidden" name="history_filter" value="<?php echo $history_filter; ?>" />
                    <button class="download-btn"><img src="../../files/xls.png" alt=""/> دانلود اکسل</button>
                </form>
                <form action="Agri_rep172_doc.php" method="post">
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1; ?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city; ?>" />
                    <input type="hidden" name="id_mar" value="<?php echo $id_mar; ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city; ?>" />
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh; ?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m; ?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
                    <input type="hidden" name="cod_mah" value="<?php echo $cod_mah; ?>" />
                    <input type="hidden" name="zka1" value="<?php echo $zka1; ?>" />
                    <input type="hidden" name="zka2" value="<?php echo $zka2; ?>" />
                    <input type="hidden" name="zkb1" value="<?php echo $zkb1; ?>" />
                    <input type="hidden" name="zkb2" value="<?php echo $zkb2; ?>" />
                    <input type="hidden" name="sba1" value="<?php echo $sba1; ?>" />
                    <input type="hidden" name="sba2" value="<?php echo $sba2; ?>" />
                    <input type="hidden" name="sbb1" value="<?php echo $sbb1; ?>" />
                    <input type="hidden" name="sbb2" value="<?php echo $sbb2; ?>" />
                    <input type="hidden" name="mtolp1" value="<?php echo $mtolp1; ?>" />
                    <input type="hidden" name="mtolp2" value="<?php echo $mtolp2; ?>" />
                    <input type="hidden" name="mtol1" value="<?php echo $mtol1; ?>" />
                    <input type="hidden" name="mtol2" value="<?php echo $mtol2; ?>" />
                    <input type="hidden" name="mah_bem" value="<?php echo $mah_bem; ?>" />
                    <input type="hidden" name="mah_kh" value="<?php echo $mah_kh; ?>" />
                    <input type="hidden" name="date_s1" value="<?php echo $date_s1; ?>" />
                    <input type="hidden" name="date_s2" value="<?php echo $date_s2; ?>" />
                    <input type="hidden" name="history_filter" value="<?php echo $history_filter; ?>" />
                    <button class="download-btn"><img src="../../files/word.png" alt=""/> دانلود ورد</button>
                </form>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>🌾 نام محصول : <?php echo mah_name($cod_mah) ?></h3>
                </div>
                <div class="card-body">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>سابقه</th>
                                <th>جزئیات</th>
                                <th>میزان قطعی</th>
                                <th>میزان پیش‌بینی</th>
                                <th>سطح برداشت</th>
                                <th>سطح زیر کشت</th>
                                <th>کد ملی</th>
                                <th>نام بهره‌بردار</th>
                                <th>ردیف</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                $r = $start + 1;
                foreach ($stmt as $row) {
                    ?>
                            <tr>
                                <td>
                                    <form action="history_bah_zk.php" method="post" onsubmit="target_popup1(this)" style="display: inline;">
                                        <input type="hidden" name="z_sal" value="<?php echo $row['z_sal']; ?>" />
                                        <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan']; ?>" />
                                        <input type="hidden" name="id_mar" value="<?php echo $row['id_mar']; ?>" />
                                        <input type="hidden" name="cod_mah" value="<?php echo $row['cod_mah']; ?>" />
                                        <input type="hidden" name="id_city" value="<?php echo $row['id_city']; ?>" />
                                        <input type="hidden" name="mor_cod_m" value="<?php echo $row['mor_cod_m']; ?>" />
                                        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']; ?>" />
                                        <button class="action-btn" title="بررسی سوابق"><img src="../../files/komo2.png" alt=""/></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="Agridata_view1.php" method="post" onsubmit="target_popup1(this)" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['Agri_id']; ?>" />
                                        <input type="hidden" name="z_sal" value="<?php echo $row['z_sal']; ?>" />
                                        <button class="action-btn" title="نمایش"><img src="../../files/view.png" alt=""/></button>
                                    </form>
                                    <?php echo check_agri_status_pdo($dbh, $row['bah_cod_m'], $row['z_sal'], $row['cod_mah']); ?>
                                </td>
                                <td><?php echo round($row['mah_tol'], 3) * 1; ?></td>
                                <td><?php echo round($row['mah_tolp'], 3) * 1; ?></td>
                                <td><?php echo $row['s_bar_a'] + $row['s_bar_b']; ?></td>
                                <td><?php echo $row['zer_kesht_a'] + $row['zer_kesht_b']; ?></td>
                                <td><?php echo $row['bah_cod_m']; ?></td>
                                <td style="text-align: right;"><?php echo bah_name($row['bah_cod_m']); ?></td>
                                <td><?php echo $r; ?></td>
                            </tr>
                    <?php
                    $r++;
                }
                ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        } else {
            echo '<div class="empty-message"><h3>📭 اطلاعاتی یافت نشد</h3><p>لطفاً معیارهای جستجوی خود را تغییر دهید.</p></div>';
        }
        
        $stmt1 = $dbh->prepare($query1);
        $stmt1->execute();
        $rows = $stmt1->fetchColumn();
        $total = ceil($rows / $limit);
        $visible_pages = 2;
        $start_page = max(1, $id_page - $visible_pages);
        $end_page = min($total, $id_page + $visible_pages);
        
        if ($total > 0) {
        ?>
        <div class="pagination-container">
            <ul class="pagination">
                <?php if ($id_page > 1) { ?>
                    <li>
                        <form action="list_bah_zk.php?id=<?php echo $id_page - 1; ?>#1" method="post" style="display: inline;">
                            <?php generate_hidden_inputs_agri(); ?>
                            <button type="submit" class="nav-btn">« قبلی</button>
                        </form>
                    </li>
                <?php } ?>
                <?php if ($start_page > 1) { ?>
                    <li>
                        <form action="list_bah_zk.php?id=1#1" method="post" style="display: inline;">
                            <?php generate_hidden_inputs_agri(); ?>
                            <button type="submit" class="page-btn">1</button>
                        </form>
                    </li>
                    <?php if ($start_page > 2) { echo '<li style="color:#999; padding:5px 10px;">...</li>'; } ?>
                <?php } ?>
                <?php for ($i = $start_page; $i <= $end_page; $i++) { ?>
                    <li>
                        <?php if ($i == $id_page) { ?>
                            <span class="page-btn-active"><?php echo $i; ?></span>
                        <?php } else { ?>
                            <form action="list_bah_zk.php?id=<?php echo $i; ?>#1" method="post" style="display: inline;">
                                <?php generate_hidden_inputs_agri(); ?>
                                <button type="submit" class="page-btn"><?php echo $i; ?></button>
                            </form>
                        <?php } ?>
                    </li>
                <?php } ?>
                <?php if ($end_page < $total) { ?>
                    <?php if ($end_page < $total - 1) { echo '<li style="color:#999; padding:5px 10px;">...</li>'; } ?>
                    <li>
                        <form action="list_bah_zk.php?id=<?php echo $total; ?>#1" method="post" style="display: inline;">
                            <?php generate_hidden_inputs_agri(); ?>
                            <button type="submit" class="page-btn"><?php echo $total; ?></button>
                        </form>
                    </li>
                <?php } ?>
                <?php if ($id_page < $total) { ?>
                    <li>
                        <form action="list_bah_zk.php?id=<?php echo $id_page + 1; ?>#1" method="post" style="display: inline;">
                            <?php generate_hidden_inputs_agri(); ?>
                            <button type="submit" class="nav-btn">بعدی »</button>
                        </form>
                    </li>
                <?php } ?>
            </ul>
            <?php if ($id_page < $total || $id_page > 1) { ?>
            <div class="page-jump">
                <form id="pageJumpFormAgri" action="list_bah_zk.php" method="post">
                    <span>📄 رفتن به صفحه:</span>
                    <input type="number" name="page_input" min="1" max="<?php echo $total; ?>" value="<?php echo $id_page; ?>" />
                    <button type="submit" class="nav-btn">برو</button>
                    <?php generate_hidden_inputs_agri(); ?>
                </form>
            </div>
            <?php } ?>
        </div>
        <?php
        }
    }
}

// اگر درخواست Ajax باشد، خروجی را برگردانده و پایان می‌دهیم
if ($is_ajax) {
    $output = ob_get_clean();
    echo $output;
    exit;
}
?>
</div>
</body>
</html>