<?php 
include("../../lock_p1.php");
echo $add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
echo $add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
echo $bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
echo $sh_gat = isset($_POST['sh_gat']) ? $_POST['sh_gat'] : '';
echo $z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
echo $id = isset($_POST['id']) ? $_POST['id'] : '';
$id_page = isset($_POST['id_page']) ? $_POST['id_page'] : '';
$id_page = isset($_POST['id_page']) ? $_POST['id_page'] : '';
if($id_page < 1 || $id_page == '') { 
    $id_page = 1; 
}
 $Agri_table      = 'Agri'.str_replace('-','_',$z_sal) ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
 if ($z_sal=='1404-1405' or $z_sal=='1405-1406') $Agri_edit_available = '1'  ;  else  $Agri_edit_available = '0';  
include('../../event.php');
require_once('../../Jalali.php');
 if (isset($_POST['bah_cod_m']) and $Agri_edit_available == '1') 
 { 
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
$error = 0 ;
$query = "SELECT id from `$Agri_prod_table` where Agri_id = $id ";
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row)
{
 $prod_id = $row['id'] ;
// $prod_id = 17375 ; 

if (check_payesh($prod_id,0,substr($z_sal, 0, 4)) == 2)  $error = 1    ; 
if (check_payesh($prod_id,0,substr($z_sal, 0, 4)) == 0)  $error = 2    ; 
}
if ( $error == 1 )
{
?>
<form name="myform" class="myform" method="post" action="liste_Agri.php?id=<?php echo $id_page .'#1' ?>">
     <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ?>" />
     <input type="hidden" name="action_lise" value="1" />
     <input type="hidden" name="back_p" value="1" />
     <input type="hidden" name="com_alert" value="برای محصول / محصولات این قطعه توسط سامانه پایش نهاده اختصاص داده شده ، حذف مقدور نمیباشد">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
if ( $error == 2 )
{
?>
<form name="myform" class="myform" method="post" action="liste_Agri.php?id=<?php echo $id_page .'#1' ?>">
     <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ?>" />
     <input type="hidden" name="action_lise" value="1" />
     <input type="hidden" name="back_p" value="1" />
     <input type="hidden" name="com_alert" value="خطا! عدم ارتباط با وب سرویس سامانه پایش ، بعدا بررسی کنید">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
 
if ($error == 0 )
{
$query = "DELETE FROM `$Agri_table` WHERE  id=? ORDER BY id ASC LIMIT 1";
$q = $dbh->prepare($query);
$q->execute(array($id));
$query = "
    INSERT INTO `del_rec` (`Date`, `Table_id`, `Table_name`, `sal`, `bah_cod_m`, `mor_cod_m`, `cod_mah`, `date_s`, `num_bah`, `no_kesh`, `zer_kesht_a`, `zer_kesht_b`, `mah_tolp`, `add_abadi`, `add_city`)
    SELECT :Date, id, :Table_name, :sal, bah_cod_m, :mor_cod_m, cod_mah, date_s, num_bah, no_kesh, zer_kesht_a, zer_kesht_b, mah_tolp, add_abadi, add_city
    FROM `$Agri_prod_table`
    WHERE Agri_id = :Agri_id
";
$q = $dbh->prepare($query);
$q->execute(array(
    ':Date' => $date_edit,
    ':Table_name' => $Agri_prod_table,
    ':sal' => $z_sal,
    ':mor_cod_m' => $login_session,
    ':Agri_id' => $id
));
$query = "DELETE FROM `$Agri_prod_table` WHERE  Agri_id=?  ";
$q = $dbh->prepare($query);
$q->execute(array($id));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'حذف اطلاعات زراعی - '.$bah_cod_m,$id_ostan) ; 

?>
<form name="myform" class="myform" method="post" action="liste_Agri.php?id=<?php echo $id_page .'#1' ?>">
     <input type="hidden" name="com_alert" value="اطلاعات زراعی با موفقیت حذف شد">
     <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ?>" />
     <input type="hidden" name="action_lise" value="1" />
     <input type="hidden" name="back_p" value="1" />

</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
 else 
 { 
?>
<form name="myform" class="myform" method="post" action="liste_Agri.php#1">
     <input type="hidden" name="bah_cod_m" value="" />
     <input type="hidden" name="action_lise" value="1" />
     <input type="hidden" name="back_p" value="1" />
     <input type="hidden" name="com_alert" value="خطایی در حذف اطلاعات زراعی رخ داده است">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 } 
}
