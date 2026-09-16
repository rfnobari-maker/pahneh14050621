<?php 
include_once("../lock_ce.php");
include_once('counter.php');
?>
<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<title><?php echo htmlspecialchars($title); ?></title>
<link href="../FA.css" rel="stylesheet" type="text/css">
<style>
    .style3 { color: #FFFFFF; }
    .style4 { font-size: 10px; color: #FFFFFF; }
    .box {
        width: 275px;
        float: right;
        line-height: 150%;
        margin: 10px 20px 30px 10px;
        font-family: Tahoma;
    }
    .tricky_image {
        margin-bottom: 10px;
        max-width: 86px;
        max-height: 86px;
        transition: all 1s;
        opacity: 1;
    }
    .tricky_image:hover {
        opacity: 0.2;
    }
</style>
</head>
<body>
<table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td><img src="../files/images/header.jpg" width="100%" height="130" alt="Header Image"></td>
    </tr>
    <tr>
        <td><?php include('menu.php'); ?></td>
    </tr>
    <tr>
        <td>
            <?php include('top.php'); ?>
            <p align="center"><img src="../files/reza.gif" width="240" height="57" style="border-radius:15px" alt=""></p>
            <?php if (strstr($perm, 'd9')): ?>
                <div class="box" align="center">
                    <p><a href="benef.php" title="اطلاعات بهره برداران کشاورزی"><img src="../files/farmer.png" alt="upload" width="58" height="70" class="tricky_image"></a></p>
                    <p><a href="benef.php" class="btn">بهره برداران کشاورزی</a></p>
                </div>
            <?php endif; ?>
            <?php if (strstr($perm, 'd1') || strstr($perm, 'd2')): ?>
                <div class="box" align="center">
                    <p><a href="Agri" title="مدیریت امور زراعت"><img src="../files/zera.png"  width="70" height="70" class="tricky_image"></a></p>
                    <p><a href="Agri" class="btn">زراعت</a></p>
                </div>
            <?php endif; ?>
            <?php if (strstr($perm, 'd3') || strstr($perm, 'd4') || strstr($perm, 'd5')): ?>
                <div class="box" align="center">
                    <p><a href="Garden" title=""><img src="../files/tree.png"  width="86" height="70" class="tricky_image"></a></p>
                    <p><a href="Garden" class="btn">باغبانی</a></p>
                </div>
            <?php endif; ?>
            <?php if (strstr($perm, 'd7')): ?>
                <div class="box" align="center">
                    <p><a href="Poultry/" title=""><img src="../files/bee.png"  width="110" height="70" class="tricky_image"></a></p>
                    <p><a href="Poultry/" class="btn">زنبورعسل</a></p>
                </div>
            <?php endif; ?>
            <?php if (strstr($perm, 'd6')): ?>
                <div class="box" align="center">
                    <p><a href="Aquatic" title=""><img src="../files/fish1.png"  width="75" height="70" class="tricky_image"></a></p>
                    <p><a href="Aquatic" class="btn">آبزی پروری</a></p>
                </div>
            <?php endif; ?>
            <?php if (strstr($perm, 'd10')): ?>
                <div class="box" align="center">
                    <p><a href="Industry/" title="صنایع تبدیلی و غذایی"><img src="../files/sana.png"  width="158" height="70" class="tricky_image"></a></p>
                    <p><a href="Industry/" class="btn">صنایع تبدیلی و تکمیلی</a></p>
                </div>
            <?php endif; ?>
            <?php if (strstr($perm, 'd8')): ?>
                <div class="box" align="center">
                    <p><a href="Promotion/index.php" title=""><img src="../files/farmer-512.png"  width="86" height="70" class="tricky_image"></a></p>
                    <p><a href="Promotion/index.php" class="btn">تحقیقات آموزش و ترویج</a></p>
                </div>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td height="109" valign="middle">
            <p class="style8"><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47" alt="Go Back"></a></p>
        </td>
    </tr>
    <tr>
        <td height="109" valign="middle" style="background:url('../files/bottom.gif')"><?php include_once('../footer.php'); ?></td>
    </tr>
</table>
</body>
</html>
