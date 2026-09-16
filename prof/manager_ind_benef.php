<?php
include("../lock_p1.php");
include('../event.php') ;
if(isset ($_POST['bah_cod_m']))  $bah_cod_m=$_POST['bah_cod_m'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
 <script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
            $.validator.addMethod("IsDate",
                  function (value, element) {
                      var result = /^(?:1[23]\d{2})\/(?:0?[1-9]|1[0-2])\/(?:0?[1-9]|[12][0-9]|3[01])$/.test(value);
                      if (value.length == 0)
                          return true;
                      else
                          return result;
                  },
                   "<br/><span style='color:#FF0066'>مثال<br/><span dir='ltr'>1390/08/14 </span></span>"
             );

            //$("#form1").validate();
        });
    </script>
</head>
<body>
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
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
 include ('../login/config.php');
 ?>
<p align="center" >&nbsp;</p>
<p align="center" class="style8" >مدیریت اطلاعات بهره بردار صنایع</p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form id="form1" name="form1" method="post" action="#result">
   <p>
     <input type="text" name="bah_cod_m" id="bah_cod_m" style="width:200px ; height:40px ; color:#900 ; font-size:14px" value="<?php echo $bah_cod_m?>" />
     :کد ملی بهره بردار/مدیرعامل</p>
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
$query = "SELECT id_city,date_t,name,last_name,bah_cod_m,num_bah,fname,tel_m,mor_cod_m,add_abadi,add_city,no_bah,co_name from ind_bah where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
if ($found>0) {
?>
    <?php if(isset($no_bah) && $no_bah=='2') echo '<p class=style8>بهره بردار داری شخصیت حقوقی ، با نام شرکت :' .$co_name .'</p>'?>
    <?php if(isset($no_bah) && $no_bah=='1') echo '<p class=style8> بهره بردار دارای شخصیت حقیقی </p>'?>
    <span class="style21"><a name="result" id="result"></a></span>  </p>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr class="text1">
    <td colspan="3" bgcolor="#006699">عملیات</td>
    <td width="12%" height="54" bgcolor="#006699">کارشناس </td>
    <td width="10%" bgcolor="#006699">شماره همراه</td>
    <td width="10%" bgcolor="#006699">بهره بردار</td>
    <td width="10%" bgcolor="#006699">کد ملی </td>
    <td width="11%" bgcolor="#006699">نام خانوادگی</td>
    <td width="9%" bgcolor="#006699">نام</td>
    <td width="10%" bgcolor="#006699">آبادی</td>
    <td width="10%" bgcolor="#006699">شهر</td>
    <td width="10%" bgcolor="#006699">شهرستان</td>
    </tr>
  <tr>
<?php
foreach($stmt as $row){ 
$city_s= $row['city_s'] ; 
$name= $row['name'] ; 
$last_name= $row['last_name'] ; 
$bah_cod_m= $row['bah_cod_m'] ; 
$num_bah= $row['num_bah'] ; 
$fname=$row['fname'];
$tel_m=$row['tel_m'];
$mor_cod_m=$row['mor_cod_m'];
$pic = user_pic($mor_cod_m) ;
$add_abadi=$row['add_abadi'];
$add_city = $row['add_city'];
$no_bah = $row['no_bah'];
$co_name = $row['co_name'];
if ($no_bah=='1') $v_no_bah = 'حقیقی' ;
if ($no_bah=='2') $v_no_bah = 'حقوقی' ;

if ($add_abadi<>'') {
$query = "SELECT ostan,city,abadi,mar from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$abadi= $row2['abadi'] ; 
$mar = $row2['mar'];
}
if ($add_city<>'') {
$query = "SELECT ostan,city,shahr,mar from list_city where add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$shahr= $row2['shahr'] ; 
$mar = $row2['mar'];
}
?>

   <?php if($mor_cod_m == $login_session) {?>
    <td width="6%">
    <form  action="del_ind_benef.php" method="post">
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
    <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
    <button onclick="return confirm('از حذف اطلاعات بهره بردار مطمئن هستید ؟ ')"><img src="../files/del.png" title="حذف اطلاعات بهره بردار"    width="33" height="26"  alt=""/></button>
    </form></td>
    <td width="6%">
    <form  action="edit_ind_benef.php" method="post">
    <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
    <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
    <input type="hidden" name="no_bah" value="<?php echo $row['no_bah'] ;  ;?>" />
    <button><img src="../files/edit.png" title="ویرایش اطلاعات بهره بردار" width="33" height="26"  alt=""/></button>
    </form>
</td>
    <td width="6%"> <form  action="view_ind_benef.php" method="post">
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
    <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />

    <button><img src="../files/view.png" title="نمایش اطلاعات بهره بردار"  width="33" height="26"  alt=""/></button>
    </form>
    <?php
 }
 else 
{
?>
<td colspan="3">
<img src="../files/lock.gif" title="اطلاعات توسط شما ثبت نشده است" width="33" height="26" alt=""/>
<?php 
}
?>
    </td>
    <td height="47" class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />      
      <?php echo user_name($mor_cod_m)?><br/><?php echo $mor_cod_m?><br /></td>
    <td class="normalTextSmaller"><?php echo $tel_m ?></td>
    <td class="normalTextSmaller"><?php echo $v_no_bah ; ?><br />
      <?php echo $row['co_name'] ; ?></td>
    <td height="47" class="normalTextSmaller"><?php echo $bah_cod_m ?></td>
    <td class="normalTextSmaller"><?php echo $last_name ?></td>
    <td class="normalTextSmaller"><?php echo $name ?></td>
    <td class="normalTextSmaller"><?php if(isset($abadi)) echo $abadi ?></td>
    <td class="normalTextSmaller"><?php if(isset($shahr)) echo $shahr ?></td>
    <td class="normalTextSmaller"><?php  echo city_name1($id_city,$id_ostan) ?></td>
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
   <p><a href="benefic.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p> 
  </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>
