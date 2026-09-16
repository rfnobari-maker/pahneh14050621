<?php 
include('../../lock_expar.php');
include('../../event.php');
require_once('../../Jalali.php');

// متغیرهای ورودی جدید
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
$id_ostan1   = $id_ostan ; 

// گرفتن لیست استان‌ها

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
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      <span class="style1">برش الگوی کشت ابلاغی محصولات زراعی به تفکیک شهرستان</span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 350px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="209" border='0' align="center" cellpadding='0' cellspacing='0'>

               <tr bgcolor='#f1f1f1' >
                 <td height="48" align="right" bgcolor="#FFFFFF" class="input_text" >
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
                 <td height="49" align="right" bgcolor="#FFFFFF" class="input_text" >
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
                 <td height="52" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal2" style="height:40px ; width:170px ; direction:rtl" tabindex="1">
                     <option value="1405-1406" <?php if (isset($z_sal) && $z_sal=='1405-1406') echo 'selected=selected'?>>1405-1406</option>
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
// نمایش نتایج برای تمام شهرستان های استان 03 برای محصول و سال زراعی انتخاب شده
$query = "
SELECT
    c.id_city,
    c.city,
    a.s_dem AS s_dem_city,
    a.s_abi AS s_abi_city,
    a.t_dem AS t_dem_city,
    a.t_abi AS t_abi_city,
    a.a_dem AS a_dem_city,
    a.a_abi AS a_abi_city,
    IFNULL(m.total_marakez_dem, 0) AS total_marakez_dem,
    IFNULL(m.total_marakez_abi, 0) AS total_marakez_abi
FROM cityname c
LEFT JOIN Agri_ab_city a
    ON c.id_city = a.id_city
    AND a.z_sal = :z_sal
    AND a.group_cod = :mah_qroup
    AND a.product_cod = :mah_name
    AND a.id_ostan = :id_ostan_target
LEFT JOIN (
    SELECT
        id_city,
        SUM(s_dem) AS total_marakez_dem,
        SUM(s_abi) AS total_marakez_abi
    FROM Agri_ab_mar
    WHERE z_sal = :z_sal
    AND group_cod = :mah_qroup
    AND product_cod = :mah_name
    AND id_ostan = :id_ostan_target
    GROUP BY id_city
) m
    ON c.id_city = m.id_city
WHERE c.id_ostan = :id_ostan_target
ORDER BY BINARY c.city ASC;
";
$stmt = $dbh->prepare($query);
$stmt->execute(array(
    ':z_sal'     => $z_sal,
    ':mah_qroup' => $mah_qroup,
    ':mah_name'  => $mah_name,
    ':id_ostan_target' => $id_ostan1
));
$t_row = $stmt->rowCount();

if ($t_row > 0) {
?>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Sab_L2pd_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                   <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                   <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                 <td><form action="Sab_L2p_chart.php" method="post" onsubmit="target_popup(this)">
  <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
  <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
  <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
  <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
  <button><img src="../../files/chart1.jpg" title="مشاهده نمودار"  width="44" height="45"  alt=""/></button>
</form></td>
               </tr>
             </table>
            <table class="agri-table">
              <tr class="text1">
                <td colspan="2" bgcolor="#006699">عملکرد / کیلوگرم در هکتار<br /></td>
                <td colspan="2" bgcolor="#006699">تولید / تن <br /></td>
                <td colspan="2" bgcolor="#006699"><p>سطح   / هکتار<br /></p></td>
                <td width="19%" height="35" rowspan="2" bgcolor="#006699">عنوان</td>
                <td width="13%" rowspan="2" bgcolor="#006699">شهرستان </td>
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
                $id_city = $row['id_city'] ;

                // محاسبه ترازها
                $diff_marakez_dem = $row['s_dem_city'] - $row['total_marakez_dem'];
                $diff_marakez_abi = $row['s_abi_city'] - $row['total_marakez_abi'];

                // تعیین رنگ‌ها
                $color_marakez_dem = ($diff_marakez_dem >= 0) ? "#008000" : "#ff0000";
                $color_marakez_abi = ($diff_marakez_abi >= 0) ? "#008000" : "#ff0000";
              ?>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_dem_city']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_abi_city']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem_city']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi_city']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_dem_city']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_abi_city']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>میزان برش شهرستان</td>
                <td rowspan="3" class="style19" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'] ?></td>
                <td rowspan="3" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
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

          <p><a href="Pattern.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
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
