<?php
//include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');
include_once('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
/////////////////////////////////////////////////// 
 if (isset($_POST['action'])) 
 {  
$sal = $_POST['sal'] ; 
$t_mo = $_POST['t_mo'] ; 
$t_pro = $_POST['t_pro'] ; 

$A1=$_POST['A1'];$A2=$_POST['A2'];$A3=$_POST['A3'];$A4=$_POST['A4'];$A5=$_POST['A5'];$A6=$_POST['A6'];$A7=$_POST['A7']; 
$A8 = $A2+$A3+$A4+$A5+$A6+$A7;$A9=($A8*100)/$A1 ; 

$B1=$_POST['B1'];$B2=$_POST['B2'];$B3=$_POST['B3'];$B4=$_POST['B4'];$B5=$_POST['B5'];$B6=$_POST['B6'];$B7=$_POST['B7']; 
$B8 = $B2+$B3+$B4+$B5+$B6+$B7;$B9=($B8*100)/$B1 ; 

$C1=$_POST['C1'];$C2=$_POST['C2'];$C3=$_POST['C3'];$C4=$_POST['C4'];$C5=$_POST['C5'];$C6=$_POST['C6'];$C7=$_POST['C7']; 
$C8 = $C2+$C3+$C4+$C5+$C6+$C7;$C9=($C8*100)/$C1 ; 

$D1=$_POST['D1'];$D2=$_POST['D2'];$D3=$_POST['D3'];$D4=$_POST['D4'];$D5=$_POST['D5'];$D6=$_POST['D6'];$D7=$_POST['D7']; 
$D8 = $D2+$D3+$D4+$D5+$D6+$D7;$D9=($D8*100)/$D1 ; 

$E1=$_POST['E1'];$E2=$_POST['E2'];$E3=$_POST['E3'];$E4=$_POST['E4'];$E5=$_POST['E5'];$E6=$_POST['E6'];$E7=$_POST['E7']; 
$E8 = $E2+$E3+$E4+$E5+$E6+$E7;$E9=($E8*100)/$E1 ; 

$F1=$_POST['F1'];$F2=$_POST['F2'];$F3=$_POST['F3'];$F4=$_POST['F4'];$F5=$_POST['F5'];$F6=$_POST['F6'];$F7=$_POST['F7']; 
$F8 = $F2+$F3+$F4+$F5+$F6+$F7;$F9=($F8*100)/$F1 ; 

$G1=$_POST['G1'];$G2=$_POST['G2'];$G3=$_POST['G3'];$G4=$_POST['G4'];$G5=$_POST['G5'];$G6=$_POST['G6'];$G7=$_POST['G7']; 
$G8 = $G2+$G3+$G4+$G5+$G6+$G7;$G9=($G8*100)/$G1 ; 

$H1=$_POST['H1'];$H2=$_POST['H2'];$H3=$_POST['H3'];$H4=$_POST['H4'];$H5=$_POST['H5'];$H6=$_POST['H6'];$H7=$_POST['H7']; 
$H8 = $H2+$H3+$H4+$H5+$H6+$H7;$H9=($H8*100)/$H1 ; 

$I1=$_POST['I1'];$I2=$_POST['I2'];$I3=$_POST['I3'];$I4=$_POST['I4'];$I5=$_POST['I5'];$I6=$_POST['I6'];$I7=$_POST['I7']; 
$I8 = $I2+$I3+$I4+$I5+$I6+$I7;$I9=($I8*100)/$I1 ; 


$query = "UPDATE D_mav1_etab SET date_s=?,sal=?,t_mo=?,t_pro=?
,A1=?,A2=?,A3=?,A4=?,A5=?,A6=?,A7=?,A8=?,A9=?
,B1=?,B2=?,B3=?,B4=?,B5=?,B6=?,B7=?,B8=?,B9=?
,C1=?,C2=?,C3=?,C4=?,C5=?,C6=?,C7=?,C8=?,C9=?
,D1=?,D2=?,D3=?,D4=?,D5=?,D6=?,D7=?,D8=?,D9=?
,E1=?,E2=?,E3=?,E4=?,E5=?,E6=?,E7=?,E8=?,E9=?
,F1=?,F2=?,F3=?,F4=?,F5=?,F6=?,F7=?,F8=?,F9=?
,G1=?,G2=?,G3=?,G4=?,G5=?,G6=?,G7=?,G8=?,G9=?
,H1=?,H2=?,H3=?,H4=?,H5=?,H6=?,H7=?,H8=?,H9=?
,I1=?,I2=?,I3=?,I4=?,I5=?,I6=?,I7=?,I8=?,I9=?

WHERE 1 " ;
$q = $dbh->prepare($query);
          $q->execute(array($date_edit,$sal,$t_mo,$t_pro,
		  $A1,$A2,$A3,$A4,$A5,$A6,$A7,$A8,$A9,
		  $B1,$B2,$B3,$B4,$B5,$B6,$B7,$B8,$B9,
		  $C1,$C2,$C3,$C4,$C5,$C6,$C7,$C8,$C9,
		  $D1,$D2,$D3,$D4,$D5,$D6,$D7,$D8,$D9,
		  $E1,$E2,$E3,$E4,$E5,$E6,$E7,$E8,$E9,
		  $F1,$F2,$F3,$F4,$F5,$F6,$F7,$F8,$F9,
		  $G1,$G2,$G3,$G4,$G5,$G6,$G7,$G8,$G9,
		  $H1,$H2,$H3,$H4,$H5,$H6,$H7,$H8,$H9,
		  $I1,$I2,$I3,$I4,$I5,$I6,$I7,$I8,$I9,
		  		  
		  
		   ));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ویرایش اطلاعات مزرعه تکثیر و پرورش آبزیان - '.$bah_cod_m) ; 
unset($date_s,$sal,
          $A1,$A2,$A3,$A4,$A5,$A6,$A7,$A8,$A9,
		  $B1,$B2,$B3,$B4,$B5,$B6,$B7,$B8,$B9,
		  $C1,$C2,$C3,$C4,$C5,$C6,$C7,$C8,$C9,
		  $D1,$D2,$D3,$D4,$D5,$D6,$D7,$D8,$D9,
		  $E1,$E2,$E3,$E4,$E5,$E6,$E7,$E8,$E9,
		  $F1,$F2,$F3,$F4,$F5,$F6,$F7,$F8,$F9,
		  $G1,$G2,$G3,$G4,$G5,$G6,$G7,$G8,$G9,
		  $H1,$H2,$H3,$H4,$H5,$H6,$H7,$H8,$H9,
		  $I1,$I2,$I3,$I4,$I5,$I6,$I7,$I8,$I9,$t_mo,$t_pro
);
alert ('ویرایش اطلاعات اعتبارات با موفقیت انجام شد ') ;
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
unset($date_s,$mor_cod_m,$num_bah,$id_ostan,$id_city,$id_mar,$add_abadi,$add_city,$m_zamin,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_fa,$g_tol,$pt_no,$pt_date,$pb_no,$pb_date,$m_ab,$unit_name,$sal,$tak1,$tak2,$tak3,$tak4,$tak5,$par1,$par2,$par3,$par4);
alert ('انصراف از ثبت اطلاعات اعتبارات ') ;
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
$query = "SELECT * from D_mav1_etab where 1"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sal    = $row['sal'] ;
$date_s = $row["date_s"]; 
$t_mo    = $row['t_mo'] ;
$t_pro = $row["t_pro"]; 
$A1=$row["A1"];$A2=$row["A2"];$A3=$row["A3"];$A4=$row["A4"];$A5=$row["A5"];$A6=$row["A6"];$A7=$row["A7"]; 
$B1=$row["B1"];$B2=$row["B2"];$B3=$row["B3"];$B4=$row["B4"];$B5=$row["B5"];$B6=$row["B6"];$B7=$row["B7"]; 
$C1=$row["C1"];$C2=$row["C2"];$C3=$row["C3"];$C4=$row["C4"];$C5=$row["C5"];$C6=$row["C6"];$C7=$row["C7"]; 
$D1=$row["D1"];$D2=$row["D2"];$D3=$row["D3"];$D4=$row["D4"];$D5=$row["D5"];$D6=$row["D6"];$D7=$row["D7"]; 
$E1=$row["E1"];$E2=$row["E2"];$E3=$row["E3"];$E4=$row["E4"];$E5=$row["E5"];$E6=$row["E6"];$E7=$row["E7"]; 
$F1=$row["F1"];$F2=$row["F2"];$F3=$row["F3"];$F4=$row["F4"];$F5=$row["F5"];$F6=$row["F6"];$F7=$row["F7"]; 
$G1=$row["G1"];$G2=$row["G2"];$G3=$row["G3"];$G4=$row["G4"];$G5=$row["G5"];$G6=$row["G6"];$G7=$row["G7"]; 
$H1=$row["H1"];$H2=$row["H2"];$H3=$row["H3"];$H4=$row["H4"];$H5=$row["H5"];$H6=$row["H6"];$H7=$row["H7"]; 
$I1=$row["I1"];$I2=$row["I2"];$I3=$row["I3"];$I4=$row["I4"];$I5=$row["I5"];$I6=$row["I6"];$I7=$row["I7"]; 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>ویرایش اعتبارات تخصیصی</title>
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
            <td><img src="files/head009_241.png" width="964" height="140" /></td>
          </tr>
  <tr>
    <td>

           <p align="right" class="link" style="margin-right:30px">داشبور مدیریتی  سازمان جهاد کشاورزی<br />
             معاونت برنامه ریزی و امور اقتصادی <br />
           </p>
      <p align="right" class="link" style="margin-right:30px"></p>
           <p class="style8"><span class="style19" style="margin-right:30px">           ثبت اطلاعات  اعتبارات مصوب به تفکیک نوع تخصیص </span><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
           </p>
    <form action="" method="post" id="form1" name="form1">
           <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
             <tr>
               <td width="21%"><span class="style8">ارقام : میلیون ریال</span></td>
               <td width="21%" class="style19"><div align="right">
                 <?php echo $date_s ; ?>
                 <br />
               </div></td>
               <td width="23%" class="style19"><span class="style8">تاریخ بروزرسانی قبلی</span></td>
               <td width="19%">
                 <div align="right">
                   <select name="sal" class="style19" id="sal"  style="height:40px ; width:70px ; direction:rtl" tabindex="1">
                     <option value="1399" <?php if($sal =='1399'){ echo 'selected="selected"' ; } ?>>1399</option>
                     <option value="1400" <?php if($sal =='1400'){ echo 'selected="selected"' ; } ?>>1400</option>
                     <option value="1401" <?php if($sal =='1401'){ echo 'selected="selected"' ; } ?>>1401</option>
                   </select>
                 </div>
               </td>
               <td width="16%" class="style19"><span class="style8"> : سال </span></td>
             </tr>
             <tr>
               <td height="44">&nbsp;</td>
               <td class="style19"><div align="center" class="style8">
                 <input name="t_pro" type="text" class="style9 required digits" id="t_pro" style="width:50px; height:30px ; " tabindex="68" dir="rtl" lang="fa" value="<?php echo $t_pro ; ?>" maxlength="10" xml:lang="fa"/>
                 <br />
               </div></td>
               <td class="style8">تعداد پروژه</td>
               <td><div align="center" class="style8">
                 <input name="t_mo" type="text" class="style9 required digits" id="t_mo" style="width:50px; height:30px ; " tabindex="67" dir="rtl" lang="fa" value="<?php echo $t_mo ; ?>" maxlength="10" xml:lang="fa"/>
                 <br />
               </div></td>
               <td class="style8">تعداد موافقتنامه</td>
             </tr>
           </table>

     
<table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" class="input_text">
                <tr>
                  <td colspan="6">تخصیص</td>
                  <td width="11%" rowspan="3">مصوب</td>
                  <td width="22%" rowspan="3">منابع</td>
                </tr>
                <tr>
                  <td colspan="2">بند ه تبصره 5</td>
                  <td colspan="3">بند ب تبصره 5</td>
                  <td width="11%" rowspan="2">نقدی</td>
                  </tr>
                <tr>
                  <td width="8%">سه ساله</td>
                  <td width="6%">یک ساله</td>
                  <td width="7%">سه ساله</td>
                  <td width="8%">دو ساله</td>
                  <td width="8%"> یک ساله</td>
                  </tr>
                <tr>
                  <td><div align="center" class="style8">
                    <input name="A7" type="text" class="style8 required digits" id="md_ab7" style="width:50px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $A7 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="A6" type="text" class="style8 required digits" id="A6" style="width:50px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $A6 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="A5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $A5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="A4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $A4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="A3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $A3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="A2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $A2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="A1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $A1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td>تملک دارایی های سرمایه ای استان </td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B7" type="text" class="style8 required digits" id="md_ab7" style="width:50px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $B7 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B6" type="text" class="style8 required digits" id="A6" style="width:50px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $B6 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $B5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $B4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $B3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $B2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="B1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $B1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC">سه درصد درآمد حاصل از صادرات نفت خام و گاز طبیعی</td>
                </tr>
                <tr>
                  <td><div align="center" class="style8">
                    <input name="C7" type="text" class="style8 required digits" id="md_ab7" style="width:50px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $C7 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="C6" type="text" class="style8 required digits" id="A6" style="width:50px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $C6 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="C5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $C5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="C4" type="text" class="style8" id="A4" style="width:50px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $C4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="C3" type="text" class="style8" id="A3" style="width:50px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $C3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="C2" type="text" class="style8" id="A2" style="width:50px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $C2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="C1" type="text" class="style8" id="md_ab6" style="width:50px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $C1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td>اعتبارات موضوع قانون استفاده متوازن از امکانات کشور </td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="D7" type="text" class="style8" id="md_ab7" style="width:50px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $D7 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="D6" type="text" class="style8" id="A6" style="width:50px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $D6 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="D5" type="text" class="style8" id="A5" style="width:50px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $D5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="D4" type="text" class="style8" id="A4" style="width:50px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $D4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="D3" type="text" class="style8" id="A3" style="width:50px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $D3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="D2" type="text" class="style8" id="A2" style="width:50px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $D2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="D1" type="text" class="style8" id="md_ab6" style="width:50px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $D1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC">ماده 10</td>
                </tr>
                <tr>
                  <td><div align="center" class="style8 required digits">
                    <input name="E7" type="text" class="style8" id="md_ab7" style="width:50px; height:30px ; " tabindex="36" dir="rtl" lang="fa" value="<?php echo $E7 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="E6" type="text" class="style8" id="A6" style="width:50px; height:30px ; " tabindex="35" dir="rtl" lang="fa" value="<?php echo $E6 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="E5" type="text" class="style8" id="A5" style="width:50px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $E5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="E4" type="text" class="style8" id="A4" style="width:50px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $E4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="E3" type="text" class="style8" id="A3" style="width:50px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $E3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="E2" type="text" class="style8" id="A2" style="width:50px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $E2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="E1" type="text" class="style8" id="md_ab6" style="width:50px; height:30px ; " tabindex="30" dir="rtl" lang="fa" value="<?php echo $E1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td>ماده 12</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="F7" type="text" class="style8" id="md_ab7" style="width:50px; height:30px ; " tabindex="43" dir="rtl" lang="fa" value="<?php echo $F7 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="F6" type="text" class="style8" id="A6" style="width:50px; height:30px ; " tabindex="42" dir="rtl" lang="fa" value="<?php echo $F6 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="F5" type="text" class="style8" id="A5" style="width:50px; height:30px ; " tabindex="41" dir="rtl" lang="fa" value="<?php echo $F5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="F4" type="text" class="style8" id="A4" style="width:50px; height:30px ; " tabindex="40" dir="rtl" lang="fa" value="<?php echo $F4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="F3" type="text" class="style8" id="A3" style="width:50px; height:30px ; " tabindex="39" dir="rtl" lang="fa" value="<?php echo $F3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="F2" type="text" class="style8" id="A2" style="width:50px; height:30px ; " tabindex="38" dir="rtl" lang="fa" value="<?php echo $F2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8 required digits">
                    <input name="F1" type="text" class="style8" id="md_ab6" style="width:50px; height:30px ; " tabindex="37" dir="rtl" lang="fa" value="<?php echo $F1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC">جزء 1 ردیف 550000</td>
                </tr>
                <tr>
                  <td><div align="center" class="style8 required digits">
                    <input name="G7" type="text" class="style8" id="md_ab7" style="width:50px; height:30px ; " tabindex="50" dir="rtl" lang="fa" value="<?php echo $G7 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="G6" type="text" class="style8" id="A6" style="width:50px; height:30px ; " tabindex="49" dir="rtl" lang="fa" value="<?php echo $G6 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="G5" type="text" class="style8" id="A5" style="width:50px; height:30px ; " tabindex="48" dir="rtl" lang="fa" value="<?php echo $G5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="G4" type="text" class="style8" id="A4" style="width:50px; height:30px ; " tabindex="47" dir="rtl" lang="fa" value="<?php echo $G4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="G3" type="text" class="style8" id="A3" style="width:50px; height:30px ; " tabindex="46" dir="rtl" lang="fa" value="<?php echo $G3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="G2" type="text" class="style8" id="A2" style="width:50px; height:30px ; " tabindex="45" dir="rtl" lang="fa" value="<?php echo $G2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8 required digits">
                    <input name="G1" type="text" class="style8" id="md_ab6" style="width:50px; height:30px ; " tabindex="44" dir="rtl" lang="fa" value="<?php echo $G1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td>فروش اموال </td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="H7" type="text" class="style8 required digits" id="md_ab7" style="width:50px; height:30px ; " tabindex="57" dir="rtl" lang="fa" value="<?php echo $H7 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style8">
                    <input name="H6" type="text" class="style8 required digits" id="A6" style="width:50px; height:30px ; " tabindex="56" dir="rtl" lang="fa" value="<?php echo $H6 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
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
                  <td bgcolor="#FFFFCC">ارتقای شاخص های توسعه اقتصادی</td>
                </tr>
                <tr>
                  <td><div align="center" class="style8">
                    <input name="I7" type="text" class="style8 required digits" id="md_ab7" style="width:50px; height:30px ; " tabindex="64" dir="rtl" lang="fa" value="<?php echo $I7 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="I6" type="text" class="style8 required digits" id="A6" style="width:50px; height:30px ; " tabindex="63" dir="rtl" lang="fa" value="<?php echo $I6 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="I5" type="text" class="style8 required digits" id="A5" style="width:50px; height:30px ; " tabindex="62" dir="rtl" lang="fa" value="<?php echo $I5 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="I4" type="text" class="style8 required digits" id="A4" style="width:50px; height:30px ; " tabindex="61" dir="rtl" lang="fa" value="<?php echo $I4 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="I3" type="text" class="style8 required digits" id="A3" style="width:50px; height:30px ; " tabindex="60" dir="rtl" lang="fa" value="<?php echo $I3 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="I2" type="text" class="style8 required digits" id="A2" style="width:50px; height:30px ; " tabindex="59" dir="rtl" lang="fa" value="<?php echo $I2 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td><div align="center" class="style8">
                    <input name="I1" type="text" class="style8 required digits" id="md_ab6" style="width:50px; height:30px ; " tabindex="58" dir="rtl" lang="fa" value="<?php echo $I1 ; ?>" maxlength="10" xml:lang="fa"/>
                    <br />
                  </div></td>
                  <td>مازاد درآمد استانی</td>
                </tr>
                </table>
      <p>
        <input type="submit" name="action" value="ثبت اطلاعات" id="submit" style="width:150px ; height:45px" tabindex="65" /> 
        <input type="submit" name="action11" value="انصراف" id="submit" style="width:150px ; height:45px" tabindex="66" />
      </p>
        </p>
      </div>
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
</table>     
</body>
</html>
