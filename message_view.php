<?php
include("lock_p1.php");
include('event.php');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <link href="FA.css" rel="stylesheet" type="text/css" />
    <style>
        /* Modernized Styles */
        body {
            font-family: 'Tahoma', sans-serif; /* Example, adjust to your preferred Persian font */
            margin: 0;
            background-color: #f0f2f5; /* Light gray background */
        }

        .container {
            width: 100%; /* Adjust as needed */
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Softer shadow */
            border-radius: 8px; /* Slightly rounded corners for the main container */
            overflow: hidden; /* Clear any floats */
        }

        header {
            width: 100%;
            height: auto; /* Let image define height */
            display: block; /* Ensure image takes full width */
        }

        header img {
            width: 100%;
            height: auto;
            display: block;
        }

        .main-content {
            padding: 20px;
        }

        .message-box {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); /* Modern box-shadow */
            width: 95%; /* Adjusted width for better responsiveness */
            max-width: 600px; /* Max width for the message box */
            background-color: #fff;
            margin: 20px auto;
            border: 1px solid #e0e0e0; /* Lighter border */
            border-radius: 12px; /* More prominent border-radius */
            padding: 20px;
        }

        .user-pic {
            border-radius: 50%; /* Perfect circle for user image */
            width: 60px; /* Slightly larger for better visual */
            height: 60px;
            object-fit: cover; /* Ensure image covers the area nicely */
            border: 2px solid #007bff; /* A subtle border for the image */
        }

        .input-field {
            width: calc(100% - 20px); /* Adjust width to account for padding */
            padding: 12px 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px; /* Slightly rounded input fields */
            font-size: 16px;
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
            text-align: right; /* Maintain right-to-left text direction */
        }

        textarea.input-field {
            min-height: 120px; /* Taller text area */
            resize: vertical; /* Allow vertical resizing */
        }

        .form-row {
            display: flex; /* Use flexbox for layout within form rows */
            align-items: center; /* Vertically align items */
            margin-bottom: 15px;
            flex-wrap: wrap; /* Allow items to wrap on smaller screens */
        }

        .form-row label {
            flex: 0 0 120px; /* Fixed width for labels */
            text-align: left; /* Align label text to the left */
            padding-left: 15px; /* Space between label and input */
            font-weight: bold;
            color: #333;
        }

        .form-row .input-container {
            flex-grow: 1; /* Input takes remaining space */
        }

        .button-group {
            display: flex;
            justify-content: center; /* Center buttons */
            gap: 20px; /* Space between buttons */
            margin-top: 30px;
        }

        .action-button {
            padding: 12px 25px;
            background-color: #007bff; /* Primary blue button */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            min-width: 150px; /* Ensure buttons have a minimum width */
        }

        .action-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: translateY(-2px); /* Slight lift effect */
        }

        .attachment-link {
            display: inline-flex; /* Align icon and text if any */
            align-items: center;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .attachment-link:hover {
            color: #0056b3;
        }

        .attachment-link img {
            margin-left: 10px; /* Space between icon and text */
            width: 40px; /* Adjusted size for attachment icon */
            height: 40px;
        }

        .error-message {
            text-align: center;
            color: red;
            font-size: 1.2em;
            margin-top: 20px;
        }

        .go-back {
            display: block;
            margin: 30px auto;
            width: 120px; /* Keep the image size consistent */
            height: auto;
            text-align: center;
        }

        .go-back img {
            width: 100%;
            height: auto;
        }

        footer {
height: 109px; /* تنظیم ارتفاع */
    background-image: url('files/bottom.gif'); /* تصویر پس‌زمینه */
    background-position: center; /* تصویر را در مرکز قرار می‌دهد */
    display: flex; /* استفاده از Flexbox برای تراز کردن محتوا */
    align-items: center; /* محتوا را در مرکز عمودی قرار می‌دهد (معادل valign: middle) */
    justify-content: center; /* محتوا را در مرکز افقی قرار می‌دهد (اگر `footer.php` محتوای کمی داشته باشد) */
    /* اگر footer.php شامل محتوای تراز شده به چپ یا راست است، justify-content را بردارید */        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .message-box {
                width: 90%;
            }

            .form-row {
                flex-direction: column; /* Stack items vertically on small screens */
                align-items: flex-end; /* Align to the right in RTL */
            }

            .form-row label {
                padding-left: 0;
                margin-bottom: 5px; /* Add some space below labels */
                text-align: right;
            }

            .button-group {
                flex-direction: column;
                gap: 15px;
            }

            .action-button {
                width: 100%; /* Full width buttons on small screens */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img src="files/images/header.jpg" alt="Header Image" />
        </header>

        <div dir="ltr"><?php include('menu_notseen.php'); ?></div>

        <div class="main-content">
            <?php include('top.php'); ?>

            <?php
            if (isset($_POST['id']) && isset($_POST['s_user'])) {
                $id = $_POST['id'];
                $s_user = $_POST['s_user'];
                $query = "SELECT * FROM pm WHERE id = :id AND s_user = :s_user"; // Use prepared statements for security
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':s_user', $s_user, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) { // Check if a message was found
                    $title_msg = $row['title']; // Renamed to avoid conflict with page title
                    $s_user_name = $row['s_user'];
                    $r_user = $row['r_user'];
                    $message = $row['message'];
                    $file = $row['file'];
            ?>
                    <h2 style="text-align: center; margin-bottom: 20px;">مشاهده پیام</h2>
                    <hr style="border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0)); margin-bottom: 30px;">

                    <form action="" method="post" id="form1">
                        <div class="message-box">
                            <div class="form-row">
                                <label for="sender_name">فرستنده:</label>
                                <div class="input-container" style="display: flex; align-items: center;">
                                    <img class="user-pic" src="../files/users/<?php echo user_pic($s_user_name); ?>" alt="User Picture" />
                                    <input name="sender_name" type="text" class="input-field" id="sender_name" value="<?php echo user_name($s_user_name); ?>" readonly />
                                </div>
                            </div>

                            <div class="form-row">
                                <label for="message_title">موضوع پیام:</label>
                                <div class="input-container">
                                    <input name="message_title" type="text" class="input-field" id="message_title" value="<?php echo $title_msg; ?>" readonly />
                                </div>
                            </div>

                            <div class="form-row">
                                <label for="message_content">متن پیام:</label>
                                <div class="input-container">
                                    <textarea name="message_content" class="input-field" id="message_content" readonly><?php echo $message; ?></textarea>
                                </div>
                            </div>

                            <?php if (!empty($file)) { ?>
                                <div class="form-row">
                                    <label>فایل پیوستی:</label>
                                    <div class="input-container">
                                        <a href="../pm_files/<?php echo $file; ?>" target="_blank" class="attachment-link" title="مشاهده پیوست">
                                            <img src="files/reports.png" alt="Attachment Icon" />
                                            <span>مشاهده فایل</span>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="button-group">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                <input type="hidden" name="s_user" value="<?php echo $row['s_user']; ?>" />
                                <button type="submit" name="reply2" class="action-button">انتقال پیام</button>

                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                <input type="hidden" name="s_user" value="<?php echo $row['s_user']; ?>" />
                                <button type="submit" name="reply1" class="action-button">ارسال پاسخ</button>
                            </div>
                        </div>
                    </form>
            <?php
                } else {
                    echo '<p class="error-message">پیام یافت نشد.</p>';
                }
            } else {
                echo '<p class="error-message">مجوز دسترسی به این صفحه را ندارید.</p>';
            }
            ?>

            <a href="messanger.php" title="برگشت به صفحه قبل" class="go-back">
                <img src="files/goback.jpg" alt="Go Back" />
            </a>
        </div>

        <footer>
            <?php include('footer.php'); ?>
        </footer>
    </div>

    <?php
    if (isset($_POST['reply1'])) {
    ?>
        <form name="reply_form" class="reply" method="post" action="reply_pm.php#1">
            <input type="hidden" name="username" value="<?php echo $row['s_user']; ?>" />
            <input type="hidden" name="title" value="<?php echo $row['title']; ?>" />
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        </form>
        <script type="text/javascript">document.reply_form.submit();</script>
    <?php
    }
    ?>

    <?php
    if (isset($_POST['reply2'])) {
    ?>
        <form name="forward_form" class="reply" method="post" action="forward.php#1">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        </form>
        <script type="text/javascript">document.forward_form.submit();</script>
    <?php
    }
    ?>
</body>
</html>