<?php include('../lock_p3.php');
include('counter.php');
$id_mar = $_POST['mar'] ; 
$add_bakh = $_POST['bakh'] ; 
$add_deh = $_POST['deh'] ; 
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
    <form action='' method="post">
      <p>
        <input type=hidden name=todo value=change-password>
      </p>
      <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
        <tr bgcolor='#f1f1f1' >
          <td height="40" colspan='2' align='center' bgcolor="#FFFFCC"><font size="2" class="style1">تعیین معیار جستجو </font></td>
        </tr>
        <tr >
          <td height="45" bgcolor="#f1f1f1" class="input_text" align="right" ><select dir="rtl"  name="mar" id="mar" style="width:170px ; height:40px" >
            <option value="0">کلیه مراکز</option>
            <?php
$query = "SELECT id_mar,mar FROM  mar WHERE  id_ostan = '$id_ostan' and id_city = '$id_city'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_mar'] ;?>" 
      <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
            <?php }?>
          </select></td>
          <td width="163"  align='center' bgcolor="#F1F1F1" class="style1"><font size="2">: مرکز خدمات</font></td>
        </tr>
        <tr bgcolor='#f1f1f1' >
          <td height="45" bgcolor="#FFFFFF" class="input_text" align="right" ><select dir="rtl"  name="bakh" id="bakh" style="width:170px ; height:40px" >
            <option value="0">کلیه بخش های شهرستان</option>
            <?php
$query = "SELECT DISTINCT add_bakh,bakh FROM  list_abadi WHERE  id_ostan = '$id_ostan' and id_city = '$id_city'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['add_bakh'] ;?>"
   <?php if ($row['add_bakh']==$add_bakh) echo 'selected=selected'?>> <?php echo $row['bakh'] ;?></option>
            <?php }?>
          </select></td>
          <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2"> :بخش</font></td>
        </tr>
        <tr bgcolor='#f1f1f1' >
          <td height="45" align="right" bgcolor="#f1f1f1" class="input_text" ><select dir="rtl"  name="deh" id="deh" style="width:170px ; height:40px" >
            <option value="0">کلیه دهستان ها</option>
            <?php
$query = "SELECT DISTINCT add_deh,deh FROM  list_abadi WHERE  id_ostan = '$id_ostan' and id_city = '$id_city'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['add_deh'] ;?>"
   <?php if ($row['add_deh']==$add_deh) echo 'selected=selected'?>> <?php echo $row['deh'] ;?></option>
            <?php }?>
          </select></td>
          <td  align='center' class="style1"><font size="2"> :دهستان </font></td>
        </tr>
        <tr bgcolor='#ffffff' >
          <td colspan="2" align="center"><p>&nbsp;</p>
            <p>
              <input type="reset" value='پاک کردن ' style="width:150px ; height:45px" />
              <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
            </p>
            </font></td>
        </tr>
      </table>
    </form>
</div>

  <p>
    <?php if(isset($_POST['action']))
{
$id_mar = $_POST['mar'] ; 
$add_bakh = $_POST['bakh'] ; 
$add_deh = $_POST['deh'] ; 
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($add_bakh == 0) { $v_add_bakh = 'add_bakh=add_bakh' ;} else { $v_add_bakh = "add_bakh='$add_bakh'" ;}
if ($add_deh == 0) { $v_add_deh = 'add_deh=add_deh' ;} else { $v_add_deh = "add_deh='$add_deh'" ;}
$query = "SELECT add_abadi,abadi,deh,mar,bakh,city,ostan,post_cod FROM list_abadi where id_ostan = '$id_ostan' and id_city = '$id_city' and  $v_id_mar and $v_add_bakh and $v_add_deh  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  </p>
  <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="95%" height="97" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td width="9%" bgcolor="#999999">تعداد بهره بردار</td>
    <td width="19%" height="49" bgcolor="#999999">آدرس آماری آبادی</td>
    <td width="11%" bgcolor="#999999">نام آبادی</td>
    <td width="7%" bgcolor="#999999">دهستان</td>
    <td width="11%" bgcolor="#999999">مرکز جهاد کشاورزی</td>
    <td width="11%" bgcolor="#999999">بخش</td>
    <td width="12%" bgcolor="#999999">شهرستان</td>
    <td width="15%" bgcolor="#999999">استان</td>
    <td width="5%" bgcolor="#999999">ردیف</td>

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