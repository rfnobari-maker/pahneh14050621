<?php
require_once('Jalali.php');
require_once('./login/config.php'); // فایل config.php را اضافه کنید
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");

//get records from database

// به جای mysqli از PDO استفاده کنید
$query = $dbh->query("SELECT * from users WHERE 1");

if ($query->rowCount() > 0) {
    $delimiter = ",";
    $filename = "users.csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    // $fields = array('date_s','bah_cod_m','no_bah','num_bah', 'name', 'last_name', 'date_t', 'fname','co_name','sh_meli','id_ostan','id_city','ok');
    // fputcsv($f, $fields, $delimiter); // این خط در کد اصلی کامنت بود
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $lineData = array(
            $row['id'],$row['date_pas'],$row['username'],$row['password'],$row['psalt'],
            $row['id_ostan'],$row['ostan'],$row['id_city'],$row['city'],$row['id_mar'],$row['markaz'],
            $row['date_es'],$row['date_kh'],$row['no_es'],$row['jens'],$row['name'],$row['Last_name'],
            $row['cod_m'],$row['sh_sh'],$row['fname'],$row['date_t'],$row['m_sodor'],$row['m_tah'],
            $row['r_tah'],$row['avre'],$row['univer'],$row['m_date'],$row['v_tahol'],$row['addres'],
            $row['tel_s'],$row['tel_m'],$row['cod_p'],$row['pic'],$row['Access'],$row['S_access'],$row['id_aria'],$row['expert_unit'],$row['end_bee'],$row['date_end_bee'],$row['con_center'],$row['date_con_center'],$row['con_city'],$row['date_con_city'],$row['con_ostan'],$row['date_con_ostan'],$row['chief'],$row['ostans'],$row['perm']
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