<?php include('../lock_cp.php');
include('counter.php');
 $id_ostan1 = $_POST['id_ostan'] ;
$id_city1 = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
    <td width="4"><p>&nbsp;</p></td>
    <td width="840" >
  <p>
    <?php 
include('top.php'); 
include ('../login/config.php');
?>
  </p>
  <p class="style1">لیست آبادی غیرفعال </p>
  <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 500px; padding: 15px;border: 3px solid navy; margin:auto" >
    <table width="500" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFCC"><font size="2" class="style1">تعیین معیار جستجو </font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="66" align="right" bgcolor="#F1F1F1" class="input_text" ><form method="post" name="form1" id="form"  action="">
          <select dir="rtl"  name="id_ostan" id="id_ostan" style="width:170px ; height:40px"  onchange="this.form.submit()">
            <option value="-1">انتخاب استان</option>
            <?php
$query = "SELECT  id_ostan,ostan FROM ostanname ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php 
		   }?>
          </select>
        </form>
          <?php if (isset($_POST['id_ostan']))
 $id_ostan1 = $_POST['id_ostan'] ; 
?></td>
        <td width="163"  align='center' bgcolor="#F1F1F1" class="style1"><font size="2" class="style8">:استان</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td align="right" bgcolor="#FFFFFF" class="input_text" >
        
       <form method="post" name="form3" id="form3" action="#1" onsubmit="return ray.ajax()" >
       <select dir="rtl"  name="id_city" id="id_city" style="width:170px ; height:40px"  >
            <option value="0">انتخاب شهرستان</option>
            <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' ORDER BY BINARY city ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city1) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
            <?php 
		   }?>
         </select>
          <?php if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?>


        <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
      
      <tr >
        <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" >
            <p>&nbsp;</p>
            <p>
              <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
              <input name="id_mar" type="hidden"  value="<?php echo $id_mar ;?>" />
              <input type="reset"  value='پاک کردن' style="width:150px ; height:45px" />
              <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
            </p>
      </form>
        <td  align='center' bgcolor="#FFFFFF" class="style8">&nbsp;</td>
      </tr>
    </table>
  </div>

  <p>
  <?php if(isset($_POST['action']))
{
 $id_ostan = $_POST['id_ostan'] ; 
 $id_city = $_POST['id_city'] ; 
if ($id_ostan1 == '-1') { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
if ($id_city == 0) { $v_id_city = 'id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
// $query = "SELECT * FROM  list_abadi where  $v_id_ostan and  $v_id_city and $v_id_mar"  ;
// $query = "SELECT public_abadi4.ostan,public_abadi4.id_abadi,public_abadi4.add_abadi,public_abadi4.abadi,public_abadi4.deh,public_abadi4.city,public_abadi4.id_ostan
//FROM public_abadi4
//LEFT JOIN list_abadi ON list_abadi.add_abadi = public_abadi4.add_abadi
//WHERE list_abadi.add_abadi IS NULL and 1 and  public_abadi4.$v_id_city" ;

$query = "SELECT * FROM  public_abadi4 where  ok = '2'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
    <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<table width="138" height="56" border="0" align="center">
        <tr>
          <td width="66"><form  action="lists_abadi_xls.php" method="post">
            <input type="hidden" name="id_ostan2" value="<?php echo  $id_ostan ;?>" />
            <input type="hidden" name="id_city2" value="<?php echo  $id_city ;?>" />
            <input type="hidden" name="id_mar2" value="<?php echo  $id_mar;?>" />
            <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="42" height="42"  alt=""/></button>
          </form></td>
        </tr>
</table>

        <p>&nbsp;</p>
        
        <table width="90%" height="96" border="0" align="center" cellpadding="0" cellspacing="0" >
          <tr align="center" class="style8">
            <td width="27%" height="41" bgcolor="#CCCCCC">آدرس آماری آبادی</td>
            <td width="19%" bgcolor="#CCCCCC">نام آبادی</td>
            <td width="20%" bgcolor="#CCCCCC">دهستان</td>
            <td width="16%" bgcolor="#CCCCCC">شهرستان </td>
            <td  bgcolor="#CCCCCC">استان</td>
            <td width="8%" bgcolor="#CCCCCC">ردیف</td>
            
          </tr>
          <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
?>
  <td height="55" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo '"'.$row['add_abadi'].'"';?></span></td>
            <td class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?><br /></td>
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
          
          <p>&nbsp;</p>
          <p><a href="cities&villages.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a>
          </p>
          <p>&nbsp;</p>
          
          
          </
  </table>

  </p>
</body>
</html>
