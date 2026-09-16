<?php 
require_once('Jalali.php');
$sal = $_POST['sal'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>آمار کشاورزی استان</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="speechbubbles.css" />

<script src="speechbubbles.js">

/***********************************************
* Speech Bubbles Tooltip- (c) Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/


</script>
<script type="text/javascript">
jQuery(function($){ //on document.ready
 	//Apply tooltip to links with class="addspeech", plus look inside 'speechdata.txt' for the tooltip markups
	$('a.addspeech').speechbubble({url:"speechdata.php?sal=<? echo $sal ; ?>"})
})

</script>
<style type="text/css">
<!--
      <style type="text/css">
<!--
.style1 {
	font-size: 13px;
	color: #990000;
	font-family: Tahoma;
	text-decoration: none;
}
.style2 {
	color: #FFFFFF;
	font-weight: bold;
}

.style8 {
	color: #990000;
	font-family: Tahoma;
	font-weight: bold;
	font-size: 12px;
	text-decoration: none;
}
.style10 {
	font-weight: bold;
	color: #003399;
	font-family: Tahoma;
	font-size: 16px;
}
.style15 {font-size: 12px; color: #993333;}
.style16 {font-weight: bold; color: #000000; font-family: Tahoma; font-size: 14px; }
.style17 {font-family: Tahoma; font-size: 14px; color: #000000;}
.style20 {font-family: Tahoma; font-size: 14px; color: #003399;}
.style21 {font-size: 14px}
.style23 {
	color: #990033;
	font-family: Tahoma;
}
.style25 {	font-family: Tahoma;
	font-size: 14px;
	color: #003399;
	text-decoration: none;
}
body {
	background-color: #FFC;
}
-->
</style>
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
<p align="center" class="style10"><span class="style20"><img src="arme.png" width="66" height="64" /></span></p>
<p align="center" class="style20">معاونت برنامه ریزی و امور اقتصادی</p>
<p align="center" class="style20">اداره آمار ، فناوری اطلاعات و تجهیز شبکه </p>
<p align="center" class="style16">&nbsp;</p>
<p align="center" class="style16"><span class="style10">سیمای  کشاورزی استان</span></p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
  <tr>
    <td height="52">&nbsp;</td>
    <td colspan="4" align="right"><span class="style23">موقعیت شما :<a href="map1.php" class="style25"></a></span><a href="map1.php" class="style25"> آمار اراضی سطح زیر کشت و تولیدات</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="25%"><div align="left"><span class="speechbubbles-arrow-border style1">آخرین وضعیت شهرستان </span></div></td>
    <td width="18%">&nbsp;</td>
    <td width="32%">&nbsp;</td>
    <td width="23%"><div align="center" class="style1">آخرین وضعیت استان </div></td>
    <td width="1%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><p align="right" style="margin-right:30px" class="speechbubbles-arrow-border style1"><img src="east_azarbayjan_map_92.jpg" width="506" height="526" border="0" usemap="#Map" />
        <map name="Map" id="Map">
          <a href="shahr_kol.php?id=2" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city2"><area shape="circle" coords="114,273,12"/>
          <a href="shahr_kol.php?id=13" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city13"><area shape="rect" coords="122,341,168,355"/>
          <a href="shahr_kol.php?id=2" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city2"><area shape="rect" coords="166,286,180,309"/>
          <a href="shahr_kol.php?id=3" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city3"><area shape="rect" coords="285,162,363,199"/>
          <a href="shahr_kol.php?id=3" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city3"><area shape="rect" coords="351,96,370,146"/>
          <a href="shahr_kol.php?id=4" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city4"><area shape="circle" coords="261,297,34" href="shahr_kol.php" target="_new"/>
          <ahref="shahr_kol.php?id=5" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city5"><area shape="poly" coords="159,360,136,378,113,394,117,414,150,403,166,400" />
          <a href="shahr_kol.php?id=17" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city17"><area shape="circle" coords="393,370,46"/>
          <a href="shahr_kol.php?id=6" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city6"><area shape="circle" coords="195,258,22"/>
          <a href="shahr_kol.php?id=15" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city15"><area shape="rect" coords="63,127,161,189"/>
          <a href="shahr_kol.php?id=12" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city12"><area shape="circle" coords="312,112,25"/>
          <a href="shahr_kol.php?id=18" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city18"><area shape="rect" coords="179,131,269,179"/>
          <a href="shahr_kol.php?id=11" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city11"><area shape="rect" coords="82,210,172,227"/>
          <a href="shahr_kol.php?id=7" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city7"><area shape="rect" coords="85,101,217,118"/>
          <a href="shahr_kol.php?id=19" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city19"><area shape="rect" coords="222,210,327,247"/>
          <a href="shahr_kol.php?id=10" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city10"><area shape="circle" coords="366,273,37"/>
          <a href="shahr_kol.php?id=8" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city8"><area shape="circle" coords="301,431,36"/>
          <a href="shahr_kol.php?id=20" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city20"><area shape="rect" coords="237,356,321,387"/>
          <a href="shahr_kol.php?id=14" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city14"><area shape="circle" coords="196,372,30" />
          <a href="shahr_kol.php?id=16" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city16"><area shape="circle" coords="171,425,19" />
          <a href="shahr_kol.php?id=1" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city1"><area shape="circle" coords="138,309,20"/>
          <a  href="shahr_kol.php?id=9" onclick="positionedPopup(this.href,'myWindow','650','450','100','200','yes');return false" class="addspeech" rel="#city9"><area shape="poly" coords="385,37,347,50,329,61,318,85,273,103,246,128,239,106,300,57,352,24,368,17"/>
          
        </map>
      </p>    </td>
    <td valign="top"><p>
      <!--START OSTAN -->
</head>
  <? 
error_reporting(0) ;
$con = mysql_connect("localhost", "eagri_nobari", "13520312") or die( "  خطا : نام هاست ، نام کاربر و یا کلمه عبور اشتباه است  <img src='..\images\error_big.gif' width='48' height='48'>");
mysql_select_db("eagri_download") or die("  خطا : جدول مورد نظر یافت نشد  <img src='..\images\error_big.gif' width='48' height='48'>"); 
$data = mysql_query("SELECT * FROM amar where city = '99' and sal = '$sal' ")
or die(mysql_error()); 
$row2=mysql_fetch_row($data) ; 
$ar_ab = $row2[6];
$ar_de = $row2[10];
$ar_ad = $row2[11];
$t_mh = $row2[16];
mysql_close($con);
?>
  <body>
<table width="293" border="1" align="center" cellpadding="0" cellspacing="0" class="style1" bgcolor="#FFFFFF">
  <tr>
    <td height="34" colspan="3" valign="middle"  bgcolor="#990033" ><div align="center" class="style1" >
    <p class="style2">کل استان </p>
    </div></td>
  </tr>
  <tr>
    <td height="33"> 
    
    <form id="ff" method="post" action="">
	    <p align="center">
		  <select name="sal">
        <option value="91-92" selected="selected">91-92</option>
  	    <option value="90-91" 
			  <?php  $id = '90-91' ; 
		  if($id==$_POST["sal"])	
		  {	
		  echo ' selected="selected"';	
		  }
		  ?>
		>90-91</option>

  	    <option value="89-90" 
			  <?php  $id = '89-90' ; 
		  if($id==$_POST["sal"])	
		  {	
		  echo ' selected="selected"';	
		  }
		  ?>
		>89-90</option>
  	    <option value="88-89" 
			  <?php  $id = '88-89' ; 
		  if($id==$_POST["sal"])	
		  {	
		  echo ' selected="selected"';	
		  }
		  ?>
		>88-89</option>

  	    <option value="87-88" 
			  <?php  $id = '87-88' ; 
		  if($id==$_POST["sal"])	
		  {	
		  echo ' selected="selected"';	
		  }
		  ?>
		>87-88</option>

  	    <option value="86-87" 
			  <?php  $id = '86-87' ; 
		  if($id==$_POST["sal"])	
		  {	
		  echo ' selected="selected"';	
		  }
		  ?>
		>86-87</option>

  	    <option value="85-86" 
			  <?php  $id = '85-86' ; 
		  if($id==$_POST["sal"])	
		  {	
		  echo ' selected="selected"';	
		  }
		  ?>
		>85-86</option>
          <option value="84-85" 
			  <?php  $id = '84-85' ; 
		  if($id==$_POST["sal"])	
		  {	
		  echo ' selected="selected"';	
		  }
		  ?>
		>84-85</option>
       </select>
	    </p>
	    <p align="center">
	      <input type="submit" value="انتخاب"></input>
        </p>
    </form>

</td>
    <td colspan="2" align="center">انتخاب سال زراعی </td>
  </tr>
  <tr>
    <td width="94" height="33"><div align="center"><? echo  Num2Fa($ar_ab)  ; ?></div></td>
    <td width="105"><div align="center"><a title="برای مشاهده جزئیات کلیک کنید " href="map2.php" ><img src="click.png" width="21" height="24" border="0" /></a> اراضی آبی</div></td>
    <td width="86" rowspan="3" align="center"><p>سطح زیر کشت/هکتار</p></td>
  </tr>
  <tr>
    <td height="32"><div align="center"><? echo  Num2Fa($ar_de) ; ?></div></td>
    <td><div align="center"><a title="برای مشاهده جزئیات کلیک کنید " href="map3.php"><img src="click.png" width="21" height="24" border="0" /></a>اراضی دیم</div></td>
    </tr>
  <tr>
    <td height="35"><div align="center"><? echo  Num2Fa($ar_ad) ; ?></div></td>
    <td><div align="center">کل </div></td>
    </tr>
  <tr>
    <td height="30"><div align="center"><? echo  Num2Fa($t_mh) ; ?></div></td>
    <td colspan="2"><div align="center">
      <p><a title="برای مشاهده جزئیات کلیک کنید " href="map4.php"><img src="click.png" width="21" height="24" border="0" /></a>تولید محصولات/تن</p>
    </div></td>
  </tr>
</table>
      <!--END OSTAN -->
      </p>
      <div align="center" >
        <p>&nbsp;</p>
      <table width="100%" height="41" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="84%"><div align="center" class="style8">
            <div align="right"><a href="../repo_city.php" class="style8"> آمار کلیه شهرستان ها </a></div>
          </div></td>
          <td width="16%"><div align="center"><img src="../files/images/img-head-04.gif" width="22" height="22" /></div></td>
        </tr>
      </table>
      <p><a href="../kol_city.php"></a></p>
      <p align="right" class="style23">کاربران گرامی  </p>
      <div align="right" class="style20">لطفا از مرورگر اینترنت اکسپلورر 7 یا بالاتر استفاده   کنید</div>
      <p class="style21">&nbsp;</p>
    </div></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<div align="center" class="style15">Copyright 2014, سازمان جهاد کشاورزی استان آذربایجان شرقی All   rights reserved | Web Designer : Nobari </div>
<p align="center">&nbsp;</p>
</body>
</html>
