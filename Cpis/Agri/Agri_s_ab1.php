<?php
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../side_menu1.php');
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
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
                 <td height="60" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <?php
$query = "SELECT id_ostan,ostan FROM `ostanname`  ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                     <?php 
		   }?>
                   </select>
                   <?php 
				   if (isset($_POST['id_ostan']))
  $id_ostan1= $_POST['id_ostan'] ; 
?></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style8">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="71" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal2" style="height:40px ; width:170px ; direction:rtl" tabindex="1">
                     <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                     </select>
                 </div>                   <?php 
				   if (isset($_POST['id_city5']))
  $id_city = $_POST['id_city5'] ; 
?></td>
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
 if (isset($_POST['action'])) 
 {  
$query = "
INSERT INTO Agri_ab_ostan (group_cod, group_name, product_cod, product_name, id_ostan, z_sal)
SELECT p.group_cod, p.group_name, p.product_cod, p.product_name, :id_ostan1, :z_sal
FROM product_z p
LEFT JOIN Agri_ab_ostan a 
  ON p.product_cod = a.product_cod 
     AND a.id_ostan = :id_ostan1 
     AND a.z_sal = :z_sal
WHERE a.product_cod IS NULL";
$q = $dbh->prepare($query);
$q->execute(array(
    ':id_ostan1' => $id_ostan1,
    ':z_sal'     => $z_sal
));




$start=0;
$limit=25;
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$start=($id-1)*$limit;
 $query = "SELECT  * from Agri_ab_ostan where z_sal = '$z_sal' and id_ostan = '$id_ostan1' group by group_cod,product_cod ASC LIMIT $start, $limit "; 
 $query1 = "SELECT  count(*) from Agri_ab_ostan where z_sal = '$z_sal' and id_ostan = '$id_ostan1'"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Agri_sab_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
            <table class="agri-table">
              <tr class="text1">
          <td width="7%" rowspan="2" bgcolor="#006699">عملیات</td>
          <td colspan="2" bgcolor="#006699">عملکرد / کیلوگرم در هکتار<br /></td>
          <td colspan="2" bgcolor="#006699">تولید / تن <br /></td>
          <td colspan="2" bgcolor="#006699"><p>سطح   / هکتار<br />
          </p></td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات </td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="15%" bgcolor="#006699">دیم</td>
          <td width="12%" bgcolor="#006699">آبی</td>
          <td width="11%" bgcolor="#006699">دیم</td>
          <td width="9%" bgcolor="#006699">آبی</td>
          <td width="10%" bgcolor="#006699">دیم</td>
          <td width="9%" bgcolor="#006699">آبی</td>
          <td width="12%" height="36" bgcolor="#006699" class="text1">نام محصول </td>
          <td width="10%" bgcolor="#006699">گروه</td>
          </tr>
        <tr>
          <?php 
//$r = $start+1 ;
$r = 1 ;
foreach($stmt as $row){ 
 $t_r = $r ; 
  ?>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form name="form<?php echo $t_r ?>">
              <input type="hidden" id="id<?php echo $t_r ?>" name="id" value="<?php echo $row['id'] ;?>" />
              <input type="hidden" id="id_ostan<?php echo $t_r ?>"  name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
              <input type="hidden" id="z_sal"     name="z_sal" value="<?php echo $z_sal ;?>" />
              <input name="submit"  type="submit" class="submit<?php echo $t_r ?>" id="submit<?php echo $t_r ?>" style="width:40px ; height:35px ; font-size:14px ; color:#900 ; font-family:tahoma ; text-align:center" tabindex="<?php echo ($r*10+7); ?>"  value="ثبت"  />
              <span class="error<?php echo $t_r ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15"  alt=""/></span>
              <span class="success<?php echo $t_r ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15"  alt=""/></span>
            </form>
          </td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="a_dem"  type="text" class="a_dem<?php echo $t_r ?> required number input_text" id="a_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+6); ?>"  dir="rtl" lang="fa" value="" maxlength="8"  align="baseline" xml:lang="fa" readonly /></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="a_abi"  type="text" class="a_abi<?php echo $t_r ?> required number input_text" id="a_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+5); ?>"  dir="rtl" lang="fa" value="" maxlength="8"  align="baseline" xml:lang="fa" readonly /></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="t_dem"  type="text" class="t_dem<?php echo $t_r ?> required number input_text" id="t_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+4); ?>"  dir="rtl" lang="fa" value="<?php  echo $row['t_dem']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" /></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="t_abi"  type="text" class="t_abi<?php echo $t_r ?> required number input_text" id="t_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+3); ?>"  dir="rtl" lang="fa" value="<?php  echo $row['t_abi']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" /></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="s_dem"  type="text" class="s_dem<?php echo $t_r ?> required digits input_text" id="s_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+2); ?>"  dir="rtl" lang="fa" value="<?php echo $row['s_dem']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" /></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="s_abi"  type="text" class="s_abi<?php echo $t_r ?> required digits input_text" id="s_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+1); ?>"  dir="rtl" lang="fa" value="<?php echo $row['s_abi']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" /></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <?php echo $row['product_name'] ?>
          </td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $row['group_name']?></div></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
  <p class="style2" align="center">
    <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
if (isset($query1)) {
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute();
    $rows = $stmt1->fetchColumn();
    $total = ceil($rows / $limit);
    $t_row = ($rows > 25) ? 25 : $rows;

    // تابع تولید ورودی‌های hidden
    function generate_hidden_inputs_agri()
    {
        global $id_ostan1, $z_sal, $dis;
        ?>
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?= htmlspecialchars($id_ostan1) ?>" />
        <input type="hidden" name="z_sal" value="<?= htmlspecialchars($z_sal) ?>" />
        <input type="hidden" name="dis" value="<?= htmlspecialchars($dis) ?>" />
        <?php
    }

    // بازه صفحات قابل نمایش (5 صفحه قبل و بعد از صفحه فعلی)
    $visible_pages = 5;
    $start_page = max(1, $id - $visible_pages);
    $end_page = min($total, $id + $visible_pages);
    ?>

    <div dir="rtl" class="pagination-container" style="text-align:center; margin: 20px auto;">
        <ul class="pagination" style="display: flex; list-style: none; justify-content: center; flex-wrap: wrap; gap: 5px; padding: 0;">

            <?php if ($id > 1): ?>
                <li>
                    <form action="Agri_s_ab.php?id=<?= $id - 1 ?>#1" method="post">
                        <?php generate_hidden_inputs_agri(); ?>
                        <button class="button" style="background: #4CAF50; color: white; padding: 8px 12px; border: none; border-radius: 4px;">&laquo; قبلی</button>
                    </form>
                </li>
            <?php endif; ?>

            <?php if ($start_page > 1): ?>
                <li>
                    <form action="Agri_s_ab.php?id=1#1" method="post">
                        <?php generate_hidden_inputs_agri(); ?>
                        <button class="button" style="background: #eee; padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px;">1</button>
                    </form>
                </li>
                <?php if ($start_page > 2): ?>
                    <li style="padding: 6px 10px; color: #999;">...</li>
                <?php endif; ?>
            <?php endif; ?>

            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                <li>
                    <?php if ($i == $id): ?>
                        <span style="background: #4CAF50; color: white; padding: 6px 10px; border-radius: 4px;"><?= $i ?></span>
                    <?php else: ?>
                        <form action="Agri_s_ab.php?id=<?= $i ?>#1" method="post">
                            <?php generate_hidden_inputs_agri(); ?>
                            <button class="button" style="background: #f8f8f8; color:#999; padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px;"><?= $i ?></button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>

            <?php if ($end_page < $total): ?>
                <?php if ($end_page < $total - 1): ?>
                    <li style="padding: 6px 10px; color: #999;">...</li>
                <?php endif; ?>
                <li>
                    <form action="Agri_s_ab.php?id=<?= $total ?>#1" method="post">
                        <?php generate_hidden_inputs_agri(); ?>
                        <button class="button" style="background: #eee; padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px;"><?= $total ?></button>
                    </form>
                </li>
            <?php endif; ?>

            <?php if ($id < $total): ?>
                <li>
                    <form action="Agri_s_ab.php?id=<?= $id + 1 ?>#1" method="post">
                        <?php generate_hidden_inputs_agri(); ?>
                        <button class="button" style="background: #4CAF50; color: white; padding: 8px 12px; border: none; border-radius: 4px;">بعدی &raquo;</button>
                    </form>
                </li>
            <?php endif; ?>

        </ul>

        <div style="margin-top: 15px;">
            <form method="post" action="Agri_s_ab.php" style="display: inline-flex; align-items: center; gap: 10px;">
                <?php generate_hidden_inputs_agri(); ?>
                <span>به صفحه:</span>
                <input type="number" name="page_input" value="<?= $id ?>" style="width: 60px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                <button type="submit" class="button" style="background: #4CAF50; color: white; padding: 6px 12px; border: none; border-radius: 4px;">برو</button>
            </form>
        </div>
    </div>

    <script>
    document.querySelector('.pagination-container form[action="Agri_s_ab.php"]').addEventListener('submit', function (e) {
        const input = this.querySelector('input[name="page_input"]');
        const value = parseInt(input.value);
        if (isNaN(value) || value < 1 || value > <?= $total ?>) {
            e.preventDefault();
            alert('لطفاً عددی بین 1 تا <?= $total ?> وارد کنید.');
        } else {
            this.action = `Agri_s_ab.php?id=${value}#1`;
        }
    });
    </script>

<?php
}
?>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
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
<?php
$no = isset($t_row) ? $t_row : 0;
while ($no > 0){
?>
   <script type="text/javascript" >
$(function() {
$(".submit<?php echo $no ?>").click(function() {
var s_abi     = $("#s_abi<?php echo $no ?>").val();
var s_dem     = $("#s_dem<?php echo $no ?>").val();
var t_abi     = $("#t_abi<?php echo $no ?>").val();
var t_dem     = $("#t_dem<?php echo $no ?>").val();
var a_abi     = $("#a_abi<?php echo $no ?>").val();
var a_dem     = $("#a_dem<?php echo $no ?>").val();
var id        = $("#id<?php echo $no ?>").val();
var id_ostan   = $("#id_ostan").val();
var z_sal       = $("#z_sal").val();
var dataString = 's_abi='+s_abi+'&s_dem='+s_dem+'&t_abi='+t_abi+'&t_dem='+t_dem+'&a_abi='+a_abi+'&a_dem='+a_dem+'&id='+id+'&id_ostan='+id_ostan+'&z_sal='+z_sal;
console.log(dataString);
if( (parseFloat(s_abi) > 0   &&  parseFloat(t_abi) <= 0 )|| (parseFloat(s_dem) > 0   &&  parseFloat(t_dem) <= 0 ) )
{
$('.success<?php echo $no ?>').fadeOut(200).hide();
$('.error<?php echo $no ?>').fadeOut(200).show();
}
else
{
$.ajax({
type: "POST",
url: "sabt_ab.php",
data: dataString,
success: function(){
$('.success<?php echo $no ?>').fadeIn(200).show();
$('.error<?php echo $no ?>').fadeOut(200).hide();
}
});
}
return false;
});
});
</script>
<script>
function formatNumberWithSeparator(num) {
  if(num === null || num === undefined || num === "") return "";
  var parts = num.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "٬");
  return parts.join(".");
}
function unformatNumber(str) {
  return str.replace(/٬/g, "");
}
function enforceNumericInput(el) {
  el.addEventListener('input', function(e) {
    let value = el.value.replace(/[^\d.]/g, '');
    // فقط یک نقطه مجاز است
    let parts = value.split('.');
    if(parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');
    // جداکننده هزارگان
    if(value !== "") el.value = formatNumberWithSeparator(value);
    else el.value = "";
  });
  // هنگام paste
  el.addEventListener('paste', function(e) {
    setTimeout(function(){
      let value = el.value.replace(/[^\d.]/g, '');
      let parts = value.split('.');
      if(parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');
      if(value !== "") el.value = formatNumberWithSeparator(value);
      else el.value = "";
    }, 0);
  });
}
function calcRow(row) {
  var t_abi = parseFloat(unformatNumber(document.getElementById('t_abi'+row).value)) || 0;
  var s_abi = parseFloat(unformatNumber(document.getElementById('s_abi'+row).value)) || 0;
  var t_dem = parseFloat(unformatNumber(document.getElementById('t_dem'+row).value)) || 0;
  var s_dem = parseFloat(unformatNumber(document.getElementById('s_dem'+row).value)) || 0;
  var a_abi = (s_abi !== 0) ? (t_abi/s_abi*1000).toFixed(2) : '';
  var a_dem = (s_dem !== 0) ? (t_dem/s_dem*1000).toFixed(2) : '';
  document.getElementById('a_abi'+row).value = formatNumberWithSeparator(a_abi);
  document.getElementById('a_dem'+row).value = formatNumberWithSeparator(a_dem);
}
window.addEventListener('DOMContentLoaded', function() {
  var i = 1;
  while(document.getElementById('t_abi'+i)) {
    (function(row){
      ['t_abi','s_abi','t_dem','s_dem'].forEach(function(field) {
        var el = document.getElementById(field+row);
        if(el) {
          enforceNumericInput(el);
          el.addEventListener('input', function(){ calcRow(row); });
        }
      });
      // مقدار اولیه را هم محاسبه کن
      calcRow(row);
    })(i);
    i++;
  }
});
</script>
<?php
 $no--;
}
?>