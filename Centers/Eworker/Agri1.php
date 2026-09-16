<?php
include('../../lock_p2.php');
include('../../login/config.php');
include('../../event.php');
include('../../cod_m.php') ;
if (isset($_POST['action1'])) 
 {
$bah_cod_m = $_POST['bah_cod_m'];
echo $bah_cod_m  ; 
?>
<form name="myform" class="myform" method="post" action="../benef.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
 <?php
 }
if(isset($_POST["add_abadi"]))
{ 
$add_abadi = $_POST["add_abadi"]; 
}
 if (isset($_POST['action'])) 
 {  
$add_abadi = $_POST["add_abadi"]; 
if ($add_abadi=='') $mess.='نام آبادی را انتخاب کنید'.'<p>' ;
$bah_cod_m = $_POST['bah_cod_m'];
if ($bah_cod_m=='') $mess.='کد ملی را وارد کنید'.'<p>' ;
if ($bah_cod_m<>'' & check_code_melli($bah_cod_m)<>1)  $mess.='کد ملی وارد شده صحیح نیست' ; 
if ((isset($_POST['action'])) and ($mess==''))
{
$query = "SELECT * from bah where bah_cod_m = '$bah_cod_m'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
if ($count_codm==0) 
{
$mess='اطلاعات بهره بردار یافت نشد ' ; 
$not_found_bah= true ;
}
else 
{
$query = "SELECT cod_m from Eworker where cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
if ($count_codm>0) { 
$mess='اطلاعات مدد کار ترویجی قبلاً در سامانه ثبت شده است' ; 
}
if ($mess=='') { 
?>
	 <form name="myform1" class="myform" method="post" action="Agri_data1.php">
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
    </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
}
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="reza.css">
    <link href="../../prof/radio.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>
<script src="../../15_files/jquery.js" type="text/javascript"></script>
<script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
<script>
function autoSubmit()
{
    var formObject = document.forms['reg-form'];
    formObject.submit();
}
</script>
<!--style the error message--> 
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
</style> 
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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

           <p class="style8">ثبت اطلاعات مدد کار ترویجی </p><a name="1" id="1"></a>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div id="div">
             <div id="mess"><?php echo $mess ?>
              </div>
             <form id="form" name="form1" action="" method="post" >
             <table width="100%" height="252" border="0">
               <tr>
                 <td width="69%" height="66"><p style="text-align: right">
                   <select dir="rtl"  name="add_abadi"  class="input_text" style="width:170px ; height:40px"   >
                     <option value="" >انتخاب نام آبادی</option>
                     <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE  id_mar = '$id_mar' ORDER BY BINARY abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                     <?php }?>
                     </select>
                 </p></td>
                 <td width="31%" class="normalTextSmall"> :انتخاب نام آبادی</td>
               </tr>
            
                                  <tr>
   <td width="69%" height="69" align="right">   <div align="right">
                      <input name="bah_cod_m"   type="text" maxlength="10" value="<?php echo $bah_cod_m ;?>"/>
   </div> </td>
                   <td width="31%"><span class="normalTextSmall">:کد ملی مددکار</span></td>
                 </tr>
                 <tr>
                   <td height="107"  colspan="2">
                     <input name="action" type="submit" class="style8" value="ادامه"  />
                  </tr>
               </table>
          </form>
          </div>
           <p><a href="../index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
