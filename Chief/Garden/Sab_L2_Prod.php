<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');

// متغیرهای ورودی - سازگار با PHP 5.3
$z_sal     = isset($_POST['z_sal'])     ? $_POST['z_sal']     : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name  = isset($_POST['mah_name'])  ? $_POST['mah_name']  : '';
$id_ostan1 = isset($_POST['id_ostan'])  ? $_POST['id_ostan']  : '';

// گرفتن لیست استان‌ها
$stmt_ostan = $dbh->query("SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC");
$ostans = $stmt_ostan->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="fa-IR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title ;?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    function target_popup(form) {
        window.open("null", "formpopup", "location=1,status=1,scrollbars=1,width=1000,height=800"); 
        form.target = 'formpopup';
    }
    </script>
    <style type="text/css">
        .style1 { color: #003366; font-family: Tahoma; font-size: 14px; font-weight: bold; }
        .style8 { font-family: Tahoma; font-size: 12px; color: #FF0000; font-weight: bold; }
        .normalTextSmall { font-family: Tahoma; font-size: 11px; }
        .header-table { background-color: #006699; color: #FFFFFF; font-weight: bold; }
    .style81 {font-family: Tahoma; font-size: 12px; color: #FF0000; font-weight: bold; }
    </style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr><td colspan="3"><?php require_once("../header.php"); ?></td></tr>
  <tr>
    <td colspan="3" valign="middle" align="center">
      <br /><span class="style1">برش الگوی کشت محصولات باغی به تفکیک شهرستان</span><br /><br />
      
      <form id="reg-form" method="post" action="">
        <div style="width: 500px; padding: 15px; border: 2px solid #09C; margin: auto; border-radius: 15px; direction: rtl;">
            <table width="100%" border='0' dir="rtl">
                <tr>
                  <td height="44" align="right" bgcolor="#FFFFFF" >استان : </td>
                    <td bgcolor="#FFFFFF">
                        <select name="id_ostan" style="width:200px; height:45px font-family:Tahoma">
                            <option value="">-- انتخاب کنید --</option>
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
                            <option value="1404" <?php if($z_sal=='1404') echo 'selected="selected"'; ?>>1404</option>
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
    </td>
  </tr>
  <tr><td height="100"></td></tr>
  <tr>
    <td colspan="3" background="../../files/bottom.gif" height="109">
        <?php require_once('../../footer.php'); ?>
    </td>
  </tr>
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