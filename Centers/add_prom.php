<?php
include("../lock_p2.php");
 ?> 
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
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php'); ?>
 <p align="center" class="style8" >ثبت  اطلاعات مروج جديد مرکز </p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
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
?>

	    <form action="" method="post" id="form1" name="form1">
 <table width="850" border="0" cellpadding="0" cellspacing="0">
   <tr>
     <td width="293" height="61" class="input_text"><div align="right">
       <input name="last_name" type="text" class="required input_text" style="width:150px; height:30px ; " dir="rtl" lang="fa"  maxlength="100" xml:lang="fa" tabindex="2" />
       </div></td>
     <td width="120"><div align="right">:نام خانوادگی</div></td>
     <td width="37">&nbsp;</td>
     <td width="241"><div align="right">
       <input name="name" type="text" class="required input_text" style="width:150px; height:30px ; " dir="rtl" lang="fa"  maxlength="100" xml:lang="fa" tabindex="1" />
       </div></td>
     <td width="137"><div align="right">:نام</div></td>
   </tr>
   <tr>
     <td height="38">&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td><div align="right">
       <input name="cod_m" type="text" class="required input_text" id="cod_m" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa"  maxlength="100" xml:lang="fa" />
     </div></td>
     <td><div align="right" >:کد ملی </div></td>
   </tr>
 </table>
 <div align="center">
   <p>&nbsp;     </p>
   <p>
   <input type="hidden" name="ostan" value="<?php echo $row['ostan'] ;?>">
   <input type="hidden" name="city" value="<?php echo $row['city'] ;?>">
   <input type="hidden" name="markaz" value="<?php echo $row['mar'] ;?>">
   <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>">
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="5" value="ثبت کاربر " />
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
</table>
	</p></td>
        </tr>
</table></body>
</body>
</html>
<?php
if (isset($_POST['action'])) 
 {  
  $ostan = $_POST['ostan'] ; 
  $city = $_POST['city'] ; 
  $mar = $_POST['markaz'] ; 
  $id_mar = $_POST['id_mar'] ; 
  $name = $_POST['name'] ; 
  $last_name = $_POST['last_name'] ; 
  $mor_codm_old = $_POST['cod_m'] ; 
  $status = '1' ; 
  $no_request ='5' ; 
include('../login/config.php');
$query = "INSERT INTO change_mor (ostan,city,id_mar,mar,mor_codm_old,name,Last_name,no_request,date_s,status) VALUES (:ostan,:city,:id_mar,:mar,:mor_codm_old,:name,:Last_name,:no_request,:date_s,:status)";
$q = $dbh->prepare($query);
$q->execute(array(':ostan'=>$ostan,':city'=>$city,':id_mar'=>$id_mar,':mar'=>$mar,':mor_codm_old'=>$mor_codm_old,':name'=>$name,':Last_name'=>$last_name,':no_request'=>$no_request,':date_s'=>$date_edit,':status'=>$status));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','ثبت درخواست مروج جدید ') ; 
alert('درخواست شما پس از تایید مدیر شهرستان اعمال خواهد شد ') ;
?>
<form name="myform" class="myform" method="post" action="list_request.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
// end click update
 }
 ?>
