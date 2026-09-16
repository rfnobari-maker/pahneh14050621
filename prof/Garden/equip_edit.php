<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');

// Function to convert 0/1 to "Exists"/"Needed" (for display purposes)
function get_status_checked($value, $expected_value) {
    if ($value !== null && $value == $expected_value) {
        return 'checked';
    }
    return '';
}

// Function to check if a value exists
function is_value_set($value) {
    return ($value !== null && $value !== '');
}

// --- بخش ۱: پردازش اطلاعات ارسالی و به‌روزرسانی پایگاه داده ---
if (isset($_POST['action']) && $_POST['action'] == 'update_data') {
    $date_edit = jdate("Y/m/d");
    $time = date('H:i:s');
    $unique_id = $_POST['unique_id'];
    $mor_cod_m = $login_session; // Assuming login session is used for who made the change

    // Sanitize and get POST variables for equipment status
    $taj_1_exists = isset($_POST['taj_1_exists']) ? $_POST['taj_1_exists'] : null;
    $taj_1_needed = isset($_POST['taj_1_needed']) ? $_POST['taj_1_needed'] : 0;
    // ... ادامه متغیرها برای taj_2 تا taj_20 ...
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
    
    // UPDATE Query
    $query = "UPDATE bee_equipment SET
        date_s = :date_s,
        taj_1_exists = :taj_1_exists, taj_1_needed = :taj_1_needed,
        taj_2_exists = :taj_2_exists, taj_2_needed = :taj_2_needed,
        taj_3_exists = :taj_3_exists, taj_3_needed = :taj_3_needed,
        taj_4_exists = :taj_4_exists, taj_4_needed = :taj_4_needed,
        taj_5_exists = :taj_5_exists, taj_5_needed = :taj_5_needed,
        taj_6_exists = :taj_6_exists, taj_6_needed = :taj_6_needed,
        taj_7_exists = :taj_7_exists, taj_7_needed = :taj_7_needed,
        taj_8_exists = :taj_8_exists, taj_8_needed = :taj_8_needed,
        taj_9_exists = :taj_9_exists, taj_9_needed = :taj_9_needed,
        taj_10_exists = :taj_10_exists, taj_10_needed = :taj_10_needed,
        taj_11_exists = :taj_11_exists, taj_11_needed = :taj_11_needed,
        taj_12_exists = :taj_12_exists, taj_12_needed = :taj_12_needed,
        taj_13_exists = :taj_13_exists, taj_13_needed = :taj_13_needed,
        taj_14_exists = :taj_14_exists, taj_14_needed = :taj_14_needed,
        taj_15_exists = :taj_15_exists, taj_15_needed = :taj_15_needed,
        taj_16_exists = :taj_16_exists, taj_16_needed = :taj_16_needed,
        taj_17_exists = :taj_17_exists, taj_17_needed = :taj_17_needed,
        taj_18_exists = :taj_18_exists, taj_18_needed = :taj_18_needed,
        taj_19_exists = :taj_19_exists, taj_19_needed = :taj_19_needed,
        taj_20_exists = :taj_20_exists, taj_20_needed = :taj_20_needed
        WHERE unique_id = :unique_id";

    $q = $dbh->prepare($query);
    $q->execute(array(
        ':date_s' => date_con(jdate("Y/m/d")),
        ':unique_id' => $unique_id,
        ':taj_1_exists' => $taj_1_exists,
        ':taj_1_needed' => $taj_1_needed,
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
        ':taj_20_needed' => $taj_20_needed
    ));

    sabt_event($login_session, getUserIP_1(), $date_edit, $time, '', 'ویرایش اطلاعات تجهیزات زنبورستان - ' . $unique_id);
    
    // Redirect with success message
    $com_alert_message = "اطلاعات زنبورستان با موفقیت تصحیح شد";
    
    echo '<form name="myform4" class="myform" method="post" action="list_bee.php">
        <input type="hidden" name="action" value="true" />
        <input type="hidden" name="bah_cod_m" value="' . htmlspecialchars($_POST['bah_cod_m']) . '" />
        <input type="hidden" name="com_alert" value="' . htmlspecialchars($com_alert_message) . '" />
    </form>
    <script type="text/javascript">document.myform4.submit();</script>';
    exit;
}

// --- بخش ۲: دریافت اطلاعات برای نمایش در فرم ویرایش ---
if (!isset($_POST['unique_id'])) {
    alert("شناسه یکتا برای ویرایش ارسال نشده است.");
    echo '<script type="text/javascript">
        window.location.href = "index.php"; 
    </script>';
    exit;
}

$unique_id = $_POST['unique_id'];
$bah_cod_m = $_POST['bah_cod_m'];
$num_bah = $_POST['num_bah'];

// Fetch existing data from the database
$query = "SELECT * FROM `bee_equipment` WHERE `unique_id` = :unique_id";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':unique_id' => $unique_id));
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    alert("اطلاعاتی با این شناسه یافت نشد.");
    echo '<script type="text/javascript">
        window.location.href = "index.php"; 
    </script>';
    exit;
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
    .button-group {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }
    .button {
        width: 120px;
        height: 40px;
        font-size: 16px;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    #submitBtn {
        background-color: #4CAF50;
        color: white;
    }
    #submitBtn:hover {
        background-color: #45a049;
    }
    #cancelBtn {
        background-color: #f44336;
        color: white;
    }
    #cancelBtn:hover {
        background-color: #d32f2f;
    }
</style>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>ویرایش اطلاعات تجهیزات</title>
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
            // Check form completion on page load for initial state
            checkFormCompletion();

            // Initial toggle for needed fields
            <?php 
            for ($i = 1; $i <= 20; $i++) {
                $exists_field = 'taj_' . $i . '_exists';
                if ($data[$exists_field] == 0) {
                    echo "toggleNeeded('taj_" . $i . "', true);\n";
                }
            }
            ?>
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
        
        function cancelAction() {
            var form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('action', 'list_bee.php');
            
            var actionInput = document.createElement('input');
            actionInput.setAttribute('type', 'hidden');
            actionInput.setAttribute('name', 'action');
            actionInput.setAttribute('value', 'true');
            
            var bahCodInput = document.createElement('input');
            bahCodInput.setAttribute('type', 'hidden');
            bahCodInput.setAttribute('name', 'bah_cod_m');
            bahCodInput.setAttribute('value', '<?php echo $bah_cod_m; ?>');
            
            document.body.appendChild(form);
            form.appendChild(actionInput);
            form.appendChild(bahCodInput);
            
            form.submit();
        }
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
                <p class="style19">ویرایش لیست تجهیزات زنبورستان </p>
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
                                <input type="hidden" name="action" value="update_data">
                                <div style="direction:rtl; padding: 10px;">
                                    <div class="equipment-list">
                                        <div class="equipment-item">
                                            <div class="equipment-name">کندو لانگستروت</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_1_exists" value="1" onclick="toggleNeeded('taj_1', false)" required <?php echo get_status_checked($data['taj_1_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_1_exists" value="0" onclick="toggleNeeded('taj_1', true)" required <?php echo get_status_checked($data['taj_1_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_1_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_1_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_1_needed" value="1" <?php echo get_status_checked($data['taj_1_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_1_needed" value="0" <?php echo get_status_checked($data['taj_1_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">کندو فک باز</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_2_exists" value="1" onclick="toggleNeeded('taj_2', false)" required <?php echo get_status_checked($data['taj_2_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_2_exists" value="0" onclick="toggleNeeded('taj_2', true)" required <?php echo get_status_checked($data['taj_2_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_2_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_2_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_2_needed" value="1" <?php echo get_status_checked($data['taj_2_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_2_needed" value="0" <?php echo get_status_checked($data['taj_2_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="equipment-item">
                                            <div class="equipment-name">اکستراکتور برقی</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_3_exists" value="1" onclick="toggleNeeded('taj_3', false)" required <?php echo get_status_checked($data['taj_3_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_3_exists" value="0" onclick="toggleNeeded('taj_3', true)" required <?php echo get_status_checked($data['taj_3_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_3_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_3_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_3_needed" value="1" <?php echo get_status_checked($data['taj_3_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_3_needed" value="0" <?php echo get_status_checked($data['taj_3_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="equipment-item">
                                            <div class="equipment-name">اکستراکتور دستی</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_4_exists" value="1" onclick="toggleNeeded('taj_4', false)" required <?php echo get_status_checked($data['taj_4_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_4_exists" value="0" onclick="toggleNeeded('taj_4', true)" required <?php echo get_status_checked($data['taj_4_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_4_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_4_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_4_needed" value="1" <?php echo get_status_checked($data['taj_4_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_4_needed" value="0" <?php echo get_status_checked($data['taj_4_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="equipment-item">
                                            <div class="equipment-name">دستگاه برداشت ژل رویال اتوماتیک</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_5_exists" value="1" onclick="toggleNeeded('taj_5', false)" required <?php echo get_status_checked($data['taj_5_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_5_exists" value="0" onclick="toggleNeeded('taj_5', true)" required <?php echo get_status_checked($data['taj_5_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_5_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_5_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_5_needed" value="1" <?php echo get_status_checked($data['taj_5_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_5_needed" value="0" <?php echo get_status_checked($data['taj_5_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">موم دوز برقی</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_6_exists" value="1" onclick="toggleNeeded('taj_6', false)" required <?php echo get_status_checked($data['taj_6_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_6_exists" value="0" onclick="toggleNeeded('taj_6', true)" required <?php echo get_status_checked($data['taj_6_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_6_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_6_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_6_needed" value="1" <?php echo get_status_checked($data['taj_6_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_6_needed" value="0" <?php echo get_status_checked($data['taj_6_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">دستگاه پرکن عسل اتوماتیک</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_7_exists" value="1" onclick="toggleNeeded('taj_7', false)" required <?php echo get_status_checked($data['taj_7_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_7_exists" value="0" onclick="toggleNeeded('taj_7', true)" required <?php echo get_status_checked($data['taj_7_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_7_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_7_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_7_needed" value="1" <?php echo get_status_checked($data['taj_7_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_7_needed" value="0" <?php echo get_status_checked($data['taj_7_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">صافی عسل</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_8_exists" value="1" onclick="toggleNeeded('taj_8', false)" required <?php echo get_status_checked($data['taj_8_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_8_exists" value="0" onclick="toggleNeeded('taj_8', true)" required <?php echo get_status_checked($data['taj_8_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_8_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_8_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_8_needed" value="1" <?php echo get_status_checked($data['taj_8_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_8_needed" value="0" <?php echo get_status_checked($data['taj_8_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">رس گیر عسل گازی</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_9_exists" value="1" onclick="toggleNeeded('taj_9', false)" required <?php echo get_status_checked($data['taj_9_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_9_exists" value="0" onclick="toggleNeeded('taj_9', true)" required <?php echo get_status_checked($data['taj_9_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_9_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_9_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_9_needed" value="1" <?php echo get_status_checked($data['taj_9_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_9_needed" value="0" <?php echo get_status_checked($data['taj_9_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">خرک برداشت عسل مخزن دار</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_10_exists" value="1" onclick="toggleNeeded('taj_10', false)" required <?php echo get_status_checked($data['taj_10_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_10_exists" value="0" onclick="toggleNeeded('taj_10', true)" required <?php echo get_status_checked($data['taj_10_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_10_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_10_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_10_needed" value="1" <?php echo get_status_checked($data['taj_10_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_10_needed" value="0" <?php echo get_status_checked($data['taj_10_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">دستگاه تصعید اسید اگزالیک برقی</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_11_exists" value="1" onclick="toggleNeeded('taj_11', false)" required <?php echo get_status_checked($data['taj_11_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_11_exists" value="0" onclick="toggleNeeded('taj_11', true)" required <?php echo get_status_checked($data['taj_11_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_11_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_11_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_11_needed" value="1" <?php echo get_status_checked($data['taj_11_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_11_needed" value="0" <?php echo get_status_checked($data['taj_11_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">دستگاه زهرگیر</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_12_exists" value="1" onclick="toggleNeeded('taj_12', false)" required <?php echo get_status_checked($data['taj_12_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_12_exists" value="0" onclick="toggleNeeded('taj_12', true)" required <?php echo get_status_checked($data['taj_12_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_12_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_12_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_12_needed" value="1" <?php echo get_status_checked($data['taj_12_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_12_needed" value="0" <?php echo get_status_checked($data['taj_12_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">خرک برداشت عسل پایه دار</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_13_exists" value="1" onclick="toggleNeeded('taj_13', false)" required <?php echo get_status_checked($data['taj_13_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_13_exists" value="0" onclick="toggleNeeded('taj_13', true)" required <?php echo get_status_checked($data['taj_13_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_13_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_13_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_13_needed" value="1" <?php echo get_status_checked($data['taj_13_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_13_needed" value="0" <?php echo get_status_checked($data['taj_13_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">دستگاه پرس موم</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_14_exists" value="1" onclick="toggleNeeded('taj_14', false)" required <?php echo get_status_checked($data['taj_14_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_14_exists" value="0" onclick="toggleNeeded('taj_14', true)" required <?php echo get_status_checked($data['taj_14_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_14_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_14_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_14_needed" value="1" <?php echo get_status_checked($data['taj_14_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_14_needed" value="0" <?php echo get_status_checked($data['taj_14_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">دستگاه استحصال نان زنبور</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_15_exists" value="1" onclick="toggleNeeded('taj_15', false)" required <?php echo get_status_checked($data['taj_15_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_15_exists" value="0" onclick="toggleNeeded('taj_15', true)" required <?php echo get_status_checked($data['taj_15_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_15_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_15_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_15_needed" value="1" <?php echo get_status_checked($data['taj_15_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_15_needed" value="0" <?php echo get_status_checked($data['taj_15_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">دستگاه تمیزکننده گرده گل</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_16_exists" value="1" onclick="toggleNeeded('taj_16', false)" required <?php echo get_status_checked($data['taj_16_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_16_exists" value="0" onclick="toggleNeeded('taj_16', true)" required <?php echo get_status_checked($data['taj_16_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_16_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_16_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_16_needed" value="1" <?php echo get_status_checked($data['taj_16_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_16_needed" value="0" <?php echo get_status_checked($data['taj_16_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">دستگاه مه پاش</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_17_exists" value="1" onclick="toggleNeeded('taj_17', false)" required <?php echo get_status_checked($data['taj_17_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_17_exists" value="0" onclick="toggleNeeded('taj_17', true)" required <?php echo get_status_checked($data['taj_17_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_17_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_17_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_17_needed" value="1" <?php echo get_status_checked($data['taj_17_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_17_needed" value="0" <?php echo get_status_checked($data['taj_17_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">سیستم کنترل هوشمند دمای کندو</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_18_exists" value="1" onclick="toggleNeeded('taj_18', false)" required <?php echo get_status_checked($data['taj_18_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_18_exists" value="0" onclick="toggleNeeded('taj_18', true)" required <?php echo get_status_checked($data['taj_18_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_18_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_18_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_18_needed" value="1" <?php echo get_status_checked($data['taj_18_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_18_needed" value="0" <?php echo get_status_checked($data['taj_18_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">دستگاه رطوبت گیر عسل</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_19_exists" value="1" onclick="toggleNeeded('taj_19', false)" required <?php echo get_status_checked($data['taj_19_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_19_exists" value="0" onclick="toggleNeeded('taj_19', true)" required <?php echo get_status_checked($data['taj_19_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_19_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_19_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_19_needed" value="1" <?php echo get_status_checked($data['taj_19_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_19_needed" value="0" <?php echo get_status_checked($data['taj_19_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equipment-item">
                                            <div class="equipment-name">دستگاه تغلیظ کننده عسل اتوماتیک</div>
                                            <div class="option-group">
                                                <label class="option-label exists">
                                                    <input type="radio" name="taj_20_exists" value="1" onclick="toggleNeeded('taj_20', false)" required <?php echo get_status_checked($data['taj_20_exists'], 1); ?>>
                                                    <span class="custom-radio"></span> موجود
                                                </label>
                                                <label class="option-label not-exists">
                                                    <input type="radio" name="taj_20_exists" value="0" onclick="toggleNeeded('taj_20', true)" required <?php echo get_status_checked($data['taj_20_exists'], 0); ?>>
                                                    <span class="custom-radio"></span> ناموجود
                                                </label>
                                                <div id="taj_20_needed_options" class="needed-options option-group" style="display: <?php echo ($data['taj_20_exists'] == 0) ? 'flex' : 'none'; ?>;">
                                                    <label class="option-label needed">
                                                        <input type="radio" name="taj_20_needed" value="1" <?php echo get_status_checked($data['taj_20_needed'], 1); ?>>
                                                        <span class="custom-radio"></span> نیاز هست
                                                    </label>
                                                    <label class="option-label not-needed">
                                                        <input type="radio" name="taj_20_needed" value="0" <?php echo get_status_checked($data['taj_20_needed'], 0); ?>>
                                                        <span class="custom-radio"></span> نیاز نیست
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <input name="send_data" type="submit" class="button" id="submitBtn" tabindex="50" value="ویرایش اطلاعات" />
                                    <input type="button" class="button" id="cancelBtn" value="انصراف" onclick="cancelAction()" />
                                </div>
                                <br />
                                <div align="center">
                                    <input type="hidden" name="unique_id" value="<?php echo htmlspecialchars($unique_id); ?>" />
                                    <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m); ?>" />
                                    <input type="hidden" name="num_bah" value="<?php echo htmlspecialchars($num_bah); ?>" />
                                    
                                    <input type="hidden" name="add_city" id="add_city" value="<?php echo htmlspecialchars($data['add_city']); ?>" />
                                    <input type="hidden" name="add_abadi" id="add_abadi" value="<?php echo htmlspecialchars($data['add_abadi']); ?>" />
                                    <input type="hidden" name="no_zan" id="no_zan" value="<?php echo htmlspecialchars($data['no_zan']); ?>" />
                                    <input type="hidden" name="id_ostan" id="id_ostan" value="<?php echo htmlspecialchars($data['id_ostan']); ?>" />
                                    <input type="hidden" name="id_city" id="id_city" value="<?php echo htmlspecialchars($data['id_city']); ?>" />
                                    <input type="hidden" name="id_mar" id="id_mar" value="<?php echo htmlspecialchars($data['id_mar']); ?>" />
                                </div>
                            </form>
                        </td>
                        <td width="4">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>