<?php 
include_once('../../lock_p1.php');
include_once('../../event.php');
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : ''; 
$id_city = isset($_POST['id_city5']) ? $_POST['id_city5'] : ''; 
$id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : ''; 
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : ''; 
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : ''; 
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : ''; 
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : ''; 
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : ''; 
$dis = isset($_POST['dis']) ? $_POST['dis'] : ''; 
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : ''; 
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <script src="../../15_files/jquery.js" type="text/javascript"></script>
  <style>
    /* ========== استایل مدرن فرم جستجو ========== */
.search-container {
    max-width: 800px;
    margin: 200px auto 30px auto;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    padding: 2px;
    box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.2);
    direction: rtl;
    animation: fadeInUp 0.5s ease-out;
}

.search-form {
    background: white;
    border-radius: 14px;
    padding: 12px 18px;
}

.search-title {
    text-align: center;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 2px solid #e0e0e0;
}

.search-title h3 {
    color: #333;
    font-size: 16px;
    margin: 0 0 3px 0;
}

.search-title p {
    color: #666;
    font-size: 11px;
    margin: 0;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px 15px;
}

.form-field {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f8f9fa;
    padding: 4px 12px;
    border-radius: 10px;
    transition: all 0.3s ease;
    direction: rtl;
}

.form-field:hover {
    background: #f0f2f5;
    transform: translateY(-1px);
}

.form-field label {
    min-width: 100px;
    font-size: 12px;
    font-weight: 500;
    color: #495057;
    text-align: right;
}

.form-field label::after {
    content: ":";
    margin-right: 6px;
}

.form-field input,
.form-field select {
    flex: 1;
    padding: 6px 10px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    font-size: 12px;
    font-family: inherit;
    transition: all 0.3s ease;
    background: white;
    text-align: right;
}

.form-field input:focus,
.form-field select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-field input[readonly] {
    background: #e9ecef;
    cursor: not-allowed;
}

.form-field select:disabled {
    background: #e9ecef;
    cursor: not-allowed;
}

.full-width {
    grid-column: span 2;
}

.info-text {
    background: #e3f2fd;
    border-radius: 8px;
    padding: 6px 12px;
    font-size: 11px;
    color: #1565c0;
    text-align: center;
}

.search-btn {
    text-align: center;
    margin-top: 12px;
}

.search-btn input {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 8px 30px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.search-btn input:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.search-btn input:active {
    transform: translateY(0);
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .full-width {
        grid-column: span 1;
    }
    
    .form-field {
        flex-direction: column;
        align-items: stretch;
        gap: 6px;
    }
    
    .form-field label {
        min-width: auto;
    }
    
    .search-form {
        padding: 15px;
    }
}

.form-field:nth-child(even) {
    background: #ffffff;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>  
<style>
    /* استایل ردیف و ستون‌ها برای چیدمان افقی */
    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        justify-content: center;
        align-items: center;
    }

    .column {
        flex: 0 0 auto;
    }

    /* عرض ستون‌ها */
    .column:nth-child(1) { width: 45px; }  /* دکمه ثبت */
    .column:nth-child(2) { width: 70px; }  /* خسارت */
    .column:nth-child(3) { width: 70px; }  /* بیمه */
    .column:nth-child(4) { width: 65px; }  /* تولید قطعی */
    .column:nth-child(5) { width: 65px; }  /* پیش بینی */
    .column:nth-child(6) { width: 70px; }  /* درخت غیر بارور */
    .column:nth-child(7) { width: 70px; }  /* درخت بارور */

    /* فیلدها داخل ستون */
    .column select, .column input {
        width: 100%;
        padding: 5px;
        font-size: 12px;
        text-align: center;
    }

    /* آیکون‌های موفق/خطا */
    .success, .error {
        display: inline-block;
        margin-right: 5px;
    }
    
    /* ========== استایل اصلاح شده برای sticky header جدول ========== */
    .table-container {
        max-height: 70vh;
        overflow-y: auto;
        overflow-x: auto;
        width: 100%;
        position: relative;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .my-table {
        width: 90%;
        border-collapse: collapse;
        min-width: 1200px;
    }

    /* حذف position sticky از th ها */
    .my-table thead tr th {
        background-color: #006699 !important;
    }

    /* اعمال sticky به ردیف اول هدر */
    .my-table thead tr:first-child {
        position: sticky;
        top: 0;
        z-index: 20;
    }

    /* اعمال sticky به ردیف دوم هدر */
    .my-table thead tr:last-child {
        position: sticky;
        top: 60px; /* ارتفاع ردیف اول هدر - در صورت نیاز با JS می‌توان داینامیک کرد */
        z-index: 15;
    }

    /* هدر جدول */
    .my-table .text1 th {
        background-color: #006699 !important;
        color: white;
        font-weight: bold;
        padding: 10px 5px;
        border: 1px solid #0088bb;
        text-align: center;
        vertical-align: middle;
    }

    /* زیرهدر */
    .my-table .text1 span.style2 {
        font-size: 11px;
        color: #ffdd99;
    }

    /* سلول‌های معمولی */
    .my-table td {
        padding: 8px 4px;
        border: 1px solid #ddd;
        text-align: center;
        vertical-align: middle;
        font-size: 12px;
    }

    /* ردیف‌های زوج */
    .my-table tr:nth-child(even) td {
        background-color: #FFFFCC;
    }

    /* ردیف‌های فرد */
    .my-table tr:nth-child(odd) td {
        background-color: #ffffff;
    }

    /* هاور روی ردیف */
    .my-table tr:hover td {
        background-color: #e6f7ff !important;
        transition: 0.2s;
    }

    /* فیلدهای ورودی داخل جدول */
    .my-table input,
    .my-table select {
        width: 95%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 12px;
        text-align: center;
        box-sizing: border-box;
    }

    /* دکمه ثبت داخل جدول */
    .my-table input[type="submit"] {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        height: 32px;
        width: 50px;
    }

    .my-table input[type="submit"]:hover {
        background-color: #218838;
    }

    /* آیکون‌های موفق/خطا */
    .my-table .success img,
    .my-table .error img {
        vertical-align: middle;
        margin-top: 5px;
    }
    
    /* استایل برای نمایش بهتر اسکرول */
    .table-container::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }
    
    .table-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 5px;
    }
    
    .table-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 5px;
    }
    
    .table-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>    
    
    <script>
        function target_Gar15(form) {
            window.open('null','formpopup','width=950,height=700,resizeable,scrollbars');
            form.target = 'formpopup';
        }
    </script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $(".country").change(function() {
                var id=$(this).val();
                var dataString = 'group_cod='+ id;
                $.ajax({
                    type: "POST",
                    url: "ajax_garden.php",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        $(".mar").html(html);
                    } 
                });
            });
        });
    </script>
</head>

<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
        </tr>
        <tr>
            <td><?php include_once('menu.php'); ?></td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                        <td >
                            <?php include_once('top.php');?>
                            
                              <div class="search-container">
    <div class="search-form">
        <div class="search-title">
            <h3>تکمیل اطلاعات تولید قطعی</h3>
            <p>محصولات مثمر دارای درخت بارور / سطح زیر کشت بارور</p>
        </div>
                            <form id="reg-form" method="post" action="#1">
        <div class="form-grid">
            <!-- سال زراعی -->
            <div class="form-field">
                <label>سال زراعی </label>
                <select name="z_sal" class="required" id="z_sal" tabindex="1">
                    <option value="1404" <?php if (isset($z_sal) && $z_sal=='1404') echo 'selected'?>>1404</option>
                </select>
            </div>
            
            <!-- استان -->
            <div class="form-field">
                <label>استان</label>
                <select name="id_ostan" disabled id="id_ostan" onchange="this.form.submit()">
                    <?php $id_ostan1 = $id_ostan ?>
                    <option value="-1">انتخاب استان</option>
                    <?php
                    $query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan ASC";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                    <option value="<?php echo $row['id_ostan']; ?>"
                        <?php if ($row['id_ostan']==$id_ostan1) echo 'selected'?>> <?php echo $row['ostan']; ?></option>
                    <?php } ?>
                </select>
                <?php 
                if (isset($_POST['id_ostan']))
                    $id_ostan1 = $_POST['id_ostan']; 
                ?>
            </div>
            
            <!-- نوع کشت -->
            <div class="form-field">
                <label>نوع کشت</label>
                <select name="no_kesh" class="required" id="no_bah2" tabindex="2">
                    <option value="0">انتخاب کنید</option>
                    <option value="1" <?php if($no_kesh=="1") echo "selected"?>>آبی</option>
                    <option value="2" <?php if($no_kesh=="2") echo "selected"?>>دیم</option>
                </select>
            </div>
            
            <!-- شهرستان -->
            <div class="form-field">
                <label>شهرستان</label>
                <select name="id_city5" disabled id="id_city" onchange="this.form.submit()">
                    <option value="0"> کل استان</option>
                    <?php
                    $query = "SELECT id_city,city FROM cityname WHERE id_ostan = '$id_ostan1' ORDER BY BINARY city ASC";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                    <option value="<?php echo $row['id_city']; ?>"
                        <?php if ($row['id_city']==$id_city) echo 'selected'?>> <?php echo $row['city']; ?></option>
                    <?php } ?>
                </select>
                <?php 
                if (isset($_POST['id_city5']))
                    $id_city = $_POST['id_city5']; 
                ?>
            </div>
            
            <!-- گروه محصولات -->
            <div class="form-field">
                <label>گروه محصولات</label>
                <select name="mah_qroup" class="required country" id="mah_qroup" tabindex="22">
                    <option value=""> انتخاب گروه</option>
                    <?php
                    $query = "SELECT DISTINCT group_cod,group_name FROM product_b";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                    <option value="<?php echo $row['group_cod']; ?>"
                        <?php if ($row['group_cod']==$mah_qroup) echo 'selected'?>> <?php echo $row['group_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <!-- نام محصول -->
            <div class="form-field">
                <label>نام محصول</label>
                <select name="mah_name" class="required mar" id="mah_name" tabindex="23">
                    <?php
                    $query = "SELECT DISTINCT product_cod,product_name FROM product_b WHERE group_cod = '$mah_qroup'";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                    <option value="<?php echo $row['product_cod']; ?>"
                        <?php if ($row['product_cod']==$mah_name) echo 'selected'?>> <?php echo $row['product_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <!-- مرکز جهاد کشاورزی -->
            <div class="form-field">
                <label>مرکز جهاد کشاورزی</label>
                <select name="id_mar" disabled id="bakh" onchange="this.form.submit()">
                    <option value="0"> نام مرکز</option>
                    <?php
                    $query = "SELECT id_mar,mar FROM mar WHERE id_ostan = '$id_ostan1' and id_city = '$id_city'";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                    <option value="<?php echo $row['id_mar']; ?>"
                        <?php if ($row['id_mar']==$id_mar) echo 'selected'?>> <?php echo $row['mar']; ?></option>
                    <?php } ?>
                </select>
                <?php
                if (isset($_POST['id_mar']))
                    $id_mar = $_POST['id_mar']; 
                ?>
                <input name="id_city" type="hidden" value="<?php echo $id_city; ?>" />
            </div>
            
            <!-- نام آبادی -->
            <div class="form-field">
                <label>نام آبادی</label>
                <select name="add_abadi" id="add_abadi" tabindex="6">
                    <option value="0">انتخاب نام آبادی</option>
                    <?php
                    $query = "SELECT add_abadi,abadi FROM list_abadi WHERE mor_cod_m = '$login_session' ORDER BY BINARY abadi";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                    <option value="<?php echo $row['add_abadi']; ?>"
                        <?php if ($row['add_abadi']==$add_abadi) echo 'selected'?>> <?php echo $row['abadi']; ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <!-- نام شهر -->
            <div class="form-field">
                <label>نام شهر</label>
                <select name="add_city" id="add_city" tabindex="7">
                    <option value="0">انتخاب نام شهر</option>
                    <?php
                    $query = "SELECT add_city,shahr FROM list_city WHERE id_mar = '$id_mar' and mor_cod_m = '$login_session' ORDER BY BINARY shahr";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                    <option value="<?php echo $row['add_city']; ?>"
                        <?php if ($row['add_city']==$add_city) echo 'selected'?>> <?php echo $row['shahr']; ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <!-- کد ملی بهره بردار -->
            <div class="form-field">
                <label>کد ملی بهره بردار</label>
                <input name="bah_cod_m" type="text" id="bah_cod_m" tabindex="8" value="<?php echo $bah_cod_m?>" />
            </div>
            
            <!-- کد ملی مروج -->
            <div class="form-field">
                <label>کد ملی مروج</label>
                <input name="mor_cod_m" type="text" value="<?php echo $login_session ?>" readonly />
            </div>
            
            <!-- نمایش رکوردها -->
            <div class="form-field full-width">
                <label>نمایش رکوردها</label>
                <select name="dis" class="required" id="no_kesh" tabindex="9">
                    <option value="1" <?php if($dis=="1") echo "selected"?>>همه رکوردها</option>
                    <option value="2" <?php if($dis=="2") echo "selected"?>>رکوردهای فاقد تولید قطعی</option>
                </select>
            </div>
            
            <!-- توضیحات -->
            <div class="info-text full-width">
                ℹ️ برای مشاهده محصولات فاقد تولید قطعی، آیتم نمایش رکوردها را روی "رکوردهای فاقد تولید قطعی" قرار دهید
            </div>
        </div>
        
        <div class="search-btn">
            <input name="action" type="submit" id="action" tabindex="10" value='🔍 جستجو' />
        </div>
    </div>
</div>
                          </form>
                            
                            <p><span class="style1"><a name="1" id="1"></a></span>
                            <?php
                            if (isset($_POST['action'])) {  
                                if ($id_ostan1 == '-1') { $v_id_ostan = 'id_ostan=id_ostan'; } else { $v_id_ostan = "id_ostan='$id_ostan1'"; }
                                if ($id_city == 0) { $v_id_city = 1; } else { $v_id_city = "id_city='$id_city'"; }
                                if ($id_mar == 0) { $v_id_mar = 1; } else { $v_id_mar = "id_mar='$id_mar'"; }
                                if ($add_abadi == '0') { $f_add_abadi = 1; } else { $f_add_abadi = "add_abadi = '$add_abadi'"; }
                                if ($add_city == '0') { $f_add_city = 1; } else { $f_add_city = "add_city = '$add_city'"; }
                                if ($no_kesh == '0') { $f_no_kesh = 1; } else { $f_no_kesh = "no_kesh = '$no_kesh'"; }
                                if ($bah_cod_m == '') { $v_bah_cod_m = 1; } else { $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'"; }
                                if ($z_sal == '') { $v_z_sal = 1; } else { $v_z_sal = "z_sal = '$z_sal'"; }
                                if ($mah_name == '') { $v_cod_mah = 1; } else { $v_cod_mah = "cod_mah = '$mah_name'"; }
                                if ($dis == '1') { $v_dis = 1; } else { $v_dis = "mah_tol < 0.0000001 and cod_mah != '299007' and mah_kh !='1'"; }
                                
                                $start=0;
                                $limit=5;
                                $id = isset($_GET['id']) ? $_GET['id'] : 1;
                                $start=($id-1)*$limit;
                                $query = "SELECT mah_bem,mah_kh,id,Garden_id,z_sal,bah_cod_m,sh_gat,no_kesh,cod_mah,mah_tolp,mah_tol,add_abadi,add_city,s_kesht_b,s_kesht_gb,tree_b,tree_gb from Garden_prod 
                                    where $v_id_ostan and $v_id_city and $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh and mor_cod_m = '$login_session' and $v_bah_cod_m and $v_z_sal and $v_cod_mah and $v_dis 
                                    AND (s_kesht_b > 0 OR tree_b > 0) AND cod_mah != '299007' ORDER BY bah_cod_m ASC LIMIT $start, $limit";

                                $query1 = "SELECT count(*) from Garden_prod 
                                    where $v_id_ostan and $v_id_city and $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh and mor_cod_m = '$login_session' and $v_bah_cod_m and $v_z_sal and $v_cod_mah and $v_dis 
                                    AND (s_kesht_b > 0 OR tree_b > 0) AND cod_mah != '299007'";

                                $stmt = $dbh->prepare($query);
                                $stmt->execute();
                                $t_row = $stmt->rowCount();

                                if ($t_row > 0) {
                            ?>
                            <br />
                            <img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                            
                            <!-- جدول با قابلیت sticky header -->
                            <div class="table-container">
                                <table align="center" class="my-table">
<thead>
    <tr class="text1">
        <th rowspan="2">عملیات</th>
        <th rowspan="2">خسارت</th>
        <th rowspan="2">بیمه</th>
        <th colspan="2">میزان تولید قطعی<br><span class="style2">تن</span></th>
        <th colspan="2">تعداد درخت<br><span class="style2">اصله</span></th>
        <th colspan="2">سطح زیر کشت<br><span class="style2">هکتار</span></th>
        <th rowspan="2">نام محصول</th>
        <th rowspan="2">نوع کشت</th>
        <th colspan="2">مشخصات بهره بردار</th>
        <th rowspan="2">ردیف</th>
    </tr>
    <tr class="text1">
        <th>قطعی</th><th>پیش بینی</th>
        <th>غیر بارور</th><th>بارور</th>
        <th>غیر بارور</th><th>بارور</th>
        <th>کد ملی</th><th>نام و نام خانوادگی</th>
    </tr>
</thead>                                    <tbody>
<?php 
$r = 1+$start;
foreach($stmt as $row){ 
    if ($row['no_kesh'] == '1') $v_no_kesh = 'آبی';     
    if ($row['no_kesh'] == '2') $v_no_kesh = 'دیم';
    $t_r = $r;
    
    $mah_kh = $row['mah_kh']; 
    $mah_bem = $row['mah_bem']; 
    $mah_tol = $row['mah_tol']; 
    $mah_tolp = $row['mah_tolp']; 
    $tree_gb = $row['tree_gb']; 
    $tree_b = $row['tree_b']; 
?>
<tr>
    <!-- ستون عملیات (ثبت و آیکون‌ها) -->
    <td style="white-space: nowrap;">
        <form name="form<?php echo $t_r ?>" style="display: inline-block;">
            <input type="hidden" id="cod_mah<?php echo $t_r ?>" name="cod_mah" value="<?php echo $row['cod_mah']; ?>" />
            <input type="hidden" id="id<?php echo $t_r ?>" name="id" value="<?php echo $row['id']; ?>" />
            <input type="hidden" id="Garden_id<?php echo $t_r ?>" name="Garden_id" value="<?php echo $row['Garden_id']; ?>" />
            <input type="hidden" id="add_city<?php echo $t_r ?>" name="add_city" value="<?php echo $add_city; ?>" />
            <input type="hidden" id="z_sal" name="z_sal" value="<?php echo $z_sal; ?>" />
            <input type="hidden" id="bah_cod_m<?php echo $t_r ?>" name="bah_cod_m" value="<?php echo $row['bah_cod_m']; ?>" />
            <input type="hidden" id="add_abadi<?php echo $t_r ?>" name="add_abadi" value="<?php echo $row['add_abadi']; ?>" />
            <input type="hidden" id="sh_gat<?php echo $t_r ?>" name="sh_gat" value="<?php echo $row['sh_gat']; ?>" />
            <input type="hidden" id="s_kesht_b<?php echo $t_r ?>" name="s_kesht_b" value="<?php echo $row['s_kesht_b'] * 1; ?>" />
            <input type="hidden" id="s_kesht_gb<?php echo $t_r ?>" name="s_kesht_gb" value="<?php echo $row['s_kesht_gb'] * 1; ?>" />
            
            <input type="submit" class="submit<?php echo $t_r ?>" value="ثبت" />
            <span class="error<?php echo $t_r ?>" style="display:none">❌</span>
            <span class="success<?php echo $t_r ?>" style="display:none">✅</span>
        </form>
    </td>
    
    <!-- ستون خسارت -->
    <td>
        <select name="mah_kh" id="mah_kh<?php echo $t_r ?>">
            <option value="">انتخاب</option>
            <option value="1" <?php if($row['mah_kh'] == '1') echo 'selected'; ?>>بلی</option>
            <option value="2" <?php if($row['mah_kh'] == '2') echo 'selected'; ?>>خیر</option>
        </select>
    </td>
    
    <!-- ستون بیمه -->
    <td>
        <select name="mah_bem" id="mah_bem<?php echo $t_r ?>">
            <option value="">انتخاب</option>
            <option value="1" <?php if($row['mah_bem'] == '1') echo 'selected'; ?>>بلی</option>
            <option value="2" <?php if($row['mah_bem'] == '2') echo 'selected'; ?>>خیر</option>
        </select>
    </td>
    
    <!-- ستون تولید قطعی (تن) -->
    <td><input type="text" class="mah_tol<?php echo $t_r ?>" id="mah_tol<?php echo $t_r ?>" value="<?php echo $mah_tol * 1; ?>" style="width:95%" /></td>
    
    <!-- ستون پیش بینی -->
    <td><input type="text" class="mah_tolp<?php echo $t_r ?>" id="mah_tolp<?php echo $t_r ?>" value="<?php echo $mah_tolp * 1; ?>" style="width:95%" /></td>
    
    <!-- ستون درخت غیر بارور -->
    <td><input type="text" class="tree_gb" id="tree_gb<?php echo $t_r ?>" value="<?php echo $tree_gb; ?>" style="width:95%" /></td>
    
    <!-- ستون درخت بارور -->
    <td><input type="text" class="tree_b<?php echo $t_r ?>" id="tree_b<?php echo $t_r ?>" value="<?php echo $tree_b; ?>" style="width:95%" /></td>
    
    <!-- ستون سطح زیر کشت غیر بارور (فقط نمایشی) -->
    <td><?php echo $row['s_kesht_gb']; ?></td>
    
    <!-- ستون سطح زیر کشت بارور (فقط نمایشی) -->
    <td><?php echo $row['s_kesht_b']; ?></td>
    
    <!-- ستون نام محصول -->
    <td><?php echo mah_name_bagh($row['cod_mah']); ?></td>
    
    <!-- ستون نوع کشت -->
    <td><?php echo $v_no_kesh; ?></td>
    
    <!-- ستون کد ملی بهره بردار -->
    <td><?php echo $row['bah_cod_m']; ?></td>
    
    <!-- ستون نام و نام خانوادگی -->
    <td><?php echo bah_name($row['bah_cod_m']); ?></td>
    
    <!-- ستون ردیف -->
    <td><?php echo $r; ?></td>
</tr>
<?php 
    $r++;
} 
?>
             </tbody>
                                </table>
                            </div>
                            
                            <p class="style2" align="center">
                            <?php } else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }} ?>
                            
                            <?php
                            $stmt1 = $dbh->prepare($query1);
                            $stmt1->execute();
                            $rows = $stmt1->fetchColumn();
                            $total = ceil($rows/$limit);
                            $t_row = ($rows > 20) ? 20 : $rows;
                            
                            function generate_hidden_inputs() {
                                global $id_ostan1, $id_city, $id_mar, $add_abadi, $add_city, $bah_cod_m, 
                                       $user_check, $no_kesh, $z_sal, $mah_qroup, $mah_name, $dis;
                                ?>
                                <input type="hidden" name="action" value="1" />
                                <input type="hidden" name="id_ostan" value="<?= htmlspecialchars($id_ostan1) ?>" />
                                <input type="hidden" name="id_city5" value="<?= htmlspecialchars($id_city) ?>" />
                                <input type="hidden" name="id_mar" value="<?= htmlspecialchars($id_mar) ?>" />
                                <input type="hidden" name="add_abadi" value="<?= htmlspecialchars($add_abadi) ?>" />
                                <input type="hidden" name="add_city" value="<?= htmlspecialchars($add_city) ?>" />
                                <input type="hidden" name="bah_cod_m" value="<?= htmlspecialchars($bah_cod_m) ?>" />
                                <input type="hidden" name="mor_cod_m" value="<?= htmlspecialchars($user_check) ?>" />
                                <input type="hidden" name="no_kesh" value="<?= htmlspecialchars($no_kesh) ?>" />
                                <input type="hidden" name="z_sal" value="<?= htmlspecialchars($z_sal) ?>" />
                                <input type="hidden" name="mah_qroup" value="<?= htmlspecialchars($mah_qroup) ?>" />
                                <input type="hidden" name="mah_name" value="<?= htmlspecialchars($mah_name) ?>" />
                                <input type="hidden" name="dis" value="<?= htmlspecialchars($dis) ?>" />
                                <?php
                            }
                            
                            $visible_pages = 5;
                            $start_page = max(1, $id - $visible_pages);
                            $end_page = min($total, $id + $visible_pages);
                            ?>
                            
                            <div dir="rtl" class="pagination-container" style="margin: 20px auto; text-align: center; padding: 15px;">
                                <ul class="pagination" style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; flex-wrap: wrap; gap: 5px;">
                                    <?php if($id > 1): ?>
                                        <li style="display: inline-block;">
                                            <form action="Garden_edit_T_new.php?id=<?= $id-1 ?>#1" method="post" style="display: inline;">
                                                <?php generate_hidden_inputs(); ?>
                                                <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">&laquo; قبلی</button>
                                            </form>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php if($start_page > 1): ?>
                                        <li style="display: inline-block;">
                                            <form action="Garden_edit_T_new.php?id=1#1" method="post" style="display: inline;">
                                                <?php generate_hidden_inputs(); ?>
                                                <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;">1</button>
                                            </form>
                                        </li>
                                        <?php if($start_page > 2): ?>
                                            <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                                        <li style="display: inline-block;">
                                            <?php if($i == $id): ?>
                                                <span style="background: #4CAF50; color: white; padding: 5px 10px; border-radius: 4px; display: inline-block;"><?= $i ?></span>
                                            <?php else: ?>
                                                <form action="Garden_edit_T_new.php?id=<?= $i ?>#1" method="post" style="display: inline;">
                                                    <?php generate_hidden_inputs(); ?>
                                                    <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $i ?></button>
                                                </form>
                                            <?php endif; ?>
                                        </li>
                                    <?php endfor; ?>
                                    
                                    <?php if($end_page < $total): ?>
                                        <?php if($end_page < $total - 1): ?>
                                            <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
                                        <?php endif; ?>
                                        <li style="display: inline-block;">
                                            <form action="Garden_edit_T_new.php?id=<?= $total ?>#1" method="post" style="display: inline;">
                                                <?php generate_hidden_inputs(); ?>
                                                <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $total ?></button>
                                            </form>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php if($id < $total): ?>
                                        <li style="display: inline-block;">
                                            <form action="Garden_edit_T_new.php?id=<?= $id+1 ?>#1" method="post" style="display: inline;">
                                                <?php generate_hidden_inputs(); ?>
                                                <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">بعدی &raquo;</button>
                                            </form>
                                        </li>
                                    
                                </ul>
                                
                                <div class="page-jump" style="margin-top: 15px;">
                                    <form action="Garden_edit_T_new.php" method="post" style="display: inline-flex; align-items: center; gap: 10px;">
                                        <?php generate_hidden_inputs(); ?>
                                        <span style="font-size: 14px;"> به صفحه:</span>
                                        <input type="number" name="page_input" value="<?= $id ?>" style="width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
                                        <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">برو</button>
                                    </form>
                                </div>
                            </div>
                            <?php endif; ?>
                            <script>
                                document.querySelector('.page-jump form')?.addEventListener('submit', function(e) {
                                    const pageInput = this.querySelector('input[name="page_input"]');
                                    const pageNum = parseInt(pageInput.value);
                                    
                                    if (isNaN(pageNum)) {
                                        e.preventDefault();
                                        alert('لطفاً یک عدد معتبر وارد کنید');
                                        return;
                                    }
                                    
                                    if (pageNum < 1 || pageNum > <?= $total ?>) {
                                        e.preventDefault();
                                        alert('لطفاً عددی بین 1 و <?= $total ?> وارد کنید');
                                        return;
                                    }
                                    
                                    this.action = `Garden_edit_T_new.php?id=${pageNum}#1`;
                                });
                            </script>
                            
                            <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt=""/></a></p>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </body>
    </html>
    
    <?php
    $no = isset($t_row) ? $t_row : 0;
    while ($no > 0){
    ?>
    
    <script>
        $('.tree_b<?php echo $no ?>').change(function () {
            $('#mah_tolp<?php echo $no ?>').val('');
            $('#mah_tol<?php echo $no ?>').val('');
            var e = document.getElementById("cod_mah<?php echo $no ?>");
            var mcod = e.options[e.selectedIndex].value;
            var treeb = document.getElementById("tree_b<?php echo $no ?>").value;
            if ((mcod == '203003' || mcod == '206024' || mcod == '205002'
            || mcod == '299006' || mcod == '299003' || mcod == '208034'
            || mcod == '208037' || mcod == '208046' || mcod == '208052'
            || mcod == '208053' || mcod == '208108' || mcod == '208999') & treeb > 0 ) {
                alert("برای این محصول نباید تعداد درخت ثبت کنید ");
                $('#tree_b<?php echo $no ?>').val(0);
                document.getElementById("tree_b<?php echo $no ?>").focus();
            }
            var skb = document.getElementById("s_kesht_b<?php echo $no ?>").value;
            if (parseFloat(skb) <= 0 ) {
                alert("بعلت سطح کشت بارور 0 ، امکان ثبت تعداد درخت بارور وجود ندارد ");
                $('#tree_b<?php echo $no ?>').val(0);
                document.getElementById("tree_b<?php echo $no ?>").focus();
            }
        });
    </script>
    
    <script>
        $('.tree_gb').change(function () {
            var e = document.getElementById("cod_mah<?php echo $no ?>");
            var mcod = e.options[e.selectedIndex].value;
            var treegb = document.getElementById("tree_gb<?php echo $no ?>").value;
            if ((mcod == '203003' || mcod == '206024' || mcod == '205002'
            || mcod == '299006' || mcod == '299003' || mcod == '208034'
            || mcod == '208037' || mcod == '208046' || mcod == '208052'
            || mcod == '208053' || mcod == '208108' || mcod == '208999') & treegb > 0 ) {
                alert("برای این محصول نباید تعداد درخت ثبت کنید ");
                $('#tree_gb<?php echo $no ?>').val(0);
                document.getElementById("tree_gb<?php echo $no ?>").focus();
            }
            var skgb = document.getElementById("s_kesht_gb<?php echo $no ?>").value;
            if (parseFloat(skgb) <= 0 ) {
                alert("بعلت سطح کشت غیربارور 0 ، امکان ثبت تعداد درخت غیر بارور وجود ندارد ");
                $('#tree_b<?php echo $no ?>').val(0);
                document.getElementById("tree_gb<?php echo $no ?>").focus();
            }
        });
    </script>
    
    <script type="text/javascript">
        $(function() {
            $(".submit<?php echo $no ?>").click(function() {
                var tree_gb = $("#tree_gb<?php echo $no ?>").val();
                var tree_b = $("#tree_b<?php echo $no ?>").val();
                var mah_tol = $("#mah_tol<?php echo $no ?>").val();
                var mah_tolp = $("#mah_tolp<?php echo $no ?>").val();
                var e = document.getElementById("mah_kh<?php echo $no ?>");
                var mah_kh = e.options[e.selectedIndex].value;
                var e1 = document.getElementById("mah_bem<?php echo $no ?>");
                var mah_bem = e1.options[e1.selectedIndex].value;
                var id = $("#id<?php echo $no ?>").val();
                var Garden_id = $("#Garden_id<?php echo $no ?>").val();
                var bah_cod_m = $("#bah_cod_m<?php echo $no ?>").val();
                var z_sal = $("#z_sal").val();
                var sh_gat = $("#sh_gat<?php echo $no ?>").val();
                var add_abadi = $("#add_abadi<?php echo $no ?>").val();
                var s_kesht_b = $("#s_kesht_b<?php echo $no ?>").val();
                var s_kesht_gb = $("#s_kesht_gb<?php echo $no ?>").val();
                var dataString = 'tree_gb='+ tree_gb + '&tree_b=' + tree_b +'&mah_tol='+mah_tol+'&mah_tolp='+mah_tolp+'&id='+id+'&Garden_id='+Garden_id+'&bah_cod_m=' + bah_cod_m + '&add_abadi=' + add_abadi + '&z_sal=' + z_sal + '&sh_gat=' + sh_gat + '&mah_bem=' + mah_bem + '&mah_kh=' + mah_kh;
                
                if(mah_bem =='' || mah_kh =='' || (parseFloat(s_kesht_b) > 0 && mah_kh =='2' && (parseFloat(mah_tol) <= 0 || parseFloat(mah_tolp) <= 0))) {
                    $('.success<?php echo $no ?>').fadeOut(200).hide();
                    $('.error<?php echo $no ?>').fadeOut(200).show();
                } else {
                    $.ajax({
                        type: "POST",
                        url: "post98.php",
                        data: dataString,
                        success: function(){
                            $('.success<?php echo $no ?>').fadeIn(200).show();
                            $('.error<?php echo $no ?>').fadeOut(200).hide();
                        }
                    });
                }
                return false;
            });
        });
    </script>
    
    <?php
    $no--;
    }
    ?>
	