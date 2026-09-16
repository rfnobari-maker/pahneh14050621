<?php include('../../lock_expar.php');
include('../../event.php') ;
 if (isset($_POST['action'])) 
  {  
include('../../login/config.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
 $date_s    = jdate("Y/m/d");
 $for_days  = $_POST['for_days'] ; 
 $age_day1  = $_POST['age_day1'];
 $age_day2  = $_POST['age_day2']; 
 $no_part   = $_POST['no_part'] ;
 $target    = $_POST['target']; 
 $show_list = $_POST['show_list']; 

 $no_days = slau_for_day($for_days) ; 

$query  = "SELECT min(date_check_F) as date_home,max(date_check_F) as date_end FROM  `samasat_for_day` where 1  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$date_home = $row['date_home'] ; 
$date_end = $row['date_end'] ; 
// $date_check      =  jdate('Y/m/d',time()+($for_days*86400)) ;
// $date_check_name =  jdate('l',time()+($for_days*86400)) ;
// alert( 'شما مایل به تهیه لیست کشتار تا '.$no_days.' روز آینده هستید') ;

//$query = "INSERT INTO samasat_slau_base(date_s,for_days,age_day1,age_day2,no_part,target) 
//                                VALUES (:date_s,:for_days,:age_day1,:age_day2,:no_part,:target)";
//    $q = $dbh->prepare($query);
//    $q->execute(array(':date_s'=>$date_s,':for_days'=>$for_days,':age_day1'=>$age_day1,':age_day2'=>$age_day2,
//	':no_part'=>$no_part,':target'=>$target));



 $query = "DELETE FROM `samasat_slau_data` WHERE 1 "; 
 $stmt = $dbh->prepare($query);
 $stmt->execute();

 include ('../../update_age_day.php') ;

 $query = "INSERT INTO `samasat_slau_data`(select * from samasat2 where m_joj > 0 
 and age_day >= $age_day1-$no_days)"; 
 $stmt = $dbh->prepare($query);
 $stmt->execute();
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','تهیه لیست کشتار / '.user_name($r_user),$id_ostan) ; 

?>
<form name="myform" class="myform" method="post" action="list_Slau_data.php">
<input type="hidden" name="for_days" value='<?php echo $no_days ?>'/>
<input type="hidden" name="date_home" value='<?php echo $date_home ?>'/>
<input type="hidden" name="date_end" value='<?php echo $date_end ?>'/>
<input type="hidden" name="age_day1" value='<?php echo $age_day1 ?>'/>
<input type="hidden" name="age_day2" value='<?php echo $age_day2 ?>'/>
<input type="hidden" name="no_part" value='<?php echo $no_part ?>'/>
<input type="hidden" name="target" value='<?php echo $target ?>'/>
<input type="hidden" name="show_list" value='<?php echo $show_list ?>'/>
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
//alert('اطلاعات با موفقیت ثبت شد ') ;
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
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
#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
</style>
    <script>
function sama_popup(form) {
    window.open('null', 'formpopup', 'width=700,height=700,resizeable,scrollbars');
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
  <p>
    <?php 
include('top.php'); 
?>
  </p>
  <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
  </p>
      <form  id="reg-form" method="post" action="#1">
  <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <table width="100%" height="368" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="44" colspan='4' align='center' bgcolor="#FFFFFF"><span class="style1">تنظیم لیست پیشنهادی کشتار</span></td>
      </tr>
      <tr >
        <td width="38%" height="54" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
        <td width="7%" height="54" align="right" bgcolor="#DDDDDD" class="style1" >&nbsp;</td>
        <td width="29%" height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <font size="2" class="style8"> کشتار آینده </font>
          <input name="for_days" type="text" class="input_text" id="cod_e"  style="height:35px ; width:75px " tabindex="1" value="<?php echo $cod_ep?>" />
          </div></td>
        <td width="26%" height="54"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">: پیش بینی برای</font></td>
      </tr>
      <tr >
        <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"><span class="style2">روز </span>
            <input name="age_day2" type="text" class="input_text" id="age_day2"  style="height:35px ; width:70px " tabindex="3" value="<?php echo $no_joj2 ?>" />
        </div></td>
        <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall"><font size="2" class="style8">: الی</font></td>
        <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <input name="age_day1" type="text" class="input_text" id="age_day1"  style="height:35px ; width:70px " tabindex="2" value="<?php echo $no_joj1 ?>" />
        </div></td>
        <td  align='center' bgcolor="#FFFFFF" class="style1"><span style="text-decoration: none; font-family: Tahoma; color: #990000;"><font size="2"> : سن گله در زمان کشتار </font></span></td>
      </tr>
      <tr >
        <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
        <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">&nbsp;</td>
        <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span class="style2">قطعه</span>
          <input name="no_part" type="text" class="input_text" id="no_part"  style="height:35px ; width:70px " tabindex="4" value="<?php echo $m_joj1?>" />
        </div></td>
        <td  align='center' bgcolor="#DDDDDD" class="style1"><span class="style8"><font size="2"> : تعداد بارگیری در هر نوبت</font></span></td>
      </tr>
      <tr >
        <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
        <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">&nbsp;</td>
        <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"><span class="style2">قطعه</span>
          <input name="target" type="text" class="input_text" id="zka4"  style="height:35px ; width:70px " tabindex="5" value="<?php echo $target?>" />
        </div></td>
        <td  align='center' bgcolor="#FFFFFF" class="style1"><span class="style8"><font size="2"> : تعداد هدف در روز  </font></span></td>
      </tr>
      <tr >
        <td height="60" align="left">&nbsp;</td>
        <td height="60" align="left">&nbsp;</td>
        <td height="60" align="left"><div align="right">
       <select name="show_list" class="input_text  required" id="show_list" style="height:40px ; width:100px ; direction:rtl" tabindex="6">
            <option value="1"<?php if($show_list=='1') echo "selected='selected'"?> >بلی</option>
            <option value="2"<?php if($show_list=='2') echo "selected='selected'"?> >خیر</option>
        </select>
        </div></td>
        <td height="60" align='center' bgcolor="#FFFFFF" class="style8"><span class="style8"><font size="2">: امکان مشاهده و ویرایش </font></td>
      </tr>
      <tr >
        <td height="60" colspan="4" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="7" value='ادامه' /></td>
      </tr>
    </table>
  </div>
   </form>
      <p>
      </p>
  </p>
  <p><a href="Broiler_chicken.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
