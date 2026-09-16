<?php
// این فایل مسئول نمایش فرم و مدیریت تعاملات سمت کاربر است.
include('../../lock_p3.php');
include('../../event.php');
require_once('../../Jalali.php');

$id_ostan1 = $id_ostan;
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';

// گرفتن لیست استان‌ها برای فرم اولیه
try {
    require_once('../../login/config.php');
    $stmt = $dbh->query("SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC");
    $ostans = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("خطا در اتصال به پایگاه داده: " . $e->getMessage());
}

$taraaz = null;
$product_list = array();

// فقط در صورتی که مرکز و سال زراعی انتخاب شده باشند، فرم اصلی را بارگذاری می‌کنیم
if ($id_mar && $z_sal) {
    try {
        // دریافت اطلاعات محصول 490 (تراز اولیه)
        $stmt_taraaz = $dbh->prepare("SELECT s_abi, s_dem, t_abi, t_dem FROM Agri_ab_mar WHERE id_mar = ? AND product_cod = '490' AND z_sal = ?");
        $stmt_taraaz->execute(array($id_mar, $z_sal));
        $taraaz = $stmt_taraaz->fetch(PDO::FETCH_ASSOC);

        // بررسی وجود رکورد و مقادیر سطح زیر کشت
        if ($taraaz && ($taraaz['s_abi'] > 0 || $taraaz['s_dem'] > 0)) {
            // دریافت لیست محصولات مجاز برای dropdown
            $stmt_products = $dbh->prepare("SELECT product_cod, product_name FROM product_z WHERE group_cod = '4' AND product_cod NOT IN ('170', '172', '174') ORDER BY product_name ASC");
            $stmt_products->execute();
            $product_list = $stmt_products->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $taraaz = null; // برای نمایش پیام خطا
        }
    } catch (PDOException $e) {
        die("خطا در اتصال به پایگاه داده: " . $e->getMessage());
    }
}


function formatNumberWithSeparator($value) {
    return number_format($value);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script src="../../15_files/jquery-1.9.0.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var initial_id_ostan = '<?php echo !empty($id_ostan1) ? $id_ostan1 : ''; ?>';
    var initial_id_city = '<?php echo !empty($id_city) ? $id_city : ''; ?>';
    var initial_id_mar = '<?php echo !empty($id_mar) ? $id_mar : ''; ?>';

// تابع جدید برای اعتبارسنجی فرم
function validateForm() {
    var markaz = document.getElementById("markaz").value;
    if (markaz === "") {
        alert("لطفاً ابتدا نام مرکز را انتخاب کنید.");
        return false; 
    }
    return true;
}
</script>
<script src="../../location/ajax-location.js"></script>
    <style type="text/css">
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
    color: #003366;
    font-family: Tahoma;
    font-size: 18px;
}

#content
{
    width: 900px;
    margin: 0 auto;
    font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
    list-style: none;
    display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
    font-weight:bold;
    color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
.column {
  float: left;
  width:12.25%;
  padding: 5px;
}
.row {
    width: 100%
}

.row::after {
  content: "";
  clear: both;
  display: table;
}
/* جدول نتایج مدرن و واکنش‌گرا */
.agri-table {
  width: 95%;
  margin: 24px auto;
  border-collapse: collapse;
  font-family: Tahoma, Arial, sans-serif;
  font-size: 15px;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  border-radius: 12px;
  overflow: hidden;
  /* direction: rtl; */
}
.agri-table th, .agri-table td {
  padding: 10px 8px;
  text-align: center;
  border-bottom: 1px solid #e0e0e0;
  border-right: 1px solid #e0e0e0;
}
.agri-table th:last-child, .agri-table td:last-child {
  border-right: none;
}
.agri-table th {
  background: #006699;
  color: #fff;
  font-weight: bold;
  font-size: 16px;
}
.agri-table tr:nth-child(even) {
  background: #f9f9f9;
}
.agri-table tr:nth-child(odd) {
  background: #fff;
}
.agri-table tr:hover {
  background: #e6f2ff;
}
@media (max-width: 900px) {
  /* فقط فونت و سایز جدول را کوچک‌تر می‌کنیم، ساختار جدول حفظ شود */
  .agri-table {
    font-size: 13px;
  }
  .agri-table th, .agri-table td {
    padding: 8px 4px;
  }
  .agri-table tr { margin-bottom: 15px; }
  .agri-table td, .agri-table th {
    text-align: right;
    padding: 10px 5px;
    border: none;
    border-bottom: 1px solid #e0e0e0;
    position: relative;
  }
  .agri-table th {
    background: #006699;
    color: #fff;
    font-size: 15px;
    border-radius: 0;
  }
}
/* Style for taraaz box */
.taraaz-box {
  background-color: #f0f8ff;
  border-left: 5px solid #007bff;
  padding: 15px;
  margin: 20px auto;
  border-radius: 8px;
  max-width: 600px;
  font-family: 'Tahoma', sans-serif;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  direction: rtl;
}

.taraaz-box h3 {
  color: #0056b3;
  margin-top: 0;
  font-size: 20px;
  border-bottom: 2px solid #007bff;
  padding-bottom: 10px;
}

.taraaz-box p {
  margin: 8px 0;
  font-size: 16px;
  line-height: 1.6;
}

.taraaz-box span {
  font-weight: bold;
  color: #333;
}

/* Style for the main form table */
#mainForm table {
  width: 95%;
  margin: 20px auto;
  border-collapse: collapse;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  border-radius: 12px;
  overflow: hidden;
  font-family: 'Tahoma', sans-serif;
}

#mainForm th, #mainForm td {
  padding: 12px 10px;
  text-align: center;
  border: 1px solid #ddd;
}

#mainForm thead th {
  background-color: #006699;
  color: white;
  font-size: 16px;
  font-weight: bold;
}

#mainForm tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

#mainForm tbody tr:hover {
  background-color: #e6f2ff;
}

/* Style for input fields inside the table */
#mainForm input[type="text"],
#mainForm select {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px;
}

/* Style for buttons */
#addRowBtn,
#submitBtn,
.deleteRowBtn {
  font-family: 'Tahoma', sans-serif;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  color: white;
  cursor: pointer;
  margin: 10px 5px;
  transition: background-color 0.3s ease;
}

#addRowBtn {
  background-color: #28a745;
}

#addRowBtn:hover {
  background-color: #218838;
}

#submitBtn {
  background-color: #007bff;
}

#submitBtn:hover {
  background-color: #0056b3;
}

.deleteRowBtn {
  background-color: #dc3545;
  padding: 8px 12px;
}

.deleteRowBtn:hover {
  background-color: #c82333;
}
</style>
</head>
<body>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      <span class="style8">ثبت برش الگوی کشت محصولات زراعی مراکز جهاد کشاورزی </span><br />
      </p>
      <form id="reg-form" method="post" action="#1" onsubmit="return validateForm()">
        <div style="width: 350px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
          <table width="100%" height="279" border='0' align="center" cellpadding='0' cellspacing='0'>
            <tr bgcolor='#f1f1f1' >
              <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr bgcolor='#f1f1f1' >
              <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" >
              

              <select name="id_ostan" disabled="disabled" class="style8" id="ostan" style="width:170px ; height:40px" dir="rtl" >
    <option value="">-- انتخاب استان --</option>
    <?php foreach($ostans as $o): ?>
    <option value="<?php echo $o['id_ostan']; ?>" <?php echo ($o['id_ostan'] == $id_ostan1) ? 'selected="selected"' : ''; ?>><?php echo htmlspecialchars($o['ostan'], ENT_QUOTES, 'UTF-8'); ?></option>
    <?php endforeach; ?>
</select>
</td>
              <td  align='center' bgcolor="#FFFFFF" class="style8"><span class="style1"> : استان</span></td>
            </tr>
            <tr bgcolor='#f1f1f1' >
              <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" >
             <select name="id_city" disabled="disabled" class="input_text" id="shahrestan" style="width:170px ; height:40px" dir="rtl"  >
    <option value="">-- انتخاب شهرستان --</option>
    <?php
    // If a province and city were previously selected, load the cities for that province
    if (!empty($id_ostan1) && !empty($id_city)) {
        $stmt_cities = $dbh->prepare("SELECT id_city, city FROM cityname WHERE id_ostan = ? ORDER BY BINARY city ASC");
        $stmt_cities->execute(array($id_ostan1));
        $cities = $stmt_cities->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cities as $c) {
            echo '<option value="' . $c['id_city'] . '"' . (($c['id_city'] == $id_city) ? ' selected="selected"' : '') . '>' . htmlspecialchars($c['city'], ENT_QUOTES, 'UTF-8') . '</option>';
        }
    }
    ?>
</select>
</td>
              <td  align='center' bgcolor="#FFFFFF" class="style1"> : شهرستان</td>
            </tr>
            <tr bgcolor='#f1f1f1' >
              <td height="53" align="right" bgcolor="#FFFFFF" class="input_text" >
<select name="id_mar" class="input_text" id="markaz" style="width:170px ; height:40px" dir="rtl" >
    <option value="">-- انتخاب مرکز --</option>
    <?php
    // If a city and markaz were previously selected, load the markazes for that city
    if (!empty($id_city) && !empty($id_mar)) {
        $stmt_markazes = $dbh->prepare("SELECT id_mar, mar FROM marname WHERE id_city = ? ORDER BY BINARY mar ASC");
        $stmt_markazes->execute(array($id_city));
        $markazes = $stmt_markazes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($markazes as $m) {
            echo '<option value="' . $m['id_mar'] . '"' . (($m['id_mar'] == $id_mar) ? ' selected="selected"' : '') . '>' . htmlspecialchars($m['mar'], ENT_QUOTES, 'UTF-8') . '</option>';
        }
    }
    ?>
</select>  
</td>              <td  align='center' bgcolor="#FFFFFF" class="style1">: مرکز </td>
            </tr>
            <tr bgcolor='#f1f1f1' >
              <td height="40" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                <select name="z_sal" class="input_text  required" id="z_sal2" style="height:40px ; width:170px ; direction:rtl" tabindex="1">
                  <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                </select>
              </div></td>
              <td width="146"  align='center' bgcolor="#FFFFFF" class="style1">: سال زراعی</td>
            </tr>
            <tr >
              <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="10" value='جستجو' /></td>
            </tr>
          </table>
        </div>
      </form>
               <p>

<hr>

<?php if ($id_mar && $z_sal): ?>
    <?php if (!$taraaz): ?>
        <p class="error">اطلاعاتی برای محصول سایر سبزیجات (کد 490) با سطح کشت بزرگتر از ۰ در این مرکز یافت نشد.</p>
    <?php else: ?>
        <div class="taraaz-box">
            <h3>تراز باقی‌مانده (از محصول 490)</h3>
            <p>سطح آبی: <span id="taraaz_s_abi"><?php echo formatNumberWithSeparator($taraaz['s_abi']); ?></span></p>
            <p>سطح دیم: <span id="taraaz_s_dem"><?php echo formatNumberWithSeparator($taraaz['s_dem']); ?></span></p>
            <p>تولید آبی: <span id="taraaz_t_abi"><?php echo formatNumberWithSeparator($taraaz['t_abi']); ?></span></p>
            <p>تولید دیم: <span id="taraaz_t_dem"><?php echo formatNumberWithSeparator($taraaz['t_dem']); ?></span></p>
        </div>

        <form id="mainForm" action="process_490.php" method="post">
            <input type="hidden" name="id_mar" value="<?php echo htmlspecialchars($id_mar); ?>">
            <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>">
            <input type="hidden" name="initial_s_abi" value="<?php echo htmlspecialchars($taraaz['s_abi']); ?>">
            <input type="hidden" name="initial_s_dem" value="<?php echo htmlspecialchars($taraaz['s_dem']); ?>">
            <input type="hidden" name="initial_t_abi" value="<?php echo htmlspecialchars($taraaz['t_abi']); ?>">
            <input type="hidden" name="initial_t_dem" value="<?php echo htmlspecialchars($taraaz['t_dem']); ?>">

            <table class="agri-table" dir="rtl">
                <thead>
                    <tr>
                        <th>نام محصول</th>
                        <th>سطح آبی (هکتار)</th>
                        <th>سطح دیم (هکتار)</th>
                        <th>تولید آبی (تن)</th>
                        <th>تولید دیم (تن)</th>
                        <th>عملکرد آبی (کیلوگرم/هکتار)</th>
                        <th>عملکرد دیم (کیلوگرم/هکتار)</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody id="product_rows">
                    </tbody>
            </table>

            <button type="button" id="addRowBtn">
                + افزودن ردیف
            </button>

            <hr>
            <button type="submit" id="submitBtn">
                ثبت و به‌روزرسانی نهایی
            </button>
        </form>
    <?php endif; ?>
<?php endif; ?>
          <p><a href="Pattern.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>      
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>

<script src="../../15_files/jquery-1.9.0.min.js"></script>
<script>
    // اسکریپت‌های مربوط به مدیریت فرم و محاسبات (کد قبلی)
    let taraaz = {
        s_abi: parseFloat(unformatNumber(document.getElementById('taraaz_s_abi') ? document.getElementById('taraaz_s_abi').textContent : '0')) || 0,
        s_dem: parseFloat(unformatNumber(document.getElementById('taraaz_s_dem') ? document.getElementById('taraaz_s_dem').textContent : '0')) || 0,
        t_abi: parseFloat(unformatNumber(document.getElementById('taraaz_t_abi') ? document.getElementById('taraaz_t_abi').textContent : '0')) || 0,
        t_dem: parseFloat(unformatNumber(document.getElementById('taraaz_t_dem') ? document.getElementById('taraaz_t_dem').textContent : '0')) || 0
    };

    const initialTaraaz = {...taraaz};
    let selectedProducts = [];
    let rowCounter = 0;

    function updateTaraazDisplay() {
        if(document.getElementById('taraaz_s_abi')) {
            document.getElementById('taraaz_s_abi').textContent = formatNumberWithSeparator(taraaz.s_abi.toFixed(2));
            document.getElementById('taraaz_s_dem').textContent = formatNumberWithSeparator(taraaz.s_dem.toFixed(2));
            document.getElementById('taraaz_t_abi').textContent = formatNumberWithSeparator(taraaz.t_abi.toFixed(2));
            document.getElementById('taraaz_t_dem').textContent = formatNumberWithSeparator(taraaz.t_dem.toFixed(2));
        }
    }

// تابع جدید برای فرمت‌دهی به اعداد با جداکننده انگلیسی
function formatNumberWithSeparator(number) {
    // اطمینان از اینکه ورودی یک عدد است
    if (typeof number !== 'number') {
        number = parseFloat(unformatNumber(number));
    }
    // اگر ورودی عدد معتبری نباشد، همان رشته اصلی را برمی‌گرداند
    if (isNaN(number)) {
        return '';
    }
    // استفاده از فرمت‌دهی محلی انگلیسی برای جداکننده هزارگان
    return number.toLocaleString('en-US');
}

// تابع جدید برای حذف جداکننده‌های انگلیسی و فارسی و تبدیل ارقام فارسی به انگلیسی
function unformatNumber(numberString) {
    if (typeof numberString === 'string') {
        // ابتدا ارقام فارسی را به انگلیسی تبدیل می‌کند
        const convertedToEnglish = numberString.replace(/[۰-۹]/g, d => '۰۱۲۳۴۵۶۷۸۹'.indexOf(d));
        // سپس کاما و جداکننده هزارگان فارسی را حذف می‌کند
        return convertedToEnglish.replace(/[,٬]/g, '');
    }
    return numberString;
}
    function calculatePerformance(s, t) {
        s = parseFloat(unformatNumber(s));
        t = parseFloat(unformatNumber(t));
        if (s > 0) {
            return formatNumberWithSeparator((t / s * 1000).toFixed(2));
        }
        return '';
    }
    
    function updatePerformance(rowId) {
        const s_abi = document.getElementById(`s_abi_${rowId}`).value;
        const t_abi = document.getElementById(`t_abi_${rowId}`).value;
        const s_dem = document.getElementById(`s_dem_${rowId}`).value;
        const t_dem = document.getElementById(`t_dem_${rowId}`).value;

        document.getElementById(`a_abi_${rowId}`).value = calculatePerformance(s_abi, t_abi);
        document.getElementById(`a_dem_${rowId}`).value = calculatePerformance(s_dem, t_dem);
    }

    function validateAndRecalculate(rowId) {
        let s_abi = parseFloat(unformatNumber(document.getElementById(`s_abi_${rowId}`).value)) || 0;
        let s_dem = parseFloat(unformatNumber(document.getElementById(`s_dem_${rowId}`).value)) || 0;
        let t_abi = parseFloat(unformatNumber(document.getElementById(`t_abi_${rowId}`).value)) || 0;
        let t_dem = parseFloat(unformatNumber(document.getElementById(`t_dem_${rowId}`).value)) || 0;

        const old_s_abi = parseFloat(document.getElementById(`s_abi_${rowId}`).getAttribute('data-old-value')) || 0;
        const old_s_dem = parseFloat(document.getElementById(`s_dem_${rowId}`).getAttribute('data-old-value')) || 0;
        const old_t_abi = parseFloat(document.getElementById(`t_abi_${rowId}`).getAttribute('data-old-value')) || 0;
        const old_t_dem = parseFloat(document.getElementById(`t_dem_${rowId}`).getAttribute('data-old-value')) || 0;
        
        // اصلاح تراز قبل از اعمال مقادیر جدید
        taraaz.s_abi += old_s_abi;
        taraaz.s_dem += old_s_dem;
        taraaz.t_abi += old_t_abi;
        taraaz.t_dem += old_t_dem;
        
        // اعتبارسنجی
        if (s_abi > taraaz.s_abi || s_dem > taraaz.s_dem || t_abi > taraaz.t_abi || t_dem > taraaz.t_dem) {
            alert('مقدار وارد شده از تراز باقی‌مانده بیشتر است!');
            // بازگرداندن به مقدار قبلی
            s_abi = old_s_abi;
            s_dem = old_s_dem;
            t_abi = old_t_abi;
            t_dem = old_t_dem;
            document.getElementById(`s_abi_${rowId}`).value = formatNumberWithSeparator(s_abi);
            document.getElementById(`s_dem_${rowId}`).value = formatNumberWithSeparator(s_dem);
            document.getElementById(`t_abi_${rowId}`).value = formatNumberWithSeparator(t_abi);
            document.getElementById(`t_dem_${rowId}`).value = formatNumberWithSeparator(t_dem);
        }
        
        // کاهش تراز با مقادیر جدید
        taraaz.s_abi -= s_abi;
        taraaz.s_dem -= s_dem;
        taraaz.t_abi -= t_abi;
        taraaz.t_dem -= t_dem;

        // ذخیره مقادیر جدید به عنوان old-value برای دفعه بعد
        document.getElementById(`s_abi_${rowId}`).setAttribute('data-old-value', s_abi);
        document.getElementById(`s_dem_${rowId}`).setAttribute('data-old-value', s_dem);
        document.getElementById(`t_abi_${rowId}`).setAttribute('data-old-value', t_abi);
        document.getElementById(`t_dem_${rowId}`).setAttribute('data-old-value', t_dem);

        updateTaraazDisplay();
        updatePerformance(rowId);
    }

    function createProductDropdown() {
        const dropdown = document.createElement('select');
        dropdown.name = `product_cod_row_${rowCounter}`;
        dropdown.required = true;
        dropdown.innerHTML = '<option value="">انتخاب محصول...</option>';
        const availableProducts = <?php echo json_encode($product_list); ?>.filter(p => !selectedProducts.includes(p.product_cod));

        availableProducts.forEach(product => {
            const option = document.createElement('option');
            option.value = product.product_cod;
            option.textContent = product.product_name;
        option.textContent = product.product_name;
            dropdown.appendChild(option);
        });
        
        dropdown.addEventListener('change', (e) => {
            const newProductCode = e.target.value;
            const oldProductCode = e.target.getAttribute('data-old-product');
            if (oldProductCode) {
                const index = selectedProducts.indexOf(oldProductCode);
                if (index > -1) {
                    selectedProducts.splice(index, 1);
                }
            }
            if (newProductCode) {
                selectedProducts.push(newProductCode);
            }
            e.target.setAttribute('data-old-product', newProductCode);
            // به روزرسانی سایر dropdown ها برای حذف محصول انتخاب شده
            updateAllDropdowns();
        });
        return dropdown;
    }

    function updateAllDropdowns() {
        const dropdowns = document.querySelectorAll('select[name^="product_cod_row_"]');
        dropdowns.forEach(dropdown => {
            const currentSelection = dropdown.value;
            dropdown.innerHTML = '<option value="">انتخاب محصول...</option>';
            const availableProducts = <?php echo json_encode($product_list); ?>.filter(p => !selectedProducts.includes(p.product_cod) || p.product_cod === currentSelection);
            
            availableProducts.forEach(product => {
                const option = document.createElement('option');
                option.value = product.product_cod;
                option.textContent = product.product_name;
                if (product.product_cod === currentSelection) {
                    option.selected = true;
                }
                dropdown.appendChild(option);
            });
        });
    }
    
    function addRow() {
        if (taraaz.s_abi <= 0 && taraaz.s_dem <= 0 && taraaz.t_abi <= 0 && taraaz.t_dem <= 0) {
            alert('مقادیر تراز به صفر رسیده‌اند و امکان اضافه کردن ردیف جدید وجود ندارد.');
            return;
        }
        
        rowCounter++;
        const row = document.createElement('tr');
        row.id = `row_${rowCounter}`;
        row.classList.add('data-row'); // اضافه کردن کلاس برای شناسایی ردیف‌ها
        row.innerHTML = `
            <td></td>
            <td><input type="text" name="s_abi_${rowCounter}" id="s_abi_${rowCounter}" data-old-value="0" placeholder="سطح آبی" required></td>
            <td><input type="text" name="s_dem_${rowCounter}" id="s_dem_${rowCounter}" data-old-value="0" placeholder="سطح دیم"></td>
            <td><input type="text" name="t_abi_${rowCounter}" id="t_abi_${rowCounter}" data-old-value="0" placeholder="تولید آبی" required></td>
            <td><input type="text" name="t_dem_${rowCounter}" id="t_dem_${rowCounter}" data-old-value="0" placeholder="تولید دیم"></td>
            <td><input type="text" id="a_abi_${rowCounter}" disabled></td>
            <td><input type="text" id="a_dem_${rowCounter}" disabled></td>
            <td><button type="button" class="deleteRowBtn">حذف</button></td>
        `;
        
        const dropdownContainer = row.querySelector('td:first-child');
        dropdownContainer.appendChild(createProductDropdown());

        document.getElementById('product_rows').appendChild(row);

        ['s_abi', 's_dem', 't_abi', 't_dem'].forEach(field => {
            const input = document.getElementById(`${field}_${rowCounter}`);
            input.addEventListener('input', () => {
                input.value = formatNumberWithSeparator(unformatNumber(input.value));
                validateAndRecalculate(rowCounter);
            });
        });

        row.querySelector('.deleteRowBtn').addEventListener('click', () => {
            const s_abi_val = parseFloat(unformatNumber(row.querySelector('input[name^="s_abi"]').value)) || 0;
            const s_dem_val = parseFloat(unformatNumber(row.querySelector('input[name^="s_dem"]').value)) || 0;
            const t_abi_val = parseFloat(unformatNumber(row.querySelector('input[name^="t_abi"]').value)) || 0;
            const t_dem_val = parseFloat(unformatNumber(row.querySelector('input[name^="t_dem"]').value)) || 0;
            
            taraaz.s_abi += s_abi_val;
            taraaz.s_dem += s_dem_val;
            taraaz.t_abi += t_abi_val;
            taraaz.t_dem += t_dem_val;
            
            const productCod = row.querySelector('select').value;
            selectedProducts = selectedProducts.filter(p => p !== productCod);
            
            updateTaraazDisplay();
            row.remove();
            updateAllDropdowns();
        });
    }
    
    document.getElementById('addRowBtn').addEventListener('click', addRow);
    
    // مدیریت ارسال نهایی فرم با AJAX
document.getElementById('mainForm').addEventListener('submit', function(event) {
    event.preventDefault(); // جلوگیری از ارسال پیش‌فرض فرم

    const formData = new FormData();

    // اضافه کردن داده‌های ثابت فرم
    formData.append('id_mar', document.querySelector('input[name="id_mar"]').value);
    formData.append('z_sal', document.querySelector('input[name="z_sal"]').value);
    formData.append('initial_s_abi', document.querySelector('input[name="initial_s_abi"]').value);
    formData.append('initial_s_dem', document.querySelector('input[name="initial_s_dem"]').value);
    formData.append('initial_t_abi', document.querySelector('input[name="initial_t_abi"]').value);
    formData.append('initial_t_dem', document.querySelector('input[name="initial_t_dem"]').value);

    // جمع‌آوری داده‌های ردیف‌های جدید از طریق یک حلقه
    document.querySelectorAll('.data-row').forEach(row => {
        const rowId = row.id.split('_')[1];
        const productCodInput = row.querySelector('select[name^="product_cod_row_"]');
        const sAbiInput = row.querySelector('input[name^="s_abi_"]');
        const sDemInput = row.querySelector('input[name^="s_dem_"]');
        const tAbiInput = row.querySelector('input[name^="t_abi_"]');
        const tDemInput = row.querySelector('input[name^="t_dem_"]');
        
        if (productCodInput && sAbiInput && sDemInput && tAbiInput && tDemInput) {
            formData.append('product_cod[]', productCodInput.value);
            formData.append('s_abi[]', unformatNumber(sAbiInput.value));
            formData.append('s_dem[]', unformatNumber(sDemInput.value));
            formData.append('t_abi[]', unformatNumber(tAbiInput.value));
            formData.append('t_dem[]', unformatNumber(tDemInput.value));
        }
    });

    // ارسال داده‌ها با AJAX
    fetch('process_490.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            window.location.reload(); // بارگذاری مجدد صفحه پس از ثبت موفقیت‌آمیز
        } else {
            alert('خطا: ' + data.message);
        }
    })
    .catch(error => {
        console.error('خطا:', error);
        alert('خطایی در ارتباط با سرور رخ داد. لطفاً دوباره تلاش کنید.');
    });
});
</script>
</body>
</html>