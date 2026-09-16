<?php
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../side_menu1.php');

// متغیرهای ورودی جدید
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    <style type="text/css">
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
.column {
  float: left;
  width:12.25%;
  padding: 5px;
}
.row {
	width: 100%
}

.row::after {
  content: "";
  clear: both;
  display: table;
}
/* جدول نتایج مدرن و واکنش‌گرا */
.agri-table {
  width: 95%;
  margin: 24px auto;
  border-collapse: collapse;
  font-family: Tahoma, Arial, sans-serif;
  font-size: 15px;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  border-radius: 12px;
  overflow: hidden;
  /* direction: rtl; */
}
.agri-table th, .agri-table td {
  padding: 10px 8px;
  text-align: center;
  border-bottom: 1px solid #e0e0e0;
  border-right: 1px solid #e0e0e0;
}
.agri-table th:last-child, .agri-table td:last-child {
  border-right: none;
}
.agri-table th {
  background: #006699;
  color: #fff;
  font-weight: bold;
  font-size: 16px;
}
.agri-table tr:nth-child(even) {
  background: #f9f9f9;
}
.agri-table tr:nth-child(odd) {
  background: #fff;
}
.agri-table tr:hover {
  background: #e6f2ff;
}
@media (max-width: 900px) {
  /* فقط فونت و سایز جدول را کوچک‌تر می‌کنیم، ساختار جدول حفظ شود */
  .agri-table {
    font-size: 13px;
  }
  .agri-table th, .agri-table td {
    padding: 8px 4px;
  }
  .agri-table tr { margin-bottom: 15px; }
  .agri-table td, .agri-table th {
    text-align: right;
    padding: 10px 5px;
    border: none;
    border-bottom: 1px solid #e0e0e0;
    position: relative;
  }
  .agri-table th {
    background: #006699;
    color: #fff;
    font-size: 15px;
    border-radius: 0;
  }
}
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
      <span class="style8">برنامه الگوی کشت ابلاغی محصولات زراعی </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 350px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="213" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>

               <tr bgcolor='#f1f1f1' >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <div align="right">

                    <select name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="22" dir="rtl"  >
                      <option value="" > انتخاب گروه</option>
                      <?php
                        $query = "SELECT DISTINCT group_cod,group_name FROM `product_z` ORDER BY group_cod ASC" ;
                        $stmt = $dbh->prepare($query);
                        $stmt->execute();
                        foreach($stmt as $row){
                      ?>
                      <option value="<?php echo $row['group_cod'] ;?>"
                         <?php if (isset($_POST['mah_qroup']) && $row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                      <?php }?>
                    </select>
                   </div>
                 </td>
                 <td align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8">:گروه محصولات</font></td>
               </tr>

               <tr bgcolor='#f1f1f1' >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <div align="right">
                     <select name="mah_name" class="required input_text mar" style="width:170px ; height:40px" tabindex="23" dir="rtl">
                       <?php
                         if (!empty($mah_qroup)) {
                           $query = "SELECT DISTINCT product_cod,product_name FROM `product_z` WHERE `group_cod` = :mah_qroup ORDER BY product_name ASC" ;
                           $stmt = $dbh->prepare($query);
                           $stmt->bindParam(':mah_qroup', $mah_qroup);
                           $stmt->execute();
                           foreach($stmt as $row){
                       ?>
                       <option value="<?php echo $row['product_cod'] ;?>"
                          <?php if ($row['product_cod']==$mah_name) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
                       <?php
                           }
                         } else {
                            echo '<option value="">ابتدا گروه را انتخاب کنید</option>';
                         }
                       ?>
                     </select>
                   </div>
                 </td>
                 <td align='center' bgcolor="#FFFFFF" class="style8">: نام محصول</td>
               </tr>

               <tr bgcolor='#f1f1f1' >
                 <td height="71" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal2" style="height:40px ; width:170px ; direction:rtl" tabindex="1">
                     <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                     </select>
                 </div>
                 </td>
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><span class="style8">: سال زراعی</span></td>
               </tr>
               <tr >
                 <td height="60" colspan="2" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="10" value='جستجو' />
                   </td>
               </tr>
             </table>
           </div>
 </form>
             <p>
               <?php
 if (isset($_POST['action']) && !empty($mah_qroup) && !empty($mah_name) && !empty($z_sal))
 {

// نمایش نتایج برای تمام 32 استان برای محصول و سال زراعی انتخاب شده
$query = "
    SELECT 
        o.id_ostan,
        o.product_cod,
        o.z_sal,
        o.s_dem,
        o.s_abi,
        o.t_dem,
        o.t_abi,
        o.a_dem,
        o.a_abi,
        osn.ostan,
        IFNULL(c.total_city_dem,0) AS total_city_dem,
        IFNULL(c.total_city_abi,0) AS total_city_abi
    FROM Agri_ab_ostan o
    JOIN ostanname osn ON o.id_ostan = osn.id_ostan
    LEFT JOIN (
        SELECT 
            id_ostan,
            product_cod,
            SUM(s_dem) AS total_city_dem,
            SUM(s_abi) AS total_city_abi
        FROM Agri_ab_city
        WHERE z_sal = :z_sal
        AND group_cod = :mah_qroup
        AND product_cod = :mah_name
        GROUP BY id_ostan, product_cod
    ) c 
       ON o.id_ostan = c.id_ostan
      AND o.product_cod = c.product_cod
    WHERE o.z_sal = :z_sal
      AND o.group_cod = :mah_qroup
      AND o.product_cod = :mah_name
    ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')
";
$stmt = $dbh->prepare($query);
$stmt->execute(array(
    ':z_sal'     => $z_sal,
    ':mah_qroup' => $mah_qroup,
    ':mah_name'  => $mah_name
));
$t_row = $stmt->rowCount();

if ($t_row > 0) {

    // آماده‌سازی داده‌ها برای نمودار
    // آرایه‌ها با سینتکس سازگار با PHP 5.2.3 تعریف شده‌اند
    $province_names = array();
    $s_dem_data = array();
    $total_city_dem_data = array();
    $s_abi_data = array();
    $total_city_abi_data = array();

    foreach($stmt as $row) {
        $province_names[] = $row['ostan'];
        $s_dem_data[] = (float)$row['s_dem'];
        $total_city_dem_data[] = (float)$row['total_city_dem'];
        $s_abi_data[] = (float)$row['s_abi'];
        $total_city_abi_data[] = (float)$row['total_city_abi'];
    }
    
    // تبدیل آرایه‌های PHP به JSON برای استفاده در جاوااسکریپت
    // ثابت JSON_UNESCAPED_UNICODE در این نسخه از PHP وجود ندارد
    $province_names_json = json_encode($province_names);
    $s_dem_data_json = json_encode($s_dem_data);
    $total_city_dem_data_json = json_encode($total_city_dem_data);
    $s_abi_data_json = json_encode($s_abi_data);
    $total_city_abi_data_json = json_encode($total_city_abi_data);
?>
<hr>
<script src="../../15_files/chart.js"></script>

<div style="width: 80%; margin: 24px auto; direction: rtl;">
    <h2 style="text-align: center;">نمودار مقایسه ای سطح (دیم) محصول <?php echo mah_name($mah_name)?></h2>
    <canvas id="demChart"></canvas>
    <hr>
    <h2 style="text-align: center;">نمودار مقایسه ای سطح (آبی)  محصول <?php echo mah_name($mah_name)?></h2>
    <canvas id="abiChart"></canvas>
</div>

<script>
    // داده‌های آماده شده در PHP
    const labels = <?php echo $province_names_json; ?>;
    const s_dem_data = <?php echo $s_dem_data_json; ?>;
    const total_city_dem_data = <?php echo $total_city_dem_data_json; ?>;
    const s_abi_data = <?php echo $s_abi_data_json; ?>;
    const total_city_abi_data = <?php echo $total_city_abi_data_json; ?>;

    // نمودار برای داده‌های دیم
    const demCtx = document.getElementById('demChart').getContext('2d');
    new Chart(demCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'سطح دیم ابلاغی استان',
                    data: s_dem_data,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'مجموع برش شهرستانی (دیم)',
                    data: total_city_dem_data,
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    rtl: true
                },
                title: {
                    display: true,
                    text: 'مقایسه سطح دیم ابلاغی با مجموع برش شهرستانی',
                    font: {
                        size: 16
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'سطح (هکتار)'
                    }
                }
            },
            indexAxis: 'x'
        }
    });

    // نمودار برای داده‌های آبی
    const abiCtx = document.getElementById('abiChart').getContext('2d');
    new Chart(abiCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'سطح آبی ابلاغی استان',
                    data: s_abi_data,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'مجموع برش شهرستانی (آبی)',
                    data: total_city_abi_data,
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    rtl: true
                },
                title: {
                    display: true,
                    text: 'مقایسه سطح آبی ابلاغی با مجموع برش شهرستانی',
                    font: {
                        size: 16
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'سطح (هکتار)'
                    }
                }
            },
            indexAxis: 'x'
        }
    });
</script>

<?php
} else {
    echo '<p class="style8">اطلاعاتی یافت نشد. لطفاً گروه محصولات، نام محصول و سال زراعی را انتخاب و جستجو کنید.</p>';
}
 } else {
     echo '<p class="style8"></p>';
 }
?>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

<script type="text/javascript">
// jQuery برای بارگذاری پویای محصولات بر اساس گروه
$(document).ready(function() {
  $(".country").change(function() {
    var id = $(this).val();
    var dataString = 'group_cod=' + id;
    $.ajax({
      type: "POST",
      url: "ajax_city.php", // این فایل از قبل موجود است
      data: dataString,
      cache: false,
      success: function(html) {
        $(".mar").html(html);
      }
    });
  });
});
</script>

</body>
</html>