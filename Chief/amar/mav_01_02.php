<?php
include_once('../../login/config.php');
$query = "SELECT * from D_mav1_tash where 1"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sal    = $row['sal'] ;
$date_s = $row["date_s"]; 
$A1=$row["A1"];$A2=$row["A2"];$A3=$row["A3"];$A4=$row["A4"];$A5=$row["A5"];$A6=$row["A6"];
$B1=$row["B1"];$B2=$row["B2"];$B3=$row["B3"];$B4=$row["B4"];$B5=$row["B5"];$B6=$row["B6"];
$C1=$row["C1"];$C2=$row["C2"];$C3=$row["C3"];$C4=$row["C4"];$C5=$row["C5"];$C6=$row["C6"];
$D1=$row["D1"];$D2=$row["D2"];$D3=$row["D3"];$D4=$row["D4"];$D5=$row["D5"];$D6=$row["D6"];
$E1=$row["E1"];$E2=$row["E2"];$E3=$row["E3"];$E4=$row["E4"];$E5=$row["E5"];$E6=$row["E6"];
$F1=$row["F1"];$F2=$row["F2"];$F3=$row["F3"];$F4=$row["F4"];$F5=$row["F5"];$F6=$row["F6"];
$G1=$row["G1"];$G2=$row["G2"];$G3=$row["G3"];$G4=$row["G4"];$G5=$row["G5"];$G6=$row["G6"];
$H1=$row["H1"];$H2=$row["H2"];$H3=$row["H3"];$H4=$row["H4"];$H5=$row["H5"];$H6=$row["H6"];
$I1=$row["I1"];$I2=$row["I2"];$I3=$row["I3"];$I4=$row["I4"];$I5=$row["I5"];$I6=$row["I6"];
$J1=$row["J1"];$J2=$row["J2"];$J3=$row["J3"];$J4=$row["J4"];$J5=$row["J5"];$J6=$row["J6"];
$K1=$row["K1"];$K2=$row["K2"];$K3=$row["K3"];$K4=$row["K4"];$K5=$row["K5"];$K6=$row["K6"];
$L1=$row["L1"];$L2=$row["L2"];$L3=$row["L3"];$L4=$row["L4"];$L5=$row["L5"];$L6=$row["L6"];
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>تسهیلات</title>
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
              <p align="center"><span class="style19" style="margin-right:30px">وضعیت اعتبارات تسهیلاتی سازمان جهاد کشاورزی استان  در سال <span class="style19" style="margin-right:30px"><?php echo $sal; ?></span></span><br />
                <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>              </p>
              <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="18%"><span class="style8">ارقام : میلیارد ریال</span></td>
                  <td width="38%" class="style19">&nbsp;</td>
                  <td width="20%"><div align="center" class="style19"><?php echo $date_s ; ?></div></td>
                  <td width="24%" class="style19"><span class="style8"> : تاریخ بروز رسانی</span></td>
                </tr>
              </table>
              <table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" class="input_text">
                <tr>
                  <td width="10%" rowspan="2">عملکرد </td>
                  <td colspan="2">پرداخت</td>
                  <td colspan="2">معرفی</td>
                  <td width="11%" rowspan="2">سهم استان </td>
                  <td colspan="2" rowspan="2">بانک عامل</td>
                  <td colspan="2" rowspan="2">منبع تسهیلات</td>
                </tr>
                <tr>
                  <td width="10%">مبلغ</td>
                  <td width="8%">تعداد</td>
                  <td width="10%">مبلغ</td>
                  <td width="10%">تعداد</td>
                  </tr>
                <tr>
                  <td height="42"><div align="center" class="style19"> <?php echo round($A6,2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A5) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A4) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A3) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($A1) ; ?> <br />
                  </div></td>
                  <td width="10%">تبصره 18</td>
                  <td width="10%" rowspan="2">کشاورزی</td>
                  <td colspan="2" rowspan="6">صندوق توسعه ملی</td>
                  </tr>
                <tr>
                  <td height="43" bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo round($B6,2) ; ?> <br />
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
                  <td bgcolor="#FFFFCC">ماده 52</td>
                  </tr>
                <tr>
                  <td height="35"><div align="center" class="style19"> <?php echo round($C6,2) ; ?> <br />
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
                  <td width="10%">تبصره 18</td>
                  <td rowspan="2">پست بانک</td>
                  </tr>
                <tr>
                  <td height="37" bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo round($D6,2) ; ?> <br />
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
                  <td bgcolor="#FFFFCC">ماده 52</td>
                  </tr>
                <tr>
                  <td height="41"><div align="center" class="style19"> <?php echo round($E6,2) ; ?> <br />
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
                  <td width="10%">تبصره 18</td>
                  <td rowspan="2">توسعه تعاون</td>
                  </tr>
                <tr>
                  <td height="33" bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo round($F6,2) ; ?> <br />
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
                  <td bgcolor="#FFFFCC">ماده 52</td>
                  </tr>
                <tr>
                  <td><div align="center" class="style19"> <?php echo round($G6,2) ; ?> <br />
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
                  <td colspan="2">کشاورزی ، پست بانک ، توسعه تعاون ، صندوق کارآفرینی امید</td>
                  <td width="10%">روستایی</td>
                  <td width="11%" rowspan="2">سامانه کارا</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo round($H6,2) ; ?> <br />
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
                  <td colspan="2" bgcolor="#FFFFCC">بانک های 8 گانه مطابق دستورالعمل </td>
                  <td>فراگیر</td>
                  </tr>
                <tr>
                  <td height="35"><div align="center" class="style19"> <?php echo round($I6,2) ; ?> <br />
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
                  <td colspan="2">کلیه بانک ها </td>
                  <td colspan="2">رونق تولید </td>
                  </tr>
                <tr>
                  <td height="33" bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo round($J6,2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($J5) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($J4) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($J3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($J2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($J1) ; ?> <br />
                  </div></td>
                  <td colspan="2" bgcolor="#FFFFCC">سینا</td>
                  <td colspan="2">تفاهم نامه توسعه روستائی</td>
                </tr>
                <tr>
                  <td><div align="center" class="style19"> <?php echo round($K6,2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($K5) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($K4) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($K3) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($K2) ; ?> <br />
                  </div></td>
                  <td><div align="center" class="style19"> <?php echo number_format($K1) ; ?> <br />
                  </div></td>
                  <td colspan="2">کشاورزی</td>
                  <td colspan="2">خط اعتباری مکانیزاسون کشاورزی</td>
                </tr>
                <tr>
                  <td height="40" bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo round($L6,2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($L5) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($L4) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($L3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($L2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC"><div align="center" class="style19"> <?php echo number_format($L1) ; ?> <br />
                  </div></td>
                  <td colspan="2" bgcolor="#FFFFCC">کشاورزی</td>
                  <td colspan="2">کمک های فنی و اعتباری</td>
                </tr>
              </table>
</td>
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
  <!-- Begin WebGozar.com Counter code -->
      <script type="text/javascript" language="JavaScript" src="http://www.webgozar.ir/c.aspx?Code=3151728&amp;t=counter" ></script>
      <noscript>
        <a href="http://www.webgozar.com/counter/stats.aspx?code=3151728" target="_blank">&#1570;&#1605;&#1575;&#1585;</a>
        </noscript>
      <!-- End WebGozar.com Counter code -->
</body>
</html>