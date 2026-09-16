<?php
require_once('Jalali.php');
require_once('./login/config.php'); // Include the config.php file
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");

// Get records from database
// Use PDO instead of mysqli
$query = $dbh->query("SELECT * FROM mar");

if ($query->rowCount() > 0) {
    $delimiter = ",";
    $filename = "mar.csv";
    
    // Create a file pointer
    $f = fopen('php://memory', 'w');
    
    // Set column headers
    // The commented line from the original code remains commented here as well.
    // $fields = array('date_s','bah_cod_m','no_bah','num_bah', 'name', 'last_name', 'date_t', 'fname','co_name','sh_meli','id_ostan','id_city','ok');
    
    // Output each row of the data, format line as CSV and write to file pointer
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $lineData = array($row['id'], $row['id_ostan'], $row['ostan'], $row['id_city'], $row['city'], $row['id_mar'], $row['mar']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    // Move back to the beginning of the file
    fseek($f, 0);
    
    // Set headers to download the file rather than display it
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    // Output all remaining data on a file pointer
    fpassthru($f);
}
exit;
?>