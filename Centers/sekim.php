<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<select name="mor_codm_new" id="select" class="required style8" dir="rtl"  style="width:250px ; height:30px">
            <option value="">انتخاب مروج </option>
<?php
include ('../login/config.php');
$query3 = "SELECT * from users where id_mar = '0317' and S_access = '1'";
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
 foreach($stmt3 as $row3)
 {
echo '<option dir=rtl class=style8 value='.$row3['cod_m'].'>'.$row3['name'].'  '.$row3['Last_name'] .'</option>';
}
?>
</select>
</body>
</html>