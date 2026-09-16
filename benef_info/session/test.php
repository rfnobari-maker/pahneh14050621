<?php
session_start();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['test'] = array("username"=>"alireza","age"=>"45","page_url"=>$actual_link) ;
?>
<a href="test2.php">test2</a>