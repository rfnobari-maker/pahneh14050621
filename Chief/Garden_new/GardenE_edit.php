<?php
include('../../lock_p1.php');
include_once('../../login/config.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
require_once('CropValidationService.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;

if(isset($_POST['bah_cod_m'])) 
{
    if(isset($_POST['id_page'])) $id_page = $_POST["id_page"];
    $bah_cod_m = $_POST['bah_cod_m'];
    $query = "SELECT ok from bah where bah_cod_m = :bah_cod_m ";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ok = $row['ok'] ;
    if($ok=='2')
    {
        alert ('بهره بردار در قید حیات نمیباشد !! امکان ثبت اطلاعات مقدور نیست  ') ;
        ?>
        <form name="myform" class="myform" method="post" action="index.php"></form>
        <script type="text/javascript">document.myform.submit();</script>
        <?php
    }
    if($ok=='4')
    {
        alert ('اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ثبت اطلاعات مقدور نمیباشد  ') ;
        ?>
        <form name="myform" class="myform" method="post" action="index.php"></form>
        <script type="text/javascript">document.myform.submit();</script>
        <?php
    }
}

if (isset($_POST['cancel'])) 
{  
    ?>
    <form name="myform" class="myform" method="post" action="liste_Garden.php?id=<?php echo $id_page .'#1' ?>">
    <input type="hidden" name="action_lise" value="1" />
    <input type="hidden" name="back_p" value="1" />
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
}

if (isset($_POST['action'])) 
{  
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $date_s = $date_edit;
    $mor_cod_m = $login_session;
    $no_mush = isset($_POST['no_mush']) ? $_POST['no_mush'] : '';
    $bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
    $num_bah = isset($_POST['num_bah']) ? $_POST['num_bah'] : '';
    $add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
    $add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
    $id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
    $id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
    $id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
    $m_zamin = isset($_POST['m_zamin']) ? $_POST['m_zamin'] : '';
    $no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
    $lng = isset($_POST['lng']) ? $_POST['lng'] : '';
    $lat = isset($_POST['lat']) ? $_POST['lat'] : '';
    $sh_gat = isset($_POST['sh_gat']) ? $_POST['sh_gat'] : '';
    $m_cod_m = isset($_POST['m_cod_m']) ? $_POST['m_cod_m'] : '';
    if ($no_mal <> '7') $m_cod_m = $bah_cod_m;
    $m_vaz_sok = isset($_POST['m_vaz_sok']) ? $_POST['m_vaz_sok'] : '';
    $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
    $nah_kesh = isset($_POST['nah_kesh']) ? $_POST['nah_kesh'] : '';
    $m_ab = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
    $md_ab = isset($_POST['md_ab']) ? $_POST['md_ab'] : '';
    $h_ab = isset($_POST['h_ab']) ? $_POST['h_ab'] : '';
    $no_sab = isset($_POST['no_sab']) ? $_POST['no_sab'] : '';
    $no_ab = isset($_POST['no_ab']) ? $_POST['no_ab'] : '';
    $es = isset($_POST['es']) ? $_POST['es'] : '';
    $check_cod = isset($_POST['check_cod']) ? $_POST['check_cod'] : '';
    $z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
    $page_id = isset($_POST['id_page']) ? $_POST['id_page'] : 1;

    if ($no_kesh=='2')
    {
        $m_ab = '' ;
        $md_ab = 0 ;
        $h_ab = 0 ;
        $no_sab = '' ;
        $no_ab = '' ;
        $es = '' ;
    }
    if ($nah_kesh=='3')
    {
        $m_zamin = 0 ;
        $no_mal = '' ;
        $lng = 0 ;
        $lat = 0 ;
        $m_cod_m = '' ;
        $m_vaz_sok = '' ;
        $no_kesh = '' ;
        $m_ab = '' ;
        $md_ab = 0 ;
        $h_ab = 0 ;
        $no_sab = '' ;
        $no_ab = '' ;
        $es = '' ;
    }

    // ========== دریافت مقادیر فعلی از دیتابیس ==========
    $query_current = "SELECT m_zamin, no_kesh, nah_kesh FROM Garden WHERE id = :id";
    $stmt_current = $dbh->prepare($query_current);
    $stmt_current->execute(array(':id' => $id));
    $current = $stmt_current->fetch(PDO::FETCH_ASSOC);

    // ========== شرط 1: ممنوعیت تغییر نحوه کشت از '3' به غیر '3' ==========
    if ($current['nah_kesh'] == '3' && $nah_kesh != '3') {
        $query_check_products = "SELECT COUNT(*) as product_count FROM Garden_prod WHERE Garden_id = :garden_id";
        $stmt_check_products = $dbh->prepare($query_check_products);
        $stmt_check_products->execute(array(':garden_id' => $id));
        $product_count = $stmt_check_products->fetch(PDO::FETCH_ASSOC);
        
        if ($product_count['product_count'] > 0) {
            ?>
            <form name="myform" class="myform" method="post" action="liste_Garden.php?id=<?php echo $page_id; ?>">
            <input type="hidden" name="com_alert" value="این باغ به صورت درختان پراکنده ثبت شده و دارای محصول می‌باشد. امکان تغییر نحوه کشت مقدور نیست.">
            <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>">
            <input type="hidden" name="action_lise" value="1">
            <input type="hidden" name="back_p" value="1">
            </form>
            <script type="text/javascript">document.myform.submit();</script>
            <?php
            exit;
        }
    }

    // ========== شرط 2: بررسی الگوی کشت در صورت تغییر نوع کشت ==========
    if ($no_kesh != $current['no_kesh']) {
        $query_products = "SELECT id, cod_mah, s_kesht_b, s_kesht_gb FROM Garden_prod WHERE Garden_id = :garden_id";
        $stmt_products = $dbh->prepare($query_products);
        $stmt_products->execute(array(':garden_id' => $id));
        $products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($products) > 0) {
            $validationService = new CropValidationService($dbh);
            $errors = array();
            
            foreach ($products as $product) {
                $validationResult = $validationService->validateCultivatedAreaAgainstAllocation(
                    $product['id'], $id, $product['cod_mah'],
                    $product['s_kesht_b'], $product['s_kesht_gb'],
                    $z_sal, $id_ostan, $id_city, $id_mar,
                    $no_kesh, 0
                );
                
                if (!$validationResult['isValid']) {
                    $errors[] = "محصول " . mah_name($product['cod_mah']) . ": " . $validationResult['message'];
                }
            }
            
            if (!empty($errors)) {
    $error_message = "خطا : امکان تغییر نوع کشت بعلت مغایرت الگوی کشت مرکز برای محصول ثبت شده ، مقدور نیست";
    ?>
    <form name="myform" class="myform" method="post" action="liste_Garden.php?id=<?php echo $page_id; ?>">
    <input type="hidden" name="com_alert" value="<?php echo $error_message; ?>">
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>">
    <input type="hidden" name="action_lise" value="1">
    <input type="hidden" name="back_p" value="1">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
    exit;
}
        }
    }

// محاسبه مجموع سطح کشت فعلی (بارور + غیربارور)
$query_sum_cultivation = "SELECT SUM(s_kesht_b + s_kesht_gb) AS total_cultivation FROM Garden_prod WHERE Garden_id = :garden_id";
$stmt_sum = $dbh->prepare($query_sum_cultivation);
$stmt_sum->execute(array(':garden_id' => $id));
$sum_row = $stmt_sum->fetch(PDO::FETCH_ASSOC);
$total_cultivation = (float)$sum_row['total_cultivation'];

// مساحت جدید نباید از مجموع سطح کشت کمتر باشد
if ($m_zamin < $total_cultivation) {
    ?>
    <form name="myform" class="myform" method="post" action="liste_Garden.php?id=<?php echo $page_id; ?>">
    <input type="hidden" name="com_alert" value="خطا: مساحت زمین (<?php echo $m_zamin; ?> هکتار) نمی‌تواند از مجموع سطح زیر کشت (<?php echo $total_cultivation; ?> هکتار) کمتر باشد.">
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>">
    <input type="hidden" name="action_lise" value="1">
    <input type="hidden" name="back_p" value="1">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
    exit;
}
// ========== شرط 2-1: بررسی نهاده در صورت تغییر نوع کشت ==========
if ($no_kesh != $current['no_kesh']) {
    $has_allocated = false;
    $query_check_payesh = "SELECT id FROM Garden_prod WHERE Garden_id = :garden_id";
    $stmt_check = $dbh->prepare($query_check_payesh);
    $stmt_check->execute(array(':garden_id' => $id));
    while ($row_check = $stmt_check->fetch(PDO::FETCH_ASSOC)) {
        if (check_payesh($row_check['id'], 1, substr($z_sal, 0, 4)) == 2) {
            $has_allocated = true;
            break;
        }
    }
    
    if ($has_allocated) {
        ?>
        <form name="myform" class="myform" method="post" action="liste_Garden.php?id=<?php echo $page_id; ?>">
        <input type="hidden" name="com_alert" value="خطا: برای این باغ نهاده اختصاص داده شده، تغییر نوع کشت مجاز نیست.">
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>">
        <input type="hidden" name="action_lise" value="1">
        <input type="hidden" name="back_p" value="1">
        </form>
        <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit;
    }
}

    // ========== بروزرسانی جدول Garden ==========
    $query = "UPDATE Garden SET date_s=?, es=?, no_mal=?, lng=?, lat=?,
              m_cod_m=?, m_vaz_sok=?, no_kesh=?, m_ab=?, md_ab=?, h_ab=?, no_sab=?, no_ab=?,
              num_bah=?, add_abadi=?, add_city=?, m_zamin=?, nah_kesh=? 
              WHERE bah_cod_m=? and id=?" ;
    $q = $dbh->prepare($query);
    $q->execute(array($date_s, $es, $no_mal, $lng, $lat, $m_cod_m, $m_vaz_sok, $no_kesh,
                      $m_ab, $md_ab, $h_ab, $no_sab, $no_ab, $num_bah, $add_abadi, $add_city,
                      $m_zamin, $nah_kesh, $bah_cod_m, $id));

// ========== به‌روزرسانی no_kesh و nah_kesh در جدول Garden_prod ==========
if ($no_kesh != $current['no_kesh'] || $nah_kesh != $current['nah_kesh']) {
    
    // فیلدهایی که باید به‌روزرسانی شوند
    $update_fields = array();
    $update_params = array();
    
    if ($no_kesh != $current['no_kesh']) {
        $update_fields[] = "no_kesh = ?";
        $update_params[] = $no_kesh;
    }
    
    if ($nah_kesh != $current['nah_kesh']) {
        $update_fields[] = "nah_kesh = ?";
        $update_params[] = $nah_kesh;
    }
    
    if (!empty($update_fields)) {
        $update_params[] = $id; // WHERE Garden_id = ?
        
        $update_prod_query = "UPDATE Garden_prod SET " . implode(", ", $update_fields) . " WHERE Garden_id = ?";
        $stmt_prod_update = $dbh->prepare($update_prod_query);
        $stmt_prod_update->execute($update_params);
    }
}
    // ========== ثبت اطلاعات مالک ==========
    $m_jens = isset($_POST['m_jens']) ? $_POST['m_jens'] : '';
    $m_name = isset($_POST['m_name']) ? $_POST['m_name'] : '';
    $m_last_name = isset($_POST['m_last_name']) ? $_POST['m_last_name'] : '';
    $m_fname = isset($_POST['m_fname']) ? $_POST['m_fname'] : '';
    $m_tel_m = isset($_POST['m_tel_m']) ? $_POST['m_tel_m'] : '';

    $query = "INSERT IGNORE INTO malek (date_s, mor_cod_m, m_cod_m, m_jens, m_name, m_last_name, m_fname, m_tel_m) 
              VALUES(:date_s, :mor_cod_m, :m_cod_m, :m_jens, :m_name, :m_last_name, :m_fname, :m_tel_m)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_s'=>$date_s, ':mor_cod_m'=>$mor_cod_m, ':m_cod_m'=>$m_cod_m,
                      ':m_jens'=>$m_jens, ':m_name'=>$m_name, ':m_last_name'=>$m_last_name,
                      ':m_fname'=>$m_fname, ':m_tel_m'=>$m_tel_m));

    // ========== ثبت رویداد ==========
    sabt_event($login_session, getUserIP_1(), $date_edit, $time, $add_abadi, 
               'تصحیح اطلاعات باغی و قلمستان - '.$bah_cod_m, $id_ostan);

    alert ('اطلاعات بهره برداری باغی با موفقیت تصحیح شد ') ;
    ?>
    <form name="myform" class="myform" method="post" action="liste_Garden.php?id=<?php echo $page_id .'#1' ?>">
    <input type="hidden" name="action" value="1" />
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ?>" />
    <input type="hidden" name="action_lise" value="1" />
    <input type="hidden" name="back_p" value="1" />
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
}
?>
<?php
if (isset($_POST['bah_cod_m']))
{
    $date_s = date_con(jdate("Y/m/d"));
    $add_abadi = isset($_POST["add_abadi"]) ? $_POST["add_abadi"] : ''; 
    $add_city = isset($_POST["add_city"]) ? $_POST["add_city"] : ''; 
    $bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';

    if(isset($_POST['m_poul'])) {
        $m_poul = $_POST['m_poul'];
    }

    $sh_gat = isset($_POST['sh_gat']) ? $_POST['sh_gat'] : '';
    $z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
    $no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
    $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
    $nah_kesh = isset($_POST['nah_kesh']) ? $_POST['nah_kesh'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    $query = "SELECT id, lng, lat, m_zamin, m_cod_m, m_ab, h_ab, no_sab, no_ab, es, md_ab, m_vaz_sok, check_cod, num_bah 
              FROM Garden WHERE bah_cod_m = '$bah_cod_m' and sh_gat = '$sh_gat' and z_sal = '$z_sal' and id = '$id'"; 
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    $num_bah = $row['num_bah'];
    $lng = $row['lng'];
    $lat = $row['lat'];
    $m_zamin = $row['m_zamin'];
    $m_cod_m = $row['m_cod_m'] ;
    $m_ab = $row['m_ab'] ;
    $md_ab = $row['md_ab'] ;
    $h_ab = $row['h_ab'] ;
    $no_sab = $row['no_sab'] ;
    $no_ab = $row['no_ab'] ;
    $es = $row['es'] ;
    $check_cod = $row['check_cod'] ;
    $m_vaz_sok = $row['m_vaz_sok'] ;

    if ($no_mal <> 7)
    {
        $query = "SELECT bah_cod_m, no_bah, co_name, name, jens, last_name, fname, tel_m 
                  FROM bah WHERE bah_cod_m = :bah_cod_m and num_bah = :num_bah"; 
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':bah_cod_m'=>$bah_cod_m, ':num_bah'=>$num_bah));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $no_bah = $row['no_bah'] ;
        $co_name = $row['co_name'] ;
        $m_name = $row['name'] ;
        $m_jens = $row['jens'] ;
        $m_last_name = $row['last_name'] ;
        $m_fname = $row['fname'] ;
        $m_tel_m = $row['tel_m'] ;
    }
    else 
    {
        $query = "SELECT m_cod_m, m_name, m_jens, m_last_name, m_fname, m_tel_m 
                  FROM malek WHERE m_cod_m = :m_cod_m"; 
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':m_cod_m'=>$m_cod_m));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $m_name = $row['m_name'] ;
        $m_jens = $row['m_jens'] ;
        $m_last_name = $row['m_last_name'] ;
        $m_fname = $row['m_fname'] ;
        $m_tel_m = $row['m_tel_m'] ;
    }

    if ($no_kesh=='1') $v_no_kesh='آبی';
    if ($no_kesh=='2') $v_no_kesh='دیم';
    if ($nah_kesh=='1') $v_nah_kesh='ساده' ;     
    if ($nah_kesh=='2') $v_nah_kesh='مخلوط' ;     
    if ($nah_kesh=='3') $v_nah_kesh='درختان پراکنده' ;     
    if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
    if ($no_mal=='1') $v_no_mal='سند ششدانگ';
    if ($no_mal=='2') $v_no_mal='سند مشاعی';
    if ($no_mal=='3') $v_no_mal='اصلاحات اراضی';
    if ($no_mal=='4') $v_no_mal='موقوفه';
    if ($no_mal=='5') $v_no_mal='واگذاری';
    if ($no_mal=='6') $v_no_mal='قولنامه';
    if ($no_mal=='7') $v_no_mal='اجاره' ;
    if ($no_mal=='8') $v_no_mal='سایر' ;

    if ($m_poul=='abadi') {
        $query = "SELECT add_abadi, id_ostan, id_city, id_mar FROM list_abadi WHERE add_abadi = :add_abadi"; 
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_abadi'=>$add_abadi));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $add_abadi = $row["add_abadi"]; 
        $add_city = '-'; 
        $id_ostan = $row["id_ostan"]; 
        $id_city = $row["id_city"]; 
        $id_mar = $row["id_mar"]; 
    }
    if ($m_poul=='shahr') {
        $query = "SELECT add_city, id_ostan, id_city, id_mar FROM list_city WHERE add_city = :add_city"; 
        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':add_city'=>$add_city));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $add_city = $row["add_city"]; 
        $add_abadi = '-'; 
        $id_ostan = $row["id_ostan"]; 
        $id_city = $row["id_city"]; 
        $id_mar = $row["id_mar"]; 
    }
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
        <script src="../../15_files/jquery.js" type="text/javascript"></script>
        <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
        <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
        <script type="text/javascript">
            $().ready(function () { $("#form1").validate(); });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".Mcod_m").change(function() {
                    var id = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "select_mar.php",
                        data: 'cod_m=' + id,
                        cache: false,
                        success: function(html) { $(".mar").html(html); }
                    });
                });
            });
        </script>
    </head>
    <body>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr><td><img src="../../files/images/header.jpg" width="100%" height="149" /></td></tr>
        <tr><td><?php include('menu.php'); ?></td></tr>
        <tr><td>
            <?php include('top.php'); ?>
            <p class="style8">تصحیح اطلاعات باغی و قلمستان</p>
            <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/><br />
            <?php sar_data2($bah_cod_m, $num_bah); ?>
            </p>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr><td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
            <td width="840">
       <form action="" method="post" id="form1" name="form1">
      <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="34%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?></div></td>
          <td width="15%"><div align="right">:شهرستان</div></td>
          <td width="10%" rowspan="2">&nbsp;</td>
          <td width="23%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right">نوع مالکیت:<?php echo $v_no_mal; ?></div></td>
          <td height="38" colspan="2"><div align="right">نوع کاشت :<?php echo $v_no_kesh; ?></div></td>
          <td height="38"><div align="right"> <?php echo $v_nah_kesh; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نحوه کشت </div></td>
        </tr>
  <?php if($nah_kesh<>'3'){?> 
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
        </tr>
        <tr>
          <td height="63"><div align="right">
            <span class="style2">درجه اعشار</span>
            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td><div align="right">:Y عرض جغرافیایی</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <span class="style2">درجه اعشار</span>
            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
        </tr>
        <tr>
          <td height="49" colspan="4"><div align="right"><span class="style8">هکتار</span>
            <input name="m_zamin" type="text" class="m_zamin input_text number required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" min="0.01" maxlength="11"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:مساحت زمین</div></td>
        </tr>
        <tr>
          <td height="5" colspan="5">  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="42" colspan="5" bgcolor="#CCCCCC"><?php if($no_mal<>7) echo '<p align="center" style="color:#0066CC" > اطلاعات بهره بردار بعنوان مالک ثبت خواهد شد </p>' ;  else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>' ?></td>
                </tr>
              <tr>
                <td width="31%" height="58"><div align="right">
                  <select name="m_jens"  class="input_text mar required" id="m_jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="6">
                    <option value="1" <?php if ($row['jens']=='1') echo 'selected=selected'?>>مرد</option>
                    <option value="2" <?php if ($row['jens']=='2') echo 'selected=selected'?>>زن</option>
                    </select>
                  </div></td>
                <td width="20%"><div align="right">جنسیت</div></td>
                <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
                <td width="30%"  bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="5"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="11" xml:lang="fa"/>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد ملی مالک </div></td>
                </tr>
              <tr>
                <td height="46" bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_last_name" type="text"  class="input_text required" id="m_last_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="8" dir="rtl" lang="fa" value="<?php echo $m_last_name ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی<br />
                  </div></td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="7" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="50" xml:lang="fa"/>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
                </tr>
              <tr>
                <td height="51"><div align="right">
                  <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="10" dir="rtl" lang="fa" value="<?php echo $m_tel_m ; ?>"  maxlength="11"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div align="right">:تلفن همراه</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="9" dir="rtl" lang="fa" value="<?php if ($no_bah==2) echo $co_name; else echo $m_fname ; ?>" maxlength="75" xml:lang="fa"/>
                  </div></td>
                <td><div style="margin-right:30px" align="right">
                  <?php if ($no_bah==2) echo ':نام شرکت'; else echo ':نام پدر' ; ?>
                </div></td>
                </tr>
              <tr>
                <td height="60" colspan="4"><div align="right">
                  <select name="m_vaz_sok" class="required input_text  " id="m_vaz_sok"  style="height:40px ; width:120px ; direction:rtl" tabindex="12">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($m_vaz_sok=='1') { echo 'selected="selected"' ; } ?>>ساکن</option>
                    <option value="2" <?php if ($m_vaz_sok=='2') { echo 'selected="selected"' ; } ?> >غیرساکن</option>
                    </select>
                  </div></td>
                <td><div style="margin-right:30px" align="right">
                  <p>:وضعیت سکونت مالک</p>
                  </div></td>
              </tr>
              </table>
              <?php }?>
            </td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF">
  <?php if($no_kesh=='1'){?> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات آب</strong></div></td>
                </tr>
              <tr>
                <td width="31%" height="53"><div align="right">
                  <span class="style2">شبانه روز</span>
                  <input name="md_ab" type="text" class="required number input_text" id="md_ab" style="width:50px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $md_ab ; ?>" maxlength="2" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td width="20%"><div align="right">:مدار آبیاری</div></td>
                <td width="1%">&nbsp;</td>
                <td width="30%" bgcolor="#FFFFFF"><div align="right">
                  <select name="m_ab" class="input_text required " id="m_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="14">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($m_ab=='1') { echo 'selected="selected"' ; } ?> >چشمه</option>
                    <option value="2" <?php if ($m_ab=='2') { echo 'selected="selected"' ; } ?>>قنات</option>
                    <option value="3" <?php if ($m_ab=='3') { echo 'selected="selected"' ; } ?>>رودخانه</option>
                    <option value="4" <?php if ($m_ab=='4') { echo 'selected="selected"' ; } ?>>سد</option>
                    <option value="5" <?php if ($m_ab=='5') { echo 'selected="selected"' ; } ?>>چاه سطحی</option>
                    <option value="6"  <?php if ($m_ab=='6') { echo 'selected="selected"' ; } ?>>چاه عمیق</option>
                    <option value="7"  <?php if ($m_ab=='7') { echo 'selected="selected"' ; } ?>>چاه نیمه عمیق</option>
                    <option value="8"  <?php if ($m_ab=='8') { echo 'selected="selected"' ; } ?>>زهکش</option>
                    <option value="9"  <?php if ($m_ab=='9') { echo 'selected="selected"' ; } ?>>پساب</option>
                    <option value="10" <?php if ($m_ab=='10') { echo 'selected="selected"' ; } ?>>آب بندان</option>
                    <option value="11" <?php if ($m_ab=='11') { echo 'selected="selected"' ; } ?>>سایر</option>
                    </select>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: منبع آب</div></td>
                </tr>
              <tr>
                <td height="47"><div align="right">
                  <select name="no_sab" class="input_text required " id="no_sab"  style="height:40px ; width:170px ; direction:rtl" tabindex="17">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($no_sab=='1') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری</option>
                    <option value="2" <?php if ($no_sab=='2') { echo 'selected="selected"' ; } ?>>مجوز آب</option>
                    <option value="3" <?php if ($no_sab=='3') { echo 'selected="selected"' ; } ?>>عرفی</option>
                    <option value="4" <?php if ($no_sab=='4') { echo 'selected="selected"' ; } ?>>سایر</option>
                    </select>
                  </div></td>
                <td><div align="right">:نوع سند حقابه</div></td>
                <td>&nbsp;</td>
                <td><div align="right"><span class="style2">ساعت</span>
                  <input name="h_ab" type="text" class="input_text  required  number" id="h_ab" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $h_ab ; ?>" maxlength="4"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div style="margin-right:30px" align="right">:حقابه</div></td>
                </tr>
              <tr>
                <td height="52"><div align="right">
                  <select name="es" class="input_text required" id="es"  style="height:40px ; width:170px ; direction:rtl" tabindex="19">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($es=='1') { echo 'selected="selected"' ; } ?> >ندارد</option>
                    <option value="2" <?php if ($es=='2') { echo 'selected="selected"' ; } ?>>دارد / جهت ذخیره آب</option>
                    <option value="3" <?php if ($es=='3') { echo 'selected="selected"' ; } ?>>دارد - دو منظوره </option>
                    </select>
                  </div></td>
                <td><div align="right"> :وضعیت استخر</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <select name="no_ab" class="input_text  required" id="no_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="18">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($no_ab=='1') { echo 'selected="selected"' ; }?>>جوی و پشته</option>
                    <option value="2" <?php if ($no_ab=='2') { echo 'selected="selected"' ; }?>>نواری</option>
                    <option value="3" <?php if ($no_ab=='3') { echo 'selected="selected"' ; }?>>غرقابی</option>
                    <option value="4" <?php if ($no_ab=='4') { echo 'selected="selected"' ; }?>>تشتکی</option>
                    <option value="5" <?php if ($no_ab=='5') { echo 'selected="selected"' ; }?>>تحت فشار قطره ای</option>
                    <option value="6" <?php if ($no_ab=='6') { echo 'selected="selected"' ; }?>>تحت فشار بارانی</option>
                    <option value="7" <?php if ($no_ab=='7') { echo 'selected="selected"' ; }?>>سایر</option>
                    </select>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نحوه آبیاری</div></td>
                </tr>
              </table>
  <?php }?>
            </td>
        </tr>
  <?php if($nah_kesh<>'3'){?>
          <?php }?> 
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="id" value=<?php echo $id; ?> />
     <input type="hidden" name="sh_gat" value=<?php echo $sh_gat; ?> />
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="hidden" name="no_kesh" value=<?php echo $no_kesh; ?> />
     <input type="hidden" name="nah_kesh" value=<?php echo $nah_kesh; ?> />
     <input type="hidden" name="no_mal" value=<?php echo $no_mal; ?> />
     <input type="hidden" name="check_cod" value=<?php echo $check_cod; ?> />
     <input type="hidden" name="id_page"  value="<?php echo $id_page ;?>" />
     <input type="submit" name="cancel" value="انصراف" style="width:150px ; height:45px" tabindex="32" id="btn1" />
     <input type="submit" name="action" value="تصحیح اطلاعات" style="width:150px ; height:45px" tabindex="33" id="submit" onClick="setTimeout(disableFunction, 1);"/>
        </p>
      </div>
</form> 
<script>
function disableFunction() {
    document.getElementById("submit").disabled = 'true';
	$("#submit").attr("disabled","");
}
</script>  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Garden.php">
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
