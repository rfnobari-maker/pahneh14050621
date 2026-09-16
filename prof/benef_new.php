<?php
include('../lock_p1.php');
include('../login/config.php');
include('../event.php');
// Initialize variables
$m_bah = $add_abadi = $add_city = $no_bah = $no_nation = $bah_cod_m = $date_t = $s_bah = $sh_meli = "";
$mess = '';
// Process form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $m_bah = isset($_POST["m_bah"]) ? trim($_POST["m_bah"]) : "";
    $add_abadi = isset($_POST["add_abadi"]) ? trim($_POST["add_abadi"]) : "";
    $add_city = isset($_POST["add_city"]) ? trim($_POST["add_city"]) : "";
    $no_nation = isset($_POST["no_nation"]) ? trim($_POST["no_nation"]) : "";
    $no_bah = isset($_POST["no_bah"]) ? trim($_POST["no_bah"]) : "";
    $bah_cod_m = isset($_POST["bah_cod_m"]) ? trim($_POST["bah_cod_m"]) : "";
    $date_t = isset($_POST["date_t"]) ? trim($_POST["date_t"]) : "";
    $s_bah = isset($_POST["s_bah"]) ? trim($_POST["s_bah"]) : "";
    $sh_meli = isset($_POST["sh_meli"]) ? trim($_POST["sh_meli"]) : "";

    // Validation
    if (isset($_POST['action'])) {
        if ($m_bah == '') $mess = 'موقعیت بهره بردار را انتخاب کنید' . '<p>';
        
        if ($m_bah == 'shahr' && $add_city == '') $mess .= 'نام شهر را انتخاب کنید' . '<p>';
        if ($m_bah == 'abadi' && $add_abadi == '') $mess .= 'نام آبادی را انتخاب کنید' . '<p>';
        
        if ($no_nation == '') $mess .= 'ملیت بهره بردار را تعیین کنید' . '<p>';
        
        if ($no_nation == '1' && $no_bah == '') $mess .= 'نوع بهره بردار را انتخاب کنید' . '<p>';
        if ($no_nation == '2') $no_bah = '1';
        
        if ($bah_cod_m == '') $mess .= 'کد ملی را وارد کنید' . '<p>';
        if ($no_nation == '1' && strlen($bah_cod_m) < 10) $mess .= 'کد ملی باید 10 رقمی باشد' . '<p>';
        
        // Validate sh_meli for legal entities
        if ($no_bah == '2' && $sh_meli == '') $mess .= 'شناسه ملی را وارد کنید' . '<p>';
        if ($no_bah == '2' && strlen($sh_meli) < 11) $mess .= 'شناسه ملی باید 11 رقمی باشد' . '<p>';
        
        if ($s_bah == '') $mess .= 'وضعیت سکونت بهره بردار را انتخاب کنید' . '<p>';
        
        // If no errors, proceed
        if ($mess == '') {
            // Check if beneficiary already exists
            $query = "SELECT id FROM bah WHERE bah_cod_m = ? AND no_bah = '1'";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array($bah_cod_m));
            $count_codm = $stmt->rowCount();
            
            if ($no_bah == '1' && $count_codm > 0) {
                $mess = 'اطلاعات بهره بردار قبلاً ثبت شده است';
            } else {
                // Redirect to next page with form data
                ?>
                <form name="myform1" class="myform" method="post" action="benef_data_new.php">
                    <input type="hidden" name="m_bah" value="<?php echo htmlspecialchars($m_bah); ?>" />
                    <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($add_city); ?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($add_abadi); ?>" />
                    <input type="hidden" name="no_bah" value="<?php echo htmlspecialchars($no_bah); ?>" />
                    <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m); ?>" />
                    <input type="hidden" name="date_t" value="<?php echo htmlspecialchars($date_t); ?>" />
                    <input type="hidden" name="num_bah" value="<?php echo $count_codm + 1; ?>" />
                    <input type="hidden" name="s_bah" value="<?php echo htmlspecialchars($s_bah); ?>" />
                    <input type="hidden" name="no_nation" value="<?php echo htmlspecialchars($no_nation); ?>" />
                    <input type="hidden" name="sh_meli" value="<?php echo htmlspecialchars($sh_meli); ?>" />
                </form>
                <script type="text/javascript">document.myform1.submit();</script>
                <?php
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa" xml:lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title; ?></title>
    <link href="../FA.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="reza_1.css">
    <link href="radio.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js-persian-cal.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
        });
    </script>
    <script>
    function autoSubmit() {
        document.forms['reg-form'].submit();
    }
    function autoSubmit1() {
        document.forms['no_bah'].submit();
    }
    function autoSubmit2() {
        document.forms['no_nation'].submit();
    }
    </script>
    <style type="text/css"> 
    .error { 
        display: block; 
        color: red; 
        font-style: italic; 
    } 
    #message { 
        display:none; 
        font-size:15px; 
        font-weight:bold; 
        color:#333333; 
    } 
    </style> 
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
        </tr>
        <tr>
            <td><?php include('menu.php'); ?></td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                        <?php include('top.php'); ?>
                        <td width="840">
                            <p class="style8">ثبت بهره بردار جدید <span class="normalTextSmall"><span class="style21"><a name="1" id="13"></a></span></span></p>
                            <p><img src="../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                            <div id="div">
                                <div id="mess"><?php echo $mess ?></div>
                                <form id="reg-form" method="post" action="#1">
                                    <table width="100%" height="97" border="0" dir="ltr">
                                        <tr>
                                            <td width="38%" height="93">
                                                <p style="text-align: right">
                                                    <?php if ($m_bah == 'shahr') { ?>
                                                    <select name="add_city" style="width:170px; height:40px" dir="rtl" onchange="this.form.submit()">
                                                        <option value="">انتخاب نام شهر</option>
                                                        <?php
                                                        $query = "SELECT add_city, shahr FROM list_city WHERE mor_cod_m = ?";
                                                        $stmt = $dbh->prepare($query);
                                                        $stmt->execute(array($login_session));
                                                        foreach($stmt as $row) {
                                                        ?>
                                                        <option value="<?php echo htmlspecialchars($row['add_city']); ?>" <?php if ($row['add_city'] == $add_city) echo 'selected="selected"'; ?>>
                                                            <?php echo htmlspecialchars($row['shahr']); ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php } ?>
                                                    <?php if ($m_bah == 'abadi') { ?>
                                                    <select dir="rtl" name="add_abadi" class="required" style="width:170px; height:40px" onchange="this.form.submit()">
                                                        <option value="">انتخاب نام آبادی</option>
                                                        <?php
                                                        $query = "SELECT add_abadi, abadi FROM list_abadi WHERE mor_cod_m = ? ORDER BY BINARY abadi";
                                                        $stmt = $dbh->prepare($query);
                                                        $stmt->execute(array($login_session));
                                                        foreach($stmt as $row) {
                                                        ?>
                                                        <option value="<?php echo htmlspecialchars($row['add_abadi']); ?>" <?php if ($row['add_abadi'] == $add_abadi) echo 'selected="selected"'; ?>>
                                                            <?php echo htmlspecialchars($row['abadi']); ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php } ?>
                                                </p>
                                            </td>
                                            <td width="20%">
                                                <?php 
                                                if ($m_bah == 'shahr') echo ': نام شهر';
                                                if ($m_bah == 'abadi') echo ': نام آبادی';
                                                ?>
                                            </td>
                                            <td width="18%">
                                                <p style="text-align: right">شهر
                                                    <input type="radio" class="red" name="m_bah" <?php if ($m_bah == 'shahr') echo 'checked="checked"'; ?> value="shahr" onChange="autoSubmit();" />
                                                </p>
                                                <p style="text-align: right"> آبادی
                                                    <input type="radio" class="red" name="m_bah" <?php if ($m_bah == 'abadi') echo 'checked="checked"'; ?> value="abadi" onChange="autoSubmit();" />
                                                </p>
                                            </td>
                                            <td width="24%" class="normalTextSmall">: موقعیت بهره بردار</td>
                                        </tr>
                                    </table>
                                </form>
                                <form id="no_nation" method="post" action="#1">
                                    <table width="100%" border="0" dir="ltr">
                                        <tr>
                                            <td width="76%">
                                                <p style="text-align: right"> ایرانی
                                                    <input type="radio" value="1" class="red" name="no_nation" <?php if($no_nation == '1') echo 'checked="checked"'; ?> onChange="autoSubmit2();" />
                                                </p>
                                                <p style="text-align: right"> تبعه خارجی
                                                    <input type="radio" value="2" class="red" name="no_nation" <?php if ($no_nation == '2') echo 'checked="checked"'; ?> onchange="autoSubmit2();" />
                                                    <input type="hidden" name="m_bah" value="<?php echo htmlspecialchars($m_bah); ?>" />
                                                    <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($add_city); ?>" />
                                                    <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($add_abadi); ?>" />
                                                </p>
                                            </td>
                                            <td width="24%" class="normalTextSmall">:ملیت بهره بردار</td>
                                        </tr>
                                    </table>
                                </form>
                                <?php if($no_nation == '1') { ?>
                                <form id="no_bah" method="post" action="">
                                    <table width="100%" border="0" dir="ltr">
                                        <tr>
                                            <td width="76%">
                                                <p style="text-align: right">
                                                    حقیقی
                                                    <input type="radio" class="red" name="no_bah" <?php if ($no_bah == '1') echo 'checked="checked"'; ?> value="1" onChange="autoSubmit1();" />
                                                <p style="text-align: right"> حقوقی
                                                    <input type="radio" class="red" name="no_bah" <?php if ($no_bah == '2') echo 'checked="checked"'; ?> value="2" onChange="autoSubmit1();" />
                                                    <input type="hidden" name="m_bah" value="<?php echo htmlspecialchars($m_bah); ?>" />
                                                    <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($add_city); ?>" />
                                                    <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($add_abadi); ?>" />
                                                    <input type="hidden" name="no_nation" value="<?php echo htmlspecialchars($no_nation); ?>" />
                                            </td>
                                            <td width="24%" class="normalTextSmall">:نوع بهره بردار</td>
                                        </tr>
                                    </table>
                                </form>
                                <?php } ?>
                                <form id="form1" name="form1" action="" method="post">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" dir="ltr">
                                        <tr>
                                            <td width="76%" align="right">
                                                <div align="right">
                                                    <?php if (isset($_POST['no_bah']) || isset($_POST['no_nation'])) { ?>
                                                    <input name="bah_cod_m" class="required" type="text" value="<?php echo htmlspecialchars($bah_cod_m); ?>"/>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td width="24%">
                                                <?php
                                                if ($no_bah == '1') echo ': کد ملی بهره بردار';
                                                if ($no_bah == '2') echo ': کد ملی مدیر عامل';
                                                if ($no_nation == '2') echo ': کد اختصاصی';
                                                ?>
                                            </td>
                                        </tr>
                                        <?php if ($no_bah == '2') { ?>
                                        <tr>
                                            <td width="76%" align="right">
                                                <div align="right">
                                                    <input name="sh_meli" class="required digits" type="text" value="<?php echo htmlspecialchars($sh_meli); ?>" maxlength="11" minlength="11" placeholder="شناسه ملی (11 رقمی)"/>
                                                </div>
                                            </td>
                                            <td width="24%">: شناسه ملی شرکت</td>
                                        </tr>
                                        <?php } ?>
                                        <?php if ($no_nation == '1') { ?>
                                        <tr>
                                            <td height="119" align="right">
                                                <div align="right"><span class="style8">13520425: مثال</span>
                                                    <input name="date_t" type="text" class="required digits" id="date_t" value="<?php echo htmlspecialchars($date_t); ?>" maxlength="8" minlength="4"/>
                                                </div>
                                            </td>
                                            <td><span class="normalTextSmall">: تاریخ تولد</span></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>
                                                <p style="text-align: right"> ساکن <span class="style2">مدت سکونت حداقل شش ماه در سال</span>
                                                    <input type="radio" class="red" name="s_bah" <?php if ($s_bah == '1') echo 'checked="checked"'; ?> value="1" />
                                                </p>
                                                <p style="text-align: right"> غیرساکن <span class="style2">مدت سکونت کمتر از شش ماه در سال</span>
                                                    <input type="radio" class="red" name="s_bah" <?php if ($s_bah == '2') echo 'checked="checked"'; ?> value="2" />
                                                </p>
                                                <p style="text-align: right"> عشایر 
                                                    <input type="radio" class="red" name="s_bah" <?php if ($s_bah == '3') echo 'checked="checked"'; ?> value="3" />
                                                    <input type="hidden" name="m_bah" value="<?php echo htmlspecialchars($m_bah); ?>" />
                                                    <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($add_city); ?>" />
                                                    <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($add_abadi); ?>" />
                                                    <input type="hidden" name="no_bah" value="<?php echo htmlspecialchars($no_bah); ?>" />
                                                    <input type="hidden" name="no_nation" value="<?php echo htmlspecialchars($no_nation); ?>" />
                                                </p>
                                            </td>
                                            <td>: وضعیت سکونت</td>
                                        </tr>
                                        <tr>
                                            <td height="107" colspan="2"><input name="action" type="submit" value="ادامه" /></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <p><a href="benefic.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47" alt=""/> </a></p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>