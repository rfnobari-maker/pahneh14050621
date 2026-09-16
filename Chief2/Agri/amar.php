<?php 
include('../../lock_ce.php');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ;?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
    <header class="row mx-0 g-0">
        <div class="col rounded-3">
            <img src="../../files/images/header.jpg" width="100%" height="100%" alt="Header Image"/>
        </div>
    </header>
    
    <nav class="row bg-white mx-0 g-0">
        <div class="col" dir="ltr">
            <?php include('menu.php'); ?>
        </div>
    </nav>

    <div class="row bg-white mx-0 g-0 h-100">
        <div class="col">
            <?php include('top.php'); ?>
        </div>
    </div>

    <main>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
                <td width="4">&nbsp;</td>
                <td width="840">
                    <div style="margin-right:25px">
                        <p class="style8">گزارشات زراعی ویژه آمارنامه</p>
                        <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/>
                        <p align="right"><a href="Agri_amar1.php" class="link-primary">برآورد سطح، میزان تولید و عملکرد در هکتار محصولات زراعی کل کشور به تفکیک محصول</a></p>
                        <p align="right"><a href="Agri_amar2.php" class="link-primary">برآورد سطح، میزان تولید و عملکرد در هکتار محصولات زراعی کل کشور به تفکیک استان</a></p>
                        <p align="right"><a href="Agri_amar3.php" class="link-primary">برآورد سطح و میزان تولید هر محصول به تفکیک استان</a></p>
                      <p align="right"><a href="Agri_amar4.php" class="link-primary">برآورد سطح و میزان تولید هر دسته محصول به تفکیک استان</a></p>
                        <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/> </p>
                      <p align="right"><a href="Agri_dash_ostan_xls1401.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1402-1401</a></p>
                        <p align="right"><a href="Agri_dash_ostan_city_xls1401.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی </a><a href="Agri_dash_ostan_xls1400.php" class="link-primary">1402-1401</a></p>
                        <p align="right"><a href="Agri_dash_ostan_details_xls1401.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی </a><a href="Agri_dash_ostan_xls1400.php" class="link-primary">1402-1401</a></p>
                        <p align="right"><a href="Agri_dash_ostan_city_details_xls1401.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی </a><a href="Agri_dash_ostan_xls1400.php" class="link-primary">1402-1401</a></p>
                        <p align="right"><a href="Vege_dash_xls_ostan1401.php" class="link-primary">خروجی اکسل محصولات صیفی به تفکیک استان در سال زراعی 1402-1401</a></p>
                        <p align="right"><a href="Vege_dash_xls1401.php" class="link-primary">خروجی اکسل محصولات صیفی به تفکیک استان و شهرستان در سال زراعی 1402-1401</a></p>
                        <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/>
                        </p>
                        <p align="right"><a href="Agri_dash_ostan_xls1400.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1401-1400</a></p>
                        <p align="right"><a href="Agri_dash_ostan_city_xls1400.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1401-1400</a></p>
                        <p align="right"><a href="Agri_dash_ostan_details_xls1400.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1401-1400</a></p>
                        <p align="right"><a href="Agri_dash_ostan_city_details_xls1400.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1401-1400</a></p>
                        <p align="right"><a href="Vege_dash_xls_ostan1400.php" class="link-primary">خروجی اکسل محصولات صیفی به تفکیک استان در سال زراعی 1401-1400</a></p>
                        <p align="right"><a href="Vege_dash_xls1400.php" class="link-primary">خروجی اکسل محصولات صیفی به تفکیک استان و شهرستان در سال زراعی 1401-1400</a></p>
                        <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/>
                        <p align="right"><a href="Agri_dash_ostan_xls.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1400-1399</a></p>
                        <p align="right"><a href="Agri_dash_ostan_city_xls.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1400-1399</a></p>
                        <p align="right"><a href="Agri_dash_ostan_details_xls.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان در سال زراعی 1400-1399</a></p>
                        <p align="right"><a href="Agri_dash_ostan_city_details_xls.php" class="link-primary">خروجی اکسل محصولات تولیدی به تفکیک استان و شهرستان در سال زراعی 1400-1399</a></p>
                        <p align="right"><a href="Vege_dash_xls_ostan.php" class="link-primary">خروجی اکسل محصولات صیفی به تفکیک استان در سال زراعی 1400-1399</a></p>
                        <p align="right"><a href="Vege_dash_xls.php" class="link-primary">خروجی اکسل محصولات صیفی به تفکیک استان و شهرستان در سال زراعی 1400-1399</a></p>
                        <p>&nbsp;</p>
                        <p><a href="../" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt="برگشت به صفحه قبل"/></a></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" valign="middle" background="../../files/bottom.gif">
                    <?php include('../../footer.php')?>
                </td>
            </tr>
        </table>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
