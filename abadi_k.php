<?php
require_once('Jalali.php');
require_once('./login/config.php'); // فایل config.php را اضافه کنید
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");

//get records from database

// به جای mysqli از PDO استفاده کنید
$query = $dbh->query("SELECT * from list_abadi WHERE 1");

if ($query->rowCount() > 0) {
    $delimiter = ",";
    $filename = "list_abadi.csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    // $fields = array('date_s','bah_cod_m','no_bah','num_bah', 'name', 'last_name', 'date_t', 'fname','co_name','sh_meli','id_ostan','id_city','ok');
    // توجه: خط بالا به دلیل کامنت بودن در کد اصلی، در کد جدید نیز کامنت باقی می‌ماند.
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $lineData = array($row['id'], $row['id_ostan'], $row['ostan'], $row['id_city'], $row['city'], $row['bakh'], $row['deh'], $row['id_mar'], $row['mar'], $row['abadi'], $row['mor_cod_m'], $row['add_abadi'], $row['add_deh'], $row['add_bakh'], $row['post_cod']);
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