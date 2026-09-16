<?php 
include('../lock_oce.php');
include('../event.php');
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
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
    function target_popup3(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=1000,height=600"); 
    form.target = 'formpopup'; 
	}
   </script>

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
?>
  </p>
  <p class="style1"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 500px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style1">آبادی های دارای مغایرت شهرستان / کارشناس</span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#F1F1F1" class="input_text" ><form method="post" name="form1" id="form"  action="">
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#F1F1F1" class="input_text" ><form method="post" name="form1" id="form2"  action="#1">
          <select dir="rtl"  name="id_city" id="id_city" style="width:170px ; height:40px"  onchange="this.form.submit()">
            <option value="0">انتخاب شهرستان</option>
            <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' ORDER BY BINARY city ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
            <?php 
		   }?>
          </select>
          <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
        </form>
          <?php if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
        <td><font size="2" class="style8">: شهرستان</font></td>
      </tr>
      <tr >
        <td height="23" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >
          <form method="post" name="form3" id="form3"  action="#1">
            <p>
              <select dir="rtl"  name="id_mar" id="bakh" style="width:170px ; height:40px">
                <option value="0"> نام مرکز</option>
                <?php
$query = "SELECT DISTINCT id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan' and id_city = '$id_city'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
                <?php }?>
                </select>
              </p>
            <p>
              <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
              <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
              <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
              </p>
            </form></td>
        <td width="163" height="47"  align='center' bgcolor="#FFFFFF" class="style8"><font size="2" class="style8">: مرکز خدمات</font></td>
      </tr>
      <tr >
        <td height="29"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
      </tr>
    </table>
</div>

  <p>
  <?php if(isset($_POST['action']))
{
 $id_city = $_POST['id_city'] ; 
 $id_mar = $_POST['id_mar'] ; 
if ($id_ostan == '') { $v_id_ostan = 1 ;} else { $v_id_ostan = "list_abadi.id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 1 ;} else { $v_id_city = "list_abadi.id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 1 ;} else { $v_id_mar = "list_abadi.id_mar='$id_mar'" ;}
 // برای نمایش 
$start=0;
$limit=100;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
  $query = "SELECT list_abadi.mor_cod_m,list_abadi.ostan,list_abadi.city,list_abadi.mar,list_abadi.abadi,list_abadi.add_abadi
,users.id_ostan as user_id_ostan, users.id_city as user_id_city,users.id_mar as user_id_mar,users.Last_name,users.name
FROM list_abadi
inner join users ON list_abadi.mor_cod_m = users.username and (list_abadi.id_mar != users.id_mar or list_abadi.id_city != users.id_city)
 where  $v_id_ostan and  $v_id_city and $v_id_mar    ORDER BY  list_abadi.add_abadi ASC LIMIT $start, $limit "; 
$query1 = "SELECT list_abadi.id FROM list_abadi
inner join users ON list_abadi.mor_cod_m = users.username and list_abadi.id_mar != users.id_mar where  $v_id_ostan and  $v_id_city and $v_id_mar   ORDER BY  list_abadi.add_abadi ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span><br />
  </p>
  <table width="79" height="56" border="0" align="center">
    <tr>
      <td width="73"><form  action="lists_abadi_conflict_mor_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo  $id_mar;?>" />
        <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="42" height="42"  alt=""/></button>
      </form></td>
      </tr>
  </table>
  <br />
  <table width="95%" height="136" border="1" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="text1">
      <td colspan="5" bgcolor="#999999" >موقعیت کارشناس</td>
      <td height="49" colspan="5" bgcolor="#999999">موقعیت آبادی </td>
      <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
    <tr align="center" class="text1">
               <td width="8%" bgcolor="#999999" >کد ملی کارشناس</td>
               <td width="11%" bgcolor="#999999">نام و نام خانوادگی کارشناس</td>
               <td width="10%" bgcolor="#999999">مرکز </td>
               <td width="11%" bgcolor="#999999" >شهرستان</td>
               <td width="9%" bgcolor="#999999">استان</td>
               <td width="14%" height="49" bgcolor="#999999">آدرس آماری آبادی</td>
    <td width="8%" bgcolor="#999999">نام آبادی</td>
    <td width="6%" bgcolor="#999999">مرکز </td>
    <td width="9%" bgcolor="#999999" >شهرستان</td>
    <td width="10%" bgcolor="#999999">استان</td>
    </tr>
  <tr>
   
<?php
$r = $start+1 ;
 foreach($stmt as $row){
?>
 <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ;?></td>
 <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['Last_name'].'-'.$row['name'];?></td>
 <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['user_id_mar']); ?></td>
 <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['user_id_city'],$row['user_id_ostan']) ; ?></td>
 <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['user_id_ostan']);?></td>
<td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> height="38" class="normalTextSmaller"><?php echo $row['add_abadi'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mar'];?></td>
    <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['city'];?></td>
    <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['ostan'];?></td>
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
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);
if($id>1)
{
?>
    <form  action="lists_abadi_conflict_mor.php?id=<?php echo $id-1 ?>" method="post">
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
    <form  action="lists_abadi_conflict_mor.php?id=<?php echo $id+1 ?>" method="post">
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
      <li class='current'><form  action="lists_abadi_conflict_mor.php?id=<?php echo $i?>" method="post">
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
           <p> <p><a href="cities&villages.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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



