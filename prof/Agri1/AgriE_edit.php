<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$id_page   = $_POST['id_page'] ; 
// انصراف
 if (isset($_POST['cancel'])) 
 {  
?>
<form  name="myform" class="myform" method="post" action="liste_Agri.php?id=<?php echo $id_page.'#1' ?>">
<input type="hidden" name="action_lise" value="1" />
<input type="hidden" name="back_p" value="1" />
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
// تصحیح
$r = 0 ; 
 if (isset($_POST['action'])) 
 {  
$id         = isset($_POST['id']) ? $_POST['id'] : '';
$date_s     = $date_edit; // مقدار ثابت یا متغیر از قبل تعریف‌شده
$id_page    = isset($_POST['id_page']) ? $_POST['id_page'] : '';
$mor_cod_m  = $login_session; // مقدار ثابت یا متغیر از قبل تعریف‌شده
$bah_cod_m  = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$num_bah    = isset($_POST['num_bah']) ? $_POST['num_bah'] : '';
$add_city   = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$add_abadi  = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$id_ostan   = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city    = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$id_mar     = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$m_zamin    = isset($_POST['m_zamin']) ? $_POST['m_zamin'] : '';
$no_mal     = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
$lng        = isset($_POST['lng']) ? $_POST['lng'] : '';
$lat        = isset($_POST['lat']) ? $_POST['lat'] : '';
$sh_gat     = isset($_POST['sh_gat']) ? $_POST['sh_gat'] : '';
$m_cod_m    = isset($_POST['m_cod_m']) ? $_POST['m_cod_m'] : '';
if ($no_mal !== '7') {
    $m_cod_m = $bah_cod_m;
}
$m_vaz_sok  = isset($_POST['m_vaz_sok']) ? $_POST['m_vaz_sok'] : '';
$no_kesh    = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$m_ab       = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
$md_ab      = isset($_POST['md_ab']) ? $_POST['md_ab'] : '';
$h_ab       = isset($_POST['h_ab']) ? $_POST['h_ab'] : '';
$no_sab     = isset($_POST['no_sab']) ? $_POST['no_sab'] : '';
$no_ab      = isset($_POST['no_ab']) ? $_POST['no_ab'] : '';
$es         = isset($_POST['es']) ? $_POST['es'] : '';
$check_cod  = isset($_POST['check_cod']) ? $_POST['check_cod'] : '';
$t_mah      = isset($_POST['t_mah']) ? $_POST['t_mah'] : '';
$z_sal      = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$z_sal_old  = isset($_POST['z_sal_old']) ? $_POST['z_sal_old'] : '';
$s_ayesh    = isset($_POST['s_ayesh']) ? $_POST['s_ayesh'] : '';
$Agri_table      = 'Agri'.str_replace('-','_',$z_sal) ; 
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
if ($no_kesh =='2')
{
$m_ab = '' ;
$md_ab = 0 ;
$h_ab = 0 ;
$no_sab = '' ;
$no_ab = '' ;
$es = '' ;
}
//بانک مالک
$m_jens      = isset($_POST['m_jens']) ? $_POST['m_jens'] : '';
$m_name      = isset($_POST['m_name']) ? $_POST['m_name'] : '';
$m_last_name = isset($_POST['m_last_name']) ? $_POST['m_last_name'] : '';
$m_fname     = isset($_POST['m_fname']) ? $_POST['m_fname'] : '';
$m_tel_m     = isset($_POST['m_tel_m']) ? $_POST['m_tel_m'] : '';
$t_mah       = isset($_POST['t_mah']) ? $_POST['t_mah'] : '';

$query = "UPDATE  `$Agri_prod_table` SET 
date_s=?,z_sal=?,num_bah=?,add_abadi=?,add_city=?,no_kesh=? WHERE bah_cod_m=? and Agri_id=? " ;
$q = $dbh->prepare($query);
$q->execute(array($date_s,$z_sal,$num_bah,$add_abadi,$add_city,$no_kesh,$bah_cod_m,$id));

$query = "UPDATE  `$Agri_table` SET 
date_s=?,num_bah=?,add_abadi=? ,add_city=?,m_zamin=?,no_mal=?,lng=?,lat=?,m_cod_m=?,m_vaz_sok=?,no_kesh=?,m_ab=?,md_ab=?,h_ab=?,no_sab=?,no_ab=?,es=?,z_sal=?,s_ayesh=? WHERE bah_cod_m=? and id=? " ;
$q = $dbh->prepare($query);
$q->execute(array($date_s,$num_bah,$add_abadi,$add_city,$m_zamin,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_kesh,$m_ab,$md_ab,$h_ab,$no_sab,$no_ab,$es,$z_sal,$s_ayesh,$bah_cod_m,$id));
// اطلاعات مالک
$query = "INSERT IGNORE INTO malek (date_s,mor_cod_m,m_cod_m,m_jens,m_name,m_last_name,m_fname,m_tel_m)                        VALUES(:date_s,:mor_cod_m,:m_cod_m,:m_jens,:m_name,:m_last_name,:m_fname,:m_tel_m)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':m_cod_m'=>$m_cod_m,':m_jens'=>$m_jens,':m_name'=>$m_name,':m_last_name'=>$m_last_name,':m_fname'=>$m_fname,':m_tel_m'=>$m_tel_m));
 // ثبت در فایل عملکرد و برگشت به لیست
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'تصحیح زمین زراعی/'.$sh_gat.'/'.$bah_cod_m ,$id_ostan) ; 
unset($error,$date_s,$mor_cod_m,$sh_gat,$id_ostan,$id_city,$id_mar,$add_abadi,$add_city,$no_kesh,$m_zamin,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_kesh,$m_ab,$md_ab,$h_ab,$no_sab,$no_ab,$es,$s_ayesh,$m_jens,$m_name,$m_last_name,$m_fname,$m_tel_m);
$com_alert =  'اطلاعات زمین زراعی با موفقیت تصحیح شد ' ;
?>
<form  name="myform" class="myform" method="post" action="liste_Agri.php?id=<?php echo $id_page.'#1' ?>">
<input type="hidden" name="action" value="1" />
<input type="hidden" name="action_lise" value="1" />
<input type="hidden" name="back_p" value="1" />
<input type="hidden" name="com_alert" value="<?php echo  $com_alert ;?>" />
  </form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
<?php
/// 
if  (isset($_POST['bah_cod_m']))
{
date_default_timezone_set('Asia/Tehran') ;
$date_s = date_con(jdate("Y/m/d"));
$id_page    = isset($_POST['id_page']) ? $_POST['id_page'] : '';
$add_abadi  = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city   = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$bah_cod_m  = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$num_bah    = isset($_POST['num_bah']) ? $_POST['num_bah'] : '1'; // مقدار پیش‌فرض
$m_poul     = isset($_POST['m_poul']) ? $_POST['m_poul'] : '';
$sh_gat     = isset($_POST['sh_gat']) ? $_POST['sh_gat'] : '';
$z_sal      = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$z_sal_old  = isset($_POST['z_sal_old']) ? $_POST['z_sal_old'] : '';
$t_mah      = isset($_POST['t_mah']) ? $_POST['t_mah'] : '';
$no_mal     = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
$no_kesh    = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$id         = isset($_POST['id']) ? $_POST['id'] : '';
$Agri_table     = 'Agri'.str_replace('-','_',$z_sal) ; 
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
//$bank_account = bank_account5($bah_cod_m,$num_bah) ;
//نوع کشت کشت قراردادی 
$error = 0 ;
$query = "SELECT id,no_kesh from `$Agri_prod_table` where Agri_id = $id ";
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row)
{
 $prod_id = $row['id'] ;
if (check_id($prod_id) == 2)  $error = 1    ; 
}
if ( $error == 1 and $row['no_kesh'] != $no_kesh )
{
?>
<form name="myform" class="myform" method="post" action="liste_Agri.php#1">
     <input type="hidden" name="bah_cod_m" value="" />
     <input type="hidden" name="action_lise" value="1" />
     <input type="hidden" name="back_p" value="1" />
     <input type="hidden" name="com_alert" value="حداقل یکی از محصولات این قطعه شامل کشت قراردادی میباشد ،  تغییر نوع کشت مقدور نیست">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}

//
$query = "SELECT * from `$Agri_table` where  id = $id "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$id));
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
$s_ayesh = $row['s_ayesh'] ;
$m_vaz_sok = $row['m_vaz_sok'] ;
$check_cod=$row['check_cod'] ;
$docId = $row['docId'] ; 
$num_bah = $row['num_bah'];
//alert($docId) ; 
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
$query = "SELECT m_name,m_jens,m_last_name,m_fname,m_tel_m from malek where  m_cod_m = :m_cod_m"; 
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
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
if ($no_mal=='1')  $v_no_mal='سند ششدانگ';
if ($no_mal=='2')  $v_no_mal='سند مشاعی';
if ($no_mal=='3')  $v_no_mal='اصلاحات اراضی';
if ($no_mal=='4')  $v_no_mal='موقوفه';
if ($no_mal=='5')  $v_no_mal='واگذاری';
if ($no_mal=='6')  $v_no_mal='قولنامه';
if ($no_mal=='7')  $v_no_mal='اجاره' ;
$num_t_mah = $t_mah ; 
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
$query = "SELECT sum(zer_kesht_a) z_kesht1 , sum(zer_kesht_b) z_kesht2 from $Agri_prod_table where Agri_id = :Agri_id ";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':Agri_id'=>$id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $z_kesht1 = $row['z_kesht1'] ;
    $z_kesht2 = $row['z_kesht2'] ;
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
.size:hover
{
width: 20px;
height:19 ;
}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
           <p class="style8">ویرایش  اطلاعات زمین زراعی </p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1">
      <table width="99%" height="409" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="31%" height="40"><div align="right"><?php echo city_name1($id_city,$id_ostan); ?></div></td>
          <td width="20%"><div align="right">:شهرستان</div></td>
          <td width="8%">&nbsp;</td>
          <td width="23%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi).''.shahr_name($add_city) ; ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
          </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo $v_no_mal; ?></div></td>
          <td><div align="right">:نوع مالکیت</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo $v_no_kesh; ?></div></td>
          <td><div style="margin-right:30px" align="right" >:نوع کشت</div></td>
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
          <td height="49" colspan="5"><table width="75%" border="0" align="center" cellspacing="0">
            <tr>
              <td width="19%" bgcolor="#66CCFF"><div align="right"><span class="style2">هکتار</span>
                <input name="m_zamin2" type="text" class="m_zamin input_text number required" id="m_zamin2" 
        style="width:80px; height:30px;" dir="rtl" lang="fa" 
        value="<?php echo $z_kesht2 * 1; ?>" maxlength="15" readonly align="baseline" xml:lang="fa" />
              </div></td>
              <td width="17%" bgcolor="#66CCFF"> : مجموع مساحت کشت دوم</td>
              <td width="21%" bgcolor="#66FF66"><div align="right"><span class="style2">هکتار</span>
                <input name="m_zamin1" type="text" class="m_zamin input_text number required" id="m_zamin1" 
        style="width:80px; height:30px;" dir="rtl" lang="fa" 
        value="<?php echo $z_kesht1 * 1; ?>" maxlength="15" readonly align="baseline" xml:lang="fa" />
              </div></td>
              <td width="17%" bgcolor="#66FF66"> : مجموع مساحت کشت اول</td>
              <td width="26%" bgcolor="#CCCCCC" class="style19">: اطلاعات کشت موجود</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="49" colspan="3">            </td>
          <td><div align="right"><span class="style2">هکتار</span>
            <input name="m_zamin"    type="text" class="m_zamin input_text number required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" min=0.001 max=6000 maxlength="11"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:مساحت زمین</div></td>
        </tr>
        <tr>
          <td height="5" colspan="5">  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="42" colspan="5" bgcolor="#CCCCCC"><?php if($no_mal<>7) echo '<p align="center" style="color:#0066CC" > اطلاعات بهره بردار  بعنوان مالک ثبت خواهد شد </p>' ;  else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>' ?></td>
                </tr>
              <tr>
                <td width="31%" height="58"><div align="right">
                  <select name="m_jens"  class="input_text mar required" id="m_jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="6">
                    <option value="1" <?php if ($m_jens=='1') echo 'selected=selected'?>>مرد</option>
                    <option value="2" <?php if ($m_jens=='2') echo 'selected=selected'?>>زن</option>
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
                  <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="7" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="70" xml:lang="fa"/>
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
                <td height="60">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><div align="right">
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
                  <input name="h_ab" type="text" class="input_text  required  number" id="h_ab" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $h_ab ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
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
            <br />
            <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></td>
        </tr>
          <tr>
            <td height="40"><div align="right"><span class="style2">هکتار</span>
              <input name="s_ayesh" type="text" class="s_ayesh input_text required number" id="s_ayesh" style="width:100px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $s_ayesh*1 ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
            </div></td>
            <td><div  align="right">: سطح آیش</div></td>
            <td>&nbsp;</td>
            <td><div align="right">
              <input name="z_sal" readonly  type="text" class="z_sal input_text required " id="z_sal" style="width:100px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $z_sal ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />               
              </div></td>
            <td><div style="margin-right:30px" align="right">: سال زراعی</div></td>
          </tr>
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="id" value=<?php echo $id; ?> />
     <input type="hidden" name="z_sal_old" value=<?php echo $z_sal_old; ?> />
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
     <input type="hidden" name="no_mal" value=<?php echo $no_mal; ?> />
     <input type="hidden" name="t_mah" value=<?php echo $t_mah; ?> />
     <input type="hidden" name="check_cod" value=<?php echo $check_cod; ?> />
     <input type="hidden" name="id_page"  value="<?php echo $id_page ;?>" />
     <input type="submit" name="cancel" value="انصراف" style="width:150px ; height:45px" tabindex="30" id="btn1" />
     <input type="submit" name="action" value="تصحیح اطلاعات" id="submit" style="width:150px ; height:45px" tabindex="32" />
        </p>
      </div>
<p align="center" >&nbsp;</p>
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
<form  name="myform" class="myform" method="post" action="Agri1.php">
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
<script>
window.addEventListener("load", function() {
    document.getElementById("form1").addEventListener("submit", function(event) {
        var m_zamin = parseFloat(document.getElementById("m_zamin").value) || 0;
        var m_zamin1 = parseFloat(document.getElementById("m_zamin1").value) || 0;
        var m_zamin2 = parseFloat(document.getElementById("m_zamin2").value) || 0;
        var s_ayesh = parseFloat(document.getElementById("s_ayesh").value) || 0;

        // محاسبه بزرگترین مقدار بین کشت اول و دوم
        var max_kesht = Math.max(m_zamin1, m_zamin2);
        var sum_kesht_ayesh = max_kesht + s_ayesh;

        // شرط 1: مساحت زمین نباید کوچکتر از مجموع مساحت کشت شده و آیش باشد
        if (m_zamin < sum_kesht_ayesh) {
        alert("مساحت کل زمین نمی‌تواند کوچکتر از مجموع مساحت کشت شده و آیش یعنی " + sum_kesht_ayesh + " باشد.");
            event.preventDefault(); // جلوگیری از ارسال فرم
            return;
        }
        // شرط 2: سطح آیش نباید از مساحت زمین بزرگتر باشد
        if (s_ayesh > m_zamin) {
            alert("سطح آیش نمی‌تواند از مساحت کل زمین بزرگتر باشد.");
            event.preventDefault(); // جلوگیری از ارسال فرم
            return;
        }
    });
});
</script>
<script>
$('.s_ayesh').keyup(function () {
 var ayesh = document.getElementById("s_ayesh").value;
 if(parseFloat(ayesh) < 0 )
 {
   alert("خطا !!  \n  سطح آیش نمیتواند منفی باشد  ");
    // پاک کردن سطح برداشت 1
		$('#s_ayesh').val(0);
}
});
</script>
</body>
</html>