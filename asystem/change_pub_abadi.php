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
<title><?php echo $title ;?></title>
     <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=320,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
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
 ?>
<p align="center" ><span class="style1">ویرایش اطلاعات آبادی </span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 
  <?php if (isset($_POST['id_abadi'])) 
 {  
include('../login/config.php');
$id_abadi=$_POST['id_abadi'];
$error = $_POST['error'];
$query = "SELECT ostan,id_ostan,city,id_city,deh,abadi,add_abadi,bakh,id_bakh,id_deh from public_abadi4 where id_abadi =  :id_abadi "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id_abadi'=>$id_abadi));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row['ostan'] ; 
$id_ostan= $row['id_ostan'] ; 
$city= $row['city'] ; 
$id_city= $row['id_city'] ; 
$deh= $row['deh'] ; 
$abadi= $row['abadi'] ; 
$add_abadi= $row['add_abadi'] ; 
$add_abadi_old= $row['add_abadi'] ; 
$bakh= $row['bakh'] ; 
$id_bakh= $row['id_bakh'] ; 
$deh= $row['deh'] ; 
$id_deh= $row['id_deh'] ; 


?>
  <table width="85%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="18%" bgcolor="#999999" class="text1">کد آبادی</td>
      <td width="18%" height="35" bgcolor="#999999" class="text1">آبادی</td>
      <td width="18%" bgcolor="#999999" class="text1">دهستان</td>
      <td width="14%" bgcolor="#999999"><span class="text1">شهرستان</span></td>
      <td width="14%" bgcolor="#999999"><span class="text1">استان</span></td>
      </tr>
    <tr>
      <td><?php echo $id_abadi ?></td>
      <td height="48"><?php echo $abadi ?><br />
        <?php echo $add_abadi ?></td>
      <td><?php echo $deh ?></td>
      <td><?php echo $city ?></td>
      <td><?php echo $ostan ?></td>
    </tr>
  </table>
  <p><span class="style8"><?php echo $error?></span>  </p>
   <form id="form2" name="form2" method="post" action="">
     <table width="800" height="340" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
         <td width="324" ><input name="id_ostan" type="text" class="input_text" id="id_ostan" style="width:150px ; height:30px" tabindex="2" value="<?php echo $id_ostan?>" /></td>
         <td width="114" style="text-align: right">:کد استان</td>
         <td width="252" height="51" ><input name="ostan" type="text" class="input_text" id="ostan" style="width:150px ; height:30px ; margin-right:" tabindex="1" value="<?php echo $ostan?>" /></td>
         <td width="110" style="text-align: right">:استان </td>
       </tr>
       <tr>
         <td ><input name="id_city" type="text" class="input_text" style="width:150px ; height:30px" tabindex="4"  value="<?php echo $id_city?>" /></td>
         <td style="text-align: right">:کد شهرستان</td>
         <td height="43" ><input name="city" type="text" class="input_text" style="width:150px ; height:30px" tabindex="3"  value="<?php echo $city?>" /></td>
         <td style="text-align: right">:شهرستان </td>
       </tr>
       <tr>
         <td ><input name="id_bakh" type="text" class="input_text" style="width:150px ; height:30px" tabindex="6"  value="<?php echo $id_bakh?>" /></td>
         <td style="text-align: right">:کد بخش</td>
         <td height="46" ><input name="bakh" type="text" class="input_text" style="width:150px ; height:30px" tabindex="5"  value="<?php echo $bakh?>" /></td>
         <td style="text-align: right">:بخش </td>
       </tr>
       <tr>
         <td ><input name="id_deh" type="text" class="input_text" style="width:150px ; height:30px" tabindex="8"  value="<?php echo $id_deh?>" /></td>
         <td style="text-align: right">:کد دهستان</td>
         <td height="42" ><input name="deh" type="text" class="input_text" style="width:150px ; height:30px" tabindex="7"  value="<?php echo $deh?>" /></td>
         <td style="text-align: right">:دهستان </td>
       </tr>
       <tr>
         <td >&nbsp;</td>
         <td style="text-align: right">&nbsp;</td>
         <td height="46" ><input name="abadi" type="text" class="input_text" style="width:150px ; height:30px" tabindex="9" value="<?php echo $abadi?>" /></td>
         <td style="text-align: right">:نام آبادی</td>
       </tr>
       <tr>
         <td height="28" colspan="4" class="RedTitleSmall" style="text-align: right">&nbsp;</td>
       </tr>
 </table>
   <p>
     <input type="hidden" name="id_abadi"  value="<?php echo $id_abadi ?>" />
     <input name="action2" type="submit" id="action2" style="width:100px ; height:40px ; margin:10px" tabindex="12" value="بازگشت" />
     <input name="action1" type="submit" id="action1" style="width:100px ; height:40px" tabindex="13" value="ثبت" /> 

   </p>
 </form>
     <?php
 }
?>
     
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
  <?php if (isset($_POST['action2'])) 
 {
 ?>
 <form name="myform1" class="myform" method="post" action="change_abadi.php">
  </form>
 <script type="text/javascript">document.myform1.submit();</script>
<?php  
 }
 if (isset($_POST['action1'])) 
 {  
$ostan= $_POST['ostan'] ; 
$id_ostan= $_POST['id_ostan'] ; 
$city= $_POST['city'] ; 
$id_city= $_POST['id_city'] ; 
$deh= $_POST['deh'] ; 
$abadi= $_POST['abadi'] ; 
$bakh= $_POST['bakh'] ; 
$id_bakh= $_POST['id_bakh'] ; 
$deh= $_POST['deh'] ; 
$id_deh= $_POST['id_deh'] ; 
$add_abadi = $id_ostan.$id_city.$id_bakh.$id_deh.$id_abadi ;
$add_deh = $id_ostan.$id_city.$id_bakh.$id_deh ;
$add_bakh = $id_ostan.$id_city.$id_bakh ;
$query = "UPDATE public_abadi4 SET id_ostan=?,ostan=?,id_city=?,city=?,id_bakh=?,bakh=?,id_deh=?,deh=?,add_abadi=?,abadi
=? WHERE id_abadi=?";
$q = $dbh->prepare($query);
$q->execute(array($id_ostan,$ostan,$id_city,$city,$id_bakh,$bakh,$id_deh,$deh,$add_abadi,$abadi,$id_abadi));

// اصلاح list_abadi
$query = "UPDATE list_abadi SET id_ostan=?,ostan=?,id_city=?,city=?,bakh=?,deh=?,add_abadi=?,abadi=?,add_deh=?,add_bakh=? WHERE add_abadi=?";
$q = $dbh->prepare($query);
$q->execute(array($id_ostan,$ostan,$id_city,$city,$bakh,$deh,$add_abadi,$abadi,$add_deh,$add_bakh,$add_abadi_old));

// شروع اصلاح جداول 
if ($add_abadi != $add_abadi_old)
{
$query = "UPDATE Agri1395_1396 SET add_abadi = '$add_abadi' , id_city = '$id_city'  where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$query = "UPDATE Agri_prod1395_1396 SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old'"; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1396_1397 SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$query = "UPDATE Agri_prod1396_1397 SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old'"; 
$stmt = $dbh->prepare($query);
$stmt->execute();

 $query = "UPDATE Agri1397_1398 SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$query = "UPDATE Agri_prod1397_1398 SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old'"; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1398_1399 SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$query = "UPDATE Agri_prod1398_1399 SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old'"; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1399_1400 SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$query = "UPDATE Agri_prod1399_1400 SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old'"; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Agri1400_1401 SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$query = "UPDATE Agri_prod1400_1401 SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old'"; 
$stmt = $dbh->prepare($query);
$stmt->execute();


$query = "UPDATE bah SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE bee SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Aquatic SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Eworker SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Garden SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Garden_prod SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Greenhousn SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Greenhous_prod SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Mushroom SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Mushroom_prod SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Vege SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

$query = "UPDATE Vege_prod SET add_abadi = '$add_abadi' , id_city = '$id_city' where add_abadi = '$add_abadi_old' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
}
// پایان اصلاح جداول 

alert(' آبادی مورد نظر با موفقیت ویرایش شد.') ;
?>
 <form name="myform1" class="myform" method="post" action="change_abadi.php">
  </form>
 <script type="text/javascript">document.myform1.submit();</script>

<?php 
}
?>