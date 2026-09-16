<?php 
include('../../lock_oce.php');
include('../../event.php');
include('counter.php');
 $id_mar = $_POST['id_mar'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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

-->
</style>
<script>
function close_window() {
      close();
 }
</script>

</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="100%" >
<?php 
include('../../login/config.php');
 $query = "SELECT * FROM  users WHERE  id_mar = '$id_mar' and S_access = '1'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p class="style19">کارشناسان مرکز<br />
            <img src="../../files/horizontal-line-700x223.png" width="90%" height="19"  alt=""/></p>
           <table align="center" class="my-table"  >
             <tr align="center" class="text1">
               <td width="15%" bgcolor="#0099FF"> آخرین وضعیت سرشماری</td>
               <td width="9%" bgcolor="#0099FF">تعداد زنبورستان ثبت شده </td>
               <td width="12%" bgcolor="#0099FF">کد ملی</td>
               <td width="17%" bgcolor="#0099FF">نام خانوادگی</td>
               <td width="12%" bgcolor="#0099FF">نام</td>
               <td width="10%" bgcolor="#0099FF">&nbsp;</td>
               <td width="25%" bgcolor="#0099FF">ردیف</td>
             </tr>
             <tr>
               <?php
$r = 1 ;
 foreach($stmt as $row){
?>

               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mor_bee_status($row['cod_m'])?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo mor_bee_count($row['cod_m'])?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['cod_m'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row['name'];?></td>
               <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png' ?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img src="../../files/users/<?php echo $pic ?>" width="40" height="49"  alt=""/></span></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
       </table>
           <p>&nbsp;</p>
           <p>
       <p> <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بستن پنجره</button></p></p>  
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>



