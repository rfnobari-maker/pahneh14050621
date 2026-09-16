<?php include("../../lock_ce.php");
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
          <td><img src="../../files/images/header.jpg" width="100%" height="130" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
          </tr>
          <tr>
            <td>
  <?php include('../top.php'); ?>
           <p align="center" class="style8"  > زراعت </p>
           <p align="center"  ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
   <?php  if(strstr($perm,'d1')) { ?>
           <div class="box" align="center">
             <p><a href="liste_Agri.php"><img src="../../files/Sback.PNG" alt="bee" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="liste_Agri.php" class="btn">لیست بهره برداری های زراعی</a></p>
              </div>
           <div class="box" align="center">
             <p><a href="Agri_rep11.php"><img src="../../files/setting.png" alt="bee" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep11.php" class="btn">گزارش اطلاعات زراعی استان</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep160.php"><img src="../../files/receive.png" alt="bee" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep160.php" class="btn">گزارش گروه محصولات زراعی </a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep16.php"><img src="../../files/agri_prod.png" alt="bee" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep16.php" class="btn">گزارش محصولات زراعی </a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep14.php"><img src="../../files/morvege.png" alt="bee" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep14.php" class="btn">گزارش اطلاعات زراعی به تفکیک بهره بردار</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep15.php"><img src="../../files/morvege.png" alt="bee" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep15.php" class="btn">گزارش اطلاعات زراعی بهره بردار / محصول</a><br />
             </p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep18.php"><img src="../../files/user.jpg" alt="bee" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep18.php" class="btn">بهره برداران  تولید کننده یک محصول </a><br />
             </p>
           </div>
           <div class="box" align="center">
             <p><a href="rep_keshavarz.php"><img src="../../files/pub_abadi.png" alt="Bank Account" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="rep_keshavarz.php" class="btn">اطلاعات زراعی دهستان / محصول</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep21.php"><img src="../../files/abadi.png" alt="Bank Account" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep21.php" class="btn">اطلاعات زراعی آبادی / محصول</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="rep_keshavarz_city.php"><img src="../../files/city-pub.png" alt="Bank Account" width="104" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="rep_keshavarz_city.php" class="btn">اطلاعات زراعی شهر / محصول</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep12p.php"><img src="../../files/map.png" alt="Bank Account" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep12p.php" class="btn">اطلاعات زراعی محصول /استان</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep11p.php"><img src="../../files/region.png" alt="Bank Account" width="108" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep11p.php" class="btn">اطلاعات زراعی محصول /شهرستان</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep220.php"><img src="../../files/agri_prod.png" alt="Bank Account" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep220.php" class="btn">گزارش تولید به تفکیک محصول</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep170.php"><img src="../../files/filter_data.png" alt="گزارش ویژه زراعت" width="83" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep170.php" class="btn">گزارش ویژه محصولات زراعی</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep23.php"><img src="../../files/filter_data.png" alt="گزارش ویژه اراضی زراعی" width="83" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep23.php" class="btn">گزارش ویژه اراضی زراعی</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="AgriP_edit_T.php"><img src="../../files/icon-rma.png" alt="bee" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="AgriP_edit_T.php" class="btn">بررسی تولید قطعی</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="list_Agri_no_editing.php"><img src="../../files/return.png" alt="سوابق" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="list_Agri_no_editing.php" class="btn">لیست قطعات فاقد ویرایش </a><br />
             </p>
           </div>
          <?php if($login_session=='0056578377' or $login_session=='1380066174') {?>
           <div class="box" align="center">
             <p><a href="Agri_deleted.php"><img src="../../files/download-(2).jpg" alt="سوابق" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_deleted.php" class="btn">رکوردهای حذف شده </a><br />
             </p>
           </div>
          <?php }?>
           <div class="box" align="center">
             <p><a href="../../search_benef.php"><img src="../../files/user-search-icon.png" alt="سوابق" width="87" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="../search_benef.php" class="btn">سوابق  بهره بردار </a><br />
             </p>
           </div>
           <div class="box" align="center">
             <p><a href="amar.php"><img src="../../files/sent0.png" alt="سوابق" width="87" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="amar.php" class="btn">گزارشات آمارنامه</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="../../list_product_amar_xls.php"><img src="../../files/xls.png" alt="بهره برداری زراعی" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="../../list_product_amar_xls.php" class="btn">کدینگ محصولات زراعی</a></p>
           </div>

 <?php } if(strstr($perm,'d2')) { ?>
           <div class="box" align="center">
             <p><img src="../../files/Vege.png" alt="بهره برداری زراعی" width="94" height="86" border="0" class="tricky_image" /></p>
             <p><a href="Vege.php" class="btn">  محصولات عمده صیفی</a><br />
             </p>
           </div>
 <?php } ?>
           <p class="style9">&nbsp;</p>
           <p class="style9">&nbsp;</p>
           <p class="style9">&nbsp;</p>
           <p class="style9">&nbsp;</p>
            <p>&nbsp;</p></td>
          </tr>
          <tr>
            <td  height="109"colspan="3" valign="middle" >           <p class="LinkRedTitle"><a href="../prof.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p></td>
          </tr>
          <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
          </tr>
        </table>
      </div>
</body>
</html>