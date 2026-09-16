<?php
$host = 'localhost';
$dbname = 'information_schema';
$user = 'eagri_upahneh';
$pass = 'Reza9147857121';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statusVars = array(
        'Key_reads',
        'Key_read_requests',
        'Key_writes',
        'Key_write_requests',
        'Created_tmp_disk_tables',
        'Created_tmp_tables',
        'Created_tmp_files',
        'Select_full_join',
        'Select_scan',
        'Sort_merge_passes',
        'Sort_rows',
        'Sort_scan',
        'Threads_connected',
        'Threads_running',
   );

    $placeholders = implode("','", $statusVars);
    $stmt = $pdo->query("SHOW GLOBAL STATUS WHERE Variable_name IN ('$placeholders')");
    $rows = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    function percent($part, $whole) {
        if ($whole == 0) return '0%';
        return round(($part / $whole) * 100, 2) . '%';
    }

    echo "<h2>🧠 MySQL Cache & Temp Table Status</h2><pre>";

    echo "Key Read Hit Rate:  " . percent($rows['Key_read_requests'] - $rows['Key_reads'], $rows['Key_read_requests']) . "\n";
    echo "Key Write Hit Rate: " . percent($rows['Key_write_requests'] - $rows['Key_writes'], $rows['Key_write_requests']) . "\n";
    echo "Temp Tables on Disk: " . $rows['Created_tmp_disk_tables'] . " / " . $rows['Created_tmp_tables'] .
         " (" . percent($rows['Created_tmp_disk_tables'], $rows['Created_tmp_tables']) . ")\n";
    echo "Temp Files Created: " . $rows['Created_tmp_files'] . "\n";
    echo "Full Joins (no index): " . $rows['Select_full_join'] . "\n";
    echo "Full Table Scans: " . $rows['Select_scan'] . "\n";
    echo "Sort Merge Passes: " . $rows['Sort_merge_passes'] . "\n";
    echo "Sort Rows: " . $rows['Sort_rows'] . "\n";
    echo "Sort Scans: " . $rows['Sort_scan'] . "\n";
    echo "Threads Connected: " . $rows['Threads_connected'] . "\n";
    echo "Threads Running: " . $rows['Threads_running'] . "\n";

    echo "</pre>";
} catch (PDOException $e) {
    echo "خطا در اتصال یا اجرا: " . $e->getMessage();
}
?>
