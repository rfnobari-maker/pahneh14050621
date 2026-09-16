<?php 
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city   = isset($_POST['id_city5']) ? $_POST['id_city5'] : '';
$id_mar    = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city  = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh   = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$dis       = isset($_POST['dis']) ? $_POST['dis'] : '';

if (isset($_POST['z_sal'])) {
    $z_sal = $_POST['z_sal'];
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
} else {
    $z_sal = '';
    $Agri_prod_table = '';
}

$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name  = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <style type="text/css">
        <!--
        .tabel { margin-right:45px }
        .text_r { margin-right:0px }
        .style1 {
            color: #003366;
            font-family: Tahoma;
            font-size: 18px;
        }
        -->
    </style>
    <style type="text/css">
        #content {
            width: 900px;
            margin: 0 auto;
            font-family: Arial, Helvetica, sans-serif;
        }
        .page {
            float: right;
            margin: 0;
            padding: 0;
        }
        .page li {
            list-style: none;
            display: inline-block;
        }
        .page li a, .current {
            display: block;
            padding: 5px;
            text-decoration: none;
            color: #8A8A8A;
        }
        .current {
            font-weight: bold;
            color: #000;
        }
        .button {
            padding: 5px 15px;
            text-decoration: none;
            background: #333;
            color: #F3F3F3;
            font-size: 13PX;
            border-radius: 2PX;
            margin: 0 4PX;
            display: block;
            float: left;
        }
        .column {
            float: left;
            padding: 5px;
            box-sizing: border-box;
            /* width will be set inline */
        }
        .row {
            width: 100%;
        }
        .row::after {
            content: "";
            clear: both;
            display: table;
        }
        .delivery-col {
            width: 80px;
        }
        .delivery-input {
            width: 70px !important;
            height: 30px !important;
            text-align: center;
            font-size: 13px;
            font-family: Tahoma;
            border: 2px solid #006699;
            border-radius: 5px;
            background-color: #FFFFCC;
        }
        .delivery-input-readonly {
            background-color: #E8E8E8;
            border: 1px solid #CCC;
        }
        .btn-edit-delivery {
            background-color: #FF9900;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 3px 8px;
            font-size: 11px;
            cursor: pointer;
            font-family: Tahoma;
            margin-top: 3px;
        }
        .btn-edit-delivery:hover {
            background-color: #E68A00;
        }
        .btn-update-delivery {
            background-color: #009900;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 3px 8px;
            font-size: 11px;
            cursor: pointer;
            font-family: Tahoma;
            margin-top: 3px;
        }
        .btn-update-delivery:hover {
            background-color: #007700;
        }
        .delivery-saved {
            color: #090;
            font-size: 10px;
        }
        .delivery-editing {
            color: #FF6600;
            font-size: 10px;
        }

        /* تنظیمات جدول برای هماهنگی ستون‌ها */
        #test {
            table-layout: fixed;
            width: 100%;
        }
        #test .column input,
        #test .column select {
            width: 80% !important;    /* کاهش عرض ورودی‌ها */
            box-sizing: border-box;
            margin: 0 auto;
            display: block;
            text-align: center;
        }
        #test .column {
            box-sizing: border-box;
            padding: 5px;
        }
        /* تنظیم برای دکمه‌ها و پیام‌ها در ستون تحویلی */
        #test .column .btn-edit-delivery,
        #test .column .btn-update-delivery {
            width: auto !important;
            display: inline-block;
        }
        #test .column .delivery-saved,
        #test .column .delivery-editing {
            display: inline-block;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".country<?php if(isset($num_t_mah)) echo $num_t_mah ;?>").change(function() {
                var id=$(this).val();
                var dataString = 'group_cod='+ id;
                $.ajax({
                    type: "POST",
                    url: "ajax_city.php",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $(".mar").html(html);
                    }
                });
            });
        });
    </script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
    </tr>
    <tr>
        <td><?php include('menu.php'); ?></td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                    <td width="840">
                        <?php include('top.php');?>
                        <span class="style8">تکمیل اطلاعات سطح برداشت و تولید قطعی </span><br />
                        <form id="reg-form" method="post" action="#1">
                            <div style="width: 700px; padding: 5px; border: 2px solid #09C; margin: auto; text-align: left; border-radius: 15px">
                                <table width="100%" height="437" border='0' align="center" cellpadding='0' cellspacing='0'>
                                    <!-- فرم جستجو (بدون تغییر) -->
                                    <tr bgcolor='#f1f1f1'>
                                        <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
                                    </tr>
                                    <tr bgcolor='#f1f1f1'>
                                        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text"><div align="right">
                                            <select name="z_sal" class="input_text required" id="z_sal" style="height:40px; width:170px; direction:rtl" tabindex="1">
                                                <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                                                <option value="1403-1404" <?php if (isset($z_sal) && $z_sal=='1403-1404') echo 'selected=selected'?>>1403-1404</option>
                                            </select>
                                        </div></td>
                                        <td align='center' bgcolor="#FFFFFF" class="style8">: سال زراعی</td>
                                        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text">
                                            <select name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px; height:40px" dir="rtl" onchange="this.form.submit()">
                                                <?php $id_ostan1 = $id_ostan ?>
                                                <option value="-1">انتخاب استان</option>
                                                <?php
                                                $query = "SELECT id_ostan,ostan FROM `ostanname` ORDER BY BINARY ostan ASC";
                                                $stmt = $dbh->prepare($query);
                                                $stmt->execute();
                                                foreach($stmt as $row){
                                                ?>
                                                <option value="<?php echo $row['id_ostan']; ?>" <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>><?php echo $row['ostan']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($_POST['id_ostan'])) $id_ostan1= $_POST['id_ostan']; ?>
                                        </td>
                                        <td align='center' bgcolor="#FFFFFF" class="style8">: استان</td>
                                    </tr>
                                    <tr bgcolor='#f1f1f1'>
                                        <td height="47" align="right" bgcolor="#DDDDDD" class="input_text"><div align="right">
                                            <select name="no_kesh" class="input_text required" id="no_bah2" style="height:40px; width:170px; direction:rtl" tabindex="2">
                                                <option value="0">انتخاب کنید</option>
                                                <option value="1" <?php if(isset($no_kesh) and $no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                                                <option value="2" <?php if(isset($no_kesh) and $no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                                            </select>
                                        </div></td>
                                        <td height="47" align="right" bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">: نوع کشت</font></td>
                                        <td width="214" align="right" bgcolor="#DDDDDD" class="input_text">
                                            <select name="id_city5" disabled="disabled" class="style8" id="id_city" style="width:170px; height:40px" dir="rtl" onchange="this.form.submit()">
                                                <option value="0"> کل استان</option>
                                                <?php
                                                $query = "SELECT id_city,city FROM `cityname` WHERE `id_ostan` = '$id_ostan1' ORDER BY BINARY city ASC";
                                                $stmt = $dbh->prepare($query);
                                                $stmt->execute();
                                                foreach($stmt as $row){
                                                ?>
                                                <option value="<?php echo $row['id_city']; ?>" <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>><?php echo $row['city']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($_POST['id_city5'])) $id_city = $_POST['id_city5']; ?>
                                        </td>
                                        <td width="146" align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
                                    </tr>
                                    <tr>
                                        <td height="54" align="right" class="input_text"><div align="right">
                                            <select name="mah_name" class="required input_text mar" style="width:170px; height:40px" tabindex="4" dir="rtl">
                                                <?php
                                                if(isset($mah_qroup)) {
                                                    $query = "SELECT DISTINCT product_cod,product_name FROM `product_z` WHERE `group_cod` = $mah_qroup";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach($stmt as $row){
                                                ?>
                                                <option value="<?php echo $row['product_cod']; ?>" <?php if ($row['product_cod']==$mah_name) echo 'selected=selected'?>><?php echo $row['product_name']; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </div></td>
                                        <td height="54" align='center' class="style8">نام محصول</td>
                                        <td height="54" align="right" class="input_text"><div align="right">
                                            <select name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px; height:40px" tabindex="3" dir="rtl">
                                                <option value=""> انتخاب گروه</option>
                                                <?php
                                                $query = "SELECT DISTINCT group_cod,group_name FROM `product_z`";
                                                $stmt = $dbh->prepare($query);
                                                $stmt->execute();
                                                foreach($stmt as $row){
                                                ?>
                                                <option value="<?php echo $row['group_cod']; ?>" <?php if (isset($mah_qroup) and $row['group_cod']==$mah_qroup) echo 'selected=selected'?>><?php echo $row['group_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div></td>
                                        <td align='center' class="style1"><font size="2" class="style8">:گروه محصولات</font></td>
                                    </tr>
                                    <tr>
                                        <td height="54" align="right" bgcolor="#DDDDDD" class="input_text">
                                            <select name="add_abadi" class="input_text" id="add_abadi" style="width:170px; height:40px" tabindex="6" dir="rtl">
                                                <option value="0">انتخاب نام آبادی</option>
                                                <?php
                                                $query = "SELECT add_abadi,abadi FROM `list_abadi` WHERE `mor_cod_m` = '$login_session' ORDER BY BINARY abadi";
                                                $stmt = $dbh->prepare($query);
                                                $stmt->execute();
                                                foreach($stmt as $row){
                                                ?>
                                                <option value="<?php echo $row['add_abadi']; ?>" <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>><?php echo $row['abadi']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td height="54" align='center' bgcolor="#DDDDDD" class="style8">نام آبادی</td>
                                        <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text">
                                            <select name="id_mar" disabled="disabled" class="style8" id="bakh" style="width:170px; height:40px" dir="rtl" onchange="this.form.submit()">
                                                <option value="0"> نام مرکز</option>
                                                <?php
                                                $query = "SELECT id_mar,mar FROM `mar` WHERE `id_ostan` = $id_ostan1 and `id_city` = $id_city";
                                                $stmt = $dbh->prepare($query);
                                                $stmt->execute();
                                                foreach($stmt as $row){
                                                ?>
                                                <option value="<?php echo $row['id_mar']; ?>" <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>><?php echo $row['mar']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($_POST['id_mar'])) $id_mar = $_POST['id_mar']; ?>
                                            <input name="id_city" type="hidden" value="<?php echo $id_city; ?>" />
                                        </td>
                                        <td width="146" rowspan="2" align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
                                    </tr>
                                    <tr>
                                        <td height="40" align="right" bgcolor="#DDDDDD" class="input_text">
                                            <select name="add_city" class="input_text" id="add_city" style="width:170px; height:40px" tabindex="7" dir="rtl">
                                                <option value="0">انتخاب نام شهر</option>
                                                <?php
                                                $query = "SELECT add_city,shahr FROM `list_city` WHERE `id_mar` = '$id_mar' and `mor_cod_m`= '$login_session' ORDER BY BINARY shahr";
                                                $stmt = $dbh->prepare($query);
                                                $stmt->execute();
                                                foreach($stmt as $row){
                                                ?>
                                                <option value="<?php echo $row['add_city']; ?>" <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>><?php echo $row['shahr']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td height="40" align='center' bgcolor="#DDDDDD" class="style8">نام شهر</td>
                                    </tr>
                                    <tr>
                                        <td height="54" align="right" class="input_text"><div align="right">
                                            <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m" style="height:35px; width:170px" tabindex="8" value="<?php echo $bah_cod_m?>" />
                                        </div></td>
                                        <td height="54" align="right" class="style1"><font size="2" class="style8">: کد ملی بهره بردار</font></td>
                                        <td height="54" align="right" class="input_text"><div align="right">
                                            <input name="mor_cod_m" type="text" class="style8" style="height:35px; width:170px" value=" <?php echo $login_session ?>" readonly="readonly" />
                                        </div></td>
                                        <td height="54" align='center' class="style1"><font size="2" class="style8">: کد ملی مروج</font></td>
                                    </tr>
                                    <tr>
                                        <td height="60" align="left" bgcolor="#DDDDDD">&nbsp;</td>
                                        <td height="60" align="left" bgcolor="#DDDDDD">&nbsp;</td>
                                        <td height="60" align="left" bgcolor="#DDDDDD"><div align="right">
                                            <select name="dis" class="input_text required" id="no_kesh" style="height:40px; width:170px; direction:rtl" tabindex="9">
                                                <option value="1" selected="selected" <?php if($dis=="1") echo "selected='selected'"?>>همه رکوردها</option>
                                                <option value="2" <?php if($dis=="2") echo "selected='selected'"?>>رکوردهای فاقد تولید قطعی</option>
                                            </select>
                                        </div></td>
                                        <td height="60" align="left" bgcolor="#DDDDDD"><font size="2" class="style8">:   نمایش رکوردها</font></td>
                                    </tr>
                                    <tr>
                                        <td height="60" colspan="4" align="left">
                                            <input name="action" type="submit" id="action" style="width:150px; height:45px" tabindex="10" value='جستجو' />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>

                        <p><span class="style1"><a name="1" id="1"></a></span>
                        <?php
                        if (isset($_POST['action'])) {
                            if ($id_ostan1 == '-1')    { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
                            if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
                            if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
                            if ($add_abadi  == '0')  { $f_add_abadi  = 1 ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
                            if ($add_city  == '0')  { $f_add_city  = 1 ; }else{ $f_add_city = "add_city = '$add_city'" ;}
                            if ($no_kesh == '0')  { $f_no_kesh  = 1 ; }else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
                            if ($mor_cod_m == '')  { $v_mor_cod_m  = 1 ; }else{ $v_mor_cod_m = "mor_cod_m ='$login_session' " ;}
                            if ($bah_cod_m == '')  { $v_bah_cod_m  = 1 ; }else{ $v_bah_cod_m = "bah_cod_m ='$bah_cod_m' " ;}
                            if ($z_sal == '')  { $v_z_sal  = 1 ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
                            if ($mah_name == '')  { $v_cod_mah  = 1 ; }else{ $v_cod_mah = "cod_mah = '$mah_name'" ;}
                            if ($dis == '1')      { $v_dis  = 1 ; }else{ $v_dis = "mah_tol = 0 and mah_kh !='1'  " ;}

                            $start=0;
                            $limit=25;
                            $id = isset($_GET['id']) ? $_GET['id'] : 1;
                            $start=($id-1)*$limit;
                            $query = "SELECT id,bah_cod_m,sh_gat,no_kesh,cod_mah,zer_kesht_a,zer_kesht_b,mah_tolp,s_bar_a,s_bar_b,mah_tol,add_abadi,mah_kh from $Agri_prod_table where $v_id_ostan and $v_id_city and $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh and $v_mor_cod_m and $v_bah_cod_m and $v_z_sal and $v_cod_mah and $v_dis ORDER BY bah_cod_m,sh_gat ASC LIMIT $start, $limit";
                            $query1 = "SELECT count(*) from $Agri_prod_table where $v_id_ostan and $v_id_city and $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh and $v_mor_cod_m and $v_bah_cod_m and $v_z_sal and $v_cod_mah and $v_dis";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute();
                            $t_row = $stmt -> rowCount();
                            if ($t_row>0) {
                        ?>
                        <br />
                        <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt="" />
                        <br />
                        <table align="center" class="my-table" id="test">
                            <!-- هدر جدول با عرض‌های جدید (مجموع ۱۰۰%) -->
                            <tr class="text1">
                                <td width="6%" rowspan="2" bgcolor="#006699">عملیات</td>
                                <td width="5%" rowspan="2" bgcolor="#006699">خسارت دیده ؟</td>
                                <td width="6%" rowspan="2" bgcolor="#006699">میزان تحویلی به دولت<br><span class="style2">تن</span></td>
                                <td width="6%" rowspan="2" bgcolor="#006699">میزان تولید قطعی<br /><span class="style2">تن</span></td>
                                <td colspan="2" bgcolor="#006699"><p>سطح برداشت <br /><span class="style2">هکتار</span></p></td>
                                <td width="4%" rowspan="2" bgcolor="#006699"><p>پیش بینی<br />تولید<br /><span class="style2">تن </span></p></td>
                                <td colspan="2" bgcolor="#006699">سطح زیر کشت<br /><span class="style2">هکتار</span></td>
                                <td width="7%" rowspan="2" bgcolor="#006699">نام محصول</td>
                                <td width="4%" rowspan="2" bgcolor="#006699">نوع کشت</td>
                                <td width="4%" rowspan="2" bgcolor="#006699">شماره قطعه<br /></td>
                                <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
                                <td width="3%" rowspan="2" bgcolor="#006699">ردیف</td>
                            </tr>
                            <tr class="text1">
                                <td width="6%" bgcolor="#006699">دوم</td>
                                <td width="7%" bgcolor="#006699">اول</td>
                                <td width="5%" bgcolor="#006699">دوم</td>
                                <td width="5%" bgcolor="#006699">اول</td>
                                <td width="12%" height="36" bgcolor="#006699" class="text1">کد ملی</td>
                                <td width="20%" bgcolor="#006699">نام و نام خانوادگی</td>
                            </tr>
                            <!-- بدنه جدول -->
                            <?php
                            $r = 1;
                            foreach($stmt as $row){
                                if ($row['no_kesh']=='1') $v_no_kesh='آبی';
                                if ($row['no_kesh']=='2') $v_no_kesh='دیم';
                                $t_r = $r;
                                // بررسی وجود تحویلی
                                $check_delivery = "SELECT delivery_amount FROM delivery WHERE Agri_id = '".$row['id']."'";
                                $stmt_del = $dbh->prepare($check_delivery);
                                $stmt_del->execute();
                                $delivery_row = $stmt_del->fetch(PDO::FETCH_ASSOC);
                                $delivery_amount = ($delivery_row) ? $delivery_row['delivery_amount'] : '';
                                $has_delivery = ($delivery_row) ? true : false;
                            ?>
                            <tr>
                                <td colspan="6" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                                    <form name="form<?php echo $t_r ?>">
                                        <input type="hidden" id="id<?php echo $t_r ?>" name="id" value="<?php echo $row['id']; ?>" />
                                        <input type="hidden" id="add_city<?php echo $t_r ?>" name="add_city" value="<?php echo $add_city; ?>" />
                                        <input type="hidden" id="z_sal" name="z_sal" value="<?php echo $z_sal; ?>" />
                                        <input type="hidden" id="bah_cod_m<?php echo $t_r ?>" name="bah_cod_m" value="<?php echo $row['bah_cod_m']; ?>" />
                                        <input type="hidden" id="add_abadi<?php echo $t_r ?>" name="add_abadi" value="<?php echo $row['add_abadi']; ?>" />
                                        <input type="hidden" id="sh_gat<?php echo $t_r ?>" name="sh_gat" value="<?php echo $row['sh_gat']; ?>" />
                                        <input type="hidden" id="id_ostan_h<?php echo $t_r ?>" name="id_ostan_h" value="<?php echo $id_ostan1; ?>" />
                                        <input type="hidden" id="id_city_h<?php echo $t_r ?>" name="id_city_h" value="<?php echo $id_city; ?>" />
                                        <input type="hidden" id="id_mar_h<?php echo $t_r ?>" name="id_mar_h" value="<?php echo $id_mar; ?>" />
                                        <input type="hidden" id="mor_cod_m_h<?php echo $t_r ?>" name="mor_cod_m_h" value="<?php echo $login_session; ?>" />
                                        <input type="hidden" id="s_bar_a_h<?php echo $t_r ?>" value="<?php echo $row['s_bar_a']; ?>" />
                                        <input type="hidden" id="s_bar_b_h<?php echo $t_r ?>" value="<?php echo $row['s_bar_b']; ?>" />
                                        <input type="hidden" id="mah_tol_h<?php echo $t_r ?>" value="<?php echo $row['mah_tol']; ?>" />

                                        <div class="row">
                                            <!-- ستون ۱: عملیات (عرض 6% از کل جدول → 16.6667% از td) -->
                                            <div class="column" style="width:16.6667%;">
                                                <input name="submit" type="submit" class="submit<?php echo $t_r ?>" id="submit<?php echo $t_r ?>" style="width:80%; height:35px; font-size:14px; color:#900; font-family:tahoma; text-align:center; margin:0 auto; display:block;" tabindex="<?php echo $r.'6'?>" value="ثبت" />
                                                <span class="error<?php echo $t_r ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15" alt=""/></span>
                                                <span class="success<?php echo $t_r ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15" alt=""/></span>
                                            </div>
                                            <!-- ستون ۲: خسارت (عرض 5% → 13.8889% از td) -->
                                            <div class="column" style="width:13.8889%;">
                                                <select name="mah_kh" class="required input_text required" id="mah_kh<?php echo $t_r ;?>" style="width:80%; height:40px; direction:rtl; margin:0 auto; display:block;" tabindex="<?php echo $r.'5'?>">
                                                    <option value="">انتخاب</option>
                                                    <option value="1" <?php if ($row['mah_kh']=='1') echo 'selected="selected"' ; ?>>بلی</option>
                                                    <option value="2" <?php if ($row['mah_kh']=='2') echo 'selected="selected"' ; ?>>خیر</option>
                                                </select>
                                            </div>
                                            <!-- ستون ۳: تحویلی (عرض 6% → 16.6667% از td) -->
                                            <div class="column" style="width:16.6667%;">
                                                <input name="delivery_amount" type="number" step="any" min="0" tabindex="<?php echo $r.'4'?>"
                                                       class="input_text<?php echo $t_r ?>" id="delivery<?php echo $t_r ?>"
                                                       style="width:80%; height:30px; text-align:center; font-size:13px; font-family:Tahoma; margin:0 auto; display:block; <?php if($has_delivery) echo 'background-color:#E8E8E8;border:1px solid #CCC;'; else echo 'border:2px solid #006699;background-color:#FFFFCC;'; ?>"
                                                       value="<?php echo $delivery_amount; ?>" maxlength="12" step="any"
                                                       <?php if($has_delivery) echo 'readonly="readonly"'; ?> placeholder="میزان تحویل" />
                                                <?php if($has_delivery): ?>
                                                    <br>
                                                    <button type="button" class="btn-edit-delivery" id="editBtn<?php echo $t_r ?>" onclick="enableEdit(<?php echo $t_r ?>)">ویرایش</button>
                                                    <button type="button" class="btn-update-delivery" id="updateBtn<?php echo $t_r ?>" style="display:none;" onclick="updateDelivery(<?php echo $t_r ?>)">بروزرسانی</button>
                                                    <br>
                                                    <span class="delivery-saved" id="statusMsg<?php echo $t_r ?>">✓ ثبت شده</span>
                                                    <span class="delivery-editing" id="editMsg<?php echo $t_r ?>" style="display:none;">✎ در حال ویرایش</span>
                                                <?php else: ?>
                                                    <span class="error<?php echo $t_r ?>" style="display:none;font-size:10px;color:red;">خطا</span>
                                                    <span class="success<?php echo $t_r ?>" style="display:none;font-size:10px;color:green;">✓</span>
                                                <?php endif; ?>
                                            </div>
                                            <!-- ستون ۴: تولید (عرض 6% → 16.6667% از td) -->
                                            <div class="column" style="width:16.6667%;">
                                                <input name="mah_tol" type="text" class="mah_tol<?php echo $t_r ?> required number input_text" id="mah_tol<?php echo $t_r ?>" style="width:80%; height:30px; margin:0 auto; display:block; text-align:center;" tabindex="<?php echo $r.'3'?>" dir="rtl" lang="fa" value="<?php echo $row['mah_tol']*1 ; ?>" maxlength="10" align="baseline" xml:lang="fa" />
                                            </div>
                                            <!-- ستون ۵: سطح برداشت دوم (عرض 6% → 16.6667% از td) -->
                                            <div class="column" style="width:16.6667%;">
                                                <input name="s_bar_b" type="text" class="s_bar_b<?php echo $t_r ?> required digits input_text" id="s_bar_b<?php echo $t_r ?>" style="width:80%; height:30px; margin:0 auto; display:block; text-align:center;" tabindex="<?php echo $r.'2'?>" dir="rtl" lang="fa" value="<?php echo $row['s_bar_b']*1 ; ?>" maxlength="6" align="baseline" xml:lang="fa" />
                                            </div>
                                            <!-- ستون ۶: سطح برداشت اول (عرض 7% → 19.4444% از td) -->
                                            <div class="column" style="width:19.4444%;">
                                                <input name="s_bar_a" type="text" class="s_bar_a<?php echo $t_r ?> required digits input_text" id="s_bar_a<?php echo $t_r ?>" style="width:80%; height:30px; margin:0 auto; display:block; text-align:center;" tabindex="<?php echo $r.'1'?>" dir="rtl" lang="fa" value="<?php echo $row['s_bar_a']*1 ; ?>" maxlength="6" align="baseline" xml:lang="fa" />
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tolp']*1; ?></td>
                                <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']; ?>
                                    <input name="zer_kesht_b<?php echo $t_r ?>" type="hidden" class="zer_kesht_b<?php echo $t_r ?> required digits style8" id="zer_kesht_b<?php echo $t_r ?>" style="width:40px; height:30px;" tabindex="<?php echo $r.'1'?>" dir="rtl" lang="fa" value="<?php echo $row['zer_kesht_b']*1 ; ?>" maxlength="6" readonly="readonly" align="baseline" xml:lang="fa" />
                                </td>
                                <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $row['zer_kesht_a']; ?>
                                    <input name="zer_kesht_a<?php echo $t_r ?>" type="hidden" class="zer_kesht_a<?php echo $t_r ?> required digits style8" id="zer_kesht_a<?php echo $t_r ?>" style="width:40px; height:30px;" tabindex="<?php echo $r.'1'?>" dir="rtl" lang="fa" value="<?php echo $row['zer_kesht_a']*1 ; ?>" maxlength="6" readonly="readonly" align="baseline" xml:lang="fa" />
                                </td>
                                <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']); ?>
                                    <input name="cod_mah<?php echo $t_r ?>" type="hidden" class="cod_mah<?php echo $t_r ?> required digits style2" id="cod_mah<?php echo $t_r ?>" style="width:30px; height:30px;" tabindex="<?php echo $r.'1'?>" dir="rtl" lang="fa" value="<?php echo $row['cod_mah'] ; ?>" maxlength="6" readonly="readonly" align="baseline" xml:lang="fa" />
                                </td>
                                <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh; ?>
                                    <input name="no_kesh<?php echo $t_r ?>" type="hidden" class="no_kesh<?php echo $t_r ?> required digits style2" id="no_kesh<?php echo $t_r ?>" style="width:30px; height:30px;" tabindex="<?php echo $r.'1'?>" dir="rtl" lang="fa" value="<?php echo $row['no_kesh'] ; ?>" maxlength="6" readonly="readonly" align="baseline" xml:lang="fa" />
                                </td>
                                <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
                                <td height="43" class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
                                <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
                                <td class="normalTextSmall" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
                            </tr>
                            <?php
                                $r++;
                            }
                            ?>
                        </table>
                        <p class="style2" align="center">
                        <?php } else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }} ?>
                        </p>
                        <div style="text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px; border-radius: 15px">
                        <?php
                        if(isset($query1)) {
                            $stmt1 = $dbh->prepare($query1);
                            $stmt1->execute();
                            $rows = $stmt1 -> fetchColumn();
                            $total=ceil($rows/$limit);
                            if ($rows > 25) $t_row = 25 ; else $t_row = $rows ;
                            if($id>1) {
                        ?>
                            <form action="AgriP_edit_T_98.php?id=<?php echo $id-1 ?>#1" method="post">
                                <input type="hidden" name="action" value="1" />
                                <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                                <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                                <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                                <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                                <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                                <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                                <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                                <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                                <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                                <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                                <input type="hidden" name="dis" value="<?php echo $dis ;?>" />
                                <button class='button'>قبلی</button>
                            </form>
                        <?php } if($id!=$total) { ?>
                            <form action="AgriP_edit_T_98.php?id=<?php echo $id+1 ?>#1" method="post">
                                <input type="hidden" name="action" value="1" />
                                <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                                <input type="hidden" name="id_city5" value="<?php echo $id_city?>" />
                                <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                                <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                                <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                                <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                                <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                                <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                                <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                                <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                                <input type="hidden" name="dis" value="<?php echo $dis ;?>" />
                                <button class='button'>بعدی</button>
                            </form>
                        <?php }
                            echo "<ul class='page'>";
                            for($i=1;$i<=$total;$i++) {
                                if($i==$id) { echo "<li class='current'>".$i."</li>"; }
                                else {
                        ?>
                            <li class='current'>
                                <form action="AgriP_edit_T_98.php?id=<?php echo $i?>#1" method="post">
                                    <input type="hidden" name="action" value="1" />
                                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                                    <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
                                    <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
                                    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
                                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                                    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                                    <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
                                    <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                                    <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                                    <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                                    <input type="hidden" name="dis" value="<?php echo $dis ;?>" />
                                    <button><?php echo $i ?></button>
                                </form>
                            </li>
                        <?php } } } echo "</ul>"; ?>
                        </div>
                        <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt=""/></a></p>
                    </td>
                </tr>
                <tr>
                    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
<?php
$no = isset($t_row) ? $t_row : 0;
while ($no > 0){
?>
<script>
$('.s_bar_a<?php echo $no ?>').keyup(function () {
    var zka = document.getElementById("zer_kesht_a<?php echo $no ?>").value; 
    var sba = document.getElementById("s_bar_a<?php echo $no ?>").value;
    if (parseFloat(zka) < parseFloat(sba)) {
        alert("سطح برداشت اول از سطح زیر کشت اول بزرگتر است ");
        $('#s_bar_a<?php echo $no ?>').val('');
        document.getElementById("s_bar_a<?php echo $no ?>").focus();
    }
});
</script>
<script>
$('.s_bar_a<?php echo $no ?>').change(function () {
    $('#mah_tol<?php echo $no ?>').val('');
});
</script>
<script>
$('.s_bar_b<?php echo $no ?>').keyup(function () {
    var zkb = document.getElementById("zer_kesht_b<?php echo $no ?>").value; 
    var sbb = document.getElementById("s_bar_b<?php echo $no ?>").value;
    if (parseFloat(zkb) < parseFloat(sbb)) {
        alert("سطح برداشت دوم از سطح زیر کشت دوم بزرگتر است ");
        $('#s_bar_b<?php echo $no ?>').val('');
        document.getElementById("s_bar_b<?php echo $no ?>").focus();
    }
});
</script>
<script>
$('.s_bar_b<?php echo $no ?>').change(function () {
    $('#mah_tol<?php echo $no ?>').val('');
});
</script>
<script>
$('.mah_tol<?php echo $no ?>').keyup(function () {
    var mcod = document.getElementById("cod_mah<?php echo $no ?>").value;
    var sba = document.getElementById("s_bar_a<?php echo $no ?>").value;
    var sbb  = document.getElementById("s_bar_b<?php echo $no ?>").value;
    var mtol = document.getElementById("mah_tol<?php echo $no ?>").value;
    var no_kesh = document.getElementById("no_kesh<?php echo $no ?>").value;
    $.ajax({
        url: "aj.php",
        type: "POST",
        data: {op:"check_mah_tol",mcod:mcod,sba:sba,sbb:sbb,mtol:mtol,no_kesh:no_kesh},
        success: function(data,status){
            if(data!='true') {
                document.getElementById("submit<?php echo $no ?>").disabled = true;
                $('#mah_tol<?php echo $no ?>').val('');
                document.getElementById("mah_tol<?php echo $no ?>").focus();
                alert(' خطا  \n \n  میزان تولید وارد شده از محدود مجاز، بیشتر هست / میزان سطح برداشت را بررسی کنید ');
            } else
                document.getElementById("submit<?php echo $no ?>").disabled = false ;
        },
        error: function(){$("#result").html("مشکلی در اتصال به سرور به وجود آمد!");}
    });
});
</script>
<script>
$('.mah_tol<?php echo $no ?>').change(function () {
    var sba = document.getElementById("s_bar_a<?php echo $no ?>").value;
    var sbb  = document.getElementById("s_bar_b<?php echo $no ?>").value;
    var mtol = document.getElementById("mah_tol<?php echo $no ?>").value;
    var sb = parseFloat(sba) + parseFloat(sbb);
    if (sb > 0 && parseFloat(mtol) <= 0) {
        $('#mah_tol<?php echo $no ?>').val('');
        document.getElementById("mah_tol<?php echo $no ?>").focus();
        alert("با توجه به سطح برداشت، تولید قطعی نادرست است");
    }
});
</script>
<script type="text/javascript">
$(function() {
    $(".submit<?php echo $no ?>").click(function() {
        var s_bar_a     = $("#s_bar_a<?php echo $no ?>").val();
        var s_bar_b     = $("#s_bar_b<?php echo $no ?>").val();
        var mah_tol     = $("#mah_tol<?php echo $no ?>").val();
        var e = document.getElementById("mah_kh<?php echo $no ?>");
        var mah_kh = e.options[e.selectedIndex].value;
        var id          = $("#id<?php echo $no ?>").val();
        var bah_cod_m   = $("#bah_cod_m<?php echo $no ?>").val();
        var add_abadi   = $("#add_abadi<?php echo $no ?>").val();
        var z_sal       = $("#z_sal").val();
        var sh_gat      = $("#sh_gat<?php echo $no ?>").val();
        var sb          = parseFloat(s_bar_a) + parseFloat(s_bar_b);

        var delivery_amount = $("#delivery<?php echo $no ?>").val();

        if(s_bar_a=='' || s_bar_b=='' || mah_tol=='' || (sb > 0 && parseFloat(mah_tol) <= 0) || (sb <= 0 && parseFloat(mah_tol) > 0) || mah_kh == '' ) {
            $('.success<?php echo $no ?>').fadeOut(200).hide();
            $('.error<?php echo $no ?>').fadeOut(200).show();
            return false;
        }

        var submitBtn = document.getElementById("submit<?php echo $no ?>");
        if(submitBtn) {
            submitBtn.disabled = true;
            submitBtn.value = 'در حال ثبت...';
        }

        var dataString = 's_bar_a='+ s_bar_a + '&s_bar_b=' + s_bar_b + '&mah_tol=' + mah_tol + '&id=' + id + '&bah_cod_m=' + bah_cod_m + '&add_abadi=' + add_abadi + '&z_sal=' + z_sal + '&sh_gat=' + sh_gat + '&mah_kh=' + mah_kh;

        $.ajax({
            type: "POST",
            url: "post98.php",
            data: dataString,
            success: function(response){
                if(response == 'success' || response.trim() == '') {
                    if(parseFloat(delivery_amount) > 0) {
                        var id_agri = id;
                        var id_ostan = $("#id_ostan_h<?php echo $no ?>").val();
                        var id_city = $("#id_city_h<?php echo $no ?>").val();
                        var id_mar = $("#id_mar_h<?php echo $no ?>").val();
                        var mor_cod_m = $("#mor_cod_m_h<?php echo $no ?>").val();
                        var s_bar_a_new = s_bar_a;
                        var s_bar_b_new = s_bar_b;
                        var mah_tol_new = mah_tol;

                        var deliveryData = 'delivery_amount=' + delivery_amount + '&id_agri=' + id_agri + '&bah_cod_m=' + bah_cod_m + '&sh_gat=' + sh_gat + '&id_ostan=' + id_ostan + '&id_city=' + id_city + '&id_mar=' + id_mar + '&mor_cod_m=' + mor_cod_m + '&s_bar_a=' + s_bar_a_new + '&s_bar_b=' + s_bar_b_new + '&mah_tol=' + mah_tol_new + '&z_sal=' + z_sal;

                        $.ajax({
                            type: "POST",
                            url: "post_delivery.php",
                            data: deliveryData,
                            async: false,
                            success: function(deliveryResponse){
                                if(deliveryResponse == 'success') {
                                    var input = document.getElementById('delivery<?php echo $no ?>');
                                    input.setAttribute('readonly', 'readonly');
                                    input.style.backgroundColor = '#E8E8E8';
                                    input.style.border = '1px solid #CCC';
                                    var deliveryDiv = input.parentNode;
                                    var oldEditBtn = document.getElementById('editBtn<?php echo $no ?>');
                                    if(oldEditBtn) oldEditBtn.remove();
                                    var oldStatusMsg = document.getElementById('statusMsg<?php echo $no ?>');
                                    if(oldStatusMsg) oldStatusMsg.remove();

                                    var editBtn = document.createElement('button');
                                    editBtn.type = 'button';
                                    editBtn.className = 'btn-edit-delivery';
                                    editBtn.id = 'editBtn<?php echo $no ?>';
                                    editBtn.innerHTML = 'ویرایش';
                                    editBtn.onclick = function() { enableEdit(<?php echo $no ?>); };

                                    var statusMsg = document.createElement('span');
                                    statusMsg.className = 'delivery-saved';
                                    statusMsg.id = 'statusMsg<?php echo $no ?>';
                                    statusMsg.innerHTML = '✓ ثبت شده';
                                    statusMsg.style.display = 'inline-block';

                                    deliveryDiv.appendChild(document.createElement('br'));
                                    deliveryDiv.appendChild(editBtn);
                                    deliveryDiv.appendChild(document.createElement('br'));
                                    deliveryDiv.appendChild(statusMsg);

                                    $('.success<?php echo $no ?>').fadeIn(200).show();
                                    $('.error<?php echo $no ?>').fadeOut(200).hide();
                                } else {
                                    alert("خطا در ثبت تحویلی: " + deliveryResponse);
                                    $('.success<?php echo $no ?>').fadeOut(200).hide();
                                    $('.error<?php echo $no ?>').fadeOut(200).show();
                                }
                            },
                            error: function(){
                                alert("مشکلی در اتصال به سرور برای ثبت تحویلی به وجود آمد!");
                                $('.error<?php echo $no ?>').fadeOut(200).show();
                            }
                        });
                    } else {
                        $('.success<?php echo $no ?>').fadeIn(200).show();
                        $('.error<?php echo $no ?>').fadeOut(200).hide();
                    }
                } else {
                    $('.success<?php echo $no ?>').fadeOut(200).hide();
                    $('.error<?php echo $no ?>').fadeOut(200).show();
                    alert("خطا در ثبت اطلاعات زراعی: " + response);
                }
                if(submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.value = 'ثبت';
                }
            },
            error: function(){
                alert("مشکلی در اتصال به سرور برای ثبت زراعی به وجود آمد!");
                $('.error<?php echo $no ?>').fadeOut(200).show();
                if(submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.value = 'ثبت';
                }
            }
        });
        return false;
    });
});
</script>

<script>
function enableEdit(row) {
    var input = document.getElementById('delivery' + row);
    var editBtn = document.getElementById('editBtn' + row);
    var updateBtn = document.getElementById('updateBtn' + row);
    var statusMsg = document.getElementById('statusMsg' + row);
    var editMsg = document.getElementById('editMsg' + row);
    
    input.removeAttribute('readonly');
    input.style.backgroundColor = '#FFFFCC';
    input.style.border = '2px solid #FF6600';
    input.focus();
    
    if(editBtn) editBtn.style.display = 'none';
    if(updateBtn) updateBtn.style.display = 'inline-block';
    if(statusMsg) statusMsg.style.display = 'none';
    if(editMsg) editMsg.style.display = 'inline-block';
}

function updateDelivery(row) {
    var delivery_amount = document.getElementById('delivery' + row).value;
    var id_agri = document.getElementById('id' + row).value;
    var bah_cod_m = document.getElementById('bah_cod_m' + row).value;
    var sh_gat = document.getElementById('sh_gat' + row).value;
    var id_ostan = document.getElementById('id_ostan_h' + row).value;
    var id_city = document.getElementById('id_city_h' + row).value;
    var id_mar = document.getElementById('id_mar_h' + row).value;
    var mor_cod_m = document.getElementById('mor_cod_m_h' + row).value;
    var s_bar_a = document.getElementById('s_bar_a_h' + row).value;
    var s_bar_b = document.getElementById('s_bar_b_h' + row).value;
    var mah_tol = document.getElementById('mah_tol_h' + row).value;
    var z_sal = document.getElementById('z_sal').value;
    
    var dataString = 'delivery_amount=' + delivery_amount + '&id_agri=' + id_agri + '&bah_cod_m=' + bah_cod_m + '&sh_gat=' + sh_gat + '&id_ostan=' + id_ostan + '&id_city=' + id_city + '&id_mar=' + id_mar + '&mor_cod_m=' + mor_cod_m + '&s_bar_a=' + s_bar_a + '&s_bar_b=' + s_bar_b + '&mah_tol=' + mah_tol + '&z_sal=' + z_sal;
    
    if(delivery_amount.trim() === '' || isNaN(parseFloat(delivery_amount)) || parseFloat(delivery_amount) < 0) {
        alert("لطفاً میزان تحویلی معتبر وارد کنید");
        return false;
    }
    
    var mtol = parseFloat(mah_tol) || 0;
    var del = parseFloat(delivery_amount) || 0;
    if (del > mtol) {
        alert("میزان تحویلی از تولید قطعی بیشتر است!");
        return false;
    }
    
    $.ajax({
        type: "POST",
        url: "post_delivery.php",
        data: dataString,
        success: function(response){
            if(response == 'success') {
                var input = document.getElementById('delivery' + row);
                var editBtn = document.getElementById('editBtn' + row);
                var updateBtn = document.getElementById('updateBtn' + row);
                var statusMsg = document.getElementById('statusMsg' + row);
                var editMsg = document.getElementById('editMsg' + row);
                
                input.setAttribute('readonly', 'readonly');
                input.style.backgroundColor = '#E8E8E8';
                input.style.border = '1px solid #CCC';
                
                if(editBtn) editBtn.style.display = 'inline-block';
                if(updateBtn) updateBtn.style.display = 'none';
                if(statusMsg) statusMsg.style.display = 'inline-block';
                if(editMsg) editMsg.style.display = 'none';
                
                alert('میزان تحویلی با موفقیت بروزرسانی شد');
            } else {
                alert("خطا در بروزرسانی اطلاعات: " + response);
            }
        },
        error: function(){
            alert("مشکلی در اتصال به سرور به وجود آمد!");
        }
    });
}
</script>

<?php
$no--;
}
?>