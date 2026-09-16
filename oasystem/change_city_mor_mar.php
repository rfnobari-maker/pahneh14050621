<?php
include("../lock_ad.php");
include('../event.php') ;

function change_city_fa_digits($value)
{
    $map = array(
        '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
        '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
        '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
        '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
    );
    return strtr(trim((string) $value), $map);
}

function change_city_bounce($add_city, $id_mar, $mor_cod_m, $error)
{
?>
 <form name="myform1" class="myform" method="POST" action="">
 <input type="hidden" name="add_city" value="<?php echo htmlspecialchars($add_city, ENT_QUOTES, 'UTF-8'); ?>" />
 <input type="hidden" name="id_mar" value="<?php echo htmlspecialchars($id_mar, ENT_QUOTES, 'UTF-8'); ?>" />
 <input type="hidden" name="mor_cod_m" value="<?php echo htmlspecialchars($mor_cod_m, ENT_QUOTES, 'UTF-8'); ?>" />
 <input type="hidden" name="error" value="<?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>" />
  </form>
 <script type="text/javascript">document.myform1.submit();</script>
<?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
     <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=320,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 include ('../login/config.php');
 ?>
<p align="center" ><span class="style1">ویرایش مرکز و مروج شهر</span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 
  <?php if (isset($_POST['add_city'])) 
 {  
include('../login/config.php');
$add_city=$_POST['add_city'];
$error = isset($_POST['error']) ? $_POST['error'] : '';
$query = "SELECT * from list_city  where  add_city =  :add_city "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    echo '<p align="center" class="style8">شهر مورد نظر یافت نشد</p>';
} else {
$ostan= $row['ostan'] ; 
$city= $row['city'] ; 
$id_city= $row['id_city'] ;
$bakh= $row['bakh'] ; 
$shahr= $row['shahr'] ; 
$add_city= $row['add_city'] ; 
$mor_cod_m= $row['mor_cod_m'] ; 
$id_mar= $row['id_mar'] ; 
$mar= $row['mar'] ;
$form_id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : $id_mar;
$form_mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : $mor_cod_m; 
?>
  <table width="85%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="38" colspan="2" bgcolor="#999999"><span class="text1">مشخصات مروج فعلی </span></td>
      <td colspan="2" bgcolor="#999999"><span class="text1">مشخصات مرکز فعلی</span></td>
      <td width="18%" rowspan="2" bgcolor="#999999" class="text1">شهر</td>
      <td width="18%" rowspan="2" bgcolor="#999999" class="text1">بخش</td>
      <td width="14%" rowspan="2" bgcolor="#999999"><span class="text1">شهرستان</span></td>
    </tr>
    <tr>
      <td height="35" bgcolor="#999999"><span class="text1">کد ملی </span></td>
      <td width="22%" bgcolor="#999999"><span class="text1">نام و نام خانوادگی</span></td>
      <td width="9%" bgcolor="#999999"><span class="text1">کد مرکز</span></td>
      <td width="15%" bgcolor="#999999"><span class="text1">نام مرکز</span></td>
    </tr>
    <tr>
      <td width="22%" height="48"><?php echo $mor_cod_m?></td>
      <td><?php echo user_name1($mor_cod_m) ?></td>
      <td><?php echo $id_mar ?></td>
      <td><?php echo $mar ?></td>
      <td><?php echo $shahr ?><br />
        <?php echo $add_city ?></td>
      <td><?php echo $bakh ?></td>
      <td><?php echo $city ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
<form  action="mar_list.php" method="post" onsubmit="target_popup(this)">
    <button><img src="../files/con_info.png" border="0"  title="لیست مراکز جهاد کشاورزی " width="16" height="16" /></button>
    <span class="input_text">مشاهده لیست مراکز
    جهاد کشاورزی </span>
</form>
   <p><span class="style8"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></span>
     </p>
   <form id="form2" name="form2" method="post" action="">
     <table width="400" height="132" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
       <td width="238" height="52" ><input name="id_mar" type="text" class="input_text" id="id_mar" style="width:150px ; height:30px" value="<?php echo htmlspecialchars($form_id_mar, ENT_QUOTES, 'UTF-8'); ?>" /></td>
       <td width="262" style="text-align: right"> <span class="RedTitleSmall">*</span>:کد مرکز جهاد کشاورزی</td>
     </tr>
     <tr>
       <td height="49"><input name="mor_cod_m" type="text" class="input_text" id="mor_cod_m" dir="ltr" inputmode="numeric" style="width:150px ; height:30px" value="<?php echo htmlspecialchars($form_mor_cod_m, ENT_QUOTES, 'UTF-8'); ?>"/></td>
       <td style="text-align: right">:کد ملی مروج شهر </td>
     </tr>
     <tr>
       <td height="31" colspan="2" class="RedTitleSmall" style="text-align: right">درج کد مرکز جهاد کشاورزی الزامی است *</td>
       </tr>
 </table>
   <p>
     <input type="hidden" name="add_city"  value="<?php echo htmlspecialchars($add_city, ENT_QUOTES, 'UTF-8'); ?>" />
     <input type="hidden" name="id_city"  value="<?php echo htmlspecialchars($id_city, ENT_QUOTES, 'UTF-8'); ?>" />
     <input type="submit" name="action1" id="action1" value="ثبت " style="width:100px ; height:40px" />
     <input type="submit" name="action2" id="action2" value="بازگشت" style="width:100px ; height:40px" />
   </p>
 </form>
     <?php
 }
 }
?>
     
   <p align="center" style="color:#900 ; font-family:Tahoma; font-size:12px" >&nbsp;</p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
  <?php
 if (isset($_POST['action2']))
 {
 ?>
 <form name="myform1" class="myform" method="post" action="active_city.php">
  </form>
 <script type="text/javascript">document.myform1.submit();</script>
<?php
 }
 if (isset($_POST['action1']))
 {
    include('../login/config.php');
    $add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
    $mor_cod_m = change_city_fa_digits(isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '');
    $id_mar = change_city_fa_digits(isset($_POST['id_mar']) ? $_POST['id_mar'] : '');
    $id_city_back = isset($_POST['id_city']) ? $_POST['id_city'] : '';

    $stmtCity = $dbh->prepare('SELECT add_city, id_city FROM list_city WHERE add_city = :add_city');
    $stmtCity->execute(array(':add_city' => $add_city));
    $cityRow = $stmtCity->fetch(PDO::FETCH_ASSOC);
    if (!$cityRow) {
        change_city_bounce($add_city, $id_mar, $mor_cod_m, 'شهر مورد نظر یافت نشد ');
    } else {
        $add_city = $cityRow['add_city'];
        $id_city_back = $cityRow['id_city'];

        $stmtMar = $dbh->prepare('SELECT mar FROM mar WHERE id_mar = :id_mar');
        $stmtMar->execute(array(':id_mar' => $id_mar));
        $marRow = $stmtMar->fetch(PDO::FETCH_ASSOC);
        if ($id_mar === '' || !$marRow) {
            change_city_bounce($add_city, $id_mar, $mor_cod_m, 'کد مرکز جهاد کشاورزی معتبر نمی باشد ');
        } else {
            $mar = $marRow['mar'];
            $can_save = true;
            if ($mor_cod_m !== '') {
                $stmtUser = $dbh->prepare('SELECT cod_m FROM users WHERE cod_m = :cod_m OR username = :username LIMIT 1');
                $stmtUser->execute(array(':cod_m' => $mor_cod_m, ':username' => $mor_cod_m));
                $userRow = $stmtUser->fetch(PDO::FETCH_ASSOC);
                if (!$userRow) {
                    $can_save = false;
                    change_city_bounce($add_city, $id_mar, $mor_cod_m, 'کد ملی مروج در فهرست کاربران یافت نشد ');
                } else {
                    $mor_cod_m = $userRow['cod_m'];
                }
            }
            if ($can_save) {
                require_once('../Jalali.php');
                date_default_timezone_set('Asia/Tehran');
                $date_edit = jdate('Y/m/d');
                $time = date('H:i:s');
                $query = 'UPDATE list_city SET id_mar=?,mar=?,mor_cod_m=? WHERE add_city=?';
                $q = $dbh->prepare($query);
                $q->execute(array($id_mar, $mar, $mor_cod_m, $add_city));
                sabt_event($login_session, $_SERVER['REMOTE_ADDR'], $date_edit, $time, $add_city, 'ویرایش مرکز و مروج شهر', $id_ostan);
                edit_database_city($id_mar, $mor_cod_m, $add_city);
                alert(' شهر مورد نظر با موفقیت ویرایش شد.');
?>
<form name="myform1" class="myform" method="post" action="active_city.php">
<input type="hidden" name="id_city" value="<?php echo htmlspecialchars($id_city_back, ENT_QUOTES, 'UTF-8'); ?>" />
<input type="hidden" name="id_mar" value="<?php echo htmlspecialchars($id_mar, ENT_QUOTES, 'UTF-8'); ?>" />
<input type="hidden" name="action" value="جستجو" />
</form>
<script type="text/javascript">document.myform1.submit();</script>
<?php
            }
        }
    }
}
?>