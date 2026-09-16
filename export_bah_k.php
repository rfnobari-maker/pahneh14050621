<?php
require_once('Jalali.php');
require_once('./login/config.php'); // فایل config.php را اضافه کنید
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");

//get records from database

// به جای mysqli از PDO استفاده کنید
$query = $dbh->query("SELECT * from bah WHERE 1"); // اشتباه تایپی frob به from اصلاح شد

if($query->rowCount() > 0){
    $delimiter = ",";
    $filename = "bah.csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    // $fields = array('date_s','bah_cod_m','no_bah','num_bah', 'name', 'last_name', 'date_t', 'fname','co_name','sh_meli','id_ostan','id_city','ok');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $lineData = array(
            $row['id'],$row['date_s'],$row['id_ostan'],$row['id_city'],$row['id_mar'],$row['add_abadi'],$row['add_city'],$row['mor_cod_m'],$row['bah_cod_m'],$row['no_bah'],$row['s_bah'],$row['num_bah'],$row['cod_p'],
            $row['jens'],$row['name'],$row['last_name'],$row['date_t'],$row['sh_sh'],$row['m_sod'],$row['fname'],$row['m_tah'],$row['er_mtah'],$row['tel_s'],$row['tel_m'],$row['ostan_s'],$row['shahr_s'],$row['city_s'],$row['rosta_s'],$row['co_name'],
            $row['sh_meli'],$row['no_co'],$row['co_sabt'],$row['fa_1'],$row['fa_2'],$row['fa_3'],$row['fa_45'],$row['fa_67'],$row['fa_8'],$row['fa_9'],$row['fa_10'],$row['fa_11'],$row['fa_12'],$row['fa_13'],$row['fa_14'],$row['confi'],$row['bank_account'],
            $row['ok'],$row['no_nation'],$row['nation']
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
?>
