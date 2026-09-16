<?php 
include('../lock_ce.php');
require_once('side_menu1.php');
include('counter_a.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
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
        function target_popup(form) {
            window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
            form.target = 'formpopup';
        }
        function target_popup2(form) {
            window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
            form.target = 'formpopup';
        }
    </script>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
        </tr>
        <tr>
            <td><?php include('menu.php'); ?></td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
                    <tr>
                        <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                        <td width="840">
                            <?php include('top.php');?>
                            <p class="style8">داشبورد مدیریتی استان های تحت پوشش</p>
                            <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
                            <table width="132" height="56" border="0" align="center">
                                <tr>
                                    <td width="61">
                                        <form  action="provinces_xls.php" method="post">
                                            <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="39" height="43"  alt=""/></button>
                                        </form>
                                    </td>
                                    <td width="129">
                                        <form  action="provinces_doc.php" method="post">
                                            <button><img src="../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="39" height="43"  alt=""/></button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                            <?php 
                                $query = "SELECT t1.id_ostan, t1.ostan, t2.id, t2.username, t2.tel_m, t2.cod_m, t2.Last_name, t2.name, t2.pic FROM ostanname t1 LEFT JOIN users t2 ON t1.id_ostan = t2.id_ostan AND t2.chief = '1' ORDER BY BINARY t1.ostan";
                                $stmt = $dbh->prepare($query);
                                $stmt->execute();

                                $province_counts = get_province_counts();
                            ?>
                            <table width="98%" align="center" class="my-table"  >
                                <tr align="center" class="text1">
                                    <td height="56" colspan="4" rowspan="2" bgcolor="#336699">عملیات</td>
                                    <td colspan="6" bgcolor="#336699">تعداد</td>
                                    <td height="32" colspan="3" bgcolor="#336699">مشخصات رئیس سازمان</td>
                                    <td width="12%" rowspan="2" bgcolor="#336699">استان</td>
                                    <td width="4%" rowspan="2" bgcolor="#336699">ردیف</td>
                                </tr>
                                <tr align="center" class="text1">
                                    <td bgcolor="#336699">بهره‌بردار</td>
                                    <td bgcolor="#336699">آبادی</td>
                                    <td bgcolor="#336699">شهر</td>
                                    <td bgcolor="#336699">کارشناس پهنه</td>
                                    <td width="5%" bgcolor="#336699">مرکز</td>
                                    <td width="7%" bgcolor="#336699">شهرستان</td>
                                    <td width="10%" height="47" bgcolor="#336699">نام خانوادگی</td>
                                    <td width="8%" bgcolor="#336699">نام</td>
                                    <td width="5%" bgcolor="#336699">تصویر</td>
                                </tr>
                                <?php
                                $r = 1;
                                foreach($stmt as $row) {
                                    $id_ostan = $row['id_ostan'];
                                    $pic = $row['pic'] ? $row['pic'] : 'no_pic.png';
  if (isset($province_counts[$id_ostan])) {
    $counts = $province_counts[$id_ostan];
} else {
    $counts = array(
        'benef_count' => 0,
        'abadi_count' => 0,
        'shahr_count' => 0,
        'mor_count' => 0,
        'mar_count' => 0,
        'city_count' => 0
    );
}
                                ?>
                                    <tr class="normalTextSmaller" <?php if($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>>
                                        <td width="6%" height="59">
                                            <form action="send_sms.php" method="post" onsubmit="target_popup(this)">
                                                <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                                <input type="hidden" name="tel_m" value="<?php echo htmlspecialchars($row['tel_m']); ?>" />
                                                <button><img src="../files/sms_icon.png" border="0" title="ارسال پیامک" width="31" height="31" /></button>
                                            </form>
                                        </td>
                                        <td width="6%">
                                            <form action="send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
                                                <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                                <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
                                            </form>
                                        </td>
                                        <td width="6%">
                                            <form action="center_operation1.php#1" method="post" onsubmit="target_popup2(this)">
                                                <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                                <button><img src="../files/History.png" border="0" title="مشاهده عملکرد مروج در سامانه" width="31" height="30" /></button>
                                            </form>
                                        </td>
                                        <td width="6%">
                                            <form action="center_profile1.php#1" method="post" onsubmit="target_popup2(this)">
                                                <input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                                <input type="hidden" name="cod_m" value="<?php echo htmlspecialchars($row['cod_m']); ?>" />
                                                <button><img src="../files/adduser1.jpg" border="0" title="مشاهده اطلاعات تکمیلی مروج" width="31" height="30" /></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="ostan_benef.php" method="post" onsubmit="return ray.ajax()">
                                                <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan); ?>" />
                                                <input type="hidden" name="ostan" value="<?php echo htmlspecialchars($row['ostan']); ?>" />
                                                <button><?php echo $counts['benef_count']; ?></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="ostan_act_abadi.php" method="POST" onsubmit="return ray.ajax()">
                                                <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan); ?>" />
                                                <input type="hidden" name="ostan" value="<?php echo htmlspecialchars($row['ostan']); ?>" />
                                                <button><?php echo $counts['abadi_count']; ?></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="ostan_listscity.php" method="post" onsubmit="return ray.ajax()">
                                                <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan); ?>" />
                                                <input type="hidden" name="ostan" value="<?php echo htmlspecialchars($row['ostan']); ?>" />
                                                <button><?php echo $counts['shahr_count']; ?></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="ostan_promotes.php" method="post" onsubmit="return ray.ajax()">
                                                <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan); ?>" />
                                                <input type="hidden" name="ostan" value="<?php echo htmlspecialchars($row['ostan']); ?>" />
                                                <button><?php echo $counts['mor_count']; ?></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="ocenters_list.php" method="post" onsubmit="return ray.ajax()">
                                                <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan); ?>" />
                                                <input type="hidden" name="ostan" value="<?php echo htmlspecialchars($row['ostan']); ?>" />
                                                <button><?php echo $counts['mar_count']; ?></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="centers.php" method="post" onsubmit="return ray.ajax()">
                                                <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan); ?>" />
                                                <input type="hidden" name="ostan" value="<?php echo htmlspecialchars($row['ostan']); ?>" />
                                                <button><?php echo $counts['city_count']; ?></button>
                                            </form>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['Last_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><span class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo htmlspecialchars($pic); ?>" width="37" height="43" alt=""/></span></td>
                                        <td><?php echo htmlspecialchars($row['ostan']); ?><br />
                                            <a href="#" title="درصد بروز رسانی اطلاعات عمومی آبادی ها"><?php echo ostan_abadi_update_per($id_ostan); ?></a>
                                        </td>
                                        <td><?php echo $r; ?></td>
                                    </tr>
                                <?php
                                    $r++;
                                }
                                ?>
                                <tr>
                                    <td colspan="4" rowspan="2" bgcolor="#999999" class="normalTextSmaller">&nbsp;</td>
                                    <td height="44" bgcolor="#CCCCCC" class="morph"><a href="bah_rep1.php" class="LinkRedTitle">بهره‌بردار</a></td>
                                    <td bgcolor="#CCCCCC" class="morph">آبادی</td>
                                    <td bgcolor="#CCCCCC" class="morph">شهر</td>
                                    <td bgcolor="#CCCCCC" class="morph">کارشناس پهنه</td>
                                    <td bgcolor="#CCCCCC" class="morph">مرکز</td>
                                    <td bgcolor="#CCCCCC" class="morph">شهرستان</td>
                                    <td colspan="5" rowspan="2" bgcolor="#FFFFCC" class="morph">جمع کل</td>
                                </tr>
                                <tr>
                                    <td height="41" bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo kol_bah_count(); ?></td>
                                    <td bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo abadi_count(); ?></td>
                                    <td bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo totl_shahr_count(); ?></td>
                                    <td bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo mor_count(); ?></td>
                                    <td bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo totl_mar_count(); ?></td>
                                    <td bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo kol_city_count(); ?></td>
                                </tr>
                            </table>
                            <p>&nbsp;</p>
                            <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47" alt=""/></a></p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>