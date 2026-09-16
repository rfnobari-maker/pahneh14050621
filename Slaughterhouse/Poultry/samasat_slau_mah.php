<?php
 include('../../lock_expar.php');
include('../../event.php') ;
include('../../login/config.php');
$date_day        = $_POST['date_day'] ; 
$date_day_name   = $_POST['date_day_name'] ; 
//alert($date_day_name);
 $x          = $_POST['X'] ; 
 $for_days   = $_POST['for_days'] ; 
 $age_day1   = $_POST['age_day1'];
 $age_day2   = $_POST['age_day2']; 
 $no_part    = $_POST['no_part'] ;
 $target     = $_POST['target']; 
 $date_home = $_POST['date_home'] ;
 $date_end  = $_POST['date_end'] ;
 $show_list = $_POST['show_list'];  
$query  = "DELETE FROM `samasat_slau_list` WHERE 1  ";
$stmt = $dbh->prepare($query);
$stmt->execute();


$query  = "SELECT * FROM  `samasat_slau_temp` where  m_joj > 0 order by age_day DESC  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
   foreach($stmt as $row){ 
$sh_yek = $row['sh_yek'] ; 
$date_joj = $row['date_joj'] ; 
$m_joj = $row['m_joj'] ; 
$ostan = $row['ostan'] ; 
$city = $row['city'] ; 
$id_ostan = $row['id_ostan'] ; 
$id_city = $row['id_city'] ; 
$cod_sys = $row['cod_sys'] ; 
$cod_p = $row['cod_p'] ; 
$cod_ep = $row['cod_ep'] ; 
$name_unit = $row['name_unit'] ; 
$name_m = $row['name_m'] ; 
$sh_moj = $row['sh_moj'] ; 
$sh_gova = $row['sh_gova'] ; 
$no_dar  = $row['no_dar'] ; 
$date_part = $row['date_part'] ; 
$no_joj = $row['no_joj'] ; 
$age_day = $row['age_day'] ; 
$z_kol = $row['z_kol'] ; 

// محاسبه تعداد برداشت از هر گله 
$albaghi = $m_joj - $no_part    ;
if($albaghi <=3000) {
	$no_slau = $m_joj ;
}
else 
{
$no_slau = $no_part ;
}
$m_joj1 = $m_joj - $no_slau ; 
// انتهای  محاسبه تعداد برداشت از هر گله 
$query  = "SELECT sum(no_slau) as kol_slau FROM  `samasat_slau_list` where  date_slau = '$date_day'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_slau = $row['kol_slau'] ; 
if($kol_slau < $target)
{
	$query = "INSERT INTO samasat_slau_list(sh_moj,sh_gova,no_dar,date_part,no_joj,age_day,z_kol,
	cod_sys,cod_p,cod_ep,name_unit,name_m,ostan,city,id_ostan,id_city,t_part,no_slau,day_slau,date_slau,sh_yek,date_joj,m_joj
	,m_joj1,target) 
             VALUES (:sh_moj,:sh_gova,:no_dar,:date_part,:no_joj,:age_day,:z_kol, :cod_sys,:cod_p,:cod_ep,:name_unit
			 ,:name_m,:ostan,:city,:id_ostan,:id_city,:t_part,:no_slau,:day_slau,:date_slau,:sh_yek,:date_joj
			 ,:m_joj,:m_joj1,:target)";
    $q = $dbh->prepare($query);
    $q->execute(array(':sh_moj'=>$sh_moj,':sh_gova'=>$sh_gova,':no_dar'=>$no_dar,':date_part'=>$date_part,
	':no_joj'=>$no_joj,':age_day'=>$age_day,':z_kol'=>$z_kol,':cod_sys'=>$cod_sys,':cod_p'=>$cod_p,
	':cod_ep'=>$cod_ep,':name_unit'=>$name_unit,':name_m'=>$name_m,':ostan'=>$ostan,':city'=>$city,
	':id_ostan'=>$id_ostan,':t_part'=>1,':id_city'=>$id_city,':no_slau'=>$no_slau,
	':day_slau'=>$date_day_name,':date_slau'=>$date_day,':sh_yek'=>$sh_yek,
	':date_joj'=>$date_joj,':m_joj'=>$m_joj,':m_joj1'=>$m_joj1,':target'=>$target));
}
}

$query  = "SELECT sum(no_slau) as kol_slau ,sum(m_joj1) as kol_m_joj1 FROM  `samasat_slau_list` where  date_slau = '$date_day'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_slau  = $row['kol_slau'] ; 
$kol_m_joj1 = $row['kol_m_joj1'] ; 
// در صورتی که علیرغم برداشت پارتی از تمامی گله ها باز هم هدف تامین نشد و تعداد مرغ باقی مانده از 0 بزرگتر بود 

if($kol_slau < $target && $kol_m_joj1 > 0 )
{
// حلقه برداشت از گله های دارای مرغ به شرط تامین هدف یا عدم وجود مرغ
do {
//alert('حلقه'.$kol_slau) ;
  $query = "SELECT sh_yek,date_joj,m_joj1 FROM `samasat_slau_list` where m_joj1 > 0 ORDER BY age_day DESC "  ;
  $stmt = $dbh->prepare($query);
  $stmt->execute();
  foreach($stmt as $row){
  $sh_yek = $row['sh_yek'] ; 
  $date_joj = $row['date_joj'] ; 
  $m_joj1 = $row['m_joj1'] ; 
  // محاسبه تعداد برداشت از هر گله 
  $albaghi = $m_joj1 - $no_part    ;
  if($albaghi <=3000) {
	$no_slau = $m_joj1 ;
  }
  else 
  {
  $no_slau = $no_part ;
  }
  // 
  // برداشت پارت های بعدی 
  $query = "UPDATE `samasat_slau_list`  SET m_joj1= m_joj1-$no_slau , no_slau = no_slau + $no_slau ,t_part = t_part+1
  WHERE sh_yek=? and date_joj=?";
  $q = $dbh->prepare($query);
  $q->execute(array($sh_yek,$date_joj));
  //
}
$query  = "SELECT sum(no_slau) as kol_slau ,sum(m_joj1) as kol_m_joj1 FROM  `samasat_slau_list` where  date_slau = '$date_day'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_slau  = $row['kol_slau'] ; 
$kol_m_joj1 = $row['kol_m_joj1'] ; 
} while ( $kol_slau < $target and $kol_m_joj1 > 0 );
// پایان حلقه 
}
$mog = $kol_slau - $target ; 
//alert('برای تاریخ : '.$date_day.' ----> هدف : '.$target.' تامین شده :'.$kol_slau.' مغایرت : '.$mog.' قطعه') ; 

 // بروز رسانی موجودی جدول samasat_slau_data بعد از تهیه لیست روز قبل 
  $query = "SELECT sh_yek,date_joj,m_joj1 FROM `samasat_slau_list` where 1 "  ;
  $stmt = $dbh->prepare($query);
  $stmt->execute();
  foreach($stmt as $row){
  $sh_yek = $row['sh_yek'] ; 
  $date_joj = $row['date_joj'] ; 
  $m_joj1 = $row['m_joj1'] ; 
  $query = "UPDATE `samasat_slau_data`  SET m_joj= ? WHERE sh_yek=? and date_joj=?";
  $q = $dbh->prepare($query);
  $q->execute(array($m_joj1,$sh_yek,$date_joj));
    
  //
}

  $query = "DELETE FROM `samasat_slau_Plist` WHERE date_slau ='$date_day'";
  $q = $dbh->prepare($query);
  $q->execute();
  
  $query = "INSERT INTO `samasat_slau_Plist`(select * from samasat_slau_list where 1)";
  $q = $dbh->prepare($query);
  $q->execute();

  $query = "DELETE FROM `samasat_for_day` WHERE 1 limit 1";
  $q = $dbh->prepare($query);
  $q->execute();

$query  = "SELECT count(*) as count_day FROM  `samasat_for_day` where 1  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count_day = $row['count_day'] ; 
//alert($count_day) ; 
if($count_day > 0)
{

?>
<form name="myform" class="myform" method="post" action="list_Slau_data.php">
<input type="hidden" name="for_days" value='<?php echo $no_days ?>'/>
<input type="hidden" name="age_day1" value='<?php echo $age_day1 ?>'/>
<input type="hidden" name="age_day2" value='<?php echo $age_day2 ?>'/>
<input type="hidden" name="no_part" value='<?php echo $no_part ?>'/>
<input type="hidden" name="target" value='<?php echo $target ?>'/>
<input type="hidden" name="date_home" value='<?php echo $date_home ?>'/>
<input type="hidden" name="date_end" value='<?php echo $date_end ?>'/>
<input type="hidden" name="show_list" value='<?php echo $show_list ?>'/>
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
else 
{
?>
<form name="myform" class="myform" method="post" action="list_P_Slau.php">
<input type="hidden" name="for_days" value='<?php echo $no_days ?>'/>
<input type="hidden" name="age_day1" value='<?php echo $age_day1 ?>'/>
<input type="hidden" name="age_day2" value='<?php echo $age_day2 ?>'/>
<input type="hidden" name="no_part" value='<?php echo $no_part ?>'/>
<input type="hidden" name="target" value='<?php echo $target ?>'/>
<input type="hidden" name="date_home" value='<?php echo $date_home ?>'/>
<input type="hidden" name="date_end" value='<?php echo $date_end ?>'/>
<input type="hidden" name="show_list" value='<?php echo $show_list ?>'/>
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php

}
?>