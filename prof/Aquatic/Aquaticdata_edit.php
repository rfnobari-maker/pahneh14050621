<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');
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
 if (isset($_POST['action'])) 
 {  
$m_page      = isset($_POST['m_page']) ? $_POST['m_page'] : null;
$h_add_abadi = isset($_POST['h_add_abadi']) ? $_POST['h_add_abadi'] : null;
$h_add_city  = isset($_POST['h_add_city']) ? $_POST['h_add_city'] : null;
$h_no_fa     = isset($_POST['h_no_fa']) ? $_POST['h_no_fa'] : null;
$h_no_mal    = isset($_POST['h_no_mal']) ? $_POST['h_no_mal'] : null;
$h_sal       = isset($_POST['h_sal']) ? $_POST['h_sal'] : null;
$id          = isset($_POST['id']) ? $_POST['id'] : null;

// این متغیرها از POST دریافت نمی‌شوند، پس نیازی به isset() ندارند.
$date_s      = $date_edit;
$mor_cod_m   = $login_session;

$bah_cod_m   = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : null;
$add_city    = isset($_POST['add_city']) ? $_POST['add_city'] : null;
$add_abadi   = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : null;
$id_ostan    = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : null;
$id_city     = isset($_POST['id_city']) ? $_POST['id_city'] : null;
$id_mar      = isset($_POST['id_mar']) ? $_POST['id_mar'] : null;
$no_fa       = isset($_POST['no_fa']) ? $_POST['no_fa'] : null;
$m_zamin     = isset($_POST['m_zamin']) ? $_POST['m_zamin'] : null;
$no_mal      = isset($_POST['no_mal']) ? $_POST['no_mal'] : null;
$lng         = isset($_POST['lng']) ? $_POST['lng'] : null;
$lat         = isset($_POST['lat']) ? $_POST['lat'] : null;
if ($lng>99) $lng = 0 ; 
if ($lat>99) $lat = 0 ; 
$m_cod_m = $_POST['m_cod_m'] ;
$num_bah = $_POST['num_bah']; 
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
$m_vaz_sok = $_POST['m_vaz_sok'] ;
$g_tol = $_POST['g_tol'] ;
$no_gol = $_POST['no_gol'] ;
$pt_no = $_POST['pt_no'] ;
$pt_date = $_POST['pt_date'] ;
$pb_no = $_POST['pb_no'] ;
$pb_date = $_POST['pb_date'] ;
$m_ab = $_POST['m_ab'] ;
$unit_name = $_POST['unit_name'] ;
$sal = $_POST['sal'] ;
if ($no_fa =='1')
 {
$tak1  = isset($_POST['tak1']) ? $_POST['tak1'] : null;
$tak2  = isset($_POST['tak2']) ? $_POST['tak2'] : null;
$tak3  = isset($_POST['tak3']) ? $_POST['tak3'] : null;
$tak4  = isset($_POST['tak4']) ? $_POST['tak4'] : null;
$tak5  = isset($_POST['tak5']) ? $_POST['tak5'] : null;
$tak6  = isset($_POST['tak6']) ? $_POST['tak6'] : null;
$tak7  = isset($_POST['tak7']) ? $_POST['tak7'] : null;
$tak8  = isset($_POST['tak8']) ? $_POST['tak8'] : null;
$tak9  = isset($_POST['tak9']) ? $_POST['tak9'] : null;
$tak10 = isset($_POST['tak10']) ? $_POST['tak10'] : null;
$par1 = $par2 = $par3 = $par4 = $par5 = $par6 = $par7 = $par8 = $par9 = $par10 = $par11 = $par12 = $par13 = $par14 = $par15 = $par16 = $par17 = 0;

}
if ($no_fa =='2')
{
$tak1 = $tak2 = $tak3 = $tak4 = $tak5 = $tak6 = $tak7 = $tak8 = $tak9 = $tak10 = 0;

$par1 = isset($_POST['par1']) ? $_POST['par1'] : null;
$par2 = isset($_POST['par2']) ? $_POST['par2'] : null;
$par3 = isset($_POST['par3']) ? $_POST['par3'] : null;
$par4 = isset($_POST['par4']) ? $_POST['par4'] : null;
$par5 = isset($_POST['par5']) ? $_POST['par5'] : null;
$par6 = isset($_POST['par6']) ? $_POST['par6'] : null;
$par7 = isset($_POST['par7']) ? $_POST['par7'] : null;
$par8 = isset($_POST['par8']) ? $_POST['par8'] : null;
$par9 = isset($_POST['par9']) ? $_POST['par9'] : null;
$par10 = isset($_POST['par10']) ? $_POST['par10'] : null;
$par11 = isset($_POST['par11']) ? $_POST['par11'] : null;
$par12 = isset($_POST['par12']) ? $_POST['par12'] : null;
$par13 = isset($_POST['par13']) ? $_POST['par13'] : null;
$par14 = isset($_POST['par14']) ? $_POST['par14'] : null;
$par15 = isset($_POST['par15']) ? $_POST['par15'] : null;
$par16 = isset($_POST['par16']) ? $_POST['par16'] : null;
$par17 = isset($_POST['par17']) ? $_POST['par17'] : null;

}
if ($no_fa =='3')
{
$tak1 = isset($_POST['tak1']) ? $_POST['tak1'] : null;
$tak2 = isset($_POST['tak2']) ? $_POST['tak2'] : null;
$tak3 = isset($_POST['tak3']) ? $_POST['tak3'] : null;
$tak4 = isset($_POST['tak4']) ? $_POST['tak4'] : null;
$tak5 = isset($_POST['tak5']) ? $_POST['tak5'] : null;
$tak6 = isset($_POST['tak6']) ? $_POST['tak6'] : null;
$tak7 = isset($_POST['tak7']) ? $_POST['tak7'] : null;
$tak8 = isset($_POST['tak8']) ? $_POST['tak8'] : null;
$tak9 = isset($_POST['tak9']) ? $_POST['tak9'] : null;
$tak10 = isset($_POST['tak10']) ? $_POST['tak10'] : null;

$par1 = isset($_POST['par1']) ? $_POST['par1'] : null;
$par2 = isset($_POST['par2']) ? $_POST['par2'] : null;
$par3 = isset($_POST['par3']) ? $_POST['par3'] : null;
$par4 = isset($_POST['par4']) ? $_POST['par4'] : null;
$par5 = isset($_POST['par5']) ? $_POST['par5'] : null;
$par6 = isset($_POST['par6']) ? $_POST['par6'] : null;
$par7 = isset($_POST['par7']) ? $_POST['par7'] : null;
$par8 = isset($_POST['par8']) ? $_POST['par8'] : null;
$par9 = isset($_POST['par9']) ? $_POST['par9'] : null;
$par10 = isset($_POST['par10']) ? $_POST['par10'] : null;
$par11 = isset($_POST['par11']) ? $_POST['par11'] : null;
$par12 = isset($_POST['par12']) ? $_POST['par12'] : null;
$par13 = isset($_POST['par13']) ? $_POST['par13'] : null;
$par14 = isset($_POST['par14']) ? $_POST['par14'] : null;
$par15 = isset($_POST['par15']) ? $_POST['par15'] : null;
$par16 = isset($_POST['par16']) ? $_POST['par16'] : null;
$par17 = isset($_POST['par17']) ? $_POST['par17'] : null;
}
$sal = $_POST['sal'] ;
//بانک مالک
$m_addres = $_POST['m_addres'] ;
$m_jens = $_POST['m_jens'] ;
$m_name = $_POST['m_name'] ;
$m_last_name = $_POST['m_last_name'] ;
$m_fname = $_POST['m_fname'] ;
$m_tel_m = $_POST['m_tel_m'] ;
$t_mah = $_POST['t_mah'] ;

$query = "UPDATE Aquatic2 SET m_zamin=?,no_mal=?,lng=?,lat=?,
m_cod_m=?,m_vaz_sok=?,no_fa=?,m_ab=?,g_tol=?,pt_date=?,pt_no=?,sal=?,num_bah=?,add_abadi=? ,add_city=?,pb_date=?,pb_no=?,unit_name=?,tak1=?,tak2=?,tak3=?,tak4=?,tak5=?,tak6=?,tak7=?,tak8=?,tak9=?,tak10=?,par1=?,par2=?,par3=?,par4=?,par5=?,par6=?,par7=?,par8=?,par9=?,par10=?,par11=?,par12=?,par13=?,par14=?,par15=?,par16=?,par17=? WHERE bah_cod_m=? and id=? " ;
$q = $dbh->prepare($query);
          $q->execute(array($m_zamin,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_fa,$m_ab,$g_tol,$pt_date,$pt_no,$sal,$num_bah,$add_abadi,$add_city,$pb_date,$pb_no,$unit_name,$tak1,$tak2,$tak3,$tak4,$tak5,$tak6,$tak7,$tak8,$tak9,$tak10,$par1,$par2,$par3,$par4,$par5,$par6,$par7,$par8,$par9,$par10,$par11,$par12,$par13,$par14,$par15,$par16,$par17,$bah_cod_m,$id ));
$query = "SELECT id FROM `malek` WHERE  `m_cod_m` = '$m_cod_m'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
if ($stmt -> rowCount() == 0)
{
$query = "INSERT INTO malek (date_s,mor_cod_m,m_cod_m,m_addres,m_jens,m_name,m_last_name,m_fname,m_tel_m)                        VALUES(:date_s,:mor_cod_m,:m_cod_m,:m_addres,:m_jens,:m_name,:m_last_name,:m_fname,:m_tel_m)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':m_cod_m'=>$m_cod_m,':m_addres'=>$m_addres,':m_jens'=>$m_jens,':m_name'=>$m_name,':m_last_name'=>$m_last_name,':m_fname'=>$m_fname,':m_tel_m'=>$m_tel_m));
}
else 
{
$query = "UPDATE  malek  SET date_s=?,mor_cod_m=?,m_cod_m=?,m_addres=?,m_jens=?,m_name=?,m_last_name=?,m_fname=?,m_tel_m=?  WHERE m_cod_m=? ";
 $q = $dbh->prepare($query);
$q->execute(array($date_s,$mor_cod_m,$m_cod_m,$m_addres,$m_jens,$m_name,$m_last_name,$m_fname,$m_tel_m,$m_cod_m));
}
 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ویرایش اطلاعات مزرعه تکثیر و پرورش آبزیان - '.$bah_cod_m) ; 

unset($date_s,$mor_cod_m,$num_bah,$id_ostan,$id_city,$id_mar,$add_abadi,$add_city,$m_zamin,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_fa,$g_tol,$pt_no,$pt_date,$pb_no,$pb_date,$m_ab,$unit_name,$sal,$tak1,$tak2,$tak3,$tak4,$tak5,$par1,$par2,$par3,$par4);
alert ('ویرایش اطلاعات مزرعه تکثیر و پرورش آبزیان با موفقیت انجام شد ') ;
?>
<form  name="myform" class="myform" method="post" action="<?php echo $m_page ?>">
<input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
<input type="hidden" name="add_abadi" value="<?php echo $h_add_abadi?>" />
<input type="hidden" name="add_city" value="<?php echo $h_add_city?>" />
<input type="hidden" name="no_fa" value="<?php echo $h_no_fa?>" />
<input type="hidden" name="no_mal" value="<?php echo $h_no_mal?>" />
<input type="hidden" name="sal" value="<?php echo $h_sal?>" />
    <input type="hidden" name="action" value='1'/>
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>

<?php
 if (isset($_POST['action11'])) 
 { 
$bah_cod_m   = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : null;
$m_page      = isset($_POST['m_page']) ? $_POST['m_page'] : null;
$h_add_abadi = isset($_POST['h_add_abadi']) ? $_POST['h_add_abadi'] : null;
$h_add_city  = isset($_POST['h_add_city']) ? $_POST['h_add_city'] : null;
$h_no_fa     = isset($_POST['h_no_fa']) ? $_POST['h_no_fa'] : null;
$h_no_mal    = isset($_POST['h_no_mal']) ? $_POST['h_no_mal'] : null;
$h_sal       = isset($_POST['h_sal']) ? $_POST['h_sal'] : null;
unset($date_s,$mor_cod_m,$num_bah,$id_ostan,$id_city,$id_mar,$add_abadi,$add_city,$m_zamin,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_fa,$g_tol,$pt_no,$pt_date,$pb_no,$pb_date,$m_ab,$unit_name,$sal,$tak1,$tak2,$tak3,$tak4,$tak5,$par1,$par2,$par3,$par4);
alert ('انصراف از ویرایش اطلاعات مزرعه تکثیر و پرورش آبزیان ') ;
?>
<form  name="myform" class="myform" method="post" action="<?php echo $m_page ?>">
<input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
<input type="hidden" name="add_abadi" value="<?php echo $h_add_abadi?>" />
<input type="hidden" name="add_city" value="<?php echo $h_add_city?>" />
<input type="hidden" name="no_fa" value="<?php echo $h_no_fa?>" />
<input type="hidden" name="no_mal" value="<?php echo $h_no_mal?>" />
<input type="hidden" name="sal" value="<?php echo $h_sal?>" />
<input type="hidden" name="action" value='1'/>
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
<?php
/////////////////////////////////////////////// 
if  (isset($_POST['bah_cod_m']))
{
date_default_timezone_set('Asia/Tehran') ;
$date_s = date_con(jdate("Y/m/d"));
$m_page      = isset($_POST['m_page']) ? $_POST['m_page'] : null;
$h_add_abadi = isset($_POST['h_add_abadi']) ? $_POST['h_add_abadi'] : null;
$h_add_city  = isset($_POST['h_add_city']) ? $_POST['h_add_city'] : null;
$h_no_fa     = isset($_POST['h_no_fa']) ? $_POST['h_no_fa'] : null;
$h_no_mal    = isset($_POST['h_no_mal']) ? $_POST['h_no_mal'] : null;
$h_sal       = isset($_POST['h_sal']) ? $_POST['h_sal'] : null;
$id          = isset($_POST['id']) ? $_POST['id'] : null;
$add_abadi   = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : null;
$add_city    = isset($_POST['add_city']) ? $_POST['add_city'] : null;
$bah_cod_m   = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : null;
$m_poul      = isset($_POST['m_poul']) ? $_POST['m_poul'] : null;
$no_mal      = isset($_POST['no_mal']) ? $_POST['no_mal'] : null;
$no_fa       = isset($_POST['no_fa']) ? $_POST['no_fa'] : null;
$sal         = isset($_POST['sal']) ? $_POST['sal'] : null;
$num_bah     = isset($_POST['num_bah']) ? $_POST['num_bah'] : null;
$query = "SELECT * from Aquatic2 where bah_cod_m = '$bah_cod_m' and sal = '$sal' and id = '$id' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$lng = $row['lng'];
$lat = $row['lat'];
$m_zamin = $row['m_zamin'];
$m_cod_m = $row['m_cod_m'] ;
$g_tol = $row['g_tol'] ;
$no_gol = $row['no_gol'] ;
$pt_no = $row['pt_no'] ;
$pt_date = $row['pt_date'] ;
$pb_no = $row['pb_no'] ;
$pb_date = $row['pb_date'] ;
$m_ab = $row['m_ab'] ;
$unit_name = $row['unit_name'] ;
$sys_kesh = $row['sys_kesh'] ;
$no_sokh = $row['no_sokh'] ;
$sys_hot = $row['sys_hot'] ;
$sys_cool = $row['sys_cool'] ;
$sal = $row['sal'] ;
$tak1 = $row['tak1'] ; 
$tak2 = $row['tak2'] ; 
$tak3 = $row['tak3'] ; 
$tak4 = $row['tak4'] ; 
$tak5 = $row['tak5'] ; 
$tak6 = $row['tak6'] ; 
$tak7 = $row['tak7'] ; 
$tak8 = $row['tak8'] ; 
$tak9 = $row['tak9'] ; 
$tak10 = $row['tak10'] ; 

$par1 = $row['par1'] ; 
$par2 = $row['par2'] ; 
$par3 = $row['par3'] ; 
$par4 = $row['par4'] ; 
$par5 = $row['par5'] ; 
$par6 = $row['par6'] ; 
$par7 = $row['par7'] ; 
$par8 = $row['par8'] ; 
$par9 = $row['par9'] ; 
$par10 = $row['par10'] ; 
$par11 = $row['par11'] ; 
$par12 = $row['par12'] ; 
$par13 = $row['par13'] ; 
$par14 = $row['par14'] ; 
$par15 = $row['par15'] ; 
$par16 = $row['par16'] ;
$par17 = $row['par17'] ;
$m_vaz_sok = $row['m_vaz_sok'] ;
if ($no_mal <> 7)
{
$query = "SELECT no_bah,co_name,fname,name,jens,last_name,tel_m from bah where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_bah = $row['no_bah'] ;
$co_name = $row['co_name'] ;
if ($no_bah=='2') 
{
$m_fname = '-' ;
$v_co_name= '/ شرکت '.$row['co_name'].' /'; 
}
else 
{
$m_fname = $row['fname'] ;
}
$m_name = $row['name'] ;
$m_jens = $row['jens'] ;
$m_last_name = $row['last_name'] ;
$m_fname = $row['fname'] ;
$m_tel_m = $row['tel_m'] ;
}
else 
{
$query = "SELECT * from malek where  m_cod_m = :m_cod_m"; 
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
$query = "SELECT * from malek where  m_cod_m = :m_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':m_cod_m'=>$m_cod_m));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_addres = $row['m_addres'] ;

if ($no_fa=='1')  $v_no_fa='تکثیر';
if ($no_fa=='2')  $v_no_fa='پرورش';
if ($no_fa=='3')  $v_no_fa='تکثیر و پرورش' ;	 
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
$query = "SELECT * from list_abadi where add_abadi = :add_abadi"; 
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
$query = "SELECT * from list_city where add_city = :add_city"; 
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
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
           <p class="style8">ویرایش اطلاعات  مزرعه تکثیر و پرورش آبزیان</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1">
      <table width="99%" height="570" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="36%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?></div></td>
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
          <td height="38"><div align="right"> <?php echo $v_no_fa; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نوع فعالیت</div></td>
        </tr>
        <?php if($nah_kesh<>'3'){?>
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
        </tr>
        <tr>
          <td height="63"><div align="right">
            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td><div align="right">:Y عرض جغرافیایی</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
        </tr>
        <tr>
          <td height="49">&nbsp;</td>
          <td><div align="right"></div></td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right"><span class="style2">مترمربع</span>
            <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:مساحت مفید</div></td>
        </tr>
        <tr>
          <td height="5" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td  height="42" colspan="5" bgcolor="#CCCCCC"><?php if($no_mal<>7) echo '<p align="center" style="color:#0066CC" > اطلاعات بهره بردار بعنوان مالک ثبت خواهد شد </p>' ;  else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>' ?></td>
            </tr>
            <tr>
              <td width="31%" height="58"><div align="right">
                <select name="m_jens"  class="input_text mar required" id="m_jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="5">
                  <option value="1" <?php if ($row['jens']=='1') echo 'selected=selected'?>>مرد</option>
                  <option value="2" <?php if ($row['jens']=='2') echo 'selected=selected'?>>زن</option>
                </select>
              </div></td>
              <td width="20%"><div align="right">جنسیت</div></td>
              <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
              <td width="30%"  bgcolor="#FFFFFF"><div align="right"  >
                <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="4"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="10" xml:lang="fa"/>
              </div></td>
              <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد ملی مالک </div></td>
            </tr>
            <tr>
              <td height="46" bgcolor="#FFFFFF"><div align="right"  >
                <input name="m_last_name" type="text"  class="input_text required" id="m_last_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="7" dir="rtl" lang="fa" value="<?php echo $m_last_name ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی<br />
              </div></td>
              <td bgcolor="#FFFFFF">&nbsp;</td>
              <td bgcolor="#FFFFFF"><div align="right">
                <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="75" xml:lang="fa"/>
              </div></td>
              <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
            </tr>
            <tr>
              <td height="51"><div align="right">
                <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="9" dir="rtl" lang="fa" value="<?php echo $m_tel_m ; ?>"  maxlength="11"  align="baseline" xml:lang="fa" />
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
              <td height="50" colspan="4"><div align="right"><span style="text-align: right">
                <textarea name="m_addres" cols="80" rows="4" class="required input_text" id="m_addres" tabindex="10"><?php echo $m_addres ;?></textarea>
              </span></div></td>
              <td><div style="margin-right:30px" align="right">:آدرس محل سکونت</div></td>
            </tr>
            <tr>
              <td height="60">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><div align="right">
                <select name="m_vaz_sok" class="required input_text  " id="m_vaz_sok"  style="height:40px ; width:120px ; direction:rtl" tabindex="11">
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
            <?php }?></td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
            </tr>
            <tr>
              <td width="37%" height="53"><div align="right">
                <select name="m_ab" class="input_text required " id="m_ab"  style="height:40px ; width:150px ; direction:rtl" tabindex="13">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($m_ab=='1') { echo 'selected="selected"' ; } ?>>رودخانه</option>
                  <option value="2" <?php if ($m_ab=='2') { echo 'selected="selected"' ; } ?>>چاه</option>
                  <option value="3" <?php if ($m_ab=='3') { echo 'selected="selected"' ; } ?>>چشمه و قنات</option>
                  <option value="4" <?php if ($m_ab=='4') { echo 'selected="selected"' ; } ?>>آبن بندان</option>
                  <option value="5" <?php if ($m_ab=='5') { echo 'selected="selected"' ; } ?>>خور و دریا</option>
                  <option value="6" <?php if ($m_ab=='6') { echo 'selected="selected"' ; } ?>>دریاچه</option>
                  <option value="7" <?php if ($m_ab=='7') { echo 'selected="selected"' ; } ?>>سایر منابع</option>
                </select>
              </div></td>
              <td width="17%"><div align="right">: منبع تامین آب</div></td>
              <td width="2%">&nbsp;</td>
              <td width="26%" bgcolor="#FFFFFF"><div align="right">
                <select name="g_tol" class="input_text required " id="g_tol"  style="height:40px ; width:150px ; direction:rtl" tabindex="12">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($g_tol=='1') { echo 'selected="selected"' ; } ?>>مجتمع</option>
                  <option value="2" <?php if ($g_tol=='2') { echo 'selected="selected"' ; } ?>>منفرد</option>
                  <option value="3" <?php if ($g_tol=='3') { echo 'selected="selected"' ; } ?>>مدار بسته</option>
                  <option value="4" <?php if ($g_tol=='4') { echo 'selected="selected"' ; } ?>>دو منظوره</option>
                  <option value="5" <?php if ($g_tol=='5') { echo 'selected="selected"' ; } ?>>شالیزار</option>
                  <option value="6" <?php if ($g_tol=='6') { echo 'selected="selected"' ; } ?>>قفس</option>
                  <option value="7" <?php if ($g_tol=='7') { echo 'selected="selected"' ; } ?>>پن</option>
                  <option value="8" <?php if ($g_tol=='8') { echo 'selected="selected"' ; } ?>>آب بندان</option>
                  <option value="9" <?php if ($g_tol=='9') { echo 'selected="selected"' ; } ?>>منابع آبی</option>
                  <option value="10" <?php if ($g_tol=='10') { echo 'selected="selected"' ; } ?>>سایر موارد</option>
                </select>
              </div></td>
              <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:قالب تولید</div></td>
            </tr>
            <tr>
              <td height="53"><div align="right">
                <input name="pb_no" type="text" class="required  input_text" id="pb_no" style="width:75px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $pb_no ; ?>" maxlength="20" xml:lang="fa"/>
                تاریخ
                <input name="pb_date" type="text" class="pdate required input_text" id="pcal2" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $pb_date ; ?>" maxlength="10" xml:lang="fa"/>
شماره <br />
              </div></td>
              <td><div align="right">:پروانه بهره برداری</div></td>
              <td>&nbsp;</td>
              <td bgcolor="#FFFFFF"><div align="right">
                <input name="pt_no" type="text" class="required  input_text" id="pt_no" style="width:75px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $pt_no ; ?>" maxlength="20" xml:lang="fa"/>
                تاریخ
                <input name="pt_date" type="text"  class="pdate required input_text" id="pcal1"  style="width:100px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $pt_date ; ?>" maxlength="10" xml:lang="fa"/>
شماره <br />
              </div></td>
              <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: پروانه تاسیس</div></td>
            </tr>
            <tr>
              <td height="53" colspan="4"><div align="right"> <span class="style2">در صورت واقع شدن در مجتمع شیلاتی</span>
                <input name="unit_name" type="text" class="required input_text" id="unit_name" style="width:250px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $unit_name ; ?>" maxlength="75" xml:lang="fa"/>
                <br />
              </div></td>
              <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:نام مجتمع </div></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات تولید </strong></div></td>
        </tr>
        <tr>
          <td height="40">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="sal" class="input_text  required" id="sal"  style="height:40px ; width:120px ; direction:rtl" tabindex="19">
              <option value="1405" <?php if ($sal=='1405') { echo 'selected="selected"' ; } ?>>1405</option>
            </select>
          </div></td>
          <td><div style="margin-right:30px" align="right">: سال </div></td>
        </tr>
        <tr>
          <td height="131" colspan="5"><?PHP if(($no_fa == '1') or ($no_fa == '3')) {?>
            <table align="center"  class="my-table" >
              <tr>
                <td height="43" colspan="3" bgcolor="#FFFFCC"><strong><span class="style19">تکثیر</span></strong></td>
              </tr>
              <tr>
                <td width="19%" height="43" bgcolor="#FFFFCC"><strong><span class="style19">واحد </span></strong></td>
                <td width="16%" bgcolor="#FFFFCC"><strong><span class="style19">میزان تولید سالانه </span></strong></td>
                <td width="17%" bgcolor="#FFFFCC"><strong><span class="style19">عنوان</span></strong></td>
              </tr>
              <tr>
                <td height="51"><span class="style2"> هزار قطعه</span></td>
                <td><div align="center">
                  <input name="tak1" type="text" class="required number input_text" id="tak1" style="width:70px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $tak1 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">ماهیان گرمابی</td>
              </tr>
              <tr>
                <td height="51"><span class="style2"> هزار قطعه</span></td>
                <td><div align="center">
                  <input name="tak2" type="text" class="required number input_text" id="tak2" style="width:70px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $tak2 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">ماهیان    دریایی در استخرهای خاکی</td>
              </tr>
              <tr>
                <td height="51"><span class="style2"> هزار قطعه</span></td>
                <td><div align="center">
                  <input name="tak3" type="text" class="required number input_text" id="tak3" style="width:70px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $tak3 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">ماهیان خاویاری</td>
              </tr>
              <tr>
                <td height="51"><span class="style2"> هزار قطعه</span></td>
                <td><div align="center">
                  <input name="tak4" type="text" class="required number input_text" id="tak4" style="width:70px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $tak4 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">ماهیان    سردآبی (قزل آلا) </td>
              </tr>
              <tr>
                <td height="51"><span class="style2"> هزار قطعه</span></td>
                <td><div align="center">
                  <input name="tak5" type="text" class="required number input_text" id="tak5" style="width:70px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $tak5 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">منابع آبی طبیعی و نیمه طبیعی</td>
              </tr>
              <tr>
                <td height="51"><span class="style2"> هزار قطعه</span></td>
                <td><div align="center">
                  <input name="tak6" type="text" class="required number input_text" id="tak6" style="width:70px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $tak6 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">میگو آب    شیرین</td>
              </tr>
              <tr>
                <td height="51"><span class="style2"> هزار قطعه</span></td>
                <td><div align="center">
                  <input name="tak7" type="text" class="required number input_text" id="tak7" style="width:70px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $tak7 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">میگو آب شور </td>
              </tr>
              <tr>
                <td height="51"><span class="style2"> هزار قطعه</span></td>
                <td><div align="center">
                  <input name="tak8" type="text" class="required number input_text" id="tak8" style="width:70px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $tak8 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">شاه    میگو</td>
              </tr>
              <tr>
                <td height="51"><span class="style2"> هزار قطعه</span></td>
                <td><div align="center">
                  <input name="tak9" type="text" class="required number input_text" id="tak9" style="width:70px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $tak9 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">ماهیان زینتی</td>
              </tr>
              <tr>
                <td height="51"><span class="style2"> هزار قطعه</span></td>
                <td><div align="center">
                  <input name="tak10" type="text" class="required number input_text" id="tak10" style="width:70px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $tak10 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">صدف</td>
              </tr>
            </table>
            <?php }?>
            <br />
            <?PHP if(($no_fa == '2') or ($no_fa == '3')) {?>
            <table align="center"  class="my-table" >
              <tr>
                <td height="43" colspan="3" bgcolor="#FFFFCC"><span class="style19">پرورش</span></td>
              </tr>
              <tr>
                <td width="19%" height="43" bgcolor="#FFFFCC"><span class="style19">واحد </span></td>
                <td width="16%" bgcolor="#FFFFCC"><span class="style19">میزان تولید سالانه </span></td>
                <td width="17%" bgcolor="#FFFFCC"><span class="style19">عنوان </span></td>
              </tr>
              <tr>
                <td height="51"><span class="style2">تن</span></td>
                <td><div align="center">
                  <input name="par1" type="text" class="required number input_text" id="par1" style="width:70px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $par1 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">پرورش ماهی تیلاپیا</td>
              </tr>
              <tr>
                <td height="51"><span class="style2">تن</span></td>
                <td><div align="center">
                  <input name="par2" type="text" class="required number input_text" id="par2" style="width:70px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $par2 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">پرورش    ماهی در دریا (قفس)</td>
              </tr>
              <tr>
                <td height="51"><span class="style2">تن</span></td>
                <td><div align="center">
                  <input name="par3" type="text" class="required number input_text" id="par3" style="width:70px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $par3 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">پرورش ماهیان خاویاری</td>
              </tr>
              <tr>
                <td height="51"><span class="style2">تن</span></td>
                <td><div align="center">
                  <input name="par4" type="text" class="required number input_text" id="par4" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par4 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">پرورش    ماهیان دریایی در استخرهای خاکی</td>
              </tr>
              <tr>
                <td height="51"><span class="style2">تن</span></td>
                <td><div align="center">
                  <input name="par5" type="text" class="required number input_text" id="par5" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par5 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">پرورش ماهیان سردآبی</td>
              </tr>
              <tr>
                <td height="51"><span class="style2">تن</span></td>
                <td><div align="center">
                  <input name="par6" type="text" class="required number input_text" id="par6" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par6 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">پرورش    ماهیان گرمابی</td>
              </tr>
              <tr>
                <td height="51"><span class="style2">تن</span></td>
                <td><div align="center">
                  <input name="par7" type="text" class="required number input_text" id="par7" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par7 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">پرورش میگو آب شیرین</td>
              </tr>
              <tr>
                <td height="51"><span class="style2">تن</span></td>
                <td><div align="center">
                  <input name="par8" type="text" class="required number input_text" id="par8" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par8 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">پرورش میگو آب شور</td>
              </tr>
              <tr>
                <td height="51">تن</td>
                <td><div align="center">
                  <input name="par9" type="text" class="required number input_text" id="par9" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par9 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">پرورش شاه میگو</td>
              </tr>
              <tr>
                <td height="51">تن</td>
                <td><div align="center">
                  <input name="par10" type="text" class="required number input_text" id="par10" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par10 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">پرورش    در منابع آبی طبیعی و نیمه طبیعی</td>
              </tr>
              <tr>
                <td height="51">هزارقطعه</td>
                <td><div align="center">
                  <input name="par11" type="text" class="required number input_text" id="par11" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par11 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">ماهیان زینتی</td>
              </tr>
              <tr>
                <td height="51">هزار عدد</td>
                <td><div align="center">
                  <input name="par12" type="text" class="required number input_text" id="par12" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par12 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">زالوی    طبی </td>
              </tr>
              <tr>
                <td height="51">هزار شاخه </td>
                <td><div align="center">
                  <input name="par13" type="text" class="required number input_text" id="par13" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par13 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">گیاهان آبزی</td>
              </tr>
              <tr>
                <td height="51">سر</td>
                <td><div align="center">
                  <input name="par14" type="text" class="required number input_text" id="par14" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par14 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">کروکودیل</td>
              </tr>
              <tr>
                <td height="51">تن</td>
                <td><div align="center">
                  <input name="par15" type="text" class="required number input_text" id="par15" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par15 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">صدف</td>
              </tr>
              <tr>
                <td height="51">تن</td>
                <td><div align="center">
                  <input name="par16" type="text" class="required number input_text" id="par16" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par16 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">جلبک    (وزن تر)</td>
              </tr>
              <tr>
                <td height="51">تن</td>
                <td><div align="center">
                  <input name="par17" type="text" class="required number input_text" id="par17" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par17 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td class="style19">سیست و بیومس آرتمیا</td>
              </tr>
            </table>
            <?php }?>
            <br /></td>
        </tr>
      </table>
      <div align="center">
        <p>
     <input type="hidden" name="id" value=<?php echo $id; ?> />
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="hidden" name="no_fa" value=<?php echo $no_fa; ?> />
     <input type="hidden" name="no_mal" value=<?php echo $no_mal; ?> />
      <input type="hidden" name="m_page" value="<?php echo $m_page?>" />
      <input type="hidden" name="h_add_abadi" value="<?php echo $h_add_abadi?>" />
      <input type="hidden" name="h_add_city" value="<?php echo $h_add_city?>" />
      <input type="hidden" name="h_no_fa" value="<?php echo $h_no_fa?>" />
      <input type="hidden" name="h_no_mal" value="<?php echo $h_no_mal?>" />
      <input type="hidden" name="h_sal" value="<?php echo $h_sal?>" />
     <input type="submit" name="action" value="ثبت اطلاعات" id="submit" style="width:150px ; height:45px" tabindex="39" /> 
     <input type="submit" name="action11" value="انصراف" id="submit" style="width:150px ; height:45px" tabindex="40" />
        </p>
      </div>
<p align="center" >&nbsp;</p>
</form> 
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
<form  name="myform" class="myform" method="post" action="Aquatic.php">
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
