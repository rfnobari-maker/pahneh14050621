<script type="text/javascript">
var ray={
ajax:function(st)
	{
		this.show('load');
	},
show:function(el)
	{
		this.getID(el).style.display='';
	},
getID:function(el)
	{
		return document.getElementById(el);
	}
}
</script>
<style type="text/css">
#load{
position:absolute;
z-index:1;
margin-top:-150px;
margin-left:-150px;
top:50%;
left:50%;
}
</style>
        <div id="load" style="display:none;"><img src="../files/ajax_loader_red_512.gif" width="204" height="204"  alt=""/></div>

<?php
include ('../lock_ce.php') ;
include_once('../login/config.php');
$test = $dbh ; 
$query = "SELECT id_mar  FROM  markers " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$mar_map = $stmt -> rowCount();
$query = "SELECT username FROM  users WHERE  id_city = '$id_city' and S_access='2' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_m = $stmt -> rowCount();
//$query = "SELECT * from list_abadi where mor_cod_m'".$user_check."'";
$query = "SELECT city FROM  list_abadi WHERE  id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt -> rowCount();
///
$query = "SELECT id FROM  users WHERE  S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_kol = $stmt -> rowCount();
////
?>
<?php
function mor_abadi_count($mor_cod_m)
{
 global $test ; 
$query = "SELECT id FROM  list_abadi WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi = $stmt -> rowCount();
return $count_abadi ; 	
}
?>
<?php
function mar_abadi_count($id_mar)
{
 global $test ; 
$query = "SELECT id FROM  list_abadi where id_mar = $id_mar" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_abadi = $stmt -> rowCount();
return $count_mar_abadi ; 	
}
?>
<?php
function mar_shahr_count($id_mar)
{
 global $test ; 
$query = "SELECT id FROM  list_city where id_mar = $id_mar" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_shahr = $stmt -> rowCount();
return $count_mar_shahr ; 	
}
?>

<?php function mar_mor_count($id_mar)
{
 global $test ; 
$query = "SELECT id FROM  users WHERE  id_mar = '$id_mar'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt -> rowCount();
return $count_mar_mor ; 
}
?>
<?php function city_mor_count($id_ostan,$id_city)
{
 global $test ; 
$query = "SELECT id FROM  users WHERE   id_ostan = '$id_ostan'  and id_city = '$id_city'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt -> rowCount();
return $count_mar_mor ; 
}
?>
<?php function mar_mor_jens_count($id_mar,$n_jens)
{
 global $test ; 
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT id FROM  users WHERE  id_mar = '$id_mar' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
//return $jens ; 
}
//echo mar_mor_jens_count('0307',1)
?>
<?php function city_mor_jens_count($id_city,$n_jens)
{
 global $test ; 
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT id FROM  users WHERE  id_city = '$id_city' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
//return $jens ; 
}
//echo mar_mor_jens_count('0307',1)
?>
<?php function mar_mor_mtah_count($id_mar,$m_tah)
{
 global $test ; 
$query = "SELECT id FROM  users WHERE  id_mar = '$id_mar' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
}
?>
<?php function city_mor_mtah_count($id_city,$m_tah)
{
 global $test ; 
$query = "SELECT id FROM  users WHERE id_city = '$id_city' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_jens_mor = $stmt -> rowCount();
return $count_city_jens_mor ; 
}
?>
<?php function mar_request_count($id_mar,$status)
{
 global $test ; 
$query = "SELECT id FROM  change_mor WHERE id_mar = '$id_mar'  and status = '$status'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_request = $stmt -> rowCount();
return $count_mar_request ; 
}
?>
<?php
function city_abadi_count($id_ostan,$id_city)
{
 global $test ; 
$query = "SELECT id FROM  list_abadi where id_ostan = '$id_ostan' and id_city = $id_city" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_abadi = $stmt -> rowCount();
return $count_city_abadi ; 	
}
?>
<?php
function city_shahr_count($id_ostan,$id_city)
{
 global $test ; 
$query = "SELECT id FROM  list_city where id_ostan = '$id_ostan' and id_city = $id_city" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_shahr = $stmt -> rowCount();
return $count_city_shahr ; 	
}
?>
<?php
function ostan_city_count($id_ostan)
{
 global $test ; 
$query = "SELECT  DISTINCT id_city FROM public_abadi4 WHERE  id_ostan = '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_city = $stmt -> rowCount();
return $count_ostan_city ; 	
}
?>
<?php
function ostan_mar_count($id_ostan)
{
 global $test ; 
$query = "SELECT id_mar FROM mar WHERE  id_ostan = '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_mar = $stmt -> rowCount();
return $count_ostan_mar ; 	
}
?>
<?php
function city_mar_count($id_ostan,$id_city)
{
 global $test ; 
$query = "SELECT  DISTINCT id_mar FROM mar WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_mar = $stmt -> rowCount();
return $count_city_mar ; 	
}
?>
<?php
function ostan_count()
{
 global $test ; 
$query = "SELECT  DISTINCT id_ostan FROM public_abadi4 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan = $stmt -> rowCount();
return $count_ostan ; 	
}
?>
<?php
function kol_city_count()
{
 global $test ; 
$query = "SELECT  DISTINCT id_city,id_ostan FROM public_abadi4  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city = $stmt -> rowCount();
return $count_city ; 	
}
?>
<?php
function city_count($id_ostan)
{
 global $test ; 
$query = "SELECT  DISTINCT id_city FROM public_abadi4 WHERE  id_ostan = '$id_ostan' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city = $stmt -> rowCount();
return $count_city ; 	
}
?>
<?php
function shahr_count($id_ostan)
{
 global $test ; 
$query = "SELECT  DISTINCT add_city FROM list_city WHERE  id_ostan = '$id_ostan' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt -> rowCount();
return $count_shahr ; 	
}
?>
<?php
function kol_shahr_count($id_ostan)
{
 global $test ; 
$query = "SELECT  DISTINCT add_city FROM public_city WHERE  id_ostan = '$id_ostan' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt -> rowCount();
return $count_shahr ; 	
}
?>
<?php
function abadi_count()
{
 global $test ; 
//$query = "SELECT * FROM  list_abadi where id_ostan = $id_ostan" ;
$query = "SELECT id FROM  list_abadi " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi = $stmt -> rowCount();
return $count_abadi ; 	
}
?>
<?php
function ostan_abadi_count($id_ostan)
{
 global $test ; 
$query = "SELECT count(*) FROM  list_abadi WHERE id_ostan = '$id_ostan' group by id_ostan " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; }
?>
<?php
function kol_abadi_count($id_ostan)
{
 global $test ; 
$query = "SELECT id FROM public_abadi4 where id_ostan = $id_ostan" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol_ostan_abadi = $stmt -> rowCount();
return $kol_ostan_abadi ; 	
}
?>

<?php function mor_jens_count($n_jens)
{
 global $test ; 
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT id FROM  users WHERE  jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_jens_mor = $stmt -> rowCount();
return $count_jens_mor ; 
}
?>
<?php function ostan_mor_jens_count($id_ostan,$n_jens)
{
 global $test ; 
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_jens_mor = $stmt -> rowCount();
return $count_ostan_jens_mor ; 
}
?>
<?php function mor_mtah_count($m_tah)
{
 global $test ; 
$query = "SELECT id FROM  users WHERE  m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_jens_mor = $stmt -> rowCount();
return $count_jens_mor ; 
}
?>
<?php function ostan_mor_mtah_count($id_ostan,$m_tah)
{
 global $test ; 
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_jens_mor = $stmt -> rowCount();
return $count_ostan_jens_mor ; 
}
?>
<?php function mor_count()
{
 global $test ; 
$query = "SELECT id FROM  users WHERE  S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mor = $stmt -> rowCount();
return $count_mor ; 
}
?>
<?php function ostan_mor_count($id_ostan)
{
 global $test ; 
$query = "SELECT count(*) FROM  users WHERE id_ostan = '$id_ostan' and S_access = '1' group by id_ostan " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
}
?>
<?php function city_request_count($city)
{
 global $test ; 
$query = "SELECT id FROM  change_mor WHERE city = $city " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_request = $stmt -> rowCount();
return $count_city_request ; 
}
?>
<?php function kol_bah_count()
{
 global $test ; 
$query = "SELECT id FROM  bah   " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bah = $stmt -> rowCount();
return $count_bah ; 
}
?>
<?php function ostan_bah_count($id_ostan)
{
 global $test ; 
$query = "SELECT count(*) FROM  bah WHERE id_ostan = '$id_ostan' group by id_ostan " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
}
?>
<?php function city_bah_count($id_ostan,$id_city)
{
 global $test ; 
$query = "SELECT id FROM  bah WHERE id_ostan = '$id_ostan' and id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bah = $stmt -> rowCount();
return $count_city_bah ; 
}
?>
<?php function city_bee_count($id_ostan,$id_city)
{
 global $test ; 
$query = "SELECT id FROM  bee WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bee = $stmt -> rowCount();
return $count_city_bee ; 
}
?>
<?php function ostan_abadi_update_per($id_ostan)
{
 global $test ; 
$query = "select public_abadi4.add_abadi,public_abadi4.up_date,public_abadi4.id_ostan ,list_abadi.add_abadi  FROM list_abadi
LEFT JOIN public_abadi4 ON public_abadi4.add_abadi = list_abadi.add_abadi
WHERE  public_abadi4.id_ostan = '$id_ostan' and public_abadi4.up_date <> '' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 $count_update = $stmt -> rowCount();
 $count_kol = ostan_abadi_count($id_ostan) ;
$per_update = round((($count_update*100)/$count_kol),1) ;
return $per_update ; 
}
?>

<?php function abadi_update_per($id_ostan,$id_city)
{
 global $test ; 
$query = "select public_abadi4.add_abadi,public_abadi4.up_date,public_abadi4.id_city,public_abadi4.id_ostan ,list_abadi.add_abadi  FROM list_abadi
LEFT JOIN public_abadi4 ON public_abadi4.add_abadi = list_abadi.add_abadi
WHERE  public_abadi4.id_ostan = '$id_ostan' and public_abadi4.id_city = '$id_city'  and public_abadi4.up_date <> '' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 $count_update = $stmt -> rowCount();
 $count_kol = city_abadi_count($id_ostan,$id_city) ;
$per_update = round((($count_update*100)/$count_kol),1) ;
return $per_update ; 
}
?>



<?php function city_status($id_ostan,$id_city)
{
 global $test ; 
$query = "SELECT con_center  FROM  users  WHERE  id_city = '$id_city'  and S_access = '1' and con_city='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt -> rowCount();
if ($count_finish_mor ==  city_mor_count($id_ostan,$id_city)) $result = 1 ; else $result = 2;   
return $result ; 
}
?>
<?php
function mor_shahr_count($mor_cod_m)
{
 global $test ; 
$query = "SELECT id FROM  list_city WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt -> rowCount();
return $count_shahr ; 	
}
?>
<?php
function mor_bah_count($mor_cod_m)
{
 global $test ; 
$query = "SELECT id FROM  bah WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bah = $stmt -> rowCount();
return $count_bah ; 	
}
?>
<?php
function abadi_bah_count($add_abadi)
{
 global $test ; 
$query = "SELECT id FROM  bah WHERE  add_abadi = '$add_abadi' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi_bah = $stmt -> rowCount();
return $count_abadi_bah ; 	
}
?>
<?php
function sh_bah_count($add_city)
{
 global $test ; 
$query = "SELECT id FROM  bah WHERE  add_city = '$add_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi_bah = $stmt -> rowCount();
return $count_abadi_bah ; 	
}
?>
<?php
function shahr_bah_count($add_city)
{
 global $test ; 
$stmt = $dbh->prepare("SELECT count(id) FROM bah WHERE add_city = '$add_city'");
$stmt->execute();
$count = $stmt->fetchColumn();
return $count ; 
}
?>
<?php
function inactive_abadi()
{
 global $test ; 
$query = "SELECT id FROM public_abadi4  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol_abadi = $stmt -> rowCount();
$active_abadi = abadi_count() ;   
$inactive_abadi = ($kol_abadi - $active_abadi) ;
return $inactive_abadi ; 	
}
?>
<?php
function inactive_city()
{
 global $test ; 
$query = "SELECT id FROM public_city  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol_city = $stmt -> rowCount();
$active_city = totl_shahr_count() ;   
$inactive_city = ($kol_city - $active_city) ;
return $inactive_city ; 	
}
?>

<?php
function totl_shahr_count()
{
 global $test ; 
$query = "SELECT  DISTINCT add_city FROM list_city  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$totl_count_shahr = $stmt -> rowCount();
return $totl_count_shahr ; 	
}
?>
<?php
function totl_mar_count()
{
 global $test ; 
$query = "SELECT id FROM mar  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$totl_count_mar = $stmt -> rowCount();
return $totl_count_mar ; 	
}
?>
