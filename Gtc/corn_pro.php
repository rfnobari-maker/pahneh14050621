<?php include('../lock_df.php');
include_once ('../event.php') ; 
$id_ostan1 = $_POST['id_ostan1'] ;
$id_city1 = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
$date_s1 = $_POST['date_s1'] ; 
$date_s2 = $_POST['date_s2'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<script src="../15_files/jquery-1.9.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../15_files/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $.mask.definitions['~'] = "[+-]";
        $("#date").mask("9999/99/99",{placeholder:"____/__/__"});
    	 $("#date2").mask("9999/99/99",{placeholder:"____/__/__"});
    });
</script>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    </style>

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
    <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
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

  <div style=" width: 500px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1 ; border-radius:10px" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#F1F1F1"><span class="style1">گزارش بهره برداری های تولید کننده ذرت دانه ای </span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#FFFFFF" class="input_text" ><form method="post" name="form1" id="form"  action="">
        <select dir="rtl"  name="id_ostan1" id="id_ostan" style="width:170px ; height:40px"  onchange="this.form.submit()">
            <option value="-1">انتخاب استان</option>
            <?php
$query = "SELECT DISTINCT id_ostan,ostan FROM `public_abadi4` ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php 
		   }?>
          </select></form>
          <?php $id_ostan1 = $_POST['id_ostan1']?>
                 </td>
        <td bgcolor="#FFFFFF"><font size="2" class="style8">: استان</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#F1F1F1" class="input_text" ><form method="post" name="form1" id="form2"  action="#1">
          <select dir="rtl"  name="id_city" id="id_city" style="width:170px ; height:40px"  onchange="this.form.submit()">
            <option value="0">انتخاب شهرستان</option>
            <?php
$query = "SELECT DISTINCT id_city,city FROM `list_abadi` WHERE  `id_ostan` = $id_ostan1"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city1) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
            <?php 
		   }?>
          </select>
          <input name="id_ostan1" type="hidden" value="<?php echo $id_ostan1 ;?>" />
        </form>
          <?php if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
        <td><font size="2" class="style8">: شهرستان</font></td>
      </tr>
      <tr >
        <td height="23" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" ><form method="post" name="form3" id="form3"  action="#1">
          <p>
            <select dir="rtl"  name="id_mar" id="bakh" style="width:170px ; height:40px">
              <option value="0"> نام مرکز</option>
              <?php
$query = "SELECT DISTINCT id_mar,mar FROM `mar` WHERE  `id_ostan` = '$id_ostan1' and `id_city` = '$id_city'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
              <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
              <?php }?>
            </select>
          </p>
          <p>
            <input name="date_s2" type="text" id="date2" style="width:100px ; height:35px" tabindex="5" value="<?php echo $date_s2?>" />
            <span class="style8">: تا 
تاریخ              </span>
            <input name="date_s1" type="text" id="date" style="width:100px ; height:35px" tabindex="4" value="<?php echo $date_s1?>" />
          </p>
          <p>
            <input name="id_ostan1" type="hidden" value="<?php echo $id_ostan1 ;?>" />
            <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
            <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          </p>
        </form></td>
               <td width="163" valign="top" height="36"  align='center' bgcolor="#FFFFFF" class="style8"><p><font size="2" class="style8">: مرکز خدمات</font></p>
          <p><font size="2" class="style8">آخرین ویرایش<br />
            : از تاریخ</font></p></td>
      </tr>
      <tr >
        <td height="29"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
      </tr>
    </table>
  </div>
  <p>
  <?php if(isset($_POST['action']))
{
?>
<form  name="myform" class="myform" method="post" action="Corn_prod2_xls.php">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city1" value="<?php echo $id_city1 ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ;?>" />
        <input type="hidden" name="date_s1" value="<?php echo $date_s1 ;?>" />
        <input type="hidden" name="date_s2" value="<?php echo $date_s2 ;?>" />
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
  </table>
  <p>&nbsp;</p><p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>