<?php
include('../../lock_p1.php');
include_once('../../login/config.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
/////////////////////////////////////////////////// 
 if (isset($_POST['action'])) 
 {  
$date_s = $date_edit ;
$no_mush  = $_POST['no_mush']  ;
$num_bah   = $_POST['num_bah']  ;
 $bah_cod_m = $_POST['bah_cod_m'] ; 
 $add_city  = $_POST['add_city'] ;
 $add_abadi = $_POST['add_abadi']  ;
 $id_ostan  = $_POST['id_ostan'] ;
 $id_city   = $_POST['id_city']  ;
 $id_mar    = $_POST['id_mar']  ;
 $v_unit   = '1' ;
 $unit_id  = $_POST['unit_id'] ;
 $y_prod = $_POST['y_prod'] ;
 $z_dep = $_POST['z_dep'] ;
 $dep = $_POST['dep'] ;
 $lisan = $_POST['lisan'] ;
 $m_fani = $_POST['m_fani'] ;
 $t_mar = $_POST['t_mar'] ;
 $t_zan = $_POST['t_zan'] ;
 $gar_j = $_POST['gar_j'] ;
 $gar_ja = $_POST['gar_ja'] ;
 $gar_m = $_POST['gar_m'] ;
 $gar_ma = $_POST['gar_ma'] ;
 $hash_j = $_POST['hash_j'] ;
 $hash_ja = $_POST['hash_ja'] ;
 $hash_m = $_POST['hash_m'] ;
 $hash_ma = $_POST['hash_ma'] ;
 $zof_j = $_POST['zof_j'] ;
 $zof_ja = $_POST['zof_ja'] ;
 $zof_m = $_POST['zof_m'] ;
 $zof_ma = $_POST['zof_ma'] ;
 $gazoil_m = $_POST['gazoil_m'] ;
 $gazoil_a = $_POST['gazoil_a'] ;
 $benz_m = $_POST['benz_m'] ;
 $benz_a = $_POST['benz_a'] ;
 $ab_m = $_POST['ab_m'] ;
 $ab_a = $_POST['ab_a'] ;
 if(isset($_POST['barg_m'])){$barg_m = $_POST['barg_m'];$barg_a=$_POST['barg_a'];}else{$barg_m=0;$barg_a=0;}
 if(isset($_POST['gaz_m'])){$gaz_m = $_POST['gaz_m'];$gaz_a=$_POST['gaz_a'];}else{$gaz_m=0;$gaz_a=0;}
 $comp   = $_POST['comp'] ;
 $nt_comp   = $_POST['nt_comp'] ;
 $t_dpar = $_POST['t_dpar'] ;
 $mah_tol = $_POST['mah_tol'] ;
$query = "SELECT sum(zer_kesh) as kol_zer_kesh FROM Mushroom_spawn where unit_id =? and y_prod=? order by id";
$stmt = $dbh->prepare($query);
$stmt->execute(array($unit_id,$y_prod));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_zer_kesh = $row['kol_zer_kesh'] ;
$zer_kesh     = $kol_zer_kesh * $t_dpar ;
$tol_avg      = ($mah_tol * 1000) / $zer_kesh ; 
///
    $query = "INSERT INTO Mushroom_prod (date_s,unit_id,y_prod,v_unit,num_bah,bah_cod_m,mor_cod_m,no_mush,
	id_ostan,id_city,id_mar,add_abadi,add_city,z_dep,dep,lisan,m_fani,t_mar,t_zan,
	gar_j,gar_ja,gar_m,gar_ma,hash_j,hash_ja,hash_m,hash_ma,zof_j,zof_ja,zof_m,zof_ma,
	gazoil_m,gazoil_a,benz_m,benz_a,ab_m,ab_a,barg_m,barg_a,gaz_m,gaz_a,comp,nt_comp,t_dpar,mah_tol,zer_kesh,tol_avg)
	  VALUES(:date_s,:unit_id,:y_prod,:v_unit,:num_bah,:bah_cod_m,:mor_cod_m,:no_mush,
	  :id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:z_dep,:dep,:lisan,:m_fani,:t_mar,:t_zan,
	  :gar_j,:gar_ja,:gar_m,:gar_ma,:hash_j,:hash_ja,:hash_m,:hash_ma,:zof_j,:zof_ja,:zof_m,:zof_ma,
	  :gazoil_m,:gazoil_a,:benz_m,:benz_a,:ab_m,:ab_a,:barg_m,:barg_a,:gaz_m,:gaz_a,:comp,:nt_comp,:t_dpar,:mah_tol,:zer_kesh,:tol_avg)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_s'=>$date_edit,':unit_id'=>$unit_id,':y_prod'=>$y_prod,':v_unit'=>$v_unit,':mor_cod_m'=>$login_session,
	':no_mush'=>$no_mush,':num_bah'=>$num_bah,':bah_cod_m'=>$bah_cod_m,':id_ostan'=>$id_ostan,':id_city'=>$id_city,
	':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':z_dep'=>$z_dep,':dep'=>$dep,':lisan'=>$lisan,
	':m_fani'=>$m_fani,':t_mar'=>$t_mar,':t_zan'=>$t_zan,':gar_j'=>$gar_j,':gar_ja'=>$gar_ja,':gar_m'=>$gar_m,
	':gar_ma'=>$gar_ma ,':hash_j'=>$hash_j,':hash_ja'=>$hash_ja,':hash_m'=>$hash_m,':hash_ma'=>$hash_ma,':zof_j'=>$zof_j
	,':zof_ja'=>$zof_ja,':zof_m'=>$zof_m,':zof_ma'=>$zof_ma,':gazoil_m'=>$gazoil_m,':gazoil_a'=>$gazoil_a
	,':ab_a'=>$ab_a,':ab_m'=>$ab_m,
	':benz_m'=>$benz_m,':benz_a'=>$benz_a,':barg_m'=>$barg_m,':barg_a'=>$barg_a,':gaz_m'=>$gaz_m,':gaz_a'=>$gaz_a,
	':comp'=>$comp,':nt_comp'=>$nt_comp,':t_dpar'=>$t_dpar,':mah_tol'=>$mah_tol,':zer_kesh'=>$zer_kesh,':tol_avg'=>$tol_avg));
    sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','ثبت عملکرد واحد پرورش قارچ-'.$bah_cod_m,$id_ostan) ;
 
    alert ('عملکرد واحد پرورش قارچ با موفقیت ثبت شد ') ;
?>
<form  name="myform" class="myform" method="post" action="liste_Mush_prod.php">
            <input type="hidden" name="id"  value="<?php echo $unit_id ;?>" />
            <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m  ;?>" />
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

$query = "SELECT bah_cod_m,add_abadi,add_city,id_ostan,id_city,id_mar,unit_name,no_mush,gaz,barg from Mushroom where id = :id"; 
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
$barg = $row['barg'];

if ($no_mush=='1')  $v_no_mush='صدفی';
if ($no_mush=='2')  $v_no_mush='دکمه ای';
if ($no_mush=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';
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
    <script type="text/javascript" src="modify_records98.js"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function ()  {
            $("#form1").validate();
           });
//  function checkform() { 
//   if(5>4)
//	 {
//   alert("اطلاعات سالن تکمیل نشده است");
//   return false;
//   } 
//	else
//	 {
//  return true;
//   }
//   }
</script>
</head>
<body>
     <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
      <table width="99%" height="1272" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
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
            <input name="t_mar" type="text" class="t_mar input_text  required  digits" id="t_mar" style="width:50px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $dep ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div align="right">:تعداد شاغل مرد</div></td>
          <td rowspan="3">&nbsp;</td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="z_dep" type="text" class="z_dep input_text  required  digits" id="z_dep" style="width:50px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $z_dep ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:زیر دیپلم</div></td>
        </tr>
        <tr>
          <td height="43"><div align="right"><span class="style2">نفر</span>
            <input name="t_zan" type="text" class="t_zan input_text  required  digits" id="t_zan" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $t_zan ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div align="right">:تعداد شاغل زن </div></td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="dep" type="text" class="dep input_text  required  digits" id="dep" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lisan ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:دیپلم یا بالاتر</div></td>
        </tr>
        <tr>
          <td height="42"><div align="right">
            <select name="m_fani" class="input_text required " id="seeAnotherField"  style="height:40px ; width:100px ; direction:rtl" tabindex="6">
              <option value="">انتخاب کنید</option>
              <option value="1" <?php if ($m_fani=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
              <option value="2" <?php if ($m_fani=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
            </select>
          </div></td>
          <td><div align="right">:مسئول فنی </div></td>
          <td><div align="right"><span class="style2">نفر</span>
            <input name="lisan" type="text" class="lisan input_text  required  digits" id="lisan" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $t_mar ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right" >:لیسانس یا بالاتر </div></td>
        </tr>
        <tr>
          <td height="215" colspan="5">  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="29" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>وضعیت سموم و مواد ضد عفونی کننده مورد استفاده در سال </strong></div></td>
                </tr>
              <tr>
                <td width="26%" height="36" ><div style="margin-right:30px" align="right" >ارزش /<span class="style2"> ریال</span></div> </td>
                <td width="18%" ><div style="margin-right:30px" align="right" >مایع / <span class="style2">لیتر</span></div></td>
                <td width="19%"  bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" > ارزش / <span class="style2"> ریال</span>  </div></td>
                <td width="19%"  bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >جامد / <span class="style2">کیلوگرم</span></div></td>
                <td width="18%">&nbsp;</td>
                </tr>
              <tr>
                <td height="46" bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_ma" type="text" class="input_text  required  digits" id="gar_ma" style="width:100px;height:30px" tabindex="10" dir="rtl" lang="fa" value="<?php echo $gar_ma ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_m" type="text" class="input_text  required  number" id="gar_m" style="width:100px;height:30px" tabindex="9" dir="rtl" lang="fa" value="<?php echo $gar_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_ja" type="text" class="input_text  required  digits" id="gar_ja" style="width:100px;height:30px" tabindex="8" dir="rtl" lang="fa" value="<?php echo $gar_ja ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="gar_j" type="text" class="input_text  required  number" id="gar_j" style="width:100px;height:30px" tabindex="7" dir="rtl" lang="fa" value="<?php echo $gar_j ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                </div></td>
                <td width="18%" bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >قارچ کش</div></td>
                </tr>
              <tr>
                <td height="44"><div align="right">
                  <input name="hash_ma" type="text" class="input_text  required  digits" id="hash_ma" style="width:100px; height:30px" tabindex="14" dir="rtl" lang="fa" value="<?php echo $hash_ma ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div align="right">
                  <input name="hash_m" type="text" class="input_text  required  number" id="hash_m" style="width:100px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $hash_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div align="right">
                  <input name="hash_ja" type="text" class="input_text  required  digits" id="hash_ja" style="width:100px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $hash_ja ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div align="right">
                  <input name="hash_j" type="text" class="input_text  required  number" id="hash_j" style="width:100px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $hash_j ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                </div></td>
                <td ><div style="margin-right:30px" align="right" >حشره کش</div></td>
                </tr>
              <tr>
                <td height="47"><div align="right">
                  <input name="zof_ma" type="text" class="input_text  required  digits" id="zof_ma" style="width:100px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $zof_ma ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                </div></td>
                <td height="47"><div align="right">
                  <input name="zof_m" type="text" class="input_text  required  number" id="zof_m" style="width:100px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $zof_m ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                </div></td>
                <td height="47"><div align="right">
                  <input name="zof_ja" type="text" class="input_text  required  digits" id="zof_ja" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $zof_ja ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                </div></td>
                <td height="47"><div align="right">
                  <input name="zof_j" type="text" class="input_text  required  number" id="zof_j" style="width:100px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $zof_j ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                </div></td>
                <td ><div style="margin-right:30px" align="right" >ضد عفونی کننده</div></td>
                </tr>
              </table></td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="29" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>وضعیت مصرف حامل های انرژی در سال </strong></div></td>
            </tr>
            <tr>
              <td width="19%" height="35" ><?php if($gaz=='1') {?>
                <div style="margin-right:30px" align="right" >گاز</div>
                <?php }?></td>
              <td width="17%" ><?php if($barg=='1') {?>
                <div style="margin-right:30px" align="right" >برق</div>
                <?php }?></td>
              <td width="15%" ><div style="margin-right:30px" align="right" >گازوئیل</div></td>
              <td width="17%" ><div style="margin-right:30px" align="right" >بنزین</div></td>
              <td width="20%" bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >آب</div></td>
              <td width="12%">&nbsp;</td>
            </tr>
            <tr>
              <td height="47"><?php if($gaz=='1') {?>
                <div align="right"> <span class="style2">مترمکعب</span>
                  <input name="gaz_m" type="text" class="input_text  required  number" id="gaz_m" style="width:100px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $gaz_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div>
                <?php }?></td>
              <td><?php if($barg=='1') {?>
                <div align="right"> <span class="style2">کیلووات</span>
                  <input name="barg_m" type="text" class="input_text  required  number" id="barg_m" style="width:100px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $barg_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
                </div>
                <?php } ?></td>
              <td><div align="right"><span class="style2">لیتر</span>
                <input name="gazoil_m" type="text" class="input_text  required  number" id="gazoil_m" style="width:100px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $gazoil_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right"> <span class="style2">لیتر</span>
                <input name="benz_m" type="text" class="input_text  required  number" id="benz_m" style="width:100px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $benz_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right"> <span class="style2">مترمکعب</span>
                <input name="ab_m" type="text" class="input_text  required  number" id="ab_m" style="width:100px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $ab_m ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
              </div></td>
              <td ><div style="margin-right:30px" align="right" >مقدار</div></td>
            </tr>
            <tr>
              <td height="52"><?php if($gaz=='1') {?>
                <div align="right">
                  <input name="gaz_a" type="text" class="input_text  required  number" id="gaz_a" style="width:100px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $gaz_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                </div>
                <?php }?></td>
              <td><?php if($barg=='1') {?>
                <div align="right">
                  <input name="barg_a" type="text" class="input_text  required  number" id="barg_a" style="width:100px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $barg_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
                </div>
                <?php } ?></td>
              <td><div align="right">
                <input name="gazoil_a" type="text" class="input_text  required  number" id="gazoil_a" style="width:100px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $gazoil_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td><div align="right">
                <input name="benz_a" type="text" class="input_text  required  number" id="benz_a" style="width:100px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $benz_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="right">
                <input name="ab_a" type="text" class="input_text  required  number" id="ab_a" style="width:100px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $ab_a ; ?>" maxlength="12"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF" ><div style="margin-right:30px" align="right" >ارزش / <span class="style2"> ریال</span></div></td>
            </tr>
          </table></td>
        </tr>
          <tr>
            <td height="29" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>میزان کمپوست مصرفی در سال </strong></div></td>
              </tr>
              <tr>
                <td height="47" ><div align="right"><select name="nt_comp" class="input_text required " id="m_fani"  style="height:40px ; width:100px ; direction:rtl" tabindex="30">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($nt_comp=='1') { echo 'selected="selected"' ; } ?>>خود مصرفی</option>
                  <option value="2" <?php if ($nt_comp=='2') { echo 'selected="selected"' ; } ?>>خریداری شده</option>
                  <option value="3" <?php if ($nt_comp=='3') { echo 'selected="selected"' ; } ?>>ترکیبی</option>
                </select></div></td>
                <td height="47" ><div align="right">:نحوه تامین کمپوست</div></td>
                <td height="47" >&nbsp;</td>
                <td bgcolor="#FFFFFF" ><div align="right"><span class="style2">تن /سال</span>
                  <input name="comp" type="text" class="input_text  required  digits" id="comp" style="width:100px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $comp ; ?>"  maxlength="5"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div style="margin-right:30px" align="right" >:کمپوست مصرفی</div></td>
              </tr>
              <tr>
                <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>اطلاعات تولید  </strong></div></td>
                </tr>
              <tr>
                <td width="33%" height="47" ><div align="right"><span class="style2">تن</span>
                    <input name="mah_tol" type="text" class="input_text  required  number" id="mah_tol" style="width:100px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $mah_tol ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
                </div></td>
                <td width="17%" ><div align="right">:میزان کل تولید </div></td>
                <td width="7%" >&nbsp;</td>
                <td width="22%" bgcolor="#FFFFFF" ><div align="right"><span class="style2">دوره / سال</span>
                    <input name="t_dpar" type="text" class="input_text  required  number" id="t_dpar" style="width:100px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $t_dpar ; ?>" min="1" max="8" maxlength="1"  align="baseline" xml:lang="fa" />
                </div></td>
                <td width="21%"><div style="margin-right:30px" align="right" >:تعداد دوره های پرورش  </div></td>
                </tr>
              </table></td>
          </tr>
          <tr>
          <td height="29" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:20px" align="right"><strong>مشخصات سالن/ سالن ها  </strong></div></td>
          </tr>
        <tr>
          <td height="197" colspan="5"><br /><?php include('Mushroom_prod_data98.php')?></td>
        </tr>
        <tr>
          <td height="96" colspan="5">
            <p class="style8">جهت محاسبه سطح زیر کشت و عملکرد تولید سالانه  کلید زیر را کلیک کنید          <img src="../../files/con_info.png" width="16" height="16"  alt=""/></p>
            <p>
              <input type="button" class="spwan"  style="width:250px ; height:45px ; font-family:'B Titr'" name="spwan" id="spwan" value="محاسبه سطح زیر کشت و عملکرد سالانه"/>
            </p> 
          </td>
          </tr>
        <tr>
          <td height="54" bgcolor="#33CCCC"><div align="right"><span class="style2">کیلوگرم / مترمربع</span>
              <input name="tol_avg" type="text" class="input_text  required  number" id="tol_avg" style="width:100px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $tol_avg ; ?>" maxlength="9" readonly  align="baseline" xml:lang="fa" />
          </div></td>
          <td height="54" bgcolor="#33CCCC"><div align="right">:عملکرد تولید  </div></td>
          <td height="54" bgcolor="#33CCCC">&nbsp;</td>
          <td height="54" bgcolor="#33CCCC"><div align="right"><span class="style2">مترمربع</span>
              <input name="zer_kesh" type="text" class="input_text  required  number" id="zer_kesh9" style="width:100px; height:30px ; " min="1"  tabindex="33" dir="rtl" lang="fa" value="<?php echo $zer_kesh ; ?>" maxlength="10" readonly  align="baseline" xml:lang="fa" />
          </div></td>
          <td height="54" bgcolor="#33CCCC"><div style="margin-right:30px" align="right" >:سطح زیر کشت سالانه</div></td>
        </tr>
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="p_number" value=<?php echo $number; ?> />
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
     <input type="hidden" name="no_mush" value=<?php echo $no_mush; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="hidden" name="y_prod" value=<?php echo $y_prod; ?> />
     <input type="hidden" name="unit_id" value=<?php echo $unit_id; ?> />
    <input type="submit" name="action" value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="35" id="submit" />
</form> 
         <a href="#" onClick="document.form_name.submit(); return false;">
         <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="36" />
         </a>
           <form  name="form_name" class="form_name" method="post" action="liste_Mush_prod.php">
            <input type="hidden" name="id"  value="<?php echo $unit_id ;?>" />
            <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m  ;?>" />
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

<script>
$( ".spwan" ).click(function() {
                $.ajax({
                url: "test.php",
                type: "POST",
				data: {unit_id:<?php echo $unit_id ?>,y_prod:<?php echo $y_prod ?>},
                success: function(data,status){
                    if(data =='error')
                    {
                        //  alert( ' خطا  \n \n  میزان تولید وارد شده از حداکثر ممکن یعنی ' + data +' تن بیشتر هست \n \n  برای ادامه باید نسبت به تصحیح آن اقدام فرمایید ' );
                        alert( ' خطا  \n \n  اطلاعات مربوط به سالن / سالن ها را بررسی کنید ' );
                        // پاک کردن مقدار تولید
                    }
                else
                var t_dpar = document.getElementById("t_dpar").value;
                var mah_tol = 1000 * document.getElementById("mah_tol").value;
                var zer_kesh_salon = data ;
                var zer_kesh_sal = zer_kesh_salon * t_dpar ;
				 $('#zer_kesh9').val(parseFloat(Math.round((zer_kesh_sal * 100)) / 100));
				 $('#tol_avg').val(parseFloat(Math.round((mah_tol / zer_kesh_sal * 100)) / 100));
				 
                },
                error: function(){$("#result").html("مشکلی در اتصال به سرور به وجود آمد!")}
            });
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
<script>
$('.z_dep').change(function () {
			$('#t_mar').val('');
			$('#t_zan').val('');
   });
$('.dep').change(function () {
			$('#t_mar').val('');
			$('#t_zan').val('');
   });
$('.lisan').change(function () {
			$('#t_mar').val('');
			$('#t_zan').val('');
   });
</script>
<script>
$('.t_mar').change(function () {
  var t_z_dep = document.getElementById("z_dep").value;
  var t_dep   = document.getElementById("dep").value;
  var t_lisan = document.getElementById("lisan").value;
  var mard    = document.getElementById("t_mar").value;
 if (t_z_dep == '') t_z_dep = 0 ; 
 if (t_dep == '')   t_dep = 0 ; 
 if (t_lisan == '') t_lisan = 0 ; 
  var jam     = (parseFloat(t_z_dep) +  parseFloat(t_dep) + parseFloat(t_lisan)) 
 if (parseFloat(mard) > jam) {
   alert("تعداد شاغلین مرد از مجموع شاغلین بر حسب مدرک تحصیلی بزرگتر است ");
			$('#t_mar').val('');
  			// فوکوس روی تولید محصول 
			document.getElementById("t_mar").focus();
}
else 
{
  var zan     = parseFloat(jam) - parseFloat(mard)
			$('#t_zan').val(zan);
}
   });
</script>
<script>
$('.t_zan').change(function () {
  var t_z_dep = document.getElementById("z_dep").value;
  var t_dep   = document.getElementById("dep").value;
  var t_lisan = document.getElementById("lisan").value;
  var zan    = document.getElementById("t_zan").value;
 if (t_z_dep == '') t_z_dep = 0 ; 
 if (t_dep == '')   t_dep = 0 ; 
 if (t_lisan == '') t_lisan = 0 ; 
  var jam     = (parseFloat(t_z_dep) +  parseFloat(t_dep) + parseFloat(t_lisan)) 
 if (parseFloat(zan) > jam) {
   alert("تعداد شاغلین زن از مجموع شاغلین بر حسب مدرک تحصیلی بزرگتر است ");
			$('#t_zan').val('');
  			// فوکوس روی تولید محصول 
			document.getElementById("t_zan").focus();
}
else 
{
  var mard     = parseFloat(jam) - parseFloat(zan)
			$('#t_mar').val(mard);
}
   });
</script>
