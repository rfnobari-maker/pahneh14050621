<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
 if (isset($_POST['action']) and $_POST['id_mar'] !='') 
 {  
$sh_gat = $_POST['sh_gat'] ;
$id = $_POST['id']; 
$date_s = $date_edit ;
$mor_cod_m = $login_session ;
$bah_cod_m = $_POST['bah_cod_m']; 
$b_time = $_POST['b_time']; 
$add_city = $_POST['add_city'] ;
$add_abadi = $_POST['add_abadi'] ;
$id_ostan = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ;
$m_zamin = $_POST['m_zamin'] ;
$lng = $_POST['lng'] ;
$lat = $_POST['lat'] ;
if ($lng>99) $lng = 0 ; 
if ($lat>99) $lat = 0 ; 
$m_cod_m = $_POST['m_cod_m'] ;
$no_bah = $_POST['no_bah'] ;
$t_mah = $_POST['t_mah'] ;
$z_sal = $_POST['z_sal'] ;
$m_ab = $_POST['m_ab'] ;

// --- شروع اعتبارسنجی سقف همانند Vege_data ---
$successful_products_count = 0;
$error_message = '';
$products_to_insert = array();
$temp_zer_kesht_for_this_form = array();

$is_validation_needed = ($z_sal != '1403-1404');
$num3_validate = $t_mah;
while ($num3_validate > 0) {
    if (isset($_POST['mah_mas' . $num3_validate])) {
        $zer_kesht = floatval($_POST['mah_mas' . $num3_validate]);
        $cod_mah = $_POST['cod_mah' . $num3_validate];
        if (!isset($temp_zer_kesht_for_this_form[$cod_mah])) {
            $temp_zer_kesht_for_this_form[$cod_mah] = 0;
        }
        $is_valid_product = true;
        if ($is_validation_needed) {
            $query_sum = "SELECT SUM(zer_kesht) AS total_zer_kesht
                          FROM Vege_prod
                          WHERE id_ostan = :id_ostan AND id_city = :id_city AND id_mar = :id_mar
                            AND z_sal = :z_sal AND cod_mah = :cod_mah AND Vege_id <> :Vege_id";
            $stmt_sum = $dbh->prepare($query_sum);
            $stmt_sum->execute(array(
                ':id_ostan' => $id_ostan,
                ':id_city'  => $id_city,
                ':id_mar'   => $id_mar,
                ':z_sal'    => $z_sal,
                ':cod_mah'  => $cod_mah,
                ':Vege_id'  => $id
            ));
            $row_sum = $stmt_sum->fetch(PDO::FETCH_ASSOC);
            $current_db_total = ($row_sum && $row_sum['total_zer_kesht']) ? floatval($row_sum['total_zer_kesht']) : 0;
            $query_abi = "SELECT s_abi FROM Agri_ab_mar
                          WHERE id_ostan = :id_ostan AND id_city = :id_city AND id_mar = :id_mar
                            AND z_sal = :z_sal AND product_cod = :cod_mah";
            $stmt_abi = $dbh->prepare($query_abi);
            $stmt_abi->execute(array(
                ':id_ostan' => $id_ostan,
                ':id_city'  => $id_city,
                ':id_mar'   => $id_mar,
                ':z_sal'    => $z_sal,
                ':cod_mah'  => $cod_mah
            ));
            $row_abi = $stmt_abi->fetch(PDO::FETCH_ASSOC);
            $s_abi_limit = $row_abi ? floatval($row_abi['s_abi']) : null;
            if ($s_abi_limit !== null && ($current_db_total + $temp_zer_kesht_for_this_form[$cod_mah] + $zer_kesht) > $s_abi_limit) {
                $error_message .= "خطا: سقف مجاز برای ثبت محصول : " . mah_name($cod_mah) . " پر شده است. این مورد ثبت نشد.\\n";
                $is_valid_product = false;
            }
        }
        if ($is_valid_product) {
            $ragham = isset($_POST['ragham' . $num3_validate]) ? $_POST['ragham' . $num3_validate] : '';
            $no_ab  = isset($_POST['no_ab'  . $num3_validate]) ? $_POST['no_ab'  . $num3_validate] : '';
            $sal_ab = isset($_POST['sal_ab' . $num3_validate]) ? $_POST['sal_ab' . $num3_validate] : '';
            $mah_ab = isset($_POST['mah_ab' . $num3_validate]) ? $_POST['mah_ab' . $num3_validate] : '';
            $roz_ab = isset($_POST['roz_ab' . $num3_validate]) ? $_POST['roz_ab' . $num3_validate] : '';
            $mah_bem = isset($_POST['mah_bem' . $num3_validate]) ? $_POST['mah_bem' . $num3_validate] : '';
            $ra_kesh = isset($_POST['ra_kesh' . $num3_validate]) ? $_POST['ra_kesh' . $num3_validate] : '';
            $products_to_insert[] = array(
                'cod_mah'   => $cod_mah,
                'zer_kesht' => $zer_kesht,
                'mah_bem'   => $mah_bem,
                'ragham'    => $ragham,
                'no_ab'     => $no_ab,
                'sal_ab'    => $sal_ab,
                'mah_ab'    => $mah_ab,
                'roz_ab'    => $roz_ab,
                'ra_kesh'   => $ra_kesh
            );
            $temp_zer_kesht_for_this_form[$cod_mah] += $zer_kesht;
            $successful_products_count++;
        }
    }
    $num3_validate--;
}

if ($is_validation_needed && $error_message != '') {
    echo "<script>alert('".$error_message."');</script>";
?>
<form  name="myform" class="myform" method="post" action="liste_Vege.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
    exit;
}

// --- پایان اعتبارسنجی سقف ---

// عملیات حذف و درج مجدد در یک تراکنش برای اتمیک بودن
try {
    $dbh->beginTransaction();
    $Vege_id = $id ; 
    $sql = "DELETE FROM Vege_prod WHERE Vege_id =  :Vege_id";
    $stmt =  $dbh->prepare($sql);
    $stmt->bindParam(':Vege_id', $id, PDO::PARAM_INT);   
    $stmt->execute();

    // درج اقلام معتبر
    foreach ($products_to_insert as $product) {
        $no_ab    = $product['no_ab'];
        $zer_kesht= $product['zer_kesht'];
        $cod_mah  = $product['cod_mah'];
        $mah_bem  = $product['mah_bem'];
        $ragham   = $product['ragham'];
        $ra_kesh  = $product['ra_kesh'];
        $sal_ab   = $product['sal_ab'];
        $mah_ab   = $product['mah_ab'];
        $roz_ab   = $product['roz_ab'];
        $date_ab = $sal_ab.'/'.$mah_ab.'/'.$roz_ab ;

        $query = "INSERT INTO Vege_prod (
Vege_id,date_s,mor_cod_m,bah_cod_m,b_time,no_bah,sh_gat,id_ostan,id_city,id_mar,add_abadi,add_city,z_sal,ra_kesh,cod_mah,zer_kesht,mah_bem,ragham,no_ab,sal_ab,mah_ab,roz_ab,date_ab)  
VALUES(:Vege_id,:date_s,:mor_cod_m,:bah_cod_m,:b_time,:no_bah,:sh_gat,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:z_sal,:ra_kesh,:cod_mah,:zer_kesht,:mah_bem,:ragham,:no_ab,:sal_ab,:mah_ab,:roz_ab,:date_ab)";
$q = $dbh->prepare($query);
$q->execute(array(':Vege_id'=>$Vege_id,':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':bah_cod_m'=>$bah_cod_m,':b_time'=>$b_time,':no_bah'=>$no_bah,':sh_gat'=>$sh_gat,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':z_sal'=>$z_sal,':ra_kesh'=>$ra_kesh,':cod_mah'=>$cod_mah,':zer_kesht'=>$zer_kesht,':mah_bem'=>$mah_bem,':ragham'=>$ragham,':no_ab'=>$no_ab,':sal_ab'=>$sal_ab,':mah_ab'=>$mah_ab,':roz_ab'=>$roz_ab,':date_ab'=>$date_ab));
    }
    
    // update Vege table with the correct count after successful products are determined
    $t_mah = $successful_products_count;
    $query_update_vege = "UPDATE  Vege SET 
    date_s=?,no_bah=?,b_time=?,add_abadi=?,add_city=?,m_zamin=?,lng=?,lat=?,m_ab=?,z_sal=?,t_mah=?,confi=?,date_confi=? WHERE bah_cod_m=? and id=? " ;
    $q_update_vege = $dbh->prepare($query_update_vege);
    $q_update_vege->execute(array($date_s,$no_bah,$b_time,$add_abadi,$add_city,$m_zamin,$lng,$lat,$m_ab,$z_sal,$t_mah,'1',$date_s,$bah_cod_m,$id));

    $dbh->commit();
} catch (Exception $e) {
    if ($dbh->inTransaction()) { $dbh->rollBack(); }
    echo "<script>alert('خطا در ویرایش رکوردها: ".$e->getMessage()."');</script>";
    exit;
}

include('../../login/config.php');
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'تصحیح اطلاعات صیفی - '.$bah_cod_m,$id_ostan) ; 

unset($actual_link,$add_abadi,$add_city,$Vege_id,$bah_cod_m,$bank_account,$check,$city,$co_name,$cod_m_session,$cod_mah,$cod_qroup,$count_pm,$date_edit,$date_s,$dsn,$dbh,$e,$es,$euser,$found,$h_ab,$id_city,$id_mar,$id_ostan,$jens,$karbar_m,$lat,$lng,$m_ab,$zer_kesht_b,$m_addres,$m_cod_m,$m_fname,$m_jens,$m_last_name,$m_name,$m_poul,$m_tel_m,$m_vaz_sok,$m_zamin,$mah_bem,$mah_mas,$mah_tol,$mah_tol,$mah_tolp,$markaz,$md_ab,$mor_cod_m,$n,$name,$name,$no,$no_ab,$no_bah,$no_karbar,$no_kesh,$no_mal,$no_sab,$num2_t_mah,$num3_t_mah,$num_t_mah,$num_t_mah,$ostan,$password,$PersName,$q,$query,$row,$s_ayesh,$s_bar_a,$s_bar_b,$sh_gat,$stmt,$t_gat,$t_mah,$time,$title,$user,$user_check,$v_co_name,$v_jen,$v_no_kesh,$v_no_mal,$z_sal,$zer_kesht_a,$zer_kesht_b);
alert ('اطلاعات محصولات صیفی با موفقیت تصحیح شد ') ;
// clos conntection 

?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>

<?php
////////
if  (isset($_POST['bah_cod_m']))
{
$id = $_POST['id'] ; 
$sh_gat = $_POST['sh_gat'];
$date_s = date_con(jdate("Y/m/d"));
$no_bah = $_POST['no_bah'] ; 
$add_abadi = $_POST["add_abadi"]; 
$add_city = $_POST["add_city"]; 
$bah_cod_m = $_POST['bah_cod_m'];
$m_poul = $_POST['m_poul'];
$b_time = $_POST['b_time'];
if ($b_time=='1')  $v_b_time='زمستانه/استمرار';
if ($b_time=='2')  $v_b_time='بهاره';
if ($b_time=='3')  $v_b_time='تابستانه';
if ($b_time=='4')  $v_b_time='پاییزه';
$z_sal = $_POST['z_sal'];
$mah1 = $_POST['mah1'];
$mah2 = $_POST['mah2'];
$mah3 = $_POST['mah3'];
$t_kind = $_POST['t_kind'];
$m_ab = $_POST['m_ab'] ;
// تعریف آرایه نام محصول 
$name_mah = array() ; 
// تنطیم تعداد محصول 
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
$query = "SELECT lng,lat,m_zamin from Vege where id = $id";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$lng = $row['lng'] ;
$lat = $row['lat'] ;
$m_zamin = $row['m_zamin'] ;
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
<title><?php echo $title ;?></title>
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
           <p class="style8">تصحیح اطلاعات محصولات عمده صیفی</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <br />
             <?php sar_data2($bah_cod_m,$no_bah) ;?>
             <br />
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1">
      <table width="99%" height="443" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="25" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
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
          <td height="28" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
          </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo $v_m_ab; ?></div></td>
          <td><div align="right">:منبع آب</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo $v_b_time; ?></div></td>
          <td><div style="margin-right:30px" align="right" >:فصل کشت</div></td>
        </tr>
        <tr>
          <td height="58"><div align="right">
            <span class="style2">درجه اعشار</span>
            <input name="lat" type="text" class="number input_text" id="lat" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td><div align="right">:Y عرض جغرافیایی</div></td>
          <td>&nbsp;</td>
          <td><div align="right"><span class="style2">درجه اعشار</span>
<input name="lng" type="text" class="number input_text" id="lng" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
        </tr>
        <tr>
          <td height="40">&nbsp;</td>
          <td>&nbsp;</td>
          <td height="40">&nbsp;</td>
          <td height="40"><div align="right"><span class="style2">هکتار</span>
            <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="11"  align="baseline" xml:lang="fa" />
            </div></td>
          <td><div style="margin-right:30px" align="right">:کل سطح زیر کشت</div></td>
        </tr>
        <tr>
          <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong> <?php echo $z_sal ;?> : اطلاعات کاشت سال زراعی </strong></div></td>
        </tr>
        <tr>
          <td height="101" colspan="5"><table width="100%" height="84" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="10%" height="19" bgcolor="#FFFFCC">محصول بیمه هست ؟</td>
              <td width="21%" bgcolor="#FFFFCC">تاریخ اولین آبیاری<br />
               <span class="style8">روز / ماه / سال</span></td>
               <td width="16%" bgcolor="#FFFFCC">روش آبیاری</td> 
              <td width="13%" bgcolor="#FFFFCC">روش کشت</td>
              <td width="13%" bgcolor="#FFFFCC">نوع رقم</td>
              <td width="9%" bgcolor="#FFFFCC">سطح زیر کشت<br />
                <span class="style2">هکتار</span></td>
              <td width="14%" bgcolor="#FFFFCC">نام محصول</td>
              <td width="4%" bgcolor="#FFFFCC">ردیف</td>
              </tr>
            <?php 
// واکشی تمام رکوردهای محصول از دیتابیس
$query_vege_prod = "SELECT * from Vege_prod WHERE Vege_id = :Vege_id ORDER BY id ASC";
$stmt_vege_prod = $dbh->prepare($query_vege_prod);
$stmt_vege_prod->execute(array(':Vege_id' => $id));
$existing_products = $stmt_vege_prod->fetchAll(PDO::FETCH_ASSOC);

// آماده‌سازی آرایه برای دسترسی آسان
$products_by_cod_mah = array();
foreach ($existing_products as $prod) {
    $products_by_cod_mah[$prod['cod_mah']][] = $prod;
}

$n = 1 ;
$num2_t_mah = $t_mah ;
while ($num2_t_mah > 0){
    $cod_mah1 = $name_mah[$n-1][1] ;
    $mah_mas = '';
    $ragham = '';
    $ra_kesh = '';
    $no_ab = '';
    $roz_ab = '';
    $mah_ab = '';
    $sal_ab = '';
    $mah_bem = '';
    
    // اگر محصولی با این کد در دیتابیس وجود داشت و هنوز استفاده نشده بود
    if (isset($products_by_cod_mah[$cod_mah1]) && !empty($products_by_cod_mah[$cod_mah1])) {
        // اطلاعات اولین رکورد موجود را از آرایه واکشی و استفاده می‌کنیم
        $row = array_shift($products_by_cod_mah[$cod_mah1]);
        $mah_mas = $row['zer_kesht'] ;
        $ragham = $row['ragham'] ; 
        $ra_kesh = $row['ra_kesh'] ; 
        $no_ab = $row['no_ab'] ; 
        $roz_ab = $row['roz_ab'] ; 
        $mah_ab = $row['mah_ab'] ; 
        $sal_ab = $row['sal_ab'] ; 
        $mah_bem = $row['mah_bem'] ;
    }
?>
            <tr>
              <td height="42" bgcolor="#FFFFFF"><div align="center">
                   <select name="mah_bem<?php echo $num2_t_mah ;?>" class="required input_text  required" id="mah_bem<?php echo $num2_t_mah ;?>"  style="height:40px ; width:70px ; direction:rtl" tabindex="12">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($mah_bem=='1') { echo 'selected="selected"' ; } ?>>بلی</option>
                  <option value="2" <?php if ($mah_bem=='2') { echo 'selected="selected"' ; } ?>>خیر</option>
                </select>
                </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <select name="sal_ab<?php echo $num2_t_mah ?>" class="Csalab<?php echo $num2_t_mah ?> input_text required"  id="sal_ab<?php echo $num2_t_mah ?>"  style="height:35px ; width:50px ; direction:rtl" tabindex="11">
                  <option value="">--</option>
                  <option value="1404" <?php if ($sal_ab=='1404') { echo 'selected="selected"' ; } ?>>1404</option>
                  <option value="1403" <?php if ($sal_ab=='1403') { echo 'selected="selected"' ; } ?>>1403</option>
                  <option value="1402" <?php if ($sal_ab=='1402') { echo 'selected="selected"' ; } ?>>1402</option>
                  </select>
                /
                <select name="mah_ab<?php echo $num2_t_mah ?>" class="Cmahab<?php echo $num2_t_mah ?> input_text  required" id="mah_ab<?php echo $num2_t_mah ?>"  style="height:35px ; width:40px ; direction:rtl" tabindex="10">
                  <option value="">--</option>
                  <option value="01" <?php if ($mah_ab=='01') { echo 'selected="selected"' ; } ?>>01</option>
                  <option value="02" <?php if ($mah_ab=='02') { echo 'selected="selected"' ; } ?>>02</option>
                  <option value="03" <?php if ($mah_ab=='03') { echo 'selected="selected"' ; } ?>>03</option>
                  <option value="04" <?php if ($mah_ab=='04') { echo 'selected="selected"' ; } ?>>04</option>
                  <option value="05" <?php if ($mah_ab=='05') { echo 'selected="selected"' ; } ?>>05</option>
                  <option value="06" <?php if ($mah_ab=='06') { echo 'selected="selected"' ; } ?>>06</option>
                  <option value="07" <?php if ($mah_ab=='07') { echo 'selected="selected"' ; } ?>>07</option>
                  <option value="08" <?php if ($mah_ab=='08') { echo 'selected="selected"' ; } ?>>08</option>
                  <option value="09" <?php if ($mah_ab=='09') { echo 'selected="selected"' ; } ?>>09</option>
                  <option value="10" <?php if ($mah_ab=='10') { echo 'selected="selected"' ; } ?>>10</option>
                  <option value="11" <?php if ($mah_ab=='11') { echo 'selected="selected"' ; } ?>>11</option>
                  <option value="12" <?php if ($mah_ab=='12') { echo 'selected="selected"' ; } ?>>12</option>
                  </select>
                /
                <select name="roz_ab<?php echo $num2_t_mah ?>" class="input_text  required" id="roz<?php echo $num2_t_mah ?>"  style="height:35px ; width:40px ; direction:rtl" tabindex="9">
                  <option value="">--</option>
                  <option value="01" <?php if ($roz_ab=='01') { echo 'selected="selected"' ; } ?>>01</option>
                  <option value="02" <?php if ($roz_ab=='02') { echo 'selected="selected"' ; } ?>>02</option>
                  <option value="03" <?php if ($roz_ab=='03') { echo 'selected="selected"' ; } ?>>03</option>
                  <option value="04" <?php if ($roz_ab=='04') { echo 'selected="selected"' ; } ?>>04</option>
                  <option value="05" <?php if ($roz_ab=='05') { echo 'selected="selected"' ; } ?>>05</option>
                  <option value="06" <?php if ($roz_ab=='06') { echo 'selected="selected"' ; } ?>>06</option>
                  <option value="07" <?php if ($roz_ab=='07') { echo 'selected="selected"' ; } ?>>07</option>
                  <option value="08" <?php if ($roz_ab=='08') { echo 'selected="selected"' ; } ?>>08</option>
                  <option value="09" <?php if ($roz_ab=='09') { echo 'selected="selected"' ; } ?>>09</option>
                  <option value="10" <?php if ($roz_ab=='10') { echo 'selected="selected"' ; } ?>>10</option>
                  <option value="11" <?php if ($roz_ab=='11') { echo 'selected="selected"' ; } ?>>11</option>
                  <option value="12" <?php if ($roz_ab=='12') { echo 'selected="selected"' ; } ?>>12</option>
                  <option value="13" <?php if ($roz_ab=='13') { echo 'selected="selected"' ; } ?>>13</option>
                  <option value="14" <?php if ($roz_ab=='14') { echo 'selected="selected"' ; } ?>>14</option>
                  <option value="15" <?php if ($roz_ab=='15') { echo 'selected="selected"' ; } ?>>15</option>
                  <option value="16" <?php if ($roz_ab=='16') { echo 'selected="selected"' ; } ?>>16</option>
                  <option value="17" <?php if ($roz_ab=='17') { echo 'selected="selected"' ; } ?>>17</option>
                  <option value="18" <?php if ($roz_ab=='18') { echo 'selected="selected"' ; } ?>>18</option>
                  <option value="19" <?php if ($roz_ab=='19') { echo 'selected="selected"' ; } ?>>19</option>
                  <option value="20" <?php if ($roz_ab=='20') { echo 'selected="selected"' ; } ?>>20</option>
                  <option value="21" <?php if ($roz_ab=='21') { echo 'selected="selected"' ; } ?>>21</option>
                  <option value="22" <?php if ($roz_ab=='22') { echo 'selected="selected"' ; } ?>>22</option>
                  <option value="23" <?php if ($roz_ab=='23') { echo 'selected="selected"' ; } ?>>23</option>
                  <option value="24" <?php if ($roz_ab=='24') { echo 'selected="selected"' ; } ?>>24</option>
                  <option value="25" <?php if ($roz_ab=='25') { echo 'selected="selected"' ; } ?>>25</option>
                  <option value="26" <?php if ($roz_ab=='26') { echo 'selected="selected"' ; } ?>>26</option>
                  <option value="27" <?php if ($roz_ab=='27') { echo 'selected="selected"' ; } ?>>27</option>
                  <option value="28" <?php if ($roz_ab=='28') { echo 'selected="selected"' ; } ?>>28</option>
                  <option value="29" <?php if ($roz_ab=='29') { echo 'selected="selected"' ; } ?>>29</option>
                  <option value="30" <?php if ($roz_ab=='30') { echo 'selected="selected"' ; } ?>>30</option>
                  <option value="31" <?php if ($roz_ab=='31') { echo 'selected="selected"' ; } ?>>31</option>
                  </select>
                </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <select name="no_ab<?php echo $num2_t_mah ?>" class="input_text  required" id="no_ab<?php echo $num2_t_mah ?>"  style="height:40px ; width:120px ; direction:rtl" tabindex="8">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($no_ab=='1') { echo 'selected="selected"' ; }?>>نواری</option>
                  <option value="2" <?php if ($no_ab=='2') { echo 'selected="selected"' ; }?>>غرقابی</option>
                  <option value="3" <?php if ($no_ab=='3') { echo 'selected="selected"' ; }?>>قطره ای</option>
                  <option value="4" <?php if ($no_ab=='4') { echo 'selected="selected"' ; }?>>بارانی</option>
                  <option value="5" <?php if ($no_ab=='5') { echo 'selected="selected"' ; }?>>سایر</option>
                  </select>
                </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <select name="ra_kesh<?php echo $num2_t_mah ?>" id="no_kesht<?php echo $num2_t_mah ?>" class="input_text  required"  style="height:40px ; width:80px ; direction:rtl" tabindex="7">
<?php if ($name_mah[$n-1][0]=='سیب زمینی') {?> 

                  <option value="2" <?php if ($ra_kesh=='2') { echo 'selected="selected"' ; }?>>مستقیم</option>
<?php } else {?>
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($ra_kesh=='1') { echo 'selected="selected"' ; }?>>نشایی</option>
                  <option value="2" <?php if ($ra_kesh=='2') { echo 'selected="selected"' ; }?>>مستقیم</option>
<?php }?>
<?php if ($name_mah[$n-1][0]=='گوجه فرنگی') {?> 
                  <option value="3" <?php if ($ra_kesh=='3') { echo 'selected="selected"' ; }?>>نشایی با مالچ</option>
                  <option value="4" <?php if ($ra_kesh=='4') { echo 'selected="selected"' ; }?>>مستقیم با مالچ</option>
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
                <input name="mah_mas<?php echo $num2_t_mah ;?>" type="text" class="mashat required number input_text" id="mashat<?php echo $num2_t_mah ;?>" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $mah_mas ;?>" maxlength="10"  align="baseline" xml:lang="fa" />
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
          <td height="31" colspan="4"><div align="right"><span class="style2">هکتار</span>
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
     <input type="hidden" name="id"  value=<?php echo $id ; ?> />
     <input type="hidden" name="sh_gat" value=<?php echo $sh_gat; ?> />
     <input type="button" name="cancel" value="انصراف" style="width:150px ; height:45px" tabindex="30" id="btn1" onClick="window.location='index.php';"/>
     <input type="submit" name="action" value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="33" id="submit" onClick="setTimeout(disableFunction, 1);"/>
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
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
   </tr>
</table>
</table>
</body>
</html>
<script>
// تغییر به change  به دلیل عدم نمایش پیام در حین تایپ
	$('.mashat').change(function () {
 
    // initialize the sum (total mashat) to zero
    var sum = 0;
    // we use jQuery each() to loop through all the textbox with 'mashat' class
    // and compute the sum for each loop
    $('.mashat').each(function() {
        sum += Number($(this).val());
    });
     var kol = document.getElementById("m_zamin").value;
    // set the computed value to 'use' textbox
    $('#kol').val(kol);
    // we use jQuery each() to loop through all the textbox with 'mashat' class
    // and compute the sum for each loop
    $('.mashat').each(function() {
        def -= Number($(this).val());
    });
    // set the computed value to 'use' textbox
    $('#use').val(sum);
    var def = kol - sum ;
    // set the computed value to 'use' textbox
    $('#traz').val(def);
if( def < 0 ){
   alert("خطا! \n \n تراز مساحت منفی میباشد . عدد وارد شده را تصحیح کنید ");
   document.getElementById("submit").disabled = true;
   document.getElementById("submit").value = 'خطا در ورودی ';
}
if( def >= 0 ){
   document.getElementById("submit").disabled = false ;
   document.getElementById("submit").value = 'ثبت اطلاعات';
}
});
</script>
<?php
$no = $t_mah ; 
while ($no > 0){
?>
<script>
$('.Cmahab<?php echo $no?>').change(function () {
// سال آبیاری
  var e = document.getElementById("sal_ab<?php echo $no ?>");
  var salab = e.options[e.selectedIndex].value;
// ماه آبیاری
  var b = document.getElementById("mah_ab<?php echo $no ?>");
  var mahab = b.options[b.selectedIndex].value;
// سال پایه از سال زراعی 
  var salpa = <?php echo substr($z_sal,2,2) ?> ; 
  var salen = <?php echo substr($z_sal,7,2) ?> ; 
  if ((parseInt(salab) == parseInt(salpa) && parseInt(mahab) < 5 ) || (parseInt(salab) == parseInt(salen) && parseInt(mahab) > 4 )) {
	 alert('خطا! \n \n با توجه به سال انتخاب شده ، ماه آبیاری صحیح نیست ') ; 
// تغییر ماه انتخاب شده به null
	 $(".Cmahab<?php echo $no?>").val("");
	}
});
</script>
<script>
$('.Csalab<?php echo $no?>').change(function () {
// سال آبیاری
  var e = document.getElementById("sal_ab<?php echo $no ?>");
  var salab = e.options[e.selectedIndex].value;
// ماه آبیاری
  var b = document.getElementById("mah_ab<?php echo $no ?>");
  var mahab = b.options[b.selectedIndex].value;
// سال پایه از سال زراعی 
  var salpa = <?php echo substr($z_sal,2,2) ?> ; 
  var salen = <?php echo substr($z_sal,7,2) ?> ; 
   if ((parseInt(salab) == parseInt(salpa) && parseInt(mahab) < 5 ) || (parseInt(salab) == parseInt(salen) && parseInt(mahab) > 4 )) {
	 alert('خطا! \n \n با توجه به ماه انتخاب شده ، سال آبیاری صحیح نیست ') ; 
// تغییر سال انتخاب شده به null
	 $(".Csalab<?php echo $no?>").val("");
	}
});
</script>
  <?php
 $no--;
}
?>