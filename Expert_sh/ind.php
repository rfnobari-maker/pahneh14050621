<?php
include('../lock_expsh.php');
include('../login/config.php');
include('cod_m.php') ;
///
$m_bah = "";
$add_abadi ="" ;
$add_city="";
$no_bah = "";
$bah_cod_m="";
if(isset($_POST["m_bah"]))
{ 
$m_bah = $_POST["m_bah"]; 
}
if(isset($_POST["add_abadi"]))
{ 
$add_abadi = $_POST["add_abadi"]; 
}
if(isset($_POST["add_city"]))
{ 
 $add_city = $_POST["add_city"]; 
}
if(isset($_POST["no_bah"]))
{ 
$add_abadi = $_POST["add_abadi"]; 
$add_city = $_POST["add_city"]; 
$m_bah = $_POST["m_bah"]; 
$no_bah = $_POST["no_bah"]; 
$bah_cod_m = $_POST["bah_cod_m"]; 
$date_t = $_POST["date_t"]; 
$s_bah = $_POST["s_bah"]; 


}
/////

$mess = '' ;
 if (isset($_POST['action'])) 
 {  
$m_bah = $_POST["m_bah"]; 
if ($m_bah=='') $mess='موقعیت بهره بردار را انتخاب کیند '.'<p>' ;
$add_city = $_POST["add_city"]; 
if ($m_bah=='shahr' and $add_city=='') $mess.='نام شهر را انتخاب کنید'.'<p>' ;
$add_abadi = $_POST["add_abadi"]; 
if ($m_bah=='abadi' and $add_abadi=='') $mess.='نام آبادی را انتخاب کنید'.'<p>' ;

$no_bah = $_POST["no_bah"]; 
if ($no_bah=='') $mess.='نوع بهره بردار را انتخاب کنید '.'<p>' ;
$bah_cod_m = $_POST['bah_cod_m'];
if ($bah_cod_m=='') $mess.='کد ملی را وارد کنید'.'<p>' ;
 //$mess = check_code_melli($cod_m) ; 
if (check_code_melli($bah_cod_m)<>1)  $mess.='کد ملی بهره بردار صحیح نیست' ; 
if ((isset($_POST['action'])) and ($mess==''))
{
 $query = "SELECT id from ind_bah where bah_cod_m = $bah_cod_m and no_bah='1'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
if ($no_bah=='1' and $count_codm>0) { $mess='اطلاعات بهره بردار قبلاٌ ثبت شده است ' ; }
else
{
?>
	      <form name="myform1" class="myform" method="post" action="ind_benef_data.php">
           <input type="hidden" name="m_bah" value="<?php echo $m_bah ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="no_bah" value="<?php echo $no_bah ;?>" />
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="date_t" value="<?php echo $date_t ;?>" />
           <input type="hidden" name="num_bah" value="<?php echo $count_codm+1 ;?>" />
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="reza_1.css">
    <link href="radio.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js-persian-cal.min.js"></script>
    <script type="text/javascript" src="../script.js"></script>
	<script src="../15_files/jquery.js" type="text/javascript"></script>
    <script src="../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
         //$("#form1").validate();
        });
    </script>
<script>
function autoSubmit()
{
    var formObject = document.forms['reg-form'];
    formObject.submit();
}
</script>
<script>
function autoSubmit1()
{
    var formObject = document.forms['no_bah'];
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
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
  <?php include('top.php'); ?>
    <td width="840" >

           <p class="style8">ثبت اطلاعات صاحبان مشاغل وابسته به بخش کشاورزی <span class="normalTextSmall"><span class="style21"><a name="1" id="13"></a></span></span> </p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
          <div id="div">
             <div id="mess"><?php echo $mess ?></div>
             <form  id="reg-form" method="post" action="#1">
             <table width="100%" height="97" border="0">
               <tr>
                 
                 <td width="38%" height="93">
                   <p style="text-align: right">
                     <?php if ($m_bah == 'shahr') { ?>
                     <select  name="add_city"  style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()" >
                       <option value="" >انتخاب نام شهر</option>
                       <?php
$query = "SELECT  add_city,shahr FROM list_city WHERE  id_ostan = '$id_ostan' and  id_city = '$id_city' ORDER BY BINARY city ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                       <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                       <?php }?>
                       </select>
                     <?php }?>
                     <?php if ($m_bah == 'abadi') { ?>
                     <select dir="rtl"  name="add_abadi"  class="required" style="width:170px ; height:40px"  onchange="this.form.submit()" >
                       <option value="" >انتخاب نام آبادی</option>
                       <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE id_ostan = '$id_ostan' and id_city = '$id_city' ORDER BY BINARY abadi ASC"   ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                       <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                       <?php }?>
                       </select>
                     <?php }?>
                    </td>
                 <td width="17%"><?php if ($m_bah == 'shahr') { ?>
                   : نام شهر
                   <?php } 
                            if ($m_bah == 'abadi') { ?>
                   : نام آبادی
                   <?php }
				   	  ?></td>
                 <td width="26%"><p style="text-align: right">شهر
                   <input type="radio"  class="red" name="m_bah" <?php if ($m_bah == 'shahr') { ?>checked='checked' <?php } ?> value="shahr" onChange="autoSubmit();" />
                   </p>
                   <p style="text-align: right"> آبادی
                     <input type="radio" class="red" name="m_bah" <?php if ($m_bah == 'abadi') { ?>checked='checked' <?php } ?> value="abadi" onChange="autoSubmit();" />
                    </p></td>
                 
                 <td width="19%" class="normalTextSmall"> : موقعیت بهره بردار</td>
               </tr>
             </table>
              </form>
             <form id="no_bah" method="post" action="">
             <table width="100%"  border="0">
               <tr>
                 
                 <td width="76%" >
                   <p style="text-align: right">
                     حقیقی
                     <input type="radio"  class="red" name="no_bah" <?php if ($no_bah == '1') { ?>checked='checked' <?php } ?> value='1' onChange="autoSubmit1();" />
                     <p style="text-align: right"> حقوقی
                       
                       <input type="radio" class="red" name="no_bah" <?php if ($no_bah == '2') { ?>checked='checked' <?php } ?> value='2' onChange="autoSubmit1();" />
                       <input type="hidden" name="m_bah" value="<?php echo $m_bah ;?>" />
                       <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                       <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
  </td>
                 <td width="24%" class="normalTextSmall"> :نوع بهره بردار</td>
               </tr>
               </table>
             </form>
             <form id="form1" name="form1" action="" method="post" >
               <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                 <tr>
   <td width="76%" align="right">   <div align="right">
   <?php if (isset($_POST['no_bah'])) {?>
   <input name="bah_cod_m"  class="required" type="text" value="<?php echo $bah_cod_m ;?>"/>
   <?php } ?>
   </div> </td>
                   <td width="24%"><?php
                 if ($no_bah=='1') echo ': کد ملی بهره بردار';
                 if ($no_bah=='2') echo ': کد ملی مدیر عامل';
				 ?></td>
                 </tr>
                 <tr>
                   <td height="119" align="right"><div align="right"><span class="style8">13520425: مثال</span>
                       <input name="date_t" type="text"  class="required digits" id="date_t" value="<?php echo $date_t ;?>"  maxlength="8" minlength="4"/>
                       <input type="hidden" name="m_bah" value="<?php echo $m_bah ;?>" />
                       <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                       <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                       <input type="hidden" name="no_bah" value="<?php echo $no_bah ;?>" />
                   </div></td>
                   <td><span class="normalTextSmall">:  تاریخ تولد</span></td>
                 </tr>
                 <tr>
                   <td height="107" colspan="2"><input name="action" type="submit" value="ادامه"  /></td>
                 </tr>
               </table>
              
              </form>
            </div>
           <p><a href="Industry.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
