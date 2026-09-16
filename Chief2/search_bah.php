<?php include('../lock_ce.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="typeahead.min.js"></script>
    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search_b.php?key=%QUERY' ,
		limit : 30
    });
});
    </script>
    <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup2(form) {
    window.open('null', 'formpopup', 'width=800,height=900,resizeable,scrollbars');
    form.target = 'formpopup';
}
    function target_popup3(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600"); 
    form.target = 'formpopup'; 
	}

</script>
    <style type="text/css">
.bs-example{
	font-family: Tahoma;
	position: relative;
	margin: 30px;
	text-align: center;
}
.typeahead, .tt-query, .tt-hint {
	border: 2px solid #CCCCCC;
	border-radius: 8px;
	font-size: 16px;
	height: 30px;
	line-height: 30px;
	outline: medium none;
	padding: 8px 12px;
	width: 396px;
}
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
	color: #999999;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	font-size: 14px;
	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
    </style>
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
<?php include('top.php') ;?>
           <p class="style8">جستجوی مروج </p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
  <form action="#1" name='myform' method="post">
    <div class="row">
      <div class=".col-md-6">
        <div class="panel panel-default">
    <div dir="rtl" class="bs-example">
        <p>
          <input type="text" dir="rtl" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="نام خانوادگی">
        </p>
        <p>
          <input type="submit" name="action" value="تایید" style=" margin:auto ; width:100px ; height:45px ; font-size:14px"" tabindex="9" />
        </p>
        
    </div>
  </div>
</div>
  </div>
</form>
  <?php 
 if (isset($_POST['action'])) 
    {  
//   echo $_POST['typeahead'].'<p>' ; 
//echo stristr($_POST['typeahead'],"1");
$b = strpos($_POST['typeahead'],'-').'<p>' ;
$a= strlen($_POST['typeahead']);
$c = $a - $b ;
$cod_m =  substr($_POST['typeahead'],$b+1,$c) ;
include('counter.php');
$query = "SELECT username,tel_m,cod_m,Last_name,name,S_access,pic FROM  users WHERE  cod_m = $cod_m "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <table width="98%" height="132" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="style8">
    <td height="58" colspan="4" rowspan="2" bgcolor="#CCCCCC">عملیات</td>
    <td height="29" colspan="2" bgcolor="#CCCCCC" class="style8"> تحت پوشش</td>
    <td width="7%" rowspan="2" bgcolor="#CCCCCC">تلفن همراه</td>
    <td width="12%" rowspan="2" bgcolor="#CCCCCC">سطح دسترسی</td>
    <td width="11%" rowspan="2" bgcolor="#CCCCCC">کد ملی</td>
    <td width="13%" rowspan="2" bgcolor="#CCCCCC">نام خانوادگی</td>
    <td width="11%" rowspan="2" bgcolor="#CCCCCC">نام</td>
    <td width="5%" rowspan="2" bgcolor="#CCCCCC">تصویر</td>
    </tr>
    <tr align="center" class="style8">
      <td height="23" bgcolor="#CCCCCC" class="style8">آبادی</td>
      <td bgcolor="#CCCCCC" class="style8">شهر</td>
      </tr>
  <tr>
<?php
 foreach($stmt as $row){
  if ($row['S_access']=='1') $v_s_access = 'مروج کشاورزی' ;
  if ($row['S_access']=='2') $v_s_access = 'رئیس مرکز' ;
  if ($row['S_access']=='3') $v_s_access = 'مدیریت شهرستان' ;
  if ($row['S_access']=='4') $v_s_access = 'مدیریت سامانه' ;
  if ($row['S_access']=='5') $v_s_access = 'کارشناس معین استان' ;
  if ($row['S_access']=='6') $v_s_access = 'کارشناس موضوعی شهرستان' ;
  if ($row['S_access']=='7') $v_s_access = 'محقق معین شهرستان' ;
  if ($row['S_access']=='98') $v_s_access = 'ادمین استان' ;
  if ($row['S_access']=='20') $v_s_access = 'مدیریت کشوری سامانه' ;
  if ($row['S_access']=='99') $v_s_access = 'مدیر سامانه' ;

?>
<td  width="6%" height="58" class="normalTextSmaller">
    <form  action="send_sms.php" method="post" onsubmit="target_popup(this)">
    <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
    <input type="hidden" name="tel_m" value="<?php echo $row['tel_m'] ;?>" />
    <button><img src="../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
    </form></td>
<td   width="6%" class="normalTextSmaller">
    <form  action="send_pm1.php#1" method="post" onsubmit="target_popup3(this)">
    <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
    <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
    </form>
</td>
<td   width="7%" class="normalTextSmaller">
      <form  action="prom_operation.php" method="post">
      <input type="hidden" name="username" value="<?php echo $row['cod_m'] ;?>" />
      <button><img src="../files/History.png" border="0"  title="مشاهده عملکرد مروج در سامانه  " width="40" height="35" /></button>
      </form>
</td>

<td   width="7%" class="normalTextSmaller">
      <form  action="promo_profile.php" method="post">
      <input type="hidden" name="mor_cod_m" value="<?php echo $row['cod_m'] ;?>" />
      <button><img src="../files/adduser1.jpg" border="0"  title="مشاهده اطلاعات تکمیلی مروج " width="40" height="35" /></button>
      </form>
</td>
<td width="9%"  class="normalTextSmaller" ><form  action="promo_listsabadi.php" method="post" onsubmit="target_popup2(this)">
  <input type="hidden" name="mor_cod_m" value="<?php echo $row['cod_m'] ;?>" />
  <input type="hidden" name="name" value="<?php echo $row['name'] ;?>" />
  <input type="hidden" name="last_name" value="<?php echo $row['Last_name'] ;?>" />
  <button><?php echo mor_abadi_count($row['cod_m'])?></button>
</form></td>
<td width="6%" class="normalTextSmaller"  ><?php 
  $t_shahr =  mor_shahr_count($row['cod_m']) ;
  if ($t_shahr > 0)
  {
   ?>
  <form  action="promo_listsshahr.php" method="post">
    <input type="hidden" name="mor_cod_m" value="<?php echo $row['cod_m'] ;?>" />
    <input type="hidden" name="name" value="<?php echo $row['name'] ;?>" />
    <input type="hidden" name="last_name" value="<?php echo $row['Last_name'] ;?>" />
    <button><?php echo mor_shahr_count($row['cod_m'])?></button>
    </form>
  <?php 
  }
  else 
  {
	  echo $t_shahr ; 
	  }
   ?></td>
    <td  class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
    <td  class="normalTextSmaller"><?php echo $v_s_access;?></td>
    <td  class="normalTextSmaller"><?php echo $row['cod_m'];?></td>
    <td  class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
    <td   class="normalTextSmaller"><?php echo $row['name'];?> <span class="style21"><a name="1" id="1"></a></span></td>
    <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td><form  action="last_login.php" method="post" onsubmit="target_popup(this)">
      <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
      <button><img id="img1" src="../files/users/<?php echo $pic;?>" width="37" height="45"  alt=""/></button>
      </form></td>
    </tr>
<?php
}
}
?>
</table>
           <p>
           <p>            
           <p><a href="users.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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



