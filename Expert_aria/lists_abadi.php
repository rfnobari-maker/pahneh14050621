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
  <p class="style1">لیست آبادی های تحت پوشش </p>
  <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 500px; padding: 15px;border: 3px solid navy; margin:auto" >
    <table width="500" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFCC"><font size="2" class="style1">تعیین معیار جستجو </font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" bgcolor="#FFFFFF" class="input_text" align="right" ><form method="post" name="form1" id="form1" >
          <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
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
        <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
      </tr>
      <tr >
        <td height="74" bgcolor="#f1f1f1" class="input_text" align="right" ><form method="post" name="form2" id="form2" >
          <select dir="rtl"  name="id_mar" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
               <option value="0"> نام مرکز</option>
            <?php
$query = "SELECT DISTINCT id_mar,mar FROM list_abadi WHERE  id_ostan = '$id_ostan' and id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
            <?php }?>
          </select>
          <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
        </form>
          <?php if (isset($_POST['id_mar']))
 $id_mar = $_POST['id_mar'] ; 
?></td>
        <td width="163"  align='center' bgcolor="#F1F1F1" class="style1"><font size="2" class="style8">: مرکز خدمات</font></td>
      </tr>
      <tr >
        <td height="23" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >
        <form method="post" name="form3" id="form3" action="#1" >
          <p>
            <select dir="rtl"  name="id_deh" id="id_deh" style="width:170px ; height:40px" >
              <option value="0">کلیه دهستان ها</option>
              <?php
$query = "SELECT DISTINCT add_deh,deh FROM  list_abadi WHERE  id_mar = $id_mar"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
              <option value="<?php echo $row['add_deh'] ;?>"
   <?php if ($row['add_deh']==$add_deh) echo 'selected=selected'?>> <?php echo $row['deh'] ;?></option>
              <?php }?>
            </select>
          </p>
          <p>
            <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
            <input name="id_mar" type="hidden"  value="<?php echo $id_mar ;?>" />
            <input type="reset"  value='پاک کردن' style="width:150px ; height:45px" />
            <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          </p>
        </form></td>
        <td height="47"  align='center' bgcolor="#FFFFFF" class="style8"> : دهستان</td>
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
 $add_deh = $_POST['id_deh'] ; 
if ($id_city == 0) { $v_id_city = 'id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($add_deh == 0) { $v_add_deh = 'add_deh' ;} else { $v_add_deh = "add_deh='$add_deh'" ;}
$query = "SELECT list_abadi.add_abadi,list_abadi.abadi,list_abadi.bakh,list_abadi.city,list_abadi.ostan,list_abadi.mar,list_abadi.deh
FROM list_abadi
INNER JOIN aria ON list_abadi.id_city = aria.id_city
WHERE aria.id_aria='$id_aria' and list_abadi.id_ostan='$id_ostan' and  list_abadi.$v_id_city and list_abadi.$v_id_mar and list_abadi.$v_add_deh"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span></p>
           <table width="95%" height="97" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td width="8%" bgcolor="#999999">تعداد بهره بردار</td>
    <td width="20%" height="49" bgcolor="#999999">آدرس آماری آبادی</td>
    <td width="11%" bgcolor="#999999">نام آبادی</td>
    <td width="7%" bgcolor="#999999">دهستان</td>
    <td width="11%" bgcolor="#999999">مرکز جهاد کشاورزی</td>
    <td width="11%" bgcolor="#999999">بخش</td>
    <td width="12%" bgcolor="#999999">شهرستان</td>
    <td width="10%" bgcolor="#999999">استان</td>
    <td width="10%" bgcolor="#999999">ردیف</td>

  </tr>
  <tr>
   
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller">
 <form action="abadi_list_bah.php" method="post">
  <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
  <button><?php echo abadi_bah_count($row['add_abadi'])?></button>
</form>
 </td>
<td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> height="48" class="normalTextSmaller"><?php echo $row['add_abadi'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['deh'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mar'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['bakh'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['city'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['ostan'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
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



