<?php 
include('../../lock_ce.php');
include('../../event.php');
$bah_cod_m = $_POST['bah_cod_m'] ;
$num_bah   = $_POST['num_bah'] ; 
$z_sal = $_POST['z_sal'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script>
function close_window() {
      close();
 }
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="840" >
      <?php
 if (isset($_POST['action'])) 
 {  
  $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;
 include('../../login/config.php');
$start=0;
$limit=100;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
   $query = "SELECT id,id_ostan,id_city,id_mar,no_fa,g_tol,mor_cod_m,bah_cod_m,sal,no_mal,m_zamin,add_abadi,add_city,m_ab,num_bah from Aquatic where $v_bah_cod_m  and num_bah = '$num_bah' and sal = '$z_sal'  ORDER BY mor_cod_m ASC  "; 
   $query1 = "SELECT id from Aquatic where $v_bah_cod_m  and num_bah = '$num_bah' and sal = '$z_sal'  ORDER BY mor_cod_m "; 
   $stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
            <span class="style8">سوابق مزارع پرورش آبزیان بهره بردار در سال <?php echo $z_sal ;?></span> <br />
            <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/> 
            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
          <td width="5%" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="5%" rowspan="2" bordercolor="#CCCCCC" bgcolor="#006699">کارشناس<br />
            مروج</td>
          <td width="9%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
            مترمربع</td>
          <td width="8%" rowspan="2" bgcolor="#006699">منبع آب</td>
          <td width="9%" rowspan="2" bgcolor="#006699">قالب تولید</td>
          <td width="9%" rowspan="2" bgcolor="#006699">نوع فعالیت</td>
          <td width="6%" rowspan="2" bgcolor="#006699">سال</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="3" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="8%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="12%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="8%" bgcolor="#006699">شهر/آبادی</td>
          <td width="8%" bgcolor="#006699">شهرستان</td>
          <td width="8%" bgcolor="#006699">استان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
if ($row['no_mal']=='1') $f_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $f_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $f_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $f_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $f_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $f_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $f_no_mal='اجاره' ;	 
if ($row['no_fa']=='1') $f_no_fa='تکثیر' ;	 
if ($row['no_fa']=='2') $f_no_fa='پرورش' ;	 
if ($row['no_fa']=='3') $f_no_fa='تکثیر و پرورش' ;	 
if ($row['g_tol']=='1') $f_g_tol='مجتمع' ;	 
if ($row['g_tol']=='2') $f_g_tol='منفرد' ;	
if ($row['g_tol']=='3') $f_g_tol='مداربسته' ;	
if ($row['g_tol']=='4') $f_g_tol='دو منظوره' ;	 
if ($row['g_tol']=='5') $f_g_tol='شالیزار' ;	
if ($row['g_tol']=='6') $f_g_tol='قفس' ;	
if ($row['g_tol']=='7') $f_g_tol='پن' ;	 
if ($row['g_tol']=='8') $f_g_tol='آب بندان' ;	 
if ($row['g_tol']=='9') $f_g_tol='منابع آبی' ;	 
if ($row['g_tol']=='10') $f_g_tol='سایر موارد' ;	 

if ($row['m_ab']=='1') $v_m_ab='رودخانه' ;	 
if ($row['m_ab']=='2') $v_m_ab='چاه' ;	
if ($row['m_ab']=='3') $v_m_ab='قنات و چشمه' ;	
if ($row['m_ab']=='4') $v_m_ab='آب بندان' ;	 
if ($row['m_ab']=='5') $v_m_ab='خور و دریا' ;	
if ($row['m_ab']=='6') $v_m_ab='دریاچه' ;	
if ($row['m_ab']=='7') $v_m_ab='سایرمنابع' ;	 

  ?>
          <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="Aquatic_view1.php" method="post" onsubmit="target_ebad(this)>
           <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
           <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
           <input type="hidden" name="num_bah" value="<?php echo $row['num_bah'] ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $row['m_poul'] ;?>" />
           <input type="hidden" name="sal" value="<?php echo $row['sal'] ;?>" />
           <input type="hidden" name="no_fa" value="<?php echo $row['no_fa'] ;?>" />
           <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form></td>
          <td bordercolor="#CCCCCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />
            <?php echo user_name($row['mor_cod_m'])?><br/>
            <?php echo $row['mor_cod_m']?><br />
            <?php echo user_tel($row['mor_cod_m'])?><br />
          </p></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_ab ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_g_tol?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_no_fa?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal']; ?></td>
          <td height="108" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
    </table>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
	?>
    <p>&nbsp;</p>
       <p> <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بازگشت</button></p></p> 
</td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
