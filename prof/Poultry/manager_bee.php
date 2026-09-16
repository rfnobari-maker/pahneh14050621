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
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../../files/images/header.jpg" width="100%" height="130" /></td>
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
if(isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'] ; 
 ?>
<p align="center" >&nbsp;</p>
<p align="center" >مدیریت اطلاعات زنبورستان</p>
 <p align="center" ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form id="form1" name="form1" method="post" action="#result">
   <p>
     <input type="text" name="bah_cod_m" id="bah_cod_m" value="<?php echo $bah_cod_m ?> "  style="width:200px ; height:40px ; color:#900 ; font-size:14px" />
     :کد ملی زنبوردار</p>
  <p>&nbsp;</p>
   <p>
     <input type="submit" name="action" id="action" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
   </p>
 </form>
  <p>
    <?php
 if (isset($_POST['action'])) 
 {  
$query = "SELECT end_bee from users where username = '$login_session' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_bee =  $row['end_bee'] ; 
$bah_cod_m=$_POST['bah_cod_m'];
 $query = "SELECT id_ostan,id_city,mor_cod_m,no_zan,bah_cod_m,add_abadi,add_city,id,tk_mo,tk_bo,unique_id,num_bah from bee where  bah_cod_m = ?  and sal = ?"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array($bah_cod_m , '1404'));
$found = $stmt -> rowCount();
if ($found>0) {
?>
    <span class="style21"><a name="result" id="result"></a></span>  </p>
  <table  align="center" class="my-table" >
    <tr class="text1">
    <td colspan="4" rowspan="2" bgcolor="#006699">عملیات</td>
    <td width="8%" height="54" rowspan="2" bgcolor="#006699">کارشناس<br />
مروج</td>
    <td height="35" colspan="3" bgcolor="#006699">تعداد کندو</td>
    <td colspan="2" bgcolor="#006699">مشخصات زنبوردار</td>
    <td width="8%" rowspan="2" bgcolor="#006699">نوع زنبورستان</td>
    <td colspan="2" bgcolor="#006699">موقعیت زنبورستان</td>
    </tr>
    <tr class="text1">
      <td width="5%" bgcolor="#006699">جمع</td>
      <td width="4%" height="31" bgcolor="#006699">مدرن</td>
      <td width="6%" bgcolor="#006699">سنتی</td>
      <td width="10%" bgcolor="#006699">کد ملی </td>
      <td width="13%" bgcolor="#006699">نام و نام خانوادگی</td>
      <td width="11%" bgcolor="#006699">شهر/آبادی</td>
      <td width="11%" bgcolor="#006699">شهرستان</td>
    </tr>  <tr>
    <?php  foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
 $unique_id = $row['unique_id'] ; 
// غیر فعال کردن تغییرات و حذف 
// $end_bee = '3' ; 
 if ($row['no_zan']=='1') $v_no_zan = 'غیرمهاجر '; else $v_no_zan = 'مهاجر' ;
  ?>
  <?php if($row['mor_cod_m'] == $login_session) {?>
    <td width="8%">
    <?php //if ((!$end_bee=='1') or (!$end_bee=='3'))  {?>
    <?php if ('1'!='1')   {?>    
    <form  action="del_bee.php" method="post">
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
    <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
    <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
    <input type="hidden" name="unique_id"  value="<?php echo $unique_id ;?>" />
    <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
    <button onclick="return confirm('از حذف اطلاعات زنبورستان مطمئن هستید ؟ ')"><img src="../../files/del.png" title="حذف اطلاعات زنبورستان" width="20" height="20"  alt=""/></button>
    </form>
     <?php }?>
    </td>
    <td width="5%" >
     <?php if ('1'!='1')   {?> 
    <form  action="equip_edit.php" method="post">
      <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
      <input type="hidden" name="num_bah" value="<?php echo $row['num_bah']  ;?>" />
      <input type="hidden" name="unique_id"  value="<?php echo $row['unique_id'] ;?>" />
      <button><img src="../../files/komo2.png" title="ویرایش تجهیزات زنبورستان" width="20" height="20"  alt=""/></button>
    </form>
    <?php }?>
    </td>
    <td width="8%">
    <?php //if ((!$end_bee=='1') or (!$end_bee=='3'))  {?>
    <?php if ('1'!='1')   {?>    
    <form  action="Bee_edit.php" method="post">
     <input type="hidden" name="m_poul" value="<?php if(isset($row['m_poul'])) echo $row['m_poul']  ;?>" />
    <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
    <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
    <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
    <input type="hidden" name="no_bee" value="<?php echo $row['no_zan']  ;?>" />
    <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
    <button><img src="../../files/edit.png" title="ویرایش اطلاعات زنبورستان" width="20" height="20"  alt=""/></button>
    </form>
     <?php }?>
</td>
    <td width="8%"> <form  action="view_list_bee.php" method="post">
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
    <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
    <button><img src="../../files/view.png" title="نمایش اطلاعات زنبورستان"  width="20" height="20"  alt=""/></button>
    </form>
    <?php
 }
 else 
{
?>
    <td width="8%"> <form  action="view_list_bee.php" method="post">
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
    <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
    <button><img src="../../files/view.png" title="نمایش اطلاعات زنبورستان"  width="20" height="20"  alt=""/></button>
    </form>
<td colspan="2">
<img src="../../files/lock.gif" title="اطلاعات زنبورستان توسط شما ثبت نشده است" width="33" height="26" alt=""/>
<?php 
}
?>
    </td>
    <td class="normalTextSmaller"><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />      
      <?php echo user_name($row['mor_cod_m'])?><br/><?php echo $row['mor_cod_m']?><br /></td>
    <td class="normalTextSmaller"><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
    <td class="normalTextSmaller"><?php echo $row['tk_mo'] ?></td>
    <td class="normalTextSmaller"><?php echo $row['tk_bo'] ?></td>
    <td height="108" class="normalTextSmaller"><?php echo $row['bah_cod_m'] ?></td>
    <td class="normalTextSmaller"><?php echo bah_name($row['bah_cod_m'])?></td>
    <td class="normalTextSmaller"><?php echo $v_no_zan?></td>
    <td class="normalTextSmaller"><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
    <td class="normalTextSmaller"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td> 
    </tr>
    <?php }?>
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