<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include('login/config_utf8.php');
include ('event.php');

$query = "SELECT  * from bah22 where 1 " ;
$q = $dbh->prepare($query);
$q->execute();

 foreach($q as $row){

$date_s = $row['date_s']; 
$mor_cod_m = $row['mor_cod_m']; 
$no_bah = $row['no_bah']; 
$bah_cod_m = $row['bah_cod_m']; 
$num_bah = $row['num_bah']; 
$name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$fname   = $row['fname']; 
$sh_meli  = $row['sh_meli'] ;
$tel_m  = $row['tel_m']; 
$co_name  = $row['co_name'] ;
$id_ostan  = $row['id_ostan'] ;
$id_city  = $row['id_city'] ;
$id_mar  = $row['id_mar'] ;
$sh_sh   = $row['sh_sh']; 
$m_tah   = $row['m_tah']; 
$er_mtah = $row['er_mtah'];
$tel_s   = $row['tel_s']; 
$s_bah   = $row['s_bah']; 
$jens= $row['jens']; 
$co_sabt  = $row['co_sabt'] ;
$cod_p = $row['cod_p']; 
$no_nation = $row['no_nation']; 
$ok = $row['ok'];


include ('login/config.php');
$query = "INSERT INTO bah_2 (date_s,mor_cod_m,no_bah,bah_cod_m,num_bah,name,last_name,date_t,fname,
sh_meli,tel_m,co_name,id_ostan,id_city,id_mar,sh_sh,m_tah,er_mtah,tel_s,s_bah,jens,co_sabt,cod_p,ok
,no_nation)
VALUES(:date_s,:mor_cod_m,:no_bah,:bah_cod_m,:num_bah,:name,:last_name,:date_t,:fname,
:sh_meli,:tel_m,:co_name,:id_ostan,:id_city,:id_mar,:sh_sh,:m_tah,:er_mtah,:tel_s,:s_bah,:jens,:co_sabt,:cod_p,:ok
,:no_nation)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':no_bah'=>$no_bah,':bah_cod_m'=>$bah_cod_m,
':num_bah'=>$num_bah,':name'=>$name,':last_name'=>$last_name,':date_t'=>$date_t,':fname'=>$fname,
':sh_meli'=>$sh_meli,':tel_m'=>$tel_m,':co_name'=>$co_name,':id_ostan'=>$id_ostan
,':id_city'=>$id_city,':id_mar'=>$id_mar,':sh_sh'=>$sh_sh,':m_tah'=>$m_tah,':er_mtah'=>$er_mtah,
':tel_s'=>$tel_s,':s_bah'=>$s_bah,':jens'=>$jens,':co_sabt'=>$co_sabt
,':cod_p'=>$cod_p,':ok'=>'1',':no_nation'=>$no_nation));
}
alert('تمام');
?>