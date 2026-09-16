<?php
include('./login/config_test.php');
include('./event.php');

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $national_id = $_POST['national_id'];
    $year = isset($_POST['year']) ? (int)$_POST['year'] : 1404;
    
    if (!empty($national_id)) {
        // ساخت نام جدول بر اساس سال انتخاب شده
        $table_name = "Agri_prod" . $year . "_" . ($year + 1);
        
        // SQL query با استفاده از نام جدول پویا
        $sql = "SELECT id, cod_mah FROM $table_name WHERE bah_cod_m = :national_id";

        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':national_id', $national_id);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Database Query Failed: " . $e->getMessage();
            $results = array();
        }
    } else {
        $results = array();
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استعلام کد ملی</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            margin: 20px;
            direction: rtl;
            text-align: right;
        }
        form {
            margin-bottom: 20px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: right;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .container {
            max-width: 700px;
            margin: auto;
            padding: 20px;
        }
        label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }
        input[type="text"], select {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 4px;
            width: 250px;
            font-size: 14px;
        }
        input[type="text"]:focus, select:focus {
            border-color: #4CAF50;
            outline: none;
        }
        button {
            padding: 10px 30px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        button:hover {
            background-color: #45a049;
        }
        .no-result {
            color: #d9534f;
            padding: 15px;
            background-color: #f2dede;
            border-radius: 4px;
            margin-top: 20px;
            border-right: 4px solid #d9534f;
        }
        .debug-info {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin-top: 15px;
            border-radius: 4px;
            font-family: monospace;
            direction: ltr;
            text-align: left;
            font-size: 13px;
        }
        h2 {
            color: #333;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }
        h3 {
            color: #555;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔍 فرم استعلام کد ملی</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="national_id">کد ملی:</label>
                <input type="text" id="national_id" name="national_id" required 
                       value="<?php echo isset($_POST['national_id']) ? htmlspecialchars($_POST['national_id']) : ''; ?>"
                       placeholder="مثال: 4899774621">
            </div>
            <div class="form-group">
                <label for="year">سال زراعی:</label>
                <select id="year" name="year">
                    <option value="1400" <?php echo (isset($_POST['year']) && $_POST['year'] == '1400') ? 'selected' : ''; ?>>1400-1401</option>
                    <option value="1401" <?php echo (isset($_POST['year']) && $_POST['year'] == '1401') ? 'selected' : ''; ?>>1401-1402</option>
                    <option value="1402" <?php echo (isset($_POST['year']) && $_POST['year'] == '1402') ? 'selected' : ''; ?>>1402-1403</option>
                    <option value="1403" <?php echo (isset($_POST['year']) && $_POST['year'] == '1403') ? 'selected' : ''; ?>>1403-1404</option>
                    <option value="1404" <?php echo (!isset($_POST['year']) || $_POST['year'] == '1404') ? 'selected' : ''; ?>>1404-1405</option>
                    <option value="1405" <?php echo (isset($_POST['year']) && $_POST['year'] == '1405') ? 'selected' : ''; ?>>1405-1406</option>
                </select>
            </div>
            <button type="submit">استعلام</button>
        </form>

        <?php if (!empty($results)): ?>
            <h3>✅ نتایج استعلام</h3>
            <table>
                <thead>
                    <tr>
                        <th>شناسه (id)</th>
                        <th>استعلام</th>
                        <th>کد (cod_mah)</th>
                        <th>سال زراعی</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo check_payesh($row['id'], 0, $year); ?></td>
                            <td><?php echo htmlspecialchars($row['cod_mah']); ?></td>
                            <td><?php echo htmlspecialchars($year . '-' . ($year + 1)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['national_id'])): ?>
            <div class="no-result">
                <strong>⚠️ نتیجه‌ای یافت نشد!</strong>
                <p>برای کد ملی <strong><?php echo htmlspecialchars($national_id); ?></strong> در سال زراعی <strong><?php echo $year . '-' . ($year + 1); ?></strong> هیچ رکوردی پیدا نشد.</p>
                <?php if (isset($table_name)): ?>
                    <div class="debug-info">
                        <strong>📋 اطلاعات دیباگ:</strong><br>
                        کد ملی جستجو شده: <?php echo htmlspecialchars($national_id); ?><br>
                        جدول جستجو شده: <?php echo htmlspecialchars($table_name); ?><br>
                        کوئری اجرا شده: <?php echo htmlspecialchars($sql); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>