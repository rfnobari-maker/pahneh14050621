<?php
    require_once('../../login/config.php');
    require_once('../../Jalali.php'); // شامل کردن فایل برای تبدیل تاریخ به شمسی
    date_default_timezone_set('Asia/Tehran'); // تنظیم منطقه زمانی
    
    // دریافت متغیرها از درخواست POST
    $Garden_id = $_POST['Garden_id'];
    $z_sal = $_POST['z_sal'];
    $mor_cod_m = $_POST['mor_cod_m'];

    // نام جدول را بر اساس z_sal تعیین می‌کنیم
    $Garden_not_table = 'Garden_note' . $z_sal;
    ?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>افزودن توضیحات</title>
<link href="../../FA.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="style_note.css">
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
        <style>
	        .close-btn-container {
            position: fixed; /* Use fixed to keep it in place while scrolling */
            top: 20px;
            left: 20px;
            z-index: 1000; /* Ensure it is on top of other elements */
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
    <h1> توضیحات </h1>
    <!-- فرم درج توضیحات جدید -->
    <form id="descriptionForm">
        <label for="description">توضیح جدید:</label>
        <textarea id="description" name="description" required title="متن خود را وارد کنید"></textarea>
        <button class="note_button"  type="submit">ثبت </button>
    </form>

    <h3>لیست توضیحات :</h3>
    <div id="previousDescriptions"></div>
  </div>
</div>
<script>
    $(document).ready(function() {
        // بارگذاری توضیحات قبلی از get_descriptions.php
        $.post('get_descriptions.php', {
            Garden_id: <?php echo json_encode($Garden_id); ?>,
            z_sal: <?php echo json_encode($z_sal); ?>,
            mor_cod_m: <?php echo json_encode($mor_cod_m); ?>
        }, function(response) {
            const result = JSON.parse(response);
            if (result.success) {
                result.descriptions.forEach(function(desc) {
                    $('#previousDescriptions').append(
                        '<div class="description-container" data-id="' + desc.id + '">' +
                            '<p><strong>تاریخ:</strong> ' + desc.date_s + '</p>' +
                            '<p><strong>متن توضیح:</strong> ' + desc.description + '</p>' +
                            '<p><strong>کد ملی کارشناس:</strong> ' + desc.mor_cod_m + '</p>' +
                            '<span class="delete-button" data-id="' + desc.id + '">حذف</span>' +
                            '<hr class="separator">' +
                        '</div>'
                    );
                });
            } else {
                alert('خطا در بارگذاری توضیحات: ' + result.error);
            }
        });

        // ارسال توضیح جدید با استفاده از AJAX
        $('#descriptionForm').on('submit', function(e) {
            e.preventDefault();
            const description = $('#description').val();
            $.post('save_description.php', {
                description: description,
                Garden_id: <?php echo json_encode($Garden_id); ?>,
                z_sal: <?php echo json_encode($z_sal); ?>,
                mor_cod_m: <?php echo json_encode($mor_cod_m); ?>
            }, function(response) {
				console.log("Response:", response); // اضافه کردن این خط برای مشاهده پاسخ
                const result = JSON.parse(response);
                if (result.success) {
                    // نمایش توضیح جدید در لیست
                    $('#previousDescriptions').prepend(
                        '<div class="description-container" data-id="' + result.id + '">' +
                            '<p><strong>تاریخ:</strong> ' + result.date_s + '</p>' +
                            '<p><strong>متن توضیح:</strong> ' + result.description + '</p>' +
                            '<p><strong>کد ملی کارشناس:</strong> ' + result.mor_cod_m + '</p>' +
                            '<span class="delete-button" data-id="' + result.id + '">حذف</span>' +
                            '<hr class="separator">' +
                        '</div>'
                    );
                    $('#description').val(''); // پاک کردن فیلد توضیحات
                } else {
                    alert('خطا در ذخیره توضیح: ' + result.error);
                }
            });
        });

        // حذف توضیحات
 $('#previousDescriptions').on('click', '.delete-button', function () {
            var id = $(this).data('id');
            var z_sal = <?php echo json_encode($z_sal); ?>;
            if (confirm('آیا از حذف این توضیح مطمئن هستید؟')) {
                $.ajax({
                    type: "POST",
                    url: "delete_description.php",
                    data: {id: id,z_sal: z_sal},
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            $('span[data-id="' + id + '"]').parent().remove();
                        } else {
                            alert('خطا در حذف توضیح: ' + response.error);
                        }
                    },
                    error: function () {
                        alert('خطا در ارتباط با سرور');
		                }
                });
            }
        });
    });
</script>

</body>
</html>