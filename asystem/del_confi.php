<?php include('../lock_admin.php');
include('../event.php') ;
 $id_ostan1 = $_POST['id_ostan'] ;
 $cod_city  = $_POST['cod_city'] ;
 $id_mar    = $_POST['id_mar'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
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
</style>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
  <p>
    <?php 
include('top.php'); 
include ('../login/config.php');
?>
  </p>
  <p class="style1"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
  حذف تایید مدیر شهرستان و رئیس مرکز
برای سرشماری زنبورستان ها </p>
      <form  id="reg-form" method="post" action="#1">
  <div style="width: 500px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <table width="100%" height="207" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td width="63%" height="41" align="right" bgcolor="#DDDDDD" class="input_text" >
          <select  name="id_ostan"  class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
            <?php
$query = "SELECT id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php 
		   }?>
            </select>
          <?php 
?></td>
        <td width="37%"  align='center' bgcolor="#DDDDDD" class="style8">: استان<span class="style1"><a name="1" id="12"></a></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td align="right" bgcolor="#FFFFFF" class="input_text" >
         <select dir="rtl"  name="cod_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
           <option value="0"> ---</option>
           <?php
//$id_ostan = '03' ;
$query = "SELECT id_city,city FROM cityname WHERE  id_ostan = $id_ostan1"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
           <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$cod_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
		   <?php 
		   }?>
         </select>
           <?php if (isset($_POST['cod_city']))
 $cod_city = $_POST['cod_city'] ; 
?>
</td>
        <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
      </tr>
      <tr >
        <td height="42" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
          <option value="0"> نام مرکز</option>
          <?php
$query = "SELECT  id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan1' and id_city = $cod_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
          <?php }?>
          </select>
          <?php
                 				   if (isset($_POST['id_mar']))
  $id_mar = $_POST['id_mar'] ; 
				 ?>
          <input name="id_city" type="hidden" value="<?php echo $cod_city ;?>" /></td>
        <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
      </tr>
      <tr >
        <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
      </tr>
    </table>
  </div>
   </form>
  <p>
  <?php if(isset($_POST['action']))
{
 if ($id_ostan1 == '-1')    { $v_id_ostan   = 1 ;}else{ $v_id_ostan  = "id_ostan='$id_ostan1'" ;}
                                                        $v_id_city   = "id_city='$cod_city'" ;
 if ($id_mar  == 0)         { $v_id_mar     = 1 ;}else{ $v_id_mar    = "id_mar='$id_mar'" ;}
 $query = "UPDATE users SET con_center='' , date_con_center = '' , con_city = '' , date_con_city = '' where $v_id_ostan and $v_id_city and $v_id_mar ";
 $stmt = $dbh->prepare($query);
 $stmt->execute();
alert('تایید مدیر شهرستان و رئیس مرکز حذف شد ') ; 
}
?>
  <p><a href="../oChief/Poultry/index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
