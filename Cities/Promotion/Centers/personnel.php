<?php
include('../../../lock_p3.php');
include("../../../event.php");
include ('../../../login/config.php');
$id_mar1  = $_POST['id_mar'];
$id_ostan1 = $_POST['id_ostan'];
$id_city1 = $_POST['id_city'];
$id_select_city  = $_POST['id_select_city'];
include ('../../../login/config.php');
// شمارش تعداد پرسنل مرکز
$query = "SELECT * FROM  users WHERE  id_ostan = '$id_ostan1' and id_mar = '$id_mar1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_tot = $stmt -> rowCount();
// شمارش تعداد رئیس مرکز
$query = "SELECT * FROM  users WHERE  id_ostan = '$id_ostan1' and id_mar = '$id_mar1'  and S_access = '2'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mchif = $stmt -> rowCount();
//
// شمارش تعداد کارشناس پهنه
$query = "SELECT * FROM  users WHERE  id_ostan = '$id_ostan1' and id_mar = '$id_mar1'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mor = $stmt -> rowCount();
//
// شمارش تعداد پرسنل پشتیبانی
$query = "SELECT * FROM  users WHERE  id_ostan = '$id_ostan1' and id_mar = '$id_mar1'  and S_access = '50'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_posh = $stmt -> rowCount();
//
// شمارش تعداد سربازان سازندگی
$query = "SELECT * FROM  users WHERE  id_ostan = '$id_ostan1' and id_mar = '$id_mar1'  and S_access = '51'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_sarbaz = $stmt -> rowCount();
//

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
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
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../../../files/images/header.jpg" width="949" height="149" /></td>
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
$query = "SELECT * FROM  users WHERE  id_mar = '$id_mar1' and id_city = '$id_city1' and id_ostan = '$id_ostan1' and  S_access = '2'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png' ; ?>
<p align="center" ><span class="style1">اطلاعات پرسنلی مرکز جهاد کشاورزی </span></p>
 <p align="center" ><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
 </p>
   <div  style=" border: 3px solid #930 ; width:600px ; margin:auto" >
     <table width="100%" height="344" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
       <tr class="style8">
         <td height="50" colspan="2" bgcolor="#FFFFCC">مشخصات رئیس مرکز</td>
         <td bgcolor="#FFFFCC">نفر<br /></td>
         <td bgcolor="#FFFFCC">سمت</td>
       </tr>
       <tr>
         <td width="180" height="51" bgcolor="#FFFFFF"  class="normalTextSmaller" 
		 <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $row['Last_name'];?> &nbsp; <?php echo $row['name'];?></div></td>
         <td width="99" bgcolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img id="img1" src="../../../files/users/<?php echo $pic?>" width="40" height="49"  alt=""/></span></td>
         <td width="67" bgcolor="#FFFFFF" style="font-size:18px ; color:#039"><button style=" width:60px; height:40px ;font-size:18px; color:#039 "><?php echo $count_mchif;  ?></button></td>
         <td width="254" bgcolor="#FFFFFF">رئیس مرکز</td>
       </tr>
       <tr>
         <td height="74" bordercolor="#FFFFFF" bgcolor="#CCCCCC" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
         <td height="74" bordercolor="#FFFFFF" bgcolor="#CCCCCC" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
         <td bgcolor="#CCCCCC">
         <form  action="../../Cpromotes.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
        <button class="tilt"><span style=" width:60px; height:40px ;font-size:18px; color:#039 "><img src="../../../files/commi.png" width="30" height="30"  alt=""/><?php echo $count_mor ; ?></span></button>
      </form>
         </td>
         <td bgcolor="#CCCCCC">کارشناسان مسئول پهنه</td>
       </tr>
       <tr>
         <td height="54" bordercolor="#FFFFFF" bgcolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
         <td bordercolor="#FFFFFF" bgcolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
         <td valign="middle" bgcolor="#FFFFFF">
         <form  action="sstaff.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
        <button class="tilt"><span style=" width:60px; height:40px ;font-size:18px; color:#039 "><img src="../../../files/commi.png" width="30" height="30"  alt=""/><?php echo $count_posh ; ?></span></button>
      </form>
        </td>
         <td bgcolor="#FFFFFF">نیروهای پشتیبانی</td>
       </tr>
       <tr>
         <td height="56" bordercolor="#FFFFFF" bgcolor="#CCCCCC" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
         <td bordercolor="#FFFFFF" bgcolor="#CCCCCC" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
         <td bgcolor="#CCCCCC">
         <form  action="list_sold.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
        <button class="tilt"><span style=" width:60px; height:40px ;font-size:18px; color:#039 "><img src="../../../files/commi.png" width="30" height="30"  alt=""/><?php echo $count_sarbaz ; ?></span></button>
      </form>         
       </td>
         <td bgcolor="#CCCCCC">سربازان سازندگی</td>
       </tr>
       <tr>
         <td height="35" colspan="2" bgcolor="#FFFFFF"><p>&nbsp;</p>
           <p>&nbsp;</p></td>
         <td bgcolor="#FFFFFF"><button style=" width:60px; height:40px ;font-size:18px; color:#900; direction:rtl "> <?php echo $count_tot ;  ?></button></td>
         <td bgcolor="#FFFFFF">جمع نیروهای مرکز</td>
       </tr>
     </table>
   </div>
 <div align="center">
   <p>
    <form action="../../list_center.php#1" method="post" id="form1" name="form1">
     <input type="hidden" name="id_city"  value='<?php echo  $id_select_city ?>'>
     <input type="hidden" name="action"  value='1'>
     <input type="hidden" name="id_ostan"  value='<?php echo $id_ostan1 ?>'>
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="23" value="بازگشت" />
    </form>
 </div>
 </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
