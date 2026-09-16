<?php
include_once('../../login/config.php');
$query = "SELECT * from D_mav1_bohr where 1"; 
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
$H1=$A1+$B1+$C1+$D1+$E1+$F1+$G1; 
$H2=$A2+$B2+$C2+$D2+$E2+$F2+$G2; 
$H3=$A3+$B3+$C3+$D3+$E3+$F3+$G3; 
$H4=$A4+$B4+$C4+$D4+$E4+$F4+$G4; 
$H5=$A5+$B5+$C5+$D5+$E5+$F5+$G5; 
$H6=($H4*100)/$H1 ; 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>تسهیلات</title>
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="speechbubbles.css" />
<script src="speechbubbles.js">
/***********************************************
* Speech Bubbles Tooltip- (c) Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/
</script>
<script language="javascript">
var popupWindow = null;
function positionedPopup(url,winName,w,h,t,l,scroll){
settings =
'height='+h+',width='+w+',top='+t+',left='+l+',scrollbars='+scroll+',resizable,location=0,status=0'
popupWindow = window.open(url,winName,settings)
}
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
              <p align="center"><span class="style19" style="margin-right:30px">گزارش جذب بند (خ) ماده 33  در سال <span class="style19" style="margin-right:30px"><?php echo $sal; ?></span></span><br />
                <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>              </p>
              <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="18%"><span class="style8">ارقام : میلیارد ریال</span></td>
                  <td width="38%" class="style19">&nbsp;</td>
                  <td width="20%"><div align="center" class="style19"><?php echo $date_s ; ?></div></td>
                  <td width="24%" class="style19"><span class="style8"> : تاریخ بروز رسانی</span></td>
                </tr>
              </table>
              <table width="75%" height="376" border="1" align="center" cellpadding="0" cellspacing="0">
                <col width="64" />
                <col width="151" />
                <col width="64" />
                <col width="147" />
                <col width="64" />
                <col width="103" />
                <col width="152" />
                <tr>
                  <td width="108" rowspan="2" style="text-align: center" dir="rtl"><span class="input_text">درصد جذب از    اعتبار ابلاغی</span></td>
                  <td colspan="2" style="text-align: center" dir="rtl"><span class="input_text">عملکرد بانک</span></td>
                  <td colspan="2" style="text-align: center" dir="rtl"><span class="input_text">کل پرونده های مصوب کارگروه بند (خ) ماده (33)</span></td>
                  <td width="101" rowspan="2" style="text-align: center" dir="rtl"><span class="input_text">جمع اعتبار    مصوب (ابلاغی)</span></td>
                  <td width="92" rowspan="2" style="text-align: center" dir="rtl"><span class="input_text">نام بانک</span></td>
                  </tr>
                <tr>
                  <td width="81" align="right" style="text-align: center" dir="rtl"><span class="input_text">تعداد    پرونده</span></td>
                  <td width="86" align="right" style="text-align: center" dir="rtl"><span class="input_text">اعتبار    مصرف شده </span></td>
                  <td width="60" align="right" style="text-align: center" dir="rtl"><span class="input_text">تعداد پرونده</span></td>
                  <td width="179" align="right" style="text-align: center" dir="rtl"><span class="input_text">مبلغ    تعیین تکلیف شده</span></td>
                </tr>
                <tr>
                  <td height="42" class="input_text"><div align="center" class="style19"> <?php echo round($A6,2) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($A5) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($A4,3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($A3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($A2,3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($A1,3) ; ?> <br />
                  </div></td>
                  <td dir="rtl" align="right"><span class="input_text">سپه</span></td>
                  </tr>
                <tr>
                  <td height="43" bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo round($B6,2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($B5) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($B4,3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($B3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($B2,3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($B1,3) ; ?> <br />
                  </div></td>
                  <td align="right" bgcolor="#FFFFCC" dir="rtl"><span class="input_text">تجارت</span></td>
                  </tr>
                <tr>
                  <td height="35" class="input_text"><div align="center" class="style19"> <?php echo round($C6,2) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($C5) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($C4,3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($C3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($C2,3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($C1,3) ; ?> <br />
                  </div></td>
                  <td dir="rtl" align="right"><span class="input_text">ملی</span></td>
                  </tr>
                <tr>
                  <td height="37" bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo round($D6,2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($D5) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($D4,3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($D3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($D2,3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($D1,3) ; ?> <br />
                  </div></td>
                  <td align="right" bgcolor="#FFFFCC" dir="rtl"><span class="input_text">کشاورزی</span></td>
                  </tr>
                <tr>
                  <td height="41" class="input_text"><div align="center" class="style19"> <?php echo round($E6,2) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($E5) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($E4,3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($E3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($E2,3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($E1,3) ; ?> <br />
                  </div></td>
                  <td dir="rtl" align="right"><span class="input_text">صادرات</span></td>
                  </tr>
                <tr>
                  <td height="33" bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo round($F6,2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($F5) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($F4,3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($F3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($F2,3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($F1,3) ; ?> <br />
                  </div></td>
                  <td align="right" bgcolor="#FFFFCC" dir="rtl"><span class="input_text">رفاه</span></td>
                  </tr>
                <tr>
                  <td height="33" class="input_text"><div align="center" class="style19"> <?php echo round($G6,2) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($G5) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($G4,3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($G3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($G2,3) ; ?> <br />
                  </div></td>
                  <td class="input_text"><div align="center" class="style19"> <?php echo number_format($G1,3) ; ?> <br />
                  </div></td>
                  <td dir="rtl" align="right"><span class="input_text">توسعه تعاون</span></td>
                  </tr>
                <tr>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo round($H6,2) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($H5) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($H4,3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($H3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($H2,3) ; ?> <br />
                  </div></td>
                  <td bgcolor="#FFFFCC" class="input_text"><div align="center" class="style19"> <?php echo number_format($H1,3) ; ?> <br />
                  </div></td>
                  <td align="right" bgcolor="#FFFFCC" dir="rtl"><span class="style19">جمع کل</span></td>
                  </tr>
            </table>
              <p  align="center"><span class="style19" style="margin-right:30px">عملكرد شهرستاني تسهیلات و کمک بلاعوض</span><br />
                <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
               
               <a href="files/pdf/mov_1/mov_1_3/mov_1_3.pdf" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city2">
               <img src="files/pdf.jpg" width="48" height="64"  alt=""/></a>
              </p>
              <p  align="center">&nbsp;</p></td>
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