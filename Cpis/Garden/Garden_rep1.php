<?php 
include("../../lock_cp.php");
include("../../Jalali.php");
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
if ($id_ostan1 !== '') echo $id_ostan1;

$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
	text-align: center;
}

/* استایل جدید برای پیام انتظار */
#loading {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #CCC;
    padding: 20px;
    z-index: 1000;
    text-align: center;
	border-radius:15px ;
}
    </style>

<script>
function showLoading() {
    document.getElementById('loading').style.display = 'block';
}
</script>
</head>
<body>
  <!-- پیام انتظار -->
  <div id="loading">
    <img src="../../files/ajax_loader_red_512.gif" width="50" height="50" alt="Loading..." />
    <p style=" direction:rtl ;  color:#003366; font-weight:bold">لطفاً منتظر بمانید...</p>
  </div>

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
      </p>
<?
include('../../login/config.php');
?>
<form id="reg-form" method="post" action="#1" onsubmit="showLoading()">
  <p>&nbsp;</p>
  <div style="width: 450px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:15px" >
    <table width="100%" height="200" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style1">گزارش اطلاعات باغی استان به تفکیک شهرستان</span><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                   <?php
                   $id_ostan1 = $id_ostan ; ?>
                   <option value="0">انتخاب استان</option>
                   <?php
$query = "SELECT  id_ostan,ostan FROM ostanname "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                   <?php 
		   }?>
                 </select>
</td>
        <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                                         <select  name="z_sal" class="input_text"  id="id_ostan" style="width:170px ; height:40px" dir="rtl" >
                   <?php
                   $query = "SELECT  sal FROM b_sal ORDER BY sal desc"  ;
                   $stmt = $dbh->prepare($query);
                   $stmt->execute();
                   foreach($stmt as $row){
                   ?>
                     <option value="<?php echo $row['sal'] ;?>"
                    <?php if (isset($z_sal) && $row['sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['sal'] ;?></option>
                   <?php }?>
                 </select>


        </div></td>
        <td width="112"  align='center' bgcolor="#FFFFFF" class="style11"><span class="input_text"><font size="2" class="style8">: عملکرد سال</font></span></td>
      </tr>
      <tr >
        <td align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
        <td height="60"  align='center' bgcolor="#FFFFFF" class="style11">&nbsp;</td>
      </tr>
    </table>
  </div>
</form>
<?php 
   if (isset($_POST['z_sal']))
   {
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan1= $_POST['id_ostan'] ; 

?>
<table width="170" height="56" border="0" align="center">
  <tr>
               <td width="100"><form  action="Garden_rep2_xls.php" method="post">
                 <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan ;?>" />
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="43" height="49"  alt=""/></button>
               </form></td>
               <td width="90"><form  action="Garden_rep1_doc.php" method="post">
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل اکسل"  width="42" height="49"  alt=""/></button>
               </form></td>
             </tr>
         </table>
<?php
include('../../login/config.php');

// کوئری اصلی با JOIN
$main_query = "
SELECT 
    c.id_city, 
    c.city,
    -- میزان تولید
    SUM(gp.mah_tol) as kol_mah,
    SUM(CASE WHEN g.no_kesh = '2' THEN gp.mah_tol ELSE 0 END) as mah_dim,
    SUM(CASE WHEN g.no_kesh = '1' THEN gp.mah_tol ELSE 0 END) as mah_abi,
    
    -- نحوه کاشت
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '3' THEN g.id END) as nah_parakande,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '2' THEN g.id END) as nah_makhloot,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '1' THEN g.id END) as nah_sade,
    
    -- تعداد درخت
    SUM(gp.tree_b + gp.tree_gb) / 1000 as kol_darakt,
    SUM(gp.tree_gb) / 1000 as darakt_ghbar,
    SUM(gp.tree_b) / 1000 as darakt_bar,
    
    -- سطح زیر کشت
    SUM(gp.s_kesht_b + gp.s_kesht_gb) as kol_kesht,
    SUM(gp.s_kesht_gb) as kesht_ghbar,
    SUM(gp.s_kesht_b) as kesht_bar,
    
    -- تعداد قطعات باغی
    COUNT(DISTINCT g.id) as kol_garden,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '2' THEN g.id END) as garden_dim,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '1' THEN g.id END) as garden_abi
FROM 
    cityname c
LEFT JOIN 
    Garden g ON c.id_city = g.id_city AND g.id_ostan = :id_ostan AND g.z_sal = :z_sal
LEFT JOIN 
    Garden_prod gp ON g.id = gp.garden_id
WHERE 
    c.id_ostan = :id_ostan
GROUP BY 
    c.id_city, c.city
ORDER BY 
    c.id_city";

// اجرای کوئری اصلی
$stmt = $dbh->prepare($main_query);
$stmt->execute(array(':id_ostan' => $id_ostan, ':z_sal' => $z_sal));
$city_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// کوئری برای جمع کل استان
$total_query = "
SELECT 
    SUM(gp.mah_tol) as kol_mah,
    SUM(CASE WHEN g.no_kesh = '2' THEN gp.mah_tol ELSE 0 END) as mah_dim,
    SUM(CASE WHEN g.no_kesh = '1' THEN gp.mah_tol ELSE 0 END) as mah_abi,
    
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '3' THEN g.id END) as nah_parakande,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '2' THEN g.id END) as nah_makhloot,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '1' THEN g.id END) as nah_sade,
    
    SUM(gp.tree_b + gp.tree_gb) / 1000 as kol_darakt,
    SUM(gp.tree_gb) / 1000 as darakt_ghbar,
    SUM(gp.tree_b) / 1000 as darakt_bar,
    
    SUM(gp.s_kesht_b + gp.s_kesht_gb) as kol_kesht,
    SUM(gp.s_kesht_gb) as kesht_ghbar,
    SUM(gp.s_kesht_b) as kesht_bar,
    
    COUNT(DISTINCT g.id) as kol_garden,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '2' THEN g.id END) as garden_dim,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '1' THEN g.id END) as garden_abi
FROM 
    Garden g
JOIN 
    Garden_prod gp ON g.id = gp.garden_id
WHERE 
    g.id_ostan = :id_ostan AND g.z_sal = :z_sal";

$stmt = $dbh->prepare($total_query);
$stmt->execute(array(':id_ostan' => $id_ostan, ':z_sal' => $z_sal));
$total_data = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<table  align="center" class="my-table" >
    <thead class="fixedHeader">
        <tr align="center" class="alternateRow">
            <td height="55" colspan="3" bgcolor="#999999">میزان تولید<br /><span class="style2">تن</span></td>
            <td colspan="3" bgcolor="#999999">نحوه کاشت<br /></td>
            <td colspan="3" bgcolor="#999999">تعداد درخت<br /><span class="style2">هزار اصله</span></td>
            <td colspan="3" bgcolor="#999999">سطح زیر کشت<br /><span class="style2">هکتار</span></td>
            <td height="55" colspan="3" bgcolor="#999999">تعداد قطعات باغی<br /><span class="style2">قطعه</span></td>
            <td width="7%" rowspan="2" bgcolor="#999999">شهرستان</td>
            <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
        </tr>
        <tr align="center" class="text1">
            <td height="57" bgcolor="#999999">کل</td>
            <td bgcolor="#999999">دیم</td>
            <td bgcolor="#999999">آبی</td>
            <td width="5%" height="57" bgcolor="#999999">پراکنده</td>
            <td width="6%" bgcolor="#999999">مخلوط</td>
            <td width="5%" bgcolor="#999999">ساده</td>
            <td height="57" bgcolor="#999999">کل</td>
            <td bgcolor="#999999">غیربارور</td>
            <td bgcolor="#999999">بارور</td>
            <td height="57" bgcolor="#999999">کل</td>
            <td bgcolor="#999999">غیربارور</td>
            <td width="6%" bgcolor="#999999">بارور</td>
            <td width="6%" height="57" bgcolor="#999999">کل</td>
            <td width="5%" bgcolor="#999999">دیم</td>
            <td width="5%" bgcolor="#999999">آبی</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $r = 1;
        foreach ($city_data as $row) {
            $bgcolor = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : '';
        ?>
        <tr>
            <!-- میزان تولید -->
            <td <?= $bgcolor ?> width="5%" height="26"><?= Num2Fa(round($row['kol_mah']*1, 1)) ?></td>
            <td <?= $bgcolor ?> width="5%"><?= Num2Fa(round($row['mah_dim']*1, 1)) ?></td>
            <td <?= $bgcolor ?> width="5%"><?= Num2Fa(round($row['mah_abi']*1, 1)) ?></td>
            
            <!-- نحوه کاشت -->
            <td <?= $bgcolor ?>><?= Num2Fa($row['nah_parakande']) ?></td>
            <td <?= $bgcolor ?>><?= Num2Fa($row['nah_makhloot']) ?></td>
            <td <?= $bgcolor ?>><?= Num2Fa($row['nah_sade']) ?></td>
            
            <!-- تعداد درخت -->
            <td width="6%" <?= $bgcolor ?>><?= Num2Fa(round($row['kol_darakt'], 1)) ?></td>
            <td width="6%" <?= $bgcolor ?>><?= Num2Fa(round($row['darakt_ghbar'], 1)) ?></td>
            <td width="7%" <?= $bgcolor ?>><?= Num2Fa(round($row['darakt_bar'], 1)) ?></td>
            
            <!-- سطح زیر کشت -->
            <td width="6%" <?= $bgcolor ?>><?= Num2Fa(round($row['kol_kesht'], 1)) ?></td>
            <td width="6%" <?= $bgcolor ?>><?= Num2Fa(round($row['kesht_ghbar'], 1)) ?></td>
            <td <?= $bgcolor ?>><?= Num2Fa(round($row['kesht_bar'], 1)) ?></td>
            
            <!-- تعداد قطعات باغی -->
            <td <?= $bgcolor ?>><?= Num2Fa($row['kol_garden']) ?></td>
            <td <?= $bgcolor ?>><?= Num2Fa($row['garden_dim']) ?></td>
            <td <?= $bgcolor ?>><?= Num2Fa($row['garden_abi']) ?></td>
            
            <td <?= $bgcolor ?>><?= $row['city'] ?></td>
            <td <?= $bgcolor ?>><?= $r ?></td>
        </tr>
        <?php
            $r++;
        }
        ?>
        
        <!-- ردیف جمع کل استان -->
        <tr>
            <?php
            $bgcolor = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : '';
            ?>
            <!-- میزان تولید -->
            <td <?= $bgcolor ?> width="5%" height="27"><?= Num2Fa(round($total_data['kol_mah']*1, 1)) ?></td>
            <td <?= $bgcolor ?> width="5%"><?= Num2Fa(round($total_data['mah_dim']*1, 1)) ?></td>
            <td <?= $bgcolor ?> width="5%"><?= Num2Fa(round($total_data['mah_abi']*1, 1)) ?></td>
            
            <!-- نحوه کاشت -->
            <td <?= $bgcolor ?>><?= Num2Fa($total_data['nah_parakande']) ?></td>
            <td <?= $bgcolor ?>><?= Num2Fa($total_data['nah_makhloot']) ?></td>
            <td <?= $bgcolor ?>><?= Num2Fa($total_data['nah_sade']) ?></td>
            
            <!-- تعداد درخت -->
            <td width="6%" <?= $bgcolor ?>><?= Num2Fa(round($total_data['kol_darakt'], 1)) ?></td>
            <td width="6%" <?= $bgcolor ?>><?= Num2Fa(round($total_data['darakt_ghbar'], 1)) ?></td>
            <td width="7%" <?= $bgcolor ?>><?= Num2Fa(round($total_data['darakt_bar'], 1)) ?></td>
            
            <!-- سطح زیر کشت -->
            <td width="6%" <?= $bgcolor ?>><?= Num2Fa(round($total_data['kol_kesht'], 1)) ?></td>
            <td width="6%" <?= $bgcolor ?>><?= Num2Fa(round($total_data['kesht_ghbar'], 1)) ?></td>
            <td <?= $bgcolor ?>><?= Num2Fa(round($total_data['kesht_bar'], 1)) ?></td>
            
            <!-- تعداد قطعات باغی -->
            <td <?= $bgcolor ?>><?= Num2Fa($total_data['kol_garden']) ?></td>
            <td <?= $bgcolor ?>><?= Num2Fa($total_data['garden_dim']) ?></td>
            <td <?= $bgcolor ?>><?= Num2Fa($total_data['garden_abi']) ?></td>
            
            <td colspan="2" class="style1" <?= $bgcolor ?>>کل استان</td>
        </tr>
    </tbody>
</table>
</div>
<?php }?>
           <p>&nbsp;</p>
           <p> <p><a href="Garden.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>