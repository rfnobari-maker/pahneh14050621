<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');

if (isset($_POST['bah_cod_m'])) {
    date_default_timezone_set('Asia/Tehran');

    // این بخش برای دریافت مقادیر از فرم POST است
    $date_edit = jdate("Y/m/d");
    $time = date('H:i:s');
    $date_s = date_con(jdate("Y/m/d"));
    $add_abadi = $_POST["add_abadi"];
    $add_city = $_POST["add_city"];
    $bah_cod_m = $_POST['bah_cod_m'];
    $no_zan = $_POST['no_zan'];
    $num_bah = $_POST['num_bah'];
    $unique_id = $_POST['unique_id'];
	
    // Check if it's an existing beekeeping site to fetch its location details
    if ($m_zan == 'abadi') {
        $query = "SELECT add_abadi,id_ostan,id_city,id_mar from list_abadi where add_abadi = :add_abadi";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_abadi' => $add_abadi));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $add_abadi = $row["add_abadi"];
        $add_city = '-';
        $id_ostan = $row["id_ostan"];
        $id_city = $row["id_city"];
        $id_mar = $row["id_mar"];
    }
    if ($m_zan == 'shahr') {
        $query = "SELECT add_city,id_ostan,id_mar,id_city from list_city where add_city = :add_city";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_city' => $add_city));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $add_city = $row["add_city"];
        $add_abadi = '-';
        $id_ostan = $row["id_ostan"];
        $id_city = $row["id_city"];
        $id_mar = $row["id_mar"];
    }
}

if (isset($_POST['action'])) {
    include('../../login/config.php');
    $date_s = $date_edit;
    $sal = '1404';
    $mor_cod_m = $login_session;
    $bah_cod_m = $_POST['bah_cod_m'];
    $add_city = $_POST['add_city'];
    $add_abadi = $_POST['add_abadi'];
    $id_ostan = $_POST['id_ostan'];
    $id_city = $_POST['id_city'];
    $id_mar = $_POST['id_mar'];
    $no_zan = $_POST['no_zan'];
    $num_bah = $_POST['num_bah'];
    $unique_id = $_POST['unique_id'];
	
    $taj_2_exists = isset($_POST['taj_2_exists']) ? $_POST['taj_2_exists'] : null;
    $taj_2_needed = isset($_POST['taj_2_needed']) ? $_POST['taj_2_needed'] : 0;
    $taj_3_exists = isset($_POST['taj_3_exists']) ? $_POST['taj_3_exists'] : null;
    $taj_3_needed = isset($_POST['taj_3_needed']) ? $_POST['taj_3_needed'] : 0;
    $taj_4_exists = isset($_POST['taj_4_exists']) ? $_POST['taj_4_exists'] : null;
    $taj_4_needed = isset($_POST['taj_4_needed']) ? $_POST['taj_4_needed'] : 0;
    $taj_5_exists = isset($_POST['taj_5_exists']) ? $_POST['taj_5_exists'] : null;
    $taj_5_needed = isset($_POST['taj_5_needed']) ? $_POST['taj_5_needed'] : 0;
    $taj_6_exists = isset($_POST['taj_6_exists']) ? $_POST['taj_6_exists'] : null;
    $taj_6_needed = isset($_POST['taj_6_needed']) ? $_POST['taj_6_needed'] : 0;
    $taj_7_exists = isset($_POST['taj_7_exists']) ? $_POST['taj_7_exists'] : null;
    $taj_7_needed = isset($_POST['taj_7_needed']) ? $_POST['taj_7_needed'] : 0;
    $taj_8_exists = isset($_POST['taj_8_exists']) ? $_POST['taj_8_exists'] : null;
    $taj_8_needed = isset($_POST['taj_8_needed']) ? $_POST['taj_8_needed'] : 0;
    $taj_9_exists = isset($_POST['taj_9_exists']) ? $_POST['taj_9_exists'] : null;
    $taj_9_needed = isset($_POST['taj_9_needed']) ? $_POST['taj_9_needed'] : 0;
    $taj_10_exists = isset($_POST['taj_10_exists']) ? $_POST['taj_10_exists'] : null;
    $taj_10_needed = isset($_POST['taj_10_needed']) ? $_POST['taj_10_needed'] : 0;
    $taj_11_exists = isset($_POST['taj_11_exists']) ? $_POST['taj_11_exists'] : null;
    $taj_11_needed = isset($_POST['taj_11_needed']) ? $_POST['taj_11_needed'] : 0;
    $taj_12_exists = isset($_POST['taj_12_exists']) ? $_POST['taj_12_exists'] : null;
    $taj_12_needed = isset($_POST['taj_12_needed']) ? $_POST['taj_12_needed'] : 0;
    $taj_13_exists = isset($_POST['taj_13_exists']) ? $_POST['taj_13_exists'] : null;
    $taj_13_needed = isset($_POST['taj_13_needed']) ? $_POST['taj_13_needed'] : 0;
    $taj_14_exists = isset($_POST['taj_14_exists']) ? $_POST['taj_14_exists'] : null;
    $taj_14_needed = isset($_POST['taj_14_needed']) ? $_POST['taj_14_needed'] : 0;
    $taj_15_exists = isset($_POST['taj_15_exists']) ? $_POST['taj_15_exists'] : null;
    $taj_15_needed = isset($_POST['taj_15_needed']) ? $_POST['taj_15_needed'] : 0;
    $taj_16_exists = isset($_POST['taj_16_exists']) ? $_POST['taj_16_exists'] : null;
    $taj_16_needed = isset($_POST['taj_16_needed']) ? $_POST['taj_16_needed'] : 0;
    $taj_17_exists = isset($_POST['taj_17_exists']) ? $_POST['taj_17_exists'] : null;
    $taj_17_needed = isset($_POST['taj_17_needed']) ? $_POST['taj_17_needed'] : 0;
    $taj_18_exists = isset($_POST['taj_18_exists']) ? $_POST['taj_18_exists'] : null;
    $taj_18_needed = isset($_POST['taj_18_needed']) ? $_POST['taj_18_needed'] : 0;
    $taj_19_exists = isset($_POST['taj_19_exists']) ? $_POST['taj_19_exists'] : null;
    $taj_19_needed = isset($_POST['taj_19_needed']) ? $_POST['taj_19_needed'] : 0;
    $taj_20_exists = isset($_POST['taj_20_exists']) ? $_POST['taj_20_exists'] : null;
    $taj_20_needed = isset($_POST['taj_20_needed']) ? $_POST['taj_20_needed'] : 0;

    $query = "INSERT INTO bee_equipment (unique_id,sal, mor_cod_m, date_s, bah_cod_m, num_bah, add_abadi, add_city, no_zan, id_ostan, id_city, id_mar,  taj_2_exists, taj_2_needed, taj_3_exists, taj_3_needed, taj_4_exists, taj_4_needed, taj_5_exists, taj_5_needed, taj_6_exists, taj_6_needed, taj_7_exists, taj_7_needed, taj_8_exists, taj_8_needed, taj_9_exists, taj_9_needed, taj_10_exists, taj_10_needed, taj_11_exists, taj_11_needed, taj_12_exists, taj_12_needed, taj_13_exists, taj_13_needed, taj_14_exists, taj_14_needed, taj_15_exists, taj_15_needed, taj_16_exists, taj_16_needed, taj_17_exists, taj_17_needed, taj_18_exists, taj_18_needed, taj_19_exists, taj_19_needed, taj_20_exists, taj_20_needed) VALUES(:unique_id,:sal, :mor_cod_m, :date_s, :bah_cod_m, :num_bah, :add_abadi, :add_city, :no_zan, :id_ostan, :id_city, :id_mar, :taj_2_exists, :taj_2_needed, :taj_3_exists, :taj_3_needed, :taj_4_exists, :taj_4_needed, :taj_5_exists, :taj_5_needed, :taj_6_exists, :taj_6_needed, :taj_7_exists, :taj_7_needed, :taj_8_exists, :taj_8_needed, :taj_9_exists, :taj_9_needed, :taj_10_exists, :taj_10_needed, :taj_11_exists, :taj_11_needed, :taj_12_exists, :taj_12_needed, :taj_13_exists, :taj_13_needed, :taj_14_exists, :taj_14_needed, :taj_15_exists, :taj_15_needed, :taj_16_exists, :taj_16_needed, :taj_17_exists, :taj_17_needed, :taj_18_exists, :taj_18_needed, :taj_19_exists, :taj_19_needed, :taj_20_exists, :taj_20_needed)";

    $q = $dbh->prepare($query);
    $q->execute(array(
        ':sal' => $sal,
        ':mor_cod_m' => $mor_cod_m,
        ':date_s' => $date_s,
        ':bah_cod_m' => $bah_cod_m,
        ':num_bah' => $num_bah,
        ':add_abadi' => $add_abadi,
        ':add_city' => $add_city,
        ':no_zan' => $no_zan,
        ':id_ostan' => $id_ostan,
        ':id_city' => $id_city,
        ':id_mar' => $id_mar,
        ':taj_2_exists' => $taj_2_exists,
        ':taj_2_needed' => $taj_2_needed,
        ':taj_3_exists' => $taj_3_exists,
        ':taj_3_needed' => $taj_3_needed,
        ':taj_4_exists' => $taj_4_exists,
        ':taj_4_needed' => $taj_4_needed,
        ':taj_5_exists' => $taj_5_exists,
        ':taj_5_needed' => $taj_5_needed,
        ':taj_6_exists' => $taj_6_exists,
        ':taj_6_needed' => $taj_6_needed,
        ':taj_7_exists' => $taj_7_exists,
        ':taj_7_needed' => $taj_7_needed,
        ':taj_8_exists' => $taj_8_exists,
        ':taj_8_needed' => $taj_8_needed,
        ':taj_9_exists' => $taj_9_exists,
        ':taj_9_needed' => $taj_9_needed,
        ':taj_10_exists' => $taj_10_exists,
        ':taj_10_needed' => $taj_10_needed,
        ':taj_11_exists' => $taj_11_exists,
        ':taj_11_needed' => $taj_11_needed,
        ':taj_12_exists' => $taj_12_exists,
        ':taj_12_needed' => $taj_12_needed,
        ':taj_13_exists' => $taj_13_exists,
        ':taj_13_needed' => $taj_13_needed,
        ':taj_14_exists' => $taj_14_exists,
        ':taj_14_needed' => $taj_14_needed,
        ':taj_15_exists' => $taj_15_exists,
        ':taj_15_needed' => $taj_15_needed,
        ':taj_16_exists' => $taj_16_exists,
        ':taj_16_needed' => $taj_16_needed,
        ':taj_17_exists' => $taj_17_exists,
        ':taj_17_needed' => $taj_17_needed,
        ':taj_18_exists' => $taj_18_exists,
        ':taj_18_needed' => $taj_18_needed,
        ':taj_19_exists' => $taj_19_exists,
        ':taj_19_needed' => $taj_19_needed,
        ':taj_20_exists' => $taj_20_exists,
        ':taj_20_needed' => $taj_20_needed,
        ':unique_id'     => $unique_id
		
    ));

    sabt_event($login_session, getUserIP_1(), $date_edit, $time, $add_abadi, 'ثبت اطلاعات زنبورستان - ' . $bah_cod_m, $id_ostan);
    unset($error);
    alert('اطلاعات زنبورستان با موفقیت ثبت شد ');
?>
    <form name="myform" class="myform" method="post" action="index.php">
    </form>
    <script type="text/javascript">
        document.myform.submit();
    </script>
<?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<link href="../radio.css" rel="stylesheet" type="text/css" />
<style>
    .style10 {
        color: #FF0000
    }

    .style11 {
        font-size: 14px
    }

    input {
        border-radius: 5px
    }

    select {
        border-radius: 5px
    }

    /* Modern Equipment Section Styles */
    .equipment-list {
        margin-right: 35px;
        display: flex;
        flex-wrap: wrap; 
        gap: 20px;
        justify-content: space-between;
    }

    .equipment-item {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background-color: #f9f9f9;
        flex: 1 1 48%; 
        box-sizing: border-box; 
        max-width: 48%; 
    }

    .equipment-name {
        font-size: 13px;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
        text-align: right;
    }
    
    .option-group {
        display: flex;
        gap: 15px;
    }

    .option-label {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 14px;
        color: #555;
        transition: background-color 0.3s, border-color 0.3s;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: #fff;
    }

    .option-label:hover {
        background-color: #f0f0f0;
    }

    .option-label input[type="radio"] {
        display: none;
    }

    .option-label input[type="radio"]:checked+.custom-radio {
        background-color: #4CAF50;
        border-color: #4CAF50;
    }

    .option-label input[type="radio"]:checked+.custom-radio:after {
        display: block;
    }

    .custom-radio {
        width: 20px;
        height: 20px;
        border: 2px solid #ccc;
        border-radius: 50%;
        margin-left: 8px;
        position: relative;
        transition: all 0.3s;
    }

    .custom-radio:after {
        content: '';
        width: 10px;
        height: 10px;
        background: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        display: none;
    }
    .needed-options {}

    /* Media query to switch to a single column on smaller screens */
    @media (max-width: 768px) {
        .equipment-list {
            flex-direction: column;
        }

        .equipment-item {
            max-width: 100%;
        }
    }
    /* Green styles for "Exists" (Mowjood) and "Needed" (Niaz Hast) */
    .option-label.exists,
    .option-label.needed {
        color: #4CAF50; /* Green text */
        border-color: #4CAF50; /* Green border */
    }

    .option-label.exists input[type="radio"]:checked + .custom-radio,
    .option-label.needed input[type="radio"]:checked + .custom-radio {
        background-color: #4CAF50;
        border-color: #4CAF50;
    }

    /* Red styles for "Doesn't Exist" (Namowjood) and "Not Needed" (Niaz Nist) */
    .option-label.not-exists,
    .option-label.not-needed {
        color: #f44336; /* Red text */
        border-color: #f44336; /* Red border */
    }

    .option-label.not-exists input[type="radio"]:checked + .custom-radio,
    .option-label.not-needed input[type="radio"]:checked + .custom-radio {
        background-color: #f44336;
        border-color: #f44336;
    }
</style>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title; ?></title>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>

    <script type="text/javascript">
        $().ready(function() {
            $("#form1").validate({
                ignore: ":hidden"
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".country").change(function() {
                var id = $(this).val();
                var dataString = 'group_cod=' + id;
                $.ajax({
                    type: "POST",
                    url: "ajax_ostan.php",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $(".mar").html(html);
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            checkFormCompletion();
        });

        function toggleNeeded(equipmentName, show) {
            var optionsDiv = document.getElementById(equipmentName + '_needed_options');
            var radios = optionsDiv.querySelectorAll('input[type="radio"]');

            if (show) {
                optionsDiv.style.display = "flex";
                for (var i = 0; i < radios.length; i++) {
                    radios[i].required = true;
                }
            } else {
                optionsDiv.style.display = "none";
                for (var i = 0; i < radios.length; i++) {
                    radios[i].required = false;
                    radios[i].checked = false;
                }
            }
            checkFormCompletion();
        }

        function checkFormCompletion() {
            var form = document.getElementById('form1');
            var submitButton = document.getElementById('submitBtn');
            var isValid = true;

            var requiredFields = form.querySelectorAll('input[required], select[required], textarea[required]');

            for (var i = 0; i < requiredFields.length; i++) {
                if (requiredFields[i].type === 'radio') {
                    var radios = document.getElementsByName(requiredFields[i].name);
                    var radioChecked = false;
                    for (var j = 0; j < radios.length; j++) {
                        if (radios[j].checked) {
                            radioChecked = true;
                            break;
                        }
                    }
                    if (!radioChecked) {
                        isValid = false;
                        break;
                    }
                } else if (!requiredFields[i].value) {
                    isValid = false;
                    break;
                }
            }

            submitButton.disabled = !isValid;
        }

        $(document).ready(function() {
            $('#form1').on('change keyup', checkFormCompletion);
        });
    </script>
</head>

<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
        </tr>
        <tr>
            <td>
                <?php include('menu.php'); ?>
            </td>
        </tr>
        <tr>
            <td bgcolor="#FFFFFF">
                <?php include('top.php'); ?>
              <p class="style19">ثبت لیست تجهیزات زنبورستان </p>
                <p>
                  <?php sar_data2($bah_cod_m, $num_bah); ?>
                  <br />
                <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt="" /></p>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td width="4">
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                        </td>
                        <td width="840">
                            <form action="" method="post" id="form1" name="form1">
                                <input type="hidden" name="action" value="save_data">
                                <div style="direction:rtl; padding: 10px;">
                                    <div class="equipment-list">
                                      
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">کندو کف باز</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_2_exists" value="1" onClick="toggleNeeded('taj_2', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_2_exists" value="0" onClick="toggleNeeded('taj_2', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_2_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_2_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_2_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">اکستراکتور برقی</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_3_exists" value="1" onClick="toggleNeeded('taj_3', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_3_exists" value="0" onClick="toggleNeeded('taj_3', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_3_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_3_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_3_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">اکستراکتور</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">دستی</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_4_exists" value="1" onClick="toggleNeeded('taj_4', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_4_exists" value="0" onClick="toggleNeeded('taj_4', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_4_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_4_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_4_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">دستگاه</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">برداشت</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">ژله</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">رویال</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">اتوماتیک</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_5_exists" value="1" onClick="toggleNeeded('taj_5', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_5_exists" value="0" onClick="toggleNeeded('taj_5', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_5_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_5_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_5_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">موم دوز برقی</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_6_exists" value="1" onClick="toggleNeeded('taj_6', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_6_exists" value="0" onClick="toggleNeeded('taj_6', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_6_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_6_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_6_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">دستگاه</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">پرکن</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">عسل</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">اتوماتیک</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_7_exists" value="1" onClick="toggleNeeded('taj_7', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_7_exists" value="0" onClick="toggleNeeded('taj_7', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_7_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_7_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_7_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">صافی</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">عسل</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_8_exists" value="1" onClick="toggleNeeded('taj_8', false)" required>

                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_8_exists" value="0" onClick="toggleNeeded('taj_8', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_8_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_8_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_8_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">رس</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">گیر</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">عسل</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">گازی</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_9_exists" value="1" onClick="toggleNeeded('taj_9', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_9_exists" value="0" onClick="toggleNeeded('taj_9', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_9_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_9_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_9_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">خرک</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">برداشت</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">عسل</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">مخزن</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">دار</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_10_exists" value="1" onClick="toggleNeeded('taj_10', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_10_exists" value="0" onClick="toggleNeeded('taj_10', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_10_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_10_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_10_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">دستگاه</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">تصعید</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">اسید</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">اگزالیک</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">برقی</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_11_exists" value="1" onClick="toggleNeeded('taj_11', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_11_exists" value="0" onClick="toggleNeeded('taj_11', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_11_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_11_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_11_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">دستگاه زهرگیر</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_12_exists" value="1" onClick="toggleNeeded('taj_12', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_12_exists" value="0" onClick="toggleNeeded('taj_12', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_12_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_12_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_12_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">خرک</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">برداشت</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">عسل</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">پایه</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">دار</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_13_exists" value="1" onClick="toggleNeeded('taj_13', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_13_exists" value="0" onClick="toggleNeeded('taj_13', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_13_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_13_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_13_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">دستگاه</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">پرس</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">موم</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_14_exists" value="1" onClick="toggleNeeded('taj_14', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_14_exists" value="0" onClick="toggleNeeded('taj_14', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_14_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_14_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_14_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">دستگاه</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">استحصال</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">نان</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">زنبور</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_15_exists" value="1" onClick="toggleNeeded('taj_15', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_15_exists" value="0" onClick="toggleNeeded('taj_15', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_15_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_15_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_15_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">دستگاه تمیزکننده</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">گرده</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">گل</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_16_exists" value="1" onClick="toggleNeeded('taj_16', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_16_exists" value="0" onClick="toggleNeeded('taj_16', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_16_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_16_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_16_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">دستگاه</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">مه</span>‌<span dir="rtl">پاش</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_17_exists" value="1" onClick="toggleNeeded('taj_17', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_17_exists" value="0" onClick="toggleNeeded('taj_17', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_17_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_17_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_17_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">سیستم</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">کنترل</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">هوشمند</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">دمای</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">کندو</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_18_exists" value="1" onClick="toggleNeeded('taj_18', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_18_exists" value="0" onClick="toggleNeeded('taj_18', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_18_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_18_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_18_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">دستگاه</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">رطوبت</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">گیر</span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span><span dir="ltr"> </span> <span dir="rtl">عسل</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_19_exists" value="1" onClick="toggleNeeded('taj_19', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_19_exists" value="0" onClick="toggleNeeded('taj_19', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_19_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_19_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_19_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equipment-item">
                                            <div class="equipment-name"><span dir="rtl">دستگاه تغلیظ کننده عسل اتوماتیک</span></div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_20_exists" value="1" onClick="toggleNeeded('taj_20', false)" required>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_20_exists" value="0" onClick="toggleNeeded('taj_20', true)">
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_20_needed_options" class="needed-options option-group" style="display: none;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_20_needed" value="1">
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_20_needed" value="0">
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                              </div>
                                <div align="center">
                                    <input name="send_data" type="submit" class="button" id="submitBtn" style="width:100px; height:40px ; font-size:16px; font-weight:bold ;" tabindex="50" value="ثبت اطلاعات" />
                                </div>
                                <br />
                                <div align="center">
                                    <input type="hidden" name="bah_cod_m" id="bah_cod_m" value="<?php echo $bah_cod_m; ?>" />
                                    <input type="hidden" name="num_bah" id="num_bah" value="<?php echo $num_bah; ?>" />
                                    <input type="hidden" name="add_city" id="add_city" value="<?php echo $add_city; ?>" />
                                    <input type="hidden" name="add_abadi" id="add_abadi" value="<?php echo $add_abadi; ?>" />
                                    <input type="hidden" name="no_zan" id="no_zan" value="<?php echo $no_zan; ?>" />
                                    <input type="hidden" name="id_ostan" id="id_ostan" value="<?php echo $id_ostan; ?>" />
                                    <input type="hidden" name="id_city" id="id_city" value="<?php echo $id_city; ?>" />
                                    <input type="hidden" name="id_mar" id="id_mar" value="<?php echo $id_mar; ?>" />
                                    <input type="hidden" name="unique_id" value="<?php echo $unique_id; ?>" />                                    
                                </div>
                            </form>
                        </td>
                        <td width="4">&nbsp;</td>
                  </tr>
              </table>

</body>

</html>