<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست_بهره_برداران_زراعی.xls");
include('../../lock_cp.php');
include('../../event.php') ;
  $id_ostan1=$_POST['id_ostan2'] ;
  $id_city =$_POST['id_city'] ;
  $id_mar  =$_POST['id_mar'] ;
  $no_kesh = $_POST['no_kesh'] ;
  $no_mal  = $_POST['no_mal'] ;
  $mor_cod_m = $_POST['mor_cod_m'] ;
  $bah_cod_m = $_POST['bah_cod_m'] ;
  $m_cod_m = $_POST['bah_cod_m'] ;
  $z_sal = $_POST['z_sal'] ;
  $Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 

 if ($id_ostan1 == '-1') {$v_id_ostan  = 1 ;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   = 1 ;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    = 1 ;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($no_mal  == '0')    {$f_no_mal    = 1 ;}else{ $f_no_mal = "no_mal = '$no_mal'" ;}
 if ($no_kesh == '0')    {$f_no_kesh   = 1 ;}else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')   {$v_mor_cod_m = 1 ;}else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')   {$v_bah_cod_m = 1 ;}else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($m_cod_m == '')     {$v_m_cod_m   = 1 ;}else{ $v_m_cod_m = "m_cod_m = '$m_cod_m'" ;}
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
include_once('../../login/config.php');
$query = "SELECT id,id_ostan,id_city,add_abadi,add_city,bah_cod_m,m_cod_m,mor_cod_m,sh_gat,no_mal,no_kesh,m_zamin,t_mah,z_sal from $Agri_table where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_no_kesh and $f_no_mal and $v_mor_cod_m and $v_bah_cod_m ORDER BY id ASC";
$stmt= $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
             <p align="center" dir="rtl">لیست قطعات زراعی - سال زراعی <?php echo $z_sal?></p>
      <table width="98%" height="91" border="0" align="center" cellpadding="1" cellspacing="1" >
        <tr align="center" class="text_r">
               <td width="10%" bgcolor="#999999">کد ملی مروج</td>
               <td width="10%" bgcolor="#999999">مساحت زمین (هکتار )</td>
    <td width="9%" height="42" bgcolor="#999999">نوع کشت</td>
    <td width="11%" bgcolor="#999999">نوع مالکیت</td>
    <td width="8%" bgcolor="#999999">کد ملی مالک</td>
    <td width="8%" bgcolor="#999999">شماره قطعه</td>
    <td width="11%" bgcolor="#999999"> کد ملی بهره بردار<br /></td>
    <td width="12%" bgcolor="#999999">نام و نام خانوادگی</td>
    <td width="12%" bgcolor="#999999">آدرس آماری شهر </td>
    <td width="12%" bgcolor="#999999"> نام شهر</td>
    <td width="12%" bgcolor="#999999">آدرس آماری آبادی </td>
    <td width="12%" bgcolor="#999999"> نام آبادی </td>
    <td width="12%" bgcolor="#999999">شهرستان </td>
    <td width="10%" bgcolor="#999999">استان</td>
    <td width="5%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
if ($row['no_mal']=='1') $v_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $v_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $v_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $v_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $v_no_mal='اجاره' ;	 
if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 

//echo $row2['User_Name'] ; 
?>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'];?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['m_zamin']; ?></span></td>
    <td height="46"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_kesh?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_mal ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_cod_m'];?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['sh_gat']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_name($row['bah_cod_m'])?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['add_city'] ;  ?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo shahr_name($row['add_city']) ?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo '&nbsp;'.$row['add_abadi'] ;  ?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo ostan_name($row['id_ostan']); ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
  <p align="center"> ------------- پایان گزارش -----------------</p>
