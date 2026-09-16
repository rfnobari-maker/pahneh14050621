<?php 
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');

// متغیرهای ورودی جدید
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
$id_ostan1 = $id_ostan ; 

// گرفتن لیست استان‌ها
$stmt_ostan = $dbh->query("SELECT id_ostan, ostan FROM ostanname where id_ostan = $id_ostan ");
$ostans = $stmt_ostan->fetchAll(PDO::FETCH_ASSOC);

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
      <br /><span class="style1">برش الگوی کشت محصولات باغی به تفکیک شهرستان</span><br /><br />
      
      <form id="reg-form" method="post" action="">
        <div style="width: 500px; padding: 15px; border: 2px solid #09C; margin: auto; border-radius: 15px; direction: rtl;">
            <table width="100%" border='0' dir="rtl">
                <tr>
                  <td height="44" align="right" bgcolor="#FFFFFF" >استان : </td>
                    <td bgcolor="#FFFFFF">
                        <select name="id_ostan" style="width:200px; height:45px font-family:Tahoma">
                            <?php foreach($ostans as $o): ?>
                                <option value="<?php echo $o['id_ostan']; ?>" <?php if($o['id_ostan'] == $id_ostan1) echo 'selected="selected"'; ?>><?php echo $o['ostan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                  <td height="36" align='right' bgcolor="#FFFFFF" >گروه محصولات :</font></td>
                    <td bgcolor="#FFFFFF">
                        <select name="mah_qroup" class="country" style="width:200px; font-family:Tahoma">
                            <option value="">انتخاب گروه</option>
                            <?php
                            $stmt_g = $dbh->query("SELECT DISTINCT group_cod, group_name FROM product_b ORDER BY group_cod");
                            while($row_g = $stmt_g->fetch(PDO::FETCH_ASSOC)) {
                                $sel = ($mah_qroup == $row_g['group_cod']) ? 'selected="selected"' : '';
                                echo "<option value='".$row_g['group_cod']."' ".$sel.">".$row_g['group_name']."</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                  <td height="38" align='right' bgcolor="#FFFFFF" > نام محصول :</td>
                    <td bgcolor="#FFFFFF">
                        <select name="mah_name" class="mar" style="width:200px; font-family:Tahoma">
                            <?php
                            if(!empty($mah_qroup)) {
                                $stmt_p = $dbh->prepare("SELECT product_cod, product_name FROM product_b WHERE group_cod = :gc");
                                $stmt_p->execute(array(':gc' => $mah_qroup));
                                while($row_p = $stmt_p->fetch(PDO::FETCH_ASSOC)) {
                                    $sel = ($mah_name == $row_p['product_cod']) ? 'selected="selected"' : '';
                                    echo "<option value='".$row_p['product_cod']."' ".$sel.">".$row_p['product_name']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                  <td width="146" height="35" align='right' bgcolor="#FFFFFF" >سال :</td>
                    <td bgcolor="#FFFFFF">
                   <select name="z_sal" style="width:200px; font-family:Tahoma">
                     <option value="1405" <?php if (isset($z_sal) && $z_sal=='1405') echo 'selected=selected'?>>1405</option>
                     <option value="1404" <?php if (isset($z_sal) && $z_sal=='1404') echo 'selected=selected'?>>1404</option>
                   </select>
                  </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><br /><input type="submit" name="action" value="جستجو و نمایش" style="width:120px; font-family:Tahoma" /></td>
                </tr>
            </table>
        </div>
      </form>

<?php
if (isset($_POST['action']) && !empty($mah_name) && !empty($id_ostan1)) {
    // کوئری متناسب با جداول باغی و محاسبه مجموع عملکرد مراکز
    $query = "
    SELECT 
        c.id_city, c.city,
        a.s_bar_dem, a.s_bar_abi, a.s_nobar_dem, a.s_nobar_abi,
        a.t_dem, a.t_abi, a.a_dem, a.a_abi,
        IFNULL(m.m_s_bar_dem, 0) AS m_s_bar_dem,
        IFNULL(m.m_s_bar_abi, 0) AS m_s_bar_abi,
        IFNULL(m.m_s_nobar_dem, 0) AS m_s_nobar_dem,
        IFNULL(m.m_s_nobar_abi, 0) AS m_s_nobar_abi
    FROM cityname c
    LEFT JOIN Garden_ab_city a ON  a.id_ostan = :io AND c.id_city = a.id_city AND  a.z_sal = :zs AND a.product_cod = :pn
    LEFT JOIN (
        SELECT id_city, 
            SUM(s_bar_dem) as m_s_bar_dem, SUM(s_bar_abi) as m_s_bar_abi,
            SUM(s_nobar_dem) as m_s_nobar_dem, SUM(s_nobar_abi) as m_s_nobar_abi
        FROM Garden_ab_mar 
        WHERE z_sal = :zs AND product_cod = :pn AND id_ostan = :io
        GROUP BY id_city
    ) m ON c.id_city = m.id_city
    WHERE c.id_ostan = :io
    ORDER BY BINARY c.city ASC";

    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':zs' => $z_sal, ':pn' => $mah_name, ':io' => $id_ostan1));

    if ($stmt->rowCount() > 0) {
?>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form action="Sab_L2p_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                   <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                   <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود اکسل" width="44" height="45" /></button>
                 </form></td>
                 <td><form action="Sab_L2p_chart.php" method="post" onsubmit="target_popup(this)">
                  <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                  <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                  <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                  <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                  <button><img src="../../files/chart1.jpg" title="مشاهده نمودار" width="44" height="45" /></button>
                 </form></td>
               </tr>
             </table>

        <table width="98%" border="1" cellpadding="3" cellspacing="0" align="center" style="border-collapse:collapse; margin-top:20px;">
            <tr class="header-table normalTextSmall">
                <td colspan="2">عملکرد</td><td colspan="2">تولید</td>
                <td colspan="2">سطح بارور</td><td colspan="2">سطح غیربارور</td>
                <td rowspan="2">عنوان</td><td rowspan="2">شهرستان</td><td rowspan="2">ردیف</td>
            </tr>
            <tr class="header-table normalTextSmall">
                <td>دیم</td><td>آبی</td><td>دیم</td><td>آبی</td>
                <td>دیم</td><td>آبی</td><td>دیم</td><td>آبی</td>
            </tr>
            <?php 
            $r = 1;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                $bg = ($r % 2 == 0) ? '#FFFFCC' : '#FFFFFF';
                
                // محاسبات تراز برای بارور و غیربارور (بر اساس Sab_L1_Prod)
                $diff_s_bar_dem = $row['s_bar_dem'] - $row['m_s_bar_dem'];
                $diff_s_bar_abi = $row['s_bar_abi'] - $row['m_s_bar_abi'];
                $diff_s_nobar_dem = $row['s_nobar_dem'] - $row['m_s_nobar_dem'];
                $diff_s_nobar_abi = $row['s_nobar_abi'] - $row['m_s_nobar_abi'];

                // تعیین رنگ ترازها
                $c_bar_dem = ($diff_s_bar_dem >= 0) ? "green" : "red";
                $c_bar_abi = ($diff_s_bar_abi >= 0) ? "green" : "red";
                $c_nobar_dem = ($diff_s_nobar_dem >= 0) ? "green" : "red";
                $c_nobar_abi = ($diff_s_nobar_abi >= 0) ? "green" : "red";
            ?>
                <tr bgcolor="<?php echo $bg; ?>" class="normalTextSmall" style="font-weight:bold;">
                    <td align="center"><?php echo $row['a_dem']*1; ?></td><td align="center"><?php echo $row['a_abi']*1; ?></td>
                    <td align="center"><?php echo $row['t_dem']*1; ?></td><td align="center"><?php echo $row['t_abi']*1; ?></td>
                    <td align="center"><?php echo $row['s_bar_dem']*1; ?></td><td align="center"><?php echo $row['s_bar_abi']*1; ?></td>
                    <td align="center"><?php echo $row['s_nobar_dem']*1; ?></td><td align="center"><?php echo $row['s_nobar_abi']*1; ?></td>
                    <td align="right" bgcolor="#EAEAEA">برش ابلاغی شهرستان</td>
                    <td rowspan="3" align="center"><?php echo $row['city']; ?></td>
                    <td rowspan="3" align="center"><?php echo $r++; ?></td>
                </tr>
                <tr bgcolor="<?php echo $bg; ?>" class="normalTextSmall">
                    <td colspan="4"></td>
                    <td align="center"><?php echo $row['m_s_bar_dem']*1; ?></td><td align="center"><?php echo $row['m_s_bar_abi']*1; ?></td>
                    <td align="center"><?php echo $row['m_s_nobar_dem']*1; ?></td><td align="center"><?php echo $row['m_s_nobar_abi']*1; ?></td>
                    <td align="right">مجموع برش مراکز</td>
                </tr>
                <tr bgcolor="<?php echo $bg; ?>" class="normalTextSmall" style="font-weight:bold;">
                    <td colspan="4"></td>
                    <td align="center" style="color:<?php echo $c_bar_dem; ?>"><?php echo $diff_s_bar_dem; ?></td>
                    <td align="center" style="color:<?php echo $c_bar_abi; ?>"><?php echo $diff_s_bar_abi; ?></td>
                    <td align="center" style="color:<?php echo $c_nobar_dem; ?>"><?php echo $diff_s_nobar_dem; ?></td>
                    <td align="center" style="color:<?php echo $c_nobar_abi; ?>"><?php echo $diff_s_nobar_abi; ?></td>
                    <td align="right">تراز مراکز</td>
                </tr>
            <?php } ?>
        </table>
<?php
    } else {
        echo '<p class="style8" align="center">اطلاعاتی یافت نشد.</p>';
    }
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
$(document).ready(function() {
  $(".country").change(function() {
    var id = $(this).val();
    $.ajax({
      type: "POST",
      url: "ajax_city.php",
      data: 'group_cod=' + id,
      success: function(html) { $(".mar").html(html); }
    });
  });
});
</script>
</body>
</html>
