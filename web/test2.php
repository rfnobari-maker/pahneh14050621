<?php
require_once "lib/nusoap.php";
// Enter these 3 parameters:
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Web Service</title>
</head>
<body>
<div  align="center" style="margin-top:100px; font-family:tahoma; font-size:16px">
<form action="" method="post">
	<p>
	  <input type="text" name="date_s"> 
	  : تاریخ آخرین دریافت<br>
	  <br>
	  <input type="text" name="start" id="start">
: از	رکورد شماره </p>
	<p>
	  <input type="text" name="number_records" id="number_records">
: تعداد ردیف ها<br>
	  <br>
	  <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="دریافت">
    </p>
</form>
</div>
<?php
if (isset($_POST['go'])) {
$username = "poshtibani";
$password = "2@ej5D6*7";
$client = new nusoap_client("http://10.7.234.126/web/test1.php?wsdl,true");
$result = $client->call("getProd", array("username" => $username , "password" =>$password, "date_s" =>$_POST['date_s'], "start" =>$_POST['start'], "number_records" =>$_POST['number_records']));
        echo "<h2 align='center'>لیست ذرت کاران دانه ای </h2><pre class = 'brush: php'>";
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
                <td align="center">row</td>

            </tr>';
$n = $_POST['start']+1 ;
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
                <td align="center">'.$n++.'</td>
           </tr>';
        }
        echo '
        </table>';
}
?>
</body>
</html>