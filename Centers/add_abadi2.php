<?php include('../lock_p2.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
        });
    </script>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>
		</style>	
    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >

<div style="float:right ; margin-right:30px ; margin-left:20px ; margin-top:15px ; padding:10px "  > <img src="../files/users/<?php echo $pic ?>" width="79" height="103"  alt="تصویر کاربر "/></div>
              <p align="right" class="link" style="margin-right:30px">&nbsp;</p>
              <p align="right" class="style2" style="margin-right:30px">پانل مدیریتی سامانه پهنه بندی آبادی های استان</p>
              <p align="right" class="RedTitleSmaller" style="margin-right:30px">ویژه روسای مراکز جهاد کشاورزی </p>
              <p align="right" class="normalTextSmaller" style="margin-right:30px">محل خدمت : <?php echo $ostan.'&nbsp; /&nbsp;'.$city.'&nbsp;/&nbsp;'.$markaz ;  ?></p>
            <p align="right" class="RedTitleSmaller" style="margin-right:30px">&nbsp;</p>
            <h1 class="style1">ثبت آبادی جدید برای مرکز </h1>
    <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
      <?php
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../login/config.php');
$query = "SELECT * FROM list_abadi WHERE id_mar='".$id_mar."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city=$row['city'];
?>
</P>
<div align="right" class="LinkRedTitle" style="margin-right:45px">
<form  method="post" action="list_request.php">
               <p>
                 <input type="hidden" name="id_mar" value="<?php echo $id_mar?>"/>
                 <input type="submit" name="submit" id="submit" style="height:30px"value=" مشاهده درخواست های قبلی"  title="جهت مشاهده درخواست های خود کلیک کنید "/>
                 <br />
               </p>
             </form>    
             </div>
<form id="form1" name="form1" action="" method="post">
  <table width="50%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="63" bgcolor="#006633" class="text1">انتخاب آبادی جدید </td>
    </tr>
    <tr>
      <td width="54%" height="79"><select name="add_abadi" id="select" class="required style8" dir="rtl"  style="width:250px ; height:30px">
        <option value="">انتخاب نام آبادی</option>
        <?php
include('../login/config.php') ; 
$query3 = "SELECT * from list_abadi where city = '$city' and id_mar <> '$id_mar' ORDER BY abadi ASC ";
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
 foreach($stmt3 as $row3){
echo '<option dir=rtl  class=style8 value='.$row3['add_abadi'].'>'.$row3['abadi'] .'</option>';
}
?>
      </select></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>
    <input type="hidden" name="ostan" value="<?php echo $row['ostan'] ;?>">
   <input type="hidden" name="city" value="<?php echo $row['city'] ;?>">
   <input type="hidden" name="markaz" value="<?php echo $row['mar'] ;?>">
   <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>">
   <input type="submit" name="action" value="ثبت درخواست" style="width:150px ; height:45px" tabindex="39" />
</p>
</form>
<p>&nbsp;</p>
            <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>       
            <!-- Tabs -->
    </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php
if (isset($_POST['action'])) 
 {  

 function alert($string)
{
    echo '<script type="text/javascript">alert("' . $string . '");</script>';
}
  $ostan = $_POST['ostan'] ; 
  $city = $_POST['city'] ; 
  $mar = $_POST['markaz'] ;  
  $id_mar = $_POST['id_mar'] ; 
  $add_abadi = $_POST['add_abadi'] ; 
// echo abadi_name($add_abadi); 
  $status = '1' ; 
  $no_request ='4' ; 
  $date_edit ; 
$id_abadi = substr($add_abadi,13,6) ;
$query3 = "SELECT * FROM  public_abadi  where id_abadi = $id_abadi " ;
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
$abadi = $row3['abadi'] ;
 $query = "INSERT INTO change_mor(ostan,city,id_mar,mar,abadi,add_abadi,no_request,date_s,status) VALUES (:ostan,:city,:id_mar,:mar,:abadi,:add_abadi,:no_request,:date_s,:status)";
$q = $dbh->prepare($query);
$q->execute(array(':ostan'=>$ostan,':city'=>$city,':id_mar'=>$id_mar,':mar'=>$mar,':abadi'=>$abadi,':add_abadi'=>$add_abadi,':no_request'=>$no_request,':date_s'=>$date_edit,':status'=>$status));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ثبت درخواست آبادی جدید ') ; 
alert('درخواست شما پس از تایید مدیر شهرستان اعمال خواهد شد ') ;
?>
<form name="myform" class="myform" method="post" action="list_request.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
// end click update
 }
 ?>
