<?php
include('../../lock_p1.php');
include('../../event.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
      <style>
           .search-box {
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    background-color: #f9f9f9;
    width: 78%;
    margin: auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
              }
          .th, .td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        .th {
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
            padding: 5px 8px;
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
            padding: 5px 8px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
			font-family: myfont;
			font-weight:bold;
        }
        .remove-btn {
            padding: 5px 8px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
			font-family: myfont;
    		font-weight:bold;
        }
.btn_cancel {
	margin-top:55px ; 
    width: 200px; /* هر دکمه 48% از عرض ردیف */
    padding: 15px;
    color: white;
    font-family:myfont;
    font-size: 18px;
	font-weight:bold ; 
    border: none;
    cursor: pointer;
    border-radius: 5px; /* گوشه‌های گرد */
    background-color:#903;
}
.form-row1 button[value='cancel']:hover {
    background-color:#F30 ;
}  

    </style>
</head>
<body>
     <table dir="rtl" width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>
<?php
$partIDCode = isset($_POST['partIDCode']) ? $_POST['partIDCode'] : '';
$sal = isset($_POST['sal']) ? $_POST['sal'] : '';
$no_fa = isset($_POST['no_fa']) ? $_POST['no_fa'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$epidemiologic = isset($_POST['epidemiologic']) ? $_POST['epidemiologic'] : '';


?>
<h4> ثبت آمار واحد در سال <?php echo $sal ?></h4>
<!-- فرم جستجو -->
<div class="search-box">
       <div style="display: flex; align-items: center; width: 84%; margin-bottom: 20px; gap: 5px;">
    <label for="searchPartIDCode" style="font-size:14px;">نام و نام خانوادگی:</label>
    <span style="font-size:14px; color:#069; margin-right:10px"><?php echo bah_name($bah_cod_m); ?></span>
    
    <label for="searchPartIDCode" style="font-size:14px; margin-right:70px">کد ملی:</label>
    <span style="font-size:14px; color:#069; margin-right:10px"><?php echo $bah_cod_m; ?></span>
    
    <label for="searchPartIDCode" style="font-size:14px; margin-right:70px">کد اپیدمیولوژیک:</label>
    <span style="font-size:14px; color:#069; margin-right:10px"><?php echo $epidemiologic; ?></span>
</div>
       <div style="display: flex; align-items: center;  width: 84%; margin-bottom: 20px; gap: 5px;">
    <label for="searchPartIDCode" style="font-size:14px;">شناسه یکتا :</label>
    <span style="font-size:14px; color:#069; margin-right:10px"><?php echo $partIDCode; ?></span>
    
    <label for="searchPartIDCode" style="font-size:14px;; margin-right:70px">نوع فعالیت:</label>
    <span style="font-size:14px; color:#069; margin-right:10px"><?php echo translateUnitType($no_fa); ?></span>
    
</div>

   <div id="searchResultMessage" style="color: red; margin-top: 10px;"></div>

</div>

<div style="background-color:#FFF; width:90%; margin:auto ; text-align:center ; margin-top:15px">
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

function updateActivityOptions(selectElement) {
    const speciesValue = selectElement.value;
    const activitySelect = selectElement.closest('tr').querySelector("select[name='activity[]']");

    // اطمینان از وجود المان activitySelect
    if (!activitySelect) {
        console.log('المان activity موجود نیست');
        return;
    }

    // پاک کردن گزینه‌های فعلی
    activitySelect.innerHTML = ''; 

    // افزودن گزینه‌های پیش‌فرض
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'انتخاب کنید';
    activitySelect.appendChild(defaultOption);

    // بررسی مقدار speciesValue و افزودن گزینه‌ها بر اساس آن
    if (speciesValue == '6') { // 6 مربوط به اسب است
        console.log('اسب انتخاب شد');
        const options = [
            { value: "5", text: 'تفریحی-همراه' },
            { value: "7", text: 'کاری' }
        ];
        options.forEach(option => {
            const newOption = document.createElement('option');
            newOption.value = option.value;
            newOption.textContent = option.text;
            activitySelect.appendChild(newOption);
        });
    } else if (speciesValue == '7' || speciesValue == '8') { // 7 مربوط به قاطر و 8 مربوط به استر است
        console.log('قاطر یا استر انتخاب شد');
        const options = [
            { value: "7", text: 'کاری' }
        ];
        options.forEach(option => {
            const newOption = document.createElement('option');
            newOption.value = option.value;
            newOption.textContent = option.text;
            activitySelect.appendChild(newOption);
        });
    } else if (speciesValue == '9') { // 9 مربوط به سگ است
        console.log('سگ انتخاب شد');
        const options = [
            { value: "5", text: 'تفریحی-همراه' }
        ];
        options.forEach(option => {
            const newOption = document.createElement('option');
            newOption.value = option.value;
            newOption.textContent = option.text;
            activitySelect.appendChild(newOption);
        });
    } else {
        console.log('گونه دیگری انتخاب شد');
        const allOptions = [
            { value: "1", text: 'داشتی شیری' },
            { value: "2", text: 'داشتی دومنظوره' },
            { value: "3", text: 'داشتی بومی' },
            { value: "4", text: 'پرواری' }
        ];
        allOptions.forEach(option => {
            const newOption = document.createElement('option');
            newOption.value = option.value;
            newOption.textContent = option.text;
            activitySelect.appendChild(newOption);
        });
    }
}
//
function addRow() {
    const table = document.getElementById('animalTable').getElementsByTagName('tbody')[0];

    // بررسی اینکه آیا جدول ردیفی دارد یا نه
    if (table.rows.length === 0) {
        console.log("جدول خالی است, ردیف جدید اضافه می‌شود.");
        const newRow = table.insertRow(0);
        newRow.innerHTML = `
            <input type="hidden" name="rowID" value="">
            <td>
        <select id="species" name="species[]" onchange="updateActivityOptions(this)">
                    <option value="">انتخاب کنید</option>
                    <option value="1">گاو</option>
                    <option value="2">گاومیش</option>
                    <option value="3">شتر</option>
                    <option value="4">گوسفند</option>
                    <option value="5">بز</option>
                    <option value="6">اسب</option>
                    <option value="7">استر</option>
                    <option value="8">قاطر</option>                
                    <option value="9">سگ</option>                
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
                    <option value="1">0 تا 6 ماه</option>
                    <option value="2">6 تا 12 ماه</option>
                    <option value="3">از یکسال تا دو سال</option>
                    <option value="4">بیشتر از دو سال</option>
                </select>
            </td>
            <td>
                <select id="activity" name="activity[]">
                    <option value="">انتخاب کنید</option>
                    <option value="1">داشتی شیری</option>
                    <option value="2">داشتی دومنظوره</option>
                    <option value="3">داشتی بومی</option>
                    <option value="4">پرواری</option>
                    <option value="5">تفریحی-همراه</option>
                    <option value="6">ورزشی</option>
                    <option value="7">کاری</option>
                </select>
            </td>
            <td><input type="number" name="quantity[]" min="1" required></td>
            <td>
                <button type="button" class="remove-btn" title="حذف ردیف" onclick="removeRow(this)">✖</button>
                <button type="button" class="btn1" title="ثبت/ویرایش" onclick="saveEdit(this)">✔</button>
            </td>
        `;

        // اضافه کردن رویداد onchange به select مربوط به species
        const speciesSelect = newRow.querySelector('select[name="species[]"]');
        speciesSelect.addEventListener('change', function() {
            updateActivityOptions(this);
        });

    } else {
        console.log("جدول ردیف دارد, ردیف اول کپی می‌شود.");
        const newRow = table.rows[0].cloneNode(true);
        newRow.querySelectorAll('select, input').forEach(input => input.value = ''); 
        table.appendChild(newRow);

        // اضافه کردن رویداد onchange به select مربوط به species
        const speciesSelect = newRow.querySelector('select[name="species[]"]');
        speciesSelect.addEventListener('change', function() {
            updateActivityOptions(this);
        });
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

    fetch(`search_dam2.php?partIDCode=${partIDCode}&sal=${sal}`)
        .then(response => response.json())
        .then(data => {
            const messageElement = document.getElementById('searchResultMessage');
            const tableBody = document.querySelector('#animalTable tbody');
            tableBody.innerHTML = ''; // پاک کردن محتوای فعلی جدول

            if (data.found) {
             //   messageElement.style.color = 'green';
            //    messageElement.textContent = 'سوابق موجود :';
			console.log('پاسخ کامل از سرور:', data);
                data.records.forEach(rowData => {
                    const newRow = document.createElement('tr');
const speciesOptions = ['انتخاب کنید', 'گاو', 'گاومیش', 'شتر', 'گوسفند', 'بز', 'اسب', 'استر','قاطر','سگ'];
const breedOptions = ['انتخاب کنید', 'اصیل', 'بومی', 'آمیخته'];
const genderOptions = ['انتخاب کنید', 'نر', 'ماده', 'فریمارتین نر', 'فریمارتین ماده'];
const ageOptions = ['انتخاب کنید', '0 تا 6 ماه', '6 تا 12 ماه', 'از یکسال تا دو سال', 'بیشتر از دو سال'];
const activityOptions = ['انتخاب کنید', 'داشتی شیری', 'داشتی دومنظوره', 'داشتی بومی', 'پرواری','تفریحی - همراه','ورزشی','کاری'];
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
                            <option value="8">قاطر</option>				
                            <option value="9">سگ</option>				
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
                            <option value="1">0 تا 6 ماه</option>
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
                            <option value="5">تفریحی-همراه</option>
                            <option value="6">ورزشی</option>
                            <option value="7">کاری</option>
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

    // ارسال داده‌ها به سرور
    fetch('save_edit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // دریافت پاسخ به صورت JSON
    .then(parsedData => {
        const messageElement = document.getElementById('searchResultMessage');
        
        // بررسی وضعیت success و تغییر رنگ بر اساس آن
        if (parsedData.success) {
            messageElement.style.color = 'green';
        } else {
            messageElement.style.color = 'red';
        }

        // نمایش پیام سرور
        messageElement.textContent = parsedData.message;
        
        // به‌روزرسانی rowID در صورت موفقیت
        if (parsedData.success && parsedData.rowID) {
            row.querySelector('input[name="rowID"]').value = parsedData.rowID;
        }

        // نمایش دکمه حذف همه رکوردها در صورت موفقیت
        if (parsedData.success) {
            const removeBtn = document.getElementById('removeAllBtn');
            removeBtn.style.display = 'inline';
        }
    })
    .catch(error => {
        console.error('Error:', error);  // مدیریت خطاهای مربوط به درخواست
    });
}


</script>
  <tr>
<td  height="200"colspan="3" valign="middle" >
<p> <button type='submit' class='btn_cancel' name='cancel' value='cancel' onclick='close_window()'> خروج </button></div></p>
</td>
   </tr>

  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php');?></td>
   </tr>
</table>
<?php
function translateUnitType($unitType) {
    $unitTypes = array(
        1  => 'واحد پرواربندی گاو',
        2  => 'واحد پرورش گاو شيري',
        3  => 'واحد پرورش گاوميش داشتی',
        4  => 'واحد پرواربندی گوسفند',
        5  => 'واحد پرورش گوسفند داشتي',
        6  => 'واحد پرورش بز',
        7  => 'واحد پرورش اسب',
        8  => 'واحد پرورش گوزن',
        9  => 'واحد پرورش شتر داشتی',
        10 => 'واحد پرورش لاما',
        11 => 'واحد پرورش سگ(گله، پليس، نگهبان و...)',
        13 => 'واحد پرورش حيوانات آزمايشگاهي(موش، خوكچه هندي، هامستر و...)',
        15 => 'واحد پرورش دام چند منظوره',
        16 => 'واحد پروش دام روستايی',
        19 => 'واحد پرورش دام مستقر در مجتمع دامپروري',
        20 => 'واحد پرواربندی گاوميش',
        21 => 'واحد پرواربندی شتر',
        22 => 'واحد پرورش آهو و جبير',
        23 => 'واحد پرورش مارال',
        24 => 'واحد پرورش كل و بز',
        25 => 'واحد پرورش قوچ و ميش',
        26 => 'واحد پرورش الاغ شيري',
        27 => 'واحد پرورش روباه (توليد پوست)',
        28 => 'واحد پرورش خرگوش',
        29 => 'واحد پروش دام غیر صنعتی',
        30 => 'واحد پرورش دام مستقر در مجموعه دامپروري'
    );
    // بازگشت ترجمه کد واحد
    return isset($unitTypes[$unitType]) ? $unitTypes[$unitType] : 'نوع واحد نامشخص';
}
?>
<script>
function close_window() {
      close();
 }
    </script>

</body>
</html>