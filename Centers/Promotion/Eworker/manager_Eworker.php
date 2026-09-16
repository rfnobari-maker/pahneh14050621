<?php
include("../../../lock_p2.php");
include('../../../event.php') ;
if (isset($_POST['cod_m']))  $cod_m=$_POST['cod_m'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
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
             <td><img src="../../../files/images/header.jpg" width="100%" height="149" /></td>
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
 <?php include('top.php');
 include ('../../../login/config.php');
 ?>
 <p align="center" ><span class="style8">مدیریت اطلاعات مددکار ترویجی / تسهلیگر</span><br />
  <img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form id="form1" name="form1" method="post" action="#result">
   <p>
     <input type="submit" name="action_lise" id="action_lise" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
     <input type="text" name="cod_m" id="cod_m" value="<?php echo $cod_m ?>" style="width:200px ; height:40px ; color:#900 ; font-size:14px ; text-align:center" />
     :کد ملی مددکار ترویجی / تسهیلگر</p>
 </form>
  <p>
    <?php
 if (isset($_POST['action_lise'])) 
 {  
include('../../../login/config.php');
$query = "SELECT end_bee from users where username = $login_session ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_bee =  $row['end_bee'] ; 
$cod_m=$_POST['cod_m'];
$query = "SELECT * from Eworker where  cod_m = :cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':cod_m'=>$cod_m));
$found = $stmt -> rowCount();
if ($found>0) {
?>
    <span class="style21"><a name="result" id="result"></a></span>  </p>
  <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
        <tr class="text1">
          <td colspan="3" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="6%" rowspan="2" bgcolor="#006699">نوع عضویت</td>
          <td width="13%" rowspan="2" bgcolor="#006699">گرایش تحصیلی</td>
          <td width="12%" rowspan="2" bgcolor="#006699">رشته تحصیلی</td>
          <td width="5%" rowspan="2" bgcolor="#006699">سال جذب</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات </td>
          <td colspan="2" bgcolor="#006699">موقعیت </td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="9%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="13%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="11%" bgcolor="#006699">شهر /آبادی</td>
          <td width="9%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
if ($row['g_tah']=='1') $v_g_tah='امور دام ' ;	 
if ($row['g_tah']=='2') $v_g_tah='دامپزشکی' ;	 
if ($row['g_tah']=='3') $v_g_tah='زراعت و باغبانی' ;	 
if ($row['g_tah']=='4') $v_g_tah='شیلات و آبزیان' ;	 
if ($row['g_tah']=='5') $v_g_tah='منابع طبیعی و آبخیزداری' ;	 
if ($row['g_tah']=='6') $v_g_tah='آب و خاک' ;	 
if ($row['g_tah']=='7') $v_g_tah='مکانیزاسیون کشاورزی' ;	 
if ($row['g_tah']=='8') $v_g_tah='صنایع تبدیلی و تکمیلی' ;	 
if ($row['g_tah']=='9') $v_g_tah='ترویج و آموزش کشاورزی' ;	 
if ($row['g_tah']=='10') $v_g_tah='غیر کشاورزی' ;	 
if ($row['g_tah']=='11') $v_g_tah='اعلام نشده' ;	 
if ($row['g_tah']=='12') $v_g_tah='فاقد مدرک دانشگاهی' ;	 
if ($row['no_oz']=='1') $v_no_oz='فعال' ;	 
if ($row['no_oz']=='2') $v_no_oz='غیرفعال' ;	 
  ?>
  <?php if($row['id_mar'] == $id_mar) {?>

          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="del_Eworker.php" method="post">
              <input type="hidden" name="m_page" value="manager_Eworker.php" />
              <input type="hidden" name="cod_m" value="<?php echo $row['cod_m']  ;?>" />
              <button onclick="return confirm('از حذف اطلاعات مددکار مطمئن هستید ؟ ')"><img src="../../../files/del1.png" title="حذف اطلاعات مددکار ترویجی" width="33" height="26"  alt=""/></button>
            </form>
            </td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
              <form  action="Eworker_edit.php" method="post">
               <input type="hidden" name="m_page" value="manager_Eworker.php" />
              <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
              <input type="hidden" name="add_abadi"  value="<?php echo $row['add_abadi'] ;?>" />
              <input type="hidden" name="cod_m" value="<?php echo $row['cod_m']  ;?>" />
              <button><img src="../../../files/edit.png" title="ویرایش اطلاعات مددکار" width="33" height="26"  alt=""/></button>
            </form>
           </td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
           <form  action="Eworker_view.php" method="post">
              <input type="hidden" name="m_page" value="manager_Eworker.php" />
              <input type="hidden" name="cod_m" value="<?php echo $row['cod_m']  ;?>" />
            <button><img src="../../../files/view.png" title="نمایش اطلاعات مددکار"  width="33" height="26"  alt=""/></button>
          </form>
<?php
           }
		    else 
{
?>
    <td width="7%" colspan="2">    
           <form  action="Eworker_view.php" method="post">
              <input type="hidden" name="m_page" value="manager_Eworker.php" />
              <input type="hidden" name="cod_m" value="<?php echo $row['cod_m']  ;?>" />
            <button><img src="../../../files/view.png" title="نمایش اطلاعات مددکار"  width="33" height="26"  alt=""/></button>
          </form>
<td>
<img src="../../../files/lock.gif" title="اطلاعات مددکار ترویجی در این مرکز ثبت نشده است" width="33" height="26" alt=""/>
<?php 
}

?>
          
          </td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_oz; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $v_g_tah; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['r_tah']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal_z']; ?></td>
          <td height="71" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['cod_m'],'1')?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']), shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
      </table>
  <p>
    <?php
 }
 else 
 {
echo '<p class=style8> مددکار ترویجی با مشخصات وارد شده یافت نشد</p>'  ;
 }
 }
?>
  </p>
  <p>&nbsp; </p>
  <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p> 
  </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>
