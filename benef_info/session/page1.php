<?php 
session_start();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['userName'] = $actual_link;
echo $_SESSION['userName'] ;
echo "<p><a title='page2' href='page2.php'>page2</a>"
?>
