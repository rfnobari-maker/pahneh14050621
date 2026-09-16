<?php 
include('../../lock_p3.php');
include('../../event.php');
require_once('../../Jalali.php');

$id_ostan1 = $id_ostan;
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
      <span class="style8"> مشاهده برنامه الگوی کشت ابلاغی محصولات باغی به تفکیک استان</span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 350px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="213" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="60" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
                     <?php
$query = "SELECT id_ostan,ostan FROM `ostanname` where id_ostan = ? "  ;
$stmt = $dbh->prepare($query);
$stmt->execute(array($id_ostan));
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
                        <option value="1405" <?php if ($z_sal=='1405') echo 'selected="selected"'?>>1405</option><br />
                        <option value="1404" <?php if ($z_sal=='1404') echo 'selected="selected"'?>>1404</option>                     </select>
                 </div>                   <?php
?></td>
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
 if (isset($_POST['action']))
 {
// منطق INSERT برای محصولات باغی هم حذف شده است تا فقط نمایش داده شوند
/*
$query = "
INSERT INTO Garden_ab_ostan (group_cod, group_name, product_cod, product_name, id_ostan, z_sal)
SELECT p.group_cod, p.group_name, p.product_cod, p.product_name, :id_ostan1, :z_sal
FROM product_g p
LEFT JOIN Garden_ab_ostan a
  ON p.product_cod = a.product_cod
     AND a.id_ostan = :id_ostan1
     AND a.z_sal = :z_sal
WHERE a.product_cod IS NULL";
$q = $dbh->prepare($query);
$q->execute(array(
    ':id_ostan1' => $id_ostan1,
    ':z_sal'     => $z_sal
));
*/


$start=0;
$limit=25;
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$start=($id-1)*$limit;

// کوئری برای محصولات باغی از جدول Garden_ab_ostan
 $query = "SELECT  
              product_name, group_name, product_cod, 
              s_bar_abi, s_bar_dem, 
              s_nobar_abi, s_nobar_dem, 
              t_abi, t_dem 
            FROM Garden_ab_ostan 
            WHERE z_sal = '$z_sal' AND id_ostan = '$id_ostan1' 
            GROUP BY group_cod,product_cod ASC LIMIT $start, $limit ";

 $query1 = "SELECT  count(*) FROM Garden_ab_ostan WHERE z_sal = '$z_sal' AND id_ostan = '$id_ostan1'";

$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ;
if ($t_row>0) { ;
?>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Sab_L1_kol.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
            <table class="agri-table">
              <tr class="text1">
                <td colspan="2" bgcolor="#006699">تولید / تن <br /></td>
                <td colspan="2" bgcolor="#006699"><p>سطح کل بارور  / هکتار<br /></p></td>
                <td colspan="2" bgcolor="#006699">سطح کل غیر بارور / هکتار</td>
                <td height="35" colspan="2" bgcolor="#006699">مشخصات </td>
                <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
              </tr>
              <tr class="text1">
                <td width="11%" bgcolor="#006699">دیم</td>
                <td width="9%" bgcolor="#006699">آبی</td>
                <td width="10%" bgcolor="#006699">دیم</td>
                <td width="9%" bgcolor="#006699">آبی</td>
                <td width="10%" bgcolor="#006699">دیم</td>
                <td width="9%" bgcolor="#006699">آبی</td>
                <td width="12%" height="36" bgcolor="#006699" class="text1">نام محصول </td>
                <td width="10%" bgcolor="#006699">گروه</td>
              </tr>
              
        <tr>
          <?php
//$r = $start+1 ; // شمارش ردیف از ابتدای صفحه
$r = 1 ;
foreach($stmt as $row){
 $t_r = $r ;
 $product_cod = $row['product_cod'] ;
  ?>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_dem']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_abi']*1; ?></td>
          
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_dem']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_abi']*1; ?></td>
          
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_nobar_dem']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_nobar_abi']*1; ?></td>
          
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <?php echo $row['product_name'] ?></td>
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
                    <form action="Sab_L1_Ostan.php?id=<?= $id - 1 ?>#1" method="post">
                        <?php generate_hidden_inputs_agri(); ?>
                        <button class="button" style="background: #4CAF50; color: white; padding: 8px 12px; border: none; border-radius: 4px;">&laquo; قبلی</button>
                    </form>
                </li>
            <?php endif; ?>

            <?php if ($start_page > 1): ?>
                <li>
                    <form action="Sab_L1_Ostan.php?id=1#1" method="post">
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
                        <form action="Sab_L1_Ostan.php?id=<?= $i ?>#1" method="post">
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
                    <form action="Sab_L1_Ostan.php?id=<?= $total ?>#1" method="post">
                        <?php generate_hidden_inputs_agri(); ?>
                        <button class="button" style="background: #eee; padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px;"><?= $total ?></button>
                    </form>
                </li>
            <?php endif; ?>

            <?php if ($id < $total): ?>
                <li>
                    <form action="Sab_L1_Ostan.php?id=<?= $id + 1 ?>#1" method="post">
                        <?php generate_hidden_inputs_agri(); ?>
                        <button class="button" style="background: #4CAF50; color: white; padding: 8px 12px; border: none; border-radius: 4px;">بعدی &raquo;</button>
                    </form>
                </li>
            <?php endif; ?>

        </ul>

        <div style="margin-top: 15px;">
            <form method="post" action="Sab_L1_Ostan.php" style="display: inline-flex; align-items: center; gap: 10px;">
                <?php generate_hidden_inputs_agri(); ?>
                <span>به صفحه:</span>
                <input type="number" name="page_input" value="<?= $id ?>" style="width: 60px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                <button type="submit" class="button" style="background: #4CAF50; color: white; padding: 6px 12px; border: none; border-radius: 4px;">برو</button>
            </form>
        </div>
    </div>

    <script>
    document.querySelector('.pagination-container form[action="Sab_L1_Ostan.php"]').addEventListener('submit', function (e) {
        const input = this.querySelector('input[name="page_input"]');
        const value = parseInt(input.value);
        if (isNaN(value) || value < 1 || value > <?= $total ?>) {
            e.preventDefault();
            alert('لطفاً عددی بین 1 تا <?= $total ?> وارد کنید.');
        } else {
            this.action = `Sab_L1_Ostan.php?id=${value}#1`;
        }
    });
    </script>

<?php
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
