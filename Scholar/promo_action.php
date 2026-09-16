<?php include("../lock_Sc.php");
include('counter2.php');
$id_ostan1 = $_POST['id_ostan'] ;
$id_city1 = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
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
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
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
  <p>
    <?php 
include('top.php'); 
include ('../login/config.php');
?>
  </p>
  <p class="style1"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 500px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1 ; border-radius:10px" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#F1F1F1"><span class="style1">گزارش عملکرد مروجین در سامانه  </span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#FFFFFF" class="input_text" ><form method="post" name="form1" id="form"  action="">
          <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
            <option value="0">انتخاب استان</option>
            <?php
$query = "SELECT id_ostan,ostan FROM ostanname"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php 
		   }?>
          </select>
        </form>
          <?php if (isset($_POST['id_ostan']))
 $id_ostan = $_POST['id_ostan'] ; 
?></td>
        <td bgcolor="#FFFFFF"><font size="2" class="style8">: استان</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#F1F1F1" class="input_text" ><form method="post" name="form1" id="form2"  action="#1">
          <select  name="id_city" disabled="disabled" class="style8" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
            <option value="0">انتخاب شهرستان</option>
            <?php
$query = "SELECT DISTINCT id_city,city FROM list_abadi WHERE  id_ostan = $id_ostan"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
            <?php 
		   }?>
          </select>
          <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
        </form>
          <?php if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
        <td><font size="2" class="style8">: شهرستان</font></td>
      </tr>
      <tr >
        <td height="23" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" ><form method="post" name="form3" id="form3"  action="#1">
          <p>
            <select dir="rtl"  name="id_mar" id="bakh" style="width:170px ; height:40px">
              <option value="0"> نام مرکز</option>
              <?php
$query = "SELECT DISTINCT id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan' and id_city = '$id_city'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
              <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
              <?php }?>
            </select>
          </p>
          <p>
            <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
            <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
            <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          </p>
        </form></td>
        <td width="163" height="47"  align='center' bgcolor="#FFFFFF" class="style8"><font size="2" class="style8">: مرکز خدمات</font></td>
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
if ($id_ostan == 0) { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
$query = "SELECT * FROM  users where  $v_id_ostan and  $v_id_city and $v_id_mar and S_access = '1' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span></p>
  <table width="90%" height="108" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC" >
    <tr align="center" class="text1">
      <td height="50" colspan="2" bgcolor="#999999">عملیات</td>
      <td width="9%" height="50" bordercolor="#66CCFF" bgcolor="#999999">زنبورستان</td>
      <td width="9%" bordercolor="#66CCFF" bgcolor="#999999"> مرغداری صنعتی</td>
      <td width="9%" bordercolor="#66CCFF" bgcolor="#999999"> قطعات باغی</td>
      <td width="8%" bordercolor="#66CCFF" bgcolor="#999999"> قطعات زراعی</td>
      <td width="9%" bordercolor="#66CCFF" bgcolor="#999999"> بهره بردار</td>
      <td width="7%" bordercolor="#66CCFF" bgcolor="#999999">آبادی</td>
      <td width="7%" bgcolor="#999999">شهر</td>
      <td colspan="2" bgcolor="#999999">مشخصات مروج </td>
      <td width="4%" bgcolor="#999999">ردیف</td>
    </tr>
    <tr>
      <?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['cod_m'] ;
$pic_mo = $row['pic'];
if ($pic_mo=='') $pic_mo = 'no_pic.png' ; ?>
      <td  width="7%" height="58" class="normalTextSmaller"  >
      <form  action="send_sms.php" method="post" onsubmit="target_popup(this)">
        <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
        <input type="hidden" name="tel_m" value="<?php echo $row['tel_m'] ;?>" />
        <button><img src="../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
      </form></td>
      <td  width="6%" class="normalTextSmaller"  >
        <form  action="send_pm.php" method="post">
          <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
          <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
        </form></td>
      <td height="58" bordercolor="#66CCFF"><?php echo mor_bee_count($row['cod_m'])?></td>
      <td bordercolor="#66CCFF"> <?php echo mor_spoul_count($cod_m)?></td>
      <td bordercolor="#66CCFF"> <?php echo mor_Garden_count($cod_m)?></td>
      <td bordercolor="#66CCFF"> <?php echo mor_Agri_count($cod_m)?></td>
      <td bordercolor="#66CCFF"> <?php echo mor_bah_count($cod_m)?></td>
      <td bordercolor="#66CCFF"> <?php echo mor_abadi_count($cod_m)?></td>
      <td  class="normalTextSmaller"  > <?php echo mor_shahr_count($cod_m)?></td>
      <td  width="10%" class="normalTextSmaller"  ><?php echo $row['Last_name'].' '.$row['name'];?></td>
      <td  width="6%" class="normalTextSmaller"  ><form  action="last_login.php" method="post" onsubmit="target_popup(this)">
      <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
      <button><img src="../files/users/<?php echo $pic_mo;?>" width="37" height="45"  alt=""/></button>
      </form> </td>
 <td ><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
}
?>
  </table>
  <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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



