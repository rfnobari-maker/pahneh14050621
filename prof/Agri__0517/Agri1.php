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
<link href="../../FA.css" rel="stylesheet" type="text/css"/>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="../reza_1.css">
    <link href="../radio.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
        <td><img src="../../files/images/header.jpg" width="100%" height="100"/></td>
    </tr>
    <tr>
        <td ><?php include('menu.php'); ?>
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

                        <p class="style8">ثبت اطلاعات بهره برداری زراعی جدید</p><a name="1" id="1"></a>
                      <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/><br />                        
                        <div id="div">
                            <div id="mess"><?php if (isset($mess)) echo $mess ?>
                            </div>
                            <form id="reg-form" method="post" action="#1">
                                <table width="100%" height="97" border="0">
                                    <tr>
                                        <td width="38%" height="93">
                                            <p style="text-align: right">

                                                <select name="add_city" class="input_text shahr_select"
                                                        style="<?= $add_city ? '' : 'display:none;' ?>width:170px ; height:40px"
                                                        dir="rtl">
                                                    <option value="">انتخاب نام شهر</option>
                                                    <?php
                                                    $query = "SELECT  add_city,shahr FROM `list_city` WHERE mor_cod_m = :mor_cod_m";
                                                  $stmt = $dbh->prepare($query);
                                                $stmt->execute(array(':mor_cod_m' => $login_session));
                                                    foreach ($stmt as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['add_city']; ?>"
                                                            <?php if (isset($_POST['add_city']) && $row['add_city'] == $add_city) echo 'selected=selected' ?>> <?php echo $row['shahr']; ?></option>
                                                    <?php } ?>
                                                </select>

                                                <select dir="rtl" name="add_abadi" class="input_text abadi_select"
                                                        style="<?= $add_abadi ? '' : 'display:none;' ?>width:170px ; height:40px">
                                                    <option value="">انتخاب نام آبادی</option>
                                                    <?php
                                                    $query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = :mor_cod_m ORDER BY BINARY abadi";
                                                   $stmt = $dbh->prepare($query);
                                                   $stmt->execute(array(':mor_cod_m' => $login_session));
                                                    foreach ($stmt as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['add_abadi']; ?>"
                                                            <?php if (isset($_POST['add_abadi']) && $row['add_abadi'] == $add_abadi) echo 'selected=selected' ?>> <?php echo $row['abadi']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </p>
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
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td height="68" colspan="2" align="right">
                                            <div align="right">
                                                <input name="bah_cod_m" class="required" type="text" maxlength="12"
                                                       value="<?php if (isset($_POST['bah_cod_m'])) echo $bah_cod_m; ?>"/>
                                            </div>
                                        </td>
                                        <td width="31%">
                                            <div align="right"> : کد ملی بهره بردار / مدیرعامل</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">&nbsp;</td>
                                        <td width="18%" height="42">
                                            <div align="right"><span style="text-align: right">آبی
   <input type="radio" class="green" name="no_kesh"
          <?php if (isset($_POST['no_kesh']) && $no_kesh == '1') { ?>checked='checked' <?php } ?> value="1"/>
                    </span></div>
                                        </td>
                                        <td rowspan="2">
                                            <div align="right"> : نوع کشت</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="37" align="center">
                                            <div align="right"><span style="text-align: right">دیم
   <input type="radio" class="green" name="no_kesh"
          <?php if (isset($_POST['no_kesh']) && $no_kesh == '2') { ?>checked='checked' <?php } ?> value="2"/>
                    </span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="55" colspan="2" align="center">
                                            <div align="right">
                                                <select name="no_mal" class="input_text  required" id="no_mal"
                                                        style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                                                    <option value="">انتخاب کنید</option>
                                                    <option value="1" <?php if (isset($_POST['no_mal']) && $no_mal == '1') {
                                                        echo 'selected="selected"';
                                                    } ?>>سند ششدانگ
                                                    </option>
                                                    <option value="2" <?php if (isset($_POST['no_mal']) && $no_mal == '2') {
                                                        echo 'selected="selected"';
                                                    } ?>>سند مشاعی
                                                    </option>
                                                    <option value="3" <?php if (isset($_POST['no_mal']) && $no_mal == '3') {
                                                        echo 'selected="selected"';
                                                    } ?>>اصلاحات اراضی
                                                    </option>
                                                    <option value="4" <?php if (isset($_POST['no_mal']) && $no_mal == '4') {
                                                        echo 'selected="selected"';
                                                    } ?>>موقوفه
                                                    </option>
                                                    <option value="5" <?php if (isset($_POST['no_mal']) && $no_mal == '5') {
                                                        echo 'selected="selected"';
                                                    } ?>>واگذاری
                                                    </option>
                                                    <option value="6" <?php if (isset($_POST['no_mal']) && $no_mal == '6') {
                                                        echo 'selected="selected"';
                                                    } ?>>قولنامه
                                                    </option>
                                                    <option value="7" <?php if (isset($_POST['no_mal']) && $no_mal == '7') {
                                                        echo 'selected="selected"';
                                                    } ?>>اجاره
                                                    </option>
                                                    <option value="8" <?php if (isset($_POST['no_mal']) && $no_mal == '8') {
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
                                      <td height="107" colspan="3">
                                        <input id="sub" name="action" type="submit" class="style8" value="ادامه"/>
                                        <input type="hidden" name="m_poul"    value="<?php echo $m_poul; ?>"/>
                                        <input type="hidden" name="add_city"  value="<?php echo $add_city; ?>"/>
                                        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>"/>
                                        <input type="hidden" name="agri_h"    value="1"/>
                                        <?php if (isset($not_found_bah))  { ?>
                                        <input name="action1" type="submit" class="style8"
     value="ثبت اطلاعات بهره بردار"/>
                                        </td>
                                      <?php } ?>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg"
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