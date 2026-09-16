<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست_samasat.xls");
//include('lock_ce.php');
include('../../event.php') ;
 if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'] ;
 if(isset($_POST['id_city'])) $id_city   = $_POST['id_city'] ;
 if(isset($_POST['cod_ep']))   $cod_ep    = $_POST['cod_ep'] ;
 if(isset($_POST['sh_yek']))   $sh_yek    = $_POST['sh_yek'] ;
 if(isset($_POST['no_joj1']))  $no_joj1   = $_POST['no_joj1'] ;
 if(isset($_POST['no_joj2']))  $no_joj2   = $_POST['no_joj2'] ;
 if(isset($_POST['m_joj1']))   $m_joj1    = $_POST['m_joj1'] ;
 if(isset($_POST['m_joj2']))   $m_joj2    = $_POST['m_joj2'] ;
 if(isset($_POST['age_day1'])) $age_day1  = $_POST['age_day1'] ;
 if(isset($_POST['age_day2'])) $age_day2  = $_POST['age_day2'] ;

 if ($id_ostan1 == '-1')  { $v_id_ostan   = 1 ;}else{ $v_id_ostan  = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)       { $v_id_city    = 1 ;}else{ $v_id_city   = "id_city='$id_city'" ;}
 if ($cod_ep == '')       { $v_cod_ep     = 1 ;}else{ $v_cod_ep = "cod_ep = '$cod_ep'" ;}
 if ($sh_yek == '')       { $v_sh_yek     = 1 ;}else{ $v_sh_yek = "sh_yek = '$sh_yek'" ;}
 if ($no_joj1 == '')      {$v_no_joj1      = 1;}else{ $v_no_joj1 = "no_joj >= '$no_joj1'" ;}
 if ($no_joj2 == '')      {$v_no_joj2      = 1;}else{ $v_no_joj2 = "no_joj <= '$no_joj2'" ;}
 if ($m_joj1 == '')       {$v_m_joj1      = 1;}else{ $v_m_joj1 = "m_joj >= '$m_joj1'" ;}
 if ($m_joj2 == '')       {$v_m_joj2      = 1;}else{ $v_m_joj2 = "m_joj <= '$m_joj2'" ;}
 if ($age_day1 == '')     {$v_age_day1  = 1;}else{ $v_age_day1 = "age_day >= '$age_day1'" ;}
 if ($age_day2 == '')     {$v_age_day2  = 1;}else{ $v_age_day2 = "age_day <= '$age_day2'" ;}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
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
</head>
<body>
      <p>
             <?php 
include('../../login/config.php');
$query = "SELECT * FROM  samasat2 where  $v_id_ostan  and $v_cod_ep and $v_sh_yek  and  $v_id_city and $v_no_joj1 and $v_no_joj2 and $v_m_joj1  and $v_m_joj2 and $v_age_day1 and $v_age_day2  ORDER BY age_day ASC";
$stmt= $dbh->prepare($query);
$stmt->execute(array());
?>
<p align="center" dir="rtl">لیست جوجه ریزی </p>
      <table width="98%" height="86" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#33CCFF" >
        <tr align="center" class="text_r">
               <td width="10%" bgcolor="#999999">تعاونی</td>
               <td width="10%" bgcolor="#999999">نوع ارتباط</td>
               <td width="10%" bgcolor="#999999">تعداد پارتی</td>
               <td width="10%" bgcolor="#999999">سن هفته</td>
               <td width="10%" bgcolor="#999999">سن روز</td>
               <td width="10%" bgcolor="#999999">تعداد موجود</td>
               <td width="10%" bgcolor="#999999">تعداد جوجه ریزی</td>
               <td width="8%" bgcolor="#999999">ظرفیت کل</td>
               <td width="10%" bgcolor="#999999">تاریخ آخرین پارتی</td>
               <td width="10%" bgcolor="#999999">تاریخ جوجه ریزی</td>
    <td width="9%" height="42" bgcolor="#999999">تعداد درخواست</td>
    <td width="11%" bgcolor="#999999"> گواهی دامپزشکی</td>
    <td width="8%" bgcolor="#999999">شماره مجوز</td>
    <td width="11%" bgcolor="#999999"> نام مالک</td>
    <td width="12%" bgcolor="#999999">نام واحد </td>
    <td width="12%" bgcolor="#999999">شناسه یکتا </td>
    <td width="12%" bgcolor="#999999"> کد اپیدیمیولوژیک</td>
    <td width="12%" bgcolor="#999999">کد پستی </td>
    <td width="12%" bgcolor="#999999"> کد سیستمی واحد</td>
    <td width="12%" bgcolor="#999999">کد شهرستان</td>
    <td width="12%" bgcolor="#999999">شهرستان </td>
    <td width="10%" bgcolor="#999999">استان</td>
    <td width="5%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {

//echo $row2['User_Name'] ; 
?>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['tavoni'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['no_ert'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['no_part'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['age_w'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['age_day'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['m_joj'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['no_joj'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['z_kol']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['date_part'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['date_joj'];?></span></td>
    <td height="27"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['no_dar'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo '&nbsp;'.$row['sh_gova'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_moj'];?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['name_m'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['name_unit'] ;  ?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo '&nbsp;'.$row['sh_yek'] ;  ?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo '&nbsp;'.$row['cod_ep'] ;  ?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['cod_p'] ;  ?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['cod_sys'] ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo $row['id_city'] ; ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo $row['city'] ; ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo $row['ostan']; ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
  <p align="center"> ------------- پایان گزارش -----------------</p>
