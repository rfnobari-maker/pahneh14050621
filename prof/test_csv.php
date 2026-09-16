<?php
$dbHost     = 'localhost';
$dbUsername = 'eagri_upahneh';
$dbPassword = 'Reza9147857121';
$dbName     = 'eagri_pahneh';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if($db->connect_error){
    die("Unable to connect database: " . $db->connect_error);
}
$query = $db->query("SELECT 
bah.`date_s`,
bah.`mor_cod_m`,
bah.`bah_cod_m`,
bah.`num_bah`,
bah.`no_bah`,
bah.`name`,
bah.`last_name`,
bah.`date_t`,
bah.`fname`,
bah.`sh_meli`,
bah.`tel_m`,
bah.`co_name`,
bah.`id_ostan`,
bah.`id_city` ,
bah.`id_mar`,
bah.`sh_sh`,
bah.`m_tah`,
bah.`er_mtah`,
bah.`tel_s`,
bah.`s_bah`,
bah.`jens`,
bah.`co_sabt`,
bah.`cod_p`,
bah.`ok` ,
bah.`ok` ,
bah.`no_nation` ,
bah.`id` 
 FROM `bah`  
WHERE 1 limit 10 ");

// open the file "demosaved.csv" for writing
$file = fopen('bah_day.csv', 'w');
 
// save the column headers
//fputcsv($file, array('Column 1', 'Column 2', 'Column 3', 'Column 4', 'Column 5'));
 
// Sample data. This can be fetched from mysql too
    while($row = $query->fetch_assoc()){
        $lineData = array($row['date_s'],$row['mor_cod_m'],$row['bah_cod_m'], $row['no_bah'], $row['num_bah'], $row['name'], $row['last_name'], $row['date_t'],
		 $row['fname'], $row['co_name'], $row['sh_meli'],$row['tel_m'],$row['id_ostan'],$row['id_city'],$row['id_mar'],
		 $row['sh_sh'],$row['m_tah'],$row['er_mtah'],$row['tel_s'],$row['s_bah'],$row['jens'],$row['co_sabt'],$row['cod_p']
		 ,$row['ok'],$row['no_nation'],$row['id']);
fputcsv($file, $row);
}
 
// Close the file
fclose($file);
?>