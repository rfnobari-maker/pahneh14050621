<?php
$mysql_hostname = "localhost";
$mysql_user = "aeoazshi_lic";
$mysql_password = "Reza3294563";
$mysql_database = "aeoazshi_license";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
?>