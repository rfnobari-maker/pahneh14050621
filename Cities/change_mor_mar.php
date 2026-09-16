<?php
include("../lock_p3.php");
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
 include ('../login/config.php');
 ?>
<p align="center" ><span class="style1">اتصال آبادی به مرکز جهاد کشاورزی</span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 
  <?php if (isset($_POST['add_abadi'])) 
 {  
include('../login/config.php');
$add_abadi=$_POST['add_abadi'];
$id_mar=$_POST['id_mar'];
$mar=$_POST['mar'];
$error = $_POST['error'];
$id_abadi = substr($add_abadi,10,6) ; 
$query = "SELECT * from public_abadi4 where  substr(add_abadi,11,6) =  substr(:add_abadi,11,6) and id_ostan = :id_ostan"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi,':id_ostan'=>$id_ostan));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row['ostan'] ; 
$city= $row['city'] ; 
$deh= $row['deh'] ; 
$abadi= $row['abadi'] ; 
$add_abadi= $row['add_abadi'] ; 
?>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr class="text1">
    <td width="34%" height="37" bgcolor="#999999">آدرس آماری آبادی</td>
    <td width="17%" bgcolor="#999999">نام آبادی</td>
    <td width="17%" bgcolor="#999999">دهستان</td>
    <td width="18%" bgcolor="#999999">شهرستان</td>
    <td width="14%" bgcolor="#999999">استان</td>
  </tr>
  <tr>
    <td height="41"><?php echo $add_abadi ?></td>
    <td><?php echo $abadi ?></td>
    <td><?php echo $deh ?></td>
    <td><?php echo $city ?></td>
    <td><?php echo $ostan ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p><span class="style8"><?php echo $error?></span>
</p>
   <form id="form2" name="form2" method="post" action="">
     <table width="400" height="104" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
       <td width="240" height="52" ><input name="id_mar" type="text" class="input_text" id="id_mar" style="width:150px ; height:30px" value="<?php echo $id_mar ?>" readonly="readonly" /></td>
       <td width="160" style="text-align: right">:کد مرکز جهاد کشاورزی</td>
     </tr>
       <tr>
         <td height="52" ><input name="mar" type="text" class="input_text" style="width:150px ; height:30px "  value="<?php echo '&nbsp;'.$mar ;  ?>" readonly="readonly" /></td>
         <td style="text-align: right">:نام مرکز جهاد کشاورزی</td>
       </tr>
     </table>
   <p>
     <input type="hidden" name="id_abadi"  value="<?php echo $id_abadi ?>" />
    <input  type="submit" name="action2"  value="بازگشت" style="width:100px ; height:40px" />
     <input type="submit" name="action1" id="action1" value="ثبت " style="width:100px ; height:40px" />
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
<?PHP
if (isset($_POST['action1'])) 
 {  
    include('../login/config.php');
    $id_abadi=$_POST['id_abadi'];
 $id_mar=$_POST['id_mar'];
$query = "SELECT * from public_abadi4 where id_abadi = :id_abadi"; 
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
$query = "SELECT * from mar where id_mar = :id_mar"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id_mar'=>$id_mar));
$v_mar = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mar= $row['mar'] ; 
//
$query = "SELECT * from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$count = $stmt -> rowCount();
if ($count>0)
{
?>
 <form name="myform1" class="myform" method="post" action="">
 <input type="hidden" name="add_abadi"  value="<?php echo $add_abadi ?>" />
 <input type="hidden" name="error"  value="آبادی مورد نظر در حال حاضر در لیست آبادی های فعال می باشد" />
  </form>
 <script type="text/javascript">document.myform1.submit();</script>
<?php
	}
else 
{
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$query = "INSERT INTO list_abadi (id_ostan,ostan,id_city,city,bakh,deh,id_mar,mar,abadi,add_abadi,add_deh,add_bakh) VALUES (:id_ostan,:ostan,:id_city,:city,:bakh,:deh,:id_mar,:mar,:abadi,:add_abadi,:add_deh,:add_bakh)";
$q = $dbh->prepare($query);
echo $q->execute(array(':id_ostan'=>$id_ostan,':ostan'=>$ostan,':id_city'=>$id_city,':city'=>$city,':bakh'=>$bakh,':deh'=>$deh,':id_mar'=>$id_mar,':mar'=>$mar,':abadi'=>$abadi,':add_abadi'=>$add_abadi,':add_deh'=>$add_deh,':add_bakh'=>$add_bakh));
$query = "UPDATE change_mor SET status=? , date_a = ?
	WHERE add_abadi = ? and id_mar =? and no_request=?";
$q = $dbh->prepare($query);
$q->execute(array('2',$date_edit,$add_abadi,$id_mar,'4'));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'اتصال آبادی به مرکز - '.$id_mar,$id_ostan) ; 
alert(' آبادی مورد نظر با موفقیت در لیست آبادی های فعال شما ثبت شد.') ;
?>
 <form name="myform1" class="myform" method="post" action="list_request1.php">
     <input type="hidden" name="id_mar" value="<?php echo $id_mar ;?>" />
     <input type="hidden" name="mar" value="<?php echo $mar ;?>" />
  </form>
 <script type="text/javascript">document.myform1.submit();</script>

<?php 
}
}
?>
<?PHP
 if (isset($_POST['action2'])) 
 {  
    include('../login/config.php');
?>
 <form name="myform2" class="myform" method="post" action="list_request1.php">
     <input type="hidden" name="id_mar" value="<?php echo $id_mar ;?>" />
     <input type="hidden" name="mar" value="<?php echo $mar ;?>" />
  </form>
 <script type="text/javascript">document.myform2.submit();</script>

<?php 
}
?>