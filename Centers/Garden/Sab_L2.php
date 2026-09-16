<?php 
include('../../lock_p2.php');
include('../../event.php');
require_once('../../Jalali.php');

//$id_city     = isset($_POST['id_city'])   ? $_POST['id_city']   : '';
$z_sal       = isset($_POST['z_sal'])      ? $_POST['z_sal']      : '';
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
    var initial_id_ostan = '<?php echo !empty($id_ostan1) ? $id_ostan1 : ''; ?>';
    var initial_id_city = '<?php echo !empty($id_city) ? $id_city : ''; ?>';
</script>
<script src="../../location/ajax-location.js"></script>
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
                
                <select name="id_city" disabled="disabled" class="input_text" id="shahrestan" style="width:170px ; height:40px" dir="rtl" >
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
                        <option value="1404" <?php if ($z_sal=='1404') echo 'selected="selected"'?>>1404</option>
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
          <p><a href="Pattern.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
