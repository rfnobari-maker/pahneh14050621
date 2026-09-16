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
<p align="center" ><span class="style1">ثبت آبادی جديد</span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <input type="text" name="id_abadi" id="id_abadi" />
     :کد آبادی
</p>
   <p>
     <input type="text" name="id_mar" id="id_mar" />
:کد مرکز</p>
   <p>
     <input type="text" name="mar_cod_m" id="mar_cod_m" />
:کد ملی مروج</p>
   <p>
     <input type="submit" name="action" id="action" value="جستجو " />
   </p>
 </form>
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
  <?
 if (isset($_POST['action'])) 
 {  
    include('../login/config.php');
    $id_abadi=$_POST['id_abadi'];
	$id_mar=$_POST['id_mar'];
$query = "SELECT * from public_abadi where id_abadi = :id_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id_abadi'=>$id_abadi));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$id_ostan= $row['id_ostan'] ; 
$ostan= $row['ostan'] ; 
$id_city= $row['id_city'] ; 
$city= $row['city'] ; 
$bakh= $row['bakh'] ; 
$deh= $row['deh'] ; 
$abadi= $row['abadi'] ; 
$add_abadi= $row['add_abadi'] ; 
$add_deh =  substr($add_abadi,0,10) .'<p>';
$add_bakh = substr($add_abadi,0,6) .'<p>';
$mar_cod_m=$_POST['mar_cod_m'];
//
$query = "SELECT * from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$count = $stmt -> rowCount();
if (!$count>0)
{
//
$query = "SELECT * from list_abadi where id_mar = :id_mar"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id_mar'=>$id_mar));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mar= $row['mar'] ; 
$query = "INSERT INTO list_abadi (id_ostan,ostan,id_city,city,bakh,deh,id_mar,mar,abadi,mor_cod_m,add_abadi,add_deh,add_bakh) VALUES (:id_ostan,:ostan,:id_city,:city,:bakh,:deh,:id_mar,:mar,:abadi,:mor_cod_m,:add_abadi,:add_deh,:add_bakh)";
$q = $dbh->prepare($query);
$q->execute(array(':id_ostan'=>$id_ostan,':ostan'=>$ostan,':id_city'=>$id_city,':city'=>$city,':bakh'=>$bakh,':deh'=>$deh,':id_mar'=>$id_mar,':mar'=>$mar,':abadi'=>$abadi,':mor_cod_m'=>$mar_cod_m,':add_abadi'=>$add_abadi,':add_deh'=>$add_deh,':add_bakh'=>$add_bakh));
 }
 else 
 {
	alert('نام آبادی قبلا ثبت شده است ') ;
	 }
	 
	alert(' آبادی با موفقیت ثبت شد') ;
 }
?>