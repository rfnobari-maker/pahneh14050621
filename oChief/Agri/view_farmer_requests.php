<?php 
include('../../lock_oce.php'); 
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');

// --- تنظیمات صفحه‌بندی و دریافت متغیرها با POST ---
$limit = 10; // تعداد نمایش در هر صفحه

// شماره صفحه را از POST دریافت می‌کنیم. اگر نبود 1 در نظر گرفته می‌شود
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
if($page < 1) $page = 1;
$start = ($page - 1) * $limit;

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

// --- کوئری ۱: شمارش کل رکوردها (برای محاسبه تعداد صفحات) ---
$sql_count = "SELECT COUNT(*) FROM Agri_req_bah r $where_clauses";
$stmt_count = $dbh->prepare($sql_count);
$stmt_count->execute($params);
$total_rows = $stmt_count->fetchColumn();
$total_pages = ceil($total_rows / $limit);

// --- کوئری ۲: دریافت داده‌ها با LIMIT ---
// نکته: LIMIT را مستقیم در رشته SQL گذاشتیم
$sql = "SELECT r.* FROM Agri_req_bah r $where_clauses ORDER BY r.id DESC LIMIT $start, $limit";

$stmt = $dbh->prepare($sql);
$stmt->execute($params);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);


// تابع کمکی برای استایل وضعیت‌ها
function getStatusLabel($status) {
    switch ($status) {
        case '0':  return '<span style="background:#f39c12; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">بررسی نشده مرکز</span>'; 
        case '1':  return '<span style="background:#2ecc71; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">تایید شده مرکز</span>'; 
        case '11': return '<span style="background:#e74c3c; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">رد شده مرکز</span>'; 
        case '2':  return '<span style="background:#2ecc71; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">تایید شده - شهرستان</span>'; 
        case '22': return '<span style="background:#e67e22; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">رد شده - شهرستان</span>'; 
        case '3':  return '<span style="background:#2980b9; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">تایید نهایی - استان</span>'; 
        case '33': return '<span style="background:#c0392b; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">رد نهایی - استان</span>'; 
        default:   return '<span style="color:#95a5a6;">نامشخص</span>';
    }
}
?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8" />
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <title>مدیریت درخواست‌ها</title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <style>
    :root {
        --primary-color: #3498db;
        --hover-color: #2980b9;
    }

    body { font-family: myfont,Tahoma, sans-serif; background-color: #f4f7f6; margin: 0; }
    .filter-container { display: flex; justify-content: center; margin: 30px 0; }
    .filter-box { background: #ffffff; width: 100%; max-width: 500px; border: 1px solid #e0e0e0; padding: 25px; border-radius: 15px; direction: rtl; box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
    .filter-title { margin-bottom: 20px; color: #2c3e50; font-size: 18px; text-align: center; border-bottom: 2px solid #3498db; padding-bottom: 10px; font-weight: bold; }
    .filter-row { display: flex; align-items: center; margin-bottom: 15px; }
    .filter-row label { flex: 0 0 120px; font-weight: 600; font-size: 13px; color: #546e7a; }
    .filter-row input, .filter-row select { flex: 1; padding: 10px; border: 1px solid #cfd8dc; border-radius: 8px; font-family: Tahoma; font-size: 13px; outline: none; }
    .list-table { width: 95%; margin: 0 auto; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    .list-table th { background-color: #34495e; color: white; padding: 15px; font-size: 13px; }
    .list-table td { padding: 12px; border-bottom: 1px solid #eee; text-align: center; font-size: 12px; }
    .btn-group { display: flex; flex-direction: column; gap: 10px; margin-top: 20px; }
    .btn-search { background: linear-gradient(135deg, #3498db, #2980b9); color: white; border: none; padding: 12px; cursor: pointer; border-radius: 8px; font-family: Tahoma; font-weight: bold; }
    .btn-clear { font-size: 11px; color: #95a5a6; text-decoration: none; text-align: center; }
    .btn-approve { background: #2ecc71; color: white; border: none; padding: 7px 15px; cursor: pointer; border-radius: 5px; margin-bottom: 5px; }
    .btn-reject { background: #e74c3c; color: white; border: none; padding: 7px 15px; cursor: pointer; border-radius: 5px; }
    .style3 { color: #FF0000; font-size: 10px; }
    .back-button {
        display: block;
        width: 150px;
        height: 45px;
        margin: 20px auto;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: Tahoma, Arial, sans-serif;
    }

    .back-button:hover {
        background: var(--hover-color);
        transform: translateY(-2px);
    }
        .pagination {
            text-align: center;
            margin-top: 20px;
            direction: rtl;
        }
        .pagination a, .pagination span {
            display: inline-block;
            padding: 5px 10px;
            margin: 2px;
            border: 1px solid #ccc;
            background-color: #fff;
            color: #333;
            text-decoration: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .pagination span.current {
            background-color: #006699;
            color: #fff;
            border-color: #006699;
            font-weight: bold;
        }
        .pagination a:hover {
            background-color: #eee;
        }
    </style>
    <script type="text/javascript">
        // تابع جاوااسکریپت برای ارسال فرم هنگام کلیک روی صفحات
        function goPage(pageNum) {
            document.getElementById('page_num').value = pageNum;
            document.getElementById('search_form').submit();
        }
    </script>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr><td><img src="../../files/images/header.jpg" width="100%" height="149" alt="Header" style="display: block;" /></td></tr>
        <tr><td><?php include('menu.php'); ?></td></tr>
        <tr><td><?php include('top.php'); ?></td></tr>
        <tr>
            <td>
              <div style="padding: 20px; min-height: 450px;">
                <div class="filter-container">
                        <div class="filter-box">
                            <!-- فرم اصلی با آیدی مشخص برای جاوااسکریپت -->
                            <form method="post" action="view_farmer_requests.php" id="search_form">
                                <!-- فیلد مخفی برای شماره صفحه -->
                                <input type="hidden" name="page" id="page_num" value="<?php echo $page; ?>" />

                                <div class="filter-title">🔍 درخواست های تغییر بهره بردار </div>
                                <div class="filter-row">
                                    <label>سال زراعی:</label>
                                    <select name="z_sal">
                                        <option value="1404-1405" <?php if($z_sal == '1404-1405') echo 'selected'; ?>>1404-1405</option>
                                    </select>
                                </div>
          
                                <div class="filter-row">
                                    <label>شهرستان:</label>
                                    <select name="id_city" class="input_text" id="shahrestan" style="width:170px ; height:40px" dir="rtl">
                                      <option value=""></option>
                                        <?php
                                        $query = "SELECT DISTINCT id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' ORDER BY BINARY city ASC "  ;
                                        $stmt_city = $dbh->prepare($query);
                                        $stmt_city->execute();
                                        foreach($stmt_city as $row_city){
                                        ?>
                                        <option value="<?php echo $row_city['id_city'] ;?>"
                                   <?php if ($row_city['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row_city['city'] ;?></option>
                                        <?php }?>
                                    </select>
                                </div>

                                <div class="filter-row">
                                    <label>کد ملی قبلی / جدید :</label>
                                    <input type="text" name="f_bah_cod" value="<?php echo $bah_cod_m; ?>" maxlength="10" />
                                </div>
                                <div class="filter-row">
                                    <label>کد ملی کارشناس:</label>
                                    <input type="text" name="f_mor_cod" value="<?php echo $mor_cod_m; ?>" maxlength="10" />
                                </div>
                              <div class="filter-row">
                                    <label>وضعیت درخواست:</label>
                                    <select name="f_status">
                                        <option value="" <?php if($f_status === '') echo 'selected'; ?>>همه درخواست ها</option>
                                        <option value="0" <?php if($f_status === '0') echo 'selected'; ?>>بررسی نشده مرکز</option>
                                        <option value="1" <?php if($f_status === '1') echo 'selected'; ?>>تایید شده مرکز</option>
                                        <option value="11" <?php if($f_status === '11') echo 'selected'; ?>>رد شده مرکز</option>
                                        <option value="2" <?php if($f_status === '2') echo 'selected'; ?>>تایید شده شهرستان</option>
                                        <option value="22" <?php if($f_status === '22') echo 'selected'; ?>>رد شده شهرستان</option>
                                        <option value="3" <?php if($f_status === '3') echo 'selected'; ?>>تایید شده نهایی استان</option>
                                        <option value="33" <?php if($f_status === '33') echo 'selected'; ?>>رد شده نهائی استان</option>

                                    </select>
                              </div>
                                <div class="btn-group">
                                    <!-- دکمه جستجو همیشه صفحه را به 1 برمی‌گرداند -->
                                    <button type="button" class="btn-search" onclick="goPage(1)">اعمال فیلتر</button>
                                    <a href="view_farmer_requests.php" class="btn-clear">❌ حذف فیلترها</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table width="122" height="56" border="0" align="center">
             <tr>
               <td width="56"><form  action="bah_requests_xls.php" method="post">
                <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? $z_sal : ''; ?>" />
                <input type="hidden" name="id_city" value="<?php echo isset($id_city) ? $id_city : ''; ?>" />
                <input type="hidden" name="f_bah_cod" value="<?php echo isset($bah_cod_m) ? $bah_cod_m : ''; ?>" />
                <input type="hidden" name="f_mor_cod" value="<?php echo isset($mor_cod_m) ? $mor_cod_m : ''; ?>" />
                <input type="hidden" name="f_status" value="<?php echo isset($f_status) ? $f_status : ''; ?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
             </tr>
         </table>
                    <a name="1" id="1"></a>
                    <table width="92%" class="list-table" dir="rtl">
                        <thead>
                            <tr>
                                <th bgcolor="#990000">ردیف</th>
                                <th bgcolor="#006699">تاریخ درخواست</th>
                                <th bgcolor="#006699">شهرستان</th>
                                <th bgcolor="#006699">نام آبادی / شهر</th>
                                <th bgcolor="#006699">مساحت زمین</th>
                                <th bgcolor="#006699">نوع کشت</th>
                                <th bgcolor="#006699"> بهره بردار فعلی<span class="style3"></span></th>
                                <th bgcolor="#006699"> بهره بردار پیشنهادی<span class="style3"></span></th>
                                <th bgcolor="#006699">کارشناس</th>
                                <th  bgcolor="#006699">مشاهده اطلاعات زمین</th>
                                <th bgcolor="#006699">عملیات</th>
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
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['date_req']; ?></td>
                                <td><?php echo city_name1($row['id_city'],$id_ostan); ?></td>
                                <td><?php echo abadi_name($row['add_abadi']).shahr_name($row['add_city']); ?></td>
                              <td><strong><?php echo $row['m_zamin']; ?></strong></td>
                                <td style="background-color: #fff9f9;"><?php if ($row['no_kesh'] =='1') echo 'آبی' ; if ($row['no_kesh'] =='2') echo 'دیم' ; ?></td>
                                <td style="background-color: #fff9f9;"><strong><?php echo $old_name; ?></strong><br>                                <?php echo $row['bah_cod_m'] ; ?></td>
                                <td style="background-color: #f9fff9; font-weight: bold; color: #27ae60;"><strong><?php echo $new_name; ?></strong><br>                                  <?php echo $row['new_bah_cod_m'] ; ?></td>
                                <td>
                                    <p><img id="img1" src="../../files/users/<?php echo user_pic($row['mor_cod_m']) ?>" width="37" height="43" alt=""/><br />
                                    <?php echo user_name($row['mor_cod_m'])?><br/>
                                    <?php echo $row['mor_cod_m']?><br />
                                    <?php echo user_tel($row['mor_cod_m'])?></p>
                                </td>
                                <td>
                                    <form action="Agridata_view1.php" method="post" onsubmit="target_Agri18(this)">
                                        <input type="hidden" name="id" value="<?php echo $row['Agri_id']; ?>" />
                                        <input type="hidden" name="z_sal" value="<?php echo $row['z_sal']; ?>" />
                                        <button type="submit"><img src="../../files/view.png" width="33" height="26" title="نمایش اطلاعات بهره برداری" /></button>
                                    </form>
                                <form action="review_bah_comment.php" method="post" onsubmit="target_Agri19(this)">
                                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                  <button type="submit"><img src="../../files/con_info.png" width="33" height="26" title="مشاهده علت درخواست و نظرات کارشناسی " /></button>
                                </form></td>
                                <td>
                                    <?php  echo getStatusLabel($row['reg_status']); ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    
                  <!-- بخش صفحه‌بندی با استفاده از POST -->
                  <div class="pagination">
                      <?php
                      if ($total_pages > 1) {
                          // دکمه قبلی
                          if ($page > 1) {
                              echo '<a onclick="goPage('.($page - 1).')">« قبلی</a>';
                          }

                          // شماره صفحات
                          for ($p = 1; $p <= $total_pages; $p++) {
                              if ($p == $page) {
                                  echo '<span class="current">' . $p . '</span>';
                              } else {
                                  // نمایش هوشمند
                                  if ($p == 1 || $p == $total_pages || ($p >= $page - 2 && $p <= $page + 2)) {
                                       echo '<a onclick="goPage('.$p.')">' . $p . '</a>';
                                  } elseif ($p == $page - 3 || $p == $page + 3) {
                                      echo '<span>...</span>';
                                  }
                              }
                          }

                          // دکمه بعدی
                          if ($page < $total_pages) {
                              echo '<a onclick="goPage('.($page + 1).')">بعدی »</a>';
                          }
                          
                          echo '<br><br><span>تعداد کل رکوردها: '.$total_rows.'</span>';
                      }
                      ?>
                  </div>
                  <!-- پایان صفحه‌بندی -->
                  
              </div>
                          <a href="./Pattern.php">
                <input type="submit" value="بازگشت" class="back-button">
            </a>

            </td>
        </tr>
        <tr><td height="109" background="../../files/bottom.gif"><?php include('../../footer.php'); ?></td></tr>
    </table>
<script>
function target_Agri19(form) {
    window.open("null", "formpopup", "location=1,status=1,scrollbars=1,width=350,height=400");
    form.target = "formpopup";
}

function target_Agri18(form) {
    window.open("null", "formpopup", "location=1,status=1,scrollbars=1,width=950,height=600");
    form.target = "formpopup";
}
</script>

</body>
</html>
