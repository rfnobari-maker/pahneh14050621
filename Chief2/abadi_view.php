<?php include('../lock_ce.php');
include('counter.php');
// استفاده از filter_input برای دریافت داده‌های POST و جلوگیری از SQL Injection
$id_ostan1 = filter_input(INPUT_POST, 'id_ostan', FILTER_SANITIZE_NUMBER_INT);
$id_city1 = filter_input(INPUT_POST, 'id_city', FILTER_SANITIZE_NUMBER_INT);
$id_mar = filter_input(INPUT_POST, 'id_mar', FILTER_SANITIZE_NUMBER_INT);
$id_deh = filter_input(INPUT_POST, 'id_deh', FILTER_SANITIZE_NUMBER_INT);
$sal = filter_input(INPUT_POST, 'sal', FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
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
  <p>
    <?php 
include('top.php'); 
include ('../login/config.php');
?>
  </p>
  <p class="style1">اطلاعات کلی آبادی </p>
  <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 550px; padding: 15px;border: 2px solid navy; margin:auto ; border-radius:15px" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
  <tr bgcolor='#f1f1f1'>
    <td align="right" bgcolor="#FFFFFF" class="input_text">
      <form method="post" name="form_year" id="form_year" action="">
        <select dir="rtl" name="sal" id="sal" style="width:170px ; height:40px" onchange="this.form.submit()">
          <option value="">انتخاب سال</option>
          <?php
          // ایجاد یک حلقه برای سال‌ها، از 1400 تا 1405 به عنوان مثال
          for ($i = 1400; $i <= 1403; $i++) {
          ?>
          <option value="<?php echo $i; ?>"
              <?php if ($i == $sal) echo 'selected=selected'; ?>>
            <?php echo $i; ?>
            </option>
          <?php } ?>
          </select>
        </form>
      <?php if (isset($_POST['sal'])) $sal = $_POST['sal']; ?>
      </td>
    <td align='center' bgcolor="#FFFFFF" class="style1">
      <font size="2" class="style8">:سال</font>
      </td>
  </tr>
  <tr bgcolor='#f1f1f1'>
    <td align="right" bgcolor="#F1F1F1" class="input_text">
      <form method="post" name="form1" id="form" action="">
        <select dir="rtl" name="id_ostan" id="id_ostan" style="width:170px ; height:40px" onchange="this.form.submit()">
          <option value="-1">انتخاب استان</option>
          <?php
          $query = "SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC";
          $stmt = $dbh->prepare($query);
          $stmt->execute();
          foreach ($stmt as $row) {
          ?>
            <option value="<?php echo $row['id_ostan']; ?>"
              <?php if ($row['id_ostan'] == $id_ostan1) echo 'selected=selected'; ?>>
              <?php echo $row['ostan']; ?>
            </option>
          <?php } ?>
        </select>
        <input name="sal" type="hidden" value="<?php echo $sal; ?>" />
      </form>
      <?php if (isset($_POST['id_ostan'])) $id_ostan = $_POST['id_ostan']; ?>
    </td>
    <td align='center' bgcolor="#F1F1F1" class="style1" style="color: #F1F1F1">
      <font size="2" class="style8">:استان<font size="2" class="style8"><span class="style21"><a name="1" id="1"></a></span></font></font>
    </td>
  </tr>
  <tr bgcolor='#f1f1f1'>
    <td align="right" bgcolor="#FFFFFF" class="input_text">
      <form method="post" name="form1" id="form2" action="#1">
        <select dir="rtl" name="id_city" id="id_city" style="width:170px ; height:40px" onchange="this.form.submit()">
          <option value="0">انتخاب شهرستان</option>
          <?php
          $query = "SELECT id_city, city FROM cityname WHERE id_ostan = '$id_ostan' ORDER BY BINARY city ASC";
          $stmt = $dbh->prepare($query);
          $stmt->execute();
          foreach ($stmt as $row) {
          ?>
            <option value="<?php echo $row['id_city']; ?>"
              <?php if ($row['id_city'] == $id_city1) echo 'selected=selected'; ?>>
              <?php echo $row['city']; ?>
            </option>
          <?php } ?>
        </select>
        <input name="id_ostan" type="hidden" value="<?php echo $id_ostan; ?>" />
        <input name="sal" type="hidden" value="<?php echo $sal; ?>" />
      </form>
      <?php if (isset($_POST['id_city'])) $id_city = $_POST['id_city']; ?>
    </td>
    <td align='center' bgcolor="#FFFFFF" class="style1">
      <font size="2" class="style8">:شهرستان</font>
    </td>
  </tr>
  <tr>
    <td bgcolor="#f1f1f1" class="input_text" align="right">
      <form method="post" name="form2" id="form2">
        <select dir="rtl" name="id_mar" id="bakh" style="width:170px ; height:40px" onchange="this.form.submit()">
          <option value="0">نام مرکز</option>
          <?php
          $query = "SELECT DISTINCT id_mar, mar FROM list_abadi WHERE id_ostan = '$id_ostan' and id_city = '$id_city'";
          $stmt = $dbh->prepare($query);
          $stmt->execute();
          foreach ($stmt as $row) {
          ?>
            <option value="<?php echo $row['id_mar']; ?>"
              <?php if ($row['id_mar'] == $id_mar) echo 'selected=selected'; ?>>
              <?php echo $row['mar']; ?>
            </option>
          <?php } ?>
        </select>
        <input name="id_ostan" type="hidden" value="<?php echo $id_ostan; ?>" />
        <input name="id_city" type="hidden" value="<?php echo $id_city; ?>" />
        <input name="sal" type="hidden" value="<?php echo $sal; ?>" />
      </form>
      <?php if (isset($_POST['id_mar'])) $id_mar = $_POST['id_mar']; ?>
    </td>
    <td width="149" align='center' bgcolor="#F1F1F1" class="style1">
      <font size="2" class="style8">: مرکز خدمات<span class="style21"><a name="1" id="12"></a></span></font>
    </td>
  </tr>
  <tr>
    <td height="6" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text">
      <form method="post" name="form3" id="form3" action="#3" onsubmit="return ray.ajax()">
        <p>
          <select dir="rtl" name="id_deh" id="id_deh" style="width:170px ; height:40px">
            <option value="0">کلیه دهستان ها</option>
            <?php
            $query = "SELECT DISTINCT add_deh, deh FROM list_abadi WHERE id_mar = '$id_mar'";
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            foreach ($stmt as $row) {
            ?>
              <option value="<?php echo $row['add_deh']; ?>"
                <?php if ($row['add_deh'] == $add_deh) echo 'selected=selected'; ?>>
                <?php echo $row['deh']; ?>
              </option>
            <?php } ?>
          </select>
        </p>
        <p>
          <input name="id_ostan" type="hidden" value="<?php echo $id_ostan; ?>" />
          <input name="id_city" type="hidden" value="<?php echo $id_city; ?>" />
          <input name="id_mar" type="hidden" value="<?php echo $id_mar; ?>" />
          <input name="sal" type="hidden" value="<?php echo $sal; ?>" />
          <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
        </p>
      </form>
    </td>
    <td height="26" align='center' bgcolor="#FFFFFF" class="style8">: دهستان</td>
  </tr>
  <tr>
    <td height="24" align='center' bgcolor="#FFFFFF" class="style8">&nbsp;</td>
  </tr>
    </table>

  </div>

  <p>
<?php
if (isset($_POST['action'])) {
    // دریافت مقادیر از فرم
    $id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
    $id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
    $id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
    $add_deh = isset($_POST['id_deh']) ? $_POST['id_deh'] : '';
    $sal = isset($_POST['sal']) ? $_POST['sal'] : '';

    if (!empty($sal)) {
        // محاسبه سال قبلی و تنظیم مقادیر متغیرها
        $previous_sal = $sal - 1;
        $Agri_prod = "Agri_prod{$previous_sal}_{$sal}";
        $z_sal = "{$previous_sal}-{$sal}"; // تغییر به `_` برای جداسازی سال‌ها
    } else {
        $z_sal = '';
        $Agri_prod = '';
    }

    // نمایش مقادیر متغیرها
    echo '<p>' . htmlspecialchars($Agri_prod) . '</p>';
    echo '<p>' . htmlspecialchars($z_sal) . '</p>';

if ($id_ostan == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "list_abadi.id_ostan='$id_ostan'" ;}
if ($id_city  == 0)    { $v_id_city  = 1 ;} else { $v_id_city  = "list_abadi.id_city ='$id_city'" ;}
if ($id_mar   == 0)    { $v_id_mar   = 1 ;} else { $v_id_mar   = "list_abadi.id_mar  ='$id_mar'" ;}
if ($add_deh  == 0)    { $v_add_deh  = 1 ;} else { $v_add_deh  = "list_abadi.add_deh ='$add_deh'" ;}

// برای نمایش 
$start=0;
$limit=50;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query = "SELECT list_abadi.add_abadi,
list_abadi.ostan,
list_abadi.city,
list_abadi.deh,
list_abadi.abadi ,
COUNT(bah.add_abadi) AS kol_bah ,
SUM(CASE WHEN no_kesh = '1' THEN $Agri_prod.zer_kesht_a ELSE 0 END) AS zer_kesht1 ,
SUM(CASE WHEN no_kesh = '2' THEN $Agri_prod.zer_kesht_a ELSE 0 END) AS zer_kesht2 ,
COUNT(DISTINCT $Agri_prod.cod_mah) AS t_mah_z
FROM  list_abadi 
inner join bah ON bah.add_abadi = list_abadi.add_abadi  
inner join $Agri_prod ON $Agri_prod.add_abadi = list_abadi.add_abadi  
inner join Vege_prod ON Vege_prod.add_abadi = list_abadi.add_abadi  and Vege_prod.z_sal = '$z_sal'
  where  $v_id_ostan and  $v_id_city and $v_id_mar   and  $v_add_deh 
  group by list_abadi.add_abadi
   ORDER BY BINARY list_abadi.abadi ASC LIMIT $start, $limit "; 
$query1 = "SELECT count(*) FROM  list_abadi where  $v_id_ostan and  $v_id_city and $v_id_mar  and $v_add_deh   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>  
  <span class="style21"><a name="3" id="13"></a></span>
  <table width="95%" height="100" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="text1">
    <td height="50" colspan="3" bgcolor="#999999">&nbsp;</td>
    <td width="6%" height="50" bgcolor="#999999">تنوع محصولات زراعی</td>
    <td bgcolor="#999999">زیر کشت زراعی دیم<br />
هکتار</td>
    <td bgcolor="#999999">زیر کشت زراعی آبی<br />
      هکتار</td>
    <td width="6%" bgcolor="#999999">تعداد کل<br />
بهره بردار</td>
    <td width="11%" bgcolor="#999999">نام آبادی</td>
    <td width="8%" bgcolor="#999999">دهستان</td>
    <td width="8%" bgcolor="#999999">شهرستان</td>
    <td width="8%" bgcolor="#999999">استان</td>
    <td width="3%" bgcolor="#999999">ردیف</td>

  </tr>
  <tr>
<?php
$r = $start+1 ;
 foreach($stmt as $row){
$cod_m = $row['mor_cod_m'] ;
$add_abadi = $row['add_abadi'] ;
?>
<td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="5%" height="59" class="normalTextSmaller">&nbsp;</td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="5%" class="normalTextSmaller">&nbsp;</td>
<td width="24%">&nbsp;</td>
   <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['t_mah_z']?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> width="8%" class="normalTextSmaller"><?php echo $row['zer_kesht2']*1?></td>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> width="8%" class="normalTextSmaller"><?php echo $row['zer_kesht1']*1?></td>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['kol_bah']?> </td>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['abadi'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['deh'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
}
?>
</table>
<?php 
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1->fetchColumn();
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="listpublic_abadi.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
         <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
         <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_deh" value="<?php echo $add_deh ?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="listpublic_abadi.php?id=<?php echo $id+1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
         <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
         <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_deh" value="<?php echo $add_deh ?>" />
        <button class='button' >بعدی</button>
      </form>
    <?php 
}

echo "<ul class='page'>";

		for($i=1;$i<=$total;$i++)
		{
			if($i==$id) { echo "<li class='current'>".$i."</li>"; }
			else { 
			?>
      <li class='current'><form  action="listpublic_abadi.php?id=<?php echo $i?>" method="post">
        <input type="hidden" name="action" value="1" />
         <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
         <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_deh" value="<?php echo $add_deh ?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>

           <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
