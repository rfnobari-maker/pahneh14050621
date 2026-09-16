<?php
require_once('Jalali.php');
require('./login/config.php');
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");

// Prepare and execute the query
$stmt = $dbh->prepare("SELECT 
    bah.date_s,
    bah.mor_cod_m,
    bah.bah_cod_m,
    bah.num_bah,
    bah.no_bah,
    bah.name,
    bah.last_name,
    bah.date_t,
    bah.fname,
    bah.sh_meli,
    bah.tel_m,
    bah.co_name,
    bah.id_ostan,
    bah.id_city,
    bah.id_mar,
    bah.sh_sh,
    bah.m_tah,
    bah.er_mtah,
    bah.tel_s,
    bah.s_bah,
    bah.jens,
    bah.co_sabt,
    bah.cod_p,
    bah.ok,
    bah.no_nation
FROM bah  
LEFT JOIN bah20 ON bah.bah_cod_m = bah20.bah_cod_m AND bah.no_bah = bah20.no_bah 
WHERE bah20.bah_cod_m IS NULL");

$stmt->execute();

if ($stmt->rowCount() > 0) {
    $delimiter = ",";
    $filename = "bah3.csv";
    
    // Create a file pointer
    $f = fopen('php://memory', 'w');
    
 // Set column headers
 // $fields = array('date_s', 'mor_cod_m', 'bah_cod_m', 'no_bah', 'num_bah', 'name', 'last_name', 'date_t','fname', 'sh_meli', 'tel_m', 'co_name', 'id_ostan', 'id_city', 'id_mar','sh_sh', 'm_tah', 'er_mtah', 'tel_s', 's_bah', 'jens', 'co_sabt', 'cod_p','ok', 'no_nation');
    fputcsv($f, $fields, $delimiter);
    
    // Output each row of the data, format line as CSV and write to file pointer
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $lineData = array($row['date_s'], $row['mor_cod_m'], $row['bah_cod_m'], $row['no_bah'], $row['num_bah'], $row['name'], $row['last_name'], $row['date_t'],
                          $row['fname'], $row['sh_meli'], $row['tel_m'], $row['co_name'], $row['id_ostan'], $row['id_city'], $row['id_mar'],
                          $row['sh_sh'], $row['m_tah'], $row['er_mtah'], $row['tel_s'], $row['s_bah'], $row['jens'], $row['co_sabt'], $row['cod_p'],
                          $row['ok'], $row['no_nation']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    // Move back to the beginning of the file
    fseek($f, 0);
    
    // Set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    // Output all remaining data on a file pointer
    fpassthru($f);
}
exit;
?>
