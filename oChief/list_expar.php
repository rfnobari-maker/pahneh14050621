<?php
include("../lock_oce.php");
include("../event.php");
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
$id_aria = $_POST['id_aria']
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
<p align="center" ><span class="style1">کارشناسان معین استانی </span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
 <p class="style8"> <?php echo $_POST['mess'] ; ?></p>
 <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
   <tr bgcolor='#f1f1f1' >
     
   </tr>
   <tr bgcolor='#f1f1f1' >
     <td width="704" height="55"  align="right" bgcolor="#CCCCCC" class="input_text" >
     <form method="post" name="form1" id="form2"  action="#1">
      <div align="right">
       <select  name="id_aria" class="input_text" id="id_aria" style="width:100px ; height:40px" dir="rtl"  onchange="this.form.submit()">
       <option value="">انتخاب منطقه</option>
         <option value="1" <?php if($id_aria=='1')   echo 'selected=selected'?>>یک</option>
         <option value="2" <?php if($id_aria=='2')   echo 'selected=selected'?>>دو</option>
         <option value="3" <?php if($id_aria=='3')   echo 'selected=selected'?>>سه</option>
         <option value="4" <?php if($id_aria=='4')   echo 'selected=selected'?>>چهار</option>
         <option value="5" <?php if($id_aria=='5')   echo 'selected=selected'?>>پنج</option>
         <option value="6" <?php if($id_aria=='6')   echo 'selected=selected'?>>شش</option>
         <option value="7" <?php if($id_aria=='7')   echo 'selected=selected'?>>هفت</option>
         <option value="8" <?php if($id_aria=='8')   echo 'selected=selected'?>>هشت</option>
         <option value="9" <?php if($id_aria=='9')   echo 'selected=selected'?>>نه</option>
         <option value="10" <?php if($id_aria=='10') echo 'selected=selected'?>>ده</option>
       </select></div>
            </form>
    <?php if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?>   
            </td>
     <td width="181"  align='center' bgcolor="#CCCCCC" class="style1"><div align="right" class="style8"><font size="2" class="style8">       : انتخاب منطقه مورد نظر</font></div>
       </td>
     <td width="60"  align='center' bgcolor="#CCCCCC" class="style1"><p>&nbsp;</p></td>
   </tr>
 </table>
 <p>
   <?php if (isset($id_aria))
 {
 $query = "SELECT * from aria where id_aria = $id_aria";
 $query = "SELECT username,name,Last_name,expert_unit,pic,tel_m,cod_m  FROM  users WHERE  id_ostan = '$id_ostan' and S_access = '5' and id_aria = '$id_aria' order by expert_unit" ;

$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt -> rowCount();
if($count>0){
?>
   <span class="RedTitleSmall">لیست کارشناسان معین استانی - منطقه <?php echo $id_aria ?></span><br />
 </p>
 <table width="750" height="100" border="0" align="center" cellpadding="2" cellspacing="2" >
   <tr align="center" class="text1">
     <td height="32" colspan="4" bgcolor="#999999">عملیات</td>
     <td width="18%" bgcolor="#999999">نام خانوادگی</td>
     <td width="12%" bgcolor="#999999">نام</td>
     <td width="6%" bgcolor="#999999">تصویر</td>
     <td width="27%" bgcolor="#999999">واحد تخصصی </td>
     <td width="5%" bgcolor="#999999">ردیف</td>
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
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><div align="right" style="margin-right:10px"> <?php echo $v_exp_unit ?></div></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
   </tr>
   <?php
$r++ ; 
}
?>
 </table>
       <?php 
 }
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
