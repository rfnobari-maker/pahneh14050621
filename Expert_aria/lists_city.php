<?php include('../lock_expar.php');
include('counter.php');
$id_city = $_POST['id_city'] ;
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
        <td height="40" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style1">لیست شهر های تحت پوشش </span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" bgcolor="#DDDDDD" class="input_text" align="right" ><form method="post" name="form1" id="form1" >
          <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
            >
            <option value="0"> شهرستان</option>
            <?php
$query = "SELECT id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' order by binary city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
            <?php }?>
          </select>
        </form>
          <?php if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
        <td width="163"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
      </tr>
      <tr >
        <td height="23" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >
          <form method="post" name="form3" id="form3"  action="#1">
            <p>
              <select dir="rtl"  name="id_mar" id="bakh" style="width:170px ; height:40px">
                <option value="0"> نام مرکز</option>
                <?php
$query="SELECT DISTINCT id_mar,mar FROM list_abadi WHERE id_ostan = '$id_ostan' and id_city = '$id_city'" ;
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
              <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
              <input type="reset"  value='پاک کردن' style="width:150px ; height:45px" />
              <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
              </p>
            </form></td>
        <td height="47"  align='center' bgcolor="#FFFFFF" class="style8"><font size="2" class="style8">: مرکز خدمات</font></td>
      </tr>
      <tr >
        <td height="29"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
      </tr>
    </table>
</div>

  <p>
  <?php if(isset($_POST['action']))
{
 $id_city = $_POST['id_city'] ; 
 $id_mar = $_POST['id_mar'] ; 
if ($id_city == 0) { $v_id_city = 'id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 //$query = "SELECT * FROM  list_city where  id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar "  ;
$query = "SELECT list_city.add_city,list_city.shahr,list_city.bakh,list_city.city,list_city.ostan,list_city.mar
FROM list_city
INNER JOIN aria ON list_city.id_city = aria.id_city
WHERE aria.id_aria='$id_aria' and list_city.id_ostan=$id_ostan and list_city.$v_id_city and list_city.$v_id_mar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  </p>
  <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="95%" height="78" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td width="10%" bgcolor="#999999">تعداد بهره بردار</td>
    <td width="20%" height="39" bgcolor="#999999">آدرس آماری شهر</td>
    <td width="12%" bgcolor="#999999">نام شهر</td>
    <td width="12%" bgcolor="#999999">مرکز جهاد کشاورزی</td>
    <td width="12%" bgcolor="#999999">بخش</td>
    <td width="13%" bgcolor="#999999">شهرستان</td>
    <td width="14%" bgcolor="#999999">استان</td>
    <td width="7%" bgcolor="#999999">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller">
 <form action="city_list_bah.php" method="post">
  <input type="hidden" name="add_city" value="<?php echo $row['add_city'] ;?>" />
  <button><?php echo shahr_bah_count($row['add_city'])?></button>
</form>
 </td>
<td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> height="39" class="normalTextSmaller"><?php echo $row['add_city'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['shahr'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mar'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['bakh'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['city'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['ostan'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="style21"><a name="1" id="1"></a></span><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
 }
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



