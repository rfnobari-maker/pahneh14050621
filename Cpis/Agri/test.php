<?php
include_once('../../login/config.php');

// گرفتن لیست استان‌ها
$stmt = $dbh->query("SELECT id_ostan, ostan FROM ostanname ORDER BY ostan");
$ostans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<title>انتخاب استان، شهرستان، مرکز</title>
<script src="../../assets/js/jquery-3.6.0.min.js"></script>
<script src="../../location/ajax-location.js"></script>
</head>
<body>

<form>
    <p>
      <label>استان:</label>
      <select id="ostan">
        <option value="">-- انتخاب استان --</option>
        <?php foreach($ostans as $o): ?>
        <option value="<?php echo $o['id_ostan']; ?>"><?php echo htmlspecialchars($o['ostan'], ENT_QUOTES, 'UTF-8'); ?></option>
        <?php endforeach; ?>
      </select>
    </p>
    <p>
      
      <label>شهرستان:</label>
      <select id="shahrestan">
        <option value="">-- انتخاب شهرستان --</option>
      </select>
      
      <label><br>
        <br>
      مرکز:</label>
      <select id="markaz">
        <option value="">-- انتخاب مرکز --</option>
      </select>
    </p>
</form>

</body>
</html>
