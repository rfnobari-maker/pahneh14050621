<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=تولید_به_تفکیک_شهرستان.xls");
include('../../lock_expar.php');
include('../../event.php');
if(isset($_POST['sal']))  $sal = $_POST['sal'];
if(isset($_POST['id_ostan'])) echo $id_ostan1 = $_POST['id_ostan'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
<p align="center" class="style1">آمار  نهایی تولید زنبورستان های استان <?php echo ostan_name($id_ostan1)?> به تفکیک شهرستان بر اساس سرشماری <?php echo $sal?></p>
          <?php if(isset($_POST['sal']))
		  {
	include('../../login/config.php');
 $query = "SELECT city,id_city FROM `cityname` WHERE id_ostan = '$id_ostan1' ORDER BY BINARY city   "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
        <table width="98%" height="174" border="1" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0" >
          <tr align="center" class="text1">
            <td height="56" bgcolor="#999999">تولید زهر/g</td>
            <td bgcolor="#999999">تولید بره موم /Kg</td>
            <td bgcolor="#999999">تولید موم /Kg</td>
            <td bgcolor="#999999">تولید گرده گل /Kg</td>
            <td width="5%" bgcolor="#999999">تولید ژل رویال /Kg</td>
            <td width="5%" bgcolor="#999999">تولید کندوی مدرن /Kg</td>
            <td width="6%" bgcolor="#999999">تولید کندوی سنتی /Kg</td>
            <td width="6%" bgcolor="#999999">تعداد زنبورستان بیمه شده </td>
            <td width="5%" bgcolor="#999999">تعداد کندومی مدرن</td>
            <td width="4%" bgcolor="#999999">تعداد کندوی سنتی</td>
            <td bgcolor="#999999">تعداد ملکه از محل خرید از بخش دولتی</td>
            <td bgcolor="#999999">تعداد ملکه از محل خرید از بخش خصوصی</td>
            <td bgcolor="#999999">تعداد ملکه از محل خودم مصرفی</td>
            <td width="5%" bgcolor="#999999">تعداد زنبوردار تحت پوشش بیمه</td>
            <td width="7%" bgcolor="#999999">تعداد افراد شاغل</td>
            <td width="8%" bgcolor="#999999">تعداد زنبورستان نهایی</td>
            <td width="12%" bgcolor="#999999">تعداد زنبورستان مهاجر از سایر شهرستان ها / استان ها</td>
            <td width="12%" bgcolor="#999999">تعداد زنیورستان مهاجر</td>
            <td width="12%" bgcolor="#999999">تعداد زنبورستان غیر مهاجر</td>
            <td width="12%" bgcolor="#999999">شهرستان</td>
            <td width="5%" bgcolor="#999999">ردیف</td>
          </tr>
          <tr align="center">
               <?php
$r = 1 ;
foreach($stmt as $row2){
$id_city1 = $row2['id_city'] ; 
$v_id_city = "(
((id_ostan='$id_ostan1') and (id_city='$id_city1') and (m_ostan = '-')) or
((m_ostan='$id_ostan1') and (m_city='$id_city1'))
)" ;
 $query = "SELECT count(*) zan,
count(CASE WHEN ((id_ostan='$id_ostan1') and (m_ostan='$id_ostan1' or m_ostan='-') ) THEN 1  END )  zan_bo ,
count(CASE WHEN ((id_ostan !='$id_ostan1') and (m_ostan='$id_ostan1' )) THEN 1  END )  zan_ma ,
sum(`t_sha`) t_sh ,
count(CASE WHEN bee.`bem_zan`!='3' THEN 1  END )  t_zanB ,
sum(`tm_kh`)  tm_kh ,
sum(`tm_kkh`) tm_kkh ,
sum(`tm_kdo`) tm_kdo ,
sum(`tk_bo`) k_bo ,
sum(`tk_mo`) k_mo ,
count(CASE WHEN bee.`bem_kand`='1' THEN 1  END )  t_kandB ,
sum(`to_bo`) t_bo ,
sum(`to_mo`) t_mo ,
sum(`t_gar`) t_gard , 
sum(`t_bar`) t_bar , 
sum(`t_mom`) t_mom , 
sum(`t_jel`) t_jel ,
sum(`t_zah`) t_zah 
FROM `bee` where  $v_id_city  and sal = '$sal' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_kbo = $row['t_bo'] / $row['k_bo'] ;
$m_kmo = $row['t_mo'] / $row['k_mo'] ; 
 ?>
                <td width="4%" height="42"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_zah']/1000),3) ; ?></td>
                <td width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bar'],0) ; ?></td>
                <td align="center" width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mom'],0) ; ?></td>
                <td align="center" width="3%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_gard'],0) ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_jel']/1000,3) ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mo'],0) ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bo'],0) ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_kandB'] ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_mo']*1 ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_bo']*1 ; ?></td>
                <td align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kdo']*1 ; ?></td>
                <td align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kkh']*1 ; ?></td>
                <td align="center"class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kh']*1 ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_zanB'] ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh']*1 ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo zan_sma($sal,$id_ostan1,$id_city1) ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan_ma'] ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan_bo'] ; ?></td>
            <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right" style="margin-right:2px"><?php echo $row2['city'];?></div></td>
            <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
<?php
$r++ ; 
}
$query = "SELECT `id_ostan`,
count(*) zan,
sum(`t_sha`) t_sh ,
count(CASE WHEN bee.`bem_zan`!='3' THEN 1  END )  t_zanB ,
sum(`tm_kh`)  tm_kh ,
sum(`tm_kkh`) tm_kkh ,
sum(`tm_kdo`) tm_kdo ,
sum(`tk_bo`) k_bo ,
sum(`tk_mo`) k_mo ,
count(CASE WHEN bee.`bem_kand`='1' THEN 1  END )  t_kandB ,
sum(`to_bo`) t_bo ,
sum(`to_mo`) t_mo ,
sum(`t_gar`) t_gard , 
sum(`t_bar`) t_bar , 
sum(`t_mom`) t_mom , 
sum(`t_jel`) t_jel ,
sum(`t_zah`) t_zah 
FROM `bee` WHERE ((id_ostan = '$id_ostan1' and  m_ostan = '-' )or(m_ostan = '$id_ostan1')) and  `sal` = '$sal'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
  <tr>
    <td height="38" align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_zah']/1000),3) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bar'],0) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mom'],0) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_gard'],0) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_jel']/1000,3) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mo'],0) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bo'],0) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_kandB'] ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_mo']*1 ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_bo']*1 ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kdo']*1 ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kkh']*1 ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kh']*1 ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_zanB'] ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh']*1 ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
    <td colspan="5" align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>جمع کل</td>
    </tr>
</table>
<?php }?>
<p align="center">-------------- پایان گزارش -------------</p>
</body>
</html>
<?php
function zan_sma($sal,$id_ostan1,$id_city1)
{
include('../../login/config.php');
 $query = "SELECT COUNT( * ) 
FROM bee
WHERE 
(
(id_ostan = '$id_ostan1' and id_city = '$id_city1' and m_ostan  ='$id_ostan1' and m_city !='$id_city1' )  or 
(id_ostan = '$id_ostan1' and id_city = '$id_city1' and m_ostan != '$id_ostan1' and m_ostan != '-' )
)
AND sal =  '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 
$dbh = null;
}
?>