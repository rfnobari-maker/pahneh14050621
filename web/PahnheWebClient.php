<?php
require_once "lib/nusoap.php";
$client = new nusoap_client("http://10.7.234.126/web/PahnehWebService.php");
$username = "poshtibani";
$password = "2@ej5D6*7";
$date_s = "1396/06/30" ;
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre class = 'brush: php' >" . $error . "</pre>";
}
$result = $client->call("getProd", array("username" => $username , "password" =>$password, "date_s" =>$date_s));
if ($client->fault) {
    echo "<h2>Fault</h2><pre class = 'brush: php' >";
    print_r($result);
    echo "</pre>";
}
else {
    $error = $client->getError();
    if ($error) {
        echo "<h2>Error</h2><pre class = 'brush: php'>" . $error . "</pre>";
    }
    else {
        echo "<h2>خروجی</h2><pre class = 'brush: php'>";
        echo '<table border="0">
            <tr>
                <td align="center">date_s</td>
                <td align="center">id_ostan</td>
                <td align="center">id_city</td>
                <td align="center">id_mar</td>
                <td align="center">add_abadi</td>
                <td align="center">add_city</td>
                <td align="center">bah_cod_m</td>
                <td align="center">last_name</td>
                <td align="center">name</td>
                <td align="center">num_bah</td>
                <td align="center">zer_kesht</td>
                <td align="center">mah_tolp</td>
                <td align="center">bank_account</td>
                <td align="center">mor_cod_m</td>

            </tr>';
        foreach ($result as $record) {
            echo '
            <tr>
                <td align="center">'.$record['date_s'] .'</td>
                <td align="center">'.$record['id_ostan'].'</td>
                <td align="center">'.$record['id_city'].'</td>
                <td align="center">'.$record['id_mar'].'</td>
                <td align="center">'.$record['add_abadi'].'</td>
                <td align="center">'.$record['add_city'].'</td>
                <td align="center">'.$record['bah_cod_m'].'</td>
                <td align="center">'.$record['last_name'].'</td>
                <td align="center">'.$record['name'].'</td>
                <td align="center">'.$record['num_bah'].'</td>
                <td align="center">'.$record['zer_kesht'].'</td>
                <td align="center">'.$record['mah_tolp'].'</td>
                <td align="center">'.$record['bank_account'].'</td>
                <td align="center">'.$record['mor_cod_m'].'</td>

            </tr>
            
            ';
        }
        echo '
        </table>';
    }
}