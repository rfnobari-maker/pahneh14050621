<?php 
include('../../lock_p1.php');
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
      <span class="style8">سوابق زنبورستان بهره بردار در سال <?php echo $z_sal ;?></span><br />
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
   $query = "SELECT id,id_ostan,id_city,id_mar,no_fa,g_tol,mor_cod_m,bah_cod_m,sal,no_mal,m_zamin,add_abadi,add_city,m_ab,num_bah from Aquatic where $v_bah_cod_m  and num_bah = '$num_bah' and sal = '$z_sal'  ORDER BY mor_cod_m ASC LIMIT $start, $limit "; 
   $query1 = "SELECT id from Aquatic where $v_bah_cod_m  and num_bah = '$num_bah' and sal = '$z_sal'  ORDER BY mor_cod_m "; 
 $query = "SELECT * FROM  `bee` where  $v_bah_cod_m  and num_bah = '$num_bah' and sal = '$z_sal'  ORDER BY bah_cod_m ASC LIMIT $start, $limit ";
 $query1 = "SELECT id FROM  `bee` where $v_bah_cod_m  and num_bah = '$num_bah' and sal = '$z_sal'  ORDER BY bah_cod_m ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>        <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span>
        </p>
      </p>
      <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC'>
        <tr class="text1">
      <td rowspan="2" bgcolor="#006699">عملیات</td>
      <td width="5%" colspan="2" rowspan="2" bgcolor="#006699">کارشناس<br />
        مروج</td>
      <td colspan="3" bgcolor="#006699">تولید عسل<br />
        <span class="style2">کیلوگرم</span></td>
      <td height="43" colspan="3" bgcolor="#006699">تعداد کندو</td>
      <td colspan="2" bgcolor="#006699">مشخصات زنبوردار</td>
      <td width="8%" rowspan="2" bgcolor="#006699"><p>نوع </p>
        <p>زنبورستان</p></td>
      <td colspan="2" bgcolor="#006699">موقعیت زنبورستان</td>
      <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
    </tr>
    <tr class="text1">
      <td width="6%" bgcolor="#006699">جمع</td>
      <td width="6%" bgcolor="#006699">مدرن</td>
      <td width="5%" bgcolor="#006699">سنتی</td>
      <td width="5%" bgcolor="#006699">جمع</td>
      <td width="6%" height="45" bgcolor="#006699">مدرن</td>
      <td width="6%" bgcolor="#006699">سنتی</td>
      <td width="8%" bgcolor="#006699">کد ملی </td>
      <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
      <td width="10%" bgcolor="#006699">شهر/آبادی</td>
      <td width="9%" bgcolor="#006699">شهرستان</td>
      </tr>
    <tr>
      <?php 
$r = $start+1 ;
	   foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
 if ($row['no_zan']=='1') $v_no_zan = 'غیرمهاجر '; else $v_no_zan = 'مهاجر' ;
  ?>
      <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <form  action="view_bee.php" method="post" onsubmit="bee_popup(this)">
        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
        <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
        <input type="hidden" name="m_page"  value="list_bee.php" />
        <button><img src="../../files/view.png" title="نمایش اطلاعات زنبورستان"  width="33" height="40"  alt=""/></button>
      </form></td>
      <td height="67" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['mor_cod_m']?><br />
        <?php echo user_tel($row['mor_cod_m'])?></p></td>
      <td height="67" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />
        <?php echo user_name($row['mor_cod_m'])?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['to_mo']+$row['to_bo'] ;   ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['to_mo'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['to_bo'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_bo'] ?></td>
      <td height="67" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_zan?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
      <td class="normalTextSmall"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
       <?php 
	   $r++ ; 
}
$query = "SELECT SUM(tk_bo) AS kol_k_bo ,SUM(tk_mo) AS kol_k_mo,SUM(to_bo) AS kol_t_bo,SUM(to_mo) AS kol_t_mo from bee where  $v_bah_cod_m  and num_bah = '$num_bah' and sal = '$z_sal'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_k_bo = $row['kol_k_bo'];
$kol_k_mo = $row['kol_k_mo'] ; 
$kol_t_bo = $row['kol_t_bo'];
$kol_t_mo = $row['kol_t_mo'] ; 
$kol_to = round(($kol_t_mo + $kol_t_bo),2) ;
$kol_tk = round(($kol_k_mo + $kol_k_bo),2) ;
$av_to_mo = round(($kol_t_mo / $kol_k_mo),2) ;
$av_to_bo = round(($kol_t_bo / $kol_k_bo),2) ;

?>
 <tr>
      <td height="43" colspan="3" bgcolor="#999999">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="normalTextSmall" ><?php echo $kol_to ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_t_mo ;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_t_bo ;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_tk ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_k_mo ;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_k_bo ;  ?></td>
      <td height="43" colspan="6" bgcolor="#FFFFFF" class="style1">جمع کل</td>
      </tr>
</table>
  <p align="right" class="input_text" style="margin-right:20px">میانگین تولید کندوهای سنتی : <?php echo $av_to_bo ?> کیلوگرم</p>
  <p align="right" class="input_text" style="margin-right:20px">میانگین تولید کندوهای مدرن : <span class="normalTextSmall"><?php echo $av_to_mo ?><span class="input_text"> کیلوگرم</span></span></p>
  <?php }?>
</div>
 
       <p> <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بازگشت</button></p></p> 
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
