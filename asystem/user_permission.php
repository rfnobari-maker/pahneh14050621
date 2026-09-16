<?php include('../lock_admin.php');?>
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
	text-align: right;
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
 <?php if(isset($_POST['action'])) 
{
 $username = $_POST['username'] ; 
 $p1= $_POST['p1'] ; 
 $p2= $_POST['p2'] ; 
 $p3= $_POST['p3'] ; 
 $p4= $_POST['p4'] ; 
 $d1= $_POST['d1'] ; 
 $d2= $_POST['d2'] ; 
 $d3= $_POST['d3'] ; 
 $d4= $_POST['d4'] ; 
 $d5= $_POST['d5'] ; 
 $d6= $_POST['d6'] ; 
 $d7= $_POST['d7'] ; 
 $d8= $_POST['d8'] ; 
 $d9= $_POST['d9'] ; 
 $d10= $_POST['d10'] ; 
 $d11= $_POST['d11'] ; 
 $full=$_POST['full'] ; 

if($full =='p1p2p3p4d1d2d3d4d5d6d7d8d9d10d11')
{
$perm = $full ;  
}
else
{
 $perm=$p1.$p2.$p3.$p4.$d1.$d2.$d3.$d4.$d5.$d6.$d7.$d8.$d9.$d10.$d11 ;  
}

include ('../login/config.php');
$query = "UPDATE users SET perm=?  WHERE username=?";
$q = $dbh->prepare($query);
$q->execute(array($perm,$username));
?>
<script>
      alert('تغییرات با موفقیت اعمال شد ') ;
      close();
</script>
<?php } ?>
<table width="102%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="1022"  >
 <form action='' method=post>
  <?php 
  if(isset($_POST['username']))
{
include('../login/config.php');
$username = $_POST['username'] ; 
  $query2 = "SELECT * FROM  users  where username = '$username' " ;
  $stmt2 = $dbh->prepare($query2);
  $stmt2->execute();
  $row2 = $stmt2->fetch(PDO::FETCH_ASSOC); ?>
  <table  style=" margin-right:35px" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
              <td height="22" colspan="5"><span class="style8"><img src="../files/horizontal-line-700x223.png" width="630" height="17"  alt=""/></span></td>
          </tr>
            <tr>
              <td width="274" height="44" align="right" class="style19" ><?php echo $row2['cod_m'] ;  ?></td>
              <td width="181" align="right" ><span class="style8"><span class="style19">:کد ملی</span></span></td>
              <td width="113">&nbsp;</td>
              <td width="226"><div align="right" class="style9">
                <?php  echo $row2['name'].' '.$row2['Last_name'] ?></div>
</td>
              <td width="159"><span class="style8"><img src="../files/users/<?php echo $row2['pic'];?>" width="46" height="51"  alt=""/></span></td>
            </tr>
            <tr>
              <td height="18" colspan="5" align="right" ><span class="style8"><img src="../files/horizontal-line-700x223.png" width="630" height="17"  alt=""/></span></td>
          </tr>
        </table>
  <table width="75%" border='0' align=center cellpadding='0' cellspacing='0' bgcolor="#CCCCCC">
    <tr bgcolor='#f1f1f1' > <td height="40" colspan='4' align='center' bgcolor="#FFFFCC"><font size="2" face="verdana, arial, helvetica" class="style8">مجوز دسترسی به اطلاعات</font></td> </tr>
<tr bgcolor='#f1f1f1' >
  <td width="376"  align='center' bgcolor="#CC3333" class="text1">اطلاعات اختصاصی </td>
  <td width="24" height="45"  align='center' bgcolor="#CC3333" class="text1">&nbsp;</td>
  <td width="340"  align='center' bgcolor="#CC3333" class="text1">اطلاعات عمومی</td>
  <td width="27"  align='center' bgcolor="#CC3333" class="text1">&nbsp;</td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td width="376" height="38"  align='center' bgcolor="#F1F1F1" class="style1">بهره برداران کشاورزی</td>
  <td width="24"  align='center' bgcolor="#F1F1F1" class="style1"><input name="d9" type="checkbox" id="d9" value="d9" <?php if(strstr($row2['perm'],'d9')) echo "checked='checked'" ?> ;  /></td>
  <td width="340"  align='center' bgcolor="#F1F1F1" class="style1">استان های تحت پوشش</td>
  <td width="27"  align='center' bgcolor="#F1F1F1" class="style1"><input type="checkbox" name="p1" id="p1" value="p1"  <?php if(strstr($row2['perm'],'p1')) echo "checked='checked'" ?> /></td>
  </tr>
<tr bgcolor='#f1f1f1' >
  <td width="376" height="38"  align='center' bgcolor="#FFFFCC" class="style1">زراعت </td>
  <td width="24"  align='center' bgcolor="#FFFFCC" class="style1"><input name="d1" type="checkbox" id="d1" value="d1" 
  <?php if (preg_match('/\bd1\b/', preg_replace('/(d\d+)/', ' $1 ', $row2['perm']))) echo "checked='checked'"; ?> ;  /></td>
  <td  align='center' bgcolor="#FFFFCC" class="style1">شهرها و آبادی ها</td>
  <td  align='center' bgcolor="#FFFFCC" class="style1"><input type="checkbox" name="p2" id="p2" value="p2"  <?php if(strstr($row2['perm'],'p2')) echo "checked='checked'" ?> /></td>
  </tr>
<tr bgcolor='#f1f1f1' >
  <td height="35"  align='center' bgcolor="#F1F1F1" class="style1">صیفی</td>
  <td  align='center' bgcolor="#F1F1F1" class="style1"><input name="d2" type="checkbox" id="d2" value="d2"  <?php if(strstr($row2['perm'],'d2')) echo "checked='checked'" ?> /></td>
  <td  align='center' bgcolor="#F1F1F1" class="style1">مراکز جهاد کشاورزی</td>
  <td  align='center' class="style1"><input name="p3" type="checkbox" id="p3" value="p3" <?php if(strstr($row2['perm'],'p3')) echo "checked='checked'" ?> /></td>
  </tr>
<tr bgcolor='#f1f1f1' >
  <td height="35"  align='center' bgcolor="#FFFFCC" class="style1">باغبانی</td>
  <td  align='center' bgcolor="#FFFFCC" class="style1"><input name="d3" type="checkbox" id="d3" value="d3" <?php if(strstr($row2['perm'],'d3')) echo "checked='checked'" ?> /></td>
  <td  align='center' bgcolor="#FFFFCC" class="style1">کاربران سامانه</td>
  <td  align='center' bgcolor="#FFFFCC" class="style1"><input name="p4" type="checkbox" id="p4" value="p4"  <?php if(strstr($row2['perm'],'p4')) echo "checked='checked'" ?> /></td>
  </tr>
<tr bgcolor='#f1f1f1' >
  <td height="32"  align='center' bgcolor="#F1F1F1" class="style1">گلخانه</td>
  <td  align='center' bgcolor="#F1F1F1" class="style1"><input name="d4" type="checkbox" id="d4" value="d4"  <?php if(strstr($row2['perm'],'d4')) echo "checked='checked'" ?> /></td>
  <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
  <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
  </tr>
<tr bgcolor='#f1f1f1' >
  <td height="37"  align='center' bgcolor="#FFFFCC" class="style1">پرورش قارج</td>
  <td  align='center' bgcolor="#FFFFCC" class="style1"><input name="d5" type="checkbox" id="d5" value="d5"  <?php if(strstr($row2['perm'],'d5')) echo "checked='checked'" ?> /></td>
  <td  align='center' bgcolor="#FFFFCC" class="style1">&nbsp;</td>
  <td  align='center' bgcolor="#FFFFCC" class="style1">&nbsp;</td>
  </tr>
<tr bgcolor='#f1f1f1' >
  <td height="42"  align='center' bgcolor="#F1F1F1" class="style1">مزارع پرورش آبزیان</td>
  <td  align='center' bgcolor="#F1F1F1" class="style1"><input name="d6" type="checkbox" id="d6" value="d6"  <?php if(strstr($row2['perm'],'d6')) echo "checked='checked'" ?> /></td>
  <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
  <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
  </tr>
<tr bgcolor='#f1f1f1' >
  <td height="35"  align='center' bgcolor="#FFFFCC" class="style1">زنبور عسل</td>
  <td  align='center' bgcolor="#FFFFCC" class="style1"><input name="d7" type="checkbox" id="d7" value="d7"  <?php if(strstr($row2['perm'],'d7')) echo "checked='checked'" ?> /></td>
  <td  align='center' bgcolor="#FFFFCC" class="style1">&nbsp;</td>
  <td  align='center' bgcolor="#FFFFCC" class="style1">&nbsp;</td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td height="41"  align='center' bgcolor="#F1F1F1" class="style1">ترویج</td>
  <td  align='center' bgcolor="#F1F1F1" class="style1"><input name="d8" type="checkbox" id="d8" value="d8"  <?php if(strstr($row2['perm'],'d8')) echo "checked='checked'" ?> /></td>
  <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
  <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td height="41"  align='center' bgcolor="#FFFFFF" class="style1">صنایع تبدیلی و تکمیلی</td>
  <td  align='center' bgcolor="#FFFFFF" class="style1"><input name="d10" type="checkbox" id="d10" value="d10"  <?php if(strstr($row2['perm'],'d10')) echo "checked='checked'" ?> /></td>
  <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
  <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td height="41"  align='center' bgcolor="#FFFFFF" class="style1">دام</td>
  <td  align='center' bgcolor="#FFFFFF" class="style1"><input name="d11" type="checkbox" id="d11" value="d11"  <?php if(strstr($row2['perm'],'d11')) echo "checked='checked'" ?> /></td>
  <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
  <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td height="41"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
  <td  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
  <td  align='center' bgcolor="#CCCC33" class="style1">دسترسی طلائی </td>
  <td  align='center' bgcolor="#CCCC33" class="style1"><input name="full" type="checkbox" id="full" value="p1p2p3p4d1d2d3d4d5d6d7d8d9d10d11"  <?php if($row2['perm']=='p1p2p3p4d1d2d3d4d5d6d7d8d9d10d11') echo "checked='checked'" ?> /></td>
  </tr>
<tr bgcolor='#ffffff' > <td height="64" colspan=4 align=center><p>&nbsp;
  </p>
    <p>
      <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
      <input name='action' type=submit class="style19" style="width:150px ; height:45px" value='ثبت تغییرات ' />
    </p>    </font></td></tr>
</table>

    </form>
<?php }
else 
{
    echo '<br>' ; 
	echo '<p align=center style=color:red> مجوز دسترسی به این صفحه را ندارید </p> ' ;
	}
?>
</td>
  </tr>
</table>
</body>
</html>