<?php
include("lock_p2.php");
include("event.php");
$expert_unit = $_POST['expert_unit'] ; 
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
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
 ?>
<p align="center" >&nbsp;</p>
<p align="center" ><span class="style1">کارشناسان موضوعی تخصصی شهرستان </span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
 <p class="style8"> <?php echo $_POST['mess'] ; ?></p>
 <div style=" width: 500px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
   <form method="post" name="form1" id="form1" >
     <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
       <tr bgcolor='#f1f1f1' >
         <td height="40" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style1">معیار جستجو</span></td>
       </tr>
       <tr bgcolor='#f1f1f1' >
         <td height="45" bgcolor="#DDDDDD" class="input_text" align="right" ><select  name="id_city" disabled="disabled" id="bakh" style="width:170px ; height:40px" dir="rtl" >
           >
           <option value="0"> شهرستان</option>
           <?php
$query = "SELECT DISTINCT id_city,city FROM list_abadi WHERE  id_ostan = '$id_ostan'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
           <option value="<?php  echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php  echo $row['city'] ;?></option>
           <?php }?>
         </select>
           <?php  if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
         <td width="163"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
       </tr>
       <tr >
         <td height="23" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" ><p>
           <select name="expert_unit" class="required input_text" style="height:40px ; width:200px ; direction:rtl" tabindex="13">
             <option value="0">انتخاب زمینه تخصصی</option>
             <option value="1" <?php if ($_POST['expert_unit']=='1') { echo 'selected="selected"' ; } ?>>هماهنگی ترویج</option>
             <option value="2" <?php if ($_POST['expert_unit']=='2') { echo 'selected="selected"' ; } ?>> باغبانی</option>
             <option value="3" <?php if ($_POST['expert_unit']=='3') { echo 'selected="selected"' ; } ?>> حفظ نباتات</option>
             <option value="4" <?php if ($_POST['expert_unit']=='4') { echo 'selected="selected"' ; } ?>> زراعت</option>
             <option value="5" <?php if ($_POST['expert_unit']=='5') { echo 'selected="selected"' ; } ?>> امور شیلات و آبزیان</option>
             <option value="6" <?php if ($_POST['expert_unit']=='6') { echo 'selected="selected"' ; } ?>> امور دام </option>
             <option value="7" <?php if ($_POST['expert_unit']=='7') { echo 'selected="selected"' ; } ?>> امور طیور</option>
             <option value="8" <?php if ($_POST['expert_unit']=='8') { echo 'selected="selected"' ; } ?>> امور اراضی </option>
             <option value="9" <?php if ($_POST['expert_unit']=='9') { echo 'selected="selected"' ; } ?>> صنایع کشاورزی</option>
             <option value="10" <?php if ($_POST['expert_unit']=='10') { echo 'selected="selected"';} ?>> آب و خاک</option>
           </select>
         </p>
           <p >
             <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
           </p></td>
         <td height="47"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8">:زمینه تخصصی</font></td>
       </tr>
       <tr >
         <td height="29"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
       </tr>
     </table>
   </form>
 </div>
 <p>
   <?php if (isset($expert_unit))
 {
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($expert_unit == 0) { $v_expert_unit = 'expert_unit=expert_unit' ;} else { $v_expert_unit = "expert_unit='$expert_unit'" ;}
  $query = "SELECT username,name,Last_name,expert_unit,pic,tel_m,cod_m,id_city  FROM  users WHERE  id_ostan = '$id_ostan' and S_access = '6' and  $v_id_city and $v_expert_unit order by expert_unit" ;

$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt -> rowCount();
if($count>0){
?>
   <span class="RedTitleSmall">لیست کارشناسان معین شهرستانی</span><br />
 </p>
 <table width="750" height="100" border="0" align="center" cellpadding="2" cellspacing="2" >
   <tr align="center" class="text1">
     <td height="32" bgcolor="#999999">عملیات</td>
     <td width="24%" bgcolor="#999999">نام خانوادگی</td>
     <td width="14%" bgcolor="#999999">نام</td>
     <td width="7%" bgcolor="#999999">تصویر</td>
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
<td width="12%" height="61" bordercolor="#FFFFFF" class="normalTextSmaller" <?php  if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="send_pm.php" method="post">
  <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
  <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
</form></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['Last_name'];?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmall"><?php echo $row['name'];?></td>
     <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><img src="../files/users/<?php echo $pic ?>" width="40" height="49"  alt=""/></span></td>
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
 <p align="center"><a href="index.php"><img src="../files/goback.jpg"  alt="" width="128" height="57" border="0"/></a></p>
 <p align="center"></p>
 <p align="center"></p>
    </td>
  </tr>
  <tr>
      <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p>
      <?php include('footer.php')?>
    </p>
      <p>&nbsp; </p></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>