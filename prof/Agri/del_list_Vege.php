<?php
include("../../lock_p1.php");
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$sh_gat = isset($_POST['sh_gat']) ? $_POST['sh_gat'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';
$id_page = isset($_POST['id_page']) ? $_POST['id_page'] : '';
if ($id_page < 1 || $id_page == '') {
    $id_page = 1;
}

$Vege_table      = 'Vege';
$Vege_prod_table = 'Vege_prod';

include('../../event.php');
require_once('../../Jalali.php');

if ($z_sal == '' && $id !== '') {
    $stmt_sal = $dbh->prepare("SELECT z_sal FROM `$Vege_table` WHERE id = ? LIMIT 1");
    $stmt_sal->execute(array($id));
    $sal_row = $stmt_sal->fetch(PDO::FETCH_ASSOC);
    if ($sal_row && isset($sal_row['z_sal'])) {
        $z_sal = $sal_row['z_sal'];
    }
}

if ($z_sal == '1404-1405' or $z_sal == '1405-1406') $Vege_edit_available = '1'; else $Vege_edit_available = '0';

function vege_del_back($id_page, $bah_cod_m, $z_sal, $add_abadi, $add_city, $msg)
{
    ?>
<form name="myform" class="myform" method="post" action="liste_Vege.php?id=<?php echo (int)$id_page; ?>#1">
     <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m, ENT_QUOTES, 'UTF-8'); ?>" />
     <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8'); ?>" />
     <input type="hidden" name="add_abadi" value="<?php echo htmlspecialchars($add_abadi, ENT_QUOTES, 'UTF-8'); ?>" />
     <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($add_city, ENT_QUOTES, 'UTF-8'); ?>" />
     <input type="hidden" name="action_lise" value="1" />
     <input type="hidden" name="back_p" value="1" />
     <input type="hidden" name="com_alert" value="<?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?>" />
</form>
<script type="text/javascript">document.myform.submit();</script>
    <?php
}

if (isset($_POST['bah_cod_m']) and $Vege_edit_available == '1') {
    date_default_timezone_set('Asia/Tehran');
    $date_edit = jdate("Y/m/d");
    $time = date('H:i:s');
    include('../../login/config.php');
    $error = 0;

    $query = "SELECT id from `$Vege_prod_table` where Vege_id = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($id));
    foreach ($stmt as $row) {
        $prod_id = $row['id'];
        $payesh = check_payesh($prod_id, 4, substr($z_sal, 0, 4));
        if ($payesh == 2) $error = 1;
        if ($payesh == 0) $error = 2;
    }

    if ($error == 1) {
        vege_del_back($id_page, $bah_cod_m, $z_sal, $add_abadi, $add_city, 'برای محصول / محصولات این قطعه توسط سامانه پایش نهاده اختصاص داده شده ، حذف مقدور نمیباشد');
    } elseif ($error == 2) {
        vege_del_back($id_page, $bah_cod_m, $z_sal, $add_abadi, $add_city, 'خطا! عدم ارتباط با وب سرویس سامانه پایش ، بعدا بررسی کنید');
    } else {
        $query = "DELETE FROM `$Vege_table` WHERE  id=? ORDER BY id ASC LIMIT 1";
        $q = $dbh->prepare($query);
        $q->execute(array($id));

        $query = "
            INSERT INTO `del_rec` (`Date`, `Table_id`, `Table_name`, `sal`, `bah_cod_m`, `mor_cod_m`, `cod_mah`, `date_s`, `num_bah`, `no_kesh`, `zer_kesht_a`, `zer_kesht_b`, `mah_tolp`, `add_abadi`, `add_city`)
            SELECT :Date, id, :Table_name, :sal, bah_cod_m, :mor_cod_m, cod_mah, date_s, num_bah, no_kesh, zer_kesht_a, zer_kesht_b, mah_tolp, add_abadi, add_city
            FROM `$Vege_prod_table`
            WHERE Vege_id = :Vege_id
        ";
        $q = $dbh->prepare($query);
        $q->execute(array(
            ':Date' => $date_edit,
            ':Table_name' => $Vege_prod_table,
            ':sal' => $z_sal,
            ':mor_cod_m' => $login_session,
            ':Vege_id' => $id
        ));

        $query = "DELETE FROM `$Vege_prod_table` WHERE  Vege_id=?  ";
        $q = $dbh->prepare($query);
        $q->execute(array($id));

        sabt_event($login_session, getUserIP_1(), $date_edit, $time, $add_abadi, 'حذف اطلاعات محصولات جالیزی - ' . $bah_cod_m, $id_ostan);
        vege_del_back($id_page, $bah_cod_m, $z_sal, $add_abadi, $add_city, 'اطلاعات محصولات جالیزی با موفقیت حذف شد');
    }
} else {
    vege_del_back($id_page, $bah_cod_m, $z_sal, $add_abadi, $add_city, 'خطایی در حذف اطلاعات محصولات جالیزی رخ داده است');
}
