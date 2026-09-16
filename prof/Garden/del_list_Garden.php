<?php 
include("../../lock_p1.php");
include('../../event.php');
require_once('../../Jalali.php');
include_once('../../login/config.php');

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

// دریافت پارامترها
$id_page = isset($_POST['id_page']) && $_POST['id_page'] != '' ? intval($_POST['id_page']) : 1;
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$sh_gat = isset($_POST['sh_gat']) ? $_POST['sh_gat'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$Garden_table = 'Garden';
$Garden_prod_table = 'Garden_prod';

if (isset($_POST['bah_cod_m']) && $id > 0) {
    
    $error = 0;
    
    // بررسی محدودیت پایش برای تمام محصولات این باغ
    $query = "SELECT id FROM `$Garden_prod_table` WHERE Garden_id = :garden_id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':garden_id' => $id));
    
    foreach($stmt as $row) {
        $prod_id = $row['id'];
        $check_result = check_payesh($prod_id, 1, substr($z_sal, 0, 4));
        
        if ($check_result == 2) {
            $error = 1;  // نهاده اختصاص داده شده
            break;
        }
        if ($check_result == 0) {
            $error = 2;  // خطا در ارتباط با وب سرویس
            break;
        }
    }
    
    // خطا: نهاده اختصاص داده شده
    if ($error == 1) {
        ?>
        <form name="myform" class="myform" method="post" action="liste_Garden.php?id=<?php echo $id_page . '#1' ?>">
            <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" />
            <input type="hidden" name="action_lise" value="1" />
            <input type="hidden" name="back_p" value="1" />
            <input type="hidden" name="com_alert" value="برای محصول / محصولات این باغ توسط سامانه پایش نهاده اختصاص داده شده، حذف مقدور نمیباشد">
        </form>
        <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit;
    }
    
    // خطا: عدم ارتباط با وب سرویس
    if ($error == 2) {
        ?>
        <form name="myform" class="myform" method="post" action="liste_Garden.php?id=<?php echo $id_page . '#1' ?>">
            <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" />
            <input type="hidden" name="action_lise" value="1" />
            <input type="hidden" name="back_p" value="1" />
            <input type="hidden" name="com_alert" value="خطا! عدم ارتباط با وب سرویس سامانه پایش، بعدا بررسی کنید">
        </form>
        <script type="text/javascript">document.myform.submit();</script>
        <?php
        exit;
    }
    
    // اگر خطایی وجود نداشت، حذف انجام شود
    if ($error == 0) {
        try {
            $dbh->beginTransaction();
            
            // ثبت محصولات در جدول تاریخچه del_rec_Garden
            $query = "
                INSERT INTO `del_rec_Garden` (`Date`, `Table_id`, `Table_name`, `sal`, `bah_cod_m`, `mor_cod_m`, `cod_mah`, `date_s`, `num_bah`, `no_kesh`, `nah_kesh`, `s_kesht_b`, `s_kesht_gb`, `tree_b`, `tree_gb`, `mah_tolp`, `mah_tol`, `mah_bem`, `mah_kh`, `add_abadi`, `add_city`, `Type_Op`)
                SELECT :Date, id, :Table_name, :sal, bah_cod_m, :mor_cod_m, cod_mah, date_s, num_bah, no_kesh, nah_kesh, s_kesht_b, s_kesht_gb, tree_b, tree_gb, mah_tolp, mah_tol, mah_bem, mah_kh, add_abadi, add_city, :Type_Op
                FROM `$Garden_prod_table`
                WHERE Garden_id = :garden_id
            ";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(
                ':Date' => $date_edit,
                ':Table_name' => $Garden_prod_table,
                ':sal' => substr($z_sal, 0, 4),
                ':mor_cod_m' => $login_session,
                ':Type_Op' => '3',  // 3 = حذف کل باغ
                ':garden_id' => $id
            ));
            
            // حذف محصولات از جدول Garden_prod
            $query = "DELETE FROM `$Garden_prod_table` WHERE Garden_id = :garden_id";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':garden_id' => $id));
            
            // حذف باغ از جدول Garden
            $query = "DELETE FROM `$Garden_table` WHERE id = :id AND bah_cod_m = :bah_cod_m";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':id' => $id, ':bah_cod_m' => $bah_cod_m));
            
            // ثبت رویداد
            sabt_event(
                $login_session,
                getUserIP_1(),
                $date_edit,
                $time,
                $add_abadi,
                'حذف اطلاعات باغی - ' . $bah_cod_m,
                $id_ostan
            );
            
            $dbh->commit();
            ?>
            <form name="myform" class="myform" method="post" action="liste_Garden.php?id=<?php echo $id_page . '#1' ?>">
                <input type="hidden" name="com_alert" value="اطلاعات باغی با موفقیت حذف شد">
                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" />
                <input type="hidden" name="action_lise" value="1" />
                <input type="hidden" name="back_p" value="1" />
            </form>
            <script type="text/javascript">document.myform.submit();</script>
            <?php
        } catch (PDOException $e) {
            $dbh->rollBack();
            ?>
            <form name="myform" class="myform" method="post" action="liste_Garden.php?id=<?php echo $id_page . '#1' ?>">
                <input type="hidden" name="com_alert" value="خطا در حذف اطلاعات باغی: <?php echo $e->getMessage(); ?>">
                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" />
                <input type="hidden" name="action_lise" value="1" />
                <input type="hidden" name="back_p" value="1" />
            </form>
            <script type="text/javascript">document.myform.submit();</script>
            <?php
        }
    }
} else {
    ?>
    <form name="myform" class="myform" method="post" action="liste_Garden.php?id=<?php echo $id_page . '#1' ?>">
        <input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات باغی رخ داده است">
        <input type="hidden" name="bah_cod_m" value="" />
        <input type="hidden" name="action_lise" value="1" />
        <input type="hidden" name="back_p" value="1" />
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
}
?>