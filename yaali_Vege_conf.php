<?php
include ('login/config.php');
include ('event.php');

//$query = "UPDATE users SET end_bee='',con_center='',con_city='' WHERE  id_mar in ('0228') and S_access = '1' " ; 
//$query = "UPDATE users SET end_bee = '' , date_end_bee = '' , con_center = '' , date_con_center = '' , con_city = '' ,  date_con_city= '' , con_ostan= '' , date_con_ostan = '' ";
//$query = "UPDATE Vege SET confi='1' , confi2='1' where id_mar='2911'  and z_sal = '1401-1402'" ; 
//$query = "UPDATE Agri_prod1400_1401 SET bah_cod_m = '4620688215' , num_bah = '2' where bah_cod_m = '4621445855' " ; 
//$query = "UPDATE users SET Access = '1' where S_access = '1' and id_ostan = '02' " ; 
$query = "UPDATE users SET end_bee=''   WHERE S_access = '1' and  id_ostan = '25' and id_city = '01' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();

//$query = "UPDATE bee SET bah_cod_m = concat('00',bah_cod_m) where length(bah_cod_m) = 8   and sal = '1402' " ;
//$stmt = $dbh->prepare($query);
//$stmt->execute();

//$query = "UPDATE bee SET bah_cod_m = concat('0',bah_cod_m) where length(bah_cod_m) = 9   and sal = '1402' " ;
//$stmt = $dbh->prepare($query);
//$stmt->execute();

//$query = "UPDATE list_abadi SET mor_cod_m = '2992913928' where mor_cod_m='0063331373' " ; 
//$stmt = $dbh->prepare($query);
//$stmt->execute();

//$query = "UPDATE list_abadi SET mor_cod_m = '0063331373' where mor_cod_m='4449713192' " ; 
//$stmt = $dbh->prepare($query);
//$stmt->execute();

//$query = "UPDATE list_abadi SET mor_cod_m = '4449713192' where mor_cod_m='4449713192' " ; 
//$stmt = $dbh->prepare($query);
//$stmt->execute();

// $query = "UPDATE Greenhous SET no_kesht = '2',no_saz='',no_gol='',sys_kesh='',
//no_sokh='',sys_hot='',sys_cool='' where no_kesht = '1' 
//and mor_cod_m = '2279474336' and ( bah_cod_m='2279706075' or
// bah_cod_m='2279881152')" ; 
//$stmt = $dbh->prepare($query);
//$stmt->execute();


//$query = "UPDATE Garden_prod_man SET date_s = Garden_id_old , z_sal = '1402' , mah_tol = 0 , mah_tolp = 0 , mah_bem = '' , mah_kh = '' " ; 
//$stmt = $dbh->prepare($query);
//$stmt->execute();

alert('تمام');
?>