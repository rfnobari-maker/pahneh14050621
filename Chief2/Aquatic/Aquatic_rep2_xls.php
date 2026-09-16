<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=تولید_مزارع.xls");
include('../../lock_ce.php');
include('../../event.php');
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if(isset($_POST['sal'])) $sal = $_POST['sal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
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
</head>
<body>
  <?php if((isset($_POST['sal'])))
{
	include('../../login/config.php');
$sal = $_POST['sal'];
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if ($id_ostan1 == '') 
{
 $query = "SELECT id_ostan,sum(tak1) as tak1,sum(tak2) as tak2,sum(tak3) as tak3,sum(tak4) as tak4,sum(tak5) as tak5
 ,sum(par1) as par1 ,sum(par2) as par2,sum(par3) as par3,sum(par4) as par4
 FROM Aquatic WHERE sal = '$sal' group by id_ostan 
 ORDER BY  FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21')
 "  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT id_city,sum(tak1) as tak1,sum(tak2) as tak2,sum(tak3) as tak3,sum(tak4) as tak4,sum(tak5) as tak5
 ,sum(par1) as par1 ,sum(par2) as par2,sum(par3) as par3,sum(par4) as par4 FROM Aquatic WHERE sal = '$sal' and id_ostan = '$id_ostan1' group by id_city "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center">گزارش عملکرد مزارع تکثیر و پرورش آبزیان در سال <?php echo $sal?></p>
  <table width="99%" height="279" border="1" bordercolor="#00CCFF" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="text1">
               <td height="25" colspan="4" bgcolor="#999999">پرورش<span class="style2"><br /> 
                تن</span><br /></td>
               <td colspan="5" bgcolor="#999999">تکثیر<span class="style2"> <br />
                هزار قطعه</span><br /></td>
               <td width="14%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?><br /></td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">میگوی و<br />
                 شاه میگو<br /></td>
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
               <td width="11%" bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
               <td width="10%" height="43" bordercolor="#0099CC" bgcolor="#999999">ماهیان زینتی<br /></td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">میگوی و<br />
                شاه میگو<br /></td>
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
               <td width="10%" bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
    </tr>
             <tr>
               <?php
$r = 1 ;
  foreach($stmt as $row){
	  if($row['no_fa'] == '1') $v_no_fa = 'تکثیر' ; 
	  if($row['no_fa'] == '2') $v_no_fa = 'پرورش' ; 
  	  if($row['no_fa'] == '3') $v_no_fa = 'تکثیر و پرورش' ; 
 ?>
               
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par4']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par3']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par2']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par1']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak5']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak4']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak3']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak2']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak1']?></td>
               <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >
                 <?php if($id_ostan1=='') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$id_ostan1)  ; ?>
               <td align="center"class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
if ($id_ostan1 == '') 
{
 $query = "SELECT sum(tak1) as tak1,sum(tak2) as tak2,sum(tak3) as tak3,sum(tak4) as tak4,sum(tak5) as tak5
 ,sum(par1) as par1 ,sum(par2) as par2,sum(par3) as par3,sum(par4) as par4 FROM Aquatic WHERE sal = '$sal' 
 ORDER BY no_fa
 "  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT sum(tak1) as tak1,sum(tak2) as tak2,sum(tak3) as tak3,sum(tak4) as tak4,sum(tak5) as tak5
 ,sum(par1) as par1 ,sum(par2) as par2,sum(par3) as par3,sum(par4) as par4 FROM Aquatic WHERE sal = '$sal' and id_ostan = '$id_ostan1'  "  ;
}
?>
             <tr align="center" class="text1">
               <td height="25" colspan="4" bgcolor="#999999">پرورش<span class="style2"><br />
                 تن</span><br /></td>
               <td colspan="5" bgcolor="#999999">تکثیر<span class="style2"> <br />
                 هزار قطعه</span><br /></td>
               <td rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?>
                 <br /></td>
               <td rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td bordercolor="#0099CC" bgcolor="#999999">میگوی و<br />
                 شاه میگو<br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
               <td height="43" bordercolor="#0099CC" bgcolor="#999999">ماهیان زینتی<br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">میگوی و<br />
                 شاه میگو<br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
             </tr>

<?php
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

             <tr>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par4']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par3']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par2']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par1']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak5']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak4']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak3']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak2']?></td>
               <td align="center" height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak1']?></td>
               <td align="center" colspan="2"   <?php  echo 'bgcolor=#ffcc99' ?>>مجموع کل</td>
             </tr>
</table>
<?php }?>
</body>
</html>