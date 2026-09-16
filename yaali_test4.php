<?php
include ('login/config.php');
include ('event.php');

// تابع برای دریافت تعداد رکوردهای یک آبادی در تمام جداول
function getRecordCounts($dbh, $add_abadi) {
    $tables = array(
        'Agri1397_1398', 'Agri1398_1399', 'Agri1399_1400', 'Agri1400_1401',
        'Agri1401_1402', 'Agri1402_1403', 'Agri1403_1404', 'Agri1404_1405',
        'Agri1405_1406',
        'Agri_prod1397_1398', 'Agri_prod1398_1399', 'Agri_prod1399_1400',
        'Agri_prod1400_1401', 'Agri_prod1401_1402', 'Agri_prod1402_1403',
        'Agri_prod1403_1404', 'Agri_prod1404_1405', 'Agri_prod1405_1406',
        'Agriprod1399_1400', 'Agriprod1400_1401', 'Agriprod1401_1402',
        'Agriprod1402_1403',
        'Aquatic', 'Aquatic2',
        'bah', 'bah20',
        'bee', 'bee_1403',
        'Garden', 'Garden_prod',
        'Greenhous', 'Greenhous_prod', 'Greenprod_annual',
        'Mushroom', 'Mushroom_prod',
        'Vege', 'Vege_prod'
    );
    
    $counts = array();
    $total = 0;
    
    foreach ($tables as $table) {
        $query = "SELECT COUNT(*) as count FROM $table WHERE add_abadi = ?";
        $stmt = $dbh->prepare($query);
        $stmt->execute(array($add_abadi));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = intval($row['count']);
        if ($count > 0) {
            $counts[$table] = $count;
            $total += $count;
        }
    }
    
    return array('details' => $counts, 'total' => $total);
}

// پردازش حذف
if (isset($_GET['delete']) && !empty($_GET['add_abadi'])) {
    $add_abadi = $_GET['add_abadi'];
    
    try {
        $dbh->beginTransaction();
        
        // دریافت نام آبادی برای نمایش
        $stmt = $dbh->prepare("SELECT abadi FROM list_abadi WHERE add_abadi = ?");
        $stmt->execute(array($add_abadi));
        $abadi_name = $stmt->fetchColumn();
        
        // کپی در جدول بایگانی
        $stmt = $dbh->prepare("INSERT INTO list_abadi_del SELECT * FROM list_abadi WHERE add_abadi = ?");
        $stmt->execute(array($add_abadi));
        $copy_count = $stmt->rowCount();
        
        // حذف از جدول اصلی
        $stmt = $dbh->prepare("DELETE FROM list_abadi WHERE add_abadi = ?");
        $stmt->execute(array($add_abadi));
        $delete_count = $stmt->rowCount();
        
        $dbh->commit();
        
        $message = "✅ آبادی '$abadi_name' با موفقیت حذف شد. (کپی در بایگانی: $copy_count رکورد)";
        $message_type = "success";
        
    } catch (Exception $e) {
        $dbh->rollBack();
        $message = "❌ خطا در حذف: " . $e->getMessage();
        $message_type = "error";
    }
}

// دریافت لیست آبادی‌ها
$query = "SELECT l.* 
          FROM list_abadi l
          WHERE NOT EXISTS (
              SELECT 1 
              FROM public_abadi4 p 
              WHERE p.add_abadi = l.add_abadi
          )
          ORDER BY l.abadi";

$stmt = $dbh->prepare($query);
$stmt->execute();
$abadi_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_abadis = count($abadi_list);

?>
<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مدیریت آبادی‌های بدون آمار</title>
    <style>
        body {
            font-family: Tahoma, Arial;
            background: #f5f5f5;
            margin: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background: #0066cc;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h2 {
            margin: 0;
        }
        .total-badge {
            background: #ff6600;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 18px;
        }
        .message {

            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #0066cc;
            color: white;
            padding: 12px;
            text-align: right;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background: #f0f8ff;
        }
        tr.no-record {
            background: #d4edda;
        }
        tr.no-record:hover {
            background: #c3e6cb;
        }
        tr.has-record {
            background: #fff3cd;
        }
        tr.has-record:hover {
            background: #ffeaa7;
        }
        .record-count {
            background: #4CAF50;
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 12px;
            margin-left: 5px;
        }
        .record-count.zero {
            background: #28a745;
        }
        .record-details {
            font-size: 12px;
            color: #666;
        }
        .btn-delete {
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }
        .btn-delete.active {
            background: #dc3545;
        }
        .btn-delete.active:hover {
            background: #c82333;
        }
        .btn-delete.disabled {
            background: #6c757d;
            cursor: not-allowed;
            opacity: 0.6;
        }
        .btn-delete.disabled:hover {
            background: #6c757d;
        }
        .no-data {
            text-align: center;
            padding: 50px;
            color: #666;
            font-size: 18px;
        }
        .stats {
            display: flex;
            gap: 20px;
            margin: 15px 0;
            flex-wrap: wrap;
        }
        .stats-item {
            background: #e8f4fd;
            padding: 10px 20px;
            border-radius: 5px;
            flex: 1;
            min-width: 150px;
            text-align: center;
        }
        .stats-item strong {
            color: #0066cc;
            font-size: 20px;
            display: block;
        }
        .stats-item.can-delete {
            background: #d4edda;
        }
        .stats-item.can-delete strong {
            color: #28a745;
        }
        .stats-item.cant-delete {
            background: #fff3cd;
        }
        .stats-item.cant-delete strong {
            color: #dc3545;
        }
        .expand-btn {
            background: #17a2b8;
            color: white;
            border: none;
            padding: 2px 10px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 11px;
        }
        .expand-btn:hover {
            background: #138496;
        }
        .table-details {
            display: none;
            margin-top: 5px;
            font-size: 12px;
            background: #f8f9fa;
            padding: 5px;
            border-radius: 3px;
        }
        .table-details.show {
            display: block;
        }
        .status-badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }
        .status-badge.can-delete {
            background: #28a745;
            color: white;
        }
        .status-badge.cant-delete {
            background: #dc3545;
            color: white;
        }
        .search-box {
            margin-bottom: 20px;
        }
        .search-box input {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 300px;
            font-size: 14px;
        }
        .legend {
            display: flex;
            gap: 20px;
            margin: 15px 0;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
            font-size: 14px;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 3px;
        }
        .legend-color.green {
            background: #d4edda;
            border: 1px solid #28a745;
        }
        .legend-color.yellow {
            background: #fff3cd;
            border: 1px solid #dc3545;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>📋 مدیریت آبادی‌های بدون آمار</h2>
        <div class="total-badge">
            تعداد کل: <?php echo number_format($total_abadis); ?>
        </div>
    </div>

    <?php if (isset($message)): ?>
    <div class="message <?php echo $message_type; ?>">
        <?php echo $message; ?>
    </div>
    <?php endif; ?>

    <div class="legend">
        <div class="legend-item">
            <div class="legend-color green"></div>
            <span>🟢 قابل حذف (بدون رکورد)</span>
        </div>
        <div class="legend-item">
            <div class="legend-color yellow"></div>
            <span>🟡 غیرقابل حذف (دارای رکورد)</span>
        </div>
    </div>

    <?php 
    // محاسبه آمار
    $can_delete_count = 0;
    $cant_delete_count = 0;
    $total_records_all = 0;
    
    foreach ($abadi_list as $abadi) {
        $counts = getRecordCounts($dbh, $abadi['add_abadi']);
        if ($counts['total'] == 0) {
            $can_delete_count++;
        } else {
            $cant_delete_count++;
            $total_records_all += $counts['total'];
        }
    }
    ?>

    <div class="stats">
        <div class="stats-item can-delete">
            <strong><?php echo number_format($can_delete_count); ?></strong>
            قابل حذف (بدون رکورد)
        </div>
        <div class="stats-item cant-delete">
            <strong><?php echo number_format($cant_delete_count); ?></strong>
            غیرقابل حذف (دارای رکورد)
        </div>
        <div class="stats-item">
            <strong><?php echo number_format($total_records_all); ?></strong>
            کل رکوردها
        </div>
    </div>

    <?php if ($total_abadis == 0): ?>
        <div class="no-data">
            ✅ همه آبادی‌ها در جدول public_abadi4 وجود دارند.<br>
            <span style="font-size: 14px; color: #999;">هیچ آبادی بدون آمار یافت نشد.</span>
        </div>
    <?php else: ?>

    <div class="search-box">
        <input type="text" id="searchInput" placeholder="جستجوی آبادی..." onkeyup="filterTable()">
    </div>

    <div style="overflow-x: auto; max-height: 600px; overflow-y: auto;">
        <table id="abadiTable">
            <thead>
                <tr>
                    <th style="width: 50px;">ردیف</th>
                    <th style="width: 120px;">کد آبادی</th>
                    <th>نام آبادی</th>
                    <th style="width: 200px;">وضعیت</th>
                    <th style="width: 150px;">تعداد رکورد</th>
                    <th style="width: 120px;">عملیات</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $row_number = 0;
            foreach ($abadi_list as $abadi):
                $row_number++;
                $add_abadi = $abadi['add_abadi'];
                $abadi_name = $abadi['abadi'];
                
                // دریافت تعداد رکوردها
                $counts = getRecordCounts($dbh, $add_abadi);
                $total_records = $counts['total'];
                $details = $counts['details'];
                
                // تعیین کلاس ردیف
                if ($total_records == 0) {
                    $row_class = 'no-record';
                    $can_delete = true;
                    $status_text = '✅ قابل حذف';
                    $status_class = 'can-delete';
                } else {
                    $row_class = 'has-record';
                    $can_delete = false;
                    $status_text = '⛔ غیرقابل حذف';
                    $status_class = 'cant-delete';
                }
            ?>
                <tr class="<?php echo $row_class; ?>" data-name="<?php echo htmlspecialchars($abadi_name); ?>">
                    <td><?php echo $row_number; ?></td>
                    <td><?php echo htmlspecialchars($add_abadi); ?></td>
                    <td><?php echo htmlspecialchars($abadi_name); ?></td>
                    <td>
                        <span class="status-badge <?php echo $status_class; ?>">
                            <?php echo $status_text; ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($total_records > 0): ?>
                            <span class="record-count"><?php echo number_format($total_records); ?> رکورد</span>
                            <button class="expand-btn" onclick="toggleDetails(<?php echo $row_number; ?>)">
                                📊 جزئیات
                            </button>
                            <div class="table-details" id="details-<?php echo $row_number; ?>">
                                <?php foreach ($details as $table => $count): ?>
                                    <div><?php echo htmlspecialchars($table); ?>: <?php echo number_format($count); ?> رکورد</div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <span class="record-count zero">✅ بدون رکورد</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($can_delete): ?>
                            <button class="btn-delete active" 
                                    onclick="confirmDelete('<?php echo $add_abadi; ?>', '<?php echo addslashes($abadi_name); ?>')">
                                🗑️ حذف
                            </button>
                        <?php else: ?>
                            <button class="btn-delete disabled" disabled title="این آبادی دارای رکورد در جداول دیگر است و قابل حذف نیست">
                                🔒 غیرفعال
                            </button>
                            <br><small style="color: #999; font-size: 10px;"><?php echo number_format($total_records); ?> رکورد همراه</small>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php endif; ?>
</div>

<script>
// جستجو در جدول
function filterTable() {
    var input = document.getElementById("searchInput");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("abadiTable");
    var rows = table.getElementsByTagName("tr");
    
    for (var i = 1; i < rows.length; i++) {
        var td = rows[i].getElementsByTagName("td");
        if (td.length > 0) {
            var name = td[2].textContent || td[2].innerText;
            if (name.toUpperCase().indexOf(filter) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
}

// نمایش/مخفی کردن جزئیات
function toggleDetails(rowId) {
    var details = document.getElementById("details-" + rowId);
    if (details.classList.contains("show")) {
        details.classList.remove("show");
    } else {
        details.classList.add("show");
    }
}

// تایید حذف
function confirmDelete(add_abadi, abadi_name) {
    if (confirm("آیا از حذف آبادی '" + abadi_name + "' اطمینان دارید؟\n\n" +
               "⚠️ این عملیات:\n" +
               "1. یک کپی در جدول بایگانی (list_abadi_del) ذخیره می‌کند\n" +
               "2. آبادی را از جدول اصلی (list_abadi) حذف می‌کند\n\n" +
               "✅ این آبادی هیچ رکوردی در جداول دیگر ندارد\n\n" +
               "آیا ادامه می‌دهید؟")) {
        window.location.href = "?delete=1&add_abadi=" + encodeURIComponent(add_abadi);
    }
}

// پیغام موفقیت بعد از 5 ثانیه محو شود
setTimeout(function() {
    var message = document.querySelector(".message");
    if (message) {
        message.style.transition = "opacity 1s";
        message.style.opacity = "0";
        setTimeout(function() {
            message.style.display = "none";
        }, 1000);
    }
}, 5000);
</script>

</body>
</html>