<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=آبزیان.xls");
?>
<?php 
include('../../lock_P3.php');
include('../../event.php') ;
$id_ostan1 = $_POST['id_ostan'] ; 
$id_city = $_POST['id_city'] ; 
$id_mar = $_POST['id_mar'] ; 
$no_fa = $_POST['no_fa'] ; 
$g_tol = $_POST['g_tol'] ; 
$m_ab = $_POST['m_ab'] ; 
$no_mal = $_POST['no_mal'] ; 
$mor_cod_m = $_POST['mor_cod_m'] ; 
$bah_cod_m = $_POST['bah_cod_m'] ; 
$sal = $_POST['sal'] ; 
if ($id_ostan1 == '-1')    { $v_id_ostan = '1' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
if ($id_city == 0)    { $v_id_city = '1' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar  == 0)    { $v_id_mar = '1' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($no_mal  == '0')  { $f_no_mal  = '1'  ; }else{ $f_no_mal = "no_mal = '$no_mal'" ;}
if ($no_fa == '0')  { $f_no_fa  = '1'  ; }else{ $f_no_fa = "no_fa = '$no_fa'" ;}
if ($g_tol == '0')  { $f_g_tol  = '1'  ; }else{ $f_g_tol = "g_tol = '$g_tol'" ;}
if ($m_ab == '0')   { $f_m_ab  = '1'  ; }else{ $f_m_ab = "m_ab = '$m_ab'" ;}
if ($mor_cod_m == '')  { $v_mor_cod_m  = '1'  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
if ($bah_cod_m == '')  { $v_bah_cod_m  = '1'  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
if ($sal == '')  { $v_sal  = '1'  ; }else{ $v_sal = "sal = '$sal'" ;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی</title>
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td><p>
      <?php 
include ('../../login/config.php');
$query = "SELECT * from Aquatic where $v_id_ostan  and $v_id_city and  $v_id_mar  and $f_no_fa and $f_g_tol and $f_m_ab and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m and $v_sal ORDER BY mor_cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
           <table width="98%" height="153" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text_r">
               <td width="3%" bordercolor="#0099CC" bgcolor="#999999">کد ملی کارشناس مروج</td>
               <td width="3%" bordercolor="#0099CC" bgcolor="#999999">کارشناس مروج</td>
               <td width="3%" height="43" bordercolor="#0099CC" bgcolor="#999999">پرورش میگوی آب شور و شیرین و شاه میگو/<span class="style2">تن</span></td>
               <td width="2%" bordercolor="#0099CC" bgcolor="#999999"><p>پرورش قزل آلا/<span class="style2">تن</span><br />
               </p></td>
               <td width="3%" bordercolor="#0099CC" bgcolor="#999999">پرورش  کپور ماهیان/<span class="style2">تن</span><br /></td>
               <td width="4%" bordercolor="#0099CC" bgcolor="#999999">پرورش  ماهیان خاویاری/<span class="style2">تن</span></td>
               <td width="3%" height="43" bordercolor="#0099CC" bgcolor="#999999">تکثیر ماهیان زینتی/<span class="style2">هزار قطعه</span><br /></td>
               <td width="3%" bordercolor="#0099CC" bgcolor="#999999">تکثیر میگوی آب شور و شیرین و شاه میگو/<span class="style2">هزار قطعه</span><br /></td>
               <td width="2%" bordercolor="#0099CC" bgcolor="#999999">تکثیر قزل آلا /<span class="style2">هزار قطعه</span><br /></td>
               <td width="3%" bordercolor="#0099CC" bgcolor="#999999">تکثیر کپور ماهیان/<span class="style2">هزار قطعه</span><br /></td>
               <td width="4%" bordercolor="#0099CC" bgcolor="#999999">تکثیر ماهیان خاویاری/<span class="style2">هزار قطعه</span><br /></td>
               <td width="6%" bgcolor="#999999">مساحت زمین (مترمربع )</td>
    <td width="6%" height="43" bgcolor="#999999">منبع تامین آب</td>
    <td width="6%" bgcolor="#999999">قالب تولیدی</td>
    <td width="6%" bgcolor="#999999">نوع فعالیت</td>
    <td width="6%" bgcolor="#999999">سال</td>
    <td width="7%" bgcolor="#999999"> کد ملی<br /></td>
    <td width="9%" bgcolor="#999999">نام و نام خانوادگی</td>
    <td width="8%" bgcolor="#999999">شهر / آبادی </td>
    <td width="7%" bgcolor="#999999">شهرستان </td>
    <td width="7%" bgcolor="#999999">استان</td>
    <td width="3%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
if ($row['no_fa']=='1') $v_no_fa='تکثیر' ;	 
if ($row['no_fa']=='2') $v_no_fa='پرورش' ;	 
if ($row['no_fa']=='3') $v_no_fa='تکثیر و پرورش' ;	 
	 
if ($row['g_tol']=='1') $v_g_tol='مجتمع' ;	 
if ($row['g_tol']=='2') $v_g_tol='منفرد' ;	
if ($row['g_tol']=='3') $v_g_tol='مداربسته' ;	
if ($row['g_tol']=='4') $v_g_tol='دو منظوره' ;	 
if ($row['g_tol']=='5') $v_g_tol='شالیزار' ;	
if ($row['g_tol']=='6') $v_g_tol='قفش' ;	
if ($row['g_tol']=='7') $v_g_tol='پن' ;	 
if ($row['g_tol']=='8') $v_g_tol='آب بندان' ;	 
if ($row['g_tol']=='9') $v_g_tol='منابع آبی' ;	 
if ($row['g_tol']=='10') $v_g_tol='سایر موارد' ;	 

if ($row['m_ab']=='1') $v_m_ab='رودخانه' ;	 
if ($row['m_ab']=='2') $v_m_ab='چاه' ;	
if ($row['m_ab']=='3') $v_m_ab='قنات و چشمه' ;	
if ($row['m_ab']=='4') $v_m_ab='آب بندان' ;	 
if ($row['m_ab']=='5') $v_m_ab='خور و دریا' ;	
if ($row['m_ab']=='6') $v_m_ab='دریاچه' ;	
if ($row['m_ab']=='7') $v_m_ab='سایرمنابع' ;	 

//echo $row2['User_Name'] ; 
?>
<td align="center" class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
<td align="center" class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['mor_cod_m']) ?></td>
<td align="center" class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par4'] ?></td>
<td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par3'] ?></td>
<td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par2'] ?></td>
<td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par1'] ?></td>
<td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak5'] ?></td>
<td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak4'] ?></td>
<td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak3'] ?></td>
<td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak2'] ?></td>
<td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak1'] ?></td>
<td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['m_zamin']; ?></span></td>
  <td align="center"height="46"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_m_ab?></span></td>
    <td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_g_tol ?></span></td>
    <td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_fa ; ?></span></td>
    <td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['sal']; ?></span></td>
    <td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_name($row['bah_cod_m'])?></span></td>
    <td align="center"class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></span></td>
    <td align="center"style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></span></td>
    <td align="center"style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo ostan_name($row['id_ostan']) ?></td>
    <td align="center"style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>