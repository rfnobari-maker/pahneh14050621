<?php include('../lock_ce.php');
include('counter.php');
$id_ostan1 = $_POST['id_ostan'] ;
$id_city1 = $_POST['id_city'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    </style>

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
-->
</style>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
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
  <p class="style1"> اطلاعات مراکز جهاد کشاورزی </p>
  <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <form method="post" name="form1" id="form3"  action="">
  <div style="width:390px; padding: 5px; border:2px solid navy; margin: auto; text-align: left; border-radius:15px ; background-color:#F1F1F1" >
   <table width="388" border='0' align="center" cellpadding='0' cellspacing='0'>
     <tr bgcolor='#f1f1f1' >
       <td height="74" align="right" bgcolor="#F1F1F1" class="input_text" >
	  <select id="province" dir="rtl"  name="id_ostan"  style="width:170px ; height:40px">
	    <option value="-1">لطفا استان را انتخاب کنید</option>
	    <?php

			// دریافت لیست استان‌ها
			$stmt = $dbh->prepare("SELECT * FROM ostanname ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21')");
			$stmt->execute();
			$provinces = $stmt->fetchAll(PDO::FETCH_ASSOC);

			// نمایش لیست استان‌ها
			foreach ($provinces as $province) {
				$selected = ($province['id_ostan'] == $id_ostan1) ? 'selected' : '';
				echo '<option value="' . $province['id_ostan'] . '" ' . $selected . '>' . $province['ostan'] . '</option>';
			}
		?>
      </select>
</td>
       <td> <div id="int" align="right">: استان</div></td>
     </tr>
     <tr bgcolor='#f1f1f1' >
       <td width="246" height="73" align="right" bgcolor="#F1F1F1" class="input_text" >
	  <select id="city" dir="rtl"  name="id_city" style="width:170px ; height:40px">
	    <option value="0">لطفا شهرستان را انتخاب کنید</option>
      </select>
</td>
       <td width="142"><div id="int" align="right">: شهرستان</div></td>
     </tr>
   </table>
   </div>
 <div align="center">
   <p>
       <input name="action" type="submit" style="width:150px ; height:45px" tabindex="12" value="جستجو" />
   </p>
 </div>
    </form>

    <?php if(isset($_POST['action']))
{
 $id_ostan = $_POST['id_ostan'] ; 
 $id_city = $_POST['id_city'] ; 
 $id_select_city = $_POST['id_city'] ; 
if ($id_ostan == -1) { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($add_deh == 0) { $v_add_deh = 1 ;} else { $v_add_deh = "add_deh='$add_deh'" ;}

$start=0;
$limit=50;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
  $query = "SELECT id_city,id_ostan,id_mar,mar,city,ostan FROM  mar where  $v_id_ostan and  $v_id_city order by id_ostan,id_city LIMIT $start, $limit "  ;
 $query1 = "SELECT id FROM  mar where  $v_id_ostan and  $v_id_city order by id_ostan,id_city  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
    <span class="style21"><a name="1" id="1"></a></span>  
  <table width="559" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <td width="118"><form  action="Promotion/Centers/list_organiz.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/centers.png" border="0"  title="مشاهده اطلاعات عمومی مرکز " width="63" height="69" /></button>
        <br />
        <span class="normalTextSmaller">تشکل ها و شرکت ها </span>
      </form></td>
      <td width="99" ><form  action="Promotion/Centers/list_supplies.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/setting.png" border="0"  title="مشاهده اطلاعات عمومی مرکز " width="63" height="69" /></button>
        <br />
        <span class="normalTextSmaller">ملزومات مرکز </span>
      </form></td>
      <td width="102" height="123" >
      <form  action="Promotion/Centers/list_personnel.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/morvege1.png" border="0"  title="مشاهده اطلاعات عمومی مرکز " width="63" height="69" /></button>
        <br />
        <span class="normalTextSmaller">اطلاعات پرسنلی </span>
      </form></td>
      <td width="104" height="123" ><form  action="Promotion/Centers/list_build.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/repair.png" border="0"  title="مشاهده اطلاعات ساختمان مرکز " width="63" height="69" /></button>
        <br />
        <span class="normalTextSmaller">اطلاعات ساختمان </span>
      </form></td>
      <td width="104"><form  action="Promotion/Centers/list_public.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
         <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/p_abadi.png" border="0"  title="مشاهده اطلاعات عمومی مرکز " width="63" height="69" /></button>
        <br />
        <span class="normalTextSmaller">اطلاعات عمومی </span>
      </form></td>
    </tr>
  </table>
  <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
  <table width="138" height="56" border="0" align="center">
    <tr>
      <td width="66"><form  action="list_center_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
        <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="42" height="42"  alt=""/></button>
      </form></td>
      <td width="124"><form  action="list_center_doc.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
        <button><img src="../files/word.png" title="دانلود نتایج با فرمت فایل اکسل"  width="42" height="42"  alt=""/></button>
      </form></td>
    </tr>
  </table>
  <table width="95%" height="145" border="0" align="center" cellpadding="0" cellspacing="2" >
    <tr align="center" class="text1">
      <td height="35" colspan="5" bgcolor="#999999">اطلاعات اختصاصی مرکز جهاد کشاورزی </td>
      <td colspan="3" bordercolor="#FFFFFF" bgcolor="#999999">مشخصات رئیس مرکز</td>
      <td width="15%" rowspan="2" bgcolor="#999999">مرکز جهاد کشاورزی</td>
      <td width="11%" rowspan="2" bgcolor="#999999">شهرستان</td>
      <td width="12%" rowspan="2" bgcolor="#999999">استان</td>
      <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
    <tr align="center" class="text1">
      <td height="44" bgcolor="#999999">تشکل ها </td>
      <td bgcolor="#999999">ملزومات</td>
      <td height="44" bgcolor="#999999">پرسنل</td>
      <td height="44" bgcolor="#999999">اطلاعات ساختمان</td>
      <td height="44" bgcolor="#999999">اطلاعات عمومی</td>
      <td width="10%" bordercolor="#FFFFFF" bgcolor="#999999">نام خانوادگی</td>
      <td width="7%" bordercolor="#FFFFFF" bgcolor="#999999">نام</td>
      <td width="6%" bordercolor="#FFFFFF" bgcolor="#999999">تصویر</td>
    </tr>
    <tr>
      <?php
$r = $start+1 ;
 foreach($stmt as $row){
$id_city = $row['id_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_mar = $row['id_mar'] ;
$query2 = "SELECT id_ostan,id_mar,id_city,Last_name,name,pic FROM  users WHERE  id_mar = '$id_mar' and id_city = '$id_city' and id_ostan = '$id_ostan' and  S_access = '2'"  ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'
?>
      <td width="6%" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
      <form  action="Promotion/Centers/organiz.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $row2['id_ostan'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $row2['id_mar'] ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $row2['id_city'] ;?>" />
         <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/centers.png" border="0"  title="مشاهده اطلاعات تشکل و شرکت های مرکز " width="31" height="37" /></button>
      </form></td>
      <td width="7%" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
      <form  action="Promotion/Centers/supplies.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $row2['id_ostan'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $row2['id_mar'] ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $row2['id_city'] ;?>" />
         <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/setting.png" border="0"  title="مشاهده اطلاعات ملزومات مرکز " width="31" height="37" /></button>
      </form></td>
      <td width="6%" height="58" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
      <form  action="Promotion/Centers/personnel.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $row2['id_ostan'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $row2['id_mar'] ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $row2['id_city'] ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/morvege1.png" border="0"  title="مشاهده اطلاعات پرسنلی مرکز " width="31" height="37" /></button>
      </form></td>
      <td width="8%" height="58" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
      <form  action="Promotion/Centers/building.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $row2['id_ostan'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $row2['id_mar'] ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $row2['id_city'] ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/repair.png" border="0"  title="مشاهده اطلاعات ساختمان مرکز " width="31" height="37" /></button>
      </form></td>
      <td width="7%"  class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
      <form  action="Promotion/Centers/public.php" method="post">
      <input type="hidden" name="id_ostan" value="<?php echo $row2['id_ostan'] ;?>" />
      <input type="hidden" name="id_mar" value="<?php echo $row2['id_mar'] ;?>" />
      <input type="hidden" name="id_city" value="<?php echo $row2['id_city'] ;?>" />
      <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
      <button class="tilt"><img src="../files/p_abadi.png" border="0"  title="مشاهده اطلاعات عمومی مرکز " width="31" height="37" /></button>
      </form></td>
      <td bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['Last_name'];?></td>
      <td bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['name'];?></td>
      <td bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/></span></td>
      <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['mar'];?><br />
        <?php echo $row['id_mar'];?></td>
      <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['city'];?></td>
      <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['ostan'];?></td>
      <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
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
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);
if($id>1)
{
	?>
    <form  action="list_center.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="list_center.php?id=<?php echo $id+1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
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
      <li class='current'><form  action="list_center.php?id=<?php echo $i?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
  <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/></a></p>
  </p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
    <script>
		$(document).ready(function() {
			// وقتی یک استان انتخاب می‌شود
			$('#province').change(function() {
				var provinceId = $(this).val();

				// دریافت لیست شهرستان‌های این استان
				$.ajax({
					url: '../get_cities.php',
					type: 'POST',
					data: {province_id: provinceId},
					dataType: 'json',
					success: function(response) {
						// پاک کردن لیست شهرستان‌ها و مراکز
						$('#city').empty();
						$('#center').empty();

						// نمایش لیست شهرستان‌ها
						$('#city').append('<option value="">لطفا شهرستان را انتخاب کنید</option>');
						$.each(response.cities, function(index, city) {
							$('#city').append('<option value="' + city.id_city + '">' + city.city + '</option>');
						});
					},
					error: function() {
						alert('خطا در دریافت لیست شهرستان‌ها');
					}
				});
			});

			// وقتی یک شهرستان انتخاب می‌شود
			$('#city').change(function() {
				var cityId = $(this).val();
                var provinceId = $('#province').val();
				// دریافت لیست مراکز این شهرستان
				$.ajax({
					url: '../get_centers.php',
					type: 'POST',
					data: {province_id: provinceId,city_id: cityId},
					dataType: 'json',
					success: function(response) {
						// پاک کردن لیست مراکز
						$('#center').empty();

						// نمایش لیست مراکز
						$('#center').append('<option value="">لطفا مرکز را انتخاب کنید</option>');
						$.each(response.centers, function(index, center) {
							$('#center').append('<option value="' + center.id_mar + '">' + center.mar + '</option>');
						});
					},
					error: function() {
						alert('خطا در دریافت لیست مراکز');
					}
				});
			});
		});

	</script>

</html>



