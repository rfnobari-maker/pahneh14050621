<?php
include("../login/config.php");
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
 if (isset($_POST['go']) && $_POST['days_ago'] >= '1' ) {
 $days_ago = $_POST['days_ago'] ; 
 $date_check =  jdate('Y/m/d',time()-($days_ago*86400)) ;
 $query = "SELECT Agri_prod.`date_s` ,
Agri_prod.`id_ostan` , 
bah.`no_bah` ,
Agri_prod.`bah_cod_m` ,
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
AND `mah_tolp` > 0 
AND Agri_prod.date_s = '$date_check'
)Agri_prod
INNER JOIN bah ON Agri_prod.bah_cod_m = bah.bah_cod_m
AND Agri_prod.num_bah = bah.num_bah
where bah.ok = '1'
GROUP BY Agri_prod.bah_cod_m, Agri_prod.`id_ostan`,Agri_prod.`num_bah`   ";
$stmt = $dbh->prepare($query);
$stmt->execute();
if($stmt -> rowCount() > 0){	
    $delimiter = ",";
    $filename = "list_" . jdate('Y-m-d',time()-($days_ago*86400)) . ".csv";
    //create a file pointer
    $f = fopen('php://memory', 'w');
    //set column headers
    $fields = array('id_ostan', 'no_bah'  ,'bah_cod_m', 'name', 'last_name','co_name', 'sh_meli','mah_tolp');
    fputcsv($f, $fields, $delimiter);
    //output each row of the data, format line as csv and write to file pointer
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	foreach($stmt as $row)
	{
	if($row['no_bah'] == '1') 
	{
      $row['co_name'] = '-'  ; 
      $row['sh_meli'] = '-'  ; 
      $bah_cod_m = $row['bah_cod_m'] ; 
	}
	if($row['no_bah'] == '2') 
	{
      $row['name'] = '-'  ; 
      $row['last_name'] = '-'  ; 
      $bah_cod_m = '-' ; 
	}
   $lineData = array(
   $row['id_ostan'],$row['no_bah'],$bah_cod_m, $row['name'], $row['last_name'],$row['co_name'],$row['sh_meli'],kol_mah($row['id_ostan'],$row['bah_cod_m'],$row['no_bah'])
   );
        fputcsv($f, $lineData, $delimiter);
    }
    //move back to beginning of file
    fseek($f, 0);
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;
}
else 
{
?>
<form  name="myform" class="myform" method="post" action="day_list.php">
<input type="hidden" name="error" value="خطا در انتخاب روز" >
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
<?php
function kol_mah($id_ostan,$bah_cod_m,$num_bah) 
{include("../login/config.php");
$query = "SELECT sum(mah_tolp) as mah_tolp from Agri_prod 
where `z_sal` = '1396-1397'
AND `cod_mah` = '102'
AND `cod_qroup` = '1'
and `id_ostan` = '$id_ostan'
and `bah_cod_m` = '$bah_cod_m'
and `num_bah` = '$num_bah'
group by `id_ostan`,`bah_cod_m`,`num_bah`";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return  $row['mah_tolp']*1 ; 
$dbh = null;
}
?>