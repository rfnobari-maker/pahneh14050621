<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
if (isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if (isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'];
if (isset($_POST['sal'])) $sal = $_POST['sal'];

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
.new-table th, .new-table td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: center;
}
.new-table th {
    background-color: #006699;
    color: #fff;
}
.new-table tr:nth-child(even) {
    background-color: #f2f2f2;
}
.new-table tr:nth-child(odd) {
    background-color: #fff;
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
    <td  colspan="3" valign="middle" >
  <p class="style1"><br />
  </p>
  <div style="direction:rtl; text-align:center;">
    <h2 style="color: #003366;">آمار نهائی تجهیزات </h2>
  </div>
  <p class="style1"><span class="style8">غیر مهاجر استان + مهاجر استان - مهاجر سایر استان ها </span></p>
      <form  id="reg-form" method="post" action="#1">
  <div style="width: 400px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <table width="100%" height="234" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="49" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
            <option value="1404" <?php if (isset($sal) && $sal=='1404') echo 'selected=selected'?>>1404</option>
            <option value="1403" <?php if (isset($sal) && $sal=='1403') echo 'selected=selected'?>>1403</option>
            <option value="1402" <?php if (isset($sal) && $sal=='1402') echo 'selected=selected'?>>1402</option>
            <option value="1401" <?php if (isset($sal) && $sal=='1401') echo 'selected=selected'?>>1401</option>
            <option value="1398" <?php if (isset($sal) && $sal=='1398') echo 'selected=selected'?>>1398</option>
            <option value="1397" <?php if (isset($sal) && $sal=='1397') echo 'selected=selected'?>>1397</option>
            </select>
          </div></td>
        <td  align='center' bgcolor="#DDDDDD" class="style8">: سرشماری سال</td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="49" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
          <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
          <?php 
		   }?>
          </select>
          <?php 
				   if (isset($_POST['id_ostan']))
  $id_ostan1= $_POST['id_ostan'] ; 
?></td>
        <td  align='center' bgcolor="#FFFFFF" class="style8">: استان<span class="style1"><a name="1" id="12"></a></span></td>
        </tr>
      <tr >
        <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo isset($bah_cod_m) ? $bah_cod_m : ''; ?>" />
        </div></td>
        <td height="54"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">: کد ملی بهره بردار</font></td>
      </tr>
      <tr >
        <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
      </tr>
    </table>
  </div>
   </form>
  <p>
  <?php if(isset($_POST['action']))
{
 if ($id_ostan1 == '-1')    { $v_id_ostan   = 1 ;}else{ $v_id_ostan = "(((bee.id_ostan='$id_ostan1') and (bee.m_ostan='$id_ostan1' or bee.m_ostan='-'))
 or (bee.id_ostan != '$id_ostan1' and bee.m_ostan = '$id_ostan1'))" ;}
 if ($bah_cod_m == '')      { $v_bah_cod_m  = 1 ;}else{ $v_bah_cod_m = "bee.bah_cod_m = '$bah_cod_m'" ;}
 if ($sal == '')            { $v_sal        = 1 ;}else{ $v_sal       = "bee.sal = '$sal'" ;}
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
} else {
    $id = 1;
}

// Start of new section
?>
<br />
<?php
$query = "SELECT 
count(*) zan,
sum(t_sha) t_sh ,
count(CASE WHEN bee.bem_zan!='3' THEN 1  END )  t_zanB ,
count(CASE WHEN bee.bem_kand='1' THEN 1  END )  t_kandB ,
SUM(t_gar) AS kol_t_gar ,SUM(t_bar) AS kol_t_bar ,SUM(t_mom) AS kol_t_mom ,SUM(t_jel) AS kol_t_jel 
,SUM(t_zah) AS kol_t_zah,SUM(t_nan) AS kol_t_nan,SUM(tk_bo) AS kol_k_bo ,SUM(tk_mo) AS kol_k_mo,SUM(to_bo) AS kol_t_bo,
SUM(to_mo) AS kol_t_mo from bee where  $v_id_ostan  and $v_sal and $v_bah_cod_m" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_k_bo = $row['kol_k_bo'];
$kol_k_mo = $row['kol_k_mo'] ; 
$kol_t_bo = $row['kol_t_bo'];
$kol_t_mo = $row['kol_t_mo'] ; 
$kol_to = round(($kol_t_mo + $kol_t_bo),2) ;
$kol_tk = round(($kol_k_mo + $kol_k_bo),2) ;
$av_to_mo = ($kol_k_mo != 0) ? round(($kol_t_mo / $kol_k_mo),2) : 0;
$av_to_bo = ($kol_k_bo != 0) ? round(($kol_t_bo / $kol_k_bo),2) : 0;
?>
  <table width="90%" align="center" class="my-table"  >
    <tr align="center" class="text1">
    <td colspan="6" bgcolor="#6699CC">تولید سایر فرآورده های جانبی<br />
Kg<br /></td>
    <td colspan="3" bgcolor="#6699CC">تولید عسل<br />
      <span class="style8">      میانگین</span><br />
      Kg</td>
    <td height="60" colspan="3" bgcolor="#6699CC">تعداد کندو</td>
    <td colspan="2" bgcolor="#6699CC">تعداد تحت پوشش بیمه</td>
    <td colspan="2" bgcolor="#6699CC">تعداد</td>
    </tr>
  <tr align="center" class="text1">
    <td bgcolor="#6699CC">نان زنبور</td>
    <td bgcolor="#6699CC">زهر</td>
    <td height="35" bgcolor="#6699CC">بره موم</td>
    <td bgcolor="#6699CC">موم</td>
    <td bgcolor="#6699CC">گرده گل </td>
    <td width="8%" bgcolor="#6699CC">ژله رویال</td>
    <td width="6%" bgcolor="#6699CC">جمع</td>
    <td width="7%" bgcolor="#6699CC">مدرن</td>
    <td width="11%" bgcolor="#6699CC">سنتی</td>
    <td width="6%" bgcolor="#6699CC">جمع</td>
    <td width="7%" bgcolor="#6699CC">مدرن</td>
    <td width="7%" bgcolor="#6699CC">سنتی</td>
    <td width="7%"  bgcolor="#6699CC">زنبورستان</td>
    <td width="6%"  bgcolor="#6699CC">زنبوردار</td>
    <td width="6%"  bgcolor="#6699CC">افراد شاغل</td>
    <td width="7%"  bgcolor="#6699CC">زنبورستان</td>
    </tr>
  <tr>
    <td width="7%"  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round($row['kol_t_bar'],0) ?></span></td>
    <td width="7%"  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round(($row['kol_t_zah']/1000),3) ?></span></td>
    <td width="7%" height="58"  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round($row['kol_t_bar'],0) ?></span></td>
    <td width="8%"  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round($row['kol_t_mom'],0) ?></span></td>
    <td width="7%"  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round($row['kol_t_gar'],0) ?></span></td>
    <td  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round(($row['kol_t_jel']/1000),3) ?></span></td>
    <td  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $kol_to ?></span></td>
    <td  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($kol_t_mo,0) ; ?><br />
      <?php echo $av_to_mo ?></td>
    <td  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($kol_t_bo,0) ; ?><br />
      <?php echo $av_to_bo ?></td>
    <td  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $kol_tk ?></span></td>
    <td  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $kol_k_mo ;  ?></td>
    <td  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $kol_k_bo ; ?></td>
    <td  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_kandB'] ; ?></td>
    <td  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_zanB'] ; ?></td>
    <td  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh'] ; ?></td>
    <td  class="normalTextSmaller" <?php if(0%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
    </tr>
</table>
<br /><hr>
<br />
<?php
// Count total beekeepers for the selected criteria
 $total_count_query = "SELECT COUNT(*) AS `total`
                     FROM `bee`
                     Right JOIN `bee_equipment` AS t2 ON bee.unique_id = t2.unique_id
                     WHERE $v_id_ostan AND $v_sal AND $v_bah_cod_m";
$total_stmt = $dbh->prepare($total_count_query);
$total_stmt->execute();
$total_row = $total_stmt->fetch(PDO::FETCH_ASSOC);
$total_beekeepers = (int)$total_row['total'];
?>
<div style="direction:rtl; text-align:center;">
    <h2 style="color: #003366;">آمار تجهیزات استان : <?php echo ostan_name($id_ostan1) ;?> تعداد پرسشنامه تکمیل شده : <?php echo $total_beekeepers?></h2>
</div>
<br />
<table width="90%" align="center" class="my-table new-table" >
    <tr class="text1">
        <td colspan="2" bgcolor="#006699">لازم هست</td>
        <td colspan="2" bgcolor="#006699">ناموجود</td>
        <td colspan="2" bgcolor="#006699">موجود</td>
        <td width="27%" rowspan="2" bgcolor="#006699">نام تجهیزات</td>
        <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
    </tr>
    <tr class="text1">
      <td width="13%" bgcolor="#006699">درصد</td>
      <td width="11%" bgcolor="#006699">تعداد</td>
        <td width="13%" bgcolor="#006699">درصد</td>
        <td width="11%" bgcolor="#006699">تعداد</td>
        <td width="10%" bgcolor="#006699">درصد</td>
        <td width="10%" bgcolor="#006699">تعداد</td>
    </tr>
<?php
// Define equipment names
$equip_names = array(
    'کندو کف باز',
    'اکستراکتور برقی',
    'اکستراکتور دستی',
    'دستگاه برداشت ژله رویال اتوماتیک',
    'موم دوز برقی',
    'دستگاه پرکن عسل اتوماتیک',
    'صافی عسل',
    'رس گیر عسل گازی',
    'خرک برداشت عسل مخزن دار',
    'دستگاه تصعید اسید اگزالیک برقی',
    'دستگاه زهرگیر',
    'خرک برداشت عسل پایه دار',
    'دستگاه پرس موم',
    'دستگاه استحصال نان زنبور',
    'دستگاه تمیزکننده گرده گل',
    'دستگاه مه پاش',
    'سیستم کنترل هوشمند دمای کندو',
    'دستگاه رطوبت گیر عسل',
    'دستگاه تغلیظ کننده عسل اتوماتیک'
);


// Loop through each equipment item and calculate percentages
for ($i = 2; $i <= 20; $i++) {
    $equip_exists_field = "taj_" . $i . "_exists";
    $equip_needed_field = "taj_" . $i . "_needed";

    // Query to count beekeepers who have the equipment
    $exists_query = "SELECT COUNT(*) AS `exists_count`
                     FROM `bee`
                     LEFT JOIN `bee_equipment` AS t2 ON bee.unique_id = t2.unique_id
                     WHERE $v_id_ostan AND $v_sal AND $v_bah_cod_m AND t2.`$equip_exists_field` = 1";

    $exists_stmt = $dbh->prepare($exists_query);
    $exists_stmt->execute();
    $exists_data = $exists_stmt->fetch(PDO::FETCH_ASSOC);
    $exists_count = (int)$exists_data['exists_count'];
    // Query to count beekeepers who have and need the equipment
    $needed_query = "SELECT COUNT(*) AS `needed_count`
                     FROM `bee`
                     LEFT JOIN `bee_equipment` AS t2 ON bee.unique_id = t2.unique_id
                     WHERE $v_id_ostan AND $v_sal AND $v_bah_cod_m AND t2.`$equip_exists_field` = 0 AND t2.`$equip_needed_field` = 1";

    $needed_stmt = $dbh->prepare($needed_query);
    $needed_stmt->execute();
    $needed_data = $needed_stmt->fetch(PDO::FETCH_ASSOC);
    $needed_count = (int)$needed_data['needed_count'];

    // Calculate percentages based on your new logic
    $exists_percent = ($total_beekeepers > 0) ? round(($exists_count / $total_beekeepers) * 100, 2) : 0;
    $needed_percent = ($total_beekeepers > 0) ? round(($needed_count / ($total_beekeepers-$exists_count)) * 100, 2) : 0;
?>
    <tr>
        <td>%<?php echo $needed_percent; ?></td>
        <td><?php echo $needed_count; ?></td>
        <td>%<?php echo round(100 - $exists_percent,2); ?></td>
        <td><?php echo $total_beekeepers - $exists_count; ?></td>
        <td>%<?php echo $exists_percent; ?></td>
        <td><?php echo $exists_count; ?></td>
        <td style="text-align: right;"><?php echo $equip_names[$i-2]; ?></td>
        <td><?php echo $i-1; ?></td>
    </tr>
<?php
}
?>
</table>
<br />
<?php 
}
?>
</td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>