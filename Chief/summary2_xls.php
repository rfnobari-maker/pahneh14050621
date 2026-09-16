<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=بهره برداری های ثبت شده.xls");
include('../lock_ce.php');
include('counter9.php');
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
<?php include_once('../login/config.php');
$query = "SELECT  DISTINCT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center" class="style8">بهره برداری های ثبت شده به تفکیک استان و نوع بهره برداری  در<?php echo $sal ?></p>
 <table width="85%" height="107" border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="text1">
     <td width="10%" height="26" align="center" bgcolor="#999999">صنایع</td>
     <td width="12%" align="center" bgcolor="#999999">زنبورعسل</td>
     <td align="center" bgcolor="#999999">آبزی پروری</td>
     <td align="center" bgcolor="#999999">قارچ</td>
     <td align="center" bgcolor="#999999">گلخانه</td>
     <td align="center" bgcolor="#999999">باغی</td>
     <td align="center" width="8%" bgcolor="#999999">صیفی</td>
     <td align="center" width="7%" bgcolor="#999999">زراعی</td>
    <td align="center" width="9%" bgcolor="#999999">تعداد بهره بردار</td>
    <td align="center" width="13%" bgcolor="#999999">استان </td>
    <td align="center" width="5%" bgcolor="#999999">ردیف</td>
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
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_ind_count($row['id_ostan'],$sal) ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bee_count($row['id_ostan'],$sal) ?></td>
    <td align="center" width="10%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Aquatic_count2($row['id_ostan'],$sal) ?></td>
    <td align="center" width="9%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Mushroom_count($row['id_ostan'],$sal) ?></td>
    <td align="center" width="9%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Greenhous_count2($row['id_ostan'],$sal) ?></td>
    <td align="center" width="8%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Garden_count2($row['id_ostan'],$sal) ?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Vege_count($row['id_ostan'],$sal) ?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Agri_count2($row['id_ostan'],$sal) ?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_count($row['id_ostan']);?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['ostan'];?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
  <tr>
    <td align="center" bgcolor="#CCCCCC" class="morph">صنایع</td>
    <td align="center" bgcolor="#CCCCCC" class="morph">زنبور عسل </td>
     <td align="center" bgcolor="#CCCCCC"  class="morph"  >آبزی پروری</td>
     <td align="center" bgcolor="#CCCCCC"  class="morph"  >قارچ</td>
     <td align="center" bgcolor="#CCCCCC"  class="morph"  >گلخانه</td>
     <td align="center" bgcolor="#CCCCCC"  class="morph"  >باغی<br />
    </td>
     <td align="center" bgcolor="#CCCCCC"  class="morph"  >صیفی</td>
     <td align="center" bgcolor="#CCCCCC"  class="morph"  >زراعی</td>
    <td align="center" bgcolor="#CCCCCC"  class="morph"  >بهره بردار</td>
    <td align="center" colspan="2" rowspan="2" bgcolor="#FFFFCC"   class="morph">جمع کل</td>
   </tr>
  <tr>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller"  ><?php echo total_ind_count($sal)?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller"  ><?php echo total_bee_count($sal)?></td>
    <td align="center" bgcolor="#FFFFCC"  class="normalTextSmall"  ><span class="normalTextSmaller"><?php echo total_Aquatic_count2($sal)?></span></td>
    <td align="center" bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo total_Mushroom_count($sal)?></td>
    <td align="center" bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo total_Greenhous_count2($sal)?></td>
    <td align="center" bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo total_Garden_count2($sal)?></td>
    <td align="center" bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo total_Vege_count($sal)?></td>
    <td align="center" bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo total_Agri_count2($sal)?></td>
    <td align="center" bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo kol_bah_count();?></td>
   </tr>

</table>
 <p align="center">-------------------- پایان گزارش -------------------</p>
</body>
</html>



