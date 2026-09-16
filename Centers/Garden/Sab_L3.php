<?php 
include('../../lock_p2.php');
include('../../event.php');
require_once('../../Jalali.php');

//$id_city     = isset($_POST['id_city'])   ? $_POST['id_city']   : '';
//$id_mar      = isset($_POST['id_mar'])     ? $_POST['id_mar']     : '';
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
    var initial_id_mar = '<?php echo !empty($id_mar) ? $id_mar : ''; ?>';
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
      <span class="style1"> مشاهده برش مرکزی برنامه الگوی کشت ابلاغی محصولات باغی </span><br />
      <br />
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 350px; padding: 5px; border: 2px solid #09C; margin: auto; text-align: left; border-radius: 15px" >
          <table width="100%" height="295" border='0' align="center" cellpadding='0' cellspacing='0'>
            <tr bgcolor='#f1f1f1' ><td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td></tr>
            <tr bgcolor='#f1f1f1' >
              <td height="43" align="right" bgcolor="#FFFFFF" class="input_text" >
              <select name="id_ostan" class="input_text" id="ostan" style="width:170px ; height:40px" dir="rtl" >
                    <option value="">-- انتخاب استان --</option>
                    <?php foreach($ostans as $o): ?>
                    <option value="<?php echo $o['id_ostan']; ?>" <?php echo ($o['id_ostan'] == $id_ostan1) ? 'selected="selected"' : ''; ?>><?php echo $o['ostan']; ?></option>
                    <?php endforeach; ?>
                </select></td>
              <td  align='center' bgcolor="#FFFFFF" class="style1"> : استان</td>
            </tr>
            <tr bgcolor='#f1f1f1' >
              <td height="44" align="right" bgcolor="#FFFFFF" class="input_text" >
              <select name="id_city" class="input_text" id="shahrestan" style="width:170px ; height:40px" dir="rtl"  >
                <option value="">-- انتخاب شهرستان --</option>
                <?php
                if (!empty($id_ostan1) && !empty($id_city)) {
                    $stmt_cities = $dbh->prepare("SELECT id_city, city FROM cityname WHERE id_ostan = ? ORDER BY BINARY city ASC");
                    $stmt_cities->execute(array($id_ostan1));
                    $cities = $stmt_cities->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($cities as $c) {
                        echo '<option value="' . $c['id_city'] . '"' . (($c['id_city'] == $id_city) ? ' selected="selected"' : '') . '>' . htmlspecialchars($c['city'], ENT_QUOTES, 'UTF-8') . '</option>';
                    }
                }
                ?>
              </select></td>
              <td  align='center' bgcolor="#FFFFFF" class="style1"> : شهرستان</td>
            </tr>
            <tr bgcolor='#f1f1f1' >
              <td height="53" align="right" bgcolor="#FFFFFF" class="input_text" >
                <select name="id_mar" class="input_text" id="markaz" style="width:170px ; height:40px" dir="rtl" >
                    <option value="">-- انتخاب مرکز --</option>
                    <?php
                    if (!empty($id_city) && !empty($id_mar)) {
                        $stmt_markazes = $dbh->prepare("SELECT id_mar, mar FROM marname WHERE id_city = ? ORDER BY BINARY mar ASC");
                        $stmt_markazes->execute(array($id_city));
                        $markazes = $stmt_markazes->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($markazes as $m) {
                            echo '<option value="' . $m['id_mar'] . '"' . (($m['id_mar'] == $id_mar) ? ' selected="selected"' : '') . '>' . htmlspecialchars($m['mar'], ENT_QUOTES, 'UTF-8') . '</option>';
                        }
                    }
                    ?>
                </select>   
             </td>
              <td  align='center' bgcolor="#FFFFFF" class="style1">: مرکز </td>
            </tr>
            <tr bgcolor='#f1f1f1' >
              <td height="56" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                <select name="z_sal" class="input_text required" id="z_sal2" style="height:40px ; width:170px ; direction:rtl">
                  <option value="1404" <?php if (isset($z_sal) && $z_sal=='1404') echo 'selected=selected'?>>1404</option>
                </select>
              </div></td>
              <td width="146"  align='center' bgcolor="#FFFFFF" class="style1">: سال </td>
            </tr>
            <tr>
              <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px" value='جستجو' /></td>
            </tr>
          </table>
        </div>
      </form>

<?php
 if (isset($_POST['action']) && !empty($id_mar)) 
 {  
    $start=0;
    $limit=25;
    $id = isset($_GET['id']) ? $_GET['id'] : 1;
    $start=($id-1)*$limit;

    // تغییر به جدول باغی مرکز
    $query  = "SELECT * FROM Garden_ab_mar 
               WHERE z_sal = '$z_sal' AND id_ostan = '$id_ostan1' AND id_city = '$id_city' AND id_mar = '$id_mar' 
               AND (s_bar_abi > 0 OR s_bar_dem > 0 OR s_nobar_abi > 0 OR s_nobar_dem > 0) 
               ORDER BY product_name ASC LIMIT $start, $limit"; 
    
    $query1 = "SELECT count(*) FROM Garden_ab_mar 
               WHERE z_sal = '$z_sal' AND id_ostan = '$id_ostan1' AND id_city = '$id_city' AND id_mar = '$id_mar' 
               AND (s_bar_abi > 0 OR s_bar_dem > 0 OR s_nobar_abi > 0 OR s_nobar_dem > 0)"; 

    $stmt = $dbh->prepare($query);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) { 
?>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Sab_L3_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button type="submit" style="border:none; background:none; cursor:pointer;"><img src="../../files/xls.png" title="دانلود نتایج باغی" width="44" height="45"/></button>
                 </form></td>
               </tr>
             </table>

            <table class="agri-table">
                <thead>
                    <tr>
                        <th colspan="2">عملکرد (کیلوگرم)</th>
                        <th colspan="2">تولید (تن)</th>
                        <th colspan="2">سطح بارور (هکتار)</th>
                        <th colspan="2">سطح غیربارور (هکتار)</th>
                        <th rowspan="2">نام محصول</th>
                        <th rowspan="2" width="5%">ردیف</th>
                    </tr>
                    <tr style="background:#004c73; font-size:11px;">
                        <th>دیم</th><th>آبی</th>
                        <th>دیم</th><th>آبی</th>
                        <th>دیم</th><th>آبی</th>
                        <th>دیم</th><th>آبی</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $r = $start + 1;
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                ?>
                    <tr>
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
                </tbody>
            </table>
<?php 
    } else { echo '<p class="style8" align="center">اطلاعات باغی برای این مرکز یافت نشد</p>'; }

    // بخش صفحه‌بندی (Pagination)
    if (isset($query1)) {
        $stmt1 = $dbh->prepare($query1);
        $stmt1->execute();
        $rows = $stmt1->fetchColumn();
        $total = ceil($rows / $limit);

        function generate_hidden_inputs_agri() {
            global $id_ostan1,$id_city,$id_mar,$z_sal;
            echo '<input type="hidden" name="action" value="1" />';
            echo '<input type="hidden" name="id_ostan" value="'.htmlspecialchars($id_ostan1).'" />';
            echo '<input type="hidden" name="id_city" value="'.htmlspecialchars($id_city).'" />';
            echo '<input type="hidden" name="id_mar" value="'.htmlspecialchars($id_mar).'" />';
            echo '<input type="hidden" name="z_sal" value="'.htmlspecialchars($z_sal).'" />';
        }
        
        if($total > 1) {
    ?>
    <div dir="rtl" style="text-align:center; margin: 20px auto;">
        <ul style="display: flex; list-style: none; justify-content: center; gap: 5px; padding: 0;">
            <?php for ($i = 1; $i <= $total; $i++): ?>
                <li>
                    <form action="Sab_L3.php?id=<?= $i ?>#1" method="post">
                        <?php generate_hidden_inputs_agri(); ?>
                        <button class="button" style="<?= ($i==$id)?'background:#4CAF50;':'background:#eee;color:#333;' ?>"><?= $i ?></button>
                    </form>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
    <?php 
        }
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
</body>
</html>
