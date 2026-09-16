<?php 
include('../../event.php');
include('../../login/config.php') ;
 $group_cod = $_POST['group_cod'] ;
 $protocol_cod1 = $_POST['protocol_cod1'] ;
 $protocol_cod2 = $_POST['protocol_cod2'] ;
 $protocol_cod3 = $_POST['protocol_cod3'] ;
 $protocol_cod4 = $_POST['protocol_cod4'] ;
 $protocol_cod5 = $_POST['protocol_cod5'] ;
 $t_j = $_POST['t_j'] ;
 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <span class="style8">ثبت پروتکل  </span>
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="410" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">&nbsp;</td>
                 <td width="214" height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <select  name="group_cod" class="input_text" id="id_ostan" style="width:250px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="-1">گروه</option>
                     <?php
$query = "SELECT  group_name,group_cod FROM protocol  group by Group_cod ORDER BY group_cod "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$group_cod) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                     <?php 
		   }?>
                     </select>
                   <?php 
				   if (isset($_POST['group_cod']))
 $protocol_cod = $_POST['protocol_cod'] ;


?></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: گروه</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="47" colspan="2" align="right" bgcolor="#FFFFFF" class="style1" ><div align="right">
                   <select  name="protocol_cod1" class="input_text" id="protocol_cod" style="width:370px ; height:40px" dir="rtl"  >
                      <option value="">انتخاب پروتکل</option>
                     <?php
$query = "SELECT  protocol_name,protocol_cod FROM protocol where group_cod = $group_cod ORDER BY protocol_cod "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['protocol_cod'] ;?>"
   <?php if ($row['protocol_cod']==$protocol_cod1) echo 'selected=selected'?>> <?php echo $row['protocol_name'] ;?></option>
                     <?php 
		   }?>
                     </select>
                   </div>
                   <?php 
				   if (isset($_POST['protocol_cod']))
 $protocol_cod = $_POST['protocol_cod'] ;
?></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :پروتکل 1</font></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="47" colspan="2" align="right" bgcolor="#FFFFFF" class="style1" ><div align="right">
                   <select  name="protocol_cod2" class="input_text" id="protocol_cod2" style="width:370px ; height:40px" dir="rtl" >
                      <option value="">انتخاب پروتکل</option>
                     <?php
$query = "SELECT  protocol_name,protocol_cod FROM protocol where group_cod = $group_cod ORDER BY protocol_cod "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['protocol_cod'] ;?>"
   <?php if ($row['protocol_cod']==$protocol_cod2) echo 'selected=selected'?>> <?php echo $row['protocol_name'] ;?></option>
                     <?php 
		   }?>
                   </select>
                 </div>
                   <?php 
				   if (isset($_POST['protocol_cod']))
 $protocol_cod = $_POST['protocol_cod'] ;
?></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :پروتکل 2</font></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="47" colspan="2" align="right" bgcolor="#FFFFFF" class="style1" ><div align="right">
                   <select  name="protocol_cod3" class="input_text" id="protocol_cod4" style="width:370px ; height:40px" dir="rtl" >
                     <option value="">انتخاب پروتکل</option>
                     <?php
$query = "SELECT  protocol_name,protocol_cod FROM protocol where group_cod = $group_cod ORDER BY protocol_cod "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['protocol_cod'] ;?>"
   <?php if ($row['protocol_cod']==$protocol_cod3) echo 'selected=selected'?>> <?php echo $row['protocol_name'] ;?></option>
                     <?php 
		   }?>
                   </select>
                 </div>
                   <?php 
				   if (isset($_POST['protocol_cod']))
 $protocol_cod = $_POST['protocol_cod'] ;
?></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :پروتکل 2</font></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="47" colspan="2" align="right" bgcolor="#FFFFFF" class="style1" ><div align="right">
                   <select  name="protocol_cod4" class="input_text" id="protocol_cod4" style="width:370px ; height:40px" dir="rtl"  >
                     <option value="">انتخاب پروتکل</option>
                     <?php
$query = "SELECT  protocol_name,protocol_cod FROM protocol where group_cod = $group_cod ORDER BY protocol_cod "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['protocol_cod'] ;?>"
   <?php if ($row['protocol_cod']==$protocol_cod4) echo 'selected=selected'?>> <?php echo $row['protocol_name'] ;?></option>
                     <?php 
		   }?>
                   </select>
                 </div>
                   <?php 
				   if (isset($_POST['protocol_cod']))
 $protocol_cod = $_POST['protocol_cod'] ;
?></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :پروتکل 4</font></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="47" colspan="2" align="right" bgcolor="#FFFFFF" class="style1" ><div align="right">
                   <select  name="protocol_cod5" class="input_text" id="protocol_cod5" style="width:370px ; height:40px" dir="rtl"  >
                     <option value="">انتخاب پروتکل</option>
                     <?php
$query = "SELECT  protocol_name,protocol_cod FROM protocol where group_cod = $group_cod ORDER BY protocol_cod "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['protocol_cod'] ;?>"
   <?php if ($row['protocol_cod']==$protocol_cod5) echo 'selected=selected'?>> <?php echo $row['protocol_name'] ;?></option>
                     <?php 
		   }?>
                   </select>
                 </div>
                   <?php 
				   if (isset($_POST['protocol_cod']))
 $protocol_cod = $_POST['protocol_cod'] ;
?></td>
                 <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :پروتکل 5</font></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="47" colspan="2" align="right" bgcolor="#FFFFFF" class="style1" ><div align="right">
                   <input name="t_j" type="text" class="input_text" id="t_j"  style="height:35px ; width:50px " value="<?php echo $t_j?>" />
                 </div>                   
                   <?php 
				   if (isset($_POST['protocol_cod']))
 $protocol_cod = $_POST['protocol_cod'] ;
?></td>
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :تعداد جلسات</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='درج در لیست ' />
                   </td>
               </tr>
             </table> 
           </div>
 </form>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
    
    </tr>
</table>
</table>
</body>
</html>