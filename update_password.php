<?php
include ('./login/config.php');
include ('./helper.php');

$data = json_decode(file_get_contents('php://input'), true);
$password = $data['password'] ?? '';

$p_salt = rand_string(20);
$site_salt = "subinsblogsalt";
$salted_hash = hash('sha256', $password . $site_salt . $p_salt);

$query = "UPDATE users SET date_pas=?, password=?, psalt=? WHERE username=?";
$stmt = $dbh->prepare($query);
$stmt->execute(['0000-00-00', $salted_hash, $p_salt, $username]);

echo "رمز عبور با موفقیت تغییر کرد.";
?>