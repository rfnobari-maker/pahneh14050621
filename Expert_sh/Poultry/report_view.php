<?php
include('../../lock_expsh.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
//require_once('../../ersal_p.php');
if  (isset($_POST['sh_yek']))
{
include('../../login/config.php');
$sh_yek = $_POST['sh_yek'];
$date_joj = $_POST['date_joj'];
$query = "SELECT * from samasat2 where sh_yek =:sh_yek and date_joj=:date_joj"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':sh_yek'=>$sh_yek,':date_joj'=>$date_joj));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city = $row['city']; 
$ostan = $row['ostan'] ;
$id_city = $row['id_city']; 
$id_ostan = $row['id_ostan'] ;
$sh_yek = $row['sh_yek'] ;
$date_joj = $row['date_joj'] ;
$no_joj = $row['no_joj'] ;
$m_joj = $row['m_joj'] ;
$cod_ep = $row['cod_ep'] ;
$name_unit = $row['name_unit'] ;
$name_m = $row['name_m'] ;
$z_kol = $row['z_kol'] ;
$sh_moj = $row['sh_moj'] ;
$age_day = $row['age_day'] ;
}
 ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<link href="../radio.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
        });
function close_window() {
      close();
 }
</script>
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>
           <p class="style8"> گردش کار واحد <br />
           <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
        <tr>
    <td width="4">
     </td>
    <td>
      <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="28" colspan="7" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
        </tr>
        <tr>
          <td height="30" colspan="2" bgcolor="#CCCCCC"><div align="right"><span class="normalTextSmall"><?php echo $city ; ?></span></div></td>
          <td width="21%" bgcolor="#CCCCCC"><div align="right">:شهرستان</div></td>
          <td width="4%" bgcolor="#CCCCCC">&nbsp;</td>
          <td colspan="2" bgcolor="#CCCCCC"><div align="right"><span class="normalTextSmall"><?php echo $ostan ; ?></span></div></td>
          <td width="27%" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="30" colspan="2" bgcolor="#CCCCCC"><div align="right"><span class="normalTextSmall"><?php echo $sh_yek ;  ?></span></div></td>
          <td bgcolor="#CCCCCC"><div align="right">: شناسه یکتا</div></td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td colspan="2" bgcolor="#CCCCCC"><div align="right"><span class="normalTextSmall"><?php echo $cod_ep ;  ?></span></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: کد اپیدیمیولوژیک</div></td>
        </tr>
        <tr>
          <td  height="34" colspan="2" bgcolor="#CCCCCC"><div align="right"  ><span class="normalTextSmall"><?php echo $name_m ;  ?></span></div></td>
          <td bgcolor="#CCCCCC" ><div align="right"> : نام مالک <span class="style2"></span></div></td>
          <td  bgcolor="#CCCCCC">&nbsp;</td>
          <td colspan="2"  bgcolor="#CCCCCC"><div align="right"  ><span class="normalTextSmall"><?php echo $name_unit ;  ?></span></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:30px" align="right"> : نام واحد</div></td>
          </tr>
        <tr>
          <td  height="34" colspan="2" bgcolor="#CCCCCC"><div align="right"><span class="normalTextSmall"><?php echo $sh_moj ;  ?></span></div></td>
          <td bgcolor="#CCCCCC" ><div align="right"> : شماره مجوز <span class="style2"></span></div></td>
          <td  bgcolor="#CCCCCC">&nbsp;</td>
          <td width="15%"  bgcolor="#CCCCCC"><div align="right"  ><span class="style2">قطعه</span></div></td>
          <td width="4%"  bgcolor="#CCCCCC"><div align="right"  ><span class="normalTextSmall"><?php echo $z_kol ; ?></span></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:30px" align="right"> :ظرفیت کل</div></td>
        </tr>
        <tr>
          <td width="21%" height="34" bgcolor="#CCCCCC"><div align="right"  ><span class="style2">قطعه</span></div></td>
          <td width="8%" bgcolor="#CCCCCC"><div align="right"><span class="normalTextSmall"><?php echo $no_joj ;  ?></span></div></td>
          <td bgcolor="#CCCCCC"><div align="right">:تعداد جوجه ریزی<br />
            </div></td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td colspan="2" bgcolor="#CCCCCC"><div align="right"><span class="normalTextSmall"><?php echo $date_joj ;  ?></span></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: تاریخ جوجه ریزی</div></td>
        </tr>
        </table>
         <form method="post" id="form1" name="form1">
      <table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td width="43%" height="40" bgcolor="#FFFFCC">توضیح </td>
          <td width="6%" bgcolor="#FFFFCC">سن گله</td>
          <td width="10%" bgcolor="#FFFFCC"> موجود</td>
          <td width="10%" bgcolor="#FFFFCC"> کسر شده</td>
          <td width="8%" bgcolor="#FFFFCC">تاریخ</td>
          <td width="20%" bgcolor="#FFFFCC">نوع رویداد </td>
          <td width="3%" bgcolor="#FFFFCC">ردیف</td>
        </tr>
<?php
$query = "SELECT no_event,date_event,t_kasr,comment,age_day,m_joj FROM samasat_event WHERE sh_yek = '$sh_yek' and date_joj = '$date_joj' order by id  " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ; 
foreach($stmt as $row){
$age_day = $row['age_day'] ; 
$m_joj = $row['m_joj'] ; 
$no_event = $row['no_event'] ; 
$date_event = $row['date_event'] ; 
$t_kasr = $row['t_kasr'] ; 
$comment = $row['comment'] ;
if($no_event=='1') $v_no_event = 'بازدید کارشناس شهرستان' ; 
if($no_event=='2') $v_no_event = 'کشتار' ; 
 
?>
   <tr>
          <td height="32"><div align="right"><span class="normalTextSmall"><?php echo $comment ;  ?></span></div></td>
          <td><div align="center"><span class="normalTextSmall"><?php echo $age_day ;  ?></span></div></td>
          <td><div align="center"><span class="normalTextSmall"><?php echo $m_joj ;  ?></span></div></td>
          <td height="32"><div align="center"><span class="normalTextSmall"><?php echo $t_kasr ;  ?></span></div></td>
          <td height="32"><div align="center"><span class="normalTextSmall"><?php echo $date_event ;  ?></span></div></td>
          <td height="32"><div align="right"><span class="normalTextSmall"><?php echo $v_no_event ;  ?></span></div></td>
          <td><div align="center"><span class="normalTextSmall"><?php echo $r ;  ?></span></div></td>
        </tr>
<?php 
$r = $r+1 ; 
}
?>
      </table>
      <p>
        <input type="button" name="btn1" value="بازگشت" style="width:150px ; height:45px" tabindex="33" onclick="close_window()">
        </button>
      </p>
      <tr>
  <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
        </tr>
</table>
</table>
</body>
</html>
