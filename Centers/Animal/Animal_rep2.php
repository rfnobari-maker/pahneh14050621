<?php 
include('../../lock_p2.php');
include('../../event.php');
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if(isset($_POST['sal'])) $sal = $_POST['sal'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
width:50px
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
</style>
  <script>
function target_po2(form) {
    window.open('null', 'formpopup', 'width=500,height=230,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_po3(form) {
    window.open('null', 'formpopup', 'width=1050,height=1400,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>

</head>
<body>
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
        <p class="style1">گزارش تعداد دام بر حسب گونه </p>
        <div style=" width: 400px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1 ; border-radius:10px" >
          <form method="post" name="form1" id="form"  action="#1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="55%" height="63"><div align="right">
                  <?php $id_ostan1 = $id_ostan?>
                  <select  name="id_ostan" disabled="disabled" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
                   <option value="">کل کشور</option>
                    <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                    <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                    <?php 
		   }?>
                  </select>
                </div></td>
                <td width="45%" class="style8">: انتخاب نام استان</td>
              </tr>
              <tr>
                <td height="68"><div align="right">
                  <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
                    <option value="1403"<?php if ($sal=='1403') echo 'selected=selected'?>>1403</option>
                  </select>
                </div></td>
                <td class="style8"> : انتخاب سال</td>
              </tr>
            </table>
            <p>
              <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
            </p>
          </form>
      </div>
        <p>
  <?php if(isset($_POST['action']) and (isset($_POST['sal'])))
{
	include_once('../../login/config.php');
$sal = $_POST['sal'];
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if ($id_ostan1 == '') 
{
 $query = "SELECT 
    SUM(CASE WHEN an.species = '1' THEN an.quantity ELSE 0 END) AS kol_1,
    SUM(CASE WHEN an.species = '2' THEN an.quantity ELSE 0 END) AS kol_2,
    SUM(CASE WHEN an.species = '3' THEN an.quantity ELSE 0 END) AS kol_3,
    SUM(CASE WHEN an.species = '4' THEN an.quantity ELSE 0 END) AS kol_4,
    SUM(CASE WHEN an.species = '5' THEN an.quantity ELSE 0 END) AS kol_5,
    SUM(CASE WHEN an.species = '6' THEN an.quantity ELSE 0 END) AS kol_6,
    SUM(CASE WHEN an.species = '7' THEN an.quantity ELSE 0 END) AS kol_7,
    SUM(CASE WHEN an.species = '8' THEN an.quantity ELSE 0 END) AS kol_8,
    SUM(CASE WHEN an.species = '9' THEN an.quantity ELSE 0 END) AS kol_9,
au.id_ostan
FROM 
    animals_unit au
INNER JOIN 
    animals an 
ON 
    au.PartIdCode = an.PartIdCode
WHERE 
    an.sal = '$sal'
GROUP BY 
    au.id_ostan  ORDER BY  FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21')" ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT
    au.id_city , au.id_mar , 
    SUM(CASE WHEN an.species = '1' THEN an.quantity ELSE 0 END) AS kol_1,
    SUM(CASE WHEN an.species = '2' THEN an.quantity ELSE 0 END) AS kol_2,
    SUM(CASE WHEN an.species = '3' THEN an.quantity ELSE 0 END) AS kol_3,
    SUM(CASE WHEN an.species = '4' THEN an.quantity ELSE 0 END) AS kol_4,
    SUM(CASE WHEN an.species = '5' THEN an.quantity ELSE 0 END) AS kol_5,
    SUM(CASE WHEN an.species = '6' THEN an.quantity ELSE 0 END) AS kol_6,
    SUM(CASE WHEN an.species = '7' THEN an.quantity ELSE 0 END) AS kol_7,
    SUM(CASE WHEN an.species = '8' THEN an.quantity ELSE 0 END) AS kol_8,
    SUM(CASE WHEN an.species = '9' THEN an.quantity ELSE 0 END) AS kol_9,
au.id_ostan
FROM 
    animals_unit au
INNER JOIN 
    animals an 
ON 
    au.PartIdCode = an.PartIdCode
WHERE 
   sal = '$sal' and id_ostan = '$id_ostan1' and id_city = '$id_city' and id_mar = '$id_mar'
group by id_mar "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
        <span class="style21"><a name="1" id="1"></a></span>
        <table width="69" height="56" border="0" align="center">
          <tr>
            <td width="63"><form  action="Animal_rep2_xls.php" method="post">
              <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
              <input type="hidden" name="sal" value="<?php echo  $sal ;?>" />
              <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
            </form></td>
          </tr>
        </table>
      <table width="90%" align="center" class="my-table"  >
             <tr align="center" class="text1">
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">سگ</td>
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">قاطر</td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">استر</td>
               <td width="11%" bordercolor="#0099CC" bgcolor="#999999">اسب</td>
               <td width="10%" height="43" bordercolor="#0099CC" bgcolor="#999999">بز</td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">گوسفند</td>
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">شتر</td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">گاومیش</td>
               <td width="10%" bordercolor="#0099CC" bgcolor="#999999">گاو</td>
               <td width="14%" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'مرکز جهاد کشاورزی'  ; ?>
                 <br /></td>
               <td width="4%" bgcolor="#999999">ردیف</td>
              </tr>
             <tr>
               <?php
$r = 1 ;
  foreach($stmt as $row){
 ?>
               
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_9']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_8']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_7']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_6']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_5']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_4']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_3']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_2']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_1']?></td>
               <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >
                 <?php if($id_ostan1=='') echo ostan_name($row['id_ostan']) ;  else echo mar_name($row['id_mar'])  ; ?>
               <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
if ($id_ostan1 == '') 
{
 $query = "SELECT 
    SUM(CASE WHEN an.species = '1' THEN an.quantity ELSE 0 END) AS kol_1,
    SUM(CASE WHEN an.species = '2' THEN an.quantity ELSE 0 END) AS kol_2,
    SUM(CASE WHEN an.species = '3' THEN an.quantity ELSE 0 END) AS kol_3,
    SUM(CASE WHEN an.species = '4' THEN an.quantity ELSE 0 END) AS kol_4,
    SUM(CASE WHEN an.species = '5' THEN an.quantity ELSE 0 END) AS kol_5,
    SUM(CASE WHEN an.species = '6' THEN an.quantity ELSE 0 END) AS kol_6,
    SUM(CASE WHEN an.species = '7' THEN an.quantity ELSE 0 END) AS kol_7,
    SUM(CASE WHEN an.species = '8' THEN an.quantity ELSE 0 END) AS kol_8,
    SUM(CASE WHEN an.species = '9' THEN an.quantity ELSE 0 END) AS kol_9,
au.id_ostan
FROM 
    animals_unit au
INNER JOIN 
    animals an 
ON 
    au.PartIdCode = an.PartIdCode
WHERE 
    an.sal = '$sal' "  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT 
        SUM(CASE WHEN an.species = '1' THEN an.quantity ELSE 0 END) AS kol_1,
    SUM(CASE WHEN an.species = '2' THEN an.quantity ELSE 0 END) AS kol_2,
    SUM(CASE WHEN an.species = '3' THEN an.quantity ELSE 0 END) AS kol_3,
    SUM(CASE WHEN an.species = '4' THEN an.quantity ELSE 0 END) AS kol_4,
    SUM(CASE WHEN an.species = '5' THEN an.quantity ELSE 0 END) AS kol_5,
    SUM(CASE WHEN an.species = '6' THEN an.quantity ELSE 0 END) AS kol_6,
    SUM(CASE WHEN an.species = '7' THEN an.quantity ELSE 0 END) AS kol_7,
    SUM(CASE WHEN an.species = '8' THEN an.quantity ELSE 0 END) AS kol_8,
    SUM(CASE WHEN an.species = '9' THEN an.quantity ELSE 0 END) AS kol_9,
au.id_ostan
FROM 
    animals_unit au
INNER JOIN 
    animals an 
ON 
    au.PartIdCode = an.PartIdCode
WHERE 
    an.sal = '$sal' and id_ostan = '$id_ostan1' and id_city = '$id_city' and id_mar = '$id_mar' "  ;
}
?>
             <tr align="center" class="text1">
               <td bordercolor="#0099CC" bgcolor="#999999">سگ</td>
               <td bordercolor="#0099CC" bgcolor="#999999">قاطر</td>
               <td bordercolor="#0099CC" bgcolor="#999999">استر</td>
               <td bordercolor="#0099CC" bgcolor="#999999">اسب</td>
               <td height="43" bordercolor="#0099CC" bgcolor="#999999">بز</td>
               <td bordercolor="#0099CC" bgcolor="#999999">گوسفند</td>
               <td bordercolor="#0099CC" bgcolor="#999999">شتر</td>
               <td bordercolor="#0099CC" bgcolor="#999999">گاومیش</td>
               <td bordercolor="#0099CC" bgcolor="#999999">گاو</td>
               <td colspan="2" bgcolor="#999999">&nbsp;</td>
             </tr>

<?php
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

             <tr>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_9']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_8']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_7']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_6']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_5']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_4']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_3']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_2']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_1']?></td>
               <td colspan="2"   <?php  echo 'bgcolor=#ffcc99' ?>>&nbsp;</td>
             </tr>
         </table>
<?php }?>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
<p>&nbsp;</p>

      <p>&nbsp;</p>
           <p> <p><a href="./index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html><?php
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
        30 => 'واحد پرورش دام مستقر در مجموعه دامپروري',
    	101=> 'دام صنعتی و نیمه صنعتی' ,
		110=> 'دامداری عشایری' ,
		111=> 'دامداری روستایی و غیرصنعتی'

    );
    // بازگشت ترجمه کد واحد
    return isset($unitTypes[$unitType]) ? $unitTypes[$unitType] : 'نوع واحد نامشخص';
}

// تابع برای ترجمه وضعیت پروانه
function translateLicenseStatus($licenseStatus) {
    $status = array(
        1 => 'دارای پروانه/ مجوز',
        2 => 'فاقد پروانه/ مجوز'
    );

    // بازگشت ترجمه کد وضعیت پروانه
    return isset($status[$licenseStatus]) ? $status[$licenseStatus] : 'وضعیت نامشخص';
}
?>
 <?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>