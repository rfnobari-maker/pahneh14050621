<?php 
include('../../lock_p2.php');
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
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td>&nbsp;</td>
          </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    
      </p>
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
 $query = "SELECT id,id_ostan,id_city,id_mar,no_mtol,no_saz,no_gol,sys_kesh,mor_cod_m,bah_cod_m,sal,no_mal,m_zamin,m_zamin_baz,add_abadi,add_city,num_bah from Greenhous where $v_bah_cod_m  and num_bah = '$num_bah' and sal = '$z_sal'  ORDER BY mor_cod_m ASC  "; 
 $query1 = "SELECT id from Greenhous where $v_bah_cod_m  and num_bah = '$num_bah' and sal = '$z_sal'  ORDER BY mor_cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
          <p><span class="style8">سوابق واحدهای  های پرورش گلخانه ای بهره بردار در سال <?php echo $z_sal ;?></span><br />
            <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
          <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
            <tr class="text1">
          <td width="5%" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="10%" rowspan="2" bordercolor="#CCCCCC" bgcolor="#006699">کارشناس<br />
            مروج</td>
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت فضای باز<br />
            <span class="style2">مترمرب</span></td>
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت گلخانه<br />
            <span class="style2">مترمربع</span></td>
          <td width="9%" rowspan="2" bgcolor="#006699">نوع گلخانه</td>
          <td width="8%" rowspan="2" bgcolor="#006699">نوع سازه</td>
          <td width="8%" rowspan="2" bgcolor="#006699">سیستم کشت</td>
          <td width="8%" rowspan="2" bgcolor="#006699">نوع محصول</td>
          <td width="8%" rowspan="2" bgcolor="#006699">سال</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="3" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="8%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="8%" bgcolor="#006699">شهر/آبادی</td>
          <td width="7%" bgcolor="#006699">شهرستان</td>
          <td width="6%" bgcolor="#006699">استان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
if ($row['no_mal']=='1') $v_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $v_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $v_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $v_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $v_no_mal='اجاره' ;	 
if ($row['no_mtol']=='1')  $v_no_mtol='سبزی و صیفی';
if ($row['no_mtol']=='2')  $v_no_mtol='گل و گیاه زینتی در فضای گلخانه';
if ($row['no_mtol']=='4')  $v_no_mtol='گل و گیاه زینتی در فضای باز ';
if ($row['no_mtol']=='5')  $v_no_mtol='گل و گیاه زینتی در فضای توام';
if ($row['no_mtol']=='3')  $v_no_mtol='سایر' ;	 
if ($row['no_saz']=='') $v_no_saz='' ;	 
if ($row['no_saz']=='1') $v_no_saz='فلزی با پوشش پلاستیکی' ;	 
if ($row['no_saz']=='2') $v_no_saz='فلزی با پوشش پلی کربنات' ;	
if ($row['no_saz']=='3') $v_no_saz='فلزی با پوشش شیشه ای' ;	
if ($row['no_saz']=='4') $v_no_saz='چوبی پلاستیکی' ;	 
if ($row['no_gol']=='') $v_no_gol='' ;	 
if ($row['no_gol']=='1') $v_no_gol='تونلی تک قلو' ;	 
if ($row['no_gol']=='2') $v_no_gol='تونلی به هم پیوسته' ;	
if ($row['no_gol']=='3') $v_no_gol='یک طرفه' ;	
if ($row['no_gol']=='4') $v_no_gol='شیشه ای سقف شیروانی' ;	 
if ($row['sys_kesh']=='') $v_sys_kesh='' ;	 
if ($row['sys_kesh']=='1') $v_sys_kesh='خاکی' ;	 
if ($row['sys_kesh']=='2') $v_sys_kesh='هیدروپونیک' ;	 
  ?>
          <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="Greenhous_view.php" method="post" onsubmit="target_ebad(this)">
           <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
           <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
           <input type="hidden" name="num_bah" value="<?php echo $row['num_bah'] ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $row['m_poul'] ;?>" />
           <input type="hidden" name="sal" value="<?php echo $row['sal'] ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_mtol" value="<?php echo $row['no_mtol']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="num_bah"  value="<?php echo $row['num_bah'] ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form></td>
          <td bordercolor="#CCCCCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />
            <?php echo user_name($row['mor_cod_m'])?><br/>
            <?php echo $row['mor_cod_m']?><br />
            <?php echo user_tel($row['mor_cod_m'])?><br />
          </p></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin_baz']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_gol?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_saz ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_sys_kesh?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mtol?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal']?></td>
          <td height="99" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?><br />
            <?php echo bah_tel_m($row['bah_cod_m']) ?></td>
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
   <p> <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بازگشت</button></p></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>