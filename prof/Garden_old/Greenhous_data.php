<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include_once('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
////
if(isset($_POST['bah_cod_m'])) 
    {
	$bah_cod_m = $_POST['bah_cod_m'];
    $query = "SELECT ok from bah where  bah_cod_m = :bah_cod_m ";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
    $found = $stmt -> rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ok = $row['ok'] ;
   if($ok=='2')
   {
      alert ('بهره بردار در قید حیات نمیباشد !! امکان ثبت اطلاعات مقدور نیست  ') ;
    ?>
    <form  name="myform" class="myform" method="post" action="index.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
	
	}
   if($ok=='4')
   {
      alert ('اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ثبت اطلاعات مقدور نمیباشد  ') ;
    ?>
    <form  name="myform" class="myform" method="post" action="index.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
    <?php
	}
	}
/////////////////////////////////////////////////// 
 if (isset($_POST['action']) && $_POST['no_kesht'] > 0 ) 
 {  
$date_s = $date_edit ;
$mor_cod_m = $login_session ;
$bah_cod_m = $_POST['bah_cod_m']; 
$add_city = $_POST['add_city'] ;
$add_abadi = $_POST['add_abadi'] ;
$id_ostan = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ;
$no_kesht = $_POST['no_kesht'] ;
$no_moj = $_POST['no_moj'] ;
$m_zamin = $_POST['m_zamin'] ;
$m_zamin_gol = $_POST['m_zamin_gol'] ;
$no_mal = $_POST['no_mal'] ;
$lng_d = $_POST['lng_d'] ;
$lng_m = $_POST['lng_m'] ;
$lng_s = $_POST['lng_s'] ;
$lng_ds = $_POST['lng_ds'] ;
$lat_d = $_POST['lat_d'] ;
$lat_m = $_POST['lat_m'] ;
$lat_s = $_POST['lat_s'] ;
$lat_ds = $_POST['lat_ds'] ;
$m_cod_m = $_POST['m_cod_m'] ;
$num_bah = $_POST['num_bah']; 
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
$m_vaz_sok = $_POST['m_vaz_sok'] ;
$address = $_POST['m_addres'] ;
$unit_name = $_POST['unit_name'] ;
$pt_no = $_POST['pt_no'] ;
$pt_date = $_POST['pt_date'] ;
$pb_no = $_POST['pb_no'] ;
$pb_date = $_POST['pb_date'] ;
if ($no_moj =='1' or $no_moj !='5')
{
	 $pt_no    = '' ; 
     $pt_date  = '' ; 
}
if ($no_moj =='4')
{
	 $pt_no    = '' ; 
     $pt_date  = '' ; 
	 $pb_no    = '' ; 
     $pb_date  = '' ; 
}
$sal_tas = $_POST['sal_tas'] ;
$sar_kol = $_POST['sar_kol'] ;
$no_saz = $_POST['no_saz'] ;
$no_gol = $_POST['no_gol'] ;
$sys_kesh = $_POST['sys_kesh'] ;
$no_sokh = $_POST['no_sokh'] ;
$sys_hot = $_POST['sys_hot'] ;
$sys_cool = $_POST['sys_cool'] ;
if ($no_kesht =='2')
{
$m_zamin_gol = '' ;  $no_saz = ''   ; $no_gol = '' ; $sys_kesh = '' ; $no_sokh= '';$sys_hot = '' ; $sys_cool = '' ;
}
$gaz = $_POST['gaz'] ; 
$z_gaz = $_POST['z_gaz'] ; 
if ($gaz =='2') $z_gaz = 0 ; 
$barg = $_POST['barg'] ; 
$f_barg = $_POST['f_barg'] ; 
$a_barg = $_POST['a_barg'] ; 
if ($barg =='2')
{
	 $f_barg = 0 ; 
     $a_barg  = 0 ; 
}
$m_ab = $_POST['m_ab'] ; 
$num_ab = $_POST['num_ab'] ; 
$sard = $_POST['sard'] ; 
$z_sard = $_POST['z_sard'] ; 
if ($sard =='2')
{
	 $z_sard = 0 ; 
}
$m_sard = $_POST['m_sard'] ; 
$sort = $_POST['sort'] ; 
$z_sort = $_POST['z_sort'] ; 
if ($sort =='2')
{
	 $z_sort = 0 ; 
}
$baz_chr = $_POST['baz_chr'] ; 
$nft = $_POST['nft'] ; 
$ab_sh = $_POST['ab_sh'] ; 
//بانک مالک
$m_addres = $_POST['m_addres'] ;
$m_jens = $_POST['m_jens'] ;
$m_name = $_POST['m_name'] ;
$m_last_name = $_POST['m_last_name'] ;
$m_fname = $_POST['m_fname'] ;
$m_tel_m = $_POST['m_tel_m'] ;

// بانک اطلاعات کشت 

$query = "INSERT INTO Greenhous (date_s,mor_cod_m,bah_cod_m,num_bah,id_ostan,id_city,id_mar,add_abadi,add_city
,m_zamin,m_zamin_gol,no_mal,lng_d,lng_m,lng_s,lng_ds,lat_d,lat_m,lat_s,lat_ds
,m_cod_m,m_vaz_sok
,address,no_kesht,unit_name,no_moj,pt_no,pt_date,pb_no,pb_date,sal_tas,sar_kol,no_saz,no_gol,sys_kesh
,no_sokh,sys_hot,sys_cool,gaz,z_gaz,barg,f_barg,a_barg,m_ab,num_ab,sard,z_sard,m_sard,sort,z_sort,baz_chr,nft,ab_sh
)
VALUES(:date_s,:mor_cod_m,:bah_cod_m,:num_bah,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city
,:m_zamin,:m_zamin_gol,:no_mal,:lng_d,:lng_m,:lng_s,:lng_ds,:lat_d,:lat_m,:lat_s,:lat_ds
,:m_cod_m,:m_vaz_sok
,:address,:no_kesht,:unit_name,:no_moj,:pt_no,:pt_date,:pb_no,:pb_date,:sal_tas,:sar_kol,:no_saz,:no_gol,:sys_kesh
,:no_sokh,:sys_hot,:sys_cool,:gaz,:z_gaz,:barg,:f_barg,:a_barg,:m_ab,:num_ab,:sard,:z_sard,:m_sard,:sort,:z_sort,:baz_chr,:nft,:ab_sh
)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah,
':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city,
':m_zamin'=>$m_zamin,':m_zamin_gol'=>$m_zamin_gol,':no_mal'=>$no_mal,':lng_d'=>$lng_d,
':lng_m'=>$lng_m,':lng_s'=>$lng_s,':lng_ds'=>$lng_ds,':lat_d'=>$lat_d,':lat_m'=>$lat_m,':lat_s'=>$lat_s,
':lat_ds'=>$lat_ds,':m_cod_m'=>$m_cod_m,':m_vaz_sok'=>$m_vaz_sok
,':address'=>$address,
':no_kesht'=>$no_kesht,':unit_name'=>$unit_name,':no_moj'=>$no_moj,
':pt_no'=>$pt_no,':pt_date'=>$pt_date,':pb_no'=>$pb_no,':pb_date'=>$pb_date,':sal_tas'=>$sal_tas,
':sar_kol'=>$sar_kol,':no_saz'=>$no_saz,':no_gol'=>$no_gol,
':sys_kesh'=>$sys_kesh,':no_sokh'=>$no_sokh,':sys_hot'=>$sys_hot,':sys_cool'=>$sys_cool,
':gaz'=>$gaz,':z_gaz'=>$z_gaz,':barg'=>$barg,':f_barg'=>$f_barg
,':a_barg'=>$a_barg,':m_ab'=>$m_ab,':num_ab'=>$num_ab,':sard'=>$sard,':z_sard'=>$z_sard,':m_sard'=>$m_sard
,':sort'=>$sort,':z_sort'=>$z_sort,':baz_chr'=>$baz_chr,':nft'=>$nft,':ab_sh'=>$ab_sh

));

$query = "SELECT id FROM `malek` WHERE  `m_cod_m` = '$m_cod_m'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
if ($stmt -> rowCount() == 0)
{
$query = "INSERT INTO malek (date_s,mor_cod_m,m_cod_m,m_jens,m_name,m_last_name,m_fname,m_tel_m)
                   VALUES(:date_s,:mor_cod_m,:m_cod_m,:m_jens,:m_name,:m_last_name,:m_fname,:m_tel_m)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':m_cod_m'=>$m_cod_m,':m_jens'=>$m_jens,':m_name'=>$m_name,':m_last_name'=>$m_last_name,':m_fname'=>$m_fname,':m_tel_m'=>$m_tel_m));
}
 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ثبت اطلاعات گلخانه - '.$bah_cod_m,$id_ostan) ; 

unset($date_s,$mor_cod_m,$bah_cod_m,$add_city,$add_abadi,$id_ostan,$id_city,$id_mar,$no_kesht,$no_moj,$m_zamin,$m_zamin_gol,
$no_mal,$lng_d,$lng_m,$lng_s,$lng_ds,$lat_d,$lat_m,$lat_s,$lat_ds,$m_cod_m,$num_bah,$m_vaz_sok,$address
,$unit_name,$pt_no,$pt_date,$pb_no,$pb_date,$sal_tas,$sar_kol,$no_saz,$no_gol,$sys_kesh,$no_sokh,$sys_hot,
$sys_cool,$gaz,$z_gaz,$barg,$f_barg,$a_barg,$m_ab,$num_ab,$sard,$m_sard,$sort,$baz_chr,$nft,$ab_sh);
alert ('اطلاعات گلخانه با موفقیت ثبت شد ') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
<?php
/////////////////////////////////////////////// 

if  (isset($_POST['bah_cod_m']))
{
$add_abadi = $_POST["add_abadi"]; 
$add_city = $_POST["add_city"]; 
$bah_cod_m = $_POST['bah_cod_m'];
$m_poul = $_POST['m_poul'];
$no_mal = $_POST['no_mal'];
echo $no_moj   = $_POST['no_moj'];
$no_kesht = $_POST['no_kesht'];
if ($no_mal <> 7)
{
$query = "SELECT bah_cod_m,no_bah,co_name,name,jens,last_name,fname,tel_m from bah where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_bah = $row['no_bah'] ;
$co_name = $row['co_name'] ;
$m_name = $row['name'] ;
$m_jens = $row['jens'] ;
$m_last_name = $row['last_name'] ;
$m_fname = $row['fname'] ;
if(isset($_POST['num_bah'])) $num_bah = $_POST['num_bah']; else  $num_bah = '1' ;
$m_tel_m = $row['tel_m'] ;
}
if ($no_kesht=='1')  $v_no_kesht='گلخانه';
if ($no_kesht=='2')  $v_no_kesht='فضای باز';
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
if ($no_mal=='1')  $v_no_mal='سند ششدانگ';
if ($no_mal=='2')  $v_no_mal='سند مشاعی';
if ($no_mal=='3')  $v_no_mal='اصلاحات اراضی';
if ($no_mal=='4')  $v_no_mal='موقوفه';
if ($no_mal=='5')  $v_no_mal='واگذاری';
if ($no_mal=='6')  $v_no_mal='قولنامه';
if ($no_mal=='7')  $v_no_mal='اجاره' ;
if ($no_mal=='8')  $v_no_mal='سایر' ;

if ($m_poul=='abadi') {
$query = "SELECT add_abadi,id_ostan,id_city,id_mar from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$add_abadi = $row["add_abadi"]; 
$add_city = '-'; 
$id_ostan = $row["id_ostan"]; 
$id_city = $row["id_city"]; 
$id_mar = $row["id_mar"]; 
}

if  ($m_poul=='shahr') {
$query = "SELECT add_city,id_ostan,id_city,id_mar from list_city where add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$add_city = $row["add_city"]; 
$add_abadi = '-'; 
$id_ostan = $row["id_ostan"]; 
$id_city = $row["id_city"]; 
$id_mar = $row["id_mar"]; 
}
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
	<link rel="stylesheet" href="../jspc-gray.css">
	<script type="text/javascript" src="../js-persian-cal.min.js"></script>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>
<!--دریافت اطلاعات مالک -->
<script type="text/javascript">
$(document).ready(function()
{
$(".Mcod_m").change(function()
{
var id=$(this).val();
var dataString = 'cod_m='+ id;
$.ajax
({
type: "POST",
url: "select_mar.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar").html(html);
} 
});

});
});
</script>
<!-- پایان دریافت اطلاعات مالک -->
</head>
<body>
<div id="rasul" style="width: 100%; height: 100%; background: #726d6d; display: none;  opacity: 0.6; position: fixed; z-index: 4;">
    <img src="img/loading2.gif" style="margin: auto;float: right;z-index: 93;width: 90px;min-height: 50px;position: fixed;left: 0;right: 0;margin: 200px auto;">
</div>

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
           <p class="style8">ثبت اطلاعات گلخانه جدید</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1">
      <table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="36%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan)  ?></div></td>
          <td width="15%"><div align="right">:شهرستان</div></td>
          <td width="10%">&nbsp;</td>
          <td width="21%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"><?php echo $v_no_mal; ?></div></td>
          <td height="38"><div align="right"> : نوع مالکیت</div></td>
          <td height="38">&nbsp;</td>
          <td height="38"><div align="right"> <?php echo $v_no_kesht; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نوع کشت</div></td>
        </tr>
  <?php if($nah_kesh<>'3'){?> 
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
        </tr>
        <tr>
          <td height="63" colspan="5"><table width="85%" border="1" bordercolor="#00CCFF" align="center" cellpadding="1" cellspacing="0">
            <tr>
              <td width="19%" height="31" bgcolor="#FFFFCC">دهم ثانیه</td>
              <td width="21%" bgcolor="#FFFFCC">ثانیه</td>
              <td width="17%" bgcolor="#FFFFCC">دقیقه</td>
              <td width="17%" bgcolor="#FFFFCC">درجه</td>
              <td width="26%" bgcolor="#FFFFCC">مختصات جغرافیایی</td>
            </tr>
            <tr>
              <td height="42"><input name="lng_ds" type="text" class="input_text required digits" id="lng_ds" style="width:50px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $lng_ds ; ?>" maxlength="1" align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_s" type="text" class="input_text required digits" id="lng_s" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lng_s ; ?>" maxlength="2" max="60" min="0"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_m" type="text" class="input_text required digits" id="lng_m" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lng_m ; ?>" maxlength="2" max="60" min="0"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_d" type="text" class="input_text required digits" id="lng_d" style="width:50px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $lng_d ; ?>" maxlength="2"  max="63" min="44" align="baseline" xml:lang="fa" /></td>
              <td>طول </td>
            </tr>
            <tr>
              <td height="50"><input name="lat_ds" type="text" class="input_text required digits" id="lat_ds" style="width:50px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $lat_ds ; ?>" maxlength="1"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lat_s" type="text" class="input_text required digits" id="lat_s" style="width:50px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $lat_s ; ?>" maxlength="2" max="60" min="0"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lat_m" type="text" class="input_text required digits"  id="lat_m" style="width:50px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $lat_m ; ?>" maxlength="2" max="60" min="0"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lat_d" type="text" class="input_text required digits" id="lat_d" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $lat_d ; ?>" maxlength="2" max="39" min="25"  align="baseline" xml:lang="fa" /></td>
              <td>عرض </td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="49">
          <?php if($no_kesht == '1') { ?>
          <div align="right"  >
              <span class="style2">مترمربع</span>
              <input name="m_zamin_gol" type="text"  class="input_text required" id="m_zamin_gol" style="width:100px; height:30px;  " tabindex="10" dir="rtl" lang="fa" value="<?php echo $m_zamin_gol ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
          </div>
          <?php } ?>
          </td>
          <td colspan="2">
<?php if($no_kesht == '1') { ?>
          <div style="margin-right:30px" align="right">:مساحت مفید گلخانه<span class="style2"></span></div></td>
<?php } ?>
          <td>
            <div align="right"><span class="style2">مترمربع</span>
            <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />          
          </td>
          <td>
          <div style="margin-right:30px" align="right">:مساحت زمین<span class="style2"></span></div>
          </td>
        </tr>
        <tr>
          <td height="5" colspan="5">   
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="42" colspan="5" bgcolor="#CCCCCC"><?php if($no_mal<>7) echo '<p align="center" style="color:#0066CC" > اطلاعات بهره بردار بعنوان مالک ثبت خواهد شد </p>' ;  else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>' ?></td>
                </tr>
              <tr>
                <td width="31%" height="58"><div align="right">
                  <select name="m_jens"  class="input_text mar required" id="m_jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="12">
                    <option value="1" <?php if ($row['jens']=='1') echo 'selected=selected'?>>مرد</option>
                    <option value="2" <?php if ($row['jens']=='2') echo 'selected=selected'?>>زن</option>
                    </select>
                  </div></td>
                <td width="20%"><div align="right">جنسیت</div></td>
                <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
                <td width="30%"  bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="11"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="12" xml:lang="fa"/>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد ملی مالک </div></td>
                </tr>
              <tr>
                <td height="46" bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_last_name" type="text"  class="input_text required" id="m_last_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="14" dir="rtl" lang="fa" value="<?php echo $m_last_name ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی<br />
                  </div></td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="13" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="70" xml:lang="fa"/>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
                </tr>
              <tr>
                <td height="51"><div align="right">
                  <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="16" dir="rtl" lang="fa" value="<?php echo $m_tel_m ; ?>"  maxlength="11"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div align="right">:تلفن همراه</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="15" dir="rtl" lang="fa" value="<?php if ($no_bah==2) echo $co_name; else echo $m_fname ; ?>" maxlength="75" xml:lang="fa"/>
                </div></td>
                <td><div style="margin-right:30px" align="right">
                  <?php if ($no_bah==2) echo ':نام شرکت'; else echo ':نام پدر' ; ?>
                </div></td>
                </tr>
              <tr>
                <td height="50" colspan="4"><div align="right"><span style="text-align: right">
                  <textarea name="m_addres" cols="80" rows="4" class="required input_text" id="m_addres" tabindex="17"><?php echo $m_addres ;?></textarea>
                  </span></div></td>
                <td><div style="margin-right:30px" align="right">:آدرس محل سکونت</div></td>
                </tr>
              <tr>
                <td height="60">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="m_vaz_sok" class="required input_text  " id="m_vaz_sok"  style="height:40px ; width:120px ; direction:rtl" tabindex="18">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($m_vaz_sok=='1') { echo 'selected="selected"' ; } ?>>ساکن</option>
                    <option value="2" <?php if ($m_vaz_sok=='2') { echo 'selected="selected"' ; } ?> >غیرساکن</option>
                    </select>
                  </div></td>
                <td><div style="margin-right:30px" align="right">
                  <p>:وضعیت سکونت </p>
                  </div></td>
                </tr>
              </table>
              <?php }?>
            </td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="53" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
                    </tr>
                  <tr>
                    <td width="31%" height="57" ><div align="right">
                      <select name="no_moj" disabled="disabled" class="input_text required " id="no_moj"  style="height:40px ; width:230px ; direction:rtl" tabindex="20">
                        <option value="">انتخاب کنید</option>
                        <option value="1" <?php if ($no_moj=='1') { echo 'selected="selected"' ; } ?> >پروانه بهره برداری/نظام مهندسی</option>
                        <option value="5" <?php if ($no_moj=='5') { echo 'selected="selected"' ; } ?> >پروانه بهره برداری/سازمان جهاد کشاورزی</option>
                        <option value="2" <?php if ($no_moj=='2') { echo 'selected="selected"' ; } ?>>مشاغل خانگی/وزارت جهاد</option>
                        <option value="3" <?php if ($no_moj=='3') { echo 'selected="selected"' ; } ?>>تسهیلات/بسیج سازندگی</option>
                        <option value="4" <?php if ($no_moj=='4') { echo 'selected="selected"' ; } ?>>فاقد مجوز</option>
                        </select>
                      </div></td>
                    <td width="20%"><div align="right">:نوع مجوز</div></td>
                    <td width="1%">&nbsp;</td>
                    <td width="28%" bgcolor="#FFFFFF"><div align="right">
                      <input name="unit_name" type="text" class="required input_text" id="unit_name" style="width:150px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $unit_name ; ?>" maxlength="35" xml:lang="fa"/>
                      <br />
                      </div></td>
                    <td width="20%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:نام واحد گلخانه ای</div></td>
                    </tr>
                  <tr>
                    <?php
 if($no_moj !='4' and $no_moj !='1' and $no_moj !='5') {?>
                    <td ><div align="right">
                      <input name="pt_date" type="text"  class="pdate required input_text" id="pcal2"  style="width:100px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $pt_date ; ?>" maxlength="10" xml:lang="fa"/>
                      <br />
                      </div></td>
                    <td><div id="otherFieldDiv11" align="right">:تاریخ پروانه تاسیس</div></td>
                    <td>&nbsp;</td>
                    <td bgcolor="#FFFFFF"><div  align="right">
                      <input name="pt_no" type="text" class="required  input_text" id="pt_no" style="width:75px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $pt_no ; ?>" maxlength="20" xml:lang="fa"/>
                      <br />
                      </div></td>
                    <td bgcolor="#FFFFFF"><div  style="margin-right:30px" align="right">:شماره پروانه تاسیس</div></td>
                    </tr>
                  <?php } if($no_moj !='4' ) {?>
                  <tr>
                    <td height="34"><div  align="right">
                      <input name="pb_date" type="text"  class="pdate required input_text" id="pcal1"  style="width:100px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $pb_date ; ?>" maxlength="10" xml:lang="fa"/>
                      <br />
                      </div></td>
                    <td><div id="otherFieldDiv12" align="right">:تاریخ پروانه بهره برداری</div></td>
                    <td>&nbsp;</td>
                    <td bgcolor="#FFFFFF"><div  align="right">
                      <input name="pb_no" type="text" class="required  input_text" id="pb_no" style="width:75px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $pb_no ; ?>" maxlength="20" xml:lang="fa"/>
                      <br />
                      </div></td>
                    <td bgcolor="#FFFFFF"><div  style="margin-right:30px" align="right">:شماره پروانه بهره برداری</div></td>
                    </tr>
                  <?php  }?>
                  <tr>
                    <td height="53"><div align="right"> <span class="style8">میلیارد ریال </span>
                      <input name="sar_kol" type="text" class="required number input_text" id="sar_kol" style="width:75px; height:30px ; " tabindex="30" dir="rtl" lang="fa" value="<?php echo $sar_kol ; ?>" maxlength="35" xml:lang="fa"/>
                      <br />
                      </div></td>
                    <td><div align="right">:سرمایه گذاری کل</div></td>
                    <td>&nbsp;</td>
                    <td bgcolor="#FFFFFF"><div align="right">
                      <input name="sal_tas" type="text" class="required number input_text" id="sal_tas" style="width:75px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $sal_tas ; ?>"min='1200' max='1404' minlength="4" maxlength="4" xml:lang="fa"/>
                      <br />
                      </div></td>
                    <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:سال تاسیس</div></td>
                    </tr>
                  </table></td>
              </tr>
<?php if($no_kesht=='1') {?>
              <tr>
                <td width="31%" height="53"><div align="right">
                  <select name="no_gol" class="input_text required " id="no_gol"  style="height:40px ; width:150px ; direction:rtl" tabindex="32">
                    <option value="">انتخاب کنید</option>
                    <option value="1">تونلی تک قلو</option>
                    <option value="2">تونلی بهم پیوسته</option>
                    <option value="3">یک طرفه</option>
                    <option value="4">شیشه ای سقف شیروانی</option>
                  </select>
                </div></td>
                <td width="20%"><div align="right">:نوع گلخانه</div></td>
                <td width="1%">&nbsp;</td>
                <td width="28%" bgcolor="#FFFFFF"><div align="right">
                  <select name="no_saz" class="input_text required " id="no_saz"  style="height:40px ; width:150px ; direction:rtl" tabindex="31">
                    <option value="">انتخاب کنید</option>
                    <option value="1">فلزی با پوشش پلاستیکی</option>
                    <option value="2">فلزی با پوشش پلی کربنات</option>
                    <option value="3">فلزی با پوشش شیشه ای</option>
                    <option value="4">چوبی پلاستیکی</option>
                  </select>
                </div></td>
                <td width="20%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:نوع سازه</div></td>
              </tr>
              <tr>
                <td height="47"><div align="right">
                  <select name="no_sokh" class="input_text required " id="no_sokh"  style="height:40px ; width:120px ; direction:rtl" tabindex="35">
                    <option value="">انتخاب کنید</option>
                    <option value="1">نفت سفید</option>
                    <option value="2">گازوئیل</option>
                    <option value="3">گاز </option>
                    </select>
                  </div></td>
                <td><div align="right">:نوع سوخت </div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="sys_kesh" class="input_text  required" id="sys_kesh"  style="height:40px ; width:120px ; direction:rtl" tabindex="34">
                    <option value="">انتخاب کنید</option>
                    <option value="1">خاکی</option>
                    <option value="2">هیدروپونیک</option>
                    <option value="3">اکوآپونیک</option>
                    </select>
                  </div></td>
                <td><div style="margin-right:30px" align="right">:سیستم کشت</div></td>
              </tr>
              <tr>
                <td height="47"><div align="right">
                  <select name="sys_cool" class="input_text  required" id="sys_kol"  style="height:40px ; width:120px ; direction:rtl" tabindex="37">
                    <option value="">انتخاب کنید</option>
                    <option value="1">پدوفن</option>
                    <option value="2">مه پاش</option>
                    <option value="3">دریچه های تهویه</option>
                    <option value="4">سایر</option>
                    </select>
                  </div></td>
                <td><div align="right">:نوع سیستم خنک کننده</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="sys_hot" class="input_text  required" id="sys_hot"  style="height:40px ; width:120px ; direction:rtl" tabindex="36">
                    <option value="">انتخاب کنید</option>
                    <option value="1">حرارت مرکزی</option>
                    <option value="2">هیتر یا بخاری</option>
                    <option value="3">تشعشعی</option>
                    <option value="4">سایر</option>
                    </select>
                  </div></td>
                <td><div style="margin-right:30px" align="right">: نوع سیستم گرمایشی</div></td>
              </tr>
<?php }?>
              <tr>
                <td height="47" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                    <td height="40" colspan="3" class="style2"><div align="right" id="otherFieldDiv2"> مترمکعب / ساعت
                      <select name="z_gaz" class="input_text " id="gaz4"  style="height:40px ; width:75px ; direction:rtl" tabindex="39">
                        <option value="4">4</option>
                        <option value="6">6</option>
                        <option value="10">10</option>
                        <option value="16">16</option>
                        <option value="25">25</option>
                        <option value="40">40</option>
                        <option value="65">65</option>
                        <option value="100">100</option>
                        <option value="160">160</option>
                      </select>
                      <br />
                    </div></td>

                    <td width="13%" height="40" ><div style="margin-right:15px" align="right" id="otherFieldDiv1"> :ظرفیت کنتور</div></td>
                    <td width="16%" height="40" class="style2"><div align="right">
                      <select name="gaz" class="input_text required " id="seeAnotherField"  style="height:40px ; width:100px ; direction:rtl" tabindex="38">
                        <option value="">انتخاب کنید</option>
                        <option value="2">ندارد</option>
                        <option value="1">دارد</option>
                      </select>
                    </div></td>

                    <td width="20%" height="40" ><div style="margin-right:30px" align="right"> :گاز طبیعی </div></td>
                  </tr>
                  <tr>
<td width="19%" height="46" class="style2"><div align="right" id="otherFieldDiv6" > آمپر
                      <select name="a_barg" class="input_text" id="a_barg"  style="height:40px ; width:72px ; direction:rtl" tabindex="42">
                        <option value="25">25</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        </select>
                      <br />
                      </div></td>
                    <td width="12%" ><div style="margin-right:15px" align="right" id="otherFieldDiv5"> :مقدار آمپر</div></td>
                    <td width="20%" height="46" class="style2"><div align="right" id="otherFieldDiv4">
                      <select name="f_barg" class="input_text required " id="f_barg"  style="height:40px ; width:75px ; direction:rtl" tabindex="41">
                        <option value="1">تک فاز</option>
                        <option value="3">سه فاز</option>
                        </select>
                      <br />
                      </div></td>
                    <td height="46" ><div style="margin-right:15px" align="right" id="otherFieldDiv3"> :تعداد فاز</div></td>
                    <td height="46" class="style2"><div align="right">
                      <select name="barg" class="input_text required " id="seeAnotherField2"  style="height:40px ; width:100px ; direction:rtl" tabindex="40">
                        <option value="">انتخاب کنید</option>
                        <option value="2">ندارد</option>
                        <option value="1">دارد</option>
                        </select>
                      </div></td>
                    <td height="46" ><div style="margin-right:30px" align="right"> :برق شهری </div></td>
                  </tr>
                  <tr>
                    <td height="48" colspan="2">&nbsp;</td>
                    <td><div align="right"> <span class="style2">لیتر / ثانیه</span>
                      <input name="num_ab" type="text" class="required number input_text" id="num_ab" style="width:75px; height:30px ; " tabindex="44" dir="rtl" lang="fa" value="<?php echo $num_ab ; ?>" maxlength="6" xml:lang="fa"/>
                      <br />
                    </div></td>
                    <td><div style="margin-right:15px" align="right"> :دبی آب</div></td>
                    <td><div align="right">
                      <select name="m_ab" class="input_text required " id="m_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="43">
                        <option value="">انتخاب کنید</option>
                        <option value="1" <?php if ($m_ab=='1') { echo 'selected="selected"' ; } ?> >چشمه</option>
                        <option value="2" <?php if ($m_ab=='2') { echo 'selected="selected"' ; } ?>>قنات</option>
                        <option value="3" <?php if ($m_ab=='3') { echo 'selected="selected"' ; } ?>>رودخانه</option>
                        <option value="4" <?php if ($m_ab=='4') { echo 'selected="selected"' ; } ?>>سد</option>
                        <option value="5" <?php if ($m_ab=='5') { echo 'selected="selected"' ; } ?>>چاه سطحی</option>
                        <option value="6"  <?php if ($m_ab=='6') { echo 'selected="selected"' ; } ?>>چاه عمیق</option>
                        <option value="7"  <?php if ($m_ab=='7') { echo 'selected="selected"' ; } ?>>چاه نیمه عمیق</option>
                        <option value="8"  <?php if ($m_ab=='8') { echo 'selected="selected"' ; } ?>>زهکش</option>
                        <option value="9"  <?php if ($m_ab=='9') { echo 'selected="selected"' ; } ?>>پساب</option>
                        <option value="10" <?php if ($m_ab=='10') { echo 'selected="selected"' ; } ?>>آب بندان</option>
                        <option value="11" <?php if ($m_ab=='11') { echo 'selected="selected"' ; } ?>>سایر</option>
                      </select>
                    </div></td>
                    <td><div style="margin-right:30px" align="right"> :منبع تامین آب </div></td>                  </tr>
                  <tr>
<td height="46" colspan="3" class="style2"><div align="right" id="otherFieldDiv8"> تن
    <input name="z_sard" type="text" class="required number input_text" id="z_sard" style="width:75px; height:30px ; " tabindex="47" dir="rtl" lang="fa"  value="0" maxlength="35" xml:lang="fa"/>
                      <br />
                    </div></td>
                    <td width="13%" height="46" ><div style="margin-right:15px" align="right" id="otherFieldDiv7"> :حجم</div></td>
                    <td width="16%" height="46" class="style2"><div align="right">
                      <select name="sard" class="input_text required " id="seeAnotherField3"  style="height:40px ; width:100px ; direction:rtl" tabindex="46">
                        <option value="">انتخاب کنید</option>
                        <option value="2">ندارد</option>
                        <option value="1">دارد</option>
                      </select>
                    </div></td>
                    <td width="20%" height="46" ><div style="margin-right:30px" align="right"> :سردخانه </div></td>                  
                    </tr>
                  <tr>
                    <td height="42" colspan="3" class="style2">&nbsp;</td>
                    <td height="42" >&nbsp;</td>
                    <td height="42" class="style2"><div align="right">
                      <select name="m_sard" class="input_text required " id="sard"  style="height:40px ; width:100px ; direction:rtl" tabindex="48">
                        <option value="">انتخاب کنید</option>
                        <option value="2">ندارد</option>
                        <option value="1">دارد</option>
                      </select>
                    </div></td>
                    <td height="42" ><div style="margin-right:15px" align="right"> :ماشین سردخانه دار</div></td>
                  </tr>
                  <tr>
<td height="42" colspan="3" class="style2"><div align="right" id="otherFieldDiv10"> تن
    <input name="z_sort" type="text" class="required number input_text" id="z_sort" style="width:75px; height:30px ; " tabindex="50" dir="rtl" lang="fa" value="0" maxlength="35" xml:lang="fa"/>
                      <br />
                    </div></td>
                    <td width="13%" height="42" ><div style="margin-right:15px" align="right" id="otherFieldDiv9"> :ظرفیت</div></td>
                    <td width="16%" height="42" class="style2"><div align="right">
                      <select name="sort" class="input_text required " id="seeAnotherField4"  style="height:40px ; width:100px ; direction:rtl" tabindex="49">
                        <option value="">انتخاب کنید</option>
                        <option value="2">ندارد</option>
                        <option value="1">دارد</option>
                      </select>
                    </div></td>
                    <td width="20%" height="42" ><div style="margin-right:30px" align="right"> :سورت و بسته بندی</div></td>                  </tr>
                  <tr>
                    
                  </tr>
                  <tr>
                    <td height="35" colspan="6" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>سیستم های نوین تولید</strong></div></td>
                  </tr>
                  <tr>
                    <td height="53" class="style2"><div align="right">
                      <select name="ab_sh" class="input_text required " id="barg2"  style="height:40px ; width:100px ; direction:rtl" tabindex="53">
                        <option value="">انتخاب کنید</option>
                        <option value="2">ندارد</option>
                        <option value="1">دارد</option>
                        </select>
                      </div></td>
                    <td ><div style="margin-right:0px" align="right" id="otherFieldDiv5"> :آب شیرین کن</div></td>
                    <td height="53" class="style2"><div align="right">
                      <select name="nft" class="input_text required " id="barg"  style="height:40px ; width:100px ; direction:rtl" tabindex="52">
                        <option value="">انتخاب کنید</option>
                        <option value="2">ندارد</option>
                        <option value="1">دارد</option>
                        </select>
                      </div></td>
                    <td height="53" ><div style="margin-right:15px" align="right" id="otherFieldDiv3"> :NFT</div></td>
                    <td height="53" class="style2"><div align="right">
                      <select name="baz_chr" class="input_text required " id="seeAnotherField2"  style="height:40px ; width:100px ; direction:rtl" tabindex="51">
                        <option value="">انتخاب کنید</option>
                        <option value="2">ندارد</option>
                        <option value="1">دارد</option>
                        </select>
                      </div></td>
                    <td height="53" ><div style="margin-right:30px" align="right"> :بازچرخان </div></td>
                  </tr>
                  </table></td>
                </tr>
              </table>
            </td>
        </tr>
        <tr>
          <td height="19" colspan="5" class="style2">&nbsp;</td>
        </tr>
        </table>
      <div align="center">

     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="hidden" name="no_kesht" value=<?php echo $no_kesht; ?> />
     <input type="hidden" name="no_moj" value=<?php echo $no_moj; ?> />
     <input type="hidden" name="no_mal" value=<?php echo $no_mal; ?> />
 <a href="Greenhous.php">
          <input type="button" name="btn2" value="انصراف" style="width:150px ; height:45px" tabindex="55" /></a>
          <input  type="submit" name="action" value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="54" id="submit" onClick="setTimeout(disableFunction, 1);"/>
                              </p>
              </div>
                        </form>
                        <script>
                            $('#submit').click(function () {
                                $('#rasul').css('display', 'block');
                                setTimeout(function () {
                                    $('#rasul').css('display', 'none');
                                },3000)

                              
                            },3000)


                            function disableFunction() {
                                document.getElementById("submit").disabled = 'true';
                                $("#submit").attr("disabled","");
                            }
                        </script>
    <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal1' );
		  </script>
                <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal2' );
		  </script>
</td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Greenhouse.php">
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
<script src="hide-show-fields.js"></script>
</body>
</html>
