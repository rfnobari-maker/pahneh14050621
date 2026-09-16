<?php
include('event.php') ;
include('login/config.php') ; 
$query = "UPDATE eagri_pahneh.users SET Access = '1' WHERE username = '1689565624' or username = '3369340615'  
or username ='4284815741'
or username ='4371948278'
or username ='5609951879'
or username ='4284982737'
or username ='4410969897'
or username ='0067538411' ";

$q = $dbh->prepare($query);
$q->execute(array());
alert('انجام شد')
?>