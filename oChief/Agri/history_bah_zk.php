<?php
require_once("../../lock_oce.php");
require_once("../../event.php");
require_once("../../login/config.php");
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
}
else 
{
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

// ایجاد نام جدول بر اساس سال
$Agri_table = 'Agri' . str_replace('-', '_', $z_sal);
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
}
// تعریف مقدار اولیه برای Z_SAL برای استفاده در جاوااسکریپت (به عنوان سال مرجع)
// فرض می‌کنیم که اگر پارامتر z_sal در POST موجود باشد، مقدار 'اولیه' آن از یک جای دیگر (شاید یک فیلد مخفی در صفحه قبلی) آمده است.
// برای سادگی، یک فیلد مخفی با نام initial_z_sal ایجاد می‌کنیم که همیشه سال مرجع را نگه دارد.
$initial_z_sal = isset($_POST['initial_z_sal']) ? $_POST['initial_z_sal'] : $z_sal;


?>
<?php
// ... کدهای PHP موجود در فایل (require_once، تعریف متغیرها و...)
// ... (تعریف متغیرهای POST در ابتدای فایل، مانند: $id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';)

// تابع جدید برای تولید فیلدهای مخفی از متغیرهای POST
function generate_all_hidden_inputs($is_vege_case) {
    // تعریف متغیرهای سراسری (GLOBAL) مورد نیاز در هر دو حالت
    global $id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $mor_cod_m, $bah_cod_m, $cod_mah;
    
    $inputs = array();

    // متغیرهای خاص بخش صیفی (Vege - Vegetables/Fruits: cod_mah == 170 || 172 || 174)
    if ($is_vege_case) {
        // توجه: $id_city5 در POST برای صیفی استفاده می‌شود، اما معمولاً در PHP با $id_city هندل می‌شود
        global $ra_kesh, $b_time, $mah_name, $zka1, $zka2, $ragham, $no_ab, $sba1, $sba2, $mtolp1, $mtolp2, $mtol1, $mtol2, $mah_bazar, $dah_bazar;
        $inputs = array(
            'id_ostan'    => $id_ostan1, 
            'id_city5'    => $id_city, // استفاده از نام فیلد اصلی در POST
            'id_mar'      => $id_mar, 
            'add_abadi'   => $add_abadi, 
            'add_city'    => $add_city, 
            'ra_kesh'     => $ra_kesh, 
            'mor_cod_m'   => $mor_cod_m, 
            'bah_cod_m'   => $bah_cod_m, 
            'b_time'      => $b_time, 
            'mah_name'    => $mah_name, 
            'zka1'        => $zka1, 
            'zka2'        => $zka2, 
            'ragham'      => $ragham, 
            'no_ab'       => $no_ab, 
            'sba1'        => $sba1, 
            'sba2'        => $sba2, 
            'mtolp1'      => $mtolp1, 
            'mtolp2'      => $mtolp2, 
            'mtol1'       => $mtol1, 
            'mtol2'       => $mtol2, 
            'mah_bazar'   => $mah_bazar, 
            'dah_bazar'   => $dah_bazar,
            'cod_mah'     => $cod_mah
        );
    } 
    // متغیرهای خاص بخش سایر محصولات (Agri)
    else {
        global $no_kesh, $m_ab, $zkb1, $zkb2, $sbb1, $sbb2, $mah_qroup, $mah_kh, $mah_bem, $date_s1, $date_s2;
        $inputs = array(
            'id_ostan'    => $id_ostan1, 
            'id_city'     => $id_city, 
            'id_mar'      => $id_mar, 
            'add_abadi'   => $add_abadi, 
            'add_city'    => $add_city, 
            'no_kesh'     => $no_kesh, 
            'm_ab'        => $m_ab, 
            'mor_cod_m'   => $mor_cod_m, 
            'bah_cod_m'   => $bah_cod_m, 
            'cod_mah'     => $cod_mah, 
            'zka1'        => $zka1, 
            'zka2'        => $zka2, 
            'zkb1'        => $zkb1, 
            'zkb2'        => $zkb2, 
            'sba1'        => $sba1, 
            'sba2'        => $sba2, 
            'sbb1'        => $sbb1, 
            'sbb2'        => $sbb2, 
            'mtol1'       => $mtol1, 
            'mtol2'       => $mtol2, 
            'mtolp1'      => $mtolp1, 
            'mtolp2'      => $mtolp2, 
            'mah_qroup'   => $mah_qroup, 
            'mah_kh'      => $mah_kh, 
            'mah_bem'     => $mah_bem, 
            'date_s1'     => $date_s1, 
            'date_s2'     => $date_s2
        );
    }

    // تولید فیلدهای مخفی
    foreach ($inputs as $name => $value) {
        // فیلدهای سال (z_sal و initial_z_sal) مستقیماً در HTML تولید می‌شوند
        if (!empty($value) || $value === '0' || $value === 0) {
            echo '<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '" />';
        }
    }
}
// ... بقیه کدهای PHP و سپس شروع HTML ...
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
<style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #FFC107;
            --background-light: #f5f7fa;
            --card-background: #ffffff;
            --text-color: #333;
            --border-color: #e0e0e0;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --border-radius: 12px;
        }

        body {
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            background-color: var(--background-light);
            color: var(--text-color);
            margin: 0;
            padding: 24px;

        }

        .close-btn-container {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .card {
            background: var(--card-background);
            padding: 24px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        h2 {
            text-align: center;
            color: var(--primary-color);
            margin-top: 0;
            font-size: 1.8rem;
        }

        .chart-container {
            position: relative;
        }

        .info-message {
            text-align: center;
            padding: 24px;
            background-color: #fff3e0;
            border: 1px solid #ffcc80;
            border-radius: 8px;
            color: #e65100;
            font-size: 1.2rem;
        }
        
        .close-btn {
            background-color: #F44336;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .close-btn:hover {
            background-color: #D32F2F;
            transform: translateY(-2px);
        }

        .close-btn:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .container {
                padding: 16px;
            }
            h2 {
                font-size: 1.5rem;
            }
            .close-btn-container {
                top: 10px;
                left: 10px;
            }
        }
        
        /* --- کدهای CSS اضافه شده برای مدیریت سال --- */
        .year-controls-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px; /* فاصله بیشتر برای ظاهر بهتر */
            margin: 15px 0;
            padding: 15px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            background-color: var(--card-background);
        }

        .year-display {
            font-size: 1.8rem; /* بزرگتر شدن نمایش سال */
            font-weight: bold;
            color: var(--primary-color); 
            min-width: 150px;
            text-align: center;
        }

        .year-btn {
            padding: 10px 18px;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            transition: background-color 0.3s, opacity 0.3s, transform 0.2s;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .year-btn-prev {
            background-color: #f44336; /* رنگ قرمز برای سال قبل */
            color: white;
        }
        .year-btn-prev:hover:not(:disabled) {
             background-color: #d32f2f;
             transform: translateY(-1px);
        }

        .year-btn-next {
            background-color: #2196f3; /* رنگ آبی برای سال بعد */
            color: white;
            display: none; /* در ابتدا مخفی است */
        }
        .year-btn-next:hover:not(:disabled) {
             background-color: #1976d2;
             transform: translateY(-1px);
        }

        .year-btn:disabled {
            background-color: #9e9e9e; /* خاکستری برای غیرفعال */
            cursor: not-allowed;
            opacity: 0.7;
            box-shadow: none;
        }

</style>
<script type="text/javascript">

function target_popup(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=950,height=700"); 
    form.target = 'formpopup';
}
    function target_Agri17(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600"); 
    form.target = 'formpopup'; 
	}
   
   // --- منطق جاوا اسکریپت برای مدیریت سال ---
   document.addEventListener('DOMContentLoaded', function() {
    // مقداردهی اولیه از PHP (سال مرجع)
    const initialSalString = "<?php echo htmlspecialchars($initial_z_sal); ?>";
    let currentSalString = "<?php echo htmlspecialchars($z_sal); ?>"; // سالی که در حال نمایش است
    const maxStepsBack = 5; // حداکثر تعداد سالی که می‌توان به عقب رفت

    // عناصر DOM
    const display = document.getElementById('currentSalDisplay');
    const prevBtn = document.getElementById('prevYearBtn');
    const nextBtn = document.getElementById('nextYearBtn');

    /**
     * یک سال از رشته سال (مثلاً 1404-1405) کم می‌کند.
     */
    function decreaseYear(salStr) {
        try {
            const parts = salStr.split('-');
            const startYear = parseInt(parts[0]);
            const endYear = parseInt(parts[1]);
            return `${startYear - 1}-${endYear - 1}`;
        } catch (e) {
            return salStr;
        }
    }

    /**
     * یک سال به رشته سال (مثلاً 1403-1404) اضافه می‌کند.
     */
    function increaseYear(salStr) {
        try {
            const parts = salStr.split('-');
            const startYear = parseInt(parts[0]);
            const endYear = parseInt(parts[1]);
            return `${startYear + 1}-${endYear + 1}`;
        } catch (e) {
            return salStr;
        }
    }
    
    /**
     * سال نمایش داده شده را از سال اولیه کسر می‌کند تا تعداد قدم‌های عقب رفته مشخص شود.
     * @returns {number} تعداد قدم‌های عقب رفته (مقدار مثبت)
     */
    function calculateStepsBack(current, initial) {
        try {
            const initialStartYear = parseInt(initial.split('-')[0]);
            const currentStartYear = parseInt(current.split('-')[0]);
            return initialStartYear - currentStartYear;
        } catch (e) {
            return 0; // در صورت خطا، 0 در نظر گرفته می‌شود
        }
    }
    
    let stepsBack = calculateStepsBack(currentSalString, initialSalString);


    /**
     * وضعیت دکمه‌ها را به روز رسانی کرده و فرم اصلی را سابمیت می‌کند.
     */
function updateYearAndSubmit(newSal) {
        // فرض بر این است که متغیرهای currentSalString و initialSalString در محیط جهانی تعریف شده‌اند
        currentSalString = newSal;
        // stepsBack = calculateStepsBack(currentSalString, initialSalString); // در صورت نیاز به به‌روزرسانی دکمه‌ها

        // 1. هدف قرار دادن فرم جدید و مخفی yearChangeForm
        const mainForm = document.getElementById('yearChangeForm');

        if (mainForm) {
            // به روز رسانی فیلدهای سال در فرم مخفی
            let zSalInput = document.getElementById('hiddenZSal');
            let initialSalInput = document.getElementById('hiddenInitialZSal');

            if (zSalInput && initialSalInput) {
                // به‌روزرسانی مقدار سال جاری برای ارسال
                zSalInput.value = currentSalString;
                // مقدار سال مرجع ثابت است
                initialSalInput.value = initialSalString; 

                // سابمیت کردن فرم به فایل جاری (history_bah_zk.php) با پارامترهای جدید
                mainForm.submit();
            } else {
                 alert("خطا: فیلدهای سال در فرم اصلی پیدا نشد.");
            }
        } else {
             // این خطا نباید دیگر نمایش داده شود
             alert("خطا: فرم اصلی برای ارسال داده‌ها پیدا نشد.");
        }
    }
    // --- مدیریت کلیک‌ها ---
    
    prevBtn.addEventListener('click', function() {
        if (stepsBack < maxStepsBack) {
            const newSal = decreaseYear(currentSalString);
            updateYearAndSubmit(newSal);
        }
    });

    nextBtn.addEventListener('click', function() {
        if (currentSalString !== initialSalString) {
            const newSal = increaseYear(currentSalString);
            updateYearAndSubmit(newSal);
        }
    });

    // --- تنظیم وضعیت اولیه (بدون سابمیت کردن) ---
    function setInitialButtonState() {
        display.textContent = currentSalString;
        
        // سال قبل
        if (stepsBack >= maxStepsBack) {
            prevBtn.disabled = true;
        } else {
            prevBtn.disabled = false;
        }

        // سال بعد
        if (stepsBack > 0) {
            nextBtn.style.display = 'flex'; 
            if (currentSalString === initialSalString) {
                nextBtn.disabled = true; 
            } else {
                nextBtn.disabled = false;
            }
        } else {
            nextBtn.style.display = 'none'; 
        }
    }
    
    setInitialButtonState();
    
});

   </script>

</head>
<body>
<form id="yearChangeForm" action="history_bah_zk.php" method="post" style="display: none;">
    <?php 
        // تعیین اینکه در حالت صیفی هستیم یا سایر محصولات
        $is_vege = ($cod_mah == 170 || $cod_mah == 172 || $cod_mah == 174);
        generate_all_hidden_inputs($is_vege); 
    ?>
    <input type="hidden" name="z_sal" id="hiddenZSal" value="<?php echo htmlspecialchars($z_sal); ?>" />
    <input type="hidden" name="initial_z_sal" id="hiddenInitialZSal" value="<?php echo htmlspecialchars($initial_z_sal); ?>" />
</form>
<div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">بستن پنجره</button>
</div>
<div class="container">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td  colspan="3" valign="middle" >
        <p><span class="style19"> بررسی سوابق کشت محصول : <?php echo mah_name($cod_mah)?> توسط این بهره بردار در سال </span></p>

        <div class="year-controls-container">
            <button id="prevYearBtn" class="year-btn year-btn-prev" title="یک سال به عقب">
                <span style="margin-right: 5px;">&#x25C0;</span> سال قبل
            </button>
            
            <span id="currentSalDisplay" class="year-display"></span>

            <button id="nextYearBtn" class="year-btn year-btn-next" title="یک سال به جلو">
                سال بعد <span style="margin-left: 5px;">&#x25B6;</span>
            </button>
        </div>
        <p>&nbsp; </p>
             <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['z_sal'])) 
 {  
if ($cod_mah == 170 || $cod_mah == 172 || $cod_mah == 174) {
if(1==1){
 if ($id_ostan1 == '-1') { $v_id_ostan  = 1   ;}else{$v_id_ostan  = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      { $v_id_city   = 1   ;}else{$v_id_city   = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      { $v_id_mar    = 1   ;}else{$v_id_mar    = "id_mar='$id_mar'" ;}
 if ($mor_cod_m == '')   { $v_mor_cod_m = 1   ;}else{$v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')   { $v_bah_cod_m = 1   ;}else{$v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')       { $v_z_sal     = 1   ;}else{$v_z_sal     = "z_sal = '$z_sal'" ;}
 $v_cod_mah   = "cod_mah = '$cod_mah'" ;
 include_once('../../login/config.php');
$start=0;
$limit=25;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start=($id-1)*$limit;
 $query = "SELECT * from  Vege_prod where  $v_id_ostan  and  $v_id_city  and  $v_id_mar and  $v_mor_cod_m and  $v_bah_cod_m and $v_z_sal  and  $v_cod_mah  ORDER BY bah_cod_m ASC LIMIT $start, $limit "; 
 $query1 = "SELECT count(*) from  Vege_prod where  $v_id_ostan  and  $v_id_city  and  $v_id_mar and  $v_mor_cod_m and  $v_bah_cod_m and $v_z_sal  and  $v_cod_mah"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
        </p>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Vege_rep2_xls.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="0" />
                   <input type="hidden" name="add_city"  value="0" />
                   <input type="hidden" name="ra_kesh"   value="<?php echo  $ra_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="b_time" value="<?php echo $b_time;?>" />
                   <input type="hidden" name="mah_name"  value="<?php echo $cod_mah ;?>" />
                   <input type="hidden" name="zka1"  value="<?php echo $zka1 ;?>" />
                   <input type="hidden" name="zka2"  value="<?php echo $zka2 ;?>" />
                   <input type="hidden" name="ragham"  value="<?php echo $ragham ;?>" />
                   <input type="hidden" name="no_ab"  value="<?php echo $no_ab ;?>" />
                   <input type="hidden" name="sba1"  value="<?php echo $sba1 ;?>" />
                   <input type="hidden" name="sba2"  value="<?php echo $sba2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="mah_bazar"  value="<?php echo  $mah_bazar ;?>" />
                   <input type="hidden" name="dah_bazar"  value="<?php echo  $dah_bazar ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
             <br />
            <table width="90%" align="center" class="my-table" >
              <tr class="text1">
                <td colspan="2" rowspan="2" bgcolor="#006600">عملیات</td>
                <td width="6%" rowspan="2" bgcolor="#006600">نام محصول</td>
                <td width="10%" rowspan="2" bgcolor="#006600">فصل تولید </td>
          <td colspan="2" bgcolor="#006600">میزان محصول / تن</td>
          <td colspan="2" bgcolor="#006600">مساحت/هکتار</td>
          <td  colspan="2" bgcolor="#006600">مشخصات بهره بردار</td>
          <td width="5%" rowspan="2" bgcolor="#006600">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="9%" bgcolor="#006600">قطعی</td>
          <td width="9%" bgcolor="#006600">پیش بینی</td>
          <td width="7%" bgcolor="#006600">سطح برداشت</td>
          <td width="11%" bgcolor="#006600">سطح زیر کشت</td>
          <td width="12%" bgcolor="#006600" class="style8"><img src="../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="16%" bgcolor="#006600">نام و نام خانوادگی</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['b_time']=='1')  $v_b_time='زمستانه/استمرار';
if ($row['b_time']=='2')  $v_b_time='بهاره';
if ($row['b_time']=='3')  $v_b_time='تابستانه';
if ($row['b_time']=='4')  $v_b_time='پاییزه';
  ?>
          <td height="58" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>  <form  action="../send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
            <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
            <button><img src="../../files/receive_mail.png" width="31" height="30" title="ارسال پیام " /></button>
          </form></td>
          <td width="8%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Vegedata_T_view.php" method="post" onsubmit="target_popup2(this)">
              <input type="hidden" name="id"  value="<?php echo $row['Vege_id'] ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_b_time ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht']+0 ; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>

<?php
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1->fetchColumn();
$total = ceil($rows/$limit);
// Function to generate hidden inputs (reduces code duplication)
function generate_hidden_inputs() {
    global $id_ostan1, $id_city, $id_mar, $add_abadi, $add_city,
           $ra_kesh, $mor_cod_m, $bah_cod_m, $z_sal, $b_time, $cod_mah,
           $zka1, $zka2, $ragham, $no_ab, $sba1, $sba2, $mtolp1, $mtolp2,
           $mtol1, $mtol2, $mah_bazar, $dah_bazar;
    ?>
    <input type="hidden" name="action" value="1" />
    <input type="hidden" name="id_ostan" value="<?= htmlspecialchars($id_ostan1) ?>" />
    <input type="hidden" name="id_city5" value="<?= htmlspecialchars($id_city) ?>" />
    <input type="hidden" name="id_mar" value="<?= htmlspecialchars($id_mar) ?>" />
    <input type="hidden" name="add_abadi" value="<?= htmlspecialchars($add_abadi) ?>" />
    <input type="hidden" name="add_city" value="<?= htmlspecialchars($add_city) ?>" />
    <input type="hidden" name="ra_kesh" value="<?= htmlspecialchars($ra_kesh) ?>" />
    <input type="hidden" name="mor_cod_m" value="<?= htmlspecialchars($mor_cod_m) ?>" />
    <input type="hidden" name="bah_cod_m" value="<?= htmlspecialchars($bah_cod_m) ?>" />
    <input type="hidden" name="z_sal" value="<?= htmlspecialchars($z_sal) ?>" />
    <input type="hidden" name="b_time" value="<?= htmlspecialchars($b_time) ?>" />
    <input type="hidden" name="cod_mah" value="<?= htmlspecialchars($cod_mah) ?>" />
    <input type="hidden" name="zka1" value="<?= htmlspecialchars($zka1) ?>" />
    <input type="hidden" name="zka2" value="<?= htmlspecialchars($zka2) ?>" />
    <input type="hidden" name="ragham" value="<?= htmlspecialchars($ragham) ?>" />
    <input type="hidden" name="no_ab" value="<?= htmlspecialchars($no_ab) ?>" />
    <input type="hidden" name="sba1" value="<?= htmlspecialchars($sba1) ?>" />
    <input type="hidden" name="sba2" value="<?= htmlspecialchars($sba2) ?>" />
    <input type="hidden" name="mtolp1" value="<?= htmlspecialchars($mtolp1) ?>" />
    <input type="hidden" name="mtolp2" value="<?= htmlspecialchars($mtolp2) ?>" />
    <input type="hidden" name="mtol1" value="<?= htmlspecialchars($mtol1) ?>" />
    <input type="hidden" name="mtol2" value="<?= htmlspecialchars($mtol2) ?>" />
    <input type="hidden" name="mah_bazar" value="<?= htmlspecialchars($mah_bazar) ?>" />
    <input type="hidden" name="dah_bazar" value="<?= htmlspecialchars($dah_bazar) ?>" />
    <?php
}

// Define visible pages range (shows 5 pages at a time)
$visible_pages = 5;
$start_page = max(1, $id - $visible_pages);
$end_page = min($total, $id + $visible_pages);
?>

<div dir="rtl" class="pagination-container" style="margin: 20px auto; text-align: center; padding: 15px;">
    <ul class="pagination" style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; flex-wrap: wrap; gap: 5px;">
        <?php if($id > 1): ?>
            <li style="display: inline-block;">
              <form action="list_bah_zk.php?id=<?= $id-1 ?>#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">&laquo; قبلی</button>
              </form>
            </li>
        <?php endif; ?>

        <?php if($start_page > 1): ?>
            <li style="display: inline-block;">
              <form action="list_bah_zk.php?id=1#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;">1</button>
              </form>
            </li>
            <?php if($start_page > 2): ?>
                <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
            <?php endif; ?>
        <?php endif; ?>

        <?php for($i = $start_page; $i <= $end_page; $i++): ?>
            <li style="display: inline-block;">
                <?php if($i == $id): ?>
                    <span style="background: #4CAF50; color: white; padding: 5px 10px; border-radius: 4px; display: inline-block;"><?= $i ?></span>
                <?php else: ?>
              <form action="list_bah_zk.php?id=<?= $i ?>#1" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $i ?></button>
              </form>
                <?php endif; ?>
            </li>
        <?php endfor; ?>

        <?php if($end_page < $total): ?>
            <?php if($end_page < $total - 1): ?>
                <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
            <?php endif; ?>
            <li style="display: inline-block;">
              <form action="list_bah_zk.php?id=<?= $total ?>#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $total ?></button>
              </form>
            </li>
        <?php endif; ?>

        <?php if($id < $total): ?>
            <li style="display: inline-block;">
              <form action="list_bah_zk.php?id=<?= $id+1 ?>#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">بعدی &raquo;</button>
              </form>
            </li>
        <?php endif; ?>
    </ul>

    <?php if($id < $total || $id > 1): ?>
    <div class="page-jump" style="margin-top: 15px;">
        <form action="list_bah_zk.php" method="post" style="display: inline-flex; align-items: center; gap: 10px;">
            <?php generate_hidden_inputs(); ?>
            <span style="font-size: 14px;"> به صفحه:</span>
            <input type="number" name="page_input"
                   value="<?= $id ?>" style="width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
            <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">برو</button>
        </form>
    </div>
    <?php endif; ?>
</div>

<script>
document.querySelector('.page-jump form').addEventListener('submit', function(e) {

    const pageInput = this.querySelector('input[name="page_input"]');
    const pageNum = parseInt(pageInput.value);

    if (isNaN(pageNum)) {
        e.preventDefault();
        alert('لطفاً یک عدد معتبر وارد کنید');
        return;
    }

    if (pageNum < 1 || pageNum > <?= $total ?>) {
        e.preventDefault();
        alert('لطفاً عددی بین 1 و <?= $total ?> وارد کنید');
        return;
    }

    this.action = `list_bah_zk.php?id=${pageNum}#1`;
});
</script>
<?php 
}
// پایان اگر محصول صیفی باشد
else
{
// ایجاد یک آرایه برای فیلترها
$filters = array(
    'date_s1' => $date_s1,
    'date_s2' => $date_s2,
    'id_ostan1' => $id_ostan1,
    'id_city' => $id_city,
    'id_mar' => $id_mar,
    'add_abadi' => $add_abadi,
    'add_city' => $add_city,
    'no_kesh' => $no_kesh,
    'm_ab' => $m_ab,
    'no_ab' => $no_ab,
    'mor_cod_m' => $mor_cod_m,
    'bah_cod_m' => $bah_cod_m,
    'z_sal' => $z_sal, // اضافه کردن z_sal به فیلترها
    'initial_z_sal' => $initial_z_sal, // اضافه کردن initial_z_sal به فیلترها
    'cod_mah' => $cod_mah,
    'zka1' => $zka1,
    'zka2' => $zka2,
    'zkb1' => $zkb1,
    'zkb2' => $zkb2,
    'sba1' => $sba1,
    'sba2' => $sba2,
    'sbb1' => $sbb1,
    'sbb2' => $sbb2,
    'mtol1' => $mtol1,
    'mtol2' => $mtol2,
    'mtolp1' => $mtolp1,
    'mtolp2' => $mtolp2,
    'mah_kh' => $mah_kh,
    'mah_bem' => $mah_bem,
);

// ایجاد یک آرایه برای شرایط
$query_parts = array();

// بررسی و اضافه کردن هر فیلتر به آرایه شرایط
foreach ($filters as $key => $value) {
    if ($value != '') {
        switch ($key) {
            case 'date_s1':
                $query_parts[] = "$Agri_prod_table.date_s >= '$value'";
                break;
            case 'date_s2':
                $query_parts[] = "$Agri_prod_table.date_s <= '$value'";
                break;
            case 'id_ostan1':
                if ($value != '-1') {
                    $query_parts[] = "$Agri_prod_table.id_ostan = '$value'";
                }
                break;
            case 'id_city':
                $query_parts[] = "$Agri_prod_table.id_city = '$value'";
                break;
            case 'id_mar':
                $query_parts[] = "$Agri_prod_table.id_mar = '$value'";
                break;
            case 'add_abadi':
                $query_parts[] = "$Agri_prod_table.add_abadi = '$value'";
                break;
            case 'add_city':
                $query_parts[] = "$Agri_prod_table.add_city = '$value'";
                break;
            case 'no_kesh':
                $query_parts[] = "$Agri_prod_table.no_kesh = '$value'";
                break;
            case 'm_ab':
                $query_parts[] = "$Agri_table.m_ab = '$value'";
                break;
            case 'no_ab':
                $query_parts[] = "$Agri_table.no_ab = '$value'";
                break;
            case 'mor_cod_m':
                $query_parts[] = "$Agri_prod_table.mor_cod_m = '$value'";
                break;
            case 'bah_cod_m':
                $query_parts[] = "$Agri_prod_table.bah_cod_m = '$value'";
                break;
            case 'cod_mah':
                $query_parts[] = "$Agri_prod_table.cod_mah = '$value'";
                break;
            case 'zka1':
                $query_parts[] = "$Agri_prod_table.zer_kesht_a >= '$value'";
                break;
            case 'zka2':
                $query_parts[] = "$Agri_prod_table.zer_kesht_a <= '$value'";
                break;
            case 'zkb1':
                $query_parts[] = "$Agri_prod_table.zer_kesht_b >= '$value'";
                break;
            case 'zkb2':
                $query_parts[] = "$Agri_prod_table.zer_kesht_b <= '$value'";
                break;
            case 'sba1':
                $query_parts[] = "$Agri_prod_table.s_bar_a >= '$value'";
                break;
            case 'sba2':
                $query_parts[] = "$Agri_prod_table.s_bar_a <= '$value'";
                break;
            case 'sbb1':
                $query_parts[] = "$Agri_prod_table.s_bar_b >= '$value'";
                break;
            case 'sbb2':
                $query_parts[] = "$Agri_prod_table.s_bar_b <= '$value'";
                break;
            case 'mtol1':
                $query_parts[] = "$Agri_prod_table.mah_tol >= '$value'";
                break;
            case 'mtol2':
                $query_parts[] = "$Agri_prod_table.mah_tol <= '$value'";
                break;
            case 'mtolp1':
                $query_parts[] = "$Agri_prod_table.mah_tolp >= '$value'";
                break;
            case 'mtolp2':
                $query_parts[] = "$Agri_prod_table.mah_tolp <= '$value'";
                break;
            case 'mah_kh':
                $query_parts[] = "$Agri_prod_table.mah_kh = '$value'";
                break;
            case 'mah_bem':
                $query_parts[] = "$Agri_prod_table.mah_bem = '$value'";
                break;
        }
    }
}

// ایجاد شرایط کوئری
$query_conditions = implode(' AND ', $query_parts);
// ایجاد کوئری نهایی
$start=0;
$limit=25;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start = ($id - 1) * $limit;
  $query = "SELECT $Agri_prod_table.*, $Agri_table.m_ab, $Agri_table.no_ab
          FROM $Agri_prod_table
          INNER JOIN $Agri_table ON $Agri_table.id = $Agri_prod_table.Agri_id
          WHERE $query_conditions
          ORDER BY bah_cod_m ASC
          LIMIT $start, $limit";
 $query1 = "SELECT count(*)  FROM $Agri_prod_table
          INNER JOIN $Agri_table ON $Agri_table.id = $Agri_prod_table.Agri_id
          WHERE $query_conditions
"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
        <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
        <table width="122" height="56" border="0" align="center">
               <tr>
                 <td width="56"><form  action="Agri_rep172_xls.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh"   value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="m_ab"       value="<?php echo  $m_ab ;?>" />
                   <input type="hidden" name="no_ab"      value="<?php echo  $no_ab ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="initial_z_sal" value="<?php echo $initial_z_sal ;?>" /> 
                   <input type="hidden" name="cod_mah"  value="<?php echo $cod_mah ;?>" />
                   <input type="hidden" name="zka1"  value="<?php echo $zka1 ;?>" />
                   <input type="hidden" name="zka2"  value="<?php echo $zka2 ;?>" />
                   <input type="hidden" name="zkb1"  value="<?php echo $zkb1 ;?>" />
                   <input type="hidden" name="zkb2"  value="<?php echo $zkb2 ;?>" />
                   <input type="hidden" name="sba1"  value="<?php echo $sba1 ;?>" />
                   <input type="hidden" name="sba2"  value="<?php echo $sba2 ;?>" />
                   <input type="hidden" name="sbb1"  value="<?php echo $sbb1 ;?>" />
                   <input type="hidden" name="sbb2"  value="<?php echo $sbb2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="mah_bem"  value="<?php echo $mah_bem ;?>" />
                   <input type="hidden" name="mah_kh"  value="<?php echo $mah_kh ;?>" />
                   <input type="hidden" name="date_s1"  value="<?php echo $date_s1 ;?>" />
                   <input type="hidden" name="date_s2"  value="<?php echo $date_s2 ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                 <td width="56"><form  action="Agri_rep172_doc.php" method="post">
                   <input type="hidden" name="id_ostan"  value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city"   value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar"    value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city"  value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh"   value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="initial_z_sal" value="<?php echo $initial_z_sal ;?>" />
                   <input type="hidden" name="cod_mah"  value="<?php echo $cod_mah ;?>" />
                   <input type="hidden" name="zka1"  value="<?php echo $zka1 ;?>" />
                   <input type="hidden" name="zka2"  value="<?php echo $zka2 ;?>" />
                   <input type="hidden" name="zkb1"  value="<?php echo $zkb1 ;?>" />
                   <input type="hidden" name="zkb2"  value="<?php echo $zkb2 ;?>" />
                   <input type="hidden" name="sba1"  value="<?php echo $sba1 ;?>" />
                   <input type="hidden" name="sba2"  value="<?php echo $sba2 ;?>" />
                   <input type="hidden" name="sbb1"  value="<?php echo $sbb1 ;?>" />
                   <input type="hidden" name="sbb2"  value="<?php echo $sbb2 ;?>" />
                   <input type="hidden" name="mtolp1"  value="<?php echo $mtolp1 ;?>" />
                   <input type="hidden" name="mtolp2"  value="<?php echo $mtolp2 ;?>" />
                   <input type="hidden" name="mtol1"  value="<?php echo $mtol1 ;?>" />
                   <input type="hidden" name="mtol2"  value="<?php echo $mtol2 ;?>" />
                   <input type="hidden" name="mah_bem"  value="<?php echo $mah_bem ;?>" />
                   <input type="hidden" name="mah_kh"  value="<?php echo $mah_kh ;?>" />
                   <input type="hidden" name="date_s1"  value="<?php echo $date_s1 ;?>" />
                   <input type="hidden" name="date_s2"  value="<?php echo $date_s2 ;?>" />
                   <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
                 </form></td>

               </tr>
             </table>
             <br />
            <table width="85%" align="center" class="my-table" >
              <tr class="text1">
                <td colspan="2" rowspan="2" bgcolor="#006600">عملیات</td>
                <td width="7%" rowspan="2" bgcolor="#006600">نوع کشت</td>
                <td width="7%" rowspan="2" bgcolor="#006600">نام محصول</td>
                <td width="7%" colspan="2" bgcolor="#006600">عملکرد تولید <br />                  <span class="style2">کیلوگرم در هکتار</span></td>
          <td colspan="2" bgcolor="#006600">میزان محصول <br /><span class="style2">تن</span></td>
          <td colspan="2" bgcolor="#006600">مساحت<br />            <span class="style2">هکتار</span></td>
          <td  colspan="2" bgcolor="#006600">مشخصات بهره بردار</td>
          <td width="4%" rowspan="2" bgcolor="#006600">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="7%" bgcolor="#006600">قطعی</td>
          <td width="7%" bgcolor="#006600">پیش بینی</td>
          <td width="6%" bgcolor="#006600">قطعی</td>
          <td width="7%" bgcolor="#006600">پیش بینی</td>
          <td width="7%" bgcolor="#006600">سطح برداشت</td>
          <td width="6%" bgcolor="#006600">سطح زیر کشت</td>
          <td width="11%" bgcolor="#006600" class="style8"><span class="text1"> کد ملی</span></td>
          <td width="17%" bgcolor="#006600">نام و نام خانوادگی</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if($row['no_kesh'] =='1') $v_no_kesh = 'آبی' ; 
if($row['no_kesh'] =='2') $v_no_kesh = 'دیم' ; 
  ?>
          <td width="6%" height="80" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> 
            <form  action="../send_pm1.php#1" method="post" onsubmit="target_Agri17(this)">
              <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
              <button><img src="../../files/receive_mail.png" width="31" height="30" title="ارسال پیام " /></button>
            </form></td>
          <td width="6%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Agridata_view1.php" method="post" onsubmit="target_popup1(this)">
              <input type="hidden" name="id"  value="<?php echo $row['Agri_id'] ;?>" />
              <input type="hidden" name="z_sal"  value="<?php echo $row['z_sal'] ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['mah_tol'] /  ($row['s_bar_a'] + $row['s_bar_b']))*1000,1) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['mah_tolp'] /  ($row['zer_kesht_a'] + $row['zer_kesht_b']))*1000,1) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']+$row['s_bar_b'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a'] + $row['zer_kesht_b'] ; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
if(isset($query1)) {
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute();
    $rows = $stmt1->fetchColumn();
    $total = ceil($rows/$limit);
    
    // Set visible pages range (3 before and after current page)
    $visible_pages = 3;
    $start_page = max(1, $id - $visible_pages);
    $end_page = min($total, $id + $visible_pages);
    
    $show_first = ($start_page > 1);
    $show_last = ($end_page < $total);
    
    // Function to generate hidden inputs
    function generate_hidden_inputs() {
        global $action, $id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, $mor_cod_m, 
               $no_kesh, $m_ab, $no_ab, $z_sal, $initial_z_sal, $mah_qroup, $cod_mah, $zka1, $zka2, $zkb1, $zkb2, 
               $sba1, $sba2, $sbb1, $sbb2, $mtolp1, $mtolp2, $mtol1, $mtol2, $mah_bem, $mah_kh;
        ?>
        <input type="hidden" name="action" value="1" />
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
        <input type="hidden" name="initial_z_sal" value="<?php echo htmlspecialchars($initial_z_sal); ?>" />
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
        <?php
    }
    ?>
    
    <div dir="rtl" class="pagination-container" style="margin: 20px auto; text-align: center; background: #fff; padding: 15px; border-radius: 15px; width: 98%;">
        <ul class="pagination" style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; flex-wrap: wrap; gap: 5px;">
            <?php if($id > 1): ?>
                <li style="display: inline-block; margin: 2px;">
                    <form action="list_bah_zk.php?id=<?php echo $id-1 ?>#1" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #06C; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">&laquo; قبلی</button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($show_first): ?>
                <li style="display: inline-block; margin: 2px;">
                    <form action="list_bah_zk.php?id=1#1" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #f8f8f8; color: #06C; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;">1</button>
                    </form>
                </li>
                <?php if($start_page > 2): ?>
                    <li style="display: inline-block; margin: 2px; color: #999; padding: 5px 10px;">...</li>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                <li style="display: inline-block; margin: 2px;">
                    <?php if($i == $id): ?>
                        <span style="background: #06C; color: white; padding: 5px 10px; border-radius: 4px; display: inline-block;"><?php echo $i; ?></span>
                    <?php else: ?>
                        <form action="list_bah_zk.php?id=<?php echo $i ?>#1" method="post" style="display: inline;">
                            <?php generate_hidden_inputs(); ?>
                            <button type="submit" class="button" style="background: #f8f8f8; color: #06C; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?php echo $i; ?></button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>
            
            <?php if($show_last): ?>
                <?php if($end_page < $total - 1): ?>
                    <li style="display: inline-block; margin: 2px; color: #999; padding: 5px 10px;">...</li>
                <?php endif; ?>
                <li style="display: inline-block; margin: 2px;">
                    <form action="list_bah_zk.php?id=<?php echo $total ?>#1" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #f8f8f8; color: #06C; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?php echo $total; ?></button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($id < $total): ?>
                <li style="display: inline-block; margin: 2px;">
                    <form action="list_bah_zk.php?id=<?php echo $id+1 ?>#1" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #06C; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">بعدی &raquo;</button>
                    </form>
                </li>
            <?php endif; ?>
        </ul>
        
        <div class="page-jump" style="margin-top: 15px;">
            <form id="pageJumpForm" action="list_bah_zk.php" method="post" style="display: inline-flex; align-items: center; gap: 10px;">
                <?php generate_hidden_inputs(); ?>
                <span style="font-size: 14px;">به صفحه:</span>
                <input type="number" name="page_input" min="1" max="<?php echo $total; ?>" 
                       value="<?php echo $id; ?>" 
                       style="width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
                <button type="submit" class="button" style="background: #06C; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">برو</button>
            </form>
        </div>
    </div>

    <script>
    document.getElementById('pageJumpForm').addEventListener('submit', function(e) {
        const pageInput = this.querySelector('input[name="page_input"]');
        const pageNum = parseInt(pageInput.value);
        
        if (isNaN(pageNum)) {
            e.preventDefault();
            alert('لطفاً یک عدد وارد کنید');
            return;
        }
        
        if (pageNum < 1 || pageNum > <?php echo $total; ?>) {
            e.preventDefault();
            alert('لطفاً عددی بین 1 و <?php echo $total; ?> وارد کنید');
            return;
        }
        this.action = `list_bah_zk.php?id=${pageNum}#1`;
    });
    </script>
<?php }} ?>
    </td>
  </tr>
</table>
</div>
</body>
</html>