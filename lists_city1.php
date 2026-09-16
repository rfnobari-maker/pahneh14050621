<?php include('lock_p1.php');
      include('event.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<!-- لودینگ -->
<div  dir="rtl" id="loading" style="display:none;">
    <div class="spinner"></div>
    در حال بروزرسانی اطلاعات شهر ها ، لطفا صبر کنید ...
</div>

<!-- استایل لودینگ -->
<style>
 #btn1 {
            background-color: #4CAF50; /* رنگ پس‌زمینه سبز */
            color: white; /* رنگ متن سفید */
            border: none; /* حذف حاشیه */
            padding: 10px 20px; /* فاصله داخلی */
            text-align: center; /* متن در مرکز دکمه */
            text-decoration: none; /* حذف خط زیر متن */
            display: inline-block; /* نمایش به صورت خطی */
            font-size: 16px; /* اندازه فونت */
            margin: 4px 2px; /* فاصله از اطراف */
            cursor: pointer; /* نمایش نشانگر به شکل دست */
            border-radius: 5px; /* گوشه‌های گرد */
            transition: background-color 0.3s ease; /* انیمیشن تغییر رنگ */
        }

        #btn1:hover {
            background-color: #45a049; /* رنگ پس‌زمینه هنگام هاور */
        }

        #btn1:active {
            background-color: #3e8e41; /* رنگ پس‌زمینه هنگام کلیک */
        }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
#loading {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    font-size: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top: 4px solid white;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<?php
if (isset($_POST['action'])) 
{ 
$mor_cod_m = $_POST['mor_cod_m'];
//alert($mor_cod_m) ; 
include ('login/config.php');
 $query = " SELECT add_city,mor_cod_m,id_mar,id_city,id_ostan  FROM list_city where mor_cod_m = '$mor_cod_m' and mor_cod_m <> ''  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

foreach($stmt as $row){
$add_city = $row['add_city'] ;
$mor_cod_m = $row['mor_cod_m'] ;
$id_mar = $row['id_mar'] ;
$id_city = $row['id_city'] ;
$id_ostan   = $row['id_ostan'] ;

$query = "UPDATE bah SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city,$add_city));

$query = "UPDATE Agri1397_1398 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri1398_1399 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri1399_1400 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri1400_1401 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri1401_1402 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri1402_1403 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri1403_1404 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));


$query = "UPDATE Agri_prod1397_1398 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri_prod1398_1399 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri_prod1399_1400 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri_prod1400_1401 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri_prod1401_1402 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri_prod1402_1403 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$query = "UPDATE Agri_prod1403_1404 SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));


$query = "UPDATE Garden SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Garden_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Greenhous SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Greenhous_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Greenprod_annual SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Aquatic SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE bee SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE unknown_bee SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Vege SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Vege_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Aquatic SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Mushroom SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));

$query = "UPDATE Mushroom_prod SET mor_cod_m = ? , id_mar = ? , id_ostan=? , id_city=?    WHERE add_city=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_mar,$id_ostan,$id_city ,$add_city));
$dbh = null ; 
}
   alert('اطلاعات با موفقبت بروز رسانی شد ');
   echo "<script>hideLoading();</script>"; // مخفی کردن لودینگ پس از تکمیل عملیات
}
?>

</head>
<body>
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="files/images/header.jpg" width="100%" height="149" /></td>
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
  <?php include('top.php'); ?>
    <td width="840" ><?php
$query = "SELECT add_city,shahr,bakh,city,ostan FROM  list_city WHERE  mor_cod_m = '$user_check' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>

           <p class="style1">لیست شهر های تحت پوشش </p>
           <p><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<?php $num_city = $stmt -> rowCount(); if($num_city > 0) {?>
           <p align="right" style="margin-right:35px"><form name="test" method="post">
              <input type="submit"  value="بروزرسانی اطلاعات شهر ها" name="action" id="btn1">
             </form>
<script>
// نمایش لودینگ هنگام ارسال فرم
document.querySelector('form[name="test"]').onsubmit = function() {
    document.getElementById('loading').style.display = 'flex';  // نمایش لودینگ
};

// اگر عملیات PHP تمام شد، لودینگ را پنهان کنیم
function hideLoading() {
    document.getElementById('loading').style.display = 'none';  // مخفی کردن لودینگ
}
</script>
          </p>
<?php } ?>
           <table width="85%" height="97" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="19%" height="49" bgcolor="#CCCCCC">آدرس آماری شهر</td>
    <td width="14%" bgcolor="#CCCCCC">نام شهر</td>
    <td width="16%" bgcolor="#CCCCCC">بخش</td>
    <td width="15%" bgcolor="#CCCCCC">شهرستان</td>
    <td width="14%" bgcolor="#CCCCCC">استان</td>
    <td width="7%" bgcolor="#CCCCCC">ردیف</td>
  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
<td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller" height="48" ><?php echo $row['add_city'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['shahr'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bakh'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="indexbenef.php" title="برگشت به صفحه قبل"><img src="files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="files/bottom.gif"><?php include('footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>