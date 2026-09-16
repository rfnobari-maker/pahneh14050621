<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=فرم های ثبت شده.doc");
include('../lock_ce.php');
include('counter.php');
$sal = $_POST['sal'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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

-->
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
<?php include('../login/config.php');
$query = "SELECT  DISTINCT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center" dir="rtl" class="style8">فرم های ثبت شده به تفکیک استان و نوع بهره برداری  در <?php echo $sal ?></p>
 <table width="85%" height="107" border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="text1">
     <td align="center" height="26" bgcolor="#999999">آبزی پروری</td>
     <td align="center" bgcolor="#999999">گلخانه</td>
     <td align="center" bgcolor="#999999">باغی</td>
     <td align="center" width="15%" bgcolor="#999999">زراعی</td>
    <td align="center" width="15%" bgcolor="#999999">تعداد بهره بردار</td>
    <td align="center" width="20%" bgcolor="#999999">استان </td>
    <td align="center" width="6%" bgcolor="#999999">ردیف</td>
   </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
$id_ostan = $row['id_ostan'] ;
$query2 = "SELECT id,username,tel_m,cod_m,Last_name,name,pic FROM  users WHERE  id_ostan = '$id_ostan' and  chief = '1' "  ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
//echo $row2['User_Name'] ; 
?>
   <td align="center" width="15%" height="29"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Aquatic_count($row['id_ostan'],$sal) ?></td>
    <td align="center" width="16%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Greenhous_count($row['id_ostan'],$sal) ?></td>
    <td align="center" width="13%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Garden_count($row['id_ostan'],$sal) ?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Agri_count($row['id_ostan'],$sal) ?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_count($row['id_ostan']);?></td>
    <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['ostan'];?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
  <tr>
     <td align="center" height="25" bgcolor="#CCCCCC"  class="morph"  >آبزی پروری</td>
     <td align="center" bgcolor="#CCCCCC"  class="morph"  >گلخانه</td>
     <td align="center" bgcolor="#CCCCCC"  class="morph"  >باغی<br />
    </td>
     <td align="center" bgcolor="#CCCCCC"  class="morph"  >زراعی</td>
    <td align="center" bgcolor="#CCCCCC"  class="morph"  >بهره بردار</td>
    <td align="center" colspan="2" rowspan="2" bgcolor="#FFFFCC"   class="morph">جمع کل</td>
   </tr>
  <tr>
    <td align="center" height="25" bgcolor="#FFFFCC"  class="normalTextSmaller"  ><?php echo total_Aquatic_count($sal)?></td>
    <td align="center" bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo total_Greenhous_count($sal)?></td>
    <td align="center" bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo total_Garden_count($sal)?></td>
    <td align="center" bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo total_Agri_count($sal)?></td>
    <td align="center" bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo kol_bah_count();?></td>
   </tr>

</table>
 <p align="center">-------------------- پایان گزارش -------------------</p>
</body>
</html>



