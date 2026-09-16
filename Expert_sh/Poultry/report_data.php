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
 <?php 
 if (isset($_POST['action'])) 
  {  
$t_kasr   = $_POST['t_kasr'] ; 
$comment  = $_POST['comment'];
$city = $_POST['city']; 
$ostan = $_POST['ostan'] ;
$id_city = $_POST['id_city']; 
$id_ostan = $_POST['id_ostan'] ;
$sh_yek = $_POST['sh_yek'] ;
$date_joj = $_POST['date_joj'] ;
$no_joj = $_POST['no_joj'] ;
$m_joj = $_POST['m_joj'] - $t_kasr ;
$cod_ep = $_POST['cod_ep'] ;
$name_unit = $_POST['name_unit'] ;
$name_m = $_POST['name_m'] ;
$z_kol = $_POST['z_kol'] ;
$sh_moj = $_POST['sh_moj'] ;
$age_day = $_POST['age_day'] ;


//$t_kasr,$comment,$city,$ostan,$id_city,$id_ostan,$sh_yek,$date_joj,$no_joj,$m_joj,
//$cod_ep,$name_unit,$name_m,$z_kol,$sh_moj,$age_day


//$r_user  = $_POST['username']; 
//$message = $_POST['message']; 
//require_once('Jalali.php');
//date_default_timezone_set('Asia/Tehran') ;
//$date_edit = jdate("Y/m/d");
//$time = date('H:i:s') ;
//include('login/config.php');
	$query = "INSERT INTO samasat_event (t_kasr,comment,city,ostan,id_city,id_ostan,sh_yek,date_joj,no_joj,m_joj,
cod_ep,name_unit,name_m,z_kol,sh_moj,age_day,no_event,date_event) VALUES (:t_kasr,:comment,:city,:ostan,:id_city,:id_ostan,:sh_yek,:date_joj,:no_joj,:m_joj,
:cod_ep,:name_unit,:name_m,:z_kol,:sh_moj,:age_day,:no_event,:date_event)";
    $q = $dbh->prepare($query);
    $q->execute(array(':t_kasr'=>$t_kasr,':comment'=>$comment,':city'=>$city,':ostan'=>$ostan,
	':id_city'=>$id_city,':id_ostan'=>$id_ostan,':sh_yek'=>$sh_yek,':date_joj'=>$date_joj,':no_joj'=>$no_joj,
	':m_joj'=>$m_joj,':cod_ep'=>$cod_ep,':name_unit'=>$name_unit,':name_m'=>$name_m,':z_kol'=>$z_kol,
	':sh_moj'=>$sh_moj,':age_day'=>$age_day,':no_event'=>'1',':date_event'=>$date_edit));

     $query = "UPDATE samasat2 SET m_joj = m_joj - $t_kasr  where sh_yek = $sh_yek and date_joj = '$date_joj' "; 
     $stmt = $dbh->prepare($query);
     $stmt->execute();


	sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','ثبت گزارش بازدید / '.user_name($r_user),$id_ostan) ; 


alert('اطلاعات با موفقیت ثبت شد ') ;

?>
   <script type="text/javascript">
  
      close();

</script>
<?php
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
           <p class="style8"> ثبت گزارش بازدید از واحد </p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
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
          <td bgcolor="#CCCCCC"><div align="right">:شهرستان</div></td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td colspan="2" bgcolor="#CCCCCC"><div align="right"><span class="normalTextSmall"><?php echo $ostan ; ?></span></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: استان</div></td>
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
          <td  bgcolor="#CCCCCC"><div align="right"  ><span class="style2">قطعه</span></div></td>
          <td  bgcolor="#CCCCCC"><div align="right"  ><span class="normalTextSmall"><?php echo $z_kol ; ?></span></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:30px" align="right"> :ظرفیت کل</div></td>
        </tr>
        <tr>
          <td width="15%" height="34" bgcolor="#CCCCCC"><div align="right"  ><span class="style2">قطعه</span></div></td>
          <td width="16%" bgcolor="#CCCCCC"><div align="right"><span class="normalTextSmall"><?php echo $no_joj ;  ?></span></div></td>
          <td bgcolor="#CCCCCC"><div align="right">:تعداد جوجه ریزی<br />
          </div></td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td colspan="2" bgcolor="#CCCCCC"><div align="right"><span class="normalTextSmall"><?php echo $date_joj ;  ?></span></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: تاریخ جوجه ریزی</div></td>
        </tr>
        <tr>
          <td height="38" colspan="2" bgcolor="#CCCCCC"><div align="right"  ></div></td>
          <td width="19%" bgcolor="#CCCCCC"><div align="right"><br />
            </div></td>
          <td width="4%" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="14%" bgcolor="#CCCCCC"><div align="right"  ><span class="style2">قطعه</span></div></td>
          <td width="6%" bgcolor="#CCCCCC"><div align="right"><span class="normalTextSmall"><?php echo $m_joj ;  ?></span></div></td>
          <td width="26%" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right" >: تعداد موجود</div></td>
        </tr>
        </table>
         <form method="post" id="form1" name="form1">
      <table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="47"><div align="right"><span class="style2">قطعه</span>
            <input name="t_kasr" type="text" class="input_text  required digits" max=<?php echo $m_joj ;  ?> id="t_kasr" style="width:50px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $tm_kh ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:20px" align="right" >: تعداد کسر شده</div></td>
        </tr>
        <tr>
          <td height="104"><div align="right">
            <textarea name="comment" id="comment" cols="45" rows="5" dir="rtl" style="font-family:Tahoma ; font-size:14 ; color:#069"></textarea>
          </div></td>
          <td><div style="margin-right:20px" align="right" >:توضیحات لازم</div></td>
        </tr>
      </table>
                                    <input type="hidden" name="city" value=<?php echo $city; ?> />
                                    <input type="hidden" name="ostan" value="<?php echo $ostan ;?>" />
                                    <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
                                    <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
                                    <input type="hidden" name="sh_yek" value=<?php echo $sh_yek; ?> />
                                    <input type="hidden" name="date_joj" value=<?php echo $date_joj; ?> />
                                    <input type="hidden" name="no_joj" value=<?php echo $no_joj; ?> />
                                    <input type="hidden" name="m_joj" value=<?php echo $m_joj; ?> />                                    
                                    <input type="hidden" name="cod_ep" value=<?php echo $cod_ep; ?> />
                                    <input type="hidden" name="name_unit" value=<?php echo $name_unit; ?> />
                                    <input type="hidden" name="name_m" value=<?php echo $name_m; ?> />
                                    <input type="hidden" name="z_kol"  value=<?php echo $z_kol; ?> />
                                    <input type="hidden" name="sh_moj" value=<?php echo $sh_moj; ?> />
                                    <input type="hidden" name="age_day" value=<?php echo $age_day; ?> />                                    
                                    <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="33" onclick="close_window()"></button>
                                    <input  type="submit" name="action" value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="32" id="submit" onClick="setTimeout(disableFunction, 1);"/>
            </form>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
   </tr>
</table>
</table>
</body>
</html>
