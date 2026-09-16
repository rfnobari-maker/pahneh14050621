<?php
require_once("../../lock_cp.php");
require_once("../../event.php");
// ADDED: Move config inclusion up to support new database functions
require_once("../../login/config.php"); 

if (isset($_POST['z_sal']))  $z_sal= $_POST['z_sal'] ; 
if (isset($_POST['id_ostan'])) $id_ostan1= $_POST['id_ostan']   ; 
if (isset($_POST['id_city'])) $id_city= $_POST['id_city']   ; 
if (isset($_POST['id_mar'])) $id_mar= $_POST['id_mar']   ; 
if (isset($_POST['cod_mah'])) $cod_mah= $_POST['cod_mah']   ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 	  

// ADDED: Utility Functions for Database
// Function to handle database connections (assuming $dbh is a global or included PDO object)
function get_db_connection() {
    global $dbh;
    if (!$dbh) {
        return null;
    }
    return $dbh;
}

// Function to safely execute a prepared statement
function execute_prepared_statement($query, $params) {
    $dbh = get_db_connection();
    if (!$dbh) {
        return null;
    }
    $stmt = $dbh->prepare($query);
    foreach ($params as $key => $value) {
        // Use bindParam for better security and type-checking
        $stmt->bindParam($key, $params[$key]);
    }
    $stmt->execute();
    return $stmt;
}

// ADDED: تابع جدید برای دریافت تعداد کارشناسان پهنه (S_access = 1) بر اساس مرکز، شهرستان و استان
function get_s_access_count_by_marakez($id_ostan, $id_city, $id_mar) {
    $dbh = get_db_connection();
    if (!$dbh) {
        return 'N/A';
    }
    // کوئری با فیلتر id_ostan، id_city و id_mar
    $query = "SELECT count(*) AS count FROM `users` WHERE `S_access` = '1' AND `id_ostan` = :id_ostan_target AND `id_city` = :id_city_target AND `id_mar` = :id_mar_target";
    $params = array(
        ':id_ostan_target' => $id_ostan, 
        ':id_city_target' => $id_city, 
        ':id_mar_target' => $id_mar
    );
    
    $stmt = execute_prepared_statement($query, $params); 
    $row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
    return $row ? (int)$row['count'] : '0';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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

        }

        .close-btn-container {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
        
        /* ADDED CSS: کانتینر جدید برای نمایش تعداد کارشناسان (سمت راست) */
        .s-access-info-container {
            position: fixed;
            top: 20px;
            right: 20px; /* تنظیم موقعیت در سمت راست */
            z-index: 1000;
        }

        /* ADDED CSS: استایل نمایش تعداد کارشناسان با پس‌زمینه رنگی */
        .s-access-count {
            background-color: #E8F5E9; /* سبز روشن */
            color: #2E7D32; /* سبز پررنگ */
            padding: 12px 18px; /* افزایش Padding برای جلوه بهتر */
            border-radius: 8px; /* گردتر شدن لبه‌ها */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            font-size: 1rem;
            border: 1px solid #C8E6C9; /* اضافه کردن حاشیه سبز کم‌رنگ */
            direction: rtl; 
            font-weight: bold;
        }
        /* END ADDED CSS */

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 32px;
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

        /* --- استایل جدید برای دایره توپر --- */
        .kol-circle {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            background-color: #F44336; /* رنگ قرمز */
            color: #FFFFFF; /* رنگ سفید برای متن */
            text-align: center;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease;
        }

        .kol-circle:hover {
            transform: scale(1.1);
        }
    </style>
<script type="text/javascript">
    var initial_id_ostan = '<?php echo !empty($id_ostan1) ? $id_ostan1 : ''; ?>';
    var initial_id_city = '<?php echo !empty($id_city) ? $id_city : ''; ?>';
    var initial_id_mar = '<?php echo !empty($id_mar) ? $id_mar : ''; ?>';
    
    // --- تابع جدید برای باز کردن پاپ‌آپ ---
    function openKolPopup(mor_cod_m, id_ostan, id_city, id_mar, cod_mah, z_sal) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'list_bah_zk.php';
        form.target = 'list_mah_zk_detail_popup';
        form.style.display = 'none';

        const postData = {
            'z_sal': z_sal,
            'id_ostan': id_ostan,
            'id_city': id_city,
            'id_mar': id_mar,
            'cod_mah': cod_mah,
            'mor_cod_m': mor_cod_m
        };

        for (const key in postData) {
            if (postData.hasOwnProperty(key)) {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = key;
                hiddenInput.value = postData[key];
                form.appendChild(hiddenInput);
            }
        }
        
        window.open('about:blank', 'list_mah_zk_detail_popup', 'location=1,status=1,scrollbars=1,width=1000,height=800,top=50,left=50');
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }
</script>

</head>
<body>
<?php
// Calculate count after variable definition and function loading
$s_access_count = 0;
if (!empty($id_ostan1) && !empty($id_city) && !empty($id_mar)) {
    $s_access_count = get_s_access_count_by_marakez($id_ostan1, $id_city, $id_mar);
}
?>
<div class="s-access-info-container">
    <div class="s-access-count">
        کارشناسان پهنه مرکز جهاد: <?php echo htmlspecialchars($s_access_count, ENT_QUOTES); ?> نفر
    </div>
</div>
<div class="close-btn-container">
    <button class="close-btn" onclick="window.close()">بستن پنجره</button>
</div>
<div class="container">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >

<?php 
   if (isset($_POST['id_mar']))
   {
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan= $_POST['id_ostan'] ;  ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 	  
 $id_city = $_POST['id_city'] ;
if ($id_city == 0) $v_id_city = 1  ; else $v_id_city = "$Agri_prod_table.id_city = '$id_city'" ; 
if ($id_mar == 0) $v_id_mar = 1  ; else $v_id_mar = "$Agri_prod_table.id_mar = '$id_mar'" ; 
if ($cod_mah == 0) $v_cod_mah = 1  ; else $v_cod_mah = "$Agri_prod_table.cod_mah = '$cod_mah'" ; 

// اگر محصول صیفی باشد 
if ($cod_mah == 170 || $cod_mah == 172 || $cod_mah == 174) {
?>
<br />
      <table width="85%"  align="center" class="my-table"  >
             <tr align="center" class="text1">
               <td width="19%" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td width="19%" bgcolor="#999999">سطح برداشت<br />
                 <span class="style2">هکتار</span></td>
               <td bgcolor="#999999">پیش بینی تولید <br />
                <span class="style2">تن</span> <br /></td>
               <td width="14%" bgcolor="#999999">سطح زیر کشت<br />
                <span class="style2">هکتار</span></td>
               <td width="10%" bgcolor="#999999">تعداد قطعات</td>
               <td width="15%" bgcolor="#999999">مشخصات کارشناس</td>
               <td width="5%" bgcolor="#999999">ردیف</td>
             </tr>
             <tr>
               <?php
// REMOVED: require_once("../../login/config.php"); - moved to the top of the file
  $query = "SELECT 
   cod_mah ,  mor_cod_m,count(*) as kol , 
    sum(zer_kesht) zer_k,
    sum(s_bar) s_bar,
    sum(mah_tolp) m_tolp, 
    sum(mah_tol) m_tol
FROM Vege_prod 
where id_ostan = '$id_ostan1'  and id_city='$id_city' and id_mar='$id_mar' and cod_mah = '$cod_mah' and z_sal = '$z_sal'
GROUP BY mor_cod_m
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
$pic = user_pic($row['mor_cod_m']) ;
?>
               <td height="32" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['s_bar']),1)*1 ; ?><br /></td>
               <td width="18%" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k']),1)*1 ; ?><br /></td>
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                   <span class="kol-circle" onclick="openKolPopup('<?php echo htmlspecialchars($row['mor_cod_m'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($id_ostan1, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($id_city, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($id_mar, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($cod_mah, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($z_sal, ENT_QUOTES); ?>')">
                       <?php echo htmlspecialchars($row['kol'], ENT_QUOTES); ?>
                   </span>
               </td>
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />
        <?php echo user_name($row['mor_cod_m'])?><br />
        <?php echo $row['mor_cod_m']?><br />

        <?php echo user_tel($row['mor_cod_m'])?></td>
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>

   </table>

<?php	
}
// پایان شرط صیفی
else 
{
?>
<br />
      <table width="85%"  align="center" class="my-table"  >
             <tr align="center" class="text1">
               <td height="55" colspan="3" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح برداشت<br />
                 <span class="style2">هکتار</span></td>
               <td rowspan="2" bgcolor="#999999">پیش بینی تولید <br />
                <span class="style2">تن</span> <br /></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت<br />
                <span class="style2">هکتار</span></td>
               <td width="7%" rowspan="2" bgcolor="#999999">تعداد قطعات</td>
               <td width="7%" rowspan="2" bgcolor="#999999">مشخصات کارشناس</td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="57" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="57" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="57" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">دیم</td>
               <td width="6%" bgcolor="#999999">آبی</td>
              </tr>
             <tr>
               <?php
// REMOVED: require_once("../../login/config.php"); - moved to the top of the file
  $query = "SELECT 
   cod_mah ,  mor_cod_m,count(*) as kol , 
    sum(zer_kesht_a) zer_k1,
    sum(CASE WHEN no_kesh = '1' THEN zer_kesht_a ELSE 0 END) as zer_k1_abi,
    sum(CASE WHEN no_kesh = '2' THEN zer_kesht_a ELSE 0 END) as zer_k1_dim,

    sum(zer_kesht_b) zer_k2,
    sum(CASE WHEN no_kesh = '1' THEN zer_kesht_b ELSE 0 END) as zer_k2_abi,
    sum(CASE WHEN no_kesh = '2' THEN zer_kesht_b ELSE 0 END) as zer_k2_dim,

    sum(s_bar_a) s_bar1,
    sum(CASE WHEN no_kesh = '1' THEN s_bar_a ELSE 0 END) as s_bar1_abi,
    sum(CASE WHEN no_kesh = '2' THEN s_bar_a ELSE 0 END) as s_bar1_dim,

    sum(s_bar_b) s_bar2,
    sum(CASE WHEN no_kesh = '1' THEN s_bar_b ELSE 0 END) as s_bar2_abi,
    sum(CASE WHEN no_kesh = '2' THEN s_bar_b ELSE 0 END) as s_bar2_dim,
	
    sum(mah_tolp) m_tolp, 
    sum(mah_tol) m_tol,
    sum(CASE WHEN no_kesh = '1' THEN mah_tol ELSE 0 END) as m_tol_abi,
    sum(CASE WHEN no_kesh = '2' THEN mah_tol ELSE 0 END) as m_tol_dim
FROM $Agri_prod_table 
where $Agri_prod_table.id_ostan = '$id_ostan1'  and $v_id_city and $v_id_mar and $v_cod_mah
GROUP BY mor_cod_m
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
$pic = user_pic($row['mor_cod_m']) ;
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="32" ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td width="6%" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['s_bar1']+$row['s_bar2']),1)*1 ; ?><br /></td>
               <td width="6%" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['s_bar1_dim']+$row['s_bar2_dim']),1)*1 ; ?><br /></td>
               <td width="7%" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['s_bar1_abi']+$row['s_bar2_abi']),1)*1 ; ?><br /></td>
               <td width="3%" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
               <td width="3%" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k1']+$row['zer_k2']),1)*1 ; ?><br /></td>
               <td width="6%" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k1_dim']+$row['zer_k2_dim']),1)*1 ; ?><br /></td>
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k1_abi']+$row['zer_k2_abi']),1)*1 ; ?><br /></td>
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                   <span class="kol-circle" onclick="openKolPopup('<?php echo htmlspecialchars($row['mor_cod_m'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($id_ostan1, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($id_city, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($id_mar, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($cod_mah, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($z_sal, ENT_QUOTES); ?>')">
                       <?php echo htmlspecialchars($row['kol'], ENT_QUOTES); ?>
                   </span>
               </td>
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />
        <?php echo user_name($row['mor_cod_m'])?><br />
        <?php echo $row['mor_cod_m']?><br />

        <?php echo user_tel($row['mor_cod_m'])?></td>
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>

   </table>
           <?php }}?>
    </td>
  </tr>
  </tr>
</table>
</div>
</body>
</html>