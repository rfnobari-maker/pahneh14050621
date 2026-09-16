<?php
include('../../lock_expar.php');
include('../../event.php');

if(isset($_POST['s_abi']))
{
    function clean_number($value) {
        return str_replace('٬', '', $value);
    }

    $s_abi   = clean_number($_POST['s_abi']) ;
    $s_dem   = clean_number($_POST['s_dem']) ;
    $t_abi   = clean_number($_POST['t_abi']) ;
    $t_dem   = clean_number($_POST['t_dem']) ;
    $a_abi   = clean_number($_POST['a_abi']) ;
    $a_dem   = clean_number($_POST['a_dem']) ;
    $id      = clean_number($_POST['id']) ;
    $z_sal     = $_POST['z_sal'] ;
    $id_ostan = $_POST['id_ostan'];
    $id_city = $_POST['id_city'];
    $product_cod = $_POST['product_cod'];
    $group_cod = $_POST['group_cod'];

    require_once('../../Jalali.php');
    date_default_timezone_set('Asia/Tehran') ;
    $date_edit = jdate("Y/m/d");
    $time = date('H:i:s') ;
    include('../../login/config.php');

    try {
        $query = "UPDATE Agri_ab_city SET date_s=?,s_abi=?,s_dem=?,t_abi=?,t_dem=?,a_abi=?,a_dem=? WHERE id=? ";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array($date_edit,$s_abi,$s_dem,$t_abi,$t_dem,$a_abi,$a_dem,$id));
        echo "success";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "invalid request";
}
?>
