<?php 
include('../../lock_expar.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$id_ostan = isset($id_ostan) ? $id_ostan : '';
// متغیرهای ورودی جدید
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_qroup = isset($_POST['mah_qroup']) ? $_POST['mah_qroup'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    <style type="text/css">
<!--
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
.column {
  float: left;
  width:12.25%;
  padding: 5px;
}
.row {
	width: 100%
}

.row::after {
  content: "";
  clear: both;
  display: table;
}
/* جدول نتایج مدرن و واکنش‌گرا */
.agri-table {
  width: 95%;
  margin: 24px auto;
  border-collapse: collapse;
  font-family: Tahoma, Arial, sans-serif;
  font-size: 15px;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  border-radius: 12px;
  overflow: hidden;
  /* direction: rtl; */
}
.agri-table th, .agri-table td {
  padding: 10px 8px;
  text-align: center;
  border-bottom: 1px solid #e0e0e0;
  border-right: 1px solid #e0e0e0;
}
.agri-table th:last-child, .agri-table td:last-child {
  border-right: none;
}
.agri-table th {
  background: #006699;
  color: #fff;
  font-weight: bold;
  font-size: 16px;
}
.agri-table tr:nth-child(even) {
  background: #f9f9f9;
}
.agri-table tr:nth-child(odd) {
  background: #fff;
}
.agri-table tr:hover {
  background: #e6f2ff;
}
@media (max-width: 900px) {
  /* فقط فونت و سایز جدول را کوچک‌تر می‌کنیم، ساختار جدول حفظ شود */
  .agri-table {
    font-size: 13px;
  }
  .agri-table th, .agri-table td {
    padding: 8px 4px;
  }
  .agri-table tr { margin-bottom: 15px; }
  .agri-table td, .agri-table th {
    text-align: right;
    padding: 10px 5px;
    border: none;
    border-bottom: 1px solid #e0e0e0;
    position: relative;
  }
  .agri-table th {
    background: #006699;
    color: #fff;
    font-size: 15px;
    border-radius: 0;
  }
}
</style>
</head>
<body>
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
      <span class="style8">برنامه الگوی کشت ابلاغی محصولات زراعی </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 350px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="213" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>

               <tr bgcolor='#f1f1f1' >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <div align="right">
                    <select name="mah_qroup" class="required input_text country" id="mah_qroup" style="width:170px ; height:40px" tabindex="1" dir="rtl"  >
                      <option value="" > انتخاب گروه</option>
                      <?php
                        $query = "SELECT DISTINCT group_cod,group_name FROM `product_z` ORDER BY group_cod ASC" ;
                        $stmt = $dbh->prepare($query);
                        $stmt->execute();
                        foreach($stmt as $row){
                      ?>
                      <option value="<?php echo $row['group_cod'] ;?>"
                         <?php if (isset($_POST['mah_qroup']) && $row['group_cod']==$mah_qroup) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                      <?php }?>
                    </select>
                   </div>
                 </td>
                 <td align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8">:گروه محصولات</font></td>
               </tr>

               <tr bgcolor='#f1f1f1' >
                 <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <div align="right">
                     <select name="mah_name" class="required input_text mar" style="width:170px ; height:40px" tabindex="2" dir="rtl">
                       <?php
                         if (!empty($mah_qroup)) {
                           $query = "SELECT DISTINCT product_cod,product_name FROM `product_z` WHERE `group_cod` = :mah_qroup ORDER BY product_name ASC" ;
                           $stmt = $dbh->prepare($query);
                           $stmt->bindParam(':mah_qroup', $mah_qroup);
                           $stmt->execute();
                           foreach($stmt as $row){
                       ?>
                       <option value="<?php echo $row['product_cod'] ;?>"
                          <?php if ($row['product_cod']==$mah_name) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
                       <?php
                           }
                         } else {
                            echo '<option value="">ابتدا گروه را انتخاب کنید</option>';
                         }
                       ?>
                     </select>
                   </div>
                 </td>
                 <td align='center' bgcolor="#FFFFFF" class="style8">: نام محصول</td>
               </tr>

               <tr bgcolor='#f1f1f1' >
                 <td height="71" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal2" style="height:40px ; width:170px ; direction:rtl" tabindex="3">
                     <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                     </select>
                 </div>
                 </td>
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><span class="style8">: سال زراعی</span></td>
               </tr>
               <tr >
                 <td height="60" colspan="2" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" tabindex="4" value='جستجو' />
                   </td>
               </tr>
             </table>
           </div>
 </form>
             <p>
               <?php
 if (isset($_POST['action']) && !empty($mah_qroup) && !empty($mah_name) && !empty($z_sal))
 {

$query_city_list = "SELECT id_city FROM cityname WHERE id_ostan = :id_ostan";
$stmt_city_list = $dbh->prepare($query_city_list);
$stmt_city_list->bindParam(':id_ostan', $id_ostan);
$stmt_city_list->execute();
$city_ids = $stmt_city_list->fetchAll(PDO::FETCH_COLUMN);

foreach ($city_ids as $city_id) {
    $query_insert = "
    INSERT INTO Agri_ab_city (group_cod, group_name, product_cod, product_name, id_ostan, id_city, z_sal)
    SELECT p.group_cod, p.group_name, p.product_cod, p.product_name, :id_ostan, :id_city, :z_sal
    FROM product_z p
    LEFT JOIN Agri_ab_city a
      ON p.product_cod = a.product_cod
         AND p.group_cod = a.group_cod
         AND a.id_ostan = :id_ostan
         AND a.id_city = :id_city
         AND a.z_sal = :z_sal
    WHERE a.product_cod IS NULL
      AND p.product_cod = :mah_name
      AND p.group_cod = :mah_qroup";

    $q_insert = $dbh->prepare($query_insert);
    $q_insert->execute(array(
        ':id_ostan'  => $id_ostan,
        ':id_city'   => $city_id,
        ':z_sal'     => $z_sal,
        ':mah_name'  => $mah_name,
        ':mah_qroup' => $mah_qroup
    ));
}


$query = "
    SELECT a.*, c.city
    FROM Agri_ab_city a
    JOIN cityname c ON a.id_city = c.id_city AND a.id_ostan = c.id_ostan
    WHERE a.z_sal = :z_sal
      AND a.group_cod = :mah_qroup
      AND a.product_cod = :mah_name
      AND a.id_ostan = :id_ostan
    ORDER BY BINARY c.city ASC
";
$stmt = $dbh->prepare($query);
$stmt->execute(array(
    ':z_sal'     => $z_sal,
    ':mah_qroup' => $mah_qroup,
    ':mah_name'  => $mah_name,
    ':id_ostan'  => $id_ostan
));
$t_row = $stmt->rowCount();

if ($t_row > 0) {
?>
             <table width="122" height="56" border="0" align="center">
               <tr>
                 <td><form  action="Sab_L2p_xls.php" method="post">
                   <input type="hidden" name="mah_qroup" value="<?php echo $mah_qroup ;?>" />
                   <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
             </table>
            <table class="agri-table">
              <tr class="text1">
                <td width="7%" rowspan="2" bgcolor="#006699">عملیات</td>
                <td colspan="2" bgcolor="#006699">عملکرد / کیلوگرم در هکتار<br /></td>
                <td colspan="2" bgcolor="#006699">تولید / تن <br /></td>
                <td colspan="2" bgcolor="#006699"><p>سطح   / هکتار<br /></p></td>
                <td width="17%" height="35" rowspan="2" bgcolor="#006699">شهرستان </td>
                <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
              </tr>
              <tr class="text1">
                <td width="15%" bgcolor="#006699">دیم</td>
                <td width="12%" bgcolor="#006699">آبی</td>
                <td width="11%" bgcolor="#006699">دیم</td>
                <td width="9%" bgcolor="#006699">آبی</td>
                <td width="10%" bgcolor="#006699">دیم</td>
                <td width="9%" bgcolor="#006699">آبی</td>
              </tr>
              <tr>
                <?php
                $r = 1 ;
                foreach($stmt as $row){
                $t_r = $r ;
                $id_city = $row['id_city'] ;
                ?>
                <td height="78" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
                  <form name="form<?php echo $t_r ?>">
                    <input type="hidden" id="id<?php echo $t_r ?>" name="id" value="<?php echo $row['id'] ;?>" />
                    <input type="hidden" id="id_city<?php echo $t_r ?>"  name="id_city" value="<?php echo $id_city ;?>" />
                    <input type="hidden" id="id_ostan" name="id_ostan" value="<?php echo $id_ostan; ?>" />
                    <input type="hidden" id="z_sal"     name="z_sal" value="<?php echo $z_sal ;?>" />
                    <input type="hidden" id="product_cod<?php echo $t_r ?>" name="product_cod" value="<?php echo  $mah_name ;?>" />
                    <input type="hidden" id="group_cod<?php echo $t_r ?>" name="group_cod" value="<?php echo  $mah_qroup ;?>" />

                    <input name="submit"  type="submit" class="submit<?php echo $t_r ?>" id="submit<?php echo $t_r ?>" style="width:40px ; height:35px ; font-size:14px ; color:#900 ; font-family:tahoma ; text-align:center" tabindex="<?php echo ($r*10+7); ?>"  value="ثبت"  />
                    <span class="error<?php echo $t_r ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15"  alt=""/></span>
                    <span class="success<?php echo $t_r ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15"  alt=""/></span>
                  </form>
                </td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="a_dem"  type="text" class="style8" id="a_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+6); ?>"  dir="rtl" lang="fa" value="" maxlength="8"  align="baseline" xml:lang="fa" readonly /></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="a_abi"  type="text" class="style8" id="a_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+5); ?>"  dir="rtl" lang="fa" value="" maxlength="8"  align="baseline" xml:lang="fa" readonly /></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="t_dem"  type="text" class="t_dem<?php echo $t_r ?> required number input_text" id="t_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+4); ?>"  dir="rtl" lang="fa" value="<?php  echo $row['t_dem']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" /></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="t_abi"  type="text" class="t_abi<?php echo $t_r ?> required number input_text" id="t_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+3); ?>"  dir="rtl" lang="fa" value="<?php  echo $row['t_abi']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" /></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="s_dem"  type="text" class="s_dem<?php echo $t_r ?> required digits input_text" id="s_dem<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+2); ?>"  dir="rtl" lang="fa" value="<?php echo $row['s_dem']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" /></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input name="s_abi"  type="text" class="s_abi<?php echo $t_r ?> required digits input_text" id="s_abi<?php echo $t_r ?>" style="width:80px; height:30px ; " tabindex="<?php echo ($r*10+1); ?>"  dir="rtl" lang="fa" value="<?php echo $row['s_abi']*1 ; ?>" maxlength="8"  align="baseline" xml:lang="fa" /></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'] ?></td>
                <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
              </tr>
              <?php
              $r++ ;
              }
              ?>
            </table>
            <p class="style2" align="center">
            <?php
} else {
    echo '<p class="style8">اطلاعاتی یافت نشد. لطفاً گروه محصولات، نام محصول و سال زراعی را انتخاب و جستجو کنید.</p>';
}
 } else {
     echo '<p class="style8"></p>';
 }
?>
          <p><a href="Pattern.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>

<script type="text/javascript">
// jQuery برای بارگذاری پویای محصولات بر اساس گروه
$(document).ready(function() {
  $(".country").change(function() {
    var id = $(this).val();
    var dataString = 'group_cod=' + id;
    $.ajax({
      type: "POST",
      url: "ajax_city.php",
      data: dataString,
      cache: false,
      success: function(html) {
        $(".mar").html(html);
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
let isValidRow<?php echo $no ?> = {
  s_abi: true,
  s_dem: true,
  t_abi: true,
  t_dem: true
};

function handleBoxChange(boxClass, valueName) {
  $('.' + boxClass + '<?php echo $no ?>').on('change', function () {
    const value = parseFloat(unformatNumber($(this).val())) || 0;
    const s_abi = parseFloat(unformatNumber($('#s_abi<?php echo $no ?>').val())) || 0;
    const s_dem = parseFloat(unformatNumber($('#s_dem<?php echo $no ?>').val())) || 0;
    const z_sal = '<?php echo isset($z_sal) ? $z_sal : ""; ?>';
    const id_ostan = '<?php echo $id_ostan?>';
    const id_city = $('#id_city<?php echo $no ?>').val();
    const product_cod = $('#product_cod<?php echo $no ?>').val();
    const $input = $(this);

    // اعتبارسنجی برای t_abi
    if (valueName === 't_abi' && s_abi > 0 && value <= 0) {
      alert("تولید آبی نمی‌تواند مساوی یا کوچکتر از ۰ باشد.");
      $input.val('');
      $input.focus();
      isValidRow<?php echo $no ?>[valueName] = false;
      return;
    }
    
    // اعتبارسنجی برای t_dem
    if (valueName === 't_dem' && s_dem > 0 && value <= 0) {
      alert("تولید دیم نمی‌تواند مساوی یا کوچکتر از ۰ باشد.");
      $input.val('');
      $input.focus();
      isValidRow<?php echo $no ?>[valueName] = false;
      return;
    }
    
    $.post('check_s_abi2.php', {
      [valueName]: value,
      z_sal,
      id_ostan,
      id_city,
      product_cod
    }, function(response) {
      console.log('پاسخ از سرور:', response);
      if (response && !response.valid) {
        alert(response.message);
        $input.val('');
        $input.focus();

        if (boxClass.includes('abi')) {
          $('.t_abi<?php echo $no ?>').val('');
          $('.a_abi<?php echo $no ?>').val('');
        }
        if (boxClass.includes('dem')) {
          $('.t_dem<?php echo $no ?>').val('');
          $('.a_dem<?php echo $no ?>').val('');
        }
        isValidRow<?php echo $no ?>[valueName] = false;
      } else {
        isValidRow<?php echo $no ?>[valueName] = true;
      }
    }, 'json').fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error in check_s_abi2.php AJAX call:", textStatus, errorThrown);
    });
  });
}

handleBoxChange('s_abi', 's_abi');
handleBoxChange('s_dem', 's_dem');
handleBoxChange('t_abi', 't_abi');
handleBoxChange('t_dem', 't_dem');
</script>

<script>
$(function() {
  $(".submit<?php echo $no ?>").click(function() {
    const un = unformatNumber;
    const s_abi = un($("#s_abi<?php echo $no ?>").val());
    const s_dem = un($("#s_dem<?php echo $no ?>").val());
    const t_abi = un($("#t_abi<?php echo $no ?>").val());
    const t_dem = un($("#t_dem<?php echo $no ?>").val());
    const a_abi = un($("#a_abi<?php echo $no ?>").val());
    const a_dem = un($("#a_dem<?php echo $no ?>").val());
    const id = $("#id<?php echo $no ?>").val();
    const id_ostan = '<?php echo $id_ostan?>';
    const id_city = $("#id_city<?php echo $no ?>").val();
    const z_sal = $("#z_sal").val();
    const product_cod = $("#product_cod<?php echo $no ?>").val();
    const group_cod = $("#group_cod<?php echo $no ?>").val();

    const dataString = `s_abi=${s_abi}&s_dem=${s_dem}&t_abi=${t_abi}&t_dem=${t_dem}&a_abi=${a_abi}&a_dem=${a_dem}&id=${id}&id_ostan=${id_ostan}&id_city=${id_city}&z_sal=${z_sal}&product_cod=${product_cod}&group_cod=${group_cod}`;
    
    const isRowValid = Object.values(isValidRow<?php echo $no ?>).every(v => v === true);

    if (!isRowValid ||
        (parseFloat(s_abi) > 0 && parseFloat(t_abi) <= 0) ||
        (parseFloat(s_dem) > 0 && parseFloat(t_dem) <= 0)) {
      $('.success<?php echo $no ?>').fadeOut(200).hide();
      $('.error<?php echo $no ?>').fadeIn(200).show();
      alert('لطفاً مقادیر را به درستی وارد کنید. سطح نمی‌تواند با تولید صفر باشد.');
    } else {
      $.post("sabt_ab3.php", dataString, function(response) {
        if (response.trim() === 'success') {
            $('.success<?php echo $no ?>').fadeIn(200).show();
            $('.error<?php echo $no ?>').fadeOut(200).hide();
        } else {
            $('.success<?php echo $no ?>').fadeOut(200).hide();
            $('.error<?php echo $no ?>').fadeIn(200).show();
            alert('خطا در ثبت اطلاعات: ' + response);
        }
      }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error in sabt_ab2.php AJAX call:", textStatus, errorThrown);
            $('.success<?php echo $no ?>').fadeOut(200).hide();
            $('.error<?php echo $no ?>').fadeIn(200).show();
            alert('خطای شبکه یا سرور در ثبت اطلاعات.');
      });
    }
    return false;
  });
});
</script>

<script>
function formatNumberWithSeparator(num) {
  if (!num && num !== 0) return "";
  const parts = num.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "٬");
  return parts.join(".");
}

function unformatNumber(str) {
  return str ? str.replace(/٬/g, "") : "0";
}

function enforceNumericInput(el) {
  el.addEventListener('input', function() {
    let value = el.value.replace(/[^\d.]/g, '');
    const parts = value.split('.');
    if (parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');
    el.value = value ? formatNumberWithSeparator(value) : "";
  });

  el.addEventListener('paste', function() {
    setTimeout(() => {
      let value = el.value.replace(/[^\d.]/g, '');
      const parts = value.split('.');
      if (parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');
      el.value = value ? formatNumberWithSeparator(value) : "";
    }, 0);
  });
}

function calcRow(row) {
  const t_abi = parseFloat(unformatNumber(document.getElementById('t_abi'+row).value)) || 0;
  const s_abi = parseFloat(unformatNumber(document.getElementById('s_abi'+row).value)) || 0;
  const t_dem = parseFloat(unformatNumber(document.getElementById('t_dem'+row).value)) || 0;
  const s_dem = parseFloat(unformatNumber(document.getElementById('s_dem'+row).value)) || 0;

  const a_abi = s_abi > 0 ? (t_abi / s_abi * 1000).toFixed(2) : '';
  const a_dem = s_dem > 0 ? (t_dem / s_dem * 1000).toFixed(2) : '';

  document.getElementById('a_abi'+row).value = formatNumberWithSeparator(a_abi);
  document.getElementById('a_dem'+row).value = formatNumberWithSeparator(a_dem);
}

window.addEventListener('DOMContentLoaded', function() {
  let i = 1;
  while(document.getElementById('t_abi'+i)) {
    ((row) => {
      ['t_abi','s_abi','t_dem','s_dem'].forEach((field) => {
        const el = document.getElementById(field+row);
        if (el) {
          enforceNumericInput(el);
          el.addEventListener('input', () => calcRow(row));
          calcRow(row);
        }
      });
      
      document.getElementById('s_abi' + row).addEventListener('input', function() {
        document.getElementById('t_abi' + row).value = '';
      });

      document.getElementById('s_dem' + row).addEventListener('input', function() {
        document.getElementById('t_dem' + row).value = '';
      });

    })(i);
    i++;
  }
});
</script>
<?php
$no--;
}
?>
