<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Garden_rep.doc");
include("../../lock_p1.php");
include("../../event.php");
include_once('../../login/config.php') ;
if (isset($_POST['z_sal']))  
 $id_ostan1 = $_POST['id_ostan1'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_kesh = $_POST['no_kesh'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
// کد گروه و کد محصول
  $mah_name = $_POST['mah_name'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="840" >
<?php
 if ($id_ostan1 == '-1')  { $v_id_ostan = 1   ;} else{ $v_id_ostan  = "Garden_prod.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)       { $v_id_city = 1    ;} else{ $v_id_city   = "Garden_prod.id_city='$id_city'" ;}
 if ($id_mar  == 0)       { $v_id_mar = 1     ;} else{ $v_id_mar    = "Garden_prod.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1 ;} else{ $f_add_abadi = "Garden_prod.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')   { $f_add_city  = 1  ;} else{ $f_add_city  = "Garden_prod.add_city = '$add_city'" ;}
 if ($no_kesh == '0')     { $f_no_kesh  = 1   ;} else{ $f_no_kesh   = "Garden_prod.no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')    { $v_mor_cod_m  = 1 ;} else{ $v_mor_cod_m = "Garden_prod.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')    { $v_bah_cod_m  = 1 ;} else{ $v_bah_cod_m = "Garden_prod.bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')        { $v_z_sal  = 1     ;} else{ $v_z_sal     = "Garden_prod.z_sal = '$z_sal'" ;}
 if ($mah_name == '')     { $v_cod_mah  = 1   ;} else{ $v_cod_mah   = "Garden_prod.cod_mah = '$mah_name'" ;}
?>
<br />
<table width="98%" height="72" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td width="15%" bgcolor="#999999">کد ملی مروج </td>
               <td width="15%" height="31" bgcolor="#999999">میزان تولید قطعی / تن </td>
               <td width="13%" bgcolor="#999999">میزان تولید پیش بینی / تن </td>
               <td bgcolor="#999999"> تعداد درخت غیربارور / اصله </td>
               <td bgcolor="#999999">تعداد درخت بارور / اصله </td>
               <td bgcolor="#999999">سطح زیر کشت غیربارور / هکتار</td>
               <td width="10%" bgcolor="#999999">سطح زیر کشت بارور / هکتار</td>
               <td width="11%" bgcolor="#999999">کد ملی بهره بردار </td>
               <td width="12%" bgcolor="#999999">نام و نام خانوادگی بهره بردار </td>
               <td width="6%" bgcolor="#999999">ردیف</td>
             </tr>
             <tr>
               <?php
 $query = "SELECT  Garden_prod.bah_cod_m ,Garden_prod.num_bah,Garden_prod.mor_cod_m ,
sum(Garden_prod.s_kesht_b)   s_keshtb,
sum(Garden_prod.s_kesht_gb) s_keshtgb,
sum(Garden_prod.tree_b)  treeb,
sum(Garden_prod.tree_gb) treegb ,
sum(Garden_prod.mah_tolp)   mahtolp,
sum(Garden_prod.mah_tol)   mahtol
FROM Garden_prod
where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah Group by bah_cod_m  ORDER BY bah_cod_m  "; 
$stmt = $dbh->prepare($query);
$stmt->execute(); 
$r = 1 ;
 foreach($stmt as $row){
 $treeb = $row['treeb'] ;
 $treegb = $row['treegb'] ;
 $s_keshtb = round($row['s_keshtb'],4) ;
 $s_keshtgb = round($row['s_keshtgb'],4) ;
 $mahtolp = round($row['mahtolp'],4) ;
 $mahtol = round($row['mahtol'],4) ;
?>
        <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['mor_cod_m'] ?></span></td>
        <td align="center" height="39"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol ;?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtolp ;?></td>
               <td align="center" width="11%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $treegb ;?></td>
               <td align="center"  width="11%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $treeb ;?></td>
               <td align="center" width="11%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_keshtgb ;?></td>
               <td align="center"    <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_keshtb ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo $row['bah_cod_m'] ?></span><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><div align="right" style="margin-right:5px"> <?php echo bah_name2($row['bah_cod_m'],$row['num_bah']) ?></div></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
     </table>
</body>           </div>
          <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>




