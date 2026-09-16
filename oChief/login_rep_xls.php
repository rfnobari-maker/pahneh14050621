<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=user_login.xls");
include('../lock_oce.php');
include('counter2.php');
$id_ostan1 = $_POST['id_ostan'] ;
$id_city1 = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
$date_s1 = $_POST['date_s1'] ; 
$date_s2 = $_POST['date_s2'] ; 
$s_access = $_POST['s_access']; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<script src="../15_files/jquery-1.9.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../15_files/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $.mask.definitions['~'] = "[+-]";
        $("#date").mask("9999/99/99",{placeholder:"____/__/__"});
    	 $("#date2").mask("9999/99/99",{placeholder:"____/__/__"});
    });
</script>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    </style>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

-->
</style>
    <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
    <?php 
include ('../login/config.php');
?>
<p align="center" class="style1">گزارش ورود کاربران به سامانه </p>
<?php 
$id_ostan = $_POST['id_ostan'] ; 
 $id_city = $_POST['id_city'] ; 
 $id_mar = $_POST['id_mar'] ; 
$date_s1 = $_POST['date_s1'];
$date_s2 = $_POST['date_s2'];
if ($date_s1 == '') { $v_date_s1 = 1 ;} else { $v_date_s1 = "Last_user.date>'$date_s1'" ;}
if ($date_s2 == '') { $v_date_s2 = 1 ;} else { $v_date_s2 = "Last_user.date<'$date_s2'" ;}
if ($id_ostan == -1) { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($s_access == 0) { $v_s_access = 's_access=s_access' ;} else { $v_s_access = "s_access='$s_access'" ;}

 $query = "SELECT users.id_city,users.id_mar,users.tel_m,users.pic,users.city,users.username,users.markaz, Last_user.PersCode , Last_user.PersName,Last_user.date ,Last_user.time,Last_user.ip
FROM Last_user
INNER JOIN users ON users.username = Last_user.PersCode
where users.$v_id_ostan and $v_date_s1 and $v_date_s2 and users.$v_id_city and users.$v_id_mar and users.$v_s_access
order by users.username,Last_user.date ,Last_user.time "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  </p>
  <table width="95%" height="63" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC" >
    <tr align="center" class="text1">
      <td align="center" width="12%" height="27" bordercolor="#66CCFF" bgcolor="#999999">ip</td>
      <td align="center" width="12%" bordercolor="#66CCFF" bgcolor="#999999">ساعت</td>
      <td align="center" width="11%" bordercolor="#66CCFF" bgcolor="#999999">تاریخ</td>
      <td align="center" width="12%" bordercolor="#66CCFF" bgcolor="#999999">نام مرکز</td>
      <td align="center" width="15%" bgcolor="#999999">شهرستان</td>
      <td align="center" width="14%" bgcolor="#999999">کد ملی</td>
      <td align="center" width="20%" bgcolor="#999999">مشخصات مروج </td>
      <td align="center" width="4%" bgcolor="#999999">ردیف</td>
    </tr>
    <tr>
      <?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['username'] ;
$pic_mo = $row['pic'];
if ($pic_mo=='') $pic_mo = 'no_pic.png' ; ?>
      <td align="center" height="30" bordercolor="#66CCFF"><?php echo $row['ip']?></td>
      <td align="center" bordercolor="#66CCFF"><?php echo $row['time']?></td>
      <td align="center" bordercolor="#66CCFF"><?php echo $row['date']?></td>
      <td align="center" bordercolor="#66CCFF"><?php echo $row['markaz']?></td>
      <td align="center" bordercolor="#66CCFF"><?php echo $row['city']?></td>
      <td align="center"  class="normalTextSmaller"><?php echo $cod_m ?></td>
      <td align="center" class="normalTextSmaller"  ><?php echo $row['PersName']?></td>
      <td align="center" ><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
?>
  </table>
  <p align="center">---------------پایان گزارش ----------------------</p>
</body>
</html>



