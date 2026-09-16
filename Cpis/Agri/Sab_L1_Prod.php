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
<script type="text/javascript">
function target_popup(form) {
	window.open("null", "formpopup", "location=1,status=1,scrollbars=1,width=1000,height=800"); 
	form.target = 'formpopup';
}
</script>
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
                            <option value="1405-1406" <?php if ($z_sal == '1405-1406') echo 'selected="selected"'; ?>>1405-1406</option>
                            <option value="1404-1405" <?php if ($z_sal == '1404-1405') echo 'selected="selected"'; ?>>1404-1405</option>
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
// Removed the INSERT query to make it display-only
/*
// دریافت لیست تمام استان ها
$query_ostan_list = "SELECT id_ostan FROM ostanname";
$stmt_ostan_list = $dbh->prepare($query_ostan_list);
$stmt_ostan_list->execute();
$ostan_ids = $stmt_ostan_list->fetchAll(PDO::FETCH_COLUMN);

// بررسی و درج داده ها برای هر 32 استان
foreach ($ostan_ids as $ostan_id) {
    $query_insert = "
    INSERT INTO Agri_ab_ostan (group_cod, group_name, product_cod, product_name, id_ostan, z_sal)
    SELECT p.group_cod, p.group_name, p.product_cod, p.product_name, :ostan_id, :z_sal
    FROM product_z p
    LEFT JOIN Agri_ab_ostan a
      ON p.product_cod = a.product_cod
         AND p.group_cod = a.group_cod
         AND a.id_ostan = :ostan_id
         AND a.z_sal = :z_sal
    WHERE a.product_cod IS NULL
      AND p.product_cod = :mah_name
      AND p.group_cod = :mah_qroup";

    $q_insert = $dbh->prepare($query_insert);
    $q_insert->execute(array(
        ':ostan_id'  => $ostan_id,
        ':z_sal'     => $z_sal,
        ':mah_name'  => $mah_name,
        ':mah_qroup' => $mah_qroup
    ));
}
*/

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
        IFNULL(c.total_city_abi,0) AS total_city_abi,
        IFNULL(m.total_marakez_dem,0) AS total_marakez_dem,
        IFNULL(m.total_marakez_abi,0) AS total_marakez_abi
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
    LEFT JOIN (
        SELECT 
            id_ostan,
            product_cod,
            SUM(s_dem) AS total_marakez_dem,
            SUM(s_abi) AS total_marakez_abi
        FROM Agri_ab_mar
        WHERE z_sal = :z_sal
        AND group_cod = :mah_qroup
        AND product_cod = :mah_name
        GROUP BY id_ostan, product_cod
    ) m 
       ON o.id_ostan = m.id_ostan
      AND o.product_cod = m.product_cod
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
?>
             <table width="122" height="76" border="0" align="center">
               <tr>
                 <td height="72"><form  action="Sab_L1p_2_xls.php" method="post">
                   <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                   <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button> کل<img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                 <td><form  action="Sab_L1p_xls.php" method="post">
                   <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                   <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button>جزئیات<img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                 <td><form action="Sab_L1p_chart.php" method="post" onsubmit="target_popup(this)">
                   <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                   <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button>نمودار<img src="../../files/chart1.jpg" title="مشاهده نمودار"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
            <table class="my-table" align="center">
              <tr class="text1">
                <td colspan="2" bgcolor="#006699">عملکرد / کیلوگرم در هکتار<br /></td>
                <td colspan="2" bgcolor="#006699">تولید / تن <br /></td>
                <td colspan="2" bgcolor="#006699"><p>سطح   / هکتار<br /></p></td>
                <td width="19%" height="35" rowspan="2" bgcolor="#006699">عنوان</td>
                <td width="13%" rowspan="2" bgcolor="#006699">استان </td>
                <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
              </tr>
              <tr class="text1">
                <td width="12%" bgcolor="#006699">دیم</td>
                <td width="10%" bgcolor="#006699">آبی</td>
                <td width="12%" bgcolor="#006699">دیم</td>
                <td width="9%" bgcolor="#006699">آبی</td>
                <td width="11%" bgcolor="#006699">دیم</td>
                <td width="10%" bgcolor="#006699">آبی</td>
              </tr>
              <?php
                $r = 1 ;
                foreach($stmt as $row){
                $t_r = $r ;
                $id_ostan = $row['id_ostan'] ;

                // محاسبه ترازها
                $diff_city_dem = $row['s_dem'] - $row['total_city_dem'];
                $diff_city_abi = $row['s_abi'] - $row['total_city_abi'];
                $diff_marakez_dem = $row['s_dem'] - $row['total_marakez_dem'];
                $diff_marakez_abi = $row['s_abi'] - $row['total_marakez_abi'];

                // تعیین رنگ‌ها
                $color_city_dem = ($diff_city_dem >= 0) ? "#008000" : "#ff0000"; // green or red
                $color_city_abi = ($diff_city_abi >= 0) ? "#008000" : "#ff0000"; // green or red
                $color_marakez_dem = ($diff_marakez_dem >= 0) ? "#008000" : "#ff0000";
                $color_marakez_abi = ($diff_marakez_abi >= 0) ? "#008000" : "#ff0000";
              ?>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_dem']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_abi']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_abi']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>برنامه الگوی کشت ابلاغی</td>
                <td rowspan="5" class="style19" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan'] ?></td>
                <td rowspan="5" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
              </tr>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_city_dem']; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_city_abi']; ?></td>
                <td class="normalTextSmaller" align="right" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> مجموع برش شهرستانی</td>
              </tr>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_marakez_dem']; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_marakez_abi']; ?></td>
                <td class="normalTextSmaller" align="right" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> مجموع برش مراکز</td>
              </tr>
              <tr style='font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" style='color:<?php echo $color_city_dem; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_city_dem; ?></td>
                <td class="normalTextSmall" style='color:<?php echo $color_city_abi; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_city_abi; ?></td>
                <td class="normalTextSmall" align="right" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> تراز شهرستانی</td>
              </tr>
              <tr style='font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" style='color:<?php echo $color_marakez_dem; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_marakez_dem; ?></td>
                <td class="normalTextSmall" style='color:<?php echo $color_marakez_abi; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_marakez_abi; ?></td>
                <td class="normalTextSmall" align="right" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> تراز مراکز</td>
              </tr>

              <?php
              $r++ ;
              }
              ?>
            </table>
            <p class="style2" align="center">
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
<?php
// Removed all JavaScript related to editing, validation, and calculations
/*
$no = isset($t_row) ? $t_row : 0;
while ($no > 0){
?>
<script>
// تعریف متغیر وضعیت اعتبار برای هر ردیف
let isValidRow<?php echo $no ?> = {
  s_abi: true,
  s_dem: true,
  t_abi: true,
  t_dem: true
};

// تابع بررسی و اعتبارسنجی ورودی‌ها
function handleBoxChange(boxClass, valueName) {
  $('.' + boxClass + '<?php echo $no ?>').on('change', function () {
    const value = $(this).val();
    const z_sal = '<?php echo isset($z_sal) ? $z_sal : ""; ?>';
    const id_ostan = $('#id_ostan<?php echo $no ?>').val(); // اصلاح شد به id_ostan هر ردیف
    const product_cod = $('#product_cod<?php echo $no ?>').val();
    const $input = $(this);

    $.post('check.php', { // فرض بر این است که فایل check.php منطق لازم برای بررسی را دارد
      [valueName]: value,
      z_sal,
      id_ostan,
      product_cod
    }, function(response) {
      if (response && !response.valid) { // اطمینان از وجود response و valid
        alert(response.message);
        $input.val(0); // یا مقدار قبلی

        // ریست مقادیر مرتبط
        if (boxClass.includes('abi')) {
          $('.t_abi<?php echo $no ?>').val(0);
          $('.a_abi<?php echo $no ?>').val(0);
        }
        if (boxClass.includes('dem')) {
          $('.t_dem<?php echo $no ?>').val(0);
          $('.a_dem<?php echo $no ?>').val(0);
        }
        isValidRow<?php echo $no ?>[valueName] = false;
      } else {
        isValidRow<?php echo $no ?>[valueName] = true;
      }
    }, 'json').fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error in check.php AJAX call:", textStatus, errorThrown);
        // می‌توانید یک پیام خطا به کاربر نمایش دهید
    });
  });
}

// راه‌اندازی بررسی مقادیر
handleBoxChange('s_abi', 's_abi');
handleBoxChange('s_dem', 's_dem');
handleBoxChange('t_abi', 't_abi');
handleBoxChange('t_dem', 't_dem');
</script>

<script>
$(function() {
  $(".submit<?php echo $no ?>").click(function() {
    const un = unformatNumber;
    const s_abi = un($("#s_abi<?php echo $no ?>").val());
    const s_dem = un($("#s_dem<?php echo $no ?>").val());
    const t_abi = un($("#t_abi<?php echo $no ?>").val());
    const t_dem = un($("#t_dem<?php echo $no ?>").val());
    const id = $("#id<?php echo $no ?>").val();
    const id_ostan = $("#id_ostan<?php echo $no ?>").val(); // اصلاح شد
    const z_sal = $("#z_sal").val();
    const product_cod = $("#product_cod<?php echo $no ?>").val(); // اضافه شد
    const group_cod = $("#group_cod<?php echo $no ?>").val(); // اضافه شد

    // مقادیر عملکرد (a_abi, a_dem) فقط برای نمایش هستند و به سرور ارسال نمی‌شوند،
    // چرا که در سمت کلاینت محاسبه می‌شوند.
    // اگر نیاز است در دیتابیس ذخیره شوند، باید از سمت سرور محاسبه و ذخیره شوند.
    // اما در حال حاضر صرفا مقادیر وارد شده (سطح و تولید) برای ثبت ارسال می‌شوند.
    // بنابراین نیازی به ارسال a_abi و a_dem در dataString نیست مگر اینکه logic تغییر کند.

    const dataString = `s_abi=${s_abi}&s_dem=${s_dem}&t_abi=${t_abi}&t_dem=${t_dem}&id=${id}&id_ostan=${id_ostan}&z_sal=${z_sal}&product_cod=${product_cod}&group_cod=${group_cod}`;

    // بررسی اعتبار ورودی‌ها
    const isRowValid = Object.values(isValidRow<?php echo $no ?>).every(v => v === true);

    if (!isRowValid ||
        (parseFloat(s_abi) > 0 && parseFloat(t_abi) <= 0) ||
        (parseFloat(s_dem) > 0 && parseFloat(t_dem) <= 0)) {
      $('.success<?php echo $no ?>').fadeOut(200).hide();
      $('.error<?php echo $no ?>').fadeIn(200).show();
      alert('لطفاً مقادیر را به درستی وارد کنید. سطح نمی‌تواند با تولید صفر باشد.');
    } else {
      $.post("sabt_ab2.php", dataString, function(response) {
        if (response === 'success') { // فرض بر این است که sabt_ab.php "success" برمی گرداند
            $('.success<?php echo $no ?>').fadeIn(200).show();
            $('.error<?php echo $no ?>').fadeOut(200).hide();
        } else {
            $('.success<?php echo $no ?>').fadeOut(200).hide();
            $('.error<?php echo $no ?>').fadeIn(200).show();
            alert('خطا در ثبت اطلاعات: ' + response);
        }
      }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error in sabt_ab.php AJAX call:", textStatus, errorThrown);
            $('.success<?php echo $no ?>').fadeOut(200).hide();
            $('.error<?php echo $no ?>').fadeIn(200).show();
            alert('خطای شبکه یا سرور در ثبت اطلاعات.');
      });
    }
    return false;
  });
});
</script>

<script>
// جداکننده و حذف‌کننده هزارگان
function formatNumberWithSeparator(num) {
  if (!num && num !== 0) return ""; // برای 0 هم مقدار خالی برنگرداند اگر عدد است
  const parts = num.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "٬");
  return parts.join(".");
}

function unformatNumber(str) {
  return str ? str.replace(/٬/g, "") : "0";
}

// اجبار به ورودی عددی با فرمت
function enforceNumericInput(el) {
  el.addEventListener('input', function() {
    let value = el.value.replace(/[^\d.]/g, '');
    const parts = value.split('.');
    if (parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');
    el.value = value ? formatNumberWithSeparator(value) : "";
  });

  el.addEventListener('paste', function() {
    setTimeout(() => {
      let value = el.value.replace(/[^\d.]/g, '');
      const parts = value.split('.');
      if (parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');
      el.value = value ? formatNumberWithSeparator(value) : "";
    }, 0);
  });
}

// محاسبه مقادیر هر ردیف
function calcRow(row) {
  const t_abi = parseFloat(unformatNumber(document.getElementById('t_abi'+row).value)) || 0;
  const s_abi = parseFloat(unformatNumber(document.getElementById('s_abi'+row).value)) || 0;
  const t_dem = parseFloat(unformatNumber(document.getElementById('t_dem'+row).value)) || 0;
  const s_dem = parseFloat(unformatNumber(document.getElementById('s_dem'+row).value)) || 0;

  // محاسبه عملکرد فقط در صورتی که سطح > 0 باشد
  const a_abi = s_abi > 0 ? (t_abi / s_abi * 1000).toFixed(2) : '';
  const a_dem = s_dem > 0 ? (t_dem / s_dem * 1000).toFixed(2) : '';

  document.getElementById('a_abi'+row).value = formatNumberWithSeparator(a_abi);
  document.getElementById('a_dem'+row).value = formatNumberWithSeparator(a_dem);
}

// راه‌اندازی هنگام بارگذاری صفحه
window.addEventListener('DOMContentLoaded', function() {
  let i = 1;
  // حلقه تا زمانی که عنصری با id 't_abi'+i پیدا شود
  while(document.getElementById('t_abi'+i)) {
    ((row) => {
      ['t_abi','s_abi','t_dem','s_dem'].forEach((field) => {
        const el = document.getElementById(field+row);
        if (el) {
          enforceNumericInput(el);
          el.addEventListener('input', () => calcRow(row));
          // فراخوانی calcRow در زمان بارگذاری برای مقادیر اولیه موجود
          calcRow(row);
        }
      });
    })(i);
    i++;
  }
});
</script>
<?php
$no--;
}
*/
?>