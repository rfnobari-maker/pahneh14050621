<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
require_once('counter.php');
if (isset($_POST['id_city'])) $id_city = $_POST['id_city'];
if (isset($_POST['city'])) $city = $_POST['city'];
if (isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if (isset($_POST['sal'])) $sal = $_POST['sal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style>
button
{
	border-color:#FFF ;
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
    </style>
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}

function mor_popup(form) {
    window.open('null', 'formpopup', 'width=500,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
<?php
$query = "SELECT * FROM  mar WHERE  id_ostan = '$id_ostan1' and id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1"> آخرین وضعیت تایید اطلاعات سرشماری زنبورستان های<br />
مراکز جهاد کشاورزی شهرستان <?php echo $city ;?></p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="90%" align="center" class="my-table" >
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
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >
    <form  action="mor_list.php" method="post" onsubmit="mor_popup(this)">
    <input type="hidden" name="id_mar" value="<?php echo $row['id_mar'] ;?>" />
    <input type="hidden" name="sal" value="<?php echo $sal ;?>" />
    <button><?php echo $row['id_mar'];?></button>
    </form>
    </td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
<?php
$r++ ; 
}
?>
</table>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
            <form action="bee2.php#1" method="post" id="form1" name="form1">
                            <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1?>" />
                            <input type="hidden" name="sal" value="<?php echo $sal?>" />
                            <input type="hidden" name="action" value="1" />
                            <input type="submit" name="action" value="بازگشت" id="submit"  class="btn" style="width:150px ; height:45px ; border-radius:10px ; font-family:Tahoma"   tabindex="30" />
                        </form>
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>