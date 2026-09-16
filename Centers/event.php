<?php
function sabt_event($username,$ip,$date,$time,$add_abadi,$verb)
{
include('../login/config.php');
$query = "INSERT INTO log (username,ip,date,time,add_abadi,verb) VALUES (:username,:ip,:date,:time,:add_abadi,:verb)";
$q = $dbh->prepare($query);
$q->execute(array(':username'=>$username,':ip'=>$ip,':date'=>$date,':time'=>$time,':add_abadi'=>$add_abadi,':verb'=>$verb));
$dbh = null;
}
?>