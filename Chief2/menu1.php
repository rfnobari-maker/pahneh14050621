<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../FA.css">
<link rel="stylesheet" href="./header_style.css">
</head>
<body>
<div class='logo'>
    <img  src="../files/images/header.jpg"  alt="" >
  </div>
<header class="header"  >
    <nav class="nav_bar">
<ul class="ul_class">
    <li>
      
      <a href="./index.php">صفحه اصلی</a>
      <img src="../files/Home-icon.png" class="img" alt="">
    </li>
    <li id="user">  نام کاربر :<?php echo $v_jen.' '.$PersName ; ?></li>
    <li>
      <span><?php echo $_SERVER['REMOTE_ADDR']; ?></span>
      <img src="../files/ip.gif" class="img" alt="">
    </li>
    <li><a href="./change-password.php">تغییر کلمه عبور</a>
    <img src="../files/lock.gif" class="img"  alt="">
    </li>
    <li><a href="../login/logout.php">خروج از سامانه</a>
      <img src="../files/exit.png" class="img" alt="">
      </li>
</ul>
  </nav>
  </div>
</header>
<div style="width:100%"><?php include('menup.php'); ?></div>
</body>
</html>