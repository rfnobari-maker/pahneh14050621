<?php 
include('../../lock_p3.php');
include('../../event.php');
$id_mar          = isset($_POST['id_mar'])    ? $_POST['id_mar']    : '';
$z_sal           = isset($_POST['z_sal'])        ? $_POST['z_sal']        : '';
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script>
function close_window() {
      close();
 }
</script>
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

-->
</style>
<style type="text/css">
#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
.report-title {
    font-size: 1.1rem;
    color: #2c3e50;
    margin-bottom: 15px;
    display: block;
    line-height: 1.6;
}

.report-title strong {
    color: #e74c3c;
    font-weight: bold;
}
</style>

</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
<p>
    <span dir="rtl" class="report-title">
    سوابق اطلاعات بررسی شده  مرکز جهاد کشاورزی: 
    <strong><?php echo htmlspecialchars(mar_name($id_mar), ENT_QUOTES, 'UTF-8'); ?></strong>
     در سال زراعی <strong ><?php echo htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8'); ?></strong>
</span>
            <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['id_mar'])) 
 {  
 if ($id_mar == '')   {$v_id_mar =1;}else{ $v_id_mar = "id_mar = '$id_mar'" ;}
 include('../../login/config.php') ; 
 $query = "SELECT app_date ,app_result ,app_comment from Agri_approved
 where $v_id_mar and z_sal = '$z_sal' and app_level = '2' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
            <table align="center" class="my-table" >
              <tr align="center" class="text1">
                <td bgcolor="#006699">دلایل عدم تایید </td>
                <td width="9%" bgcolor="#006699">نتیجه بررسی </td>
                <td width="12%" bgcolor="#006699">تاریخ بررسی </td>
                <td width="5%" bgcolor="#006699">ردیف</td>
              </tr>
             <tr>
               <?php
$r = 1 ; 
 foreach($stmt as $row){

 $app_date = $row['app_date'] ;
 $app_result = $row['app_result'] ;
 if ($app_result == '1') $v_app_result = 'تایید شد'  ; else $v_app_result = 'تایید نشد' ; 
 $app_comment = $row['app_comment'] ;
?>
               <td width="10%" height="40"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $app_comment ;?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $v_app_result ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $app_date ;?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
         </table>
             <?php
}
}
?>
         </table>
           
           <p> <button  id="send" class="btn-33"  onclick="close_window()">بازگشت</button></p></p>  </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>