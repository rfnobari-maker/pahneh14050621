<?php
include('../event.php');
$dbHost     = 'localhost';
$dbUsername = 'eagri_upahneh';
$dbPassword = 'Reza9147857121';
$dbName     = 'eagri_pahneh';
alert('inja') ; 
//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if($db->connect_error){
    die("Unable to connect database: " . $db->connect_error);
}

         // Open uploaded CSV file with read-only mode
            $csvFile = fopen('/var/www/html/reza/bah_day.csv', 'r');
           
            // Skip the first line
          //  fgetcsv($csvFile);
     //			$line = fgetcsv($csvFile) ;
alert($csvFile);            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
$date_s      = $line[0];
$mor_cod_m   = $line[1];
$bah_cod_m   = $line[2];
$num_bah     = $line[3];
$no_bah      = $line[4];
$name        = $line[5];
alert($name) ; 
$last_name   = $line[6];
$date_t      = $line[7];
$fname       = $line[8];
$sh_meli     = $line[9];
$tel_m       = $line[10];
$co_name     = $line[11];
$id_ostan    = $line[12];
$id_city     = $line[13];
$id_mar      = $line[14];
$sh_sh       = $line[15];
$m_tah       = $line[16];
$er_mtah     = $line[17];
$tel_s       = $line[18];
$s_bah       = $line[19];
$jens        = $line[20];
$co_sabt     = $line[21];
$cod_p       = $line[22];
$ok          = $line[23];
$no_nation   = $line[24];
$id          = $line[25]; 
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT id FROM bah2 WHERE bah_cod_m = '".$line[2]."' and no_bah = '".$line[4]."' ";
                $prevResult = $db->query($prevQuery);
               
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                $db->query("UPDATE bah2 SET `date_s`='".$date_s."',`mor_cod_m`='".$mor_cod_m."',`bah_cod_m`='".$bah_cod_m."',`no_bah`='".$no_bah."',`num_bah`='".$num_bah."',`name`='".$name."',`last_name`='".$last_name."',`date_t`='".$date_t."',`fname`='".$fname."',`co_name`='".$co_name."',`sh_meli`='".$sh_meli."',`tel_m`='".$tel_m."',`id_ostan`='".$id_ostan."',`id_city`='".$id_city."',`id_mar`='".$id_mar."',`sh_sh`='".$sh_sh."',`m_tah`='".$m_tah."',`er_mtah`='".$er_mtah."',`tel_s`='".$tel_s."',`s_bah`='".$s_bah."',`jens`='".$jens."',`co_sabt`='".$co_sabt."',`cod_p`='".$cod_p."',`ok`='".$ok."',`no_nation`='".$no_nation."'");
                }else{
                    // Insert member data in the database
                 $db->query("INSERT INTO `bah2`(`date_s`, `mor_cod_m`, `bah_cod_m`, `no_bah`, `num_bah`, `name`, `last_name`, `date_t`, `fname`, `co_name`, `sh_meli`, `tel_m`, `id_ostan`, `id_city`, `id_mar`, `sh_sh`, `m_tah`, `er_mtah`, `tel_s`, `s_bah`, `jens`, `co_sabt`, `cod_p`, `ok`, `no_nation`, `id`)
				  VALUES ('".$date_s."','".$mor_cod_m."','".$bah_cod_m."','".$no_bah."','".$num_bah."','".$name."',
				  '".$last_name."','".$date_t."','".$fname."','".$co_name."','".$sh_meli."','".$tel_m."','".$id_ostan."',
				  '".$id_city."','".$id_mar."','".$sh_sh."','".$m_tah."','".$er_mtah."','".$tel_s."','".$s_bah."',
				  '".$jens."','".$co_sabt."','".$cod_p."','".$ok."','".$no_nation."','".$id."')");
	            }
            }
            
            // Close opened CSV file
            fclose($csvFile);
?>			