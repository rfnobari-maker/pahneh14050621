<?php
include('../../lock_p2.php');
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
          th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
			font-size:16px ;
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
<h4>  آمار واحد در سال <?php echo $sal ?></h4>
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
    
    <label for="searchPartIDCode" style="font-size:14px;; margin-right:70px">نوع واحد:</label>
    <span style="font-size:14px; color:#069; margin-right:10px"><?php echo translateUnitType($no_fa); ?></span>
    
</div>

   <div id="searchResultMessage" style="color: red; margin-top: 10px;"></div>

</div>

<div style="background-color:#FFF; width:90%; margin:auto ; text-align:center ; margin-top:15px">
<?php

if ($partIDCode) {
    // کوئری برای انتخاب داده‌ها
    include('../../login/config.php');
$query = "SELECT * FROM animals WHERE partIDCode = :partIDCode and sal = '1403'";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':partIDCode', $partIDCode, PDO::PARAM_STR);
    $stmt->execute();

    // نمایش داده‌ها در جدول
    echo '<table width="100%" id="animalTable" align="center" class="my-table" >
            <thead>
                <tr>
                    <th>گونه</th>
                    <th>نژاد</th>
                    <th>جنسیت</th>
                    <th>سن</th>
                    <th>نوع دام</th>
                    <th>تعداد دام</th>
                </tr>
            </thead>
            <tbody>';

    // متغیر برای جمع‌بندی تعداد دام
    $totalQuantity = 0;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>
                <td>' . translateSpecies(htmlspecialchars($row['species'])) . '</td>
                <td>' . translateBreed(htmlspecialchars($row['breed'])) . '</td>
                <td>' . translateGender(htmlspecialchars($row['gender'])) . '</td>
                <td>' . translateAge(htmlspecialchars($row['age'])) . '</td>
                <td>' . translateActivity(htmlspecialchars($row['activity'])) . '</td>
                <td>' . htmlspecialchars($row['quantity']) . '</td>
              </tr>';

        // جمع‌بندی تعداد دام
        $totalQuantity += (int)$row['quantity'];
    }

    // نمایش مجموع تعداد دام در انتهای جدول
    echo '<tr>
            <td colspan="5" style="text-align: right; font-weight: bold;">مجموع تعداد دام:</td>
            <td style="font-weight: bold;">' . $totalQuantity . '</td>
          </tr>';
    echo '</tbody></table>';
} else {
    echo '<p>شناسه یکتا (partIDCode) وارد نشده است.</p>';
}
?>
  <tr>
<td  height="50"colspan="3" valign="middle" >
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
        30 => 'واحد پرورش دام مستقر در مجموعه دامپروري' ,
		101=> 'دام صنعتی و نیمه صنعتی' ,
		110=> 'دامداری عشایری' ,
		111=> 'دامداری روستایی و غیرصنعتی'
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
<?php
// تابع ترجمه گونه (species)
function translateSpecies($speciesCode) {
    $species = array(
        1 => 'گاو',
        2 => 'گاومیش',
        3 => 'شتر',
        4 => 'گوسفند',
        5 => 'بز',
        6 => 'اسب',
        7 => 'استر' ,
        8 => 'قاطر' ,
        9 => 'سگ' ,
    );
    return isset($species[$speciesCode]) ? $species[$speciesCode] : 'گونه نامشخص';
}

// تابع ترجمه نژاد (breed)
function translateBreed($breedCode) {
    $breeds = array(
        1 => 'اصیل',
        2 => 'بومی',
        3 => 'آمیخته'
    );
    return isset($breeds[$breedCode]) ? $breeds[$breedCode] : 'نژاد نامشخص';
}

// تابع ترجمه جنسیت (gender)
function translateGender($genderCode) {
    $genders = array(
        1 => 'نر',
        2 => 'ماده',
        3 => 'فریمارتین نر',
        4 => 'فریمارتین ماده'
    );
    return isset($genders[$genderCode]) ? $genders[$genderCode] : 'جنسیت نامشخص';
}

// تابع ترجمه سن (age)
function translateAge($ageCode) {
    $ages = array(
        1 => '0 تا 6 ماه',
        2 => '6 تا 12 ماه',
        3 => 'از یکسال تا دو سال',
        4 => 'بیشتر از دو سال'
    );
    return isset($ages[$ageCode]) ? $ages[$ageCode] : 'سن نامشخص';
}

// تابع ترجمه نوع فعالیت (activity)
function translateActivity($activityCode) {
    $activities = array(
        1 => 'داشتی شیری',
        2 => 'داشتی دومنظوره',
        3 => 'داشتی بومی',
        4 => 'پرواری' ,
        5 => 'همراه-تفریحی' ,
        6 => 'ورزشی' ,
        7 => 'کاری' ,
		
    );
    return isset($activities[$activityCode]) ? $activities[$activityCode] : 'فعالیت نامشخص';
}
?>