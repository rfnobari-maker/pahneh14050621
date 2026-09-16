<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>وبگو | نمایش نتایج پرس و جو از دیتابیس با آژاکس</title>
<!-- http://webgoo.ir -->
<script type="text/javascript">
function showList(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("showtxt").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4)
    {
    document.getElementById("showtxt").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getlist.php?q="+str,true);
xmlhttp.send();
}
</script>
<style type="text/css">
body{
    font-family:Tahoma, Geneva, sans-serif;
    font-size:12px;
    direction:rtl;
}
</style>
</head>
<body>
<form action=""> 
<select name="list" onchange="showList(this.value)">
<option value="">انتخاب یک کاربر</option>
<option value="user1">کاربر 1</option>
<option value="user2">کاربر 2</option>
<option value="user3">کاربر 3</option>
</select>
</form>
<br />
<div id="showtxt">پس از انتخاب یک کاربر، اندکی صبر نمائید...</div>
</body>
</html>