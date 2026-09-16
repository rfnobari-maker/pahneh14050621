<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php');
$mess = $add_abadi = $add_city = $m_poul = '' ; 
if (isset($_POST['no_mal'])) $no_mal = test_input($_POST['no_mal']);
if (isset($_POST['bah_cod_m'])) $bah_cod_m = test_input($_POST['bah_cod_m']);
if (isset($_POST['no_kesh'])) $no_kesh = test_input($_POST['no_kesh']);
if (isset($_POST['action1'])) {
    ?>
    <form name="myform" class="myform" method="post" action="../benef.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
}
if (isset($_POST["m_poul"])) {
    $m_poul = $_POST["m_poul"];
}
if (isset($_POST["add_abadi"])) {
    $add_abadi = $_POST["add_abadi"];
    $m_poul = $_POST["m_poul"];
}
if (isset($_POST["add_city"])) {
    $add_city = $_POST["add_city"];
    $m_poul = $_POST["m_poul"];
}
if (isset($_POST['action'])) {
    $m_poul = $_POST["m_poul"];
    if ($m_poul == '') $mess = 'موقعیت بهره برداری را تعیین کنید ' . '<p>';
    $add_city = $_POST["add_city"];
    if ($m_poul == 'shahr' and $add_city == '') $mess .= 'نام شهر را انتخاب کنید' . '<p>';
    $add_abadi = $_POST["add_abadi"];
    if ($m_poul == 'abadi' and $add_abadi == '') $mess .= 'نام آبادی را انتخاب کنید' . '<p>';
    $bah_cod_m = $_POST['bah_cod_m'];
    if ($bah_cod_m == '') $mess .= 'کد ملی را وارد کنید' . '<p>';
     $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
    if ($no_kesh == '') $mess .= 'نوع کشت را انتخاب کنید' . '<p>';
    $no_mal = $_POST['no_mal'];
    if ($no_mal == '') $mess .= 'نوع مالکیت را انتخاب کنید' . '<p>';
   // if ($bah_cod_m <> '' & check_code_melli($bah_cod_m) <> 1) $mess .= 'کد ملی بهره بردار صحیح نیست';
    if ((isset($_POST['action'])) and ($mess == '')) {
        $query = "SELECT num_bah from bah where bah_cod_m = :bah_cod_m";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
        $count_codm = $stmt -> rowCount();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
       $num_bah = '';  // اضافه کنید
      if ($count_codm == 1) { $num_bah = $row['num_bah']; }
      if ($count_codm > 1) {       ?>
            <form name="myform1" class="myform" method="post" action="bah_history.php">
                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>"/>
                <input type="hidden" name="num_bah" value="<?php echo $num_bah; ?>"/>
                <input type="hidden" name="m_poul" value="<?php echo $m_poul; ?>"/>
                <input type="hidden" name="add_city" value="<?php echo $add_city; ?>"/>
                <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>"/>
                <input type="hidden" name="no_kesh" value="<?php echo $no_kesh; ?>"/>
                <input type="hidden" name="no_mal" value="<?php echo $no_mal; ?>"/>
            </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
        }
        if ($count_codm == 0) {
            $mess = 'اطلاعات بهره بردار یافت نشد <p> برای ثبت اطلاعات بهره برداری زراعی ، ابتدا اطلاعات بهره بردار را ثبت نمایید ';
            $not_found_bah = true;
        } else {
            /*    $query = "SELECT count(*) from Agri where bah_cod_m = $bah_cod_m";
                   $stmt = $dbh->prepare($query);
                   $stmt->execute();
                   $count_codm = $stmt->fetchColumn();
                    if ($count_codm>0) { */
            // نمایش سوابق زراعی : بلی
            if ($_POST['agri_h'] == '2') {
                ?>
                <form name="myform1" class="myform" method="post" action="Agri_history.php">
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>"/>
                    <input type="hidden" name="m_poul" value="<?php echo $m_poul; ?>"/>
                    <input type="hidden" name="add_city" value="<?php echo $add_city; ?>"/>
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>"/>
                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh; ?>"/>
                    <input type="hidden" name="no_mal" value="<?php echo $no_mal; ?>"/>
                </form>
                <script type="text/javascript">document.myform1.submit();</script>
                <?php
            }
            ?>
            <form name="myform1" class="myform" method="post" action="Agri_data1.php">
                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>"/>
                <input type="hidden" name="num_bah" value="<?php echo $num_bah; ?>"/>
                <input type="hidden" name="m_poul" value="<?php echo $m_poul; ?>"/>
                <input type="hidden" name="add_city" value="<?php echo $add_city; ?>"/>
                <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>"/>
                <input type="hidden" name="no_kesh" value="<?php echo $no_kesh; ?>"/>
                <input type="hidden" name="no_mal" value="<?php echo $no_mal; ?>"/>
            </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
        }
    }
}
?>
<!DOCTYPE html >
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />
    
    <link href="../../FA.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../reza_1.css">
    <link href="../radio.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    
    <style type="text/css">
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Vazir', Tahoma, sans-serif;
            min-height: 100vh;
            padding: 20px;
        }
        .main-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .header-img { width: 100%; height: auto; display: block; }
        .form-header {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            padding: 25px 30px;
            text-align: center;
        }
        .form-header h1 { color: white; font-size: 24px; font-weight: 500; margin: 0; }
        .form-header p { color: #a0aec0; font-size: 14px; margin-top: 8px; }
        .form-content { direction:rtl ; padding: 35px 40px; background: #f8fafc; }
        .error-message {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .error-message i { font-size: 18px; }
        .form-row {
            margin-bottom: 25px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
        }
        .form-label {
            width: 180px;
            font-weight: 600;
            color: #2d3748;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .form-label i { color: #667eea; width: 20px; }
        .form-field { flex: 1; min-width: 200px; }
        .radio-group { display: flex; gap: 25px; align-items: center; }
        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 14px;
            color: #4a5568;
        }
        .radio-label input[type="radio"] {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #cbd5e0;
            border-radius: 50%;
            margin: 0;
            cursor: pointer;
            transition: all 0.2s;
        }
        .radio-label input[type="radio"]:checked {
            border-color: #667eea;
            background-color: #667eea;
            box-shadow: inset 0 0 0 4px white;
        }
        .search-wrapper {
            position: relative;
            display: block;
        }
        .search-input, input[type="text"], select {
            width: 100%;
            padding: 12px 15px;
            font-size: 14px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-family: 'Vazir', Tahoma, sans-serif;
            transition: all 0.3s ease;
            background: white;
            color: #2d3748;
            direction: rtl;
        }
        .search-input:focus, input[type="text"]:focus, select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .dropdown-arrow {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #a0aec0;
            font-size: 14px;
            background: white;
            padding: 0 5px;
            transition: all 0.2s;
            z-index: 10;
        }
        .dropdown-arrow:hover { color: #667eea; }
        .custom-dropdown-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            max-height: 250px;
            overflow-y: auto;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            z-index: 1000;
            display: none;
            direction: rtl;
            text-align: right;
            margin-top: 5px;
        }
        .custom-dropdown-list div {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s;
            font-size: 14px;
            color: #4a5568;
        }
        .custom-dropdown-list div:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 14px 35px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Vazir', Tahoma, sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
        }
        .btn-back {
            background: linear-gradient(135deg, #718096 0%, #4a5568 100%);
            padding: 10px 25px;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 10px;
            color: white;
            transition: all 0.3s;
        }
        .btn-back:hover {
            transform: translateX(5px);
            color: white;
        }
        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            justify-content: center;
            flex-wrap: wrap;
        }
        #rasul {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 9999;
            backdrop-filter: blur(5px);
        }
        #rasul img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
        }
        @media (max-width: 768px) {
            .form-content { padding: 20px; }
            .form-row { flex-direction: column; align-items: stretch; }
            .form-label { width: auto; }
        }
        select { background: white; cursor: pointer; }
        .error {
            display: block;
            color: #e53e3e;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div id="rasul">
    <img src="img/loading2.gif" alt="loading">
</div>

<div class="main-container">
    <div>
        <img src="../../files/images/header.jpg" class="header-img" alt="header">
    </div>
    
    <?php include('menu.php'); ?>
    
    <div class="form-header">
        <h1><i class="fas fa-tractor"></i> ثبت اطلاعات بهره برداری زراعی جدید</h1>
        <p>لطفاً اطلاعات زیر را با دقت وارد کنید</p>
    </div>
    
    <div class="form-content">
        <?php if (isset($mess) && $mess != '') { ?>
            <div class="error-message">
                <i class="fas fa-exclamation-triangle"></i>
                <?php echo $mess; ?>
            </div>
        <?php } ?>
        
        <form id="reg-form" method="post" action="#1" onsubmit="return validateForm()">
            <div class="form-row">
                <div class="form-label">
                    <i class="fas fa-map-marker-alt"></i> موقعیت بهره برداری:
                </div>
                <div class="form-field">
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" class="region" name="m_poul" <?php if ($m_poul == 'shahr') echo 'checked="checked"'; ?> value="shahr"/>
                            <span>شهر</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" class="region" name="m_poul" <?php if ($m_poul == 'abadi') echo 'checked="checked"'; ?> value="abadi"/>
                            <span>آبادی</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-label">
                    <i class="fas fa-city"></i> <span id="location_label">نام شهر:</span>
                </div>
                <div class="form-field">
                    <div id="shahr_container" class="shahr_select" style="<?php echo ($m_poul == 'shahr') ? '' : 'display:none;'; ?>">
                        <div class="search-wrapper">
                            <input type="text" id="add_city_text" class="search-input" dir="rtl" 
                                   placeholder="تایپ یا انتخاب کنید..." autocomplete="off"
                                   value="<?php 
                                       if (!empty($add_city)) {
                                           $query = "SELECT shahr FROM `list_city` WHERE add_city = :add_city AND mor_cod_m = :mor_cod_m LIMIT 1";
                                           $stmt = $dbh->prepare($query);
                                           $stmt->execute(array(':add_city' => $add_city, ':mor_cod_m' => $login_session));
                                           $row_city = $stmt->fetch(PDO::FETCH_ASSOC);
                                           echo htmlspecialchars($row_city['shahr']);
                                       }
                                   ?>">
                            <i class="fas fa-chevron-down dropdown-arrow" id="city_arrow"></i>
                            <div id="city_dropdown" class="custom-dropdown-list"></div>
                        </div>
                        <input type="hidden" name="add_city" id="add_city_hidden" value="<?php echo htmlspecialchars($add_city); ?>">
                    </div>
                    
                    <div id="abadi_container" class="abadi_select" style="<?php echo ($m_poul == 'abadi') ? '' : 'display:none;'; ?>">
                        <div class="search-wrapper">
                            <input type="text" id="add_abadi_text" class="search-input" dir="rtl" 
                                   placeholder="تایپ یا انتخاب کنید..." autocomplete="off"
                                   value="<?php 
                                       if (!empty($add_abadi)) {
                                           $query = "SELECT abadi FROM `list_abadi` WHERE add_abadi = :add_abadi AND mor_cod_m = :mor_cod_m LIMIT 1";
                                           $stmt = $dbh->prepare($query);
                                           $stmt->execute(array(':add_abadi' => $add_abadi, ':mor_cod_m' => $login_session));
                                           $row_abadi = $stmt->fetch(PDO::FETCH_ASSOC);
                                           echo htmlspecialchars($row_abadi['abadi']);
                                       }
                                   ?>">
                            <i class="fas fa-chevron-down dropdown-arrow" id="abadi_arrow"></i>
                            <div id="abadi_dropdown" class="custom-dropdown-list"></div>
                        </div>
                        <input type="hidden" name="add_abadi" id="add_abadi_hidden" value="<?php echo htmlspecialchars($add_abadi); ?>">
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-label">
                    <i class="fas fa-id-card"></i> کد ملی بهره بردار:
                </div>
                <div class="form-field">
                    <input type="text" name="bah_cod_m" class="required" maxlength="12" 
                           value="<?php if (isset($_POST['bah_cod_m'])) echo htmlspecialchars($bah_cod_m); ?>"
                           placeholder="کد ملی را وارد کنید">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-label">
                    <i class="fas fa-seedling"></i> نوع کشت:
                </div>
                <div class="form-field">
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" class="green" name="no_kesh" <?php if (isset($_POST['no_kesh']) && $no_kesh == '1') echo 'checked="checked"'; ?> value="1"/>
                            <span>آبی</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" class="green" name="no_kesh" <?php if (isset($_POST['no_kesh']) && $no_kesh == '2') echo 'checked="checked"'; ?> value="2"/>
                            <span>دیم</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-label">
                    <i class="fas fa-file-contract"></i> نوع مالکیت:
                </div>
                <div class="form-field">
                    <select name="no_mal" class="required" id="no_mal">
                        <option value="">انتخاب کنید</option>
                        <option value="1" <?php if (isset($_POST['no_mal']) && $no_mal == '1') echo 'selected="selected"'; ?>>سند ششدانگ</option>
                        <option value="2" <?php if (isset($_POST['no_mal']) && $no_mal == '2') echo 'selected="selected"'; ?>>سند مشاعی</option>
                        <option value="3" <?php if (isset($_POST['no_mal']) && $no_mal == '3') echo 'selected="selected"'; ?>>اصلاحات اراضی</option>
                        <option value="4" <?php if (isset($_POST['no_mal']) && $no_mal == '4') echo 'selected="selected"'; ?>>موقوفه</option>
                        <option value="5" <?php if (isset($_POST['no_mal']) && $no_mal == '5') echo 'selected="selected"'; ?>>واگذاری</option>
                        <option value="6" <?php if (isset($_POST['no_mal']) && $no_mal == '6') echo 'selected="selected"'; ?>>قولنامه</option>
                        <option value="7" <?php if (isset($_POST['no_mal']) && $no_mal == '7') echo 'selected="selected"'; ?>>اجاره</option>
                        <option value="8" <?php if (isset($_POST['no_mal']) && $no_mal == '8') echo 'selected="selected"'; ?>>سایر</option>
                    </select>
                </div>
            </div>
            
            <div class="button-group">
                <button type="submit" id="sub" name="action" class="btn-submit">
                    <i class="fas fa-arrow-left"></i> ادامه
                </button>
                <?php if (isset($not_found_bah)) { ?>
                    <button type="submit" name="action1" class="btn-submit btn-secondary">
                        <i class="fas fa-user-plus"></i> ثبت اطلاعات بهره بردار
                    </button>
                <?php } ?>
                <a href="index.php" class="btn-back">
                    <i class="fas fa-arrow-right"></i> برگشت
                </a>
            </div>
            
            <input type="hidden" name="m_poul" value="<?php echo htmlspecialchars($m_poul); ?>">
            <input type="hidden" name="agri_h" value="1">
        </form>
    </div>
    
    <div style="background: #2d3748; text-align: center; padding: 15px;">
        <?php include('../../footer.php'); ?>
    </div>
</div>

<script type="text/javascript">
var cityData = [];
var abadiData = [];

<?php
$query = "SELECT add_city, shahr FROM `list_city` WHERE mor_cod_m = :mor_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m' => $login_session));
foreach ($stmt as $row) {
    echo "cityData.push({code: '" . addslashes($row['add_city']) . "', name: '" . addslashes($row['shahr']) . "'});\n";
}

$query = "SELECT add_abadi, abadi FROM `list_abadi` WHERE mor_cod_m = :mor_cod_m ORDER BY BINARY abadi";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m' => $login_session));
foreach ($stmt as $row) {
    echo "abadiData.push({code: '" . addslashes($row['add_abadi']) . "', name: '" . addslashes($row['abadi']) . "'});\n";
}
?>

function populateCityList(filterText) {
    var dropdown = $('#city_dropdown');
    dropdown.empty();
    var filtered = cityData;
    if (filterText && filterText != '') {
        filtered = cityData.filter(function(item) {
            return item.name.indexOf(filterText) !== -1;
        });
    }
    if (filtered.length == 0) {
        dropdown.append('<div style="color:#999; text-align:center;">موردی یافت نشد</div>');
    } else {
        for (var i = 0; i < filtered.length; i++) {
            dropdown.append('<div data-code="' + filtered[i].code.replace(/'/g, "\\'") + '" data-name="' + filtered[i].name.replace(/'/g, "\\'") + '">' + filtered[i].name + '</div>');
        }
    }
    dropdown.show();
    
    $('#city_dropdown div').off('click').on('click', function() {
        var code = $(this).data('code');
        var name = $(this).data('name');
        $('#add_city_text').val(name);
        $('#add_city_hidden').val(code);
        $('#city_dropdown').hide();
        console.log('City selected - code:', code, 'name:', name);
    });
}

function populateAbadiList(filterText) {
    var dropdown = $('#abadi_dropdown');
    dropdown.empty();
    var filtered = abadiData;
    if (filterText && filterText != '') {
        filtered = abadiData.filter(function(item) {
            return item.name.indexOf(filterText) !== -1;
        });
    }
    if (filtered.length == 0) {
        dropdown.append('<div style="color:#999; text-align:center;">موردی یافت نشد</div>');
    } else {
        for (var i = 0; i < filtered.length; i++) {
            dropdown.append('<div data-code="' + filtered[i].code.replace(/'/g, "\\'") + '" data-name="' + filtered[i].name.replace(/'/g, "\\'") + '">' + filtered[i].name + '</div>');
        }
    }
    dropdown.show();
    
    $('#abadi_dropdown div').off('click').on('click', function() {
        var code = $(this).data('code');
        var name = $(this).data('name');
        $('#add_abadi_text').val(name);
        $('#add_abadi_hidden').val(code);
        $('#abadi_dropdown').hide();
        console.log('Abadi selected - code:', code, 'name:', name);
    });
}

// تابع اعتبارسنجی قبل از ارسال فرم
function validateForm() {
    var selectedType = $('input[name=m_poul]:checked').val();
    
    if (selectedType == 'shahr') {
        var cityCode = $('#add_city_hidden').val();
        if (cityCode == '' || cityCode == null) {
            alert('لطفاً یک شهر را از لیست انتخاب کنید');
            return false;
        }
    } else if (selectedType == 'abadi') {
        var abadiCode = $('#add_abadi_hidden').val();
        if (abadiCode == '' || abadiCode == null) {
            alert('لطفاً یک آبادی را از لیست انتخاب کنید');
            return false;
        }
    }
    
    // نمایش لودر
    $('#rasul').fadeIn(300);
    return true;
}

$(document).ready(function() {
    function updateLabel() {
        if ($('input[name=m_poul]:checked').val() == 'shahr') {
            $('#location_label').html('نام شهر:');
        } else {
            $('#location_label').html('نام آبادی:');
        }
    }
    updateLabel();
    
    $('input.region').change(function() {
        $('[name=m_poul]').val(this.value);
        updateLabel();
        if (this.value == 'shahr') {
            $('#shahr_container').show();
            $('#abadi_container').hide();
        } else if (this.value == 'abadi') {
            $('#abadi_container').show();
            $('#shahr_container').hide();
        }
    });
    
    $('#city_arrow').click(function(e) {
        e.stopPropagation();
        populateCityList($('#add_city_text').val());
    });
    
    $('#abadi_arrow').click(function(e) {
        e.stopPropagation();
        populateAbadiList($('#add_abadi_text').val());
    });
    
    $('#add_city_text').click(function(e) {
        e.stopPropagation();
        populateCityList($(this).val());
    });
    
    $('#add_abadi_text').click(function(e) {
        e.stopPropagation();
        populateAbadiList($(this).val());
    });
    
    $('#add_city_text').on('input', function() {
        populateCityList($(this).val());
    });
    
    $('#add_abadi_text').on('input', function() {
        populateAbadiList($(this).val());
    });
    
    $(document).click(function() {
        $('#city_dropdown').hide();
        $('#abadi_dropdown').hide();
    });
    
    $('#city_arrow, #add_city_text, #city_dropdown').click(function(e) {
        e.stopPropagation();
    });
    
    $('#abadi_arrow, #add_abadi_text, #abadi_dropdown').click(function(e) {
        e.stopPropagation();
    });
});
</script>
</body>
</html>