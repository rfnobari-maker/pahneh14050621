<?php
include('../../../lock_p2.php');
include('../../../login/config.php');
include('../../../event.php');
include('../../../prof/cod_m.php') ;
$id = $_POST['id'];
$m_poul = $_POST['m_poul'];
$cod_m = $_POST['cod_m'];
$add_abadi = $_POST['add_abadi'];
$add_city  = $_POST['add_city'];
if(strlen($add_city < 5 )) $m_poul = 'abadi' ; 
if(strlen($add_abadi< 5)) $m_poul = 'shahr' ; 
?>
<?php
// کیلک دکمه ادامه 
if (isset($_POST['action'])) 
 {  
$m_poul = $_POST["m_poul"]; 
$id = $_POST["id"]; 
if ($m_poul=='') $mess='موقعیت بهره برداری را تعیین کنید '.'<p>' ;
$add_city = $_POST["add_city"]; 
if ($m_poul=='shahr' and $add_city=='') $mess.='نام شهر را انتخاب کنید'.'<p>' ;
$add_abadi = $_POST["add_abadi"]; 
if ($m_poul=='abadi' and $add_abadi=='') $mess.='نام آبادی را انتخاب کنید'.'<p>' ;

$cod_m = $_POST['cod_m'];
if ($cod_m=='') $mess.='کد ملی را وارد کنید'.'<p>' ;
if ((isset($_POST['action'])) and ($mess==''))
{
$query = "SELECT id from bah where bah_cod_m = '$cod_m'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
?>
	 <form name="myform1" class="myform" method="post" action="Eworkerdata_edit.php">
           <input type="hidden" name="cod_m" value="<?php echo $cod_m ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
    </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="../reza_1.css">
    <link href="../radio.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../prof/Agri/jquery-1.11.3-jquery.min.js"></script>
<script src="../../../15_files/jquery.js" type="text/javascript"></script>
<script src="../../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../../15_files/messages_fa.js" type="text/javascript"></script>
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
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../../files/images/header.jpg" width="100%" height="149" /></td>
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

           <p class="style8">ویرایش اطلاعات مددکار / تسهیلگر</p><a name="1" id="1"></a>
           <p><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div id="div">
             <div id="mess"><?php echo $mess ?>
              </div>
             <form  id="reg-form" method="post" action="#1">
               <table width="100%" height="97" border="0">
               <tr>
                 <td width="38%" height="93"><p style="text-align: right">
                   <?php if ($m_poul == 'shahr') { ?>
                   <select  name="add_city" class="input_text"  style="width:170px ; height:40px" dir="rtl"   onchange="this.form.submit()" >
                     <option value="" >انتخاب نام شهر</option>
                     <?php
$query = "SELECT  add_city,shahr FROM list_city WHERE  id_mar = '$id_mar' ORDER BY BINARY shahr"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                     <?php }?>
                                     </select>
                   <?php }?>
                     
                   <?php if ($m_poul == 'abadi') { ?>
                   <select dir="rtl"  name="add_abadi"  class="input_text" style="width:170px ; height:40px"  onchange="this.form.submit()" >
                     <option value="" >انتخاب نام آبادی</option>
                     <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE id_mar = '$id_mar' ORDER BY BINARY abadi"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                     <?php }?>
                   </select>
                   <?php }?>
                 </p></td>
                 <td width="20%"><?php if ($m_poul == 'shahr') { ?>
                   : نام شهر
                   <?php } 
                            if ($m_poul == 'abadi') { ?>
                   : نام آبادی
                   <?php }
				   	  ?></td>
                 <td width="18%"><p style="text-align: right">شهر
                   <input type="radio"  class="green" name="m_poul" <?php if ($m_poul == 'shahr') { ?>checked='checked' <?php } ?> value="shahr" onChange="autoSubmit();" />
                 </p>
                   <p style="text-align: right"> آبادی
       
                     <input type="radio" class="green" name="m_poul" <?php if ($m_poul == 'abadi') { ?>checked='checked' <?php } ?> value="abadi" onChange="autoSubmit();" />
                  </p></td>
                 <td width="24%" class="normalTextSmall"> : موقعیت بهره برداری<span style="text-align: right">
                      </span></td>
               </tr>
             </table>
    <input type="hidden" name="cod_m" value="<?php echo $cod_m ;?>" />
             </form>
             <form id="form" name="form1" action="" method="post" >
               <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
   <td width="18%" height="68" align="right">   <div align="right">
                      <input name="cod_m" type="text"  class="required" value="<?php echo $cod_m ;?>" maxlength="10" readonly/>
   </div> </td>
                   <td width="31%"><div align="right"> : کد ملی مددکار / تسهیلگر</div></td>
                 </tr>
                 <tr>
                   <td height="107"  colspan="2">
                     <input name="action" type="submit" class="style8" value="ادامه"  />
                     <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
                     <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                     <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                     <input type="hidden" name="id" value="<?php echo $id ;?>" />
                   </tr>
               </table>
          </form>
          </div>
           <p><a href="liste_Eworker.php" title="برگشت به صفحه قبل"><img src="../../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
