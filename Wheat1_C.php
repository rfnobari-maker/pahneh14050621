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
	  <input type="text" name="id_ostan" id="id_ostan"> 
	  : کد استان<br>
	  <br>
	  <input type="text" name="no_bah" id="no_bah">
: نوع بهره بردار</p>
	<p>
	  <input type="text" name="meli" id="meli">
: کد / شناسه ملی<br>
	  <br>
	  <input type="submit" name="go" style="font-size:16px ; color:#06C ; font-family:tahoma; width:100px ; height:40px" value="دریافت">
    </p>
</form>
</div>
<?php
if (isset($_POST['go'])) {
$username = "user_GTC" ;
$password = "Sa#912E27@511" ;
//echo getProd($username,$password,$_POST['id_ostan'],$_POST['no_bah'],$_POST['meli']) ; 
 $client = new nusoap_client("http://poud.maj.ir/web/Wheat1_WS.php");
$record = $client->call("getProd", array("username" => $username , "password" =>$password, "id_ostan" =>$_POST['id_ostan'], "no_bah" =>$_POST['no_bah'], "meli" =>$_POST['meli']));
        echo "<h2 align='center'>اطلاعات گندمکار</h2><pre class = 'brush: php'>";
        echo '<table border="0">
            <tr>
                <td align="center">no_bah</td>
                <td align="center">meli</td>
                <td align="center">name</td>
                <td align="center">last_name</td>
                <td align="center">co_name</td>
                <td align="center">mah_tolp</td>
            </tr>';
                   echo '
            <tr>
                <td align="center">'.$record['no_bah'] .'</td>
                <td align="center">'.$record['bah_cod_m'].'</td>
                <td align="center">'.$record['name'].'</td>
                <td align="center">'.$record['last_name'].'</td>
                <td align="center">'.$record['co_name'].'</td>
                <td align="center">'.$record['mah_tolp'].'</td>
           </tr>';
        echo '
        </table>';
}
?>
</body>
</html>