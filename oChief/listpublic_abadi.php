<?php include('../lock_oce.php');
$id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$id_mar  = isset($_POST['id_mar'])  ? $_POST['id_mar']  : '';
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
            <td><img src="../files/images/header.jpg" width="100%" height="12" /></td>
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
?>
  </p>
  <p class="style1">اطلاعات عمومی  آبادی های تحت پوشش </p>
  <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 550px; padding: 5px; border: 2px solid navy; margin: auto; text-align: left; border-radius:15px" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFCC"><font size="2" class="style1">تعیین معیار جستجو </font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td width="351" height="45" align="right" bgcolor="#FFFFFF" class="input_text" >
        <form method="post" name="form1" id="form1"  action="#1">
          <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
             <option value="0"> شهرستان</option>
            <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
            <?php }?>
          </select>
        </form>
          <?php if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
        <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان<span class="style21"><a name="1" id="1"></a></span></font></td>
      </tr>
      <tr >
        <td height="74" bgcolor="#f1f1f1" class="input_text" align="right" >
        <form method="post" name="form2" id="form2"  >
          <select dir="rtl"  name="id_mar" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
           
            <option value="0"> نام مرکز</option>
            <?php
$query = "SELECT id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan' and id_city = '$id_city'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
            <?php }?>
          </select>
          <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
        </form>
          <?php if (isset($_POST['id_mar']))
 $id_mar = $_POST['id_mar'] ; 
?></td>
        <td width="149"  align='center' bgcolor="#F1F1F1" class="style1"><font size="2" class="style8">: مرکز خدمات<span class="style21"><a name="1" id="12"></a></span></font></td>
      </tr>
      <tr >
        <td height="23" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >
        <form method="post" name="form3" id="form3" action="#3" >
          <p>
            <select dir="rtl"  name="id_deh" id="id_deh" style="width:170px ; height:40px" >
              <option value="0">کلیه دهستان ها</option>
              <?php
$query = "SELECT DISTINCT add_deh,deh FROM  list_abadi WHERE  id_mar = '$id_mar'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
              <option value="<?php echo $row['add_deh'] ;?>"
   <?php if ($row['add_deh']==$add_deh) echo 'selected=selected'?>> <?php echo $row['deh'] ;?></option>
              <?php }?>
            </select>
          </p>
          <p>
            <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
            <input name="id_mar" type="hidden"  value="<?php echo $id_mar ;?>" />
            <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          </p>
        </form></td>
        <td height="47"  align='center' bgcolor="#FFFFFF" class="style8"> : دهستان</td>
      </tr>
      <tr >
        <td height="29"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
      </tr>
    </table>
  </div>

  <p>
  <?php if(isset($_POST['action']))
{
 $id_city = $_POST['id_city'] ; 
 $id_mar = $_POST['id_mar'] ; 
 $add_deh = $_POST['id_deh'] ; 
if ($id_city == 0) { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($add_deh == 0) { $v_add_deh = 1 ;} else { $v_add_deh = "add_deh='$add_deh'" ;}
 $query = "SELECT * FROM  list_abadi where  id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar  and $v_add_deh  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>  
  <span class="style21"><a name="3" id="13"></a></span>
  <table align="center" class="my-table"  >
    <tr align="center" class="text1">
    <td height="50" colspan="3" bgcolor="#999999">عملیات</td>
    <td width="9%" height="50" bgcolor="#999999"><p> آخرین بروز رسانی اطلاعات<br />
    </p></td>
    <td colspan="2" bgcolor="#999999">مشخصات مروج آبادی</td>
    <td width="11%" bgcolor="#999999">نام آبادی</td>
    <td width="11%" bgcolor="#999999">دهستان</td>
    <td width="14%" bgcolor="#999999">شهرستان</td>
    <td width="4%" bgcolor="#999999">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['mor_cod_m'] ;
$add_abadi = $row['add_abadi'] ;
$query2 = "SELECT pic,name,last_name,tel_m,username FROM  users  where cod_m = '$cod_m' " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic_mo = $row2['pic'];
if ($pic_mo=='') $pic_mo = 'no_pic.png' ; 
// تاریخ بروز رسانی اطلاعات عمومی 
$id_abadi = substr($row['add_abadi'],10,6) ;
$query3 = "SELECT $up_date FROM  public_abadi4  where id_abadi = $id_abadi " ;
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
$up_date = $row3['up_date'] ; 
if ($up_date=='') $up_date =  '<p style=color:red> عدم بروز رسانی</p>' ;
?>
<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" height="58" class="normalTextSmaller">
    <form  action="send_sms.php" method="post" onsubmit="target_popup(this)">
    <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
    <input type="hidden" name="tel_m" value="<?php echo $row2['tel_m'] ;?>" />
    <button><img src="../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
    </form></td>
<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller">
    <form  action="send_pm.php" method="post">
    <input type="hidden" name="username" value="<?php echo $row2['username'] ;?>" />
    <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
    </form>
<td width="6%"><form  action="public_abadi.php" method="post">
  <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
  <button><img src="../files/view.png" border="0"  title="مشاهده اطلاعات عمومی آبادی" width="28" height="23" /></button>
</form></td>
   <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $up_date ;?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> width="15%" class="normalTextSmaller"><?php echo $row2['Last_name'].' '.$row2['name'];?></td>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> width="6%" class="normalTextSmaller"><img src="../files/users/<?php echo $pic_mo;?>" width="37" height="45"  alt=""/></td>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['abadi'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['deh'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
}
?>
</table>
           <p>&nbsp;</p>
           <p> <p><a href="cities&villages.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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
