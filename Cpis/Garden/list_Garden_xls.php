<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Garden_list.xls");
?>
<?php 
include('../../lock_cp.php');
include('../../event.php') ;
  $id_ostan=$_POST['id_ostan'] ;
  $id_city =$_POST['id_city'] ;
  $id_mar  =$_POST['id_mar'] ;
  $nah_kesh = $_POST['nah_kesh'] ;
  $no_kesh = $_POST['no_kesh'] ;
  $no_mal  = $_POST['no_mal'] ;
  $mor_cod_m = $_POST['mor_cod_m'] ;
  $bah_cod_m = $_POST['bah_cod_m'] ;
  $m_cod_m = $_POST['m_cod_m'] ;
  $z_sal = $_POST['z_sal'] ;
  if ($id_ostan == '-1')  { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
  if ($id_city == '0')    { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
  if ($id_mar  == '0')    { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
  if ($no_mal  == '0')  { $f_no_mal  = 'id = id'  ; }else{ $f_no_mal = "no_mal = '$no_mal'" ;}
  if ($no_kesh == '0')  { $f_no_kesh  = 'id = id'  ; }else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
  if ($mor_cod_m == '')  { $v_mor_cod_m  = 'id = id'  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
  if ($bah_cod_m == '')  { $v_bah_cod_m  = 'id = id'  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
  if ($m_cod_m == '')  { $v_m_cod_m  = 1  ; }else{ $v_m_cod_m = "m_cod_m = '$m_cod_m'" ;}
  if ($z_sal == '')  { $v_z_sal  = 'id = id'  ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
  if ($nah_kesh == '0')  { $v_nah_kesh  = 'id = id'  ; }else{ $v_nah_kesh = "nah_kesh = '$nah_kesh'" ;}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td><p>
      <?php 
include ('../../login/config.php');
 $query = "SELECT id_ostan,id_city,id_mar,nah_kesh,no_kesh,sh_gat,m_cod_m,mor_cod_m,bah_cod_m,z_sal,no_mal,m_zamin,add_abadi,add_city,t_mah from Garden where $v_id_ostan and $v_id_city and $v_id_mar and $v_z_sal and $f_no_mal and $f_no_kesh and $v_mor_cod_m and $v_bah_cod_m and $v_nah_kesh ORDER BY mor_cod_m ASC ";
 $stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
           <table width="98%" height="91" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text_r">
               <td width="12%" bgcolor="#999999">مساحت زمین (هکتار )</td>
    <td width="10%" height="42" bgcolor="#999999">نوع کشت</td>
    <td width="10%" bgcolor="#999999">نوع مالکیت</td>
    <td width="10%" bgcolor="#999999">نحوه کشت</td>
    <td width="10%" bgcolor="#999999">کد ملی مالک</td>
    <td width="10%" bgcolor="#999999">شماره قطعه</td>
    <td width="10%" bgcolor="#999999">شماره همراه</td>
    <td width="10%" bgcolor="#999999">تاریخ تولد</td>
    <td width="10%" bgcolor="#999999"> کد ملی بهره بردار<br /></td>
    <td width="11%" bgcolor="#999999">نام و نام خانوادگی</td>
    <td width="9%" bgcolor="#999999">شهر / آبادی </td>
    <td width="11%" bgcolor="#999999">شهرستان </td>
    <td width="7%" bgcolor="#999999">ردیف</td>
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
if ($row['nah_kesh']=='1') $v_nah_kesh='ساده' ;	 
if ($row['nah_kesh']=='2') $v_nah_kesh='مخلوط' ;	 
if ($row['nah_kesh']=='3') $v_nah_kesh='درختان پراکنده' ;	 
if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 

//echo $row2['User_Name'] ; 
?>
<td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['m_zamin']; ?></span></td>
  <td height="46"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_kesh?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_mal ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_nah_kesh ; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_cod_m'];?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['sh_gat']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_tel_m($row['bah_cod_m']);?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_date_t($row['bah_cod_m']);?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_name($row['bah_cod_m'])?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>