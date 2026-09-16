<?php
require_once("../../lock_ce.php");
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
      <span class="style8">برنامه الگوی کشت ابلاغی محصولات باغی </span><br /> 
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
                        // استفاده از product_b
                        $query = "SELECT DISTINCT group_cod,group_name FROM `product_b` ORDER BY group_cod ASC" ;
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
                           // استفاده از product_b
                           $query = "SELECT DISTINCT product_cod,product_name FROM `product_b` WHERE `group_cod` = :mah_qroup ORDER BY product_name ASC" ;
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
                     <option value="1404" <?php if (isset($z_sal) && $z_sal=='1404') echo 'selected=selected'?>>1404</option>
                     </select>
                 </div>
                 </td>
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><span class="style8">: سال </span></td>
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
// کوئری برای محصولات باغی (Garden) با فیلدهای سطح بارور و غیر بارور مجزا
$query = "
    SELECT 
        o.id_ostan,
        o.product_cod,
        o.z_sal,
        -- فیلدهای ابلاغی استان (مجزا)
        o.s_bar_dem,
        o.s_bar_abi,
        o.s_nobar_dem,
        o.s_nobar_abi,
        o.t_dem,
        o.t_abi,
        o.a_dem,
        o.a_abi,
        osn.ostan,
        
        -- فیلدهای مجموع برش شهرستانی (مجزا)
        IFNULL(c.total_city_s_bar_dem,0) AS total_city_s_bar_dem,
        IFNULL(c.total_city_s_bar_abi,0) AS total_city_s_bar_abi,
        IFNULL(c.total_city_s_nobar_dem,0) AS total_city_s_nobar_dem,
        IFNULL(c.total_city_s_nobar_abi,0) AS total_city_s_nobar_abi,
        
        -- فیلدهای مجموع برش مراکز (مجزا)
        IFNULL(m.total_marakez_s_bar_dem,0) AS total_marakez_s_bar_dem,
        IFNULL(m.total_marakez_s_bar_abi,0) AS total_marakez_s_bar_abi,
        IFNULL(m.total_marakez_s_nobar_dem,0) AS total_marakez_s_nobar_dem,
        IFNULL(m.total_marakez_s_nobar_abi,0) AS total_marakez_s_nobar_abi
        
    FROM Garden_ab_ostan o  /* تغییر جدول */
    JOIN ostanname osn ON o.id_ostan = osn.id_ostan
    LEFT JOIN (
        SELECT 
            id_ostan,
            product_cod,
            SUM(s_bar_dem) AS total_city_s_bar_dem,
            SUM(s_bar_abi) AS total_city_s_bar_abi,
            SUM(s_nobar_dem) AS total_city_s_nobar_dem,
            SUM(s_nobar_abi) AS total_city_s_nobar_abi
        FROM Garden_ab_city  /* تغییر جدول */
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
            SUM(s_bar_dem) AS total_marakez_s_bar_dem,
            SUM(s_bar_abi) AS total_marakez_s_bar_abi,
            SUM(s_nobar_dem) AS total_marakez_s_nobar_dem,
            SUM(s_nobar_abi) AS total_marakez_s_nobar_abi
        FROM Garden_ab_mar  /* تغییر جدول */
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
                <td colspan="2" bgcolor="#006699">سطح بارور/ هکتار</td>
                <td colspan="2" bgcolor="#006699">سطح غیر بارور/ هکتار</td>
                <td width="19%" height="35" rowspan="2" bgcolor="#006699">عنوان</td>
                <td width="13%" rowspan="2" bgcolor="#006699">استان </td>
                <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
              </tr>
              <tr class="text1">
                <td width="6%" bgcolor="#006699">دیم</td>
                <td width="6%" bgcolor="#006699">آبی</td>
                <td width="6%" bgcolor="#006699">دیم</td>
                <td width="6%" bgcolor="#006699">آبی</td>
                <td width="6%" bgcolor="#006699"> دیم</td>
                <td width="6%" bgcolor="#006699"> آبی</td>
                <td width="6%" bgcolor="#006699">دیم</td>
                <td width="6%" bgcolor="#006699">آبی</td>
              </tr>
              <?php
                $r = 1 ;
                foreach($stmt as $row){
                $t_r = $r ;
                $id_ostan = $row['id_ostan'] ;

                // محاسبه ترازها برای چهار فیلد مجزا
                $diff_city_s_bar_dem = $row['s_bar_dem'] - $row['total_city_s_bar_dem'];
                $diff_city_s_bar_abi = $row['s_bar_abi'] - $row['total_city_s_bar_abi'];
                $diff_city_s_nobar_dem = $row['s_nobar_dem'] - $row['total_city_s_nobar_dem'];
                $diff_city_s_nobar_abi = $row['s_nobar_abi'] - $row['total_city_s_nobar_abi'];

                $diff_marakez_s_bar_dem = $row['s_bar_dem'] - $row['total_marakez_s_bar_dem'];
                $diff_marakez_s_bar_abi = $row['s_bar_abi'] - $row['total_marakez_s_bar_abi'];
                $diff_marakez_s_nobar_dem = $row['s_nobar_dem'] - $row['total_marakez_s_nobar_dem'];
                $diff_marakez_s_nobar_abi = $row['s_nobar_abi'] - $row['total_marakez_s_nobar_abi'];

                // تعیین رنگ‌ها
                $color_city_s_bar_dem = ($diff_city_s_bar_dem >= 0) ? "#008000" : "#ff0000";
                $color_city_s_bar_abi = ($diff_city_s_bar_abi >= 0) ? "#008000" : "#ff0000";
                $color_city_s_nobar_dem = ($diff_city_s_nobar_dem >= 0) ? "#008000" : "#ff0000";
                $color_city_s_nobar_abi = ($diff_city_s_nobar_abi >= 0) ? "#008000" : "#ff0000";
                
                $color_marakez_s_bar_dem = ($diff_marakez_s_bar_dem >= 0) ? "#008000" : "#ff0000";
                $color_marakez_s_bar_abi = ($diff_marakez_s_bar_abi >= 0) ? "#008000" : "#ff0000";
                $color_marakez_s_nobar_dem = ($diff_marakez_s_nobar_dem >= 0) ? "#008000" : "#ff0000";
                $color_marakez_s_nobar_abi = ($diff_marakez_s_nobar_abi >= 0) ? "#008000" : "#ff0000";
              ?>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_dem']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['a_abi']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_nobar_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_nobar_abi']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>برنامه الگوی کشت ابلاغی</td>
                <td rowspan="5" class="style19" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan'] ?></td>
                <td rowspan="5" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
              </tr>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_city_s_bar_dem']; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_city_s_bar_abi']; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_city_s_nobar_dem']; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_city_s_nobar_abi']; ?></td>
                <td class="normalTextSmaller" align="right" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> مجموع برش شهرستانی</td>
              </tr>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_marakez_s_bar_dem']; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_marakez_s_bar_abi']; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_marakez_s_nobar_dem']; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['total_marakez_s_nobar_abi']; ?></td>
                <td class="normalTextSmaller" align="right" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> مجموع برش مراکز</td>
              </tr>
              <tr style='font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" style='color:<?php echo $color_city_s_bar_dem; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_city_s_bar_dem; ?></td>
                <td class="normalTextSmall" style='color:<?php echo $color_city_s_bar_abi; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_city_s_bar_abi; ?></td>
                <td class="normalTextSmall" style='color:<?php echo $color_city_s_nobar_dem; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_city_s_nobar_dem; ?></td>
                <td class="normalTextSmall" style='color:<?php echo $color_city_s_nobar_abi; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_city_s_nobar_abi; ?></td>
                <td class="normalTextSmall" align="right" style="padding-right: 20px;" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> تراز شهرستانی</td>
              </tr>
              <tr style='font-weight:bold;'>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>></td>
                <td class="normalTextSmall" style='color:<?php echo $color_marakez_s_bar_dem; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_marakez_s_bar_dem; ?></td>
                <td class="normalTextSmall" style='color:<?php echo $color_marakez_s_bar_abi; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_marakez_s_bar_abi; ?></td>
                <td class="normalTextSmall" style='color:<?php echo $color_marakez_s_nobar_dem; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_marakez_s_nobar_dem; ?></td>
                <td class="normalTextSmall" style='color:<?php echo $color_marakez_s_nobar_abi; ?>;' align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $diff_marakez_s_nobar_abi; ?></td>
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