<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php') ;
if(isset($_POST['partIDCode'])) $partIDCode = $_POST['partIDCode'] ; else  $partIDCode = '' ;
if(isset($_POST['vaz_s']))  $vaz_s  = $_POST['vaz_s']  ; else  $vaz_s = '' ;
if(isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m']; else  $bah_cod_m = '' ;
if (isset($_POST['action1']))
{
    ?>
    <form name="myform" class="myform" method="post" action="../benef.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
}
if(isset($_POST["m_poul"]))  $m_poul = $_POST["m_poul"];  else  $m_poul = '' ;
if(isset($_POST["add_abadi"]))
{
    $add_abadi = $_POST["add_abadi"];
    $m_poul = $_POST["m_poul"];
}
if(isset($_POST["add_city"]))
{
    $add_city = $_POST["add_city"];
    $m_poul = $_POST["m_poul"];
}
if (isset($_POST['action']))
{
    $m_poul = $_POST["m_poul"];
    if ($m_poul=='') $mess='موقعیت بهره برداری را تعیین کنید '.'<p>' ;
    $add_city = $_POST["add_city"];
    if ($m_poul=='shahr' and $add_city=='') $mess.='نام شهر را انتخاب کنید'.'<p>' ; else $mess = '' ;
    $add_abadi = $_POST["add_abadi"];
    if ($m_poul=='abadi' and $add_abadi=='') $mess.='نام آبادی را انتخاب کنید'.'<p>' ;
    $bah_cod_m = $_POST['bah_cod_m'];
    if ($bah_cod_m=='') $mess.='کد ملی را وارد کنید'.'<p>' ;
    $partIDCode = $_POST['partIDCode'];
    if ($partIDCode=='') $mess.='شناسه یکتا را وارد کنید'.'<p>' ;
    $docNum = $_POST['docNum'];
    if ($docNum=='') $mess.='شماره مجوز را وارد کنید '.'<p>' ;

    $vaz_s = $_POST['vaz_s'];
    if ($vaz_s=='') $mess.='وضعیت سکونت بهره بردار را انتخاب کنید'.'<p>' ;
    if ($bah_cod_m<>'' & check_code_melli($bah_cod_m)<>1)  $mess.='کد ملی بهره بردار صحیح نیست' ;
    if ((isset($_POST['action'])) and ($mess == '')) {
        $query = "SELECT num_bah from bah where bah_cod_m = '$bah_cod_m'";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $count_codm = $stmt -> rowCount();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if ($count_codm == 1) {
         $num_bah = $row['num_bah'] ; 	
		   }
        if ($count_codm > 1) {
            ?>
            <form  name="myform1" class="myform" method="post" action="bah_history.php">
                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                <input type="hidden" name="partIDCode" value="<?php echo $partIDCode ;?>" />
               <input  type="hidden"  name="docNum"     value="<?php echo $docNum ;?>" />
                <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
                <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                <input type="hidden" name="vaz_s" value="<?php echo $vaz_s ;?>" />
            </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
        }
        if ($count_codm==0)
        {
            $mess='اطلاعات بهره بردار یافت نشد <p> برای ثبت اطلاعات بهره برداری دامی ، ابتدا اطلاعات بهره بردار را ثبت نمایید ' ;
            $not_found_bah= true ;
        }
        else
        {
            $query = "SELECT id from Animal where bah_cod_m = '$bah_cod_m'";
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $count_codm = $stmt -> rowCount();
            if ($count_codm>0) {
                ?>
                <form name="myform1" class="myform" method="post" action="Animal_history.php">
                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                    <input type="hidden" name="partIDCode" value="<?php echo $partIDCode ;?>" />
                    <input  type="hidden"  name="docNum"     value="<?php echo $docNum ;?>" />
                    <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                    <input type="hidden" name="vaz_s" value="<?php echo $vaz_s ;?>" />
                 </form>
                <script type="text/javascript">document.myform1.submit();</script>
                <?php
            }
            ?>
            <form name="myform1" class="myform" method="post" action="Animal_data.php">
               <input  type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
               <input  type="hidden" name="partIDCode" value="<?php echo $partIDCode ;?>" />
               <input  type="hidden"  name="docNum"     value="<?php echo $docNum ;?>" />
                <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
                <input type="hidden" name="page" value="<?php echo 'Animal.php' ;?>" />
                <input type="hidden" name="vaz_s" value="<?php echo $vaz_s ;?>" />
           </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <link rel="stylesheet" href="../reza_1.css">
    <link href="../radio.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
    <script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script>
        function autoSubmit()
        {
            var formObject = document.forms['reg-form'];
            formObject.submit();
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
		select
		{
			font-family:myfount ;
			font-size:14;
			color:#C03;
			}
    </style>
</head>
<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
    </tr>
    <tr>
        <td><?php include('menu.php'); ?>
        </td>
    </tr>
    <tr>
        <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
                <tr>
                    <td width="4"><p>&nbsp;</p>
                        <p>&nbsp;</p></td>
                    <?php include('top.php'); ?>
                    <td width="840" >

                        <p class="style8">ثبت اطلاعات بهره برداری دامی جدید</p><a name="1" id="1"></a>
                        <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
                        <div id="div">
                            <div id="mess"><?php if(isset($mess)) echo $mess ; ?>
                            </div>
                            <form  id="reg-form" method="post" action="#1">
                                <table width="100%" height="97" border="0">
                                    <tr>
                                        <td width="38%" height="93"><p style="text-align: right">

                                                <select  name="add_city" class="shahr_select"  style="<?=$add_city?'':'display:none;'?>width:170px ; height:40px" dir="rtl">
                                                    <option value="" >انتخاب نام شهر</option>
                                                    <?php
                                                    $query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = '$login_session'"  ;
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach($stmt as $row){
                                                        ?>
                                                        <option value="<?php echo $row['add_city'] ;?>"
                                                            <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                                                    <?php }?>
                                                </select>

                                                <select dir="rtl"  name="add_abadi"  class="abadi_select" style="<?=$add_abadi?'':'display:none;'?>width:170px ; height:40px ;">
                                                    <option value="" >انتخاب نام آبادی</option>
                                                    <?php
                                                    $query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session'"  ;
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach($stmt as $row){
                                                        ?>
                                                        <option value="<?php echo $row['add_abadi'] ;?>"
                                                            <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                                                    <?php }?>
                                                </select>

                                            </p></td>
                                        <td width="20%"><?php if ($m_poul == 'shahr') { ?>
                                                : نام شهر
                                            <?php }
                                            if ($m_poul == 'abadi') { ?>
                                                : نام آبادی
                                            <?php }
                                            ?></td>
                                        <td width="18%"><p style="text-align: right">شهر
                                                <input type="radio"  class="green region" name="m_poul" <?php if ($m_poul == 'shahr') { ?>checked='checked' <?php } ?> value="shahr"/>
                                            </p>
                                            <p style="text-align: right"> آبادی
                                                <input type="radio" class="green region" name="m_poul" <?php if ($m_poul == 'abadi') { ?>checked='checked' <?php } ?> value="abadi"/>
                                            </p></td>
                                        <td width="24%" class="normalTextSmall"> : موقعیت بهره برداری</td>
                                    </tr>
                                </table>
                                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                                <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
                               <input type="hidden" name="vaz_s" value="<?php echo $vaz_s ;?>" />
                            </form>
                            <form id="form" name="form1" action="" method="post" >
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td height="68" colspan="2" align="right">   <div align="right">
                                                <input name="bah_cod_m"  class="required" type="text" maxlength="12" value="<?php echo $bah_cod_m ;?>"/>
                                            </div> </td>
                                        <td width="36%"><div align="right"> : کد ملی بهره بردار / مدیرعامل </div></td>
                                    </tr>
                                    <tr>
                                      <td height="62" colspan="2"><div align="right">
                                        <input name="partIDCode" type="text"  class="required" id="partIDCode" value="<?php echo $partIDCode ;?>" maxlength="15"/>
                                      </div></td>
                                      <td><div align="right"> : شناسه یکتای واحد </div></td>
                                    </tr>
                                    <tr>
                                      <td height="57" colspan="2"><div align="right">
                                        <input name="docNum" type="text"  class="required" id="docNum" value="<?php echo $docNum ;?>" maxlength="15"/>
                                      </div></td>
                                      <td><div align="right"> : شماره مجوز</div></td>
                                    </tr>
                                    <tr>
                                      <td height="27" colspan="3" bgcolor="#FFFF99" class="style8">در صورتیکه واحد دارای مجوز از سامانه سماک  هست ، شماره مجوز و در غیر اینصورت 0 وارد شود </td>
                                    </tr>
                                    <tr>
                                      <td width="27%" height="44">&nbsp;</td>
                                      <td width="37%"><div align="right">
                                        <select name="vaz_s" class="required" id="vaz_s" style="height:40px ; width:200px ; direction:rtl" tabindex="4">
                                          <option value="">انتخاب کنید</option>
                                          <option value="1" <?php if ($vaz_s=='1') { echo 'selected="selected"' ; } ?>>ساکن</option>
                                          <option value="2" <?php if ($vaz_s=='2') { echo 'selected="selected"' ; } ?>>غیرساکن</option>
                                          <option value="3" <?php if ($vaz_s=='3') { echo 'selected="selected"' ; } ?>>عشایر</option>
                                        </select>
                                      </div></td>
                                      <td><div align="right"> :وضعیت سکونت</div></td>
                                    </tr>
                                    <tr>
                                        <td height="107"  colspan="3">
                                            <input name="action" type="submit" class="style8" value="ادامه"  />
                                            <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
                                            <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                                            <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                                            <?php if(isset($not_found_bah))  { ?>
                                            <input name="action1" type="submit" class="style8" value="ثبت اطلاعات بهره بردار"  />
                                        </td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <p><a href="../Animal" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
                        <p>&nbsp;</p></td>
                </tr>
                <tr>
                    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
                </tr>
            </table>
</table>
<script>

        $('.shahr_select').change(function() {
             $('[name=add_city]').val(this.value)
        });

        $('.abadi_select').change(function() {
            $('[name=add_abadi]').val(this.value)
        });

        $('input.region').change(function() {
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
</script>
</body>
</html>
<?php
include('../../login/config.php');
$query = "SELECT end_dam,date_end_dam from users where username = '$login_session' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_dam =  $row['end_dam'] ; 
$date_end_dam =  $row['date_end_dam'] ; 
if ($end_dam=='1')
{
alert (' خطا !! \n  خاتمه عملیات در تاریخ : '.$date_end_dam.' گزارش شده است  ') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
} 
 if(isset($_POST['com_alert'])) alert($_POST['com_alert']) ;
?>
