<?php include('../lock_p1.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><p><!--تاریخ فارسی-->
           <style type="text/css">
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
      </style>
    </p>
 <?php include ('top.php') ;?>
      <div id="content">
  <p  align="center" class="style8">مشاهده عملکرد بروز مروج در سامانه 
    <?php

if(isset($user_check))
{
include('../login/config.php');

// تعداد رکوردهای کل
$query_total = "SELECT COUNT(*) FROM log WHERE username = '$user_check'";
$stmt_total = $dbh->prepare($query_total);
$stmt_total->execute();
$total_records = $stmt_total->fetchColumn();

// تعداد رکورد در هر صفحه
$records_per_page = 25;

// تعداد صفحات
$total_pages = ceil($total_records / $records_per_page);

// صفحه جاری (از GET می‌آید)
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// محاسبه محدودیت شروع
$offset = ($page - 1) * $records_per_page;

// کوئری با LIMIT و OFFSET برای صفحه‌بندی
$query = "SELECT * FROM log WHERE username = '$user_check' ORDER BY date DESC, time DESC LIMIT :offset, :records_per_page";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':records_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// اطلاعات کاربر
$query2 = "SELECT * FROM users WHERE username = '$user_check'";
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
?>

  </p>
  <table  style=" margin-right:35px" width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
    <tr>
      <td width="111" rowspan="2"><p class="style8"><img src="../files/users/<?php echo $row2['pic'];?>" width="61" height="75"  alt=""/></p></td>
      <td height="45" colspan="4"><span class="style8"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></span></td>
      </tr>
    <tr>
      <td width="216" height="44" align="right" ><?php echo $row2['cod_m'] ;  ?></td>
      <td width="184" align="right" ><span class="style8">:کد ملی</span></td>
      <td width="204"><?php  echo '<dir style=margin-right:45px>'.$row2['name'].' '.$row2['Last_name'].'</div>'; ?></td>
      <td width="139"><span class="style8">:نام و نام خانوادگی </span></td>
    </tr>
</table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
  <table width="90%" align="center" class="my-table"  >
          <tr align="center" class="style8">
    <td width="17%"  height="49" bgcolor="#CCCCCC">آی پی سیستم</td>
    <td width="13%"  bgcolor="#CCCCCC">ساعت</td>
    <td width="14%"  bgcolor="#CCCCCC">تاریخ</td>
    <td width="21%"  bgcolor="#CCCCCC">نام آبادی</td>
    <td width="27%"  bgcolor="#CCCCCC">عملیات</td>
    <td width="8%"  bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = $offset + 1;
foreach($stmt as $row){
    $add_abadi =  $row['add_abadi']; 
    $query3 = "SELECT abadi FROM list_abadi WHERE add_abadi = '$add_abadi'";
    $stmt3 = $dbh->prepare($query3);
    $stmt3->execute();
    $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
?>
    <td height="56" class="normalTextSmall"><?php echo $row['ip'];?></td>
    <td class="normalTextSmall"><?php echo $row['time'];?></td>
    <td class="normalTextSmall"><?php echo $row['date'];?></td>
    <td class="normalTextSmall"><?php echo $row3['abadi'];?></td>
    <td class="normalTextSmall"><?php echo $row['verb'];?></td>
    <td><?php echo $r;?></td>
  </tr>
<?php
    $r++;
}
?>
</table>

<!-- صفحه‌بندی -->
<div  style=" text-align:right;height:60px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">

    <ul class="page">
        <?php
        // شماره صفحه‌های قبلی و بعدی را اضافه می‌کنیم
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<li>';
            if ($page == $i) {
                echo '<a href="#" class="current">'.$i.'</a>';
            } else {
                echo '<a href="?page='.$i.'">'.$i.'</a>';
            }
            echo '</li>';
        }
        ?>
    </ul>
</div>
<?php 
}
else 
{
    echo '<br>' ; 
    echo '<p align=center style=color:red> مجوز دسترسی به این صفحه را ندارید </p> ';
}
?>
</div>
          </p>
      <p>
        <!--end form --> 
         <form name='back' action="../indexbenef.php" method="post">
           <input type="submit" name="action" value="بازگشت" style="width:150px ; height:45px" tabindex="39" />
          </form>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html> 
