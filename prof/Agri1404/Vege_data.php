<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$check = 1 ;

// بررسی اولیه وضعیت بهره‌بردار
if(isset($_POST['bah_cod_m']))
{
    $bah_cod_m = $_POST['bah_cod_m'];
    $query = "SELECT ok from bah where bah_cod_m = :bah_cod_m ";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
    $found = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ok = $row['ok'] ;
    if($ok=='2')
    {
        echo "<script>alert('بهره بردار در قید حیات نمیباشد !! امکان ثبت اطلاعات مقدور نیست');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit;
    }
    if($ok=='4')
    {
        echo "<script>alert('اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ثبت اطلاعات مقدور نمیباشد');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit;
    }
}

// --------------------------------------------------------------------------------------------------------------------------------------
// بخش پردازش اطلاعات فرم
if (isset($_POST['action']) and !empty($_POST['id_mar']))
{
    $date_s = $date_edit ;
    $mor_cod_m = $login_session ;
    $bah_cod_m = $b_time = $add_city = $add_abadi = $id_ostan = $id_city = $id_mar = $m_zamin = $lng = $lat = $m_cod_m = $no_bah = $t_mah = $z_sal = $m_ab = null;

    if (isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'];
    if (isset($_POST['b_time'])) $b_time = $_POST['b_time'];
    if (isset($_POST['add_city'])) $add_city = $_POST['add_city'];
    if (isset($_POST['add_abadi'])) $add_abadi = $_POST['add_abadi'];
    if (isset($_POST['id_ostan'])) $id_ostan = $_POST['id_ostan'];
    if (isset($_POST['id_city'])) $id_city = $_POST['id_city'];
    if (isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'];
    if (isset($_POST['m_zamin'])) $m_zamin = $_POST['m_zamin'];
    if (isset($_POST['lng'])) $lng = $_POST['lng'];
    if (isset($_POST['lat'])) $lat = $_POST['lat'];
    if (isset($_POST['m_cod_m'])) $m_cod_m = $_POST['m_cod_m'];
    if (isset($_POST['no_bah'])) $no_bah = $_POST['no_bah'];
    if (isset($_POST['t_mah'])) $t_mah = $_POST['t_mah'];
    if (isset($_POST['z_sal'])) $z_sal = $_POST['z_sal'];
    if (isset($_POST['m_ab'])) $m_ab = $_POST['m_ab'];

    if ($lng > 99) $lng = 0;
    if ($lat > 99) $lat = 0;
    if($check==1) {
        $query = "SELECT max(`sh_gat`) as `max_shgat` FROM `Vege` WHERE  bah_cod_m= '$bah_cod_m' and z_sal= '$z_sal' and no_bah = '$no_bah'";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $t_gat =  $row['max_shgat'] ;
        $sh_gat = $t_gat + 1 ;
    }

    $successful_products_count = 0;
    $error_message = '';
    $products_to_insert = array();
    $temp_zer_kesht_for_this_form = array();

    // مرحله اول: اعتبارسنجی تمامی محصولات قبل از هرگونه ثبت در دیتابیس
    $num3_t_mah = $t_mah;
    while ($num3_t_mah > 0) {
        if (isset($_POST['mah_mas' . $num3_t_mah])) {
            $zer_kesht = $_POST['mah_mas' . $num3_t_mah];
            $cod_mah = $_POST['cod_mah' . $num3_t_mah];

            // اگر کد محصول هنوز در آرایه موقت ثبت نشده، آن را با مقدار 0 مقداردهی اولیه می‌کنیم
            if (!isset($temp_zer_kesht_for_this_form[$cod_mah])) {
                $temp_zer_kesht_for_this_form[$cod_mah] = 0;
            }

            // بررسی سقف مجاز
            $is_validation_needed = ($z_sal != '1403-1404');

            $is_valid_product = true;
            if ($is_validation_needed) {
                $query_sum = "SELECT SUM(zer_kesht) as total_zer_kesht FROM Vege_prod WHERE id_ostan = :id_ostan AND id_city = :id_city AND id_mar = :id_mar AND z_sal = :z_sal AND cod_mah = :cod_mah";
                $stmt_sum = $dbh->prepare($query_sum);
                $stmt_sum->execute(array(':id_ostan' => $id_ostan, ':id_city' => $id_city, ':id_mar' => $id_mar, ':z_sal' => $z_sal, ':cod_mah' => $cod_mah));
                $row_sum = $stmt_sum->fetch(PDO::FETCH_ASSOC);
                $current_db_total = $row_sum['total_zer_kesht'] ? $row_sum['total_zer_kesht'] : 0;
                
                $query_abi = "SELECT s_abi FROM Agri_ab_mar WHERE id_ostan = :id_ostan AND id_city = :id_city AND id_mar = :id_mar AND z_sal = :z_sal AND product_cod = :cod_mah";
                $stmt_abi = $dbh->prepare($query_abi);
                $stmt_abi->execute(array(':id_ostan' => $id_ostan, ':id_city' => $id_city, ':id_mar' => $id_mar, ':z_sal' => $z_sal, ':cod_mah' => $cod_mah));
                $row_abi = $stmt_abi->fetch(PDO::FETCH_ASSOC);
                $s_abi_limit = $row_abi['s_abi'];

                // بررسی سقف مجاز با در نظر گرفتن مجموع از دیتابیس و محصولات فعلی فرم
                if (($current_db_total + $temp_zer_kesht_for_this_form[$cod_mah] + $zer_kesht) > $s_abi_limit) {
                    $error_message .= "خطا: سقف مجاز برای ثبت محصول : " . mah_name($cod_mah) . " پر شده است. این مورد ثبت نشد.\\n";
                    $is_valid_product = false;
                }
            }

            // اگر محصول معتبر بود، به لیست محصولات برای ثبت نهایی اضافه می‌شود
            if ($is_valid_product) {
                // مجموع موقت مساحت این محصول در فرم را به‌روزرسانی می‌کنیم
                $temp_zer_kesht_for_this_form[$cod_mah] += $zer_kesht;
                
                $no_ab = $_POST['no_ab'.$num3_t_mah] ;
                $mah_bem = $_POST['mah_bem'.$num3_t_mah] ;
                $ragham = isset($_POST['ragham'.$num3_t_mah]) ? $_POST['ragham'.$num3_t_mah] : '';
                $ra_kesh = $_POST['ra_kesh'.$num3_t_mah] ;
                $sal_ab = isset($_POST['sal_ab'.$num3_t_mah]) ? $_POST['sal_ab'.$num3_t_mah] : '';
                $mah_ab = $_POST['mah_ab'.$num3_t_mah] ;
                $roz_ab = $_POST['roz_ab'.$num3_t_mah] ;
                $date_ab = $sal_ab.'/'.$mah_ab.'/'.$roz_ab ;

                array_push($products_to_insert, array(
                    'zer_kesht' => $zer_kesht,
                    'cod_mah' => $cod_mah,
                    'no_ab' => $no_ab,
                    'mah_bem' => $mah_bem,
                    'ragham' => $ragham,
                    'ra_kesh' => $ra_kesh,
                    'sal_ab' => $sal_ab,
                    'mah_ab' => $mah_ab,
                    'roz_ab' => $roz_ab,
                    'date_ab' => $date_ab
                ));
                $successful_products_count++;
            }
        }
        $num3_t_mah--;
    }

    // مرحله دوم: اگر حداقل یک محصول معتبر وجود دارد، عملیات ثبت را انجام دهید
    if ($successful_products_count > 0) {
        try {
            $dbh->beginTransaction();

            // ثبت رکورد اصلی در جدول Vege
            $query = "INSERT INTO Vege (date_s,mor_cod_m,bah_cod_m,b_time,no_bah,sh_gat,id_ostan,id_city,id_mar,add_abadi,add_city,m_zamin,lng,lat,m_ab,z_sal,t_mah)
            VALUES(:date_s,:mor_cod_m,:bah_cod_m,:b_time,:no_bah,:sh_gat,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:m_zamin,:lng,:lat,:m_ab,:z_sal,:t_mah)";
            $q = $dbh->prepare($query);
            $q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':bah_cod_m'=>$bah_cod_m,':b_time'=>$b_time,':no_bah'=>$no_bah,':sh_gat'=>$sh_gat,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':m_zamin'=>$m_zamin,':lng'=>$lng,':lat'=>$lat,':m_ab'=>$m_ab,':z_sal'=>$z_sal,':t_mah'=>$successful_products_count));
            $Vege_id = Vege_id($bah_cod_m,$sh_gat,$z_sal,$mor_cod_m,$date_s);

            // ثبت محصولات معتبر در جدول Vege_prod
            foreach ($products_to_insert as $product) {
                $query = "INSERT INTO Vege_prod (Vege_id,date_s,mor_cod_m,bah_cod_m,b_time,no_bah,sh_gat,id_ostan,id_city,id_mar,add_abadi,add_city,z_sal,ra_kesh,cod_mah,zer_kesht,mah_bem,ragham,no_ab,sal_ab,mah_ab,roz_ab,date_ab)
                VALUES(:Vege_id,:date_s,:mor_cod_m,:bah_cod_m,:b_time,:no_bah,:sh_gat,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:z_sal,:ra_kesh,:cod_mah,:zer_kesht,:mah_bem,:ragham,:no_ab,:sal_ab,:mah_ab,:roz_ab,:date_ab)";
                $q = $dbh->prepare($query);
                $q->execute(array(':Vege_id'=>$Vege_id,':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':bah_cod_m'=>$bah_cod_m,':b_time'=>$b_time,':no_bah'=>$no_bah,':sh_gat'=>$sh_gat,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':z_sal'=>$z_sal,':ra_kesh'=>$product['ra_kesh'],':cod_mah'=>$product['cod_mah'],':zer_kesht'=>$product['zer_kesht'],':mah_bem'=>$product['mah_bem'],':ragham'=>$product['ragham'],':no_ab'=>$product['no_ab'],':sal_ab'=>$product['sal_ab'],':mah_ab'=>$product['mah_ab'],':roz_ab'=>$product['roz_ab'],':date_ab'=>$product['date_ab']));
            }

            sabt_event($login_session, getUserIP_1(), $date_edit, $time, $add_abadi, 'ثبت اطلاعات صیفی - ' . $bah_cod_m, $id_ostan);
            $dbh->commit();
            $success_message = "اطلاعات " . $successful_products_count . " محصول با موفقیت ثبت شد.";
            echo "<script>alert('{$success_message}\\n{$error_message}');</script>";
            echo "<script>window.location.href = 'index.php';</script>";

        } catch (PDOException $e) {
            $dbh->rollBack();
            echo "<script>alert('خطای پایگاه داده: {$e->getMessage()}');</script>";
            echo "<script>window.location.href = 'Vege.php';</script>";
        }
    } else {
        // اگر هیچ محصولی برای ثبت وجود ندارد، فقط پیام خطا نمایش داده می‌شود
        echo "<script>alert('{$error_message}هیچ محصولی ثبت نشد.');</script>";
        echo "<script>window.location.href = 'Vege.php';</script>";
    }
}
// --------------------------------------------------------------------------------------------------------------------------------------
// بخش نمایش فرم
else if  (isset($_POST['bah_cod_m']))
{
    $date_s = date_con(jdate("Y/m/d"));
    $no_bah = $_POST['no_bah'] ;
    $add_abadi = $_POST["add_abadi"];
    $add_city = $_POST["add_city"];
    $bah_cod_m = $_POST['bah_cod_m'];
    if(isset($_POST['m_poul'])) $m_poul = $_POST['m_poul'];
    if(isset($_POST['b_time'])) $b_time = $_POST['b_time'];
    if ($b_time=='1')  $v_b_time='زمستانه/استمرار';
    if ($b_time=='2')  $v_b_time='بهاره';
    if ($b_time=='3')  $v_b_time='تابستانه';
    if ($b_time=='4')  $v_b_time='پاییزه';
    $z_sal = $_POST['z_sal'];
    if(isset($_POST['mah1'])) $mah1 = $_POST['mah1'];
    if(isset($_POST['mah2'])) $mah2 = $_POST['mah2'];
    if(isset($_POST['mah3'])) $mah3 = $_POST['mah3'];
    if(isset($_POST['t_kind'])) $t_kind = $_POST['t_kind'];
    if(isset($_POST['m_ab'])) $m_ab = $_POST['m_ab'] ;
    $name_mah = array() ;
    $t_mah = 0 ;
    if ($mah1=='1') { $t_mah = $t_mah + 1 ;  $name_mah[] = array('گوجه فرنگی','174')  ; }
    if ($mah2=='1') { $t_mah = $t_mah + 1 ;  $name_mah[] = array('پیاز','172'); }
    if ($mah3=='1') { $t_mah= $t_mah + $t_kind ;  while ($t_kind > 0){ $name_mah[]=array('سیب زمینی','170') ; $t_kind-- ; }}
    if ($m_ab=='1')  $v_m_ab='چشمه';
    if ($m_ab=='2')  $v_m_ab='قنات';
    if ($m_ab=='3')  $v_m_ab='رودخانه';
    if ($m_ab=='4')  $v_m_ab='سد';
    if ($m_ab=='5')  $v_m_ab='چاه سطحی';
    if ($m_ab=='6')  $v_m_ab='چاه عمیق';
    if ($m_ab=='7')  $v_m_ab='چاه نیمه عمیق';
    if ($m_ab=='8')  $v_m_ab='زهکش';
    if ($m_ab=='9')  $v_m_ab='پساب';
    if ($m_ab=='10')  $v_m_ab='آب بندان' ;
    if ($m_ab=='11')  $v_m_ab='سایر' ;
    $num_t_mah = $t_mah ;
    if ($m_poul=='abadi') {
        $add_city = '-';
    }
    if  ($m_poul=='shahr') {
        $add_abadi = '-';
    }
    $sal_ab = $ragham = '' ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php if(isset($title)) echo $title ;?></title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td>
      <?php include('top.php'); ?>
           <p class="style8">ثبت اطلاعات محصولات عمده صیفی</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
      <?php sar_data2($bah_cod_m,$no_bah) ;?>
      <br />
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1">
      <table width="99%" height="517" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="31%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?></div></td>
          <td width="20%"><div align="right">:شهرستان</div></td>
          <td width="1%">&nbsp;</td>
          <td width="30%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
          </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo $v_m_ab; ?></div></td>
          <td><div align="right">:منبع آب</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo $v_b_time; ?></div></td>
          <td><div style="margin-right:30px" align="right" >:فصل تولید</div></td>
        </tr>
        <tr>
          <td height="63"><div align="right">
            <span class="style2">درجه اعشار</span>
            <input name="lat" type="text" class="number input_text" id="lat" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php if(isset($lat)) echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td><div align="right">:Y عرض جغرافیایی</div></td>
          <td>&nbsp;</td>
          <td><div align="right"><span class="style2">درجه اعشار</span>
<input name="lng" type="text" class="number input_text" id="lng" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php if(isset($lng)) echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
        </tr>
        <tr>
          <td height="49" colspan="3"><div align="right" class="input_text"> مجموع سطح زیر کشت سه محصول شامل گوجه فرنگی ، پیاز و سیب زمینی درج گردد </div></td>
          <td height="49"><div align="right"><span class="style2"> هکتار</span>
            <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php if(isset($m_zamin)) echo $m_zamin ; ?>" maxlength="11"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:کل سطح زیر کشت</div></td>
        </tr>
        <tr>
          <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong> <?php echo $z_sal ;?> : اطلاعات کاشت سال زراعی </strong></div></td>
        </tr>
        <tr>
          <td height="101" colspan="5"><table width="100%" height="101" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="13%" height="19" bgcolor="#FFFFCC">محصول بیمه هست ؟</td>
              <td width="21%" bgcolor="#FFFFCC">تاریخ اولین آبیاری<br />
               <span class="style8">روز / ماه / سال</span></td>
               <td width="15%" bgcolor="#FFFFCC">روش آبیاری</td>
              <td width="12%" bgcolor="#FFFFCC">روش کشت</td>
              <td width="14%" bgcolor="#FFFFCC">نوع رقم</td>
              <td width="8%" bgcolor="#FFFFCC">سطح زیر کشت<br />
                <span class="style2">هکتار</span></td>
              <td width="12%" bgcolor="#FFFFCC">نام محصول</td>
              <td width="5%" bgcolor="#FFFFCC">ردیف</td>
              </tr>
            <?php
$n = 1 ;
$num2_t_mah = $t_mah ;
while ($num2_t_mah > 0){
?>
            <tr>
              <td height="51" bgcolor="#FFFFFF"><div align="center">
                <select name="mah_bem<?php echo $num2_t_mah ;?>" class="required input_text  required" id="mah_bem<?php echo $num2_t_mah ;?>"  style="height:40px ; width:100px ; direction:rtl" tabindex="12">
                  <option value="">انتخاب کنید</option>
                  <option value="1">بلی</option>
                  <option value="2">خیر</option>
                </select>
                </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <select name="sal_ab<?php echo $num2_t_mah ?>" class="input_text  required" id="sal<?php echo $num2_t_mah ?>"  style="height:35px ; width:50px ; direction:rtl" tabindex="11">
                  <option value="">--</option>
                  <option value="1405" <?php if ($sal_ab=='1405') { echo 'selected="selected"' ; } ?>>1405</option>
                  <option value="1404" <?php if ($sal_ab=='1404') { echo 'selected="selected"' ; } ?>>1404</option>
                  <option value="1403" <?php if ($sal_ab=='1403') { echo 'selected="selected"' ; }?>>1403</option>
                  </select>
                /
                <select name="mah_ab<?php echo $num2_t_mah ?>" class="input_text  required" id="mah<?php echo $num2_t_mah ?>"  style="height:35px ; width:40px ; direction:rtl" tabindex="10">
                  <option value="">--</option>
                  <option value="01">01</option>
                  <option value="02">02</option>
                  <option value="03">03</option>
                  <option value="04">04</option>
                  <option value="05">05</option>
                  <option value="06">06</option>
                  <option value="07">07</option>
                  <option value="08">08</option>
                  <option value="09">09</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  </select>
                /
                <select name="roz_ab<?php echo $num2_t_mah ?>" class="input_text  required" id="roz<?php echo $num2_t_mah ?>"  style="height:35px ; width:40px ; direction:rtl" tabindex="9">
                  <option value="">--</option>
                  <option value="01">01</option>
                  <option value="02">02</option>
                  <option value="03">03</option>
                  <option value="04">04</option>
                  <option value="05">05</option>
                  <option value="06">06</option>
                  <option value="07">07</option>
                  <option value="08">08</option>
                  <option value="09">09</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  </select>
                </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <select name="no_ab<?php echo $num2_t_mah ?>" class="input_text  required" id="no_ab<?php echo $num2_t_mah ?>"  style="height:40px ; width:120px ; direction:rtl" tabindex="8">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if (isset($no_ab) and $no_ab=='1') { echo 'selected="selected"' ; }?>>نواری</option>
                  <option value="2" <?php if (isset($no_ab) and $no_ab=='2') { echo 'selected="selected"' ; }?>>غرقابی</option>
                  <option value="3" <?php if (isset($no_ab) and $no_ab=='3') { echo 'selected="selected"' ; }?>>قطره ای</option>
                  <option value="4" <?php if (isset($no_ab) and $no_ab=='4') { echo 'selected="selected"' ; }?>>بارانی</option>
                  <option value="5" <?php if (isset($no_ab) and $no_ab=='5') { echo 'selected="selected"' ; }?>>سایر</option>
                  </select>
                </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <select name="ra_kesh<?php echo $num2_t_mah ?>" id="no_kesht<?php echo $num2_t_mah ?>" class="input_text  required"  style="height:40px ; width:80px ; direction:rtl" tabindex="7">
<?php if ($name_mah[$n-1][0]=='سیب زمینی') {?>
                  <option value="2">مستقیم</option>
<?php } else {?>
                  <option value="">انتخاب کنید</option>
                  <option value="1">نشایی</option>
                  <option value="2">مستقیم</option>
<?php }?>
<?php if ($name_mah[$n-1][0]=='گوجه فرنگی') {?>
                  <option value="3">نشایی با مالچ</option>
                  <option value="4">مستقیم با مالچ</option>
<?php }?>
                  </select>
                </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <select name="ragham<?php echo $num2_t_mah ?>" id="ragham<?php echo $num2_t_mah ?>" class="input_text  required"  style="height:40px ; width:100px ; direction:rtl" tabindex="6">
<?php
switch ($name_mah[$n-1][0]) {
    case "گوجه فرنگی":
?>
        <option value="-">-----</option>
<?php
        break;
    case "پیاز":
?>
      <option value="">انتخاب کنید</option>
      <option value="1" <?php if ($ragham=='1') { echo 'selected="selected"' ; }?>>قرمز</option>
      <option value="2" <?php if ($ragham=='2') { echo 'selected="selected"' ; }?>>سفید</option>
      <option value="3" <?php if ($ragham=='3') { echo 'selected="selected"' ; }?>>زرد</option>
      <option value="4" <?php if ($ragham=='4') { echo 'selected="selected"' ; }?>>صورتی</option>
<?php
        break;
    case "سیب زمینی":
?>
      <option value="">انتخاب کنید</option>
      <option value="1" <?php if ($ragham=='1') { echo 'selected="selected"' ; }?>>اگریا</option>
      <option value="2" <?php if ($ragham=='2') { echo 'selected="selected"' ; }?>>سانته</option>
      <option value="3" <?php if ($ragham=='3') { echo 'selected="selected"' ; }?>>ساتینا</option>
      <option value="4" <?php if ($ragham=='4') { echo 'selected="selected"' ; }?>>میلوا</option>
      <option value="5" <?php if ($ragham=='5') { echo 'selected="selected"' ; }?>>بورن</option>
      <option value="6" <?php if ($ragham=='6') { echo 'selected="selected"' ; }?>>ساوالان</option>
      <option value="7" <?php if ($ragham=='7') { echo 'selected="selected"' ; }?>>آرنیدا</option>
      <option value="8" <?php if ($ragham=='8') { echo 'selected="selected"' ; }?>>بانبا</option>
      <option value="9" <?php if ($ragham=='9') { echo 'selected="selected"' ; }?>>مارفونا</option>
      <option value="10" <?php if ($ragham=='10') { echo 'selected="selected"' ; }?>>فونتانه</option>
      <option value="11" <?php if ($ragham=='11') { echo 'selected="selected"' ; }?>>راموس</option>
      <option value="12" <?php if ($ragham=='12') { echo 'selected="selected"' ; }?>>پیکاسو</option>
      <option value="13" <?php if ($ragham=='13') { echo 'selected="selected"' ; }?>>جلی</option>
      <option value="14" <?php if ($ragham=='14') { echo 'selected="selected"' ; }?>>سایر</option>
<?php
}
?>
                  </select>
                </div></td>
              <td class="style8" bgcolor="#FFFFFF"><div align="center">
                <input name="mah_mas<?php echo $num2_t_mah ;?>" type="text" class="mashat required number input_text" id="mashat<?php echo $num2_t_mah ;?>" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php $mah_mas ;?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td class="style8" bgcolor="#FFFFFF"><div align="center">
                <input name="mah_name<?php echo $num2_t_mah ;?>" type="text" class="mah_name required  style8" id="mah_name<?php echo $num2_t_mah ;?>2" style="width:75px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo  $name_mah[$n-1][0] ; ?>" maxlength="10" readonly  align="baseline" xml:lang="fa" />
              <input type="hidden" name="cod_mah<?php echo $num2_t_mah ;?>" value=<?php echo $name_mah[$n-1][1]; ?> />
                </div>
              </td>
              <td bgcolor="#FFFFFF"><?php echo $n ;?></td>
              </tr><?php
 $num2_t_mah--;
 $n++ ;
}
?>
            </table></td>
        </tr>
        <tr>
          <td height="52" colspan="4"><div align="right"><span class="style2">هکتار</span>
            <input name="traz" id="traz" type="text"  disabled="disabled" style="width:100px; height:30px ; " tabindex="32" dir="rtl" lang="fa"  maxlength="70"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:10px" align="right">: تراز مساحت</div></td>
        </tr>
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="no_bah" value=<?php echo $no_bah ; ?> />
     <input type="hidden" name="b_time" value=<?php echo $b_time ; ?> />
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m ; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan ; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city ; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi ; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city ; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar ; ?> />
     <input type="hidden" name="t_mah" value=<?php echo $t_mah ; ?> />
     <input type="hidden" name="z_sal" value=<?php echo $z_sal ; ?> />
     <input type="hidden" name="m_ab"  value=<?php echo $m_ab ; ?> />
    <input type="submit" name="action" value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="33" id="submit" onClick="setTimeout(disableFunction, 1);"/>
    <a href="Vege.php">
    <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="22" /></a>
        </p>
      </div>
<p align="center" >&nbsp;</p>
</form>
<script>
function disableFunction() {
    document.getElementById("submit").disabled = 'true';
	$("#submit").attr("disabled","");
}
</script>
  </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
   </tr>
</table>
</table>
</body>
</html>
<script>
	$('.mashat').change(function () {
    var sum = 0;
    $('.mashat').each(function() {
        sum += Number($(this).val());
    });
    var kol = document.getElementById("m_zamin").value;
    $('#kol').val(kol);
    var def = kol - sum ;
    $('#traz').val(def);
if( def < 0 ){
   alert("خطا! \n \n  دقت تراز مساحت منفی است");
   document.getElementById("submit").disabled = true;
}
if( def >= 0 ){
   document.getElementById("submit").disabled = false ;
}
});
</script>
<?php
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Vege.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>