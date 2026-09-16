<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم جستجو</title>
</head>
<body>

<h2>فرم جستجوی رکورد</h2>

<!-- فرم جستجو -->
<form method="POST" action="process_serch.php">
    <label for="partIDCode">شناسه یکتا (partIDCode):</label>
    <input type="text" name="partIDCode" id="partIDCode" required>
    <br><br>
    
    <label for="sal">سال:</label>
    <input type="text" name="sal" id="sal" required>
    <br><br>
    
    <input type="hidden" name="action" value="search">  <!-- مشخص می‌کند که عمل جستجو انجام شود -->
    <input type="submit" value="جستجو">
</form>

</body>
</html>
