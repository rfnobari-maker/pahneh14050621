<?php
include("../lock_admin.php");
include("../event.php");
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
 <table width="343" height="200" border="0" align="center">
   <tr>
     <td width="254" height="60"><div align="right">
       <?php 
   $id_ostan = '08' ; 
	  include('../login/config.php');
   $query = "SELECT max(`id_mar`) as `max_mar` FROM  `mar` WHERE  `id_ostan` = '$id_ostan' " ;
   $stmt = $dbh->prepare($query);
   $stmt->execute();  
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $count_mar =  $row['max_mar'] ; 
   $count_mar =  substr($count_mar,2,3) ;
   $mar_num = $count_mar + 1 ;
   if($mar_num<10) $mar_num = '0'.$mar_num ; 
   $id_mar=$id_ostan.$mar_num ;?>
   <select name="id_city" id="id_city" class="required input_text" style="width:170px ; height:40px" dir="rtl" >
   <option value="">انتخاب نام شهرستان</option>
      <?php
echo $query = "SELECT  id_city,city FROM `cityname` WHERE  `id_ostan` = '08'"  ;
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
     <td width="79"><div align="right">:شهرستان</div></td>
   </tr>
   <tr>
     <td height="66"><div align="right">
       <input name="id_mar" type="text" class="required digits input_text" id="id_mar" style="width:50px; height:30px ; background-color:#0CF " tabindex="4" dir="rtl" lang="fa" value="<?php echo $id_mar ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right">:کد مرکز</div></td>
   </tr>
   <tr>
     <td height="66"><div align="right">
       <input name="mar" type="text" class="required input_text" id="mar" style="width:200px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $_POST['mar']?>" maxlength="35" xml:lang="fa" />
     </div></td>
     <td><div align="right">:نام مرکز </div></td>
     </tr>
 </table>
 <div align="center">
   <p>&nbsp;     </p>
   <p>
     <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan ?>">
     <input type="hidden" name="ostan"  value="<?php echo $ostan ?>">
    <a href="index.php"><input type="button" name="action2"  value="بازگشت" style="width:150px ; height:45px" /></a>
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="12" value="ثبت و ادامه" />
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
  <?php if (isset($_POST['action'])) 
 {  
    include('../login/config.php');
   if(isset($_POST['mar']) && isset($_POST['id_mar'])){
    $password=$_POST['pass'];
    $sql=$dbh->prepare("SELECT COUNT(*) FROM `mar` WHERE `id_mar`=?");
    $sql->execute(array($_POST['id_mar']));
    if($sql->fetchColumn()!=0){
?>
<form name="myform" class="myform" method="post" action="">
<input type="hidden" name="mess"  value="مرکزی با این کد قبلاً ثبت شده است">
<input type="hidden" name="city"  value="<?php echo $_POST['city'] ;?>">
<input type="hidden" name="id_mar"  value="<?php echo $_POST['id_mar'] ;?>">
<input type="hidden" name="mar"  value="<?php echo $_POST['mar'] ;?>">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
	    }
	else
	{
echo   $id_city= $_POST['id_city']; 
echo   $city =city_name1($id_city,$id_ostan) ;
  $id_ostan = $_POST['id_ostan']; 
  $ostan = $_POST['ostan']; 
  $mar = $_POST['mar']; 
  $id_mar = $_POST['id_mar']; 
     $sql=$dbh->prepare("INSERT INTO `mar` (`id_ostan`,`ostan`,`city`,`id_city`,`mar`,`id_mar`) VALUES ( ?, ?,?, ?, ?, ?);");
     $sql->execute(array($id_ostan,$ostan,$city,$id_city,$mar,$id_mar));
    // $mess = "کاربر جدید با موفقیت ثبت شد ";
	 alert('مرکز جدید با موفقیت ثبت شد ')
?>
	 <form name="myform1" class="myform" method="post" action="mar.php">
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
    }
   }
  }
  ?>