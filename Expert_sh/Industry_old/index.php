<?php
include('../../lock_expsh.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php');
if (isset($_POST['no_mal'])) $no_mal = $_POST['no_mal'];
if (isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'];
if (isset($_POST['action1'])) {
    ?>
    <form name="myform" class="myform" method="post" action="../ind.php">
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
    $no_mal = $_POST['no_mal'];
    if ($no_mal == '') $mess .= 'نوع مالکیت را انتخاب کنید' . '<p>';
    if ($bah_cod_m <> '' & check_code_melli($bah_cod_m) <> 1) $mess .= 'کد ملی بهره بردار صحیح نیست';
    if ((isset($_POST['action'])) and ($mess == '')) {
        $query = "SELECT count(*) from ind_bah where bah_cod_m = $bah_cod_m";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $count_codm = $stmt->fetchColumn();
        if ($count_codm > 1) {
            ?>
            <form name="myform1" class="myform" method="post" action="ind_bah_history.php">
                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>"/>
                <input type="hidden" name="num_bah" value="<?php echo $num_bah; ?>"/>
                <input type="hidden" name="m_poul" value="<?php echo $m_poul; ?>"/>
                <input type="hidden" name="add_city" value="<?php echo $add_city; ?>"/>
                <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>"/>
                <input type="hidden" name="no_mal" value="<?php echo $no_mal; ?>"/>
                <input type="hidden" name="t_gat" value="<?php echo $count_codm; ?>"/>
            </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
        }
        if ($count_codm == 0) {
            $mess = 'اطلاعات بهره بردار یافت نشد <p> برای ثبت اطلاعات واحد صنعتی ، ابتدا اطلاعات بهره بردار را ثبت نمایید ';
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
                <form name="myform1" class="myform" method="post" action="ind_unit_history.php">
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>"/>
                    <input type="hidden" name="m_poul" value="<?php echo $m_poul; ?>"/>
                    <input type="hidden" name="add_city" value="<?php echo $add_city; ?>"/>
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>"/>
                    <input type="hidden" name="no_mal" value="<?php echo $no_mal; ?>"/>
                </form>
                <script type="text/javascript">document.myform1.submit();</script>
                <?php
            }
            ?>
            <form name="myform1" class="myform" method="post" action="ind_unit_data.php">
                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>"/>
                <input type="hidden" name="m_poul" value="<?php echo $m_poul; ?>"/>
                <input type="hidden" name="add_city" value="<?php echo $add_city; ?>"/>
                <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>"/>
                <input type="hidden" name="no_mal" value="<?php echo $no_mal; ?>"/>
            </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css"/>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="../reza_1.css">
    <link href="../radio.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
    <script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script>
        function autoSubmit() {
            var formObject = document.forms['reg-form'];
            formObject.submit();
        }
    </script>
    <!--style the error message-->
    <style type="text/css">
        .error {
            display: block;
            color: red;
            font-style: italic;
        }

        #message {
            display: none;
            font-size: 15px;
            font-weight: bold;
            color: #333333;
        }
    </style>
</head>
<body>

<div id="rasul" style="width: 100%; height: 100%; background: #726d6d; display: none;  opacity: 0.6; position: fixed; z-index: 4;">
    <img src="img/loading2.gif" style="margin: auto;float: right;z-index: 93;width: 90px;min-height: 50px;position: fixed;left: 0;right: 0;margin: 200px auto;">
    
</div>

<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td><img src="../../files/images/header.jpg" width="100%" height="149"/></td>
    </tr>
    <tr>
        <td><?php include('menu.php'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td width="4"><p>&nbsp;</p>
                        <p>&nbsp;</p></td>
                    <?php include('top.php'); ?>
                    <td width="840">

                        <p class="style8">ثبت اطلاعات واحد صنعتی جدید</p><a name="1" id="1"></a>
                        <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                        <div id="div">
                            <div id="mess"><?php if (isset($mess)) echo $mess ?>
                            </div>
                            <form id="reg-form" method="post" action="#1">
                                <table width="100%" height="97" border="0">
                                    <tr>
                                        <td width="38%" height="93">
                                            <div align="right" >
                                                <select name="add_city" class="input_text shahr_select"
                                                        style="<?= $add_city ? '' : 'display:none;' ?>width:170px ; height:40px"
                                                        dir="rtl">
                                                    <option value="">انتخاب نام شهر</option>
                                                    <?php
                      $query = "SELECT  add_city,shahr FROM list_city WHERE  id_ostan = '$id_ostan' and  id_city = '$id_city' ORDER BY BINARY city ASC"  ;
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach ($stmt as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['add_city']; ?>"
                                                            <?php if (isset($POST['add_city']) && $row['add_city'] == $add_city) echo 'selected=selected' ?>> <?php echo $row['shahr']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <select dir="rtl" name="add_abadi" class="input_text abadi_select"
                                                        style="<?= $add_abadi ? '' : 'display:none;' ?>width:170px ; height:40px">
                                                    <option value="">انتخاب نام آبادی</option>
                                                    <?php
                    $query = "SELECT  add_abadi,abadi FROM list_abadi WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' ORDER BY BINARY abadi ASC"   ;
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach ($stmt as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['add_abadi']; ?>"
                                                            <?php if (isset($POST['add_abadi']) && $row['add_abadi'] == $add_abadi) echo 'selected=selected' ?>> <?php echo $row['abadi']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td width="20%"><?php if (isset($_POST['m_poul']) && $m_poul == 'shahr') { ?>
                                                : نام شهر
                                            <?php }
                                            if (isset($_POST['m_poul']) && $m_poul == 'abadi') { ?>
                                                : نام آبادی
                                            <?php }
                                            ?></td>
                                        <td width="18%"><p style="text-align: right">شهر
                                                <input type="radio" class="green region" name="m_poul"
                                                       <?php if (isset($_POST['m_poul']) && $m_poul == 'shahr') { ?>checked='checked' <?php } ?>
                                                       value="shahr"/>
                                            </p>
                                            <p style="text-align: right"> آبادی
                                                <input type="radio" class="green region" name="m_poul"
                                                       <?php if (isset($_POST['m_poul']) && $m_poul == 'abadi') { ?>checked='checked' <?php } ?>
                                                       value="abadi"/>
                                            </p></td>
                                        <td width="24%" class="normalTextSmall"> : موقعیت بهره برداری</td>
                                    </tr>
                                </table>
                                <input type="hidden" name="bah_cod_m"
                                       value="<?php if (isset($bah_cod_m)) echo $bah_cod_m; ?>"/>
                                <input type="hidden" name="no_kesh"
                                       value="<?php if (isset($no_kesh)) echo $no_kesh; ?>"/>
                                <input type="hidden" name="t_mah" value="<?php if (isset($t_mah)) echo $t_mah; ?>"/>
                                <input type="hidden" name="no_mal" value="<?php if (isset($no_mal)) echo $no_mal; ?>"/>

                            </form>
                            <form id="form" name="form1" action="" method="post">
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="18%" height="68" align="right">
                                            <div align="right">
                                                <input name="bah_cod_m" class="required" type="text" maxlength="10"
                                                       value="<?php if (isset($_POST['bah_cod_m'])) echo $bah_cod_m; ?>"/>
                                            </div>
                                        </td>
                                        <td width="31%">
                                            <div align="right"> : کد ملی بهره بردار / مدیرعامل</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="55" align="center">
                                            <div align="right">
                                                <select name="no_mal" class="input_text  required" id="no_mal"
                                                        style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                                                    <option value="">انتخاب کنید</option>
                                                    <option value="1" <?php if (isset($POST['no_mal']) && $no_mal == '1') {
                                                        echo 'selected="selected"';
                                                    } ?>>امور اراضی
                                                    </option>
                                                    <option value="2" <?php if (isset($POST['no_mal']) && $no_mal == '2') {
                                                        echo 'selected="selected"';
                                                    } ?>>منابع طبیعی
                                                    </option>
                                                    <option value="3" <?php if (isset($POST['no_mal']) && $no_mal == '3') {
                                                        echo 'selected="selected"';
                                                    } ?>>شهرک صنعتی
                                                    </option>
                                                    <option value="4" <?php if (isset($POST['no_mal']) && $no_mal == '4') {
                                                        echo 'selected="selected"';
                                                    } ?>>مالکیت شخصی
                                                    </option>
                                                    <option value="5" <?php if (isset($POST['no_mal']) && $no_mal == '5') {
                                                        echo 'selected="selected"';
                                                    } ?>>اجاره ای
                                                    </option>
                                                    <option value="6" <?php if (isset($POST['no_mal']) && $no_mal == '6') {
                                                        echo 'selected="selected"';
                                                    } ?>>سایر
                                                    </option>
                                                </select></div>
                                        </td>
                                        <td>
                                            <div align="right"> : نوع مالکیت</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="72">
                                            <div align="right">
                                                <select name="agri_h" class="input_text  required" id="no_mal2"
                                                        style="height:40px ; width:120px ; direction:rtl" tabindex="4">
                                                    <option value="1">خیر</option>
                                                    <option value="2">بلی</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td height="72">
                                            <div align="right"> : نمایش واحد های قبلی</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="107" colspan="2"><input id="sub" name="action" type="submit"
                                                                            class="style8" value="ادامه"/>
                                            <input type="hidden" name="m_poul" value="<?php echo $m_poul; ?>"/>
                                            <input type="hidden" name="add_city" value="<?php echo $add_city; ?>"/>
                                            <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>"/>
                                            <?php if (isset($not_found_bah))  { ?>
                                            <input name="action1" type="submit" class="style8"
                                                   value="ثبت اطلاعات بهره بردار"/>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <p><a href="../Industry.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg"
                                                                                 width="118" height="47" alt=""/> </a>
                        </p>
                        <p>&nbsp;</p></td>
                </tr>
                <tr>
                    <td height="109" colspan="3" valign="middle"
                        background="../../files/bottom.gif"><?php include('../../footer.php') ?></td>
                </tr>
            </table>
</table>
<script>

    $('#sub').click(function () {

    var r = $('#rasul').css('display','block');
r.delay(400).find(30000);

    })


    $(document).ready(function () {
        $('.shahr_select').change(function () {
            $('[name=add_city]').val(this.value)
        });

        $('.abadi_select').change(function () {
            $('[name=add_abadi]').val(this.value)
        });

        $('input.region').change(function () {
            console.log(this.value)
            $('[type=hidden][name=m_poul]').val(this.value)
            if (this.value == 'shahr') {
                $('.shahr_select').show();
                $('.abadi_select').hide();
            }
            else if (this.value == 'abadi') {
                $('.abadi_select').show();
                $('.shahr_select').hide();
            }
        });
    });
</script>
</body>
</html>