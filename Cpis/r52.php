<?php
require_once('../lock_cp.php');
require_once('../event.php');
$page = $_SERVER['PHP_SELF'];
$sec = 10;  // زمان بر حسب ثانیه
$title = "Some Title"; // اطمینان حاصل کنید که مقدار $title تعریف شده است
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../files/images/favicon.ico" type="image/x-icon">
    <link href="../FA.css" rel="stylesheet" type="text/css" />
    <title><?php echo htmlspecialchars($title); ?></title>
    <style type="text/css">
        .tabel { margin-right: 45px; }
        .text_r { margin-right: 0px; }
        .header_test {
            position: sticky;
            top: 0;
        }
    </style>
    <script type="text/javascript">
        // تابعی برای بارگذاری مجدد صفحه پس از زمان مشخص شده
        function refreshPage() {
            window.location.reload();
        }

        // تنظیم تایمر برای بارگذاری مجدد صفحه پس از زمان مشخص شده
        setTimeout(refreshPage, <?php echo $sec * 1000; ?>);
    </script>
</head>
<body>
    <div style='z-index: 9999' align='center' class='header_test'>
        <img src="../files/images/header.jpg" width="949" height="149" />
    </div>

    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><?php include('menu.php'); ?></td>
        </tr>
        <tr>
            <td>
                <p><!--تاریخ فارسی--></p>
                <p>
                    <?php
                    $start = 0;
                    $limit = 25;
                    if (isset($_GET['id'])) {
                        $id = (int)$_GET['id'];
                        $start = ($id - 1) * $limit;
                    }
                    include_once('../login/config.php');
                    require_once('../Jalali.php');
                    date_default_timezone_set('Asia/Tehran');
                    $date_edit = jdate("Y/m/d");
                    echo htmlspecialchars($date_edit);
                    $query = "SELECT ip, time, date, add_abadi, verb, username FROM log WHERE date = :date_edit ORDER BY date DESC, time DESC LIMIT :start, :limit";
                    $stmt = $dbh->prepare($query);
                    $stmt->bindParam(':date_edit', $date_edit);
                    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
                    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                    $stmt->execute();
                    ?>
                    امروز:
                </p>
                <p><img src="../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                <table width="90%" height="97" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr align="center" class="style8">
                        <td width="12%" height="49" bgcolor="#CCCCCC">آی پی سیستم</td>
                        <td width="8%" bgcolor="#CCCCCC">ساعت</td>
                        <td width="9%" bgcolor="#CCCCCC">تاریخ</td>
                        <td width="16%" bgcolor="#CCCCCC">آدرس آماری آبادی</td>
                        <td width="21%" bgcolor="#CCCCCC">عملیات</td>
                        <td colspan="2" bgcolor="#CCCCCC">مشخصات کاربر</td>
                        <td width="4%" bgcolor="#CCCCCC">ردیف</td>
                    </tr>
                    <?php
                    $r = $start + 1;
                    foreach ($stmt as $row) {
                        $username = $row['username'];
                        $query2 = "SELECT ostan, Last_name, name, city, markaz, pic FROM users WHERE username = :username";
                        $stmt2 = $dbh->prepare($query2);
                        $stmt2->bindParam(':username', $username);
                        $stmt2->execute();
                        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <tr>
                            <td class="normalTextSmaller"><?php echo htmlspecialchars($row['ip']); ?></td>
                            <td class="persianumber normalTextSmaller"><?php echo htmlspecialchars($row['time']); ?></td>
                            <td class="persianumber normalTextSmaller"><?php echo htmlspecialchars($row['date']); ?></td>
                            <td class="normalTextSmaller"><?php echo htmlspecialchars(abadi_name($row['add_abadi']) . ' ' . $row['add_abadi']); ?></td>
                            <td class="normalTextSmaller"><?php echo htmlspecialchars($row['verb']); ?></td>
                            <td width="24%" class="normalTextSmaller"><?php echo htmlspecialchars($row2['Last_name'] . ' ' . $row2['name'] . ' / ' . $row2['city'] . ' - ' . $row2['markaz']); ?></td>
                            <td width="6%" class="normalTextSmaller">
                                <a href="#" title="<?php echo htmlspecialchars('استان' . ' ' . $row2['ostan']); ?>">
                                    <img id="img1" src="../files/users/<?php echo htmlspecialchars($row2['pic']); ?>" width="28" height="33" alt=""/>
                                </a>
                            </td>
                            <td class="persianumber normalTextSmaller"><?php echo $r; ?></td>
                        </tr>
                        <?php
                        $r++;
                    }
                    ?>
                </table>
                <br/>
                <div class="persianumber" style="text-align: right; height: 50px; margin: auto; width: 80%; overflow: auto; background-color: #ffffff; color: #06C; scrollbar-base-color: gold; font-family: tahoma; font-size: 11px; padding: 10px; border-radius: 15px;">
                    <?php
                    $stmt1 = $dbh->prepare($query1);
                    $stmt1->execute();
                    $rows = $stmt1->rowCount();
                    $total = ceil($rows / $limit);

                    if (isset($id) && $id > 1) {
                        echo "<a href='?id=" . ($id - 1) . "' class='button'>قبلی</a>";
                    }
                    if (isset($id) && $id != $total) {
                        echo "<a href='?id=" . ($id + 1) . "' class='button'>بعدی</a>";
                    }

                    echo "<ul class='page'>";
                    for ($i = 1; $i <= $total; $i++) {
                        if (isset($id) && $i == $id) {
                            echo "<li class='current'>" . $i . "</li>";
                        } else {
                            echo "<li><a href='?id=" . $i . "'>" . $i . "</a></li>";
                        }
                    }
                    echo "</ul>";
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td height="109" colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php'); ?></td>
        </tr>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/../assets/js/jquery-3.6.0.min.js"></script>
    <script src="persianumber.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.persianumber').persiaNumber();
        });
    </script>
</body>
</html>
