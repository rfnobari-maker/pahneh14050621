<?php 
include('../../lock_p3.php'); 
include('../../login/config.php');
$id_mar = $_SESSION['id_mar']; 

// ۱. مقادیر فیلتر را دریافت می‌کنیم
$id     = isset($_POST['id']) ? $_POST['id'] : '';

// ۲. ساخت پرس‌وجو
$sql = "SELECT r.* 
        FROM Agri_req_bah r
        WHERE r.id = :id";

$stmt = $dbh->prepare($sql);
$params = array(':id' => $id);
$stmt->execute($params);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8" />
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <title>مدیریت درخواست‌ها</title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <style>
        body { font-family: Tahoma, sans-serif; background-color: #f4f7f6; margin: 0; }
        .filter-container { display: flex; justify-content: center; margin: 30px 0; }
         html, body { background-color: #FFFFFF !important; margin: 0 !important; padding: 0 !important; font-family: Tahoma; }
        .search-box { width: 500px; margin: 30px auto; padding: 20px; background: #fff; border: 1px solid #2980b9; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .list-table { width: 95%; margin: 0 auto; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .list-table th { background-color: #34495e; color: white; padding: 15px; font-size: 13px; }
        .list-table td { padding: 12px; border-bottom: 1px solid #eee; text-align: center; font-size: 12px; }
        .header-blue { background-color: #2980b9; color: #fff; }
        
        .status-badge { padding: 4px 8px; border-radius: 5px; color: #fff; font-weight: bold; display: inline-block; font-size: 10px; min-width: 90px; }
        .status-0 { background-color: #f39c12; }   /* در جریان */
        .status-1 { background-color: #3498db; }   /* تایید مرکز */
        .status-11 { background-color: #e74c3c; }  /* رد مرکز */
        .status-2 { background-color: #2980b9; }   /* تایید شهرستان */
        .status-22 { background-color: #e74c3c; }  /* رد شهرستان */
        .status-3 { background-color: #27ae60; }   /* تایید نهایی */
        .status-33 { background-color: #c0392b; }  /* رد نهایی */

        .comment-row { border-top: 1px dashed #ddd; margin-top: 5px; padding-top: 4px; }
        .comment-date { color: #7f8c8d; font-size: 9px; display: block; margin-top: 2px; }

    </style>
</head>
<body>
                  <table width="92%" class="list-table" dir="rtl">
                      <thead>
                          <tr>
                              <th width="5%">علت درخواست و نظرات کارشناسی</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php  foreach($requests as $row) { ?>
                                <tr>
                              <td>                    <div><strong>علت درخواست:</strong> <?php echo $row['reason']; ?></div>
                                      <span class="comment-date">تاریخ ثبت: <?php echo $row['date_req']; ?></span>
                    
                    <?php if(!empty($row['center_comment'])): ?>
                        <div class="comment-row">
                            <strong style="color:#3498db;">نظر مرکز:</strong> <?php echo $row['center_comment']; ?>
                            <span class="comment-date">تاریخ بررسی: <?php echo $row['center_date']; ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($row['city_comment'])): ?>
                        <div class="comment-row">
                            <strong style="color:#d35400;">نظر شهرستان:</strong> <?php echo $row['city_comment']; ?>
                            <span class="comment-date">تاریخ بررسی: <?php echo $row['city_date']; ?></span>
                        </div>
                    <?php endif; ?>

                 <?php if(!empty($row['prov_comment'])): ?>
                        <div class="comment-row">
                            <strong style="color:#F03;">نظر نهائی استان:</strong> <?php echo $row['prov_comment']; ?>
                            <span class="comment-date">تاریخ بررسی: <?php echo $row['prov_date']; ?></span>
                        </div>
                    <?php endif; ?>
                   <?php }?> 
</td>
                          </tr>
                          
                      </tbody>
                  </table>
<div align="center"> <p> <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بستن</button></p></div>
                </div>
</body>
</html>
<script>
function close_window() {
      close();
 }
</script>
