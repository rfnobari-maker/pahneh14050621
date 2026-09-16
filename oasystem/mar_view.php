<?php
include("../lock_ad.php");
include("../event.php");
$id_ostan1 = $_POST['id_ostan'] ;
$id_city1 = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
#int
{ margin-right:10px 
}
</style>
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
<p align="center" >&nbsp;</p>
<p align="center" >مدیریت مراکز جهاد کشاورزی </p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <p align="center" style="color:#900 ; font-family:Tahoma; font-size:12px" ><?php echo $_POST['mess'] ; ?></p>

   <table width="600" border='0' align="center" cellpadding='0' cellspacing='0'>
     <tr bgcolor='#f1f1f1' >
       <td height="69" align="right" bgcolor="#F1F1F1" class="input_text" ><form method="post" name="form1" id="form3"  action="">
         <select  name="id_ostan" disabled="disabled" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
           <option value="-1">انتخاب استان</option>
           <?php
$query = "SELECT  id_ostan,ostan FROM ostanname "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
           <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
           <?php 
		   }?>
           </select>
         </form>
         <?php if (isset($_POST['id_ostan']))
 $id_ostan = $_POST['id_ostan'] ; 
?></td>
       <td> <div id="int" align="right">: استان</div></td>
     </tr>
     <tr bgcolor='#f1f1f1' >
       <td width="303" height="141" rowspan="2" align="right" bgcolor="#F1F1F1" class="input_text" >
         <form method="post" name="form1" id="form2"  action="#1">
           <p>
             <select dir="rtl"  name="id_city"  style="width:170px ; height:40px" >
               <option value="0">انتخاب نام شهرستان</option>
               <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = $id_ostan"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
               <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city1) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
               <?php 
		   }?>
             </select>
             </p>
      <p>
      <a href="index.php"><input type="button" name="action2"  value="بازگشت" style="width:150px ; height:45px" /></a>
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="12" value="جستجو" />
     <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
     </p>
           </form>
  </td>
       <td width="130" height="37"><div id="int" align="right">: شهرستان</div></td>
     </tr>
     <tr bgcolor='#f1f1f1' >
       <td height="77">&nbsp;</td>
     </tr>
   </table>
   <p>
     <?php if (isset($_POST['action'])) 
 {  
  include ('../login/config.php');
 $id_city = $_POST['id_city']; 
 $id_ostan = $_POST['id_ostan']; 
if ($id_ostan == -1) { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
 $query = "SELECT * FROM  mar where  $v_id_ostan and $v_id_city order by id_mar"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
     نتایج یافت شده </p>
   <table width="60%" height="119" border="1" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="style8">
      <td height="58" colspan="2" bgcolor="#CCCCCC">عملیات</td>
      <td width="12%" bgcolor="#CCCCCC">کد مرکز</td>
      <td width="13%" bgcolor="#CCCCCC">نام مرکز </td>
      <td width="13%" bgcolor="#CCCCCC">نام شهرستان</td>
      <td width="6%" bgcolor="#CCCCCC">ردیف</td>

    </tr>
    <tr>
      <?php
	  $r = 1 ;
 foreach($stmt as $row)
 {
?>
      <td   width="4%" height="58" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <form  action="#" method="post">
        <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
        <button  onclick="return confirm('از حذف مرکز با نام <?php echo $row['mar'] ;?> مطمئن هستید ؟ ')"><img src="../files/del1.png" width="40" height="35" title="حذف مرکز" /></button>
      </form></td>
      <td   width="7%" class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="mar_edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $row['id_city'] ;?>" />
        <button><img src="../files/adduser1.jpg" border="0"  title="ویرایش اطلاعات مرکز" width="40" height="35" /></button>
      </form></td>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_mar'];?></td>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mar'];?></td>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'];?></td>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
</a></span>
    </tr>
    <?php
	$r++ ; 
}
}
?>
  </table>  <p>&nbsp;</p>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
