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
$query = $db->query("SELECT 
bah.date_s,
bah.mor_cod_m,
bah.sp_cod_m,
bah.bah_cod_m,
bah.num_bah,
bah.no_bah,
bah.name,
bah.last_name,
bah.date_t,
bah.fname,
bah.sh_meli,
bah.tel_m,
bah.valid,
bah.co_name,
bah.id_ostan,
bah.id_city ,
bah.id_mar,
bah.add_abadi,
bah.add_city,
bah.sh_sh,
bah.m_tah,
bah.er_mtah,
bah.tel_s,
bah.s_bah,
bah.jens,
bah.co_sabt,
bah.cod_p,
bah.ok ,
bah.no_nation 
 FROM bah  
 left join bah20 on bah.bah_cod_m = bah20.bah_cod_m  and bah.no_bah = bah20.no_bah 
WHERE bah20.bah_cod_m is null order by bah.bah_cod_m ");
if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "bah3.csv";
   
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
   // $fields = array('date_s','bah_cod_m','no_bah','num_bah', 'name', 'last_name', 'date_t', 'fname','co_name','sh_meli','id_ostan','id_city','ok');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $lineData = array($row['date_s'],$row['mor_cod_m'],$row['sp_cod_m'],$row['bah_cod_m'], $row['no_bah'], $row['num_bah'], $row['name'], $row['last_name'], $row['date_t'],
		 $row['fname'], $row['co_name'], $row['sh_meli'],$row['tel_m'],$row['valid'],$row['id_ostan'],$row['id_city'],$row['id_mar'],$row['add_abadi'],
		 $row['add_city'],$row['sh_sh'],$row['m_tah'],$row['er_mtah'],$row['tel_s'],$row['s_bah'],$row['jens'],$row['co_sabt'],$row['cod_p']
		 ,$row['ok'],$row['no_nation'],0);
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