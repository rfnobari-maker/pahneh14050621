<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>رهگیری درخواست: سازمان نظام مهندسی کشاورزی و منابع طبیعی استان</title>
    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../print/print_files/PLogo.jpg" width="949" height="152" /></td>
          </tr>
          <tr>
            <td>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >  
 <table width="100%" border="0">
   <tr>
     <td>
	 <?php 
  include('../event.php');
  include('config.php');
$cod_p = htmlspecialchars($_POST['cod-rah']) ; 
$stmt = $dbh->prepare('SELECT * FROM pay WHERE cod_p = :cod_p');
$stmt->execute(array('cod_p' => $cod_p));
$check2 = $stmt -> rowCount() ;
if ($check2 == 0)
 {
echo' <p>&nbsp;</p>' ;
echo '<p style="color:red">کد پیگیری يافت نشد </p>' ; 
?>
 <p>&nbsp;</p>
   </tr>
 </table>
 <p> <a href="../index.php" title="برگشت به صفحه اصلی"><img src="../files/goback.jpg" width="128" height="57" /></a> </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p class="MenuItemRight">Copyright © 2014, سازمان نظام مهندسی کشاورزی و منابع طبیعی استان آذربایجان شرقی All Rights Reserved.</p>
      <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</td>
</table>
</body>
</html>
<?php
exit ; 
 }
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_bah =  $row['no_bah'];
sar_data($cod_p,$no_bah);
$stmt = $dbh->prepare('SELECT * FROM pay WHERE cod_p = :cod_p');
$stmt->execute(array('cod_p' => $cod_p));
?></td>
   </tr>
   <tr>
     <td><img src="../files/horizontal-line-700x223.png" width="700" height="19" /></td>
   </tr>
   <tr>
     <td>    <?php 	  echo "تعداد رویداد ثبت شده  : ". $check2 . " مورد" ; ?>
</p>
             <form name="form2" method="post" action="user_del2.php">
  <?php
       echo "<table  with='100%' border='1' cellpadding='10' cellspacing='0' bgcolor='#FFFFFF' align='center' dir='rtl' bordercolor='#993333'>" ; 
        echo "<tr><th>کد پیگیری</th> <th>آخرین رویداد </th> <th>تاریخ </th>"; 
        // loop through results of database query, displaying them in the table 
               foreach($stmt as $row){
                 // echo out the contents of each row into a table 
                echo "<tr>"; 
             ?>
			  <?php
				echo '<td>' . $row['cod_p'] . '</td>'; 
                echo '<td align="center" >' . $row['coevent'];  '</td>'; 
                echo '<td align="center" >' . $row['date']; '</td>'; 
                 echo "</tr>";  
        }  
         // close table>
        echo "</table>"; 
?>
      </form></td>
   </tr>
 </table>
 <p> <a href="../index.php" title="برگشت به صفحه اصلی"><img src="../files/goback.jpg" width="128" height="57" /></a> </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p class="MenuItemRight">Copyright © 2014, سازمان نظام مهندسی کشاورزی و منابع طبیعی استان آذربایجان شرقی All Rights Reserved.</p>
      <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</td>
</table>
</body>
</html>
