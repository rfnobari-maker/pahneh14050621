<?php 
include("../../lock_oce.php");
include("../../Jalali.php");
include('counter.php');
if (isset($_POST['id_ostan'])) echo $id_ostan1 = $_POST['id_ostan']; 
if (isset($_POST['z_sal']))   $z_sal = $_POST['z_sal']; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title; ?></title>
    <style type="text/css">
    <!--
    .tabel { margin-right:45px }
    .text_r { margin-right:0px }
    .style1 {
        color: #003366;
        font-family: Tahoma;
        font-size: 18px;
        text-align: center;
    }
    -->
    </style>
</head>
<body>
  <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
                        <form id="reg-form" method="post" action="#1">
                            <div style="width: 450px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:15px">
                                <table width="100%" height="200" border='0' align="center" cellpadding='0' cellspacing='0'>
                                    <tr bgcolor='#f1f1f1'>
                                        <td height="48" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style1">گزارش اطلاعات باغی استان به تفکیک شهرستان</span><span class="style8"><a name="1" id="1"></a></span></span></td>
                                    </tr>
                                    <tr bgcolor='#f1f1f1'>
                                        <td height="46" align="right" bgcolor="#DDDDDD" class="input_text">
                                            <?php $id_ostan1 = $id_ostan; ?>
                                            <select name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
                                                <option value="0">انتخاب استان</option>
                                                <?php
                                                $query = "SELECT id_ostan, ostan FROM ostanname";
                                                $stmt = $dbh->prepare($query);
                                                $stmt->execute();
                                                foreach ($stmt as $row) {
                                                ?>
                                                <option value="<?php echo $row['id_ostan']; ?>" <?php if ($row['id_ostan'] == $id_ostan1) echo 'selected=selected'; ?>><?php echo $row['ostan']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
                                    </tr>
                                    <tr bgcolor='#f1f1f1'>
                                        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text">
                                            <div align="right">
                                                <select name="z_sal" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl">
                                                    <?php
                                                    $query = "SELECT sal FROM b_sal ORDER BY sal DESC";
                                                    $stmt = $dbh->prepare($query);
                                                    $stmt->execute();
                                                    foreach ($stmt as $row) {
                                                    ?>
                                                    <option value="<?php echo $row['sal']; ?>" <?php if (isset($z_sal) && $row['sal'] == $z_sal) echo 'selected=selected'; ?>><?php echo $row['sal']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td width="112" align='center' bgcolor="#FFFFFF" class="style11"><span class="input_text"><font size="2" class="style8">: عملکرد سال</font></span></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
                                        <td height="60" align='center' bgcolor="#FFFFFF" class="style11">&nbsp;</td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['z_sal'])) {
                            $z_sal = $_POST['z_sal'];
                            $id_ostan1 = $_POST['id_ostan'];

                            // کوئری جامع برای جمع‌آوری داده‌ها
                            $query = "
                                SELECT 
                                    c.id_city,
                                    c.city,
                                    SUM(gp.mah_tol) AS city_mah_tol,
                                    SUM(CASE WHEN g.no_kesh = '2' THEN gp.mah_tol ELSE 0 END) AS sum_mah_tol_dry,
                                    SUM(CASE WHEN g.no_kesh = '1' THEN gp.mah_tol ELSE 0 END) AS sum_mah_tol_irrigated,
                                    COUNT(CASE WHEN g.nah_kesh = '3' THEN 1 END) AS nah_kesh_scattered,
                                    COUNT(CASE WHEN g.nah_kesh = '2' THEN 1 END) AS nah_kesh_mixed,
                                    COUNT(CASE WHEN g.nah_kesh = '1' THEN 1 END) AS nah_kesh_simple,
                                    SUM(gp.tree_gb + gp.tree_b) / 1000 AS sum_tree,
                                    SUM(gp.tree_gb) / 1000 AS sum_tree_gb,
                                    SUM(gp.tree_b) / 1000 AS sum_tree_b,
                                    SUM(gp.s_kesht_gb + gp.s_kesht_b) AS sum_kesht,
                                    SUM(gp.s_kesht_gb) AS sum_kesht_gb,
                                    SUM(gp.s_kesht_b) AS sum_kesht_b,
                                    COUNT(g.id) AS garden_count,
                                    COUNT(CASE WHEN g.no_kesh = '2' THEN 1 END) AS no_garden_gat_dry,
                                    COUNT(CASE WHEN g.no_kesh = '1' THEN 1 END) AS no_garden_gat_irrigated
                                FROM 
                                    cityname c
                                LEFT JOIN 
                                    Garden g ON c.id_city = g.id_city
                                LEFT JOIN 
                                    Garden_prod gp ON g.id = gp.garden_id
                                WHERE 
                                    c.id_ostan = :id_ostan AND g.z_sal = :z_sal
                                GROUP BY 
                                    c.id_city, c.city
                            ";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute(array('id_ostan' => $id_ostan, 'z_sal' => $z_sal));
                            $cityData = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // کوئری برای جمع‌آوری داده‌های کل استان
                            $queryTotal = "
                                SELECT 
                                    SUM(gp.mah_tol) AS ostan_mah_tol,
                                    SUM(CASE WHEN g.no_kesh = '2' THEN gp.mah_tol ELSE 0 END) AS ostan_sum_mah_tol_dry,
                                    SUM(CASE WHEN g.no_kesh = '1' THEN gp.mah_tol ELSE 0 END) AS ostan_sum_mah_tol_irrigated,
                                    COUNT(CASE WHEN g.nah_kesh = '3' THEN 1 END) AS ostan_nah_kesh_scattered,
                                    COUNT(CASE WHEN g.nah_kesh = '2' THEN 1 END) AS ostan_nah_kesh_mixed,
                                    COUNT(CASE WHEN g.nah_kesh = '1' THEN 1 END) AS ostan_nah_kesh_simple,
                                    SUM(gp.tree_gb + gp.tree_b) / 1000 AS ostan_sum_tree,
                                    SUM(gp.tree_gb) / 1000 AS ostan_sum_tree_gb,
                                    SUM(gp.tree_b) / 1000 AS ostan_sum_tree_b,
                                    SUM(gp.s_kesht_gb + gp.s_kesht_b) AS ostan_sum_kesht,
                                    SUM(gp.s_kesht_gb) AS ostan_sum_kesht_gb,
                                    SUM(gp.s_kesht_b) AS ostan_sum_kesht_b,
                                    COUNT(g.id) AS ostan_garden_count,
                                    COUNT(CASE WHEN g.no_kesh = '2' THEN 1 END) AS ostan_no_garden_gat_dry,
                                    COUNT(CASE WHEN g.no_kesh = '1' THEN 1 END) AS ostan_no_garden_gat_irrigated
                                FROM 
                                    Garden g
                                LEFT JOIN 
                                    Garden_prod gp ON g.id = gp.garden_id
                                WHERE 
                                    g.id_ostan = :id_ostan AND g.z_sal = :z_sal
                            ";
                            $stmtTotal = $dbh->prepare($queryTotal);
                            $stmtTotal->execute(array('id_ostan' => $id_ostan, 'z_sal' => $z_sal));
                            $totalData = $stmtTotal->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt="" /><br /></p>
                        <table width="170" height="56" border="0" align="center">
                            <tr>
                                <td width="100">
                                    <form action="Garden_rep1_xls.php" method="post">
                                        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan; ?>" />
                                        <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
                                        <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل" width="58" height="59" alt="" /></button>
                                    </form>
                                </td>
                                <td width="90">
                                    <form action="Garden_rep1_doc.php" method="post">
                                        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan; ?>" />
                                        <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
                                        <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل اکسل" width="58" height="59" alt="" /></button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        <br />
                        <table width="100%" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0">
                            <thead class="fixedHeader">
                                <tr align="center" class="alternateRow">
                                    <td height="55" colspan="3" bgcolor="#999999">میزان تولید<br /><span class="style2">تن</span></td>
                                    <td colspan="3" bgcolor="#999999">نحوه کاشت<br /></td>
                                    <td colspan="3" bgcolor="#999999">تعداد درخت<br /><span class="style2">هزار اصله</span></td>
                                    <td colspan="3" bgcolor="#999999">سطح زیر کشت<br /><span class="style2">هکتار</span></td>
                                    <td height="55" colspan="3" bgcolor="#999999">تعداد قطعات باغی<br /><span class="style2">قطعه</span></td>
                                    <td width="7%" rowspan="2" bgcolor="#999999">شهرستان</td>
                                    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
                                </tr>
                                <tr align="center" class="text1">
                                    <td height="57" bgcolor="#999999">کل</td>
                                    <td bgcolor="#999999">دیم</td>
                                    <td bgcolor="#999999">آبی</td>
                                    <td width="5%" height="57" bgcolor="#999999">پراکنده</td>
                                    <td width="6%" bgcolor="#999999">مخلوط</td>
                                    <td width="5%" bgcolor="#999999">ساده</td>
                                    <td height="57" bgcolor="#999999">کل</td>
                                    <td bgcolor="#999999">غیربارور</td>
                                    <td bgcolor="#999999">بارور</td>
                                    <td height="57" bgcolor="#999999">کل</td>
                                    <td bgcolor="#999999">غیربارور</td>
                                    <td width="6%" bgcolor="#999999">بارور</td>
                                    <td width="6%" height="57" bgcolor="#999999">کل</td>
                                    <td width="5%" bgcolor="#999999">دیم</td>
                                    <td width="5%" bgcolor="#999999">آبی</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $r = 1;
                                foreach ($cityData as $row) {
                                ?>
                                <tr>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?> width="5%" height="26"><?php echo Num2Fa(round($row['city_mah_tol'], 1)); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?> width="5%"><?php echo Num2Fa(round($row['sum_mah_tol_dry'], 1)); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?> width="5%"><?php echo Num2Fa(round($row['sum_mah_tol_irrigated'], 1)); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($row['nah_kesh_scattered']); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($row['nah_kesh_mixed']); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($row['nah_kesh_simple']); ?></td>
                                    <td width="6%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($row['sum_tree'], 1)); ?></td>
                                    <td width="6%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($row['sum_tree_gb'], 1)); ?></td>
                                    <td width="7%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($row['sum_tree_b'], 1)); ?></td>
                                    <td width="6%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($row['sum_kesht'], 1)); ?></td>
                                    <td width="6%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($row['sum_kesht_gb'], 1)); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($row['sum_kesht_b'], 1)); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($row['garden_count']); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($row['no_garden_gat_dry']); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($row['no_garden_gat_irrigated']); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo $row['city']; ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo $r; ?></td>
                                </tr>
                                <?php
                                $r++;
                                }
                                ?>
                                <tr>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?> width="5%" height="27"><?php echo Num2Fa(round($totalData['ostan_mah_tol'], 1)); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?> width="5%"><?php echo Num2Fa(round($totalData['ostan_sum_mah_tol_dry'], 1)); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?> width="5%"><?php echo Num2Fa(round($totalData['ostan_sum_mah_tol_irrigated'], 1)); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($totalData['ostan_nah_kesh_scattered']); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($totalData['ostan_nah_kesh_mixed']); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($totalData['ostan_nah_kesh_simple']); ?></td>
                                    <td width="6%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($totalData['ostan_sum_tree'], 1)); ?></td>
                                    <td width="6%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($totalData['ostan_sum_tree_gb'], 1)); ?></td>
                                    <td width="7%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($totalData['ostan_sum_tree_b'], 1)); ?></td>
                                    <td width="6%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($totalData['ostan_sum_kesht'], 1)); ?></td>
                                    <td width="6%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($totalData['ostan_sum_kesht_gb'], 1)); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa(round($totalData['ostan_sum_kesht_b'], 1)); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($totalData['ostan_garden_count']); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($totalData['ostan_no_garden_gat_dry']); ?></td>
                                    <td <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>><?php echo Num2Fa($totalData['ostan_no_garden_gat_irrigated']); ?></td>
                                    <td colspan="2" class="style1" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC'; ?>>کل استان</td>
                                </tr>
                            </tbody>
                        </table>
                        <?php } ?>
                        <p>&nbsp;</p>
                        <p><a href="Garden.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt="" /></a></p>
                        <p>&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php'); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>