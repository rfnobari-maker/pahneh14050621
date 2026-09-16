<?php
include('../../lock_p1.php');
include_once('../../login/config.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
//include_once('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
/////////////////////////////////////////////////// 
 if (isset($_POST['action'])) 
 {  
$date_s = $date_edit ;
$mor_cod_m = $login_session ;
$check_cod = $_POST['check_cod']  ;
$check_cod ++ ;
$bah_cod_m = $_POST['bah_cod_m']; 
$add_city = $_POST['add_city'] ;
$add_abadi = $_POST['add_abadi'] ;
$id_ostan = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ;
$m_zamin = $_POST['m_zamin'] ;
$no_mal = $_POST['no_mal'] ;
$lng = $_POST['lng'] ;
$lat = $_POST['lat'] ;
if ($lng>99) $lng = 0 ; 
if ($lat>99) $lat = 0 ; 
$m_cod_m = $_POST['m_cod_m'] ;
$num_bah = $_POST['num_bah']; 
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
$m_vaz_sok = $_POST['m_vaz_sok'] ;
$no_kesh = $_POST['no_kesh'] ;
$nah_kesh = $_POST['nah_kesh'] ;
if ($no_kesh =='1')
{
$m_ab = $_POST['m_ab'] ;
$md_ab = $_POST['md_ab'] ;
$h_ab = $_POST['h_ab'] ;
$no_sab = $_POST['no_sab'] ;
$no_ab = $_POST['no_ab'] ;
$es = $_POST['es'] ;
}
if ($no_kesh =='2')
{
$m_ab = '' ;
$md_ab = 0 ;
$h_ab = 0 ;
$no_sab = '' ;
$no_ab = '' ;
$es = '' ;
}
$t_mah = $_POST['t_mah'] ;
$z_sal = $_POST['z_sal'] ;
$s_ayesh = $_POST['s_ayesh'] ;
//بانک مالک
$m_jens = $_POST['m_jens'] ;
$m_name = $_POST['m_name'] ;
$m_last_name = $_POST['m_last_name'] ;
$m_fname = $_POST['m_fname'] ;
$m_tel_m = $_POST['m_tel_m'] ;
$t_mah = $_POST['t_mah'] ;
// بانک اطلاعات کشت 
if ($nah_kesh<>3)
{
$query = "INSERT INTO Garden (date_s,mor_cod_m,bah_cod_m,num_bah,sh_gat,id_ostan,id_city,id_mar,add_abadi,add_city,m_zamin,no_mal,lng,lat,m_cod_m,m_vaz_sok,nah_kesh,no_kesh,m_ab,md_ab,h_ab,no_sab,no_ab,es,z_sal,t_mah,check_cod)                        VALUES(:date_s,:mor_cod_m,:bah_cod_m,:num_bah,:sh_gat,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:m_zamin,:no_mal,:lng,:lat,:m_cod_m,:m_vaz_sok,:nah_kesh,:no_kesh,:m_ab,:md_ab,:h_ab,:no_sab,:no_ab,:es,:z_sal,:t_mah,:check_cod)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah,':sh_gat'=>$sh_gat,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':m_zamin'=>$m_zamin,':no_mal'=>$no_mal,':lng'=>$lng,':lat'=>$lat,':m_cod_m'=>$m_cod_m,':m_vaz_sok'=>$m_vaz_sok,':nah_kesh'=>$nah_kesh,':no_kesh'=>$no_kesh,':m_ab'=>$m_ab,':md_ab'=>$md_ab,':h_ab'=>$h_ab,':no_sab'=>$no_sab,':no_ab'=>$no_ab,':es'=>$es,':z_sal'=>$z_sal,':t_mah'=>$t_mah,':check_cod'=>$check_cod));

$num3_t_mah = $t_mah ;
// شروع حلقه تنوع محصول 
$Garden_id = Garden_id($bah_cod_m,$sh_gat,$z_sal,$mor_cod_m,$date_s)  ;
while ($num3_t_mah > 0 and $Garden_id>0 ){
 $cod_qroup = $_POST['mah_qroup'.$num3_t_mah] ;
 $cod_mah = $_POST['mah_name'.$num3_t_mah] ;
 $s_kesht_b = $_POST['s_kesht_b'.$num3_t_mah] ;
 $s_kesht_gb = $_POST['s_kesht_gb'.$num3_t_mah] ;
 $tree_b = $_POST['tree_b'.$num3_t_mah] ;
 $tree_gb = $_POST['tree_gb'.$num3_t_mah] ;
 $mah_tol = $_POST['mah_tol'.$num3_t_mah] ;
 $mah_tolp = $_POST['mah_tolp'.$num3_t_mah] ;
 $mah_bem = $_POST['mah_bem'.$num3_t_mah] ;
$query = "INSERT INTO `eagri_pahneh`.`Garden_prod` (`Garden_id` ,`id`, `date_s`, `mor_cod_m`, `id_ostan`, `id_city`, `id_mar`, `bah_cod_m`, `num_bah`, `sh_gat`, `no_kesh`, `nah_kesh`, `z_sal`, `cod_qroup`, `cod_mah`, `s_kesht_b`, `s_kesht_gb`, `tree_b`, `tree_gb`, `mah_tol`, `mah_tolp`, `mah_bem`, `add_abadi`, `add_city`,`check_cod`) VALUES ('$Garden_id',NULL, '$date_s', '$mor_cod_m', '$id_ostan', '$id_city', '$id_mar', '$bah_cod_m', '$num_bah', '$sh_gat', '$no_kesh', '$nah_kesh', '$z_sal', '$cod_qroup', '$cod_mah', '$s_kesht_b', '$s_kesht_gb', '$tree_b', '$tree_gb', '$mah_tol', '$mah_tolp', '$mah_bem', '$add_abadi', '$add_city','$check_cod');";
$q = $dbh->prepare($query);
$q->execute();
// پایان حلقه تنوع محصول 
$num3_t_mah--;
}
$query = "INSERT IGNORE INTO malek (date_s,mor_cod_m,m_cod_m,m_jens,m_name,m_last_name,m_fname,m_tel_m)                        VALUES(:date_s,:mor_cod_m,:m_cod_m,:m_jens,:m_name,:m_last_name,:m_fname,:m_tel_m)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':m_cod_m'=>$m_cod_m,':m_jens'=>$m_jens,':m_name'=>$m_name,':m_last_name'=>$m_last_name,':m_fname'=>$m_fname,':m_tel_m'=>$m_tel_m));
}
if ($nah_kesh=='3')
{
$query = "INSERT INTO Garden (date_s,mor_cod_m,bah_cod_m,num_bah,sh_gat,id_ostan,id_city,id_mar,add_abadi,add_city,nah_kesh,z_sal,t_mah,check_cod)           VALUES(:date_s,:mor_cod_m,:bah_cod_m,:num_bah,:sh_gat,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:nah_kesh,:z_sal,:t_mah,:check_cod)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah,':sh_gat'=>$sh_gat,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':nah_kesh'=>$nah_kesh,':z_sal'=>$z_sal,':t_mah'=>$t_mah,':check_cod'=>$check_cod));

$num3_t_mah = $t_mah ;
// شروع حلقه تنوع محصول 
while ($num3_t_mah > 0){
 $cod_qroup = $_POST['mah_qroup'.$num3_t_mah] ;
 $cod_mah = $_POST['mah_name'.$num3_t_mah] ;
 $tree_b = $_POST['tree_b'.$num3_t_mah] ;
 $tree_gb = $_POST['tree_gb'.$num3_t_mah] ;
 $mah_tol = $_POST['mah_tol'.$num3_t_mah] ;
 $mah_tolp = $_POST['mah_tolp'.$num3_t_mah] ;
 $mah_bem = $_POST['mah_bem'.$num3_t_mah] ;
 $Garden_id = Garden_id($bah_cod_m,$sh_gat,$z_sal,$mor_cod_m,$date_s)  ;
if ($Garden_id > 0)
{
$query = "INSERT INTO `eagri_pahneh`.`Garden_prod` (`Garden_id` ,`id`, `date_s`, `mor_cod_m`, `id_ostan`, `id_city`, `id_mar`, `bah_cod_m`, `num_bah`, `sh_gat`,  `nah_kesh`, `z_sal`, `cod_qroup`, `cod_mah`, `tree_b`, `tree_gb`, `mah_tol`, `mah_tolp`, `mah_bem`, `add_abadi`, `add_city`,`check_cod`) VALUES ('$Garden_id',NULL, '$date_s', '$mor_cod_m', '$id_ostan', '$id_city', '$id_mar', '$bah_cod_m', '$num_bah', '$sh_gat', '$nah_kesh', '$z_sal', '$cod_qroup', '$cod_mah', '$tree_b', '$tree_gb', '$mah_tol', '$mah_tolp', '$mah_bem', '$add_abadi', '$add_city','$check_cod');";
}
$q = $dbh->prepare($query);
$q->execute();
// پایان حلقه تنوع محصول 
$num3_t_mah--;
}
}
 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ثبت اطلاعات باغی - '.$bah_cod_m,$id_ostan) ; 
unset($error,$date_s,$mor_cod_m,$bah_cod_m,$sh_gat,$id_ostan,$id_city,$id_mar,$add_abadi,$add_city,$no_kesh,$z_sal,$cod_qroup,$cod_mah,$s_kesht_b,$s_kesht_gb,$tree_b,$tree_gb,$mah_tol,$mah_tolp,$mah_bem,$m_zamin,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_kesh,$m_ab,$md_ab,$h_ab,$no_sab,$no_ab,$es,$z_sal,$s_ayesh,$m_addres,$m_jens,$m_name,$m_last_name,$m_fname,$m_tel_m,$check_cod);
alert ('اطلاعات بهره برداری باغ و قلمستان با موفقیت ثبت شد ') ;
// clos conntection 

?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
<?php
if  (isset($_POST['unit_id']))
{
date_default_timezone_set('Asia/Tehran') ;
$date_s = date_con(jdate("Y/m/d"));
$unit_id = $_POST['unit_id'] ; 
$y_prod = $_POST['y_prod'];
$num_bah = $_POST['num_bah'];

$query = "SELECT bah_cod_m,add_abadi,id_ostan,id_city,id_mar,unit_name,no_mush,gaz from Mushroom where id = :id"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$unit_id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$add_abadi = $row["add_abadi"]; 
$add_abadi = $row["add_abadi"]; 
$add_city = $row["add_city"];
$id_ostan = $row["id_ostan"]; 
$id_city = $row["id_city"]; 
$id_mar = $row["id_mar"]; 
$bah_cod_m = $row['bah_cod_m'];
$unit_name = $row['unit_name'];
$no_mush = $row['no_mush'];
$gaz = $row['gaz'];

if ($no_mush=='1')  $v_no_mush='صدفی';
if ($no_mush=='2')  $v_no_mush='دکمه ای';

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="modify_records.js"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function ()  {
            $("#form1").validate();
           });

     function checkform() { 
          if(5>4)
		   {
        alert("اطلاعات سالن تکمیل نشده است");
        return false;
    } 
	else
	 {
    	return true;
    }
    }
</script>
</head>
<body>
     <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td>
      <?php include('top.php'); ?>
           <p class="style8">ثبت عملکرد سال <?php echo $y_prod?> واحد پرورش قارچ </p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1"  onSubmit="return checkform()">
      <table width="99%" height="997" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="31" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:20px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="33%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan)?></div></td>
          <td width="15%"><div align="right">:شهرستان</div></td>
          <td width="9%" rowspan="3">&nbsp;</td>
          <td width="25%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo $v_no_mush ?></div></td>
          <td height="38"><div align="right">: نوع قارچ پرورشی</div></td>
          <td height="38"><div align="right"> <?php echo $unit_name; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نام واحد</div></td>
        </tr>
        <tr>
          <td height="30" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>تعداد افراد شاغل</strong></div></td>
        </tr>
        <tr>
          <td height="40"><div align="right"><span class="style2">نفر</span>
            <input name="dep" type="text" class="input_text  required  digits" id="dep" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $dep ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div align="right">:دیپلم یا بالاتر</div></td>
          <td rowspan="3">&nbsp;</td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="z_dep" type="text" class="input_text  required  digits" id="z_dep" style="width:50px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $z_dep ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:زیر دیپلم</div></td>
        </tr>
        <tr>
          <td height="43">&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="lisan" type="text" class="input_text  required  digits" id="lisan" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lisan ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:لیسانس یا بالاتر</div></td>
        </tr>
        <tr>
          <td height="42"><div align="right"><span class="style2">نفر</span>
            <input name="t_zan" type="text" class="input_text  required  digits" id="t_zan" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $t_zan ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div align="right">:تعداد شاغل زن </div></td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="t_mar" type="text" class="input_text  required  digits" id="t_mar" style="width:50px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $t_mar ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:تعداد شاغل مرد</div></td>
        </tr>
        <tr>
          <td height="215" colspan="5">  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="29" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>وضعیت سموم و مواد ضد عفونی کننده مورد استفاده در سال </strong></div></td>
                </tr>
              <tr>
                <td width="26%" height="36" ><div style="margin-right:30px" align="right" >ارزش /<span class="style2">میلیون ریال</span></div> </td>
                <td width="18%" ><div style="margin-right:30px" align="right" >مایع / <span class="style2">لیتر</span></div></td>
                <td width="19%"  bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" > ارزش / <span class="style2">میلیون ریال</span>  </div></td>
                <td width="19%"  bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >جامد / <span class="style2">کیلوگرم</span></div></td>
                <td width="18%">&nbsp;</td>
                </tr>
              <tr>
                <td height="46" bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_ma" type="text" class="input_text  required  number" id="gar_ma" style="width:100px;height:30px" tabindex="9" dir="rtl" lang="fa" value="<?php echo $gar_ma ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_m" type="text" class="input_text  required  number" id="gar_m" style="width:100px;height:30px" tabindex="8" dir="rtl" lang="fa" value="<?php echo $gar_m ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_ja" type="text" class="input_text  required  number" id="gar_ja" style="width:100px;height:30px" tabindex="7" dir="rtl" lang="fa" value="<?php echo $gar_ja ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_j" type="text" class="input_text  required  number" id="gar_j" style="width:100px;height:30px" tabindex="6" dir="rtl" lang="fa" value="<?php echo $gar_j ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
                <td width="18%" bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >قارچ کش</div></td>
                </tr>
              <tr>
                <td height="44"><div align="right">
                  <input name="hash_ma" type="text" class="input_text  required  number" id="hash_ma" style="width:100px; height:30px" tabindex="13" dir="rtl" lang="fa" value="<?php echo $hash_ma ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div align="right">
                  <input name="hash_m" type="text" class="input_text  required  number" id="hash_m" style="width:100px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $hash_m ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div align="right">
                  <input name="hash_ja" type="text" class="input_text  required  number" id="hash_ja" style="width:100px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $hash_ja ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div align="right">
                  <input name="hash_j" type="text" class="input_text  required  number" id="hash_j" style="width:100px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $hash_j ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
                <td ><div style="margin-right:30px" align="right" >حشره کش</div></td>
                </tr>
              <tr>
                <td height="47"><div align="right">
                  <input name="zof_ma" type="text" class="input_text  required  number" id="zof_ma" style="width:100px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $zof_ma ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
                <td height="47"><div align="right">
                  <input name="zof_m" type="text" class="input_text  required  number" id="zof_m" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $zof_m ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
                <td height="47"><div align="right">
                  <input name="zof_ja" type="text" class="input_text  required  number" id="zof_ja" style="width:100px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $zof_ja ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
                <td height="47"><div align="right">
                  <input name="zof_j" type="text" class="input_text  required  number" id="zof_j" style="width:100px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $zof_j ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
                <td ><div style="margin-right:30px" align="right" >ضد عفونی کننده</div></td>
                </tr>
              </table></td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="29" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>وضعیت مصرف حامل های انرژی در سال </strong></div></td>
              </tr>
            <tr>
              <td width="26%" height="35" ><?php if($gaz=='1') {?><div style="margin-right:30px" align="right" >گاز</div><?php }?></td>
              <td width="18%" ><div style="margin-right:30px" align="right" >گازوئیل</div></td>
              <td width="19%" ><div style="margin-right:30px" align="right" >بنزین</div></td>
              <td width="19%" bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >برق</div></td>
              <td width="18%">&nbsp;</td>
              </tr>
            <tr>
              <td height="47"><?php if($gaz=='1') {?><div align="right">
                <span class="style2">مترمکعب</span>
                <input name="gaz_m" type="text" class="input_text  required  number" id="gaz_m" style="width:100px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $gaz_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div><?php }?></td>
              <td><div align="right"><span class="style2">لیتر</span>
                <input name="gazoil_m" type="text" class="input_text  required  number" id="gazoil_m" style="width:100px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $hazoil_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
              <td><div align="right">
                <span class="style2">لیت</span>
                <input name="benz_m" type="text" class="input_text  required  number" id="benz_m" style="width:100px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $benz_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
              <td><div align="right">
                <span class="style2">کیلووات</span>
                <input name="barg_m" type="text" class="input_text  required  number" id="barg_m" style="width:100px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $barg_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
              <td ><div style="margin-right:30px" align="right" >مقدار</div></td>
              </tr>
            <tr>
              <td height="52"><?php if($gaz=='1') {?><div align="right">
                <input name="gaz_a" type="text" class="input_text  required  number" id="gaz_a" style="width:100px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $gaz_a ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div><?php }?></td>
              <td><div align="right">
                <input name="gazoil_a" type="text" class="input_text  required  number" id="gazoil_a" style="width:100px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $gazoil_a ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
              <td><div align="right">
                <input name="benz_a" type="text" class="input_text  required  number" id="benz_a" style="width:100px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $benz_a ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
              <td bgcolor="#FFFFFF"><div align="right">
                <input name="barg_a" type="text" class="input_text  required  number" id="barg_a" style="width:100px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $gazoil_a ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div></td>
              <td bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >ارزش / <span class="style2">میلیون ریال</span></div></td>
              </tr>
            </table></td>
        </tr>
          <tr>
            <td height="29" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>میزان کمپوست مصرفی در سال </strong></div></td>
              </tr>
              <tr>
                <td height="47" colspan="3" ><span class="style2">ر</span></td>
                <td bgcolor="#FFFFFF" ><div align="right"><span class="style2">تن /سال</span>
                  <input name="comp" type="text" class="input_text  required  number" id="comp" style="width:100px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $comp ; ?>"  maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div style="margin-right:30px" align="right" >:کمپوست مصرفی</div></td>
              </tr>
              <tr>
                <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>اطلاعات تولید  </strong></div></td>
                </tr>
              <tr>
                <td width="33%" height="47" ><div align="right"><span class="style2">کیلوگرم</span>
                  <input name="mah_tol" type="text" class="input_text  required  number" id="mah_tol" style="width:100px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $mah_tol ; ?>" maxlength="4"  align="baseline" xml:lang="fa" />
                </div></td>
                <td width="15%" ><div align="right">:میزان کل تولید </div></td>
                <td width="9%" >&nbsp;</td>
                <td width="22%" bgcolor="#FFFFFF" ><div align="right"><span class="style2">دوره</span>
                    <input name="t_dpar" type="text" class="input_text  required  number" id="t_dpar" style="width:100px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $t_dpar ; ?>" min="1" max="8" maxlength="1"  align="baseline" xml:lang="fa" />
                </div></td>
                <td width="21%"><div style="margin-right:30px" align="right" >:تعداد دوره های پرورش در سال </div></td>
                </tr>
              </table></td>
          </tr>
          <tr>
          <td height="29" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>مشخصات سالن ها  </strong></div></td>
          </tr>
        <tr>
          <td height="71" colspan="5"><?php include('Mushroom_prod_data.php')?></td>
        </tr>
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="p_number" value=<?php echo $number; ?> />
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="hidden" name="y_prod" value=<?php echo $y_prod; ?> />
     <input type="hidden" name="unit_id" value=<?php echo $unit_id; ?> />
     <input type="hidden" name="no_kesh" value=<?php echo $no_kesh; ?> />
     <input type="hidden" name="nah_kesh" value=<?php echo $nah_kesh; ?> />
     <input type="hidden" name="no_mal" value=<?php echo $no_mal; ?> />
     <input type="hidden" name="t_mah" value=<?php echo $t_mah; ?> />
    <input type="submit" name="action" value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="29" id="submit" />
  <a href="Mushroom_prod.php">
    <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="30" /></a>
        </p>
      </div>
</form> 
<script>
function disableFunction() {
    document.getElementById("submit").disabled = 'true';
	$("#submit").attr("disabled","");
}
</script>
  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Mushroom_prod.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
   </tr>
</table>
</table>
</body>
</html>
<script>
// we used jQuery 'keyup' to trigger the computation as the user type
$('.mashat').keyup(function () {
    // initialize the sum (total mashat) to zero
    var sum = 0;
    // we use jQuery each() to loop through all the textbox with 'mashat' class
    // and compute the sum for each loop
    $('.mashat').each(function() {
        sum += Number($(this).val());
    });
     var kol = document.getElementById("m_zamin").value;
     
    // set the computed value to 'use' textbox
	if (kol === '') { kol = 0 ; }
    $('#kol').val(kol);
    // we use jQuery each() to loop through all the textbox with 'mashat' class
    // and compute the sum for each loop
    $('.mashat').each(function() {
        def -= Number($(this).val());
    });
    // set the computed value to 'use' textbox
    $('#use').val(sum);
    var def = parseFloat(kol) - parseFloat(sum) ;
    // set the computed value to 'use' textbox
	var defn = def.toFixed(4)*1
    $('#traz').val(defn);
if( defn < 0 ){
   alert("مجموع سطح کشت بارور و غیربارور از کل مساحت زمین بیشتر است");
   document.getElementById("submit").disabled = true;
}
if( defn >= 0 ){
   document.getElementById("submit").disabled = false ;
}
});
</script>
<?php
$no = $t_mah ; 
while ($no > 0){
?>
<script>
$( ".target" ).change(function() {
  var e = document.getElementById("cod_mah<?php echo $no ?>");
  var mcod = e.options[e.selectedIndex].value;
  if (mcod == '299007') 
  {
  alert('غیر مثمر');
    $('#mah_tol<?php echo $no ?>').val(0);
    $('#mah_tolp<?php echo $no ?>').val(0);
  }
});
</script>
<script>
$('.z_kesht_a').keyup(function () {
   var mas = document.getElementById("mashat<?php echo $no ?>").value;
   var zka = document.getElementById("z_kesht_a<?php echo $no ?>").value;
if (parseInt(mas) < parseInt(zka)) {
   alert("سطح زیر کشت  درختان بارور از مساحت بزرگتر است ");
   document.getElementById("submit").disabled = true;
}
else 
{
   document.getElementById("submit").disabled = false ;
}
});
</script>
<script>
$('.z_kesht_b').keyup(function () {
   var mas = document.getElementById("mashat<?php echo $no ?>").value;
   var zkb = document.getElementById("z_kesht_b<?php echo $no ?>").value;
if (parseInt(mas) < parseInt(zkb)) {
   alert("سطح کشت درختان غیر بارور از مساحت بزرگتر است ");
   document.getElementById("submit").disabled = true;
}
else 
{
   document.getElementById("submit").disabled = false ;
}
});
</script>
<script>
$('.mah_tolp').change(function () {
   var e = document.getElementById("cod_mah<?php echo $no ?>");
   var mcod = e.options[e.selectedIndex].value;
   var p_mtol = document.getElementById("mah_tolp<?php echo $no ?>").value;
 if (mcod == '299007'  &&  parseFloat(p_mtol) > 0) {
   alert("میزان پبش بینی تولید محصولات غیرمثمر باید 0 ثبت شود");
            // پاک کردن مقدار تولید 
			$('#mah_tolp<?php echo $no ?>').val('0');
  			// فوکوس روی تولید محصول 
			document.getElementById("mah_tolp<?php echo $no ?>").focus();
}
   });
</script>
<script>
$('.mah_tol').change(function () {
   var e = document.getElementById("cod_mah<?php echo $no ?>");
   var mcod = e.options[e.selectedIndex].value;
   var p_mtol = document.getElementById("mah_tol<?php echo $no ?>").value;
 if (mcod == '299007'  &&  parseFloat(p_mtol) > 0) {
   alert("میزان تولید قطعی محصولات غیرمثمر باید 0 ثبت شود");
            // پاک کردن مقدار تولید 
			$('#mah_tol<?php echo $no ?>').val('0');
  			// فوکوس روی تولید محصول 
			document.getElementById("mah_tol<?php echo $no ?>").focus();
}
   });
</script>
<?php
 $no--;
}
?>