<?php
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../side_menu1.php');

$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city   = isset($_POST['id_city'])   ? $_POST['id_city']   : '';
$z_sal     = isset($_POST['z_sal'])     ? $_POST['z_sal']     : '';

// گرفتن لیست استان‌ها
$stmt = $dbh->query("SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC");
$ostans = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    var initial_id_ostan = '<?php echo $id_ostan1; ?>';
    var initial_id_city = '<?php echo $id_city; ?>';
</script>
<script src="../../location/ajax-location.js"></script>
<style type="text/css">
/* حفظ استایل‌های اصلی کادر جستجو */
.style1 { color: #003366; font-family: Tahoma; font-size: 18px; }
.style8 { font-family: Tahoma; font-size: 12px; color: #FF0000; font-weight: bold; }
.agri-table { width: 95%; margin: 24px auto; border-collapse: collapse; font-family: Tahoma; font-size: 15px; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.07); border-radius: 12px; overflow: hidden; }
.agri-table th, .agri-table td { padding: 10px 8px; text-align: center; border-bottom: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0; }
.agri-table th { background: #006699; color: #fff; font-weight: bold; font-size: 16px; }
.normalTextSmall { font-family: Tahoma; font-size: 11px; }
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr><td colspan="3"><?php require_once("../header.php"); ?></td></tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <span class="style1"> مشاهده برش شهرستانی برنامه الگوی کشت ابلاغی محصولات باغی </span><br />
      <br />
      
      <form id="reg-form" method="post" action="#1">
        <div style="width: 350px; padding: 5px; border: 2px solid #09C; margin: auto; text-align: left; border-radius: 15px" >
          <table width="100%" height="240" border='0' align="center" cellpadding='0' cellspacing='0'>
            <tr bgcolor='#f1f1f1' ><td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td></tr>
            <tr bgcolor='#f1f1f1' >
              <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" >
                <select name="id_ostan" class="input_text" id="ostan" style="width:170px ; height:40px" dir="rtl" >
                    <option value="">-- انتخاب استان --</option>
                    <?php foreach($ostans as $o): ?>
                    <option value="<?php echo $o['id_ostan']; ?>" <?php echo ($o['id_ostan'] == $id_ostan1) ? 'selected="selected"' : ''; ?>><?php echo $o['ostan']; ?></option>
                    <?php endforeach; ?>
                </select>
              </td>
              <td align='center' bgcolor="#FFFFFF" class="style8"><span class="style1"> : استان</span></td>
            </tr>
            <tr bgcolor='#f1f1f1' >
              <td height="52" align="right" bgcolor="#FFFFFF" class="input_text" >
                <select name="id_city" class="input_text" id="shahrestan" style="width:170px ; height:40px" dir="rtl" >
                    <option value="">-- انتخاب شهرستان --</option>
                    <?php
                    if (!empty($id_ostan1)) {
                        $stmt_cities = $dbh->prepare("SELECT id_city, city FROM cityname WHERE id_ostan = ? ORDER BY BINARY city ASC");
                        $stmt_cities->execute(array($id_ostan1));
                        while ($c = $stmt_cities->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="'.$c['id_city'].'"'.(($c['id_city'] == $id_city)?' selected="selected"':'').'>'.$c['city'].'</option>';
                        }
                    }
                    ?>
                </select>
              </td>
              <td align='center' bgcolor="#FFFFFF" class="style1"> : شهرستان</td>
            </tr>
            <tr bgcolor='#f1f1f1' >
              <td height="59" align="right" bgcolor="#FFFFFF" class="input_text" >
                <div align="right">
                    <select name="z_sal" class="input_text required" id="z_sal2" style="height:40px ; width:170px ; direction:rtl" tabindex="1">
                     <option value="1405" <?php if (isset($z_sal) && $z_sal=='1405') echo 'selected=selected'?>>1405</option>
                     <option value="1404" <?php if (isset($z_sal) && $z_sal=='1404') echo 'selected=selected'?>>1404</option>
                    </select>
                </div>
              </td>
              <td width="146" align='center' bgcolor="#FFFFFF" class="style1">: سال </td>
            </tr>
            <tr>
              <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px" value='جستجو' /></td>
            </tr>
          </table>
        </div>
      </form>

<?php
if (isset($_POST['action']) && !empty($id_city)) {  
    // تغییر کوئری به جدول باغی Garden_ab_city
    $query = "SELECT * FROM Garden_ab_city 
              WHERE z_sal = :zs AND id_ostan = :io AND id_city = :ic 
              AND (s_bar_abi > 0 OR s_bar_dem > 0 OR s_nobar_abi > 0 OR s_nobar_dem > 0)
              ORDER BY product_name ASC";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':zs' => $z_sal, ':io' => $id_ostan1, ':ic' => $id_city));

    if ($stmt->rowCount() > 0) {
?>
        <table width="122" border="0" align="center" style="margin-top:10px;">
           <tr>
             <td><form action="Sab_L2_xls.php" method="post">
               <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1; ?>" />
               <input type="hidden" name="id_city" value="<?php echo $id_city; ?>" />
               <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
               <button type="submit" style="border:none; background:none; cursor:pointer;"><img src="../../files/xls.png" width="44" height="45" /></button>
             </form></td>
           </tr>
        </table>
        
        <table class="agri-table">
          <tr class="text1">
            <td colspan="2" bgcolor="#006699">عملکرد (کیلوگرم)</td>
            <td colspan="2" bgcolor="#006699">تولید (تن)</td>
            <td colspan="2" bgcolor="#006699">سطح بارور (هکتار)</td>
            <td colspan="2" bgcolor="#006699">سطح غیربارور (هکتار)</td>
            <td width="15%" bgcolor="#006699">نام محصول</td>
            <td width="5%" bgcolor="#006699">ردیف</td>
          </tr>
          <tr class="text1" style="background:#006699; color:#fff; font-size:11px;">
            <td>دیم</td><td>آبی</td><td>دیم</td><td>آبی</td><td>دیم</td><td>آبی</td><td>دیم</td><td>آبی</td>
            <td colspan="2"></td>
          </tr>
          <?php 
          $r = 1;
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
            $bg = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : '';
          ?>
          <tr <?php echo $bg; ?> class="normalTextSmall">
            <td><?php echo $row['a_dem']*1; ?></td>
            <td><?php echo $row['a_abi']*1; ?></td>
            <td><?php echo $row['t_dem']*1; ?></td>
            <td><?php echo $row['t_abi']*1; ?></td>
            <td><?php echo $row['s_bar_dem']*1; ?></td>
            <td><?php echo $row['s_bar_abi']*1; ?></td>
            <td><?php echo $row['s_nobar_dem']*1; ?></td>
            <td><?php echo $row['s_nobar_abi']*1; ?></td>
            <td align="right"><?php echo $row['product_name']; ?></td>
            <td><?php echo $r++; ?></td>
          </tr>
          <?php } ?>
        </table>
<?php 
    } else { echo '<p class="style8" align="center">اطلاعاتی یافت نشد</p>'; }
}
?>
    </td>
  </tr>
  <tr><td height="109" colspan="3" background="../../files/bottom.gif"><?php include('../../footer.php'); ?></td></tr>
</table>
</body>
</html>