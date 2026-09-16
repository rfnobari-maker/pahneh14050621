<?php
include("../lock_oce.php");
include("../event.php");
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
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
 <script src="../15_files/jquery.js" type="text/javascript"></script>
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
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 include ('../login/config.php');
 ?>
<p align="center" ><span class="style1">مدیران استانی سامانه</span></p>
<p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
 
 <p>
   <?php 
  $query = "SELECT username,name,Last_name,expert_unit,pic,tel_m,cod_m,id_city  FROM  users WHERE S_access = '4'  and chief != '1'  and id_ostan = '$id_ostan'" ;

$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt -> rowCount();
if($count>0){
?>
   <span class="RedTitleSmall">لیست مدیران استانی سامانه</span><br />
 </p>
 <table width="750" height="100" border="0" align="center" cellpadding="2" cellspacing="2" >
   <tr align="center" class="text1">
     <td height="32" colspan="4" bgcolor="#999999">عملیات</td>
     <td width="24%" bgcolor="#999999">نام خانوادگی</td>
     <td width="20%" bgcolor="#999999">نام</td>
     <td width="15%" bgcolor="#999999">تصویر</td>
     <td width="9%" bgcolor="#999999">ردیف</td>
   </tr>
   <tr>
     
     <?php
$r = 1 ;
 foreach($stmt as $row){
 ?>
<td width="8%" height="61" bordercolor="#FFFFFF" class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="send_sms.php" method="post" onsubmit="target_popup(this)">
       <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
       <input type="hidden" name="tel_m" value="<?php echo $row['tel_m'] ;?>" />
       <button><img src="../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
     </form></td>
     <td width="8%" bordercolor="#FFFFFF" class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="send_pm.php" method="post">
       <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
       <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
     </form></td>
     <td width="8%" bordercolor="#FFFFFF" class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="center_operation.php" method="post">
       <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
       <button><img src="../files/History.png" border="0"  title="مشاهده عملکرد مروج در سامانه  " width="31" height="30" /></button>
     </form></td>
     <td width="8%" bordercolor="#FFFFFF" class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="center_profile.php" method="post">
       <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
       <input type="hidden" name="cod_m" value="<?php echo $row['cod_m'] ;?>" />
       <button><img src="../files/adduser1.jpg" border="0"  title="مشاهده اطلاعات تکمیلی مروج " width="31" height="30" /></button>
     </form></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['Last_name'];?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmall"><?php echo $row['name'];?></td>
     <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall">
       <form  action="last_login.php" method="post" onsubmit="target_popup(this)">
         <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
         <button><img id="img1" src="../files/users/<? echo $pic ?>" width="37" height="43"  alt=""/></button>
         </form> 
     </td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
   </tr>
   <?php
$r++ ; 
}
?>
 </table>
       <?php 
 }
 ?>

 <p align="center"></p>
 <p align="center"><a href="index.php"><img src="../files/goback.jpg" width="128" height="57"  alt=""/></a></p>
 <p align="center"></p>
 <p align="center"></p>
    </td>
  </tr>
  <tr>
      <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p>
      <?php include('../footer.php')?>
    </p>
      <p>&nbsp; </p></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
