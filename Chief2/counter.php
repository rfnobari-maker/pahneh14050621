<?php
include ('../lock_ce.php') ;
include('../login/config.php') ;
//
date_default_timezone_set('Asia/Tehran');
$v_date = date("Y-m-d", strtotime( '-120 days' ) );
if (strtotime($date_pas) < strtotime($v_date)) {
header("Location:expaire_pass.php");
}
// پیام جدید 
//$query = "SELECT count(*) FROM  pm WHERE r_user = '$login_session' and  r_user !='1380066174' and  ru_read = '1'" ;
//$stmt = $dbh->prepare($query);
//$stmt->execute();
//$count_pm = $stmt->fetchColumn();
//if ($count_pm > 0) {
//header("Location:rec_msg_notseen.php?unread");
//
//}
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
$query = "SELECT count(*) FROM  users WHERE  S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_kol = $stmt->fetchColumn();
function mor_abadi_count($mor_cod_m)
{
 global $dbh;
$query = "SELECT count(*) FROM  list_abadi WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi = $stmt->fetchColumn();
return $count_abadi ; 	

}
function mar_abadi_count($id_mar)
{
 global $dbh;
$query = "SELECT count(*) FROM list_abadi where id_mar = '$id_mar'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_abadi =  $stmt->fetchColumn();
return $count_mar_abadi ; 	

}
function mar_shahr_count($id_mar)
{
 global $dbh;
$query = "SELECT count(*) FROM  list_city where id_mar = '$id_mar'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_shahr = $stmt->fetchColumn();
return $count_mar_shahr ; 	

}
function mar_mor_count($id_mar)
{
 global $dbh;
$query = "SELECT count(*) FROM  users WHERE  id_mar = '$id_mar'  and S_access = '1'" ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 	

}
function city_mor_count($id_ostan,$id_city)
{
 global $dbh;
$query = "SELECT count(*) FROM  users WHERE   id_ostan = '$id_ostan'  and id_city = '$id_city'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt->fetchColumn();
return $count_mar_mor ; 

}
 function mar_mor_jens_count($id_mar,$n_jens)
{
 global $dbh;
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
 function city_mor_jens_count($id_city,$n_jens)
{
 global $dbh;
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT count(*) FROM  users WHERE  id_city = '$id_city' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt->fetchColumn();
return $count_mar_jens_mor ; 
//return $jens ; 

}
//echo mar_mor_jens_count('0307',1)
function mar_mor_mtah_count($id_mar,$m_tah)
{
 global $dbh;
$query = "SELECT count(*) FROM  users WHERE  id_mar = '$id_mar' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt->fetchColumn();
return $count_mar_jens_mor ; 

}
function city_mor_mtah_count($id_city,$m_tah)
{
 global $dbh;
$query = "SELECT count(*) FROM  users WHERE id_city = '$id_city' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_jens_mor = $stmt->fetchColumn();
return $count_city_jens_mor ; 

}
function mar_request_count($id_mar,$status)
{
 global $dbh;
$query = "SELECT count(*) FROM  change_mor WHERE id_mar = '$id_mar'  and status = '$status'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_request = $stmt->fetchColumn();
return $count_mar_request ; 

}
function city_abadi_count($id_ostan,$id_city)
{
 global $dbh;
$query = "SELECT count(*) FROM  list_abadi where id_ostan = '$id_ostan' and id_city = '$id_city'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_abadi = $stmt->fetchColumn();
return $count_city_abadi ; 	

}
function city_shahr_count($id_ostan,$id_city)
{
 global $dbh;
$query = "SELECT count(*) FROM  list_city where id_ostan = '$id_ostan' and id_city = '$id_city'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_shahr = $stmt->fetchColumn();
return $count_city_shahr ; 	

}
function ostan_city_count($id_ostan)
{
 global $dbh;
$query = "SELECT  count(*) FROM cityname WHERE  id_ostan = '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_city = $stmt->fetchColumn();
return $count_ostan_city ; 	

}
function ostan_mar_count($id_ostan)
{
 global $dbh;
$query = "SELECT count(*) FROM mar WHERE  id_ostan = '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_mar = $stmt->fetchColumn();
return $count_ostan_mar ; 	

}
function city_mar_count($id_ostan,$id_city)
{
 global $dbh;
$query = "SELECT  count(*) FROM mar WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_mar = $stmt->fetchColumn();
return $count_city_mar ; 	

}
function ostan_count()
{
 global $dbh;
$query = "SELECT  count(*) FROM ostanname "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan = $stmt->fetchColumn();
return $count_ostan ; 	

}
function kol_city_count()
{
 global $dbh;
$query = "SELECT  count(*)  FROM cityname "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city = $stmt->fetchColumn();
return $count_city ; 	

}
function city_count($id_ostan)
{
 global $dbh;
$query = "SELECT  count(*) FROM cityname WHERE  id_ostan = '$id_ostan' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city = $stmt->fetchColumn();
return $count_city ; 	

}
function shahr_count($id_ostan)
{
 global $dbh;
$query = "SELECT count(*) FROM list_city WHERE  id_ostan = '$id_ostan' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt->fetchColumn();
return $count_shahr ; 	

}
function kol_shahr_count($id_ostan)
{
 global $dbh;
$query = "SELECT  count(*) FROM public_city WHERE  id_ostan = '$id_ostan' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt->fetchColumn();
return $count_shahr ; 	

}
function abadi_count()
{
 global $dbh;
$query = "SELECT count(*) FROM  list_abadi " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 	

}
function abadi_no_mor_count()
{
 global $dbh;
$query = "SELECT count(*) FROM  list_abadi where mor_cod_m = '' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi = $stmt->fetchColumn(); 
return $count_abadi ; 	

}
function ostan_abadi_count($id_ostan)
{
 global $dbh;
$query = "SELECT count(*) FROM  list_abadi WHERE id_ostan = '$id_ostan'  " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
}
function kol_abadi_count($id_ostan)
{
 global $dbh;
$query = "SELECT count(*) FROM public_abadi4 where id_ostan = '$id_ostan'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol_ostan_abadi =$stmt->fetchColumn(); 
return $kol_ostan_abadi ; 	

}
?>
<?php function mor_jens_count($n_jens)
{
 global $dbh;
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT count(*) FROM  users WHERE  jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_jens_mor = $stmt ->fetchColumn(); 
return $count_jens_mor ; 

}
?>
<?php function ostan_mor_jens_count($id_ostan,$n_jens)
{
 global $dbh;
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT count(*) FROM  users WHERE  id_ostan = '$id_ostan' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_jens_mor = $stmt ->fetchColumn(); 
return $count_ostan_jens_mor ; 

}
?>
<?php function mor_mtah_count($m_tah)
{
 global $dbh;
$query = "SELECT count(*) FROM  users WHERE  m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_jens_mor = $stmt ->fetchColumn(); 
return $count_jens_mor ; 

}
?>
<?php function ostan_mor_mtah_count($id_ostan,$m_tah)
{
 global $dbh;
$query = "SELECT count(*)  FROM  users WHERE  id_ostan = '$id_ostan' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_jens_mor = $stmt -> fetchColumn();
return $count_ostan_jens_mor ; 

}
?>
<?php function mor_count()
{
 global $dbh;
$query = "SELECT count(*)  FROM  users WHERE  S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mor = $stmt -> fetchColumn();
return $count_mor ; 

}
?>
<?php function ostan_mor_count($id_ostan)
{
 global $dbh;
$query = "SELECT count(*) FROM  users WHERE id_ostan = '$id_ostan' and S_access = '1'  " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 

}
?>
<?php function city_request_count($city)
{
 global $dbh;
$query = "SELECT count(*) FROM  change_mor WHERE city = '$city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_request = $result->fetchColumn(); 
return $count_city_request ; 

}
?>
<?php function kol_bah_count()
{
 global $dbh;
$query = "SELECT count(*) FROM  bah  WHERE ok = '1' " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 

}
?>
<?php function ostan_bah_count($id_ostan)
{
 global $dbh;
$query = "SELECT count(*) FROM  bah WHERE id_ostan = '$id_ostan' and ok = '1'  " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 

}
?>
<?php function city_bah_count($id_ostan,$id_city)
{
 global $dbh;
$query = "SELECT count(*) FROM  bah WHERE id_ostan = '$id_ostan' and id_city = '$id_city'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bah = $stmt->fetchColumn();
return $count_city_bah ; 

}
?>
<?php function city_bee_count($id_ostan,$id_city)
{
 global $dbh;
$query = "SELECT count(*) FROM  bee WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bee = $stmt->fetchColumn();
return $count_city_bee ; 

}
?>
<?php function ostan_abadi_update_per($id_ostan)
{
 global $dbh;
$query = "select count(*)  FROM list_abadi
LEFT JOIN public_abadi4 ON public_abadi4.add_abadi = list_abadi.add_abadi
WHERE  public_abadi4.id_ostan = '$id_ostan' and public_abadi4.up_date <> '' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 $count_update = $stmt -> fetchColumn();
 $count_kol = ostan_abadi_count($id_ostan) ;
$per_update = round((($count_update*100)/$count_kol),1) ;
return $per_update ; 

}
?>

<?php function abadi_update_per($id_ostan,$id_city)
{
 global $dbh;
$query = "select count(*)  FROM list_abadi
LEFT JOIN public_abadi4 ON public_abadi4.add_abadi = list_abadi.add_abadi
WHERE  public_abadi4.id_ostan = '$id_ostan' and public_abadi4.id_city = '$id_city' and public_abadi4.up_date <> '' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 $count_update = $stmt -> fetchColumn();
 $count_kol = city_abadi_count($id_ostan,$id_city) ;
$per_update = round((($count_update*100)/$count_kol),1) ;
return $per_update ; 

}
?>



<?php function city_status($id_ostan,$id_city)
{
 global $dbh;
$query = "SELECT count(*)  FROM  users  WHERE  id_city = '$id_city'  and S_access = '1' and con_city='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt -> fetchColumn();
if ($count_finish_mor ==  city_mor_count($id_ostan,$id_city)) $result = 1 ; else $result = 2;   
return $result ; 

}
function mor_shahr_count($mor_cod_m)
{
 global $dbh;
$query = "SELECT count(*)  FROM  list_city WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt -> fetchColumn();
return $count_shahr ; 	

}
function mor_bah_count($mor_cod_m)
{
 global $dbh;
$query = "SELECT count(*)  FROM  bah WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bah = $stmt -> fetchColumn();
return $count_bah ; 	

}
function abadi_bah_count($add_abadi)
{
 global $dbh;
$query = "SELECT count(*)  FROM  bah WHERE  add_abadi = '$add_abadi' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi_bah = $stmt -> fetchColumn();
return $count_abadi_bah ; 	

}
function sh_bah_count($add_city)
{
 global $dbh;
$query = "SELECT count(*)  FROM  bah WHERE  add_city = '$add_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi_bah = $stmt -> fetchColumn();
return $count_abadi_bah ; 	

}
function shahr_bah_count($add_city)
{
 global $dbh;
$stmt = $dbh->prepare("SELECT count(*) FROM bah WHERE add_city = '$add_city'");
$stmt->execute();
$count = $stmt->fetchColumn();
return $count ; 

}
function inactive_abadi()
{
 global $dbh;
$query = "SELECT count(*) as in_abadi
FROM public_abadi4
LEFT JOIN list_abadi ON list_abadi.add_abadi = public_abadi4.add_abadi
 WHERE list_abadi.add_abadi IS NULL  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//echo $row['User_Name'] ; 
$inactive_abadi = $row['in_abadi'] ;
return $inactive_abadi ; 	

}
function inactive_city()
{
 global $dbh;
$query = "SELECT count(*)  FROM public_city  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol_city = $stmt -> fetchColumn();
$active_city = totl_shahr_count() ;   
$inactive_city = ($kol_city - $active_city) ;
return $inactive_city ; 	

}
?>

<?php
function totl_shahr_count()
{
 global $dbh;
$query = "SELECT count(*) FROM  list_city  " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 	

}
function totl_mar_count()
{
 global $dbh;
$query = "SELECT count(*) FROM mar  "  ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 	

}
function ostan_Agri_count($id_ostan,$sal)
{
$sal1 = $sal-1 ;
$z_sal = $sal1.'_'.$sal ;
$Agri_table = 'Agri'.$z_sal ; 
 global $dbh;
$query = "SELECT count(*)  FROM $Agri_table where id_ostan= '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Agri = $stmt -> fetchColumn();
return $count_ostan_Agri ; 	

}
function total_Agri_count($sal)
{
$sal1 = $sal-1 ;
$z_sal = $sal1.'_'.$sal ;
$Agri_table = 'Agri'.$z_sal ; 
 global $dbh;
$query = "SELECT count(*)  FROM $Agri_table where 1 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri = $stmt -> fetchColumn();
return $count_Agri ; 	

}
function ostan_Garden_count($id_ostan,$sal)
{
 global $dbh;
$query = "SELECT count(*)  FROM Garden where id_ostan= '$id_ostan' and z_sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Garden = $stmt -> fetchColumn();
return $count_ostan_Garden ; 	

}
function total_Garden_count($sal)
{
 global $dbh;
$query = "SELECT count(*)  FROM Garden where z_sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Garden = $stmt -> fetchColumn();
return $count_Garden ; 	

}
function ostan_Greenhous_count($id_ostan,$sal)
{
 global $dbh;
$query = "SELECT count(*)  FROM Greenhous where id_ostan= '$id_ostan' and sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Greenhous = $stmt -> fetchColumn();
return $count_ostan_Greenhous ; 	

}
function total_Greenhous_count($sal)
{
 global $dbh;
$query = "SELECT count(*)  FROM Greenhous where sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Greenhous = $stmt -> fetchColumn();
return $count_Greenhous ; 	

}
function ostan_Aquatic_count($id_ostan,$sal)
{
 global $dbh;
$query = "SELECT count(*)  FROM Aquatic where id_ostan= '$id_ostan' and sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Aquatic = $stmt -> fetchColumn();
return $count_ostan_Aquatic ; 	

}
function total_Aquatic_count($sal)
{
 global $dbh;
$query = "SELECT count(*)  FROM Aquatic where sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Aquatic = $stmt -> fetchColumn();
return $count_Aquatic ; 	

}
?>
<!-- summary 2 -->
<?php
function ostan_Agri_count2($id_ostan,$sal)
{
$sal1 = $sal-1 ;
$z_sal = $sal1.'_'.$sal ;
$Agri_table = 'Agri'.$z_sal ; 
 global $dbh;
$query = "SELECT count(*)   FROM $Agri_table where id_ostan= '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Agri = $stmt -> fetchColumn(); 
return $count_ostan_Agri ; 	

}
function total_Agri_count2($sal)
{
$sal1 = $sal-1 ;
$z_sal = $sal1.'_'.$sal ;
$Agri_table = 'Agri'.$z_sal ; 
 global $dbh;
$query = "SELECT count(*)   FROM $Agri_table where 1 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri = $stmt -> fetchColumn();
return $count_Agri ; 	

}
function ostan_Garden_count2($id_ostan,$sal)
{
 global $dbh;
$query = "SELECT count(*)   FROM Garden where id_ostan= '$id_ostan' and z_sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Garden = $stmt -> fetchColumn(); 
return $count_ostan_Garden ; 	

}
function total_Garden_count2($sal)
{
 global $dbh;
$query = "SELECT dcount(*)  FROM Garden where z_sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Garden = $stmt -> fetchColumn();
return $count_Garden ; 	

}
function ostan_Greenhous_count2($id_ostan,$sal)
{
 global $dbh;
$query = "SELECT ccount(*)   FROM Greenhous where id_ostan= '$id_ostan' and sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Greenhous = $stmt -> fetchColumn();
return $count_ostan_Greenhous ; 	

}
function total_Greenhous_count2($sal)
{
 global $dbh;
$query = "SELECT count(*)  FROM Greenhous where sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Greenhous = $stmt -> fetchColumn();
return $count_Greenhous ; 	

}
function ostan_Aquatic_count2($id_ostan,$sal)
{
 global $dbh;
$query = "SELECT count(*)   FROM Aquatic where id_ostan= '$id_ostan' and sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_Aquatic = $stmt -> fetchColumn();
return $count_ostan_Aquatic ; 	

}
function total_Aquatic_count2($sal)
{
 global $dbh;
$query = "SELECT count(*)   FROM Aquatic where sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Aquatic = $stmt -> fetchColumn();
return $count_Aquatic ; 	

}
?>
