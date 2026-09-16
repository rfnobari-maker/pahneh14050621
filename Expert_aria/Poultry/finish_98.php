<?php
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
 include('../../login/config.php');
         $query = "UPDATE  users SET end_bee=?,con_center=?,con_city=?,con_ostan=? where S_access='1' and id_ostan = '18' and end_bee = ''" ;
         $q = $dbh->prepare($query);
         $q->execute(array('1','1','1','1'));
?>