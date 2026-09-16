<?php
include("../../../lock_Sc.php");
include("../../../event.php");
include ('../../../login/config.php');
$id_mar1   = $_POST['id_mar'];
$id_ostan1 = $_POST['id_ostan'];
$id_city1  = $_POST['id_city'];
$id_select_city  = $_POST['id_select_city'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../../../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 ?>
<p align="center" ><span class="style1">اطلاعات مراکز موضوع ماده 2 و تشکل ها</span></p>
 <p align="center" ><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
   <?php
$query = "SELECT * from promo_cent_organiz where id_mar = $id_mar1 and id_ostan = $id_ostan1";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$found_count = $stmt -> rowCount();
if ($found_count>0)
{
  $no_action  = '1' ; 
  $mmd_1 = $row['mmd_1']; 
  $mmd_2 = $row['mmd_2']; 
  $mmd_3 = $row['mmd_3']; 
  $mmd_4 = $row['mmd_4']; 
  $ta_1 = $row['ta_1']; 
  $ta_2= $row['ta_2']; 
  $ta_3= $row['ta_3']; 
?>
 </p>
 <form action="../../list_center.php#1" method="post" id="form1" name="form1">
   <div  style=" border: 3px solid #930 ; width:90% ; margin:auto" >
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
      <tr>
        <td height="38" bgcolor="#FFFFCC">&nbsp;</td>
        <td bgcolor="#FFFFCC" class="style8"><div align="right">مراکز موضوع ماده 2</div></td>
        <td bgcolor="#FFFFCC">&nbsp;</td>
      </tr>
      <tr>
        <td height="42"><div align="right">
          <input name="mmd_1" type="text" class="required digits input_text" id="mmd_1" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $mmd_1 ?>" maxlength="2" xml:lang="fa" />
        </div></td>
        <td width="400"><div align="right">:تعداد شرکت های خدمات مشاوره ای ، فنی و مهندسی کشاورزی </div></td>
        <td width="17">&nbsp;</td>
      </tr>
      <tr>
        <td height="36" class="input_text"><div align="right">
          <input name="mmd_2" type="text" class="required digits input_text" id="mmd_2" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $mmd_2 ?>" maxlength="2" xml:lang="fa" />
        </div></td>
        <td><div align="right">:تعداد کلینیک های گیاهپزشکی </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="41"><div align="right">
          <input name="mmd_3" type="text" class="required digits input_text" id="mmd_3" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $mmd_3 ?>" maxlength="2" xml:lang="fa" />
        </div></td>
        <td><div align="right">:تعداد کلینیک های دامپزشکی </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="37"><div align="right">
          <input name="mmd_4" type="text" class="required digits input_text" id="mmd_4" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $mmd_4 ?>" maxlength="2" xml:lang="fa" />
        </div></td>
        <td><div  align="right" >:سایر مراکز موضوع ماده 2</div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="382" height="38" bgcolor="#FFFFCC">&nbsp;</td>
        <td bgcolor="#FFFFCC" class="style8"><div align="right">تشکل های کشاورزی</div></td>
        <td bgcolor="#FFFFCC">&nbsp;</td>
      </tr>
      <tr>
        <td height="44"><div align="right">
          <input name="ta_1" type="text" class="required digits input_text" id="ta_1" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $ta_1 ?>" maxlength="2" xml:lang="fa" />
        </div></td>
        <td width="404"><div align="right">:تعداد تعاونی های تولید روستایی</div></td>
        <td width="17">&nbsp;</td>
      </tr>
      <tr>
        <td height="38" class="input_text"><div align="right">
          <input name="ta_2" type="text" class="required digits input_text" id="ta_2" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $ta_2 ?>" maxlength="2" xml:lang="fa" />
        </div></td>
        <td><div align="right">:تعداد شرکت های سهامی زراعی</div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="46"><div align="right">
          <input name="ta_3" type="text" class="required digits input_text" id="ta_3" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $ta_3 ?>" maxlength="2" xml:lang="fa" />
        </div></td>
        <td><div align="right">:تعداد تشکل های کشاورزی موضوعی - محصولی </div></td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </div>
 <div align="center">
   <p>
     <input type="hidden" name="id_city"  value='<?php echo  $id_select_city ?>'>
     <input type="hidden" name="action"  value='1'>
     <input type="hidden" name="id_ostan"  value='<?php echo $id_ostan1 ?>'>
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="23" value="بازگشت" />
   </p>
 </div>
 <p align="center" >&nbsp;</p>
    </form>  </td>
  </tr>
<?php
}
else 
{
echo '<p>&nbsp;</p>' ;
echo  "<p dir='rtl' class='style8'> متاسفانه اطلاعات مراکز موضوع ماده 2 و تشکل ها ثبت نشده است. </p> " ; 
echo '<p>&nbsp;</p>' ;
?>
 <form action="../../list_center.php#1" method="post" id="form1" name="form1">
     <input type="hidden" name="id_city"  value='<?php echo  $id_select_city ?>'>
     <input type="hidden" name="action"  value='1'>
     <input type="hidden" name="id_ostan"  value='<?php echo $id_ostan1 ?>'>
     <input  name="action" type="submit" style="width:150px ; height:45px" tabindex="23" value="بازگشت" />
    </form>
    <?php
echo '<p>&nbsp;</p>' ;
}
?>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
