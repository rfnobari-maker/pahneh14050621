<?php include("../../lock_oce.php");
//include('../counter.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ;?></title>
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    /* General Styles */
    body {
        font-family: Tahoma, sans-serif;
    }

    /* Page Title Styles */
    .page-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    /* Horizontal Line */
    .hr-line {
        width: 700px;
        border: 0;
        height: 1px;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
        margin-bottom: 40px;
    }

    /* Flex Container for Cards */
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px; /* فاصله بین کارت‌ها */
        padding: 20px;
        margin-bottom: 40px; /* فاصله از دکمه بازگشت */
    }

    /* Card Style */
    .card {
        background-color: #f9f9f9;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 300px;
        padding: 25px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px M20px rgba(0, 0, 0, 0.15);
    }

    /* Card Image */
    .card-image {
        max-width: 100px;
        height: 86px;
        object-fit: contain; /* برای حفظ تناسب تصویر */
        margin-bottom: 20px;
        transition: transform 0.4s ease;
    }
    
    .card:hover .card-image {
        transform: scale(1.1);
    }

    /* Button Style from FA.css (assuming it exists) or a new style */
    .btn {
        display: block;
        background-color: #007bff;
        color: #FFFFFF;
        padding: 12px 20px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        margin: 15px auto; /* 'auto' for horizontal centering */
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 90%; /* A fixed width for consistency */
    }

    .btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
        color: #fff;
    }

.btn1 {        display: block;
        background-color: #007bff;
        color: #FFFFFF;
        padding: 12px 20px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        margin: 15px auto; /* 'auto' for horizontal centering */
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 90%; /* A fixed width for consistency */
}
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
    </tr>
    <tr>
        <td><?php include('menu.php'); ?></td>
    </tr>
    <tr>
        <td align="center"> <?php include('top.php'); ?>
            
            <p class="page-title"> زنبورعسل</p>
            <hr class="hr-line" />

            <div dir="rtl" class="card-container">

                <div class="card">
                    <img src="../../files/bee.png" alt="زنبورعسل" class="card-image" />
                    <a href="list_bee.php" class="btn">لیست زنبورستان ها</a>
                    <a href="manager_bee.php" class="btn">جستجوی زنبوردار</a>
                    <a href="list_unknown_bee.php" class="btn">لیست زنبورستان های ناشناس</a>
                    <a href="list_bee2.php" class="btn">زنبورستان های مهاجر در سایر استان ها</a>
                    <a href="list_bee_kol.php" class="btn">لیست نهایی زنبورستان های استان</a>
                </div>

                <div class="card">
                    <img src="../../files/reports.png" alt="گزارشات" class="card-image" />
                    <a href="bee5.php" class="btn">گزارش زنبورستان به تفکیک شهرستان</a>
                    <a href="bee2.php" class="btn">گزارش تولید به تفکیک شهرستان</a>
                    <a href="bee_Ncity.php" class="btn">گزارش نهایی تولید به تفکیک شهرستان</a>
                    <a href="equip.php" class="btn">گزارش نهایی تجهیزات به تفکیک شهرستان</a>
              </div>

                <?php
                include('../../login/config.php');
                $query = "SELECT chief from users where username = :username";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(':username', $login_session);
                $stmt->execute();
                
                // Fetch the result
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $chief = $row['chief'];
                    if ($chief == '1') {
                ?>
                <div class="card">
                    <img src="../../files/finish_bee.png" alt="خاتمه عملیات" class="card-image" />
                    <a href="finish_bee.php" class="btn">ثبت خاتمه عملیات سرشماری استان</a>
                </div>
                <?php 
                    } // end if chief
                } // end if row
                ?>
            </div>

            <p><a href="../prof.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt="Back" style="border:0;" /></a></p>
        </td>
    </tr>
    <tr>
        <td height="109" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</body>
</html>