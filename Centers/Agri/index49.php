<?php include("../../lock_p2.php"); 
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
          <td><img src="../../files/images/header.jpg" width="100%" height="100" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
          </tr>
          <tr>
            <td>
  <?php include('top.php'); ?>
           <p align="center" class="style8"  > زراعت </p>
           <p align="center"  ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div class="box" align="center">
             <p><a href="liste_Agri.php"><img src="../../files/Sback.PNG" alt="agri_list" width="86" height="86" border="0" class="tricky_image" /></a></p>
                <p><a href="liste_Agri.php" class="btn">لیست بهره برداری های زراعی</a></p>
              </div>
           <div class="box" align="center">
             <p><a href="Agri_rep14.php"><img src="../../files/morvege.png" alt="agri_rep" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep14.php" class="btn">گزارش اطلاعات زراعی به تفکیک بهره بردار</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep15.php"><img src="../../files/morvege.png" alt="Agri_rep15" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep15.php" class="btn">گزارش اطلاعات زراعی بهره بردار / محصول</a><br />
             </p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep16.php"><img src="../../files/agri_prod.png" alt="Agri_rep16" width="86" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep16.php" class="btn">گزارش محصولات زراعی </a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Agri_rep17.php"><img src="../../files/filter_data.png" alt="گزارش ویژه زراعت" width="83" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Agri_rep17.php" class="btn">گزارش ویژه محصولات زراعی</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Bank_Account.php"><img src="../../files/Bank_account.png" alt="Bank Account" width="71" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Bank_Account.php" class="btn">شماره حساب / ذرت دانه ای</a></p>
           </div>
           <div class="box" align="center">
             <p><a href="Vege_pro.php"><img src="../../files/Vege.png" alt="Vege" width="94" height="86" border="0" class="tricky_image" /></a></p>
             <p><a href="Vege_pro.php" class="btn">محصولات عمده صیفی</a></p>
           </div>
           <p class="style9">&nbsp;</p>
           <p class="style9">&nbsp;</p>
           <p class="style9">&nbsp;</p>
           <p class="style9">&nbsp;</p>
           <p class="style9">&nbsp;</p>
           <p class="style9">&nbsp;</p>
           <p class="style9">&nbsp;</p>
           <p class="style9">&nbsp;</p>
           <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9">&nbsp;</p>
            <p class="style9"><a href="../prof.php"> <input type="submit" name="action" value="بازگشت" style="width:150px ; height:45px" tabindex="39" />
              </a>            </p>
            <p>&nbsp;</p></td>
          </tr>
          <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
          </tr>
        </table>
      </div>
<!-- Begin WebGozar.com Counter code -->
<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3514717&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3514717" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>
<!-- End WebGozar.com Counter code -->
</body>
</html>