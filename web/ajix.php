<?php
include('new12.php') ; 
$result = webservice('13520312', '1380066174');
echo $name = $result['name']; // دسترسی به مقدار نام
?>