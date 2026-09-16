<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ذخیره اطلاعات</title>
</head>
<body>
<?php
$dsn = 'mysql:dbname=eagri_pahneh;host=localhost;charset=UTF8';
$user = 'eagri_upahneh';
$password = 'Reza9147857121';
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$sql = "INSERT INTO `form1`(`firstname`, `lastname`, `mobile`) VALUES ('$firstname' , '$lastname' , '$mobile')" ;
if ($conn->query($sql) === TRUE) {
   echo "اطلاعات دریافتی شما با موفقیت ثبت شد !";
} else { 
    echo "خطا - مشکلی پیش آمده است !";
}
$conn->close();
?>
</body>
</html>