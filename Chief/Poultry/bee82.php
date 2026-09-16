<?php
require_once("../../lock_ce.php");
require_once('../side_menu1.php');
require_once('bee_counter.php');
if(isset($_POST['sal'])) $sal = $_POST['sal'];
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
</style>
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
        <p class="style1">آمار زنبوردار ها به تفکیک استان</p>
        <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<div style=" width: 400px; padding: 0px; border-radius:10px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
<form method="post" name="form1" id="form"  action="#1">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="64%" height="68"><div align="right">
                <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
                    <option value="1404"<?php if ($sal=='1404') echo 'selected=selected'?>>1404</option>
                    <option value="1403"<?php if ($sal=='1403') echo 'selected=selected'?>>1403</option>
                    <option value="1402"<?php if ($sal=='1402') echo 'selected=selected'?>>1402</option>
                    <option value="1401"<?php if ($sal=='1401') echo 'selected=selected'?>>1401</option>
                    <option value="1398"<?php if ($sal=='1398') echo 'selected=selected'?>>1398</option>
                    <option value="1397"<?php if ($sal=='1397') echo 'selected=selected'?>>1397</option>
                </select>
              </div></td>
              <td width="36%" class="style8"> : سرشماری سال </td>
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
	include('../../login/config.php');
$query_ostan = "SELECT * from ostanname where 1 order by binary ostanname.ostan"  ;
$stmt_ostan = $dbh->prepare($query_ostan);
$stmt_ostan->execute();
?>
  <span class="style21"><a name="1" id="1"></a></span>
  <table width="69" height="56" border="0" align="center">
    <tr>
      <td width="63"><form  action="bee72_xls.php" method="post">
        <input type="hidden" name="sal"       value="<?php echo  $sal ;?>" />
        <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
      </form></td>
      </tr>
  </table>
           <table width="90%"  align="center" class="my-table">
             <tr align="center" class="text1">
               <td colspan="6" rowspan="2" bgcolor="#669999">میزان تولید سایر فرآورده ها<br />
Kg</td>
               <td colspan="2" rowspan="2" bgcolor="#669999">عسل تولیدی<span class="style2"><br />
               </span>
Kg</td>
               <td colspan="2" rowspan="2" bgcolor="#669999">تعداد کندو</td>
               <td width="4%" rowspan="3" bgcolor="#669999">عنوان</td>
               <td height="42" colspan="5" bgcolor="#669999">تعداد زنبورستان</td>
    <td width="11%" rowspan="3" bgcolor="#669999">استان  </td>
    <td width="5%" rowspan="3" bgcolor="#669999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td width="6%" rowspan="2" bgcolor="#669999">کل</td>
               <td width="6%" rowspan="2" bgcolor="#669999">حقوقی</td>
               <td height="40" colspan="3" bgcolor="#669999">حقیقی</td>
             </tr>
             <tr align="center" class="text1">
               <td bgcolor="#669999">نان زنبور</td>
               <td width="1%" bgcolor="#669999">زهر</td>
               <td height="40" bgcolor="#669999">بره موم</td>
               <td bgcolor="#669999">موم</td>
               <td bgcolor="#669999">گرده گل </td>
               <td bgcolor="#669999">ژله رویال</td>
               <td bgcolor="#669999">مدرن</td>
               <td width="1%" bgcolor="#669999">سنتی</td>
               <td width="2%" bgcolor="#669999">مدرن</td>
               <td width="2%" bgcolor="#669999">سنتی</td>
               <td width="4%" bgcolor="#669999">جمع</td>
               <td width="5%" bgcolor="#669999">زن</td>
               <td width="3%" bgcolor="#669999">مرد</td>
             </tr>
             <?php
$r = 1 ;
$total_kol_t_nan = 0;
$total_kol_t_zah = 0;
$total_kol_t_bar = 0;
$total_kol_t_mom = 0;
$total_kol_t_gar = 0;
$total_kol_t_jel = 0;
$total_kol_t_mo = 0;
$total_kol_t_bo = 0;
$total_kol_k_mo = 0;
$total_kol_k_bo = 0;
$total_no_bah1 = 0;
$total_no_bah2 = 0;
$total_zan = 0;
$total_mard = 0;

 foreach($stmt_ostan as $row_ostan){
$id_ostan = $row_ostan['id_ostan'] ; 
$ostan = $row_ostan['ostan'] ; 
$query_data = "SELECT  
  SUM(CASE WHEN bah.jens   = '1' THEN 1 ELSE 0 END ) AS mard,
  SUM(CASE WHEN bah.jens   = '2' THEN 1 ELSE 0 END ) AS zan,
  SUM(CASE WHEN bah.no_bah = '1' THEN 1 ELSE 0 END ) AS no_bah1,
  SUM(CASE WHEN bah.no_bah = '2' THEN 1 ELSE 0 END ) AS no_bah2,
  SUM(t_nan) AS kol_t_nan,
  SUM(t_zah) AS kol_t_zah,
  SUM(t_bar) AS kol_t_bar,
  SUM(t_mom) AS kol_t_mom,
  SUM(t_gar) AS kol_t_gar,
  SUM(t_jel) AS kol_t_jel,
  SUM(to_mo) AS kol_t_mo,
  SUM(to_bo) AS kol_t_bo,
  SUM(tk_mo) AS kol_k_mo,
  SUM(tk_bo) AS kol_k_bo
FROM (
  SELECT DISTINCT 
    bee.bah_cod_m, 
    bee.num_bah, 
    bee.t_nan,
    bee.t_zah,
    bee.t_bar,
    bee.t_mom,
    bee.t_gar,
    bee.t_jel,
    bee.to_mo,
    bee.to_bo,
    bee.tk_mo,
    bee.tk_bo
  FROM bee
  WHERE (((bee.id_ostan='$id_ostan') AND (bee.m_ostan='$id_ostan' OR bee.m_ostan='-')) OR (bee.id_ostan != '$id_ostan' AND bee.m_ostan = '$id_ostan')) AND bee.sal = '$sal'
) AS bee
INNER JOIN bah ON bah.bah_cod_m = bee.bah_cod_m AND bah.num_bah = bee.num_bah
";
$stmt_data = $dbh->prepare($query_data);
$stmt_data->execute();
$row_data = $stmt_data->fetch(PDO::FETCH_ASSOC);

?>
             <tr class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
               <td align="center"><?php echo round($row_data['kol_t_nan'], 0); ?></td>
               <td align="center"><?php echo round($row_data['kol_t_zah']/1000, 3); ?></td>
               <td align="center"><?php echo round($row_data['kol_t_bar'], 0); ?></td>
               <td align="center"><?php echo round($row_data['kol_t_mom'], 0); ?></td>
               <td align="center"><?php echo round($row_data['kol_t_gar'], 0); ?></td>
               <td align="center"><?php echo round($row_data['kol_t_jel']/1000, 3); ?></td>
               <td align="center"><?php echo round($row_data['kol_t_mo'], 0); ?></td>
               <td align="center"><?php echo round($row_data['kol_t_bo'], 0); ?></td>
               <td align="center"><?php echo round($row_data['kol_k_mo'], 0); ?></td>
               <td align="center"><?php echo round($row_data['kol_k_bo'], 0); ?></td>
               <td align="center">کل</td>
               <td align="center"><?php echo $row_data['no_bah1'] + $row_data['no_bah2']; ?></td>
               <td align="center"><?php echo $row_data['no_bah2']; ?></td>
               <td align="center"><?php echo $row_data['no_bah1']; ?></td>
               <td align="center"><?php echo $row_data['zan']; ?></td>
               <td align="center"><?php echo $row_data['mard']; ?></td>
               <td align="center"><?php echo $ostan; ?></td>
               <td align="center"><?php echo $r; ?></td>
             </tr>
<?php
$r++ ; 
$total_kol_t_nan += $row_data['kol_t_nan'];
$total_kol_t_zah += $row_data['kol_t_zah'];
$total_kol_t_bar += $row_data['kol_t_bar'];
$total_kol_t_mom += $row_data['kol_t_mom'];
$total_kol_t_gar += $row_data['kol_t_gar'];
$total_kol_t_jel += $row_data['kol_t_jel'];
$total_kol_t_mo += $row_data['kol_t_mo'];
$total_kol_t_bo += $row_data['kol_t_bo'];
$total_kol_k_mo += $row_data['kol_k_mo'];
$total_kol_k_bo += $row_data['kol_k_bo'];
$total_no_bah1 += $row_data['no_bah1'];
$total_no_bah2 += $row_data['no_bah2'];
$total_zan += $row_data['zan'];
$total_mard += $row_data['mard'];
}
?>
    <tr>
      <td height="38" colspan="6" rowspan="2" align="center" bgcolor="#669999" class="text1">میزان تولید سایر فرآورده ها<br />
Kg</td>
      <td colspan="2" rowspan="2" align="center" bgcolor="#669999" class="text1">عسل تولیدی<span class="style2"><br />
      </span> Kg</td>
      <td colspan="2" rowspan="2" align="center" bgcolor="#669999" class="text1">تعداد کندو</td>
      <td rowspan="3" align="center" bgcolor="#669999" class="text1">عنوان</td>
      <td height="38" colspan="5" bgcolor="#669999"  class="text1">تعداد زنبورستان</td>
      <td colspan="2" rowspan="6" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل</td>
    </tr>
    <tr>
      <td height="38" rowspan="2" align="center" bgcolor="#669999" class="text1">کل</td>
      <td rowspan="2" align="center" bgcolor="#669999" class="text1">حقوقی</td>
      <td colspan="3" align="center" bgcolor="#669999" class="text1">حقیقی</td>
      </tr>
    <tr>
      <td align="center" bgcolor="#669999" class="text1">نان زنبور</td>
      <td align="center" bgcolor="#669999" class="text1">زهر</td>
      <td height="40" align="center" bgcolor="#669999" class="text1">بره موم</td>
      <td align="center" bgcolor="#669999" class="text1">موم</td>
      <td align="center" bgcolor="#669999" class="text1">گرده گل </td>
      <td align="center" bgcolor="#669999" class="text1">ژل رویال</td>
      <td align="center" bgcolor="#669999" class="text1">مدرن</td>
      <td align="center" bgcolor="#669999" class="text1">سنتی</td>
      <td align="center" bgcolor="#669999" class="text1">مدرن</td>
      <td align="center" bgcolor="#669999" class="text1">سنتی</td>
      <td align="center" bgcolor="#669999" class="text1">جمع</td>
      <td align="center" bgcolor="#669999" class="text1">زن</td>
      <td align="center" bgcolor="#669999" class="text1">مرد</td>
    </tr>
      <tr class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <td align="center"><?php echo round($total_kol_t_nan, 0); ?></td>
      <td align="center"><?php echo round($total_kol_t_zah/1000, 3); ?></td>
      <td align="center"><?php echo round($total_kol_t_bar, 0); ?></td>
      <td align="center"><?php echo round($total_kol_t_mom, 0); ?></td>
      <td align="center"><?php echo round($total_kol_t_gar, 0); ?></td>
      <td align="center"><?php echo round($total_kol_t_jel/1000, 3); ?></td>
      <td align="center"><?php echo round($total_kol_t_mo, 0); ?></td>
      <td align="center"><?php echo round($total_kol_t_bo, 0); ?></td>
      <td align="center"><?php echo round($total_kol_k_mo, 0); ?></td>
      <td align="center"><?php echo round($total_kol_k_bo, 0); ?></td>
      <td align="center">کل</td>
      <td align="center"><?php echo $total_no_bah1 + $total_no_bah2; ?></td>
      <td align="center"><?php echo $total_no_bah2; ?></td>
      <td align="center"><?php echo $total_no_bah1; ?></td>
      <td align="center"><?php echo $total_zan; ?></td>
      <td align="center"><?php echo $total_mard; ?></td>
      </tr>
      </table>
<?php }
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