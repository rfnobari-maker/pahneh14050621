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
$A6= ($A4*100)/$A1 ; 

$B1=$_POST['B1'];$B2=$_POST['B2'];$B3=$_POST['B3'];$B4=$_POST['B4'];$B5=$_POST['B5'];
$B6= ($B4*100)/$B1 ; 

$C1=$_POST['C1'];$C2=$_POST['C2'];$C3=$_POST['C3'];$C4=$_POST['C4'];$C5=$_POST['C5'];
$C6= ($C4*100)/$C1 ; 

$D1=$_POST['D1'];$D2=$_POST['D2'];$D3=$_POST['D3'];$D4=$_POST['D4'];$D5=$_POST['D5'];
$D6= ($D4*100)/$D1 ; 

$E1=$_POST['E1'];$E2=$_POST['E2'];$E3=$_POST['E3'];$E4=$_POST['E4'];$E5=$_POST['E5'];
$E6= ($E4*100)/$E1 ; 

$F1=$_POST['F1'];$F2=$_POST['F2'];$F3=$_POST['F3'];$F4=$_POST['F4'];$F5=$_POST['F5'];
$F6= ($F4*100)/$F1 ; 

$G1=$_POST['G1'];$G2=$_POST['G2'];$G3=$_POST['G3'];$G4=$_POST['G4'];$G5=$_POST['G5'];
$G6= ($G4*100)/$G1 ; 


$query = "UPDATE D_mav1_bohr SET date_s=?,sal=?
,A1=?,A2=?,A3=?,A4=?,A5=?,A6=?
,B1=?,B2=?,B3=?,B4=?,B5=?,B6=?
,C1=?,C2=?,C3=?,C4=?,C5=?,C6=?
,D1=?,D2=?,D3=?,D4=?,D5=?,D6=?
,E1=?,E2=?,E3=?,E4=?,E5=?,E6=?
,F1=?,F2=?,F3=?,F4=?,F5=?,F6=?
,G1=?,G2=?,G3=?,G4=?,G5=?,G6=?
WHERE 1 " ;
$q = $dbh->prepare($query);
          $q->execute(array($date_edit,$sal,
		  $A1,$A2,$A3,$A4,$A5,$A6,
		  $B1,$B2,$B3,$B4,$B5,$B6,
		  $C1,$C2,$C3,$C4,$C5,$C6,
		  $D1,$D2,$D3,$D4,$D5,$D6,
		  $E1,$E2,$E3,$E4,$E5,$E6,
		  $F1,$F2,$F3,$F4,$F5,$F6,
		  $G1,$G2,$G3,$G4,$G5,$G6
		   ));
//sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ویرایش اطلاعات مزرعه تکثیر و پرورش آبزیان - '.$bah_cod_m) ; 
unset($date_s,$sal,
          $A1,$A2,$A3,$A4,$A5,$A6,
		  $B1,$B2,$B3,$B4,$B5,$B6,
		  $C1,$C2,$C3,$C4,$C5,$C6,
		  $D1,$D2,$D3,$D4,$D5,$D6,
		  $E1,$E2,$E3,$E4,$E5,$E6,
		  $F1,$F2,$F3,$F4,$F5,$F6,
		  $G1,$G2,$G3,$G4,$G5,$G6
);
alert ('ویرایش اطلاعات گزارش جذب با موفقیت انجام شد ') ;
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
		  $G1,$G2,$G3,$G4,$G5,$G6
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
$query = "SELECT * from D_mav1_bohr where 1"; 
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
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<title>ویرایش گزارش جذب</title>
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
<table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
              <p align="center"><span class="style19" style="margin-right:30px">گزارش جذب بند (خ) ماده 33</span><br />
                <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>              </p>
    <form action="" method="post" id="form1" name="form1">
              <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="17%"><span class="style8">ارقام : میلیارد ریال</span></td>
                  <td width="25%" class="style19"><div align="right"> <?php echo $date_s ; ?> <br />
                  </div></td>
                  <td width="22%" class="style19"><span class="style8"> : تاریخ بروزرسانی قبلی</span></td>
                  <td width="21%"><div align="right">
                    <select name="sal" class="style19" id="sal"  style="height:40px ; width:70px ; direction:rtl" tabindex="1">
                      <option value="1399" <?php if($sal =='1399'){ echo 'selected="selected"' ; } ?>>1399</option>
                      <option value="1400" <?php if($sal =='1400'){ echo 'selected="selected"' ; } ?>>1400</option>
                      <option value="1401" <?php if($sal =='1401'){ echo 'selected="selected"' ; } ?>>1401</option>
                    </select>
                  </div></td>
                  <td width="15%" class="style19"><span class="style8"> : سال </span></td>
                  </tr>
              </table>
              <table width="75%" height="354" border="1" align="center" cellpadding="0" cellspacing="0">
                <col width="64" />
                <col width="151" />
                <col width="64" />
                <col width="147" />
                <col width="64" />
                <col width="103" />
                <col width="152" />
                <tr>
                  <td height="28" colspan="2" bgcolor="#CCCCCC" style="text-align: center" dir="rtl"><span class="input_text">عملکرد بانک</span></td>
                  <td colspan="2" bgcolor="#CCCCCC" style="text-align: center" dir="rtl"><span class="input_text">کل پرونده های مصوب کارگروه بند (خ) ماده (33)</span></td>
                  <td width="119" rowspan="2" bgcolor="#CCCCCC" style="text-align: center" dir="rtl"><span class="input_text">جمع اعتبار    مصوب (ابلاغی)</span></td>
                  <td width="112" rowspan="2" bgcolor="#CCCCCC" style="text-align: center" dir="rtl"><span class="input_text">نام بانک</span></td>
                  </tr>
                <tr>
                  <td width="95" height="32" align="right" bgcolor="#CCCCCC" style="text-align: center" dir="rtl"><span class="input_text">تعداد    پرونده</span></td>
                  <td width="117" align="right" bgcolor="#CCCCCC" style="text-align: center" dir="rtl"><span class="input_text">اعتبار    مصرف شده </span></td>
                  <td width="118" align="right" bgcolor="#CCCCCC" style="text-align: center" dir="rtl"><span class="input_text">تعداد پرونده</span></td>
                  <td width="148" align="right" bgcolor="#CCCCCC" style="text-align: center" dir="rtl"><span class="input_text">مبلغ    تعیین تکلیف شده</span></td>
                </tr>
                <tr>
                  <td height="44" class="input_text"><div align="center" class="style8">
                    <input name="A5" type="text" class="style8 required digits " id="A5" style="width:75px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $A5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="A4" type="text" class="style8 required number " id="A4" style="width:75px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $A4 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="A3" type="text" class="style8 required digits " id="A3" style="width:75px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $A3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="A2" type="text" class="style8 required number " id="A2" style="width:75px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $A2 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="A1" type="text" class="style8 required number " id="md_ab6" style="width:75px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $A1 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td dir="rtl" align="right"><span class="input_text">سپه</span></td>
                  </tr>
                <tr>
                  <td height="46" bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="B5" type="text" class="style8 required digits " id="A" style="width:75px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $B5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="B4" type="text" class="style8 required number " id="A4" style="width:75px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $B4 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="B3" type="text" class="style8 required digits " id="A3" style="width:75px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $B3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="B2" type="text" class="style8 required number " id="A2" style="width:75px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $B2 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="B1" type="text" class="style8 required number " id="md_ab6" style="width:75px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $B1 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td align="right" bgcolor="#FFFFCC" dir="rtl"><span class="input_text">تجارت</span></td>
                  </tr>
                <tr>
                  <td height="43" class="input_text"><div align="center" class="style8">
                    <input name="C5" type="text" class="style8 required digits " id="A5" style="width:75px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $C5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="C4" type="text" class="style8 required number " id="A4" style="width:75px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $C4 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="C3" type="text" class="style8 required digits " id="A3" style="width:75px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $C3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="C2" type="text" class="style8 required number " id="A2" style="width:75px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $C2 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="C1" type="text" class="style8 required number" id="md_ab6" style="width:75px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $C1 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td dir="rtl" align="right"><span class="input_text">ملی</span></td>
                  </tr>
                <tr>
                  <td height="44" bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="D5" type="text" class="style8 required digits" id="A5" style="width:75px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $D5 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="D4" type="text" class="style8 required number" id="A4" style="width:75px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $D4 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="D3" type="text" class="style8 required digits" id="A3" style="width:75px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $D3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="D2" type="text" class="style8 required number" id="A2" style="width:75px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $D2 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="D1" type="text" class="style8 required number" id="md_ab6" style="width:75px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $D1 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td align="right" bgcolor="#FFFFCC" dir="rtl"><span class="input_text">کشاورزی</span></td>
                  </tr>
                <tr>
                  <td height="42" class="input_text"><div align="center" class="style8">
                    <input name="E5" type="text" class="style8 required digits" id="A5" style="width:75px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $E5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="E4" type="text" class="style8 required number" id="A4" style="width:75px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $E4 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="E3" type="text" class="style8 required digits" id="A3" style="width:75px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $E3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="E2" type="text" class="style8 required number" id="A2" style="width:75px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $E2 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="E1" type="text" class="style8 required number" id="md_ab6" style="width:75px; height:30px ; " tabindex="30" dir="rtl" lang="fa" value="<?php echo $E1 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td dir="rtl" align="right"><span class="input_text">صادرات</span></td>
                  </tr>
                <tr>
                  <td height="41" bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="F5" type="text" class="style8 required digits" id="A5" style="width:75px; height:30px ; " tabindex="41" dir="rtl" lang="fa" value="<?php echo $F5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="F4" type="text" class="style8 required number" id="A4" style="width:75px; height:30px ; " tabindex="40" dir="rtl" lang="fa" value="<?php echo $F4 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="F3" type="text" class="style8 required digits" id="A3" style="width:75px; height:30px ; " tabindex="39" dir="rtl" lang="fa" value="<?php echo $F3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="F2" type="text" class="style8 required number" id="A2" style="width:75px; height:30px ; " tabindex="38" dir="rtl" lang="fa" value="<?php echo $F2 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style8">
                    <input name="F1" type="text" class="style8 required number" id="md_ab6" style="width:75px; height:30px ; " tabindex="37" dir="rtl" lang="fa" value="<?php echo $F1 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td align="right" bgcolor="#FFFFCC" dir="rtl"><span class="input_text">رفاه</span></td>
                  </tr>
                <tr>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="G5" type="text" class="style8 required digits" id="A5" style="width:75px; height:30px ; " tabindex="48" dir="rtl" lang="fa" value="<?php echo $G5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="G4" type="text" class="style8 required number" id="A4" style="width:75px; height:30px ; " tabindex="47" dir="rtl" lang="fa" value="<?php echo $G4 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="G3" type="text" class="style8 required digits" id="A3" style="width:75px; height:30px ; " tabindex="46" dir="rtl" lang="fa" value="<?php echo $G3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="G2" type="text" class="style8 required number" id="A2" style="width:75px; height:30px ; " tabindex="45" dir="rtl" lang="fa" value="<?php echo $G2 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style8">
                    <input name="G1" type="text" class="style8 required number" id="md_ab6" style="width:75px; height:30px ; " tabindex="44" dir="rtl" lang="fa" value="<?php echo $G1 ; ?>" maxlength="12" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td dir="rtl" align="right"><span class="input_text">توسعه تعاون</span></td>
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
