<?php
include('../../lock_expar.php');
include('../../event.php');
include('../../login/config.php');
$id_city = $_POST['id_city'] ; 
$city = $_POST['city'] ; 
$id_ostan = $_POST['id_ostan'] ; 
$sal = $_POST['sal'] ; 

// Fetch all required data with a single, efficient database query
 $centers = get_center_and_bee_data($dbh, $id_ostan, $id_city);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo htmlspecialchars($title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .tabel { margin-right:45px }
        .text_r { margin-right:0px }
        .style1 {
            color: #003366;
            font-family: Tahoma;
            font-size: 18px;
        }
    </style>
    <script>
        function target_Agri17(form) {
            window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600");
            form.target = 'formpopup';
        }
function mor_popup1(form) {
    window.open('null', 'formpopup', 'width=600,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>

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
            <td>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
                    <tr>
                        <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                        <td width="840">
                            <?php include('top.php');?>
                            <p class="style1">تایید اطلاعات سرشماری زنبورستان های مراکز جهاد کشاورزی</p>
                            <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
                            <table  align="center" class="my-table" >
                                <tr align="center" class="text1">
                                    <td height="56" colspan="3" rowspan="2" bgcolor="#669999">عملیات</td>
                                    <td colspan="2" bgcolor="#669999">تعداد کندو</td>
                                    <td width="9%" rowspan="2" bgcolor="#669999">تعداد زنبورستان</td>
                                    <td height="56" colspan="3" bgcolor="#669999">مشخصات رئیس مرکز</td>
                                    <td width="12%" rowspan="2" bgcolor="#669999">نام مرکز</td>
                                    <td width="7%" rowspan="2" bgcolor="#669999">ردیف</td>
                                </tr>
                                <tr align="center" class="text1">
                                    <td bgcolor="#669999">مدرن</td>
                                    <td bgcolor="#669999">بومی</td>
                                    <td width="15%" height="43" bgcolor="#669999">نام خانوادگی</td>
                                    <td width="9%" bgcolor="#669999">نام</td>
                                    <td width="6%" bgcolor="#669999">تصویر</td>
                                </tr>
                                <?php
                                $r = 1;
                                foreach($centers as $row){
                                    $row_bg_color = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : '';
                                    $pic = empty($row['pic']) ? 'no_pic.png' : $row['pic'];

                                    // Determine the status based on the pre-fetched data
                                    $status_img = '';
                                    $status_title = '';
                                    $show_buttons = false;
                                    
                                       if ($row['promoter_count'] > 0 && $row['promoter_count'] == $row['confirmed_promoter_city']) {
                                        $status_img = 'ok.png';
                                        $status_title = 'اطلاعات مرکز تایید شده است';
                                    } elseif ($row['promoter_count'] > 0 && $row['promoter_count'] == $row['unconfirmed_promoter_city']) {
                                        $status_img = 'notok.png';
                                        $status_title = 'عدم تائید اطلاعات مرکز ، توسط مدیر شهرستان ';
                                    } else {
                                        // This checks if all promoters have been confirmed
                                        if ($row['promoter_count'] > 0 && $row['promoter_count'] == $row['confirmed_promoter_count']) {
                                            $show_buttons = true;
                                        } else {
                                            $status_img = 'lock.gif';
                                            $status_title = ' عدم تایید اطلاعات کلیه مروجین توسط رئیس مرکز ';
                                        }
                                    }
                                ?>
                                <tr>
                                    <td height="58" class="normalTextSmaller" <?php echo $row_bg_color; ?>>
                                        <form action="../send_pm1.php#1" method="post" onsubmit="target_Agri17(this)">
                                            <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                            <button><img src="../../files/receive_mail.png" width="31" height="30" title="ارسال پیام " /></button>
                                        </form>
                                    </td>
                                        <td colspan="2" <?php echo $row_bg_color; ?> width="7%" class="normalTextSmaller">
                                            <img src="../../files/<?php echo htmlspecialchars($status_img); ?>" width="32" height="32" title="<?php echo htmlspecialchars($status_title); ?>" alt=""/>
                                        </td>
                                    <td width="12%" class="normalTextSmaller" <?php echo $row_bg_color; ?>><?php echo htmlspecialchars($row['kol_k_mo']); ?></td>
                                    <td width="7%" class="normalTextSmaller" <?php echo $row_bg_color; ?>><?php echo htmlspecialchars($row['kol_k_bo']); ?></td>
                                    <td class="normalTextSmaller" <?php echo $row_bg_color; ?>><?php echo htmlspecialchars($row['bee_count']); ?></td>
                                    <td <?php echo $row_bg_color; ?> class="normalTextSmaller"><?php echo htmlspecialchars($row['Last_name']); ?></td>
                                    <td <?php echo $row_bg_color; ?> class="normalTextSmaller"><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td <?php echo $row_bg_color; ?>>
                                        <span class="normalTextSmaller"><img src="../../files/users/<?php echo htmlspecialchars($pic); ?>" width="40" height="49" alt=""/></span>
                                    </td>
                                    <td <?php echo $row_bg_color; ?>> 
   <form  action="mor_list.php" method="post" onsubmit="mor_popup1(this)">
    <input type="hidden" name="id_mar" value="<?php echo htmlspecialchars($row['id_mar']) ;?>" />
    <button><?php echo htmlspecialchars($row['markaz']).'-'. htmlspecialchars($row['id_mar']); ?></button>
    </form>
                                    </td>
                                    <td <?php echo $row_bg_color; ?>><?php echo $r; ?></td>
                                </tr>
                                <?php
                                $r++;
                                }
                                ?>
                            </table>
                            <p>&nbsp;</p>
                            <p>
                                <a href="bee2.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt=""/></a>
                            </p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
<?php
include('../../login/config.php');

/**
 * Fetches comprehensive data for all users in a specific city and province.
 *
 * This function retrieves user details, counts of bee farms, and the total
 * number of native and modern beehives using a single, efficient query.
 * It also includes conditional logic to determine the status of each user.
 *
 * @param PDO $dbh The database connection handle.
 * @param string $id_ostan The province ID.
 * @param string $id_city The city ID.
 * @return array An array of user data including aggregated bee and hive counts.
 */
function get_center_and_bee_data($dbh, $id_ostan, $id_city)
{
    // The main query uses a LEFT JOIN to get all user data and aggregate
    // the bee and hive counts in one go.
    $query = "
        SELECT
            u.id_mar, u.markaz, u.name, u.Last_name, u.pic, u.username,
            COUNT(b.id) AS bee_count,
            SUM(b.tk_bo) AS kol_k_bo,
            SUM(b.tk_mo) AS kol_k_mo,
            (SELECT COUNT(*) FROM users WHERE id_mar = u.id_mar AND S_access = '1') AS promoter_count,
            (SELECT COUNT(*) FROM users WHERE id_mar = u.id_mar AND S_access = '1' AND con_center = '1') AS confirmed_promoter_count,
            (SELECT COUNT(*) FROM users WHERE id_mar = u.id_mar AND S_access = '1' AND con_city = '1') AS confirmed_promoter_city,
            (SELECT COUNT(*) FROM users WHERE id_mar = u.id_mar AND S_access = '1' AND con_city = '2') AS unconfirmed_promoter_city
        FROM
            users u
        LEFT JOIN
            bee b ON u.id_mar = b.id_mar AND b.sal = '1404'
        WHERE
            u.id_ostan = :id_ostan AND u.id_city = :id_city AND u.S_access = '2'
        GROUP BY
            u.id_mar
        ORDER BY
            u.id_mar
    ";

    $stmt = $dbh->prepare($query);
    // Use prepared statements with named parameters to prevent SQL injection
    $stmt->bindValue(':id_ostan', $id_ostan, PDO::PARAM_INT);
    $stmt->bindValue(':id_city', $id_city, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
