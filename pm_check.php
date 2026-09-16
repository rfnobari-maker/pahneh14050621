<?php
include('../login/config.php') ;
$query = "SELECT ru_read FROM  pm WHERE r_user = '$login_session' and  ru_read = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_pm = $stmt -> rowCount();
if ($count_pm > 0) {
header("Location:messanger.php?unread");
}
?>