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
id,
id_ostan,
id_city,
id_mar,
username,
name,
Last_name,
cod_m,
tel_m,
m_tah,
r_tah
 FROM users  where S_access = '1'
   ");

// open the file "demosaved.csv" for writing
$file = fopen('users2.csv', 'w');
 
// save the column headers
//fputcsv($file, array('Column 1', 'Column 2', 'Column 3', 'Column 4', 'Column 5'));
 
// Sample data. This can be fetched from mysql too
    while($row = $query->fetch_assoc()){
        $data = array($row['id'],$row['id_ostan'],$row['id_city'],$row['id_mar'],$row['username'],$row['name']
		,$row['Last_name'], $row['cod_m'],$row['tel_m'],$row['m_tah'],$row['r_tah']);
fputcsv($file, $row);
}
 
// Close the file
fclose($file);
?>