<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
@font-face {
    font-family: myfont;
    src: url(../assets/fonts/Yekan-Bakh-Fa-En-03-Light.woff) format('woff');
}

/* اعمال فونت روی تمام لینک‌ها و متن‌ها */
body, p, a {
    font-family: myfont;
    color: #FFF;
	background-color:#333
}

/* حذف استایل پیش‌فرض لینک‌ها */
a {
    text-decoration: none;
}
</style>
</head>

<body>
<div align="center" style="font-size:22px; color:#FFF" >
صفحه اصلی
<p>
<a href="<?php echo $base; ?>" title="Home" style="color:#FFF" >صفحه اصلی</a> </p>
</div>

</body>
</html>