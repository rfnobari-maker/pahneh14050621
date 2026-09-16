<?php
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=user_list.xls");
include("../lock_ce.php");
include("../event.php");
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_em = jdate("Y");
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
 $expert_unit = $_POST['expert_unit'] ;
if ($id_ostan == '-1') { $v_id_ostan = 1;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($s_access == 0) { $v_s_access = 1 ;} else { $v_s_access = "s_access='$s_access'" ;}
if ($expert_unit == 0) { $v_expert_unit = 1 ;} else { $v_expert_unit = "expert_unit='$expert_unit'" ;}
$query = "SELECT * FROM  users where  $v_id_ostan and  $v_id_city and $v_id_mar and $v_s_access and $v_expert_unit and (S_access != 50 or S_access != 51 ) order by id_ostan,id_city,id_mar ";
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<table width="93%" height="75" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="4%" bgcolor="#CCCCCC">تاریخ بروز رسانی </td>
    <td width="4%" bgcolor="#CCCCCC">آخرین وضعیت حضور همکار </td>
    <td width="4%" bgcolor="#CCCCCC">آدرس محل سکونت</td>
    <td width="3%" bgcolor="#CCCCCC">تاریخ آخرین بازدید از سامانه</td>
      <td width="4%" height="37" bgcolor="#CCCCCC">نام کاربری</td>
      <td width="3%" bgcolor="#CCCCCC">تاریخ اخذ مدرک</td>
      <td width="3%" bgcolor="#CCCCCC">معدل</td>
      <td width="4%" bgcolor="#CCCCCC">نام دانشگاه</td>
      <td width="4%" bgcolor="#CCCCCC">رشته تحصیلی</td>
      <td width="4%" bgcolor="#CCCCCC">مدرک تحصیلی</td>
      <td width="2%" bgcolor="#CCCCCC">تلفن ثبت</td>
      <td width="3%" bgcolor="#CCCCCC">تلفن همراه</td>
      <td width="5%" bgcolor="#CCCCCC">وضعیت تاهل</td>
      <td width="2%" bgcolor="#CCCCCC">شماره شبا</td>
      <td width="2%" bgcolor="#CCCCCC">سن</td>
      <td width="3%" bgcolor="#CCCCCC">تاریخ تولد </td>
      <td width="4%" bgcolor="#CCCCCC">محل صدور </td>
      <td width="2%" bgcolor="#CCCCCC">نام پدر</td>
      <td width="4%" bgcolor="#CCCCCC">شماره شناسنامه</td>
      <td width="2%" bgcolor="#CCCCCC">کد ملی</td>
      <td width="3%" bgcolor="#CCCCCC">کد پرسنلی</td>
      <td width="5%" bgcolor="#CCCCCC">نام خانوادگی</td>
      <td width="2%" bgcolor="#CCCCCC">نام</td>
      <td width="3%" bgcolor="#CCCCCC">جنسیت</td>
      <td width="5%" bgcolor="#CCCCCC">واحد تخصصی</td>
      <td width="5%" bgcolor="#CCCCCC">سطح دسترسی </td>
      <td width="5%" bgcolor="#CCCCCC">مرکز جهاد کشاورزی</td>
      <td width="4%" bgcolor="#CCCCCC">شهرستان</td>
      <td width="8%" bgcolor="#CCCCCC">استان</td>
      <td width="4%" bgcolor="#CCCCCC">ردیف</td>
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
 if ($row['S_access']=='50')  $vs_access = 'نیروی پشتیبانی' ; 
 if ($row['S_access']=='51')  $vs_access = 'سرباز سازندگی' ; 

if ($row['expert_unit']=='11')  $f_expert_unit = 'سازمان جهاد کشاورزی' ; 
if ($row['expert_unit']=='1')  $f_expert_unit = 'طرح و برنامه/ترویج' ; 
if ($row['expert_unit']=='2')  $f_expert_unit = 'باغبانی' ; 
if ($row['expert_unit']=='3')  $f_expert_unit = 'حفظ نباتات' ; 
if ($row['expert_unit']=='4')  $f_expert_unit = 'زراعت' ; 
if ($row['expert_unit']=='5')  $f_expert_unit = 'شیلات و آبزیان' ; 
if ($row['expert_unit']=='6')  $f_expert_unit = 'دام' ; 
if ($row['expert_unit']=='7')  $f_expert_unit = 'طیور و زنبورعسل' ; 
if ($row['expert_unit']=='8')  $f_expert_unit = 'اراضی' ; 
if ($row['expert_unit']=='9')  $f_expert_unit = 'صنایع تبدیلی و تکمیلی' ; 
if ($row['expert_unit']=='10') $f_expert_unit = 'آب و خاک' ; 

 if ($row['v_tahol'] =='1') $vs_tahol = 'متاهل' ; 
 if ($row['v_tahol'] =='2') $vs_tahol = 'مجرد' ; 
 if ($row['v_tahol'] =='') $vs_tahol = 'ذکر نشده' ; 
 

 if ($row['m_tah'] =='1') $vm_tah = 'لیسانس' ; 
 if ($row['m_tah'] =='2') $vm_tah = 'فوق لیسانس' ; 
 if ($row['m_tah'] =='3') $vm_tah = 'دکتری' ; 
 if ($row['m_tah'] =='4') $vm_tah = 'دیپلم' ; 
 if ($row['m_tah'] =='5') $vm_tah = 'فوق دیپلم' ; 
 if ($row['m_tah'] =='5') $vm_tah = 'ذکر نشده' ; 

                      if ($row['status']=='1') $v_status = "تمام اوقات کاری"  ;
                      if ($row['status']=='2') $v_status = "پنج روز در هفته" ;
                      if ($row['status']=='3') $v_status = "چهار روز در هفته" ;
                      if ($row['status']=='4') $v_status = "سه روز در هفته" ;
                      if ($row['status']=='5') $v_status = "دو روز در هفته" ;
                      if ($row['status']=='6') $v_status = "یک روز در هفته" ;
                     if ($row['status']=='7') $v_status = "عدم حضور-انتقال" ;
                     if ($row['status']=='8') $v_status = "عدم حضور-مامور" ;
                     if ($row['status']=='9') $v_status = "عدم حضور-بازنشسته" ;
                     if ($row['status']=='10') $v_status = "عدم حضور-بیماری" ;
                     if ($row['status']=='11') $v_status = "عدم حضور-فوت" ;
                     if ($row['status']=='12') $v_status = "عدم حضور-مرخصی" ;
 $age = $date_em - substr($row['date_t'],0,4) ; 

?>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['date_status'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $v_status;?></td>
      <td height="36" bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['addres'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo last_log($row['username'])?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['username'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['m_date'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['avre'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['univer'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['r_tah'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $vm_tah ;?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['tel_s'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $vs_tahol ;?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo '"'.$row['shaba'].'"';?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><span class="normalTextSmall"><?php echo $age ; ?></span></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['date_t'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['m_sodor'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['fname'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['sh_sh'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['cod_m'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['cod_p'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['name'];?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $row['jens'] ; ?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $f_expert_unit?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo $vs_access?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><?php echo mar_name($row['id_mar']); ?></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></span></td>
      <td bgcolor="#FFFFFF"  class="normalTextSmaller"><span class="normalTextSmall"><?php echo ostan_name($row['id_ostan']); ?></span></td>
      <td bgcolor="#FFFFFF"><?php echo $r ?></td>
    </tr>
    <?php
$r = $r+1  ;
}
?>
</table> 
</body>
</html>