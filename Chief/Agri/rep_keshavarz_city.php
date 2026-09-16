<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
if (isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'] ;
if (isset($_POST['id_city']))  $id_city = $_POST['id_city'] ;
if (isset($_POST['add_city']))  $add_city = $_POST['add_city'] ;
if (isset($_POST['z_sal']))  $z_sal = $_POST['z_sal'] ;
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 

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

    </style>
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
    function target_popup2(form) {
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
  <p class="style8"> اطلاعات زراعی مناطق شهری به تفکیک محصول      </p>
  <div style="width: 500px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <form method="post" name="form3" id="form3" action="#3" onsubmit="return ray.ajax()" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td width="319" height="51" align="right" bgcolor="#F1F1F1" class="input_text" >
          <select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
            <option value="-1">انتخاب استان</option>
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
  </td>
        <td  align='center' bgcolor="#F1F1F1" class="style1" style="color: #F1F1F1"><font size="2" class="style8">:استان</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="49" align="right" bgcolor="#FFFFFF" class="input_text" >
        <select  name="id_city" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
         <option value="0">انتخاب شهرستان</option>
            <?php
$query = "SELECT id_city,city FROM cityname WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
            <?php 
		   }?>
          </select>
</td>
        <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
      </tr>
      <tr >
        <td height="51" align="right" bgcolor="#f1f1f1" class="input_text" >
          <select  name="add_bakh" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
            <option value="0"> نام مرکز</option>
            <?php
$query = "SELECT DISTINCT add_bakh,bakh FROM list_city WHERE  id_ostan = '$id_ostan1' and  id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
       <option value="<?php echo $row['add_bakh'] ;?>"
   <?php if ($row['add_bakh']==$add_bakh) echo 'selected=selected'?>> <?php echo $row['bakh'] ;?></option>
            <?php }?>
          </select>
</td>
        <td width="131"  align='center' bgcolor="#F1F1F1" class="style1"><font size="2" class="style8">: بخش</font></td>
      </tr>
      <tr >
        <td height="48" align="right" bgcolor="#FFFFFF" class="input_text" >
          <p>
            <select  name="add_city" class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl" >
              <option value="0">کلیه شهر ها</option>
              <?php
$query = "SELECT DISTINCT add_city,shahr FROM list_city WHERE id_ostan = '$id_ostan1' and  id_city = '$id_city' and add_bakh = '$add_bakh'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
              <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
              <?php }?>
            </select>
          </p>
          
        </td>
        <td height="48"  align='center' bgcolor="#FFFFFF" class="style8"> : شهر</td>
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
        <td height="48"  align='center' bgcolor="#F1F1F1" class="style1"><span class="style8">: سال زراعی</span></td>
      </tr>
      <tr >
        <td height="72" colspan="2" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="center">
          <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          <span class="style21"><a name="3" id="13"></a></span></div></td>
        </tr>
    </table>
</form>
</div>

  <p>
  <?php if(isset($_POST['action']))
{
$id_ostan1 = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
$add_bakh = $_POST['add_bakh'] ; 
$add_city = $_POST['add_city'] ; 
$z_sal = $_POST['z_sal'] ;

if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "$Agri_prod_table.id_ostan='$id_ostan1'" ;}
if ($id_city == 0 )    { $v_id_city  = 1 ;} else { $v_id_city  = "$Agri_prod_table.id_city='$id_city'"   ;}
if ($add_bakh == 0)    { $v_add_bakh = 1 ;} else { $v_add_bakh = "list_city.add_bakh='$add_bakh'" ;}
if ($add_city == 0)     { $v_add_city  = 1 ;} else { $v_add_city  = "list_city.add_city='$add_city'"   ;}

// برای نمایش 
$start=0;
$limit=25;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start = ($id - 1) * $limit;
 $query = "SELECT 
$Agri_prod_table.id_ostan,
$Agri_prod_table.id_city,
list_city.add_bakh,
list_city.add_city,
list_city.ostan,
list_city.city,
list_city.bakh,
list_city.shahr,
$Agri_prod_table.cod_mah,
product_z.product_name,
(SUM( $Agri_prod_table.zer_kesht_a ) + SUM( $Agri_prod_table.zer_kesht_b)) AS z_kesht,
SUM( $Agri_prod_table.mah_tolp ) AS mah_tolp,
(SUM( $Agri_prod_table.s_bar_a ) + SUM( $Agri_prod_table.s_bar_b )) AS s_bar,
SUM( $Agri_prod_table.mah_tol ) AS mah_tol
FROM $Agri_prod_table
INNER JOIN list_city ON $Agri_prod_table.add_city=list_city.add_city
INNER JOIN product_z  ON product_z.product_cod = $Agri_prod_table.cod_mah
where 
$Agri_prod_table.cod_mah != ''
AND $v_id_ostan  AND $v_id_city  AND $v_add_bakh  AND $v_add_city 
GROUP BY $Agri_prod_table.cod_mah , $Agri_prod_table.add_city
ORDER BY id_ostan,id_city,add_city LIMIT $start, $limit "; 

$query1 = "SELECT COUNT(*) as total
FROM (
    SELECT 1
    FROM $Agri_prod_table
    INNER JOIN list_city ON $Agri_prod_table.add_city = list_city.add_city
    INNER JOIN product_z ON product_z.product_cod = $Agri_prod_table.cod_mah
    WHERE 
        $Agri_prod_table.cod_mah != ''
        AND $v_id_ostan AND $v_id_city AND $v_add_bakh AND $v_add_city
    GROUP BY $Agri_prod_table.cod_mah , $Agri_prod_table.add_city
) AS grouped_results";

$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      <form  action="rep_keshavarz_city_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
        <input type="hidden" name="add_bakh" value="<?php echo  $add_bakh ;?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo  $z_sal ;?>" />
        <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="60" height="57"  alt=""/></button>
      </form>
  <table width="85%"  align="center" class="my-table"  >
    <tr align="center" class="text1">
    <td width="12%" height="50" bgcolor="#999999">تولید قطعی</td>
    <td width="12%" height="50" bgcolor="#999999"><p>سطح برداشت</p></td>
    <td width="12%" bgcolor="#999999">پیش بینی تولید </td>
    <td width="12%" bgcolor="#999999">سطح زیر کشت</td>
    <td width="10%" bgcolor="#999999">نام محصول</td>
    <td width="9%" bgcolor="#999999">نام شهر</td>
    <td width="9%" bgcolor="#999999">بخش</td>
    <td width="10%" bgcolor="#999999">شهرستان</td>
    <td width="9%" bgcolor="#999999">استان</td>
    <td width="5%" bgcolor="#999999">ردیف</td>

  </tr>
  <tr>
<?php
$r = $start+1 ;
 foreach($stmt as $row){
?>
<td height="40" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tol'];?></td>
 <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar'];?></td>
 <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tolp'];?></td>
 <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_kesht'];?></td>
 <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['product_name'];?></td>
 <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['shahr'];?></td>
 <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bakh'];?></td>
 <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'];?></td>
 <td class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan'];?></td>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
<?php 
}
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1->fetchColumn();
$total = ceil($rows/$limit);

// تعیین محدوده صفحات برای نمایش
$visible_pages = 3;
$start_page = max(1, $id - $visible_pages);
$end_page = min($total, $id + $visible_pages);

$show_first = ($start_page > 1);
$show_last = ($end_page < $total);
?>

<div dir="rtl" class="pagination-container" style="margin-top:20px; text-align:center; height:auto; margin:auto; width:98%; overflow:auto; background-color:#ffffff; color:#06C; font-size:11px; padding:10px; border-radius:15px">
    <ul class="pagination" style="list-style-type:none; padding:0; margin:0; display:flex; justify-content:center; align-items:center; flex-wrap:wrap;">
        <?php if($id > 1): ?>
            <li class="page-item" style="display:inline-block; margin:2px;">
                <form action="rep_keshavarz_city.php?id=<?php echo $id-1 .'#3' ?>" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city ;?>" />
                    <input type="hidden" name="add_bakh" value="<?php echo $add_bakh ;?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">&laquo; قبلی</button>
                </form>
            </li>
        <?php endif; ?>
        
        <?php if($show_first): ?>
            <li class="page-item" style="display:inline-block; margin:2px;">
                <form action="rep_keshavarz_city.php?id=1#3" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city ;?>" />
                    <input type="hidden" name="add_bakh" value="<?php echo $add_bakh ;?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;">1</button>
                </form>
            </li>
            <?php if($start_page > 2): ?>
                <li class="page-item disabled" style="display:inline-block; margin:2px; color:#ccc;">
                    <span style="padding:5px 10px;">...</span>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php for($i = $start_page; $i <= $end_page; $i++): ?>
            <li class="page-item <?php echo ($i == $id) ? 'active' : ''; ?>" style="display:inline-block; margin:2px;">
                <?php if($i == $id): ?>
                    <span class="current-page" style="background:#06C; color:white; padding:5px 10px; border-radius:4px; display:inline-block;"><?php echo $i; ?></span>
                <?php else: ?>
                    <form action="rep_keshavarz_city.php?id=<?php echo $i .'#3'?>" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="1" />
                        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                        <input type="hidden" name="id_city" value="<?php echo $id_city ;?>" />
                        <input type="hidden" name="add_bakh" value="<?php echo $add_bakh ;?>" />
                        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                        <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $i; ?></button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endfor; ?>
        
        <?php if($show_last): ?>
            <?php if($end_page < $total - 1): ?>
                <li class="page-item disabled" style="display:inline-block; margin:2px; color:#ccc;">
                    <span style="padding:5px 10px;">...</span>
                </li>
            <?php endif; ?>
            <li class="page-item" style="display:inline-block; margin:2px;">
                <form action="rep_keshavarz_city.php?id=<?php echo $total .'#3'?>" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city ;?>" />
                    <input type="hidden" name="add_bakh" value="<?php echo $add_bakh ;?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $total; ?></button>
                </form>
            </li>
        <?php endif; ?>
        
        <?php if($id != $total): ?>
            <li class="page-item" style="display:inline-block; margin:2px;">
                <form action="rep_keshavarz_city.php?id=<?php echo $id+1 .'#3' ?>" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                    <input type="hidden" name="id_city" value="<?php echo $id_city ;?>" />
                    <input type="hidden" name="add_bakh" value="<?php echo $add_bakh ;?>" />
                    <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                    <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">بعدی &raquo;</button>
                </form>
            </li>
        <?php endif; ?>
    </ul>
    
    <div class="page-jump" style="margin-top:10px;">
        <form id="pageJumpForm" action="rep_keshavarz_city.php" method="post" style="display:inline-block;">
            <input type="hidden" name="action" value="1" />
            <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
            <input type="hidden" name="id_city" value="<?php echo $id_city ;?>" />
            <input type="hidden" name="add_bakh" value="<?php echo $add_bakh ;?>" />
            <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
            <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
            <span style="font-size:18px; margin-left:15px"><?php echo 'به صفحه'; ?></span>
            <input type="number" 
                   id="pageIdInput"
                   name="page_input"
                   value="<?php echo isset($id) ? (int)$id : 1; ?>" 
                   placeholder="شماره صفحه" 
                   style="width:80px; padding:5px; border-radius:4px; border:1px solid #ccc;">
            <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">برو</button>
        </form>
    </div>
</div>
<script>
document.getElementById('pageJumpForm').addEventListener('submit', function(e) {
    var input = document.getElementById('pageIdInput');
    var pageId = parseInt(input.value, 10);
    if (!isNaN(pageId) && pageId >= 1 && pageId <= <?php echo $total; ?>) {
        this.action = 'rep_keshavarz_city.php?id=' + pageId + '#3';
    } else {
        e.preventDefault();
        alert("لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo $total; ?> وارد کنید.");
    }
});
</script>
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