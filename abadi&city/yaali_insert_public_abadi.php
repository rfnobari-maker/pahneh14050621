<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT * from `public_abadi98` where ok = '2'   " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();

foreach($stmt as $row){
$id_abadi = $row['id_abadi'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_bakh = $row['id_bakh'] ;
$id_deh = $row['id_deh'] ;
$abadi = $row['abadi'] ;
$ostan = '' ;
$city = '' ;
$bakh = '' ;
$deh = '' ;
$id_hozeh = '001' ; 
$ok = $row['ok'] ;



//$query = "INSERT INTO `public_abadi400`(up_date,add_abadi,add_abadi1,id_abadi,id_ostan,id_city,id_bakh,id_deh,id_hozeh,ostan,city,bakh,deh,abadi) 
//VALUES (:up_date,:add_abadi,:add_abadi1,:id_abadi,:id_ostan,:id_city,:id_bakh,:id_deh,:id_hozeh,:ostan,:city,:bakh,:deh,:abadi)";
//$q = $dbh->prepare($query);
//$q->execute(array(':up_date'=>'-',':add_abadi'=>'-',':add_abadi1'=>'-',':id_abadi'=>$id_abadi,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_bakh'=>$id_bakh,
//':id_deh'=>$id_deh,':id_hozeh'=>$id_hozeh,':ostan'=>$ostan,':city'=>$city,':bakh'=>$bakh,':deh'=>$deh,
//':abadi'=>$abadi));



$query = "INSERT INTO `public_abadi40` (up_date,add_abadi,add_abadi1,id_abadi,id_ostan,id_city,id_bakh,id_deh,
id_hozeh,ostan,city,bakh,deh,abadi,hamyar, vaz_abadi, rah_zamin, rah_ahan, rah_abi, vaz_soko, s_mosem, e_mosem, 
t_hadi, learn_1,learn_2, learn_3, learn_4, learn_5, learn_6, learn_7, learn_8, learn_9, learn_10, sport_1, 
sport_2, sport_3, sport_4, mazhab_1, mazhab_2, mazhab_3, mazhab_4, mazhab_5, mazhab_6, mazhab_7
, mazhab_8, siyasi_1, siyasi_2, siyasi_3, siyasi_4, siyasi_5, niro_1, niro_2, niro_3, niro_4,
niro_5, niro_6, beh_1, beh_2, beh_3, beh_4, beh_5, beh_6, beh_7, beh_8, beh_9, beh_10,
beh_11, beh_12, beh_13, beh_14, beh_15, beh_16, beh_17, khad_1, khad_2, khad_3, khad_4,
khad_5, khad_6, khad_7, khad_8, khad_9, khad_10, khad_11, khad_12, ertebat_1, ertebat_2,
ertebat_3, ertebat_4, ertebat_5, ertebat_6, ertebat_7, ertebat_8, nofos_1, nofos_2, nofos_3,
nofos_4, nofos_5, post_cod) 
VALUES (:up_date,:add_abadi,:add_abadi1,:id_abadi,:id_ostan,:id_city,:id_bakh,:id_deh,:id_hozeh,:ostan,:city,:bakh
,:deh,:abadi,:hamyar,:vaz_abadi,:rah_zamin,:rah_ahan,:rah_abi,:vaz_soko,:s_mosem,:e_mosem,:t_hadi,:learn_1,
:learn_2,:learn_3,:learn_4,:learn_5,:learn_6,:learn_7,:learn_8,:learn_9,:learn_10,:sport_1,
:sport_2,:sport_3,:sport_4,:mazhab_1,:mazhab_2,:mazhab_3,:mazhab_4,:mazhab_5,:mazhab_6,:mazhab_7,
:mazhab_8,:siyasi_1,:siyasi_2,:siyasi_3,:siyasi_4,:siyasi_5,:niro_1,:niro_2,:niro_3,:niro_4,
:niro_5,:niro_6,:beh_1,:beh_2,:beh_3,:beh_4,:beh_5,:beh_6,:beh_7,:beh_8,:beh_9,:beh_10,
:beh_11,:beh_12,:beh_13,:beh_14,:beh_15,:beh_16,:beh_17,:khad_1,:khad_2,:khad_3,:khad_4,
:khad_5,:khad_6,:khad_7,:khad_8,:khad_9,:khad_10,:khad_11,:khad_12,:ertebat_1,:ertebat_2,
:ertebat_3,:ertebat_4,:ertebat_5,:ertebat_6,:ertebat_7,:ertebat_8,:nofos_1,:nofos_2,:nofos_3,
:nofos_4,:nofos_5,:post_cod)";
$q = $dbh->prepare($query);
$q->execute(array(':up_date'=>'',':add_abadi'=>'',':add_abadi1'=>'',':id_abadi'=>$id_abadi,':id_ostan'=>$id_ostan,
':id_city'=>$id_city,':id_bakh'=>$id_bakh,':id_deh'=>$id_deh,':id_hozeh'=>$id_hozeh,':ostan'=>$ostan,':city'=>$city
,':bakh'=>$bakh,':deh'=>$deh,':abadi'=>$abadi,':hamyar'=>'',':vaz_abadi'=>'',':rah_zamin'=>'',':rah_ahan'=>'',':rah_abi'=>'',':vaz_soko'=>'',':s_mosem'=>'',':e_mosem'=>'',':t_hadi'=>''
,':learn_1'=>'',':learn_2'=>'',':learn_3'=>'',':learn_4'=>'',':learn_5'=>'',':learn_6'=>'',':learn_7'=>'',
':learn_8'=>'',':learn_9'=>'',':learn_10'=>'',':sport_1'=>'',':sport_2'=>'',':sport_3'=>'',':sport_4'=>''
,':mazhab_1'=>'',':mazhab_2'=>'',':mazhab_3'=>'',':mazhab_4'=>'',':mazhab_5'=>'',':mazhab_6'=>'',
':mazhab_7'=>'',':mazhab_8'=>'',':siyasi_1'=>'',':siyasi_2'=>'',':siyasi_3'=>'',':siyasi_4'=>'',':siyasi_5'=>'',
':niro_1'=>'',':niro_2'=>'',':niro_3'=>'',':niro_4'=>'','niro_5'=>'',':niro_6'=>'',':beh_1'=>'',':beh_2'=>'',
':beh_3'=>'',':beh_4'=>'',':beh_5'=>'',':beh_6'=>'',':beh_7'=>'',':beh_8'=>'',':beh_9'=>'',':beh_10'=>''
,'beh_11'=>'',':beh_12'=>'',':beh_13'=>'',':beh_14'=>'',':beh_15'=>'',':beh_16'=>'',':beh_17'=>'',':khad_1'=>''
,':khad_2'=>'',':khad_3'=>'',':khad_4'=>'','khad_5'=>'',':khad_6'=>'',':khad_7'=>'',':khad_8'=>'',':khad_9'=>''
,':khad_10'=>'',':khad_11'=>'',':khad_12'=>'',':ertebat_1'=>'',':ertebat_2'=>'','ertebat_3'=>'',':ertebat_4'=>''
,':ertebat_5'=>'',':ertebat_6'=>'',':ertebat_7'=>'',':ertebat_8'=>'',':nofos_1'=>0,':nofos_2'=>0,':nofos_3'=>0
,'nofos_4'=>0,':nofos_5'=>0,':post_cod'=>''));

//alert($id_abadi) ; 
}
alert('تمام');
?>