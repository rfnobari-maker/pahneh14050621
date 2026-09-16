<?php
include('./login/config_test.php');
include('./event.php');

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $national_id = $_POST['national_id'];
    if (!empty($national_id)) {
        // SQL query to find id and cod_mah based on the national ID
        // IMPORTANT: Using prepared statements to prevent SQL injection
        $sql = "SELECT id, cod_mah FROM Agri_prod1404_1405 WHERE bah_cod_m = :national_id";

        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':national_id', $national_id);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Database Query Failed: " . $e->getMessage();
            $results = array(); // Ensure $results is an empty array on failure
        }
    } else {
        $results = array(); // No national ID provided
    }
}

// The original call to check_id is commented out as it's not directly related to the new functionality
// echo check_id($id);
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
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: right;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>فرم استعلام کد ملی</h2>
        <form action="" method="post">
            <label for="national_id">کد ملی:</label>
            <input type="text" id="national_id" name="national_id" required>
            <button type="submit">استعلام</button>
        </form>

        <?php if (!empty($results)): ?>
            <h3>نتایج استعلام</h3>
            <table>
                <thead>
                    <tr>
                        <th>شناسه (id)</th>
                        <th>استعلام</th>
                        <th>کد (cod_mah)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo check_payesh($row['id'],0,1404); ?></td>
                            <td><?php echo htmlspecialchars($row['cod_mah']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
      <p>هیچ نتیجه‌ای برای کد ملی وارد شده یافت نشد.</p>
        <?php endif; ?>
    </div>
</body>
</html>