<?php
require_once("../lock_cp.php");
require_once('side_menu1.php');
require_once('counter2.php');
$id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : null;
$id_city = isset($_POST['id_city']) ? $_POST['id_city'] : null;
$id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : null;
$s_access = isset($_POST['s_access']) ? $_POST['s_access'] : null;
$date_s1 = isset($_POST['date_s1']) ? $_POST['date_s1'] : null;
$date_s2 = isset($_POST['date_s2']) ? $_POST['date_s2'] : null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../15_files/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $.mask.definitions['~'] = "[+-]";
        $("#date").mask("9999/99/99",{placeholder:"____/__/__"});
    	 $("#date2").mask("9999/99/99",{placeholder:"____/__/__"});
    });
</script>
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
}
</style>
    <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
    function target_Agri17(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600"); 
    form.target = 'formpopup'; 
	}

</script>
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
  <form method="post" name="form1" id="form2"  action="#1">
  <div style="width: 500px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style1">گزارش ورود به سامانه کاربران </span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#F1F1F1" class="input_text" >
          <select  name="id_ostan"  class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
            <option value="-1">انتخاب استان</option>
            <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php 
		   }?>
          </select></td>
        <td bgcolor="#F1F1F1"><font size="2" class="style8">: استان</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_city" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
        </select></td>
        <td bgcolor="#FFFFFF"><font size="2" class="style8">: شهرستان</font></td>
      </tr>
      <tr >
        <td height="3" align="right" bgcolor="#F1F1F1" class="input_text" ><p>
          <select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl">
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
        </p></td>
        <td width="163" valign="top" height="9"  align='center' bgcolor="#F1F1F1" class="style8"><p><font size="2" class="style8">: مرکز خدمات</font><font size="2" class="style8"><br />
        </font></p></td>
      </tr>
      <tr >
        <td height="45" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right" >
          <select name="s_access" class="required input_text" id="s_access" style="height:40px ; width:200px ; direction:rtl" tabindex="11">
            <option value="0">انتخاب سطح دسترسی</option>
            <option value="1" <?php if ($_POST['s_access']=='1') { echo 'selected="selected"' ; } ?>>مروج کشاورزی</option>
            <option value="2" <?php if ($_POST['s_access']=='2') { echo 'selected="selected"' ; } ?>>رئیس مرکز</option>
            <option value="6" <?php if ($_POST['s_access']=='6') { echo 'selected="selected"' ; } ?>>کارشناس موضوعی شهرستان</option>
            <option value="7" <?php if ($_POST['s_access']=='7') { echo 'selected="selected"' ; } ?>>محقق معین شهرستان</option>
            <option value="3" <?php if ($_POST['s_access']=='3') { echo 'selected="selected"' ; } ?>>مدیریت شهرستان</option>
            <option value="4" <?php if ($_POST['s_access']=='4') { echo 'selected="selected"' ; } ?>>مدیریت سامانه</option>
            <option value="5" <?php if ($_POST['s_access']=='5') { echo 'selected="selected"' ; } ?>>کارشناس معین استان</option>
            <option value="98" <?php if ($_POST['s_access']=='98') { echo 'selected="selected"' ; } ?>>ادمین استان</option>
            <option value="20" <?php if ($_POST['s_access']=='20') { echo 'selected="selected"' ; } ?>>مدیر کشوری سامانه</option>

          </select>
        </div></td>
        <td valign="top" height="45"  align='center' bgcolor="#FFFFFF" class="style8">:سطح دسترسی</td>
      </tr>
      <tr >
        <td height="49" align="right" bgcolor="#F1F1F1" class="input_text" ><input name="date_s2" type="text" id="date2" style="width:100px ; height:35px" tabindex="5" value="<?php echo $date_s2?>" />
          <span class="style8">: تا 
            تاریخ </span>
          <input name="date_s1" type="text" id="date" style="width:100px ; height:35px" tabindex="4" value="<?php echo $date_s1?>" /></td>
        <td valign="top" height="49"  align='center' bgcolor="#F1F1F1" class="style8"><font size="2" class="style8">: از تاریخ</font></td>
      </tr>
      <tr >
        <td height="45" align="right" bgcolor="#FFFFFF" class="input_text" ><input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" /></td>
        <td valign="top" height="45"  align='center' bgcolor="#FFFFFF" class="style8">&nbsp;</td>
      </tr>
    </table>
  </div>
  </form>
  <p>
  <?php if(isset($_POST['action']))
{
$id_city = $_POST['id_city'] ; 
$id_mar = $_POST['id_mar'] ; 
$date_s1 = $_POST['date_s1'];
$date_s2 = $_POST['date_s2'];
$s_access = $_POST['s_access']; 

if ($date_s1 == '') { $v_date_s1 = 1 ;} else { $v_date_s1 = "Last_user.date>'$date_s1'" ;}
if ($date_s2 == '') { $v_date_s2 = 1 ;} else { $v_date_s2 = "Last_user.date<'$date_s2'" ;}
if ($id_ostan == -1) { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($s_access == 0) { $v_s_access = 's_access=s_access' ;} else { $v_s_access = "s_access='$s_access'" ;}

 $query = "SELECT users.id_city,users.id_mar,users.tel_m,users.pic,users.city,users.username,users.markaz, Last_user.PersCode , Last_user.PersName,Last_user.date ,Last_user.time,Last_user.ip
FROM Last_user
INNER JOIN users ON users.username = Last_user.PersCode
where users.$v_id_ostan and $v_date_s1 and $v_date_s2 and users.$v_id_city and users.$v_id_mar and users.$v_s_access
order by users.username,Last_user.date ,Last_user.time "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span></p>
  <form  action="login_rep_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $_POST['id_city'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $_POST['id_mar'] ;?>" />
        <input type="hidden" name="date_s1" value="<?php echo $date_s1 ;?>" />
        <input type="hidden" name="date_s2" value="<?php echo $date_s2 ;?>" />
        <input type="hidden" name="s_access" value="<?php echo $s_access ;?>" />
        <button><img src="../files/xls.png" title="دانلود فایل اکسل"  width="63" height="76"  alt=""/></button>
      </form></p>
  <table width="95%" height="100" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC" >
    <tr align="center" class="text1">
      <td height="39" colspan="2" bgcolor="#999999">عملیات</td>
      <td width="10%" bordercolor="#66CCFF" bgcolor="#999999">ip</td>
      <td width="11%" bordercolor="#66CCFF" bgcolor="#999999">ساعت</td>
      <td width="10%" bordercolor="#66CCFF" bgcolor="#999999">تاریخ</td>
      <td width="13%" bordercolor="#66CCFF" bgcolor="#999999">نام مرکز</td>
      <td width="12%" bgcolor="#999999">شهرستان</td>
      <td width="10%" bgcolor="#999999">کد ملی</td>
      <td colspan="2" bgcolor="#999999">مشخصات مروج </td>
      <td width="4%" bgcolor="#999999">ردیف</td>
    </tr>
    <tr>
      <?php
$r = 1 ;
 foreach($stmt as $row){
$cod_m = $row['username'] ;
$pic_mo = $row['pic'];
if ($pic_mo=='') $pic_mo = 'no_pic.png' ; ?>
      <td  width="7%" height="59" class="normalTextSmaller"  >
      <form  action="send_sms.php" method="post" onsubmit="target_popup(this)">
        <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
        <input type="hidden" name="tel_m" value="<?php echo $row['tel_m'] ;?>" />
        <button><img src="../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
      </form></td>
      <td  width="6%" class="normalTextSmaller"  >
        <form  action="send_pm1.php#1" method="post"  onsubmit="target_Agri17(this)">
          <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
          <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
        </form></td>
      <td bordercolor="#66CCFF"><?php echo $row['ip']?></td>
      <td bordercolor="#66CCFF"><?php echo $row['time']?></td>
      <td bordercolor="#66CCFF"><?php echo $row['date']?></td>
      <td bordercolor="#66CCFF"><?php echo $row['markaz']?></td>
      <td bordercolor="#66CCFF"><?php echo $row['city']?></td>
      <td  class="normalTextSmaller"><?php echo $cod_m ?></td>
      <td  width="10%" class="normalTextSmaller"  ><?php echo $row['PersName']?></td>
      <td  width="7%" class="normalTextSmaller"  >
     <img id="img1" src="../files/users/<?php echo $pic_mo;?>" width="37" height="45"  alt=""/>
       </td>
 <td ><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
?>
  </table>
<?php } ?>
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