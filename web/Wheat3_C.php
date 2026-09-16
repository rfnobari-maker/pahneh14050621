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
	  : تاریخ ثبت<br>
	  <br>
	  <input type="text" name="start" id="start">
: بسته 1000 تایی </p>
	<p><br>
	  <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="اجرای کوئری">
    </p>
</form>
</div>
<?php
if (isset($_POST['go'])) {
$username = "poshtibani";
$password = "2@ej5D6*7";
$client = new nusoap_client("http://10.7.234.126/web/Wheat3_WS.php");
$result = $client->call("getList", array("username" => $username , "password" =>$password, "date_s" =>$_POST['date_s'], "start" =>$_POST['start']));
        echo "<h2 align='center'>لیست گندمکاران</h2><pre class = 'brush: php'>";
        echo '<table border="0">
            <tr>
                <td align="center">row</td>
                <td align="center">date_s</td>
                <td align="center">id_ostan</td>
                <td align="center">no_bah</td>
                <td align="center">bah_cod_m</td>
                <td align="center">sh_meli</td>
                <td align="center">name</td>
                <td align="center">last_name</td>
                <td align="center">co_name</td>
                <td align="center">mah_tolp</td>
            </tr>';
$n = (($_POST['start']-1)*1000)+1 ;
        foreach ($result as $record) {
            echo '
            <tr>
                <td align="center">'.$n .'</td>
                <td align="center">'.$record['date_s'] .'</td>
                <td align="center">'.$record['id_ostan'] .'</td>
                <td align="center">'.$record['no_bah'] .'</td>
                <td align="center">'.$record['bah_cod_m'].'</td>
                <td align="center">'.$record['sh_meli'].'</td>
                <td align="center">'.$record['name'].'</td>
                <td align="center">'.$record['last_name'].'</td>
                <td align="center">'.$record['co_name'].'</td>
                <td align="center">'.$record['mah_tolp'].'</td>
           </tr>';
    $n++ ; 
        }
        echo '
        </table>';
}
?>
</body>
</html>