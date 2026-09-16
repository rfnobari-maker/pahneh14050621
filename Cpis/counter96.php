<?php

include_once('../login/config.php') ;
 $query = "SELECT count(*) FROM  pm WHERE r_user = '$login_session' and  r_user !='1380066174' and  ru_read = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_pm = $stmt->fetchColumn();
if ($count_pm > 0) {
header("Location:rec_msg_notseen.php?unread");
}
?>
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
include_once ('../lock_cp.php') ;
include_once('../login/config.php');
$query = "SELECT count(*) FROM  users WHERE  S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_kol = $stmt->fetchColumn();
////
?>
<?php
function mor_abadi_count($mor_cod_m)
{
include_once('../login/config.php');
$query = "SELECT count(*) FROM  list_abadi WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi = $stmt->fetchColumn();
return $count_abadi ; 	
}
?>
<?php
function mar_abadi_count($id_mar)
{
include_once('../login/config.php');
$query = "SELECT count(*) FROM list_abadi where id_mar = $id_mar" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_abadi =  $stmt->fetchColumn();
return $count_mar_abadi ; 	
}
?>
<?php
function mar_shahr_count($id_mar)
{
include_once('../login/config.php');
$query = "SELECT count(*) FROM  list_city where id_mar = $id_mar" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_shahr = $stmt->fetchColumn();
return $count_mar_shahr ; 	
}
?>

<?php function mar_mor_count($id_mar)
{
include_once('../login/config.php');
$query = "SELECT count(*) FROM  users WHERE  id_mar = '$id_mar'  and S_access = '1'" ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 	
}
?>
<?php function city_mor_count($id_ostan,$id_city)
{
include_once('../login/config.php');
$query = "SELECT count(*) FROM  users WHERE   id_ostan = '$id_ostan'  and id_city = '$id_city'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt->fetchColumn();
return $count_mar_mor ; 
}
?>
<?php function mar_mor_jens_count($id_mar,$n_jens)
{
include_once('../login/config.php');
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT count(*) FROM  users WHERE  id_mar = '$id_mar' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt->fetchColumn();
return $count_mar_jens_mor ; 
//return $jens ; 
}
//echo mar_mor_jens_count('0307',1)
?>
<?php function city_mor_jens_count($id_city,$n_jens)
{
include_once('../login/config.php');
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
include_once('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_mar = '$id_mar' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
}
?>
<?php function city_mor_mtah_count($id_city,$m_tah)
{
include_once('../login/config.php');
$query = "SELECT id FROM  users WHERE id_city = '$id_city' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_jens_mor = $stmt -> rowCount();
return $count_city_jens_mor ; 
}
?>
<?php function mar_request_count($id_mar,$status)
{
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
$query = "SELECT  count(DISTINCT id_ostan) FROM public_abadi4 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan = $stmt->fetchColumn();
return $count_ostan ; 	
}
?>
<?php
function kol_city_count()
{
include_once('../login/config.php');
$query = "SELECT  count(DISTINCT id_city,id_ostan)  FROM public_abadi4 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city = $stmt->fetchColumn();
return $count_city ; 	
}
?>
<?php
function city_count($id_ostan)
{
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
$query = "SELECT count(*) FROM  list_abadi WHERE 1 " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 	
}
?>
<?php
function abadi_no_mor_count()
{
include_once('../login/config.php');
//$query = "SELECT * FROM  list_abadi where id_ostan = $id_ostan" ;
$query = "SELECT id FROM  list_abadi where mor_cod_m = '' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi = $stmt -> rowCount();
return $count_abadi ; 	
}
?>
<?php
function ostan_abadi_count($id_ostan)
{
include_once('../login/config.php');
$query = "SELECT count(*) FROM  list_abadi WHERE id_ostan = '$id_ostan' group by id_ostan " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; }
?>
<?php
function kol_abadi_count($id_ostan)
{
include_once('../login/config.php');
$query = "SELECT id FROM public_abadi4 where id_ostan = $id_ostan" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol_ostan_abadi = $stmt -> rowCount();
return $kol_ostan_abadi ; 	
}
?>
<?php function mor_jens_count($n_jens)
{
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
$query = "SELECT id FROM  users WHERE  m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_jens_mor = $stmt -> rowCount();
return $count_jens_mor ; 
}
?>
<?php function ostan_mor_mtah_count($id_ostan,$m_tah)
{
include_once('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_jens_mor = $stmt -> rowCount();
return $count_ostan_jens_mor ; 
}
?>
<?php function mor_count()
{
include_once('../login/config.php');
$query = "SELECT id FROM  users WHERE  S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mor = $stmt -> rowCount();
return $count_mor ; 
}
?>
<?php function ostan_mor_count($id_ostan)
{
include_once('../login/config.php');
$query = "SELECT count(*) FROM  users WHERE id_ostan = '$id_ostan' and S_access = '1' group by id_ostan " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
}
?>
<?php function city_request_count($city)
{
include_once('../login/config.php');
$query = "SELECT id FROM  change_mor WHERE city = $city " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_request = $stmt -> rowCount();
return $count_city_request ; 
}
?>
<?php function kol_bah_count()
{
include_once('../login/config.php');
$query = "SELECT count(*) FROM  bah WHERE 1 " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
}
?>
<?php function ostan_bah_count($id_ostan)
{
include_once('../login/config.php');
$query = "SELECT count(*) FROM  bah WHERE id_ostan = '$id_ostan' group by id_ostan " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
}
?>
<?php function ostan_bah_notok($id_ostan)
{
include_once('../login/config.php');
$query = "SELECT count(*) FROM  bah WHERE id_ostan = '$id_ostan'  and  ok = '2' group by id_ostan " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
}
?>

<?php function city_bah_count($id_ostan,$id_city)
{
include_once('../login/config.php');
$query = "SELECT id FROM  bah WHERE id_ostan = '$id_ostan' and id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bah = $stmt -> rowCount();
return $count_city_bah ; 
}
?>
<?php function city_bee_count($id_ostan,$id_city)
{
include_once('../login/config.php');
$query = "SELECT id FROM  bee WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bee = $stmt -> rowCount();
return $count_city_bee ; 
}
?>
<?php function ostan_abadi_update_per($id_ostan)
{
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
$stmt = $dbh->prepare("SELECT count(id) FROM bah WHERE add_city = '$add_city'");
$stmt->execute();
$count = $stmt->fetchColumn();
return $count ; 
}
?>
<?php
function inactive_abadi()
{
include_once('../login/config.php');
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
include_once('../login/config.php');
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
include_once('../login/config.php');
$query = "SELECT count(*) FROM  list_city  " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 	
}
?>
<?php
function totl_mar_count()
{
include_once('../login/config.php');
$query = "SELECT count(*) FROM mar  "  ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 	
}
?>
<?php
function ostan_Agri_count($id_ostan,$sal)
{
$sal1 = $sal-1 ;
$z_sal = $sal1.'-'.$sal ;
include_once('../login/config.php');
$query = "SELECT id FROM Agri where id_ostan= '$id_ostan' and z_sal = '$z_sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Agri = $stmt -> rowCount();
return $count_ostan_Agri ; 	
}
?>
<?php
function total_Agri_count($sal)
{
$sal1 = $sal-1 ;
$z_sal = $sal1.'-'.$sal ;
include_once('../login/config.php');
$query = "SELECT id FROM Agri where z_sal = '$z_sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri = $stmt -> rowCount();
return $count_Agri ; 	
}
?>
<?php
function ostan_Garden_count($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM Garden where id_ostan= '$id_ostan' and z_sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Garden = $stmt -> rowCount();
return $count_ostan_Garden ; 	
}
?>
<?php
function total_Garden_count($sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM Garden where z_sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Garden = $stmt -> rowCount();
return $count_Garden ; 	
}
?>
<?php
function ostan_Greenhous_count($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM Greenhous where id_ostan= '$id_ostan' and sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Greenhous = $stmt -> rowCount();
return $count_ostan_Greenhous ; 	
}
?>
<?php
function total_Greenhous_count($sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM Greenhous where sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Greenhous = $stmt -> rowCount();
return $count_Greenhous ; 	
}
?>
<?php
function ostan_Aquatic_count($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM Aquatic where id_ostan= '$id_ostan' and sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Aquatic = $stmt -> rowCount();
return $count_ostan_Aquatic ; 	
}
?>
<?php
function total_Aquatic_count($sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM Aquatic where sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Aquatic = $stmt -> rowCount();
return $count_Aquatic ; 	
}
?>
<!-- summary 2 -->
<?php
function ostan_Agri_count2($id_ostan,$sal)
{
$sal1 = $sal-1 ;
$z_sal = $sal1.'-'.$sal ;
include_once('../login/config.php');
$query = "SELECT count(distinct bah_cod_m ,add_abadi,add_city)   FROM Agri where id_ostan= '$id_ostan' and z_sal = '$z_sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Agri = $stmt -> fetchColumn(); 
return $count_ostan_Agri ; 	
}
?>
<?php
function total_Agri_count2($sal)
{
$sal1 = $sal-1 ;
$z_sal = $sal1.'-'.$sal ;
include_once('../login/config.php');
$query = "SELECT distinct bah_cod_m ,add_abadi,add_city   FROM Agri where z_sal = '$z_sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri = $stmt -> rowCount();
return $count_Agri ; 	
}
?>
<?php
function ostan_Garden_count2($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT count(distinct bah_cod_m ,add_abadi,add_city)   FROM Garden where id_ostan= '$id_ostan' and z_sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Garden = $stmt -> fetchColumn(); 
return $count_ostan_Garden ; 	
}
?>
<?php
function total_Garden_count2($sal)
{
include_once('../login/config.php');
$query = "SELECT distinct bah_cod_m ,add_abadi,add_city   FROM Garden where z_sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Garden = $stmt -> rowCount();
return $count_Garden ; 	
}
?>
<?php
function ostan_Greenhous_count2($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT count(distinct bah_cod_m ,add_abadi,add_city)   FROM Greenhous where id_ostan= '$id_ostan' and sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Greenhous = $stmt -> fetchColumn();
return $count_ostan_Greenhous ; 	
}
?>
<?php
function total_Greenhous_count2($sal)
{
include_once('../login/config.php');
$query = "SELECT distinct bah_cod_m ,add_abadi,add_city   FROM Greenhous where sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Greenhous = $stmt -> rowCount();
return $count_Greenhous ; 	
}
?>
<?php
function ostan_Aquatic_count2($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT distinct bah_cod_m ,add_abadi,add_city   FROM Aquatic where id_ostan= '$id_ostan' and sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Aquatic = $stmt -> rowCount();
return $count_ostan_Aquatic ; 	
}
?>
<?php
function total_Aquatic_count2($sal)
{
include_once('../login/config.php');
$query = "SELECT distinct bah_cod_m ,add_abadi,add_city   FROM Aquatic where sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Aquatic = $stmt -> rowCount();
return $count_Aquatic ; 	
}
?>
