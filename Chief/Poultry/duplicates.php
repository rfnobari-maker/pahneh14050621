<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style>
button
{
	border-color:#FFF ;
}
.summary-table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    font-size: 14px;
}
.summary-table th, .summary-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    vertical-align: middle; /* برای وسط‌چینی عمودی محتوای سلول */
}
.summary-table th {
    background-color: #006699;
    color: white;
    font-weight: bold;
}
.year-filter-form {
    text-align: center;
    margin: 20px 0;
    font-size: 16px;
}
.year-filter-form select, .year-filter-form input {
    padding: 8px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin: 0 5px;
}
.year-filter-form input {
    background-color: #006699;
    color: white;
    cursor: pointer;
}
/* استایل دایره قرمز */
.red-circle {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 35px;           /* عرض دایره */
  height: 35px;          /* ارتفاع دایره */
  background-color: red; /* رنگ پس‌زمینه قرمز */
  border-radius: 50%;    /* این کد شکل را به دایره تبدیل می‌کند */
  color: white !important; /* رنگ متن سفید و مهم برای اعمال شدن */
  font-size: 16px;       /* اندازه فونت متن */
  font-weight: bold;     /* ضخامت فونت */
  margin: 0 auto;        /* برای قرارگیری دایره در وسط سلول */
}
/* استایل برای دکمه‌ای که شبیه لینک است */
.post-button {
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    color: inherit;
}
.back-link-button {
    text-decoration:none; 
    padding: 8px 15px; 
    background-color:#006699; 
    color:white; 
    border-radius: 5px;
    border: none;
    cursor: pointer;
    font-family: inherit;
    font-size: 14px;
}
</style>
<script>
function bee_popup(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="top" >
<?php
// اتصال به دیتابیس
include('../../login/config.php');

// دریافت لیست سال‌های موجود در دیتابیس
$years_stmt = $dbh->query("SELECT DISTINCT sal FROM bee ORDER BY sal DESC");
$available_years = $years_stmt->fetchAll(PDO::FETCH_COLUMN);

// تعیین سال انتخاب شده (اگر سالی انتخاب نشده بود، آخرین سال را به عنوان پیش‌فرض قرار بده)
$selected_sal = '';
if (isset($_POST['sal']) && in_array($_POST['sal'], $available_years)) {
    $selected_sal = $_POST['sal'];
} elseif (!empty($available_years)) {
    $selected_sal = $available_years[0];
}

// اگر کد ملی از طریق لینک ارسال شده بود، جدول جزئیات را نمایش بده
if (isset($_POST['bah_cod_m']) && !empty($_POST['bah_cod_m']))
{  
    $bah_cod_m = $_POST['bah_cod_m'];
    $query = "SELECT * from bee where bah_cod_m = :bah_cod_m and sal = :sal ORDER BY sal DESC"; 
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m, ':sal' => $selected_sal));
    $found = $stmt->rowCount();

    if ($found > 0) {
?>
    <p align="center" class="style1" >جزئیات سوابق برای کد ملی: <?php echo htmlspecialchars($bah_cod_m); ?></p>
    <p align="center" ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
    <p align="center" style="margin: 20px;">
        <form action="duplicates.php" method="POST" style="display: inline;">
            <input type="hidden" name="sal" value="<?php echo htmlspecialchars($selected_sal); ?>">
            <button type="submit" class="back-link-button">بازگشت به لیست</button>
        </form>
    </p>
    
    <table width="90%"  align="center" class="my-table" >
        <tr class="text1">
            <td rowspan="2" bgcolor="#006699">عملیات</td><td width="8%" height="54" rowspan="2" bgcolor="#006699">کارشناس<br /> مروج</td>
            <td colspan="3" bgcolor="#006699">تولید عسل<br /> Kg</td><td height="54" colspan="3" bgcolor="#006699">تعداد کندو</td>
            <td width="5%" rowspan="2" bgcolor="#006699">سال</td><td colspan="2" bgcolor="#006699">مشخصات زنبوردار</td>
            <td width="9%" rowspan="2" bgcolor="#006699"><p>نوع </p><p>زنبورستان</p></td><td colspan="3" bgcolor="#006699">موقعیت زنبورستان</td>
        </tr>
        <tr class="text1">
            <td width="6%" bgcolor="#006699">جمع</td><td width="6%" bgcolor="#006699">مدرن</td><td width="5%" bgcolor="#006699">سنتی</td>
            <td width="5%" bgcolor="#006699">جمع</td><td width="6%" height="31" bgcolor="#006699">مدرن</td><td width="5%" bgcolor="#006699">سنتی</td>
            <td width="7%" bgcolor="#006699">کد ملی </td><td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
            <td width="7%" bgcolor="#006699">شهر/آبادی</td><td width="8%" bgcolor="#006699">شهرستان</td><td width="10%" bgcolor="#006699">استان</td>
        </tr>
        <?php foreach($stmt as $row){ 
            $pic = user_pic($row['mor_cod_m']) ; 
            if ($row['no_zan']=='1') $v_no_zan = 'غیرمهاجر '; else $v_no_zan = 'مهاجر' ;
        ?>
        <tr>
            <td width="7%">
                <form  action="view_bee.php" method="post" onsubmit="bee_popup(this)"><input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m);?>" /><input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" /><input type="hidden" name="m_page"  value="duplicates.php" /><button><img src="../../files/view.png" title="نمایش اطلاعات زنبورستان"  width="25" height="25"  alt=""/></button></form>
            </td>
            <td height="81" class="normalTextSmaller"><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br /><?php echo user_name($row['mor_cod_m'])?><br/><?php echo $row['mor_cod_m']?><br /></td>
            <td class="normalTextSmall" ><?php echo $row['to_mo']+$row['to_bo'] ;   ?></td><td class="normalTextSmall" ><?php echo $row['to_mo'] ?></td><td class="normalTextSmall" ><?php echo $row['to_bo'] ?></td>
            <td class="normalTextSmall"><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td><td class="normalTextSmall"><?php echo $row['tk_mo'] ?></td><td class="normalTextSmall"><?php echo $row['tk_bo'] ?></td>
            <td class="normalTextSmall"><?php echo $row['sal'] ?></td><td height="81" class="normalTextSmall"><?php echo $row['bah_cod_m'] ?></td><td class="normalTextSmall"><?php echo bah_name($row['bah_cod_m'])?></td>
            <td class="normalTextSmall"><?php echo $v_no_zan?></td><td class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
            <td class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td><td class="normalTextSmall"><?php echo ostan_name($row['id_ostan']); ?></td> 
        </tr>
        <?php } ?>
    </table>
<?php
    } else {
        echo '<p class=style8 align="center"> بهره برداری با مشخصات وارد شده یافت نشد.</p>'  ;
    }
}
else // در حالت پیش‌فرض، لیست کدهای تکراری را نمایش بده
{
?>
    <p align="center" class="style1" >لیست زنبورداران با ثبت بیش از یک رکورد</p>
    <p align="center" ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
   <div dir="rtl">
    <form action="duplicates.php" method="POST" class="year-filter-form">
        <label for="sal">انتخاب سال:</label>
        <select name="sal" id="sal">
            <?php foreach ($available_years as $year): ?>
                <option value="<?php echo htmlspecialchars($year); ?>" <?php if ($year == $selected_sal) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($year); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="نمایش">
    </form>
    </div>
<?php
    if (!empty($selected_sal)) {
        $query_summary = "SELECT bah_cod_m, COUNT(id) as count FROM bee WHERE sal = :sal GROUP BY bah_cod_m HAVING count > 1 ORDER BY count DESC";
        $stmt_summary = $dbh->prepare($query_summary);
        $stmt_summary->execute(array(':sal' => $selected_sal));
        $found_summary = $stmt_summary->rowCount();
        if ($found_summary > 0) {
?>
    <table  dir="rtl" class="summary-table">
        <tr><th>نام و نام خانوادگی</th><th>کد ملی</th><th>تعداد تکرار در سال <?php echo htmlspecialchars($selected_sal); ?></th></tr>
        <?php foreach($stmt_summary as $row_summary) { ?>
        <tr>
            <td><?php echo bah_name($row_summary['bah_cod_m']); ?></td>
            <td><?php echo $row_summary['bah_cod_m']; ?></td>
            <td>
                <form action="duplicates.php" method="POST">
                    <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($row_summary['bah_cod_m']); ?>">
                    <input type="hidden" name="sal" value="<?php echo htmlspecialchars($selected_sal); ?>">
                    <button type="submit" class="post-button" title="برای مشاهده سوابق کلیک کنید">
                        <div class="red-circle">
                            <?php echo $row_summary['count']; ?>
                        </div>
                    </button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
<?php
        } else {
            echo '<p class="style8" align="center">در سال ' . htmlspecialchars($selected_sal) . ' هیچ زنبورداری با ثبت بیش از یکبار یافت نشد.</p>';
        }
    } else {
        echo '<p class="style8" align="center">هیچ اطلاعاتی برای نمایش وجود ندارد. لطفا ابتدا رکوردی ثبت کنید.</p>';
    }
}
?>
    </td>
  </tr>
  <tr><td height="100" colspan="3" valign="middle" ></td></tr>
  <tr><td height="109" colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php'); ?></td></tr>
</table>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>