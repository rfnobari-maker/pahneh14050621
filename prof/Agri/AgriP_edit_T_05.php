<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');

date_default_timezone_set('Asia/Tehran');

$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city = isset($_POST['id_city5']) ? $_POST['id_city5'] : '';
$id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
$dis = isset($_POST['dis']) ? $_POST['dis'] : '';

$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

$limit = 25;
$page = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$start = ($page - 1) * $limit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>تکمیل اطلاعات سطح برداشت و تولید قطعی</title>
<link rel="stylesheet" type="text/css" href="../../FA.css" />
<script type="text/javascript" src="../../jquery-3.6.0.min.js"></script>
<style type="text/css">
body { direction: rtl; font-family: Tahoma, Arial; font-size: 12px; }
table { border-collapse: collapse; width: 100%; }
th, td { border: 1px solid #ccc; padding: 5px; text-align: center; }
th { background-color: #f0f0f0; font-weight: bold; }
.pagination { margin: 10px 0; text-align: center; }
.pagination a, .pagination span { padding: 5px 10px; margin: 0 2px; border: 1px solid #ccc; display: inline-block; }
.pagination a:hover { background-color: #f0f0f0; }
.pagination .current { background-color: #007bff; color: white; }
input[type="text"], select { padding: 3px; font-family: Tahoma; font-size: 12px; }
.btn { padding: 5px 15px; cursor: pointer; }
</style>
<script type="text/javascript">
$(document).ready(function(){
    $('.country_select').change(function(){
        var group_cod = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'ajax_city.php',
            data: 'group_cod=' + group_cod,
            success: function(html){
                $('.mar').html(html);
            }
        });
    });
});
</script>
</head>
<body>
<?php include('../../menu.php'); ?>
<?php include('../../top.php'); ?>

<h2>تکمیل اطلاعات سطح برداشت و تولید قطعی</h2>

<form method="post" action="">
<table style="width: 90%; margin: 0 auto;">
<tr>
    <td>سال زراعی:</td>
    <td>
        <select name="z_sal">
            <option value="">انتخاب کنید</option>
            <?php
            $sql_sal = "SELECT DISTINCT z_sal FROM " . $Agri_prod_table . " ORDER BY z_sal DESC";
            $result_sal = mysql_query($sql_sal);
            while($row_sal = mysql_fetch_array($result_sal)){
                $selected = ($z_sal == $row_sal['z_sal']) ? 'selected="selected"' : '';
                echo '<option value="' . $row_sal['z_sal'] . '" ' . $selected . '>' . $row_sal['z_sal'] . '</option>';
            }
            ?>
        </select>
    </td>
    <td>استان:</td>
    <td>
        <select name="id_ostan">
            <option value="">انتخاب کنید</option>
            <?php
            $sql_ostan = "SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC";
            $result_ostan = mysql_query($sql_ostan);
            while($row_ostan = mysql_fetch_array($result_ostan)){
                $selected = ($id_ostan1 == $row_ostan['id_ostan']) ? 'selected="selected"' : '';
                echo '<option value="' . $row_ostan['id_ostan'] . '" ' . $selected . '>' . $row_ostan['ostan'] . '</option>';
            }
            ?>
        </select>
    </td>
</tr>
<tr>
    <td>شهرستان:</td>
    <td>
        <select name="id_city5">
            <option value="">انتخاب کنید</option>
            <?php
            if($id_ostan1){
                $sql_city = "SELECT id_city, city FROM cityname WHERE id_ostan = '" . mysql_real_escape_string($id_ostan1) . "' ORDER BY BINARY city ASC";
                $result_city = mysql_query($sql_city);
                while($row_city = mysql_fetch_array($result_city)){
                    $selected = ($id_city == $row_city['id_city']) ? 'selected="selected"' : '';
                    echo '<option value="' . $row_city['id_city'] . '" ' . $selected . '>' . $row_city['city'] . '</option>';
                }
            }
            ?>
        </select>
    </td>
    <td>نوع کشت:</td>
    <td>
        <select name="no_kesh">
            <option value="">انتخاب کنید</option>
            <option value="آبی" <?php echo ($no_kesh == 'آبی') ? 'selected="selected"' : ''; ?>>آبی</option>
            <option value="دیم" <?php echo ($no_kesh == 'دیم') ? 'selected="selected"' : ''; ?>>دیم</option>
        </select>
    </td>
</tr>
<tr>
    <td>گروه محصول:</td>
    <td>
        <select name="mah_qroup" class="country_select">
            <option value="">انتخاب کنید</option>
            <?php
            $sql_group = "SELECT DISTINCT group_cod, group_name FROM product_z";
            $result_group = mysql_query($sql_group);
            while($row_group = mysql_fetch_array($result_group)){
                $selected = ($mah_qroup == $row_group['group_cod']) ? 'selected="selected"' : '';
                echo '<option value="' . $row_group['group_cod'] . '" ' . $selected . '>' . $row_group['group_name'] . '</option>';
            }
            ?>
        </select>
    </td>
    <td>محصول:</td>
    <td>
        <select name="mah_name" class="mar">
            <option value="">انتخاب کنید</option>
            <?php
            if($mah_qroup){
                $sql_product = "SELECT DISTINCT product_cod, product_name FROM product_z WHERE group_cod = " . (int)$mah_qroup;
                $result_product = mysql_query($sql_product);
                while($row_product = mysql_fetch_array($result_product)){
                    $selected = ($mah_name == $row_product['product_cod']) ? 'selected="selected"' : '';
                    echo '<option value="' . $row_product['product_cod'] . '" ' . $selected . '>' . $row_product['product_name'] . '</option>';
                }
            }
            ?>
        </select>
    </td>
</tr>
<tr>
    <td>نمایش:</td>
    <td colspan="3">
        <select name="dis">
            <option value="1" <?php echo ($dis == '1') ? 'selected="selected"' : ''; ?>>همه رکوردها</option>
            <option value="2" <?php echo ($dis == '2') ? 'selected="selected"' : ''; ?>>رکوردهای فاقد تولید قطعی</option>
        </select>
    </td>
</tr>
<tr>
    <td colspan="4"><input type="submit" value="جستجو" class="btn" /></td>
</tr>
</table>
</form>

<?php
if($_POST){
    $where = array();
    
    if($z_sal) $where[] = "z_sal = '" . mysql_real_escape_string($z_sal) . "'";
    if($id_ostan1) $where[] = "id_ostan = '" . mysql_real_escape_string($id_ostan1) . "'";
    if($id_city) $where[] = "id_city = '" . mysql_real_escape_string($id_city) . "'";
    if($id_mar) $where[] = "id_mar = '" . mysql_real_escape_string($id_mar) . "'";
    if($add_abadi) $where[] = "add_abadi = '" . mysql_real_escape_string($add_abadi) . "'";
    if($add_city) $where[] = "add_city = '" . mysql_real_escape_string($add_city) . "'";
    if($no_kesh) $where[] = "no_kesh = '" . mysql_real_escape_string($no_kesh) . "'";
    if($mor_cod_m) $where[] = "mor_cod_m = '" . mysql_real_escape_string($mor_cod_m) . "'";
    if($bah_cod_m) $where[] = "bah_cod_m = '" . mysql_real_escape_string($bah_cod_m) . "'";
    if($mah_name) $where[] = "cod_mah = '" . mysql_real_escape_string($mah_name) . "'";
    
    if($dis != '1'){
        $where[] = "mah_tol = 0";
        $where[] = "mah_kh != '1'";
    }
    
    $where_clause = count($where) > 0 ? 'WHERE ' . implode(' AND ', $where) : '';
    
    $sql_count = "SELECT COUNT(*) as total FROM " . $Agri_prod_table . " " . $where_clause;
    $result_count = mysql_query($sql_count);
    $row_count = mysql_fetch_array($result_count);
    $total = $row_count['total'];
    $total_pages = ceil($total / $limit);
    
    $sql = "SELECT id, bah_cod_m, sh_gat, no_kesh, cod_mah, zer_kesht_a, zer_kesht_b, mah_tolp, s_bar_a, s_bar_b, mah_tol, add_abadi, mah_kh 
            FROM " . $Agri_prod_table . " " . $where_clause . " 
            ORDER BY bah_cod_m, sh_gat ASC 
            LIMIT " . $start . ", " . $limit;
    $result = mysql_query($sql);
    
    if(mysql_num_rows($result) > 0){
        echo '<table style="width: 95%; margin: 10px auto;">';
        echo '<tr>
                <th>ردیف</th>
                <th>کد بهره بردار</th>
                <th>نام بهره بردار</th>
                <th>شماره قطعه</th>
                <th>نوع کشت</th>
                <th>محصول</th>
                <th>سطح زیر کشت 1</th>
                <th>سطح زیر کشت 2</th>
                <th>پیش بینی تولید</th>
                <th>سطح برداشت 1</th>
                <th>سطح برداشت 2</th>
                <th>تولید قطعی (تن)</th>
                <th>خسارت</th>
                <th>عملیات</th>
              </tr>';
        
        $row_num = $start + 1;
        while($row = mysql_fetch_array($result)){
            $bah_name_val = bah_name($row['bah_cod_m']);
            $mah_name_val = mah_name($row['cod_mah']);
            
            echo '<tr>';
            echo '<td>' . $row_num . '</td>';
            echo '<td>' . $row['bah_cod_m'] . '</td>';
            echo '<td>' . $bah_name_val . '</td>';
            echo '<td>' . $row['sh_gat'] . '</td>';
            echo '<td>' . $row['no_kesh'] . '</td>';
            echo '<td>' . $mah_name_val . '</td>';
            echo '<td>' . $row['zer_kesht_a'] . '</td>';
            echo '<td>' . $row['zer_kesht_b'] . '</td>';
            echo '<td>' . $row['mah_tolp'] . '</td>';
            echo '<td><input type="text" name="s_bar_a_' . $row['id'] . '" id="s_bar_a_' . $row['id'] . '" value="' . $row['s_bar_a'] . '" size="5" /></td>';
            echo '<td><input type="text" name="s_bar_b_' . $row['id'] . '" id="s_bar_b_' . $row['id'] . '" value="' . $row['s_bar_b'] . '" size="5" /></td>';
            echo '<td><input type="text" name="mah_tol_' . $row['id'] . '" id="mah_tol_' . $row['id'] . '" value="' . $row['mah_tol'] . '" size="5" /></td>';
            echo '<td><select name="mah_kh_' . $row['id'] . '" id="mah_kh_' . $row['id'] . '">
                    <option value="0"' . ($row['mah_kh'] == '0' ? ' selected="selected"' : '') . '>خیر</option>
                    <option value="1"' . ($row['mah_kh'] == '1' ? ' selected="selected"' : '') . '>بله</option>
                  </select></td>';
            echo '<td>
                    <button type="button" class="submitX btn" data-id="' . $row['id'] . '" data-bah="' . $row['bah_cod_m'] . '" data-abadi="' . $row['add_abadi'] . '" data-sal="' . $z_sal . '" data-gat="' . $row['sh_gat'] . '" data-cod="' . $row['cod_mah'] . '" data-kesh="' . $row['no_kesh'] . '" data-zka="' . $row['zer_kesht_a'] . '" data-zkb="' . $row['zer_kesht_b'] . '">ثبت</button>
                    <span id="success_' . $row['id'] . '" style="display:none; color:green;">✓</span>
                    <span id="error_' . $row['id'] . '" style="display:none; color:red;">✗</span>
                  </td>';
            echo '</tr>';
            
            $row_num++;
        }
        echo '</table>';
        
        if($total_pages > 1){
            echo '<div class="pagination">';
            if($page > 1){
                echo '<a href="?id=' . ($page - 1) . '">قبلی</a>';
            }
            for($i = 1; $i <= $total_pages; $i++){
                if($i == $page){
                    echo '<span class="current">' . $i . '</span>';
                } else {
                    echo '<a href="?id=' . $i . '">' . $i . '</a>';
                }
            }
            if($page < $total_pages){
                echo '<a href="?id=' . ($page + 1) . '">بعدی</a>';
            }
            echo '</div>';
        }
    } else {
        echo '<p style="text-align:center;">رکوردی یافت نشد.</p>';
    }
}
?>

<script type="text/javascript">
$(document).ready(function(){
    $('input[id^="s_bar_a_"], input[id^="s_bar_b_"]').change(function(){
        var id = $(this).attr('id').split('_').pop();
        var s_bar_a = parseFloat($('#s_bar_a_' + id).val()) || 0;
        var s_bar_b = parseFloat($('#s_bar_b_' + id).val()) || 0;
        var zka = parseFloat($(this).closest('tr').find('button').data('zka')) || 0;
        var zkb = parseFloat($(this).closest('tr').find('button').data('zkb')) || 0;
        
        if(s_bar_a > zka || s_bar_b > zkb){
            alert('سطح برداشت نمی‌تواند از سطح زیر کشت بیشتر باشد');
            $(this).val('');
            return false;
        }
        $('#mah_tol_' + id).val('');
    });
    
    $('input[id^="mah_tol_"]').change(function(){
        var id = $(this).attr('id').split('_').pop();
        var btn = $(this).closest('tr').find('button');
        var mcod = btn.data('cod');
        var sba = $('#s_bar_a_' + id).val();
        var sbb = $('#s_bar_b_' + id).val();
        var mtol = $(this).val();
        var no_kesh = btn.data('kesh');
        
        $.ajax({
            type: 'POST',
            url: 'aj.php',
            data: {
                operation: 'check_mah_tol',
                mcod: mcod,
                sba: sba,
                sbb: sbb,
                mtol: mtol,
                no_kesh: no_kesh
            },
            success: function(data){
                if(data != 'true'){
                    alert('میزان تولید وارد شده از محدود مجاز، بیشتر است / میزان سطح برداشت را بررسی کنید');
                    btn.prop('disabled', true);
                } else {
                    btn.prop('disabled', false);
                }
            }
        });
    });
    
    $('.submitX').click(function(){
        var btn = $(this);
        var id = btn.data('id');
        var s_bar_a = $('#s_bar_a_' + id).val();
        var s_bar_b = $('#s_bar_b_' + id).val();
        var mah_tol = $('#mah_tol_' + id).val();
        var mah_kh = $('#mah_kh_' + id).val();
        
        $.ajax({
            type: 'POST',
            url: 'post98.php',
            data: {
                id: id,
                s_bar_a: s_bar_a,
                s_bar_b: s_bar_b,
                mah_tol: mah_tol,
                mah_kh: mah_kh,
                bah_cod_m: btn.data('bah'),
                add_abadi: btn.data('abadi'),
                z_sal: btn.data('sal'),
                sh_gat: btn.data('gat')
            },
            success: function(){
                $('#success_' + id).show();
                $('#error_' + id).hide();
                setTimeout(function(){
                    $('#success_' + id).fadeOut();
                }, 2000);
            },
            error: function(){
                $('#error_' + id).show();
                $('#success_' + id).hide();
            }
        });
    });
});
</script>

</body>
</html>

<?php
$no = isset($t_row) ? $t_row : 0;
while ($no > 0){
?>
<script>
$('.s_bar_a<?php echo $no ?>').keyup(function () {
    var zka = document.getElementById("zer_kesht_a<?php echo $no ?>").value; 
    var sba = document.getElementById("s_bar_a<?php echo $no ?>").value;
if (parseFloat(zka) < parseFloat(sba)) {
   alert("سطح برداشت اول از سطح زیر کشت اول بزرگتر است ");
            // پاک کردن سطح برداشت 1
			$('#s_bar_a<?php echo $no ?>').val('');
  			// فوکوس روی سطح برداشت 1 
			document.getElementById("s_bar_a<?php echo $no ?>").focus();
  	    }
});
</script>
<script>
$('.s_bar_a<?php echo $no ?>').change(function () {
   $('#mah_tol<?php echo $no ?>').val('');
});
</script>
<script>
$('.s_bar_b<?php echo $no ?>').keyup(function () {
    var zkb = document.getElementById("zer_kesht_b<?php echo $no ?>").value; 
    var sbb = document.getElementById("s_bar_b<?php echo $no ?>").value;
if (parseFloat(zkb) < parseFloat(sbb)) {
   alert("سطح برداشت دوم از سطح زیر کشت دوم بزرگتر است ");
            // پاک کردن سطح برداشت 1
			$('#s_bar_b<?php echo $no ?>').val('');
  			// فوکوس روی سطح برداشت 1 
			document.getElementById("s_bar_b<?php echo $no ?>").focus();
}
});
</script>
<script>
$('.s_bar_b<?php echo $no ?>').change(function () {
   $('#mah_tol<?php echo $no ?>').val('');
});
</script>
<script>
$('.mah_tol<?php echo $no ?>').keyup(function () {
 // کد محصول

  var mcod = document.getElementById("cod_mah<?php echo $no ?>").value;
  var sba = document.getElementById("s_bar_a<?php echo $no ?>").value;
  var sbb  = document.getElementById("s_bar_b<?php echo $no ?>").value;
  var mtol = document.getElementById("mah_tol<?php echo $no ?>").value;
  var no_kesh = document.getElementById("no_kesh<?php echo $no ?>").value;
  no_kesh
  $.ajax({
      url: "aj.php",
      type: "POST",
      data: {op:"check_mah_tol",mcod:mcod,sba:sba,sbb:sbb,mtol:mtol,no_kesh:no_kesh},
      success: function(data,status){
  	    if(data!='true')
  	    {
  	    	document.getElementById("submit<?php echo $no ?>").disabled = true;
       	    //  alert( ' خطا  \n \n  میزان تولید وارد شده از حداکثر ممکن یعنی ' + data +' تن بیشتر هست \n \n  برای ادامه باید نسبت به تصحیح آن اقدام فرمایید ' );
            // پاک کردن مقدار تولید 
			$('#mah_tol<?php echo $no ?>').val('');
  			// فوکوس روی تولید محصول 
			document.getElementById("mah_tol<?php echo $no ?>").focus();
  	    	alert( ' خطا  \n \n  میزان تولید وارد شده از محدود مجاز ، بیشتر هست / میزان سطح برداشت را بررسی کنید ' );
  	    }
  	    else
  	    	document.getElementById("submit<?php echo $no ?>").disabled = false ;
  	},
      error: function(){$("#result").html("مشکلی در اتصال به سرور به وجود آمد!")}
  });
});
</script>
<script>
 $('.mah_tol<?php echo $no ?>').change(function () {
  var sba = document.getElementById("s_bar_a<?php echo $no ?>").value;
  var sbb  = document.getElementById("s_bar_b<?php echo $no ?>").value;
  var mtol = document.getElementById("mah_tol<?php echo $no ?>").value;
  var sb = sba + sbb ; 
if (parseFloat(sb) > 0   &&  parseFloat(mtol) <= 0) {
            // پاک تولید 
			$('#mah_tol<?php echo $no ?>').val('');
  			// فوکوس تولید 
			document.getElementById("mah_tol<?php echo $no ?>").focus();
         alert("با توجه به سطح برداشت  ، تولید قطعی نادرست است");
  }
  });
</script>
   <script type="text/javascript" >
$(function() {
$(".submit<?php echo $no ?>").click(function() {
var s_bar_a     = $("#s_bar_a<?php echo $no ?>").val();
var s_bar_b     = $("#s_bar_b<?php echo $no ?>").val();
var mah_tol     = $("#mah_tol<?php echo $no ?>").val();
  var e = document.getElementById("mah_kh<?php echo $no ?>");
  var mah_kh = e.options[e.selectedIndex].value;
var id          = $("#id<?php echo $no ?>").val();
var bah_cod_m   = $("#bah_cod_m<?php echo $no ?>").val();
var add_abadi   = $("#add_abadi<?php echo $no ?>").val();
var z_sal       = $("#z_sal").val();
var sh_gat      = $("#sh_gat<?php echo $no ?>").val();
var sb          = s_bar_a + s_bar_b ; 
var dataString = 's_bar_a='+ s_bar_a + '&s_bar_b=' + s_bar_b + '&mah_tol=' + mah_tol + '&id=' + id 
+ '&bah_cod_m=' + bah_cod_m +  '&add_abadi=' + add_abadi + '&z_sal=' + z_sal +  '&sh_gat=' + sh_gat + '&mah_kh=' + mah_kh;
if(s_bar_a=='' || s_bar_b=='' || mah_tol=='' || (parseFloat(sb) > 0   &&  parseFloat(mah_tol) <= 0 )
|| (parseFloat(sb) <= 0   &&  parseFloat(mah_tol) > 0 )
|| mah_kh == '' )
{
$('.success<?php echo $no ?>').fadeOut(200).hide();
$('.error<?php echo $no ?>').fadeOut(200).show();
}
else
{
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