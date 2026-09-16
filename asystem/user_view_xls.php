<?php
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=user_list.xls");
include("../lock_admin.php");
include("../event.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
#int
{ margin-right:10px 
}
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title></title>
</head>
<body>
 <?php  include ('../login/config.php');
  $id_city = $_POST['id_city']; 
  $id_mar = $_POST['id_mar']; 
 $id_ostan = $_POST['id_ostan']; 
 $s_access = $_POST['s_access']; 
if ($id_ostan == '-1') { $v_id_ostan = 1;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($s_access == 0) { $v_s_access = 1 ;} else { $v_s_access = "s_access='$s_access'" ;}
 $query = "SELECT * FROM  users where  $v_id_ostan and  $v_id_city and $v_id_mar and $v_s_access order by id_ostan,id_city,id_mar ";
$stmt = $dbh->prepare($query);
$stmt->execute();
?>

<table width="93%" height="75" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="9%" bgcolor="#CCCCCC">آدرس محل سکونت</td>
      <td width="9%" height="37" bgcolor="#CCCCCC">نام کاربری</td>
      <td width="10%" bgcolor="#CCCCCC">تاریخ اخذ مدرک</td>
      <td width="10%" bgcolor="#CCCCCC">معدل</td>
      <td width="10%" bgcolor="#CCCCCC">نام دانشگاه</td>
      <td width="10%" bgcolor="#CCCCCC">رشته تحصیلی</td>
      <td width="10%" bgcolor="#CCCCCC">مدرک تحصیلی</td>
      <td width="10%" bgcolor="#CCCCCC">تلفن ثبت</td>
      <td width="10%" bgcolor="#CCCCCC">تلفن همراه</td>
      <td width="10%" bgcolor="#CCCCCC">وضعیت تاهل</td>
      <td width="10%" bgcolor="#CCCCCC">تاریخ تولد </td>
      <td width="10%" bgcolor="#CCCCCC">محل صدور </td>
      <td width="10%" bgcolor="#CCCCCC">نام پدر</td>
      <td width="10%" bgcolor="#CCCCCC">شماره شناسنامه</td>
      <td width="10%" bgcolor="#CCCCCC">کد ملی</td>
      <td width="10%" bgcolor="#CCCCCC">کد پرسنلی</td>
      <td width="10%" bgcolor="#CCCCCC">نام خانوادگی</td>
      <td width="11%" bgcolor="#CCCCCC">نام</td>
      <td width="6%" bgcolor="#CCCCCC">جنسیت</td>
      <td width="9%" bgcolor="#CCCCCC">سطح دسترسی </td>
      <td width="11%" bgcolor="#CCCCCC">مرکز جهاد کشاورزی</td>
      <td width="10%" bgcolor="#CCCCCC">شهرستان</td>
      <td width="9%" bgcolor="#CCCCCC">استان</td>
      <td width="5%" bgcolor="#CCCCCC">ردیف</td>
  </tr>
    <tr>
      <?php
	  $r = 1 ; 
 foreach($stmt as $row){

 if ($row['S_access'] =='1')  $vs_access = 'مروج کشاورزی' ; 
 if ($row['S_access'] =='2')  $vs_access = 'رئیس مرکز جهاد کشاورزی' ; 
 if ($row['S_access'] =='6')  $vs_access = 'کارشناس موضوعی شهرستان' ; 
 if ($row['S_access'] =='3')  $vs_access = 'مدیریت شهرستان' ; 
 if ($row['S_access'] =='4')  $vs_access = 'مدیریت استانی سامانه' ; 
 if ($row['S_access'] =='5')  $vs_access = 'کارشناس معین استان' ; 
 if ($row['S_access'] =='7')  $vs_access = 'محقق معین شهرستان' ; 
 if ($row['S_access'] =='98') $vs_access = 'ادمین استان' ; 
 if ($row['S_access'] =='20') $vs_access = 'مدیریت کشوری سامانه' ; 

 if ($row['v_tahol'] =='1') $vs_tahol = 'متاهل' ; 
 if ($row['v_tahol'] =='2') $vs_tahol = 'مجرد' ; 
 if ($row['v_tahol'] =='') $vs_tahol = 'ذکر نشده' ; 
 

 if ($row['m_tah'] =='1') $vm_tah = 'لیسانس' ; 
 if ($row['m_tah'] =='2') $vm_tah = 'فوق لیسانس' ; 
 if ($row['m_tah'] =='3') $vm_tah = 'دکتری' ; 
 if ($row['m_tah'] =='4') $vm_tah = 'دیپلم' ; 
 if ($row['m_tah'] =='5') $vm_tah = 'فوق دیپلم' ; 
 if ($row['m_tah'] =='5') $vm_tah = 'ذکر نشده' ; 
 

?>
      <td height="36" bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['addres'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['username'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['m_date'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['avre'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['univer'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['r_tah'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $vm_tah ;?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['tel_s'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $vs_tahol ;?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['date_t'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['m_sodor'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['fname'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['sh_sh'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['cod_m'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['cod_p'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['name'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['jens'] ; ?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $vs_access?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo mar_name($row['id_mar']); ?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></span></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><span class="normalTextSmall"><?php echo ostan_name($row['id_ostan']); ?></span></td>
      <?php 
if ($pic == '') $pic = 'no_pic.png'  ?>
      <td bgcolor="#FFFFFF"><?php echo $r ?></td>
    </tr>
    <?php
$r = $r+1  ;
}
?>
</table> 
</body>
</html>