<?php
//include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
/////////////////////////////////////////////////// 
 if (isset($_POST['action'])) 
 {  
$sal = $_POST['sal'] ; 

$A1=$_POST['A1'];$A2=$_POST['A2'];$A3=$_POST['A3'];$A4=$_POST['A4'];$A5=$_POST['A5'];
$A6= ($A5*100)/$A1 ; 

$B1=$_POST['B1'];$B2=$_POST['B2'];$B3=$_POST['B3'];$B4=$_POST['B4'];$B5=$_POST['B5'];
$B6= ($B5*100)/$B1 ; 

$C1=$_POST['C1'];$C2=$_POST['C2'];$C3=$_POST['C3'];$C4=$_POST['C4'];$C5=$_POST['C5'];
$C6= ($C5*100)/$C1 ; 

$D1=$_POST['D1'];$D2=$_POST['D2'];$D3=$_POST['D3'];$D4=$_POST['D4'];$D5=$_POST['D5'];
$D6= ($D5*100)/$D1 ; 

$E1=$_POST['E1'];$E2=$_POST['E2'];$E3=$_POST['E3'];$E4=$_POST['E4'];$E5=$_POST['E5'];
$E6= ($E5*100)/$E1 ; 

$F1=$_POST['F1'];$F2=$_POST['F2'];$F3=$_POST['F3'];$F4=$_POST['F4'];$F5=$_POST['F5'];
$F6= ($F5*100)/$F1 ; 

$G1=$_POST['G1'];$G2=$_POST['G2'];$G3=$_POST['G3'];$G4=$_POST['G4'];$G5=$_POST['G5'];
$G6= ($G5*100)/$G1 ; 

$H1=$_POST['H1'];$H2=$_POST['H2'];$H3=$_POST['H3'];$H4=$_POST['H4'];$H5=$_POST['H5'];
$H6= ($H5*100)/$H1 ; 

$I1=$_POST['I1'];$I2=$_POST['I2'];$I3=$_POST['I3'];$I4=$_POST['I4'];$I5=$_POST['I5'];
$I6= ($I5*100)/$I1 ; 

$J1=$_POST['J1'];$J2=$_POST['J2'];$J3=$_POST['J3'];$J4=$_POST['J4'];$J5=$_POST['J5'];
$J6= ($J5*100)/$J1 ; 

$K1=$_POST['K1'];$K2=$_POST['K2'];$K3=$_POST['K3'];$K4=$_POST['K4'];$K5=$_POST['K5'];
$K6= ($K5*100)/$K1 ; 

$L1=$_POST['L1'];$L2=$_POST['L2'];$L3=$_POST['L3'];$L4=$_POST['L4'];$L5=$_POST['L5'];
$L6= ($L5*100)/$L1 ; 


$query = "UPDATE D_mav1_tash SET date_s=?,sal=?
,A1=?,A2=?,A3=?,A4=?,A5=?,A6=?
,B1=?,B2=?,B3=?,B4=?,B5=?,B6=?
,C1=?,C2=?,C3=?,C4=?,C5=?,C6=?
,D1=?,D2=?,D3=?,D4=?,D5=?,D6=?
,E1=?,E2=?,E3=?,E4=?,E5=?,E6=?
,F1=?,F2=?,F3=?,F4=?,F5=?,F6=?
,G1=?,G2=?,G3=?,G4=?,G5=?,G6=?
,H1=?,H2=?,H3=?,H4=?,H5=?,H6=?
,I1=?,I2=?,I3=?,I4=?,I5=?,I6=?
,J1=?,J2=?,J3=?,J4=?,J5=?,J6=?
,K1=?,K2=?,K3=?,K4=?,K5=?,K6=?
,L1=?,L2=?,L3=?,L4=?,L5=?,L6=?

WHERE 1 " ;
$q = $dbh->prepare($query);
          $q->execute(array($date_edit,$sal,
		  $A1,$A2,$A3,$A4,$A5,$A6,
		  $B1,$B2,$B3,$B4,$B5,$B6,
		  $C1,$C2,$C3,$C4,$C5,$C6,
		  $D1,$D2,$D3,$D4,$D5,$D6,
		  $E1,$E2,$E3,$E4,$E5,$E6,
		  $F1,$F2,$F3,$F4,$F5,$F6,
		  $G1,$G2,$G3,$G4,$G5,$G6,
		  $H1,$H2,$H3,$H4,$H5,$H6,
		  $I1,$I2,$I3,$I4,$I5,$I6,
		  $J1,$J2,$J3,$J4,$J5,$J6,
		  $K1,$K2,$K3,$K4,$K5,$K6,		  		  		  
		  $L1,$L2,$L3,$L4,$L5,$L6		  
		   ));
//sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ویرایش اطلاعات مزرعه تکثیر و پرورش آبزیان - '.$bah_cod_m) ; 
unset($date_s,$sal,
          $A1,$A2,$A3,$A4,$A5,$A6,
		  $B1,$B2,$B3,$B4,$B5,$B6,
		  $C1,$C2,$C3,$C4,$C5,$C6,
		  $D1,$D2,$D3,$D4,$D5,$D6,
		  $E1,$E2,$E3,$E4,$E5,$E6,
		  $F1,$F2,$F3,$F4,$F5,$F6,
		  $G1,$G2,$G3,$G4,$G5,$G6,
		  $H1,$H2,$H3,$H4,$H5,$H6,
		  $I1,$I2,$I3,$I4,$I5,$I6,
          $J1,$J2,$J3,$J4,$J5,$J6,
		  $K1,$K2,$K3,$K4,$K5,$K6,		  		  		  
		  $L1,$L2,$L3,$L4,$L5,$L6		  
	  
);
alert ('ویرایش اطلاعات تسهیلات با موفقیت انجام شد ') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>

<?php
 if (isset($_POST['action11'])) 
 { 
unset($date_s,$sal,
          $A1,$A2,$A3,$A4,$A5,$A6,
		  $B1,$B2,$B3,$B4,$B5,$B6,
		  $C1,$C2,$C3,$C4,$C5,$C6,
		  $D1,$D2,$D3,$D4,$D5,$D6,
		  $E1,$E2,$E3,$E4,$E5,$E6,
		  $F1,$F2,$F3,$F4,$F5,$F6,
		  $G1,$G2,$G3,$G4,$G5,$G6,
		  $H1,$H2,$H3,$H4,$H5,$H6,
		  $I1,$I2,$I3,$I4,$I5,$I6,
          $J1,$J2,$J3,$J4,$J5,$J6,
		  $K1,$K2,$K3,$K4,$K5,$K6,		  		  		  
		  $L1,$L2,$L3,$L4,$L5,$L6		  
);
alert ('انصراف از ثبت اطلاعات تسهیلات ') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
<?php
/////////////////////////////////////////////// 
if  (1==1)
{
$query = "SELECT * from D_mav1_tash where 1"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sal    = $row['sal'] ;
$date_s = $row["date_s"]; 
$A1=$row["A1"];$A2=$row["A2"];$A3=$row["A3"];$A4=$row["A4"];$A5=$row["A5"];
$B1=$row["B1"];$B2=$row["B2"];$B3=$row["B3"];$B4=$row["B4"];$B5=$row["B5"];
$C1=$row["C1"];$C2=$row["C2"];$C3=$row["C3"];$C4=$row["C4"];$C5=$row["C5"];
$D1=$row["D1"];$D2=$row["D2"];$D3=$row["D3"];$D4=$row["D4"];$D5=$row["D5"];
$E1=$row["E1"];$E2=$row["E2"];$E3=$row["E3"];$E4=$row["E4"];$E5=$row["E5"];
$F1=$row["F1"];$F2=$row["F2"];$F3=$row["F3"];$F4=$row["F4"];$F5=$row["F5"];
$G1=$row["G1"];$G2=$row["G2"];$G3=$row["G3"];$G4=$row["G4"];$G5=$row["G5"];
$H1=$row["H1"];$H2=$row["H2"];$H3=$row["H3"];$H4=$row["H4"];$H5=$row["H5"];
$I1=$row["I1"];$I2=$row["I2"];$I3=$row["I3"];$I4=$row["I4"];$I5=$row["I5"];
$J1=$row["J1"];$J2=$row["J2"];$J3=$row["J3"];$J4=$row["J4"];$J5=$row["J5"];
$K1=$row["K1"];$K2=$row["K2"];$K3=$row["K3"];$K4=$row["K4"];$K5=$row["K5"];
$L1=$row["L1"];$L2=$row["L2"];$L3=$row["L3"];$L4=$row["L4"];$L5=$row["L5"];

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<title>ویرایش تسهیلات</title>
	<link rel="stylesheet" href="../jspc-gray.css">
	<script type="text/javascript" src="../js-persian-cal.min.js"></script>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>

</head>
<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
  <td colspan="2" valign="top" background="files/bottom.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="74%"><div align="center" class="style3">
        <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr></tr>
          <tr>
            <td><img src="files/head009_241.png" width="964" height="140" /></td>
          </tr>
          <tr>
            <td>
              <p align="right" class="link" style="margin-right:30px">&nbsp;</p>
              <p align="right" class="link" style="margin-right:30px">داشبور مدیریتی  سازمان جهاد کشاورزی<br />
                معاونت برنامه ریزی و امور اقتصادی <br />
              </p>
              <p align="right" class="link" style="margin-right:30px">&nbsp;</p>
              <p align="center"><span class="style19" style="margin-right:30px">وضعیت اعتبارات تسهیلاتی سازمان جهاد کشاورزی استان  در سال </span><br />
                <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>              </p>
    <form action="" method="post" id="form1" name="form1">
              <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="18%"><span class="style8">ارقام : میلیارد ریال</span></td>
                  <td width="26%" class="style19"><div align="right"> <?php echo $date_s ; ?> <br />
                  </div></td>
                  <td width="20%" class="style19"><span class="style8">تاریخ بروزرسانی قبلی</span></td>
                  <td width="22%"><div align="right">
                    <select name="sal" class="style19" id="sal"  style="height:40px ; width:70px ; direction:rtl" tabindex="1">
                      <option value="1399" <?php if($sal =='1399'){ echo 'selected="selected"' ; } ?>>1399</option>
                      <option value="1400" <?php if($sal =='1400'){ echo 'selected="selected"' ; } ?>>1400</option>
                      <option value="1401" <?php if($sal =='1401'){ echo 'selected="selected"' ; } ?>>1401</option>
                    </select>
                  </div></td>
                  <td width="14%" class="style19"><span class="style8"> : سال </span></td>
                  </tr>
              </table>
              <table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" class="input_text">
                <tr>
                  <td colspan="2" bgcolor="#999999">پرداخت</td>
                  <td colspan="2" bgcolor="#999999">معرفی</td>
                  <td width="13%" rowspan="2" bgcolor="#999999">سهم استان </td>
                  <td colspan="2" rowspan="2" bgcolor="#999999">بانک عامل</td>
                  <td colspan="2" rowspan="2" bgcolor="#999999">منبع تسهیلات</td>
                </tr>
                <tr>
                  <td width="10%" bgcolor="#999999">مبلغ</td>
                  <td width="8%" bgcolor="#999999">تعداد</td>
                  <td width="10%" bgcolor="#999999">مبلغ</td>
                  <td width="10%" bgcolor="#999999">تعداد</td>
                </tr>
                <tr>
                  <td><div align="center" class="style8">
                    <input name="A5" type="text" class="style8 required digits " id="A5" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $A5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="A4" type="text" class="style8 required digits " id="A4" style="width:50px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $A4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="A3" type="text" class="style8 required digits " id="A3" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $A3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="A2" type="text" class="style8 required digits " id="A2" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $A2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="A1" type="text" class="style8 required digits " id="md_ab6" style="width:50px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $A1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td width="14%">تبصره 18</td>
                  <td width="17%" rowspan="2">کشاورزی</td>
                  <td colspan="2" rowspan="6">صندوق توسعه ملی</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B5" type="text" class="style8 required digits " id="A5" style="width:50px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $B5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B4" type="text" class="style8 required digits " id="A4" style="width:50px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $B4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B3" type="text" class="style8 required digits " id="A3" style="width:50px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $B3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B2" type="text" class="style8 required digits " id="A2" style="width:50px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $B2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B1" type="text" class="style8 required digits " id="md_ab6" style="width:50px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $B1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC">ماده 52</td>
                </tr>
                <tr>
                  <td><div align="center" class="style8">
                    <input name="C5" type="text" class="style8 required digits " id="A5" style="width:50px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $C5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="C4" type="text" class="style8 required digits " id="A4" style="width:50px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $C4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="C3" type="text" class="style8 required digits " id="A3" style="width:50px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $C3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="C2" type="text" class="style8 required digits " id="A2" style="width:50px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $C2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="C1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $C1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td width="14%">تبصره 18</td>
                  <td rowspan="2">پست بانک</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="D5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $D5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="D4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $D4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="D3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $D3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="D2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $D2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="D1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $D1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC">ماده 52</td>
                </tr>
                <tr>
                  <td><div align="center" class="style8">
                    <input name="E5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $E5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="E4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $E4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="E3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $E3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="E2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $E2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="E1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="30" dir="rtl" lang="fa" value="<?php echo $E1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td width="14%">تبصره 18</td>
                  <td rowspan="2">توسعه تعاون</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="F5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="41" dir="rtl" lang="fa" value="<?php echo $F5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="F4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="40" dir="rtl" lang="fa" value="<?php echo $F4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="F3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="39" dir="rtl" lang="fa" value="<?php echo $F3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="F2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="38" dir="rtl" lang="fa" value="<?php echo $F2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="F1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="37" dir="rtl" lang="fa" value="<?php echo $F1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC">ماده 52</td>
                </tr>
                <tr>
                  <td><div align="center" class="style8">
                    <input name="G5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="48" dir="rtl" lang="fa" value="<?php echo $G5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="G4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="47" dir="rtl" lang="fa" value="<?php echo $G4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="G3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="46" dir="rtl" lang="fa" value="<?php echo $G3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="G2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="45" dir="rtl" lang="fa" value="<?php echo $G2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="G1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="44" dir="rtl" lang="fa" value="<?php echo $G1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td colspan="2">کشاورزی ، پست بانک ، توسعه تعاون ، صندوق کارآفرینی امید</td>
                  <td width="7%">روستایی</td>
                  <td width="11%" rowspan="2">سامانه کارا</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="H5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="55" dir="rtl" lang="fa" value="<?php echo $H5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="H4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="54" dir="rtl" lang="fa" value="<?php echo $H4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="H3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="53" dir="rtl" lang="fa" value="<?php echo $H3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="H2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="52" dir="rtl" lang="fa" value="<?php echo $H2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="H1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="51" dir="rtl" lang="fa" value="<?php echo $H1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td colspan="2" bgcolor="#FFFFCC">بانک های 8 گانه مطابق دستورالعمل </td>
                  <td>فراگیر</td>
                </tr>
                <tr>
                  <td><div align="center" class="style8">
                    <input name="I5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="60" dir="rtl" lang="fa" value="<?php echo $I5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="I4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="59" dir="rtl" lang="fa" value="<?php echo $I4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="I3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="58" dir="rtl" lang="fa" value="<?php echo $I3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="I2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="57" dir="rtl" lang="fa" value="<?php echo $I2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="I1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="56" dir="rtl" lang="fa" value="<?php echo $I1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td colspan="2">کلیه بانک ها </td>
                  <td colspan="2">رونق تولید </td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="J5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="65" dir="rtl" lang="fa" value="<?php echo $J5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="J4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="64" dir="rtl" lang="fa" value="<?php echo $J4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="J3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="63" dir="rtl" lang="fa" value="<?php echo $J3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="J2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="62" dir="rtl" lang="fa" value="<?php echo $J2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="J1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="61" dir="rtl" lang="fa" value="<?php echo $J1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td colspan="2" bgcolor="#FFFFCC">سینا</td>
                  <td colspan="2">تفاهم نامه توسعه روستائی</td>
                </tr>
                <tr>
                  <td><div align="center" class="style8">
                    <input name="K5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="70" dir="rtl" lang="fa" value="<?php echo $K5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="K4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="69" dir="rtl" lang="fa" value="<?php echo $K4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="K3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="68" dir="rtl" lang="fa" value="<?php echo $K3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="K2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="67" dir="rtl" lang="fa" value="<?php echo $K2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="K1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="66" dir="rtl" lang="fa" value="<?php echo $K1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td colspan="2">کشاورزی</td>
                  <td colspan="2">خط اعتباری مکانیزاسون کشاورزی</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="L5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="75" dir="rtl" lang="fa" value="<?php echo $L5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="L4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="74" dir="rtl" lang="fa" value="<?php echo $L4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="L3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="73" dir="rtl" lang="fa" value="<?php echo $L3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="L2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="72" dir="rtl" lang="fa" value="<?php echo $L2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="L1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="71" dir="rtl" lang="fa" value="<?php echo $L1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td colspan="2" bgcolor="#FFFFCC">کشاورزی</td>
                  <td colspan="2">کمک های فنی و اعتباری</td>
                </tr>
              </table>
              <p>&nbsp;              </p>
              <p>
                <input type="submit" name="action" value="ثبت اطلاعات" id="submit" style="width:150px ; height:45px" tabindex="76" /> 
                <input type="submit" name="action11" value="انصراف" id="submit" style="width:150px ; height:45px" tabindex="77" />
              </p>
    </form> 

  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
  <tr>
                <td  height="100px"colspan="2" valign="middle" background="files/bottom.gif"><p class="normalTextSmall">Copyright © 2021, سازمان جهاد کشاورزی آذربایجان شرقیAll rights   reserved</p>
    <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>

   </tr>
</table>     

</body>
</html>
