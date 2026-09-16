<!DOCTYPE html>
<html lang="fa">
    <link href="./FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta charset="UTF-8">
    <title>فرم ثبت اطلاعات دام</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            text-align: center;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        select, input[type="number"] {
            width: 90%;
            padding: 5px;
            box-sizing: border-box;
        }
        .btn {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn:hover {
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
    }
    .remove-btn {
        background-color: #f44336;
        color: white;
    }
    </style>
</head>
<body style="background-color:#FFF">

<h2>فرم ثبت اطلاعات دام</h2>
<div style="background-color:#FFF; width:75%; margin:auto ; text-align:center   " >
<form id="animalForm" >
    <!-- فیلدهای ثابت مخفی -->
    <input type="hidden" name="action" value="save">
    <input type="hidden" id="partIDCode" name="partIDCode" value="12345">
    <input type="hidden" id="sal" name="sal" value="1403">
  
    <table id="animalTable" align="center"  >
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
            <tr class="row">
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
                    <button type="button" class="add-btn" onclick="addRow()">+</button>
                    <button type="button" class="remove-btn" onclick="removeRow(this)">-</button>
                </td>
            </tr>
        </tbody>
    </table>
    <button type="button" class="btn" onclick="saveData()">ثبت اطلاعات</button>
</form>
</div>
<script>
function addRow() {
    const table = document.getElementById('animalTable').getElementsByTagName('tbody')[0];
    const newRow = table.rows[0].cloneNode(true);
    newRow.querySelectorAll('select, input').forEach(input => input.value = '');
    table.appendChild(newRow);
}

function removeRow(button) {
    const row = button.parentElement.parentElement;
    const table = document.getElementById('animalTable').getElementsByTagName('tbody')[0];
    if (table.rows.length > 1) {
        row.remove();
    } else {
        alert('حداقل باید یک ردیف وجود داشته باشد.');
    }
}

function saveData() {
    const formData = new FormData(document.getElementById('animalForm'));

    // نمایش داده‌های ارسال شده در کنسول
    for (let [key, value] of formData.entries()) {
        console.log(key + ": " + value);  // چاپ نام فیلد و مقدار آن
    }

    fetch('process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // پاسخ از سرور
    })
    .catch(error => {
        console.error('Error:', error); // در صورت بروز خطا
    });
}


</script>

</body>
</html>
