<?php
class MySoapClient extends SoapClient {
    private $username;
    private $password;

    public function __construct($wsdl, $options, $username, $password) {
        parent::__construct($wsdl, $options);
        $this->username = $username;
        $this->password = $password;
    }

    public function __doRequest($request, $location, $action, $version, $one_way = 0) {
        $headers = array(
            "Method: POST",
            "Connection: Keep-Alive",
            "User-Agent: PHP-SOAP-CURL",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: \"$action\"",
            "Authorization: Basic " . base64_encode($this->username . ":" . $this->password)
        );

        $ch = curl_init($location);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // اگر نیاز به غیرفعال کردن اعتبارسنجی SSL دارید (فقط برای تست)
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);
        return $response;
    }
}

// استفاده از کلاس سفارشی
$options = array(
    'trace' => 1,
    'exceptions' => 1,
    'cache_wsdl' => WSDL_CACHE_NONE,
);

$wsdl = "https://sr-ajix.maj.ir/services/SabteAhvalEstelam3?wsdl";

try {
    $client = new MySoapClient($wsdl, $options, 'poudadmin', '6ae390lm');

    // پارامترهای ورودی برای متد getEstelam3
    $params = array(
        'BirthDate' => '13520312',
        'nin' => '1380066174',
    );

    // فراخوانی متد getEstelam3
    $result = $client->getEstelam3($params);

    // نمایش خروجی
    echo "Family Name: " . $result->family;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>