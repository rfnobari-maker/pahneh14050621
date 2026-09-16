<?php
// Include necessary files
include('../../login/config.php'); // Assuming this file contains $dbh for database connection

// Function to convert 0/1 to "Exists"/"Needed"
function get_status($value, $type) {
    if ($value === null) {
        return "-";
    } elseif ($value == 1) {
        return ($type == 'exists') ? 'موجود' : 'نیاز هست';
    } else {
        return ($type == 'exists') ? 'ناموجود' : 'نیاز نیست';
    }
}

// Check if unique_id is provided in the URL
if (isset($_POST['unique_id'])) {
    $unique_id = $_POST['unique_id'];

    // Prepare and execute the query
    $query = "SELECT * FROM `bee_equipment` WHERE `unique_id` = :unique_id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':unique_id' => $unique_id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if data was found
    if ($data) {
        ?>
        <!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa" xml:lang="fa">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
            <title>نمایش اطلاعات تجهیزات</title>
            <link href="../../FA.css" rel="stylesheet" type="text/css" />
            <style>
                body {
                    font-family: 'Tahoma', sans-serif;
                    background-color: #f0f0f0;
                    direction: rtl;
                    padding: 20px;
                }
                .container {
                    max-width: 900px;
                    margin: 20px auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    text-align: center;
                    color: #333;
                }
                .info-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                .info-table th, .info-table td {
                    border: 1px solid #ddd;
                    padding: 12px;
                    text-align: right;
                }
                .info-table th {
                    background-color: #f2f2f2;
                    font-weight: bold;
                    width: 30%;
                }
                .info-table td {
                    background-color: #fafafa;
                }
                .equipment-list-display {
                    list-style-type: none;
                    padding: 0;
                    margin: 0;
                }
                .equipment-list-display li {
                    padding: 10px;
                    border-bottom: 1px dashed #ccc;
                }
                .equipment-list-display li:last-child {
                    border-bottom: none;
                }
                .equipment-name-display {
                    font-weight: bold;
                    color: #4CAF50;
                }
                .equipment-status {
                    display: block;
                    margin-top: 5px;
                    color: #555;
                }
            </style>
                <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #FFC107;
            --background-light: #f5f7fa;
            --card-background: #ffffff;
            --text-color: #333;
            --border-color: #e0e0e0;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --border-radius: 12px;
        }

        body {
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            background-color: var(--background-light);
            color: var(--text-color);
            margin: 0;
            padding: 24px;
            direction: rtl;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }
        
        /* New styling for the button container */
        .close-btn-container {
            position: fixed; /* Use fixed to keep it in place while scrolling */
            top: 20px;
            left: 20px;
            z-index: 1000; /* Ensure it is on top of other elements */
        }

        .card {
            background: var(--card-background);
            padding: 24px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        h2 {
            text-align: center;
            color: var(--primary-color);
            margin-top: 0;
            font-size: 1.8rem;
        }

        .chart-container {
            position: relative;
        }

        .info-message {
            text-align: center;
            padding: 24px;
            background-color: #fff3e0;
            border: 1px solid #ffcc80;
            border-radius: 8px;
            color: #e65100;
            font-size: 1.2rem;
        }

        .close-btn {
            background-color: #F44336;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-family: 'Vazirmatn', Tahoma, Arial, sans-serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .close-btn:hover {
            background-color: #D32F2F;
            transform: translateY(-2px);
        }

        .close-btn:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .container {
                padding: 16px;
            }
            h2 {
                font-size: 1.5rem;
            }
            .close-btn-container {
                top: 10px;
                left: 10px;
            }
        }
    </style>

        </head>
        <body>
        <div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">بستن پنجره</button>
</div>

            <div class="container">
              <h1>مشخصات تجهیزات زنبورستان</h1>
              <table class="info-table">
                  <thead>
                        <tr>
                            <th>تجهیزات</th>
                            <th>وضعیت</th>
                            <th>نیاز</th>
                        </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td>کندو کف باز</td>
                            <td><?php echo get_status($data['taj_2_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_2_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>اکستراکتور برقی</td>
                            <td><?php echo get_status($data['taj_3_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_3_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>اکستراکتور دستی</td>
                            <td><?php echo get_status($data['taj_4_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_4_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>دستگاه برداشت ژله رویال اتوماتیک</td>
                            <td><?php echo get_status($data['taj_5_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_5_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>موم دوز برقی</td>
                            <td><?php echo get_status($data['taj_6_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_6_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>دستگاه پرکن عسل اتوماتیک</td>
                            <td><?php echo get_status($data['taj_7_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_7_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>صافی عسل</td>
                            <td><?php echo get_status($data['taj_8_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_8_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>رس گیر عسل گازی</td>
                            <td><?php echo get_status($data['taj_9_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_9_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>خرک برداشت عسل مخزن دار</td>
                            <td><?php echo get_status($data['taj_10_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_10_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>دستگاه تصعید اسید اگزالیک برقی</td>
                            <td><?php echo get_status($data['taj_11_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_11_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>دستگاه زهرگیر</td>
                            <td><?php echo get_status($data['taj_12_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_12_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>خرک برداشت عسل پایه دار</td>
                            <td><?php echo get_status($data['taj_13_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_13_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>دستگاه پرس موم</td>
                            <td><?php echo get_status($data['taj_14_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_14_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>دستگاه استحصال نان زنبور</td>
                            <td><?php echo get_status($data['taj_15_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_15_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>دستگاه تمیزکننده گرده گل</td>
                            <td><?php echo get_status($data['taj_16_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_16_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>دستگاه مه پاش</td>
                            <td><?php echo get_status($data['taj_17_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_17_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>سیستم کنترل هوشمند دمای کندو</td>
                            <td><?php echo get_status($data['taj_18_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_18_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>دستگاه رطوبت گیر عسل</td>
                            <td><?php echo get_status($data['taj_19_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_19_needed'], 'needed'); ?></td>
                        </tr>
                        <tr>
                            <td>دستگاه تغلیظ کننده عسل اتوماتیک</td>
                            <td><?php echo get_status($data['taj_20_exists'], 'exists'); ?></td>
                            <td><?php echo get_status($data['taj_20_needed'], 'needed'); ?></td>
                        </tr>
                    </tbody>
              </table>
            </div>
        </body>
        </html>
        <?php
    } else {
        // No data found for the provided unique_id
        echo "<p style='text-align: center; color: red;'>اطلاعاتی با این شناسه یافت نشد.</p>";
    }
} else {
    // unique_id was not provided
    echo "<p style='text-align: center; color: red;'>شناسه زنبورستان (unique_id) درخواستی در URL مشخص نشده است.</p>";
}
?>