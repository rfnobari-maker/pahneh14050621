<?php
include('../../lock_p2.php');
include('../../event.php');
include('../../login/config.php');

// Fetch all required data with a single, efficient database query.
$users = get_users_and_bee_data($dbh, $id_mar);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $title; ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .tabel { margin-right: 45px }
        .text_r { margin-right: 0px }
        .style1 { color: #003366; font-family: Tahoma; font-size: 18px; }
    </style>
    <script>
 function target_Agri17(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600"); 
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
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                        <td width="840">
                            <?php include('top.php'); ?>
                            <p>&nbsp;</p>
                            <p class="style1">تایید اطلاعات ثبت شده سرشماری زنبورستان های مرکز</p>
                          <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                            <table align="center" class="my-table" >
                                <tr align="center" class="text1">
                                  <td height="58" bgcolor="#669999">عملیات</td>
                                    <td height="58" colspan="2" bgcolor="#669999">اعلام نظر رئیس مرکز</td>
                                    <td bgcolor="#669999"> آخرین وضعیت سرشماری</td>
                                    <td width="13%" bgcolor="#669999">تعداد زنبورستان ثبت شده</td>
                                    <td width="12%" bgcolor="#669999">کد ملی</td>
                                    <td width="14%" bgcolor="#669999">نام خانوادگی</td>
                                    <td width="10%" bgcolor="#669999">نام</td>
                                    <td width="6%" bgcolor="#669999">تصویر</td>
                                    <td width="5%" bgcolor="#669999">ردیف</td>
                                </tr>
                                <?php
                                $r = 1;
                                foreach ($users as $row) {
                                    $row_bg_color = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : '';
                                    $mor_end_bee = $row['end_bee'];
                                    $mor_con_center = $row['con_center'];
                                    $pic = empty($row['pic']) ? 'no_pic.png' : $row['pic'];
                                ?>
                                <tr>
                                    <td height="58" class="normalTextSmaller" <?php echo $row_bg_color; ?>>
                                  <form  action="../send_pm1.php#1" method="post" onsubmit="target_Agri17(this)">
                                    <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
                                    <button><img src="../../files/receive_mail.png" width="31" height="30" title="ارسال پیام " /></button>
                                  </form></td>
                                    <?php if ($mor_end_bee == '' && $mor_con_center == '') { ?>
                                    <td colspan="2" <?php echo $row_bg_color; ?> width="7%" class="normalTextSmaller">
                                        <img src="../../files/lock.gif" width="32" height="32" title="بعلت عدم گزارش خاتمه عملیات ، امکان تایید وجود ندارد" alt=""/>
                                    </td>
                                    <?php } elseif ($mor_con_center == '1') { ?>
                                    <td colspan="2" <?php echo $row_bg_color; ?> width="7%" class="normalTextSmaller">
                                        <img src="../../files/ok.png" width="32" height="32" title="اطلاعات مروج قبلاً تایید شده است" alt=""/><br><?php echo htmlspecialchars($row['date_con_center']); ?>
                                    </td>
                                    <?php } elseif ($mor_con_center == '2') { ?>
                                    <td colspan="2" <?php echo $row_bg_color; ?> width="7%" class="normalTextSmaller">
                                        <img src="../../files/notok.png" width="32" height="32" title="عدم تائید اطلاعات مروج قبلاً تایید شده است" alt=""/><br><?php echo htmlspecialchars($row['date_con_center']); ?>
                                    </td>
                                    <?php } else { ?>
                                    <td <?php echo $row_bg_color; ?> width="7%" class="normalTextSmaller">
                                        <form action="notok_bee.php" method="post">
                                            <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                            <input type="hidden" name="mor_cod_m" value="<?php echo htmlspecialchars($row['cod_m']); ?>" />
                                            <button><img src="../../files/return.png" border="0" title="عدم تایید اطلاعات و درخواست اصلاح" width="55" height="44" /></button>
                                        </form>
                                    </td>
                                    <td <?php echo $row_bg_color; ?> width="7%" class="normalTextSmaller">
                                        <form action="ok_bee.php" method="post">
                                            <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                            <input type="hidden" name="mor_cod_m" value="<?php echo htmlspecialchars($row['cod_m']); ?>" />
                                            <button><img src="../../files/coniform.png" border="0" title="تایید اطلاعات ثبت شده مروج" width="55" height="44" /></button>
                                        </form>
                                    </td>
                                    <?php } ?>
                                    <td class="normalTextSmaller" <?php echo $row_bg_color; ?>>
                                        <?php
                                            if ($mor_end_bee == '' && $mor_con_center == '') {
                                                echo '<p style="color:red">عدم گزارش خاتمه عملیات</p>';
                                            } elseif ($mor_end_bee == '' && $mor_con_center == '2') {
                                                echo '<p style="color:blue">امکان ویرایش اطلاعات را دارد</p>';
                                            } elseif ($mor_end_bee == '1') {
                                                echo '<p style="color:green">خاتمه عملیات' . '<br>' . htmlspecialchars($row['date_end_bee']) . '</p>';
                                            } elseif ($mor_end_bee == '3') {
                                                echo '<p style="color:red">عدم گزارش خاتمه عملیات تا پایان زمان مقرر</p>';
                                            }
                                        ?>
                                    </td>
                                    <td <?php echo $row_bg_color; ?> class="normalTextSmaller"><?php echo htmlspecialchars($row['bee_count']); ?></td>
                                    <td <?php echo $row_bg_color; ?> class="normalTextSmaller"><?php echo htmlspecialchars($row['cod_m']); ?></td>
                                    <td <?php echo $row_bg_color; ?> class="normalTextSmaller"><?php echo htmlspecialchars($row['Last_name']); ?></td>
                                    <td <?php echo $row_bg_color; ?> class="normalTextSmaller"><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td <?php echo $row_bg_color; ?> >
                                        <span class="normalTextSmaller"><img src="../../files/users/<?php echo htmlspecialchars($pic); ?>" width="40" height="49" alt=""/></span>
                                    </td>
                                    <td <?php echo $row_bg_color; ?> ><?php echo $r++; ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                            <p>&nbsp;</p>
                            <p>
                                <a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt=""/></a>
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
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>

<?php
// Include the database configuration
include('../../login/config.php');

/**
 * Fetches all necessary user and bee data for the main table.
 *
 * @param PDO $dbh The database connection handle.
 * @param string $id_mar The user's 'id_mar'.
 * @return array An array of user and bee data.
 */
function get_users_and_bee_data($dbh, $id_mar)
{
    // The main query joins the 'users' and 'bee' tables
    // to get all required data in a single call.
    $query = "
        SELECT
            u.id, u.username, u.tel_m, u.cod_m, u.Last_name, u.name, u.pic, u.end_bee, u.date_end_bee, u.con_center, u.date_con_center,
            COUNT(b.id) AS bee_count
        FROM
            users u
        LEFT JOIN
            bee b ON u.cod_m = b.mor_cod_m AND b.sal = '1404'
        WHERE
            u.id_mar = :id_mar AND u.S_access = '1'
        GROUP BY
            u.id
        ORDER BY
            u.id
    ";

    $stmt = $dbh->prepare($query);
    // Use a prepared statement with a named parameter to prevent SQL injection.
    $stmt->bindValue(':id_mar', $id_mar, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>