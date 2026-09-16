<?php include('../lock_ad.php');
$id_city1 = $_POST['id_city'] ;
$id_mar1 = $_POST['id_mar'] ; 
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
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
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
      <td>
  <?php include('top.php'); ?>
      <table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
  <div style=" width: 500px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style1">لیست شهرهای فعال</span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" bgcolor="#DDDDDD" class="input_text" align="right" >
        <form method="post" name="form1" id="form1" >
          <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
                  <option value="0"> شهرستان</option>
            <?php
//$id_ostan = '03' ;
$query = "SELECT DISTINCT id_city,city FROM list_abadi WHERE  id_ostan = $id_ostan"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php  echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city1) echo 'selected=selected'?>> <?php  echo $row['city'] ;?></option>
            <?php }?>
          </select>
        </form>
          <?php  if (isset($_POST['id_city']))
 $id_city1 = $_POST['id_city'] ; 
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
$query = "SELECT id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan' and id_city = $id_city1"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                <option value="<?php  echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar1) echo 'selected=selected'?>> <?php  echo $row['mar'] ;?></option>
                <?php }?>
                </select>
              </p>
            <p>
              <input name="id_city" type="hidden" value="<?php echo $id_city1 ;?>" />
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
	<?php
   if(isset($_POST['action']))
{
 $id_city1 = $_POST['id_city'] ; 
 $id_mar1 = $_POST['id_mar'] ; 
if ($id_city1 == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city1'" ;}
if ($id_mar1 == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar1'" ;}
 $query = "SELECT mor_cod_m,add_city,id_mar,shahr,mar,bakh,city FROM  list_city where  id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      <p><form  action="active_abadi_xls.php" method="post">
                 <input type="hidden" name="id_city" value="<?php echo  $id_city1 ;?>" />
                 <input type="hidden" name="id_mar" value="<?php echo  $id_mar1 ;?>" />
                 <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="42" height="42"  alt=""/></button>
               </form></p>
            <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
           <div align="right" class="LinkRedTitle" style="margin-right:45px">
             
           </div>
           <table width="90%" height="96" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="style8">
               <td height="41" colspan="2" bgcolor="#CCCCCC">عملیات</td>
               <td colspan="2" bgcolor="#CCCCCC">مشخصات مروج شهر</td>
               <td width="13%" bgcolor="#CCCCCC">نام مرکز</td>
               <td width="15%" bgcolor="#CCCCCC">نام شهر</td>
               <td width="13%" bgcolor="#CCCCCC">بخش</td>
               <td width="14%" bgcolor="#CCCCCC">شهرستان </td>
               <td width="7%" bgcolor="#CCCCCC">ردیف</td>
             </tr>
             <tr>
               <?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['mor_cod_m'] ;
$add_city = $row['add_city'] ;
$query2 = "SELECT pic,Last_name,name FROM  users  where cod_m = $cod_m " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic_mo = $row2['pic'];
if ($pic_mo=='') $pic_mo = 'no_pic.png' ; 
?>
               <td width="6%" height="55" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="doinactive_city.php" method="post">
                 <input type="hidden" name="add_city" value="<?php echo $row['add_city'] ;?>" />
                 <input type="hidden" name="id_mar2" value="<?php echo $row['id_mar'] ;?>" />
                 <button onclick="return confirm('از حذف شهر با نام <?php echo $row['shahr'] ;?> مطمئن هستید ؟ ')"><img src="../files/notok.png" border="0"  title=" غیرفعال کردن شهر" width="30" height="30" /></button>
               </form></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="7%"><form  action="change_city_mor_mar.php" method="post">
                 <input type="hidden" name="add_city" value="<?php echo $row['add_city'] ;?>" />
                 <button><img src="../files/plan-2-action.png" border="0"  title=" ویرایش مرکز و مروج آبادی" width="30" height="30" /></button>
               </form></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="19%" class="normalTextSmaller"><?php echo $row2['Last_name'].' '.$row2['name'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" class="normalTextSmaller"><img  id="img1" src="../files/users/<?php echo $pic_mo;?>" width="42" height="47"  alt=""/></td>
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mar'];?></td>
               <td class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['shahr'];?><br />
                 <?php echo $row['add_city'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['bakh'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><?php echo $row['city'];?></span></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
}
?>
           </table>
           <p>&nbsp;</p>
           <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a>
            </p>
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