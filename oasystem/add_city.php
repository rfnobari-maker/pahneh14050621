<?php
include("../lock_ad.php");
include('../event.php') ;
$error = $_POST['error'];
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
<p align="center" >&nbsp;</p>
<p align="center" ><span class="style1">ثبت شهر جديد</span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <p align="center" class="style2" ><?php echo $error ;?></p>
 <form id="form1" name="form1" method="post" action="">
   <p>
     <input type="text" name="add_city" id="add_city" style="width:150px ; height:30px" />
     :آدرس آماری شهر</p>
   <p class="RedTitleSmaller">&nbsp;</p>
   <p>
     <a href="index.php"><input type="button" name="action2"  value="بازگشت" style="width:100px ; height:45px" /></a>
     <input type="submit" name="action" id="action" value="جستجو " style="width:100px ; height:45px"/>
 </p>
 </form>
 <p align="center" >&nbsp;</p>
 <p align="center" style="color:#900 ; font-family:Tahoma; font-size:12px" >&nbsp;</p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
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
     $add_city=$_POST['add_city'];
$query = "SELECT * from public_city where add_city = :add_city and id_ostan = :id_ostan"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city,':id_ostan'=>$id_ostan));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt -> rowCount();
if ($count==0)
{
	?>
 <form name="myform1" class="myform" method="post" action="">
 <input type="hidden" name="error"  value="شهر مورد نظر یافت نشد " />
  </form>
 <script type="text/javascript">document.myform1.submit();</script>
<?php
	}
else 
{
 $add_city= $row['add_city'] ; 
//
$query = "SELECT * from list_city where add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$count = $stmt -> rowCount();
if ($count>0)
{
	?>
 <form name="myform1" class="myform" method="post" action="">
 <input type="hidden" name="error"  value="شهر مورد نظر در حال حاضر در لیست آبادی های فعال قرار دارد" />
  </form>
 <script type="text/javascript">document.myform1.submit();</script>
<?php
}
else 
{
?>
 <form name="myform1" class="myform" method="post" action="doactive_city.php">
 <input type="hidden" name="add_city"  value="<?php echo $add_city?>" />
  </form>
 <script type="text/javascript">document.myform1.submit();</script>
<?php
}
}
}
 ?>