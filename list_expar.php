<?php include('lock_p1.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>
</head>
<body>
        <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
<p>&nbsp;</p></td>
<td width="840" >
<?php
include('event.php');
include('top.php');
$id_aria = city_aria($id_ostan,$id_city) ; 
$query = "SELECT username,name,Last_name,expert_unit,pic FROM  users WHERE  id_ostan = '$id_ostan' and S_access = '5' and id_aria = '$id_aria' order by expert_unit" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p class="style8">اطلاعات کارشناسان معین منطقه <?php echo $id_aria ?></p>
           <p><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="750" height="127" border="0" align="center" cellpadding="2" cellspacing="2" >
             <tr align="center" class="text1">
               <td width="16%" height="57" bgcolor="#999999">ارسال پیام </td>
               <td width="23%" bgcolor="#999999">نام خانوادگی</td>
               <td width="16%" bgcolor="#999999">نام</td>
               <td width="9%" bgcolor="#999999">تصویر</td>
               <td width="29%" bgcolor="#999999">واحد تخصصی </td>
               <td width="7%" bgcolor="#999999">ردیف</td>
             </tr>
             <tr>
               <?php
$r = 1 ;
 foreach($stmt as $row){
   if ($row['expert_unit']=='1') $v_exp_unit = 'مدیریت هماهنگی ترویج' ; 
   if ($row['expert_unit']=='2') $v_exp_unit = 'مدیریت باغبانی';
   if ($row['expert_unit']=='3') $v_exp_unit = 'مدیریت حفظ نباتات';
   if ($row['expert_unit']=='4') $v_exp_unit = 'مدیریت زراعت';
   if ($row['expert_unit']=='5') $v_exp_unit = 'مدیریت امور شیلات و آبزیان';
   if ($row['expert_unit']=='6') $v_exp_unit = 'مدیریت امور دام ';
   if ($row['expert_unit']=='7') $v_exp_unit = 'مدیریت امور طیور';
   if ($row['expert_unit']=='8') $v_exp_unit = 'مدیریت امور اراضی ';
   if ($row['expert_unit']=='9') $v_exp_unit = 'مدیریت صنایع کشاورزی';
   if ($row['expert_unit']=='10') $v_exp_unit = 'مدیریت آب و خاک';	 
?>
               <td height="64" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="send_pm.php" method="post">
                 <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
                 <button><img src="files/receive_mail.png" width="40" height="40" title="ارسال پیام خصوصی" /></button>
               </form></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['Last_name'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmall"><?php echo $row['name'];?></td>
               <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><img src="files/users/<?php echo $pic ?>" width="40" height="49"  alt=""/></span></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><div align="right" style="margin-right:10px"> <?php echo $v_exp_unit ?></div></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
         </table>
           <p>&nbsp;</p>
           <p> <p><a href="indexbenef.php" title="برگشت به صفحه قبل"><img src="files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
      <td  height="109"colspan="3" valign="middle" background="files/bottom.gif"><p>
      <?php include('footer.php')?>
    </p>
      <p>&nbsp; </p></td>
    </tr>
</table>
</table>
</body>
</html>