<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست_درخواست_محصول_مساحت.xls");

include('../../lock_oce.php'); 
include('../../event.php');
include('../../login/config.php');

$id_city   = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$z_sal     = isset($_POST['z_sal']) ? $_POST['z_sal'] : '1404-1405';
$bah_cod_m = isset($_POST['f_bah_cod']) ? $_POST['f_bah_cod'] : '';
$mor_cod_m = isset($_POST['f_mor_cod']) ? $_POST['f_mor_cod'] : '';
$f_status  = isset($_POST['f_status']) ? $_POST['f_status'] : ''; // پیش‌فرض را چک کنید

// 2. ساخت مجدد شرط‌ها (دقیقا مثل صفحه اصلی)
// توجه: $id_ostan باید از سشن یا کانفیگ خوانده شود
$where_clauses = "WHERE r.id_ostan = :id_ostan AND r.z_sal = :z_sal";
$params = array(':id_ostan' => $id_ostan, ':z_sal' => $z_sal);

if($f_status !== '') {
    $where_clauses .= " AND r.status = :f_status";
    $params[':f_status'] = $f_status;
}
if(!empty($bah_cod_m)) { 
    $where_clauses .= " AND r.bah_cod_m = :bah_cod"; 
    $params[':bah_cod'] = $bah_cod_m;
}
if(!empty($mor_cod_m)) { 
    $where_clauses .= " AND r.mor_cod_m = :mor_cod"; 
    $params[':mor_cod'] = $mor_cod_m;
}
if(!empty($id_city)) { 
    $where_clauses .= " AND r.id_city = :id_city"; 
    $params[':id_city'] = $id_city;
}

// 3. اجرای کوئری (بدون LIMIT چون اکسل همه را می‌خواهد)
$sql = "SELECT r.* FROM Agri_prod_req r $where_clauses ORDER BY r.id DESC";
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
                <table width="92%" border="1" align="center" cellpadding="1" cellspacing="0" dir="ltr">
                    <thead>
                          <tr>
                              <th width="6%" bgcolor="#3366CC" style="color:#FFF">ردیف</th>
                              <th width="9%" bgcolor="#3366CC" style="color:#FFF">تاریخ درخواست</th>
                                <th width="10%" bgcolor="#3366CC" style="color:#FFF">شهرستان</th>
                              <th width="9%" bgcolor="#3366CC" style="color:#FFF">نام آبادی / شهر</th>
                              <th width="10%" bgcolor="#3366CC" style="color:#FFF">کد ملی بهره بردار</th>
                              <th width="6%" bgcolor="#3366CC" style="color:#FFF">نام و نام خانوادگی</th>
                              <th width="6%" bgcolor="#3366CC" style="color:#FFF">نوع کشت</th>
                              <th width="12%" bgcolor="#3366CC" style="color:#FFF"> نام محصول فعلی</th>
                              <th width="12%" bgcolor="#3366CC" style="color:#FFF">سطح فعلی/ هکتار</th>
                              <th width="12%" bgcolor="#3366CC" style="color:#FFF">نام محصول پیشنهادی </th>
                              <th width="8%" bgcolor="#3366CC" style="color:#FFF">سطح پیشنهادی/هکتار</th>
                              <th width="8%" bgcolor="#3366CC" style="color:#FFF">علت درخواست</th>
                              <th width="8%" bgcolor="#3366CC" style="color:#FFF">نام کارشناس</th>
                              <th bgcolor="#3366CC" style="color:#FFF">کد ملی کارشناس</th>
                              <th bgcolor="#3366CC" style="color:#FFF">همراه کارشناس</th>
                              <th width="10%" bgcolor="#3366CC" style="color:#FFF">آخرین وضعیت </th>
                          </tr>
                  </thead>
                      <tbody>
                          <?php  $i = 1;  foreach($requests as $row) { ?>
                          <tr>
                              <td height="36" style="text-align: center"><?php echo $i++; ?></td>
                              <td style="text-align: center"><?php echo $row['date_req']; ?></td>
                                <td style="text-align: center"><?php echo city_name1($row['id_city'],$id_ostan); ?></td>
                              <td style="text-align: center"><?php echo abadi_name($row['add_abadi']).shahr_name($row['add_city']); ?></td>
                              <td style="text-align: center"><strong><?php echo bah_name2($row['bah_cod_m'],$row['num_bah']); ?></strong><br></td>
                              <td style="text-align: center"><code><?php echo $row['bah_cod_m']; ?></code></td>
                              <td style="text-align: center"><?php if ($row['no_kesh'] =='1') echo 'آبی' ; if ($row['no_kesh'] =='2') echo 'دیم' ; ?></td>
                              <td style="text-align: center"><?php echo mah_name($row['cod_mah']); ?></td>
                              <td style="text-align: center"><?php echo $row['zer_kesht_a']; ?></span></td>
                              <td style="text-align: center"><?php echo mah_name($row['new_cod_mah']); ?></td>
                              <td style="text-align: center"><?php echo $row['new_zer_kesht_a']; ?></td>
                              <td style="text-align: center"><?php echo $row['reason'] ; ?></td>
                              <td style="text-align: center">
                                  <p><?php echo user_name($row['mor_cod_m'])?><br />
                                  </p>
                              </td>
                              <td width="8%" style="text-align: center"><?php echo $row['mor_cod_m']?></td>
                              <td width="8%" style="text-align: center"><?php echo user_tel($row['mor_cod_m'])?></td>
                            <td style="text-align: center"><?php  echo getStatusLabel($row['status']);  ?></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                </table>
