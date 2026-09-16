<?php
include('../../lock_expsh.php');
include('../../event.php');
// Enter these 3 parameters:
$identCode = $_POST["identCode"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="reza_1.css">
<style type="text/css"> 
.error { 
    display: block; 
    color: red; 
    font-style: italic; 
} 
#message { 
    display:none; 
    font-size:15px; 
    font-weight:bold; 
    color:#333333; 
}
#div{
background-color:#FFF;
color:#036;
border-radius:15px;
border:1px solid #d3cd3d;
padding:4px 30px;
font-weight:700;
width:400px;
font-size:12px;
height:auto;
margin:auto
}
} 
</style> 
</head>
<body>
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
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
  <?php include('top.php'); ?>
    <td width="840" >
           <p class="style8">استعلام مشخصات مدیر عامل</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><?php
// Enter these 3 parameters:
$webservice_url = "http://172.17.18.40:/GetPersonInfo/GetingPersonByNationalIdAndBirthDate.asmx?wsdl";
$username = "poudadmin";
$password = "6ae390lm";
?>
             <span class="style8"><span class="normalTextSmall"><span class="style21"><a name="1" id="13"></a></span></span></span></p>
           <div id="div">
           <div  align="center" style="margin-top:10px; font-family:tahoma; font-size:16px">
<form action="" method="post">
	<p>
	  <input type="text" name="birthdate" style="font-size:16px ; color:#06C ; font-family:tahoma; width:120px ; height:35px"> 
	  : تاریخ    تولد مدیر عامل<br />
	  <span class="style8"> مثال : 13520312</span><br>
	  </p>
	<p><br>
	  <input type="text" name="nationalid" style="font-size:16px ; color:#06C ; font-family:tahoma; width:120px ; height:35px">
	  : کد ملی مدیرعامل<br>
	  </p>
	<p><br>
	  <input type="hidden" name="identCode" value=<?php echo $identCode; ?> />
	  <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="ادامه">
	  </p>
</form>
</div>
<?php
if (isset($_POST['go'])) {
	$client = new SoapClient($webservice_url);
	$res = $client->GetPersonInfo(array("userName" => $username , "passWord" =>$password , "NationalId" =>$_POST['nationalid'], "BirthDate" =>$_POST['birthdate']));
	//echo '<pre dir="ltr">';print_r($res);echo '</pre>';
	if ($res->GetPersonInfoResult->status==Okay) { ;
    $c_cod_m = $_POST['nationalid'] ; 
	$c_f_name = $res->GetPersonInfoResult->firstName;
	$c_l_name = $res->GetPersonInfoResult->lastName;
	$identCode = $_POST["identCode"];
	if ($res->GetPersonInfoResult->lifeStatus==1) 
	{
    alert('این فرد قبلا فوت شده است ') ;
	}
else 
{
       ?>
     <form  name="myform" class="myform" method="post" action="ind_unit_data.php">
     <input type="hidden" name="identCode" value=<?php  echo $identCode; ?> />
     <input type="hidden" name="c_cod_m"   value=<?php  echo $c_cod_m; ?> />
     <input type="hidden" name="c_f_name"  value="<?php  echo $c_f_name; ?>" />
     <input type="hidden" name="c_l_name"  value="<?php  echo $c_l_name ; ?>" />
      </form>
      <script type="text/javascript">document.myform.submit();</script>
                    <?php
	}
	}
	else 
	{
		echo 'فردی با مشخصات وارد شده  یافت نشد' ;
	}
	echo '</div>';
}
?>
</div>
</p>
           <p>&nbsp;</p>
           <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
