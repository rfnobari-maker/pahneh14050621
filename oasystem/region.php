<?php
include("../lock_ad.php");
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
<p align="center" ><span class="style1">منطقه بندی شهرستان های استان</span></p>
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
         <option value="1" <?php if ($id_aria=='1') echo 'selected=selected'?>>یک</option>
         <option value="2" <?php if ($id_aria=='2') echo 'selected=selected'?>>دو</option>
         <option value="3" <?php if ($id_aria=='3') echo 'selected=selected'?>>سه</option>
         <option value="4" <?php if ($id_aria=='4') echo 'selected=selected'?>>چهار</option>
         <option value="5" <?php if ($id_aria=='5') echo 'selected=selected'?>>پنج</option>
         <option value="6" <?php if ($id_aria=='6') echo 'selected=selected'?>>شش</option>
         <option value="7" <?php if ($id_aria=='7') echo 'selected=selected'?>>هفت</option>
         <option value="8" <?php if ($id_aria=='8') echo 'selected=selected'?>>هشت</option>
         <option value="9" <?php if ($id_aria=='9') echo 'selected=selected'?>>نه</option>
         <option value="10" <?php if ($id_aria=='10') echo 'selected=selected'?>>ده</option>

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
 $query = "SELECT * from aria where id_aria = $id_aria and id_ostan = $id_ostan";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt -> rowCount();
if($count>0){
?>
   <span class="RedTitleSmall">لیست شهرستان های منطقه <?php echo $id_aria ?></span><br />
 </p>
 <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr class="text1">
    <td width="19%" height="39" bgcolor="#999999">عملیات</td>
    <td width="22%" bgcolor="#999999">منطقه</td>
    <td width="22%" bgcolor="#999999">شهرستان</td>
    <td width="26%" bgcolor="#999999">استان</td>
    <td width="11%" bgcolor="#999999">ردیف</td>
  </tr>
<?php 
$r = 1 ;
 foreach($stmt as $row){
?>
  <tr>
   <td width="6%" height="55" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form  action="aria_del.php" method="post">
    <input type="hidden" name="id_city" value="<?php echo $row['id_city'] ;?>" />
    <input type="hidden" name="id_aria" value="<?php echo $row['id_aria'] ;?>" />
    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />

    <button onclick="return confirm('از حذف منطقه بندی شهرستان <?php echo $row['city'] ;?> مطمئن هستید ؟ ')"><img src="../files/notok.png" border="0"  title=" حذف شهرستان از منطقه" width="30" height="30" /></button>
  </form></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_aria']?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city']?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan']?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
 }
}
   ?>
 </table>
 <br />
<table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
</table>
 <form action="" method="post" id="form1" name="form1">
 <table width="100%" height="53" border="0" cellpadding="0" cellspacing="0">
   <tr>
     <td width="744" height="53" bgcolor="#CCCCCC"><div align="right">
       <select name="id_city" id="id_city" class="required input_text" style="width:170px ; height:40px" dir="rtl" >
         <option value="">انتخاب نام شهرستان</option>
         <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = $id_ostan"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
         <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
         <?php 
		   }?>
         </select>
     </div></td>
     <td width="138" bgcolor="#CCCCCC"><div align="right" class="style8">: ثبت شهرستان جدید </div></td>
     <td width="63" bgcolor="#CCCCCC">&nbsp;</td>
   </tr>
 </table>
 <div align="center">
   <p>
     <input type="hidden" name="id_aria"  value="<?php echo $id_aria ?>">
     <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan ?>">
     <input type="hidden" name="ostan"  value="<?php echo $ostan ?>">
     <a href="index.php"><input type="button" name="action2"  value="بازگشت" style="width:150px ; height:45px" /></a>&nbsp;
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="12" value="ثبت" />
   </p>
   </p>
 </div>
      </form></td>
       <?php 
 }
 ?>
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
  <?php if (isset($_POST['action']))
 {  
    include('../login/config.php');
$query = "SELECT DISTINCT id_aria FROM aria WHERE id_ostan = '$id_ostan' and id_city= '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$id_aria2 = $row['id_aria'] ;
$count_rep = $stmt -> rowCount();
  if($count_rep>0){
?>
<form name="myform" class="myform" method="post" action="">
<input type="hidden" name="id_aria"  value="<?php echo $id_aria ?>">
<input type="hidden" name="id_city"  value="<?php echo $id_city ?>">
<input type="hidden" name="mess"  value="شهرستان <?php echo city_name1($id_city,$id_ostan)?> قبلاً در منطقه <?php echo $id_aria2?> ثبت شده است ">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
	    }
	else
	{
echo   $id_city= $_POST['id_city']; 
echo '<br>' ; 
echo   $city =city_name1($id_city,$id_ostan) ;
echo '<br>' ; 
echo   $id_ostan = $_POST['id_ostan']; 
echo '<br>' ; 
echo   $ostan = $_POST['ostan']; 
echo '<br>' ; 
echo  $id_aria = $_POST['id_aria']; 
include('../login/config.php');
$sql=$dbh->prepare("INSERT INTO aria (id_ostan,ostan,city,id_city,id_aria) VALUES ( ?, ?,?, ?, ?);");
$sql->execute(array($id_ostan,$ostan,$city,$id_city,$id_aria));

   // $mess = "کاربر جدید با موفقیت ثبت شد ";
//	 alert('منطقه شهرستان مورد نظر با موفقیت ثبت شد ')
?>
	 <form name="myform1" class="myform" method="post" action="">
     <input type="hidden" name="id_aria"  value="<?php echo $id_aria ?>">
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
   }
  }
  ?>