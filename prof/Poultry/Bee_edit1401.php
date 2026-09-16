<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php') ;
$id = $_POST['id'];
if($_POST['id_page'] > 1 ) $id_page = $_POST['id_page'] ; else $id_page = 1 ; 
$m_poul = $_POST['m_poul'];
$no_bee = $_POST['no_bee'];
$bah_cod_m = $_POST['bah_cod_m'];
$add_abadi = $_POST['add_abadi'];
$add_city  = $_POST['add_city'];
if (strlen($add_abadi) >5) $m_poul = 'abadi' ;
if (strlen($add_city) > 5) $m_poul = 'shahr' ;
$sh_gat = $_POST['sh_gat'];
    $query = "SELECT ok from bah where  bah_cod_m = :bah_cod_m ";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
    $found = $stmt -> rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ok = $row['ok'] ;
   if($ok=='2')
   {
      alert ('بهره بردار در قید حیات نمیباشد !! امکان ویرایش اطلاعات مقدور نیست  ') ;
    ?>
    <form  name="myform" class="myform" method="post" action="index.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
	
	}
   if($ok=='4')
   {
      alert ('اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ویرایش اطلاعات مقدور نمیباشد  ') ;
    ?>
    <form  name="myform" class="myform" method="post" action="index.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
	}
?>
<?php
// کیلک دکمه ادامه 
if (isset($_POST['action']))
{
    $m_poul = $_POST["m_poul"];
    $id = $_POST["id"];
    if ($m_poul=='') $mess='موقعیت بهره برداری را تعیین کنید '.'<p>' ;
    $add_city = $_POST["add_city"];
    if ($m_poul=='shahr' and $add_city=='') $mess.='نام شهر را انتخاب کنید'.'<p>' ;
    $add_abadi = $_POST["add_abadi"];
    if ($m_poul=='abadi' and $add_abadi=='') $mess.='نام آبادی را انتخاب کنید'.'<p>' ;

    $bah_cod_m = $_POST['bah_cod_m'];
    if ($bah_cod_m=='') $mess.='کد ملی را وارد کنید'.'<p>' ;
    $no_bee = $_POST['no_bee'];
    if ($no_bee=='') $mess.='نوع زنبورستان را انتخاب کنید'.'<p>' ;
    if ($bah_cod_m<>'' & check_code_melli($bah_cod_m)<>1)  $mess.='کد ملی بهره بردار صحیح نیست' ;
    if ((isset($_POST['action'])) and ($mess==''))
    {
        $query = "SELECT id from bah where bah_cod_m = $bah_cod_m";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $count_codm = $stmt -> rowCount();
        if ($count_codm==0) { $mess='اطلاعات بهره بردار یافت نشد <p> برای ثبت اطلاعات بهره برداری زراعی ، ابتدا اطلاعات بهره بردار را ثبت نمایید ' ;
            $not_found_bah= true ;
        }
        if ($count_codm>1) {
            ?>
            <form name="myform1" class="myform" method="post" id="myCoolForm" action="bahEdit_history.php">
                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
                <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                <input type="hidden" name="no_bee" value="<?php echo $no_kesh ;?>" />
                <input type="hidden" name="id" value="<?php echo $id ;?>" />
                <input type="hidden" name="id_page"  value="<?php echo $id_page ;?>" />
            </form>
            <script type="text/javascript">document.myform1.submit();</script>

            <?php
        }
        ?>
        <form name="myform1" class="myform" method="post" action="Bee_edit_data.php">
            <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
            <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
            <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
            <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
            <input type="hidden" name="id" value="<?php echo $id ;?>" />
            <input type="hidden" name="id_page"  value="<?php echo $id_page ;?>" />
            <input type="hidden" name="num_bah"  value="<?php echo $num_bah ;?>" />
            <input type="hidden" name="no_zan"  value="<?php echo $no_bee ;?>" />

        </form>
        <script type="text/javascript">document.myform1.submit();</script>
        <?php
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
    <!--style the error message-->
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
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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

                        <p class="style8">ویرایش اطلاعات زنبورستان</p><a name="1" id="1"></a>
                        <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
                        <div id="div">
                            <div id="mess"><?php if(isset($mess)) echo $mess ?>
                            </div>
                            <form id="form" name="form1" action="" method="post" >
                                <table width="100%" height="97" border="0">
                                    <tr>
                                        <td width="38%" height="93"><p style="text-align: right">
                                                <?php
//                                                echo $add_city . ' | ' . $add_abadi;
                                                ?>
                                                <select  name="add_city" class="input_text shahr_select"  style="<?=($add_city and strlen($add_abadi)<5)?'':'display:none;'?>width:170px ; height:40px" dir="rtl"    >
                                                    <option value="" >انتخاب نام شهر</option>
                                                    <?php
                                                    $query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = $login_session"  ;
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach($stmt as $row){
                                                        ?>
                                                        <option value="<?php echo $row['add_city'] ;?>"
                                                            <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                                                    <?php }?>
                                                </select>

                                                <select dir="rtl" name="add_abadi" class="input_text abadi_select" style="<?=($add_abadi and strlen($add_city) < 5)?'':'display:none;'?>width:170px ; height:40px" >
                                                    <option value="" >انتخاب نام آبادی</option>
                                                    <?php
                                                    $query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = $login_session"  ;
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
                                                <input type="radio"  class="green region" name="m_poul" <?php if ($m_poul == 'shahr') { ?>checked='checked' <?php } ?> value="shahr" />
                                            </p>
                                            <p style="text-align: right"> آبادی

                                                <input type="radio" class="green region" name="m_poul" <?php if ($m_poul == 'abadi') { ?>checked='checked' <?php } ?> value="abadi"  />
                                            </p></td>
                                        <td width="24%" class="normalTextSmall"> : موقعیت بهره برداری<span style="text-align: right">
                      </span></td>
                                    </tr>
                                </table>
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td height="68" align="right">   <div align="right">
                                                <input name="bah_cod_m" type="text"  class="required" value="<?php echo $bah_cod_m ;?>" maxlength="10" readonly/>
                                            </div> </td>
                                        <td width="31%"><div align="right"> : کد ملی بهره بردار / مدیرعامل </div></td>
                                    </tr>
                                    <tr>
                                      <td><p style="text-align: right"> غیرمهاجر
                                        <input type="radio" class="red" name="no_bee" <?php if ($no_bee == '1') { ?>checked='checked' <?php } ?> value="1"  />
                                        <br />
                                        <span class="style2">زنبورستان  های بومی منطقه </span></p>
                                        <p style="text-align: right"> مهاجر
                                          <input type="radio" class="red" name="no_bee" <?php if ($no_bee== '2') { ?>checked='checked' <?php } ?> value="2" />
                                          <br />
                                          <span class="style2">زنبورستان  های که از سایر شهرستان های  استان  یا استان های دیگر  به موقعیت فعلی کوچ کردند</span></p></td>
                                      <td><p>: نوع زنبور دار</p></td>
                                    </tr>
                                    <tr>
                                      <td height="37">&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="107"  colspan="2">
                                            <input name="action" type="submit" class="style8" value="ادامه"  />
                                            <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
                                            <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                                            <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                                            <input type="hidden" name="sh_gat" value="<?php echo $sh_gat ;?>" />
                                            <input type="hidden" name="id" value="<?php echo $id ;?>" />
                                            <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                                            <input type="hidden" name="id_page"  value="<?php echo $id_page ;?>" />
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <form action="liste_Agri.php?id=<?php echo $id_page.'#1' ?>" method="post" id="form1" name="form1">
                            <input type="hidden" name="action_lise" value="1" />
                            <input type="hidden" name="back_p" value="1" />
                            <input type="submit" name="action" value="انصراف" id="submit"  class="btn" style="width:150px ; height:45px ; border-radius:10px ; font-family:Tahoma"   tabindex="30" />
                        </form>
                        <p>&nbsp;</p></td>
                </tr>
                <tr>
                    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
                </tr>
            </table>
</table>
<script>
    $(document).ready(function() {

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
    });
</script>
</body>
</html>
