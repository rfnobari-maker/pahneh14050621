<?php
include ('login/config.php');
include ('event.php');
//alert('test') ; 
$query = "SELECT * from bah04 where id > 2600000  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
 foreach($stmt as $row){
$name      = $row['name'] ;
$bah_cod_m = $row['bah_cod_m'] ;
$last_name = $row['last_name'] ;
$sh_sh     = $row['sh_sh'] ;
$fname     = $row['fname'] ;
$m_sod     = $row['m_sod'] ;
$date_t    = $row['date_t'] ;
$jens      = $row['jens'] ;
//	alert($name.'-'.$last_name.'-'.$date_t.'-'.$sh_sh.'-'.$fname.'-'.$m_sod.'-'.$jens) ; 
	$query = "UPDATE bah SET name=?,last_name=?,sh_sh=?,fname=?,m_sod=?,date_t=?,jens=?,ok=? WHERE bah_cod_m=?";
      $q = $dbh->prepare($query);
      $q->execute(array($name,$last_name,$sh_sh,$fname,$m_sod,$date_t,$jens,'1',$bah_cod_m));
}
alert('تمام')
?>