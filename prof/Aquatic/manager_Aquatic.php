<?php
include("../../lock_p1.php");
include('../../event.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');  ?>
<p align="center" ><span class="style8">مدیریت اطلاعات مزراع تکثیر و پرورش آبزیان</span><br />
  <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form id="form1" name="form1" method="post" action="#result">
   <p>
     <input type="text" name="bah_cod_m" id="bah_cod_m"  value="<?php echo $_POST['bah_cod_m'] ;?>" style="width:200px ; height:40px ; color:#900 ; font-size:14px" />
     :کد ملی بهره بردار/ مدیر عامل</p>
  <p>&nbsp;</p>
   <p>
     <input type="submit" name="action" id="action" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
   </p>
 </form>
  <p>
    <?php
 if (isset($_POST['action'])) 
 {  
$bah_cod_m=$_POST['bah_cod_m'];
$query = "SELECT
id_ostan,id_city,sal,mor_cod_m,no_fa,g_tol,m_ab,bah_cod_m,add_abadi,add_city,id,no_mal,num_bah,m_zamin
FROM Aquatic
WHERE bah_cod_m = :bah_cod_m
UNION ALL
SELECT
id_ostan,id_city,sal,mor_cod_m,no_fa,g_tol,m_ab,bah_cod_m,add_abadi,add_city,id,no_mal,num_bah,m_zamin
FROM Aquatic2
WHERE bah_cod_m = :bah_cod_m;"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
if ($found>0) {
?>
    <span class="style21"><a name="result" id="result"></a></span>  </p>
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="3" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="7%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
            <span class="style2">متر مربع</span></td>
          <td width="10%" rowspan="2" bgcolor="#006699">منبع تامین آب </td>
          <td width="11%" rowspan="2" bgcolor="#006699">قالب تولید</td>
          <td width="9%" rowspan="2" bgcolor="#006699">نوع فعالیت</td>
          <td width="9%" rowspan="2" bgcolor="#006699">سال</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="2" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="6%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="12%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="10%" bgcolor="#006699">شهر/آبادی</td>
          <td width="9%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
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
if ($row['m_ab']=='2') $v_m_ab='خور و دریا' ;	
if ($row['m_ab']=='3') $v_m_ab='دریاچه' ;	
if ($row['m_ab']=='4') $v_m_ab='سایرمنابع' ;	 

  ?>
          <?php if($row['mor_cod_m'] == $login_session) {?>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['sal']=='1405' ) {?>
            <form  action="del_Aquatic.php" method="post">
              <input type="hidden" name="m_page" value="manager_Aquatic.php" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
              <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="sal" value="<?php echo $row['sal']  ;?>" />
              <button onclick="return confirm('از حذف اطلاعات این مزرعه مطمئن هستید ؟ ')"><img src="../../files/del1.png" title="حذف اطلاعات مزرعه" width="33" height="26"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['sal']=='1405') {?>
              <form  action="Aquatic_edit.php" method="post">
              <input type="hidden" name="m_page" value="manager_Aquatic.php" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="sal" value="<?php echo $row['sal']  ;?>" />
              <input type="hidden" name="m_poul" value="<?php echo $row['m_poul']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_fa" value="<?php echo $row['no_fa']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="num_bah"  value="<?php echo $row['num_bah'] ;?>" />
              <button><img src="../../files/edit.png" title="ویرایش اطلاعات بهره برداری" width="33" height="26"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="<?php if($row['sal'] =='1404') echo 'Aquatic_view2.php' ; else echo 'Aquatic_view.php' ; ?>" method="post">
              <input type="hidden" name="m_page" value="manager_Aquatic.php" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="sal" value="<?php echo $row['sal']  ;?>" />
              <input type="hidden" name="m_poul" value="<?php echo $row['m_poul']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_fa" value="<?php echo $row['no_fa']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="num_bah"  value="<?php echo $row['num_bah'] ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form>
<?php
           }
 else 
{
?>
    <td width="7%" colspan="2">    
          <form  action="Aquatic_view.php" method="post">
              <input type="hidden" name="m_page" value="manager_Aquatic.php" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="sal" value="<?php echo $row['sal']  ;?>" />
              <input type="hidden" name="m_poul" value="<?php echo $row['m_poul']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_mtol" value="<?php echo $row['no_mtol']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="num_bah"  value="<?php echo $row['num_bah'] ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form>
<td >
<img src="../../files/lock.gif" title="ویرایش و حذف اطلاعات مقدور نمیباشد" width="33" height="26" alt=""/>
<?php 
}
?>
         </td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_ab ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_g_tol ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_fa ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['num_bah'])?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
      </table>
<?php
 }
 else 
 {
echo '<p class=style8> بهره برداری با مشخصات وارد شده یافت نشد</p>'  ;
 }
 }
?>
   <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p> 
  </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>
