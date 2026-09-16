<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=ostan.doc");
include('../lock_cp.php');
include('counter.php');
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
                           
<p align="center" class="style8">داشبورد مدیریتی استان های تحت پوشش
                            <?php 
						        include_once('../login/config.php');
                                $query = "SELECT t1.id_ostan, t1.ostan, t2.id, t2.username, t2.tel_m, t2.cod_m, t2.Last_name, t2.name, t2.pic FROM ostanname t1 LEFT JOIN users t2 ON t1.id_ostan = t2.id_ostan AND t2.chief = '1' ORDER BY BINARY t1.ostan";
                                $stmt = $dbh->prepare($query);
                                $stmt->execute();

                                $province_counts = get_province_counts();
                            ?>
                          </p>
                            <table width="98%" align="center" class="my-table"  >
                                <tr align="center" class="text1">
                                    <td colspan="6" bgcolor="#336699">تعداد</td>
                                    <td height="40" colspan="2" bgcolor="#336699">مشخصات رئیس سازمان</td>
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
                                    <td width="10%" height="40" bgcolor="#336699">نام خانوادگی</td>
                                    <td width="8%" bgcolor="#336699">نام</td>
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
                                        <td height="40">
                                           <?php echo $counts['benef_count']; ?>
                                        </td>
                                        <td>
                                                <?php echo $counts['abadi_count']; ?>
                                        </td>
                                        <td>
                                          <?php echo $counts['shahr_count']; ?>
                                        </td>
                                        <td>
                                          <?php echo $counts['mor_count']; ?>

                                        </td>
                                        <td>
                                         <?php echo $counts['mar_count']; ?>
                                   
                                        </td>
                                        <td>
                                           <?php echo $counts['city_count']; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['Last_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['ostan']); ?><br /></td>
                                        <td><?php echo $r; ?></td>
                                    </tr>
                                <?php
                                    $r++;
                                }
                                ?>
                                <tr>
                                    <td height="40" bgcolor="#CCCCCC" class="morph"><a href="bah_rep1.php" >بهره‌بردار</a></td>
                                    <td bgcolor="#CCCCCC" class="morph">آبادی</td>
                                    <td bgcolor="#CCCCCC" class="morph">شهر</td>
                                    <td bgcolor="#CCCCCC" class="morph">کارشناس پهنه</td>
                                    <td bgcolor="#CCCCCC" class="morph">مرکز</td>
                                    <td bgcolor="#CCCCCC" class="morph">شهرستان</td>
                                    <td colspan="4" rowspan="2" bgcolor="#FFFFCC" class="morph">جمع کل</td>
                                </tr>
                                <tr>
                                    <td height="40" bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo kol_bah_count(); ?></td>
                                    <td bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo abadi_count(); ?></td>
                                    <td bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo totl_shahr_count(); ?></td>
                                    <td bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo mor_count(); ?></td>
                                    <td bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo totl_mar_count(); ?></td>
                                    <td bgcolor="#FFFFCC" class="normalTextSmaller"><?php echo kol_city_count(); ?></td>
                                </tr>
                            </table>
                            <p align="center">پایان گزارش </p>
                            <p>&nbsp;</p>
</body>
</html>