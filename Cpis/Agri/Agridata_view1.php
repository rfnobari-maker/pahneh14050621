<?php
include("../../lock_cp.php");
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');

date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $z_sal = $_POST['z_sal'];
    $Agri_table = 'Agri' . str_replace('-', '_', $z_sal);
    $Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

    include_once('../../login/config.php');

    // دریافت اطلاعات اصلی زراعی
    $query = "SELECT * FROM $Agri_table WHERE id = :id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id' => $id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo '<script>alert("رکورد مورد نظر یافت نشد"); window.history.back();</script>';
        exit;
    }

    // متغیرهای جدول Agri
    $bah_cod_m = $row['bah_cod_m'];
    $num_bah = $row['num_bah'];
    $m_poul = $row['m_poul'];
    $sh_gat = $row['sh_gat'];
    $z_sal = $row['z_sal'];
    $t_mah = $row['t_mah'];
    $no_mal = $row['no_mal'];
    $no_kesh = $row['no_kesh'];
    $id_ostan1 = $row["id_ostan"];
    $id_city1 = $row["id_city"];
    $id_mar1 = $row["id_mar"];
    $add_abadi = $row["add_abadi"];
    $add_city = $row["add_city"];
    $lng = $row['lng'];
    $lat = $row['lat'];
    $m_zamin = $row['m_zamin'];
    $m_cod_m = $row['m_cod_m'];
    $m_ab = $row['m_ab'];
    $md_ab = $row['md_ab'];
    $h_ab = $row['h_ab'];
    $no_sab = $row['no_sab'];
    $no_ab = $row['no_ab'];
    $es = $row['es'];
    $s_ayesh = $row['s_ayesh'];
    $m_vaz_sok = $row['m_vaz_sok'];

    // دریافت اطلاعات مالک
    $query = "SELECT * FROM malek WHERE m_cod_m = :m_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':m_cod_m' => $m_cod_m));
    $malek = $stmt->fetch(PDO::FETCH_ASSOC);

    $m_name = isset($malek['m_name']) ? $malek['m_name'] : '';
    $m_jens = isset($malek['m_jens']) ? $malek['m_jens'] : '';
    $m_last_name = isset($malek['m_last_name']) ? $malek['m_last_name'] : '';
    $m_fname = isset($malek['m_fname']) ? $malek['m_fname'] : '';
    $m_tel_m = isset($malek['m_tel_m']) ? $malek['m_tel_m'] : '';
    $m_addres = isset($malek['m_addres']) ? $malek['m_addres'] : '';

    // تعیین مقادیر متنی برای فیلدها
    $v_no_kesh = '';
    if ($no_kesh == '1') $v_no_kesh = 'آبی';
    elseif ($no_kesh == '2') $v_no_kesh = 'دیم';
    
    if ($no_mal != '7') $m_cod_m = $bah_cod_m;

    $malekiat = array(
        '1' => 'سند ششدانگ',
        '2' => 'سند مشاعی',
        '3' => 'اصلاحات اراضی',
        '4' => 'موقوفه',
        '5' => 'واگذاری',
        '6' => 'قولنامه',
        '7' => 'اجاره'
    );
    $v_no_mal = isset($malekiat[$no_mal]) ? $malekiat[$no_mal] : '';

    // منبع آب
    $ab_sources = array(
        '1' => 'چشمه', '2' => 'قنات', '3' => 'رودخانه', '4' => 'سد',
        '5' => 'چاه سطحی', '6' => 'چاه عمیق', '7' => 'چاه نیمه عمیق',
        '8' => 'زهکش', '9' => 'پساب', '10' => 'آب بندان', '11' => 'سایر'
    );
    $m_ab_text = isset($ab_sources[$m_ab]) ? $ab_sources[$m_ab] : '-';

    // نوع سند حقابه
    $sab_names = array('1' => 'پروانه بهره برداری', '2' => 'مجوز آب', '3' => 'عرفی', '4' => 'سایر');
    $no_sab_text = isset($sab_names[$no_sab]) ? $sab_names[$no_sab] : '-';

    // نحوه آبیاری
    $ab_types = array(
        '1' => 'جوی و پشته', '2' => 'نواری', '3' => 'غرقابی', '4' => 'تشتکی',
        '5' => 'تحت فشار قطره ای', '6' => 'تحت فشار بارانی', '7' => 'سایر'
    );
    $no_ab_text = isset($ab_types[$no_ab]) ? $ab_types[$no_ab] : '-';

    // وضعیت استخر
    $est = array('1' => 'ندارد', '2' => 'دارد / جهت ذخیره آب', '3' => 'دارد - دو منظوره');
    $es_text = isset($est[$es]) ? $est[$es] : '-';

    ?>
    <!DOCTYPE html>
    <html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo isset($title) ? $title : 'نمایش اطلاعات زراعی'; ?></title>
        <link href="../../FA.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: Tahoma, 'Segoe UI', sans-serif;
                background: #e9ecef;
                padding: 20px;
                direction: rtl;
            }
            .modern-container {
                max-width: 1300px;
                margin: 0 auto;
                background: #ffffff;
                border-radius: 16px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                overflow: hidden;
            }
            .header-modern {
                background: linear-gradient(135deg, #1e6b3b, #28a745);
                padding: 25px 30px;
                color: white;
            }
            .header-modern h2 {
                font-size: 24px;
                margin: 0;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .header-modern .badge-year {
                background: rgba(255,255,255,0.2);
                display: inline-block;
                padding: 5px 12px;
                border-radius: 20px;
                font-size: 13px;
                margin-top: 10px;
            }
            .card {
                background: #fff;
                margin: 20px;
                border-radius: 12px;
                border: 1px solid #dee2e6;
                overflow: hidden;
            }
            .card-header {
                background: #f8f9fa;
                padding: 15px 20px;
                border-bottom: 2px solid #28a745;
                font-weight: bold;
                font-size: 18px;
                color: #155724;
            }
            .card-body {
                padding: 20px;
            }
            .info-grid {
                display: table;
                width: 100%;
                border-collapse: collapse;
            }
            .info-row {
                display: table-row;
            }
            .info-label {
                display: table-cell;
                width: 180px;
                padding: 10px;
                background: #f8f9fa;
                font-weight: bold;
                border-bottom: 1px solid #dee2e6;
                vertical-align: top;
            }
            .info-value {
                display: table-cell;
                padding: 10px;
                border-bottom: 1px solid #dee2e6;
                vertical-align: top;
            }
            .product-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 13px;
            }
            .product-table th,
            .product-table td {
                border: 1px solid #dee2e6;
                padding: 8px;
                text-align: center;
            }
            .product-table th {
                background: #f8f9fa;
                font-weight: bold;
            }
            .btn-back {
                background: #6c757d;
                color: white;
                border: none;
                padding: 12px 35px;
                border-radius: 8px;
                cursor: pointer;
                font-size: 16px;
                margin: 20px;
                transition: 0.3s;
                font-weight: bold;
            }
            .btn-back:hover {
                background: #5a6268;
                transform: translateY(-2px);
            }
            hr {
                margin: 15px 0;
                border: none;
                border-top: 1px solid #dee2e6;
            }
            .text-center {
                text-align: center;
            }
            .sar-data-wrapper {
                margin: 0 20px 20px 20px;
                padding: 0;
                background: #fefce8;
                border-radius: 12px;
                border: 1px solid #fde047;
                overflow: hidden;
            }
            .sar-data-wrapper table {
                width: 100% !important;
                margin: 0 !important;
                border: none !important;
            }
            @media (max-width: 768px) {
                .info-label, .info-value {
                    display: block;
                    width: 100%;
                }
                .info-row {
                    display: block;
                }
                .product-table {
                    font-size: 11px;
                }
                .product-table th, .product-table td {
                    padding: 5px;
                }
            }
        </style>
        
           <script src="../../assets/js/jquery-3.6.0.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function() {
            <?php
            $num_t_mah = $t_mah;
            while ($num_t_mah > 0) {
                echo "
                $('.country{$num_t_mah}').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax_city.php',
                        data: 'group_cod=' + id,
                        cache: false,
                        success: function(html) {
                            $('.mar{$num_t_mah}').html(html);
                        }
                    });
                });";
                $num_t_mah--;
            }
            ?>
            
            $(".Mcod_m").change(function() {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "select_mar.php",
                    data: 'cod_m=' + id,
                    cache: false,
                    success: function(html) {
                        $(".mar").html(html);
                    }
                });
            });
        });
        
        function close_window() {
            window.close();
        }
        </script>
    </head>
    <body>
    <div class="modern-container">
        <div class="header-modern">
            <h2>📋 نمایش اطلاعات زراعی</h2>
                       <div style="margin: 25px 35px 0px 10px"> سال زراعی: <?php echo htmlspecialchars($z_sal); ?></div>
        </div>
        
        <!-- بخش اطلاعات بهره بردار (تابع sar_data2 از event.php) -->
        <div class="sar-data-wrapper">
            <?php sar_data2($bah_cod_m, $num_bah); ?>
        </div>
        
        <!-- موقعیت بهره برداری -->
        <div class="card">
            <div class="card-header">📍 موقعیت بهره‌برداری </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">استان:</div>
                        <div class="info-value"><?php echo ostan_name($id_ostan1); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">شهرستان:</div>
                        <div class="info-value"><?php echo city_name1($id_city1, $id_ostan1); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">مرکز جهاد کشاورزی:</div>
                        <div class="info-value"><?php echo mar_name($id_mar1); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">آبادی / شهر:</div>
                        <div class="info-value"><?php echo shahr_name($add_city) . ' ' . abadi_name($add_abadi); ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- اطلاعات زمین -->
        <div class="card">
            <div class="card-header">🌾 اطلاعات زمین</div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">نوع مالکیت:</div>
                        <div class="info-value"><?php echo $v_no_mal; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">نوع کشت:</div>
                        <div class="info-value"><?php echo $v_no_kesh; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">مساحت زمین (هکتار):</div>
                        <div class="info-value"><?php echo number_format((float)$m_zamin, 2); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">طول جغرافیایی (X):</div>
                        <div class="info-value" style="direction: ltr;"><?php echo htmlspecialchars($lng); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">عرض جغرافیایی (Y):</div>
                        <div class="info-value" style="direction: ltr;"><?php echo htmlspecialchars($lat); ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- اطلاعات مالک/بهره بردار -->
        <div class="card">
            <div class="card-header">👤 <?php echo ($no_mal != 7) ? 'بهره بردار (مالک)' : 'اطلاعات مالک'; ?></div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">کد ملی:</div>
                        <div class="info-value"><?php echo htmlspecialchars($m_cod_m); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">نام:</div>
                        <div class="info-value"><?php echo htmlspecialchars($m_name); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">نام خانوادگی:</div>
                        <div class="info-value"><?php echo htmlspecialchars($m_last_name); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">جنسیت:</div>
                        <div class="info-value"><?php echo ($m_jens == '1') ? 'مرد' : (($m_jens == '2') ? 'زن' : '-'); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">تلفن همراه:</div>
                        <div class="info-value"><?php echo htmlspecialchars($m_tel_m); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">نام پدر:</div>
                        <div class="info-value"><?php echo htmlspecialchars($m_fname); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">وضعیت سکونت:</div>
                        <div class="info-value"><?php echo ($m_vaz_sok == '1') ? 'ساکن' : (($m_vaz_sok == '2') ? 'غیرساکن' : '-'); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">آدرس:</div>
                        <div class="info-value"><?php echo nl2br(htmlspecialchars($m_addres)); ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if ($no_kesh == '1') { ?>
        <!-- اطلاعات آب -->
        <div class="card">
            <div class="card-header">💧 اطلاعات آب</div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">منبع آب:</div>
                        <div class="info-value"><?php echo $m_ab_text; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">مدار آبیاری (شبانه روز):</div>
                        <div class="info-value"><?php echo htmlspecialchars($md_ab); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">حقابه (ساعت):</div>
                        <div class="info-value"><?php echo htmlspecialchars($h_ab); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">نوع سند حقابه:</div>
                        <div class="info-value"><?php echo $no_sab_text; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">نحوه آبیاری:</div>
                        <div class="info-value"><?php echo $no_ab_text; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">وضعیت استخر:</div>
                        <div class="info-value"><?php echo $es_text; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        
        <!-- اطلاعات کاشت و محصولات -->
        <div class="card">
            <div class="card-header">🌱 اطلاعات کاشت</div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">سال زراعی:</div>
                        <div class="info-value"><?php echo htmlspecialchars($z_sal); ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">سطح آیش (هکتار):</div>
                        <div class="info-value"><?php echo number_format((float)$s_ayesh, 2); ?></div>
                    </div>
                </div>
                
                <hr>
                
                <div style="overflow-x: auto;">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>مساحت (هکتار)</th>
                                <th>گروه محصول</th>
                                <th>نام محصول</th>
                                <th>سطح زیر کشت اول</th>
                                <th>سطح زیر کشت دوم</th>
                                <th>سطح برداشت اول</th>
                                <th>سطح برداشت دوم</th>
                                <th>تولید پیش بینی (تن)</th>
                                <th>تولید قطعی (تن)</th>
                                <th>خسارت</th>
                                <th>بیمه</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = 1;
                        $num2_t_mah = $t_mah;
                        $queryProd = "SELECT * FROM $Agri_prod_table WHERE Agri_id = :Agri_id";
                        $stmtProd = $dbh->prepare($queryProd);
                        $stmtProd->execute(array(':Agri_id' => $id));
                        
                        $row_count = $stmtProd->rowCount();
                        if ($row_count == $num2_t_mah) {
                            while ($rowProd = $stmtProd->fetch(PDO::FETCH_ASSOC)) {
                                // دریافت نام گروه محصول
                                $group_name = '';
                                $qg = $dbh->prepare("SELECT group_name FROM product_z WHERE group_cod = :grp LIMIT 1");
                                $qg->execute(array(':grp' => $rowProd['cod_qroup']));
                                $grpRow = $qg->fetch(PDO::FETCH_ASSOC);
                                if ($grpRow) {
                                    $group_name = $grpRow['group_name'];
                                }
                                ?>
                                <tr>
                                    <td><?php echo $n++; ?></td>
                                    <td><?php echo number_format((float)$rowProd['mah_mas'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($group_name); ?></td>
                                    <td><?php echo mah_name($rowProd['cod_mah']); ?></td>
                                    <td><?php echo number_format((float)$rowProd['zer_kesht_a'], 2); ?></td>
                                    <td><?php echo number_format((float)$rowProd['zer_kesht_b'], 2); ?></td>
                                    <td><?php echo number_format((float)$rowProd['s_bar_a'], 2); ?></td>
                                    <td><?php echo number_format((float)$rowProd['s_bar_b'], 2); ?></td>
                                    <td><?php echo number_format((float)$rowProd['mah_tolp'], 2); ?></td>
                                    <td><?php echo number_format((float)$rowProd['mah_tol'], 2); ?></td>
                                    <td><?php echo ($rowProd['mah_kh'] == '1') ? 'بلی' : (($rowProd['mah_kh'] == '2') ? 'خیر' : '-'); ?></td>
                                    <td><?php echo ($rowProd['mah_bem'] == '1') ? 'بلی' : (($rowProd['mah_bem'] == '2') ? 'خیر' : '-'); ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            echo '<tr><td colspan="12">اطلاعات محصول ثبت نشده است</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="text-center">
            <button class="btn-back" onclick="close_window()">🔙 بازگشت</button>
        </div>
        <br>
    </div>
    </body>
    </html>
    <?php
    // پاکسازی متغیرها
    unset($actual_link, $add_abadi, $add_city, $bah_cod_m, $city, $cod_mah, $date_edit, $date_s, $dbh, $dsn, $es, $euser, $found, $group_cod, $h_ab, $id, $id_ostan, $m_cod_m, $no_mal, $query, $row, $stmt, $time, $title, $user);
} else {
    ?>
    <form name="myform" class="myform" method="post" action="Agri1.php"></form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
}
?>