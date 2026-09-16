<?php
include('../../lock_p1.php');
include_once('../../login/config.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
////
if(isset($_POST['bah_cod_m'])) 
    {
if  (isset($_POST['id_page'])) $id_page = $_POST["id_page"]; 
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
//
 if (isset($_POST['cancel'])) 
 {  
?>
<form  name="myform" class="myform" method="post" action="liste_Garden_not_edit.php?id=<?php echo $id_page .'#1' ?>">
<input type="hidden" name="action_lise" value="1" />
<input type="hidden" name="back_p" value="1" />
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
///////
 if (isset($_POST['action'])) 
 {  
$id = $_POST['id'];
$date_s = $date_edit ;
$mor_cod_m = $login_session ;
if(isset($_POST['no_mush'])) $no_mush = $_POST['no_mush']; 
$bah_cod_m = $_POST['bah_cod_m']; 
$num_bah = $_POST['num_bah']; 
$add_city = $_POST['add_city'] ;
$add_abadi = $_POST['add_abadi'] ;
$id_ostan = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ;
$m_zamin = $_POST['m_zamin'] ;
$no_mal = $_POST['no_mal'] ;
$lng = $_POST['lng'] ;
$lat = $_POST['lat'] ;
$sh_gat = $_POST['sh_gat'] ;
$m_cod_m = $_POST['m_cod_m'] ;
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
$m_vaz_sok = $_POST['m_vaz_sok'] ;
$no_kesh = $_POST['no_kesh'] ;
$nah_kesh = $_POST['nah_kesh'] ;
$m_ab = $_POST['m_ab'] ;
$md_ab = $_POST['md_ab'] ;
$h_ab = $_POST['h_ab'] ;
$no_sab = $_POST['no_sab'] ;
$no_ab = $_POST['no_ab'] ;
$es = $_POST['es'] ;
$check_cod =$_POST['check_cod'] ; 
if ($no_kesh=='2')
{
$m_ab = '' ;
$md_ab = 0 ;
$h_ab = 0 ;
$no_sab = '' ;
$no_ab = '' ;
$es = '' ;
}
if ($nah_kesh=='3')
{
$m_zamin = 0 ;
$no_mal = '' ;
$lng = 0 ;
$lat = 0 ;
$m_cod_m = '' ;
$m_vaz_sok = '' ;
$no_kesh = '' ;
$m_ab = '' ;
$md_ab = 0 ;
$h_ab = 0 ;
$no_sab = '' ;
$no_ab = '' ;
$es = '' ;
}
$t_mah = $_POST['t_mah'] ;
$z_sal = $_POST['z_sal'] ;
//بانک مالک
$m_jens = $_POST['m_jens'] ;
$m_name = $_POST['m_name'] ;
$m_last_name = $_POST['m_last_name'] ;
$m_fname = $_POST['m_fname'] ;
$m_tel_m = $_POST['m_tel_m'] ;
$t_mah = $_POST['t_mah'] ;
$query = "UPDATE Garden SET date_s=?,es=?,no_mal=?,lng=?,lat=?,
m_cod_m=?,m_vaz_sok=?,no_kesh=?,m_ab=?,md_ab=?,h_ab=?,no_sab=?,no_ab=?,z_sal=?,num_bah=?,add_abadi=? ,add_city=?,m_zamin=?,num_bah=?,nah_kesh=?,t_mah=? WHERE bah_cod_m=? and id=? " ;
$q = $dbh->prepare($query);
$q->execute(array($date_s,$es,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_kesh,$m_ab,$md_ab,$h_ab,$no_sab,$no_ab,$z_sal,$num_bah,$add_abadi,$add_city,$m_zamin,$num_bah,$nah_kesh,$t_mah,$bah_cod_m,$id));
// بانک اطلاعات کشت 
$query = "DELETE FROM Garden_prod WHERE bah_cod_m=? AND sh_gat=? AND Garden_id=? ";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$sh_gat,$id));


$Garden_id = $id ;
$num3_t_mah = $t_mah ;
// شروع حلقه تنوع محصول 
while ($num3_t_mah > 0){
 $cod_qroup = $_POST['mah_qroup'.$num3_t_mah] ;
 $cod_mah = $_POST['mah_name'.$num3_t_mah] ;
 $s_kesht_b = $_POST['s_kesht_b'.$num3_t_mah] ;
 $s_kesht_gb = $_POST['s_kesht_gb'.$num3_t_mah] ;
if ($nah_kesh=='3')
{
 $s_kesht_b  = 0 ;
 $s_kesht_gb = 0 ;
}
 $tree_b = $_POST['tree_b'.$num3_t_mah] ;
 $tree_gb = $_POST['tree_gb'.$num3_t_mah] ;
 $mah_tol = $_POST['mah_tol'.$num3_t_mah] ;
 $mah_tolp = $_POST['mah_tolp'.$num3_t_mah] ;
 $mah_bem = $_POST['mah_bem'.$num3_t_mah] ;
 $mah_kh = $_POST['mah_kh'.$num3_t_mah] ;
include_once('../../login/config.php');
$query = "INSERT INTO Garden_prod (Garden_id,date_s,mor_cod_m,bah_cod_m,num_bah,sh_gat,id_ostan,id_city,id_mar,add_abadi,add_city,no_kesh,z_sal,cod_qroup,cod_mah,s_kesht_b,s_kesht_gb,tree_b,tree_gb,mah_tol,mah_tolp
,mah_bem,mah_kh,nah_kesh,check_cod) VALUES(:Garden_id,:date_s,:mor_cod_m,:bah_cod_m,:num_bah,:sh_gat,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:no_kesh,:z_sal,:cod_qroup,:cod_mah,:s_kesht_b,:s_kesht_gb,:tree_b,:tree_gb,:mah_tol,:mah_tolp
,:mah_bem,:mah_kh,:nah_kesh,:check_cod)";
$q = $dbh->prepare($query);
$q->execute(array(':Garden_id'=>$Garden_id,':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah,':sh_gat'=>$sh_gat,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':no_kesh'=>$no_kesh,':z_sal'=>$z_sal,':cod_qroup'=>$cod_qroup,':cod_mah'=>$cod_mah,':s_kesht_b'=>$s_kesht_b,':s_kesht_gb'=>$s_kesht_gb,':tree_b'=>$tree_b,':tree_gb'=>$tree_gb,':mah_tol'=>$mah_tol,':mah_tolp'=>$mah_tolp
,':mah_bem'=>$mah_bem,':mah_kh'=>$mah_kh,':nah_kesh'=>$nah_kesh,':check_cod'=>$check_cod));
// پایان حلقه تنوع محصول 
$num3_t_mah--;
 if ($num3_t_mah == 0 )
{
break ; 
}
}
include_once('../../login/config.php');
$query = "INSERT IGNORE INTO malek (date_s,mor_cod_m,m_cod_m,m_jens,m_name,m_last_name,m_fname,m_tel_m)                        VALUES(:date_s,:mor_cod_m,:m_cod_m,:m_jens,:m_name,:m_last_name,:m_fname,:m_tel_m)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':m_cod_m'=>$m_cod_m,':m_jens'=>$m_jens,':m_name'=>$m_name,':m_last_name'=>$m_last_name,':m_fname'=>$m_fname,':m_tel_m'=>$m_tel_m));
 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'تصحیح اطلاعات باغی و قلمستان - '.$bah_cod_m,$id_ostan) ; 
unset($error,$date_s,$mor_cod_m,$sh_gat,$id_ostan,$id_city,$id_mar,$add_abadi,$add_city,$no_kesh,$z_sal,$mah_mas,$cod_qroup,$cod_mah,$s_kesht_b,$s_kesht_gb,$tree_b,$tree_gb,$mah_tol,$mah_tolp
,$mah_bem,$mah_kh,$m_zamin,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_kesh,$m_ab,$md_ab,$h_ab,$no_sab,$no_ab,$es,$z_sal,$m_jens,$m_name,$m_last_name,$m_fname,$m_tel_m);
alert ('اطلاعات بهره برداری باغی با موفقیت تصحیح شد ') ;
?>
<form  name="myform" class="myform" method="post" action="liste_Garden_not_edit.php?id=<?php echo $id_page .'#1' ?>">
<input type="hidden" name="action" value="1" />
<input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ?>" />
<input type="hidden" name="action_lise" value="1" />
<input type="hidden" name="back_p" value="1" />


</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
<?php
 /////////////////////////////////////////////// 
if  (isset($_POST['bah_cod_m']))
{
$date_s = date_con(jdate("Y/m/d"));
$add_abadi = $_POST["add_abadi"]; 
$add_city = $_POST["add_city"]; 
$bah_cod_m = $_POST['bah_cod_m'];
$num_bah = $_POST['num_bah'];
if ($num_bah=='') $num_bah='1' ;
if(isset($_POST['m_poul'])) $m_poul = $_POST['m_poul'];
$sh_gat = $_POST['sh_gat'];
$z_sal = $_POST['z_sal'];
$t_mah = $_POST['t_mah'];
$no_mal = $_POST['no_mal'];
$no_kesh = $_POST['no_kesh'];
$nah_kesh = $_POST['nah_kesh'];
 $id = $_POST['id'];
  $query = "SELECT id,lng,lat,m_zamin,m_cod_m,m_ab,h_ab,no_sab,no_ab,es,md_ab,m_vaz_sok,check_cod,t_mah from Garden where
 bah_cod_m = '$bah_cod_m' and sh_gat = '$sh_gat' and z_sal = '$z_sal' and id = '$id' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$id = $row['id'];
$lng = $row['lng'];
$lat = $row['lat'];
$m_zamin = $row['m_zamin'];
$m_cod_m = $row['m_cod_m'] ;
$m_ab = $row['m_ab'] ;
$md_ab = $row['md_ab'] ;
$h_ab = $row['h_ab'] ;
$no_sab = $row['no_sab'] ;
$no_ab = $row['no_ab'] ;
$es = $row['es'] ;
$t_mah_old = $row['t_mah'];
$check_cod=$row['check_cod'] ;
$m_vaz_sok = $row['m_vaz_sok'] ;
if ($no_mal <> 7)
{
$query = "SELECT bah_cod_m,no_bah,co_name,name,jens,last_name,fname,tel_m from bah where  bah_cod_m = :bah_cod_m and num_bah = :num_bah"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_bah = $row['no_bah'] ;
$co_name = $row['co_name'] ;
$m_name = $row['name'] ;
$m_jens = $row['jens'] ;
$m_last_name = $row['last_name'] ;
$m_fname = $row['fname'] ;
$m_tel_m = $row['tel_m'] ;
}
else 
{
$query = "SELECT m_cod_m,m_name,m_jens,m_last_name,m_fname,m_tel_m from malek where  m_cod_m = :m_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':m_cod_m'=>$m_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_name = $row['m_name'] ;
$m_jens = $row['m_jens'] ;
$m_last_name = $row['m_last_name'] ;
$m_fname = $row['m_fname'] ;
$m_tel_m = $row['m_tel_m'] ;
}
if ($no_kesh=='1')  $v_no_kesh='آبی';
if ($no_kesh=='2')  $v_no_kesh='دیم';
if ($nah_kesh=='1') $v_nah_kesh='ساده' ;	 
if ($nah_kesh=='2') $v_nah_kesh='مخلوط' ;	 
if ($nah_kesh=='3') $v_nah_kesh='درختان پراکنده' ;	 
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
if ($no_mal=='1')  $v_no_mal='سند ششدانگ';
if ($no_mal=='2')  $v_no_mal='سند مشاعی';
if ($no_mal=='3')  $v_no_mal='اصلاحات اراضی';
if ($no_mal=='4')  $v_no_mal='موقوفه';
if ($no_mal=='5')  $v_no_mal='واگذاری';
if ($no_mal=='6')  $v_no_mal='قولنامه';
if ($no_mal=='7')  $v_no_mal='اجاره' ;
if ($no_mal=='8')  $v_no_mal='سایر' ;
$num_t_mah = $t_mah ; 
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
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>
<?php
while ($num_t_mah > 0){
?>
<script type="text/javascript">
$(document).ready(function()
{
$(".country<?php echo $num_t_mah ;?>").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_garden.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar<?php echo $num_t_mah ;?>").html(html);
} 
});
});
});
</script>
<?php
 $num_t_mah--;
 if ($num_t_mah == 0 )
{
break ; 
}
}
?>
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
           <p class="style8">تصحیح  اطلاعات باغی و قلمستان</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1">
      <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="34%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?></div></td>
          <td width="15%"><div align="right">:شهرستان</div></td>
          <td width="10%" rowspan="2">&nbsp;</td>
          <td width="23%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right">نوع مالکیت:<?php echo $v_no_mal; ?></div></td>
          <td height="38" colspan="2"><div align="right">نوع کاشت :<?php echo $v_no_kesh; ?></div></td>
          <td height="38"><div align="right"> <?php echo $v_nah_kesh; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نحوه کشت </div></td>
        </tr>
  <?php if($nah_kesh<>'3'){?> 
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
        </tr>
        <tr>
          <td height="63"><div align="right">
            <span class="style2">درجه اعشار</span>
            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td><div align="right">:Y عرض جغرافیایی</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <span class="style2">درجه اعشار</span>
            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
        </tr>
        <tr>
          <td height="49" colspan="4"><div align="right"><span class="style8">هکتار</span>
            <input name="m_zamin" type="text" class="m_zamin input_text number required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" min="0.01" maxlength="11"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:مساحت زمین</div></td>
        </tr>
        <tr>
          <td height="5" colspan="5">  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="42" colspan="5" bgcolor="#CCCCCC"><?php if($no_mal<>7) echo '<p align="center" style="color:#0066CC" > اطلاعات بهره بردار بعنوان مالک ثبت خواهد شد </p>' ;  else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>' ?></td>
                </tr>
              <tr>
                <td width="31%" height="58"><div align="right">
                  <select name="m_jens"  class="input_text mar required" id="m_jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="6">
                    <option value="1" <?php if ($row['jens']=='1') echo 'selected=selected'?>>مرد</option>
                    <option value="2" <?php if ($row['jens']=='2') echo 'selected=selected'?>>زن</option>
                    </select>
                  </div></td>
                <td width="20%"><div align="right">جنسیت</div></td>
                <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
                <td width="30%"  bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="5"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="11" xml:lang="fa"/>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد ملی مالک </div></td>
                </tr>
              <tr>
                <td height="46" bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_last_name" type="text"  class="input_text required" id="m_last_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="8" dir="rtl" lang="fa" value="<?php echo $m_last_name ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی<br />
                  </div></td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="7" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="50" xml:lang="fa"/>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
                </tr>
              <tr>
                <td height="51"><div align="right">
                  <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="10" dir="rtl" lang="fa" value="<?php echo $m_tel_m ; ?>"  maxlength="11"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div align="right">:تلفن همراه</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="9" dir="rtl" lang="fa" value="<?php if ($no_bah==2) echo $co_name; else echo $m_fname ; ?>" maxlength="75" xml:lang="fa"/>
                  </div></td>
                <td><div style="margin-right:30px" align="right">
                  <?php if ($no_bah==2) echo ':نام شرکت'; else echo ':نام پدر' ; ?>
                </div></td>
                </tr>
              <tr>
                <td height="60" colspan="4"><div align="right">
                  <select name="m_vaz_sok" class="required input_text  " id="m_vaz_sok"  style="height:40px ; width:120px ; direction:rtl" tabindex="12">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($m_vaz_sok=='1') { echo 'selected="selected"' ; } ?>>ساکن</option>
                    <option value="2" <?php if ($m_vaz_sok=='2') { echo 'selected="selected"' ; } ?> >غیرساکن</option>
                    </select>
                  </div></td>
                <td><div style="margin-right:30px" align="right">
                  <p>:وضعیت سکونت مالک</p>
                  </div></td>
              </tr>
              </table>
              <?php }?>
            </td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF">
  <?php if($no_kesh=='1'){?> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات آب</strong></div></td>
                </tr>
              <tr>
                <td width="31%" height="53"><div align="right">
                  <span class="style2">شبانه روز</span>
                  <input name="md_ab" type="text" class="required number input_text" id="md_ab" style="width:50px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $md_ab ; ?>" maxlength="2" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td width="20%"><div align="right">:مدار آبیاری</div></td>
                <td width="1%">&nbsp;</td>
                <td width="30%" bgcolor="#FFFFFF"><div align="right">
                  <select name="m_ab" class="input_text required " id="m_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="14">
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
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: منبع آب</div></td>
                </tr>
              <tr>
                <td height="47"><div align="right">
                  <select name="no_sab" class="input_text required " id="no_sab"  style="height:40px ; width:170px ; direction:rtl" tabindex="17">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($no_sab=='1') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری</option>
                    <option value="2" <?php if ($no_sab=='2') { echo 'selected="selected"' ; } ?>>مجوز آب</option>
                    <option value="3" <?php if ($no_sab=='3') { echo 'selected="selected"' ; } ?>>عرفی</option>
                    <option value="4" <?php if ($no_sab=='4') { echo 'selected="selected"' ; } ?>>سایر</option>
                    </select>
                  </div></td>
                <td><div align="right">:نوع سند حقابه</div></td>
                <td>&nbsp;</td>
                <td><div align="right"><span class="style2">ساعت</span>
                  <input name="h_ab" type="text" class="input_text  required  number" id="h_ab" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $h_ab ; ?>" maxlength="4"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div style="margin-right:30px" align="right">:حقابه</div></td>
                </tr>
              <tr>
                <td height="52"><div align="right">
                  <select name="es" class="input_text required" id="es"  style="height:40px ; width:170px ; direction:rtl" tabindex="19">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($es=='1') { echo 'selected="selected"' ; } ?> >ندارد</option>
                    <option value="2" <?php if ($es=='2') { echo 'selected="selected"' ; } ?>>دارد / جهت ذخیره آب</option>
                    <option value="3" <?php if ($es=='3') { echo 'selected="selected"' ; } ?>>دارد - دو منظوره </option>
                    </select>
                  </div></td>
                <td><div align="right"> :وضعیت استخر</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <select name="no_ab" class="input_text  required" id="no_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="18">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($no_ab=='1') { echo 'selected="selected"' ; }?>>جوی و پشته</option>
                    <option value="2" <?php if ($no_ab=='2') { echo 'selected="selected"' ; }?>>نواری</option>
                    <option value="3" <?php if ($no_ab=='3') { echo 'selected="selected"' ; }?>>غرقابی</option>
                    <option value="4" <?php if ($no_ab=='4') { echo 'selected="selected"' ; }?>>تشتکی</option>
                    <option value="5" <?php if ($no_ab=='5') { echo 'selected="selected"' ; }?>>تحت فشار قطره ای</option>
                    <option value="6" <?php if ($no_ab=='6') { echo 'selected="selected"' ; }?>>تحت فشار بارانی</option>
                    <option value="7" <?php if ($no_ab=='7') { echo 'selected="selected"' ; }?>>سایر</option>
                    </select>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نحوه آبیاری</div></td>
                </tr>
              </table>
  <?php }?>
            </td>
        </tr>
          <tr>
          <td height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات کاشت</strong></div></td>
          </tr>
        <tr>
          <td height="52" colspan="4"><div align="right">
            <div align="right">
                <select name="z_sal" class="input_text  required" id="z_sal"  style="height:40px ; width:120px ; direction:rtl" tabindex="20">
                <option value="1401"<?php if ($z_sal=='1401') { echo 'selected="selected"' ; } ?>>1401</option>
                </select>
            </div>
          </div></td>
          <td><div style="margin-right:30px" align="right">: سال </div></td>
        </tr>
        <tr>
          <td height="131" colspan="5"><table width="100%" height="112" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="4%" rowspan="2" bgcolor="#FFFFCC"> بیمه </td>
              <td width="5%" rowspan="2" bgcolor="#FFFFCC">خسارت</td>
              <td colspan="2" bgcolor="#FFFFCC">میزان تولید<br />
                <span class="style8">تن</span></td>
              <td height="32" colspan="2" bgcolor="#FFFFCC">تعداد درخت<br /></td>
              <?php if($nah_kesh<>'3'){?>
              <td colspan="2" bgcolor="#FFFFCC">سطح کاشت<br />
                <span class="style2">هکتار</span></td>
              <?php }?>
              <td colspan="2" bgcolor="#FFFFCC">اطلاعات محصول</td>
              <td width="5%" rowspan="2" bgcolor="#FFFFCC">ردیف</td>
            </tr>
            <tr>
              <td width="9%" bgcolor="#FFFFCC">قطعی</td>
              <td width="9%" bgcolor="#FFFFCC">پیش بینی</td>
              <td width="7%" bgcolor="#FFFFCC">غیربارور</td>
              <td width="7%" bgcolor="#FFFFCC">بارور</td>
              <?php if($nah_kesh<>'3'){?>
              <td width="8%" bgcolor="#FFFFCC">غیربارور</td>
              <td width="9%" bgcolor="#FFFFCC">بارور</td>
              <?php }?>
              <td width="18%" bgcolor="#FFFFCC">نام</td>
              <td width="19%" bgcolor="#FFFFCC">گروه</td>
            </tr>
            <?php 
$n = 1 ;
$num2_t_mah = $t_mah ;
 $query ="CREATE TEMPORARY TABLE tmp_$id SELECT * FROM Garden_prod WHERE Garden_id=:id" ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$id));
$query = "SELECT * from tmp_$id where Garden_id=:id "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$id));
$row_count = $stmt -> rowCount();
// اگر تعداد تنوع محصول بزرگتر از تعداد موجود در بانک باشد 
//alert($t_mah_old.'---->'.$num2_t_mah);
if ($t_mah > $t_mah_old)
{
$xx = $t_mah - $t_mah_old ;
// پروسه اضافه کردن تعداد اضافی به بانک 
while ($xx > 0)
{
$query = "INSERT INTO tmp_$id (Garden_id,bah_cod_m,sh_gat,z_sal)              
        VALUES(:Garden_id,:bah_cod_m,:sh_gat,:z_sal)";
$q = $dbh->prepare($query);
$q->execute(array(':Garden_id'=>$id,':bah_cod_m'=>$bah_cod_m,':sh_gat'=>$sh_gat,':z_sal'=>$z_sal));
$xx-- ; 
 if ($xx == 0 )
{
break ; 
}
}
// پروسه ایجاد کوئری جدید بعد از اضافه شدن تعداد اضافی 
$query = "SELECT * from tmp_$id where Garden_id = :Garden_id "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':Garden_id'=>$id));
}


// اگر تعداد تنوع محصول کوچکتر از تعداد موجود در بانک باشد 
if ($num2_t_mah < $t_mah_old)
{
$xx =  $t_mah_old - $num2_t_mah  ;
// پروسه حذف کردن تعداد اضافی از بانک 
$sql = "DELETE FROM tmp_$id where Gardeb_id = :Gardeb_id  ORDER BY id DESC LIMIT $xx ";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(':Gardeb_id'=>$id));
// پروسه ایجاد کوئری جدید بعد از اضافه شدن تعداد اضافی 
$query = "SELECT * from tmp_$id where Garden_id = :Garden_id "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':Garden_id'=>$id));
}
while ($num2_t_mah > 0){
foreach($stmt as $row)
{
$group_cod = $row['cod_qroup'] ;
$cod_mah = $row['cod_mah'] ; 
$s_kesht_b = $row['s_kesht_b'] ;
$s_kesht_gb = $row['s_kesht_gb'] ;
$tree_b  = $row['tree_b'] ;
$tree_gb  = $row['tree_gb'] ;
$mah_tol  = $row['mah_tol'] ;
$mah_tolp  = $row['mah_tolp'] ;
$mah_bem  = $row['mah_bem'] ;
$mah_kh  = $row['mah_kh'] ;
?>
            <tr>
              <td height="36" bgcolor="#FFFFFF"><div align="center">
                <select name="mah_bem<?php echo $num2_t_mah ;?>" class="required input_text  required" id="mah_bem<?php echo $num2_t_mah ;?>"  style="height:40px ; direction:rtl" tabindex="30">
                  <option value="">انتخاب</option>
                  <option value="1" <?php if ($mah_bem=='1') { echo 'selected="selected"' ; } ?>>بلی</option>
                  <option value="2" <?php if ($mah_bem=='2') { echo 'selected="selected"' ; } ?>>خیر</option>
                </select>
              </div></td>
              <td height="36" bgcolor="#FFFFFF"><div align="center">
                <select name="mah_kh<?php echo $num2_t_mah ;?>" class="required input_text  required" id="mah_kh<?php echo $num2_t_mah ;?>"  style="height:40px ; direction:rtl" tabindex="30">
                  <option value="">انتخاب</option>
                  <option value="1" <?php if ($mah_kh=='1') { echo 'selected="selected"' ; } ?>>بلی</option>
                  <option value="2" <?php if ($mah_kh=='2') { echo 'selected="selected"' ; } ?>>خیر</option>
                </select>
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="mah_tol<?php echo $num2_t_mah ;?>" type="text" onpaste="return false" class="mah_tol<?php echo $num2_t_mah ;?> required number input_text" id="mah_tol<?php echo $num2_t_mah ;?>" style="width:100px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php  echo $mah_tol ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="mah_tolp<?php echo $num2_t_mah ;?>" type="text" onpaste="return false" class="mah_tolp<?php echo $num2_t_mah ;?> required number input_text" id="mah_tolp<?php echo $num2_t_mah ;?>" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo  $mah_tolp ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="tree_gb<?php echo $num2_t_mah ;?>" type="text" onpaste="return false" class="tree_gb required digits input_text" id="tree_gb<?php echo $num2_t_mah ;?>" style="width:50px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $tree_gb ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="tree_b<?php echo $num2_t_mah ;?>" type="text" onpaste="return false" class="tree_b<?php echo $num2_t_mah ?> required digits input_text" id="tree_b<?php echo $num2_t_mah ;?>" style="width:50px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $tree_b ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
              </div></td>
              <?php if($nah_kesh<>'3'){?>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="s_kesht_gb<?php echo $num2_t_mah ;?>" type="text" onpaste="return false" class="s_kesht_gb mashat required number input_text" id="z_kesht_b<?php echo $num2_t_mah ;?>" style="width:75px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php  echo $s_kesht_gb*1 ; ?>" maxlength="11"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="s_kesht_b<?php echo $num2_t_mah ;?>" type="text" onpaste="return false" class="s_kesht_b<?php echo $num2_t_mah ?> mashat required number input_text" id="s_kesht_b<?php echo $num2_t_mah ;?>" style="width:75px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php   echo $s_kesht_b*1 ; ?>" maxlength="11"  align="baseline" xml:lang="fa" />
              </div></td>
              <?php }?>
              <td bgcolor="#FFFFFF"><span style="margin:10px">
                <div align="right">
                  <select  name="mah_name<?php echo $num2_t_mah ;?>" class="target<?php echo $num2_t_mah ;?> required input_text mar<?php  echo $mah_name.$num2_t_mah ;?>" style="width:200px ; height:40px" tabindex="23" dir="rtl" id="cod_mah<?php echo $num2_t_mah ;?>">
                    <option value="" selected="selected">انتخاب نام محصول</option>
                    <?php
$query = "SELECT DISTINCT product_cod,product_name FROM `product_b` WHERE  `group_cod` = $group_cod" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                    <option value="<?php echo $row['product_cod'] ;?>"
   <?php if ($row['product_cod']==$cod_mah) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
                    <?php
}
?>
                  </select>
                </div></td>
              <td bgcolor="#FFFFFF"><div align="right"><span style="margin:10px">
                <select  name="mah_qroup<?php echo $num2_t_mah ;?>" class="qroup<?php echo $num2_t_mah ;?> required input_text country<?php echo $num2_t_mah ;?>" id="mah_qroup<?php echo $num2_t_mah ;?>" style="width:200px ; height:40px" tabindex="22" dir="rtl"  >
                  <option value="" > انتخاب گروه</option>
                  <?php
$query = "SELECT DISTINCT group_cod,group_name FROM `product_b` "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                  <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$group_cod) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                  <?php }?>
                </select>
              </span></div></td>
              <td bgcolor="#FFFFFF"><?php echo $n ;?></td>
            </tr>
            <?php
 $num2_t_mah--;
 $n++ ;
  if ($num2_t_mah == 0 )
{
break ; 
}
}
}
?>
          </table></td>
          </tr>
        <tr>
          <td height="37" colspan="5" class="style2"><strong dir="rtl">تعداد درخت برای محصولات توت  فرنگی، چای، زرشک، گل محمدی، گیاهان دارویی و زعفران تکمیل نمیگردد.</strong></td>
          </tr>
  <?php if($nah_kesh<>'3'){?> 
        <tr>
          <td height="31" colspan="4"><div align="right"><span class="style2">هکتار</span>
            <input name="traz" id="traz" type="text"  disabled="disabled" style="width:100px; height:30px ; " tabindex="29" dir="rtl" lang="fa"  maxlength="70"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:10px" align="right">: تراز مساحت</div></td>
        </tr>
          <?php }?> 
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="id" value=<?php echo $id; ?> />
     <input type="hidden" name="sh_gat" value=<?php echo $sh_gat; ?> />
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="hidden" name="t_mah" value=<?php echo $t_mah; ?> />
     <input type="hidden" name="no_kesh" value=<?php echo $no_kesh; ?> />
     <input type="hidden" name="nah_kesh" value=<?php echo $nah_kesh; ?> />
     <input type="hidden" name="no_mal" value=<?php echo $no_mal; ?> />
     <input type="hidden" name="t_mah" value=<?php echo $t_mah; ?> />
     <input type="hidden" name="check_cod" value=<?php echo $check_cod; ?> />
     <input type="hidden" name="id_page"  value="<?php echo $id_page ;?>" />
     <input type="submit" name="cancel" value="انصراف" style="width:150px ; height:45px" tabindex="32" id="btn1" />
  <input type="submit" name="action" value="تصحیح اطلاعات" style="width:150px ; height:45px" tabindex="33" id="submit" onClick="setTimeout(disableFunction, 1);"/>
        </p>
      </div>
</form> 
<script>
function disableFunction() {
    document.getElementById("submit").disabled = 'true';
	$("#submit").attr("disabled","");
}
</script>  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Garden.php">
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
        $( ".qroup<?php echo $no ?>" ).change(function() {
            var e = document.getElementById("cod_mah<?php echo $no ?>");
            var mcod = e.options[e.selectedIndex].value;
            $('#tree_b<?php echo $no ?>').val('');
            $('#tree_gb<?php echo $no ?>').val('');
			$('#mah_tolp<?php echo $no ?>').val('');
			$('#mah_tol<?php echo $no ?>').val('');
        });
    </script>

    <script>
        $( ".target<?php echo $no ?>" ).change(function() {
            var e = document.getElementById("cod_mah<?php echo $no ?>");
            var mcod = e.options[e.selectedIndex].value;
            $('#tree_b<?php echo $no ?>').val('');
            $('#tree_gb<?php echo $no ?>').val('');
			$('#mah_tolp<?php echo $no ?>').val('');
			$('#mah_tol<?php echo $no ?>').val('');
        });
    </script>
    <script>
        $('.s_kesht_b<?php echo $no ?>').change(function () {
			$('#mah_tolp<?php echo $no ?>').val('');
			$('#mah_tol<?php echo $no ?>').val('');
            });
    </script>

    <script>
        $('.tree_b<?php echo $no ?>').change(function () {
			$('#mah_tolp<?php echo $no ?>').val('');
			$('#mah_tol<?php echo $no ?>').val('');
            var e = document.getElementById("cod_mah<?php echo $no ?>");
            var mcod = e.options[e.selectedIndex].value;
            var treeb = document.getElementById("tree_b<?php echo $no ?>").value;
            if ((mcod == '203003' || mcod == '206024' || mcod == '205002'
			|| mcod == '299006'   || mcod == '299003' || mcod == '208034'
			|| mcod == '208037'   || mcod == '208046' || mcod == '208052'
			|| mcod == '208053'   || mcod == '208108' || mcod == '208999' ) &  treeb > 0 ) {
                alert("برای این محصول نباید تعداد درخت ثبت کنید ");
                // پاک کردن مقدار تولید
                $('#tree_b<?php echo $no ?>').val(0);
                // فوکوس روی تولید محصول
                document.getElementById("tree_b<?php echo $no ?>").focus();
            }
            var skb = document.getElementById("s_kesht_b<?php echo $no ?>").value;

            if (parseFloat(skb) <= 0 ) {
                alert("بعلت سطح کشت بارور 0 ، امکان ثبت تعداد درخت بارور وجود ندارد ");
                // پاک کردن مقدار تولید
                $('#tree_b<?php echo $no ?>').val(0);
                // فوکوس روی تولید محصول
                document.getElementById("tree_b<?php echo $no ?>").focus();
            }
            });
    </script>
    <script>
        $('.tree_gb').change(function () {
            var e = document.getElementById("cod_mah<?php echo $no ?>");
            var mcod = e.options[e.selectedIndex].value;
            var treegb = document.getElementById("tree_gb<?php echo $no ?>").value;
            if ((mcod == '203003' || mcod == '206024' || mcod == '205002'
			|| mcod == '299006'   || mcod == '299003' || mcod == '208034'
			|| mcod == '208037'   || mcod == '208046' || mcod == '208052'
			|| mcod == '208053'   || mcod == '208108' || mcod == '208999') &  treegb > 0 ) {
                alert("برای این محصول نباید تعداد درخت ثبت کنید ");
                // پاک کردن مقدار تولید
                $('#tree_gb<?php echo $no ?>').val(0);
                // فوکوس روی تولید محصول
                document.getElementById("tree_gb<?php echo $no ?>").focus();
            }
		    var skgb = document.getElementById("s_kesht_gb<?php echo $no ?>").value;
            if (parseFloat(skgb) <= 0 ) {
                alert("بعلت سطح کشت غیربارور 0 ، امکان ثبت تعداد درخت غیر بارور وجود ندارد ");
                // پاک کردن مقدار تولید
                $('#tree_b<?php echo $no ?>').val(0);
                // فوکوس روی تولید محصول
                document.getElementById("tree_gb<?php echo $no ?>").focus();
            }
            });
    </script>
    <script>
        $('.mah_tolp<?php echo $no ?>').change(function () {
            var treeb = document.getElementById("tree_b<?php echo $no ?>").value;
            var m_tolp = document.getElementById("mah_tolp<?php echo $no ?>").value;
		    if (parseFloat(treeb) <= 0 & parseFloat(m_tolp) > 0 ) {
                //alert("از صحت تعداد درخت بارور وارد شده اطمینان حاصل فرمایید ");
                  // پاک کردن مقدار تولید
                 // $('#mah_tol<php echo $no ?>').val(0); 
                // فوکوس روی تولید محصول
               //  document.getElementById("mah_tol<php echo $no ?>").focus();
            }
        });
</script>
    <script>
        $('.mah_tolp<?php echo $no ?>').keyup(function () {
            // کد محصول
            var e = document.getElementById("cod_mah<?php echo $no ?>");
            var mcod = e.options[e.selectedIndex].value;
//
            var skb = document.getElementById("s_kesht_b<?php echo $no ?>").value;
            var mtol = document.getElementById("mah_tolp<?php echo $no ?>").value;
           $.ajax({
                url: "aj.php",
                type: "POST",
                data: {op:"check_mah_tol",mcod:mcod,skb:skb,mtol:mtol,no_kesh:<?php echo $no_kesh; ?>},
                success: function(data,status){
                    if(data!='true')
                    {
                        document.getElementById("submit").disabled = true;
                        //  alert( ' خطا  \n \n  میزان تولید وارد شده از حداکثر ممکن یعنی ' + data +' تن بیشتر هست \n \n  برای ادامه باید نسبت به تصحیح آن اقدام فرمایید ' );
                        alert( ' خطا  \n \n  میزان پیش بینی وارد شده از محدوده مجاز ، بیشتر هست . لطفاً تصحیح فرمایید ' );
                        // پاک کردن مقدار تولید
                        $('#mah_tolp<?php echo $no ?>').val('');
                        // فوکوس روی تولید محصول
                        document.getElementById("mah_tolp<?php echo $no ?>").focus();
                    }
                    else
                        document.getElementById("submit").disabled = false ;
                },
                error: function(){$("#result").html("مشکلی در اتصال به سرور به وجود آمد!")}
            });
        });
    </script>
    <script>
        $('.mah_tol<?php echo $no ?>').change(function () {
            var treeb = document.getElementById("tree_b<?php echo $no ?>").value;
            var m_tol = document.getElementById("mah_tol<?php echo $no ?>").value;
		    if (parseFloat(treeb) <= 0 & parseFloat(m_tol) > 0 ) {
               // alert("از صحت تعداد درخت بارور وارد شده اطمینان حاصل فرمایید ");
				                  // پاک کردن مقدار تولید
                 // $('#mah_tol<php echo $no ?>').val(0); 
                // فوکوس روی تولید محصول
               //  document.getElementById("mah_tol<php echo $no ?>").focus();
            }
        });
</script>
    <script>
        $('.mah_tol<?php echo $no ?>').keyup(function () {
            // کد محصول
            var e = document.getElementById("cod_mah<?php echo $no ?>");
            var mcod = e.options[e.selectedIndex].value;
//
            var skb = document.getElementById("s_kesht_b<?php echo $no ?>").value;
            var mtol = document.getElementById("mah_tol<?php echo $no ?>").value;
            $.ajax({
                url: "aj.php",
                type: "POST",
                data: {op:"check_mah_tol",mcod:mcod,skb:skb,mtol:mtol,no_kesh:<?php echo $no_kesh; ?>},
                success: function(data,status){
                    if(data!='true')
                    {
                        document.getElementById("submit").disabled = true;
                        //  alert( ' خطا  \n \n  میزان تولید وارد شده از حداکثر ممکن یعنی ' + data +' تن بیشتر هست \n \n  برای ادامه باید نسبت به تصحیح آن اقدام فرمایید ' );
                        alert( ' خطا  \n \n  میزان تولید وارد شده از محدوده مجاز ، بیشتر هست . لطفاً تصحیح فرمایید ' );
                        // پاک کردن مقدار تولید
                        $('#mah_tol<?php echo $no ?>').val('');
                        // فوکوس روی تولید محصول
                        document.getElementById("mah_tol<?php echo $no ?>").focus();
                    }
                    else
                        document.getElementById("submit").disabled = false ;
                },
                error: function(){$("#result").html("مشکلی در اتصال به سرور به وجود آمد!")}
            });
        });
    </script>

    <?php
    $no--;
}
?>
<script>
$('.m_zamin').change(function () {
 var zamin = document.getElementById("m_zamin").value;
 if(parseFloat(zamin) > '100')
 {
   alert("توجه :  \n \n  لطفا از صحت مساحت وارده شده بر حسب هکتار ، اطمینان حاصل فرمایید  ");
    // پاک کردن سطح برداشت 1
	document.getElementById("m_zamin").focus();
}
});
</script>
