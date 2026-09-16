<?php
include_once('../../login/config.php');
$query = "SELECT * from D_mav1_etab where 1"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sal    = $row['sal'] ;
$date_s = $row["date_s"]; 
$t_mo    = $row['t_mo'] ;
$t_pro = $row["t_pro"]; 
$A1=$row["A1"];$A2=$row["A2"];$A3=$row["A3"];$A4=$row["A4"];$A5=$row["A5"];$A6=$row["A6"];$A7=$row["A7"];$A8=$row["A8"];$A9=$row["A9"]; 
$B1=$row["B1"];$B2=$row["B2"];$B3=$row["B3"];$B4=$row["B4"];$B5=$row["B5"];$B6=$row["B6"];$B7=$row["B7"];$B8=$row["B8"];$B9=$row["B9"];  
$C1=$row["C1"];$C2=$row["C2"];$C3=$row["C3"];$C4=$row["C4"];$C5=$row["C5"];$C6=$row["C6"];$C7=$row["C7"];$C8=$row["C8"];$C9=$row["C9"]; 
$D1=$row["D1"];$D2=$row["D2"];$D3=$row["D3"];$D4=$row["D4"];$D5=$row["D5"];$D6=$row["D6"];$D7=$row["D7"];$D8=$row["D8"];$D9=$row["D9"]; 
$E1=$row["E1"];$E2=$row["E2"];$E3=$row["E3"];$E4=$row["E4"];$E5=$row["E5"];$E6=$row["E6"];$E7=$row["E7"];$E8=$row["E8"];$E9=$row["E9"];  
$F1=$row["F1"];$F2=$row["F2"];$F3=$row["F3"];$F4=$row["F4"];$F5=$row["F5"];$F6=$row["F6"];$F7=$row["F7"];$F8=$row["F8"];$F9=$row["F9"];  
$G1=$row["G1"];$G2=$row["G2"];$G3=$row["G3"];$G4=$row["G4"];$G5=$row["G5"];$G6=$row["G6"];$G7=$row["G7"];$G8=$row["G8"];$G9=$row["G9"];  
$H1=$row["H1"];$H2=$row["H2"];$H3=$row["H3"];$H4=$row["H4"];$H5=$row["H5"];$H6=$row["H6"];$H7=$row["H7"];$H8=$row["H8"];$H9=$row["H9"];  
$I1=$row["I1"];$I2=$row["I2"];$I3=$row["I3"];$I4=$row["I4"];$I5=$row["I5"];$I6=$row["I6"];$I7=$row["I7"];$I8=$row["I8"];$I9=$row["I9"];  
$J1 = $A1+$B1+$C1+$D1+$E1+$F1+$G1+$H1+$I1 ; 
$J2 = $A2+$B2+$C2+$D2+$E2+$F2+$G2+$H2+$I2 ; 
$J3 = $A3+$B3+$C3+$D3+$E3+$F3+$G3+$H3+$I3 ; 
$J4 = $A4+$B4+$C4+$D4+$E4+$F4+$G4+$H4+$I4 ; 
$J5 = $A5+$B5+$C5+$D5+$E5+$F5+$G5+$H5+$I5 ; 
$J6 = $A6+$B6+$C6+$D6+$E6+$F6+$G6+$H6+$I6 ; 
$J7 = $A7+$B7+$C7+$D7+$E7+$F7+$G7+$H7+$I7 ; 
$J8 = $A8+$B8+$C8+$D8+$E8+$F8+$G8+$H8+$I8 ; 
$J9 = ($J8*100)/$J1 ; 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>اعتبارات</title>
<script language="javascript" src="file:///F|/ex_hard/site/right-click.js"></script>
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style3 {color: #FFFFFF}
.style4 {	font-size: 10px;
	color: #FFFFFF;
}
.box
{
 width:200px ; float:right ; line-height:150% ; margin-left:20px ; margin-top:20px ; margin-bottom:30px ; font-family:Tahoma ; margin-right:50px 
}
.tricky_image {
	margin-bottom:10px;
    max-width:86px; 
    max-height:86px;
    -moz-transition: all 1s; 
    -webkit-transition: all 1s;  
    -ms-transition: all 1s;  
    -o-transition: all 1s;  
    transition: all 1s; 
    opacity:1;
    filter:alpha(opacity=100);
}

.tricky_image:hover {
    opacity:0.2;
    filter:alpha(opacity=20);
}
body {
	background-image: url(files/templatemo_body.jpg);
}
</style>
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
              <p align="center"><span class="style19" style="margin-right:30px">جدول اعتبارات مصوب به تفکیک نوع تخصیص در سال <?php echo $sal; ?></span><br />
                <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>              </p>
              <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="31%"><span class="style19">ارقام : میلیون ریال</span></td>
                  <td width="11%" class="style19"><div align="right"></div></td>
                  <td width="28%" class="style19">&nbsp;</td>
                  <td width="14%" class="style19"><div align="center"><?php echo $date_s ; ?></div></td>
                  <td width="16%" class="style19">: تاریخ بروزرسانی </td>
                </tr>
                <tr>
                  <td height="44">&nbsp;</td>
                  <td class="style19"><div align="center" class="style19"> <?php echo $t_pro ; ?> <br />
                  </div></td>
                  <td class="style19"> : تعداد پروژه</td>
                  <td><div align="center" class="style19"> <?php echo $t_mo ; ?> <br />
                  </div></td>
                  <td class="style19"> : تعداد موافقتنامه</td>
                </tr>
              </table>
              <table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" class="input_text">
                <tr>
                  <td colspan="8">تخصیص</td>
                  <td width="11%" rowspan="3">مصوب</td>
                  <td width="22%" rowspan="3">منابع</td>
                </tr>
                <tr>
                  <td width="5%" rowspan="2">درصد </td>
                  <td width="12%" rowspan="2">جمع </td>
                  <td colspan="2">بند ه تبصره 5</td>
                  <td colspan="3">بند ب تبصره 5</td>
                  <td width="11%" rowspan="2">نقدی</td>
                  </tr>
                <tr>
                  <td>سه ساله</td>
                  <td>یک ساله</td>
                  <td>سه ساله</td>
                  <td>دو ساله</td>
                  <td> یک ساله</td>
                  </tr>
                <tr>
                  <td><div align="center" class="style19"> <?php echo round($A9,2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A8) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A7) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A6) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A5) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A4) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A3) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19">
                    <?php echo number_format($A1) ; ?>
                    <br />
                  </div></td>
                  <td>تملک دارایی های سرمایه ای استان </td>
                  </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo round($B9,2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($B8) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($B7) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($B6) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($B5) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($B4) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($B3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($B2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($B1) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC">سه درصد درآمد حاصل از صادرات نفت خام و گاز طبیعی</td>
                </tr>
                <tr>
                  <td><div align="center" class="style19"> <?php echo round($C9,2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($C8) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($C7) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($C6) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($C5) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($C4) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($C3) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($C2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($C1) ; ?> <br />
                  </div></td>
                  <td>اعتبارات موضوع قانون استفاده متوازن از امکانات کشور </td>
                </tr>
                <tr>
                  <td height="32" bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo round($D9,2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($D8) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($D7) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($D6) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($D5) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($D4) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($D3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($D2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($D1) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC">ماده 10</td>
                </tr>
                <tr>
                  <td height="31"><div align="center" class="style19"> <?php echo round($E9,2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($E8) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($E7) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($E6) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($E5) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($E4) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($E3) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($E2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($E1) ; ?> <br />
                  </div></td>
                  <td>ماده 12</td>
                </tr>
                <tr>
                  <td height="32" bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo round($F9,2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($F8) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($F7) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($F6) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($F5) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($F4) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($F3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($F2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($F1) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC">جزء 1 ردیف 550000</td>
                </tr>
                <tr>
                  <td height="31"><div align="center" class="style19"> <?php echo round($G9,2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($G8) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($G7) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($G6) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($G5) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($G4) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($G3) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($G2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($G1) ; ?> <br />
                  </div></td>
                  <td>فروش اموال </td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo round($H9,2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($H8) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($H7) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($H6) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($H5) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($H4) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($H3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($H2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($H1) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC">ارتقای شاخص های توسعه اقتصادی</td>
                </tr>
                <tr>
                  <td height="31"><div align="center" class="style19"> <?php echo round($I9,2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($I8) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($I7) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($I6) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($I5) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($I4) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($I3) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($I2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($I1) ; ?> <br />
                  </div></td>
                  <td>مازاد درآمد استانی</td>
                </tr>
                <tr>
                  <td><div align="center" class="style19"> <?php echo round($J9,2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($J8) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($J7) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($J6) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($J5) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($J4) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($J3) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($J2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($J1) ; ?> <br />
                  </div></td>
                  <td class="style19">جمع کل</td>
                </tr>
            </table>
              <p class="style9">&nbsp;</p></td>
          </tr>
                    <tr>
            <td  height="100px"colspan="2" valign="middle" ><p class="LinkRedTitle"><a href="mav_01.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p></td>
          </tr>

          <tr>
                <td  height="100px"colspan="2" valign="middle" background="files/bottom.gif"><p class="style3">Copyright © 2013, سازمان جهاد کشاورزی آذربایجان شرقیAll rights   reserved</p>
              <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
          </tr>
        </table>
      </div></td>
      </tr>
  </table></td>
</tr>
</table>
</body>
</html>