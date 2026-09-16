<!DOCTYPE html>
<html lang="fa">
<head>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <title>فرم ثبت اطلاعات دام</title>
    <style>
        body {
            direction: rtl;
            text-align: center;
            margin: 20px;
        }
           .search-box {
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    background-color: #f9f9f9;
    width: 45%;
    margin: auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
              }
          th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
			font-size:14px ;
			font-style:oblique;
        }
        input[type="number"] {
            width: 80px;
			height: 40px;
            padding: 2px;
            box-sizing: border-box;
        }
        select {
            width: 120px;
			height:35px;
            padding: 2px;
            box-sizing: border-box;
        }

        .btn1 {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
			font-family: myfont;
        }
        .btn1:hover {
            background-color: #45a049;
        }
        .icon-btn {
            padding: 5px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background: none;
        }
        .icon-btn:focus {
            outline: none;
        }
        button {
            margin: 5px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .add-btn {
            background-color: #4CAF50;
            color: white;
			font-family:myfont;
        }
        .remove-btn {
            padding: 8px 16px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
			font-family: myfont;
        }
    </style>
</head>
<body style="background-color:#FFF">

<h2>فرم ثبت آمار دام</h2>
<?php
$partIDCode = isset($_POST['partIDCode']) ? $_POST['partIDCode'] : '';
$sal = isset($_POST['sal']) ? $_POST['sal'] : '';
?>
<!-- فرم جستجو -->
<div class="search-box">
<form id="searchForm" >
    <div style="display: flex; flex-direction: column; align-items: center; width: 100%; max-width: 300px; margin: 0 auto;">
        <div style="display: flex; align-items: center; justify-content: space-between; width: 84%; margin-bottom: 20px;">
            <label for="searchPartIDCode" style="margin-left: 10px; font-size:14px">شناسه یکتا : </label>
            <input type="text" id="searchPartIDCode" name="partIDCode" value="<?php echo $partIDCode ; ?>" required style="flex: 1;">
        </div>
        <div style="display: flex; align-items: center; justify-content: space-between; width: 80%; margin-bottom: 10px;">
            <label for="searchSal" style="margin-left: 10px; font-size:14px">ســـــــــال :</label>
            <select id="searchSal" name="sal" required style="flex: 1;">
                <option value="1404" <?php if ($sal=='1404')echo 'selected' ;?> >1404</option>
                <option value="1403" <?php if ($sal=='1403')echo 'selected' ;?> >1403</option>
            </select>
        </div>
    </div>
</form> 
   <div id="searchResultMessage" style="color: red; margin-top: 10px;"></div>
</div>
<div style="background-color:#FFF; width:90%; margin:auto ; text-align:center ; margin-top:15px">
<form id="animalForm">
    <!-- فیلدهای ثابت مخفی -->
    <input type="hidden" name="action" value="save">
    <input type="hidden" id="partIDCode" name="partIDCode" value="12345">
    <input type="hidden" id="sal" name="sal" value="1403">

    <table width="100%" id="animalTable" align="center" class="my-table">
        <thead>
            <tr>
                <th>گونه</th>
                <th>نژاد</th>
                <th>جنسیت</th>
                <th>سن</th>
                <th>نوع فعالیت</th>
                <th>تعداد دام</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</form>
</div>
 <button type="button" class="add-btn" onclick="addRow()" style="display: none;" id="addAllBtn"> ایجاد ردیف جدید </button>
<button class="remove-btn" onclick="removeRows(this)" style="display: none;" id="removeAllBtn">حذف همه رکوردها</button>
<script>

    // تعریف مقادیر دریافتی از PHP
    const partIDCode = "<?php echo htmlspecialchars($partIDCode); ?>";
    const sal = "<?php echo htmlspecialchars($sal); ?>";
    // اجرای تابع جستجو هنگام بارگذاری صفحه
    if (partIDCode && sal) {
        searchRecord(); // نیازی به ارسال مجدد مقادیر نیست
    }

function addRow() {
    const table = document.getElementById('animalTable').getElementsByTagName('tbody')[0];

    // بررسی اینکه آیا جدول ردیفی دارد یا نه
    if (table.rows.length === 0) {
        // اگر جدول خالی است، ردیف جدید را به صورت دستی اضافه کنید
        const newRow = table.insertRow(0);  // اضافه کردن ردیف به ابتدای جدول
        // اضافه کردن سلول‌های جدید به ردیف جدید
        newRow.innerHTML =  newRow.innerHTML = `
		<input type="hidden" name="rowID" value="">
        <td>
            <select name="species[]">
                <option value="">انتخاب کنید</option>
                <option value="1">گاو</option>
                <option value="2">گاومیش</option>
                <option value="3">شتر</option>
                <option value="4">گوسفند</option>
                <option value="5">بز</option>
                <option value="6">اسب</option>
                <option value="7">استر</option>
            </select>
        </td>
        <td>
            <select name="breed[]">
                <option value="">انتخاب کنید</option>
                <option value="1">اصیل</option>
                <option value="2">بومی</option>
                <option value="3">آمیخته</option>
            </select>
        </td>
        <td>
            <select name="gender[]">
                <option value="">انتخاب کنید</option>
                <option value="1">نر</option>
                <option value="2">ماده</option>
                <option value="3">فریمارتین نر</option>
                <option value="4">فریمارتین ماده</option>
            </select>
        </td>
        <td>
            <select name="age[]">
                <option value="">انتخاب کنید</option>
                <option value="1">0 تا 5 ماه</option>
                <option value="2">6 تا 12 ماه</option>
                <option value="3">از یکسال تا دو سال</option>
                <option value="4">بیشتر از دو سال</option>
            </select>
        </td>
        <td>
            <select name="activity[]">
                <option value="">انتخاب کنید</option>
                <option value="1">داشتی شیری</option>
                <option value="2">داشتی دومنظوره</option>
                <option value="3">داشتی بومی</option>
                <option value="4">پرواری</option>
            </select>
        </td>
        <td><input type="number" name="quantity[]" min="1" required></td>
        <td>
                            <button type="button" class="remove-btn" title="حذف ردیف" onclick="removeRow(this)">✖</button>
                            <button type="button" class="btn1" title="ثبت/ویرایش" onclick="saveEdit(this)">✔</button>
        </td>
    `;
    } else {
        // اگر جدول ردیف دارد، ردیف اول را کپی کنید
        const newRow = table.rows[0].cloneNode(true);
        newRow.querySelectorAll('select, input').forEach(input => input.value = ''); // خالی کردن مقادیر ورودی‌ها
        table.appendChild(newRow); // اضافه کردن ردیف کپی‌شده به انتهای جدول
    }
}

function removeRow(button) {
    const row = button.parentElement.parentElement; // پیدا کردن ردیف
    const recordId = row.querySelector('input[name="rowID"]').value; 
    // بررسی اینکه آیا recordId کوچکتر از 1 است
   if (!recordId || parseInt(recordId) < 1) {
        // اگر recordId کوچکتر از 1 باشد، ردیف حذف می‌شود بدون درخواست به سرور
    const table = document.getElementById('animalTable').getElementsByTagName('tbody')[0];
  //  if (table.rows.length > 1) {
        row.remove();
   // } else {
    //    alert('حداقل باید یک ردیف وجود داشته باشد.');
   // }

    } else {
        // تایید حذف از کاربر
        if (confirm(`آیا می‌خواهید اطلاعات این ردیف حذف شود؟`)) {
            // ارسال درخواست به سرور برای حذف
            fetch('delete_record.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ recordId: recordId }) // ارسال rowID به سرور
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // برای دیباگ داده‌های دریافتی را در کنسول نمایش دهید
//                alert(data.message);
                row.remove(); // حذف ردیف از جدول در صورت موفقیت
  		      // نمایش پیام
			   const messageElement = document.getElementById('searchResultMessage');
               messageElement.style.color = 'red';
	           messageElement.textContent = data.message;  // پاک کردن پیام تاکنون رکودی ثبت نشده
      // شمارش تعداد ردیف های جدول
	  const table = document.getElementById('animalTable').getElementsByTagName('tbody')[0];
      if (table.rows.length < 1) {
        const removeBtn = document.getElementById('removeAllBtn');
        removeBtn.style.display = 'none'; // مخفی کردن دکمه حدف همه رکوردها
	  }
            })
            .catch(error => {
                console.error('خطا در حذف رکورد:', error);
                alert('خطا در حذف رکورد');
            });
        }
    }
}


function removeRows(button) {
    const row = button.parentElement.parentElement;  // پیدا کردن ردیف کنونی
    const table = document.getElementById('animalTable');  // به دست آوردن جدول بر اساس id آن
    const rows = table.getElementsByTagName('tbody')[0].rows;  // گرفتن تمام ردیف‌ها در tbody

    if (confirm(`همه آمار ثبت شده برای شناسه یکتای : ${partIDCode} در سال : ${sal} حذف شود؟`)) {
        // ارسال درخواست به سرور برای حذف
        fetch('delete_records.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ partIDCode: partIDCode }) // ارسال شناسه یکتا به سرور
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // برای دیباگ داده‌های دریافتی را در کنسول نمایش دهید
         //   alert(data.message);
        // نمایش پیام 
		       const messageElement = document.getElementById('searchResultMessage');
               messageElement.style.color = 'red';
	           messageElement.textContent = data.message;  // پاک کردن پیام تاکنون رکودی ثبت نشده


            // حذف تمام ردیف‌ها از جدول
            for (let i = rows.length - 1; i >= 0; i--) {
                rows[i].remove();
            }
        const removeBtn = document.getElementById('removeAllBtn');
        removeBtn.style.display = 'none'; // مخفی کردن دکمه حدف همه رکوردها

			
        })
        .catch(error => {
            console.error('خطا در حذف رکورد:', error);
            alert('خطا در حذف رکورد');
        });
    }
}


function saveEdit(button) {
    const row = button.parentElement.parentElement;
    const formData = new FormData();

    // جمع‌آوری داده‌های ردیف
    row.querySelectorAll('select, input').forEach(input => {
        formData.append(input.name, input.value);
    });

    
    formData.append('partIDCode', partIDCode);
    formData.append('sal', sal);

    // بررسی مقدار rowID برای تشخیص عملیات ثبت یا ویرایش
    const rowID = row.querySelector('input[name="rowID"]').value;

    if (rowID) { // اگر rowID وجود داشت (ویرایش)
        formData.append('action', 'edit'); // عملیات ویرایش
        formData.append('id', rowID); // اضافه کردن ID به فرم
    } else { // اگر rowID تهی بود (ثبت داده جدید)
        formData.append('action', 'save'); // عملیات ثبت
    }

    // نمایش اطلاعات FormData در کنسول
    console.log('Sending data:');
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

    fetch('save_edit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log('Response from server:', data); // نمایش پاسخ سرور در کنسول
        alert(data); // نمایش پاسخ از سرور
    })
    .catch(error => {
        console.error('Error:', error); // نمایش خطا در صورت بروز مشکل
    });
}



function searchRecord(event) {
  //  event.preventDefault();

       const addBtn = document.getElementById('addAllBtn');
        addBtn.style.display = 'inline'; // نمایش دکمه

    fetch(`search_dam.php?partIDCode=${partIDCode}&sal=${sal}`)
        .then(response => response.json())
        .then(data => {
            const messageElement = document.getElementById('searchResultMessage');
            const tableBody = document.querySelector('#animalTable tbody');
            tableBody.innerHTML = ''; // پاک کردن محتوای فعلی جدول

            if (data.found) {
             //   messageElement.style.color = 'green';
            //    messageElement.textContent = 'سوابق موجود :';
                data.records.forEach(rowData => {
                    const newRow = document.createElement('tr');

const speciesOptions = ['انتخاب کنید', 'گاو', 'گاومیش', 'شتر', 'گوسفند', 'بز', 'اسب', 'استر'];
const breedOptions = ['انتخاب کنید', 'اصیل', 'بومی', 'آمیخته'];
const genderOptions = ['انتخاب کنید', 'نر', 'ماده', 'فریمارتین نر', 'فریمارتین ماده'];
const ageOptions = ['انتخاب کنید', '0 تا 5 ماه', '6 تا 12 ماه', 'از یکسال تا دو سال', 'بیشتر از دو سال'];
const activityOptions = ['انتخاب کنید', 'داشتی شیری', 'داشتی دومنظوره', 'داشتی بومی', 'پرواری'];

// تابعی برای ایجاد option ها برای هر select
function createOptions(options, selectedValue) {
    return options.map((option, index) => {
        let value = (index === 0) ? '' : index;
        return `<option value="${value}" ${selectedValue == value ? 'selected' : ''}>${option}</option>`;
    }).join('');
}

                    newRow.innerHTML = `
      					<input type="hidden" name="rowID" value="${rowData.id}">
                        <td><select name="species[]">${createOptions(speciesOptions, rowData.species)}</select></td>
                        <td><select name="breed[]">${createOptions(breedOptions, rowData.breed)}</select></td>
                        <td><select name="gender[]">${createOptions(genderOptions, rowData.gender)}</select></td>
                        <td><select name="age[]">${createOptions(ageOptions, rowData.age)}</select></td>
                        <td><select name="activity[]">${createOptions(activityOptions, rowData.activity)}</select></td>
                        <td><input type="number" name="quantity[]" value="${rowData.quantity}" required></td>
                        <td>
                            <button type="button" class="remove-btn" title="حذف ردیف" onclick="removeRow(this)">✖</button>
                            <button type="button" class="btn1" title="ثبت/ویرایش" onclick="saveEdit(this)">✔</button>
                        </td>
                    `;
                    tableBody.appendChild(newRow);
                });
                checkSearchResults();
            } else {
                messageElement.style.color = 'red';
                messageElement.textContent = data.message;

                // ایجاد یک ردیف خالی مشابه بارگذاری اولیه
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
				<input type="hidden" name="rowID" value="">
                    <td>
                        <select name="species[]">
                          <option value="" selected >انتخاب کنید</option>
                            <option value="1">گاو</option>
                            <option value="2">گاومیش</option>
                            <option value="3">شتر</option>
                            <option value="4">گوسفند</option>
                            <option value="5">بز</option>
                            <option value="6">اسب</option>
                            <option value="7">استر</option>
                        </select>
                    </td>
                    <td>
                        <select name="breed[]">
                          <option value="" selected >انتخاب کنید</option>
                            <option value="1">اصیل</option>
                            <option value="2">بومی</option>
                            <option value="3">آمیخته</option>
                        </select>
                    </td>
                    <td>
                        <select name="gender[]">
                          <option value="" selected >انتخاب کنید</option>
                            <option value="1">نر</option>
                            <option value="2">ماده</option>
                            <option value="3">فریمارتین نر</option>
                            <option value="4">فریمارتین ماده</option>
                        </select>
                    </td>
                    <td>
                        <select name="age[]">
                          <option value="" selected >انتخاب کنید</option>
                            <option value="1">0 تا 5 ماه</option>
                            <option value="2">6 تا 12 ماه</option>
                            <option value="3">از یکسال تا دو سال</option>
                            <option value="4">بیشتر از دو سال</option>
                        </select>
                    </td>
                    <td>
                        <select name="activity[]">
                          <option value="" selected >انتخاب کنید</option>
                            <option value="1">داشتی شیری</option>
                            <option value="2">داشتی دومنظوره</option>
                            <option value="3">داشتی بومی</option>
                            <option value="4">پرواری</option>
                        </select>
                    </td>
                    <td><input type="number" name="quantity[]" required></td>
                    <td>
                        <button type="button" class="remove-btn" title="حذف ردیف" onclick="removeRow(this)">✖</button>
                        <button type="button" class="btn1" title="ثبت/ویرایش" onclick="saveEdit(this)">✔</button>
                    </td>
                `;
                tableBody.appendChild(newRow);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function checkSearchResults() {
    const table = document.getElementById('animalTable');
    // اگر جدول موجود نباشد، تابع را متوقف کن
    if (!table) {
        console.log('جدول پیدا نشد');
        return;
    }
    const rows = table.getElementsByTagName('tr');
    // تعداد ردیف‌ها بیشتر از یک باشد (چون ردیف اول هدر است)
   // const resultCount = rows.length - 1; // کم کردن 1 برای هدر
     const resultCount = rows.length ; // کم کردن 1 برای هدر
    const removeBtn = document.getElementById('removeAllBtn');
  if (resultCount > 0) {
        removeBtn.style.display = 'inline'; // نمایش دکمه
    } else {
        removeBtn.style.display = 'none'; // مخفی کردن دکمه
    }
}

function saveEdit(button) {
    const row = button.closest('tr'); // پیدا کردن ردیف (tr) به طور مستقیم
    const formData = new FormData();

    // جمع‌آوری داده‌های ردیف
    row.querySelectorAll('select, input').forEach(input => {
        formData.append(input.name, input.value);
    });

    // اضافه کردن partIDCode و sal از فرم یا جدول
    formData.append('partIDCode', partIDCode);
    formData.append('sal', sal);

    // بررسی مقدار rowID برای تشخیص عملیات ثبت یا ویرایش
    const rowID = row.querySelector('input[name="rowID"]').value;
    if (rowID) { // اگر rowID وجود داشت (ویرایش)
        formData.append('action', 'edit');
    } else { // اگر rowID تهی بود (ثبت داده جدید)
        formData.append('action', 'save');
    }

    // نمایش اطلاعات FormData در کنسول
    console.log('Sending data:');
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

    // ارسال داده‌ها به سرور
    fetch('save_edit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())  // دریافت پاسخ به صورت متن
    .then(data => {
        try {
            // تبدیل داده‌های JSON به شیء جاوااسکریپت
            const parsedData = JSON.parse(data);
            
            // نمایش داده‌های خوانا در کنسول
            console.log('Response from server:', parsedData);
            
            // استخراج و نمایش پیام از سرور
            //alert(parsedData.message);
            
            // دریافت و نمایش rowID
            const rowID = parsedData.rowID ; 
            console.log('Row ID:', rowID);
            
            // پیدا کردن فیلد rowID در ردیف و قرار دادن آن
            row.querySelector('input[name="rowID"]').value = rowID;
            		
        const removeBtn = document.getElementById('removeAllBtn');
        removeBtn.style.display = 'inline'; // نمایش دکمه حذف همه رکوردها
		
        // نمایش پیام 
		       const messageElement = document.getElementById('searchResultMessage');
               messageElement.style.color = 'green';
	           messageElement.textContent = parsedData.message;  // پاک کردن پیام تاکنون رکودی ثبت نشده

        } catch (e) {
            console.error('Error parsing JSON:', e);  // در صورت بروز خطا در تبدیل JSON
        }
    })
    .catch(error => {
        console.error('Error:', error);  // مدیریت خطاهای مربوط به درخواست
    });
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[name="quantity[]"]').forEach(input => {
        input.addEventListener('input', function() {
            // بررسی اینکه ورودی یک عدد معتبر است
            if (this.value < 1) {
                this.value = 1;
                alert("مقدار نمی‌تواند کمتر از 1 باشد.");
            }
        });
    });
});

</script>
</body>
</html>
