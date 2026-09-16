<?php
require("../../lock_ce.php");
require("../../event.php");
require('../side_menu1.php');
include('../../Jalali.php');

// Initialize variables for PHP 5.3
$z_sal = '';
if (isset($_POST['z_sal'])) {
    $z_sal = $_POST['z_sal'];
}

$title = '';
if (isset($title)) {
    $title = $title;
} else {
    $title = 'Greenhouse Daily Report';
}

// Include Jalali calendar for Persian date
include('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');
$date_today = jdate("Y/m/d");

// Function to get province name by ID
function ostan_name($id_ostan) {
    global $dbh;
    $query = "SELECT ostan FROM ostanname WHERE id_ostan = :id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id' => $id_ostan));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return $row['ostan'];
    } else {
        return '';
    }
}

// Function to get current greenhouse area by province
function ostan_mz($id_ostan) {
    global $dbh;
    $query = "SELECT SUM(mz) as total FROM greenh WHERE id_ostan = :id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id' => $id_ostan));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Function to get previous day greenhouse area by province
function ostan_mz_noToday($id_ostan, $date) {
    global $dbh;
    $query = "SELECT SUM(mz) as total FROM greenh_history WHERE id_ostan = :id AND date < :date";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id' => $id_ostan, ':date' => $date));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Function to get current greenhouse count by province
function ostan_counter($id_ostan) {
    global $dbh;
    $query = "SELECT COUNT(*) as total FROM greenh WHERE id_ostan = :id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id' => $id_ostan));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Function to get previous day greenhouse count by province
function ostan_counter_noToday($id_ostan, $date) {
    global $dbh;
    $query = "SELECT COUNT(*) as total FROM greenh_history WHERE id_ostan = :id AND date < :date";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id' => $id_ostan, ':date' => $date));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Function to get current greenhouse area by city
function city_mz($id_ostan, $id_city) {
    global $dbh;
    $query = "SELECT SUM(mz) as total FROM greenh WHERE id_ostan = :ostan AND id_city = :city";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':ostan' => $id_ostan, ':city' => $id_city));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Function to get previous day greenhouse area by city
function city_mz_noToday($id_ostan, $id_city, $date) {
    global $dbh;
    $query = "SELECT SUM(mz) as total FROM greenh_history WHERE id_ostan = :ostan AND id_city = :city AND date < :date";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':ostan' => $id_ostan, ':city' => $id_city, ':date' => $date));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Function to get current greenhouse count by city
function city_counter($id_ostan, $id_city) {
    global $dbh;
    $query = "SELECT COUNT(*) as total FROM greenh WHERE id_ostan = :ostan AND id_city = :city";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':ostan' => $id_ostan, ':city' => $id_city));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Function to get previous day greenhouse count by city
function city_counter_noToday($id_ostan, $id_city, $date) {
    global $dbh;
    $query = "SELECT COUNT(*) as total FROM greenh_history WHERE id_ostan = :ostan AND id_city = :city AND date < :date";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':ostan' => $id_ostan, ':city' => $id_city, ':date' => $date));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Function to get total area
function kol_mz() {
    global $dbh;
    $query = "SELECT SUM(mz) as total FROM greenh";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Function to get previous day total area
function kol_mz_noToday($date) {
    global $dbh;
    $query = "SELECT SUM(mz) as total FROM greenh_history WHERE date < :date";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':date' => $date));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Function to get total count
function kol_counter() {
    global $dbh;
    $query = "SELECT COUNT(*) as total FROM greenh";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Function to get previous day total count
function kol_counter_noToday($date) {
    global $dbh;
    $query = "SELECT COUNT(*) as total FROM greenh_history WHERE date < :date";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':date' => $date));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['total']) {
        return $row['total'];
    } else {
        return 0;
    }
}

// Get Base parameter
$Base = '';
if (isset($_POST['Base'])) {
    $Base = $_POST['Base'];
}

// Build query based on Base parameter
$v_id_ostan = '';
$v_Group = '';

if ($Base == '-1') {
    $v_id_ostan = '1';
    $v_Group = 'id_ostan';
} else if ($Base == '-2') {
    $v_id_ostan = '1';
    $v_Group = 'id_ostan,id_city';
} else if ($Base > '-1') {
    $v_id_ostan = "id_ostan='$Base'";
    $v_Group = 'id_city';
}

$query = "SELECT id_ostan, id_city, city FROM cityname where $v_id_ostan group by $v_Group ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21'),id_city";
$stmt = $dbh->prepare($query);
$stmt->execute();
$cities = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $cities[] = $row;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR" xml:lang="fa">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title; ?></title>
    <style type="text/css">
        button {
            border-color: #FFF;
        }
        .style1 {
            color: #003366;
            font-family: Tahoma;
            font-size: 18px;
        }
        .style8 {
            font-family: Tahoma;
            font-size: 14px;
        }
        .style19 {
            font-family: Tahoma;
            font-size: 16px;
            font-weight: bold;
        }
        .normalTextSmaller {
            font-family: Tahoma;
            font-size: 12px;
        }
        .text1 {
            font-family: Tahoma;
            font-size: 13px;
            font-weight: bold;
        }
        .input_text {
            font-family: Tahoma;
            font-size: 12px;
        }
    </style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td colspan="3">
            <?php require_once("../header.php"); ?>
        </td>
    </tr>
    <tr>
        <td colspan="3" valign="middle">
            <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td width="4"><p>&nbsp;</p></td>
                    <td width="840">
                        <?php require_once('top.php'); ?>
                        <p class="style8"><span class="style19">گزارش خلاصه روزانه واحدهای گلخانه</span><br /></p>
                        <p>این گزارش شامل نوع کشت فضای باز نمیباشد<br />
                        <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                        
                        <form id="reg-form" method="post" action="">
                            <div style="width: 300px; padding: 5px; border: 2px solid #09C; margin: auto; text-align: left; border-radius: 15px">
                                <table width="100%" height="128" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr bgcolor="#f1f1f1">
                                        <td height="22" colspan="2" align="center" bgcolor="#FFFFFF">&nbsp;</td>
                                    </tr>
                                    <tr bgcolor="#f1f1f1">
                                        <td width="189" height="46" align="right" bgcolor="#DDDDDD" class="input_text">
                                            <select name="Base" class="style8" id="Base" style="width:170px; height:40px" dir="rtl" onchange="this.form.submit()">
                                                <option value="-1" <?php if ($Base == '-1') echo 'selected="selected"'; ?>>کلیه استان ها</option>
                                                <option value="-2" <?php if ($Base == '-2') echo 'selected="selected"'; ?>>کلیه شهرستان ها</option>
                                                <?php
                                                $queryOstan = "SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC";
                                                $stmtOstan = $dbh->prepare($queryOstan);
                                                $stmtOstan->execute();
                                                while ($rowOstan = $stmtOstan->fetch(PDO::FETCH_ASSOC)) {
                                                    $selected = ($rowOstan['id_ostan'] == $Base) ? 'selected="selected"' : '';
                                                    echo '<option value="' . $rowOstan['id_ostan'] . '" ' . $selected . '>' . $rowOstan['ostan'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td width="111" align="center" bgcolor="#DDDDDD" class="style8">: نوع گزارش</td>
                                    </tr>
                                    <tr>
                                        <td height="60" colspan="2" align="left">
                                            <input name="action" type="submit" id="action" style="width:150px; height:45px" value="جستجو" />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                        
                        <?php if (isset($_POST['action'])): ?>
                        <table width="122" height="56" border="0" align="center">
                            <tr>
                                <td width="56">
                                    <form action="Greenh_daily_report_xls.php" method="post">
                                        <input type="hidden" name="Base" value="<?php echo $Base; ?>" />
                                        <input type="hidden" name="date_today" value="<?php echo $date_today; ?>" />
                                        <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل" width="44" height="45" alt=""/></button>
                                    </form>
                                </td>
                                <td width="56">
                                    <form action="Greenh_daily_report_doc.php" method="post">
                                        <input type="hidden" name="Base" value="<?php echo $Base; ?>" />
                                        <input type="hidden" name="date_today" value="<?php echo $date_today; ?>" />
                                        <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد" width="44" height="45" alt=""/></button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        
                        <span class="style1"><a name="1" id="1"></a></span>
                        <table width="85%" border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0">
                            <tr align="center" class="text1">
                                <td bgcolor="#999999">افزایش یا کاهش مساحت گلخانه نسبت به روز قبل</td>
                                <td bgcolor="#999999">افزایش یا کاهش تعداد واحد نسبت به روز قبل</td>
                                <td bgcolor="#999999">مساحت گلخانه در روز قبل/ مترمربع</td>
                                <td bgcolor="#999999">تعداد واحد در روز قبل</td>
                                <td width="12%" bgcolor="#999999">مساحت گلخانه در روز جاری/ مترمربع</td>
                                <td width="11%" bgcolor="#999999">تعداد واحد در روز جاری<br /><?php echo $date_today; ?></td>
                                <?php if ($Base != '-1'): ?>
                                <td width="15%" bgcolor="#999999">شهرستان</td>
                                <?php endif; ?>
                                <td width="16%" bgcolor="#999999">استان</td>
                                <td width="6%" bgcolor="#999999">ردیف</td>
                            </tr>
                            <?php
                            $r = 1;
                            foreach ($cities as $row):
                                $bgColor = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : '';
                            ?>
                            <tr>
                                <td width="10%" height="38" class="normalTextSmaller" <?php echo $bgColor; ?>>
                                    <?php
                                    if ($Base == '-1') {
                                        echo round(ostan_mz($row['id_ostan']) - ostan_mz_noToday($row['id_ostan'], $date_today), 1);
                                    } else {
                                        echo round(city_mz($row['id_ostan'], $row['id_city']) - city_mz_noToday($row['id_ostan'], $row['id_city'], $date_today), 1);
                                    }
                                    ?>
                                </td>
                                <td width="10%" class="normalTextSmaller" <?php echo $bgColor; ?>>
                                    <?php
                                    if ($Base == '-1') {
                                        echo ostan_counter($row['id_ostan']) - ostan_counter_noToday($row['id_ostan'], $date_today);
                                    } else {
                                        echo city_counter($row['id_ostan'], $row['id_city']) - city_counter_noToday($row['id_ostan'], $row['id_city'], $date_today);
                                    }
                                    ?>
                                </td>
                                <td width="10%" class="normalTextSmaller" <?php echo $bgColor; ?>>
                                    <?php
                                    if ($Base == '-1') {
                                        echo ostan_mz_noToday($row['id_ostan'], $date_today);
                                    } else {
                                        echo city_mz_noToday($row['id_ostan'], $row['id_city'], $date_today);
                                    }
                                    ?>
                                </td>
                                <td width="10%" class="normalTextSmaller" <?php echo $bgColor; ?>>
                                    <?php
                                    if ($Base == '-1') {
                                        echo ostan_counter_noToday($row['id_ostan'], $date_today);
                                    } else {
                                        echo city_counter_noToday($row['id_ostan'], $row['id_city'], $date_today);
                                    }
                                    ?>
                                </td>
                                <td class="normalTextSmaller" <?php echo $bgColor; ?>>
                                    <?php
                                    if ($Base == '-1') {
                                        echo ostan_mz($row['id_ostan']);
                                    } else {
                                        echo city_mz($row['id_ostan'], $row['id_city']);
                                    }
                                    ?>
                                </td>
                                <td class="normalTextSmaller" <?php echo $bgColor; ?>>
                                    <?php
                                    if ($Base == '-1') {
                                        echo ostan_counter($row['id_ostan']);
                                    } else {
                                        echo city_counter($row['id_ostan'], $row['id_city']);
                                    }
                                    ?>
                                </td>
                                <?php if ($Base != '-1'): ?>
                                <td class="normalTextSmaller" <?php echo $bgColor; ?>><?php echo $row['city']; ?></td>
                                <?php endif; ?>
                                <td <?php echo $bgColor; ?>><?php echo ostan_name($row['id_ostan']); ?></td>
                                <td <?php echo $bgColor; ?>><?php echo $r; ?></td>
                            </tr>
                            <?php
                                $r++;
                            endforeach;
                            ?>
                            <tr align="center" class="text1">
                                <td bgcolor="#999999">افزایش یا کاهش مساحت گلخانه نسبت به روز قبل</td>
                                <td bgcolor="#999999">افزایش یا کاهش تعداد واحد نسبت به روز قبل</td>
                                <td bgcolor="#999999">مساحت گلخانه در روز قبل/ مترمربع</td>
                                <td bgcolor="#999999">تعداد واحد در روز قبل</td>
                                <td width="12%" bgcolor="#999999">مساحت گلخانه در روز جاری/ مترمربع</td>
                                <td width="11%" bgcolor="#999999">تعداد واحد در روز جاری</td>
                                <td colspan="3" bgcolor="#999999">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="10%" height="38" class="normalTextSmaller">
                                    <?php
                                    if ($Base == '-1' or $Base == '-2') {
                                        echo round(kol_mz() - kol_mz_noToday($date_today), 1);
                                    } else if (!empty($cities)) {
                                        echo round(ostan_mz($cities[0]['id_ostan']) - ostan_mz_noToday($cities[0]['id_ostan'], $date_today), 1);
                                    }
                                    ?>
                                </td>
                                <td width="10%" class="normalTextSmaller">
                                    <?php
                                    if ($Base == '-1' or $Base == '-2') {
                                        echo kol_counter() - kol_counter_noToday($date_today);
                                    } else if (!empty($cities)) {
                                        echo ostan_counter($cities[0]['id_ostan']) - ostan_counter_noToday($cities[0]['id_ostan'], $date_today);
                                    }
                                    ?>
                                </td>
                                <td width="10%" class="normalTextSmaller">
                                    <?php
                                    if ($Base == '-1' or $Base == '-2') {
                                        echo kol_mz_noToday($date_today);
                                    } else if (!empty($cities)) {
                                        echo ostan_mz_noToday($cities[0]['id_ostan'], $date_today);
                                    }
                                    ?>
                                </td>
                                <td width="10%" class="normalTextSmaller">
                                    <?php
                                    if ($Base == '-1' or $Base == '-2') {
                                        echo kol_counter_noToday($date_today);
                                    } else if (!empty($cities)) {
                                        echo ostan_counter_noToday($cities[0]['id_ostan'], $date_today);
                                    }
                                    ?>
                                </td>
                                <td class="normalTextSmaller">
                                    <?php
                                    if ($Base == '-1' or $Base == '-2') {
                                        echo kol_mz();
                                    } else if (!empty($cities)) {
                                        echo ostan_mz($cities[0]['id_ostan']);
                                    }
                                    ?>
                                </td>
                                <td class="normalTextSmaller">
                                    <?php
                                    if ($Base == '-1' or $Base == '-2') {
                                        echo kol_counter();
                                    } else if (!empty($cities)) {
                                        echo ostan_counter($cities[0]['id_ostan']);
                                    }
                                    ?>
                                </td>
                                <td colspan="3" class="style19">جمع کل</td>
                            </tr>
                        </table>
                        <?php endif; ?>
                        
                        <p><a href="Greenhous.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" alt="" width="118" height="47" border="0" /></a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
            <?php include('../../footer.php'); ?>
        </td>
    </tr>
</table>
</body>
</html>