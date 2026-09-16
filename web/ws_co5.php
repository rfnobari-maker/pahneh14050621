<?php
// =====================================
//     CLASS: MajIrClient
// =====================================
class MajIrClient {
    private $baseUrl = 'https://sr-ajix.maj.ir/Services/GSBCompanyGetLatestInfoV2';
    private $username = 'ajix_poudadmin';
    private $password = '6ae390lm';

    public function getCompanyInfo($nationalCode, $name = '') {

        $data = array(
            'TheCCompany' => array(
                'NationalCode' => $nationalCode,
                'Name' => $name
            )
        );

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->baseUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => 'gzip, deflate, br',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Accept: */*',
                'Authorization: Basic ' . base64_encode($this->username . ':' . $this->password),
                'Cache-Control: no-cache',
                'Connection: keep-alive',
                'Content-Type: application/json',
                'Host: sr-ajix.maj.ir',
                'User-Agent: PHP-CURL-Client/1.0'
            ),
        ));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error) {
            throw new Exception("cURL Error: " . $error);
        }

        if ($httpCode != 200) {
            throw new Exception("API request failed with HTTP code: " . $httpCode);
        }

        return json_decode($response, true);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>استعلام اطلاعات شرکت</title>
</head>
<body dir="rtl">

<h2>استعلام اطلاعات شرکت</h2>

<form method="post">
    <label>شناسه ملی شرکت:</label><br>
    <input type="text" name="nationalCode" required>
    <button type="submit">استعلام</button>
</form>

<hr>

<?php
// =====================================
//        HANDLE FORM SUBMIT
// =====================================
if (!empty($_POST['nationalCode'])) {

    $nationalCode = trim($_POST['nationalCode']);

    try {
        $client = new MajIrClient();
        $response = $client->getCompanyInfo($nationalCode);

        // داده اصلی
        $data = $response['result']['data']['TheCCompany'];

        echo "<h3>نتیجه استعلام</h3>";

        echo "<table border='1' cellpadding='8' cellspacing='0' style='border-collapse: collapse; width: 70%; font-size:14px;'>";

        echo "<tr><td><b>نام شرکت</b></td><td>" . $data['Name'] . "</td></tr>";
        echo "<tr><td><b>شناسه ملی</b></td><td>" . $data['NationalCode'] . "</td></tr>";

        echo "<tr><td><b>نوع شرکت</b></td><td>" . $data['TheCICompanyType']['Title'] . "</td></tr>";
        echo "<tr><td><b>وضعیت شخصیت</b></td><td>" . $data['TheObjectState']['Title'] . "</td></tr>";

        if (!empty($data['TheCCompanyTagList'][0]['Title'])) {
            echo "<tr><td><b>وضعیت فعالیت</b></td><td>" . $data['TheCCompanyTagList'][0]['Title'] . "</td></tr>";
        }

        echo "<tr><td><b>تاریخ ثبت</b></td><td>" . $data['RegisterDate'] . "</td></tr>";
        echo "<tr><td><b>شماره ثبت</b></td><td>" . $data['RegisterNumber'] . "</td></tr>";

        echo "<tr><td><b>کد پستی</b></td><td>" . $data['PostCode'] . "</td></tr>";
        echo "<tr><td><b>محل فعالیت</b></td><td>" . $data['Residency'] . "</td></tr>";
        echo "<tr><td><b>آدرس کامل</b></td><td>" . $data['AddressDesc'] . "</td></tr>";

        echo "<tr><td><b>مرجع ثبت</b></td><td>" . $data['TheUnit']['UnitName'] . "</td></tr>";

        echo "<tr><td><b>شهر</b></td><td>" . $data['TheGeoLocation']['LocationName'] . "</td></tr>";

        echo "</table>";

    } catch (Exception $e) {
        echo "<p style='color:red;'>خطا: " . $e->getMessage() . "</p>";
    }
}
?>

</body>
</html>
