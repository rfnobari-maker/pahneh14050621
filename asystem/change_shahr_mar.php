<?php
include("../lock_admin.php");
include('../event.php') ;
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
 <title>سامانه پهنه بندی آبادی های آذربایجان شرقی</title>
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
<p align="center" ><span class="style1">تغییر مرکز و مروج آبادی</span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <input type="text" name="add_city" id="add_city" />
     :کد شهر</p>
   <p>
     <input type="submit" name="action" id="action" value="جستجو " />
   </p>
 </form>
  <?
 if (isset($_POST['action'])) 
 {  
    include('../login/config.php');
    $add_city=$_POST['add_city'];
$query = "SELECT * from list_city where  add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row['ostan'] ; 
$city= $row['city'] ; 
$shahr= $row['shahr'] ; 
$mor_cod_m=$row['mor_cod_m'];
$id_mar = $row['id_mar'];
$mar = $row['mar'];
?>
<table width="80%" border="1" align="center">
  <tr>
    <td height="35" bgcolor="#FFFFCC">کد ملی مروج</td>
    <td bgcolor="#FFFFCC">کد مرکز</td>
    <td bgcolor="#FFFFCC">نام مرکز</td>
    <td bgcolor="#FFFFCC">نام شهر</td>
    <td bgcolor="#FFFFCC">شهرستان</td>
    <td bgcolor="#FFFFCC">استان</td>
  </tr>
  <tr>
    <td height="30"><?php echo $mor_cod_m?></td>
    <td><?php echo $id_mar ?></td>
    <td><?php echo $mar ?></td>
    <td><?php echo $shahr ?></td>
    <td><?php echo $city ?></td>
    <td><?php echo $ostan ?></td>
  </tr>
</table>
 <form id="form2" name="form2" method="post" action="">
   <p>
     <input type="text" name="id_mar2" id="id_mar2" />
     :کد مرکز جدید</p>
   <p>
     <input type="text" name="mor_cod_m2" id="mor_cod_m2" />
:کد مروج جدید</p>
   <p></p>
   <p>
     <input type="hidden" name="id_mar"  value="<?php echo $id_mar ?>" />
     <input type="hidden" name="mor_cod_m"  value="<?php echo $mor_cod_m ?>" />
     <input type="hidden" name="add_city"  value="<?php echo $add_city ?>" />
     <input type="submit" name="action1" id="action1" value="ثبت تغییرات" />
 </p>
 </form>
<?php
 }
 if (isset($_POST['action1'])) 
 {  
$id_mar = $_POST['id_mar'] ;
$mor_cod_m = $_POST['mor_cod_m'] ;
$id_mar2 = $_POST['id_mar2'] ;
$mor_cod_m2 = $_POST['mor_cod_m2'] ;
$add_city = $_POST['add_city'] ;
if (strlen($id_mar2)<4) $id_mar2=$id_mar ; 
if ($mor_cod_m2=='') $mor_cod_m2=$mor_cod_m ; 
$query = "SELECT * from list_city where id_mar = :id_mar"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id_mar'=>$id_mar2));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mar= $row['mar'] ; 
///
$query = "UPDATE list_city SET id_mar=?,mar=?,mor_cod_m=? WHERE add_city=?";
$q = $dbh->prepare($query);
$q->execute(array($id_mar2,$mar,$mor_cod_m2,$add_city));
	alert(' اطلاعات شهر مورد نظر تصحیح شد ') ;
 }
?>
 <p align="center" >&nbsp;</p>
 <p align="center" style="color:#900 ; font-family:Tahoma; font-size:12px" >&nbsp;</p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
          <span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
