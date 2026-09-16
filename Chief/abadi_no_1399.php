<?php include('../lock_ce.php');
include('counter.php');
$id_ostan = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
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
<script>
    function target_popup3(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=1000,height=600"); 
    form.target = 'formpopup'; 
	}
   </script>

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
  <p class="style1"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 500px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style1">لیست آبادی های غیر فعال </span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#F1F1F1" class="input_text" ><form method="post" name="form1" id="form"  action="">
          <select dir="rtl"  name="id_ostan" id="id_ostan" style="width:170px ; height:40px"  onchange="this.form.submit()">
            <option value="">انتخاب استان</option>
            <?php
$query = "SELECT  id_ostan,ostan FROM ostanname ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php 
		   }?>
          </select>
        </form>
          <?php if (isset($_POST['id_ostan']))
 $id_ostan = $_POST['id_ostan'] ; 
?></td>
        <td width="163"><font size="2" class="style8">: استان</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#F1F1F1" class="input_text" ><form method="post" name="form1" id="form2"  action="#1">
          <select dir="rtl"  name="id_city" id="id_city" style="width:170px ; height:40px"  onchange="this.form.submit()">
            <option value="0">انتخاب شهرستان</option>
            <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' ORDER BY BINARY city ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
            <?php 
		   }?>
          </select>
          <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
        </form>
          <?php if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
        <td><font size="2" class="style8">: شهرستان</font></td>
      </tr>
      <tr >
        <td height="29" align="center" bgcolor="#FFFFFF" class="input_text" >
          <form method="post" name="form3" id="form3"  action="#1">
            <p>
              <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
              <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
              <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
              </p>
          </form></td>
        <td height="29" align="center" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
      </tr>
      </table>
</div>

  <p>
  <?php if(isset($_POST['action']))
{
$id_city = $_POST['id_city'] ; 
if ($id_ostan == '') { $v_id_ostan = 1 ;} else { $v_id_ostan = "public_abadi4.id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 1 ;} else { $v_id_city = "public_abadi4.id_city='$id_city'" ;}
// $query = "SELECT * FROM  list_abadi where  $v_id_ostan and  $v_id_city and $v_id_mar"  ;
 $query = "SELECT * FROM public_abadi_no_1399 WHERE 1 " ;

$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span></p>
  <table width="90%" height="96" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="style8">
    <td width="27%" height="41" bgcolor="#CCCCCC">کد  آبادی</td>
    <td width="19%" bgcolor="#CCCCCC">نام آبادی</td>
    <td width="20%" bgcolor="#CCCCCC">دهستان</td>
    <td width="16%" bgcolor="#CCCCCC">شهرستان </td>
    <td  bgcolor="#CCCCCC">استان</td>
    <td width="8%" bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = $start+1 ;
 foreach($stmt as $row){
?>
<td height="55" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo '"'.$row['id_abadi'].'"';?></td>
     <td class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['deh'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['city'];?></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['ostan'];?></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
}
?>
</table>
  <p>&nbsp;</p><p><a href="cities&villages.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>


