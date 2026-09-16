<?php
require_once("../lock_ce.php");
require_once("../event.php");
require_once('side_menu1.php');
include ('../web/sms1.php');
include_once('../login/config.php');

$id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : null;
$id_city  = isset($_POST['id_city']) ? $_POST['id_city'] : null;
$s_access = isset($_POST['s_access']) ? $_POST['s_access'] : null;
$id_mar   = isset($_POST['id_mar']) ? $_POST['id_mar'] : null;

 if ($s_access != '00')   { $V_s_access = "s_access = '$s_access'  and chief =''" ;} else { $V_s_access = "s_access = '4' and chief='1'" ;}
 if ($id_ostan == '-1')   { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}


    // --- ارسال SMS گروهی ---
    $message = trim($_POST['message']);
    if (strlen($message) >= 10) {
    
    $query = "SELECT tel_m from users where  $V_s_access and $v_id_ostan and $v_id_city and $v_id_mar  ";
$stmt = $dbh->prepare($query);
$stmt->execute();

        $success_count = 0;
        $fail_count = 0;

foreach($stmt as $row){
	
	            $tel_m = preg_replace('/\D/', '', $row['tel_m']);
            if (strlen($tel_m) == 10) {
                $tel_m = '0' . $tel_m;
            }
            if (strlen($tel_m) == 11) {
                $uid = uniqid();
                sendSMS($tel_m, $message . '(سامانه پهنه بندی/فرستنده : ' . $PersName . ')', $uid);
                $success_count++;
            } else {
                $fail_count++;
            }
        }

        $mess .= "<br>تعداد پیامک‌های موفق: {$success_count} | ناموفق: {$fail_count}";
    } else {
        $mess .= "<br>پیام ارسالی حداقل باید 10 کاراکتر باشد.";
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
    <style>
    #box
	{ box-shadow:10px 10px 5px #999 ; width:700px ; background-color:#CCC; 
	margin:auto; border:1px solid #003399  ; border-radius: 10px ;  
		}
   
   </style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
       <span class="style21"><a name="1" id="1"></a></span>ارسال پیام گروهی
<p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <p align="center" style="color:#900 ; font-family:Tahoma; font-size:12px" ><?php echo $mess ?></p>
	   <form action="#1" method="post" enctype="multipart/form-data" id="form1" name="form1" >
       <div id="box" style="margin-top:10px">
        <table width="100%" border="0" align="center">
          <tr>
            <td height="63"><span class="input_text"><div align="right" dir="rtl">
              <div align="right" dir="rtl">
                <select  name="id_ostan" class="style8" id="id_ostan" style="width:150px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <option value="-1">کلیه استان ها</option>
                  <?php
$query = "SELECT  id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                  <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                  <?php 
		   }?>
                </select>
                <select  name="id_city" class="input_text" id="id_city" style="width:150px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <option value="0"> کلیه شهرستان ها</option>
                  <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' ORDER BY BINARY city ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                  <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
                  <?php }?>
                </select>
                <select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                     <option value="0"> کلیه مراکز جهاد کشاورزی</option>
                     <?php
$query = "SELECT  id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan' and id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
                     <?php }?>
                     </select>
              </div>
            </div></td>
            <td width="113"><div align="right" style="margin-right:10px">: موقعیت </div></td>
          </tr>
          <tr>
            <td height="42"><div align="right" dir="rtl">
              <p>
                <select name="s_access" class="input_text" id="s_access" style="width:200px ; height:40px">
                  <option value="1"  <?php if ($s_access=='1') echo 'selected=selected'?>>کارشناس مسئول پهنه</option>
                  <option value="2" <?php if ($s_access=='2') echo 'selected=selected'?>>رئیس مرکز جهاد کشاورزی</option>
           <?php if ($id_mar=='0' or (!isset($_POST['id_ostan']))){ ?><option value="3" <?php if ($s_access=='3') echo 'selected=selected'?>>مدیر جهاد کشاورزی شهرستان</option> <?php }?>
           <?php if ($id_city=='0' or (!isset($_POST['id_ostan']))){ ?> <option value="4" <?php if ($s_access=='4') echo 'selected=selected'?>>مدیر استانی سامانه</option> <?php }?>
           <?php if ($id_city=='0' or (!isset($_POST['id_ostan']))){ ?> <option value="00" <?php if (($s_access=='4') && ($chief == '1')) echo 'selected=selected'?>>رئیس سازمان</option> <?php }?>
           <?php if ($id_ostan=='-1' or (!isset($_POST['id_ostan']))){ ?> <option value="5" <?php if ($s_access=='5') echo 'selected=selected'?>>کارشناسان معین استان</option> <?php }?>
           <?php if ($id_ostan=='-1' or (!isset($_POST['id_ostan']))){ ?> <option value="20" <?php if ($s_access=='20') echo 'selected=selected'?>>مدیر کشوری سامانه </option> <?php }?>
           <?php if ($id_city=='0' or (!isset($_POST['id_ostan']))){ ?> <option value="98" <?php if ($s_access=='98') echo 'selected=selected'?>>کاربر admin استان </option> <?php }?>
           <?php if ($id_ostan=='-1' or (!isset($_POST['id_ostan']))){ ?> <option value="99" <?php if ($s_access=='99') echo 'selected=selected'?>>خودم </option> <?php }?>
                  </select>
                </p>
              </div></td>
            <td><div align="right" style="margin-right:10px">: گروه </div></td>
          </tr>
   <tr>
     <td height="85"><div align="right">
       <textarea name="message"  class="required  input_text" id="textarea" cols="65" rows="7" dir="rtl"></textarea>
       </div></td>
     <td><div align="right" style="margin-right:10px" >:متن پیام</div></td>
   </tr>
        </table>
 <div align="center">
   <p>
     <input type="hidden" name="username" value="<?php echo $username ;?>" />
     <input type="hidden" name="s_user" value="<?php echo $login_session ;?>" />
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="5" value="ارسال پیام" />
   </p>
   </p>
 </div>
</div>
  </form> 
    </td>
  </tr>
 <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../files/bottom.gif">
      <?php include('../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>
