<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=آمار_مزارع.xls");
include('../../lock_ce.php');
include('../../event.php');
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
 $query = "SELECT id_ostan,ostan FROM ostanname WHERE 1 ORDER BY  FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21') "  ;  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT id_ostan,id_city,city FROM cityname WHERE id_ostan = '$id_ostan1'  "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center">آمار مزارع تکثیر و پرورش آبزیان در سال <?php echo $sal?></p>
<table width="85%" height="178" border="1" bordercolor="#00CCFF" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="text1">
    <td height="52" colspan="2" bgcolor="#999999" class="style19">جمع</td>
    <td height="52" colspan="2" bgcolor="#999999" class="style19">تکثیر و پرورش</td>
    <td colspan="2" bgcolor="#999999" class="style19">پرورش</td>
    <td colspan="2" bgcolor="#999999" class="style19">تکثیر</td>
    <td width="13%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?>
      <br /></td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
  </tr>
  <tr align="center" class="text1">
    <td width="16%" height="40" bgcolor="#999999">مساحت زمین/
<span class="style8">مترمربع</span></td>
    <td width="6%" bgcolor="#999999">تعداد واحد</td>
    <td width="17%" height="40" bgcolor="#999999">مساحت زمین/
      <span class="style8">مترمربع</span></td>
    <td width="6%" bgcolor="#999999">تعداد واحد</td>
    <td width="14%" bgcolor="#999999">مساحت زمین/<span class="style8">مترمربع</span></td>
    <td width="6%" bgcolor="#999999">تعداد واحد</td>
    <td width="13%" bgcolor="#999999">مساحت زمین/<span class="style8">مترمربع</span></td>
    <td width="5%" bgcolor="#999999">تعداد واحد</td>
  </tr>
  <tr>
    <?php
$r = 1 ;
  foreach($stmt as $row){
if($id_ostan1=='') {
 $id_ostan = $row['id_ostan'] ; 
 $shart = "id_ostan = '$id_ostan' " ; 
 $shart2 = 1 ; 
}
if($id_ostan1 !='') {
 $id_ostan = $row['id_ostan'] ; 
 $id_city = $row['id_city'] ; 
 $shart = "id_ostan = '$id_ostan' and id_city = '$id_city' " ; 
 $shart2 = "id_ostan = '$id_ostan'" ; 
}
 ?>
    <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo sum_zamin_t($sal,$shart) ; ?></td>
    <td align="center"   class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo unit_count_t($sal,$shart) ; ?></td>
    <td align="center"  height="31"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo sum_zamin('3',$sal,$shart) ; ?></td>
    <td align="center"  height="31"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo unit_count('3',$sal,$shart) ; ?></td>
    <td align="center"   class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo sum_zamin('2',$sal,$shart) ; ?></td>
    <td align="center"   class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo unit_count('2',$sal,$shart) ; ?></td>
    <td align="center"   class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo sum_zamin('1',$sal,$shart) ; ?></td>
    <td align="center"   class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo unit_count('1',$sal,$shart) ; ?></td>
    <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php if($id_ostan1=='') echo $row['ostan'] ;  else echo $row['city']  ; ?></td>
    <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
  <?php
$r++ ; 
}

?>
  <tr>
    <td align="center"   class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo sum_zamin_fa_tt($sal,$shart2) ; ?></td>
    <td align="center"   class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo unit_count_fa_tt($sal,$shart2) ; ?></td>
    <td align="center"  height="52"  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo sum_zamin_fa_t('3',$sal,$shart2) ; ?></td>
    <td align="center"  height="52"  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo unit_count_fa_t('3',$sal,$shart2) ; ?></td>
    <td align="center"   class="normalTextSmall" <?php  echo 'bgcolor=#ffcc99' ?>><?php  echo sum_zamin_fa_t('2',$sal,$shart2) ; ?></td>
    <td align="center"   class="normalTextSmall" <?php  echo 'bgcolor=#ffcc99' ?>><?php  echo unit_count_fa_t('2',$sal,$shart2) ; ?></td>
    <td align="center"   class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo sum_zamin_fa_t('1',$sal,$shart2) ; ?></td>
    <td align="center"   class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo unit_count_fa_t('1',$sal,$shart2) ; ?></td>
    <td align="center"  colspan="2"   <?php  echo 'bgcolor=#ffcc99' ?>><span class="style19">جمع کل</span></td>
  </tr>
  <?php }?>
</table>
<p>&nbsp;</p>
       <p> <p>&nbsp;</p>    
       </p>
      </td>
  </tr>
</table>

</body>
</html>
<?php
function unit_count($no_fa,$sal,$shart)
{
include('../../login/config.php');
 $query = "SELECT count(*) FROM  Aquatic  WHERE  no_fa = '$no_fa' and sal = '$sal' and $shart " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$unit_count = $stmt->fetchColumn();
return $unit_count ; 	

}
function unit_count_t($sal,$shart)
{
include('../../login/config.php');
$query = "SELECT count(*) FROM  Aquatic  WHERE  sal = '$sal' and $shart " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$unit_count_t = $stmt->fetchColumn();
return $unit_count_t ; 	

}

function sum_zamin($no_fa,$sal,$shart)
{
include ('../../login/config.php') ;
 $query = "SELECT sum(m_zamin) as m_zamin FROM Aquatic WHERE  no_fa = '$no_fa' and sal = '$sal' and $shart " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_zamin = $row['m_zamin'] ; 
return $m_zamin ;

}
function sum_zamin_t($sal,$shart)
{
include ('../../login/config.php') ;
 $query = "SELECT sum(m_zamin) as m_zamin FROM Aquatic WHERE   sal = '$sal' and $shart " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_zamin = $row['m_zamin'] ; 
return $m_zamin ;

}
function unit_count_fa_t($no_fa,$sal,$shart2)
{
include('../../login/config.php');
 $query = "SELECT count(*) FROM  Aquatic  WHERE  no_fa = '$no_fa' and sal = '$sal' and $shart2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$unit_count = $stmt->fetchColumn();
return $unit_count ; 	

}
function unit_count_fa_tt($sal,$shart2)
{
include('../../login/config.php');
 $query = "SELECT count(*) FROM  Aquatic  WHERE  sal = '$sal' and $shart2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$unit_count = $stmt->fetchColumn();
return $unit_count ; 	

}
function sum_zamin_fa_t($no_fa,$sal,$shart2)
{
include ('../../login/config.php') ;
 $query = "SELECT sum(m_zamin) as m_zamin FROM Aquatic WHERE  no_fa = '$no_fa' and sal = '$sal' and $shart2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_zamin = $row['m_zamin'] ; 
return $m_zamin ;

}
function sum_zamin_fa_tt($sal,$shart2)
{
include ('../../login/config.php') ;
 $query = "SELECT sum(m_zamin) as m_zamin FROM Aquatic WHERE   sal = '$sal' and $shart2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_zamin = $row['m_zamin'] ; 
return $m_zamin ;

}
?>