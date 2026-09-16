<?php 
include('../../lock_expar.php');
include('../../event.php');
include('counter.php');
$id_city = $_POST['id_city'] ; 
$city = $_POST['city'] ; 
$id_ostan1 = $_POST['id_ostan'] ; 
$sal = $_POST['sal']
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>

    <script>
function mor_popup(form) {
    window.open('null', 'formpopup', 'width=500,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
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
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="949" height="149" /></td>
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
      <?php include('top.php');?>
      </p>
<?php
include('../../login/config.php');
$query = "SELECT * FROM  mar WHERE  id_ostan = '$id_ostan1' and id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1"> آخرین وضعیت تایید اطلاعات سرشماری زنبورستان های<br />
مراکز جهاد کشاورزی شهرستان <?php echo $city ;?></p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="98%" height="145" border="1" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="56" colspan="2" rowspan="2" bgcolor="#999999">عملیات</td>
    <td colspan="2" bgcolor="#999999">تعداد کندو<br /></td>
    <td width="9%" rowspan="2" bgcolor="#999999">تعداد زنبورستان</td>
    <td width="12%" rowspan="2" bgcolor="#999999">نام مرکز جهاد کشاورزی </td>
    <td width="12%" rowspan="2" bgcolor="#999999">کد مرکز جهاد کشاورزی </td>
    <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td bgcolor="#999999">مدرن</td>
    <td bgcolor="#999999">بومی</td>
    </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
         <?php if((mar_status($row['id_mar'])=='1') and (mar_status2($row['id_mar'])=='2') and (mar_status3($row['id_mar'])=='2') ) {?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
                 <img src="../../files/return.png" border="0"  title="عدم تایید اطلاعات مرکز و درخواست اصلاح " width="55" height="44" />
               </td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
                 <img src="../../files/coniform.png" border="0"  title="تایید اطلاعات ثبت شده مرکز " width="55" height="44" />
               </td>
            <?php } ?>

     <?php if((mar_status($row['id_mar'])=='2') and (mar_status3($row['id_mar'])=='2')) {?>
               <td colspan="2"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
              <img src="../../files/lock.gif" width="32" height="32" title="بعلت عدم تایید اطلاعات کلیه مروجین ، امکان تایید وجود ندارد"  alt=""/></td>
            <?php } ?>
      <?php if(mar_status2($row['id_mar'])=='1') {?>
              <td colspan="2"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
              <img src="../../files/ok.png" width="32" height="32" title="اطلاعات سرشماری زنبورستان های مرکز تایید شده "  alt=""/><br>
              </td>
            <?php } ?>
      <?php if(mar_status3($row['id_mar'])=='1') {?>
      <td colspan="2"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="7%" class="normalTextSmaller">
      <img src="../../files/notok.png" width="32" height="32" title="اطلاعات سرشماری زنبورستان های مرکز تایید نشده "  alt=""/><br></td>
            <?php } ?>


    <td width="7%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_kol_kmo($row['id_mar'],$sal)?></td>
    <td width="7%" class="normalTextSmaller"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_kol_kbo($row['id_mar'],$sal)?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_bee_count($row['id_mar'],$sal)?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['mar'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><form  action="mor_list.php" method="post" onsubmit="mor_popup(this)">
    <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
    <button><?php echo $row['id_mar'];?></button>
    </form></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
<?php
$r++ ; 
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="bee2.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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




