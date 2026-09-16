<?php
require_once("../lock_cp.php");
require_once("../event.php");
require_once('side_menu1.php');
if (isset($_POST['id_ostan']))   $id_ostan1= $_POST['id_ostan'] ; 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style>
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
	text-align: center;
}
.my-table {
  border-collapse: separate; /* استفاده از separate به جای collapse */
  border-spacing: 0; /* حذف فاصله بین سلول‌ها */
  width: 90%;
  border: 1px solid #ddd;
  border-radius: 10px; /* اعمال border-radius به جدول */
}

.my-table th,
.my-table td {
  padding: 10px;
  border: 1px solid #ddd;
}

.my-table thead th {
  background-color: #f4f4f4;
}

.my-table tbody tr:first-child td:first-child {
  border-top-left-radius: 10px; /* گرد کردن گوشه بالا چپ */
}

.my-table tbody tr:first-child td:last-child {
  border-top-right-radius: 10px; /* گرد کردن گوشه بالا راست */
}

.my-table tbody tr:last-child td:first-child {
  border-bottom-left-radius: 10px; /* گرد کردن گوشه پایین چپ */
}

.my-table tbody tr:last-child td:last-child {
  border-bottom-right-radius: 10px; /* گرد کردن گوشه پایین راست */
}

    </style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
               <form  id="reg-form" method="post" action="#1">
  <div style="width: 450px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:15px" >
    <table width="100%" height="165" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="60" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style8">کد های شهرستان و مرکز جهاد کشاورزی استان</span><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td width="277" height="45" align="right" bgcolor="#FFFFFF" class="input_text" >

                <select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <option value="-1">انتخاب استان</option>
                  <?php
$query = "SELECT  id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC "  ;
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
        <td width="173"  align='center' bgcolor="#FFFFFF" class="tabel">: استان</td>
      </tr>
      <tr >
        <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
        </tr>
    </table>
  </div>
</form>
<?php 
   if (isset($_POST['id_ostan']))
   {
 $id_ostan= $_POST['id_ostan'] ;  
?>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="170" height="56" border="0" align="center">
             <tr>
               <td width="80"><form  action="ostan_cod_xls.php" method="post">
                 <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan ;?>" />
                 <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="58" height="59"  alt=""/></button>
               </form></td>
               <td width="110"><form  action="ostan_cod_doc.php" method="post">
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />
                 <button><img src="../files/word.png" title="دانلود نتایج با فرمت فایل اکسل"  width="58" height="59"  alt=""/></button>
               </form></td>
             </tr>
           </table>
           <br />
           <table width="85%" class="my-table"   align="center"  >
             <tr align="center" class="text1">
               <td bgcolor="#999999">کد مرکز </td>
               <td bgcolor="#999999">نام مرکز</td>
               <td width="6%" height="55" bgcolor="#999999">کد شهرستان</td>
               <td width="5%" height="55" bgcolor="#999999">  نام شهرستان</td>
               <td width="5%" height="55" bgcolor="#999999">کد استان</td>
               <td width="7%" bgcolor="#999999">نام استان</td>
               <td width="4%" bgcolor="#999999">ردیف</td>
             </tr>
             <tr>
               <?php
   if ($id_ostan1 == '-1')    { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
  $query = "SELECT  * FROM mar WHERE  $v_id_ostan order by  id_ostan,id_city,id_mar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
 $id_city = $row['id_city'] ;
?>
               <td width="6%" height="49"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['id_mar'];?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mar'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['id_city'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['city'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['id_ostan'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['ostan'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
       </table>
           </div>
<?php }?>

    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../files/bottom.gif">
      <?php include('../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>