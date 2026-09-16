<?php
function zan_sma($sal,$id_ostan1)
{
include('../../login/config.php');
 $query = "SELECT COUNT( * ) 
FROM bee
WHERE m_ostan !=  '-'
AND m_ostan !=  '$id_ostan1'
AND id_ostan =  '$id_ostan1'
AND sal =  '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 

}
echo zan_sma('1397','03') ; 
?>