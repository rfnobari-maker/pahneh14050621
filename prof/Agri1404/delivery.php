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

// برای z_sal و Agri_prod_table
if (isset($_POST['z_sal'])) {
    $z_sal = $_POST['z_sal'];
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
} else {
    $z_sal = '';
    $Agri_prod_table = '';
}
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
        .tabel { margin-right:45px }
        .text_r { margin-right:0px }
        .style1 {
            color: #003366;
            font-family: Tahoma;
            font-size: 18px;
        }
    </style>
    <style type="text/css">
        #content {
            width: 900px;
            margin: 0 auto;
            font-family:Arial, Helvetica, sans-serif;
        }
        .page {
            float: right;
            margin: 0;
            padding: 0;
        }
        .page li {
            list-style: none;
            display:inline-block;
        }
        .page li a, .current {
            display: block;
            padding: 5px;
            text-decoration: none;
            color: #8A8A8A;
        }
        .current {
            font-weight:bold;
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
            width:12%;
            padding: 5px;
        }
        .column-delivery {
            float: left;
            width:16%;
            padding: 5px;
        }
        .row {
            width: 100%
        }
        .row::after {
            content: "";
            clear: both;
            display: table;
        }
        .delivery-input {
            width: 80px !important;
            height: 35px !important;
            text-align: center;
            font-size: 14px;
            font-family: Tahoma;
            border: 2px solid #006699;
            border-radius: 5px;
            background-color: #FFFFCC;
        }
        .readonly-field {
            background-color: #E8E8E8;
            color: #333;
            border: 1px solid #CCC;
            text-align: center;
            font-family: Tahoma;
            font-size: 13px;
            width: 70px;
            height: 30px;
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
        .btn-submit-delivery {
            width:45px ; height:30px ; font-size:12px ; color:#900 ; font-family:tahoma ; text-align:center;
            background-color: #f0f0f0;
            border: 1px solid #999;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-submit-delivery:hover:not(:disabled) {
            background-color: #FFCCCC;
        }
        .btn-submit-delivery:disabled {
            background-color: #CCC;
            color: #666;
            cursor: not-allowed;
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
                        <td width="840" >
                            <?php include('top.php');?>
                            <span class="style8">ثبت میزان گندم تحویلی به دولت</span><br />
                            <form id="reg-form" method="post" action="#1">
                                <div style="width: 700px; padding: 5px; border: 2px solid #09C; margin: auto; text-align: left; border-radius: 15px" >
                                    <table width="100%" height="437" border='0' align="center" cellpadding='0' cellspacing='0'>
                                        <tr bgcolor='#f1f1f1' >
                                            <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
                                        </tr>
                                        <tr bgcolor='#f1f1f1' >
                                            <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" >
                                                <div align="right">
                                                    <select name="z_sal" class="input_text required" id="z_sal" style="height:40px ; width:170px ; direction:rtl" tabindex="1">
                                                        <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td align='center' bgcolor="#FFFFFF" class="style8">: سال زراعی</td>
                                            <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" >
                                                <select name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                                                    <?php $id_ostan1 = $id_ostan ?>
                                                    <option value="-1">انتخاب استان</option>
                                                    <?php
                                                    $query = "SELECT id_ostan,ostan FROM `ostanname` ORDER BY BINARY ostan ASC";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach($stmt as $row){
                                                    ?>
                                                    <option value="<?php echo $row['id_ostan'] ;?>"
                                                        <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                                                    <?php }?>
                                                </select>
                                                <?php 
                                                if (isset($_POST['id_ostan']))
                                                    $id_ostan1= $_POST['id_ostan'] ; 
                                                ?>
                                            </td>
                                            <td align='center' bgcolor="#FFFFFF" class="style8">: استان</td>
                                        </tr>
                                        <tr bgcolor='#f1f1f1' >
                                            <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" >
                                                <div align="right">
                                                    <select name="no_kesh" class="input_text required" id="no_bah2" style="height:40px ; width:170px ; direction:rtl" tabindex="2">
                                                        <option value="0">انتخاب کنید</option>
                                                        <option value="1" <?php if(isset($no_kesh) and $no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                                                        <option value="2" <?php if(isset($no_kesh) and $no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td height="47" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="style8">: نوع کشت</font></td>
                                            <td width="214" align="right" bgcolor="#DDDDDD" class="input_text" >
                                                <select name="id_city5" disabled="disabled" class="style8" id="id_city" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                                                    <option value="0"> کل استان</option>
                                                    <?php
                                                    $query = "SELECT id_city,city FROM `cityname` WHERE `id_ostan` = '$id_ostan1' ORDER BY BINARY city ASC";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach($stmt as $row){
                                                    ?>
                                                    <option value="<?php echo $row['id_city'] ;?>"
                                                        <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
                                                    <?php }?>
                                                </select>
                                                <?php 
                                                if (isset($_POST['id_city5']))
                                                    $id_city = $_POST['id_city5'] ; 
                                                ?>
                                            </td>
                                            <td width="146" align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
                                        </tr>
                                        <!-- ردیف نام گروه و محصول حذف شد -->
                                        <tr>
                                            <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" >
                                                <select name="add_abadi" class="input_text" id="add_abadi" style="width:170px ; height:40px" tabindex="6" dir="rtl">
                                                    <option value="0" >انتخاب نام آبادی</option>
                                                    <?php
                                                    $query = "SELECT add_abadi,abadi FROM `list_abadi` WHERE `mor_cod_m` = '$login_session' ORDER BY BINARY abadi";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach($stmt as $row){
                                                    ?>
                                                    <option value="<?php echo $row['add_abadi'] ;?>"
                                                        <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                                                    <?php }?>
                                                </select>
                                            </td>
                                            <td height="54" align='center' bgcolor="#DDDDDD" class="style8">نام آبادی</td>
                                            <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" >
                                                <select name="id_mar" disabled="disabled" class="style8" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                                                    <option value="0"> نام مرکز</option>
                                                    <?php
                                                    $query = "SELECT id_mar,mar FROM `mar` WHERE `id_ostan` = $id_ostan1 and `id_city` = $id_city";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach($stmt as $row){
                                                    ?>
                                                    <option value="<?php echo $row['id_mar'] ;?>"
                                                        <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
                                                    <?php }?>
                                                </select>
                                                <?php
                                                if (isset($_POST['id_mar']))
                                                    $id_mar = $_POST['id_mar'] ; 
                                                ?>
                                                <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
                                            </td>
                                            <td width="146" rowspan="2" align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
                                        </tr>
                                        <tr>
                                            <td height="40" align="right" bgcolor="#DDDDDD" class="input_text" >
                                                <select name="add_city" class="input_text" id="add_city" style="width:170px ; height:40px" tabindex="7" dir="rtl">
                                                    <option value="0" >انتخاب نام شهر</option>
                                                    <?php
                                                    $query = "SELECT add_city,shahr FROM `list_city` WHERE `id_mar` = '$id_mar' and `mor_cod_m`= '$login_session' ORDER BY BINARY shahr";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach($stmt as $row){
                                                    ?>
                                                    <option value="<?php echo $row['add_city'] ;?>"
                                                        <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                                                    <?php }?>
                                                </select>
                                            </td>
                                            <td height="40" align='center' bgcolor="#DDDDDD" class="style8">نام شهر</td>
                                        </tr>
                                        <tr>
                                            <td height="54" align="right" class="input_text" >
                                                <div align="right">
                                                    <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m" style="height:35px ; width:170px " tabindex="8" value="<?php echo $bah_cod_m?>" />
                                                </div>
                                            </td>
                                            <td height="54" align="right" class="style1" ><font size="2" class="style8">: کد ملی بهره بردار</font></td>
                                            <td height="54" align="right" class="input_text" >
                                                <div align="right">
                                                    <input name="mor_cod_m" type="text" class="style8" style="height:35px ; width:170px " value=" <?php echo $login_session ?>" readonly="readonly" />
                                                </div>
                                            </td>
                                            <td height="54" align='center' class="style1"><font size="2" class="style8">: کد ملی مروج</font></td>
                                        </tr>
                                        <tr>
                                            <td height="60" colspan="2" align="left" bgcolor="#DDDDDD"><span class="btn-edit-delivery">فقط قطعات دارای تولید قطعی نمایش داده میشود </span></td>
                                            <td height="60" align="left" bgcolor="#DDDDDD">
                                                <div align="right">
                                                    <select name="dis" class="input_text required" id="no_kesh" style="height:40px ; width:170px ; direction:rtl" tabindex="9">
                                                        <option value="1" <?php if($dis=="1") echo "selected='selected'"?>>همه رکوردها</option>
                                                        <option value="2" <?php if($dis=="2") echo "selected='selected'"?>>رکوردهای بدون تحویل</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td height="60" align="left" bgcolor="#DDDDDD"><font size="2" class="style8">:   نمایش رکوردها</font></td>
                                        </tr>
                                        <tr>
                                            <td height="60" colspan="4" align="left"><br />
                                              <br />
                                                <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="10" value='جستجو' />
                                            </td>
                                        </tr>
                                    </table> 
                                </div>
                            </form>
                            <p><span class="style1"><a name="1" id="1"></a></span>
                            <?php
                            if (isset($_POST['action'])) 
                            {  
                                if ($id_ostan1 == '-1')    { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
                                if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
                                if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
                                if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
                                if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
                                if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
                                if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m ='$login_session' " ;}
                                if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m ='$bah_cod_m' " ;}
                                if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
                                
                                // شرط محصولات 102 و 103
                                $v_cod_mah = "cod_mah IN (102, 103)";
                                
                                // شرط mah_tol > 0
                                $v_mah_tol = "mah_tol > 0";
                                
                                // شرط نمایش - اصلاح شده با NOT EXISTS
                                if ($dis == '1') { 
                                    // همه رکوردها
                                    $v_dis = "1=1"; 
                                } else { 
                                    // فقط رکوردهایی که هنوز تحویل ثبت نشده
                                   $v_dis = "id NOT IN (SELECT Agri_id FROM delivery WHERE Agri_id IS NOT NULL)";
                                }

                                $start=0;
                                $limit=25;
                                $id = isset($_GET['id']) ? $_GET['id'] : 1;
                                $start=($id-1)*$limit;
                                
                                $query = "SELECT id,bah_cod_m,sh_gat,no_kesh,cod_mah,zer_kesht_a,zer_kesht_b,mah_tolp,s_bar_a,s_bar_b,mah_tol,add_abadi,mah_kh 
                                          FROM $Agri_prod_table 
                                          WHERE $v_id_ostan AND $v_id_city AND $v_id_mar AND $f_add_abadi AND $f_add_city 
                                          AND $f_no_kesh AND $v_mor_cod_m AND $v_bah_cod_m AND $v_z_sal AND $v_cod_mah AND $v_mah_tol AND $v_dis 
                                          ORDER BY bah_cod_m,sh_gat ASC LIMIT $start, $limit"; 
                                
                                $query1 = "SELECT COUNT(*) FROM $Agri_prod_table 
                                           WHERE $v_id_ostan AND $v_id_city AND $v_id_mar AND $f_add_abadi AND $f_add_city 
                                           AND $f_no_kesh AND $v_mor_cod_m AND $v_bah_cod_m AND $v_z_sal AND $v_cod_mah AND $v_mah_tol AND $v_dis";
                                           
                                $stmt = $dbh->prepare($query);
                                $stmt->execute();
                                $t_row = $stmt -> rowCount() ; 
                                if ($t_row>0) { ;
                                ?>
                                <br />
                                <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                                <br />
                                <table align="center" class="my-table" >
                                    <!-- ردیف اول عنوان جدول -->
                                    <tr class="header-row">
                                        <td rowspan="2" bgcolor="#3399CC" style="width:10%;">عملیات</td>
                                      <td rowspan="2" bgcolor="#3399CC" style="width:8%;">میزان تحویلی به دولت<br><span class="style2">تن</span></td>
                                      <td rowspan="2" bgcolor="#3399CC" style="width:7%;">میزان تولید قطعی<br><span class="style2">تن</span></td>
                                      <td colspan="2" bgcolor="#3399CC" style="width:15%;">سطح برداشت <br><span class="style2">هکتار</span></td>
                                        <td rowspan="2" bgcolor="#3399CC" style="width:7%;">نام محصول</td>
                                        <td rowspan="2" bgcolor="#3399CC" style="width:5%;">نوع کشت</td>
                                        <td rowspan="2" bgcolor="#3399CC" style="width:5%;">شماره قطعه</td>
                                        <td colspan="2" bgcolor="#3399CC" style="width:20%;">مشخصات بهره بردار</td>
                                        <td rowspan="2" bgcolor="#3399CC" style="width:4%;">ردیف</td>
                                    </tr>
                                    <!-- ردیف دوم عنوان جدول -->
                                    <tr class="header-row">
                                        <td bgcolor="#3399CC" style="width:7%;">دوم</td>
                                        <td bgcolor="#3399CC" style="width:8%;">اول</td>
                                        <td bgcolor="#3399CC" style="width:10%;">کد ملی</td>
                                        <td bgcolor="#3399CC" style="width:10%;">نام و نام خانوادگی</td>
                                    </tr>
                                    <?php 
                                    $r = 1 ;
                                    foreach($stmt as $row){ 
                                        if ($row['no_kesh']=='1') $v_no_kesh='آبی';     
                                        if ($row['no_kesh']=='2') $v_no_kesh='دیم';
                                        $t_r = $r;
                                        
                                        // بررسی اینکه آیا قبلاً تحویل ثبت شده
                                        $check_delivery = "SELECT delivery_amount FROM delivery WHERE Agri_id = '".$row['id']."'";
                                        $stmt_check = $dbh->prepare($check_delivery);
                                        $stmt_check->execute();
                                        $delivery_row = $stmt_check->fetch(PDO::FETCH_ASSOC);
                                        $delivery_amount = ($delivery_row) ? $delivery_row['delivery_amount'] : '';
                                        $has_delivery = ($delivery_row) ? true : false;
                                    ?>
                                    <tr <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                                        <!-- ستون عملیات -->
                                        <td>
                                            <form name="form<?php echo $t_r ?>">
                                                <input type="hidden" id="id<?php echo $t_r ?>" name="id" value="<?php echo $row['id'] ;?>" />
                                                <input type="hidden" id="add_city<?php echo $t_r ?>" name="add_city" value="<?php echo $add_city ;?>" />
                                                <input type="hidden" id="z_sal_h<?php echo $t_r ?>" name="z_sal" value="<?php echo $z_sal ;?>" />
                                                <input type="hidden" id="bah_cod_m<?php echo $t_r ?>" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
                                                <input type="hidden" id="add_abadi<?php echo $t_r ?>" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
                                                <input type="hidden" id="sh_gat<?php echo $t_r ?>" name="sh_gat" value="<?php echo $row['sh_gat'] ;?>" />
                                                <input type="hidden" id="id_ostan_h<?php echo $t_r ?>" name="id_ostan_h" value="<?php echo $id_ostan1 ;?>" />
                                                <input type="hidden" id="id_city_h<?php echo $t_r ?>" name="id_city_h" value="<?php echo $id_city ;?>" />
                                                <input type="hidden" id="id_mar_h<?php echo $t_r ?>" name="id_mar_h" value="<?php echo $id_mar ;?>" />
                                                <input type="hidden" id="mor_cod_m_h<?php echo $t_r ?>" name="mor_cod_m_h" value="<?php echo $login_session ;?>" />
                                                <input type="hidden" id="s_bar_a_h<?php echo $t_r ?>" value="<?php echo $row['s_bar_a']; ?>" />
                                                <input type="hidden" id="s_bar_b_h<?php echo $t_r ?>" value="<?php echo $row['s_bar_b']; ?>" />
                                                <input type="hidden" id="mah_tol_h<?php echo $t_r ?>" value="<?php echo $row['mah_tol']; ?>" />
                                                
                                                <?php if($has_delivery): ?>
                                                    <!-- دکمه ویرایش -->
                                                    <button type="button" class="btn-edit-delivery" id="editBtn<?php echo $t_r ?>" onclick="enableEdit(<?php echo $t_r ?>)">ویرایش</button>
                                                    <br>
                                                    <!-- دکمه بروزرسانی (پنهان در ابتدا) -->
                                                    <button type="button" class="btn-update-delivery" id="updateBtn<?php echo $t_r ?>" style="display:none;" onclick="updateDelivery(<?php echo $t_r ?>)">بروزرسانی</button>
                                                    <br>
                                                    <span class="delivery-saved" id="statusMsg<?php echo $t_r ?>">✓ ثبت شده</span>
                                                    <span class="delivery-editing" id="editMsg<?php echo $t_r ?>" style="display:none;">✎ در حال ویرایش</span>
                                                <?php else: ?>
                                                    <input type="button" class="btn-submit-delivery submit<?php echo $t_r ?>" id="submit<?php echo $t_r ?>" 
                                                           tabindex="<?php echo $r.'5'?>" value="ثبت" onclick="submitDelivery(<?php echo $t_r ?>)" />
                                                    <br>
                                                    <span class="error<?php echo $t_r ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15" alt=""/></span>
                                                    <span class="success<?php echo $t_r ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15" alt=""/></span>
                                                <?php endif; ?>
                                            </form>
                                        </td>
                                        <!-- ستون میزان تحویلی -->
                                        <td>
                                            <input name="delivery_amount" type="text" class="delivery-input delivery<?php echo $t_r ?>" 
                                                   id="delivery<?php echo $t_r ?>" 
                                                   style="width:70px;height:30px;text-align:center;font-size:13px;font-family:Tahoma;
                                                          <?php if($has_delivery) echo 'background-color:#E8E8E8;border:1px solid #CCC;'; else echo 'border:2px solid #006699;background-color:#FFFFCC;'; ?>" 
                                                   tabindex="<?php echo $r.'4'?>" 
                                                   value="<?php echo $delivery_amount; ?>" 
                                                   maxlength="12" 
                                                   step="any"
                                                   <?php if($has_delivery) echo 'readonly="readonly"'; ?> 
                                                   placeholder="میزان تحویل" />
                                        </td>
                                        <!-- ستون میزان تولید قطعی -->
                                        <td>
                                            <input name="mah_tol_display" type="text" class="readonly-field" 
                                                   value="<?php echo $row['mah_tol']*1 ; ?>" readonly="readonly" style="width:60px;height:28px;" />
                                        </td>
                                        <!-- ستون سطح برداشت دوم -->
                                        <td>
                                            <input name="s_bar_b_display" type="text" class="readonly-field" 
                                                   value="<?php echo $row['s_bar_b']*1 ; ?>" readonly="readonly" style="width:60px;height:28px;" />
                                        </td>
                                        <!-- ستون سطح برداشت اول -->
                                        <td>
                                            <input name="s_bar_a_display" type="text" class="readonly-field" 
                                                   value="<?php echo $row['s_bar_a']*1 ; ?>" readonly="readonly" style="width:60px;height:28px;" />
                                        </td>
                                        <!-- ستون نام محصول -->
                                        <td class="normalTextSmall">
                                            <?php echo mah_name($row['cod_mah']); ?>
                                            <input name="cod_mah<?php echo $t_r ?>" type="hidden" value="<?php echo $row['cod_mah'] ;?>" />
                                        </td>
                                        <!-- ستون نوع کشت -->
                                        <td class="normalTextSmall">
                                            <?php echo $v_no_kesh?>
                                            <input name="no_kesh<?php echo $t_r ?>" type="hidden" value="<?php echo $row['no_kesh'] ;?>" />
                                        </td>
                                        <!-- ستون شماره قطعه -->
                                        <td class="normalTextSmall">
                                            <?php echo $row['sh_gat']; ?>
                                        </td>
                                        <!-- ستون کد ملی بهره بردار -->
                                        <td class="normalTextSmall">
                                            <?php echo $row['bah_cod_m'] ?>
                                        </td>
                                        <!-- ستون نام و نام خانوادگی بهره بردار -->
                                        <td class="normalTextSmall">
                                            <div align="center"><?php echo bah_name($row['bah_cod_m'])?></div>
                                        </td>
                                        <!-- ستون ردیف -->
                                        <td class="normalTextSmall">
                                            <?php echo $r;?>
                                        </td>
                                    </tr>
                                    <?php 
                                    $r++ ; 
                                    }
                                    ?>
                                </table>
                                <p class="style2" align="center">
                                <?php }  
                                else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }} ?>
                                </p>
                                <div style="text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px; border-radius: 15px">
                                <?php   
                                if(isset($query1))
                                {
                                    $stmt1 = $dbh->prepare($query1);
                                    $stmt1->execute();
                                    $rows = $stmt1 -> fetchColumn();
                                    $total=ceil($rows/$limit);
                                    if ($rows > 25) $t_row = 25 ; else $t_row = $rows ; 
                                    if($id>1)
                                    {
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
                                        <input type="hidden" name="dis" value="<?php echo $dis ;?>" />
                                        <button class='button'>قبلی</button>
                                    </form>
                                <?php 
                                    }
                                    if($id!=$total)
                                    {
                                ?>
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
                                        <input type="hidden" name="dis" value="<?php echo $dis ;?>" />
                                        <button class='button'>بعدی</button>
                                    </form>
                                <?php 
                                    }
                                    echo "<ul class='page'>";
                                    for($i=1;$i<=$total;$i++)
                                    {
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
                                            <input type="hidden" name="dis" value="<?php echo $dis ;?>" />
                                            <button><?php echo $i ?></button>
                                        </form>
                                    </li>
                                <?php
                                        }
                                    }
                                }
                                echo "</ul>";
                                ?>
                                </div>
                                <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt=""/></a></p>    
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
                            <?php include('../../footer.php')?>
                        </td>
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
// تابع فعال‌سازی ویرایش
function enableEdit(row) {
    var input = document.getElementById('delivery' + row);
    var editBtn = document.getElementById('editBtn' + row);
    var updateBtn = document.getElementById('updateBtn' + row);
    var statusMsg = document.getElementById('statusMsg' + row);
    var editMsg = document.getElementById('editMsg' + row);
    
    // فعال کردن فیلد ورودی
    input.removeAttribute('readonly');
    input.style.backgroundColor = '#FFFFCC';
    input.style.border = '2px solid #FF6600';
    input.focus();
    
    // تغییر دکمه‌ها
    if(editBtn) editBtn.style.display = 'none';
    if(updateBtn) updateBtn.style.display = 'inline-block';
    if(statusMsg) statusMsg.style.display = 'none';
    if(editMsg) editMsg.style.display = 'inline-block';
}

// تابع بروزرسانی تحویل
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
    var z_sal = document.getElementById('z_sal_h' + row).value;
    
    var dataString = 'delivery_amount=' + delivery_amount + 
                    '&id_agri=' + id_agri + 
                    '&bah_cod_m=' + bah_cod_m + 
                    '&sh_gat=' + sh_gat + 
                    '&id_ostan=' + id_ostan + 
                    '&id_city=' + id_city + 
                    '&id_mar=' + id_mar + 
                    '&mor_cod_m=' + mor_cod_m + 
                    '&s_bar_a=' + s_bar_a + 
                    '&s_bar_b=' + s_bar_b + 
                    '&mah_tol=' + mah_tol + 
                    '&z_sal=' + z_sal;
    
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
                
                // غیرفعال کردن فیلد ورودی
                input.setAttribute('readonly', 'readonly');
                input.style.backgroundColor = '#E8E8E8';
                input.style.border = '1px solid #CCC';
                
                // تغییر دکمه‌ها
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

// ====== تابع ثبت جدید ======
function submitDelivery(row) {
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
    var z_sal = document.getElementById('z_sal_h' + row).value;
    
    var dataString = 'delivery_amount=' + delivery_amount + 
                    '&id_agri=' + id_agri + 
                    '&bah_cod_m=' + bah_cod_m + 
                    '&sh_gat=' + sh_gat + 
                    '&id_ostan=' + id_ostan + 
                    '&id_city=' + id_city + 
                    '&id_mar=' + id_mar + 
                    '&mor_cod_m=' + mor_cod_m + 
                    '&s_bar_a=' + s_bar_a + 
                    '&s_bar_b=' + s_bar_b + 
                    '&mah_tol=' + mah_tol + 
                    '&z_sal=' + z_sal;
    
    if(delivery_amount.trim() === '' || isNaN(parseFloat(delivery_amount)) || parseFloat(delivery_amount) < 0) {
        $('.error' + row).fadeOut(200).show();
        alert("لطفاً میزان تحویلی معتبر وارد کنید");
        return false;
    }
    
    var mtol = parseFloat(mah_tol) || 0;
    var del = parseFloat(delivery_amount) || 0;
    if (del > mtol) {
        alert("میزان تحویلی از تولید قطعی بیشتر است!");
        $('.error' + row).fadeOut(200).show();
        return false;
    }
    
    // غیرفعال کردن دکمه ثبت برای جلوگیری از ارسال مجدد
    var submitBtn = document.getElementById('submit' + row);
    if(submitBtn) {
        submitBtn.disabled = true;
        submitBtn.value = 'در حال ارسال...';
    }
    
    $.ajax({
        type: "POST",
        url: "post_delivery.php",
        data: dataString,
        success: function(response){
            if(response == 'success') {
                $('.success' + row).fadeIn(200).show();
                $('.error' + row).fadeOut(200).hide();
                
                var input = document.getElementById('delivery' + row);
                input.setAttribute('readonly', 'readonly');
                input.style.backgroundColor = '#E8E8E8';
                input.style.border = '1px solid #CCC';
                
                // مخفی کردن دکمه ثبت و نمایش دکمه ویرایش
                if(submitBtn) {
                    submitBtn.style.display = 'none';
                }
                // اضافه کردن دکمه ویرایش
                var form = document.getElementById('form' + row);
                if(form) {
                    // حذف دکمه‌های قبلی اگر وجود دارند
                    var oldEditBtn = document.getElementById('editBtn' + row);
                    if(oldEditBtn) oldEditBtn.remove();
                    var oldStatusMsg = document.getElementById('statusMsg' + row);
                    if(oldStatusMsg) oldStatusMsg.remove();
                    
                    // ایجاد دکمه ویرایش جدید
                    var editBtn = document.createElement('button');
                    editBtn.type = 'button';
                    editBtn.className = 'btn-edit-delivery';
                    editBtn.id = 'editBtn' + row;
                    editBtn.innerHTML = 'ویرایش';
                    editBtn.onclick = function() { enableEdit(row); };
                    
                    // ایجاد پیام ثبت شده
                    var statusMsg = document.createElement('span');
                    statusMsg.className = 'delivery-saved';
                    statusMsg.id = 'statusMsg' + row;
                    statusMsg.innerHTML = '✓ ثبت شده';
                    statusMsg.style.display = 'inline-block';
                    
                    // اضافه کردن به فرم
                    form.appendChild(document.createElement('br'));
                    form.appendChild(editBtn);
                    form.appendChild(document.createElement('br'));
                    form.appendChild(statusMsg);
                }
                
                alert('اطلاعات با موفقیت ثبت شد');
            } else {
                $('.success' + row).fadeOut(200).hide();
                $('.error' + row).fadeOut(200).show();
                if(submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.value = 'ثبت';
                }
                alert("خطا در ثبت اطلاعات: " + response);
            }
        },
        error: function(){
            if(submitBtn) {
                submitBtn.disabled = false;
                submitBtn.value = 'ثبت';
            }
            alert("مشکلی در اتصال به سرور به وجود آمد!");
        }
    });
    return false;
}

// اعتبارسنجی ورودی تحویل - اصلاح شده برای پذیرش اعداد اعشاری
$('.delivery<?php echo $no ?>').on('keyup change', function () {
    var mtol = parseFloat(document.getElementById("mah_tol_h<?php echo $no ?>").value) || 0;
    var del = parseFloat(this.value) || 0;
    var submitBtn = document.getElementById("submit<?php echo $no ?>");
    
    // اگر مقدار خالی باشد یا عدد معتبر نباشد
    if (this.value.trim() === '' || isNaN(del)) {
        if(submitBtn) submitBtn.disabled = true;
        return;
    }
    
    // بررسی اعداد منفی
    if (del < 0) {
        alert("میزان تحویلی نمی‌تواند منفی باشد!");
        $(this).val('');
        $(this).focus();
        if(submitBtn) submitBtn.disabled = true;
        return;
    }
    
    // بررسی اینکه از تولید قطعی بیشتر نباشد
    if (del > mtol) {
        alert("میزان تحویلی به دولت (" + del + " تن) از میزان تولید قطعی (" + mtol + " تن) بیشتر است!");
        $(this).val('');
        $(this).focus();
        if(submitBtn) submitBtn.disabled = true;
        return;
    }
    
    // اگر مقدار معتبر بود (0 یا بیشتر و کمتر از تولید قطعی)
    if(submitBtn) submitBtn.disabled = false;
});

// مقداردهی اولیه برای دکمه ثبت
$(document).ready(function() {
    var initialVal = $('#delivery<?php echo $no ?>').val();
    var submitBtn = document.getElementById("submit<?php echo $no ?>");
    if(submitBtn) {
        if(initialVal && initialVal.trim() !== '' && !isNaN(parseFloat(initialVal)) && parseFloat(initialVal) >= 0) {
            // اگر مقدار معتبر است، دکمه را فعال کن
            var mtol = parseFloat(document.getElementById("mah_tol_h<?php echo $no ?>").value) || 0;
            if(parseFloat(initialVal) <= mtol) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        } else {
            submitBtn.disabled = true;
        }
    }
});
</script>
<?php
$no--;
}
?>