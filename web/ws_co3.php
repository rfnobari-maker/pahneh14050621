<?php

class MajIrClient {
    private $baseUrl = 'https://sr-ajix.maj.ir/Services/GSBCompanyGetLatestInfoV2';
    private $username = 'ajix_poudadmin';
    private  $password = '6ae390lm';

    /**
     * Get company information by national code
     * 
     * @param string $nationalCode The company national code
     * @param string $name Optional company name
     * @return array API response
     * @throws Exception If request fails
     */
    public function getCompanyInfo($nationalCode, $name = '') {
        // Prepare request data
        $data = array(
            'TheCCompany' => array(
                'NationalCode' => $nationalCode,
                'Name' => $name
            )
        );
        
        // Initialize cURL
        $ch = curl_init();
        
        // Set cURL options
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
        
        // Execute request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        // Handle errors
        if ($error) {
            throw new Exception("cURL Error: " . $error);
        }
        
        if ($httpCode !== 200) {
            throw new Exception("API request failed with HTTP code: " . $httpCode);
        }
        
        // Decode and return response
        return json_decode($response, true);
    }
}

function checkNationalCode($nationalCode) {
    $client = new MajIrClient();
    try {
        $response = $client->getCompanyInfo($nationalCode);

        $finalResult = array(
            'Result' => null,
            'Name' => null
        );

        // Extract Result information
        if (isset($response['result']['data']['Result'])) {
            $finalResult['Result'] = $response['result']['data']['Result'];
        }

        // Extract Name information
        if (isset($response['result']['data']['TheCCompany']['Name'])) {
            $finalResult['Name'] = $response['result']['data']['TheCCompany']['Name'];
        }

        return $finalResult;

    } catch (Exception $e) {
        return array('error' => $e->getMessage());
    }
}

// مثال استفاده:
// $nationalCode = '10100190358';
// $data = checkNationalCode($nationalCode);
//
// if (isset($data['error'])) {
//     echo "خطا: " . $data['error'] . "\n";
// } else {
//     if (isset($data['Result']['Message'])) {
//          echo "پیام: " . $data['Result']['Message'] . "\n";
//     }
//     if (isset($data['Name'])) {
//          echo "نام شرکت: " . $data['Name'] . "\n";
//     }
// }

// یا می توانید مستقیماً از کلاس استفاده کنید:
// try {
//     $client = new MajIrClient();
//     $companyInfo = $client->getCompanyInfo('14000266391');
//     
//     echo "پاسخ API:\n";
//     print_r($companyInfo);
//     
// } catch (Exception $e) {
//     echo "خطا: " . $e->getMessage();
// }
?>