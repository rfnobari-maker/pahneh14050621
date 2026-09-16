<?php
require_once('Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
//get records from database

//DB details
$dbHost     = 'localhost';
$dbUsername = 'eagri_upahneh';
$dbPassword = 'Reza9147857121';
$dbName     = 'eagri_pahneh';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if($db->connect_error){
    die("Unable to connect database: " . $db->connect_error);
}
$query = $db->query("SELECT id_ostan,id_city,sum(zer_kesht) as zer_kesht,sum(s_bar) as s_bar FROM Vege_prod WHERE z_sal = '1400-1401' group by id_ostan,id_city  ");


if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "Vege.csv";
   
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('id_ostan','id_city','zer_kesht', 's_bar');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
    $lineData = array($row['id_ostan'],$row['id_city'],$row['zer_kesht'],$row['s_bar']);
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
?>