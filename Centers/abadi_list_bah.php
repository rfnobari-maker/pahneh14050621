<?php include('../lock_p2.php');
include('../event.php') ;
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
    <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
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
  <p class="style1">&nbsp;</p>
  <p class="style8">لیست بهره برداران ثبت شده آبادی</p>
  <p>
    <?php if(isset($_POST['add_abadi']))
{
 $add_abadi = $_POST['add_abadi'] ; 
 $query = "SELECT * FROM  bah where  add_abadi = '$add_abadi' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
    <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
  <table width="98%" height="132" border="0" align="center" cellpadding="1" cellspacing="1" >
    <tr align="center" class="text1">
       <td bgcolor="#999999"><p>تایید</p></td>
      <td height="57" bgcolor="#999999"><p>مشاهده</p>
        <p>اطلاعات</p></td>
      <td width="10%" bgcolor="#999999">کارشناس مروج</td>
      <td height="57" bgcolor="#999999">شماره همراه</td>
      <td width="10%" bgcolor="#999999"> کد ملی<br /></td>
      <td width="12%" bgcolor="#999999">نام خانوادگی</td>
      <td width="9%" bgcolor="#999999"> نام </td>
      <td width="10%" bgcolor="#999999">نوع بهره بردار</td>
      <td width="13%" bgcolor="#999999">شهر / آبادی </td>
      <td width="12%" bgcolor="#999999">شهرستان </td>
      <td width="6%" bgcolor="#999999">ردیف</td>
    </tr>
    <tr>
      <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$mor_cod_m=$row['mor_cod_m'];
$pic = user_pic($mor_cod_m) ;
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
if ($add_abadi<>'') {
$query = "SELECT * from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$abadi= $row2['abadi'] ; 
$mar = $row2['mar'];
}
if ($add_city<>'') {
$query = "SELECT * from list_city where add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$shahr= $row2['shahr'] ; 
$mar = $row2['mar'];
}

//echo $row2['User_Name'] ; 
?>
      <td width="7%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="confi_benef.php" method="post">
       <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
       <input type="hidden" name="back_no" value="4" />
       <button>
        <?php if ($row['confi']=='') {?>
        <img src="../files/FAQ.png" title="اعتبار رکورد بررسی نشده "  width="33" height="26"  alt=""/> <?php }?>
        <?php if ($row['confi']=='1') {?>
        <img src="../files/icon1Active.png" title="اعتبار رکورد تایید شده"  width="33" height="26"  alt=""/> <?php }?>
        <?php if ($row['confi']=='2') {?>
        <img src="../files/icon1Inactive.png" title="اعتبار رکورد تایید نشده"  width="33" height="26"  alt=""/> <?php }?>
        
        </button>
      </form></td>

      <td width="7%" height="72" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="view_benef.php" method="post">
        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
        <input type="hidden" name="back_no" value="4" />
        <button><img src="../files/view.png" title="نمایش اطلاعات بهره بردار"  width="33" height="26"  alt=""/></button>
      </form></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo $pic ?>" width="28" height="34"  alt=""/><br />
        <?php echo user_name($mor_cod_m)?><br/>
        <?php echo $mor_cod_m?><br /></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="11%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
      <?php if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;?>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['abadi'];?><?php echo $row2['shahr'];?></td>
      <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['city'];?></td>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
}
?>
  </table>
  <p>&nbsp;</p>
           <p> <p><a href="list_abadi.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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



