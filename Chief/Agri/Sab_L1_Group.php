<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');

// متغیرهای ورودی جدید
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';

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
 if (isset($_POST['action']) && !empty($mah_qroup) && !empty($z_sal))
 {

// نمایش نتایج تجمیعی برای هر استان
$query = "
    SELECT
        o.id_ostan,
        osn.ostan,
        SUM(o.s_dem) AS s_dem,
        SUM(o.s_abi) AS s_abi,
        SUM(o.t_dem) AS t_dem,
        SUM(o.t_abi) AS t_abi,
        SUM(o.a_dem) AS a_dem,
        SUM(o.a_abi) AS a_abi,
        IFNULL(c.total_city_dem,0) AS total_city_dem,
        IFNULL(c.total_city_abi,0) AS total_city_abi,
        IFNULL(m.total_marakez_dem,0) AS total_marakez_dem,
        IFNULL(m.total_marakez_abi,0) AS total_marakez_abi
    FROM Agri_ab_ostan o
    JOIN ostanname osn ON o.id_ostan = osn.id_ostan
    LEFT JOIN (
        SELECT
            id_ostan,
            SUM(s_dem) AS total_city_dem,
            SUM(s_abi) AS total_city_abi
        FROM Agri_ab_city
        WHERE z_sal = :z_sal
        AND group_cod = :mah_qroup
        GROUP BY id_ostan
    ) c
       ON o.id_ostan = c.id_ostan
    LEFT JOIN (
        SELECT
            id_ostan,
            SUM(s_dem) AS total_marakez_dem,
            SUM(s_abi) AS total_marakez_abi
        FROM Agri_ab_mar
        WHERE z_sal = :z_sal
        AND group_cod = :mah_qroup
        GROUP BY id_ostan
    ) m
       ON o.id_ostan = m.id_ostan
    WHERE o.z_sal = :z_sal
      AND o.group_cod = :mah_qroup
    GROUP BY o.id_ostan, osn.ostan
    ORDER BY FIELD(o.id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')
";
$stmt = $dbh->prepare($query);
$stmt->execute(array(
    ':z_sal'     => $z_sal,
    ':mah_qroup' => $mah_qroup
));
$t_row = $stmt->rowCount();

if ($t_row > 0) {
?>
             <table width="122" height="76" border="0" align="center">
               <tr>
                 <td height="72"><form  action="Sab_L1_Group_xls.php" method="post">
                   <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
                 <td><form action="Sab_L1_Group_chart.php" method="post" onsubmit="target_popup(this)">
                   <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button><img src="../../files/chart1.jpg" title="مشاهده نمودار"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
            <table class="my-table" align="center">
              <tr class="text1">
                <td colspan="3" bgcolor="#006699">تولید / تن <br /></td>
                <td colspan="3" bgcolor="#006699"><p>سطح   / هکتار<br /></p></td>
                <td width="22%" rowspan="2" bgcolor="#006699">استان </td>
                <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
              </tr>
              <tr class="text1">
                <td width="13%" bgcolor="#006699">مجموع</td>
                <td width="13%" height="35" bgcolor="#006699">دیم</td>
                <td width="11%" bgcolor="#006699">آبی</td>
                <td width="12%" bgcolor="#006699">مجموع</td>
                <td width="12%" bgcolor="#006699">دیم</td>
                <td width="12%" bgcolor="#006699">آبی</td>
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

                // محاسبه مجموع کل برای هر ردیف
                $total_surface = $row['s_dem'] + $row['s_abi'];
                $total_production = $row['t_dem'] + $row['t_abi'];
              ?>
              <tr style='background:#f0f0f0; font-weight:bold;'>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $total_production*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem']*1; ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $total_surface*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_dem']*1; ?></td>
                <td class="normalTextSmall" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_abi']*1; ?></td>
                <td class="style19" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan'] ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
              </tr>

              <?php
              $r++ ;
              }
              ?>
            </table>
            <p class="style2" align="center">
            <?php
} else {
    echo '<p class="style8">اطلاعاتی یافت نشد. لطفاً گروه محصولات و سال زراعی را انتخاب و جستجو کنید.</p>';
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

</body>
</html>