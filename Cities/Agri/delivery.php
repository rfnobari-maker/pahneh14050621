<?php 
include('../../lock_p3.php');
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
        .delivery-display {
            background-color: #E8E8E8;
            color: #333;
            border: 1px solid #CCC;
            text-align: center;
            font-family: Tahoma;
            font-size: 13px;
            width: 70px;
            height: 30px;
            border-radius: 5px;
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
                            <span class="style8">مشاهده میزان گندم تحویلی به دولت</span><br />
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
                                                <select name="id_mar" class="style8" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
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
                                                    <input name="mor_cod_m" type="text" class="style8" style="height:35px ; width:170px " value="<?php echo $mor_cod_m ?>" />
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
                                if ($id_ostan1 == '-1')    { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "a.id_ostan='$id_ostan1'" ;}
                                if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "a.id_city='$id_city'" ;}
                                if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "a.id_mar='$id_mar'" ;}
                                if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "a.add_abadi = '$add_abadi'" ;}
                                if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "a.add_city = '$add_city'" ;}
                                if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "a.no_kesh = '$no_kesh'" ;}
                                if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "a.mor_cod_m ='$mor_cod_m' " ;}
                                if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "a.bah_cod_m ='$bah_cod_m' " ;}
                                if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "a.z_sal = '$z_sal'" ;}
                                
                                // شرط محصولات 102 و 103
                                $v_cod_mah = "cod_mah IN (102, 103)";
                                
                                // شرط mah_tol > 0
                                $v_mah_tol = "a.mah_tol > 0";
                                
                                // شرط نمایش - اصلاح شده با NOT EXISTS
                                if ($dis == '1') { 
                                    // همه رکوردها
                                    $v_dis = "1"; 
                                } else { 
                                    // فقط رکوردهایی که هنوز تحویل ثبت نشده
                                   $v_dis = "a.id NOT IN (SELECT Agri_id FROM delivery WHERE Agri_id IS NOT NULL)";
                                }

                                $start=0;
                                $limit=25;
                                $id = isset($_GET['id']) ? $_GET['id'] : 1;
                                $start=($id-1)*$limit;
                                
                                // اضافه کردن LEFT JOIN برای دریافت میزان تحویل
                                $query = "SELECT a.id,a.bah_cod_m,a.sh_gat,a.no_kesh,a.cod_mah,a.zer_kesht_a,a.zer_kesht_b,a.mah_tolp,a.s_bar_a,a.s_bar_b,a.mah_tol,a.add_abadi,a.mah_kh,a.id_ostan,a.id_city,a.id_mar,
                                          d.delivery_amount 
                                          FROM $Agri_prod_table a
                                          LEFT JOIN delivery d ON a.id = d.Agri_id
                                          WHERE $v_id_ostan AND $v_id_city AND $v_id_mar AND $f_add_abadi AND $f_add_city 
                                          AND $f_no_kesh AND $v_mor_cod_m AND $v_bah_cod_m AND $v_z_sal AND $v_cod_mah AND $v_mah_tol AND $v_dis 
                                          ORDER BY a.bah_cod_m,a.sh_gat ASC LIMIT $start, $limit"; 
                                
                                $query1 = "SELECT COUNT(*) FROM $Agri_prod_table a
                                           WHERE $v_id_ostan AND $v_id_city AND $v_id_mar AND $f_add_abadi AND $f_add_city 
                                           AND $f_no_kesh AND $v_mor_cod_m AND $v_bah_cod_m AND $v_z_sal AND $v_cod_mah AND $v_mah_tol AND $v_dis";
                                           
                                $stmt = $dbh->prepare($query);
                                $stmt->execute();
                                $t_row = $stmt -> rowCount() ; 
                                if ($t_row>0) { ;
                                ?>
                                <br />
                                <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                                
                                <!-- دکمه خروجی اکسل - مشابه Agri_deleted.php -->
                                <table width="62" height="56" border="0" align="center">
                                    <tr>
                                        <td width="56">
                                            <form action="delivery_export_excel.php" method="post">
                                                <input type="hidden" name="action" value="1" />
                                                <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
                                                <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1; ?>" />
                                                <input type="hidden" name="id_city5" value="<?php echo $id_city; ?>" />
                                                <input type="hidden" name="id_mar" value="<?php echo $id_mar; ?>" />
                                                <input type="hidden" name="add_abadi" value="<?php echo $add_abadi; ?>" />
                                                <input type="hidden" name="add_city" value="<?php echo $add_city; ?>" />
                                                <input type="hidden" name="no_kesh" value="<?php echo $no_kesh; ?>" />
                                                <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m; ?>" />
                                                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" />
                                                <input type="hidden" name="dis" value="<?php echo $dis; ?>" />
                                                <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل" width="44" height="45" alt=""/></button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                                <br />
                                
                                <table align="center" class="my-table" >
                                    <!-- ردیف اول عنوان جدول -->
                                    <tr class="header-row">
                                        <td bgcolor="#3399CC" style="width:8%;">میزان تحویلی به دولت<br><span class="style2">تن</span></td>
                                        <td bgcolor="#3399CC" style="width:7%;">میزان تولید قطعی<br><span class="style2">تن</span></td>
                                        <td colspan="2" bgcolor="#3399CC" style="width:15%;">سطح برداشت <br><span class="style2">هکتار</span></td>
                                        <td bgcolor="#3399CC" style="width:7%;">نام محصول</td>
                                        <td bgcolor="#3399CC" style="width:5%;">نوع کشت</td>
                                        <td bgcolor="#3399CC" style="width:5%;">شماره قطعه</td>
                                        <td colspan="2" bgcolor="#3399CC" style="width:20%;">مشخصات بهره بردار</td>
                                        <td bgcolor="#3399CC" style="width:4%;">ردیف</td>
                                    </tr>
                                    <!-- ردیف دوم عنوان جدول -->
                                    <tr class="header-row">
                                        <td bgcolor="#3399CC" style="width:8%;">&nbsp;</td>
                                        <td bgcolor="#3399CC" style="width:7%;">&nbsp;</td>
                                        <td bgcolor="#3399CC" style="width:7%;">دوم</td>
                                        <td bgcolor="#3399CC" style="width:8%;">اول</td>
                                        <td bgcolor="#3399CC" style="width:7%;">&nbsp;</td>
                                        <td bgcolor="#3399CC" style="width:5%;">&nbsp;</td>
                                        <td bgcolor="#3399CC" style="width:5%;">&nbsp;</td>
                                        <td bgcolor="#3399CC" style="width:10%;">کد ملی</td>
                                        <td bgcolor="#3399CC" style="width:10%;">نام و نام خانوادگی</td>
                                        <td bgcolor="#3399CC" style="width:4%;">&nbsp;</td>
                                    </tr>
                                    <?php 
                                    $r = 1 ;
                                    foreach($stmt as $row){ 
                                        if ($row['no_kesh']=='1') $v_no_kesh='آبی';     
                                        if ($row['no_kesh']=='2') $v_no_kesh='دیم';
                                    ?>
                                    <tr <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                                        <!-- ستون میزان تحویلی -->
                                        <td>
                                            <input type="text" class="delivery-display" 
                                                   value="<?php echo isset($row['delivery_amount']) ? number_format($row['delivery_amount'], 2) : '0.00'; ?>" 
                                                   readonly="readonly" />
                                        </td>
                                        <!-- ستون میزان تولید قطعی -->
                                        <td>
                                            <input name="mah_tol_display" type="text" class="readonly-field" 
                                                   value="<?php echo number_format($row['mah_tol']*1, 2); ?>" readonly="readonly" style="width:60px;height:28px;" />
                                        </td>
                                        <!-- ستون سطح برداشت دوم -->
                                        <td>
                                            <input name="s_bar_b_display" type="text" class="readonly-field" 
                                                   value="<?php echo number_format($row['s_bar_b']*1, 2); ?>" readonly="readonly" style="width:60px;height:28px;" />
                                        </td>
                                        <!-- ستون سطح برداشت اول -->
                                        <td>
                                            <input name="s_bar_a_display" type="text" class="readonly-field" 
                                                   value="<?php echo number_format($row['s_bar_a']*1, 2); ?>" readonly="readonly" style="width:60px;height:28px;" />
                                        </td>
                                        <!-- ستون نام محصول -->
                                        <td class="normalTextSmall">
                                            <?php echo mah_name($row['cod_mah']); ?>
                                        </td>
                                        <!-- ستون نوع کشت -->
                                        <td class="normalTextSmall">
                                            <?php echo $v_no_kesh?>
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
                                    <form action="delivery.php?id=<?php echo $id-1 ?>#1" method="post">
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
                                    <form action="delivery.php?id=<?php echo $id+1 ?>#1" method="post">
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
                                        <form action="delivery.php?id=<?php echo $i?>#1" method="post">
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