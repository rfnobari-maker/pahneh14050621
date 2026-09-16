<?php
$user = $_GET['q'];
if ($user == 'user1')
{
    echo "<table width='200' border='1'> 

  <tr>
    <th>کاربر یک</th> 
    <td>نام کاربر یک</td>
  </tr>
</table>";
}
if ($user == 'user2'){
    echo "<table width='200' border='1'>
  <tr>
    <th>کاربر دو</th> 
    <td>نام کاربر دو</td>
  </tr>
</table>";
}
if ($user == 'user3')
{
    echo "<table width='200' border='1'>
  <tr>
    <th>کاربر سه</th> 
    <td>نام کاربر سه</td>
  </tr>
</table>";
}
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>