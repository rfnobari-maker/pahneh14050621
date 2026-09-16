<!DOCTYPE html>
<html lang="en" dir="rtl" >
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href="./css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/css/tether.min.css'>
    <link rel="stylesheet" href="./css/style.css">
	<!-- Demo CSS -->
<style>
  .fontmenu{
    font-size: 12px;
  }
</style>
</head>
  <body>
<div id="wrapper">
   <div class="overlay"></div>
        <!-- Sidebar -->
    <nav class="navbar navbar-inverse fixed-top " id="sidebar-wrapper" role="navigation">
     <ul class="nav sidebar-nav">
       <div class="sidebar-header">
       <div class="sidebar-brand">
         <a  href="#">منوی اصلی</a></div></div>
         <li class="dropdown">
          <a href="" class="dropdown-toggle"  data-toggle="dropdown">پروفایل</a>
        <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
         <li><a href="<?php echo $base; ?>profile.php">ویرایش اطلاعات کاربری</a></li>
         <li><a href="change-password.php">تغییر کلمه عبور</a></li>
         <li><a href="../login/logout.php">خروج از سیستم</a></li>
         </ul>
         </li>
       <li><a href="provinces.php">داشبور مدیریتی</a></li>

       <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">شهرها و آبادی ها</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
        <div> <a class="dropdown-header" href="cities&villages.php">صفحه اول</a></div>
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
       <li><a href="">شهرهای غیرفعال</a></li>
       <li><a href="">آبادی های تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی آبادی ها</a></li>
       <li><a href="">آبادی های غیر فعال</a></li>
       <li><a href="">آبادی های فعال فاقد کارشناس</a></li>
       <li><a href="">آبادی های مغایر شهرستان/کارشناس</a></li>
       <li><a href="">کدینک استان ، شهرستان ، مرکز</a></li>
       <li><a href="search_abadi.php">سوابق آماری یک آبادی</a></li>
      </ul>
       </li>       
  
    <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">بهره برداران کشاورزی</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
      </ul>
      </li>       

    <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">زراعت</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
      </ul>
      </li>       
  
    <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">صیفی</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
      </ul>
      </li>       

    <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">باغبانی</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
      </ul>
      </li>       

    <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">قارچ</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
      </ul>
      </li>       

    <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">گلخانه</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
      </ul>
      </li>       

    <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">آبزیان</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
      </ul>
      </li>       

    <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">زنبورعسل</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
      </ul>
      </li>       

    <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">صنایع تبدیلی</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
      </ul>
      </li>       

    <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">مراکز جهاد کشاورزی</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
      </ul>
      </li>       

    <li class="dropdown">
        <a href="#works" class="dropdown-toggle"  data-toggle="dropdown">کاربران سامانه</a>
      <ul class="dropdown-menu animated fadeInLeft fontmenu" role="menu">
       <li><a href="">شهرهای تحت پوشش</a></li>
       <li><a href="">اطلاعات عمومی شهر ها</a></li>
      </ul>
      </li>       

      </ul>
  </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div  id="page-content-wrapper">
            <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
    			<span class="hamb-middle"></span>
				<span class="hamb-bottom"></span>
            </button>

</div>
</div>

  
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js'></script>
    <script  src="js/script.js"></script>
  </body>
</html>