<?php 
include('../lock_ce.php');
include('counter.php');
$previous = $_POST['previous'];
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
function target_popup2(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
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
<?php
include('top.php');
if (isset($_POST['id_city'])) 
{
include_once('../login/config.php');
$id_city = $_POST['id_city'] ;
$id_ostan_sh = $_POST['id_ostan_sh'] ;
$city = $_POST['city'] ;
$query = "SELECT * FROM  users WHERE  id_ostan = '$id_ostan_sh' and id_city = '$id_city' and S_access = '1'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p>&nbsp;</p>
           <p class="style1">لیست مروجین شهرستان <?php echo $city ; ?></p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="93%" height="174" border="0" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="58" colspan="4" rowspan="2" bgcolor="#999999">عملیات</td>
    <td colspan="2" bgcolor="#999999"> تعداد  تحت پوشش</td>
    <td width="13%" rowspan="2" bgcolor="#999999">تلفن همراه</td>
    <td width="12%" rowspan="2" bgcolor="#999999">کد ملی</td>
    <td width="14%" rowspan="2" bgcolor="#999999">نام خانوادگی</td>
    <td width="10%" rowspan="2" bgcolor="#999999">نام</td>
    <td width="6%" rowspan="2" bgcolor="#999999">تصویر</td>
    <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td bgcolor="#999999">آبادی</td>
               <td bgcolor="#999999">شهر</td>
              </tr>
  <tr>
    
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" height="68" class="normalTextSmaller">
    <form  action="send_sms.php" method="post" onsubmit="target_popup(this)">
      <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
      <input type="hidden" name="tel_m" value="<?php echo $row['tel_m'] ;?>" />
      <button><img src="../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
      </form></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller">
    <form  action="send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
      <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
      <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
      </form>
  </td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller">
    <form  action="center_operation1.php#1" method="post" onsubmit="target_popup2(this)">
      <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
      <button><img src="../files/History.png" border="0"  title="مشاهده عملکرد مروج در سامانه  " width="31" height="30" /></button>
      </form>
  </td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller">
    <form  action="center_profile1.php#1" method="post" onsubmit="target_popup2(this)">
      <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
      <input type="hidden" name="cod_m" value="<?php echo $row['cod_m'] ;?>" />
      <button><img src="../files/adduser1.jpg" border="0"  title="مشاهده اطلاعات تکمیلی مروج " width="31" height="30" /></button>
      </form>
  </td>
    <td width="9%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <form  action="promo_listsabadi.php" method="post" onsubmit="target_popup2(this)">
      <input type="hidden" name="mor_cod_m" value="<?php echo $row['cod_m'] ;?>" />
      <input type="hidden" name="name" value="<?php echo $row['name'] ;?>" />
      <input type="hidden" name="last_name" value="<?php echo $row['Last_name'] ;?>" />
      <button><?php echo mor_abadi_count($row['cod_m'])?></button>
      </form>
   </td>
    <td width="6%" class="normalTextSmaller"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
   <?php 
  $t_shahr =  mor_shahr_count($row['cod_m']) ;
  if ($t_shahr > 0)
  {
   ?>
    <form  target="_parent" action="promo_listsshahr.php" method="post" onsubmit="target_popup2(this)">
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
   ?>   
      </td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['cod_m'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row['name'];?></td>
    <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img src="../files/users/<?php echo $pic ?>" width="40" height="49"  alt=""/></span></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
<?php } else { echo '<p style="color:red">'.'مجوز دسترسی به این صفحه را ندارید '.'</p>';}?>
</table>
           <p>&nbsp;</p>
           <p> 
      <form  action="centers.php" method="POST">
      <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan'] ;?>" />
      <input type="hidden" name="ostan" value="<?php echo $row['ostan'] ;?>" />
      <button style="width:120px ; height:30px ; font-family:Tahoma ; font-size:16px ">برگشت</button>
      </form>    </p>
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



