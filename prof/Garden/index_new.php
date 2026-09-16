<?php include("../../lock_p1.php");
//include('../counter.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ;?></title>
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style3 {color: #FFFFFF}
.style4 {	font-size: 10px;
	color: #FFFFFF;
}
.box
{
 width:275px ; float:right ; line-height:150% ; margin-left:10px ; margin-top:10px ; margin-bottom:30px ; font-family:Tahoma ; margin-right:20px 
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
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
          <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
  </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
          </tr>
          <tr>
            <td>
  <?php include('top.php'); ?>
           <p align="center" class="style8"  > باغبانی </p>
           <p align="center"  ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div class="box" align="center">
             <p><img src="../../files/tree.png" alt="باغ" width="86" height="86" usemap="#Map" class="tricky_image" border="0" /></p>
                <p><a href="Garden.php" class="btn">ثبت بهره برداری باغی و قلمستان جدید</a></p>
                <p>&nbsp;</p>
                <p><a href="manager_Garden.php" class="btn">مدیریت بهره برداری باغی و قلمستان</a></p>
                <p>&nbsp;</p>
                <p><a href="liste_Garden.php" class="btn">لیست بهره برداری های باغی و قلمستان</a></p>
                <p>&nbsp;</p>
                <p><a href="liste_Garden_not_edit.php" class="btn"> ویرایش نشده های بعد از انتقال</a></p>
             <p>&nbsp;</p>
                <p><a href="Garden_edit_T_new.php" class="btn">تکمیل اطلاعات تولید قطعی </a><br />
             </p>

              </div>
           <div class="box" align="center">
             <p><img src="../../files/Garden_rep13.png" alt="گزارشات باغ" width="86" height="82" border="0" class="tricky_image" /></p>
             <p><a href="Garden_rep13.php" class="btn">گزارش محصولات باغی </a><br />
             </p>
             <p>&nbsp;</p>
             <p><a href="Garden_rep15.php" class="btn">گزارش محصولات باغی / بهره بردار </a></p>
             <p>&nbsp;</p>
             <p><a href="Garden_rep170.php" class="btn">گزارش ویژه محصولات باغی</a></p>
           </div>
           <div class="box" align="center">
             <p><img src="../../files/greenhous.png" alt="گلخانه" width="96" height="86" border="0" class="tricky_image" /></p>
             <p><a href="Greenhous.php" class="btn">ثبت گلخانه جدید</a></p>
             <p>&nbsp;</p>
             <p><a href="Greenhous_prodi.php" class="btn">ثبت عملکرد سالانه واحد </a></p>
             <p><br />
             </p>
             <p><a href="liste_Greenhousn_old.php" class="btn">مدیریت واحد گلخانه</a></p>
             <p>&nbsp;</p>
             <p><a href="list_Greenhous_nonP.php" class="btn">واحد های فاقد عملکرد</a></p>
             <p>&nbsp;</p>
             <p><a href="Greenh_rep1.php" class="btn">لیست عملکرد واحدها</a></p>
             <p>&nbsp;</p>
             <p><a href="Greenh_rep170.php" class="btn">گزارش اختصاصی محصولات</a></p>
           </div>
           <div class="box" align="center">
             <p><img src="../../files/mushroom.png" alt="گلخانه" width="96" height="86" border="0" class="tricky_image" /></p>
             <p><a href="Mushroom.php" class="btn">ثبت واحد پرورش قارچ جدید</a><br />
             </p>
             <p>&nbsp;</p>
             <p><a href="Mushroom_prodi.php" class="btn">ثبت عملکرد سالانه واحد </a></p>
             <p><br />
             </p>
             <p><a href="liste_Mushroom.php" class="btn">مدیریت واحد های پرورش قارچ</a></p>
           </div>
            </td>
          </tr>
          <tr>
            <td  colspan="3" valign="middle" ><p align="center" ><a href="../index.php"> <input type="submit" name="action" value="بازگشت" style="width:150px ; height:45px" tabindex="39" /></a></p>
            <p>&nbsp;</p></td>
          </tr>
          <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
          </tr>
</table>
      </div>
<!-- <p> Begin WebGozar.com Counter code 
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code </p> -->
</body>
</html>