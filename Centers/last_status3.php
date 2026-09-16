<?php 
include('../lock_p2.php');
//include('counter.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
   <script src="../15_files/jquery.js" type="text/javascript"></script>
<title><?php echo $title ;?></title>
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
.column {
  float: left;
  width:30.8%;
  padding: 5px;
}
.column_S {
  float: left;
  width:20.8%;
  padding: 5px;
}
.row::after {
  content: "";
  clear: both;
  display: table;
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
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
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
      <?php include('top.php'); ?>
<p>
  <?php 
$query = "SELECT shaba from users where username = '$login_session'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$shaba = $row['shaba'] ; 
$query = "SELECT status,date_status,pic,username,tel_m,id_city,city,cod_m,name,Last_name,id_ostan FROM  users WHERE  id_ostan = '$id_ostan'  and id_mar = '$id_mar' and S_access = '1'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
?>
</p>
<p><img src="../files/images/55.jpg"  alt="" width="687" height="936" class="buttonhover"/> </p>
<p class="style1">تعیین آخرین وضعیت همکار </p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="93%" height="85" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td width="14%" bgcolor="#999999">تاریخ  بروز رسانی</td>
               <td width="31%" height="36" bgcolor="#999999"> وضعیت حضور در مرکز </td>
               <td width="10%" bgcolor="#999999">تلفن همراه</td>
               <td width="13%" bgcolor="#999999">کد ملی</td>
               <td width="12%" bgcolor="#999999">نام خانوادگی</td>
               <td width="11%" bgcolor="#999999">نام</td>
               <td width="5%" bgcolor="#999999">تصویر</td>
               <td width="4%" bgcolor="#999999">ردیف</td>
             </tr>
               <?php
$r = 1 ;
 foreach($stmt as $row){
	 $t_r = $r ; 
?>
             <tr>
               <td class="style8" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php 
			   if($row['date_status'] ==''){ echo 'عدم بروز رسانی ';}else {echo $row['date_status'] ; }?></td>
               <td height="49"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
                 <form name="form<?php echo $t_r ?>" id="form<?php echo $t_r ?>">
                 <input type="hidden" id="cod_m<?php echo $t_r ?>"name="cod_m" value="<?php echo $row['cod_m'] ; ?>" />
                 <div class="row">
                 <div class="column" >
                   <input name="submit"  type="submit" class="submit<?php echo $t_r ?>" id="submit<?php echo $t_r ?>" style="width:40px ; height:35px ; font-size:14px ; color:#900 ; font-family:tahoma ; text-align:center" tabindex="<?php echo $r.'5'?>"  value="ثبت"  />
                   <span class="error<?php echo $t_r ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15"  alt=""/></span> <span class="success<?php echo $t_r ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15"  alt=""/></span> </div>
                 <div class="column" >
                   <select name="status" class="required input_text  required" id="status<?php echo $t_r ;?>"  style="height:40px ; direction:rtl" tabindex="<?php echo $r.'1'?>">
                     <option value="">انتخاب</option>
                     <option value="1" <?php if ($row['status']=='1') { echo 'selected="selected"' ; } ?>>تمام اوقات کاری </option>
                     <option value="2" <?php if ($row['status']=='2') { echo 'selected="selected"' ; } ?>>پنج روز در هفته</option>
                     <option value="3" <?php if ($row['status']=='3') { echo 'selected="selected"' ; } ?>>چهار روز در هفته</option>
                     <option value="4" <?php if ($row['status']=='4') { echo 'selected="selected"' ; } ?>>سه روز در هفته</option>
                     <option value="5" <?php if ($row['status']=='5') { echo 'selected="selected"' ; } ?>>دو روز در هفته</option>
                     <option value="6" <?php if ($row['status']=='6') { echo 'selected="selected"' ; } ?>>یک روز در هفته</option>
                     <option value="7" <?php if ($row['status']=='7') { echo 'selected="selected"' ; } ?>>عدم حضور-انتقال</option>
                     <option value="8" <?php if ($row['status']=='8') { echo 'selected="selected"' ; } ?>>عدم حضور-مامور</option>
                     <option value="9" <?php if ($row['status']=='9') { echo 'selected="selected"' ; } ?>>عدم حضور-بازنشسته</option>
                     <option value="10" <?php if ($row['status']=='10') { echo 'selected="selected"' ; } ?>>عدم حضور-بیماری</option>
                     <option value="11" <?php if ($row['status']=='11') { echo 'selected="selected"' ; } ?>>عدم حضور-فوت</option>
                     <option value="12" <?php if ($row['status']=='12') { echo 'selected="selected"' ; } ?>>عدم حضور-مرخصی</option>
                   </select>
                 </div>
                 <div class="column" >
               </form></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['cod_m'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row['name'];?></td>
               <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png' ?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img src="../files/users/<?php echo $pic ?>" width="40" height="49"  alt=""/></span></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
         </table>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

<table width="50%" border="0" align="right" style="margin-right:25px">
  <tr>
    <td><form name="form<?php echo $t_r ?>" id="form<?php echo $t_r ?>2">
      <div class="row">
        <input type="hidden" id="username" name="username" value="<?php echo $login_session ; ?>" />
        <div class="column_S" align="center" >
          <input name="submit_S"  type="submit" class="submit_S" id="submit_S" style="width:70px ; height:35px ; font-size:14px ; color:#900 ; font-family:tahoma ; text-align:center" tabindex="<?php echo $r.'5'?>"  value="ثبت شبا"  />
          <span class="error_S" style="display:none"><img src="../../files/unTick.png" width="15" height="15"  alt=""/></span> <span class="success_S" style="display:none"><img src="../../files/Tick.png" width="15" height="15"  alt=""/></span></div>
        IR
        <input type="text" name="shaba" id="shaba" value="<?php echo $shaba ;?>" style=" height:40px;width:200px"  />
        : شبا رئیس مرکز </div>
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>          <a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>

<?php
$no = $t_row ; 
while ($no > 0){
?>
 <script type="text/javascript" >
$(function() {
$(".submit<?php echo $no ?>").click(function() {
var cod_m     = $("#cod_m<?php echo $no ?>").val();
var e = document.getElementById("status<?php echo $no ?>");
var status = e.options[e.selectedIndex].value;
var dataString ='cod_m='+ cod_m + '&status=' + status ;
if(status =='')
//if( 1 == 2 )
{
$('.success<?php echo $no ?>').fadeOut(200).hide();
$('.error<?php echo $no ?>').fadeOut(200).show();
}
else
{
$.ajax({
type: "POST",
url: "post98.php",
data: dataString,
success: function(){
$('.success<?php echo $no ?>').fadeIn(200).show();
$('.error<?php echo $no ?>').fadeOut(200).hide();
}
});
}
return false;
});
});
</script>
<?php
 $no--;
}
?>
 <script type="text/javascript" >
$(function() {
$(".submit_S").click(function() {
var username    = $("#username").val();
var shaba       = $("#shaba").val();
var dataString ='username='+ username + '&shaba=' + shaba ;
if(shaba =='' || shaba.length < 24)
//if( 1 == 2 )
{
$('.success_S').fadeOut(200).hide();
$('.error_S').fadeOut(200).show();
}
else
{
$.ajax({
type: "POST",
url: "post_shaba.php",
data: dataString,
success: function(){
$('.success_S').fadeIn(200).show();
$('.error_S').fadeOut(200).hide();
}
});
}
return false;
});
});
</script>
