<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
if (isset($_POST['z_sal']))  $z_sal= $_POST['z_sal'] ; 
if (isset($_POST['id_ostan'])) $id_ostan1= $_POST['id_ostan']   ; 
if (isset($_POST['id_city'])) $id_city= $_POST['id_city']   ; 
if (isset($_POST['id_mar'])) $id_mar= $_POST['id_mar']   ; 
if ($id_ostan1 == '') $id_ostan1= '03'  ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 	  


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../../location/ajax-location.js"></script>
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
	text-align: center;
}
</style>
<script type="text/javascript">
$(document).ready(function()
{
$(".country<?php echo $num_t_mah ;?>").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar").html(html);
} 
});
});
});

$(document).ready(function()
{
$(".country").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar<?php echo $num_t_mah ;?>").html(html);
} 
});
});
});
    var initial_id_ostan = '<?php echo !empty($id_ostan1) ? $id_ostan1 : ''; ?>';
    var initial_id_city = '<?php echo !empty($id_city) ? $id_city : ''; ?>';
    var initial_id_mar = '<?php echo !empty($id_mar) ? $id_mar : ''; ?>';
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
<form  id="reg-form" method="post" action="#1">
  <div style="width: 500px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFCC" class="style1">گزارش تولید به تفکیک محصول <span class="style8"><a name="1" id="1"></a></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td width="319" height="51" align="right" bgcolor="#F1F1F1" class="input_text" >
        <select  name="id_ostan" class="input_text" id="ostan" style="width:170px ; height:40px" dir="rtl" >
          <option value="-1">-- انتخاب استان --</option>
          <?php
          // گرفتن لیست استان‌ها
          $stmt = $dbh->query("SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC");
          $ostans = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($ostans as $o): ?>
          <option value="<?php echo $o['id_ostan']; ?>" <?php echo ($o['id_ostan'] == $id_ostan1) ? 'selected="selected"' : ''; ?>><?php echo htmlspecialchars($o['ostan'], ENT_QUOTES, 'UTF-8'); ?></option>
          <?php endforeach; ?>
        </select></td>
        <td width="131"  align='center' bgcolor="#F1F1F1" class="style11" style="color: #F1F1F1"><font size="2" class="style8">:استان</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="49" align="right" bgcolor="#FFFFFF" class="input_text" >
        <select  name="id_city" class="input_text" id="shahrestan" style="width:170px ; height:40px" dir="rtl" >
          <option value="0">-- انتخاب شهرستان --</option>
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
        </select></td>
        <td  align='center' bgcolor="#FFFFFF" class="style11"><font size="2" class="style8"> :شهرستان</font></td>
      </tr>
      <tr >
        <td height="48" align="right" bgcolor="#F1F1F1" class="input_text" >
        <select  name="id_mar" class="input_text" id="markaz" style="width:170px ; height:40px" dir="rtl" >
          <option value="0">-- انتخاب مرکز --</option>
          <?php
          // If a city and markaz were previously selected, load the markazes for that city
          if (!empty($id_city) && !empty($id_mar)) {
              $stmt_markazes = $dbh->prepare("SELECT id_mar, mar FROM mar WHERE id_city = ? ORDER BY BINARY mar ASC");
              $stmt_markazes->execute(array($id_city));
              $markazes = $stmt_markazes->fetchAll(PDO::FETCH_ASSOC);
              foreach ($markazes as $m) {
                  echo '<option value="' . $m['id_mar'] . '"' . (($m['id_mar'] == $id_mar) ? ' selected="selected"' : '') . '>' . htmlspecialchars($m['mar'], ENT_QUOTES, 'UTF-8') . '</option>';
              }
          }
          ?>
          </select>
          <input name="id_city2" type="hidden" value="<?php echo $id_city ;?>" /></td>
        <td height="48"  align='center' bgcolor="#F1F1F1" class="style11"><font size="2" class="style8">:مرکز جهاد کشاورزی</font></td>
      </tr>
      <tr >
        <td height="48" align="right" bgcolor="#F1F1F1" class="input_text" ><div align="right">
          <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
            <?php
                    $query = "SELECT z_sal FROM z_sal  ORDER BY z_sal DESC "  ;
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
            <option value="<?php echo $row['z_sal'] ;?>"
                   <?php if ($row['z_sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['z_sal'] ;?></option>
            <?php }?>
            </select>
          </div></td>
        <td height="48"  align='center' bgcolor="#F1F1F1" class="style11"><span class="style8">: سال زراعی</span></td>
      </tr>
      <tr >
        <td height="72" colspan="2" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="center">
          <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          <span class="style21"><a name="3" id="13"></a></span></div></td>
      </tr>
    </table>
  </div>
</form>
<?php 
   if (isset($_POST['action']))
   {
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan= $_POST['id_ostan'] ;  ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 	  
 $id_city = $_POST['id_city'] ;
if ($id_city == 0) $v_id_city = 1  ; else $v_id_city = "$Agri_prod_table.id_city = '$id_city'" ; 
if ($id_mar == 0) $v_id_mar = 1  ; else $v_id_mar = "$Agri_prod_table.id_mar = '$id_mar'" ; 
?>
<table width="122" height="56" border="0" align="center">
        <tr>
               <td width="56"><form  action="Agri_rep220_xls.php" method="post">
                 <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                 <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
               <td width="56"><form  action="Agri_rep220_doc.php" method="post">
                 <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                 <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                 <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
               </form></td>
        </tr>
      </table>
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
               <td width="7%" rowspan="2" bgcolor="#999999">نام محصول</td>
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
 $query = "SELECT 
   cod_mah ,  
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
where $Agri_prod_table.id_ostan = '$id_ostan1'  and $v_id_city and $v_id_mar and $Agri_prod_table.cod_mah  > 0
GROUP BY cod_mah
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
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
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']);?><br /></td>
               <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>

   </table>
           <?php }?>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
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