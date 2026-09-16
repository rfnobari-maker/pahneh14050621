<?php
include('../../lock_p1.php');
include_once('../../login/config.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");

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
    if ($m_poul == '') $mess = 'موقعیت را تعیین کنید ' . '<p>';
    $add_city = $_POST["add_city"];
    if ($m_poul == 'shahr' and $add_city == '') $mess .= 'نام شهر را انتخاب کنید' . '<p>';
    $add_abadi = $_POST["add_abadi"];
    if ($m_poul == 'abadi' and $add_abadi == '') $mess .= 'نام آبادی را انتخاب کنید' . '<p>';
    if ((isset($_POST['action'])) and ($mess == '')) 
	{
   if ($m_poul == 'abadi')
{		

$query ="CREATE TEMPORARY TABLE tmp$login_session SELECT * FROM `Garden` WHERE add_abadi=:add_abadi and z_sal = '1397' " ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));

$query = "SELECT count(*)  from tmp$login_session WHERE 1 ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol = $stmt -> fetchColumn();

$query = "update tmp$login_session set date_s = id ,id_old = id ,id = '',z_sal='1398',t_mah=0 where add_abadi = :add_abadi ";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));

$query = "delete tmp$login_session.*
from tmp$login_session
INNER JOIN `Garden`
on tmp$login_session.bah_cod_m = `Garden`.bah_cod_m  and tmp$login_session.add_abadi = `Garden`.add_abadi and `Garden`.z_sal = '1398' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "SELECT count(*)  from tmp$login_session WHERE 1 ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol2 = $stmt -> fetchColumn();

$query = "INSERT INTO `Garden` (SELECT * FROM tmp$login_session where add_abadi = '$add_abadi' )" ;  	
$stmt = $dbh->prepare($query);
$stmt->execute();

//Garden_prod
$query ="CREATE TEMPORARY TABLE tmpp$login_session SELECT * FROM `Garden_prod` WHERE add_abadi=:add_abadi and z_sal = '1397' " ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));

$query = "update tmpp$login_session set date_s = :date_s ,id = '' ,Garden_id_old = Garden_id,Garden_id = '',z_sal='1398' , mah_tol=0 , mah_tolp=0 where add_abadi = :add_abadi ";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':date_s'=>$date_edit,':add_abadi'=>$add_abadi));

$query = "delete tmpp$login_session.*
from tmpp$login_session
INNER JOIN `Garden_prod`
on tmpp$login_session.bah_cod_m=`Garden_prod`.bah_cod_m  and tmpp$login_session.add_abadi = `Garden_prod`.add_abadi and `Garden_prod`.z_sal = '1398' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "INSERT INTO `Garden_prod` (SELECT * FROM tmpp$login_session where add_abadi = '$add_abadi' )" ;  	
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "update `Garden_prod`
INNER JOIN `Garden` ON `Garden`.`id_old` = `Garden_prod`.`Garden_id_old`
set `Garden_id`=`Garden`.`id` , Garden_id_old = 0
WHERE `Garden_prod`.add_abadi = '$add_abadi' and `Garden_prod`.z_sal = '1398' "; 
$q = $dbh->prepare($query);
$q->execute();

////

}

   if ($m_poul == 'shahr')
{		
$query ="CREATE TEMPORARY TABLE tmp$login_session SELECT * FROM `Garden` WHERE add_city=:add_city and z_sal = '1397' " ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));

$query = "SELECT count(*)  from tmp$login_session WHERE 1 ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol = $stmt -> fetchColumn();

$query = "update tmp$login_session set date_s = id ,id_old = id ,id = '',z_sal='1398',t_mah=0 where add_city = :add_city ";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));

$query = "delete tmp$login_session.*
from tmp$login_session
INNER JOIN `Garden`
on tmp$login_session.bah_cod_m = `Garden`.bah_cod_m  and tmp$login_session.add_city = `Garden`.add_city and `Garden`.z_sal = '1398' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "SELECT count(*)  from tmp$login_session WHERE 1 ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol2 = $stmt -> fetchColumn();

$query = "INSERT INTO `Garden` (SELECT * FROM tmp$login_session where add_city = '$add_city' )" ;  	
$stmt = $dbh->prepare($query);
$stmt->execute();

//Garden_prod
$query ="CREATE TEMPORARY TABLE tmpp$login_session SELECT * FROM `Garden_prod` WHERE add_city=:add_city and z_sal = '1397' " ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));

$query = "update tmpp$login_session set date_s = :date_s ,id = '' ,Garden_id_old = Garden_id,Garden_id = '',z_sal='1398' , mah_tol=0 , mah_tolp=0 where add_city = :add_city ";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':date_s'=>$date_edit,':add_city'=>$add_city));

$query = "delete tmpp$login_session.*
from tmpp$login_session
INNER JOIN `Garden_prod`
on tmpp$login_session.bah_cod_m=`Garden_prod`.bah_cod_m  and tmpp$login_session.add_city = `Garden_prod`.add_city and `Garden_prod`.z_sal = '1398' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "INSERT INTO `Garden_prod` (SELECT * FROM tmpp$login_session where add_city = '$add_city' )" ;  	
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "update `Garden_prod`
INNER JOIN `Garden` ON `Garden`.`id_old` = `Garden_prod`.`Garden_id_old`
set `Garden_id`=`Garden`.`id` , Garden_id_old = 0
WHERE `Garden_prod`.add_city = $add_city and `Garden_prod`.z_sal = '1398' "; 
$q = $dbh->prepare($query);
$q->execute();
}
alert('آمار انتقال قطعات \n \n - تعداد قطعات  موجود در سال مبدا :'.$kol. ' \n \n - تعداد قطعات انتقال داده شده به سال مقصد : '.$kol2  ) ; 
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
    <link href="../radio.css" rel="stylesheet" type="text/css"/>
    <script src="../../15_files/jquery.js" type="text/javascript"></script>
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
#div{
background-color:#FFF;
color:#036;
border-radius:15px;
border:1px solid #d3cd3d;
padding:4px 30px;
font-weight:700;
width:600px;
font-size:12px;
height:auto;
margin:auto
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

                        <p class="style8">انتقال اطلاعات باغی </p><a name="1" id="1"></a>
                        <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                        <div id="div">
                            <div id="mess"><?php if (isset($mess)) echo $mess ?>
                            </div>
                            <form id="reg-form" method="post" action="#1">
                                <table width="100%" height="97" border="0">
                                    <tr>
                                        <td height="93">
                                            <p style="text-align: right">

                                                <select name="add_city" class="input_text shahr_select"
                                                        style="<?= $add_city ? '' : 'display:none;' ?>width:170px ; height:40px"
                                                        dir="rtl">
                                                    <option value="">انتخاب نام شهر</option>
                                                    <?php
                                                    $query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = $login_session";
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
                                                    $query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session' ";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach ($stmt as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['add_abadi']; ?>"
                                                            <?php if (isset($POST['add_abadi']) && $row['add_abadi'] == $add_abadi) echo 'selected=selected' ?>> <?php echo $row['abadi']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </p>
                                        </td>
                                        <td width="23%"><p style="text-align: right">شهر
                                                <input type="radio" class="green region" name="m_poul"
                                                       <?php if (isset($_POST['m_poul']) && $m_poul == 'shahr') { ?>checked='checked' <?php } ?>
                                                       value="shahr"/>
                                            </p>
                                            <p style="text-align: right"> آبادی
                                                <input type="radio" class="green region" name="m_poul"
                                                       <?php if (isset($_POST['m_poul']) && $m_poul == 'abadi') { ?>checked='checked' <?php } ?>
                                                       value="abadi"/>
                                            </p></td>
                                        <td width="22%" class="normalTextSmall"> : انتخاب موقعیت </td>
                                    </tr>
                                </table>
                            <div align="right" dir="rtl" style="margin-right:30px" class="style8">
                              <p>نکته : </p>
                              <p>1- توجه کنید در صورتی که در سال مقصد برای بهره برداری قبلا اطلاعات ثبت شده باشد در این عملیات هیچ یک از قطعات آن بهره بردار انتقال داده نخواهد شد </p>
                              <p>2- در زمان انتقال اطلاعات در سال مقصد میزان پیش بینی تولید و تولید قطعی صفر درج میشود </p>
                              <p>3- صرف انتقال اطلاعات یک آبادی / شهر برای شما عملکرد محسوب نمیشود و باید ضمن بررسی و حذف قطعاتی که در سال مقصد نباید ثبت می شدند و همچنین تصحیح اطلاعات محصول ( سطح زیر کشت بارور ، غیر بارور ، تعداد درخت ، پیش بینی و تولید قطعی) اقدام کنید </p>
                              <p>4- شما مسئولیت کلیه اطلاعات انتقال داده شده را بر عهده گرفته و متعهد به تصحیح و تکمیل آنها هستید </p>
                            </div>                    
                                <div align="right" style=" margin-right:25px">موارد فوق را با دقت مطالعه کردم و با آن موافقم 
                                  <input type="checkbox"  name="checkbox" id="my_checkbox" />
                                  </div>
                                </p>
                                <p>
        <input type="submit" name="action" style=" height:45px ; alignment-adjust:middle" id="my_button" value="انتقال اطلاعات به سال 1398" />
                                </p>
                              <p>&nbsp;</p>
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
<script>
$('#my_checkbox').click(function() {
    if ($(this).is(':checked')) {
      $('#my_button').removeAttr('disabled');

    } else {
        $('#my_button').attr('disabled', 'disabled');
    }
});
//set it to disabled at load 
$('#my_button').attr('disabled', 'disabled');
</script>
</body>
</html>
