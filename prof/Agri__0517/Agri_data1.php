<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');
include('../../login/config.php');
// جلوگیری از Notice ها - سازگار با PHP 5.3
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$id_mar    = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$check_cod = isset($_POST['check_cod']) ? $_POST['check_cod'] : 0;
$m_poul    = isset($_POST['m_poul']) ? $_POST['m_poul'] : '';
$no_kesh   = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$no_mal    = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
$num_bah   = isset($_POST['num_bah']) ? $_POST['num_bah'] : 1;
$v_co_name = '';
$m_cod_m     = '';
$m_last_name = '';
$m_name      = '';
$m_tel_m     = '';
$m_fname     = '';
$m_jens      = '';
$no_bah = '1' ; 

date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$check = 1 ;
//
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
//
if (isset($_POST['action']) && $id_mar != '')

{
    $date_s = $date_edit ;
    $check_cod = $_POST['check_cod']  ;
    $mor_cod_m = $login_session ;
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
    if(isset($_POST['num_bah'])) $num_bah = $_POST['num_bah']; else  $num_bah = '1' ;
    if ($no_mal<>'7') $m_cod_m = $bah_cod_m ;
    $m_vaz_sok = $_POST['m_vaz_sok'] ;
    $no_kesh = $_POST['no_kesh'] ;
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
    $z_sal = $_POST['z_sal'] ;
    $s_ayesh = $_POST['s_ayesh'] ;
//شماره قطعه
//    $Agri_table      = 'Agri'.str_replace('-','_',$z_sal) ; 
       $Agri_table      = 'Agri'.str_replace('-','_',$z_sal) ; 
	    $query = "SELECT max(`sh_gat`) as `max_shgat` FROM `$Agri_table` WHERE  bah_cod_m= '$bah_cod_m' and z_sal= '$z_sal'";
	    $stmt = $dbh->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $t_gat =  $row['max_shgat'] ;
        $sh_gat = $t_gat + 1 ;
//بانک مالک
    $m_jens = $_POST['m_jens'] ;
    $m_name = $_POST['m_name'] ;
    $m_last_name = $_POST['m_last_name'] ;
    $m_fname = $_POST['m_fname'] ;
    $m_tel_m = $_POST['m_tel_m'] ;
// بانک اطلاعات کشت
    $query = "INSERT INTO `$Agri_table` (date_s,mor_cod_m,bah_cod_m,num_bah,sh_gat,id_ostan,id_city,id_mar,add_abadi,add_city,m_zamin,no_mal,lng,lat,m_cod_m,m_vaz_sok,no_kesh,m_ab,md_ab,h_ab,no_sab,no_ab,es,z_sal,s_ayesh,check_cod)                        VALUES(:date_s,:mor_cod_m,:bah_cod_m,:num_bah,:sh_gat,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:m_zamin,:no_mal,:lng,:lat,:m_cod_m,:m_vaz_sok,:no_kesh,:m_ab,:md_ab,:h_ab,:no_sab,:no_ab,:es,:z_sal,:s_ayesh,:check_cod)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah,':sh_gat'=>$sh_gat,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':m_zamin'=>$m_zamin,':no_mal'=>$no_mal,':lng'=>$lng,':lat'=>$lat,':m_cod_m'=>$m_cod_m,':m_vaz_sok'=>$m_vaz_sok,':no_kesh'=>$no_kesh,':m_ab'=>$m_ab,':md_ab'=>$md_ab,':h_ab'=>$h_ab,':no_sab'=>$no_sab,':no_ab'=>$no_ab,':es'=>$es,':z_sal'=>$z_sal,':s_ayesh'=>$s_ayesh,':check_cod'=>$check_cod));
// start 61
// end 61

    // ثبت در بانک پیگیری
    $check++ ;
//

//include('../../login/config.php');
// اطلاعات مالک
    $query = "INSERT IGNORE INTO malek (date_s,mor_cod_m,m_cod_m,m_jens,m_name,m_last_name,m_fname,m_tel_m)                        VALUES(:date_s,:mor_cod_m,:m_cod_m,:m_jens,:m_name,:m_last_name,:m_fname,:m_tel_m)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':m_cod_m'=>$m_cod_m,':m_jens'=>$m_jens,':m_name'=>$m_name,':m_last_name'=>$m_last_name,':m_fname'=>$m_fname,':m_tel_m'=>$m_tel_m));
    sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ثبت اطلاعات زراعی - '.$bah_cod_m,$id_ostan) ;

$dbh = null;
    alert ('اطلاعات بهره برداری زراعی  با موفقیت ثبت شد ') ;
    ?>
  <form name="myform1" class="myform" method="post" action="liste_Agri.php#1">
        <input type="hidden" name="z_sal" value="<?php echo  $z_sal ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
        <input type="hidden" name="action_lise" value="1" />
        <input type="hidden" name="t_mah" value="" />
        <input type="hidden" name="action_lise" value="1" />
 </form>
   <script type="text/javascript">document.myform1.submit();</script>   <?php
}
////////
if(isset($_POST['bah_cod_m']))
{
if(isset($_POST['t_gat'])) $check_cod = $_POST['t_gat']+1;
if(isset($_POST['add_abadi'])) $add_abadi = $_POST["add_abadi"];
if(isset($_POST['add_city'])) $add_city = $_POST["add_city"];
if(isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'];
if(isset($_POST['m_poul'])) $m_poul = $_POST['m_poul'];
if(isset($_POST['no_mal'])) $no_mal = $_POST['no_mal'];
if(isset($_POST['num_bah'])) $num_bah = $_POST['num_bah']; else  $num_bah = '1' ;
if ($no_mal <> 7)
{
   include('../../login/config.php');
    $query = "SELECT no_bah,co_name,fname,name,jens,last_name,tel_m from bah where  bah_cod_m = :bah_cod_m and num_bah = :num_bah";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
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
    $m_tel_m = $row['tel_m'] ;
}
if(isset($_POST['no_kesh'])) $no_kesh = $_POST['no_kesh'];
if(isset($_POST['lng'])) $lng = $_POST['lng'];
if(isset($_POST['lat'])) $lat = $_POST['lat'];
if(isset($_POST['m_zamin'])) $m_zamin = $_POST['m_zamin'];
if(isset($_POST['m_ab'])) $m_ab = $_POST['m_ab'] ;
if(isset($_POST['no_ab'])) $no_ab = $_POST['no_ab'] ;
if(isset($_POST['es'])) $es = $_POST['es'] ;
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
if ($no_mal=='8')  $v_no_mal='سایر' ;
if ($m_poul=='abadi') {
    $query = "SELECT id_ostan,id_city,id_mar,add_abadi from list_abadi where add_abadi = :add_abadi";
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
    $query = "SELECT id_ostan,id_city,id_mar,add_city from list_city where add_city = :add_city";
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
        height:19px ;
    }
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
            <div class="style8">ثبت قطعه زراعی جدید</div>
          <div> <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></div>
                <p>
                  <?php sar_data2($bah_cod_m,$num_bah) ;?>
                  </p>
                </p>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >

                <tr>
                    <td width="4"><p>&nbsp;</p>
                        <p>&nbsp;</p></td>
                    <td width="840" >
                        <form action="" method="post" id="form1" name="form1">
                            <table width="99%" height="612" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
                                <tr>
                                    <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
                                </tr>
                                <tr>
                                    <td width="31%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?></div></td>
                                    <td width="20%"><div align="right">:شهرستان</div></td>
                                    <td width="1%">&nbsp;</td>
                                    <td width="30%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
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
                                            <span class="style2">درجه اعشار</span>
                                            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php if(isset($lat)) echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
                                            <br />
                                            <span class="style8">37.010521: مثال</span></div></td>
                                    <td><div align="right">:Y عرض جغرافیایی</div></td>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><span class="style2">درجه اعشار</span>
                                            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php if(isset($lng)) echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
                                            <br />
                                            <span class="style8">46.212486: مثال</span></div></td>
                                    <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
                                </tr>
                                <tr>
                                    <td height="49" colspan="4"><div align="right"><span class="style2">هکتار </span>
                                            <input name="m_zamin" type="text" class="m_zamin input_text number required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php if(isset($m_zamin)) echo $m_zamin ; ?>" min=0.001 max=5000 maxlength="11"  align="baseline" xml:lang="fa" />
                                        </div></td>
                                    <td><div style="margin-right:30px" align="right">:مساحت زمین</div></td>
                                </tr>
                                <tr>
                                    <td height="5" colspan="5">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td  height="42" colspan="5" bgcolor="#CCCCCC"><?php if($no_mal<>7) echo '<p align="center" style="color:#0066CC" > اطلاعات بهره بردار '.$v_co_name.' بعنوان مالک ثبت خواهد شد </p>' ;  else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>' ?></td>
                                            </tr>
                                            <tr>
                                                <td width="31%" height="58"><div align="right">
              <select name="m_jens"  class="input_text mar required" id="m_jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="6">
              <option value="1" <?php if (isset($jens) && $row['jens']=='1') echo 'selected=selected'?>>مرد</option>
               <option value="2" <?php if (isset($jens) && $row['jens']=='2') echo 'selected=selected'?>>زن</option>
                </select>
                                                    </div></td>
                                                <td width="20%"><div align="right">جنسیت</div></td>
                                                <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
                                                <td width="30%"  bgcolor="#FFFFFF"><div align="right"  >
                                                        <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="5"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="12" xml:lang="fa"/>
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
                                                        <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="7" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="75" xml:lang="fa"/>
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
                                                <td><div style="margin-right:30px" align="right"><?php if ($no_bah==2) echo ':نام شرکت'; else echo ':نام پدر' ; ?></div></td>
                                            </tr>
                                            <tr>
                                                <td height="60" colspan="4"><div align="right">
            <select name="m_vaz_sok" class="required input_text  " id="m_vaz_sok"  style="height:40px ; width:120px ; direction:rtl" tabindex="12">
            <option value="">انتخاب کنید</option>
            <option value="1" <?php if (isset($m_vaz_sok) && $m_vaz_sok=='1') { echo 'selected="selected"' ; } ?>>ساکن</option>
            <option value="2" <?php if (isset($m_vaz_sok) &&$m_vaz_sok=='2') { echo 'selected="selected"' ; } ?> >غیرساکن</option>
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
                                    <td height="243" colspan="5" bgcolor="#FFFFFF">
                                        <?php if($no_kesh=='1'){?>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات آب</strong></div></td>
                                                </tr>
                                                <tr>
                                                    <td width="31%" height="53"><div align="right">
                                                            <span class="style2">شبانه روز</span>
                                                            <input name="md_ab" type="text" class="required number input_text" id="md_ab" style="width:50px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php if(isset($md_ab)) echo $md_ab ; ?>" maxlength="2" xml:lang="fa"/>
                                                            <br />
                                                        </div></td>
                                                    <td width="20%"><div align="right">:مدار آبیاری</div></td>
                                                    <td width="1%">&nbsp;</td>
                                                    <td width="30%" bgcolor="#FFFFFF"><div align="right">
                      <select name="m_ab" class="input_text required " id="m_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="14">
                         <option value="">انتخاب کنید</option>
                         <option value="1" <?php if (isset($m_ab) and $m_ab=='1') { echo 'selected="selected"' ; } ?> >چشمه</option>
                         <option value="2" <?php if (isset($m_ab) and $m_ab=='2') { echo 'selected="selected"' ; } ?>>قنات</option>
                         <option value="3" <?php if (isset($m_ab) and $m_ab=='3') { echo 'selected="selected"' ; } ?>>رودخانه</option>
                         <option value="4" <?php if (isset($m_ab) and $m_ab=='4') { echo 'selected="selected"' ; } ?>>سد</option>
                         <option value="5" <?php if (isset($m_ab) and $m_ab=='5') { echo 'selected="selected"' ; } ?>>چاه سطحی</option>
                         <option value="6"  <?php if (isset($m_ab) and $m_ab=='6') { echo 'selected="selected"' ; } ?>>چاه عمیق</option>
                         <option value="7"  <?php if (isset($m_ab) and $m_ab=='7') { echo 'selected="selected"' ; } ?>>چاه نیمه عمیق</option>
                         <option value="8"  <?php if (isset($m_ab) and $m_ab=='8') { echo 'selected="selected"' ; } ?>>زهکش</option>
                         <option value="9"  <?php if (isset($m_ab) and $m_ab=='9') { echo 'selected="selected"' ; } ?>>پساب</option>
                         <option value="10" <?php if (isset($m_ab) and $m_ab=='10') { echo 'selected="selected"' ; } ?>>آب بندان</option>
                         <option value="11" <?php if (isset($m_ab) and $m_ab=='11') { echo 'selected="selected"' ; } ?>>سایر</option>
                       </select></div></td>
                                                    <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: منبع آب</div></td>
                                                </tr>
                                                <tr>
                                                    <td height="47"><div align="right">
                      <select name="no_sab" class="input_text required " id="no_sab"  style="height:40px ; width:170px ; direction:rtl" tabindex="17">
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if (isset($no_sab) && ($no_sab=='1')) { echo 'selected="selected"' ; } ?>>پروانه بهره برداری</option>
                       <option value="2" <?php if (isset($no_sab) && ($no_sab=='2')) { echo 'selected="selected"' ; } ?>>مجوز آب</option>
                       <option value="3" <?php if (isset($no_sab) && ($no_sab=='3')) { echo 'selected="selected"' ; } ?>>عرفی</option>
                       <option value="4" <?php if (isset($no_sab) && ($no_sab=='4')) { echo 'selected="selected"' ; } ?>>سایر</option>
                      </select>
                                                        </div></td>
                                                    <td><div align="right">:نوع سند حقابه</div></td>
                                                    <td>&nbsp;</td>
                                              <td><div align="right"><span class="style2">ساعت</span>
                      <input name="h_ab" type="text" class="input_text  required number" id="h_ab" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php if(isset($h_ab)) echo $h_ab ; ?>" maxlength="4"  align="baseline" xml:lang="fa" />
                                                        </div></td>
                                                    <td><div style="margin-right:30px" align="right">:حقابه</div></td>
                                                </tr>
                                                <tr>
                                                    <td height="52"><div align="right">
                       <select name="es" class="input_text required" id="es"  style="height:40px ; width:170px ; direction:rtl" tabindex="19">
                          <option value="">انتخاب کنید</option>
                          <option value="1" <?php if (isset($es) and $es=='1') { echo 'selected="selected"' ; } ?> >ندارد</option>
                          <option value="2" <?php if (isset($es) and $es=='2') { echo 'selected="selected"' ; } ?>>دارد / جهت ذخیره آب</option>
                          <option value="3" <?php if (isset($es) and $es=='3') { echo 'selected="selected"' ; } ?>>دارد - دو منظوره </option>
                       </select>
                                                        </div></td>
                                                    <td><div align="right"> :وضعیت استخر</div></td>
                                                    <td>&nbsp;</td>
                                                    <td bgcolor="#FFFFFF"><div align="right">
                       <select name="no_ab" class="input_text  required" id="no_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="18">
                          <option value="">انتخاب کنید</option>
                          <option value="1" <?php if (isset($no_ab) and $no_ab=='1') { echo 'selected="selected"' ; }?>>جوی و پشته</option>
                          <option value="2" <?php if (isset($no_ab) and $no_ab=='2') { echo 'selected="selected"' ; }?>>نواری</option>
                          <option value="3" <?php if (isset($no_ab) and $no_ab=='3') { echo 'selected="selected"' ; }?>>غرقابی</option>
                          <option value="4" <?php if (isset($no_ab) and $no_ab=='4') { echo 'selected="selected"' ; }?>>تشتکی</option>
                          <option value="5" <?php if (isset($no_ab) and $no_ab=='5') { echo 'selected="selected"' ; }?>>تحت فشار قطره ای</option>
                          <option value="6" <?php if (isset($no_ab) and $no_ab=='6') { echo 'selected="selected"' ; }?>>تحت فشار بارانی</option>
                          <option value="7" <?php if (isset($no_ab) and $no_ab=='7') { echo 'selected="selected"' ; }?>>سایر</option>
                        </select>
                                                        </div></td>
                                                    <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نحوه آبیاری</div></td>
                                                </tr>
                                            </table>
                                        <?php }?>
                                    </td>
                                </tr>
                              <tr>
                                    <td height="58"><div align="right"><span class="style2">هکتار</span>
                                      <input name="s_ayesh" type="text" class="s_ayesh mashat input_text required number" id="s_ayesh" style="width:100px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php if(isset($s_ayesh)) echo $s_ayesh ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
                                    </div></td>
                                    <td height="58"><div align="right">: سطح آیش</div></td>
                                    <td height="58">&nbsp;</td>
                                    <td height="58"><div align="right">
                                      <select name="z_sal" class="z_sal input_text  required" id="z_sal"  style="height:40px ; width:120px ; direction:rtl" tabindex="20">
                                        <option value="">انتخاب کنید</option>
                                        <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405'){echo 'selected=selected';}?>>1404-1405</option>
                                      </select>
                                    </div></td>
                                    <td><div style="margin-right:30px" align="right">: سال زراعی</div></td>
                                </tr>

                            </table>
                            <div align="center">
                                <p>
                                    <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
                                    <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
                                    <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
                                    <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
                                    <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
                                    <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
                                    <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
                                    <input type="hidden" name="check_cod" value=<?php echo $check_cod; ?> />
                                    <input type="hidden" name="no_kesh" value=<?php echo $no_kesh; ?> />
                                    <input type="hidden" name="no_mal" value=<?php echo $no_mal; ?> />
                                    <a href="Agri1.php">
                                    <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="35" /></a>
                                    <input  type="submit" name="action" value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="34" id="submit" onClick="setTimeout(disableFunction, 1);"/>
                              </p>
                          </div>
                        </form>
<script>
  document.getElementById("form1").addEventListener("submit", function (e) {
    if ($(this).valid()) {
      $("#submit").prop("disabled", true);
    } else {
      e.preventDefault(); // جلوگیری از ارسال فرم در صورت نامعتبر بودن
    }
  });
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
</body>
</html>
<script>
$('.s_ayesh').keyup(function () {
 var zamin = document.getElementById("m_zamin").value;
 if (zamin === '') { zamin = 0 ; }
 var ayesh = document.getElementById("s_ayesh").value;
 if(parseFloat(ayesh) > parseFloat(zamin) )
 {
   alert("خطا !!  \n  سطح آیش وارد شده با توجه به مساحت کل زمین صحیح نیست ");
    // پاک کردن سطح برداشت 1
		$('#s_ayesh').val(0);
}
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