<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شماره مجوز</title>
</head>
<body>
    <h1>شماره مجوز</h1>
    <form method="POST" action="">
        <label for="identCode">شماره مجوز را وارد کنید :</label>
        <input type="text" id="identCode" name="identCode" required>
        <button type="submit">جستجو</button>
    </form>

    <?php
    if (isset($_POST['identCode'])) {
        $identCode = $_POST["identCode"];
        $response = json_decode(file_get_contents('https://api-semak.maj.ir/api/planLicenses/licenseValidation?docNum=' . $identCode), true);

        if ($response) {
            echo "<h2>نتایج:</h2>";
            $plan_id = htmlspecialchars($response['plan']['planTypeId']);
            
           if ($plan_id > 0 && $plan_id != 1 && $plan_id != 10 && $plan_id != 11) {
                echo "<p style='color: red;'>مجوز مربوط به دامداری نیست.</p>";
                exit;
            }

            echo "<p>نوع فعالیت: " . htmlspecialchars($response['plan']['planTypeName']) . "</p>";
            echo "<p>نام محصول: " . htmlspecialchars($response['plan']['productInfo'][0]['name']) . "</p>";

            // تعیین کد پستی و آدرس بر اساس plan_id
            $cod_p = $addres = '-';
            switch ($plan_id) {
                case 1:
                    $cod_p = $response['plan']['technicalInfo'][12]['value'];
                    $addres = $response['plan']['technicalInfo'][23]['value'];
                    break;
                case 10:
                    $cod_p = '-';
                    $addres = $response['plan']['technicalInfo'][29]['value'];
                    break;
                case 11:
                    $cod_p = $response['plan']['technicalInfo'][10]['value'];
                    $addres = $response['plan']['technicalInfo'][23]['value'];
                    break;
            }

            echo "<p>کد پستی : " . $cod_p . "</p>";
            echo "<p>آدرس: " . $addres . "</p>";

            // کد ملی بهره بردار
            $bah_cod_m = htmlspecialchars($response['user']['nationalCode']);
            echo "<p>کد ملی بهره بردار: " . $bah_cod_m . "</p>";

            // تاریخ اعتبار
            $validityDate = $response['planLicense']['validityDate'];
            $end_date = substr($validityDate, 0, 4) . '/' . substr($validityDate, 4, 2) . '/' . substr($validityDate, 6, 2);
            echo "<p>تاریخ اعتبار: " . $end_date . "</p>";
            echo "<p>مختصات: " .$GIS     = print_r($response['planGisPoints']) ; 
$X1      = $GIS[0]['x'] ; 
$Y1      = $GIS[0]['y'] ; 
$Z1      = $GIS[0]['z'] ; 
$Zone1   = $GIS[0]['zone'] ; 
$X2      = $GIS[1]['x'] ; 
$Y2      = $GIS[1]['y'] ; 
$Z2      = $GIS[1]['z'] ; 
$Zone2   = $GIS[1]['zone'] ; 
$X3      = $GIS[2]['x'] ; 
$Y3      = $GIS[2]['y'] ; 
$Z3      = $GIS[2]['z'] ; 
$Zone3   = $GIS[2]['zone'] ; 
$X4      = $GIS[3]['x'] ; 
$Y4      = $GIS[3]['y'] ; 
$Z4      = $GIS[3]['z'] ; 
$Zone4   = $GIS[3]['zone'] ; 


            // ظرفیت کل گله
            $z_kol = '';
            if ($plan_id == 10 || $plan_id == 11) {
                $z_kol = htmlspecialchars($response['plan']['productInfo'][0]['detail'][1]['value']);
            } elseif ($plan_id == 1) {
                $z_kol = htmlspecialchars($response['plan']['productInfo'][0]['detail'][0]['value']);
            }
            echo "<p>ظرفیت کل گله: " . $z_kol . "</p>";

            // نوع مجوز
            $no_moj = htmlspecialchars($response['planLicense']['licenseName']);
            echo "<p>نوع مجوز: " . $no_moj . "</p>";
        } else {
            echo "<p style='color: red;'>شماره مجوز یافت نشد</p>";
        }
    }
    ?>
</body>
</html>
