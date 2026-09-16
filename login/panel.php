<?php include("lock.php") ; ?>
<?php
# Set both random numbers you want to add
$randomNum = rand(0,9);
$randomNum2 = rand(0,9);
# Get the total.
$randomNumTotal = $randomNum + $randomNum2;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>كنترل پانل مديريت </title>
<STYLE>
TABLE TD {
	HEIGHT: 30px
}
FORM LABEL.error {
	PADDING-BOTTOM: 0px; PADDING-LEFT: 10px; PADDING-RIGHT: 0px; COLOR: red; PADDING-TOP: 0px
}
LABEL.error {
	PADDING-BOTTOM: 0px; PADDING-LEFT: 10px; PADDING-RIGHT: 0px; COLOR: red; PADDING-TOP: 0px
}
INPUT.error {
	BORDER-BOTTOM: red 1px solid; BORDER-LEFT: red 1px solid; BORDER-TOP: red 1px solid; BORDER-RIGHT: red 1px solid
}
SELECT.error {
	BORDER-BOTTOM: red 1px solid; BORDER-LEFT: red 1px solid; BORDER-TOP: red 1px solid; BORDER-RIGHT: red 1px solid
}
TEXTAREA.error {
	BORDER-BOTTOM: red 1px solid; BORDER-LEFT: red 1px solid; BORDER-TOP: red 1px solid; BORDER-RIGHT: red 1px solid
}
.required {
	COLOR: red; FONT-WEIGHT: bold
}
</STYLE>
<SCRIPT type=text/javascript src="15_files/jquery-1.3.2.min.js"></SCRIPT>

<SCRIPT type=text/javascript src="15_files/jquery.validate.min.js"></SCRIPT>

<SCRIPT type=text/javascript>
	$.validator.methods.equal = function(value, element, param) {
		return value == param;
	};
	$(document).ready(function(){
		$("#form1").validate({
				rules: {
					no_oz: "required",
					no_dar: "required",
					math: {
						equal: <?php echo $randomNumTotal; ?>	
					}
				},
				messages: {
					no_oz: " نوع عضويت انتخاب نشده است ",
					no_dar: " نوع كالا انتخاب نشده است ",
					math: " عدد وارد شده اشتباه است"
				}
			});
	});
	</SCRIPT>
<link href="FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-image: url(images/ap_bg.gif);
}
.style2 {font-size: 10px; }
.style8 {	font-size: 10px;
	color: #990000;
	text-decoration: none;
}
.style10 {
	color: #990000;
	font-size: 13px;
	margin-right: 10px;
	margin-top: 10px;
	margin-bottom: 10px;
}
-->
</style></head>
<body>
<p>&nbsp;</p>
<table width="700" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" background="images/p_bac.jpg">
  <tr>
    <td>
      <table width="90%" border="0" align="center" class="LinkTitleNews">
      <tr>
        <td width="21%" valign="middle"><a href="login/logout.php"><img title="خروج از سيستم" src="images/exit.png" width="24" height="24" border="0" /></a><a href="login/logout.php" class="LinkRedTitle"></a></td>
        <td width="34%">&nbsp;</td>
        <td width="12%">&nbsp;</td>
        <td width="21%" valign="middle"><div align="right" ><?php echo $login_session; ?></div></td>
        <td width="6%"><div align="left"><img src="images/edit_user.gif" width="22" height="22"  title="نام كاربر"/> </div></td>
        <td width="6%"><a href="chpass.php" target="_blank"><img  title="تغيير كلمه عبور" src="images/lock.gif"  border="0" width="26" height="24" /></a></td>
      </tr>
    </table>
      <p>&nbsp;</p>
      <table width="635" height="434" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#336699" background="images/p_bac.jpg">
        <tr>
          <td height="30" colspan="7" valign="middle"><div align="right" class="style10">كنترل پانل بخش مديريت</div></td>
        </tr>
        <tr>
          <td height="30" colspan="7" class="style10">مزايده ها و مناقصه ها </td>
        </tr>
        <tr>
          <td height="47">&nbsp;</td>
          <td>&nbsp;</td>
          <td><img src="images/vahed.png" width="142" height="47" /></td>
          <td>&nbsp;</td>
          <td><a href="view_bank.php"></a><img src="images/mona.png" width="142" height="47" /></td>
          <td>&nbsp;</td>
          <td><a href="view.php"></a><img src="images/moza.png" width="142" height="47" /></td>
        </tr>
        <tr>
          <td height="47">&nbsp;</td>
          <td><div align="right"></div></td>
          <td><table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#B17218">
              <tr>
                <td><a href="view_vahed.php"><img title="حذف گروه" src="images/del.png" width="40" height="38" border="0" /></a></td>
                <td><a href="view_vahed.php"><img title="ويرايش گروه" src="images/edit.png" width="40" height="38" border="0" /></a></td>
                <td><a href="new_vahed.php"><img title="ايجاد گروه جديد" src="images/new.png" width="40" height="38" border="0" /></a></td>
              </tr>
          </table></td>
          <td><div align="right"></div></td>
          <td><table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#025665">
              <tr>
                <td><a href="mona_view.php"><img title="حذف مناقصه" src="images/del.png" width="40" height="38" border="0" /></a></td>
                <td><a href="mona_view.php"><img  title="ويرايش مناقصه" src="images/edit.png" width="40" height="38" border="0" /></a></td>
                <td><a href="mona.php"><img  title="ثبت مناقصه جديد" src="images/new.png" width="40" height="38" border="0" /></a></td>
              </tr>
          </table></td>
          <td><div align="right"></div></td>
          <td><table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#074582">
              <tr>
                <td><a title="حذف مزايده ها " href="moza_view.php"><img src="images/del.png" width="40" height="38" border="0" /></a></td>
                <td><a  title="ويرايش مزايده هاي موجود" href="moza_view.php"><img src="images/edit.png" width="40" height="38" border="0" /></a></td>
                <td><a  title="ثبت مزايده جديد" href="moza.php"><img src="images/new.png" width="40" height="38" border="0" /></a></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="30" colspan="7">&nbsp;</td>
        </tr>
        <tr>
          <td height="30" colspan="7"><p class="style10">ثبت سفارش آنلاين </p>          </td>
        </tr>
        <tr>
          <td width="24%" height="47">&nbsp;</td>
          <td width="1%">&nbsp;</td>
          <td width="25%"><img src="images/darkhast.png" width="142" height="47" /></td>
          <td>&nbsp;</td>
          <td width="25%"><a href="view_bank.php"></a><img src="images/hesab.png" width="142" height="47" /></td>
          <td width="1%">&nbsp;</td>
          <td width="24%"><a href="view.php"></a><img src="images/kala.png" width="142" height="47" /></td>
        </tr>
        <tr>
          <td height="47">&nbsp;</td>
          <td><div align="right"></div></td>
          <td><table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#DA8241">
            <tr>
              <td width="46%"><div align="right"><a href="chart.php"><img src="images/cart-48.png" width="41" height="41" border="0" /></a></div></td>
              <td width="16%">&nbsp;</td>
              <td width="38%"><div align="left"><a href="fview.php"><img title="مديريت درخواست ها " src="images/view.png" width="40" height="41" border="0" /></a></div></td>
            </tr>
          </table></td>
          <td><div align="right"></div></td>
          <td><table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#025665">
              <tr>
                <td><a href="view_bank.php"><img title="حذف حساب" src="images/del.png" width="40" height="38" border="0" /></a></td>
                <td><a href="view_bank.php"><img  title="ويرايش حساب" src="images/edit.png" width="40" height="38" border="0" /></a></td>
                <td><a href="new_bank.php"><img  title="ايجاد حساب جديد" src="images/new.png" width="40" height="38" border="0" /></a></td>
              </tr>
          </table></td>
          <td><div align="right"></div></td>
          <td><table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#074582">
              <tr>
                <td><a title="حذف كالاهاي موجود" href="view.php"><img src="images/del.png" width="40" height="38" border="0" /></a></td>
                <td><a  title="ويرايش كالاي موجود" href="view.php"><img src="images/edit.png" width="40" height="38" border="0" /></a></td>
                <td><a  title="تعريف كالاي جديد" href="new.php"><img src="images/new.png" width="40" height="38" border="0" /></a></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="30">&nbsp;</td>
          <td height="30">&nbsp;</td>
          <td height="30">&nbsp;</td>
          <td height="30">&nbsp;</td>
          <td height="30">&nbsp;</td>
          <td height="30">&nbsp;</td>
          <td height="30">&nbsp;</td>
        </tr>
        <tr>
          <td height="227" colspan="7"><p align="right">كاربر گرامي جهت حفظ امنيت اطلاعات هنگام خارج شدن از سيستم از كليد<a href="login/logout.php"><img src="images/exit.png" width="24" height="24" border="0" /></a> استفاده كنيد<img src="images/info-blog.png" width="32" height="32" /></p>            </td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center" class="style2">Copyright &copy; 2011 , Moghan Agro-industrial &amp; Livestock Co.</p>
<p align="center" class="style2"><span class="style8"><a href="mailto:rfnobari@aol.com" class="style8" >Web Designer: R.Nobari </a></span> </p>
<p align="center" class="RedTitleSmall">&nbsp;</p>
</body>
</html>
