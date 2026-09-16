<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include_once('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
/////////////////////////////////////////////////// 
 if (isset($_POST['action'])) 
 {  
$date_s = $date_edit ;
$mor_cod_m = $login_session ;
$bah_cod_m = $_POST['bah_cod_m']; 
$add_city = $_POST['add_city'] ;
$add_abadi = $_POST['add_abadi'] ;
$id_ostan = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ;
$no_mtol = $_POST['no_mtol'] ;
$m_zamin = $_POST['m_zamin'] ;
$m_zamin_baz = $_POST['m_zamin_baz'] ;
$no_mal = $_POST['no_mal'] ;
$lng = $_POST['lng'] ;
$lat = $_POST['lat'] ;
if ($lng>99) $lng = 0 ; 
if ($lat>99) $lat = 0 ; 
$m_cod_m = $_POST['m_cod_m'] ;
$num_bah = $_POST['num_bah']; 
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
$m_vaz_sok = $_POST['m_vaz_sok'] ;
$no_saz = $_POST['no_saz'] ;
$no_gol = $_POST['no_gol'] ;
$pt_no = $_POST['pt_no'] ;
$pt_date = $_POST['pt_date'] ;
$pb_no = $_POST['pb_no'] ;
$pb_date = $_POST['pb_date'] ;
$m_ab = $_POST['m_ab'] ;
$unit_name = $_POST['unit_name'] ;
$sys_kesh = $_POST['sys_kesh'] ;
$no_sokh = $_POST['no_sokh'] ;
$sys_hot = $_POST['sys_hot'] ;
$sys_cool = $_POST['sys_cool'] ;
$sal = $_POST['sal'] ;
if ($no_mtol =='1')
{
$no_mtol1_1 = $_POST['no_mtol1_1'] ; 
$no_mtol1_2 = $_POST['no_mtol1_2'] ; 
$no_mtol1_3 = $_POST['no_mtol1_3'] ; 
$no_mtol1_4 = $_POST['no_mtol1_4'] ; 
$no_mtol1_5 = $_POST['no_mtol1_5'] ; 
$no_mtol1_6 = $_POST['no_mtol1_6'] ; 

$no_mtol2_1 = 0 ; 
$no_mtol2_2 = 0 ; 
$no_mtol2_3 = 0 ; 
$no_mtol2_4 = 0 ; 

$no_mtol4_1 = 0 ; 
$no_mtol4_2 = 0 ; 
$no_mtol4_3 = 0 ; 
$no_mtol4_4 = 0 ; 

$no_mtol3_1 = 0 ; 
$no_mtol3_2 = 0 ; 
$no_mtol3_3 = 0 ; 
$no_mtol3_4 = 0 ; 
}
if ($no_mtol =='2')
{
$m_zamin_baz = 0 ;
$no_mtol1_1 = 0 ; 
$no_mtol1_2 = 0 ; 
$no_mtol1_3 = 0 ; 
$no_mtol1_4 = 0 ; 
$no_mtol1_5 = 0 ; 
$no_mtol1_6 = 0 ; 

$no_mtol2_1 = $_POST['no_mtol2_1'] ; 
$no_mtol2_2 = $_POST['no_mtol2_2'] ; 
$no_mtol2_3 = $_POST['no_mtol2_3'] ; 
$no_mtol2_4 = $_POST['no_mtol2_4'] ; 

$no_mtol4_1 = 0 ; 
$no_mtol4_2 = 0 ; 
$no_mtol4_3 = 0 ; 
$no_mtol4_4 = 0 ; 

$no_mtol3_1 = 0 ; 
$no_mtol3_2 = 0 ; 
$no_mtol3_3 = 0 ; 
$no_mtol3_4 = 0 ; 

}
if ($no_mtol =='4')
{
$m_zamin = 0 ;
$no_saz = ''   ; $no_gol = '' ; $pt_date = '' ; $pt_no = '' ; $pb_date='' ; $pb_no = '' ; $m_ab ='' ; $unit_name = '' ; $sys_kesh = '' ; $no_sokh= '';$sys_hot = '' ; $sys_cool = '' ;
$no_mtol1_1 = 0 ; 
$no_mtol1_2 = 0 ; 
$no_mtol1_3 = 0 ; 
$no_mtol1_4 = 0 ; 
$no_mtol1_5 = 0 ; 
$no_mtol1_6 = 0 ; 

$no_mtol2_1 = 0 ; 
$no_mtol2_2 = 0 ; 
$no_mtol2_3 = 0 ; 
$no_mtol2_4 = 0 ; 

$no_mtol4_1 = $_POST['no_mtol4_1'] ; 
$no_mtol4_2 = $_POST['no_mtol4_2'] ; 
$no_mtol4_3 = $_POST['no_mtol4_3'] ; 
$no_mtol4_4 = $_POST['no_mtol4_4'] ; 

$no_mtol3_1 = 0 ; 
$no_mtol3_2 = 0 ; 
$no_mtol3_3 = 0 ; 
$no_mtol3_4 = 0 ; 

}
if ($no_mtol =='5')
{
$no_mtol1_1 = 0 ; 
$no_mtol1_2 = 0 ; 
$no_mtol1_3 = 0 ; 
$no_mtol1_4 = 0 ; 
$no_mtol1_5 = 0 ; 
$no_mtol1_6 = 0 ; 

$no_mtol2_1 = $_POST['no_mtol2_1'] ; 
$no_mtol2_2 = $_POST['no_mtol2_2'] ; 
$no_mtol2_3 = $_POST['no_mtol2_3'] ; 
$no_mtol2_4 = $_POST['no_mtol2_4'] ; 

$no_mtol4_1 = $_POST['no_mtol4_1'] ; 
$no_mtol4_2 = $_POST['no_mtol4_2'] ; 
$no_mtol4_3 = $_POST['no_mtol4_3'] ; 
$no_mtol4_4 = $_POST['no_mtol4_4'] ; 

$no_mtol3_1 = 0 ; 
$no_mtol3_2 = 0 ; 
$no_mtol3_3 = 0 ; 
$no_mtol3_4 = 0 ; 
}

if ($no_mtol =='3')
{
$no_mtol1_1 = 0 ; 
$no_mtol1_2 = 0 ; 
$no_mtol1_3 = 0 ; 
$no_mtol1_4 = 0 ; 
$no_mtol1_5 = 0 ; 
$no_mtol1_6 = 0 ; 

$no_mtol2_1 = 0 ; 
$no_mtol2_2 = 0 ; 
$no_mtol2_3 = 0 ; 
$no_mtol2_4 = 0 ; 

$no_mtol4_1 = 0 ; 
$no_mtol4_2 = 0 ; 
$no_mtol4_3 = 0 ; 
$no_mtol4_4 = 0 ; 

$no_mtol3_1 = $_POST['no_mtol3_1'] ; 
$no_mtol3_2 = $_POST['no_mtol3_2'] ; 
$no_mtol3_3 = $_POST['no_mtol3_3'] ; 
$no_mtol3_4 = $_POST['no_mtol3_4'] ; 
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
// بانک اطلاعات کشت 

$num3_t_mah = $t_mah ;
$query = "INSERT INTO Greenhous (date_s,mor_cod_m,bah_cod_m,num_bah,id_ostan,id_city,id_mar,add_abadi,add_city,m_zamin,m_zamin_baz,no_mal,lng,lat,m_cod_m,m_vaz_sok,no_mtol,no_saz,no_gol,pt_no,pt_date,pb_no,pb_date,m_ab,unit_name,sys_kesh,no_sokh,sys_hot,sys_cool,sal,no_mtol1_1,no_mtol1_2,no_mtol1_3,no_mtol1_4,no_mtol1_5,no_mtol1_6,no_mtol2_1,no_mtol2_2,no_mtol2_3,no_mtol2_4,no_mtol3_1,no_mtol3_2,no_mtol3_3,no_mtol3_4,no_mtol4_1,no_mtol4_2,no_mtol4_3,no_mtol4_4)             VALUES(:date_s,:mor_cod_m,:bah_cod_m,:num_bah,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:m_zamin,:m_zamin_baz,:no_mal,:lng,:lat,:m_cod_m,:m_vaz_sok,:no_mtol,:no_saz,:no_gol,:pt_no,:pt_date,:pb_no,:pb_date,:m_ab,:unit_name,:sys_kesh,:no_sokh,:sys_hot,:sys_cool,:sal,:no_mtol1_1,:no_mtol1_2,:no_mtol1_3,:no_mtol1_4,:no_mtol1_5,:no_mtol1_6,:no_mtol2_1,:no_mtol2_2,:no_mtol2_3,:no_mtol2_4,:no_mtol3_1,:no_mtol3_2,:no_mtol3_3,:no_mtol3_4,:no_mtol4_1,:no_mtol4_2,:no_mtol4_3,:no_mtol4_4)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':m_zamin'=>$m_zamin,':m_zamin_baz'=>$m_zamin_baz,':no_mal'=>$no_mal,':lng'=>$lng,':lat'=>$lat,':m_cod_m'=>$m_cod_m,':m_vaz_sok'=>$m_vaz_sok,':no_mtol'=>$no_mtol,':no_saz'=>$no_saz,':no_gol'=>$no_gol,':pt_no'=>$pt_no,':pt_date'=>$pt_date,':pb_no'=>$pb_no,':pb_date'=>$pb_date,':m_ab'=>$m_ab,':unit_name'=>$unit_name,':sys_kesh'=>$sys_kesh,':no_sokh'=>$no_sokh,':sys_hot'=>$sys_hot,':sys_cool'=>$sys_cool,':sal'=>$sal,':no_mtol1_1'=>$no_mtol1_1,':no_mtol1_2'=>$no_mtol1_2,':no_mtol1_3'=>$no_mtol1_3,':no_mtol1_4'=>$no_mtol1_4,':no_mtol1_5'=>$no_mtol1_5,':no_mtol1_6'=>$no_mtol1_6,':no_mtol2_1'=>$no_mtol2_1,':no_mtol2_2'=>$no_mtol2_2,':no_mtol2_3'=>$no_mtol2_3,':no_mtol2_4'=>$no_mtol2_4,':no_mtol3_1'=>$no_mtol3_1,':no_mtol3_2'=>$no_mtol3_2,':no_mtol3_3'=>$no_mtol3_3,':no_mtol3_4'=>$no_mtol3_4,':no_mtol4_1'=>$no_mtol4_1,':no_mtol4_2'=>$no_mtol4_2,':no_mtol4_3'=>$no_mtol4_3,':no_mtol4_4'=>$no_mtol4_4));
$query = "SELECT id FROM `malek` WHERE  `m_cod_m` = '$m_cod_m'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
if ($stmt -> rowCount() == 0)
{
$query = "INSERT INTO malek (date_s,mor_cod_m,m_cod_m,m_addres,m_jens,m_name,m_last_name,m_fname,m_tel_m)                        VALUES(:date_s,:mor_cod_m,:m_cod_m,:m_addres,:m_jens,:m_name,:m_last_name,:m_fname,:m_tel_m)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':m_cod_m'=>$m_cod_m,':m_addres'=>$m_addres,':m_jens'=>$m_jens,':m_name'=>$m_name,':m_last_name'=>$m_last_name,':m_fname'=>$m_fname,':m_tel_m'=>$m_tel_m));
}
 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ثبت اطلاعات گلخانه - '.$bah_cod_m,$id_ostan) ; 
unset($date_s,$mor_cod_m,$bah_cod_m,$num_bah,$id_ostan,$id_city,$id_mar,$add_abadi,$add_city,$m_zamin,$m_zamin_baz,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_mtol,$no_saz,$no_gol,$pt_no,$pt_date,$pb_no,$pb_date,$m_ab,$unit_name,$sys_kesh,$no_sokh,$sys_hot,$sys_cool,$sal,$no_mtol1_1,$no_mtol1_2,$no_mtol1_3,$no_mtol1_4,$no_mtol1_5,$no_mtol1_6,$no_mtol2_1,$no_mtol2_2,$no_mtol2_3,$no_mtol2_4,$no_mtol3_1,$no_mtol3_2,$no_mtol3_3,$no_mtol3_4,$no_mtol4_1,$no_mtol4_2,$no_mtol4_3,$no_mtol4_4);
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
date_default_timezone_set('Asia/Tehran') ;
$date_s = date_con(jdate("Y/m/d"));
$add_abadi = $_POST["add_abadi"]; 
$add_city = $_POST["add_city"]; 
$bah_cod_m = $_POST['bah_cod_m'];
$m_poul = $_POST['m_poul'];
$no_mal = $_POST['no_mal'];
$no_mtol = $_POST['no_mtol'];
if ($no_mal <> 7)
{
$query = "SELECT * from bah where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_name = $row['name'] ;
$m_jens = $row['jens'] ;
$m_last_name = $row['last_name'] ;
$m_fname = $row['fname'] ;
if(isset($_POST['num_bah'])) $num_bah = $_POST['num_bah']; else  $num_bah = '1' ;
$m_tel_m = $row['tel_m'] ;
}
$lng = $_POST['lng'];
$lat = $_POST['lat'];
$m_zamin = $_POST['m_zamin'];
$m_ab = $_POST['m_ab'] ;
$no_ab = $_POST['no_ab'] ;
$es = $_POST['es'] ;
if ($no_mtol=='1')  $v_no_mtol='سبزی و صیفی';
if ($no_mtol=='2')  $v_no_mtol='گل و گیاه زینتی در فضای گلخانه';
if ($no_mtol=='4')  $v_no_mtol='گل و گیاه زینتی در فضای باز ';
if ($no_mtol=='5')  $v_no_mtol='گل و گیاه زینتی در فضای توام';
if ($no_mtol=='3')  $v_no_mtol='سایر' ;	 
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
if ($no_mal=='1')  $v_no_mal='سند ششدانگ';
if ($no_mal=='2')  $v_no_mal='سند مشاعی';
if ($no_mal=='3')  $v_no_mal='اصلاحات اراضی';
if ($no_mal=='4')  $v_no_mal='موقوفه';
if ($no_mal=='5')  $v_no_mal='واگذاری';
if ($no_mal=='6')  $v_no_mal='قولنامه';
if ($no_mal=='7')  $v_no_mal='اجاره' ;
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
      <table width="99%" height="570" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <p class="one" >&nbsp;</p>
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
          <td height="38"><div align="right"> <?php echo $v_no_mtol; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نوع محصول تولیدی</div></td>
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
          <td height="49">
        <?php if ($no_mtol == '4' or $no_mtol =='5') {?>
        <div align="right"><span class="style2">مترمربع</span>
            <input name="m_zamin_baz" type="text" class="input_text required" id="m_zamin_baz" style="width:100px; height:30px ; " tabindex="4" dir="rtl"  lang="fa" value="<?php echo $m_zamin_baz ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
            <?php }?>
          </div></td>
          <td>
         <?php if ($no_mtol == '4' or $no_mtol =='5') {?>  
                   <div align="right">:مساحت زمین<span class="style2"> فضای باز</span></div>
          <?php }?>
                   </td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td>
        <?php if ($no_mtol <> '4' ) {?>  
          <div align="right"><span class="style2">مترمربع</span>
            <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />          
          <?php }?>
          </td>
          <td>
        <?php if ($no_mtol <> '4') {?>  
          <div style="margin-right:30px" align="right">:مساحت مفید<span class="style2"> گلخانه</span></div>
          <?php }?>
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
                  <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="7" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="11" xml:lang="fa"/>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
                </tr>
              <tr>
                <td height="51"><div align="right">
                  <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="10" dir="rtl" lang="fa" value="<?php echo $m_tel_m ; ?>" minlength="11" maxlength="11"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div align="right">:تلفن همراه</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="9" dir="rtl" lang="fa" value="<?php echo $m_fname ; ?>" maxlength="35" xml:lang="fa"/>
                  </div></td>
                <td><div style="margin-right:30px" align="right">:نام پدر</div></td>
                </tr>
              <tr>
                <td height="50" colspan="4"><div align="right"><span style="text-align: right">
                  <textarea name="m_addres" cols="80" rows="4" class="required input_text" id="m_addres" tabindex="11"><?php echo $m_addres ;?></textarea>
                  </span></div></td>
                <td><div style="margin-right:30px" align="right">:آدرس محل سکونت</div></td>
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
                  <p>:وضعیت سکونت </p>
                  </div></td>
                </tr>
              </table>
              <?php }?>
            </td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF">
<?php if($no_mtol<>'4') {?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
                </tr>
              <tr>
                <td height="53"><div align="right">
                  <select name="no_gol" class="input_text required " id="no_gol"  style="height:40px ; width:150px ; direction:rtl" tabindex="14">
                    <option value="">انتخاب کنید</option>
                    <option value="1">تونلی تک قلو</option>
                    <option value="2">تونلی بهم پیوسته</option>
                    <option value="3">یک طرفه</option>
                    <option value="4">شیشه ای سقف شیروانی</option>
                  </select>
                </div></td>
                <td><div align="right">:نوع گلخانه</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <select name="no_saz" class="input_text required " id="no_saz"  style="height:40px ; width:150px ; direction:rtl" tabindex="13">
                    <option value="">انتخاب کنید</option>
                    <option value="1">فلزی با پوشش پلاستیکی</option>
                    <option value="2">فلزی با پوشش پلی کربنات</option>
                    <option value="3">فلزی با پوشش شیشه ای</option>
                    <option value="4">چوبی پلاستیکی</option>
                  </select>
                </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:نوع سازه</div></td>
              </tr>
              <tr>
                <td height="53"><div align="right">
                  <input name="pb_no" type="text" class="required  input_text" id="pb_no" style="width:75px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $pb_no ; ?>" maxlength="20" xml:lang="fa"/>
                   تاریخ 
                   <input name="pb_date" type="text" class="pdate required input_text" id="pcal2" style="width:100px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $pb_date ; ?>" maxlength="10" xml:lang="fa"/>
شماره <br />
                </div></td>
                <td><div align="right">:پروانه بهره برداری</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right"> 
<input name="pt_no" type="text" class="required  input_text" id="pt_no" style="width:75px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $pt_no ; ?>" maxlength="20" xml:lang="fa"/>
 تاریخ
 <input name="pt_date" type="text"  class="pdate required input_text" id="pcal1"  style="width:100px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $pt_date ; ?>" maxlength="10" xml:lang="fa"/>
شماره <br />
                </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: پروانه تاسیس</div></td>
              </tr>
              <tr>
                <td width="37%" height="53"><div align="right">
                  <span class="style2">در صورت واقع شدن در مجتمع گلخانه ای</span>
                  <input name="unit_name" type="text" class="required input_text" id="unit_name" style="width:150px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $unit_name ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td width="17%"><div align="right">:نام مجتمع گلخانه ای </div></td>
                <td width="2%">&nbsp;</td>
                <td width="26%" bgcolor="#FFFFFF"><div align="right">
                  <select name="m_ab" class="input_text required " id="m_ab"  style="height:40px ; width:150px ; direction:rtl" tabindex="19">
                    <option value="">انتخاب کنید</option>
                    <option value="1">چاه</option>
                    <option value="2">حجمی از کانال</option>
                    <option value="3">رودخانه،چشمه و قنات</option>
                    <option value="4">آب شهری / روستایی</option>
                  </select>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: منبع تامین آب</div></td>
                </tr>
              <tr>
                <td height="47"><div align="right">
                <select name="no_sokh" class="input_text required " id="no_sokh"  style="height:40px ; width:120px ; direction:rtl" tabindex="22">
                    <option value="">انتخاب کنید</option>
                    <option value="1">نفت سفید</option>
                    <option value="2">گازوئیل</option>
                    <option value="3">گاز </option>
                 </select>
                </div></td>
                <td><div align="right">:نوع سوخت </div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="sys_kesh" class="input_text  required" id="sys_kesh"  style="height:40px ; width:120px ; direction:rtl" tabindex="21">
                    <option value="">انتخاب کنید</option>
                    <option value="1">خاکی</option>
                    <option value="2">هیدروپونیک</option>
                  </select>
                </div></td>
                <td><div style="margin-right:30px" align="right">:سیستم کشت</div></td>
              </tr>
              <tr>
                <td height="47"><div align="right">
                  <select name="sys_cool" class="input_text  required" id="sys_kol"  style="height:40px ; width:120px ; direction:rtl" tabindex="24">
                    <option value="">انتخاب کنید</option>
                    <option value="1">پدوفن</option>
                    <option value="2">مه پاش</option>
                    <option value="3">دریچه های تهویه</option>
                    </select>
                  </div></td>
                <td><div align="right">:نوع سیستم خنک کننده</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="sys_hot" class="input_text  required" id="sys_hot"  style="height:40px ; width:120px ; direction:rtl" tabindex="23">
                    <option value="">انتخاب کنید</option>
                    <option value="1">حرارت مرکزی</option>
                    <option value="2">هیتر یا بخاری</option>
                    <option value="3">تشعشعی</option>
                    </select>
                  </div></td>
                <td><div style="margin-right:30px" align="right">: نوع سیستم گرمایشی</div></td>
              </tr>
              </table>
<?php }?>
            </td>
        </tr>
          <tr>
          <td height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات کاشت</strong></div></td>
          </tr>
        <tr>
          <td height="40">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="sal" class="input_text  required" id="sal"  style="height:40px ; width:120px ; direction:rtl" tabindex="25">
   <option value="">انتخاب کنید</option>
   <option value="1394">1394</option>
   <option value="1395">1395</option>
   <option value="1396">1396</option>
            </select>
          </div></td>
          <td><div style="margin-right:30px" align="right">: سال </div></td>
        </tr>
        <tr>
          <td height="131" colspan="5"><?php if($no_mtol=='1') { ?>
            <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
              <tr>
                <td height="43" colspan="6" bgcolor="#FFFFCC">سبزی و صیفی واحد </td>
                </tr>
              <tr>
                <td width="25%" height="43" bgcolor="#FFFFCC">سایر محصولات جالیزی<br />
                  <span class="style2">تن</span></td>
                <td width="20%" bgcolor="#FFFFCC">سبزیجات برگی<br />
                  <span class="style2">تن</span></td>
                <td width="14%" bgcolor="#FFFFCC">بادمجان<br />
                  <span class="style2">تن</span></td>
                <td width="14%" bgcolor="#FFFFCC">فلفل
                  <br />
                  <span class="style2">تن</span></td>
                <td width="16%" bgcolor="#FFFFCC">گوجه فرنگی<br />
                  <span class="style2">تن</span></td>
                <td width="11%" bgcolor="#FFFFCC">خیار<br />
                  <span class="style2">تن</span></td>
              </tr>
              <tr>
                <td height="51"><div align="center">
                  <input name="no_mtol1_6" type="text" class="required number input_text" id="md_ab11" style="width:70px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $no_mtol1_6 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol1_5" type="text" class="required number input_text" id="md_ab10" style="width:70px; height:30px ; " tabindex="30" dir="rtl" lang="fa" value="<?php echo $no_mtol1_5 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol1_4" type="text" class="required number input_text" id="md_ab9" style="width:70px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $no_mtol1_5 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol1_3" type="text" class="required number input_text" id="md_ab8" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $no_mtol1_3 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol1_2" type="text" class="required number input_text" id="md_ab7" style="width:70px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $no_mtol1_2 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol1_1" type="text" class="required number input_text" id="md_ab6" style="width:70px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $no_mtol1_1 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
              </tr>
            </table>
          <?php } if($no_mtol=='2' or $no_mtol=='5') { ?>
          <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
            <tr>
                <td height="37" colspan="4" bgcolor="#FFFFCC">گل و گیاهان زینتی در فضای گلخانه</td>
                </tr>
              <tr>
                <td height="37" bgcolor="#FFFFCC">گل های فصلی <br />
                  <span class="style2">بوته</span></td>
                <td bgcolor="#FFFFCC">درخت و درختچه های زیستی<br />
                  <span class="style2">اصله</span></td>
                <td bgcolor="#FFFFCC">گیاهان آپارتمانی<br />
                  <span class="style2">گلدان</span></td>
                <td bgcolor="#FFFFCC">گل شاخه بریده<br />
                  <span class="style2">شاخه</span></td>
              </tr>
              <tr>
                <td height="41"><div align="center">
                  <input name="no_mtol2_4" type="text" class="required number input_text" id="md_ab15" style="width:70px; height:30px ; " tabindex="35" dir="rtl" lang="fa" value="<?php echo $no_mtol2_4 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol2_3" type="text" class="required number input_text" id="md_ab14" style="width:70px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $no_mtol2_3 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol2_2" type="text" class="required number input_text" id="md_ab13" style="width:70px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $no_mtol2_2 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol2_1" type="text" class="required number input_text" id="md_ab12" style="width:70px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $no_mtol2_1 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
              </tr>
        </table>
             <?php } if($no_mtol=='4' or $no_mtol =='5') {?> 
                  <br />
          <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
            <tr>
              <td height="37" colspan="4" bgcolor="#FFFFCC">گل و گیاهان زینتی در فضای باز</td>
            </tr>
            <tr>
              <td height="37" bgcolor="#FFFFCC">گل های فصلی <br />
                <span class="style2">بوته</span></td>
              <td bgcolor="#FFFFCC">درخت و درختچه های زیستی<br />
                <span class="style2">اصله</span></td>
              <td bgcolor="#FFFFCC">گیاهان آپارتمانی<br />
                <span class="style2">گلدان</span></td>
              <td bgcolor="#FFFFCC">گل شاخه بریده<br />
                <span class="style2">شاخه</span></td>
            </tr>
            <tr>
              <td height="41"><div align="center">
                <input name="no_mtol4_4" type="text" class="required number input_text" id="md_ab" style="width:70px; height:30px ; " tabindex="39" dir="rtl" lang="fa" value="<?php echo $no_mtol4_4 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div align="center">
                <input name="no_mtol4_3" type="text" class="required number input_text" id="md_ab2" style="width:70px; height:30px ; " tabindex="38" dir="rtl" lang="fa" value="<?php echo $no_mtol4_3 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div align="center">
                <input name="no_mtol4_2" type="text" class="required number input_text" id="md_ab3" style="width:70px; height:30px ; " tabindex="37" dir="rtl" lang="fa" value="<?php echo $no_mtol4_2 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div align="center">
                <input name="no_mtol4_1" type="text" class="required number input_text" id="md_ab4" style="width:70px; height:30px ; " tabindex="36" dir="rtl" lang="fa" value="<?php echo $no_mtol4_1 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
            </tr>
        </table>
          <p>
            <?php } if($no_mtol=='3') {?> 
          </p>
          <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
            <tr>
                <td height="35" colspan="4" bgcolor="#FFFFCC">سایر</td>
                </tr>
              <tr>
                <td height="35" bgcolor="#FFFFCC">سایر میوه ها <br />
                  <span class="style2">تن</span></td>
                <td bgcolor="#FFFFCC">نهال و قلمه<br />
                  <span class="style2">اصله</span></td>
                <td bgcolor="#FFFFCC">گیاهان دارویی<br />
                  <span class="style2">تن</span></td>
                <td bgcolor="#FFFFCC">توت فرنگی<br />
                  <span class="style2">تن</span></td>
              </tr>
              <tr>
                <td height="42"><div align="center">
                  <input name="no_mtol3_4" type="text" class="required number input_text" id="md_ab19" style="width:70px; height:30px ; " tabindex="43" dir="rtl" lang="fa" value="<?php echo $no_mtol3_4 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol3_3" type="text" class="required number input_text" id="md_ab18" style="width:70px; height:30px ; " tabindex="42" dir="rtl" lang="fa" value="<?php echo $no_mtol3_3 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol3_2" type="text" class="required number input_text" id="md_ab17" style="width:70px; height:30px ; " tabindex="41" dir="rtl" lang="fa" value="<?php echo $no_mtol3_2 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol3_1" type="text" class="required number input_text" id="md_ab16" style="width:70px; height:30px ; " tabindex="40" dir="rtl" lang="fa" value="<?php echo $no_mtol3_1 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
              </tr>
          </table>
<?php } ?>
</td>
          </tr>
        <tr>
          <td height="37" colspan="5" class="style2">&nbsp;</td>
          </tr>
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="hidden" name="no_mtol" value=<?php echo $no_mtol; ?> />
     <input type="hidden" name="no_mal" value=<?php echo $no_mal; ?> />
     <input type="submit" name="action" value="ثبت اطلاعات" id="submit" style="width:150px ; height:45px" tabindex="44" />
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
</body>
</html>
