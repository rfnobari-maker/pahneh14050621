<?php
include("../lock_admin.php");
include("../event.php");
$id = $_POST['id'] ;
$id_mar = $_POST['id_mar'] ;
include('../login/config.php');
$query = "SELECT * from mar where id_mar = :id_mar"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id_mar'=>$id_mar));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $id_city1= $row['id_city'] ; 
 $id_mar = $row['id_mar'] ; 
 $mar = $row['mar']; 
 $id_ostan1 = $row['id_ostan']; 
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
<p align="center" ><span class="style1">ثبت مرکز جهاد کشاورزی  جديد</span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <p align="center" style="color:#900 ; font-family:Tahoma; font-size:12px" ><?php echo $_POST['mess'] ; ?></p>

   <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
   </table>
 <form action="" method="post" id="form1" name="form1">
 <table width="700" height="117" border="0">
   <tr>
     <td width="290" height="51">&nbsp;</td>
     <td width="101">&nbsp;</td>
     <td width="54">&nbsp;</td>
     <td width="225"><div align="right">
       <select name="id_city" id="id_city" class="required input_text" style="width:170px ; height:40px" dir="rtl" >
         <option value="">انتخاب نام شهرستان</option>
         <?php
$query = "SELECT DISTINCT id_city,city FROM cityname WHERE  id_ostan = '$id_ostan1' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
         <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city1) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
         <?php 
		   }?>
       </select>
     </div></td>
     <td width="108"><div align="right">:شهرستان</div></td>
   </tr>
   <tr>
     <td height="57"><div align="right">
       <input name="id_mar" type="text" class="required digits input_text" id="id_mar" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $id_mar?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right">:کد مرکز</div></td>
     <td>&nbsp;</td>
     <td height="57"><div align="right">
       <input name="mar" type="text" class="required input_text" id="mar" style="width:200px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $mar?>" maxlength="35" xml:lang="fa" />
     </div></td>
     <td><div align="right">:نام مرکز </div></td>
     </tr>
 </table>
 <div align="center">
   <p>&nbsp;     </p>
   <p>
     <input type="hidden" name="id"  value="<?php echo $id ?>">
     <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan ?>">
     <input type="hidden" name="ostan"  value="<?php echo $ostan ?>">
     <a href="mar_view.php"><input type="button" name="action2"  value="بازگشت" style="width:150px ; height:45px" /></a>
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="12" value="ثبت مرکز" />
   </p>
   </p>
 </div>
 <p align="center" >&nbsp;</p>
      </form>  </td>
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
  <?php
 if (isset($_POST['action'])) 
 {  
   include('../login/config.php');
  $id_city= $_POST['id_city']; 
  $ostan = $_POST['ostan']; 
  $mar = $_POST['mar']; 
  $id_mar = $_POST['id_mar']; 
  $city =city_name1($id_city,$id_ostan1) ;
  $id = $_POST['id']; 
 $query = "UPDATE mar 
        SET city=?, id_city=? , mar=? , id_mar=? 
		WHERE id=?";
$q = $dbh->prepare($query);
$q->execute(array($city,$id_city,$mar,$id_mar,$id));
	 alert('اطلاعات مرکز با موفقیت اصلاح شد ')
?>
	 <form name="myform1" class="myform" method="post" action="mar_view.php">
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
   }
  ?>