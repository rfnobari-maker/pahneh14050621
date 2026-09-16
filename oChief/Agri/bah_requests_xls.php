<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست_درخواست_بهره_بردار.xls");

include('../../lock_oce.php'); 
include('../../event.php');
include('../../login/config.php');

// دریافت فیلترها با POST
$id_city   = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$z_sal     = isset($_POST['z_sal']) ? $_POST['z_sal'] : '1404-1405';
$bah_cod_m = isset($_POST['f_bah_cod']) ? $_POST['f_bah_cod'] : '';
$mor_cod_m = isset($_POST['f_mor_cod']) ? $_POST['f_mor_cod'] : '';
$f_status  = isset($_POST['f_status']) ? $_POST['f_status'] : ''; 

// ۲. ساخت پرس‌وجو
$sql = "SELECT * FROM Agri_req_bah r WHERE id_ostan = :id_ostan AND z_sal = :z_sal";

// ساخت شرط‌های SQL پایه
$where_clauses = "WHERE r.id_ostan = :id_ostan AND r.z_sal = :z_sal";
$params = array(':id_ostan' => $id_ostan, ':z_sal' => $z_sal);

if($f_status !== '') { 
    $where_clauses .= " AND r.reg_status = :f_status"; 
    $params[':f_status'] = $f_status;
}

if(!empty($bah_cod_m)) { 
    $where_clauses .= " AND r.bah_cod_m = :bah_cod OR r.new_bah_cod_m = :bah_cod"; 
    $params[':bah_cod'] = $bah_cod_m;
}

if(!empty($mor_cod_m)) { 
    $where_clauses .= " AND r.mor_cod_m = :mor_cod"; 
    $params[':mor_cod'] = $mor_cod_m;
}
if(!empty($id_city)) { 
    $where_clauses  .= " AND r.id_city = :id_city"; 
    $params[':id_city'] = $id_city;
}

$sql = "SELECT r.* FROM Agri_req_bah r $where_clauses ORDER BY r.id DESC ";
$stmt = $dbh->prepare($sql);
$stmt->execute($params);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);


// تابع کمکی برای استایل وضعیت‌ها
function getStatusLabel($status) {
    switch ($status) {
        case '0':  return 'بررسی نشده مرکز'; 
        case '1':  return 'تایید شده مرکز'; 
        case '11': return 'رد شده مرکز'; 
        case '2':  return 'تایید شده-شهرستان'; 
        case '22': return 'رد شده-شهرستان'; 
        case '3':  return 'تایید نهایی-استان'; 
        case '33': return 'رد نهایی-استان'; 
        default:   return 'نامشخص';
    }
}
?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8" />
</head>
<body>
                <table width="92%" border="1" align="center" cellpadding="0" cellspacing="0" dir="rtl" class="list-table">
                    <thead>
                            <tr>
                                <th bgcolor="#0066CC" style="color:#FFF">ردیف</th>
                                <th bgcolor="#0066CC" style="color:#FFF">تاریخ درخواست</th>
                                <th bgcolor="#0066CC" style="color:#FFF">شهرستان</th>
                                <th bgcolor="#0066CC" style="color:#FFF">نام آبادی / شهر</th>
                                <th bgcolor="#0066CC" style="color:#FFF">مساحت زمین</th>
                                <th bgcolor="#0066CC" style="color:#FFF">نوع کشت</th>
                                <th bgcolor="#0066CC" style="color:#FFF"> نام بهره بردار فعلی<span class="style3"></span></th>
                                <th bgcolor="#0066CC" style="color:#FFF">کد ملی بهره بردار فعلی</th>
                                <th bgcolor="#0066CC" style="color:#FFF"> نام بهره بردار پیشنهادی<span class="style3"></span></th>
                                <th bgcolor="#0066CC" style="color:#FFF">کد ملی بهره بردار پیشنهادی</th>
                                <th bgcolor="#0066CC" style="color:#FFF">علت درخواست</th>
                                <th bgcolor="#0066CC" style="color:#FFF">نام کارشناس</th>
                                <th  bgcolor="#0066CC" style="color:#FFF">کد ملی کارشناس </th>
                                <th  bgcolor="#0066CC" style="color:#FFF">همراه بهره بردار</th>
                                <th bgcolor="#0066CC" style="color:#FFF">آخرین وضعیت</th>
                          </tr>
                  </thead>
                        <tbody>
                           <?php 
                           $i = $start + 1; 
                           foreach($requests as $row) { 
							                $old_name = bah_name2($row['bah_cod_m'], $row['old_num_bah']);
                                            $new_name = bah_name2($row['new_bah_cod_m'], $row['new_num_bah']);
 
							?>
                            <tr>
                                <td height="35" style="text-align: center"><?php echo $i++; ?></td>
                                <td style="text-align: center"><?php echo $row['date_req']; ?></td>
                                <td style="text-align: center"><?php echo city_name1($row['id_city'],$id_ostan); ?></td>
                                <td style="text-align: center"><?php echo abadi_name($row['add_abadi']).shahr_name($row['add_city']); ?></td>
                              <td style="text-align: center"><?php echo $row['m_zamin']; ?></td>
                                <td style="text-align: center" ><?php if ($row['no_kesh'] =='1') echo 'آبی' ; if ($row['no_kesh'] =='2') echo 'دیم' ; ?></td>
                                <td style="text-align: center" ><?php echo $old_name; ?></td>
                                <td style="text-align: center" ><?php echo $row['bah_cod_m'] ; ?></td>
                                <td style="text-align: center" ><?php echo $new_name; ?></td>
                                <td style="text-align: center"><?php echo $row['new_bah_cod_m'] ; ?></td>
                                <td style="text-align: center"><?php echo $row['reason'] ; ?></td>
                                <td style="text-align: center"><?php echo user_name($row['mor_cod_m'])?></td>
                                <td style="text-align: center"><?php echo $row['mor_cod_m']?></td>
                                <td style="text-align: center"><?php echo user_tel($row['mor_cod_m'])?></td>
                                <td style="text-align: center"><?php  echo getStatusLabel($row['reg_status']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                </table>
                    

</body>
</html>
