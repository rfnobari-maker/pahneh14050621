<?php 
function getProd($username,$password,$days_ago,$num_part) {
if ( $username == "user_GTC" and $password == "Sa#912E27@511" ) {
include('../login/config.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_check =  jdate('Y/m/d',time()-($days_ago*86400)) ;
$start = ($num_part-1)*50 ; 
echo $query = "SELECT Agri_prod.`date_s` ,
Agri_prod.`id_ostan` , 
bah.`no_bah` ,
Agri_prod.`bah_cod_m` ,
Agri_prod.`mah_tolp` ,
bah.`last_name` ,
bah.`name` ,
bah.`co_name` ,
bah.`sh_meli` 
FROM (
SELECT *
FROM Agri_prod
WHERE `z_sal` = '1396-1397'
AND `cod_mah` = '102'
AND `cod_qroup` = '1'
AND Agri_prod.date_s = '$date_check'
)Agri_prod
INNER JOIN bah ON Agri_prod.bah_cod_m = bah.bah_cod_m
AND Agri_prod.num_bah = bah.num_bah
where bah.ok = '1'
GROUP BY Agri_prod.bah_cod_m, Agri_prod.`id_ostan`,Agri_prod.`num_bah`  limit $start,50"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetchAll();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['mah_tolp'];
	}
	else {
            return "خطا";
	}
}
?>