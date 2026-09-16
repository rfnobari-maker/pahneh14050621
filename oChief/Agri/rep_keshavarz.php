<?php include('../../lock_oce.php');
$id_ostan1 = $id_ostan ; 
$id_city = $_POST['id_city'] ;
$add_bakh = $_POST['add_bakh'] ; 
$add_deh = $_POST['add_deh'] ; 
$z_sal = $_POST['z_sal'] ;
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="949" height="149" /></td>
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
include ('../../login/config.php');
?>
  </p>
  <p class="style1"> اطلاعات زراعی دهستان به تفکیک محصول</p>
  <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 450px; padding: 15px;border: 3px solid navy; margin:auto ; border-radius:15px" >
   <form method="post" name="form3" id="form3" action="#3" onsubmit="return ray.ajax()" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFCC"><font size="2" class="style1">تعیین پیش فرض ها </font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td width="319" height="51" align="right" bgcolor="#F1F1F1" class="input_text" >
        <?php $id_ostan1 = $id_ostan?>
          <select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
            <?php
$query = "SELECT id_ostan,ostan FROM ostanname where id_ostan = '$id_ostan' ORDER BY BINARY ostan ASC "  ;
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
            <option value="0"> نام بخش</option>
            <?php
$query = "SELECT DISTINCT add_bakh,bakh FROM list_abadi WHERE  id_ostan = '$id_ostan1' and  id_city = $id_city"  ;
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
            <select  name="add_deh" class="input_text" id="id_deh" style="width:170px ; height:40px" dir="rtl" >
              <option value="0">کلیه دهستان ها</option>
              <?php
$query = "SELECT DISTINCT add_deh,deh FROM list_abadi WHERE id_ostan = '$id_ostan1' and  id_city = '$id_city' and add_bakh = '$add_bakh'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
              <option value="<?php echo $row['add_deh'] ;?>"
   <?php if ($row['add_deh']==$add_deh) echo 'selected=selected'?>> <?php echo $row['deh'] ;?></option>
              <?php }?>
            </select>
          </p>
          
        </td>
        <td height="48"  align='center' bgcolor="#FFFFFF" class="style8"> : دهستان</td>
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
$add_deh = $_POST['add_deh'] ; 
$z_sal = $_POST['z_sal'] ;

if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "$Agri_prod_table.id_ostan='$id_ostan1'" ;}
if ($id_city == 0 )    { $v_id_city  = 1 ;} else { $v_id_city  = "$Agri_prod_table.id_city='$id_city'"   ;}
if ($add_bakh == 0)    { $v_add_bakh = 1 ;} else { $v_add_bakh = "list_abadi.add_bakh='$add_bakh'" ;}
if ($add_deh == 0)     { $v_add_deh  = 1 ;} else { $v_add_deh  = "list_abadi.add_deh='$add_deh'"   ;}

// برای نمایش 
$start=0;
$limit=50;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
  $query = "SELECT 
$Agri_prod_table.id_ostan,
$Agri_prod_table.id_city,
list_abadi.add_bakh,
list_abadi.add_deh,
list_abadi.ostan,
list_abadi.city,
list_abadi.bakh,
list_abadi.deh,
$Agri_prod_table.cod_mah,
product_z.product_name,
(SUM( $Agri_prod_table.zer_kesht_a ) + SUM( $Agri_prod_table.zer_kesht_b)) AS z_kesht,
SUM( $Agri_prod_table.mah_tolp ) AS mah_tolp,
(SUM( $Agri_prod_table.s_bar_a ) + SUM( $Agri_prod_table.s_bar_b )) AS s_bar,
SUM( $Agri_prod_table.mah_tol ) AS mah_tol
FROM $Agri_prod_table
INNER JOIN list_abadi ON $Agri_prod_table.add_abadi=list_abadi.add_abadi
INNER JOIN product_z  ON product_z.product_cod = $Agri_prod_table.cod_mah
where 
$Agri_prod_table.cod_mah != ''
AND $v_id_ostan  AND $v_id_city  AND $v_add_bakh  AND $v_add_deh 
GROUP BY $Agri_prod_table.cod_mah , left( $Agri_prod_table.add_abadi , 10 )
ORDER BY id_ostan,id_city,add_deh LIMIT $start, $limit "; 

$query1 = "SELECT 
$Agri_prod_table.id_ostan,
$Agri_prod_table.id_city,
list_abadi.add_bakh,
list_abadi.add_deh,
list_abadi.ostan,
list_abadi.city,
list_abadi.bakh,
list_abadi.deh,
$Agri_prod_table.cod_mah,
product_z.product_name,
(SUM( $Agri_prod_table.zer_kesht_a ) + SUM( $Agri_prod_table.zer_kesht_b)) AS z_kesht,
SUM( $Agri_prod_table.mah_tolp ) AS mah_tolp,
(SUM( $Agri_prod_table.s_bar_a ) + SUM( $Agri_prod_table.s_bar_b )) AS s_bar,
SUM( $Agri_prod_table.mah_tol ) AS mah_tol
FROM $Agri_prod_table
INNER JOIN list_abadi ON $Agri_prod_table.add_abadi=list_abadi.add_abadi
INNER JOIN product_z  ON product_z.product_cod = $Agri_prod_table.cod_mah
where 
$Agri_prod_table.cod_mah != ''
AND $v_id_ostan  AND $v_id_city  AND $v_add_bakh  AND $v_add_deh 
GROUP BY $Agri_prod_table.cod_mah , left( $Agri_prod_table.add_abadi , 10 )
ORDER BY id_ostan,id_city,add_deh  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      <form  action="rep_keshavarz_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
        <input type="hidden" name="add_bakh" value="<?php echo  $add_bakh ;?>" />
        <input type="hidden" name="add_deh" value="<?php echo  $add_deh ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo  $z_sal ;?>" />
        <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="60" height="57"  alt=""/></button>
      </form>
  <table width="90%" height="90" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="text1">
    <td width="12%" height="50" bgcolor="#999999">تولید قطعی</td>
    <td width="12%" height="50" bgcolor="#999999"><p>سطح برداشت</p></td>
    <td width="12%" bgcolor="#999999">پیش بینی تولید </td>
    <td width="12%" bgcolor="#999999">سطح زیر کشت</td>
    <td width="10%" bgcolor="#999999">نام محصول</td>
    <td width="9%" bgcolor="#999999">دهستان</td>
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
 <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['deh'];?></td>
 <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bakh'];?></td>
 <td class="normalTextSmaller" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'];?></td>
 <td class="normalTextSmaller"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan'];?></td>
 <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
}
?>
</table>
<?php 
?>
<div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;">
<?php  
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="rep_keshavarz.php?id=<?php echo $id-1 .'#3' ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
        <input type="hidden" name="add_bakh" value="<?php echo  $add_bakh ;?>" />
        <input type="hidden" name="add_deh" value="<?php echo  $add_deh ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo  $z_sal ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="rep_keshavarz.php?id=<?php echo $id+1 .'#3' ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
        <input type="hidden" name="add_bakh" value="<?php echo  $add_bakh ;?>" />
        <input type="hidden" name="add_deh" value="<?php echo  $add_deh ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo  $z_sal ;?>" />
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
      <li class='current'><form  action="rep_keshavarz.php?id=<?php echo $i .'#3'?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
        <input type="hidden" name="add_bakh" value="<?php echo  $add_bakh ;?>" />
        <input type="hidden" name="add_deh" value="<?php echo  $add_deh ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo  $z_sal ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>

           <p>&nbsp;</p><p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>