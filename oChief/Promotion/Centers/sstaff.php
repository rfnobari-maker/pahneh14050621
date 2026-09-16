<?php 
include('../../../lock_oce.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php'); 
 include('../../../login/config.php');
$id_mar1   = $_POST['id_mar'];
$id_ostan1 = $_POST['id_ostan'];
$id_city1  = $_POST['id_city'];
$query = "SELECT * FROM  users WHERE  id_ostan = '$id_ostan1' and id_mar = '$id_mar1' and S_access = '50'"  ;

$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      <p class="style1">لیست پرسنل پشتیبانی ، مرکز</p>
           <p><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="93%" height="115" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="58" colspan="2" bgcolor="#999999">عملیات</td>
               <td width="13%" bgcolor="#999999">تاریخ استخدام</td>
               <td width="13%" bgcolor="#999999">نوع استخدام</td>
               <td width="14%" bgcolor="#999999">کد پزسنلی</td>
               <td width="11%" bgcolor="#999999">کد ملی</td>
               <td width="13%" bgcolor="#999999">نام خانوادگی</td>
               <td width="10%" bgcolor="#999999">نام</td>
               <td width="8%" bgcolor="#999999">تصویر</td>
               <td width="6%" bgcolor="#999999">ردیف</td>
             </tr>
             <tr>
               <?php
$r = 1 ;
 foreach($stmt as $row){
?>
               <td width="6%" height="57" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="../../send_sms.php" method="post" onsubmit="target_popup(this)">
                 <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
                 <input type="hidden" name="tel_m" value="<?php echo $row['tel_m'] ;?>" />
                 <button><img src="../../../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
               </form></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller"><form  action="view_posh.php" method="post">
                 <input type="hidden" name="cod_m" value="<?php echo $row['cod_m'] ;?>" />
                 <button><img src="../../../files/adduser1.jpg" border="0"  title="مشاهده اطلاعات همکار " width="31" height="31" /></button>
               </form></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['date_es'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['no_es'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['cod_p'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['cod_m'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row['name'];?></td>
               <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img  id='img1' src="../../../files/users/<?php echo $pic ?>" width="40" height="49"  alt=""/></span></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
         </table>
           <p>&nbsp;</p>
 <form action="personnel.php" method="post" id="form1" name="form1">
   <input type="hidden" name="id_city"  value="<?php echo $id_city1 ?>">
   <input type="hidden" name="id_mar"  value="<?php echo $id_mar1 ?>">

     <input type="hidden" name="action"  value="1">
     <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan1 ?>">
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="23" value="بازگشت" />
    </form>
      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>    </tr>
</table>
</table>
</body>
</html>